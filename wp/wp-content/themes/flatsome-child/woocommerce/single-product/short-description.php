<?php
/**
 * Single product short description
 *
 * @author  Automattic
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// add_filters('woocommerce_before_single_product', 'printPrice');

// function printPrice() {
//   echo 'printPrice';
// }

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

$randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)];

?>
<div class="call-us"><i class="map-pin-fill"></i>
    <p style="margin-bottom: 5px;">
      <strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>: 
        <i class="icon-phone" style="color: black;"></i> 
        <a class="<?= OCEAN_PHONE_CALL_LINK_CLASS ?>" href="tel:<?= $randTelNumber[1] ?>" style="cursor: pointer; color: #4e657b"><?= $randTelNumber[0] ?> - <?= $randTelNumber[2] ?></a><br>
      <a 
        href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975" 
        style="cursor: pointer; color: #4e657b" 
        target="_blank">
        Térkép a bolthoz
        <i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>
      </a>
      <p style="margin-bottom: 0px;">A feltüntetett árak tájékoztató jellegűek, nem minősülnek konkrét árajánlattételnek.</p>
    </p>
  </div>
<div class="product-short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>

<!-- Kedves vásárló áraink az állandó árvátozások miatt módosulhatnak, ezért előfordulhat, hogy megrendelés után értékesítőnk fehlívja önt és megadja önnek a pontos aznapi árat. -->