<?php

require_once(get_theme_file_path('/inc/constants.php'));
if (wp_get_environment_type() === ENVIRONMENT_TYPE_LOCAL) {
  require_once(get_theme_file_path('/vendor/autoload.php'));
}
require_once(get_theme_file_path('/inc/classes.php'));
require_once(get_theme_file_path('/inc/elements.php'));
require_once(get_theme_file_path('/inc/helpers.php'));
require_once(get_theme_file_path('/inc/woocommerce/child-theme-structure-wc-category-page-header.php'));