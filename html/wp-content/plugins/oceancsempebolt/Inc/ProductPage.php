<?php
namespace Inc;
use \Shared\Utils;
use \Shared\Config;

class ProductPage 
{
  static function init() {
    add_filter( 'woocommerce_short_description', function($post_post_excerpt) {
      if (is_product()) {
        return self::extendShortDescription($post_post_excerpt);
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
      global $product;
      $prod_id = $product->get_id();
      if ($prod_id && Utils::is_tile($prod_id)) {
        Utils::echoTilesGrid();
      } else {
        Utils::echoPopularProducts();
      }
    }, 25);

    add_action( 'woocommerce_breadcrumb_main_term', function(\WP_Term $main_term) {
      return Utils::get_main_product_category($main_term);
    });

    add_action( 'woocommerce_product_categories_widget_main_term', function(\WP_Term $main_term) {
      return Utils::get_main_product_category($main_term);
    });

    add_action( 'woocommerce_after_add_to_cart_button', function() {
      self::echoContactFormBtn();
    });
  }



  static private function echoContactFormBtn() {
    $contact_page_url = get_site_url() . Config::CONTACT_PAGE_PATH . '/#scroll-to-contact-form';
    ?>
      <a href="<?= $contact_page_url ?>" name="add-to-cart" value="24445" class="to_contact_form_btn single_add_to_cart_button button alt">Kérjen egyedi ájánlatot</a>
    <?php 
  }

  static private function extendShortDescription(string $post_post_excerpt) {
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)];
    $brand_and_family = new \OCS_Product_Brand_Categories(wc_get_product());

    if (!is_null($brand_and_family->brand)) {
      $brand_html = '<div class="ocs-product-brands">';
      $brand_html .= '<div class="brand" style="margin-bottom: 5px;"><span>Márka: </span><a href="' . get_term_link($brand_and_family->brand) . '" target="_blank">'. $brand_and_family->brand->name .'</a></div>';
    }

    if (!is_null($brand_and_family->family)) {
      if (!isset($brand_html)) $brand_html = '<div class="ocs-product-brands">';
      $brand_html .= '<div class="brand" style="margin-bottom: 5px;"><span>Család: </span><a href="' . get_term_link($brand_and_family->family) . '" target="_blank">'. $brand_and_family->family->name .'</a></div>';
    }

    if (isset($brand_html)) {
      $brand_html .= '</div>';
      $post_post_excerpt .= $brand_html;
    } 

    $post_post_excerpt = $post_post_excerpt
    . '<div class="ocs-product-brands"><span></span></div>'
    . '<div class="call-us"><i class="map-pin-fill"></i><p style="margin-bottom: 5px;">'
    . '<strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>:'
    . '<i class="icon-phone" style="color: black;"></i>'
    . '<a class="' . Config::OCEAN_PHONE_CALL_LINK_CLASS . '" href="tel:'. $randTelNumber[1] . '" style="cursor: pointer; color: #4e657b">' . $randTelNumber[0] . ' - ' . $randTelNumber[2] . '</a>'
    . '<a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975"'
    . 'style="cursor: pointer; color: #4e657b"'
    . 'target="_blank">'
    . ' - Térkép a bolthoz'
    . '<i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>'
    . '</a></div>'
    . '<a href="/kollekciok" target="_blank"><strong style="color:#686868;">Burkolat kollekcióink</strong><span style="color: #4e657b""> - Kattints ide és meríts ötletet képeinkből!</span></a>';
    
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
}