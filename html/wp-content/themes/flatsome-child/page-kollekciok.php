<?php
/*
Template name: kollekciok
*/
use \Shared\Settings;

add_filter( 'posts_where', 'ocs_posts_where', 10, 2 );
function ocs_posts_where( $where, $wp_query )
{
  $searched_title = $wp_query->get( 'search_title' );
  if (empty($searched_title)) return $where;

  $title_parts = explode(" ", $searched_title);
  global $wpdb;

  // $where .= " AND " . $wpdb->posts . ".post_title LIKE '%" . esc_sql( $wpdb->esc_like( $title ) ) . "%'";
  $where .= " AND " . $wpdb->posts . ".post_title LIKE '";

  foreach($title_parts as $title_part) {
    $where .= '%' . esc_sql( $wpdb->esc_like( $title_part ) );
  }

  $where .= "%'";
  return $where;
}

get_header(); ?>

<style>
  .searched_products_preview {
    box-shadow: 1px 1px 15px rgb(0 0 0 / 15%);
    position: absolute;
    z-index: 100;
    background: white;
    display: none;
    cursor: pointer;
    position: absolute;
    top: 45px;
  }

  .autocomplete-suggestion {
    cursor: pointer;
    min-width: 300px;
  }

  .autocomplete-suggestion img {
    margin-right: 21px;
  }

  .autocomplete-suggestion strong {
    color: #0173dd
  }

  .lightbox {
    line-height: unset;
  }
  .thin-input {
    height: 2.207em;
  }
  .ocs_product-search {
    position: relative;
    width: 100%;
  }

  .ocs_product-search input[type="search"] {
    background-color: rgba(0,0,0,.03);
    box-shadow: none;
    border-color: rgba(0,0,0,.09);
    color: currentColor!important;
    border-radius: 99px;
    padding: 0 0 0 10px;
  }

  .ocs_product-search .magnifying-glass{
    position: absolute;
    right: 14px;
    top: 8px;
  }

  select {
    background-color: rgba(0,0,0,.03);
    box-shadow: none;
    border-color: rgba(0,0,0,.09);
    color: currentColor!important;
    border-radius: 99px;
    background-image: url("data:image/svg+xml;charset=utf8, %3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-down'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-position: right 0.45em top 50%;
    background-repeat: no-repeat;
    padding-right: 1.4em;
    background-size: auto 16px;
    display: block;
    margin-bottom: unset;
  }
  
  select:focus {
    box-shadow: unset;
    background-color: rgba(0,0,0,.09);
  }

  .ocs_filters {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
    margin-right: auto;
    margin-left: auto;
    max-width: 1600px;
    padding-right: 5px;
    padding-left: 5px;
  }
  
  .ocs_dropdowns {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .ocs_dropdown, .ocs_product-search {
    width: 100%;
  }

  .ocs_product-search.--desktop,
  input[type="submit"].--desktop {
    display: none;
  }

  .ocs_collections {
    display: flex;
    flex-direction: column;
  }
  
  .ocs_collekcion {
    margin: 5px 0px;
    width: 100%;
    box-shadow: -1px 0px 9px #d7d7d7;
  }

  .ocs_collekcion:first-child{
    margin: 0 0 5px;
  }

  .ocs_collection_image {
    z-index: 10;
    width: 100%;
    height: 49.5vw;
    max-height: 421px;
    overflow: hidden;
    cursor: pointer;
  }

  .ocs_collection_image > img {
    width: 100%;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }

  .ocs_product_meta {
    margin: 5px;
    text-align: center;
  }
  .ocs_product_meta>span:first-child {
    border-top: unset;
  }
  
  .ocs_product_meta span.ocs_product_meta__brand_and_category {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 13px;
    font-size: 14px;
  }

  input[type="submit"] {
    border-radius: 25px;
    margin: unset;
  }

  ul.nav-pagination li {
    margin-left: 0;
  }

  @media only screen and (min-width: 550px) {
    .ocs_dropdowns {
      flex-direction: row;
    }
    .ocs_dropdown {
      width: 33%;
    }
    .thin-input {
      height: 2.507em;
    }
  }

  @media only screen and (min-width: 960px) {
    .ocs_collections {
      flex-direction: row;
      flex-wrap: wrap;
      margin: -6px -6px 5px;
      justify-content: center;
    }

    .ocs_collekcion {
      width: 48.5%;
      margin: 5px 5px 5px 5px;
    }

    .ocs_collekcion:first-child{
      margin: 5px 5px 5px 5px;
    }

    .ocs_collection_image {
      height: 32.5vw;
    }
  }

  @media only screen and (min-width: 1200px) {
    .ocs_filters {
      flex-direction: row;
      padding-right: 12px;
      padding-left: 12px;
    }
    .ocs_dropdowns {
      width: 70%;
    }
    .ocs_product-search,
    input[type="submit"] {
      display: none;
    }
    .ocs_product-search.--desktop,
    input[type="submit"].--desktop {
      width: 30%;
      display: block;
    }

    input[type="submit"].--desktop {
      width: 15%;
    }
    .ocs_collections {
      margin-right: auto;
      margin-left: auto;
      max-width: 1600px;
    }
  
    .ocs_collection_image {
      height: 26.5vw;
    }
  }
</style>
<style>
  .collections-loader-position {
    display: none;
    position: absolute;
    right: 50%;
    z-index: 100;
    transform: translateX(50%);
    transition: display 1s ease-in-out;
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
<?php do_action( 'flatsome_before_page' ); ?>
<?php 
  $tile_type_categories = get_category_names_by_parent(2803, [2440, 2435]);
  $choosen_tile_type = get_choosen_GET_category(Settings::TILE_TYPE, $tile_type_categories);
  
  $tile_color_categories = get_category_names_by_parent(2440);
  $choosen_tile_color =  get_choosen_GET_category(Settings::TILE_COLOR, $tile_color_categories);
  
  $tile_room_categories = get_category_names_by_parent(2435);
  $choosen_room = get_choosen_GET_category(Settings::ROOM, $tile_room_categories);

  $choosen_brand = '';
  if (isset($_GET[Settings::BRAND])) {
    $choosen_brand = filter_var($_GET[Settings::BRAND], FILTER_SANITIZE_STRING);
  }

  $choosen_family = '';
  if (isset($_GET[Settings::FAMILY])) {
    $choosen_family = filter_var($_GET[Settings::FAMILY], FILTER_SANITIZE_STRING);
  }

  $choosen_family = '';
  if (isset($_GET[Settings::FAMILY])) {
    $choosen_family = filter_var($_GET[Settings::FAMILY], FILTER_SANITIZE_STRING);
  }

  $choosen_name = '';
  if (isset($_GET['tile_name'])) {
    $choosen_name = filter_var($_GET['tile_name'], FILTER_SANITIZE_STRING);
  }



  $query_args = [];
  if ($choosen_tile_type) $query_args['tile_type'] = $choosen_tile_type->slug;
  if ($choosen_tile_color) $query_args['tile_color'] = $choosen_tile_color->slug;
  if ($choosen_room) $query_args['room'] = $choosen_room->slug;
  if ($choosen_brand) $query_args['marka'] = $choosen_brand;
  if ($choosen_family) $query_args['csalad'] = $choosen_family;
  if ($choosen_name) $query_args['tile_name'] = $choosen_name;

  $collections_query = get_collection_images($query_args);
  $found_kollections_without_filters = isset($GLOBALS['ocs_no_posts_message']) && $GLOBALS['ocs_no_posts_message'] === \Shared\Settings::NO_COLLECTIONS_WITH_THIS_NAME_MESSAGE;
?>
   
<div>
  <form action="/kollekciok/" method="get" style="margin: unset;">
    <div class="ocs_filters">
      <div class="ocs_product-search thin-input">
        <input type="search" class="search-field mb-0" placeholder="Kollekció név" value="<?= $choosen_name ?>" name="tile_name" autocomplete="off"> 
        <i class="icon-search magnifying-glass"></i>
        <div class="searched_products_preview"></div>
      </div>
      
      <?php if ($found_kollections_without_filters): ?>
        <div class="ocs_dropdowns">
          <?php echo get_select_dropdown(Settings::TILE_TYPE, $tile_type_categories, 'Burkolat típus') ?>
          <?php echo get_select_dropdown(Settings::TILE_COLOR, $tile_color_categories, 'Szín') ?>
          <?php echo get_select_dropdown(Settings::ROOM, $tile_room_categories, 'Szoba') ?>
        </div>
      <?php else: ?>
        <div class="ocs_dropdowns">
          <?php echo get_select_dropdown(Settings::TILE_TYPE, $tile_type_categories, 'Burkolat típus', $choosen_tile_type) ?>
          <?php echo get_select_dropdown(Settings::TILE_COLOR, $tile_color_categories, 'Szín', $choosen_tile_color) ?>
          <?php echo get_select_dropdown(Settings::ROOM, $tile_room_categories, 'Szoba', $choosen_room) ?>
        </div>
      <?php endif; ?>
      <input type="submit" value="Keresés">
      
      <div class="ocs_product-search --desktop">
        <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Kollekció név" value="<?= $choosen_name ?>" name="tile_name" autocomplete="off"> 
        <i class="icon-search magnifying-glass"></i>
        <div class="searched_products_preview"></div>
      </div>
      
      <input class="--desktop" type="submit" value="Keresés">
    </div>
  </form>
  
  <?php if (isset($GLOBALS['ocs_no_posts_message'])): ?>
    <div style="height: 35px; text-align: center; vertical-align:center">
      <strong style="margin: 0; position: relative; top: 1px;"><?= $GLOBALS['ocs_no_posts_message'] ?></strong>
    </div>
  <?php endif; ?>
  <div class="ocs_collections">
    <div class="collections-loader-position">
      <div class="collections-loader">Loading...</div>
    </div>
    <?php 
      if ($collections_query->have_posts()) {
        while ( $collections_query->have_posts() ) {
          $collections_query->the_post();
          $post;
          $featured_image_url_medium = get_the_post_thumbnail_url($post->ID, 'medium');
          $featured_image_url_medium_large = get_the_post_thumbnail_url($post->ID, 'medium_large');
          $featured_image_url_large = get_the_post_thumbnail_url($post->ID, 'large');
          $featured_image_url_full = get_the_post_thumbnail_url($post->ID, 'full');
          $featured_image_url_original = get_the_post_thumbnail_url($post->ID);

          $brand_and_family = get_brand_and_family_design_categories($post);

          $products_on_image_url = get_post_meta( $post->ID, 'products_in_design_url')[0];
          $product_or_category_slug = basename($products_on_image_url);
          $is_single_product = ! get_term_by('slug', $product_or_category_slug, 'design_category');
          $is_exhibited_in_shop = is_exhibited_in_shop($product_or_category_slug);
          $shop_message = $is_exhibited_in_shop ? \Shared\Config::TILE_EXHIBITED_IN_SHOP_MESSAGE : \Shared\Config::EXAMPLE_CAN_BE_REQUEST_MESSAGE;

          if (!empty($brand_and_family[0])) {
            $brand_link = Settings::KOLLECTIONS_PATH . "/?" . Settings::BRAND . "=" . $brand_and_family[0]->slug;
          }

          if (!empty($brand_and_family[0]) && !empty($brand_and_family[1])) {
            $family_link = Settings::KOLLECTIONS_PATH . "/?" . Settings::BRAND . "=" . $brand_and_family[0]->slug . '&' . Settings::FAMILY . "=" . $brand_and_family[1]->slug;
          }
      ?>

      <div class="ocs_collekcion">
        <div style="height: 35px; text-align: center; vertical-align:center">
        <h3 style="margin: 0; position: relative; top: 1px;"><?php the_title() ?></h3>
        </div>

        <div class="ocs_collection_image">
          <a href="<?= $featured_image_url_full ?>" data-lightbox="collection" style="display: none;"  data-title="<?php the_title() ?>"></a>
          <img 
            class="skip-lazy"
            src="<?php echo $featured_image_url_original ?>"
            srcset="<?php echo $featured_image_url_medium ?> 600w,  
              <?php echo $featured_image_url_medium_large ?> 768w, 
              <?php echo $featured_image_url_large ?> 1121w,
              <?php echo $featured_image_url_full ?> 1320w" 
          >
        </div>
        <div class="ocs_product_meta product_meta">
          <?php if (!empty($brand_and_family[0]) && !empty($brand_and_family[1])): ?>
            <span class="ocs_product_meta__brand_and_category">
              <span>Márka: <a href="<?= $brand_link ?>" rel="tag"><?= $brand_and_family[0]->name ?? '' ?></a></span>
              <span>Család: <a href="<?= $family_link ?>" rel="tag"><?= $brand_and_family[1]->name ?? '' ?></a></span>
            </span>
          <?php else: ?>
            <span class="ocs_product_meta__brand_and_category">
              <span>Márka: <a href="#" rel="tag"> - </a></span>
              <span>Kollekció: <a href="#" rel="tag"> - </a></span>
            </span>
          <?php endif; ?>

          <span>
            <span style="font-size: 15px;"><?= $shop_message ?></span>
          </span>
          <span><a href="<?= $products_on_image_url ?>"><?= $is_single_product ? 'Képen látható termék' : 'Képen látható termékek' ?></a></span>
        </div>
      </div>

      <?php } ?>

      
      <?php } ?>
    </div>  
    <div class="pagination">
      <?php ocs_flatsome_posts_pagination($collections_query); ?>
    </div>
</div>
<div class="invisble_overlay"></div>
<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
<script> 
  (function() {
    const ERROR_MESSAGE = 'Valami hiba történt... Vagy nincs internet, vagy hiba az oldalon. Ebben az esetben kérjük hivja fel a boltot, köszönjük.'
    const DESIGNS_REST_EP = window.location.protocol + '//' +  window.location.hostname + '/wp-json/wp/v2/designs/?per_page=20&page1&orderby=relevance';
    
    let isLoading = false;
    let requestForDesigns = false;
    let loadTerminated = false;

    $( document ).ready(function() {
      $('[type="submit"]').click(() => {
        isLoading = true;
        toggleLoader();
      })

      $('.ocs_collection_image > img').click(function() {
        const hiddenLightboxLink = $(this).siblings().eq(0).click();
      });

      $('[name="tile_name"]').keyup(debounce(async function() {
        handleTypingIntoSearchField(this);
        syncDataBetweenSearchFields(this);
      }));

      $('.invisble_overlay').click(function() {
        $(this).removeClass('--blocking');
        closeSearchedDesignsDropdown();
      });
    });

    function handleTypingIntoSearchField(that) {
      if (isLoading) {
        if (requestForDesigns) {
          loadTerminated = true;
          requestForDesigns.abort();
        };
      }

      const autocompleteContainer = $('.searched_products_preview');
      const isAutocompleteContainerOpen = autocompleteContainer.is(':visible');
      if (isAutocompleteContainerOpen) closeSearchedDesignsDropdown();

      const nameSearchField = $(that);
      const userClearedSearchField = !nameSearchField.val().trim().length;
      if (userClearedSearchField) {
        toggleLoader(true);
        return;
      };

      isLoading = true;
      toggleLoader();

      const searchedName = nameSearchField.val().trim();
      const ep = DESIGNS_REST_EP + '&search=' + searchedName; 

      requestForDesigns = $.get(ep, function( data ) {
        isLoading = false;
        toggleLoader();
        if (data.length) {
          displaySearchedDesignsDropdown(data, searchedName);
        } else {
          displaySearchedDesignsDropdown(data, searchedName);
        }
      })
      .fail(() => {
        if (loadTerminated) {
          loadTerminated = false;
        } else {
          alert(ERROR_MESSAGE);
          isLoading = false;
          toggleLoader(true);
        }
      });
    }

    function debounce(func, timeout = 300){
      let timer;
      return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
      };
    }

    function displaySearchedDesignsDropdown(collectionsData, searchedName) {
      $('.invisble_overlay').addClass('--blocking');
      const autocompleteContainer = $('.searched_products_preview');

      const noDesignsFound = !collectionsData.length;
      if (noDesignsFound) {
        autocompleteContainer.append($(
          `<div class="autocomplete-suggestion" data-index="0">
            <div class="search-name" style="text-align: center;">Nem találtunk egy kollekciót sem ezzel a névvel: <strong>${searchedName}</strong></div>
          </div>`));
          autocompleteContainer.fadeIn();

          return;
      }
      
      collectionItemsHtml = '';
      collectionsData.forEach((collectionData, i) => {
        const {thumbnail, title, design_category } = collectionData;
        collectionItemsHtml += getAutocomleteItemHtml(thumbnail, title.rendered, i, searchedName, design_category)
      });

      autocompleteContainer.append(collectionItemsHtml);

      $('.autocomplete-suggestion').click(function() {
        const choosenDesingsName = $(this).find('.search-name').text();
        $('[name="tile_name"]').val(choosenDesingsName);
        closeSearchedDesignsDropdown();
      });
      
      autocompleteContainer.fadeIn();
    }

    function getAutocomleteItemHtml(imageSrc, collectionName, i, searchedName, design_category) {
      const searchedParts = searchedName.split(' ');
      collectionName = searchedParts.reduce((collectionName, searchedPart) => {
        let regex = new RegExp(`${searchedPart.toLowerCase()}`, 'g');
        let replace = `<*>${searchedPart.toLowerCase()}</*>`;
        collectionName = collectionName.replace(regex, replace);

        lower = searchedPart.toLowerCase();
        searchedPart = searchedPart.charAt(0).toUpperCase() + lower.slice(1);
        regex = new RegExp(`${searchedPart}`, 'g');
        replace = `<*>${searchedPart}</*>`;
        return collectionName.replace(regex, replace);
      }, collectionName);

      const collectionNameWithHighlights = collectionName.replace(/\*/g, 'strong');
      return `<div class="autocomplete-suggestion" data-index="${i}">
          <img class="search-image" src="${imageSrc}">
          <div class="search-name" style="text-align: left;">${collectionNameWithHighlights}</div>
        </div>`;
    }

    function closeSearchedDesignsDropdown() {
      $('.autocomplete-suggestion').off('click');
      const autocompleteContainer = $('.searched_products_preview');
      autocompleteContainer.fadeOut(() => {
        autocompleteContainer.children().remove();
      })
    }

    function toggleLoader(shouldCloseIfOpen) {
      const loader = $('.collections-loader-position');
      if (shouldCloseIfOpen && loader.is(':visible')) {
        loader.fadeOut();
      }

      if (isLoading) {
        loader.fadeIn();
      } else {
        loader.fadeOut();
      }
    }

    function syncDataBetweenSearchFields(that) {
      const currentText = $(that).val();
      $('[name="tile_name"]').each(function(field) {
        const currentField = $(this);
        if (currentField.val() !== currentText) {
          currentField.val(currentText);
        }
      });
    }
  })();
</script>
