if (!$) {
  // eslint-disable-next-line no-unused-vars
  // eslint-disable-next-line no-var
  var $ = jQuery;
}

const CHECKED_SELECTOR = '--checked';
const COLOR_FILTER_ICONS_SELECTOR = 'filter-form__szin';
const MOBILE_SIDEBAR_MENU_ITEMS_SELECTOR =
  '.nav-sidebar .menu-item-object-page';
const MOBILE_SIDEBAR_PRODUCT_CATEGORIES_SELECTOR = '.mobile-sidebar-categories';
const MOBILE_SIDEBAR_SWITCH_BTNS_SELECTOR = '.mobile-sidebar-switch-btns';
const CLICKABLE_CLASS = '--clickable';
const MOBILE_MENU_HAMBURGER_ICON_SELECTOR = '#header [data-open="#main-menu"]';
const GOOGLE_MAPS_CONATINER_SELECTOR =
  '.lazy-load-google-maps-until-user-interaction';
const OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR = '#ocean-promo-video-container';
const CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR = `#contec-bull-promo-video-1-container`;
const CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR = `#contec-bull-promo-video-2-container`;
const FIRST_SLIDER_TITLE_LINK_SELECTOR = '[data-first] .slider-title a.n2-ow';
const BATH_TUB_SLIDER_HOMEPAGE_CONTAINER = '.home-page-kadak-slider-container';
const BATH_TUB_SLIDER_TEXT_SELECTOR = '.bath-tub-slider-text';
const TILES_SLIDER_HOMEPAGE_CONTAINER =
  '.home-page-burkolatok-slider-container';
const TILES_SLIDER_TEXT_SELECTOR = '.tiles-slider-text';
const STICKY_NAV_BAR_SELECTOR = '.header-wrapper';
const MOBILE_MENU_BAR_ARROW_SELECTOR = '.mobile-menu-arrow-up-down-box__arrow';
const MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR = '--rotated';
const DESIGN_SLIDER_HTML_IN_TEXT_SELECTOR =
  '.design-slider__slider-code-in-text';
const DESIGN_SLIDER_FAKE_IMG_SELECTOR = '.design-slider__fake-slider-img';
const DESIGN_SLIDER_CONTAINER_SELECTOR = '.design-slider__real-slider';
const DESIGN_SLIDER_LOADER_SELECTOR = '.n2-padding ss3-loader';
const BIG_PHONE_CALL_ICON_SELECTOR = '.big-phone-call-icon';
const PHONE_CALL_NUMBER_LINK = '.phone-call-number-link';
const OCEAN_PHONE_CALL_LINK_CLASS = 'ocean-phone-call';
const CATEGORY_GRID_BANNER_SELECTOR = '.category-grid-banner';

const GTM_SLIDER_INTERACTION_TRIGGER_NAME = 'interacted with slider';
const GTM_VIEW_CART_EVENT_NAME = 'view_cart';
const GTM_MACHINE_RENT_EVENT_NAME = 'ga - machine rent call';
const GTM_CALL_EVENT_NAME = 'ga - call';
const GTM_SALES_AGENT_NAME_VARIABLE = 'salesAgentsName';
const GTM_HTML_ELEMENT_VARIABLE = 'htmlElement';

const IS_SLIDER_LOADED_INTERVAL_TIMER = 200;
const SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT = 1000;
const CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR = '.contact-us-inline-infos';
const RANDOM_PHONE_BTNS_SELECTOR = '.random-phone-number-btn';
const RANDOM_PHONE_BTN_CTA_CLASS = 'default-text--';
const ACTIVE_ITEM_CLASS = 'active';
const PRODUCT_CATEGORIES_MAIN_MENU_BTN_SELECTOR = '.menu-item-4854';

const FILTER_MODAL_SELECTOR = '.filter-modal';
const FILTER_MODAL_TOGGLERS_SELECTOR = '.toggle-filter-modal';
const BE_ROCKET_FILTER_SECTION_SELECTOR = '.filter-modal .berocket_single_filter_widget';

