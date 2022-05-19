<?php

/**
 * @return array<string>
 */

function get_payment_and_shipment_notes() {
  $notes = "<h4>Köszönjük megrendelésed, hamarosan kapni fogsz tőlünk egy megerősítő emailt a megrendelésedről, melyet kérünk olvass el.</h4>";
  $order_id = basename($_SERVER['SCRIPT_URI']);
  $order = wc_get_order( $order_id );

  $payment_method = $order->get_payment_method();
  $shipping_method = $order->get_shipping_method();

  $pays_by_bank_transfer = $payment_method === BANK_TRANSFER_LABEL;
  $shipping_in_box = $shipping_method === BOX_SHIPPING_CLASS_NAME;
  if ($pays_by_bank_transfer && $shipping_in_box) {
    $box_shipping_notes = get_box_shipping_notes($order);
    $notes .= "<h4>További instrukciók:</h4>{$box_shipping_notes}";
    return $notes;
  }
  
  $shipping_by_pallett = $shipping_method === PALLET_SHIPPING_CLASS_NAME;
  if ($pays_by_bank_transfer && $shipping_by_pallett) {
    $pallet_shipping_notes = get_pallet_shipping_notes($order);
    $notes .= "<h4>További instrukciók:</h4>{$pallet_shipping_notes}";
    return $notes;
  }

  return $notes;
}