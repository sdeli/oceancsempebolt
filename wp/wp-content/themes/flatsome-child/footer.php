<?php
/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
?>

</main>

<div class="line-loader"></div>
<div class="site-block-overlay"></div>
<div class="loader">
	<h3 class="loader__title">
				⭐PILLANAT⭐
	</h3>
	<div class="loader__circle"></div>
</div>
<footer id="footer" class="footer-wrapper">

	<?php do_action('flatsome_footer'); ?>

</footer>
<div class="sidebar-filters">
  <?php 
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $colors_by_categories = get_attributes_by_product_categories();
    foreach ($colors_by_categories as $categorySlug => $attrTemplateValues) {
      $isNotCurrentCategory = $categorySlug !== $cat->slug;
      if ($isNotCurrentCategory) {
        echo get_attribute_filter_icons($categorySlug, $attrTemplateValues, $isNotCurrentCategory);
      }
    }
  ?>
</div>

<?php
  if(is_front_page()){
    $bathTubSliderHtmlText = htmlspecialchars(do_shortcode("[smartslider3 slider=\"82\"]"));
    echo '<div class="bath-tub-slider-text" style="display: none">'.$bathTubSliderHtmlText.'</div>';
    $tilesSliderHtmlText = htmlspecialchars(do_shortcode("[smartslider3 slider=\"247\"]"));
    echo '<div class="tiles-slider-text" style="display: none">'.$tilesSliderHtmlText.'</div>';
  }
 ?>

<?php
  if( !(is_shop() || is_product_category()) && is_active_sidebar('shop-sidebar')){?>
    <div class="col large-3 hide-for-medium hidden">
      <div id="shop-sidebar" class="sidebar-inner col-inner everywhere">

        <?php dynamic_sidebar('shop-sidebar'); ?>

    </div>
  </div>
<?php }?>

<?php wp_footer(); ?>

<div>
  <a href="#" class="desktop-hamburger-btn" data-open="#main-menu" data-pos="left" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false"></a>
</div>
<div class="home-page-sliders">

