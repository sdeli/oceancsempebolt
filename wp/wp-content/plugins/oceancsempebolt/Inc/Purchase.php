<?php
namespace Inc;

class Purchase 
{
  static function init() {
    add_action( 'woocommerce_cart_totals_before_shipping', function() {  
      self::removeInvalidShippingMethods();
    } );

    add_action( 'woocommerce_available_payment_gateways', function( $gateways ) {  
      return self::removeInvalidPaymentMethods($gateways);
    } );

    add_filter('woocommerce_add_message', function ($message) {
      if (is_order_received_page()) {
        echo self::get_payment_and_shipment_notes($message);
      }
    });
  }

  static private function removeInvalidShippingMethods() {
    $has_pallet_product_in_cart = self::has_palet_product_in_cart();

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

  static private function removeInvalidPaymentMethods( $gateways ) {
    $has_pallet_product_in_cart = self::has_palet_product_in_cart( $gateways );
    if ( $has_pallet_product_in_cart ) {
      unset( $gateways['cod'] );
    };

    return $gateways;
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

  static private function get_payment_and_shipment_notes() {
    $notes = "<h4>Köszönjük megrendelésed, hamarosan kapni fogsz tőlünk egy megerősítő emailt a megrendelésedről, melyet kérünk olvass el.</h4>";
    $order_id = basename($_SERVER['SCRIPT_URI']);
    $order = wc_get_order( $order_id );
  
    $payment_method = $order->get_payment_method();
    $shipping_method = $order->get_shipping_method();
  
    $pays_by_bank_transfer = $payment_method === Config::BANK_TRANSFER_LABEL;
    $shipping_in_box = $shipping_method === Config::BOX_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_in_box) {
      $box_shipping_notes = get_box_shipping_notes($order);
      $notes .= "<h4>További instrukciók:</h4>{$box_shipping_notes}";
      return $notes;
    }
    
    $shipping_by_pallett = $shipping_method === Config::PALLET_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_by_pallett) {
      $pallet_shipping_notes = get_pallet_shipping_notes($order);
      $notes .= "<h4>További instrukciók:</h4>{$pallet_shipping_notes}";
      return $notes;
    }
  
    return $notes;
  }
}