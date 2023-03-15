<?php


function create_waiter_blogs_section() {
  
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'waiter-in-blog',
    'posts_per_page'   => 4,
  );

  $query = new WP_Query( $args );
  $posts = $query->posts;
  
  return do_create_blog_section($posts);
}


function create_testimonials_waiter() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'waiter-testimonials',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;
  return do_create_testimonials_carousel($posts);
}


add_shortcode('waiter-blogs', 'create_waiter_blogs_section');
add_shortcode('testimonials-waiter', 'create_testimonials_waiter');

?>
