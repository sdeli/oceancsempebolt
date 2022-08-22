<?php
namespace Inc;
use Shared\Config;
class ShoppingFeed 
{
  const OPTIONS_GROUP = 'shopping-feed-settings-group';
  const GOOGLE_FEED_XML_FILE_PATH_SETTING = 'google-shopping-feed-xml-file';
  const FACEBOOK_FEED_XML_FILE_PATH_SETTING = 'facebook-shopping-feed-xml-file';
  const EMAIL_RECIPIENTS_SETTING = 'google-shopping-feed-email-recipients';
  const STARTED_FEED_CORRECTION_MSG = 'started feed correction';
  const FINISHED_FEED_CORRECTION_MSG = 'finished feed correction';
  const IS_GOOGLE_RUNNING = 0;
  const IS_FACEBOOK_RUNNING = 0;

  /**
   * Undocumented function redirection/v1
   *
   * @return void
   */
  static function init() {
    if(!is_admin()) {
      add_action( 'rest_api_init', function() {
        register_rest_route( 'shopping-feed/v1', '/google-xml-feed-correction', array(
          'methods' => 'GET',
          'callback' => function() {
            self::shopping_feed_xml_correction(self::GOOGLE_FEED_XML_FILE_PATH_SETTING);
          },
        ) );
      } );

      add_action( 'rest_api_init', function() {
        register_rest_route( 'shopping-feed/v1', '/facebook-xml-feed-correction', array(
          'methods' => 'GET',
          'callback' => function() {
            self::shopping_feed_xml_correction(self::FACEBOOK_FEED_XML_FILE_PATH_SETTING);
          },
        ) );
      } );

      return;
    }

    register_setting( self::OPTIONS_GROUP, self::GOOGLE_FEED_XML_FILE_PATH_SETTING );
    register_setting( self::OPTIONS_GROUP, self::FACEBOOK_FEED_XML_FILE_PATH_SETTING );
    register_setting( self::OPTIONS_GROUP, self::EMAIL_RECIPIENTS_SETTING );
    register_setting( self::OPTIONS_GROUP, self::IS_GOOGLE_RUNNING );
    register_setting( self::OPTIONS_GROUP, self::IS_FACEBOOK_RUNNING );

    add_action('admin_menu', function() {
      add_menu_page(
        'Xml Correction', 
        'Xml Correction', 
        'administrator', 
        __FILE__, 
        function() {self::shopping_feed_page();} , 
      );
    });

	  /** @phpstan-ignore-next-line */
    if (WP_ENVIRONMENT_TYPE === Config::ENVIRONMENT_TYPE_PROD) {
      $page_name = str_replace("/home/www/clients/client4478/web9628/web/wp-content/plugins/", "", __FILE__);
    /** @phpstan-ignore-next-line */
    } else {
      $page_name = str_replace("/var/www/html/wp-content/plugins/", "", __FILE__);
    }

    $is_on_this_admin_page = isset($_GET['page']) && $_GET['page'] === $page_name;
    if ($is_on_this_admin_page || defined( 'DOING_AJAX' )) {
      add_action( 'admin_init', function() {
        register_setting( self::OPTIONS_GROUP, self::GOOGLE_FEED_XML_FILE_PATH_SETTING );
      } );
      add_action( 'admin_footer', function() {
        self::request_shopping_feed_xml_correction_js();
      } );
      add_action( 'wp_ajax_shopping_feed_xml_correction', function() {
        if (isset($_POST['plattform']) && $_POST['plattform'] === 'google') {
          self::shopping_feed_xml_correction(self::GOOGLE_FEED_XML_FILE_PATH_SETTING);
        }
        
        if (isset($_POST['plattform']) && $_POST['plattform'] === 'facebook') {
          self::shopping_feed_xml_correction(self::FACEBOOK_FEED_XML_FILE_PATH_SETTING);
        }
      } );
    }
  }

