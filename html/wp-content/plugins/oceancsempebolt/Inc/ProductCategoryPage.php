<?php
namespace Inc;
use Shared\Config;
use Shared\Utils;

class ProductCategoryPage 
{
  static function init() {
    self::customizeJumbotron();
    self::addMobileNavbarCustomizations();

    add_action('woocommerce_before_main_content', function() {
      if (is_shop() || is_product_category()) {
        [ $smartSliderId, $category_specific_filter_id ] = ProductCategoryPage::getShortcodeIds();
        self::echoCustomElements($smartSliderId, $category_specific_filter_id);
        if (!is_null($category_specific_filter_id)) self::echoFilterModal($category_specific_filter_id);
      }
    });
  }

  protected static function customizeJumbotron() {
    add_action('flatsome_before_header',function() {
      remove_action( 'flatsome_after_header', 'flatsome_category_header' );
    });
    add_action('flatsome_after_header',function() {
      if (is_shop() || is_product_category()) {
        self::echoJumbotron();
      }
    });
  }
  
  protected static function echoJumbotron(bool $visibleOnScroll = false) {
    ?>
      <div class="category-name-bar <?php if ( $visibleOnScroll ): echo '--visible-on-scroll'; endif ?>">
        <?php if ( ! is_shop() ): ?>
          <a href="<?php echo Utils::getPreviousSite() ?>"><i class="icon-angle-left" style="color:black;"></i></a>
        <?php endif ?>
        <h1><?php echo ucwords(woocommerce_page_title(false)); ?></h1>
        <span class="category-name-bar__filter-btn">Szűrők <i class="icon-equalizer color-alert-coral" style="vertical-align: text-bottom; font-size: 17px;"></i></span>
      </div>
    <?php
  }

  protected static function addMobileNavbarCustomizations() {
    add_action( 'flatsome_after_header_bottom', function() {
      if (is_shop() || is_product_category()) {
        self::echoJumbotron( true );
      }
      echo '<div class="mobile-menu-arrow-up-down-box"><i class="icon-angle-up mobile-menu-arrow-up-down-box__arrow"></i></div>';
    });
  }

  protected static function echoCustomElements($smartSliderId, $category_specific_filter_id) {
    ?>
      <div class="row">
        <div class="col design-col">
          <?php if (!is_null($smartSliderId)) self::echoSmartSlider($smartSliderId) ?>
        
          <?php if (!is_null($category_specific_filter_id)) { ?>
            <div class="filter-form">
              <?php echo self::getBerocketFilters($category_specific_filter_id); ?>
            </div>
          <?php } ?>
          
          <div class="sort-disclaimer">
            <p onclick="openHamburgerMenuForCategories()">
              <strong class="open-mobile-menu-text">Rendezés,</strong> 
              <strong>Kategóriák</strong> és 
              <strong>Szűrők <i class="icon-equalizer color-alert-coral" style="vertical-align: text-bottom; font-size: 17px;"></i></strong> 
            </p>
          </div>

          <div>
            <?= \Shared\Config::CHANGING_PRICES_MESSAGE ?>
          </div>

          <?php
              $catalog = \Shared\Utils::get_pdf_catalog_data_for_category();
              if ($catalog) {
          ?>
            <a 
              href="<?= $catalog['url'] ?>" 
              target="_blank" class="catalog-legend"
            >
              ITT MEGTEKINTHETI A TELJES 
              <span class="color-alert-yellow text-shadow-sharp"><?= $catalog['name'] ?></span> 
              KATALÓGUST: <span class="color-alert-yellow text-shadow-sharp">KATTINTS IDE</span>
            </a>
          <?php } ?>

        </div>
      </div>
    <?php
  }

  protected static function getBerocketFilters(int $category_specific_filter_id, bool $is_popup_version = false) {
    if ($is_popup_version) {
      $category_specific_filter_id = Config::FILTER_POP_UP_VERSIONS_IDS[$category_specific_filter_id];
    }
    
    $berocket_filters_html = do_shortcode("[br_filters_group group_id=${category_specific_filter_id}]");
    $doc = new \DOMDocument();
    $doc->loadHTML(mb_convert_encoding($berocket_filters_html, 'HTML-ENTITIES', 'UTF-8'));
    $be_rocket_color_icon_name_containers = $doc->getElementsByTagName('label');
    foreach($be_rocket_color_icon_name_containers as $color_icon_container) {
      $color = $color_icon_container->getAttribute('aria-label');
      if ($color) {
        $color_icon_container->firstChild->textContent = $color;
      }
    }

    return $doc->saveHTML();
  }

  protected static function getSmartSliderIdByRoom(int $default) {
    $smartSliderId = $default;
    preg_match(Config::GET_LAST_BE_ROCKET_ROOM_FILTER_ID_REGEX, $_GET[Config::BE_ROCKET_FILTERS_QUERY_VAR_NAME], $roomIdArr);
    $roomId = !empty($roomIdArr) ? intval($roomIdArr[1]) : '';

    $smartSliderId = $roomId === Config::LIVING_ROOM_AND_MORE_ID ? 109 : $smartSliderId;
    $smartSliderId = $roomId === Config::KITCHEN_ID ? 230 : $smartSliderId;
    $smartSliderId = $roomId === Config::BATHROOM_ID ? 106 : $smartSliderId;

    return $smartSliderId;
  }

  protected static function echoSmartSlider($smartSliderId) {
    ?>
      <div class="design-slider">
        <div class="design-slider__fake-slider-img">
          <?php self::echoSmartSliderFirstImage(); ?>
          <?php self::echoFakeNavArrows(); ?>
          <?php self::echoSliderLoader(); ?>
        </div>
        <div class="design-slider__real-slider"></div>
      </div>
    
      <div class="design-slider__slider-code-in-text">
        <?php 
          $smartSliderHtmlAsString = htmlspecialchars(do_shortcode("[smartslider3 slider=\"$smartSliderId\"]"));
          echo $smartSliderHtmlAsString;
        ?>
      </div>
    <?php 
  }

