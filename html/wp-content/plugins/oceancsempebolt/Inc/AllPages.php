<?php
namespace Inc;
use Shared\Utils;
use Shared\Config;

class AllPages 
{
  static function init() {
    self::modifyFlatsomeMobileSidebar();
    self::addTelNumbersToNavBar();
    add_action('flatsome_before_footer', function () {
      if(is_front_page()){
        self::echoFrontPageSliders(); 
      }

      if( !(is_shop() || is_product_category()) && is_active_sidebar('shop-sidebar')){
        self::echoShopSidebar();
      }

      self::echoLoader();
      self::echoDesktopHamburgerBtn();
      self::echoSidebarFilters();
      self::echoFakehamburgerbtn();
    });

    add_filter( 'woocommerce_gallery_image_html_attachment_image_params', function($details) {
      $details['alt'] = $details['title'];
      return $details;
    } );
  }

  // This function makes in the mobile sidebar possible to switch between categories and main menu
  // It adds "menu" and the "categories" buttons to it and the categories sidebar widget as well
  protected static function addTelNumbersToNavBar() {
    $options = get_theme_mod( 'header_mobile_elements_right' );
    if (!$options) set_theme_mod('header_mobile_elements_right', ['call-icon', 'cart']);

    $no_call_btn_in_mobile_navbar_enabled = ! in_array('call-icon', $options);
    if($no_call_btn_in_mobile_navbar_enabled) set_theme_mod('header_mobile_elements_right', ['call-icon', 'cart']);

    add_action( 'flatsome_header_elements', function($value) {
      if ($value === 'nav') {
        [ $rand_tel_number ] = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)];
      ?>
        <li class="nav-main-menu-bar-tel-number menu-item menu-item-type-post_type menu-item-object-page menu-item-19796 menu-item-design-default">
          <a href="tel:<?= $rand_tel_number ?>" class="nav-top-link"><i class="icon-phone"></i><?= $rand_tel_number ?></a>
        </li>      
      <?php };

      if ($value === 'call-icon') {
        [ $rand_tel_number ] = Config::TEL_NUMBERS[array_rand(Config::TEL_NUMBERS)];
      ?>
        <li>
          <a href="tel:<?= $rand_tel_number ?>" class="nav-right-call-btn"><i class="icon-phone"></i></a> 
        </li>
        <li class="header-divider"></li>
      <?php };
    });
  }

  protected static function modifyFlatsomeMobileSidebar() {
    $options = get_theme_mods();
    
    $no_menu_and_categories_btns_enabled = ! in_array('menu-and-categories-btn', $options['mobile_sidebar']);
  
    if($no_menu_and_categories_btns_enabled) set_theme_mod('mobile_sidebar', ['search-form', 'menu-and-categories-btns', 'nav']);
    
    add_action( 'flatsome_header_elements', function($value) {
      if ($value === 'menu-and-categories-btns') :
      ?>
        <div id="mobile-sidebar-switch-btns" class="mobile-sidebar-switch-btns">
          <a class="mobile-sidebar-switch-btns__btn">Menü</a>
          <a class="mobile-sidebar-switch-btns__btn">Kategóriák</a>
        </div>        
      <?php endif;
    });

    add_action( 'flatsome_after_sidebar_menu_elements', function() {
      echo '<div class="mobile-sidebar-categories">';
        dynamic_sidebar('shop-sidebar');
      echo '</div>';
    });
  }
  
  protected static function echoShopSidebar() {
    ?>
      <div class="col large-3 hide-for-medium hidden">
        <div id="shop-sidebar" class="sidebar-inner col-inner everywhere">
          <?php dynamic_sidebar('shop-sidebar'); ?>
        </div>
      </div>
    <?php
  }

  protected static function echoFrontPageSliders() {
    $bathTubSliderHtmlText = htmlspecialchars(do_shortcode("[smartslider3 slider=\"82\"]"));
    echo '<div class="bath-tub-slider-text" style="display: none">'.$bathTubSliderHtmlText.'</div>';
    $tilesSliderHtmlText = htmlspecialchars(do_shortcode("[smartslider3 slider=\"247\"]"));
    echo '<div class="tiles-slider-text" style="display: none">'.$tilesSliderHtmlText.'</div>';
  }

  protected static function echoLoader() {
    ?>
      <div class="line-loader"></div>
      <div class="site-block-overlay"></div>
      <div class="loader">
        <h3 class="loader__title">⭐PILLANAT⭐</h3>
	      <div class="loader__circle"></div>
      </div>
    <?php
  }

  protected static function echoDesktopHamburgerBtn() {
    ?>
      <div>
        <a href="#" class="desktop-hamburger-btn" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false"></a>
      </div>
      <div class="home-page-sliders">
    <?php
  }

  protected static function echoSidebarFilters() {
    ?>
      <div class="sidebar-filters">
        <?php 
          global $wp_query;
          $cat = $wp_query->get_queried_object();
          $colors_by_categories = Utils::get_attributes_by_product_categories();
          foreach ($colors_by_categories as $categorySlug => $attrTemplateValues) {
            $isCategoryPage = !empty($cat);
            $isNotCurrentCategory = $isCategoryPage && $categorySlug !== $cat->slug;
            if ($isNotCurrentCategory) {
              echo Utils::get_attribute_filter_icons($categorySlug, $attrTemplateValues, $isNotCurrentCategory);
            }
          }
        ?>
      </div>
    <?php
  }

  protected static function echoFakehamburgerbtn() {
    ?>
      <a href="#" id="fake-hamburger-icon" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false" style="display: none;"></a>
    <?php
  }

}