  protected static function shopping_feed_page() {
    ?>
      <div class="wrap" style="position: relative;">
        <h1>Xml Correction</h1>
        
        <form method="post" action="options.php">
        <?php settings_fields( self::OPTIONS_GROUP ); ?>
        <?php do_settings_sections( self::OPTIONS_GROUP ); ?>
            <table class="form-table">
                <tr valign="top">
                  <th scope="row">google shopping feed xml file</th>
                  <td><input type="text" name="<?= self::GOOGLE_FEED_XML_FILE_PATH_SETTING ?>" style="width: 400px" value="<?php echo esc_attr( get_option(self::GOOGLE_FEED_XML_FILE_PATH_SETTING) ); ?>" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">facebook shopping feed xml file</th>
                  <td><input type="text" name="<?= self::FACEBOOK_FEED_XML_FILE_PATH_SETTING ?>" style="width: 400px" value="<?php echo esc_attr( get_option(self::FACEBOOK_FEED_XML_FILE_PATH_SETTING) ); ?>" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Nofitication email recipients</th>
                  <td><input type="text" name="<?= self::EMAIL_RECIPIENTS_SETTING ?>" style="width: 400px" value="<?php echo esc_attr( get_option(self::EMAIL_RECIPIENTS_SETTING) ); ?>" /></td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
        <p><a class="button button-primary" value="Módosítások mentése" onclick="requestGoogleShoppingFeedXmlCorrection('google')">request google shopping feed xml correction</a>
        <p><a class="button button-primary" value="Módosítások mentése" onclick="requestGoogleShoppingFeedXmlCorrection('facebook')">request facebook shopping feed xml correction</a>
        <div class="collections-loader-position">
            <div class="collections-loader">Loading...</div>
          </div>
      </div>
    <?php 
  }

  /**
   * Undocumented function
   *
   * @param string $xml_path_settings
   * @return void
   */
  protected static function shopping_feed_xml_correction($xml_path_settings) {
    $is_runnin_setting_name = $xml_path_settings === self::GOOGLE_FEED_XML_FILE_PATH_SETTING ? self::IS_GOOGLE_RUNNING : self::IS_FACEBOOK_RUNNING;
    try {
      $is_running = get_option($is_runnin_setting_name);
      /** @phpstan-ignore-next-line */
      if ($is_running) {
        echo 'it is running, wait until you get an email about the finish!';
        wp_die();
        return;
      } else {
        update_option($is_runnin_setting_name, 1);
      }

      $email_recipients = explode(' ', get_option(self::EMAIL_RECIPIENTS_SETTING));
      get_option($xml_path_settings);
      wp_mail($email_recipients, self::STARTED_FEED_CORRECTION_MSG, self::STARTED_FEED_CORRECTION_MSG);

      $xml_file_path = wp_upload_dir()['basedir'] . get_option($xml_path_settings);
      $doc = new \DOMDocument();
      $doc->load($xml_file_path);
      $products = $doc->getElementsByTagName('item');

      for ($i = 0; $i < $products->count(); $i++) { 
          $product = $products->item($i);
          if (!$product) continue;

          $cat = self::get_node($product, 'g:product_type'); //$product->childNodes->item(15);
          if (!$cat) continue;

          $id = self::get_node($product, 'g:id'); //$product->childNodes->item(1);
          if (!$id) continue;

          $current_post = get_post(intval($id->nodeValue));
          if (!$current_post || is_array($current_post)) continue;

          $categories = get_the_terms( $current_post, 'product_cat' );
          
          
          if (!$categories) $categories = get_the_terms(get_post_parent($current_post), 'product_cat');
          if (!$categories) continue;
          
          if ($categories instanceof \WP_Error) continue;
          $main_prod_cat = self::get_non_brand_root_Category($categories);
          if (!$main_prod_cat) continue;

          $main_prod_cat_ancestor_ids = array_reverse(get_ancestors($main_prod_cat->term_id, 'product_cat'));
        
          /**
           * @var string[]
           */
          $main_prod_cat_ancestor_names = [];
          foreach($main_prod_cat_ancestor_ids as $ancestor_id) {
            $ancestor = get_term_by('term_id', $ancestor_id, 'product_cat');
            if (!$ancestor) continue;
            if (is_array($ancestor)) continue;

            $main_prod_cat_ancestor_names[] = $ancestor->name;
          }

          $main_prod_cat_ancestor_names[] = $main_prod_cat->name;
          $product_category_path = implode(' =**= ', $main_prod_cat_ancestor_names);
          $cat->nodeValue = $product_category_path;
          $i = $i;
        }
        
        /** @phpstan-ignore-next-line */
        $xml = str_replace("=**=","&gt;", $doc->saveXML());
        $xml_path_info = pathinfo($xml_file_path);
        $extension = isset($xml_path_info['extension']) ? $xml_path_info['extension'] : '';
        $new_file_name = $xml_path_info['filename'] . '.modified.' . $extension;
        $new_file_path = $xml_path_info['dirname'] . '/' . $new_file_name;

        file_put_contents($new_file_path, $xml);
        wp_mail($email_recipients, self::FINISHED_FEED_CORRECTION_MSG, self::FINISHED_FEED_CORRECTION_MSG);
        $new_file_url = wp_upload_dir()['baseurl'] . pathinfo(get_option($xml_path_settings))['dirname'] . '/' . $new_file_name;
        echo $new_file_url;
        update_option($is_runnin_setting_name, 0);
        wp_die(); // this is required to terminate immediately and return a proper response
      } catch (\Exception $error) {
        wp_send_json_error( $error );
        wp_die(); // this is required to terminate immediately and return a proper response
      }
    }

