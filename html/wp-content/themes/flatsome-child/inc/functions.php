<?php

function get_collection_images() {
  $args = array(
    'post_type'             => 'designs',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'orderby'               => 'rand',
    'posts_per_page'        => 20,
    // 'post__not_in' => array( $exclude_ids ),
    'tax_query'             => array(
      array(
          'taxonomy'      => 'design_category',
          'field' => 'slug',
          'terms'         => ['alfoldi'],
          'operator'      => 'IN'
      ),
    )
  );

  return new \WP_Query($args);
}