<?php
namespace Inc;
use \Inc\Config;

class Utils {
  const C = 'constant';

  static function get_catalog_for_category($category) {
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
      $lookOnFrontEnd = $row->attribute_slug === 'pa_szin' ? LOOK_COLOR : LOOK_TAG;
      $filterType = preg_replace('/pa_/i', '', $row->attribute_slug);
      $attributeTemplateValues = [
        'id' => $row->attribute_value_id, 
        'displayName' => $displayName, 
        'slug' => $row->attribute_value_slug, 
        'form' => $lookOnFrontEnd,
        'type' => $filterType
      ];
      
      if ($attributes_by_categories[$currentCategorySlug]) {
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
      if ($attrFilterTemplateValues['form'] === LOOK_COLOR) {
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
      return $templateValues['form'] === LOOK_COLOR;
    });
    
    $tags = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
      return $templateValues['form'] === LOOK_TAG;
    });
    
    return array_merge($colors, $tags);
  }
  
  private static function get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
    $colorFilterId = $attrFilterTemplateValues['id'];
    $displayName = $attrFilterTemplateValues["displayName"];
    $isSidebarFilterLinkClass = "";
    $isCheckedClass = "";
    
    if ($shouldNavigate) {
      $url_base = Config::PRODUCT_CATEG_URL_BASE; 
      $href ="{$url_base}/{$categorySlug}/?filters=szin[{$colorFilterId}]";
      $isSidebarFilterLinkClass = Config::SIDEBAR_FILTER_LINK_CLASS; 
    } else {
      $href = "javascript:activateColorFilter('$categorySlug', {$colorFilterId})";
      $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
      $isCheckedClass = str_contains($currentFilters, $colorFilterId) ? CHECKED_CLASS : "";
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
    
    if ($shouldNavigate) {
      $href ="/{$categorySlug}/?filters={$filterType}[{$attributeFilterId}]";
      $isSidebarFilterLinkClass = SIDEBAR_FILTER_LINK_CLASS;
    } else {
      $href = "javascript:activateAttributeFilter('$categorySlug', {$attributeFilterId})";
      $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
      $isCheckedClass = str_contains($currentFilters, $attributeFilterId) ? CHECKED_CLASS : "";
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
    );
  
    register_post_type('designs', $args);
  }

  static function disable_wc_terms_toggle() { 
    remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
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


  static function add_gtm_to_head() {
    $get_gtm_script_tag = function() {
      ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MHFCRTX');</script>
        <!-- End Google Tag Manager -->
      <?php
    };
    add_action('wp_head', $get_gtm_script_tag, -10000);
  }
  
  static function add_gtm_to_body() {
    $get_gtm_script_tag = function() {
      ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHFCRTX"
          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
      <?php
    };
    
    add_action('wp_body_open', $get_gtm_script_tag, -10000);
  }

  protected static function get_pallet_shipping_notes($order) {
    $C = self::C;
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)][1];
  
    return <<<EOD
  Kérjük várd meg kollégánk jelentkezését, aki tájékoztatni fog a szállítás dijáról, valamint időtartamról. Addig is hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong><br>
  Miután tájékoztatotást kaptál a szállítási díjról es időről, már átutalhatod nekünk a végösszeget, erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
  Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.
  EOD;
  }
  
  protected static function get_box_shipping_notes($order) {
    $C = self::C;
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)][1];
  
    return <<<EOD
    Ahoz hogy elindíthassuk megrendelésed folyamatát, kérjük utald el a végösszeget (<strong>{$order->calculate_totals()}Ft</strong>) erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
    Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.<br>
    Ha bármi kérdésed merülne fel, hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong>
  EOD;
  }
}