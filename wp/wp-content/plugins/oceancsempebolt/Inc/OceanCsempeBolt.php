<?php
namespace Inc;
use Inc\Config;

class OceanCsempeBolt
{
  const C = 'constant';

	static function init() {
    $js_file_path = OCEANCSEMPEBOLT_PATH . 'Inc/js.php';
    add_action('wp_enqueue_scripts', function() use ($js_file_path) {
      require_once($js_file_path);
    }, 10000);

    if (wp_get_environment_type() === Config::ENVIRONMENT_TYPE_PROD) {
      self::ocs_add_gtm_to_head();
      self::ocs_add_gtm_to_body();
    }

    add_action( 'init', array( __CLASS__, 'add_design_post_type' ) );
    add_action( 'flatsome_footer', array( __CLASS__, 'add_design_post_type' ) );
    add_action( 'woocommerce_email_before_order_table', [ __CLASS__, 'ocs_email_instructions' ], 9, 3 ); 
    add_action( "wp", [ __CLASS__, "ocs_disable_wc_terms_toggle" ] );
    add_action('woocommerce_before_main_content', function () { \Inc\ProductCategoryPage::echoCustomElements(); });

    \Inc\AllPages::displayCustomElements();
    \Inc\CartPage::init();
	}

  static function add_design_post_type() {
    $supports = array(
    'title', // post title
    'author', // post author
    'thumbnail', // featured images
    'custom-fields', // custom fields
    'revisions', // post revisions
    );
  
    $labels = array(
    'name' => _x('designs', 'plural'),
    'singular_name' => _x('design', 'singular'),
    'menu_name' => _x('designs', 'admin menu'),
    'name_admin_bar' => _x('designs', 'admin bar'),
    'add_new' => _x('Add design', 'add design'),
    'add_new_item' => __('Add New Design'),
    'new_item' => __('New design'),
    'edit_item' => __('Edit design'),
    'view_item' => __('View design'),
    'all_items' => __('All design'),
    'search_items' => __('Search designs'),
    'not_found' => __('No designs found.'),
    );
  
    $args = array(
    'supports' => $supports,
    'labels' => $labels,
    'public' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'designs'),
    'has_archive' => true,
    'hierarchical' => false,
    'taxonomies' => array('design_category'), 
    );
  
    register_post_type('designs', $args);
  }

  static function ocs_email_instructions( $order, $sent_to_admin ) {
    if ( ! $sent_to_admin && BANK_TRANSFER_LABEL === $order->get_payment_method() && $order->has_status( ON_HOLD_ORDER_STATUS ) ) {
      if ( $order->get_shipping_method() === PALLET_SHIPPING_CLASS_NAME) {
        echo self::get_pallet_shipping_notes($order);
      }
  
      if ( $order->get_shipping_method() === BOX_SHIPPING_CLASS_NAME) {
        echo self::get_box_shipping_notes($order);
      }
    }
  }

  static function ocs_disable_wc_terms_toggle() { 
    remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
  }

  protected static function ocs_add_gtm_to_head() {
    $get_gtm_script_tag = function() {
      ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MHFCRTX');</script>
        <!-- End Google Tag Manager -->
      <?php
    };
    add_action('wp_head', $get_gtm_script_tag, -10000);
  }
  
  protected static function ocs_add_gtm_to_body() {
    $get_gtm_script_tag = function() {
      ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHFCRTX"
          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
      <?php
    };
    
    add_action('wp_body_open', $get_gtm_script_tag, -10000);
  }

  protected static function get_pallet_shipping_notes($order) {
    $C = self::C;
    $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];
  
    return <<<EOD
  Kérjük várd meg kollégánk jelentkezését, aki tájékoztatni fog a szállítás dijáról, valamint időtartamról. Addig is hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong><br>
  Miután tájékoztatotást kaptál a szállítási díjról es időről, már átutalhatod nekünk a végösszeget, erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
  Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.
  EOD;
  }
  
  protected static function get_box_shipping_notes($order) {
    $C = self::C;
    $randTelNumber = TEL_NUMBERS[array_rand(TEL_NUMBERS)][1];
  
    return <<<EOD
    Ahoz hogy elindíthassuk megrendelésed folyamatát, kérjük utald el a végösszeget (<strong>{$order->calculate_totals()}Ft</strong>) erre a bankszámlaszámra: <strong>{$C('COMPANY_BANK_ACCOUNT')}</strong><br>
    Arra kérünk, hogy rendelésed számát (<strong>{$order->id}</strong>) átutaláskor tüntesd fel a megjegyzés mezőben, köszönjük.<br>
    Ha bármi kérdésed merülne fel, hivd bizalommal kollégánkat a következő telefonszámon: <strong>{$randTelNumber}</strong>
  EOD;
  }
}