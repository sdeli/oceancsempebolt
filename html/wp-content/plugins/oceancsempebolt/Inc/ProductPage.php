<?php
namespace Inc;
use \Shared\Utils;
use \Shared\Config;

class ProductPage 
{
  static function init() {
    add_filter( 'woocommerce_short_description', function($post_post_excerpt) {
      if (is_product()) {
        return self::addShortDescriptionBefore($post_post_excerpt);
      }
    });

    add_action( 'woocommerce_after_single_product_summary', function() {
      self::echoRelatedProductsByFamily();
    }, 1);
    
    add_action( 'woocommerce_after_single_product_summary', function() {
      global $product;
      if (Utils::is_tile($product->get_id())) {
        echo Config::UKRAINE_WAR_MESSAGE;
      }
    }, 15);
    add_action( 'woocommerce_after_single_product_summary', function() {
      self::echoPopularProducts();
    }, 25);

    add_action( 'woocommerce_breadcrumb_main_term', function($main_term) {
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
        $is_referred_from_product_listing_page = strpos($_SERVER['HTTP_REFERER'], $product_cat->slug);
        if ($is_referred_from_product_listing_page) {
          return $product_cat;
        }
      }

      return $direct_categories[0];
    });
  }

  static private function addShortDescriptionBefore($post_post_excerpt) {
      $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)];
      $post_post_excerpt = $post_post_excerpt
          . '<div class="call-us"><i class="map-pin-fill"></i><p style="margin-bottom: 5px;">'
          . '<strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>:'
          . '<i class="icon-phone" style="color: black;"></i>'
          . '<a class="' . Config::OCEAN_PHONE_CALL_LINK_CLASS . '" href="tel:'. $randTelNumber[1] . '" style="cursor: pointer; color: #4e657b">' . $randTelNumber[0] . ' - ' . $randTelNumber[2] . '</a>'
          . '<a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975"'
            . 'style="cursor: pointer; color: #4e657b"'
            . 'target="_blank">'
            . ' - Térkép a bolthoz'
            . '<i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>'
          . '</a></div>';

    return $post_post_excerpt;
  }

  static function echoRelatedProductsByFamily() {
    $args = array(
			'posts_per_page' => 8,
			'columns'        => 2,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			'order'          => 'desc',
		);

    Utils::get_related_products_by_family($args);
  }

  static function echoPopularProducts() {
    ?>
      <h3 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">
        Most Népszerű			
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

  static function is_direct_category($product_cat) {
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
}