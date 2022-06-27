<?php
use \Shared\Settings;

function get_collection_images() {
  $args = array(
    'post_type'             => 'designs',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => 20,
    'tax_query'             => array(
      array(
          'taxonomy'      => 'design_category',
          'field' => 'slug',
          'operator'      => 'IN'
      ),
    )
  );

  $args['tax_query'][0]['terms'] = isset($_GET[Settings::TILE_TYPE]) ? sanitize_text_field([$_GET[Settings::TILE_TYPE]]) : ['burkolatok-product-category'];

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

function get_select_dropdown(string $name, array $items, string $label) {
  ?>
    <div class="ocs_dropdown">
      <select name="<?= $name ?>" class="ocs_select">
        <option value="" selected=""><?= $label ?></option>
        <?php foreach ($items as $item) { ?>
          <option value="<?= $item ?>"><?= $item ?></option>
        <?php } ?>
      </select>
    </div>
  <?php 
  
}