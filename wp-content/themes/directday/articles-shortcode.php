<?php

function create_articles_cats() {

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'blog',
        'posts_per_page'   => 12,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;

    $all_cats = [];

    foreach($posts as $post) {
        
        $cats = get_the_category($post->ID);
        foreach($cats as $cat) {

            $idx = -1;
            $counter = 0;

            foreach($all_cats as $itr) {
                if($itr['name'] == $cat->name) {
                    $idx = $counter;
                    break;
                }
                
                $counter++;
            }

            if($idx == -1) {
                array_push($all_cats, [
                    'name' => $cat->name,
                    'counter' => 1
                ]);
            }
            else
                $all_cats[$idx]['counter'] = $all_cats[$idx]['counter'] + 1;

        }

    }

    $output = '<div class="directday-flex directday-row-flex directday-tag-container alignwide">';

    foreach($all_cats as $cat) {
        $output .= '<div class="directday-tag"><span>' . $cat['name'] . '</span><span>' . $cat['counter'] . '</span></div>';
    }

    $output .= '</div>';
    
    return $output;
    // return '
    
    // <div class="directday-tag"><span>Restaurant</span><span>10</span></div>
    // <div class="directday-tag"><span>Marketing</span><span>12</span></div>
    // <div class="directday-tag"><span>Point Of Sale</span><span>23</span></div>
    // <div class="directday-tag"><span>Business</span><span>11</span></div>
    // <div class="directday-tag"><span>Payments</span><span>10</span></div>
    // <div class="directday-tag"><span>Takeaway & Delivery</span><span>8</span></div>
    // <div class="directday-tag"><span>Partnership</span><span>8</span></div>
    // <div class="directday-tag"><span>News</span><span>12</span></div>
    // <div class="directday-tag"><span>Technology</span><span>10</span></div>
    // </div>';
}

function subscribe() {
    $output = '<div class="directday-blue-box directday-component-gap alignwide directday-flex directday-flex-space-between">';
    $output .= '<div class="directday-flex directday-col-flex directday-gap10"><p style="margin-top: -15px" class="directday-lg-font black-color">Subscribe to our newsletter</p><p>And be up to date</p></div>';
    $output .= '<div class="directday-text-input"><input placeholder="Your Email Adress" type="text" /><span class="directday-button">Subscribe</span></div>';
    $output .= '</div>';
    return $output;

}

function recent_posts() {
    $output = '<div class="directday-component-gap alignwide">';
    $output .= '<p class="directday-page-title">RECENT ARTICLES</p>';
    $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap">';

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'blog',
        'posts_per_page'   => 12,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;

    foreach($posts as $post) {
        $image = get_the_post_thumbnail_url($post->ID);
        $output .= '<div class="directday-recent-article-card">';
        $output .= '<div><img src="' . $image . '" />';
        $output .= '<p class="date">Published on ' . $post->post_date . '</p>';
        $output .= '<p class="title">' . $post->post_title . '</p></div>';

        $cats = get_the_category($post->ID);
        
        if(count($cats) == 1)
            $output .= '<div class="tags directday-flex-center">'; 
        else if(count($cats) == 2)
            $output .= '<div class="tags directday-flex-space-between" style="gap: 10px">'; 

        foreach($cats as $cat)
            $output .= '<p class="tag">' . $cat->name . '</p>';

        $output .= '</div>';
        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
    return $output;

}


add_shortcode('articles_cats', 'create_articles_cats');
add_shortcode('articles_subscribe', 'subscribe');
add_shortcode('articles_recent', 'recent_posts');

?>