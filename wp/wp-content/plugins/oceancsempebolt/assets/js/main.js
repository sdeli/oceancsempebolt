if (!$) {
  var $ = jQuery;
}

const CHECKED_SELECTOR = "--checked";
const COLOR_FILTER_ICONS_SELECTOR = "filter-form__szin";
const SHOP_SIDEBAR_SWITCH_BTNS_SELECTOR = "#shop-sidebar-switch-btns";
const MOBILE_SIDEBAR_CONTAINER_SELECTOR = ".mfp-content";
const SHOP_SIDEBAR_MENU_SELECTOR = "#shop-sidebar";
const SHOP_SIDEBAR_MENU_SHELTER_SELECTOR = ".col.large-3.hide-for-medium";
const MAIN_SIDEBAR_MENU_SELECTOR = "#main-menu";
const MAIN_MENU_SWITCH_TITLE = "main-menu-switch-btn";
const SHOP_MENU_SWITCH_TITLE = "shop-menu-switch-btn";
const CLICKABLE_SELECTOR = "--clickable";
const CLONE_MENU_SELECTOR = "--clone";
const MOBILE_SIDEBAR_CANCEL_OVERLAY =
  ".mfp-container.mfp-s-ready.mfp-inline-holder";
const MOBILE_SIDEBAR_CANCEL_BTN = ".mfp-close";
const PARALLAX_HEADER_SELECTOR = ".identity-header__background";
const HAMBURGER_BTN_SELECTOR = '[aria-controls="main-menu"]';
const FILTER_BTN_SELECTOR = ".filter-btn";
const MAIN_SHOP_PAGE_SLUG = "shop";
const DESKTOP_MENU_TRIGGER_CLASS = "desktop-hamburger-btn";
const PRODUCT_CATEGORIES_MENU_BAR_BTN_SELECTOR = "#menu-item-4854";
const GOOGLE_MAPS_CONATINER_SELECTOR =
  ".lazy-load-google-maps-until-user-interaction";
const OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR = `#ocean-promo-video-container`;
const CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR = `#contec-bull-promo-video-1-container`;
const CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR = `#contec-bull-promo-video-2-container`;
const TABBER_CONTAINER_SELECTOR = ".tabber-container";
const FIRST_SLIDER_TITLE_LINK_SELECTOR = "[data-first] .slider-title a.n2-ow";
const ACTIVE_SLIDER_TITLE_LINK_SELECTOR =
  ".n2-ss-slide-active .slider-title a.n2-ow";
const SMART_SLIDER_SELECTOR = "[data-ssid]";
const SMART_SLIDER_ARROWS_SELECTOR = ".nextend-arrow";
const POINTER_ICON_CLASS_NAME = "icon-pointer";
const POINTER_ICON_SELECTOR = "." + POINTER_ICON_CLASS_NAME;
const PLACEHOLDER_CATEGORY_SELECTOR = [".cat-item-3724"];
const BATH_TUB_SLIDER_SELECTOR = ['[data-ssid="82"]'];
const BATH_TUB_SLIDER_HOMEPAGE_CONTAINER = ".home-page-kadak-slider-container";
const BATH_TUB_SLIDER_TEXT_SELECTOR = ".bath-tub-slider-text";
const TILES_SLIDER_HOMEPAGE_CONTAINER =
  ".home-page-burkolatok-slider-container";
const TILES_SLIDER_TEXT_SELECTOR = ".tiles-slider-text";
const TILE_PRODUCT_CARDS_CONTAINER = ".home-tiles-container";
const MOBILE_MENU_BAR_SELECTOR = ".header-wrapper";
const STICKY_MOBILE_MENU_BAR_CLASS_NAME = "stuck";
const STICKY_MOBILE_MENU_BAR_SELECTOR = "." + STICKY_MOBILE_MENU_BAR_CLASS_NAME;
const MOBILE_MENU_BAR_ARROW_SELECTOR = ".mobile-menu-arrow-up-down-box__arrow";
const MOBILE_MENU_BAR_INVISIBLE_CLASS_NAME = "nav-invisible";
const MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR = "--rotated";
const DESIGN_SLIDER_HTML_IN_TEXT_SELECTOR =
  ".design-slider__slider-code-in-text";
const DESIGN_SLIDER_FAKE_IMG_SELECTOR = ".design-slider__fake-slider-img";
const DESIGN_SLIDER_CONTAINER_SELECTOR = ".design-slider__real-slider";
const DESIGN_SLIDER_LOADER_SELECTOR = ".n2-padding ss3-loader";
const BIG_PHONE_CALL_ICON_SELECTOR = ".big-phone-call-icon";
const BIG_PHONE_CALL_ICON_SALES_AGENT_NAME_SELECTOR = ".icon-box-text strong";
const GOOGLE_MAPS_THIN_IMAGE_SELECTOR = ".google-maps-thin-image";
const PHONE_CALL_NUMBER_LINK = ".phone-call-number-link";
const OCEAN_PHONE_CALL_LINK_CLASS = "ocean-phone-call";
const CATEGORY_GRID_BANNER_SELECTOR = ".category-grid-banner";

const GTM_SLIDER_INTERACTION_TRIGGER_NAME = "interacted with slider";
const GTM_VIEW_CART_EVENT_NAME = "view_cart";
const GTM_MACHINE_RENT_EVENT_NAME = "ga - machine rent call";
const GTM_CALL_EVENT_NAME = "ga - call";
const GTM_SALES_AGENT_NAME_VARIABLE = "salesAgentsName";
const GTM_HTML_ELEMENT_VARIABLE = "htmlElement";

const IS_SLIDER_LOADED_INTERVAL_TIMER = 200;
const SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT = 1000;
const CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR = ".contact-us-inline-infos";
const RANDOM_PHONE_BTNS_SELECTOR = ".random-phone-number-btn";
const RANDOM_PHONE_BTN_CTA_CLASS = "default-text--";

