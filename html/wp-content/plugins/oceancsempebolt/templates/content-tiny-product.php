<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || false === wc_get_loop_product_visibility( $product->get_id() ) || ! $product->is_visible() ) {
	return;
}

// Check stock status.
$out_of_stock = ! $product->is_in_stock();

// Extra post classes.
$classes   = array();
$classes[] = 'product-small';
$classes[] = 'col';
$classes[] = 'has-hover';
$classes[] = 'family-brand-product';

if ( $out_of_stock ) $classes[] = 'out-of-stock';

?><div <?php wc_product_class( $classes, $product ); ?>>
	<div class="col-inner">
	
	<div class="product-small box">
		<div class="box-image">
			<div class="<?php echo flatsome_product_box_image_class(); ?>">
				<a href="<?php echo get_the_permalink(); ?>" aria-label="<?php echo esc_attr( $product->get_title() ); ?>">
					<?php
						/**
						 *
						 * @hooked woocommerce_get_alt_product_thumbnail - 11
						 * @hooked woocommerce_template_loop_product_thumbnail - 10
						 */
						do_action( 'flatsome_woocommerce_shop_loop_images' );
					?>
				</a>
			</div>
			<?php if ( $out_of_stock ) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php } ?>
		</div>

		<div class="box-text <?php echo flatsome_product_box_text_class(); ?>" style="padding-top: unset; padding-bottom: 5px;font-weight: bold;">
			<?php
				do_action( 'woocommerce_before_shop_loop_item_title' );

				echo '<div class="title-wrapper product-title-ellipsis" style="text-align: center;">' . $product->get_name() . '</div>';
			?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div><?php /* empty PHP to avoid whitespace */ ?>