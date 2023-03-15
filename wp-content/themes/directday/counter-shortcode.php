<?php


function create_counter_blogs_section() {
  
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'counter-in-blog',
    'posts_per_page'   => 4,
  );

  $query = new WP_Query( $args );
  $posts = $query->posts;
  
  return do_create_blog_section($posts);
}


function create_testimonials_counter() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'counter-testimonials',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;
  
  return do_create_testimonials_carousel($posts);
}


add_shortcode('counter-blogs', 'create_counter_blogs_section');
add_shortcode('testimonials-counter', 'create_testimonials_counter');

?>
