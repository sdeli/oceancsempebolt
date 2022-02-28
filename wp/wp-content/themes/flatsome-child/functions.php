<?php
require_once(get_theme_file_path('/inc/constants.php'));
require_once(get_theme_file_path('/inc/classes.php'));
require_once(get_theme_file_path('/inc/elements.php'));
require_once(get_theme_file_path('/inc/helpers.php'));
require_once(get_theme_file_path('/inc/woocommerce/child-theme-structure-wc-category-page-header.php'));


function add_design_post_type() {
  $supports = array(
  'title', // post title
  'author', // post author
  'thumbnail', // featured images
  'custom-fields', // custom fields
  'revisions', // post revisions
  );

  $labels = array(
  'name' => _x('designs', 'plural'),
  'singular_name' => _x('design', 'singular'),
  'menu_name' => _x('designs', 'admin menu'),
  'name_admin_bar' => _x('designs', 'admin bar'),
  'add_new' => _x('Add design', 'add design'),
  'add_new_item' => __('Add New Design'),
  'new_item' => __('New design'),
  'edit_item' => __('Edit design'),
  'view_item' => __('View design'),
  'all_items' => __('All design'),
  'search_items' => __('Search designs'),
  'not_found' => __('No designs found.'),
  );

  $args = array(
  'supports' => $supports,
  'labels' => $labels,
  'public' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'designs'),
  'has_archive' => true,
  'hierarchical' => false,
  'taxonomies' => array('design_category'), 
  );

  register_post_type('designs', $args);
}

add_action('init', 'add_design_post_type');

function flatsome_email_instructions( $order, $sent_to_admin ) {
  if ( ! $sent_to_admin && BANK_TRANSFER_LABEL === $order->get_payment_method() && $order->has_status( ON_HOLD_ORDER_STATUS ) ) {
    if ( $order->get_shipping_method() === PALLET_SHIPPING_CLASS_NAME) {
      echo get_pallet_shipping_notes($order);
    }

    if ( $order->get_shipping_method() === BOX_SHIPPING_CLASS_NAME) {
      echo get_box_shipping_notes($order);
    }
  }
}

add_action( 'woocommerce_email_before_order_table', 'flatsome_email_instructions', 9, 3 );

function action_woocommerce_before_single_product( $wc_print_notices, $int ) { 
  // make action magic happen here... 
  // echo 'sannya1212';
}; 
       
// // add the action 
// add_action( 'woocommerce_before_single_product', 'action_woocommerce_before_single_product', 10, 2 ); 

function disable_wc_terms_toggle() { remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); } add_action( "wp", "disable_wc_terms_toggle" );