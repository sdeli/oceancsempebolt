<?php

require_once(get_theme_file_path('/inc/widgets.php'));

function disable_wc_terms_toggle() { 
  remove_action( "woocommerce_checkout_terms_and_conditions", "wc_terms_and_conditions_page_content", 30 ); 
}

add_action( "wp", "disable_wc_terms_toggle" );

add_action('wp_footer','echoFakeSliderInteractionJs');

function echoFakeSliderInteractionJs(){
  ?>
    <script title="unlazy-footer"> 
        window.addEventListener('DOMContentLoaded', (event) => {
          var touchstartX = 0;
          var touchendX = 0;

          var fakeSliderGesuredZone = document.querySelector('.design-slider__fake-slider-img');

          let fakeNextArrow = document.querySelector('.fake-arrow-next');
          let fakePrevArrow = document.querySelector('.fake-arrow-prev');

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
            handleSwipe();
          }, false);

          function handleSwipe() {
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
        })
    </script>
  <?php 
}