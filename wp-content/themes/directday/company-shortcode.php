<?php

function create_values_section() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'our-values',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $output = '<div class="our-values directday-flex directday-row-flex directday-flex-center alignwide">';
  
  foreach($posts as $post) {
    $output .= '<div class="card"><div>';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '</div><div><p class="title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '';
    $output .= '</div></div></div>';
  }

  $output .= '</div>';
  return $output;
}


add_shortcode('our-values', 'create_values_section');

?>