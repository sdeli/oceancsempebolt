<?php
namespace Inc;
use Shared\Utils;
use Shared\Config;

class Purchase 
{
  static function init() {
    add_action( 'woocommerce_cart_totals_before_shipping', function() { self::removeInvalidShippingMethods(); });
    add_action( 'woocommerce_review_order_before_shipping', function() { self::removeInvalidShippingMethods(); });
    add_action( 'woocommerce_review_order_before_payment', function() { self::echo_payment_methods_heading(); });

    add_action( 'woocommerce_available_payment_gateways', function( $gateways ) {  
      if (!is_admin()) {
        return self::removeInvalidPaymentMethods($gateways);
      }
    } );

    add_filter('woocommerce_add_message', function ($message) {
      if (is_order_received_page()) {
        echo self::get_payment_and_shipment_notes($message);
      }
    });
  }

  static private function removeInvalidShippingMethods() {
    $available_methods = WC()->shipping()->packages[0]['rates'];
    $has_pallet_product_in_cart = self::has_palet_product_in_cart();
    if ($has_pallet_product_in_cart) {
      unset($available_methods[Config::BOX_SHIPPING_WOO_ID]);
    } else {
      unset($available_methods[Config::PALLET_SHIPPING_WOO_ID]);
    }
    
    $productsInCart = WC()->shipping()->packages[0]['contents'];
    $has_bomb_cosmetics_soap_in_cart = false;
    foreach ( $productsInCart as $product ) {
      $is_bomb_cosmetics_product = has_term( 'bomb-cosmetics', 'product_cat', $product['data']->get_id());
      if ($is_bomb_cosmetics_product) {
        $has_bomb_cosmetics_soap_in_cart = true;
        break;
      }
    }
    
    if ($has_bomb_cosmetics_soap_in_cart) {
      // There is a supplier called 'Bomb Cosmetics' which ships by post to us and it is expensive if customer
      // wants to pick it up in the shop, it is better if bomb directly ships to the customer 
      $cart_total_too_low = floatval(WC()->cart->get_cart_contents_total()) < 15000;
      if ($cart_total_too_low) {
        unset($available_methods[Config::PERSONAL_PICKUP_WOO_ID]);
      }
    }

    WC()->shipping()->packages[0]['rates'] = $available_methods;
  }

  static private function has_palet_product_in_cart() {
    $productsInCart = WC()->shipping()->packages[0]['contents'];
    $has_pallet_product_in_cart = false;

    foreach ( $productsInCart as $product ) {
      $shipping_class_id = $product['data']->get_shipping_class_id();
      if ($shipping_class_id === Config::PALLET_SHIPPING_CLASS_ID) {
        $has_pallet_product_in_cart = true;
        break;
      }
    }

    return $has_pallet_product_in_cart;
  }

  static private function removeInvalidPaymentMethods( $gateways ) {
    foreach( WC()->cart->get_cart() as $cart_item ){
      $product_id = $cart_item['product_id'];
      if (Utils::is_tile($product_id)) { 
        unset( $gateways['cod'] );
        unset( $gateways['WC_Gateway_SimplePay_WPS'] );
        break;
      }
    }

    return $gateways;
  }

  static private function get_payment_and_shipment_notes() {
    $notes = "<h4>K??sz??nj??k megrendel??sed, hamarosan kapni fogsz t??l??nk egy meger??s??t?? emailt a megrendel??sedr??l, melyet k??r??nk olvass el.</h4>";
    $order_id = basename($_SERVER['SCRIPT_URI']);
    $order = wc_get_order( $order_id );
  
    $payment_method = $order->get_payment_method();
    $shipping_method = $order->get_shipping_method();
  
    $pays_by_bank_transfer = $payment_method === Config::BANK_TRANSFER_LABEL;
    $shipping_in_box = $shipping_method === Config::BOX_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_in_box) {
      $box_shipping_notes = get_box_shipping_notes($order);
      $notes .= "<h4>Tov??bbi instrukci??k:</h4>{$box_shipping_notes}";
      return $notes;
    }
    
    $shipping_by_pallett = $shipping_method === Config::PALLET_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_by_pallett) {
      $pallet_shipping_notes = get_pallet_shipping_notes($order);
      $notes .= "<h4>Tov??bbi instrukci??k:</h4>{$pallet_shipping_notes}";
      return $notes;
    }
  
    return $notes;
  }

  static private function echo_payment_methods_heading() {
    $gateways =WC()->payment_gateways->get_available_payment_gateways();
    $only_one_gateway = count($gateways) === 1;
    if ($only_one_gateway ) {
      echo '<h4>Fizet??si M??d:</h4>';
    } else {
      echo '<h4>Fizet??si M??dok</h4>';
    }
  }
}