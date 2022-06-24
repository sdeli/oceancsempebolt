<?php
/**
 * @package oceancsempebolt
 * @version 5.9.3
 */
/*
Plugin Name: oceancsempebolt
*/
namespace Inc;
use Shared\Utils;
use Shared\Config;

define( 'OCEANCSEMPEBOLT_PATH', plugin_dir_path( __FILE__ ) );

require_once(realpath(OCEANCSEMPEBOLT_PATH . '../../vendor/autoload.php'));
  
if (!defined('WP_ENVIRONMENT_TYPE')) {
  define('WP_ENVIRONMENT_TYPE', Config::ENVIRONMENT_TYPE_PROD);
}

require_once(OCEANCSEMPEBOLT_PATH . '/front/enqueue.php');
add_styles_to_footer();
add_action( 'wp_enqueue_scripts', 'ocs_enqueue' ); 

add_action( 'init', function() { Utils::add_design_post_type(); });

add_filter( 'body_class', function( $classes ) {
  return array_merge( $classes, array( 'ocs' ) );
} );

add_action( 'woocommerce_email_before_order_table', function($order, $sent_to_admin) { 
  Utils::email_instructions($order, $sent_to_admin); 
}, 9, 3 ); 


ProductCategoryPage::init();
AllPages::init();
ProductPage::init();
Purchase::init();