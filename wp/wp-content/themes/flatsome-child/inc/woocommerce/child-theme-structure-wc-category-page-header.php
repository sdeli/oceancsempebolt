<?php

if ( ! function_exists( 'flatsome_category_title_no_breadcrumb' ) ) {
	/**
	 * Add Category Title if set
	 */
	function flatsome_category_title_no_breadcrumb() {
		if ( ! get_theme_mod( 'category_show_title', 0 ) ) {
			return;
		} ?>
		<h1 class="shop-page-title is-xlarge"><?php echo ucwords(woocommerce_page_title(false)); ?></h1>
		<?php
	}
}
add_action( 'flatsome_category_title_no_breadcrumb', 'flatsome_category_title_no_breadcrumb', 2 );
add_action( 'flatsome_category_sort_order', 'woocommerce_catalog_ordering', 30 );
