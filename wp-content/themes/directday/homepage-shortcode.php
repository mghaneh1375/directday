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

    if(str_contains(strtolower($post->post_title), 'directday')) {
      $tmp = explode('directday', strtolower($post->post_title));
      $output .= '<p class="directday-page-title"><span class="directday-blue">DIRECTDAY</span><span>' .  $tmp[1] . '</span></p>';
    }
    else
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

function create_testimonials_carousel() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'testimonials',
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


function create_customer_epos() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'epos-customer',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $cards = count($posts);
  $neededW = 300 * $cards + 24 * ($cards - 1);
  $output = '<div class="EPOS" style="width: ' . $neededW . 'px">';
  $output .=  '<div class="circle"></div>';
  $output .=  '<div class="cards" style="left: 0px; width: ' . $neededW . 'px">';
  foreach($posts as $post) {
    $output .= '<div class="card">';
    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $output .= '</div>';
  }

  $output .= '</div>';  
  $output .= '</div>';
  return $output;
}

function create_business_epos() {
  
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'epos-business',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $cards = count($posts);
  $neededW = 300 * $cards + 24 * ($cards - 1);
  
  $output = '<div class="EPOS" style="width: ' . $neededW . 'px">';
  $output .=  '<div class="circle"></div>';
  $output .=  '<div class="cards" style="left: 0px; width: ' . $neededW . 'px">';
  $i = 0;

  foreach($posts as $post) {
    
    if($i == 1 && $cards == 3)
      $output .= '<div style="height: 450px; margin-top: -15px;" class="card">';
    else
      $output .= '<div class="card">';

    $output .= get_the_post_thumbnail($post->ID);
    $output .= '<p class="title">' . $post->post_title . '</p>';
    $output .= '<div class="desc">' . $post->post_content . '</div>';
    $output .= '</div>';
    $i++;
  }

  $output .= '</div>';  
  $output .= '</div>';
  return $output;
}

function create_switch_business_epos_button() {
  $output = '<div class="choose_epos_plan">';
  $output .= "<span class='selected' id='choose_business_epos'>for business</span>";
  $output .= "<span id='choose_customer_epos'>for customers</span>";
  $output .= '</div>';
  ?>

  <script>
    
      document.addEventListener('DOMContentLoaded', epos_handler, false);

      function epos_handler() {
        
        let elem = document.getElementById("choose_business_epos");
        let elem2 = document.getElementById("choose_customer_epos");

        elem.onclick = function() {
          let e2 = document.getElementsByClassName("business_epos")[0];
          let e3 = document.getElementsByClassName("customer_epos")[0];
          
          elem.classList.add('selected');
          elem2.classList.remove('selected');

          e2.classList.remove("hidden");
          e3.classList.add("hidden");
        };

        elem2.onclick = function() {
          
          let e2 = document.getElementsByClassName("business_epos")[0];
          let e3 = document.getElementsByClassName("customer_epos")[0];
          
          elem2.classList.add('selected');
          elem.classList.remove('selected');

          e3.classList.remove("hidden");
          e2.classList.add("hidden");
        };
      }


  </script>

  <?php
  return $output;
}

function create_journey_section() {

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
    'category_name' => 'journey',
    'posts_per_page'   => -1,
  );
  
  $query = new WP_Query( $args );
  $posts = $query->posts;

  $output = "<div class='steps alignwide'>";
  for($i = 1; $i <= count($posts); $i++) {
    $output .= '<div class="step">';
    $output .= '<p>' . $i . '</p>';
    $output .= '<p>' . $posts[$i - 1]->post_title .'</p>';
    $output .= $posts[$i - 1]->post_content;
    $output .= '<div class="line"></div>';
    $output .= '</div>';
  }
  $output .= "</div>";
  return $output;
}


add_shortcode('journey', 'create_journey_section');
add_shortcode('switch_business_epos_button', 'create_switch_business_epos_button');

add_shortcode('business_epos', 'create_business_epos');
add_shortcode('customer_epos', 'create_customer_epos');

add_shortcode('why_we_are_different_cards', 'create_why_we_are_different_cards');
add_shortcode('pos', 'create_pos_section');
add_shortcode('testimonials_carousel', 'create_testimonials_carousel');

?>