</div>
<script type="text/javascript">
  const CHECKED_SELECTOR = '--checked';
  const COLOR_FILTER_ICONS_SELECTOR = 'filter-form__szin';
  const SHOP_SIDEBAR_SWITCH_BTNS_SELECTOR = '#shop-sidebar-switch-btns';
  const MOBILE_SIDEBAR_CONTAINER_SELECTOR = '.mfp-content';
  const SHOP_SIDEBAR_MENU_SELECTOR = '#shop-sidebar';
  const SHOP_SIDEBAR_MENU_SHELTER_SELECTOR = '.col.large-3.hide-for-medium';
  const MAIN_SIDEBAR_MENU_SELECTOR = '#main-menu';
  const MAIN_MENU_SWITCH_TITLE = 'main-menu-switch-btn';
  const SHOP_MENU_SWITCH_TITLE = 'shop-menu-switch-btn';
  const CLICKABLE_SELECTOR = '--clickable';
  const CLONE_MENU_SELECTOR = '--clone';
  const MOBILE_SIDEBAR_CANCEL_OVERLAY = '.mfp-container.mfp-s-ready.mfp-inline-holder';
  const MOBILE_SIDEBAR_CANCEL_BTN = '.mfp-close';
  const PARALLAX_HEADER_SELECTOR = '.identity-header__background';
  const HAMBURGER_BTN_SELECTOR = '[aria-controls="main-menu"]';
  const FILTER_BTN_SELECTOR = '.filter-btn';  
  const BR_ROCKET_COLOR_ICON_SELECTOR = ".filter-form__szin [aria-label]";
  const MAIN_SHOP_PAGE_SLUG = 'shop';
  const DESKTOP_MENU_TRIGGER_CLASS = 'desktop-hamburger-btn';
  const PRODUCT_CATEGORIES_MENU_BAR_BTN_SELECTOR = '#menu-item-4854';
  const GOOGLE_MAPS_CONATINER_SELECTOR = '.lazy-load-google-maps-until-user-interaction';
  const OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR = `#ocean-promo-video-container`;
  const CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR = `#contec-bull-promo-video-1-container`;
  const CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR = `#contec-bull-promo-video-2-container`;
  const TABBER_CONTAINER_SELECTOR = ".tabber-container";
  const FIRST_SLIDER_TITLE_LINK_SELECTOR = '[data-first] .slider-title a.n2-ow';
  const ACTIVE_SLIDER_TITLE_LINK_SELECTOR = '.n2-ss-slide-active .slider-title a.n2-ow';
  const SMART_SLIDER_SELECTOR = '[data-ssid]';
  const SMART_SLIDER_ARROWS_SELECTOR = '.nextend-arrow';
  const POINTER_ICON_CLASS_NAME = 'icon-pointer';
  const POINTER_ICON_SELECTOR = '.' + POINTER_ICON_CLASS_NAME;
  const PLACEHOLDER_CATEGORY_SELECTOR = ['.cat-item-3724'];
  const BATH_TUB_SLIDER_SELECTOR = ['[data-ssid="82"]'];
  const DESIGN_SLIDER_CONTAINER_SELECTOR = '.design-slider-container';
  const DESIGN_SLIDER_PLACEHOLDER_SELECTOR = '.design-slider-container__placeholder';
  const BATH_TUB_SLIDER_HOMEPAGE_CONTAINER = '.home-page-kadak-slider-container';
  const BATH_TUB_SLIDER_TEXT_SELECTOR = '.bath-tub-slider-text';
  const TILES_SLIDER_HOMEPAGE_CONTAINER = '.home-page-burkolatok-slider-container';
  const TILES_SLIDER_TEXT_SELECTOR = '.tiles-slider-text';
  const TILE_PRODUCT_CARDS_CONTAINER = '.home-tiles-container';
  const MOBILE_MENU_BAR_SELECTOR = '.header-wrapper';
  const STICKY_MOBILE_MENU_BAR_CLASS_NAME = 'stuck';
  const STICKY_MOBILE_MENU_BAR_SELECTOR = '.' + STICKY_MOBILE_MENU_BAR_CLASS_NAME;
  const MOBILE_MENU_BAR_ARROW_SELECTOR = '.mobile-menu-arrow-up-down-box__arrow';
  const MOBILE_MENU_BAR_INVISIBLE_CLASS_NAME = 'nav-invisible';
  const MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR = '--rotated';
  const DESIGN_SLIDER_LOADER_SELECTOR = '.n2-padding ss3-loader';
  const BIG_PHONE_CALL_ICON_SELECTOR = '.big-phone-call-icon';
  const GOOGLE_MAPS_THIN_IMAGE_SELECTOR = '.google-maps-thin-image';
  const PHONE_CALL_NUMBER_LINK = '.phone-call-number-link';
  const OCEAN_PHONE_CALL_LINK_CLASS = 'ocean-phone-call';
  
  const GTM_SLIDER_INTERACTION_TRIGGER_NAME = 'interacted with slider';
  const GA_VIEW_CART_EVENT_NAME = 'view_cart';
  const GA_MACHINE_RENT_CALL_EVENT_NAME = 'contact - call - machine rent';

  const IS_SLIDER_LOADED_INTERVAL_TIMER = 200;
  const SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT = 1000;
  const CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR = '.contact-us-inline-infos';
  const RANDOM_PHONE_BTNS_SELECTOR = '.random-phone-number-btn';
  const RANDOM_PHONE_BTN_CTA_CLASS = 'default-text--';

  const CATEGORIES_WITH_FILTERS_DATA = [
    {
      sidebarFilterClass: '.cat-item-2221',
      slug: "burkolatok",
    },
    {
      sidebarFilterClass: '.cat-item-644',
      slug: "furdoszoba-kiegeszitok",
    },
    {
      sidebarFilterClass: '.cat-item-2232',
      slug: "csaptelepek",
    },
    {
      sidebarFilterClass: '.cat-item-2234',
      slug: "kadak",
    },
    {
      sidebarFilterClass: '.cat-item-2245',
      slug: "mosogatok",
    },
    {
      sidebarFilterClass: '.cat-item-2246',
      slug: "szaniterek",
    },
    {
      sidebarFilterClass: '.cat-item-1258',
      slug: "zuhanyfal",
    },
    {
      sidebarFilterClass: '.cat-item-2250',
      slug: "zuhanykabinok",
    },
    {
      sidebarFilterClass: '.cat-item-2251',
      slug: "zuhanytalcak",
    },
  ];
  const CATEGORIES_SIDEBAR_HEADER_HTML = `<div id="shop-sidebar-switch-btns" class="main-menu__filter-btns"><h3 class="main-menu__filter-btns__btn --header" title="shop-menu-switch-btn">Kategóriák</h3></div>`;
  const UNNEEDED_FILTERS = `
[aria-label="01 safari"], [aria-label="02 black"], [aria-label="03 gray"], [aria-label="06 white"], 
[aria-label="07 sand"], [aria-label="10 steel metal"], [aria-label="12 black metal"], 
[aria-label="16 white alabaster"], [aria-label="24 warm gray"], [aria-label="26 traupe gray"], 
[aria-label="metál fekete"], [aria-label="traupe szürke"], [aria-label="safari"], 
[aria-label="metál fekete"], [aria-label="meleg szürke"], [aria-label="matt fekete"], [aria-label="matt fehér"], 
[aria-label="fehér LCC bevonattal"], [aria-label="fehér alabaszter"], [aria-label="homok"], 
[aria-label="acél metál"], [aria-label="antracit"], [aria-label="ezüst"], [aria-label="betonszürke"], 
[aria-label="kék"], [aria-label="betonszürke"], [data-name="gyümölcsmosóval"], [data-name="csepegtetővel"],
[data-name="vandálbiztos"], [data-name="walk-in"], [data-name="szimmetrikus"], [data-name="aszimmetrikus"], 
[aria-label="lila"], [aria-label="narancssárga"], [aria-label="piros"], [aria-label="grafit shine"], [aria-label="fehér alabaszter"],
[aria-label="fehér LCC bevonattal"], [aria-label="acél metál"], [aria-label="homok"], [aria-label="grafit"],
[data-name="állatkísérlet mentes"], [data-name="antibakteriális"], [data-name="boltban megtekinthető"], [data-name="energizáló"],
[data-name="feszesítő"], [data-name="frissítő"], [data-name="gyümölcsös"], [data-name="hidratáló"], [data-name="karcsúsító"],
[data-name="kézzel készített"], [data-name="Legszebb burkolatok"], [data-name="luxus"], [data-name="nagyméretű burkolat"], 
[data-name="olcsó burkolat"], [data-name="öregedésgátló"], [data-name="pároknak"], [data-name="romantikus"],
[data-name="soft close"], [data-name="tapadókorongos"], [data-name="tartósan alacsony árú"], [data-name="vegán"],
[aria-label="rózsaszín"], [aria-label="sárga"]
`;
  const GOOGLE_MAPS_IFRAME_HTML = `<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2695.1075531929037!2d19.169408815890215!3d47.507296602825434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c492289b176f%3A0x26d8f58d84c3afa9!2zw5NjZcOhbiBGw7xyZMWRc3pvYmEgc3phbG9u!5e0!3m2!1sen!2shu!4v1636496472824!5m2!1sen!2shu" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
  const GOOGLE_MAPS_THIN_IFRAME_CLASS = 'google-maps-thin-iframe';
  const GOOGLE_MAPS_THIN_IFRAME_HTML = `<iframe class="${GOOGLE_MAPS_THIN_IFRAME_CLASS}" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2695.1075531929037!2d19.169408815890215!3d47.507296602825434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c492289b176f%3A0x26d8f58d84c3afa9!2zw5NjZcOhbiBGw7xyZMWRc3pvYmEgc3phbG9u!5e0!3m2!1sen!2shu!4v1636496472824!5m2!1sen!2shu" width="100%" height="200" style="border:0;" allowfullscreen=""></iframe>`;
  const OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML = `<iframe src="https://www.youtube.com/embed/HieK5jUu8Jc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
  const CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/w3AUeYOrx2A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
  const CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/HRd9bETXuRI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
  const POINTER_ICON_HTML = `<span class="${POINTER_ICON_CLASS_NAME} slider-pointer-icon"></span>`;
  const MOBILE_MENU_UP_DOWN_ARROW_BOX_HTML = '<div class="mobile-menu-arrow-up-down-box"><i class="icon-angle-up mobile-menu-arrow-up-down-box__arrow"></i></div>';
  const CONTACT_US_INLINE_INFOS_HTML = `
    <strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>: 
    <i class="icon-phone" style="color: black;"></i> 
    <a href="tel:06-30-397-4150" style="cursor: pointer; color: #4e657b">06 30 397 4150 - Szabó István</a><br>
    <a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975" style="cursor: pointer; color: #4e657b" target="_blank">
      Térkép a bolthoz
    <i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>
    </a>
  ` 

  const PARALLAX_HEADER_SMALL_TABLET_Y_POSITION = -440;
  const PARALLAX_HEADER_LARGE_TABLET_Y_POSITION = -428;
  const PARALLAX_SPEED = 0.2;
  const SMALL_TABLET_WIDTH = 849;
  const MOBILE_MAX_WIDTH = 499;
  const DESIGN_SLIDER_MOBILE_HEIGHT = 238;

  const CONTACTS_PAGE_PATH = '/kapcsolat/';
  const SALOON_PAGE_PATH = '/szalon/';
  const DISCOUNTS_DISCLAIMER_PAGE_PATH = '/akciok/';
  const CART_PAGE_PATH = '/cart/';
  const MACHINE_RENT_PAGE_PATH = '/gep-kolcsonzes/';

  const CONTACT_INFOS = [
    {
      tel: "06 70 942 5095",
      name: "Pinti István",
    },
    {
      tel: "06 30 397 4150",
      name: "Szabó István",
    },
    {
      tel: "06 70 601 4600",
      name: "Illés László",
    },
  ];

const IS_CONTACT_INFO_INLINE_DATA_ATTR = 'data-inline';

 const SERVICE_PAGE_ID = "20391";

  let isMenuSwitchFinised = true;
  window.addEventListener('DOMContentLoaded',async function(){
    openSidebar();
    filterItemsOnClick();
    moveFiltersToCategSidebar();
    sidebarFilterLinksOnClick();
    jQuery(PRODUCT_CATEGORIES_MENU_BAR_BTN_SELECTOR).click(() => clickDesktopHamburgerToOpenSidebar());
    setTimeout(() => {slideUpAndDownMobileMenuBar()}, 0)

    const isHomePage = document.querySelector('.home');
    if (isHomePage) {
      adjustProductImageHeightOnRectangle();
      scrollToDesginTabber();
      scrollToContacts();
      loadElementOnUserInteractionAndInViewport(GOOGLE_MAPS_IFRAME_HTML, GOOGLE_MAPS_CONATINER_SELECTOR);
      loadElementOnUserInteractionAndInViewport(OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML, OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR);
      const tilesSliderHtml = jQuery(TILES_SLIDER_TEXT_SELECTOR).text()
      loadElementOnUserInteractionAndInViewport(tilesSliderHtml, TILES_SLIDER_HOMEPAGE_CONTAINER);
      const bathtubSliderHtml = jQuery(BATH_TUB_SLIDER_TEXT_SELECTOR).text()
      loadElementOnUserInteractionAndInViewport(bathtubSliderHtml, BATH_TUB_SLIDER_HOMEPAGE_CONTAINER);
    }

    const isContactPage = window.location.pathname === CONTACTS_PAGE_PATH;
    if (isContactPage) {
      loadElementOnUserInteractionAndInViewport(GOOGLE_MAPS_IFRAME_HTML, GOOGLE_MAPS_CONATINER_SELECTOR);
      loadElementOnUserInteractionAndInViewport(OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML, OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR)
    }

    const isSaloonPage = window.location.pathname === SALOON_PAGE_PATH;
    if (isSaloonPage) {
      loadPageTopGoogleMaps();
    }

    const isDiscountsDisclaimerPage = window.location.pathname === DISCOUNTS_DISCLAIMER_PAGE_PATH;
    if (isDiscountsDisclaimerPage) {
      loadElementOnUserInteractionAndInViewport(GOOGLE_MAPS_IFRAME_HTML, GOOGLE_MAPS_CONATINER_SELECTOR);
    }

    if (isShopOrCategPage()) {
      revealDesignSliderPlaceholder()
      swapDesignPlaceholderToSlider()
      addToCartBtnsOnClick();
      addNamesToBeRocketColorIcons();
      parallaxShopHeader();
      
      const isSubCategoryPage = jQuery('h1.shop-page-title').text() !== 'Shop';
      if (isSubCategoryPage) {
        openCurrentCategoryInSidebar()
      }

      const isMainShopPage = jQuery('h1.shop-page-title').text() === 'Shop';
      if (isMainShopPage) removeUnneededFiltersFromMainShopPage();
      
      const productCategId = window.location.pathname.replace(/\//g, '');
      const isSidebarSubCateogry = CATEGORIES_WITH_FILTERS_DATA.find((filterData) => filterData.slug === productCategId);
      if (isSidebarSubCateogry) {
        addAttributeFilterIconsToCurrentCategory();
      }
    }
    
    const hasProductCards = !!document.querySelectorAll('.product-small.box');
    if (hasProductCards) {
      resizeProductCardTitlesForElliplsis();
      addBasketIconToAddBtns();
      adjustProductImageHeightOnRectangle();
    }

    const isProductPage = !!document.querySelector('.single-product');
    if (isProductPage) {
      clickVariationSwatchIfOneOptionLeft();

      const breadCrumbs = document.querySelector('.woocommerce-breadcrumb.breadcrumbs');
      const categoriesOfProduct = jQuery('.product_meta .posted_in').text();
      const isTilePorductPage = categoriesOfProduct.includes('Burkolatok') && !categoriesOfProduct.includes('dekor csempe') && !categoriesOfProduct.includes('lisztello');
      if (isTilePorductPage) {
        squareMeterCounter();
        setTileUnit()
        swapBoxAndSquarMetersPrice();
      }; 
    }

    const isServicePage = document.querySelector(`.page-id-${SERVICE_PAGE_ID}`);
    if (isServicePage) {
      loadElementOnUserInteractionAndInViewport(GOOGLE_MAPS_IFRAME_HTML, GOOGLE_MAPS_CONATINER_SELECTOR);
    }

    const bigPhoneCallIcons = document.querySelectorAll(BIG_PHONE_CALL_ICON_SELECTOR);
    const hasPhoneCallIconsOnPage = !!bigPhoneCallIcons.length;
    if (hasPhoneCallIconsOnPage) initiateCallOnPhoneCallIconClick(bigPhoneCallIcons);

    const isCartPage = window.location.pathname === CART_PAGE_PATH;
    if (isCartPage) sendViewCartEvent();

    const inlineContactInfoElems = document.querySelectorAll(CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR);
    const hasInlineContactInfosOnPage = !!inlineContactInfoElems.length;
    if (hasInlineContactInfosOnPage) displayInlineContactInfos(inlineContactInfoElems);
    
    const randomPhoneNumberBtns = document.querySelectorAll(RANDOM_PHONE_BTNS_SELECTOR);
    const hasRandomPhoneNumberBtns = !!inlineContactInfoElems.length;
    if (hasRandomPhoneNumberBtns) fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtns);

    const isMachineRentPage = window.location.pathname === MACHINE_RENT_PAGE_PATH;
    if (isMachineRentPage) {
      loadElementOnUserInteractionAndInViewport(CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML, CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR);
      loadElementOnUserInteractionAndInViewport(CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML, CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR);
      loadElementOnUserInteractionAndInViewport(OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML, OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR);
    }
  },false);

  function scrollToDesginTabber() {
    const win = jQuery(window);
    const scrollToDesignTabberBtns = jQuery('.scroll-to-design-tabber');
    scrollToDesignTabberBtns.click(() => {
      win.scrollTo('.design-tabber', 1000);
    })
  }

  function scrollToContacts() {
    const win = jQuery(window);
    const scrollToDesignTabberBtns = jQuery('.scroll-to-contacts');
    scrollToDesignTabberBtns.click(() => {
      win.scrollTo('.contact', 1000);
    })
  }

  function isShopOrCategPage() {
    return  !!document.querySelector('.woocommerce.archive') || !!document.querySelector('.woocommerce-shop');

  }

  function openCurrentCategoryInSidebar() {
    setTimeout(() => {
      document.querySelector(".product-categories li.active").setAttribute("aria-expanded", true);
    }, 0);
  }

  function addAttributeFilterIconsToCurrentCategory() {
    const allFilterItems = Array.from(document.querySelectorAll('.filter-form li'));
    const productCategId = window.location.pathname.replace(/\//g, '');

    const { filters } = getQueryParams();
    sidebarFilterHtml = `<li id="${productCategId}" class=\"sidebar-filter --col-md-display-none cat-item cat-item-1458\"><ul>`;

    allFilterItems.map((filterItem, i) => {
      const isColorFilterIcon = filterItem.parentElement.parentElement.parentElement.className.includes(COLOR_FILTER_ICONS_SELECTOR);
      if (isColorFilterIcon) {
        sidebarFilterHtml += getFilterIconHtml(productCategId, filterItem);
      } else {
        sidebarFilterHtml += getFilterIconHtml(productCategId, filterItem, isColorFilterIcon);
      }
    })

    sidebarFilterHtml += '</ul></li>';
    const {sidebarFilterClass: currentCategorySidebarClass} = getCategoryData(productCategId);
    const currCategory = jQuery(`${currentCategorySidebarClass} > ul`);
    const currentCategSidebarFilters = jQuery(sidebarFilterHtml);
    currCategory.append(currentCategSidebarFilters);
  }

  function getFilterIconHtml(productCategId, filterItem, isCircleShape = true) {
    const filterId = filterItem.children[0].value;
    const href = `javascript:activateColorFilter('${productCategId}', ${filterId})`;
    const displayName = filterItem.children[1].getAttribute('aria-label') || filterItem.children[1].innerText;
    const isCheckedClass = filterItem.className.includes('checked') ? CHECKED_SELECTOR : '';
    let filterIconHtml = '';
    
    if (isCircleShape) {
      filterIconHtml = 
        `<li class=\"sidebar-filter__circle ${isCheckedClass} sidebar__filter-${filterId}" title="${displayName.trim()}">`
          + `<a href=\"${href}\">${displayName}</a>`
          // + `<label>${displayName}</label>`
        + "</li>";
    } else {
      filterIconHtml = 
        `<li class=\"sidebar-filter__tag ${isCheckedClass} sidebar__filter-${filterId}"\">`
          + `<a href=\"${href}\">${displayName}</a>`
        + "</li>";
    }

    return filterIconHtml;
  }

  function getTagIcon(productCategId, filterItem) {
    const filterId = filterItem.children[0].value;
    const displayName = filterItem.children[1].getAttribute('aria-label') || filterItem.children[1].innerText;
    const href = `javascript:activateColorFilter('${productCategId}', ${filterId})`;
    const isCheckedClass = filterItem.className.includes('checked') ? CHECKED_SELECTOR : '';
    
    return ''
    + `<li class=\"sidebar-filter__tag ${isCheckedClass} sidebar__filter-${filterId}"\">`
      + `<a href=\"${href}\"></a>`
    + "</li>";
  }


  function filterItemsOnClick() {
    const allFilterItems = Array.from(document.querySelectorAll('.filter-form li label'));
    allFilterItems.forEach((filterItem) => {
      filterItem.addEventListener('click', function(e) {
        filterItem.parentElement.classList.toggle('checked');
        const isFilterItemActive = filterItem.parentElement.className.includes('checked');
        const filterItemId = filterItem.parentElement.children[0].value;
        const productCategId = window.location.pathname.replace(/\//g, '');
        const isMainShopPage = productCategId === MAIN_SHOP_PAGE_SLUG;

        if (isMainShopPage) {
          activateLoader();
          return;
        } 

        const sidebarFilterItem = document.querySelector(`#${productCategId} .sidebar__filter-${filterItemId}`);
        const isSidebarFilterItemActive = sidebarFilterItem.className.includes('--checked');

        if (isFilterItemActive !== isSidebarFilterItemActive) {
          sidebarFilterItem.classList.toggle('--checked');
        }

        activateLoader();
      })
    })
  }

  function activateLoader() {
    document.querySelector('.loader').style.display = 'block';
  }

  function activateColorFilter(productCategId, colorFilterId) {
    const clickedSidebarCircle = document.querySelector(`#${productCategId} .sidebar__filter-${colorFilterId}`);
    clickedSidebarCircle.classList.toggle("--checked");
    document.querySelector(`input[value="${colorFilterId}"]`).parentElement.children[1].click();
  }
  
  function activateAttributeFilter(productCategId, attributeFilterId) {
    const clickedSidebarAttribute = document.querySelector(`#${productCategId} .sidebar__filter-${attributeFilterId}`);
    clickedSidebarAttribute.classList.toggle("--checked");

    const tagFilterIcon = document.querySelector(`li [value="${attributeFilterId}"]`);
    tagFilterIcon.classList.toggle("--checked");
    tagFilterIcon.parentElement.children[1].click();
  }
  
  function moveFiltersToCategSidebar() {
    CATEGORIES_WITH_FILTERS_DATA.forEach(categorieData => {
      const currCategory = document.querySelector(`${categorieData.sidebarFilterClass} ul`);
      if (!currCategory) return;

      const currCategsFilterElem = document.querySelector(`.sidebar-filter--${categorieData.slug}`);
      if (!currCategsFilterElem) return;
      currCategory.appendChild(currCategsFilterElem);
    });
  }

  function sidebarFilterLinksOnClick() {
    const sidebarFilterLinks = Array.from(document.querySelectorAll('.sidebar-filter__link'));

    sidebarFilterLinks.forEach((filterLink) => {
      filterLink.addEventListener('click', function() {
        this.classList.toggle('--checked');
        activateLoader();
      });
    });
  }

  function getQueryParams() {
    const urlSearchParams = new URLSearchParams(window.location.search);
    return Object.fromEntries(urlSearchParams.entries());
  }

  function getCategoryData(currentCategory) {
    return CATEGORIES_WITH_FILTERS_DATA.find((categoryData) => categoryData.slug === currentCategory)
  }

  function addBasketIconToAddBtns() {
    const basketIconHtml = '<i class="icon-shopping-basket"></i>';
    const addToCartBtns = jQuery('#main .add-to-cart-button a');

    addToCartBtns.each(function() {
      jQuery(this).append(jQuery(basketIconHtml));
    });
  }

  function adjustProductImageHeightOnRectangle() {
    const productImageContainerClass = '.product-small .box-image';

    const nonSquareImageBoxes = jQuery(productImageContainerClass).filter(function(i) {
      const imageBoxWidth = parseInt(jQuery(this).width(), 10);
      const imageBoxHeight = parseInt(jQuery(this).height(), 10);
      return imageBoxWidth !== imageBoxHeight;
    });

    nonSquareImageBoxes.each(function () {
      const imageBox = jQuery(this);
      imageBox.height(imageBox.width());
      const image = imageBox.find('img').eq(0);
      const fuck = image.addClass('non-square');
    });

    jQuery( window ).resize(function() {
      nonSquareImageBoxes.each(function () {
        const imageBox = jQuery(this);
        imageBox.height(imageBox.width());
      });
    });
  }

  function adjustBackToTopBtnVisibility() {
    const isOverFooterClass = 'is-over-footer';
    const footerClass = 'footer';
    const backToTopBtnClass = '.back-to-top';
    const backToTopBtn = jQuery(backToTopBtnClass);
    const footer$ = jQuery(footerClass);
    const document$ = jQuery(document);

    const adjust = () => {
      const wasOverFooter = backToTopBtn.hasClass(isOverFooterClass);

      const currentScrollTop = document$.scrollTop()
      const { top: btnTop } = backToTopBtn.position();
      const btnHeight = backToTopBtn.height();
      const { top: footerTop } = footer$.position();

      const backToTopBtnBottomPos = currentScrollTop + btnTop + (btnHeight * 0.7);
      const isOverFooter = (currentScrollTop + btnTop + (btnHeight * 0.7)) > footerTop

      const justCrossedFooterFromTop = isOverFooter && !wasOverFooter;
      if (justCrossedFooterFromTop) {
        backToTopBtn.addClass(isOverFooterClass)
      }
      
      const justLeftFooterToTop = wasOverFooter && !isOverFooter;
      if (justLeftFooterToTop) {
        backToTopBtn.removeClass(isOverFooterClass)
      }
    }

    adjust();
    jQuery(window).scroll(adjust);
  }

  function addToCartBtnsOnClick() {
    const addToCartButtonsClass = '.add_to_cart_button';
    const addedToCartButtonClass = '.added_to_cart';

    const addToCartBtns = jQuery(addToCartButtonsClass);
    addToCartBtns.click(function() {
      const clickedAddToCartBtn = jQuery(this);

      var addToCartBtnInDom = setInterval(function() {
        if (jQuery(addedToCartButtonClass).length) {
          clearInterval(addToCartBtnInDom);
          const newAddedToCartBtn = clickedAddToCartBtn.siblings(addedToCartButtonClass);
          newAddedToCartBtn.text('Kosárhoz');
        }
      }, 100);
    })
  }

  function resizeProductCardTitlesForElliplsis() {
    var productCardTitlesClass = '.product-small.box .title-wrapper .product-title a';
    var productTitleContainerCss = '.product-small.box .name.product-title';
    var productCardTitles = jQuery(productCardTitlesClass);

    var currentMaxWidth = jQuery(productTitleContainerCss).width();
    productCardTitles.css('max-width', currentMaxWidth);

    jQuery(window).resize(() => {
      var currentMaxWidth = jQuery(productTitleContainerCss).width();
      productCardTitles.css('max-width', currentMaxWidth);
    })
  }

  function clickHamburgerToOpenMobileSidebar() {
    const hamburgerBtn = jQuery(HAMBURGER_BTN_SELECTOR);
    hamburgerBtn.click();
  }

  function clickDesktopHamburgerToOpenSidebar() {
    const desktopSidebarMenuTrigger = jQuery('.' + DESKTOP_MENU_TRIGGER_CLASS);
    desktopSidebarMenuTrigger.click();
  }
  
  function openSidebar() {
    const hamburgerBtn = jQuery(HAMBURGER_BTN_SELECTOR);
    const filterMenuBtn = jQuery(FILTER_BTN_SELECTOR);

    hamburgerBtn.click(function() {
      setTimeout(() => {
        const isDesktopProductCategsBtnClicked = jQuery(this).hasClass(DESKTOP_MENU_TRIGGER_CLASS);
        if (isDesktopProductCategsBtnClicked) {
          createShopMenu(null, isDesktopProductCategsBtnClicked);
        } else {
          insertShopMenuSwitchBtnsIntoMobileSidebar();
        }
      }, 0);
    });
    
    filterMenuBtn.click(() => {
      setTimeout(() => {
        createShopMenu(null, false);
      }, 0);
    });
  }

  function createShopMenu(e, isDesktopMenu = false) {
    if (e) e.stopPropagation();
    if (!isMenuSwitchFinised) return;

    const isOnShopMenuAlready = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`).length;
    if (isOnShopMenuAlready) return;
    isMenuSwitchFinised = false;

    const mobileSidebarContainer = jQuery(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    const mainMenu = jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`);
    const shopMenu = jQuery(SHOP_SIDEBAR_MENU_SELECTOR);
    const shopMenuBtn = jQuery(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
    const mainMenuBtn = jQuery(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);

    if (isDesktopMenu) {
      insertDesktopSidebarHeader();
    } else {
      insertMainMenuSwitchBtnsIntoMobileSidebar();
    }

    mainMenu.appendTo('body')
    mainMenu.show();
    shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    isMenuSwitchFinised = true;
  }

  function insertShopMenuSwitchBtnsIntoMobileSidebar() {
    const shopSideBarSwitchBtns = getMobileMenuSwitchIcons(true);
    const hasMainMenuInSidebar = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`).length;
    shopSideBarSwitchBtns.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);

    if (!hasMainMenuInSidebar) {
      const mainMenu = jQuery(MAIN_SIDEBAR_MENU_SELECTOR);
      mainMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    }
    preventCloseOnMenuClick();
    resetSidebarContentOnClose();
  }

  function insertMainMenuSwitchBtnsIntoMobileSidebar() {
    const shopSideBarSwitchBtns = getMobileMenuSwitchIcons(false);
    const hasShopMenuInSidebar = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`).length;
    shopSideBarSwitchBtns.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);

    if (!hasShopMenuInSidebar) {
      const shopMenu = jQuery(SHOP_SIDEBAR_MENU_SELECTOR);
      shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    }
    preventCloseOnMenuClick();
    resetSidebarContentOnClose();
  }

  function insertDesktopSidebarHeader() {
    const categoriesSidebarHeader = jQuery(CATEGORIES_SIDEBAR_HEADER_HTML);
    categoriesSidebarHeader.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    
    const hasMainMenuInSidebar = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`).length;
    if (!hasMainMenuInSidebar) {
      const mainMenu = jQuery(MAIN_SIDEBAR_MENU_SELECTOR);
      mainMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    }
    preventCloseOnMenuClick();
    resetSidebarContentOnClose();
  }

  function switchToMainMenu(e) {
    e.stopPropagation();
    if (!isMenuSwitchFinised) return;
    
    const isOnMainMenuAlready = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`).length;
    if (isOnMainMenuAlready) return;
    isMenuSwitchFinised = false;
    
    const mainMenu = jQuery(MAIN_SIDEBAR_MENU_SELECTOR);
    const mobileSidebarContainer = jQuery(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    const shopMenu = jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`);
    const shopMenuBtn = jQuery(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
    const mainMenuBtn = jQuery(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);
    
    shopMenu.fadeOut(() => {
      shopMenu.appendTo(SHOP_SIDEBAR_MENU_SHELTER_SELECTOR);
      shopMenu.show();

      mainMenu.removeClass('mfp-hide').appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
      isMenuSwitchFinised = true;
    });
    
    shopMenuBtn.toggleClass(CLICKABLE_SELECTOR);
    mainMenuBtn.toggleClass(CLICKABLE_SELECTOR);
  }
  
  function switchToShopMenu(e) {
    if (e) e.stopPropagation();
    if (!isMenuSwitchFinised) return;
    
    const isOnShopMenuAlready = !!jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`).length;
    if (isOnShopMenuAlready) return;
    isMenuSwitchFinised = false;

    const mobileSidebarContainer = jQuery(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    const mainMenu = jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`);
    const shopMenu = jQuery(SHOP_SIDEBAR_MENU_SELECTOR);
    const shopMenuBtn = jQuery(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
    const mainMenuBtn = jQuery(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);

    mainMenu.fadeOut(() => {
      mainMenu.appendTo('body')
      mainMenu.show();
      shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
      isMenuSwitchFinised = true;
    });

    shopMenuBtn.toggleClass(CLICKABLE_SELECTOR);
    mainMenuBtn.toggleClass(CLICKABLE_SELECTOR);
  }

  function getMobileMenuSwitchIcons(isForMainMenu = true) {
    const mobileMenuSwitchBtnHtml = '' + 
    '<div id="shop-sidebar-switch-btns" class="main-menu__filter-btns">' +
      `<a class="main-menu__filter-btns__btn ${isForMainMenu ? '' : CLICKABLE_SELECTOR}" title="${MAIN_MENU_SWITCH_TITLE}" onclick="switchToMainMenu(event)">Menü</a>` +
      `<a class="main-menu__filter-btns__btn ${isForMainMenu ? CLICKABLE_SELECTOR : ''}" title="${SHOP_MENU_SWITCH_TITLE}" onclick="switchToShopMenu(event)">Kategóriák</a>` +
    '</div>';

    return jQuery(mobileMenuSwitchBtnHtml);
  }

  function resetSidebarContentOnClose() {
    const cancelingElements = jQuery(`${MOBILE_SIDEBAR_CANCEL_BTN}, ${MOBILE_SIDEBAR_CANCEL_OVERLAY}`);
    cancelingElements.click(() => {
        const mainMenuInSidebar = jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`)
        if (mainMenuInSidebar.length) {
          mainMenuInSidebar.appendTo('body')
        }
        
        const shopMenuInSidebar = jQuery(`${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`)
        if (shopMenuInSidebar.length) {
          shopMenuInSidebar.appendTo(SHOP_SIDEBAR_MENU_SHELTER_SELECTOR);
        }

        cancelingElements.unbind('click');
    }); 
  }

  function preventCloseOnMenuClick() {
    jQuery(MOBILE_SIDEBAR_CONTAINER_SELECTOR).click((e) => {
      e.stopPropagation();
    })
  }

  function clickVariationSwatchIfOneOptionLeft() {
    let clickedByJquery = false;
    const allVariationSwatchGoups = jQuery('.button-variable-wrapper');
    allVariationSwatchGoups.children().click(function() {
      if (clickedByJquery) {
        clickedByJquery = false;
        return
      }

      setTimeout(() => {
        allVariationSwatchGoups.each(function() {
          const variationSwatchGroup = jQuery(this);
          const freeToChooseSwatches = variationSwatchGroup.children(':not(.disabled):not(.selected)');

          const isNoSwatchAlreadySelected = !variationSwatchGroup.children('.selected').length;
          const hasJustOneToChoose = freeToChooseSwatches.length === 1;
          if (hasJustOneToChoose && isNoSwatchAlreadySelected) {
            clickedByJquery = true;
            freeToChooseSwatches.click();
          }
        })
      }, 0);
    });
  }

  function parallaxShopHeader() {
    const parallaxShopHeader = jQuery(PARALLAX_HEADER_SELECTOR)
    let baseBackgroundPosition = PARALLAX_HEADER_SMALL_TABLET_Y_POSITION;
    if (window.innerWidth >= SMALL_TABLET_WIDTH) {
      parallaxShopHeader.css('top', baseBackgroundPosition + 'px')
      baseBackgroundPosition = PARALLAX_HEADER_LARGE_TABLET_Y_POSITION;
    }

    
    const jqueryWindow = jQuery(window);

    jqueryWindow.scroll(function() {
      var wScrollPosition = jqueryWindow.scrollTop();
      let backgroundYPosition = baseBackgroundPosition + wScrollPosition * PARALLAX_SPEED + 'px';
      parallaxShopHeader.css('top', backgroundYPosition)
    });
  }

  function addNamesToBeRocketColorIcons() {
    const beRocketColorIconNameContainers = jQuery(BR_ROCKET_COLOR_ICON_SELECTOR);
    beRocketColorIconNameContainers.each(function() {
      const currentIcon = jQuery(this);
      const colorName = currentIcon.attr('aria-label');
      currentIcon.children().eq(0).text(colorName);
    })
  }

  function removeUnneededFiltersFromMainShopPage() {
    const unneededFilters = jQuery(UNNEEDED_FILTERS);
    unneededFilters.parent().remove();
  }

  function loadElementOnUserInteractionAndInViewport(elementHtml, elementContainerSelector, jo) {

    const elemContainer = jQuery(elementContainerSelector);
    let shouldLoadElem = isElemVisible(elementContainerSelector);
    if (shouldLoadElem) {
      const htmlElem = jQuery(elementHtml);
      elemContainer.append(htmlElem);
      return;
    }

    shouldLoadElem = true;
    jQuery(window).one('scroll',function() {
      if (!shouldLoadElem) return;
      shouldLoadElem = false;
      const htmlElem = jQuery(elementHtml);
      elemContainer.append(htmlElem);
      isGoolgeMapsLoaded = true;
    });
    
    jQuery(window).one('mousemove',function() {
      if (!shouldLoadElem) return;
      shouldLoadElem = false;
      const htmlElem = jQuery(elementHtml);
      elemContainer.append(htmlElem);
      isGoolgeMapsLoaded = true;
    });
  }

  function isElemVisible(selector) {
    const elementTop = jQuery(selector).offset().top;
    const elementBottom = elementTop + jQuery(this).outerHeight();
    const viewportTop = jQuery(window).scrollTop();
    const viewportBottom = viewportTop + jQuery(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
  }

  function loadPageTopGoogleMaps() {
    const googleMapsContainer = jQuery(GOOGLE_MAPS_CONATINER_SELECTOR);
    googleMapsContainer.css({'position': 'absolute', 'top': 0, 'z-index': 0})
    const googleMapsImageContainer = jQuery(GOOGLE_MAPS_THIN_IMAGE_SELECTOR);
    
    setTimeout(() => {
      loadElementOnUserInteractionAndInViewport(GOOGLE_MAPS_THIN_IFRAME_HTML, GOOGLE_MAPS_CONATINER_SELECTOR);
      const googleMapsIframe = jQuery(`.${GOOGLE_MAPS_THIN_IFRAME_CLASS}`);

      googleMapsIframe.on('load', function(){
        setTimeout(() => {
          googleMapsImageContainer.fadeOut(1000, () => {
            googleMapsIframe.css('position', 'relative')
            googleMapsImageContainer.remove();
          });
        }, 1000)
      });
    }, 2000)
  }

  function swapDesignPlaceholderToSlider() {
    let isSliderSet = false;
    const loadSlider = () => {
      const fakeSliderContainer = jQuery(".design-slider-container");
      const designSlider = jQuery(jQuery(".fake-slider").text());
      designSlider.hide();
      fakeSliderContainer.append(designSlider);
      return designSlider;
    }
    
    const checkIfisLiderLoaded = () => {
      return new Promise((resolve, reject) => {
        let i = 0;
        var isSliderLoadedInterval = setInterval(function() {
          const isSliderLoaded = jQuery(FIRST_SLIDER_TITLE_LINK_SELECTOR).length;
          if (isSliderLoaded) {
            clearInterval(isSliderLoadedInterval);
            resolve(true);
          }
          
          // its awful I know => in some cases smart slider doesnt start to load while being hidden, so in that case we just allow it display
          // and so it triggers loading. It takes a second to load images that is seen by the user this what we wanted to avoid.
          const sliderIsMaybeLoaded = i > 5 && jQuery(DESIGN_SLIDER_LOADER_SELECTOR).length && jQuery('.n2-padding').children().length === 1;
          if (sliderIsMaybeLoaded) {
            clearInterval(isSliderLoadedInterval);
            resolve(true);
          }

          i++;
      }, IS_SLIDER_LOADED_INTERVAL_TIMER);
      })
    }

    const _swapDesignPlaceholderToSlider = async () => {
      if (isSliderSet) return;
      isSliderSet = true;
      const designSlider = loadSlider();
      await checkIfisLiderLoaded();
      gtmSliderEventTriggerSetup();
      const designSliderPlaceholder = jQuery(DESIGN_SLIDER_PLACEHOLDER_SELECTOR);
      designSlider.css({"z-index": 2});
      designSlider.fadeIn(2000, function() {
        setSliderContainerHeight(designSlider)
        addPointerIconToSliderTitle();
        addPointerIconToSliderTitleOnSlideFinish();
      });
      const originalWidth = designSliderPlaceholder.width() + "px";
      designSliderPlaceholder.css({
        "z-index": 1,
        "position": "absolute",
        "width": originalWidth,
      })
    }

    const setSliderContainerHeight = (designSliderJqueryObj) => {
      const setContainerHeightOnSliderLoad = setInterval(function() {
        const isSliderLoaded = !!document.querySelector(SMART_SLIDER_ARROWS_SELECTOR);
        if (!isSliderLoaded) return;
        clearInterval(setContainerHeightOnSliderLoad);
        const designSliderContainer = jQuery(DESIGN_SLIDER_CONTAINER_SELECTOR);
        jQuery(window).resize(() => {
          designSliderContainer.height(designSliderJqueryObj.height());
        });
    }, 500);

    }

    setTimeout(() => {
      jQuery(window).one('mousemove', () => {
        _swapDesignPlaceholderToSlider();
      });
      jQuery(window).one('scroll', () => {
        _swapDesignPlaceholderToSlider();
      });
      jQuery(window).one('click', () => {
        _swapDesignPlaceholderToSlider();
      });
    }, 0);

    setTimeout(() => {
      _swapDesignPlaceholderToSlider();
    }, SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT);
  }

  function addPointerIconToSliderTitleOnSlideFinish() {
    const designSliderId = jQuery(`${DESIGN_SLIDER_CONTAINER_SELECTOR} [data-ssid]`).attr('data-ssid');
    const designSliderSelector = `#n2-ss-${designSliderId}`;

    var slider = _N2[designSliderSelector];
    slider.sliderElement.addEventListener('mainAnimationComplete', function(e) {
      const sliderTitleLink = jQuery(ACTIVE_SLIDER_TITLE_LINK_SELECTOR);
      const hasPointerIconAlready = !!sliderTitleLink.children(POINTER_ICON_SELECTOR).length;
      if (hasPointerIconAlready) return;
      const pointerIcon = jQuery(POINTER_ICON_HTML);
      pointerIcon.hide();
      sliderTitleLink.append(pointerIcon);
      pointerIcon.fadeIn(500);
    });
  } 

  function addPointerIconToSliderTitle() {  
    const addPointerIntoSliderTitleInterval = setInterval(function() {
      const sliderTitleLink = jQuery(FIRST_SLIDER_TITLE_LINK_SELECTOR);
      if (!sliderTitleLink.length) return; 
      clearInterval(addPointerIntoSliderTitleInterval);
      const pointerIcon = jQuery(POINTER_ICON_HTML);
      pointerIcon.hide();
      sliderTitleLink.append(pointerIcon);
      pointerIcon.fadeIn(1000);
    }, 200);
  }

  function revealDesignSliderPlaceholder() {
    const designSliderContainer = jQuery(DESIGN_SLIDER_CONTAINER_SELECTOR);
    const designSliderPlaceholder = jQuery(DESIGN_SLIDER_PLACEHOLDER_SELECTOR);
    const placeHolderMessage = jQuery('.design-slider-container__placeholder__message');

    const height = designSliderPlaceholder.width() / 2;

    designSliderPlaceholder.height(height);
    designSliderContainer.height(height);
    designSliderContainer.css('overflow','hidden');
    placeHolderMessage.addClass('--visible');
  }

  function squareMeterCounter() {
    let amountInABox;
    jQuery('.woocommerce-product-attributes-item__value').each(function () {
      const item = jQuery(this);
      try {
        const showsAmountInABox = item.children().eq(0).children(0).attr('href').includes('dobozban-levo-mennyiseg');
        if (showsAmountInABox) {
          amountInABox = parseFloat(item.children().eq(0).children(0).text());
        }
      } catch (error) {
      }
    })

    if (!amountInABox) return;
    var boxCountInput = jQuery('[name="quantity"]')

    const currentBoxAmount = parseInt(boxCountInput.val());
    const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${currentBoxAmount * amountInABox} négyzetméter)</p>`
    const addToCartSection = jQuery('.sticky-add-to-cart');
    addToCartSection.append(message);
    
    jQuery('input[value="-"]').click(function() {
      setTimeout(() => {
        jQuery('.amount-in-box-message').remove();
        const currentBoxAmount = parseInt(boxCountInput.val());
        const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${currentBoxAmount * amountInABox} négyzetméter)</p>`
        addToCartSection.append(message);
      }, 0);
    })
    jQuery('input[value="+"]').click(function() {
      setTimeout(() => {
        jQuery('.amount-in-box-message').remove()
        const currentBoxAmount = parseInt(boxCountInput.val());
        const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${currentBoxAmount * amountInABox} négyzetméter)</p>`
        addToCartSection.append(message);
      }, 0);
    })
  }

  async function slideUpAndDownMobileMenuBar() {
    let mobileMenuBar = jQuery(MOBILE_MENU_BAR_SELECTOR);
    const arrowUpDownBox = jQuery(MOBILE_MENU_UP_DOWN_ARROW_BOX_HTML);
    let isInAnimation = false;
    let ishideAndShowArrowVisible = true;

    const toggleMobileMenuSlideUpDownArrow = () => {
      const isMobileMenuSticky = mobileMenuBar.hasClass(STICKY_MOBILE_MENU_BAR_CLASS_NAME);
      const shouldRevealArrow = isMobileMenuSticky && !ishideAndShowArrowVisible;
      if (shouldRevealArrow) {
        arrowUpDownBox.show();
        ishideAndShowArrowVisible = true;
        return;
      };
      const shouldHideArrow = !isMobileMenuSticky && ishideAndShowArrowVisible;
      if (shouldHideArrow) {
        arrowUpDownBox.hide();
        ishideAndShowArrowVisible = false;
      };
    }


    if (!mobileMenuBar.length) {
      mobileMenuBar = await getMobileMenuBar()
    }

    mobileMenuBar.append(arrowUpDownBox);
    toggleMobileMenuSlideUpDownArrow()
    jQuery(window).scroll(function() {
      if (!checkIsOnMobileView()) return;
      toggleMobileMenuSlideUpDownArrow();
    });

    const hideAndShowMobileMenuArrow = jQuery(MOBILE_MENU_BAR_ARROW_SELECTOR);
    arrowUpDownBox.click(function(e) {
      if (isInAnimation) return;
      isInAnimation = true;
      mobileMenuBar.toggleClass(MOBILE_MENU_BAR_INVISIBLE_CLASS_NAME);
      hideAndShowMobileMenuArrow.toggleClass(MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR);
      setTimeout(() => {isInAnimation = false}, 500);
    });
  }

  function getMobileMenuBar() {
    return new Promise((resolve) => {
      let getMobileMenuBarInterval = setInterval(function() {
          const mobileMenuBar = jQuery(MOBILE_MENU_BAR_SELECTOR);
          if (mobileMenuBar.length) {
            clearInterval(getMobileMenuBarInterval);
            resolve(mobileMenuBar);
          }
        }, 200);
    });
  }

  function checkIsOnMobileView() {
    return window.innerWidth < SMALL_TABLET_WIDTH;
  }

  function swapBoxAndSquarMetersPrice() {
    const pricesContainer = jQuery('.product-main .price.product-page-price').eq(0);
    pricesContainer.children().last().css({"display": "block", "margin-bottom": "5px"});
    pricesContainer.children().last().removeClass('mcmp_recalc_price_row');
    pricesContainer.children().first().addClass('mcmp_recalc_price_row');
    pricesContainer.children().first().insertAfter(pricesContainer.children().last());
  }
  
  function setTileUnit() {
    jQuery('.product-page-price .woocommerce-Price-amount').eq(0).children().children().text('Ft / Doboz');
  }

  function initiateCallOnPhoneCallIconClick(bigPhoneCallIcons) {
    bigPhoneCallIcons = jQuery(bigPhoneCallIcons);
    bigPhoneCallIcons.click(function() {
      // click on jquery elem itself doesnt trigger phone call... weird.
      jQuery(this).siblings().find(PHONE_CALL_NUMBER_LINK)[0].click();
    });
    bigPhoneCallIcons.siblings().find(PHONE_CALL_NUMBER_LINK).click(function(){
      const gtmTriggerName = jQuery(this).attr("data-gtm");
      dataLayer.push({'event': gtmTriggerName});
    })
  }

  function gtmSliderEventTriggerSetup() {
    const designSliderId = jQuery(`${DESIGN_SLIDER_CONTAINER_SELECTOR} [data-ssid]`).attr('data-ssid');
    const designSliderSelector = `#n2-ss-${designSliderId}`;
    _N2.r(designSliderSelector, function(){
      var slider = _N2[designSliderSelector];
      slider.sliderElement.addEventListener('mainAnimationComplete', function(e) {
        dataLayer.push({'event': GTM_SLIDER_INTERACTION_TRIGGER_NAME});
      });
    });
  }

  function sendViewCartEvent() {
    dataLayer.push({'event': GA_VIEW_CART_EVENT_NAME});
  }

  function displayInlineContactInfos(inlineContactInfoElems) {
    // inlineContactInfoElems should be the return value of document.querySelectorAll which isnt an array but some kind of iterable
    const getContactInfoHtml = (tel, name, isInline = false) => {
return `
  <strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>: 
  <i class="icon-phone" style="color: black;"></i> 
  <a class="${OCEAN_PHONE_CALL_LINK_CLASS}" href="tel:${tel}" style="cursor: pointer; color: #4e657b">${tel} - ${name}</a>
  ${isInline ? ' - ' : '<br>'}
  <a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975" style="cursor: pointer; color: #4e657b" target="_blank">
    Térkép a bolthoz
  <i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>
  </a>
`;
    }
    inlineContactInfoElems = [...inlineContactInfoElems];
    inlineContactInfoElems.forEach((elem) => {
      inlineContactInfoElem = jQuery(elem);
      const {tel, name} = getRandomContactInfo();
      const isInline = inlineContactInfoElem.attr(IS_CONTACT_INFO_INLINE_DATA_ATTR);
      const html = getContactInfoHtml(tel, name, isInline);
      inlineContactInfoElem.append(html);
    })
  }

  function fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtnElems) {
    const phoneNumberBtns = [...randomPhoneNumberBtnElems];
    phoneNumberBtns.forEach((elem) => {
      const phoneNumberBtn = jQuery(elem);
      const { tel, name } = getRandomContactInfo();
      phoneNumberBtn.attr('href', `tel:${tel}`);

      const callToActionArr = phoneNumberBtn.attr("class").match(`${RANDOM_PHONE_BTN_CTA_CLASS}[^\\s]*`)
      let callToActionMessage = '';
      if (callToActionArr) callToActionMessage = callToActionArr[0].replace(RANDOM_PHONE_BTN_CTA_CLASS, '').replace('-', ' ');
      const btnInnerText = callToActionMessage ? `${callToActionMessage} - ${tel}` : `${callToActionMessage} - ${name}`;
      phoneNumberBtn.text(btnInnerText);
    });
  }

  function getRandomContactInfo() {
    return CONTACT_INFOS[Math.floor(Math.random() * CONTACT_INFOS.length)]
  }

  function machineRentCallEvents() {
    const phoneCallBtns = jQuery(`.${OCEAN_PHONE_CALL_LINK_CLASS}`);
    phoneCallBtns.on('click', () => {
      dataLayer.push({'event': GA_MACHINE_RENT_CALL_EVENT_NAME});
    })
  }
</script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:ital,wght@0,400;0,500;1,100;1,300;1,400&display=swap" rel="stylesheet">
</body>
</html>