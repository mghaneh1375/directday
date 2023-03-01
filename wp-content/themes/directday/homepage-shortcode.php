<?php


function create_why_we_are_different_cards() {
    
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'why-we-are-diff',
    'posts_per_page'   => -1,
  );

  $output = '<div class="why-we-are-different alignwide">';
  $query = new WP_Query( $args );
  $posts = $query->posts;

  foreach($posts as $post) {
    $output .= '<div class="card">';
    
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="title">' . $post->post_name . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $output .= '</div>';
  }
  
    $output .= '</div>';
    return $output;
}


function create_pos_section() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'homepage',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $output = '';

  foreach($posts as $post) {
    if(!str_contains($post->post_title, 'POS'))
      continue;

    $output = '<div class="directday-component-gap directday-flex directday-col-flex directday-flex-center directday-blue-box alignwide pos-container">';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="directday-page-title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $posttags = get_the_tags($post->ID);
    
    if (count($posttags) > 0) {
      
      $output .= '<div class="tags">';

      foreach($posttags as $tag) {
        $output .= '<span class="tag">' . $tag->name . '</span>';
      }

      $output .= '</div>';
    }
    $output .= '</div>';
    break;
  }

  return $output;
}

add_shortcode('why_we_are_different_cards', 'create_why_we_are_different_cards');
add_shortcode('pos', 'create_pos_section');

?>