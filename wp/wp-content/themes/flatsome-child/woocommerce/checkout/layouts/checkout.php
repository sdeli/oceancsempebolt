<?php
// Default checkout layout
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php
	wc_get_template( 'checkout/header.php' );
  
	echo '<div class="cart-container container page-wrapper page-checkout">';
  if (is_order_received_page()) {
    echo get_payment_and_shipment_notes();
    echo '<br><br>';
  }
  
	wc_print_notices();
	the_content();
	echo '</div>';
	?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
