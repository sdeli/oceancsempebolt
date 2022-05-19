<?php
/**
 * @package oceancsempebolt
 * @version 5.9.3
 */
/*
Plugin Name: oceancsempebolt
*/

define( 'OCEANCSEMPEBOLT_PATH', plugin_dir_path( __FILE__ ) );

require_once(plugin_dir_path(__FILE__) . 'vendor/autoload.php');
\Inc\OceanCsempeBolt::init();