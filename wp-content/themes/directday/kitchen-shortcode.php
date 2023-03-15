<?php


function create_kitchen_blogs_section() {
  
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'kitchen-in-blog',
    'posts_per_page'   => 4,
  );

  $query = new WP_Query( $args );
  $posts = $query->posts;
  
  return do_create_blog_section($posts);
}


function create_testimonials_kitchen() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'kitchen-testimonials',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;
        return do_create_testimonials_carousel($posts);
}


add_shortcode('kitchen-blogs', 'create_kitchen_blogs_section');
add_shortcode('testimonials-kitchen', 'create_testimonials_kitchen');

?>
