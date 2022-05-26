<?php
/**
 * @package oceancsempebolt
 * @version 5.9.3
 */
/*
Plugin Name: oceancsempebolt
*/
namespace Inc;

define( 'OCS_PLUGIN_NAME', 'oceancsempebolt' );
define( 'OCEANCSEMPEBOLT_PATH', plugin_dir_path( __FILE__ ) );

require_once(OCEANCSEMPEBOLT_PATH . 'vendor/autoload.php');
// dump_r(plugin_dir_path( __FILE__ ));

// This constant needs to be set by hand, when deploying.
define( 'WP_ENVIRONMENT_TYPE', Config::ENVIRONMENT_TYPE_LOCAL);

define( 'OCS_IS_LOCAL_ENV', wp_get_environment_type() === Config::ENVIRONMENT_TYPE_LOCAL);
define( 'OCS_IS_PROD_ENV', wp_get_environment_type() === Config::ENVIRONMENT_TYPE_PROD);

require_once(OCEANCSEMPEBOLT_PATH . '/front/enqueue.php');

add_action( 'wp_enqueue_scripts', 'ocs_enqueue' ); 

if (OCS_IS_PROD_ENV) {
  Utils::add_gtm_to_head();
  Utils::add_gtm_to_body();
}

add_action( 'init', function() { Utils::add_design_post_type(); });

add_action( 'woocommerce_email_before_order_table', function($order, $sent_to_admin) { 
  Utils::email_instructions($order, $sent_to_admin); 
}, 9, 3 ); 

add_action('woocommerce_before_main_content', function () { \Inc\ProductCategoryPage::echoCustomElements(); });

AllPages::displayCustomElements();
ProductPage::init();
Purchase::init();