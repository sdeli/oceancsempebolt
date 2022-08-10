<?php
namespace Inc;

class ShoppingFeed 
{
  const OPTIONS_GROUP = 'shopping-feed-settings-group';
  const SETTING_NAME = 'google-shopping-feed-xml-file';

  static function init() {
    add_action('admin_menu', function() {
      
      add_menu_page(
        'My Cool Plugin Settings', 
        'Cool Settings', 
        'administrator', 
        __FILE__, 
        function() {self::shopping_feed_page();} , 
      );
      
    });
    
    add_action( 'admin_init', function() {
      register_setting( self::OPTIONS_GROUP, self::SETTING_NAME );
    } );
  }

  protected static function shopping_feed_page() {
    
    ?>
      <div class="wrap">
        <h1>Your Plugin Name</h1>
        
        <form method="post" action="options.php">
        <?php settings_fields( self::OPTIONS_GROUP ); ?>
        <?php do_settings_sections( self::OPTIONS_GROUP ); ?>
            <table class="form-table">
                <tr valign="top">
                  <th scope="row">google shopping feed xml file</th>
                  <td><input type="text" name="<?= self::SETTING_NAME ?>" style="width: 400px" value="<?php echo esc_attr( get_option(self::SETTING_NAME) ); ?>" /></td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
      </div>
    <?php 
  }

  // This function makes in the mobile sidebar possible to switch between categories and main menu
  // It adds "menu" and the "categories" buttons to it and the categories sidebar widget as well
  protected static function googleProductCategories() {
    $google_feed_xml_file = '../assets/63J96YwrXlmfnTk0syHmRNvMTOtww9og.xml';
    $doc = new \DOMDocument();
    $doc->load($google_feed_xml_file);

    $products = $doc->getElementsByTagName('item');
    for ($i = 0; $i < $products->count(); $i++) { 
    // for ($i = 0; $i < 50; $i++) { 
      $product = $products->item($i);
      if (!$product) continue;

      $id = $product->childNodes->item(1);
      if (!$id) continue;

      $cat = $product->childNodes->item(15);

      if (!$cat) continue;
      $cat->textContent = $cat->textContent . ' ' . $id->textContent;
    }

    $doc->save('../assets/63J96YwrXlmfnTk0syHmRNvMTOtww9og.modified.xml');
  }
}