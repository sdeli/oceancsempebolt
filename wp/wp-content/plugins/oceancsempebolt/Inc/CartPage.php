<?php
namespace Inc;

class CartPage 
{
  static function init() {
    add_action( 'woocommerce_cart_totals_before_shipping', function() {  
      self::removeInvalidShippingMethods();
    } );
  }

  static private function removeInvalidShippingMethods() {
    $productsInCart = WC()->shipping()->packages[0]['contents'];
    $has_pallet_product_in_cart = false;
    foreach ( $productsInCart as $product ) {
      $shipping_class_id = $product['data']->get_shipping_class_id();
      if ($shipping_class_id === Config::PALLET_SHIPPING_CLASS_ID) {
        $has_pallet_product_in_cart = true;
        break;
      }
    }

    $available_methods = WC()->shipping()->packages[0]['rates'];
    $available_methods = array_filter($available_methods, function($method) use ($has_pallet_product_in_cart) {
      if ($has_pallet_product_in_cart) {
        return $method->label !== Config::BOX_SHIPPING_CLASS_NAME;
      } else {
        return $method->label !== Config::PALLET_SHIPPING_CLASS_NAME;
      }
    }, ARRAY_FILTER_USE_BOTH);

    WC()->shipping()->packages[0]['rates'] = $available_methods;
  }
}