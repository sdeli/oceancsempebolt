<?php
// namespace Inc;
function ocs_enqueue()
{
    $ver =   OCS_IS_LOCAL_ENV ? time() : false;

    wp_register_style('ocs_main_stylesheet', plugins_url(OCS_PLUGIN_NAME . '/assets/css/main.css'), [], $ver);
    wp_enqueue_style('ocs_main_stylesheet');

    wp_register_script('ocs_main_js', plugins_url(OCS_PLUGIN_NAME . '/assets/js/main.js'), [], $ver);
    wp_enqueue_script('ocs_main_js', null, ['jquery'], false, true);
}