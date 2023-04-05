<?php

function send_mail() {

	$parameter = $_SERVER['QUERY_STRING'];

	if ($parameter && str_contains($parameter, 'mail=')) {

		$mailAddr = str_replace("%40", "@", explode('mail=', $parameter)[1]);


add_filter('wp_mail_content_type', function( $content_type ) {
            return 'text/html';
});

$msg = "<p>Username: 01234567890</p>";
$msg .= "<p>Password: 123456</p>";
wp_mail( $mailAddr, "DirectDay, Get a demo Account", $msg );

    		return '<p class="directday-mediumFont directday-marginTop24">' . str_replace("%40", "@", explode('mail=', $parameter)[1]) . '</p>';
	}

}


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
      $output .= '<p class="directday-page-title"><span style="text-transform: none" class="directday-blue">DirectDay</span><span>' .  $tmp[1] . '</span></p>';
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

function do_create_testimonials_carousel($posts) {

  $output = '<div id="testimonials_carousel_container" style="position: relative; overflow-x: hidden; height: 280px" class="alignfull"><div id="testimonials_carousel" class="testimonials_carousel">';

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

  $output .= '</div></div>';

  ?>
    

    <script>

	let w = window.innerWidth;
	if(w > 720) {

      document.addEventListener('DOMContentLoaded', fn, false);


	function sc_test(currIdx) {

	      var elem = document.getElementById("testimonials_carousel");

		let scroll = currIdx * 400;
        	elem.style.left = (w / 2 - scroll - 200) + "px";

	}

      function fn() {

	var elem = document.getElementById("testimonials_carousel");
        var el = document.querySelectorAll("#testimonials_carousel > .card");
	sc_test(el.length / 2);

          for(var i =0; i < el.length; i++) {
            if(el[i].classList.contains('active-card'))
              curr_testimonials_carousel_idx = i;
              
            el[i].onclick = function() {
                
                var elems = document.querySelectorAll("#testimonials_carousel > .card");

                [].forEach.call(elems, function(e2) {
                    e2.classList.remove("active-card");
                });

                this.classList = ['card active-card'];
		sc_test(this.getAttribute('data-idx'));
              };
          }

      }
}
      
    </script>

  <?php
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
	return do_create_testimonials_carousel($posts);
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
    'order' => 'DESC',
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

  $output = "<div id='steps-container'><div class='steps alignwide'>";
  for($i = 1; $i <= count($posts); $i++) {
    $output .= '<div class="step">';
    $output .= '<p>' . $i . '</p>';
    $output .= '<p>' . $posts[$i - 1]->post_title .'</p>';
    $output .= $posts[$i - 1]->post_content;
    $output .= '<div class="line"></div>';
    $output .= '</div>';
  }
  $output .= "</div></div>";
  return $output;
}

function do_create_blog_section($posts) {

  $output = '<div class="latest-blog-section directday-flex directday-col-flex directday-flex-center alignwide">';
  $output .= '<div style="margin-bottom: 64px;" class="directday-flex directday-row-flex">';

  foreach($posts as $post) {
      $image = get_the_post_thumbnail_url($post->ID);
      $output .= '<div class="directday-recent-article-card">';
      $output .= '<div><img src="' . $image . '" />';
      
      $cats = get_the_category($post->ID);

      $output .= '<p style="font-weight: bold; color: var(--direct-theme-blue); text-transform: uppercase; text-align: center; padding: 24px">' . $cats[0]->name . '</p>';
      $output .= '<p class="title"><a target="_blank" href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></p></div>';
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


function create_blogs_section() {
  
  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'blog',
    'posts_per_page'   => 4,
  );

  $query = new WP_Query( $args );
  $posts = $query->posts;
  

  return do_create_blog_section($posts);
}

add_shortcode('blogs', 'create_blogs_section');
add_shortcode('journey', 'create_journey_section');
add_shortcode('switch_business_epos_button', 'create_switch_business_epos_button');

add_shortcode('business_epos', 'create_business_epos');
add_shortcode('customer_epos', 'create_customer_epos');

add_shortcode('send_mail', 'send_mail');
add_shortcode('why_we_are_different_cards', 'create_why_we_are_different_cards');
add_shortcode('pos', 'create_pos_section');
add_shortcode('testimonials_carousel', 'create_testimonials_carousel');

?>
