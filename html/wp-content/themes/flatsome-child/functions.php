<?php

require_once(get_theme_file_path('/inc/widgets.php'));
require_once(get_theme_file_path('/inc/utils.php'));

function disable_wc_terms_toggle() { 
  remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
}

add_action( "wp", "disable_wc_terms_toggle" );

add_action('wp_footer','echoFakeSliderInteractionJs');

add_action( 'rest_api_init', 'create_api_designs_thumbnails_field' );