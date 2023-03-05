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
  
  $output = '<div class="directday-flex directday-col-flex directday-flex-center alignwide">';
  $output .= '<div style="margin-bottom: 64px;" class="directday-flex directday-row-flex">';

  foreach($posts as $post) {
      $image = get_the_post_thumbnail_url($post->ID);
      $output .= '<div class="directday-recent-article-card">';
      $output .= '<div><img src="' . $image . '" />';
      
      $cats = get_the_category($post->ID);

      $output .= '<p style="font-weight: bold; color: var(--direct-theme-blue); text-transform: uppercase; text-align: center; padding: 24px">' . $cats[0]->name . '</p>';
      $output .= '<p class="title">' . $post->post_title . '</p></div>';      
      $output .= '<div class="tags directday-flex-center">'; 
      $output .= '<p class="author">By Direct Day</p>';

      $output .= '</div>';
      $output .= '</div>';
  }

  $output .= '</div>';
  $output .= '<a href="/blogs" style="text-decoration: none !important" class="directday-silver-button directday-blue-border">VISIT OUR BLOG</a>';
  $output .= '</div>';

  return $output;
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
  
  $output = '<div id="testimonials_carousel" class="testimonials_carousel alignfull">';

  $middle = count($posts) / 2;
  $i = 0;

  foreach($posts as $post) {
    if($i == $middle)
      $output .= '<div data-idx="' . $i . '" class="card active-card">';
    else
      $output .= '<div data-idx="' . $i . '" class="card">';

    $output .= '<div>' . $post->post_content . '</div>';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<div class="info">';
    $infos = explode(',', $post->post_excerpt);
    foreach($infos as $info)
      $output .= '<p>' . $info . '</p>';
    $output .= '</div>';
    $output .= '</div>';
    $i++;
  }

  $output .= '</div>';

  ?>
    

    <script>

      document.addEventListener('DOMContentLoaded', fn, false);
      var curr_testimonials_carousel_idx = -1;

      function fn() {
        let elem = document.getElementById("testimonials_carousel");
        elem.scrollLeft = elem.offsetWidth / 2;

         var el = document.querySelectorAll("#testimonials_carousel > .card");
          for(var i =0; i < el.length; i++) {
            if(el[i].classList.contains('active-card'))
              curr_testimonials_carousel_idx = i;
              
            el[i].onclick = function() {
                
                var elems = document.querySelectorAll("#testimonials_carousel > .card");

                [].forEach.call(elems, function(e2) {
                    e2.classList.remove("active-card");
                });

                this.classList = ['card active-card'];
                elem.scrollLeft += (this.getAttribute('data-idx') - curr_testimonials_carousel_idx) * 400;
                curr_testimonials_carousel_idx = this.getAttribute('data-idx');
              };
          }

      }
      
    </script>

  <?php
  return $output;
}


add_shortcode('waiter-blogs', 'create_waiter_blogs_section');
add_shortcode('testimonials-waiter', 'create_testimonials_waiter');

?>