    /**
     * Undocumented function
     *
     * @param \WP_Term[] $categories
     * @return \WP_Term|false
     */
    protected static function get_non_brand_root_Category($categories) {
      foreach ($categories as $product_cat) {
        $is_invalid_categ = strpos($product_cat->name, "update") !== false;
        if ($is_invalid_categ) continue;

        $is_invalid_categ = strpos($product_cat->name, "telefonhívás") !== false;
        if ($is_invalid_categ) continue;

        $is_invalid_categ = Config::TILE_BRANDS_PRODUCT_CATEG_ID === $product_cat->term_id || Config::BRANDS_PRODUCT_CATEG_ID === $product_cat->term_id;
        if ($is_invalid_categ) continue;
        
        $is_invalid_categ = term_is_ancestor_of(Config::TILE_BRANDS_PRODUCT_CATEG_ID, $product_cat->term_id, 'product_cat');
        if ($is_invalid_categ) continue;

        $is_invalid_categ = term_is_ancestor_of(Config::BRANDS_PRODUCT_CATEG_ID, $product_cat->term_id, 'product_cat');
        if ($is_invalid_categ) continue;

        $is_main_category = count( get_term_children( $product_cat->term_id, 'product_cat' ) ) === 0;
        if ($is_main_category) {
          return $product_cat;
        } else {
          $root_category = $product_cat;
        }
      }

      if (isset($root_category)) {
        return $root_category;
      } else {
        return false;
      }
    }


    /**
     * Undocumented function
     *
     * @param \DOMElement $product
     * @param string $node_type
     * @return \DOMNode|false
     */
    protected static function get_node($product, $node_type) {
      for ($i = 0; $i < $product->childNodes->count(); $i++) { 
        $current_node = $product->childNodes->item($i);
        
        if (isset($current_node->tagName) && $current_node->tagName === $node_type) {
          return $current_node;
        }
      }

      return false;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected static function request_shopping_feed_xml_correction_js() { 
      ?>
        <script type="text/javascript">
          let isLoading = false;
          function requestGoogleShoppingFeedXmlCorrection(plattform) {
            jQuery(document).ready(function($) {
              var data = {
                'action': 'shopping_feed_xml_correction',
                'plattform': plattform
              };
              console.log('data')
              console.log(data);
              if (isLoading) return;
              isLoading = true;
              toggleLoader();
              // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
              jQuery.post(ajaxurl, data, function(response) {
                console.log('url: ' + response);
                isLoading = false;
                toggleLoader();
                setTimeout(() => {
                  alert(`Editing finished! new file can be reached here: ${response}`);
                }, 500)
              })
              .fail(function(xhr, status, error) {
                isLoading = false;
                toggleLoader();
                setTimeout(() => {
                  alert('some error happened call Sandor');
                }, 500)
              });
            });
          }

          function toggleLoader() {
            const loader = jQuery('.collections-loader-position');
            if (isLoading) {
              loader.fadeIn();
            } else {
              loader.fadeOut();
            }
          }
        </script>
        <style>
            .collections-loader-position {
              display: none;
              position: absolute;
              right: 50%;
              z-index: 100;
              transform: translateX(50%);
              transition: display 1s ease-in-out;
              top: 0px;
            }
            .collections-loader {
            color: #1184EF;
            font-size: 90px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            margin: 72px auto;
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
          }
          @-webkit-keyframes load6 {
            0% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
          }
          @keyframes load6 {
            0% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
              box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
              box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
          }
          @-webkit-keyframes round {
            0% {
              -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
            }
            100% {
              -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
            }
          }
          @keyframes round {
            0% {
              -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
            }
            100% {
              -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
            }
          }
        </style>
      <?php
    }
  }