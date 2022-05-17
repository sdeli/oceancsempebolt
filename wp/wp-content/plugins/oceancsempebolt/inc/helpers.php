<?php

$C = 'constant';

function ocs_add_gtm_to_head() {
  $get_gtm_script_tag = function() {
    ?>
      <!-- Google Tag Manager -->
      <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MHFCRTX');</script> -->
      <!-- End Google Tag Manager -->
    <?php
  };
  add_action('wp_head', $get_gtm_script_tag, -10000);
}

function ocs_add_gtm_to_body() {
  $get_gtm_script_tag = function() {
    ?>
      <!-- Google Tag Manager (noscript) -->
      <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHFCRTX"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
        <!-- End Google Tag Manager (noscript) -->
        <?php
  };
  
  add_action('wp_body_open', $get_gtm_script_tag, -10000);
}

function get_pallet_shipping_notes($order) {
  global $C;
  $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];

  return <<<EOD
Kérjük várd meg kollégánk jelentkezését, aki tájékoztatni fog a szállítás dijáról, valamint időtartamról. Addig is hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong><br>
Miután tájékoztatotást kaptál a szállítási díjról es időről, már átutalhatod nekünk a végösszeget, erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.
EOD;
}

function get_box_shipping_notes($order) {
  global $C;
  $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];

  return <<<EOD
  Ahoz hogy elindíthassuk megrendelésed folyamatát, kérjük utald el a végösszeget (<strong>{$order->calculate_totals()}Ft</strong>) erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
  Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.<br>
  Ha bármi kérdésed merülne fel, hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong>
EOD;
}