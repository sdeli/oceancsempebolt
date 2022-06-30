<?php
namespace Shared;
use \Shared\Config;

class Utils {
  const C = 'constant';

  static function is_local() {
    return wp_get_environment_type() === Config::ENVIRONMENT_TYPE_LOCAL;
  }

  static function is_prod() {
    return wp_get_environment_type() === Config::ENVIRONMENT_TYPE_PROD;
  }

  static function is_dev() {
    return wp_get_environment_type() === Config::ENVIRONMENT_TYPE_DEV;
  }

  static function is_tile(string $product_id) {
    return has_term( Config::BURKOLATOK_CATEG_SLUG, 'product_cat', $product_id);
  }

  static function get_most_expensive_product($category_slug) {
    $query = array(
      'limit' => 1,
      'post_type'=> 'product',
      'post_status'           => 'publish',
      'orderby' => 'price',
      'order' => 'DESC', 
      'tax_query'             => array(
        array(
            'taxonomy'      => 'product_cat',
            'field' => 'slug',
            'terms'         => $category_slug,
            'operator'      => 'IN'
        ),
      ) 
    );

    $the_query = new \WP_Query($query);
    if ( $the_query->have_posts() ) {
      return wc_get_product($the_query->post);
    } else {
      return false;
    }
  }

  static function get_main_product_category(\WP_Term $main_term = null) {
    $main_term = is_null($main_term) ? false : $main_term;
    global $post;

    $product_categories = wc_get_product_terms(
      $post->ID,
      'product_cat',
      apply_filters(
        'woocommerce_breadcrumb_product_terms_args',
        array(
          'orderby' => 'parent',
          'order'   => 'DESC',
        )
      )
    );

    $direct_categories = [];
    foreach ($product_categories as $product_cat) {
      $is_direct_category = self::is_direct_category($product_cat);
      if ($is_direct_category) $direct_categories[] = $product_cat;
    }

    if (empty($direct_categories)) {
      return $main_term;
    }

    if (count($direct_categories) === 1) {
      return $direct_categories[0];
    }

    foreach ($direct_categories as $product_cat) {
      $is_referred_from_product_listing_page = $_SERVER['HTTP_REFERER'] ?? strpos($_SERVER['HTTP_REFERER'], $product_cat->slug);
      if ($is_referred_from_product_listing_page) {
        return $product_cat;
      }
    }

    return $direct_categories[0];
  }

  static function get_products_by_cat_ids(array $cat_ids, array $exclude_ids, int $product_amount = 12) {
    $args = array(
      'post_type'             => 'product',
      'post_status'           => 'publish',
      'ignore_sticky_posts'   => 1,
      'orderby'               => 'rand',
      'posts_per_page'        => $product_amount,
      'post__not_in' => array( $exclude_ids ),
      'tax_query'             => array(
        array(
            'taxonomy'      => 'product_cat',
            'field' => 'term_id',
            'terms'         => $cat_ids,
            'operator'      => 'IN'
        ),
      )
    );

    $products = new \WP_Query($args);
    return $products->posts;
  }