const CATEGORIES_WITH_FILTERS_DATA = [
  {
    sidebarFilterClass: '.cat-item-2221',
    slug: 'burkolatok',
  },
  {
    sidebarFilterClass: '.cat-item-644',
    slug: 'furdoszoba-kiegeszitok',
  },
  {
    sidebarFilterClass: '.cat-item-2232',
    slug: 'csaptelepek',
  },
  {
    sidebarFilterClass: '.cat-item-2234',
    slug: 'kadak',
  },
  {
    sidebarFilterClass: '.cat-item-2245',
    slug: 'mosogatok',
  },
  {
    sidebarFilterClass: '.cat-item-2246',
    slug: 'szaniterek',
  },
  {
    sidebarFilterClass: '.cat-item-1258',
    slug: 'zuhanyfal',
  },
  {
    sidebarFilterClass: '.cat-item-2250',
    slug: 'zuhanykabinok',
  },
  {
    sidebarFilterClass: '.cat-item-2251',
    slug: 'zuhanytalcak',
  },
];

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
const OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML = `<iframe src="https://www.youtube.com/embed/HieK5jUu8Jc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
const CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/w3AUeYOrx2A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
const CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/HRd9bETXuRI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;

const CONTACTS_PAGE_PATH = '/kapcsolat/';
const DISCOUNTS_DISCLAIMER_PAGE_PATH = '/akciok/';
const CART_PAGE_PATH = '/cart/';
const MACHINE_RENT_PAGE_PATH = '/gep-kolcsonzes/';

const CONTACT_INFOS = [
  {
    tel: '06 70 942 5095',
    name: 'Pinti István',
  },
  {
    tel: '06 30 397 4150',
    name: 'Szabó István',
  },
  {
    tel: '06 70 601 4600',
    name: 'Illés László',
  },
];

const FOOTER_CALL_LINK_NAME = 'footer-call-link';
const UX_BUILDER_CALL_ICON_BOX_NAME = 'ux-builder-call-icon-box';
const INLINE_CALL_LINK_NAME = 'inline-call-link';
const CALL_BUTTON_NAME = 'button';

const IS_CONTACT_INFO_INLINE_DATA_ATTR = 'data-inline';

const SERVICE_PAGE_ID = '20391';
const SALES_AGENTS_NAME_ATTRIBUTE = 'data-sales-agents-name';

window.addEventListener(
    'DOMContentLoaded',
    async function () {
      hamburberMenuOpensMobileSidbar();
      mobileSidebarSwitchMenus();
      filterItemsOnClick();
      sidebarFilterLinksOnClick();
      slideUpAndDownMobileMenuBar();

      const isHomePage = document.querySelector('.home');
      if (isHomePage) {
        adjustProductImageHeightOnRectangle();
        scrollToDesginTabber();
        scrollToContacts();
        loadElementOnUserInteractionAndInViewport(
            GOOGLE_MAPS_IFRAME_HTML,
            GOOGLE_MAPS_CONATINER_SELECTOR,
        );
        loadElementOnUserInteractionAndInViewport(
            OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML,
            OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR,
        );
        const tilesSliderHtml = $(TILES_SLIDER_TEXT_SELECTOR).text();
        loadElementOnUserInteractionAndInViewport(
            tilesSliderHtml,
            TILES_SLIDER_HOMEPAGE_CONTAINER,
        );
        const bathtubSliderHtml = $(BATH_TUB_SLIDER_TEXT_SELECTOR).text();
        loadElementOnUserInteractionAndInViewport(
            bathtubSliderHtml,
            BATH_TUB_SLIDER_HOMEPAGE_CONTAINER,
        );
      }

      const isContactPage = window.location.pathname === CONTACTS_PAGE_PATH;
      if (isContactPage) {
        loadElementOnUserInteractionAndInViewport(
            GOOGLE_MAPS_IFRAME_HTML,
            GOOGLE_MAPS_CONATINER_SELECTOR,
        );
        loadElementOnUserInteractionAndInViewport(
            OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML,
            OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR,
        );
      }

      const isDiscountsDisclaimerPage =
      window.location.pathname === DISCOUNTS_DISCLAIMER_PAGE_PATH;
      if (isDiscountsDisclaimerPage) {
        loadElementOnUserInteractionAndInViewport(
            GOOGLE_MAPS_IFRAME_HTML,
            GOOGLE_MAPS_CONATINER_SELECTOR,
        );
      }

      if (isShopOrCategPage()) {
        swapDesignPlaceholderToSlider();
        addToCartBtnsOnClick();
        filterModal();

        const isSubCategoryPage = $('h1.shop-page-title').text() !== 'Shop';
        if (isSubCategoryPage) {
          openCurrentCategoryInSidebar();
        }

        const isMainShopPage = window.location.pathname.includes('shop');
        if (isMainShopPage) removeUnneededFiltersFromMainShopPage();

        const productCategId = window.location.pathname.replace(/\//g, '');
        const isSidebarSubCateogry = CATEGORIES_WITH_FILTERS_DATA.find(
            (filterData) => filterData.slug === productCategId,
        );
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

        const categoriesOfProduct = $('.product_meta .posted_in').text();
        const isTilePorductPage =
        categoriesOfProduct.includes('Burkolatok') &&
        !categoriesOfProduct.includes('dekor csempe') &&
        !categoriesOfProduct.includes('lisztello');
        if (isTilePorductPage) {
          squareMeterCounter();
          setTileUnit();
          swapBoxAndSquarMetersPrice();
        }
      }

      const isServicePage = document.querySelector(`.page-id-${SERVICE_PAGE_ID}`);
      if (isServicePage) {
        loadElementOnUserInteractionAndInViewport(
            GOOGLE_MAPS_IFRAME_HTML,
            GOOGLE_MAPS_CONATINER_SELECTOR,
        );
      }

      const bigPhoneCallIcons = document.querySelectorAll(
          BIG_PHONE_CALL_ICON_SELECTOR,
      );
      const hasPhoneCallIconsOnPage = !!bigPhoneCallIcons.length;
      if (hasPhoneCallIconsOnPage) {
        initiateCallOnPhoneCallIconClick(bigPhoneCallIcons);
      }

      const isCartPage = window.location.pathname === CART_PAGE_PATH;
      if (isCartPage) sendViewCartEvent();

      const inlineContactInfoElems = document.querySelectorAll(
          CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR,
      );
      const hasInlineContactInfosOnPage = !!inlineContactInfoElems.length;
      if (hasInlineContactInfosOnPage) {
        displayInlineContactInfos(inlineContactInfoElems);
      }

      const randomPhoneNumberBtns = document.querySelectorAll(
          RANDOM_PHONE_BTNS_SELECTOR,
      );
      const hasRandomPhoneNumberBtns = !!inlineContactInfoElems.length;
      if (hasRandomPhoneNumberBtns) {
        fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtns);
      }

      const isMachineRentPage =
      window.location.pathname === MACHINE_RENT_PAGE_PATH;
      if (isMachineRentPage) {
        loadElementOnUserInteractionAndInViewport(
            CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML,
            CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR,
        );
        loadElementOnUserInteractionAndInViewport(
            CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML,
            CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR,
        );
      }

      const callBtnsOnPage = $(`.${OCEAN_PHONE_CALL_LINK_CLASS}`);
      if (callBtnsOnPage.length) {
        gtmPhoneCallEvents(callBtnsOnPage);
      }

      const categoryBanners = $(CATEGORY_GRID_BANNER_SELECTOR);
      if (categoryBanners.length) {
        hasCategoryBanner(categoryBanners);
      }

      const productCateogiresMainMenuBtn = $(PRODUCT_CATEGORIES_MAIN_MENU_BTN_SELECTOR);
      if (productCateogiresMainMenuBtn) {
        productCateogiresMainMenuBtn.click(() => {
          openHamburgerMenuForCategories();
        });
      }
    },
    false,
);

function scrollToDesginTabber() {
  const win = $(window);
  const scrollToDesignTabberBtns = $('.scroll-to-design-tabber');
  scrollToDesignTabberBtns.click(() => {
    win.scrollTo('.design-tabber', 1000);
  });
}

function scrollToContacts() {
  const win = $(window);
  const scrollToDesignTabberBtns = $('.scroll-to-contacts');
  scrollToDesignTabberBtns.click(() => {
    win.scrollTo('.contact', 1000);
  });
}

function isShopOrCategPage() {
  return (
    !!document.querySelector('.woocommerce.archive') ||
    !!document.querySelector('.woocommerce-shop')
  );
}

function openCurrentCategoryInSidebar() {
  setTimeout(() => {
    document
        .querySelector('.product-categories li.active')
        .setAttribute('aria-expanded', true);
  }, 0);
}

function addAttributeFilterIconsToCurrentCategory() {
  const allFilterItems = Array.from(
      document.querySelectorAll('.filter-form li'),
  );
  const productCategId = window.location.pathname.replace(/\//g, '');

  sidebarFilterHtml = `<li id="${productCategId}" class=\"sidebar-filter --col-md-display-none cat-item cat-item-1458\"><ul>`;

  allFilterItems.map((filterItem, i) => {
    const isColorFilterIcon =
      filterItem.parentElement.parentElement.parentElement.className.includes(
          COLOR_FILTER_ICONS_SELECTOR,
      );
    if (isColorFilterIcon) {
      sidebarFilterHtml += getFilterIconHtml(productCategId, filterItem);
    } else {
      sidebarFilterHtml += getFilterIconHtml(
          productCategId,
          filterItem,
          isColorFilterIcon,
      );
    }
  });

  sidebarFilterHtml += '</ul></li>';
  const {sidebarFilterClass: currentCategorySidebarClass} =
    getCategoryData(productCategId);
  const currCategory = $(`${currentCategorySidebarClass} > ul`);
  const currentCategSidebarFilters = $(sidebarFilterHtml);
  currCategory.append(currentCategSidebarFilters);
}

