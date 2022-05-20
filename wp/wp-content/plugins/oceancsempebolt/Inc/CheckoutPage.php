<?php
namespace Inc;

class CheckoutPage 
{
  static function init() {
    add_action( 'woocommerce_review_order_before_payment', function() {  
      self::removeInvalidPaymentMethods();
    } );

    add_filter('woocommerce_add_message', function ($message) {
      dump_r('adding message');
      if (is_order_received_page()) {
        echo get_payment_and_shipment_notes($message);
      }
    });
  }

  static private function removeInvalidPaymentMethods() {
    // echo 'checkout';
  }

  function get_payment_and_shipment_notes() {
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