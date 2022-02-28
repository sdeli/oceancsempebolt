<?php

/**
 * @return array<string>
 */
function get_colors_by_categories(): ColorTemplateValues {
  global $wpdb;
  $result = $wpdb->get_results ("SELECT * FROM  view_colors_by_categories");
  
  foreach ($result as $row) {
    echo '=========><br>';
    var_dump($row);
  }
}