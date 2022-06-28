<?php

function get_collection_images(array $choosen_filters) {
  if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

  $args = array(
    'post_type'             => 'designs',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => 20,
    'paged'                 => $paged,
  );

  if (!count($choosen_filters)) {
    return new \WP_Query($args);
  }

  $args['tax_query'] = ['relation' => 'IN'];
         
  foreach ($choosen_filters as $query_var => $filter) {
    $args['tax_query'][] = [
      'taxonomy'      => 'design_category',
      'field' => 'slug',
      'terms' => [ $filter ]
    ];
  }


  return new \WP_Query($args);
}

function get_brand_and_family_design_categories(WP_Post $design) {
  $design_categories = get_the_terms( $design->ID, 'design_category' );
  if (!$design_categories || $design_categories instanceof WP_Error) return false;

  $brand_cat = '';
  $family_cat = '';

  foreach ($design_categories as $design_category) {
    $is_brand_or_family = term_is_ancestor_of(\Shared\Config::DESIGN_BRANDS_PRODUCT_CATEG_ID, $design_category, 'design_category');
    if (! $is_brand_or_family) continue;

    $is_brand = \Shared\Config::DESIGN_BRANDS_PRODUCT_CATEG_ID === $design_category->parent;
    if ($is_brand) {
      $brand_cat = $design_category;
    } else {
      $family_cat = $design_category;
    }

    if (!empty($brand_cat) && !empty($family_cat)) break;
  }

  if (empty($brand_cat) && empty($family_cat)) return false;
  return [ $brand_cat, $family_cat ];
}

function is_exhibited_in_shop(string $product_or_categ_slug) {
  $is_product = ! get_term_by('slug', $product_or_categ_slug, 'design_category');
  if ($is_product) {
    $args = array(
      'name'        => $product_or_categ_slug,
      'post_type'   => 'product',
      'post_status' => 'publish'
    );

    $product = get_posts($args);
    $product_can_not_be_identified_by_slug = count($product) !== 1;
    if ($product_can_not_be_identified_by_slug) return false;
    return has_term( \Shared\Config::EXHIBITED_IN_SHOP_TAG_SLUG, 'post_tag', $product[0]->ID);
  }

  $products = wc_get_products(array(
    'category' => array( $product_or_categ_slug),
  ));

  foreach($products as $product) {
    $is_exhibited = in_array(6184, $product->get_tag_ids());
    if ($is_exhibited) {
      return true;
    }
  }

  return false;
}

function get_category_names_by_parent(int $parent_id, array $excludes = []) {
  $termchildren = array(
    'hierarchical' => 1,
    'show_option_none' => '',
    'hide_empty' => 0,
    'parent' => $parent_id ,
    'taxonomy' => 'design_category',
  );

  if (!empty($excludes))  $termchildren['exclude'] = $excludes;

  $categ_names = array_map(function ($category) { 
    return $category->name;
  }, get_categories($termchildren));

  return $categ_names;
}

function get_select_dropdown(string $name, array $items, string $label, string $choosen = '') {
   $default = empty($choosen) ? 'selected' : '';
  ?>
    <div class="ocs_dropdown">
      <select name="<?= $name ?>" class="ocs_select thin-input">
        <option value="" <?= $default ?>><?= $label ?></option>
        
        <?php 
          foreach ($items as $item) {
            if (!empty($choosen) && $choosen === $item) {
              echo '<option value="'. $item .'" selected>' . ucwords($item) . '</option>';
            } else {
              echo '<option value="'. $item .'">' . ucwords($item) . '</option>';
            }
          }
        ?>
      </select>
    </div>
  <?php 
}

function get_choosen_GET_category(string $get_variable_name, array $categories ) {
  if (!isset($_GET[$get_variable_name])) {
    return '';
  }

  $has_valid_choosen_category = in_array($_GET[$get_variable_name], $categories, true);
  $choosen_category = $has_valid_choosen_category ? $_GET[$get_variable_name] : '';
  return $choosen_category;
}

function  ocs_flatsome_posts_pagination(WP_Query $collections_query) {

  $prev_arrow = is_rtl() ? get_flatsome_icon('icon-angle-right') : get_flatsome_icon('icon-angle-left');
  $next_arrow = is_rtl() ? get_flatsome_icon('icon-angle-left') : get_flatsome_icon('icon-angle-right');

  $total = $collections_query->max_num_pages;
  $big = 999999999; // need an unlikely integer
  if( $total > 1 )  {

       if( get_option('permalink_structure') ) {
           $format = 'page/%#%/';
       } else {
           $format = '&paged=%#%';
       }
      $pages = paginate_links(array(
          'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format'        => $format,
          'current'       => max( 1, get_query_var('paged') ),
          'total'         => $total,
          'mid_size'      => 3,
          'type'          => 'array',
          'prev_text'     => $prev_arrow,
          'next_text'     => $next_arrow,
       ) );

      if( is_array( $pages ) ) {
          echo '<ul class="page-numbers nav-pagination links text-center">';
          foreach ( $pages as $page ) {
                  $page = str_replace("page-numbers","page-number",$page);
                  echo "<li>$page</li>";
          }
         echo '</ul>';
      }
  }

  function get_collection_brand_link() {
    
  }

  function get_collection_family_link() {

  }
}