  protected static function echoSmartSliderFirstImage() {
    $design_category_name = is_shop() ? Config::SHOP_PAGE_SLIDER_CATEGORY : get_queried_object()->name;
    $query = new \WP_Query( array( 
      'post_type'      => 'designs',
      'posts_per_page' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'design_category',
          'field'    => 'name',
          'terms'    => $design_category_name,
        ),
      ),
    ));
    
    $latest_designs_id = $query->post->ID ?? null;

    $featured_image_url_medium = get_the_post_thumbnail_url($latest_designs_id, 'medium');
    $featured_image_url_medium_large = get_the_post_thumbnail_url($latest_designs_id, 'medium_large');
    $featured_image_url_large = get_the_post_thumbnail_url($latest_designs_id, 'large');
    $featured_image_url_full = get_the_post_thumbnail_url($latest_designs_id, 'full');
    $featured_image_url_original = get_the_post_thumbnail_url($latest_designs_id);

    ?>
    <img 
    class="skip-lazy"
    src="<?php echo $featured_image_url_original ?>"
    srcset="<?php echo $featured_image_url_medium ?> 600w,  
            <?php echo $featured_image_url_medium_large ?> 768w, 
            <?php echo $featured_image_url_large ?> 1121w,
            <?php echo $featured_image_url_full ?> 1320w" 
    >
  <?php 
  }

  protected static function echoFakeNavArrows() {
    ?>
    <div style="position: absolute; top: 0; width: 100%; padding: 0 15px; top: 50%; transform: translateY(-50%);">
        <div class="nextend-arrow fake-arrow-prev" style="width: 32px; left: 15px; float: left; height: 32px;" role="button">
          <span class="slider-fake-arrow"><</span>
        </div>
        
        <div class="nextend-arrow fake-arrow-next" style="width: 32px; right: 15px; float: right; height: 32px;" role="button">
          <span class="slider-fake-arrow">></span>
        </div>
    </div>
    <?php 
  }

  protected static function echoFilterModal($category_specific_filter_id) {
    add_action('wp_footer', function() use ($category_specific_filter_id) {
      ?>
        <div class="filter-modal">
          <div class="filter-modal__wrapper">
            <div class="filter-modal__head">
              <h3>Szűrők</h3>
              <span class="close-btn close-right"></span>
              </span>
            </div>
            <?php echo self::getBerocketFilters($category_specific_filter_id, true) ?>
          </div>
          <div class="filter-modal__background"></div>
        </div>
        <div class="invisble_overlay"></div>
      <?php 
    });
  }

  protected static function echoSliderLoader() {
    ?>
    <style>
      .slider-loader {
        display: none;
        opacity: 1;
        transition: opacity 1s ease-in-out;
        z-index: 100;
      }
      .slider-loader__wrapper{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
      }

      .slider-loader__loader{
        display: flex;
        position: relative;
        width: 250px;
        height: 88px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .slider-loader__wave{
        display: flex;
        justify-content: space-between;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        perspective: 100px;
      }

      .slider-loader__wave > div{
        position: relative;
        width: 16px;
        height: 16px;
        border-radius: 100%;
      }

      .slider-loader__wave > div::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        border-radius: 50%;
      }

      .slider-loader__top-wave > div::before {
        background-color: #1184EF;
      }

      .slider-loader__top-wave > div{
        animation: move 3s ease-in-out infinite reverse;
        
      }
      
      .slider-loader__top-wave > div::before{
        animation: grow 3s linear infinite reverse; 
      }

      .slider-loader__bottom-wave > div{
        animation: move 3s ease-in-out infinite;
      }
      
      .slider-loader__bottom-wave > div::before{
        animation: grow 3s linear infinite;
      }

      .slider-loader__wave > div:nth-child(10){
        animation-delay: 0s;
      }
      .slider-loader__wave > div:nth-child(9){
        animation-delay: -0.1s;
      }
      .slider-loader__wave > div:nth-child(8){
        animation-delay: -0.2s;
      }
      .slider-loader__wave > div:nth-child(7){
        animation-delay: -0.3s;
      }
      .slider-loader__wave > div:nth-child(6){
        animation-delay: -0.4s;
      }
      .slider-loader__wave > div:nth-child(5){
        animation-delay: -0.5s;
      }
      .slider-loader__wave > div:nth-child(4){
        animation-delay: -0.6s;
      }
      .slider-loader__wave > div:nth-child(3){
        animation-delay: -0.7s;
      }
      .slider-loader__wave > div:nth-child(2){
        animation-delay: -0.8s;
      }
      .slider-loader__wave > div:nth-child(1){
        animation-delay: -0.9s;
      }


      .slider-loader__bottom-wave > div:nth-child(10){
        animation-delay: 0.75s;
      }
      .slider-loader__bottom-wave > div:nth-child(9){
        animation-delay: 0.65s;
      }
      .slider-loader__bottom-wave > div:nth-child(8){
        animation-delay: 0.55s;
      }
      .slider-loader__bottom-wave > div:nth-child(7){
        animation-delay: 0.45s;
      }
      .slider-loader__bottom-wave > div:nth-child(6){
        animation-delay: 0.35s;
      }
      .slider-loader__bottom-wave > div:nth-child(5){
        animation-delay: 0.25s;
      }
      .slider-loader__bottom-wave > div:nth-child(4){
        animation-delay: 0.15s;
      }
      .slider-loader__bottom-wave > div:nth-child(3){
        animation-delay: 0.05s;
      }
      .slider-loader__bottom-wave > div:nth-child(2){
        animation-delay: -0.05s;
      }
      .slider-loader__bottom-wave > div:nth-child(1){
        animation-delay: -0.15s;
      }


      @keyframes move{
        0%{
          transform: translateY(0px);
        }
        25%{
          transform: translateY(88px);
        }
        50%{
          transform: translateY(0px);
        }
        75%{
          transform: translateY(88px);
        }
        100%{
          transform: translateY(0px);
        }

      }

      @keyframes grow{
        0%, 50%, 75%, 100% {
          transform: scaleX(0.7) scaleY(0.7);
        }
        10%, 60% {
          transform: scaleX(1) scaleY(1);
        }
        35%, 85% {
          transform: scaleX(0.4) scaleY(0.4);
        }
      }
    </style>

    <div class="slider-loader slider-loader__wrapper">
      <div class="slider-loader__loader">
        <div class="slider-loader__wave slider-loader__top-wave">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <div class="slider-loader__wave slider-loader__bottom-wave">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
    <?php 
  }

  protected static function getShortcodeIds(): array {
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    [$current_path] = explode("?", $_SERVER['REQUEST_URI']);
    $category_specific_filter_id = null;
    $smartSliderId = null;
    
    if (is_shop()) {
      $smartSliderId = 248;
      $category_specific_filter_id = 10595;
    } else {
      if ($cat->slug === "burkolatok") {
        $smartSliderId = 3;

        $filtered_by_room = array_key_exists(Config::BE_ROCKET_FILTERS_QUERY_VAR_NAME, $_GET);
        if ($filtered_by_room) $smartSliderId = self::getSmartSliderIdByRoom($smartSliderId);
      }

      if ( strpos($current_path, "burkolatok")) {
        $category_specific_filter_id = 10595;
      }

      if ($cat->slug === "markak") {
        $smartSliderId = 4;	
      }
      
      if ($cat->slug === "argenta") {
        $smartSliderId = 5;	
      }
    
       if ($cat->slug === "anna") {
         $smartSliderId = 6;
       }
    
       if ($cat->slug === "camargue") {
         $smartSliderId = 7;
       }
    
      if ($cat->slug === "atr-termekcsalad") {
        $smartSliderId = 8;	
      }

      if ($cat->slug === "gs-termekcsalad") {
        $smartSliderId = 9;	
      }

      if ($cat->slug === "martha") {
        $smartSliderId = 10;	
      }
    
      if ($cat->slug === "mary") {
        $smartSliderId = 11;	
      }
    
      if ($cat->slug === "naomi") {
        $smartSliderId = 12;	
      }
    
      if ($cat->slug === "ker-termekcsalad") {
        $smartSliderId = 13;	
      }
    
      if ($cat->slug === "black-white") {
        $smartSliderId = 14;	
      }
      
      if ($cat->slug === "claudia") {
        $smartSliderId = 15;	
      }
    
      if ($cat->slug === "eva") {
        $smartSliderId = 16;	
      }
    
      if ($cat->slug === "rebekah") {
        $smartSliderId = 17;	
      }
    
      if ($cat->slug === "brandtile-burkolatok") {
        $smartSliderId = 18;	
      }
    
      if ($cat->slug === "ruby") {
        $smartSliderId = 19;	
      }
    
      if ($cat->slug === "cerrad") {
        $smartSliderId = 20;	
      }

      if ($cat->slug === "mystery-land") {
        $smartSliderId = 21;	
      }
      
      if ($cat->slug === "alaya") {
        $smartSliderId = 22;	
      }
      
      if ($cat->slug === "arno") {
        $smartSliderId = 23;	
      }
    
      if ($cat->slug === "bantu") {
        $smartSliderId = 24;	
      }
      
      if ($cat->slug === "black-and-white") {
        $smartSliderId = 25;	
      }
    
      if ($cat->slug === "concrete-style") {
        $smartSliderId = 26;	
      }
      
      if ($cat->slug === "forest-soul") {
        $smartSliderId = 27;	
      }
    
      if ($cat->slug === "good-look") {
        $smartSliderId = 28;	
      }
    
      if ($cat->slug === "gravity") {
        $smartSliderId = 29;	
      }
    
      if ($cat->slug === "hika") {
        $smartSliderId = 30;	
      }
    
      if ($cat->slug === "indira") {
        $smartSliderId = 31;	
      }
      
      if ($cat->slug === "kavir") {
        $smartSliderId = 32;	
      }
      
      if ($cat->slug === "livi") {
        $smartSliderId = 33;	
      }
      
      if ($cat->slug === "manzila") {
        $smartSliderId = 34;	
      }
      
      if ($cat->slug === "cersanit-burkolatok") {
        $smartSliderId = 35;	
      }
      
      if ($cat->slug === "marble-room") {
        $smartSliderId = 36;	
      }
      
      if ($cat->slug === "marinel") {
        $smartSliderId = 37;	
      }
      
      if ($cat->slug === "markuria") {
        $smartSliderId = 38;	
      }
        
      if ($cat->slug === "mystery-land") {
        $smartSliderId = 39;	
      }
    
      if ($cat->slug === "nanga") {
        $smartSliderId = 40;	
      }
    
      if ($cat->slug === "ondes") {
        $smartSliderId = 41;	
      }
      
      if ($cat->slug === "safari") {
        $smartSliderId = 42;	
      }
    
      if ($cat->slug === "simple-art") {
        $smartSliderId = 43;	
      }
    
      if ($cat->slug === "snowdrops") {
        $smartSliderId = 44;	
      }
    
      if ($cat->slug === "space") {
        $smartSliderId = 45;	
      }
      
      if ($cat->slug === "zambezi") {
        $smartSliderId = 46;	
      }
        
      if ($cat->slug === "kolpa-san") {
        $smartSliderId = 47;	
      }
    
      if ($cat->slug === "accordo") {
        $smartSliderId = 48;	
      }
    
      if ($cat->slug === "aria") {
        $smartSliderId = 49;	
      }
    
      if ($cat->slug === "atlas") {
        $smartSliderId = 50;	
      }
      
      if ($cat->slug === "beatrice") {
        $smartSliderId = 51;	
      }
    
      if ($cat->slug === "calando") {
        $smartSliderId = 52;	
      }
    
      if ($cat->slug === "carmen") {
        $smartSliderId = 53;	
      }
    
      if ($cat->slug === "carol") {
        $smartSliderId = 54;	
      }
    
      if ($cat->slug === "chad") {
        $smartSliderId = 55;	
      }
      
      if ($cat->slug === "destiny") {
        $smartSliderId = 56;	
      }
    
      if ($cat->slug === "evelin") {
        $smartSliderId = 57;	
      }
    
      if ($cat->slug === "flex") {
        $smartSliderId = 58;	
      }
    
      if ($cat->slug === "loco") {
        $smartSliderId = 59;	
      }
    
      if ($cat->slug === "valis") {
        $smartSliderId = 60;	
      }
    
      if ($cat->slug === "virgo-uni") {
        $smartSliderId = 61;	
      }
      
      if ($cat->slug === "zephyr") {
        $smartSliderId = 62;	
      }
      
      if ($cat->slug === "m-acryl") {
        $smartSliderId = 63;	
      }
      
      if ($cat->slug === "sandra") {
        $smartSliderId = 64;	
      }
    
      if ($cat->slug === "marazzi") {
        $smartSliderId = 65;	
      }
    
      if ($cat->slug === "clayline") {
        $smartSliderId = 66;	
      }
    
      if ($cat->slug === "d-segni") {
        $smartSliderId = 67;	
      }
    
      if ($cat->slug === "opoczno") {
        $smartSliderId = 68;	
      }
    
      if ($cat->slug === "break-the-line") {
        $smartSliderId = 69;	
      }
    
      if ($cat->slug === "calm-colors") {
        $smartSliderId = 70;	
      }
    
      if ($cat->slug === "frozen-lake") {
        $smartSliderId = 71;	
      }
      if ($cat->slug === "noisy-grey") {
        $smartSliderId = 72;	
      }
      if ($cat->slug === "selina") {
        $smartSliderId = 73;	
      }
      if ($cat->slug === "porcelanosa") {
        $smartSliderId = 74;	
      }
      if ($cat->slug === "travertino-medici") {
        $smartSliderId = 75;	
      }
      if ($cat->slug === "all-in-white") {
        $smartSliderId = 76;	
      }
      if ($cat->slug === "malena") {
        $smartSliderId = 77;	
      }
      if ($cat->slug === "obsydian") {
        $smartSliderId = 78;	
      }
      if ($cat->slug === "onis") {
        $smartSliderId = 79;	
      }
      if ($cat->slug === "tubadzin") {
        $smartSliderId = 80;	
      }
      if ($cat->slug === "fali-csempe") {
        $smartSliderId = 81;	
      }
      if ($cat->slug === Config::TUBS_SLUG) {
        $smartSliderId = 82;
      }
      
      if ( strpos($current_path, Config::TUBS_SLUG)) {
        $category_specific_filter_id = Config::COLOR_ORIENTATION_TAGS_FILTER_ID;
      }

      if ($cat->slug === "kadkiegeszitok") {
        $smartSliderId = 83;	
      }
      if ($cat->slug === "padlolapok") {
        $smartSliderId = 84;	
      }
      if ($cat->slug === "zuhanykabinok") {
        $smartSliderId = 85;	
      }
      if ($cat->slug === "ribesalbes") {
        $smartSliderId = 86;	
      }
      if ($cat->slug === "el-molino") {
        $smartSliderId = 87;	
      }
      if ($cat->slug === "ascot") {
        $smartSliderId = 88;	
      }
      if ($cat->slug === "dover") {
        $smartSliderId = 89;	
      }
      if ($cat->slug === "manhattan") {
        $smartSliderId = 90;	
      }
      if ($cat->slug === "oxford") {
        $smartSliderId = 91;	
      }
      if ($cat->slug === "park") {
        $smartSliderId = 92;	
      }
      if ($cat->slug === "spiga") {
        $smartSliderId = 93;	
      }
      if ($cat->slug === "stone-ker") {
        $smartSliderId = 94;	
      }
      if ($cat->slug === "csempe") {
        $smartSliderId = 96;	
      }
      if ($cat->slug === "ko-mintas") {
        $smartSliderId = 97;	
      }

      if ($cat->slug === "beige") {
        $smartSliderId = 100;	
      }
      if ($cat->slug === "egyeb") {
        $smartSliderId = 101;	
      }
      if ($cat->slug === "fa-mintas") {
        $smartSliderId = 102;	
      }
      if ($cat->slug === "ko-hatasu") {
        $smartSliderId = 103;	
      }
      if ($cat->slug === "szines") {
        $smartSliderId = 104;	
      }
      if ($cat->slug === "szurke-arnyalatai") {
        $smartSliderId = 105;	
      }
      if ($cat->slug === "furdoszoba-szoba") {
        $smartSliderId = 106;	
      }
      if ($cat->slug === "feher") {
        $smartSliderId = 107;	
      }
      if ($cat->slug === "marvany-hatasu") {
        $smartSliderId = 108;	
      }
      if ($cat->slug === "nappali-szoba") {
        $smartSliderId = 109;	
      }
      if ($cat->slug === "terasz-szoba") {
        $smartSliderId = 110;	
      }
      if ($cat->slug === "notta") {
        $smartSliderId = 110;	
      }
      if ($cat->slug === "safari-porcelanosa") {
        $smartSliderId = 112;	
      }
      if ($cat->slug === "vaker") {
        $smartSliderId = 113;	
      }
      if ($cat->slug === "mondo") {
        $smartSliderId = 114;	
      }
      if ($cat->slug === "fuerta") {
        $smartSliderId = 115;	
      }
      if ($cat->slug === "it-termekcsalad") {
        $smartSliderId = 116;	
      }
      if ($cat->slug === "te-termekcsalad") {
        $smartSliderId = 117;	
      }
      if ($cat->slug === "ek-termekcsalad") {
        $smartSliderId = 118;	
      }
      if ($cat->slug === "allmarble") {
        $smartSliderId = 119;	
      }
      if ($cat->slug === "d-segni-blend") {
        $smartSliderId = 120;	
      }
      if ($cat->slug === "apparel") {
        $smartSliderId = 121;	
      }
      if ($cat->slug === "blend") {
        $smartSliderId = 122;	
      }
      if ($cat->slug === "block") {
        $smartSliderId = 123;	
      }
      if ($cat->slug === "boise") {
        $smartSliderId = 124;	
      }
      if ($cat->slug === "chalk") {
        $smartSliderId = 125;	
      }
      if ($cat->slug === "chroma") {
        $smartSliderId = 126;	
      }
      if ($cat->slug === "clayline") {
        $smartSliderId = 127;	
      }
      if ($cat->slug === "clays") {
        $smartSliderId = 128;	
      }
      if ($cat->slug === "cloud") {
        $smartSliderId = 129;	
      }
      if ($cat->slug === "colorplay") {
        $smartSliderId = 130;	
      }
      if ($cat->slug === "d-segni-blend") {
        $smartSliderId = 131;	
      }
      if ($cat->slug === "eclettica") {
        $smartSliderId = 132;	
      }
      if ($cat->slug === "fabric") {
        $smartSliderId = 133;	
      }
      if ($cat->slug === "fresco") {
        $smartSliderId = 134;	
      }
      if ($cat->slug === "interiors") {
        $smartSliderId = 135;	
      }
      if ($cat->slug === "mystone-basalto") {
        $smartSliderId = 136;	
      }
      if ($cat->slug === "oficina7") {
        $smartSliderId = 137;	
      }
      if ($cat->slug === "pottery") {
        $smartSliderId = 139;	
      }
      if ($cat->slug === "treverkage") {
        $smartSliderId = 140;	
      }
      if ($cat->slug === "treverkcharme") {
        $smartSliderId = 141;	
      }
      if ($cat->slug === "treverkchic") {
        $smartSliderId = 142;	
      }
      if ($cat->slug === "treverkheart") {
        $smartSliderId = 143;	
      }
      if ($cat->slug === "treverkhome") {
        $smartSliderId = 144;	
      }
      if ($cat->slug === "treverkview") {
        $smartSliderId = 145;	
      }
      if ($cat->slug === "visual") {
        $smartSliderId = 146;	
      }
      //
      if ($cat->slug === "cambia") {
        $smartSliderId = 147;	
      }
      if ($cat->slug === "carneval") {
        $smartSliderId = 148;	
      }
      if ($cat->slug === "foggia") {
        $smartSliderId = 149;	
      }
      if ($cat->slug === "color-crush") {
        $smartSliderId = 150;	
      }
      if ($cat->slug === "cosima") {
        $smartSliderId = 151;	
      }
      if ($cat->slug === "love-you-navy-blue") {
        $smartSliderId = 152;	
      }
      if ($cat->slug === "all-in-white") {
        $smartSliderId = 153;	
      }
      if ($cat->slug === "biloba") {
        $smartSliderId = 154;	
      }
      if ($cat->slug === "epoxy") {
        $smartSliderId = 155;	
      }
      if ($cat->slug === "house-of-tones") {
        $smartSliderId = 156;	
      }
      if ($cat->slug === "marmo-doro") {
        $smartSliderId = 157;	
      }
      if ($cat->slug === "palermo") {
        $smartSliderId = 159;	
      }
      if ($cat->slug === "zambezi") {
        $smartSliderId = 160;	
      }
      if ($cat->slug === "zalakeramia") {
        $smartSliderId = 161;	
      }

      if ($cat->slug === Config::TAPS_SLUG) {
        $smartSliderId = 162;
        $category_specific_filter_id = Config::COLOR_STYLE_TAGS_HANDLE_FILTER_ID;
      }
      if ($cat->slug === "asszimetrikus") {
        $smartSliderId = 163;	
      }
      if ($cat->slug === "egyenes") {
        $smartSliderId = 164;	
      }
      if ($cat->slug === "kulonleges") {
        $smartSliderId = 165;	
      }
      if ($cat->slug === "sarok") {
        $smartSliderId = 166;	
      }
      if ($cat->slug === "terben-allo") {
        $smartSliderId = 167;	
      }
      if ($cat->slug === "mosogatok") {
        $smartSliderId = 169;	
      }
      
      if ( strpos($current_path, "mosogatok")) {
        $category_specific_filter_id = Config::COLOR_FORM_MATERIAL_TAGS_FILTER_ID;
      }

      if ($cat->slug === "kludi") {
        $smartSliderId = 171;	
      }
      if ($cat->slug === "zuhanyajto") {
        $smartSliderId = 174;	
      }
      if ($cat->slug === "1926") {
        $smartSliderId = 175;	
      }
      if ($cat->slug === "a-qa") {
        $smartSliderId = 176;	
      }
      if ($cat->slug === "active") {
        $smartSliderId = 177;	
      }
      if ($cat->slug === "amba") {
        $smartSliderId = 178;	
      }
      if ($cat->slug === "ameo") {
        $smartSliderId = 179;	
      }
      if ($cat->slug === "balance") {
        $smartSliderId = 180;	
      }
      if ($cat->slug === "bingo-star") {
        $smartSliderId = 181;	
      }
      if ($cat->slug === "bozz") {
        $smartSliderId = 182;	
      }
      if ($cat->slug === "e-go") {
        $smartSliderId = 183;	
      }
      if ($cat->slug === "e2") {
        $smartSliderId = 185;	
      }
      if ($cat->slug === "fizz") {
        $smartSliderId = 186;	
      }
      if ($cat->slug === "freshline") {
        $smartSliderId = 187;	
      }
      if ($cat->slug === "l-ine") {
        $smartSliderId = 188;	
      }
      if ($cat->slug === "logo") {
        $smartSliderId = 189;	
      }
      if ($cat->slug === "mx") {
        $smartSliderId = 190;	
      }
      if ($cat->slug === "objekta") {
        $smartSliderId = 191;	
      }
      if ($cat->slug === "pure-easy") {
        $smartSliderId = 192;	
      }
      if ($cat->slug === "scope") {
        $smartSliderId = 193;	
      }
      if ($cat->slug === "trendo") {
        $smartSliderId = 194;	
      }
      if ($cat->slug === "zenta") {
        $smartSliderId = 184;	
      }
      if ($cat->slug === "arany") {
        $smartSliderId = 197;	
      }
      if ($cat->slug === "bide-csaptelep") {
        $smartSliderId = 198;	
      }
      if ($cat->slug === "feher-csaptelepek-2") {
        $smartSliderId = 195;	
      }
      if ($cat->slug === "fekete-csaptelepek-2") {
        $smartSliderId = 199;	
      }
      if ($cat->slug === "kad-csaptelep") {
        $smartSliderId = 200;	
      }
      if ($cat->slug === "kezizuhanyok") {
        $smartSliderId = 201;	
      }
      if ($cat->slug === "krom") {
        $smartSliderId = 202;	
      }
      if ($cat->slug === "mosdo-csaptelep") {
        $smartSliderId = 203;	
      }
      if ($cat->slug === "mosogato-csaptelep") {
        $smartSliderId = 204;	
      }
      if ($cat->slug === "zuhany-csaptelep") {
        $smartSliderId = 205;	
      }
      if ($cat->slug === "zuhanyszett") {
        $smartSliderId = 206;	
      }
      if ($cat->slug === "essenza") {
        $smartSliderId = 209;	
      }
      if ($cat->slug === "furo") {
        $smartSliderId = 210;	
      }
      if ($cat->slug === "idea") {
        $smartSliderId = 211;	
      }
      if ($cat->slug === "modo") {
        $smartSliderId = 212;	
      }
      if ($cat->slug === "nes") {
        $smartSliderId = 213;	
      }
      if ($cat->slug === "ako") {
        $smartSliderId = 214;	
      }
      if ($cat->slug === "radaway") {
        $smartSliderId = 215;	
      }
      if ($cat->slug === "marmorin") {
        $smartSliderId = 216;	
      }
      if ($cat->slug === "nero") {
        $smartSliderId = 217;	
      }
      if ($cat->slug === "olwin") {
        $smartSliderId = 218;	
      }
      if ($cat->slug === "laminalt-padlo") {
        $smartSliderId = 219;	
      }
      if ($cat->slug === "egger") {
        $smartSliderId = 220;	
      }
      if ($cat->slug === "bazis") {
        $smartSliderId = 221;	
      }
      if ($cat->slug === "formo") {
        $smartSliderId = 222;	
      }
      if ($cat->slug === "liner") {
        $smartSliderId = 223;	
      }
      if ($cat->slug === "melina") {
        $smartSliderId = 224;	
      }
      if ($cat->slug === "mollis") {
        $smartSliderId = 225;	
      }
      if ($cat->slug === "optic") {
        $smartSliderId = 226;	
      }
      if ($cat->slug === "saval-2-0") {
        $smartSliderId = 227;	
      }
      if ($cat->slug === "alfoldi-markak") {
        $smartSliderId = 228;	
      }
      if ($cat->slug === "csaptelepek") {
        $smartSliderId = 162;	
      }

      if ( strpos($current_path, "csaptelepek")) {
        $category_specific_filter_id = 10595;
      }

      if ($cat->slug === "konyha-szoba") {
        $smartSliderId = 230;	
      }
      if ($cat->slug === "zuhanytalcak") {
        $smartSliderId = 232;	
      }
      if ($cat->slug === "zuhanyfal") {
        $smartSliderId = 233;	
      }

      if ($cat->slug === "bordur") {
        $smartSliderId = 235;	
      }
      if ($cat->slug === "mozaik") {
        $smartSliderId = 236;	
      }
      if ($cat->slug === "konyhai-csaptelep") {
        $smartSliderId = 237;	
      }
      if ($cat->slug === Config::BATHROOM_AUXILIARY_SLUG) {
        $smartSliderId = 238;
      }
      
      if ( strpos($current_path, Config::BATHROOM_AUXILIARY_SLUG)) {
        $category_specific_filter_id = Config::COLOR_STYLE_TAGS_HANDLE_FILTER_ID;
      }


      if ($cat->slug === Config::SANITARY_SLUG) {
        $smartSliderId = 239;	
      }
      
      if ( strpos($current_path, Config::SANITARY_SLUG)) {
        $category_specific_filter_id = Config::FORM_LOCATION_TAGS_FILTER_ID;
      }

      if ($cat->slug === "bide") {
        $smartSliderId = 240;	
      }
      if ($cat->slug === "mosdo") {
        $smartSliderId = 241;	
      }
      if ($cat->slug === "wc") {
        $smartSliderId = 242;	
      }
      if ($cat->slug === "dekor-csempe") {
        $smartSliderId = 243;	
      }

      if ($cat->slug === "mintas") {
        $smartSliderId = 245;	
      }

      if ($cat->slug === "3d-csempe") {
        $smartSliderId = 249;	
      }

      if ($cat->slug === "nowa-gala") {
        $smartSliderId = 251;	
      }
      
      if ($cat->slug === "my-tones") {
        $smartSliderId = 250;	
      }
      
      if ($cat->slug === "royal-place") {
        $smartSliderId = 252;	
      }

      if ($cat->slug === "touch") {
        $smartSliderId = 253;	
      }

      if ($cat->slug === "terraform") {
        $smartSliderId = 254;	
      }

      if ($cat->slug === "blinds") {
        $smartSliderId = 255;	
      }

      if ($cat->slug === "unit-plus") {
        $smartSliderId = 256;	
      }

      if ($cat->slug === "platine-plate") {
        $smartSliderId = 257;	
      }

      if ($cat->slug === "rock-ceramic") {
        $smartSliderId = 258;
      }
      
      if ($cat->slug === "paradyz") {
        $smartSliderId = 259;
      }

      if ($cat->slug === "bliss") {
        $smartSliderId = 260;
      }

      if ($cat->slug === "dream") {
        $smartSliderId = 261;
      }

      if ($cat->slug === "hexagon") {
        $smartSliderId = 262;
      }
      if ($cat->slug === "aulla") {
        $smartSliderId = 269;
      }
      if ($cat->slug === "brainstorm") {
        $smartSliderId = 268;
      }
      if ($cat->slug === "brave") {
        $smartSliderId = 267;
      }
      if ($cat->slug === "coma") {
        $smartSliderId = 266;
      }
      if ($cat->slug === "dots") {
        $smartSliderId = 265;
      }
      if ($cat->slug === "harmonic") {
        $smartSliderId = 264;
      }
      if ($cat->slug === "horizon-tubadzin") {
        $smartSliderId = 263;
      }
      if ($cat->slug === "horizon") {
        $smartSliderId = 270;
      }
      if ($cat->slug === "massa") {
        $smartSliderId = 274;
      }
      if ($cat->slug === "modern-pearl") {
        $smartSliderId = 275;
      }
      if ($cat->slug === "integrally") {
        $smartSliderId = 271;
      }
      if ($cat->slug === "aulla") {
        $smartSliderId = 276;
      }
      if ($cat->slug === "budapest") {
        $smartSliderId = 277;
      }
      if ($cat->slug === "reflection") {
        $smartSliderId = 273;
      }

      if ($cat->slug === "milan") {
        $smartSliderId = 278;
      }

      if ($cat->slug === "vigo-rock-ceramic") {
        $smartSliderId = 279;
      }

      if ($cat->slug === "caligula") {
        $smartSliderId = 281;
      }

      if ($cat->slug === "monza") {
        $smartSliderId = 282;
      }

      if ($cat->slug === "cicero") {
        $smartSliderId = 283;
      }
      if ($cat->slug === "amazonas") {
        $smartSliderId = 284;
      }
      if ($cat->slug === "furdoszobabutorok") {
        $smartSliderId = 285;
      }
      if ($cat->slug === "fly") {
        $smartSliderId = 286;
      }

      if ($cat->slug === "shiny-textile") {
        $smartSliderId = 287;
      }
      if ($cat->slug === "touch-me") {
        $smartSliderId = 291;
      }
      if ($cat->slug === "calvano") {
        $smartSliderId = 290;
      }
      if ($cat->slug === "soft-romantic") {
        $smartSliderId = 289;
      }
      if ($cat->slug === "taku") {
        $smartSliderId = 288;
      }
      if ($cat->slug === "cersanit") {
        $smartSliderId = 292;
      }
      if ($cat->slug === "woodskin") {
        $smartSliderId = 294;
      }
      if ($cat->slug === "lume") {
        $smartSliderId = 295;
      }
      if ($cat->slug === "plain-stone-burkolatok") {
        $smartSliderId = 296;
      }
      if ($cat->slug === "inpoint") {
        $smartSliderId = 297;
      }
      if ($cat->slug === "sfumato") {
        $smartSliderId = 299;
      }
      if ($cat->slug === "serenity") {
        $smartSliderId = 300;
      }
      if ($cat->slug === "pastel") {
        $smartSliderId = 301;
      }
      if ($cat->slug === "esenzia") {
        $smartSliderId = 302;
      }
      if ($cat->slug === "muse-kategoria") {
        $smartSliderId = 303;
      }
      if ($cat->slug === "shine-concrete") {
        $smartSliderId = 304;
      }
      if ($cat->slug === "obsydian") {
        $smartSliderId = 305;
      } 
      if ($cat->slug === "calacatta-rock-ceramic") {
        $smartSliderId = 308;
      }           
      if ($cat->slug === "gante") {
        $smartSliderId = 309;
      }           
      if ($cat->slug === "obsydian") {
        $smartSliderId = 310;
      }           
      if ($cat->slug === "obsydian") {
        $smartSliderId = 305;
      }           
      if ($cat->slug === "obsydian") {
        $smartSliderId = 305;
      } 
      if ($cat->slug === "cement") {
        $smartSliderId = 311;
      }
      if ($cat->slug === "denia") {
        $smartSliderId = 315;
      } 
      if ($cat->slug === "kronos") {
        $smartSliderId = 314;
      } 
      if ($cat->slug === "moody") {
        $smartSliderId = 313;
      } 
      if ($cat->slug === "luxor-csalad") {
        $smartSliderId = 312;
      }
      if ($cat->slug === "organic-matt") {
        $smartSliderId = 316;
      }
      if ($cat->slug === "funky") {
        $smartSliderId = 317;
      }
      if ($cat->slug === "anticatto") {
        $smartSliderId = 326;
      }
      if ($cat->slug === "mainzu") {
        $smartSliderId = 319;
      }
      if ($cat->slug === "aquarel") {
        $smartSliderId = 320;
      }
      if ($cat->slug === "bellagio") {
        $smartSliderId = 321;
      }
      if ($cat->slug === "bumpy") {
        $smartSliderId = 322;
      }
      if ($cat->slug === "cinque-terre") {
        $smartSliderId = 323;
      }
      if ($cat->slug === "estil") {
        $smartSliderId = 324;
      }
      if ($cat->slug === "legno") {
        $smartSliderId = 325;
      }
      if ($cat->slug === "ricordi-venezzia") {
        $smartSliderId = 327;
      }
      if ($cat->slug === "verona") {
        $smartSliderId = 328;
      }
      if ($cat->slug === "vitta") {
        $smartSliderId = 329;
      }
      if ($cat->slug === "goldgreen") {
        $smartSliderId = 330;
      }
      if ($cat->slug === "grunge") {
        $smartSliderId = 331;
      }
      if ($cat->slug === "mosdocsap") {
        $smartSliderId = 332;
      }
      if ($cat->slug === "praga") {
        $smartSliderId = 333;
      }
      if ($cat->slug === "viena") {
        $smartSliderId = 334;
      }
      if ($cat->slug === "white-opal") {
        $smartSliderId = 335;
      }
      if ($cat->slug === "grand-cave") {
        $smartSliderId = 336;
      }
      if ($cat->slug === "regal-stone") {
        $smartSliderId = 337;
      }
      if ($cat->slug === "amber-vein") {
        $smartSliderId = 338;
      }
      if ($cat->slug === "ambra-bianca") {
        $smartSliderId = 339;
      }
      if ($cat->slug === "tin") {
        $smartSliderId = 340;
      }
      if ($cat->slug === "specchio-carrara") {
        $smartSliderId = 341;
      }
      if ($cat->slug === "duke-stone") {
        $smartSliderId = 342;
      }
      if ($cat->slug === "persian-tale") {
        $smartSliderId = 343;
      }
      if ($cat->slug === "torano") {
        $smartSliderId = 344;
      }
      if ($cat->slug === "pietrasanta") {
        $smartSliderId = 345;
      }
      if ($cat->slug === "scoglio-grigio") {
        $smartSliderId = 346;
      }
      if ($cat->slug === "black-pulpis") {
        $smartSliderId = 347;
      }
      if ($cat->slug === "tender-stone") {
        $smartSliderId = 348;
      }
      if ($cat->slug === "masterstone") {
        $smartSliderId = 349;
      }
      if ($cat->slug === "grande-marble-look") {
        $smartSliderId = 355;
      }
      if ($cat->slug === "marquina") {
        $smartSliderId = 356;
      }
      if ($cat->slug === "calacatta-cerrad") {
        $smartSliderId = 357;
      }
      if ($cat->slug === "grande-marble-look") {
        $smartSliderId = 358;
      }
      if ($cat->slug === "iceland") {
        $smartSliderId = 359;
      }
      if ($cat->slug === "gold") {
        $smartSliderId = 360;
      }
      if ($cat->slug === "tholos") {
        $smartSliderId = 361;
      }
      if ($cat->slug === "grand-antique-kategoria") {
        $smartSliderId = 362;
      }
      if ($cat->slug === "linz") {
        $smartSliderId = 363;
      }
      if ($cat->slug === "eter") {
        $smartSliderId = 364;
      }
      if ($cat->slug === "eos") {
        $smartSliderId = 365;
      }
      if ($cat->slug === "aurora") {
        $smartSliderId = 366;
      }
      if ($cat->slug === "adar") {
        $smartSliderId = 367;
      }
      if ($cat->slug === "tinta-tubadzin") {
        $smartSliderId = 368;
      }
      if ($cat->slug === "storm") {
        $smartSliderId = 369;
      }
      if ($cat->slug === "acra") {
        $smartSliderId = 370;
      }
      if ($cat->slug === "powder") {
        $smartSliderId = 371;
      }
      if ($cat->slug === "ares") {
        $smartSliderId = 372;
      }
      if ($cat->slug === "newpark") {
        $smartSliderId = 373;
      }
      if ($cat->slug === "kalksten") {
        $smartSliderId = 374;
      }
      if ($cat->slug === "touche") {
        $smartSliderId = 375;
      }
      if ($cat->slug === "marsa") {
        $smartSliderId = 376;
      }
      if ($cat->slug === "folk") {
        $smartSliderId = 377;
      }
      if ($cat->slug === "carrara") {
        $smartSliderId = 378;
      }
      if ($cat->slug === "midas") {
        $smartSliderId = 380;
      }
      if ($cat->slug === "modico") {
        $smartSliderId = 381;
      }
      if ($cat->slug === "lira") {
        $smartSliderId = 382;
      }
      if ($cat->slug === "epulo") {
        $smartSliderId = 383;
      }
      if ($cat->slug === "crema-natural") {
        $smartSliderId = 384;
      }
      if ($cat->slug === "belite") {
        $smartSliderId = 385;
      }
      if ($cat->slug === "amberwood") {
        $smartSliderId = 386;
      }
      if ($cat->slug === "valls-kategoria") {
        $smartSliderId = 387;
      }
      if ($cat->slug === "colour") {
        $smartSliderId = 388;
      }
      if ($cat->slug === "treverkmore") {
        $smartSliderId = 401;
      }
      if ($cat->slug === "pret-a-porter") {
        $smartSliderId = 402;
      }
      if ($cat->slug === "marble") {
        $smartSliderId = 403;
      }
    }

    return [$smartSliderId, $category_specific_filter_id];
  }
}
