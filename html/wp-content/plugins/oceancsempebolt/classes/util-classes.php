<?php 

use \Shared\Config;

class OCS_Product_Brand_Categories
{
  public $brand = null;
  public $family = null;

  function __construct($product) {
    $product_categories = wc_get_product_terms(
      $product->get_id(),
      'product_cat',
      apply_filters(
        'woocommerce_breadcrumb_product_terms_args',
        array(
          'orderby' => 'parent',
          'order'   => 'DESC',
        )
      )
    );

    foreach ($product_categories as $product_cat) {
      $is_tile_brand = Config::TILE_BRANDS_PRODUCT_CATEG_ID === $product_cat->parent;
      if ($is_tile_brand) {
        $this->brand = $product_cat;
        continue;
      }
      
      $is_brand_or_family = Config::BRANDS_PRODUCT_CATEG_ID === $product_cat->parent;
      if ($is_brand_or_family) {
        $this->brand = $product_cat; 
        continue;
      }
      
      $parent_term = get_term_by( 'term_id', $product_cat->parent, 'product_cat' );
      if (!isset($parent_term->parent)) continue;
      
      $is_tile_family = Config::TILE_BRANDS_PRODUCT_CATEG_ID === $parent_term->parent;
      if ($is_tile_family) {
        $this->family = $product_cat;
        continue;
      }

      $is_family = Config::BRANDS_PRODUCT_CATEG_ID === $parent_term->parent;
      if ($is_family) {
        $this->family = $product_cat;
        continue;
      }
    }
  }
}