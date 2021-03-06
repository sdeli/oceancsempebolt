<?php
// namespace Shared;

$ver = \Shared\Utils::is_local() ? time() : false;

function ocs_enqueue()
{
  global $ver;
  wp_register_style('ocs_main_stylesheet', plugins_url(\Shared\Config::PLUGIN_NAME . '/assets/css/main.css'), [], $ver);
  wp_enqueue_style('ocs_main_stylesheet');
  

  wp_register_script('ocs_main_js', plugins_url(\Shared\Config::PLUGIN_NAME . '/assets/js/main.js'), ['jquery'], $ver);
  wp_enqueue_script('ocs_main_js', null, ['jquery'], false, true);

  $is_collections_page = strpos($_SERVER['REQUEST_URI'], \Shared\Settings::KOLLECTIONS_PATH) !== false;
  if ($is_collections_page) {
    wp_register_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', [], $ver);
    wp_enqueue_script('lightbox-js', null, ['jquery'], false, true);

    wp_register_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', [], $ver);
    wp_enqueue_style('lightbox-css');
  }
}

function add_styles_to_footer() {
  global $ver;
  add_action('get_footer', function() use($ver) {
    wp_register_style('ocs_poppins_font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,100;1,300;1,400&display=swap', [], $ver);
    wp_enqueue_style('ocs_poppins_font');
  } );
}