  static function get_pdf_catalog_data_for_category() {
    if (is_shop()) return false;

    global $wp_query;
    $category = $wp_query->get_queried_object();

    $slug = $category->slug;

    $hasCatalogUrl = isset(Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug]);
    if ($hasCatalogUrl) {
      return Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug];
    }
    
    $categs_term_id = $category->term_id;
    $parent_category_ids = get_ancestors($categs_term_id, 'product_cat');
    
    foreach(Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES as $categ_slug => $catalog_data) { 
      $parent_categ_with_catalog_found = in_array($catalog_data['term_id'], $parent_category_ids);

      if ($parent_categ_with_catalog_found) return $catalog_data;
    }
  
    return false;
  }

  static function get_attributes_by_product_categories(): array {
    global $wpdb;
    $result = $wpdb->get_results ("SELECT * FROM view_attributes_by_product_categories;");
    $attributes_by_categories = [];
  
    foreach ($result as $row) {
      $currentCategorySlug = $row->category_slug;
      $displayName = $row->attribute_value_name;
      $lookOnFrontEnd = $row->attribute_slug === 'pa_szin' ? Config::LOOK_COLOR : Config::LOOK_TAG;
      $filterType = preg_replace('/pa_/i', '', $row->attribute_slug);
      $attributeTemplateValues = [
        'id' => $row->attribute_value_id, 
        'displayName' => $displayName, 
        'slug' => $row->attribute_value_slug, 
        'form' => $lookOnFrontEnd,
        'type' => $filterType
      ];
      
      if (isset($attributes_by_categories[$currentCategorySlug])) {
        array_push($attributes_by_categories[$currentCategorySlug],$attributeTemplateValues);
      } else {
        $attributes_by_categories[$currentCategorySlug] = [$attributeTemplateValues];
      }
    }
    
    return $attributes_by_categories;
  }

  function get_attribute_filter_icons($categorySlug, $attrFilterTemplateValuesArr = null, $shouldNavigate = false) {
    if (!$attrFilterTemplateValuesArr) return '';
  
    $colorFilterHtml = "<li id=\"{$categorySlug}\" class=\"sidebar-filter--{$categorySlug} sidebar-filter cat-item cat-item-1458 color-filter\"><ul>";
    $attrFilterTemplateValuesArr = self::move_colors_to_front($attrFilterTemplateValuesArr);
  
    foreach($attrFilterTemplateValuesArr as $attrFilterTemplateValues) {
      if ($attrFilterTemplateValues['form'] === Config::LOOK_COLOR) {
        $colorFilterHtml .= self::get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
      } else {
        $colorFilterHtml .= self::get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
      }
    };
  
    $colorFilterHtml .= '</ul></li>';
    return $colorFilterHtml;
  }
  
  
  static function move_colors_to_front($attrFilterTemplateValuesArr) {
    $colors = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
      return $templateValues['form'] === Config::LOOK_COLOR;
    });
    
    $tags = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
      return $templateValues['form'] === Config::LOOK_TAG;
    });
    
    return array_merge($colors, $tags);
  }

  private static function is_direct_category($product_cat) {
    $term_id = $product_cat->term_id;
    $is_brand_term = $term_id === Config::TILE_BRANDS_PRODUCT_CATEG_ID || $term_id === Config::BRANDS_PRODUCT_CATEG_ID;
    if ($is_brand_term) return false;

    $term_ancestor_ids = get_ancestors( $term_id, 'product_cat', 'taxonomy' );

    $is_tile_brand_or_family = in_array(Config::TILE_BRANDS_PRODUCT_CATEG_ID, $term_ancestor_ids);
    if ($is_tile_brand_or_family) return false; 

    $is_brand_or_family = in_array(Config::BRANDS_PRODUCT_CATEG_ID, $term_ancestor_ids);
    if ($is_brand_or_family) return false;

    $is_direct_categ = empty(get_term_children( $term_id, 'product_cat' ));
    return $is_direct_categ;
  }
  
  private static function get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
    $colorFilterId = $attrFilterTemplateValues['id'];
    $displayName = $attrFilterTemplateValues["displayName"];
    $isSidebarFilterLinkClass = "";
    $isCheckedClass = "";
    
    if ($shouldNavigate) {
      $href ="/{$categorySlug}/?filters=szin[{$colorFilterId}]";
      $isSidebarFilterLinkClass = Config::SIDEBAR_FILTER_LINK_CLASS; 
    } else {
      $href = "javascript:activateColorFilter('$categorySlug', {$colorFilterId})";
      $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
      $isCheckedClass = str_contains($currentFilters, $colorFilterId) ? Config::CHECKED_CLASS : "";
    }
    
    return ''
    ."<li class=\"sidebar-filter__circle {$isCheckedClass} {$isSidebarFilterLinkClass} sidebar__filter-{$colorFilterId}\" title='$displayName'>"
      ."<a href=\"{$href}\">{$displayName}</a>"
    ."</li>";
  }
  
  private static function get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
    $attributeFilterId = $attrFilterTemplateValues['id'];
    $displayName = $attrFilterTemplateValues["displayName"];
    $filterType = $attrFilterTemplateValues["type"];
    $isCheckedClass = "";

    if ($shouldNavigate) {
      $href ="/{$categorySlug}/?filters={$filterType}[{$attributeFilterId}]";
      $isSidebarFilterLinkClass = Config::SIDEBAR_FILTER_LINK_CLASS;
    } else {
      $href = "javascript:activateAttributeFilter('$categorySlug', {$attributeFilterId})";
      $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
      $isCheckedClass = str_contains($currentFilters, $attributeFilterId) ? Config::CHECKED_CLASS : "";
    }
    
    return ''
    ."<li class=\"sidebar-filter__tag {$isCheckedClass} {$isSidebarFilterLinkClass} sidebar__filter-{$attributeFilterId}\">"
      ."<a href=\"{$href}\">{$displayName}</a>"
    ."</li>";
  }

  static function add_design_post_type() {
    $supports = array(
    'title', // post title
    'author', // post author
    'thumbnail', // featured images
    'custom-fields', // custom fields
    'revisions', // post revisions
    );
  
    $labels = array(
    'name' => _x('designs', 'plural'),
    'singular_name' => _x('design', 'singular'),
    'menu_name' => _x('designs', 'admin menu'),
    'name_admin_bar' => _x('designs', 'admin bar'),
    'add_new' => _x('Add design', 'add design'),
    'add_new_item' => __('Add New Design'),
    'new_item' => __('New design'),
    'edit_item' => __('Edit design'),
    'view_item' => __('View design'),
    'all_items' => __('All design'),
    'search_items' => __('Search designs'),
    'not_found' => __('No designs found.'),
    );
  
    $args = array(
    'supports' => $supports,
    'labels' => $labels,
    'public' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'designs'),
    'has_archive' => true,
    'hierarchical' => false,
    'taxonomies' => array('design_category'), 
    'show_in_rest' => true
    );
  
    register_post_type('designs', $args);
  }

  static function getPreviousSite() {
    $current_term = get_queried_object();
    if ($current_term->parent) {
      $parent_term = get_term($current_term->parent, 'product_cat');
      return get_term_link($parent_term->term_id);
    }
  
    return get_permalink( wc_get_page_id( 'shop' ) );
  }

  static function email_instructions( $order, $sent_to_admin ) {
    if ( ! $sent_to_admin && Config::BANK_TRANSFER_LABEL === $order->get_payment_method() && $order->has_status( Config::ON_HOLD_ORDER_STATUS ) ) {
      if ( $order->get_shipping_method() === Config::PALLET_SHIPPING_CLASS_NAME) {
        echo self::get_pallet_shipping_notes($order);
      }
  
      if ( $order->get_shipping_method() === Config::BOX_SHIPPING_CLASS_NAME) {
        echo self::get_box_shipping_notes($order);
      }
    }
  }

  protected static function get_pallet_shipping_notes($order) {
    $bank_account_number = Config::COMPANY_BANK_ACCOUNT;
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)][1];
  
    return <<<EOD
  Kérjük várd meg kollégánk jelentkezését, aki tájékoztatni fog a szállítás dijáról, valamint időtartamról. Addig is hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong><br>
  Miután tájékoztatotást kaptál a szállítási díjról es időről, már átutalhatod nekünk a végösszeget, erre a bankszámlaszámra: <strong>{$bank_account_number}</strong><br>
  Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.
  EOD;
  }
  
  protected static function get_box_shipping_notes($order) {
    $bank_account_number = Config::COMPANY_BANK_ACCOUNT;
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)][1];
  
    return <<<EOD
    Ahoz hogy elindíthassuk megrendelésed folyamatát, kérjük utald el a végösszeget (<strong>{$order->calculate_totals()}Ft</strong>) erre a bankszámlaszámra: <strong>{$bank_account_number}</strong><br>
    Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.<br>
    Ha bármi kérdésed merülne fel, hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong>
  EOD;
  }

  static function get_related_products_by_family($args) {  
    global $product;
		if ( ! $product ) {
			return;
		}
    $product_id = $product->get_id();
    $defaults = array(
			'posts_per_page' => 8,
			'columns'        => 2,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			'order'          => 'desc',
		);

    $args = wp_parse_args( $args, $defaults );
    [$family_categories, $brand_categories] = static::get_family_categories();
    // What comes next is a nested if, which is the ugliest thing I know but it was just fast and makes the job done...
    if (!empty($family_categories) || !empty($brand_categories)) {
      $args['related_products'] = [];

      if (!empty($family_categories)) {
        $related_products_family = array_map( 
          'wc_get_product', 
          self::get_products_by_cat_ids( $family_categories, [$product_id] )
        );
        // $related_products = wc_products_array_orderby( $args['related_products_family'], $args['orderby'], $args['order'] );
        $args['related_products'] = array_merge($args['related_products'], $related_products_family);
      }
      
      if (!empty($brand_categories)) {
        $related_products_brand = array_map( 
          'wc_get_product', 
          self::get_products_by_cat_ids( $brand_categories, [$product_id] )
        );
        // $related_products = wc_products_array_orderby( $args['related_products_brand'], $args['orderby'], $args['order'] );
        $args['related_products'] = array_merge($args['related_products'], $related_products_brand);
      }
    } else {
      $args = wp_parse_args( $args, $defaults );
      $args['related_products'] = array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids()) );
      $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );  
    }
    
    $type             = get_theme_mod( 'related_products', 'slider' );
    $repeater_classes = array();

    if ( $type == 'hidden' ) return;
    if ( $type == 'grid' ) $type = 'row';

    if ( get_theme_mod('category_force_image_height' ) ) $repeater_classes[] = 'has-equal-box-heights';
    if ( get_theme_mod('equalize_product_box' ) ) $repeater_classes[] = 'equalize-box';

    $repeater['type']         = $type;
    $repeater['columns']      = get_theme_mod( 'related_products_pr_row', 4 );
    $repeater['columns__md']  = get_theme_mod( 'related_products_pr_row_tablet', 3 );
    $repeater['columns__sm']  = get_theme_mod( 'related_products_pr_row_mobile', 2 );
    $repeater['class']        = implode( ' ', $repeater_classes );
    $repeater['slider_style'] = 'reveal';
    $repeater['row_spacing']  = 'small';
    ?>
      <div class="related related-products-wrapper product-section">
        <h5 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase ux-builder-padding-top-5 ux-builder-padding-bottom-5">
          Ez is tetszhet			
        </h5>
        <?php 
          get_flatsome_repeater_start( $repeater );

          foreach ( $args['related_products'] as $related_product ) {
            $post_object = get_post( $related_product->get_id() );
            setup_postdata( $GLOBALS['post'] =& $post_object );
            self::echo_related_product($related_product);
          }
          
          get_flatsome_repeater_end( $repeater ); 
          wp_reset_postdata();
        ?>
      </div>
    <?php 
  }

  static protected function echo_related_product($product) {
    // Ensure visibility.
    if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
      return;
    }

    // Check stock status.
    $out_of_stock = ! $product->is_in_stock();

    // Extra post classes.
    $classes   = array();
    $classes[] = 'product-small';
    $classes[] = 'col';
    $classes[] = 'has-hover';
    $classes[] = 'family-brand-product';

    if ( $out_of_stock ) $classes[] = 'out-of-stock';

    ?><div <?php wc_product_class( $classes, $product ); ?>>
      <div class="col-inner">
      
      <div class="product-small box">
        <div class="box-image">
          <div class="<?php echo flatsome_product_box_image_class(); ?>">
            <a href="<?php echo get_the_permalink(); ?>" aria-label="<?php echo esc_attr( $product->get_title() ); ?>">
              <?php
                /**
                 *
                 * @hooked woocommerce_get_alt_product_thumbnail - 11
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'flatsome_woocommerce_shop_loop_images' );
              ?>
            </a>
          </div>
          <?php if ( $out_of_stock ) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php } ?>
        </div>

        <div class="box-text <?php echo flatsome_product_box_text_class(); ?>" style="padding-top: unset; padding-bottom: 5px;font-weight: bold;">
          <?php
            do_action( 'woocommerce_before_shop_loop_item_title' );

            echo '<div class="title-wrapper product-title-ellipsis" style="text-align: center;">' . $product->get_name() . '</div>';
          ?>
        </div>
      </div>
      <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
      </div>
    </div>
    <?php
  }

  static protected function get_family_categories() {
    global $product;

    $brands_categ_id = self::is_tile($product->get_id()) ? Config::TILE_BRANDS_PRODUCT_CATEG_ID : Config::BRANDS_PRODUCT_CATEG_ID;

    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    $family_categories = [];
    $brand_categories = [];

    foreach ($terms as $term) {
      $is_brand_categ = $term->parent === $brands_categ_id;
      if ($is_brand_categ) {
        $brand_categories[] = $term->term_id;
        continue; 
      }

      $parent_cat = get_term($term->parent, 'product_cat');
      if (is_wp_error($parent_cat)) continue;

      $is_family_categ = $parent_cat->parent === $brands_categ_id;
      if ($is_family_categ) {
        $family_categories[] = $term->term_id;
        continue; 
      }
    }

    return [$family_categories, $brand_categories];
  }

  static function echo_popular_products_in_slider(int $products_count = 24, string $classes) {  
    $products_query = self::get_popular_products_query($products_count);
    if( ! $products_query->have_posts() ) return;

    $type             = get_theme_mod( 'related_products', 'slider' );
    $repeater_classes = array();

    if ( $type == 'hidden' ) return;
    if ( $type == 'grid' ) $type = 'row';

    if ( get_theme_mod('category_force_image_height' ) ) $repeater_classes[] = 'has-equal-box-heights';
    if ( get_theme_mod('equalize_product_box' ) ) $repeater_classes[] = 'equalize-box';

    $repeater['type']         = $type;
    $repeater['columns']      = get_theme_mod( 'related_products_pr_row', 4 );
    $repeater['columns__md']  = get_theme_mod( 'related_products_pr_row_tablet', 3 );
    $repeater['columns__sm']  = get_theme_mod( 'related_products_pr_row_mobile', 2 );
    $repeater['class']        = implode( ' ', $repeater_classes );
    $repeater['slider_style'] = 'reveal';
    $repeater['row_spacing']  = 'small';
    
    ?>
      <div class="related related-products-wrapper product-section <?= $classes ?>">
        <h5 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase ux-builder-padding-top-5 ux-builder-padding-bottom-5">
          Feldobják a fürdőszobád			
        </h5>
        <?php 
        get_flatsome_repeater_start( $repeater );

        while ( $products_query->have_posts() ) {
          $products_query->the_post();
          $product = wc_get_product( $products_query->post->ID );
          self::echo_related_product($product);
        }
        
        get_flatsome_repeater_end( $repeater ); ?>
      </div>
    <?php 
  }

  static function echoPopularProducts() {
    ?>
      <h3 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">
        Feldobják a fürdőszobád			
      </h3>
    <?php 
    
    $products_query = self::get_popular_products_query(8);
    
    if( $products_query->have_posts() ){
      ?>
        <div class="products row row-small large-columns-4 medium-columns-3 small-columns-1 popular-products-loop ux-builder-margin-bottom-15">
      <?php 
        while( $products_query->have_posts() ){
          $products_query->the_post();
          do_action( 'woocommerce_shop_loop' );

          wc_get_template_part( 'content', 'product' );
        }
      ?>
        </div>
      <?php 
      
    }
  }

  static function get_popular_products_query(int $product_amount = 12, array $exclude_ids = []): \WP_Query {
    $args = array(
      'post_type'             => 'product',
      'post_status'           => 'publish',
      'ignore_sticky_posts'   => 1,
      'orderby'               => 'rand',
      'posts_per_page'        => $product_amount,
      'post__not_in' => array( $exclude_ids ),
      'tax_query'             => array(
        array(
            'taxonomy'      => 'pa_nepszeruseg',
            'field' => 'slug',
            'operator'      => 'IN',
            'terms'         => 'magas',
        ),
      )
    );

    return new \WP_Query($args);
  }
}