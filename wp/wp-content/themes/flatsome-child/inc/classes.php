<?php
// class ColorTemplateValues {
//   public $id;
//   public $displayName;
//   public $slug;

//   function __construct(string $slug, int $id, string $displayName, $i)
// 	{
//     $this->$slug = $slug.$i;
//     $this->$displayName = $displayName;
//     $this->$id = $id;
//     echo 'inclasss2 ========';
//     echo '<br>id '.$this->$id.'<br>';
//     echo '<br> disp '.$this->$displayName.'<br>';
//     echo '<br> slug '.$this->$slug.'<br>';
// 	}
// }

  const OPENING_HOURS_HTML = <<<EOD
    <div>
      <span itemprop="telephone">
        <a href="tel:06709425095">06 70 942 5095 - Pinti István</a><br>
        <a href="tel:06303974150">06 30 397 4150 - Szabó István</a><br>
        <a href="tel:06706014600">06 70 601 4600 - Illés László</a>
      </span>
    </div>

    <div>
      <span itemprop="address" itemtype="http://schema.org/PostalAddress">
        <span itemprop="postalCode">1163 </span><span itemprop="addressLocality">Budapest </span> <span itemprop="streetAddress">Veres Péter út 15/A</span>
      </span>
    </div>

    <div>
      <i class="fa fa-envelope"></i><a href="mailto:oceancsempe@oceancsempe.hu "> oceancsempe@oceancsempe.hu</a>
    </div>

    <div style="display: flex; flex-direction: row; justify-content: flex-start; gap: 20px">
      <p><strong>Nyitva tartás:</strong><br>
        H-P: 09-18<br>
        Szo: 08-13
      </p>
      <p><strong>Árukiadás:</strong><br>
        H-P: 09-17:30<br>
        Szo: 08-12:30
      </p>
    </div>
    <a href="/kapcsolat/#unnepi-nyitvatartas" target="_blank"><strong>Ünnepi Nyitvatartás:</strong></a>
  EOD;

  class Sidebar_Sorting_Widget extends WP_Widget {
    const DESKTOP_CLASS = '--desktop';

    function __construct() {
      parent::__construct('Flatsome_sidebar_sorting', 'Flatsome_sidebar_sorting');
    }
    
    public function widget( $args, $instance ) {
      // $isDesktop = apply_filters( 'widget_title', $instance['logo-link'] );
      // if ($isDesktop) {
      //   echo '<div class="sidebar-product-sorting '.self::DESKTOP_CLASS.'">';
      // } else {
      //   echo '<div class="sidebar-product-sorting">';
      // }
      echo '<div class="sidebar-product-sorting">';
      
        do_action('flatsome_category_sort_order');
      echo '</div>';
    }
              
    // Widget Backend 
    public function form( $instance ) {
      if ( isset( $instance[ 'logo-link' ] ) ) {
          $isDesktop = $instance[ 'logo-link' ];
      } else {
        $isDesktop = false;
      }
    ?>

      <p>
        <label for="<?php echo $this->get_field_id( 'logo-link' ); ?>"><?php _e( 'logo link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'logo-link' ); ?>" name="<?php echo $this->get_field_name( 'logo-link' ); ?>" type="text" value="<?php echo esc_attr( $isDesktop ); ?>" />
      </p>
    <?php 
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['logo-link'] = ( ! empty( $new_instance['logo-link'] ) ) ? strip_tags( $new_instance['logo-link'] ) : '';
      return $instance;
    }
    
    // Class wpb_widget ends here
  }

  class Footer_Contact_Us_Widget extends WP_Widget {
    const DESKTOP_CLASS = '--desktop';

    function __construct() {
      parent::__construct('Footer_contact_us', 'Footer_contact_us');
    }
    
    public function widget( $args, $instance ) {
      $logoLink = apply_filters( 'widget_title', $instance['logo-link'] );
      echo '<div class="col opening-hours-footer-widget"><div style="display: flex; flex-direction: column; align-items: center; gap: 12px">';
        if ($logoLink) {
          echo <<<EOD
          <div>
            <a href="/">
              <img alt="logo" src="https://{$_SERVER['HTTP_HOST']}{$logoLink}">
            </a>
          </div>
          EOD;
        }

        echo OPENING_HOURS_HTML;
      echo '</div></div>';
    }
              
    // Widget Backend 
    public function form( $instance ) {
      if ( isset( $instance[ 'logo-link' ] ) ) {
          $isDesktop = $instance[ 'logo-link' ];
      } else {
        $isDesktop = false;
      }
    ?>

      <p>
        <label for="<?php echo $this->get_field_id( 'logo-link' ); ?>"><?php _e( 'logo link:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'logo-link' ); ?>" name="<?php echo $this->get_field_name( 'logo-link' ); ?>" type="text" value="<?php echo esc_attr( $isDesktop ); ?>" />
      </p>
    <?php 
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['logo-link'] = ( ! empty( $new_instance['logo-link'] ) ) ? strip_tags( $new_instance['logo-link'] ) : '';
      return $instance;
    }
    
    // Class wpb_widget ends here
  } 
   
   
  // Register and load the widget
  function load_widgets() {
      register_widget( 'Sidebar_Sorting_Widget' );
      register_widget( 'Footer_Contact_Us_Widget' );
  }

  add_action( 'widgets_init', 'load_widgets' );