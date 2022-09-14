<?php
namespace Inc;
use Shared\Config;

class AltText 
{
  const OPTIONS_GROUP = 'alt-text-settings-group';
  const GOOGLE_FEED_XML_FILE_PATH_SETTING = 'google-shopping-feed-xml-file';

  private static $html_titles_data = [];

  const TILE_CATEG_IDS = [
    Config::THREE_D_TILE_CATEG_ID,
    Config::BORDUR_CATEG_ID,
    Config::DECORS_TILE_CATEG_ID,
    Config::WALL_TILE_CATEG_ID,
    Config::HEXAGON_TILE_CATEG_ID,
    Config::MOSAIC_TILE_CATEG_ID,
    Config::FLOOR_TILE_CATEG_ID
  ];

  const TILE_CATEG_ID_MAP = [
    Config::THREE_D_TILE_CATEG_ID => '3D csempe',
    Config::BORDUR_CATEG_ID => 'bordűr',
    Config::DECORS_TILE_CATEG_ID => 'Dekor Csempe',
    Config::WALL_TILE_CATEG_ID => 'Fali Csempe',
    Config::HEXAGON_TILE_CATEG_ID => 'hexagon',
    Config::MOSAIC_TILE_CATEG_ID => 'Mozaik',
    Config::FLOOR_TILE_CATEG_ID => 'padlólap'
  ];

  /**
   * Undocumented function redirection/v1
   *
   * @return void
   */
  static function init() {
    if(!is_admin()) return;

    // register_setting( self::OPTIONS_GROUP, self::GOOGLE_FEED_XML_FILE_PATH_SETTING );

    add_action('admin_menu', function() {
      add_menu_page(
        'AltText', 
        'AltText', 
        'administrator', 
        __FILE__, 
        function() {self::alt_text_page();} , 
      );
    });
  }


  protected static function alt_text_page() {
    ?>
      <div class="wrap" style="position: relative;">
        <h1>Alt text</h1>
        <?php 
          self::updateAltTagsForAllTileImages();
        ?>
      </div>
    <?php 
  }

  protected static function updateAltTagsForAllTileImages() {
    $term = get_term_by( 'term_id', 2221, 'product_cat' );

    for ($i = 100; $i < $term->count; $i += 100) { 
      $page = $i / 100;
      self::getAltTagDataForTileImages($page);
    }

    // $i = 0;
    // 	http://localhost/wp-content/uploads/2022/06/OXIDART-SILVER-3060-08.jpg
    foreach(self::$html_titles_data as $image_id => $data) {
      $seo_title = $data['name'] . ' ' . self::getCategsForSEO($data['categories']);
      wp_update_post(['ID' => $image_id, 'post_title' => $seo_title]);
      update_post_meta($image_id, '_wp_attachment_image_alt', $seo_title);
      // $i++;
      // if ($i > 5) return;
    }
    // r(self::$html_titles_data);
    // r(count(self::$html_titles_data));
  }
  
  /**
   * getAltTagDataForTileImages function
   *
   * @param number $page
   * @param array $html_titles_data
   * @return array
   */
  protected static function getAltTagDataForTileImages($page) {
    $products = wc_get_products(array(
      'limit'  => 100,
      'page' => $page,
      'category' => array('burkolatok'),
    ));

    foreach($products as $product) {
      $attachment_image_ids = array_merge([$product->get_image_id()], $product->get_gallery_image_ids());
      $main_tile_categ = self::getMainCategoryOfTile($product);
  
      foreach($attachment_image_ids as $attachment_image_id) {
        if(isset(self::$html_titles_data[$attachment_image_id])) {
          if ($main_tile_categ) {
            if (!in_array($main_tile_categ, self::$html_titles_data[$attachment_image_id]['categories'])) {
              self::$html_titles_data[$attachment_image_id]['categories'][] = $main_tile_categ;
            }
          } 
          continue;
        }
        
        self::$html_titles_data[$attachment_image_id] = ['name' => $product->get_title()];
        self::$html_titles_data[$attachment_image_id]['categories'] = [];
        
        if ($main_tile_categ) self::$html_titles_data[$attachment_image_id]['categories'][] = $main_tile_categ;
      }
    }
  }
  /**
   * Undocumented function
   *
   * @param \WC_Product_Simple $product
   * @return int|boolean
   */
  protected static function getMainCategoryOfTile($product) {
    $terms = get_the_terms( $product->get_id(), 'product_cat' );

    if (!$terms || $terms instanceof \WP_Error) return false;

    foreach($terms as $term) {
      $term->term_id;
      if (in_array($term->term_id, self::TILE_CATEG_IDS)) {
        return $term->term_id;
      };
    }

    return false;
  }

  /**
   * Undocumented function
   *
   * @param array $categ_ids
   * @return string
   */
  protected static function getCategsForSEO($categ_ids) {
    shuffle($categ_ids);
    $categ_seo_names = [];
    foreach($categ_ids as $categ_id) {
      if (isset(self::TILE_CATEG_ID_MAP[$categ_id])) {
        $categ_seo_names[] = self::TILE_CATEG_ID_MAP[$categ_id];
      }
    }

    return implode(', ', $categ_seo_names);
  }
}