function getFilterIconHtml(productCategId, filterItem, isCircleShape = true) {
  const filterId = filterItem.children[0].value;
  const href = `javascript:activateColorFilter('${productCategId}', ${filterId})`;
  const displayName =
    filterItem.children[1].getAttribute('aria-label') ||
    filterItem.children[1].innerText;
  const isCheckedClass = filterItem.className.includes('checked') ?
    CHECKED_SELECTOR :
    '';
  let filterIconHtml = '';

  if (isCircleShape) {
    filterIconHtml =
      `<li class=\"sidebar-filter__circle ${isCheckedClass} sidebar__filter-${filterId}" title="${displayName.trim()}">` +
      `<a href=\"${href}\">${displayName}</a>` +
      // + `<label>${displayName}</label>`
      '</li>';
  } else {
    filterIconHtml =
      `<li class=\"sidebar-filter__tag ${isCheckedClass} sidebar__filter-${filterId}"\">` +
      `<a href=\"${href}\">${displayName}</a>` +
      '</li>';
  }

  return filterIconHtml;
}

function filterItemsOnClick() {
  const allFilterItems = Array.from(
      document.querySelectorAll('.filter-form li label, .filter-modal li:not(.orderings) label'),
  );
  allFilterItems.forEach((filterItem) => {
    filterItem.addEventListener('click', function (e) {
      filterItem.parentElement.classList.toggle('checked');
      activateLoader();
    });
  });
}