const CATEGORIES_WITH_FILTERS_DATA = [
  {
    sidebarFilterClass: ".cat-item-2221",
    slug: "burkolatok",
  },
  {
    sidebarFilterClass: ".cat-item-644",
    slug: "furdoszoba-kiegeszitok",
  },
  {
    sidebarFilterClass: ".cat-item-2232",
    slug: "csaptelepek",
  },
  {
    sidebarFilterClass: ".cat-item-2234",
    slug: "kadak",
  },
  {
    sidebarFilterClass: ".cat-item-2245",
    slug: "mosogatok",
  },
  {
    sidebarFilterClass: ".cat-item-2246",
    slug: "szaniterek",
  },
  {
    sidebarFilterClass: ".cat-item-1258",
    slug: "zuhanyfal",
  },
  {
    sidebarFilterClass: ".cat-item-2250",
    slug: "zuhanykabinok",
  },
  {
    sidebarFilterClass: ".cat-item-2251",
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
const GOOGLE_MAPS_THIN_IFRAME_CLASS = "google-maps-thin-iframe";
const GOOGLE_MAPS_THIN_IFRAME_HTML = `<iframe class="${GOOGLE_MAPS_THIN_IFRAME_CLASS}" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2695.1075531929037!2d19.169408815890215!3d47.507296602825434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c492289b176f%3A0x26d8f58d84c3afa9!2zw5NjZcOhbiBGw7xyZMWRc3pvYmEgc3phbG9u!5e0!3m2!1sen!2shu!4v1636496472824!5m2!1sen!2shu" width="100%" height="200" style="border:0;" allowfullscreen=""></iframe>`;
const OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML = `<iframe src="https://www.youtube.com/embed/HieK5jUu8Jc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
const CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/w3AUeYOrx2A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
const CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML = `<iframe width="560" height="315" src="https://www.youtube.com/embed/HRd9bETXuRI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
const POINTER_ICON_HTML = `<span class="${POINTER_ICON_CLASS_NAME} slider-pointer-icon"></span>`;
const MOBILE_MENU_UP_DOWN_ARROW_BOX_HTML =
  '<div class="mobile-menu-arrow-up-down-box"><i class="icon-angle-up mobile-menu-arrow-up-down-box__arrow"></i></div>';
const CONTACT_US_INLINE_INFOS_HTML = `n hozzánk bátran</strong>: 
    <i class="icon-phone" style="color: black;"></i> 
    <a href="tel:06-30-397-4150" style="cursor: pointer; color: #4e657b">06 30 397 4150 - Szabó István</a><br>
    <a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975" style="cursor: pointer; color: #4e657b" target="_blank">
      Térkép a bolthoz
    <i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>
    </a>
  `;

const PARALLAX_HEADER_SMALL_TABLET_Y_POSITION = -440;
const PARALLAX_HEADER_LARGE_TABLET_Y_POSITION = -428;
const PARALLAX_SPEED = 0.2;
const SMALL_TABLET_WIDTH = 849;
const MOBILE_MAX_WIDTH = 499;
const DESIGN_SLIDER_MOBILE_HEIGHT = 238;

const CONTACTS_PAGE_PATH = "/kapcsolat/";
const SALOON_PAGE_PATH = "/szalon/";
const DISCOUNTS_DISCLAIMER_PAGE_PATH = "/akciok/";
const CART_PAGE_PATH = "/cart/";
const MACHINE_RENT_PAGE_PATH = "/gep-kolcsonzes/";

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

const FOOTER_CALL_LINK_NAME = "footer-call-link";
const UX_BUILDER_CALL_ICON_BOX_NAME = "ux-builder-call-icon-box";
const INLINE_CALL_LINK_NAME = "inline-call-link";
const CALL_BUTTON_NAME = "button";

const IS_CONTACT_INFO_INLINE_DATA_ATTR = "data-inline";

const SERVICE_PAGE_ID = "20391";
const SALES_AGENTS_NAME_ATTRIBUTE = "data-sales-agents-name";

let isMenuSwitchFinised = true;
window.addEventListener(
  "DOMContentLoaded",
  async function () {
    openSidebar();
    filterItemsOnClick();
    moveFiltersToCategSidebar();
    sidebarFilterLinksOnClick();
    $(PRODUCT_CATEGORIES_MENU_BAR_BTN_SELECTOR).click(() =>
      clickDesktopHamburgerToOpenSidebar()
    );
    setTimeout(() => {
      slideUpAndDownMobileMenuBar();
    }, 0);
    setTimeout(() => {
      dataLayer.push({ event: GTM_SPENT_10_SECONDS_EVENT_NAME });
    }, 10000);

    const isHomePage = document.querySelector(".home");
    if (isHomePage) {
      adjustProductImageHeightOnRectangle();
      scrollToDesginTabber();
      scrollToContacts();
      loadElementOnUserInteractionAndInViewport(
        GOOGLE_MAPS_IFRAME_HTML,
        GOOGLE_MAPS_CONATINER_SELECTOR
      );
      loadElementOnUserInteractionAndInViewport(
        OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML,
        OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR
      );
      const tilesSliderHtml = $(TILES_SLIDER_TEXT_SELECTOR).text();
      loadElementOnUserInteractionAndInViewport(
        tilesSliderHtml,
        TILES_SLIDER_HOMEPAGE_CONTAINER
      );
      const bathtubSliderHtml = $(BATH_TUB_SLIDER_TEXT_SELECTOR).text();
      loadElementOnUserInteractionAndInViewport(
        bathtubSliderHtml,
        BATH_TUB_SLIDER_HOMEPAGE_CONTAINER
      );
    }

    const isContactPage = window.location.pathname === CONTACTS_PAGE_PATH;
    if (isContactPage) {
      loadElementOnUserInteractionAndInViewport(
        GOOGLE_MAPS_IFRAME_HTML,
        GOOGLE_MAPS_CONATINER_SELECTOR
      );
      loadElementOnUserInteractionAndInViewport(
        OCEAN_CSEMPE_PROMO_VIDEO_IFRAME_HTML,
        OCEAN_CSEMPE_PROMO_VIDEO_CONTAINER_SELECTOR
      );
    }

    const isSaloonPage =
      window.location.pathname === SALOON_PAGE_PATH ||
      window.location.pathname === "/szalon-test/";
    if (isSaloonPage) {
      loadPageTopGoogleMaps();
    }

    const isDiscountsDisclaimerPage =
      window.location.pathname === DISCOUNTS_DISCLAIMER_PAGE_PATH;
    if (isDiscountsDisclaimerPage) {
      loadElementOnUserInteractionAndInViewport(
        GOOGLE_MAPS_IFRAME_HTML,
        GOOGLE_MAPS_CONATINER_SELECTOR
      );
    }

    if (isShopOrCategPage()) {
      swapDesignPlaceholderToSlider();
      addToCartBtnsOnClick();
      parallaxShopHeader();

      const isSubCategoryPage = $("h1.shop-page-title").text() !== "Shop";
      if (isSubCategoryPage) {
        openCurrentCategoryInSidebar();
      }

      const isMainShopPage = $("h1.shop-page-title").text() === "Shop";
      if (isMainShopPage) removeUnneededFiltersFromMainShopPage();

      const productCategId = window.location.pathname.replace(/\//g, "");
      const isSidebarSubCateogry = CATEGORIES_WITH_FILTERS_DATA.find(
        (filterData) => filterData.slug === productCategId
      );
      if (isSidebarSubCateogry) {
        addAttributeFilterIconsToCurrentCategory();
      }
    }
    const hasProductCards = !!document.querySelectorAll(".product-small.box");
    if (hasProductCards) {
      resizeProductCardTitlesForElliplsis();
      addBasketIconToAddBtns();
      adjustProductImageHeightOnRectangle();
    }

    const isProductPage = !!document.querySelector(".single-product");
    if (isProductPage) {
      clickVariationSwatchIfOneOptionLeft();

      const breadCrumbs = document.querySelector(
        ".woocommerce-breadcrumb.breadcrumbs"
      );
      const categoriesOfProduct = $(".product_meta .posted_in").text();
      const isTilePorductPage =
        categoriesOfProduct.includes("Burkolatok") &&
        !categoriesOfProduct.includes("dekor csempe") &&
        !categoriesOfProduct.includes("lisztello");
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
        GOOGLE_MAPS_CONATINER_SELECTOR
      );
    }

    const bigPhoneCallIcons = document.querySelectorAll(
      BIG_PHONE_CALL_ICON_SELECTOR
    );
    const hasPhoneCallIconsOnPage = !!bigPhoneCallIcons.length;
    if (hasPhoneCallIconsOnPage)
      initiateCallOnPhoneCallIconClick(bigPhoneCallIcons);

    const isCartPage = window.location.pathname === CART_PAGE_PATH;
    if (isCartPage) sendViewCartEvent();

    const inlineContactInfoElems = document.querySelectorAll(
      CONTACT_US_INLINE_INFOS_CONTAINER_SELECTOR
    );
    const hasInlineContactInfosOnPage = !!inlineContactInfoElems.length;
    if (hasInlineContactInfosOnPage)
      displayInlineContactInfos(inlineContactInfoElems);

    const randomPhoneNumberBtns = document.querySelectorAll(
      RANDOM_PHONE_BTNS_SELECTOR
    );
    const hasRandomPhoneNumberBtns = !!inlineContactInfoElems.length;
    if (hasRandomPhoneNumberBtns)
      fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtns);

    const isMachineRentPage =
      window.location.pathname === MACHINE_RENT_PAGE_PATH;
    if (isMachineRentPage) {
      loadElementOnUserInteractionAndInViewport(
        CONTEC_BULL_PROMO_VIDEO_1_IFRAME_HTML,
        CONTEC_BULL_PROMO_VIDEO_1_CONTAINER_SELECTOR
      );
      loadElementOnUserInteractionAndInViewport(
        CONTEC_BULL_PROMO_VIDEO_2_IFRAME_HTML,
        CONTEC_BULL_PROMO_VIDEO_2_CONTAINER_SELECTOR
      );
    }

    const callBtnsOnPage = $(`.${OCEAN_PHONE_CALL_LINK_CLASS}`);
    if (callBtnsOnPage.length) {
      gtmPhoneCallEvents(callBtnsOnPage);
    }

    const categoryBanners = $(CATEGORY_GRID_BANNER_SELECTOR);
    // has category selector html elem on page
    if (categoryBanners.length) {
      hasCategoryBanner(categoryBanners);
    }
  },
  false
);

function scrollToDesginTabber() {
  const win = $(window);
  const scrollToDesignTabberBtns = $(".scroll-to-design-tabber");
  scrollToDesignTabberBtns.click(() => {
    win.scrollTo(".design-tabber", 1000);
  });
}

function scrollToContacts() {
  const win = $(window);
  const scrollToDesignTabberBtns = $(".scroll-to-contacts");
  scrollToDesignTabberBtns.click(() => {
    win.scrollTo(".contact", 1000);
  });
}

function isShopOrCategPage() {
  return (
    !!document.querySelector(".woocommerce.archive") ||
    !!document.querySelector(".woocommerce-shop")
  );
}

function openCurrentCategoryInSidebar() {
  setTimeout(() => {
    document
      .querySelector(".product-categories li.active")
      .setAttribute("aria-expanded", true);
  }, 0);
}

function addAttributeFilterIconsToCurrentCategory() {
  const allFilterItems = Array.from(
    document.querySelectorAll(".filter-form li")
  );
  const productCategId = window.location.pathname.replace(/\//g, "");

  const { filters } = getQueryParams();
  sidebarFilterHtml = `<li id="${productCategId}" class=\"sidebar-filter --col-md-display-none cat-item cat-item-1458\"><ul>`;

  allFilterItems.map((filterItem, i) => {
    const isColorFilterIcon =
      filterItem.parentElement.parentElement.parentElement.className.includes(
        COLOR_FILTER_ICONS_SELECTOR
      );
    if (isColorFilterIcon) {
      sidebarFilterHtml += getFilterIconHtml(productCategId, filterItem);
    } else {
      sidebarFilterHtml += getFilterIconHtml(
        productCategId,
        filterItem,
        isColorFilterIcon
      );
    }
  });

  sidebarFilterHtml += "</ul></li>";
  const { sidebarFilterClass: currentCategorySidebarClass } =
    getCategoryData(productCategId);
  const currCategory = $(`${currentCategorySidebarClass} > ul`);
  const currentCategSidebarFilters = $(sidebarFilterHtml);
  currCategory.append(currentCategSidebarFilters);
}

function getFilterIconHtml(productCategId, filterItem, isCircleShape = true) {
  const filterId = filterItem.children[0].value;
  const href = `javascript:activateColorFilter('${productCategId}', ${filterId})`;
  const displayName =
    filterItem.children[1].getAttribute("aria-label") ||
    filterItem.children[1].innerText;
  const isCheckedClass = filterItem.className.includes("checked")
    ? CHECKED_SELECTOR
    : "";
  let filterIconHtml = "";

  if (isCircleShape) {
    filterIconHtml =
      `<li class=\"sidebar-filter__circle ${isCheckedClass} sidebar__filter-${filterId}" title="${displayName.trim()}">` +
      `<a href=\"${href}\">${displayName}</a>` +
      // + `<label>${displayName}</label>`
      "</li>";
  } else {
    filterIconHtml =
      `<li class=\"sidebar-filter__tag ${isCheckedClass} sidebar__filter-${filterId}"\">` +
      `<a href=\"${href}\">${displayName}</a>` +
      "</li>";
  }

  return filterIconHtml;
}

function getTagIcon(productCategId, filterItem) {
  const filterId = filterItem.children[0].value;
  const displayName =
    filterItem.children[1].getAttribute("aria-label") ||
    filterItem.children[1].innerText;
  const href = `javascript:activateColorFilter('${productCategId}', ${filterId})`;
  const isCheckedClass = filterItem.className.includes("checked")
    ? CHECKED_SELECTOR
    : "";

  return (
    "" +
    `<li class=\"sidebar-filter__tag ${isCheckedClass} sidebar__filter-${filterId}"\">` +
    `<a href=\"${href}\"></a>` +
    "</li>"
  );
}

function filterItemsOnClick() {
  const allFilterItems = Array.from(
    document.querySelectorAll(".filter-form li label")
  );
  allFilterItems.forEach((filterItem) => {
    filterItem.addEventListener("click", function (e) {
      filterItem.parentElement.classList.toggle("checked");
      activateLoader();
    });
  });
}

function activateColorFilter(productCategId, colorFilterId) {
  const clickedSidebarCircle = document.querySelector(
    `#${productCategId} .sidebar__filter-${colorFilterId}`
  );
  clickedSidebarCircle.classList.toggle("--checked");
  document
    .querySelector(`input[value="${colorFilterId}"]`)
    .parentElement.children[1].click();
  activateLoader();
}

function activateLoader() {
  document.querySelector(".loader").style.display = "block";
}

function activateAttributeFilter(productCategId, attributeFilterId) {
  const clickedSidebarAttribute = document.querySelector(
    `#${productCategId} .sidebar__filter-${attributeFilterId}`
  );
  clickedSidebarAttribute.classList.toggle("--checked");

  const tagFilterIcon = document.querySelector(
    `li [value="${attributeFilterId}"]`
  );
  tagFilterIcon.classList.toggle("--checked");
  tagFilterIcon.parentElement.children[1].click();
}

function moveFiltersToCategSidebar() {
  CATEGORIES_WITH_FILTERS_DATA.forEach((categorieData) => {
    const currCategory = document.querySelector(
      `${categorieData.sidebarFilterClass} ul`
    );
    if (!currCategory) return;

    const currCategsFilterElem = document.querySelector(
      `.sidebar-filter--${categorieData.slug}`
    );
    if (!currCategsFilterElem) return;
    currCategory.appendChild(currCategsFilterElem);
  });
}

function sidebarFilterLinksOnClick() {
  const sidebarFilterLinks = Array.from(
    document.querySelectorAll(".sidebar-filter__link")
  );

  sidebarFilterLinks.forEach((filterLink) => {
    filterLink.addEventListener("click", function () {
      this.classList.toggle("--checked");
      activateLoader();
    });
  });
}

function getQueryParams() {
  const urlSearchParams = new URLSearchParams(window.location.search);
  return Object.fromEntries(urlSearchParams.entries());
}

function getCategoryData(currentCategory) {
  return CATEGORIES_WITH_FILTERS_DATA.find(
    (categoryData) => categoryData.slug === currentCategory
  );
}

function addBasketIconToAddBtns() {
  const basketIconHtml = '<i class="icon-shopping-basket"></i>';
  const addToCartBtns = $("#main .add-to-cart-button a");

  addToCartBtns.each(function () {
    $(this).append($(basketIconHtml));
  });
}

function adjustProductImageHeightOnRectangle() {
  const productImageContainerClass = ".product-small .box-image";

  const nonSquareImageBoxes = $(productImageContainerClass).filter(function (
    i
  ) {
    const imageBoxWidth = parseInt($(this).width(), 10);
    const imageBoxHeight = parseInt($(this).height(), 10);
    return imageBoxWidth !== imageBoxHeight;
  });

  nonSquareImageBoxes.each(function () {
    const imageBox = $(this);
    imageBox.height(imageBox.width());
    const image = imageBox.find("img").eq(0);
    const fuck = image.addClass("non-square");
  });

  $(window).resize(function () {
    nonSquareImageBoxes.each(function () {
      const imageBox = $(this);
      imageBox.height(imageBox.width());
    });
  });
}

function adjustBackToTopBtnVisibility() {
  const isOverFooterClass = "is-over-footer";
  const footerClass = "footer";
  const backToTopBtnClass = ".back-to-top";
  const backToTopBtn = $(backToTopBtnClass);
  const footer$ = $(footerClass);
  const document$ = $(document);

  const adjust = () => {
    const wasOverFooter = backToTopBtn.hasClass(isOverFooterClass);

    const currentScrollTop = document$.scrollTop();
    const { top: btnTop } = backToTopBtn.position();
    const btnHeight = backToTopBtn.height();
    const { top: footerTop } = footer$.position();

    const backToTopBtnBottomPos = currentScrollTop + btnTop + btnHeight * 0.7;
    const isOverFooter =
      currentScrollTop + btnTop + btnHeight * 0.7 > footerTop;

    const justCrossedFooterFromTop = isOverFooter && !wasOverFooter;
    if (justCrossedFooterFromTop) {
      backToTopBtn.addClass(isOverFooterClass);
    }

    const justLeftFooterToTop = wasOverFooter && !isOverFooter;
    if (justLeftFooterToTop) {
      backToTopBtn.removeClass(isOverFooterClass);
    }
  };

  adjust();
  $(window).scroll(adjust);
}

function addToCartBtnsOnClick() {
  const addToCartButtonsClass = ".add_to_cart_button";
  const addedToCartButtonClass = ".added_to_cart";

  const addToCartBtns = $(addToCartButtonsClass);
  addToCartBtns.click(function () {
    const clickedAddToCartBtn = $(this);

    var addToCartBtnInDom = setInterval(function () {
      if ($(addedToCartButtonClass).length) {
        clearInterval(addToCartBtnInDom);
        const newAddedToCartBtn = clickedAddToCartBtn.siblings(
          addedToCartButtonClass
        );
        newAddedToCartBtn.text("Kosárhoz");
      }
    }, 100);
  });
}

function resizeProductCardTitlesForElliplsis() {
  var productCardTitlesClass =
    ".product-small.box .title-wrapper .product-title a";
  var productTitleContainerCss = ".product-small.box .name.product-title";
  var productCardTitles = $(productCardTitlesClass);

  var currentMaxWidth = $(productTitleContainerCss).width();
  productCardTitles.css("max-width", currentMaxWidth);

  $(window).resize(() => {
    var currentMaxWidth = $(productTitleContainerCss).width();
    productCardTitles.css("max-width", currentMaxWidth);
  });
}

function clickHamburgerToOpenMobileSidebar() {
  const hamburgerBtn = $(HAMBURGER_BTN_SELECTOR);
  hamburgerBtn.click();
}

function clickDesktopHamburgerToOpenSidebar() {
  const desktopSidebarMenuTrigger = $("." + DESKTOP_MENU_TRIGGER_CLASS);
  desktopSidebarMenuTrigger.click();
}

function openSidebar() {
  const hamburgerBtn = $(HAMBURGER_BTN_SELECTOR);
  const filterMenuBtn = $(FILTER_BTN_SELECTOR);

  hamburgerBtn.click(function () {
    setTimeout(() => {
      const isDesktopProductCategsBtnClicked = $(this).hasClass(
        DESKTOP_MENU_TRIGGER_CLASS
      );
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

  const isOnShopMenuAlready = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`
  ).length;
  if (isOnShopMenuAlready) return;
  isMenuSwitchFinised = false;

  const mobileSidebarContainer = $(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  const mainMenu = $(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
  );
  const shopMenu = $(SHOP_SIDEBAR_MENU_SELECTOR);
  const shopMenuBtn = $(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
  const mainMenuBtn = $(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);

  if (isDesktopMenu) {
    insertDesktopSidebarHeader();
  } else {
    insertMainMenuSwitchBtnsIntoMobileSidebar();
  }

  mainMenu.appendTo("body");
  mainMenu.show();
  shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  isMenuSwitchFinised = true;
}

function insertShopMenuSwitchBtnsIntoMobileSidebar() {
  const shopSideBarSwitchBtns = getMobileMenuSwitchIcons(true);
  const hasMainMenuInSidebar = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
  ).length;
  shopSideBarSwitchBtns.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);

  if (!hasMainMenuInSidebar) {
    const mainMenu = $(MAIN_SIDEBAR_MENU_SELECTOR);
    mainMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  }
  preventCloseOnMenuClick();
  resetSidebarContentOnClose();
}

function insertMainMenuSwitchBtnsIntoMobileSidebar() {
  const shopSideBarSwitchBtns = getMobileMenuSwitchIcons(false);
  const hasShopMenuInSidebar = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`
  ).length;
  shopSideBarSwitchBtns.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);

  if (!hasShopMenuInSidebar) {
    const shopMenu = $(SHOP_SIDEBAR_MENU_SELECTOR);
    shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  }
  preventCloseOnMenuClick();
  resetSidebarContentOnClose();
}

function insertDesktopSidebarHeader() {
  const categoriesSidebarHeader = $(CATEGORIES_SIDEBAR_HEADER_HTML);
  categoriesSidebarHeader.prependTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);

  const hasMainMenuInSidebar = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
  ).length;
  if (!hasMainMenuInSidebar) {
    const mainMenu = $(MAIN_SIDEBAR_MENU_SELECTOR);
    mainMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  }
  preventCloseOnMenuClick();
  resetSidebarContentOnClose();
}

function switchToMainMenu(e) {
  e.stopPropagation();
  if (!isMenuSwitchFinised) return;

  const isOnMainMenuAlready = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
  ).length;
  if (isOnMainMenuAlready) return;
  isMenuSwitchFinised = false;

  const mainMenu = $(MAIN_SIDEBAR_MENU_SELECTOR);
  const mobileSidebarContainer = $(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  const shopMenu = $(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`
  );
  const shopMenuBtn = $(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
  const mainMenuBtn = $(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);

  shopMenu.fadeOut(() => {
    shopMenu.appendTo(SHOP_SIDEBAR_MENU_SHELTER_SELECTOR);
    shopMenu.show();

    mainMenu
      .removeClass("mfp-hide")
      .appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    isMenuSwitchFinised = true;
  });

  shopMenuBtn.toggleClass(CLICKABLE_SELECTOR);
  mainMenuBtn.toggleClass(CLICKABLE_SELECTOR);
}

function switchToShopMenu(e) {
  if (e) e.stopPropagation();
  if (!isMenuSwitchFinised) return;

  const isOnShopMenuAlready = !!$(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`
  ).length;
  if (isOnShopMenuAlready) return;
  isMenuSwitchFinised = false;

  const mobileSidebarContainer = $(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
  const mainMenu = $(
    `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
  );
  const shopMenu = $(SHOP_SIDEBAR_MENU_SELECTOR);
  const shopMenuBtn = $(`[title="${SHOP_MENU_SWITCH_TITLE}"]`);
  const mainMenuBtn = $(`[title="${MAIN_MENU_SWITCH_TITLE}"]`);

  mainMenu.fadeOut(() => {
    mainMenu.appendTo("body");
    mainMenu.show();
    shopMenu.appendTo(MOBILE_SIDEBAR_CONTAINER_SELECTOR);
    isMenuSwitchFinised = true;
  });

  shopMenuBtn.toggleClass(CLICKABLE_SELECTOR);
  mainMenuBtn.toggleClass(CLICKABLE_SELECTOR);
}

function getMobileMenuSwitchIcons(isForMainMenu = true) {
  const mobileMenuSwitchBtnHtml =
    "" +
    '<div id="shop-sidebar-switch-btns" class="main-menu__filter-btns">' +
    `<a class="main-menu__filter-btns__btn ${
      isForMainMenu ? "" : CLICKABLE_SELECTOR
    }" title="${MAIN_MENU_SWITCH_TITLE}" onclick="switchToMainMenu(event)">Menü</a>` +
    `<a class="main-menu__filter-btns__btn ${
      isForMainMenu ? CLICKABLE_SELECTOR : ""
    }" title="${SHOP_MENU_SWITCH_TITLE}" onclick="switchToShopMenu(event)">Kategóriák</a>` +
    "</div>";

  return $(mobileMenuSwitchBtnHtml);
}

function resetSidebarContentOnClose() {
  const cancelingElements = $(
    `${MOBILE_SIDEBAR_CANCEL_BTN}, ${MOBILE_SIDEBAR_CANCEL_OVERLAY}`
  );
  cancelingElements.click(() => {
    const mainMenuInSidebar = $(
      `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${MAIN_SIDEBAR_MENU_SELECTOR}`
    );
    if (mainMenuInSidebar.length) {
      mainMenuInSidebar.appendTo("body");
    }

    const shopMenuInSidebar = $(
      `${MOBILE_SIDEBAR_CONTAINER_SELECTOR} ${SHOP_SIDEBAR_MENU_SELECTOR}`
    );
    if (shopMenuInSidebar.length) {
      shopMenuInSidebar.appendTo(SHOP_SIDEBAR_MENU_SHELTER_SELECTOR);
    }

    cancelingElements.unbind("click");
  });
}

function preventCloseOnMenuClick() {
  $(MOBILE_SIDEBAR_CONTAINER_SELECTOR).click((e) => {
    e.stopPropagation();
  });
}

function clickVariationSwatchIfOneOptionLeft() {
  let clickedByJquery = false;
  const allVariationSwatchGoups = $(".button-variable-wrapper");
  allVariationSwatchGoups.children().click(function () {
    if (clickedByJquery) {
      clickedByJquery = false;
      return;
    }

    setTimeout(() => {
      allVariationSwatchGoups.each(function () {
        const variationSwatchGroup = $(this);
        const freeToChooseSwatches = variationSwatchGroup.children(
          ":not(.disabled):not(.selected)"
        );

        const isNoSwatchAlreadySelected =
          !variationSwatchGroup.children(".selected").length;
        const hasJustOneToChoose = freeToChooseSwatches.length === 1;
        if (hasJustOneToChoose && isNoSwatchAlreadySelected) {
          clickedByJquery = true;
          freeToChooseSwatches.click();
        }
      });
    }, 0);
  });
}

function parallaxShopHeader() {
  const parallaxShopHeader = $(PARALLAX_HEADER_SELECTOR);
  let baseBackgroundPosition = PARALLAX_HEADER_SMALL_TABLET_Y_POSITION;
  if (window.innerWidth >= SMALL_TABLET_WIDTH) {
    parallaxShopHeader.css("top", baseBackgroundPosition + "px");
    baseBackgroundPosition = PARALLAX_HEADER_LARGE_TABLET_Y_POSITION;
  }

  const jqueryWindow = $(window);

  jqueryWindow.scroll(function () {
    var wScrollPosition = jqueryWindow.scrollTop();
    let backgroundYPosition =
      baseBackgroundPosition + wScrollPosition * PARALLAX_SPEED + "px";
    parallaxShopHeader.css("top", backgroundYPosition);
  });
}

function removeUnneededFiltersFromMainShopPage() {
  const unneededFilters = $(UNNEEDED_FILTERS);
  unneededFilters.parent().remove();
}

function loadElementOnUserInteractionAndInViewport(
  elementHtml,
  elementContainerSelector
) {
  const elemContainer = $(elementContainerSelector);
  let shouldLoadElem = isElemVisible(elementContainerSelector);
  if (shouldLoadElem) {
    const htmlElem = $(elementHtml);
    elemContainer.append(htmlElem);
    return;
  }

  shouldLoadElem = true;
  $(window).one("scroll", function () {
    if (!shouldLoadElem) return;
    shouldLoadElem = false;
    const htmlElem = $(elementHtml);
    elemContainer.append(htmlElem);
    isGoolgeMapsLoaded = true;
  });

  $(window).one("mousemove", function () {
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

function loadPageTopGoogleMaps() {
  const googleMapsContainer = $(GOOGLE_MAPS_CONATINER_SELECTOR);
  googleMapsContainer.css({ position: "absolute", top: 0, "z-index": 0 });
  const googleMapsImageContainer = $(GOOGLE_MAPS_THIN_IMAGE_SELECTOR);

  setTimeout(() => {
    loadElementOnUserInteractionAndInViewport(
      GOOGLE_MAPS_THIN_IFRAME_HTML,
      GOOGLE_MAPS_CONATINER_SELECTOR
    );
    const googleMapsIframe = $(`.${GOOGLE_MAPS_THIN_IFRAME_CLASS}`);

    googleMapsIframe.on("load", function () {
      setTimeout(() => {
        googleMapsImageContainer.fadeOut(1000, () => {
          googleMapsIframe.css("position", "relative");
          googleMapsImageContainer.remove();
        });
      }, 1000);
    });
  }, 2000);
}

function swapDesignPlaceholderToSlider() {
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
      var isSliderLoadedInterval = setInterval(function () {
        const isSliderLoaded = $(FIRST_SLIDER_TITLE_LINK_SELECTOR).length;
        if (isSliderLoaded) {
          clearInterval(isSliderLoadedInterval);
          resolve(true);
        }

        console.log($(DESIGN_SLIDER_LOADER_SELECTOR));
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

    designSlider.css({ "z-index": 10 });
    const sliderFakeImg = $(DESIGN_SLIDER_FAKE_IMG_SELECTOR);
    sliderFakeImg.css({ "z-index": -10 });

    setTimeout(() => {
      designSlider.css({ position: "relative" });
      sliderFakeImg.css({ position: "absolute" });
      sliderFakeImg.fadeOut(2000, () => sliderFakeImg.remove());
    }, 200);
  };

  setTimeout(() => {
    $(window).one("mousemove", () => {
      _swapDesignPlaceholderToSlider();
    });
    $(window).one("scroll", () => {
      _swapDesignPlaceholderToSlider();
    });
    $(window).one("click", () => {
      _swapDesignPlaceholderToSlider();
    });
  }, 0);

  setTimeout(() => {
    _swapDesignPlaceholderToSlider();
  }, SWAP_PLACEHOLDER_TO_DESIGN_SLIDER_TIMEOUT);
}

function addPointerIconToSliderTitleOnSlideFinish() {
  const designSliderId = $(
    `${DESIGN_SLIDER_CONTAINER_SELECTOR} [data-ssid]`
  ).attr("data-ssid");
  const designSliderSelector = `#n2-ss-${designSliderId}`;

  var slider = _N2[designSliderSelector];
  slider.sliderElement.addEventListener("mainAnimationComplete", function (e) {
    const sliderTitleLink = $(ACTIVE_SLIDER_TITLE_LINK_SELECTOR);
    const hasPointerIconAlready = !!sliderTitleLink.children(
      POINTER_ICON_SELECTOR
    ).length;
    if (hasPointerIconAlready) return;
    const pointerIcon = $(POINTER_ICON_HTML);
    pointerIcon.hide();
    sliderTitleLink.append(pointerIcon);
    pointerIcon.fadeIn(500);
  });
}

function addPointerIconToSliderTitle() {
  const addPointerIntoSliderTitleInterval = setInterval(function () {
    const sliderTitleLink = $(FIRST_SLIDER_TITLE_LINK_SELECTOR);
    if (!sliderTitleLink.length) return;
    clearInterval(addPointerIntoSliderTitleInterval);
    const pointerIcon = $(POINTER_ICON_HTML);
    pointerIcon.hide();
    sliderTitleLink.append(pointerIcon);
    pointerIcon.fadeIn(1000);
  }, 200);
}

function squareMeterCounter() {
  let amountInABox;
  $(".woocommerce-product-attributes-item__value").each(function () {
    const item = $(this);
    try {
      const showsAmountInABox = item
        .children()
        .eq(0)
        .children(0)
        .attr("href")
        .includes("dobozban-levo-mennyiseg");
      if (showsAmountInABox) {
        amountInABox = parseFloat(item.children().eq(0).children(0).text());
      }
    } catch (error) {}
  });

  if (!amountInABox) return;
  var boxCountInput = $('[name="quantity"]');

  const currentBoxAmount = parseInt(boxCountInput.val());
  const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
    currentBoxAmount * amountInABox
  } négyzetméter)</p>`;
  const addToCartSection = $(".sticky-add-to-cart");
  addToCartSection.append(message);

  $('input[value="-"]').click(function () {
    setTimeout(() => {
      $(".amount-in-box-message").remove();
      const currentBoxAmount = parseInt(boxCountInput.val());
      const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
        currentBoxAmount * amountInABox
      } négyzetméter)</p>`;
      addToCartSection.append(message);
    }, 0);
  });
  $('input[value="+"]').click(function () {
    setTimeout(() => {
      $(".amount-in-box-message").remove();
      const currentBoxAmount = parseInt(boxCountInput.val());
      const message = `<p class="amount-in-box-message"><strong>${currentBoxAmount} doboz</strong> (${
        currentBoxAmount * amountInABox
      } négyzetméter)</p>`;
      addToCartSection.append(message);
    }, 0);
  });
}

async function slideUpAndDownMobileMenuBar() {
  let mobileMenuBar = $(MOBILE_MENU_BAR_SELECTOR);
  const arrowUpDownBox = $(MOBILE_MENU_UP_DOWN_ARROW_BOX_HTML);
  let isInAnimation = false;
  let ishideAndShowArrowVisible = true;

  const toggleMobileMenuSlideUpDownArrow = () => {
    const isMobileMenuSticky = mobileMenuBar.hasClass(
      STICKY_MOBILE_MENU_BAR_CLASS_NAME
    );
    const shouldRevealArrow = isMobileMenuSticky && !ishideAndShowArrowVisible;
    if (shouldRevealArrow) {
      arrowUpDownBox.show();
      ishideAndShowArrowVisible = true;
      return;
    }
    const shouldHideArrow = !isMobileMenuSticky && ishideAndShowArrowVisible;
    if (shouldHideArrow) {
      arrowUpDownBox.hide();
      ishideAndShowArrowVisible = false;
    }
  };

  if (!mobileMenuBar.length) {
    mobileMenuBar = await getMobileMenuBar();
  }

  mobileMenuBar.append(arrowUpDownBox);
  toggleMobileMenuSlideUpDownArrow();
  $(window).scroll(function () {
    if (!checkIsOnMobileView()) return;
    toggleMobileMenuSlideUpDownArrow();
  });

  const hideAndShowMobileMenuArrow = $(MOBILE_MENU_BAR_ARROW_SELECTOR);
  arrowUpDownBox.click(function (e) {
    if (isInAnimation) return;
    isInAnimation = true;
    mobileMenuBar.toggleClass(MOBILE_MENU_BAR_INVISIBLE_CLASS_NAME);
    hideAndShowMobileMenuArrow.toggleClass(
      MOBILE_MENU_BAR_ARROW_ROTATED_SELECTOR
    );
    setTimeout(() => {
      isInAnimation = false;
    }, 500);
  });
}

function getMobileMenuBar() {
  return new Promise((resolve) => {
    let getMobileMenuBarInterval = setInterval(function () {
      const mobileMenuBar = $(MOBILE_MENU_BAR_SELECTOR);
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
  const pricesContainer = $(".product-main .price.product-page-price").eq(0);
  pricesContainer
    .children()
    .last()
    .css({ display: "block", "margin-bottom": "5px" });
  pricesContainer.children().last().removeClass("mcmp_recalc_price_row");
  pricesContainer.children().first().addClass("mcmp_recalc_price_row");
  pricesContainer
    .children()
    .first()
    .insertAfter(pricesContainer.children().last());
}

function setTileUnit() {
  $(".product-page-price .woocommerce-Price-amount")
    .eq(0)
    .children()
    .children()
    .text("Ft / Doboz");
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
      const salesAgentName = $(this).parent().siblings().find("h3").text();
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
    `${DESIGN_SLIDER_CONTAINER_SELECTOR} [data-ssid]`
  ).attr("data-ssid");
  const designSliderSelector = `#n2-ss-${designSliderId}`;
  _N2.r(designSliderSelector, function () {
    var slider = _N2[designSliderSelector];
    slider.sliderElement.addEventListener(
      "mainAnimationComplete",
      function (e) {
        dataLayer.push({ event: GTM_SLIDER_INTERACTION_TRIGGER_NAME });
      }
    );
  });
}

function sendViewCartEvent() {
  dataLayer.push({ event: GTM_VIEW_CART_EVENT_NAME });
}

function displayInlineContactInfos(inlineContactInfoElems) {
  // inlineContactInfoElems should be the return value of document.querySelectorAll which isnt an array but some kind of iterable
  const getContactInfoHtml = (tel, name, isInline = false) => {
    return `
  <strong style="color:#686868;">Kérdésével forduljon hozzánk bátran</strong>: 
  <i class="icon-phone" style="color: black;"></i> 
  <a class="${OCEAN_PHONE_CALL_LINK_CLASS}" href="tel:${tel}" style="cursor: pointer; color: #4e657b">${tel} - ${name}</a>
  ${isInline ? " - " : "<br>"}
  <a href="https://www.google.com/maps/place/%C3%93ce%C3%A1n+F%C3%BCrd%C5%91szoba+szalon/@47.5072966,19.1694088,17z/data=!3m1!4b1!4m5!3m4!1s0x4741c492289b176f:0x26d8f58d84c3afa9!8m2!3d47.507293!4d19.1715975" style="cursor: pointer; color: #4e657b" target="_blank">
    Térkép a bolthoz
  <i class="icon-map-pin-fill" style="color: #e94336; font-size: 23px;"></i>
  </a>
`;
  };
  inlineContactInfoElems = [...inlineContactInfoElems];
  inlineContactInfoElems.forEach((elem) => {
    inlineContactInfoElem = $(elem);
    const { tel, name } = getRandomContactInfo();
    const isInline = inlineContactInfoElem.attr(
      IS_CONTACT_INFO_INLINE_DATA_ATTR
    );
    const html = getContactInfoHtml(tel, name, isInline);
    inlineContactInfoElem.append(html);
  });
}

function fillContactInfoIntoPhoneNumberBtns(randomPhoneNumberBtnElems) {
  const phoneNumberBtns = [...randomPhoneNumberBtnElems];
  phoneNumberBtns.forEach((elem) => {
    const phoneNumberBtn = $(elem);
    const { tel, name } = getRandomContactInfo();
    phoneNumberBtn.attr("href", `tel:${tel}`);
    phoneNumberBtn.attr(SALES_AGENTS_NAME_ATTRIBUTE, name);

    const callToActionArr = phoneNumberBtn
      .attr("class")
      .match(`${RANDOM_PHONE_BTN_CTA_CLASS}[^\\s]*`);
    let callToActionMessage = "";
    if (callToActionArr)
      callToActionMessage = callToActionArr[0]
        .replace(RANDOM_PHONE_BTN_CTA_CLASS, "")
        .replace("-", " ");
    const btnInnerText = callToActionMessage
      ? `${callToActionMessage} - ${tel}`
      : `${callToActionMessage} - ${name}`;
    phoneNumberBtn.text(btnInnerText);
  });
}

function getRandomContactInfo() {
  return CONTACT_INFOS[Math.floor(Math.random() * CONTACT_INFOS.length)];
}

function gtmPhoneCallEvents(callBtnsOnPageJqueryObject) {
  callBtnsOnPageJqueryObject.on("click", function () {
    callBtn = $(this);
    const callEventOpts = {
      event: GTM_CALL_EVENT_NAME,
    };

    const isMachineRentPage =
      window.location.pathname === MACHINE_RENT_PAGE_PATH;
    const hasButtonShape = callBtn.hasClass("button");
    if (hasButtonShape) {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = CALL_BUTTON_NAME;
      callEventOpts[GTM_SALES_AGENT_NAME_VARIABLE] = callBtn.attr(
        SALES_AGENTS_NAME_ATTRIBUTE
      );
      dataLayer.push(callEventOpts);
      if (isMachineRentPage)
        dataLayer.push({ event: GTM_MACHINE_RENT_EVENT_NAME });
      return;
    }

    const isFooterPhoneCallLink =
      callBtn.parent().attr("itemprop") === "telephone";
    if (isFooterPhoneCallLink) {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = FOOTER_CALL_LINK_NAME;
    } else {
      callEventOpts[GTM_HTML_ELEMENT_VARIABLE] = INLINE_CALL_LINK_NAME;
    }

    const salesAgentName = callBtn.text().match(/[A-z].*/)[0];
    callEventOpts[GTM_SALES_AGENT_NAME_VARIABLE] = salesAgentName;
    dataLayer.push(callEventOpts);
    if (isMachineRentPage)
      dataLayer.push({ event: GTM_MACHINE_RENT_EVENT_NAME });
  });
}

function hasCategoryBanner(categoryBanners) {
  categoryBanners.on("click", function () {
    const categoryBanner = $(this);
    const nextPagesLink = categoryBanner.find("a").attr("href");
    window.open(nextPagesLink, "_blank");
  });
}
