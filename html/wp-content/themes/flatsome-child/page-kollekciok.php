<?php
/*
Template name: kollekciok
*/
get_header(); ?>

<style>
  .sannya {
    background: blue;
    height: 200px;
  }

  .ocs_product-search {
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
    height: 32.5vw;
    overflow: hidden;
  }

  .ocs_collection_image > img {
    width: 100%;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
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
    margin: -6px -6px;
  }

  .ocs_collekcion {
    width: 49%;
    margin: 5px 5px 5px 5px;
  }

  .ocs_collekcion:first-child{
    margin: 5px 5px 5px 5px;
  }
}

@media only screen and (min-width: 1200px) {
  .ocs_filters {
    flex-direction: row;
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
}

</style>
<?php do_action( 'flatsome_before_page' ); ?>
<?php 
   $collections = get_collection_images();
?>
   
<div>

  <div class="ocs_filters">
    <div class="ocs_product-search">
      <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Search…" value="" name="s" autocomplete="off"> 
      <i class="icon-search magnifying-glass"></i> 
    </div>

    <div class="ocs_dropdowns">
      <div class="ocs_dropdown">
        <select name="setting" id="id_setting" class="ocs_select">
          <option value="" selected="">Burkolat típus</option>
          <option value="1">Bagno</option>
          <option value="3">Cucina</option>
          <option value="2">Living</option>
          <option value="5">Outdoor</option>
          <option value="4">Pubblico</option>
        </select>
      </div>

      <div class="ocs_dropdown">
        <select name="setting" id="id_setting" class="ocs_select">
          <option value="" selected="">Színvilág</option>
          <option value="1">Bagno</option>
          <option value="3">Cucina</option>
          <option value="2">Living</option>
          <option value="5">Outdoor</option>
          <option value="4">Pubblico</option>
        </select>
      </div>

      <div class="ocs_dropdown">
        <select name="setting" id="id_setting" class="ocs_select">
          <option value="" selected="">Rooms</option>
          <option value="1">Bagno</option>
          <option value="3">Cucina</option>
          <option value="2">Living</option>
          <option value="5">Outdoor</option>
          <option value="4">Pubblico</option>
        </select>
      </div>
    </div>

    <div class="ocs_product-search --desktop">
      <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Search…" value="" name="s" autocomplete="off"> 
      <i class="icon-search magnifying-glass"></i> 
    </div>
  </div>
  
  <div class="ocs_collections">
    <?php if ($collections->have_posts()) {
      while ( $collections->have_posts() ) {
        $collections->the_post();
        $post;
        $featured_image_url_medium = get_the_post_thumbnail_url($post->ID, 'medium');
        $featured_image_url_medium_large = get_the_post_thumbnail_url($post->ID, 'medium_large');
        $featured_image_url_large = get_the_post_thumbnail_url($post->ID, 'large');
        $featured_image_url_full = get_the_post_thumbnail_url($post->ID, 'full');
        $featured_image_url_original = get_the_post_thumbnail_url($post->ID);
      ?>

      <div class="ocs_collekcion">
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
      </div>

    <?php }
    } ?>
  </div>  
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
