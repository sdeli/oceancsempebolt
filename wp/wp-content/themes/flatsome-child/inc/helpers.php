<?php

/**
 * @return array<string>
 */

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

function get_catalog_for_category($category) {
  $slug = $category->slug;
  $hasCatalogUrl = isset(PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug]);
  if ($hasCatalogUrl) {
    return PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug];
  }
  
  $categs_term_id = $category->term_id;
  $parent_category_ids = get_ancestors($categs_term_id, 'product_cat');
  foreach(PDF_CATALOGS_BY_PRODUCT_CATEGORIES as $categ_slug => $catalog_data) { 
    $parent_categ_with_catalog_found = in_array($catalog_data['term_id'], $parent_category_ids);
    if ($parent_categ_with_catalog_found) return $catalog_data;
  }

  return false;
}