<?php

class OCS_Display_Term {
  public $name = null; 
  public $slug = null;

  function __construct(string $name, string $slug) {
    $this->name = $name;
    $this->slug = $slug;
  }
}

function get_collection_images(array $choosen_filters) {
  if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

  $args = array(
    'post_type'             => 'designs',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => 20,
    'paged'                 => $paged,
  );

  if (isset($choosen_filters['tile_name'])) {
    $args['search_title'] = $choosen_filters['tile_name'];
    unset($choosen_filters['tile_name']);
  }

  if (!isset($choosen_filters['tile_type'])) {
    $args['orderby'] = 'rand';
    $choosen_filters['tile_type'] = 'burkolatok-product-category';
  }

  $args['tax_query'] = ['relation' => 'IN'];
         
  foreach ($choosen_filters as $query_var => $filter) {
    $args['tax_query'][] = [
      'taxonomy'      => 'design_category',
      'field' => 'slug',
      'terms' => [ $filter ]
    ];
  }

  $collections_query = new \WP_Query($args);
  if ($collections_query->post_count) {
    return $collections_query;
  };
  
  $GLOBALS['ocs_no_posts_message'] = 'Nem találtunk kollekciókat ezekkel a szűrőkkel, kérjük próbálozzon máshogy.';

  if (!isset($args['search_title'])) {
    return $collections_query;
  }

  unset($args['tax_query']);

  $collections_query = new \WP_Query($args);
  if ($collections_query->post_count) {
    $GLOBALS['ocs_no_posts_message'] = \Shared\Settings::NO_COLLECTIONS_WITH_THIS_NAME_MESSAGE;
  }

  return $collections_query;
}

function get_brand_and_family_design_categories(WP_Post $design) {
  $design_categories = get_the_terms( $design->ID, 'design_category' );
  if (!$design_categories || $design_categories instanceof WP_Error) return false;

  $brand_cat = '';
  $family_cat = '';

  foreach ($design_categories as $design_category) {
    $is_brand_or_family = term_is_ancestor_of(\Shared\Config::DESIGN_BRANDS_PRODUCT_CATEG_ID, $design_category, 'design_category');
    if (! $is_brand_or_family) continue;

    $is_brand = \Shared\Config::DESIGN_BRANDS_PRODUCT_CATEG_ID === $design_category->parent;
    if ($is_brand) {
      $brand_cat = $design_category;
    } else {
      $family_cat = $design_category;
    }

    if (!empty($brand_cat) && !empty($family_cat)) break;
  }

  if (empty($brand_cat) && empty($family_cat)) return false;
  return [ $brand_cat, $family_cat ];
}

function is_exhibited_in_shop(string $product_or_categ_slug) {
  $is_product = ! get_term_by('slug', $product_or_categ_slug, 'design_category');
  if ($is_product) {
    $args = array(
      'name'        => $product_or_categ_slug,
      'post_type'   => 'product',
      'post_status' => 'publish'
    );

    $product = get_posts($args);
    $product_can_not_be_identified_by_slug = count($product) !== 1;
    if ($product_can_not_be_identified_by_slug) return false;
    return has_term( \Shared\Config::EXHIBITED_IN_SHOP_TAG_SLUG, 'post_tag', $product[0]->ID);
  }

  $products = wc_get_products(array(
    'category' => array( $product_or_categ_slug),
  ));

  foreach($products as $product) {
    $is_exhibited = in_array(6184, $product->get_tag_ids());
    if ($is_exhibited) {
      return true;
    }
  }

  return false;
}

function get_category_names_by_parent(int $parent_id, array $excludes = []): array {
  $termchildren = array(
    'hierarchical' => 1,
    'show_option_none' => '',
    'hide_empty' => 0,
    'parent' => $parent_id ,
    'taxonomy' => 'design_category',
  );

  if (!empty($excludes))  $termchildren['exclude'] = $excludes;

  $categories = array_map(function ($category) { 
    return new OCS_Display_Term($category->name, $category->slug);
  }, get_categories($termchildren));

  return $categories;
}

function get_select_dropdown(string $name, array $items, string $label, $choosen = null) {
  $hasChoosen = !empty($choosen) && !is_null($choosen) && $choosen;
  $default = $hasChoosen ? 'selected' : '';

  ?>
    <div class="ocs_dropdown">
      <select name="<?= $name ?>" class="ocs_select thin-input">
        <option value="" <?= $default ?>><?= $label ?></option>
        
        <?php 
          foreach ($items as $item) {
            if (!empty($choosen) && $choosen->slug === $item->slug) {
              echo '<option value="'. $item->slug .'" selected>' . ucwords($item->name) . '</option>';
            } else {
              echo '<option value="'. $item->slug .'">' . ucwords($item->name) . '</option>';
            }
          }
        ?>
      </select>
    </div>
  <?php 
}

