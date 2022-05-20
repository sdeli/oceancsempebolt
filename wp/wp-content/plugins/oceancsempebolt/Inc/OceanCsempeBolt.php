<?php
namespace Inc;

class OceanCsempeBolt
{
	static function init() {
    $js_file_path = OCEANCSEMPEBOLT_PATH . 'Inc/js.php';
    add_action('wp_enqueue_scripts', function() use ($js_file_path) {
      require_once($js_file_path);
    }, 10000);

    if (wp_get_environment_type() === Config::ENVIRONMENT_TYPE_PROD) {
      Utils::add_gtm_to_head();
      Utils::add_gtm_to_body();
    }

    add_action( 'init', function() { Utils::add_design_post_type(); });
    add_action( "wp",  Utils::disable_wc_terms_toggle() );
    
    add_action( 'woocommerce_email_before_order_table', function($order, $sent_to_admin) { 
      Utils::email_instructions($order, $sent_to_admin); 
    }, 9, 3 ); 

    add_action('woocommerce_before_main_content', function () { \Inc\ProductCategoryPage::echoCustomElements(); });

    AllPages::displayCustomElements();
    CartPage::init();
    ProductPage::init();
	}
}