// eslint-disable-next-line no-unused-vars
function activateColorFilter(productCategId, colorFilterId) {
  const clickedSidebarCircle = document.querySelector(
      `#${productCategId} .sidebar__filter-${colorFilterId}`,
  );
  clickedSidebarCircle.classList.toggle('--checked');
  document
      .querySelector(`input[value="${colorFilterId}"]`)
      .parentElement.children[1].click();
  activateLoader();
}

function activateLoader() {
  document.querySelector('.loader').style.display = 'block';
}

// eslint-disable-next-line no-unused-vars
function activateAttributeFilter(productCategId, attributeFilterId) {
  const clickedSidebarAttribute = document.querySelector(
      `#${productCategId} .sidebar__filter-${attributeFilterId}`,
  );
  clickedSidebarAttribute.classList.toggle('--checked');

  const tagFilterIcon = document.querySelector(
      `li [value="${attributeFilterId}"]`,
  );
  tagFilterIcon.classList.toggle('--checked');
  tagFilterIcon.parentElement.children[1].click();
}

function sidebarFilterLinksOnClick() {
  const sidebarFilterLinks = Array.from(
      document.querySelectorAll('.sidebar-filter__link'),
  );

  sidebarFilterLinks.forEach((filterLink) => {
    filterLink.addEventListener('click', function () {
      this.classList.toggle('--checked');
      activateLoader();
    });
  });
}

function getCategoryData(currentCategory) {
  return CATEGORIES_WITH_FILTERS_DATA.find(
      (categoryData) => categoryData.slug === currentCategory,
  );
}

function addBasketIconToAddBtns() {
  const basketIconHtml = '<i class="icon-shopping-basket"></i>';
  const addToCartBtns = $('#main .add-to-cart-button a');

  addToCartBtns.each(function () {
    $(this).append($(basketIconHtml));
  });
}

function adjustProductImageHeightOnRectangle() {
  const productImageContainerClass = '.product-small .box-image';

  const nonSquareImageBoxes = $(productImageContainerClass).filter(function (
      i,
  ) {
    const imageBoxWidth = parseInt($(this).width(), 10);
    const imageBoxHeight = parseInt($(this).height(), 10);
    return imageBoxWidth !== imageBoxHeight;
  });

  nonSquareImageBoxes.each(function () {
    const imageBox = $(this);
    imageBox.height(imageBox.width());
  });

  $(window).resize(function () {
    nonSquareImageBoxes.each(function () {
      const imageBox = $(this);
      imageBox.height(imageBox.width());
    });
  });
}

function addToCartBtnsOnClick() {
  const addToCartButtonsClass = '.add_to_cart_button';
  const addedToCartButtonClass = '.added_to_cart';

  const addToCartBtns = $(addToCartButtonsClass);
  addToCartBtns.click(function () {
    const clickedAddToCartBtn = $(this);

    const addToCartBtnInDom = setInterval(function () {
      if ($(addedToCartButtonClass).length) {
        clearInterval(addToCartBtnInDom);
        const newAddedToCartBtn = clickedAddToCartBtn.siblings(
            addedToCartButtonClass,
        );
        newAddedToCartBtn.text('Kosárhoz');
      }
    }, 100);
  });
}