function get_choosen_GET_category(string $get_variable_name, array $categories ) {
  if (!isset($_GET[$get_variable_name])) {
    return '';
  }

  $valid_choosen_category = array_values(array_filter($categories, function($category) use($get_variable_name) {
    return $category->slug === $_GET[$get_variable_name];
  }));

  if (empty($valid_choosen_category)) {
    return false;
  }

  return $valid_choosen_category[0];
}

function  ocs_flatsome_posts_pagination(WP_Query $collections_query) {

  $prev_arrow = is_rtl() ? get_flatsome_icon('icon-angle-right') : get_flatsome_icon('icon-angle-left');
  $next_arrow = is_rtl() ? get_flatsome_icon('icon-angle-left') : get_flatsome_icon('icon-angle-right');

  $total = $collections_query->max_num_pages;
  $big = 999999999; // need an unlikely integer
  if( $total > 1 )  {

       if( get_option('permalink_structure') ) {
           $format = 'page/%#%/';
       } else {
           $format = '&paged=%#%';
       }
      $pages = paginate_links(array(
          'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format'        => $format,
          'current'       => max( 1, get_query_var('paged') ),
          'total'         => $total,
          'mid_size'      => 3,
          'type'          => 'array',
          'prev_text'     => $prev_arrow,
          'next_text'     => $next_arrow,
       ) );

      if( is_array( $pages ) ) {
          echo '<ul class="page-numbers nav-pagination links text-center">';
          foreach ( $pages as $page ) {
                  $page = str_replace("page-numbers","page-number",$page);
                  echo "<li>$page</li>";
          }
         echo '</ul>';
      }
  }

  function get_collection_brand_link() {
    
  }

  function get_collection_family_link() {

  }
}

function create_api_designs_thumbnails_field() {
  register_rest_field( array('designs'),
  'thumbnail',
  array(
      'get_callback'    => 'get_rest_featured_image',
      'update_callback' => null,
      'schema'          => null,
  )
 );
 }
 
 function get_rest_featured_image( $object ) {
   if( $object['featured_media'] ){
     return get_the_post_thumbnail_url($object['id'], 'thumbnail');
   }
 
   return false;
 }

 function echoFakeSliderInteractionJs(){
  ?>
    <script title="unlazy-footer"> 
        window.addEventListener('DOMContentLoaded', () => {
          let fakeSliderGesuredZone = document.querySelector('.design-slider__fake-slider-img');
          let fakeNextArrow = document.querySelector('.fake-arrow-next');
          let fakePrevArrow = document.querySelector('.fake-arrow-prev');

          let hasFakeSliderOnPage = fakeSliderGesuredZone && fakeNextArrow && fakePrevArrow;
          if (hasFakeSliderOnPage) {
            fakeSliderInteractions(fakeSliderGesuredZone, fakeNextArrow, fakePrevArrow)
          }
        });

        function fakeSliderInteractions(fakeSliderGesuredZone, fakeNextArrow, fakePrevArrow) {
          var touchstartX = 0;
          var touchendX = 0;

          fakeNextArrow.addEventListener('click', () => {
            slideSliderWhenLoaded(true);
          });
          
          fakePrevArrow.addEventListener('click', () => {
            slideSliderWhenLoaded(false);
          });

          fakeSliderGesuredZone.addEventListener('touchstart', function(event) {
            touchstartX = event.pageX;
          }, false);
            
          fakeSliderGesuredZone.addEventListener('touchend', function(event) {
            touchendX = event.pageX;
            handleSwipe(touchstartX, touchendX);
          }, false);
        }

        function handleSwipe(touchstartX, touchendX) {
          const swipedLeft = touchendX < touchstartX;
          if (swipedLeft) {
            slideSliderWhenLoaded(true);
            return;
          }
          
          const swipedRight = touchendX > touchstartX;
          if (swipedRight) {
            slideSliderWhenLoaded(false);
            return;
          }
        }

        function slideSliderWhenLoaded(next) {
          let sliderLoader =  document.querySelector('.slider-loader');
          sliderLoader.style.display = 'block';
          var isSliderLoadedInterval = setInterval(function () {
            const designSlider = document.querySelector(
              '.design-slider__real-slider [data-ssid]'
            );

            if (designSlider) {
              clearInterval(isSliderLoadedInterval);
              const designSliderId = `#n2-ss-${designSlider.getAttribute("data-ssid")}`;
              setTimeout(() => {
                moveSlider(next, designSliderId, sliderLoader)
              }, 300);
            }
          }, 200);
        }

        function moveSlider(next, designSliderId, sliderLoader) {
          _N2.r(designSliderId, function(){
            var slider = _N2[designSliderId];
            if (next) {
              slider.next();
            } else {
              slider.previous();
            }
            sliderLoader.style.opacity = 0;
            setTimeout(() => {
              sliderLoader.style.display = 'none';
            }, 1000)
          });
        }
    </script>
  <?php 
}