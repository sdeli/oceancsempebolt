<?php
/*
Template name: kollekciok
*/

use \Shared\Settings;


get_header(); ?>

<style>  
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

  .ocs_product-search.--desktop {
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

  @media only screen and (min-width: 550px) {
    .ocs_dropdowns {
      flex-direction: row;
    }
    .ocs_dropdown {
      width: 33%;
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
    .ocs_product-search {
      display: none;
    }
    .ocs_product-search.--desktop {
      width: 30%;
      display: block;
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
  $has_valid_choosen_tile_type = isset($GET[Settings::TILE_TYPE]) && in_array($GET[Settings::TILE_TYPE], $tile_type_categories);
  $choosen_tile_type = $has_valid_choosen_tile_type ? $GET[Settings::TILE_TYPE] : '';
  
  $tile_color_categories = get_category_names_by_parent(2440);
  $has_valid_choosen_tile_color = isset($GET[Settings::TILE_COLOR]) && in_array($GET[Settings::TILE_COLOR], $tile_type_categories);
  $choosen_tile_color = $has_valid_choosen_tile_type ? $GET[Settings::TILE_COLOR] : '';
  
  $tile_room_categories = get_category_names_by_parent(2435);
  $has_valid_choosen_room = isset($GET[Settings::ROOM]) && in_array($GET[Settings::ROOM], $tile_type_categories);
  $choosen_room = $has_valid_choosen_tile_type ? $GET[Settings::ROOM] : '';
?>
   
<div>
  <div class="ocs_filters">
    <div class="ocs_product-search">
      <input type="search" class="search-field mb-0" placeholder="Search…" value="" name="product_name" autocomplete="off"> 
      <i class="icon-search magnifying-glass"></i> 
    </div>

    <div class="ocs_dropdowns">
      <?php echo get_select_dropdown(Settings::TILE_TYPE, $tile_type_categories, 'Burkolat típus') ?>
      <?php echo get_select_dropdown(Settings::TILE_COLOR, $tile_color_categories, 'Szín') ?>
      <?php echo get_select_dropdown(Settings::ROOM, $tile_room_categories, 'Szoba') ?>
    </div>

    <div class="ocs_product-search --desktop">
      <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Search…" value="" name="s" autocomplete="off"> 
      <i class="icon-search magnifying-glass"></i> 
    </div>
  </div>
  
  <div class="ocs_collections">
    <div class="collections-loader-position">
      <div class="collections-loader">Loading...</div>
    </div>
    <?php 
      $collections = get_collection_images();
      if ($collections->have_posts()) {
        while ( $collections->have_posts() ) {
          $collections->the_post();
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
      ?>

      <div class="ocs_collekcion">
        <div style="height: 35px; text-align: center; vertical-align:center">
        <h3 style="margin: 0; position: relative; top: 1px;"><?php the_title() ?></h3>
        </div>

        <div class="ocs_collection_image">
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
          <?php if ($brand_and_family): ?>
            <span class="ocs_product_meta__brand_and_category">
              <span>Márka: <a href="https://flatsome3.uxthemes.com/product-category/shoes/" rel="tag"><?= $brand_and_family[0]->name ?? '' ?></a></span>
              <span>Család: <a href="https://flatsome3.uxthemes.com/product-category/shoes/" rel="tag"><?= $brand_and_family[1]->name ?? '' ?></a></span>
            </span>
          <?php else: ?>
            <span class="ocs_product_meta__brand_and_category">
              <span>Márka: <a href="https://flatsome3.uxthemes.com/product-category/shoes/" rel="tag"> - </a></span>
              <span>Család: <a href="https://flatsome3.uxthemes.com/product-category/shoes/" rel="tag"> - </a></span>
            </span>
          <?php endif; ?>

          <span>
            <span style="font-size: 15px;"><?= $shop_message ?></span>
          </span>
          <!-- <span class="sku_wrapper">SKU: <span class="sku">N/A</span></span> -->
          <span><a href="<?= $products_on_image_url ?>"><?= $is_single_product ? 'Képen látható termék' : 'Képen látható termékek' ?></a></span>
        </div>
      </div>

    <?php }
    } ?>
  </div>  
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