function resizeProductCardTitlesForElliplsis() {
  const productCardTitlesClass =
    '.product-small.box .title-wrapper .product-title a';
  const productTitleContainerCss = '.product-small.box .name.product-title';
  const productCardTitles = $(productCardTitlesClass);

  const currentMaxWidth = $(productTitleContainerCss).width();
  productCardTitles.css('max-width', currentMaxWidth);

  $(window).resize(() => {
    const currentMaxWidth = $(productTitleContainerCss).width();
    productCardTitles.css('max-width', currentMaxWidth);
  });
}

function mobileSidebarSwitchMenus() {
  const switchBtns = $(MOBILE_SIDEBAR_SWITCH_BTNS_SELECTOR).children();

  switchBtns.click(function () {
    const switchBtn = $(this);
    const isBtnActive = switchBtn.hasClass(ACTIVE_ITEM_CLASS);

    if (isBtnActive) return;

    switchBtn.addClass(ACTIVE_ITEM_CLASS);
    switchBtn.toggleClass(CLICKABLE_CLASS);

    switchBtn.siblings().eq(0).removeClass(ACTIVE_ITEM_CLASS);
    switchBtn.siblings().eq(0).toggleClass(CLICKABLE_CLASS);

    const menuItems = $(MOBILE_SIDEBAR_MENU_ITEMS_SELECTOR);
    const mobileSidebarCategories = $(
        MOBILE_SIDEBAR_PRODUCT_CATEGORIES_SELECTOR,
    );

    const areCategoriesVisible = mobileSidebarCategories.is(':visible');
    if (areCategoriesVisible) {
      mobileSidebarCategories.fadeOut(200, () => menuItems.fadeIn(200));
    } else {
      menuItems.fadeOut(200, () => mobileSidebarCategories.fadeIn(200));
    }
  });
}

function hamburberMenuOpensMobileSidbar() {
  const hamburber = $(MOBILE_MENU_HAMBURGER_ICON_SELECTOR);
  const switchBtns = $(MOBILE_SIDEBAR_SWITCH_BTNS_SELECTOR);
  const menuBtn = switchBtns.children().eq(0);
  const categoriesBtn = switchBtns.children().eq(1);

  const mobileSidebarCategories = $(MOBILE_SIDEBAR_PRODUCT_CATEGORIES_SELECTOR);
  const menuItems = $(MOBILE_SIDEBAR_MENU_ITEMS_SELECTOR);

  const _isShopOrCategPage = isShopOrCategPage();
  if (_isShopOrCategPage) {
    menuBtn.addClass(CLICKABLE_CLASS);
    categoriesBtn.addClass(ACTIVE_ITEM_CLASS);
    menuItems.hide(0);
    mobileSidebarCategories.show(0);
  } else {
    menuBtn.addClass(ACTIVE_ITEM_CLASS);
    categoriesBtn.addClass(CLICKABLE_CLASS);
  }

  hamburber.click(() => {
    if (_isShopOrCategPage) {
      const menuBtnActive = menuBtn.hasClass(ACTIVE_ITEM_CLASS);
      if (menuBtnActive) {
        menuBtn.addClass(CLICKABLE_CLASS);
        menuBtn.removeClass(ACTIVE_ITEM_CLASS);

        categoriesBtn.addClass(ACTIVE_ITEM_CLASS);
        categoriesBtn.removeClass(CLICKABLE_CLASS);

        mobileSidebarCategories.show(0);
        menuItems.hide(0);
      }
    }
  });
}

function clickVariationSwatchIfOneOptionLeft() {
  let clickedByJquery = false;
  const allVariationSwatchGoups = $('.button-variable-wrapper');
  allVariationSwatchGoups.children().click(function () {
    if (clickedByJquery) {
      clickedByJquery = false;
      return;
    }

    setTimeout(() => {
      allVariationSwatchGoups.each(function () {
        const variationSwatchGroup = $(this);
        const freeToChooseSwatches = variationSwatchGroup.children(
            ':not(.disabled):not(.selected)',
        );

        const isNoSwatchAlreadySelected =
          !variationSwatchGroup.children('.selected').length;
        const hasJustOneToChoose = freeToChooseSwatches.length === 1;
        if (hasJustOneToChoose && isNoSwatchAlreadySelected) {
          clickedByJquery = true;
          freeToChooseSwatches.click();
        }
      });
    }, 0);
  });
}

function removeUnneededFiltersFromMainShopPage() {
  const unneededFilters = $(UNNEEDED_FILTERS);
  unneededFilters.parent().remove();
}

