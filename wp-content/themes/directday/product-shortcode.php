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
    $link = get_permalink( $post->ID );
    $output .= '</div><a href="' . $link . '" class="directday-silver-button">START FREE</a></div>';
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
    if($post->post_title == 'website')
	    $output .= '</div><a href="/company/#contact-form-container" class="directday-silver-button">Learn more</a></div>';
    else
	    $output .= '</div><a target="_blank" href="https://citymenu.app" class="directday-silver-button">Learn more</a></div>';

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
        $output .= '<div class="card">';
        $output .= '<p class="title">' . $post->post_title . '</p><figure>';
        $output .= get_the_post_thumbnail($post->ID);
        $output .= '</figure><div class="desc">' . $post->post_content . '</div>';
        $output .= '<a href="/company/#contact-form-container" class="directday-silver-button">Learn more</a></div>';
    }

    $output .= '</div>';
    return $output;
}


add_shortcode('others', 'create_others_section');
add_shortcode('for_customer', 'create_for_customer');
add_shortcode('for_business', 'create_for_business');

?>
