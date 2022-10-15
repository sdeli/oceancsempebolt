<?php
namespace Inc;
use Shared\Utils;
use Shared\Config;

class Purchase 
{
  static function init() {
    add_action( 'woocommerce_cart_totals_before_shipping', function() { self::removeInvalidShippingMethods(); });
    add_action( 'woocommerce_review_order_before_shipping', function() { self::removeInvalidShippingMethods(); });
    add_action( 'woocommerce_review_order_before_payment', function() { self::echo_payment_methods_heading(); }, 10);

    add_action( 'woocommerce_available_payment_gateways', function( $gateways ) {  
      if (!is_admin()) {
        return self::removeInvalidPaymentMethods($gateways);
      }
    } );

    add_filter('woocommerce_add_message', function ($message) {
      if (is_order_received_page()) {
        echo self::get_payment_and_shipment_notes($message);
      }
    });

    add_filter('woocommerce_cart_totals_after_order_total', function ($message) {
      $hadForecast = self::echo_shipping_costs_forecast();
      if ($hadForecast) {
        add_filter('woocommerce_proceed_to_checkout', function() {
          self::echoShippingCostForecatExplanation();
        });
      }
      
    }, 10);
    
    add_filter('woocommerce_review_order_after_order_total', function ($message) {
      $hadForecast = self::echo_shipping_costs_forecast();
      if ($hadForecast) {
        add_filter('woocommerce_review_order_before_payment', function() {
          ?>
        <?php 
          self::echoShippingCostForecatExplanation();
        }, 9);
      }
    });
  }
  static private function echo_shipping_costs_forecast() {
    // Config::PALLET_SHIPPING_WOO_ID
    $chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' )[0];
    $chosen_shipping_method = is_array($chosen_shipping_methods) ? $chosen_shipping_methods[0] : $chosen_shipping_methods;
    $is_palett_shipping_choosen = Config::PALLET_SHIPPING_WOO_ID === $chosen_shipping_method;
    if (!$is_palett_shipping_choosen) return false;
    ?>
      <tr>
        <th style="width: 60%;">Várható szállítási költség:</th>
        <td><?php self::echo_tile_shipping_cost_estimate() ?></td>
      </tr>
    <?php 

    return true;
  }

  /**
   * Undocumented function
   *
   * @return int|float
   */
  static private function echo_tile_shipping_cost_estimate() {
    $get_all_tiles_in_cart = function () {
      $all_tiles_sq_foot_in_cart = 0;

      foreach( WC()->cart->get_cart() as $cart_item ){
        $product_custom_fields = get_post_custom($cart_item['product_id']);
        $tile_amount_in_box = $product_custom_fields[Config::TILE_SQ_FOOT_IN_BOX_META_KEY];
        $is_price_by_square_foot = !is_null($tile_amount_in_box[0]) && !empty($tile_amount_in_box[0]);
        if ($is_price_by_square_foot) {
          $tile_amount_in_box = $cart_item['quantity'] * floatval($tile_amount_in_box[0]);
          $all_tiles_sq_foot_in_cart += $tile_amount_in_box;
        } else {
          continue;
        }
      }

      return $all_tiles_sq_foot_in_cart;
    };

    $get_trace_palett_price = function($remainding_square_foot) {
      foreach( Config::TILE_SHIPPING_COSTS as $palett_type ){
        $max_sq_foot_on_palett_type = $palett_type['max_weigth'] / Config::ONE_SQ_FOOT_TILE_WEIGTH_KG;
        if ($max_sq_foot_on_palett_type > $remainding_square_foot) {
          return $palett_type['price'];
        }
      }

      return Config::TILE_SHIPPING_COSTS['full_palett']['price'];
    };

    $echo_formated_cost = function(string $shipping_costs_estimate, $all_tiles_sq_foot_in_cart) {
      ?>
      <strong style="color: black"><?= $shipping_costs_estimate ?>Ft</strong><span> (<?= $all_tiles_sq_foot_in_cart ?>m2 csempe)</span>
      <?php 
    };

    $full_paletts_capacity = 40;
    $all_tiles_sq_foot_in_cart = $get_all_tiles_in_cart();

    $has_no_trace_paletts = $all_tiles_sq_foot_in_cart >= 40 && $all_tiles_sq_foot_in_cart % $full_paletts_capacity === 0;
    if ($has_no_trace_paletts) {
      $full_paletts_count = $all_tiles_sq_foot_in_cart / 40;
      $shipping_costs_estimate = $full_paletts_count * Config::TILE_SHIPPING_COSTS['full_palett']['price'];
      $echo_formated_cost($shipping_costs_estimate, $all_tiles_sq_foot_in_cart);
      return;
    }

    $has_one_trace_palett = $all_tiles_sq_foot_in_cart < $full_paletts_capacity;
    if ($has_one_trace_palett) {
      $trace_palett_price = $get_trace_palett_price($all_tiles_sq_foot_in_cart, $all_tiles_sq_foot_in_cart);
      $echo_formated_cost($trace_palett_price, $all_tiles_sq_foot_in_cart);
      return;
    }

    $has_more_paletts_and_one_trace_palett = $all_tiles_sq_foot_in_cart > $full_paletts_capacity && $all_tiles_sq_foot_in_cart % $full_paletts_capacity > 0;
    if ($has_more_paletts_and_one_trace_palett) {
      $full_paletts_count = intval($all_tiles_sq_foot_in_cart / 40);
      $remainding_square_foot = $all_tiles_sq_foot_in_cart % 40;
      $shipping_costs_estimate = $full_paletts_count * Config::TILE_SHIPPING_COSTS['full_palett']['price'];
      $shipping_costs_estimate += $get_trace_palett_price($remainding_square_foot);
      $echo_formated_cost($shipping_costs_estimate, $all_tiles_sq_foot_in_cart);
    }
  }