function loadElementOnUserInteractionAndInViewport(
    elementHtml,
    elementContainerSelector,
) {
  const elemContainer = $(elementContainerSelector);
  let shouldLoadElem = isElemVisible(elementContainerSelector);
  if (shouldLoadElem) {
    const htmlElem = $(elementHtml);
    elemContainer.append(htmlElem);
    return;
  }

  shouldLoadElem = true;
  $(window).one('scroll', function () {
    if (!shouldLoadElem) return;
    shouldLoadElem = false;
    const htmlElem = $(elementHtml);
    elemContainer.append(htmlElem);
    isGoolgeMapsLoaded = true;
  });

  $(window).one('mousemove', function () {
    if (!shouldLoadElem) return;
    shouldLoadElem = false;
    const htmlElem = $(elementHtml);
    elemContainer.append(htmlElem);
    isGoolgeMapsLoaded = true;
  });
}

function isElemVisible(selector) {
  const elementTop = $(selector).offset().top;
  const elementBottom = elementTop + $(this).outerHeight();
  const viewportTop = $(window).scrollTop();
  const viewportBottom = viewportTop + $(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
}

function swapDesignPlaceholderToSlider() {
  const isSliderOnPage = !!$(DESIGN_SLIDER_HTML_IN_TEXT_SELECTOR).length;
  if (!isSliderOnPage) return;

  let isSliderSet = false;
  const loadSlider = () => {
    const designSlider = $($(DESIGN_SLIDER_HTML_IN_TEXT_SELECTOR).text());
    const realSliderContainer = $(DESIGN_SLIDER_CONTAINER_SELECTOR);
    realSliderContainer.append(designSlider);
    return realSliderContainer;
  };

  const waitUntilSliderIsLoaded = () => {
    return new Promise((resolve) => {
      let i = 0;
      const isSliderLoadedInterval = setInterval(function () {
        const isSliderLoaded = $(FIRST_SLIDER_TITLE_LINK_SELECTOR).length;
        if (isSliderLoaded) {
          clearInterval(isSliderLoadedInterval);
          resolve(true);
        }

        // console.log($(DESIGN_SLIDER_LOADER_SELECTOR));
        // its awful I know => in some cases smart slider doesnt start to load while being hidden, so in that case we just allow it display
        // and so it triggers loading. It takes a second to load images that is seen by the user this what we wanted to avoid.
        const sliderIsMaybeLoaded =
          i > 5 &&
          $(DESIGN_SLIDER_LOADER_SELECTOR).length &&
          $('[aria-label="next arrow"]').children().length === 1;
        if (sliderIsMaybeLoaded) {
          clearInterval(isSliderLoadedInterval);
          setTimeout(() => {
            resolve(true);
          }, 100);
        }

        i++;
      }, IS_SLIDER_LOADED_INTERVAL_TIMER);
    });
  };

  const _swapDesignPlaceholderToSlider = async () => {
    if (isSliderSet) return;
    isSliderSet = true;
    const designSlider = loadSlider();

    await waitUntilSliderIsLoaded();
    gtmSliderEventTriggerSetup();

    designSlider.css({'z-index': 10});
    const sliderFakeImg = $(DESIGN_SLIDER_FAKE_IMG_SELECTOR);
    sliderFakeImg.css({'z-index': -10});

    setTimeout(() => {
      designSlider.css({position: 'relative'});
      sliderFakeImg.css({position: 'absolute'});
      sliderFakeImg.fadeOut(2000, () => sliderFakeImg.remove());
    }, 200);
  };

  setTimeout(() => {
    $(window).one('mousemove', () => {
      _swapDesignPlaceholderToSlider();
    });
    $(window).one('scroll', () => {
      _swapDesignPlaceholderToSlider();
    });
    $(window).one('click', () => {
      _swapDesignPlaceholderToSlider();
    });
  }, 0);

  setTimeout(() => {
    _swapDesignPlaceholderToSlider();
  }, SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT);
}

function squareMeterCounter() {
  let amountInABox;
  $('.woocommerce-product-attributes-item__value').each(function () {
    const item = $(this);
    try {
      const showsAmountInABox = item
          .children()
          .eq(0)
          .children(0)
          .attr('href')
          .includes('dobozban-levo-mennyiseg');
      if (showsAmountInABox) {
        amountInABox = parseFloat(item.children().eq(0).children(0).text());
      }
    } catch (error) {}
  });

  if (!amountInABox) return;
  const boxCountInput = $('[name="quantity"]');

  const currentBoxAmount = parseInt(boxCountInput.val());
  const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
    currentBoxAmount * amountInABox
  } négyzetméter)</p>`;
  const addToCartSection = $('.sticky-add-to-cart');
  addToCartSection.append(message);

  $('input[value="-"]').click(function () {
    setTimeout(() => {
      $('.amount-in-box-message').remove();
      const currentBoxAmount = parseInt(boxCountInput.val());
      const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
        currentBoxAmount * amountInABox
      } négyzetméter)</p>`;
      addToCartSection.append(message);
    }, 0);
  });
  $('input[value="+"]').click(function () {
    setTimeout(() => {
      $('.amount-in-box-message').remove();
      const currentBoxAmount = parseInt(boxCountInput.val());
      const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
        currentBoxAmount * amountInABox
      } négyzetméter)</p>`;
      addToCartSection.append(message);
    }, 0);
  });
}

async function slideUpAndDownMobileMenuBar() {
  const styleTag = $('<style></style>');
  $('body').append(styleTag);

  const menuBar = $(STICKY_NAV_BAR_SELECTOR);
  const arrowUpDownBox = $(MOBILE_MENU_BAR_ARROW_SELECTOR);

  const upsertInvisibleClass = () => {
    const topWhenHidden = (menuBar.height() - 3) * -1 + 'px';
    const invisibLeClassDef = `
      .stuck.--invisible {
        top: ${topWhenHidden};
      }
    `;
    styleTag.text(invisibLeClassDef);
  };

  let isInAnimation = false;
  arrowUpDownBox.click(function (e) {
    if (isInAnimation) return;
    isInAnimation = true;
    const isMenuBarVisible = menuBar.hasClass('--invisible');
    if (!isMenuBarVisible) {
      upsertInvisibleClass();
    }

    menuBar.toggleClass('--invisible');
    arrowUpDownBox.toggleClass(MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR);
    setTimeout(() => {
      isInAnimation = false;
    }, 500);
  });
}

function swapBoxAndSquarMetersPrice() {
  const pricesContainer = $('.product-main .price.product-page-price').eq(0);
  pricesContainer
      .children()
      .last()
      .css({'display': 'block', 'margin-bottom': '5px'});
  pricesContainer.children().last().removeClass('mcmp_recalc_price_row');
  pricesContainer.children().first().addClass('mcmp_recalc_price_row');
  pricesContainer
      .children()
      .first()
      .insertAfter(pricesContainer.children().last());
}

function setTileUnit() {
  $('.product-page-price .woocommerce-Price-amount')
      .eq(0)
      .children()
      .children()
      .text('Ft / Doboz');
}

function initiateCallOnPhoneCallIconClick(bigPhoneCallIcons) {
  bigPhoneCallIcons = $(bigPhoneCallIcons);

  bigPhoneCallIcons.click(function () {
    $(this).siblings().find(PHONE_CALL_NUMBER_LINK)[0].click();
  });

  bigPhoneCallIcons
      .siblings()
      .find(PHONE_CALL_NUMBER_LINK)
      .click(function () {
        const salesAgentName = $(this).parent().siblings().find('h3').text();
        const callEventOpts = {
          event: GTM_CALL_EVENT_NAME,
        };
        callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = UX_BUILDER_CALL_ICON_BOX_NAME;
        callEventOpts[GTM_SALES_AGENT_NAME_VARIABLE] = salesAgentName;
        dataLayer.push(callEventOpts);
      });
}

function gtmSliderEventTriggerSetup() {
  const designSliderId = $(
      `${DESIGN_SLIDER_CONTAINER_SELECTOR} [data-ssid]`,
  ).attr('data-ssid');
  const designSliderSelector = `#n2-ss-${designSliderId}`;
  _N2.r(designSliderSelector, function () {
    const slider = _N2[designSliderSelector];
    slider.sliderElement.addEventListener(
        'mainAnimationComplete',
        function (e) {
          dataLayer.push({event: GTM_SLIDER_INTERACTION_TRIGGER_NAME});
        },
    );
  });
}

function sendViewCartEvent() {
  dataLayer.push({event: GTM_VIEW_CART_EVENT_NAME});
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
  };
  inlineContactInfoElems = [...inlineContactInfoElems];
  inlineContactInfoElems.forEach((elem) => {
    inlineContactInfoElem = $(elem);
    const {tel, name} = getRandomContactInfo();
    const isInline = inlineContactInfoElem.attr(
        IS_CONTACT_INFO_INLINE_DATA_ATTR,
    );
    const html = getContactInfoHtml(tel, name, isInline);
    inlineContactInfoElem.append(html);
  });
}

function fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtnElems) {
  const phoneNumberBtns = [...randomPhoneNumberBtnElems];
  phoneNumberBtns.forEach((elem) => {
    const phoneNumberBtn = $(elem);
    const {tel, name} = getRandomContactInfo();
    phoneNumberBtn.attr('href', `tel:${tel}`);
    phoneNumberBtn.attr(SALES_AGENTS_NAME_ATTRIBUTE, name);

    const callToActionArr = phoneNumberBtn
        .attr('class')
        .match(`${RANDOM_PHONE_BTN_CTA_CLASS}[^\\s]*`);
    let callToActionMessage = '';
    if (callToActionArr) {
      callToActionMessage = callToActionArr[0]
          .replace(RANDOM_PHONE_BTN_CTA_CLASS, '')
          .replace('-', ' ');
    }
    const btnInnerText = callToActionMessage ?
      `${callToActionMessage} - ${tel}` :
      `${callToActionMessage} - ${name}`;
    phoneNumberBtn.text(btnInnerText);
  });
}

function getRandomContactInfo() {
  return CONTACT_INFOS[Math.floor(Math.random() * CONTACT_INFOS.length)];
}

function gtmPhoneCallEvents(callBtnsOnPageJqueryObject) {
  callBtnsOnPageJqueryObject.on('click', function () {
    callBtn = $(this);
    const callEventOpts = {
      event: GTM_CALL_EVENT_NAME,
    };

    const isMachineRentPage =
      window.location.pathname === MACHINE_RENT_PAGE_PATH;
    const hasButtonShape = callBtn.hasClass('button');
    if (hasButtonShape) {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = CALL_BUTTON_NAME;
      callEventOpts[GTM_SALES_AGENT_NAME_VARIABLE] = callBtn.attr(
          SALES_AGENTS_NAME_ATTRIBUTE,
      );
      dataLayer.push(callEventOpts);
      if (isMachineRentPage) {
        dataLayer.push({event: GTM_MACHINE_RENT_EVENT_NAME});
      }
      return;
    }

    const isFooterPhoneCallLink =
      callBtn.parent().attr('itemprop') === 'telephone';
    if (isFooterPhoneCallLink) {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = FOOTER_CALL_LINK_NAME;
    } else {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = INLINE_CALL_LINK_NAME;
    }

    const salesAgentName = callBtn.text().match(/[A-z].*/)[0];
    callEventOpts[GTM_SALES_AGENT_NAME_VARIABLE] = salesAgentName;
    dataLayer.push(callEventOpts);
    if (isMachineRentPage) {
      dataLayer.push({event: GTM_MACHINE_RENT_EVENT_NAME});
    }
  });
}

