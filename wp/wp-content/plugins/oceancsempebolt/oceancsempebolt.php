<?php
/**
 * @package oceancsempebolt
 * @version 5.9.3
 */
/*
Plugin Name: oceancsempebolt
*/

define( 'OCS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once(OCS_PLUGIN_DIR . '/inc/constants.php');

if (wp_get_environment_type() === ENVIRONMENT_TYPE_LOCAL) {
  require_once(get_theme_file_path(OCS_PLUGIN_DIR . '/vendor/autoload.php'));
}

require_once(OCS_PLUGIN_DIR . '/inc/helpers.php');

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

function ocs_email_instructions( $order, $sent_to_admin ) {
  if ( ! $sent_to_admin && BANK_TRANSFER_LABEL === $order->get_payment_method() && $order->has_status( ON_HOLD_ORDER_STATUS ) ) {
    if ( $order->get_shipping_method() === PALLET_SHIPPING_CLASS_NAME) {
      echo get_pallet_shipping_notes($order);
    }

    if ( $order->get_shipping_method() === BOX_SHIPPING_CLASS_NAME) {
      echo get_box_shipping_notes($order);
    }
  }
}

add_action( 'woocommerce_email_before_order_table', 'ocs_email_instructions', 9, 3 ); 

function ocs_disable_wc_terms_toggle() { 
  remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
}

add_action( "wp", "ocs_disable_wc_terms_toggle" );

if (wp_get_environment_type() === ENVIRONMENT_TYPE_PROD) {
  ocs_add_gtm_to_head();
  ocs_add_gtm_to_body();
}

