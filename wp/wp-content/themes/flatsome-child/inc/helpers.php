<?php

/**
 * @return array<string>
 */
// function get_attributes_by_categories(): array {
//   global $wpdb;
//   $result = $wpdb->get_results ("SELECT * FROM  view_colors_by_categories");
//   $colors_by_categories = [];
//   $i = 0;
//   foreach ($result as $row) {
//     echo $i.' foreach2 ======<br>';
//     var_dump($row);
//     $currentCategorySlug = $row->category_slug;
//     $id = $row->color_id;
//     $slug = $row->color_slug;
//     $displayName = $row->category_slug;
//     echo '<br>'.$currentCategorySlug.' prev2 ======<br>';
//     echo '<br>id '.$colors_by_categories[$currentCategorySlug][$i - 1]->$id.'<br>';
//     echo '<br>name '.$colors_by_categories[$currentCategorySlug][$i - 1]->$displayName.'<br>';
//     echo '<br>slug '.$colors_by_categories[$currentCategorySlug][$i - 1]->$slug.'<br>';
//     echo '<br>1 =======<br>';
//     var_dump($colors_by_categories);
//     $colorTemplateValue = new ColorTemplateValues($slug, $id, $displayName, $i);
//     if ($colors_by_categories[$currentCategorySlug]) {
//       $colors_by_categories[$currentCategorySlug][] = $colorTemplateValue;
//     } else {
//       $colors_by_categories[$currentCategorySlug] = [$colorTemplateValue];
//     }
//     echo '<br>2 =======<br>';
//     var_dump($colors_by_categories);
//     echo '<br>'.$currentCategorySlug.' now 2 ======<br>';
//     echo '<br>id '.$colors_by_categories[$currentCategorySlug][$i]->$id.'<br>';
//     echo '<br>name '.$colors_by_categories[$currentCategorySlug][$i]->$displayName.'<br>';
//     echo '<br>slug '.$colors_by_categories[$currentCategorySlug][$i]->$slug.'<br>';
//     $i++;
//   }
//   return $colors_by_categories;
// }

$C = 'constant';

function get_attributes_by_product_categories(): array {
  global $wpdb;
  $result = $wpdb->get_results ("SELECT * FROM  view_attributes_by_product_categories;");
  $attributes_by_categories = [];

  foreach ($result as $row) {
    $currentCategorySlug = $row->category_slug;
    $displayName = $row->attribute_value_name;
    $lookOnFrontEnd = $row->attribute_slug === 'pa_szin' ? LOOK_COLOR : LOOK_TAG;
    $filterType = preg_replace('/pa_/i', '', $row->attribute_slug);
    $attributeTemplateValues = [
      'id' => $row->attribute_value_id, 
      'displayName' => $displayName, 
      'slug' => $row->attribute_value_slug, 
      'form' => $lookOnFrontEnd,
      'type' => $filterType
    ];
    
    if ($attributes_by_categories[$currentCategorySlug]) {
      array_push($attributes_by_categories[$currentCategorySlug],$attributeTemplateValues);
    } else {
      $attributes_by_categories[$currentCategorySlug] = [$attributeTemplateValues];
    }
  }
  
  return $attributes_by_categories;
}

function get_pallet_shipping_notes($order) {
  global $C;
  $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];

  return <<<EOD
Kérjük várd meg kollégánk jelentkezését, aki tájékoztatni fog a szállítás dijáról, valamint időtartamról. Addig is hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong><br>
Miután tájékoztatotást kaptál a szállítási díjról es időről, már átutalhatod nekünk a végösszeget, erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.
EOD;
}

function get_box_shipping_notes($order) {
  global $C;
  $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];

  return <<<EOD
  Ahoz hogy elindíthassuk megrendelésed folyamatát, kérjük utald el a végösszeget (<strong>{$order->calculate_totals()}Ft</strong>) erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
  Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.<br>
  Ha bármi kérdésed merülne fel, hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong>
EOD;
}

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