function hasCategoryBanner(categoryBanners) {
  categoryBanners.on('click', function () {
    const categoryBanner = $(this);
    const nextPagesLink = categoryBanner.find('a').attr('href');
    window.open(nextPagesLink, '_blank');
  });
}

function filterModal() {
  const filterModal = $(FILTER_MODAL_SELECTOR);
  const togglers = $(`${FILTER_MODAL_TOGGLERS_SELECTOR}, .invisble_overlay`);
  const filterSections = $(BE_ROCKET_FILTER_SECTION_SELECTOR);
  const overlay = $('.invisble_overlay');

  filterSections.each(function() {
    const currentFilterSection = $(this);
    const filtersType = currentFilterSection.eq(0).find('[data-taxonomy]').attr('data-taxonomy')
        .replace('pa_', '')
        .replace('product_tag', 'cimkék')
        .replace('szin', 'szín')
        .replace('orientacio', 'orientáció');

    const title = $(`<h4 class="filter-modal__section_title">${filtersType}</h4>`);
    title.insertBefore(currentFilterSection);
  });

  orderingsOptions();

  let isInAnimation = false;

  togglers.click(function (e) {
    if (isInAnimation) return;
    isInAnimation = true;
    const isModalVisible = filterModal.css('bottom') === '0px';
    if (isModalVisible) {
      const bottomWhenHidden = (filterModal.height()) * -1 + 'px';
      filterModal.css('bottom', bottomWhenHidden);
    } else {
      filterModal.css('bottom', '0px');
    }

    overlay.toggleClass('--blocking');
    setTimeout(() => {
      isInAnimation = false;
    }, 500);
  });

  function orderingsOptions() {
    $('li.orderings label').click(function() {
      label = $(this);
      const isActive = label.parent().hasClass('checked');
      if (isActive) return;
      label.siblings().attr('checked', 'checked');
      label.parent().addClass('checked');
      label.parent().siblings().removeClass('checked');
      $('form.filter-form__tags').submit();
      activateLoader();
    });
  }

  const bottomWhenHidden = (filterModal.height()) * -1 + 'px';
  filterModal.css('bottom', bottomWhenHidden);
  setTimeout(() => {
    filterModal.css('display', 'block');
  }, 500);
}
