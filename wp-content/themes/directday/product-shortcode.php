<?php

function create_for_business() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'for-business',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $output = '<div class="regular-card-section directday-flex directday-row-flex directday-flex-center alignwide">';
  
  foreach($posts as $post) {
    $output .= '<div class="card"><div>';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $output .= '</div><a href="/product/' . $post->post_name . '" class="directday-silver-button">START FREE</a></div>';
  }

  $output .= '</div>';
  return $output;
}


function create_for_customer() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'for-customer',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $output = '<div class="customer-card-section directday-flex directday-row-flex directday-flex-center alignwide">';
  
  foreach($posts as $post) {
    $output .= '<div class="card"><div>';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $output .= '</div><a class="directday-silver-button">Learn more</a></div>';
  }

  $output .= '</div>';
  return $output;
}

function create_others_section() {
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'ASC',
        'category_name' => 'others',
        'posts_per_page'   => -1,
    );
    
    $query = new WP_Query( $args );
    $posts = $query->posts;
    
    
    $output = '<div class="others-card-section directday-flex directday-row-flex directday-flex-center alignwide">';
    
    foreach($posts as $post) {
        $output .= '<div class="card"><div><div style="height: 150px">';
        $output .= get_the_post_thumbnail($post->ID);
        $output .= '</div><p class="title">' . $post->post_title . '</p>';
        $output .= '<div class="desc">' . $post->post_content . '</div>';
        $output .= '</div><span class="directday-silver-button">Learn more</span></div>';
    }

    $output .= '</div>';
    return $output;
}


add_shortcode('others', 'create_others_section');
add_shortcode('for_customer', 'create_for_customer');
add_shortcode('for_business', 'create_for_business');

?>