  static private function echoShippingCostForecatExplanation() {
    $randTelNumber = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)];

    ?>
    <p style="margin-bottom: 5px; font-size: 15px; margin-top: -15px;">A fenti <strong>szállítási költség</strong> a benzin ár alakulasa végett <strong>lehet több</strong> vagy <strong>akár kevesebb</strong> a feltüntetettnél.</p>
    <p style="margin-bottom: 5px; font-size: 15px;">Rendelés esetén <strong>kollégánk jelentkezni fog önnél, ennek egyeztetése céljából.</strong></p>
    <p style="margin-bottom: 10px; font-size: 15px;">Pontosításért hívjon minket:
      <a class="<?= Config::OCEAN_PHONE_CALL_LINK_CLASS ?>" href="tel:<?=  $randTelNumber[1] ?> '" style="cursor: pointer; color: #4e657b"><?=  $randTelNumber[0] ?> - <?=  $randTelNumber[2] ?></a>
    </p>
  <?php 
  }
  static private function removeInvalidShippingMethods() {
    $available_methods = WC()->shipping()->packages[0]['rates'];
    $has_pallet_product_in_cart = self::has_palet_product_in_cart();
    if ($has_pallet_product_in_cart) {
      unset($available_methods[Config::BOX_SHIPPING_WOO_ID]);
    } else {
      unset($available_methods[Config::PALLET_SHIPPING_WOO_ID]);
    }
    
    $productsInCart = WC()->shipping()->packages[0]['contents'];
    $has_bomb_cosmetics_soap_in_cart = false;
    foreach ( $productsInCart as $product ) {
      $is_bomb_cosmetics_product = has_term( 'bomb-cosmetics', 'product_cat', $product['data']->get_id());
      if ($is_bomb_cosmetics_product) {
        $has_bomb_cosmetics_soap_in_cart = true;
        break;
      }
    }
    
    if ($has_bomb_cosmetics_soap_in_cart) {
      // There is a supplier called 'Bomb Cosmetics' which ships by post to us and it is expensive if customer
      // wants to pick it up in the shop, it is better if bomb directly ships to the customer 
      $cart_total_too_low = floatval(WC()->cart->get_cart_contents_total()) < 15000;
      if ($cart_total_too_low) {
        unset($available_methods[Config::PERSONAL_PICKUP_WOO_ID]);
      }
    }

    WC()->shipping()->packages[0]['rates'] = $available_methods;
  }

  static private function has_palet_product_in_cart() {
    $productsInCart = WC()->shipping()->packages[0]['contents'];
    $has_pallet_product_in_cart = false;

    foreach ( $productsInCart as $product ) {
      $shipping_class_id = $product['data']->get_shipping_class_id();
      if ($shipping_class_id === Config::PALLET_SHIPPING_CLASS_ID) {
        $has_pallet_product_in_cart = true;
        break;
      }
    }

    return $has_pallet_product_in_cart;
  }

  static private function removeInvalidPaymentMethods( $gateways ) {
    foreach( WC()->cart->get_cart() as $cart_item ){
      $product_id = $cart_item['product_id'];
      if (Utils::is_tile($product_id)) { 
        unset( $gateways['cod'] );
        unset( $gateways['WC_Gateway_SimplePay_WPS'] );
        break;
      }
    }

    return $gateways;
  }

  static private function get_payment_and_shipment_notes() {
    $notes = "<h4>Köszönjük megrendelésed, hamarosan kapni fogsz tőlünk egy megerősítő emailt a megrendelésedről, melyet kérünk olvass el.</h4>";
    $order_id = basename($_SERVER['SCRIPT_URI']);
    $order = wc_get_order( $order_id );
  
    $payment_method = $order->get_payment_method();
    $shipping_method = $order->get_shipping_method();
  
    $pays_by_bank_transfer = $payment_method === Config::BANK_TRANSFER_LABEL;
    $shipping_in_box = $shipping_method === Config::BOX_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_in_box) {
      $box_shipping_notes = get_box_shipping_notes($order);
      $notes .= "<h4>További instrukciók:</h4>{$box_shipping_notes}";
      return $notes;
    }
    
    $shipping_by_pallett = $shipping_method === Config::PALLET_SHIPPING_CLASS_NAME;
    if ($pays_by_bank_transfer && $shipping_by_pallett) {
      $pallet_shipping_notes = get_pallet_shipping_notes($order);
      $notes .= "<h4>További instrukciók:</h4>{$pallet_shipping_notes}";
      return $notes;
    }
  
    return $notes;
  }

  static private function echo_payment_methods_heading() {
    $gateways =WC()->payment_gateways->get_available_payment_gateways();
    $only_one_gateway = count($gateways) === 1;
    if ($only_one_gateway ) {
      echo '<h4>Fizetési Mód:</h4>';
    } else {
      echo '<h4>Fizetési Módok</h4>';
    }
  }
}