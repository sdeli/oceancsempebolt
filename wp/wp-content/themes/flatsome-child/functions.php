<?php

require_once(get_theme_file_path('/inc/widgets.php'));

function disable_wc_terms_toggle() { 
  remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
}

add_action( "wp", "disable_wc_terms_toggle" );