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

    $output = '<div class="directday-flex directday-row-flex directday-tag-container alignwide article-tags">';

    foreach($all_cats as $cat) {
	if($cat['name'] != 'blog')
	        $output .= '<div class="directday-tag"><span>' . $cat['name'] . '</span><span>' . $cat['counter'] . '</span></div>';
    }

    $output .= '</div>';
    
    return $output;
}

function subscribe() {
    $output = '<div class="directday-blue-box directday-component-gap alignwide directday-flex directday-flex-space-between directday-subscription responsive-alignwide">';
    $output .= '<div class="directday-flex directday-col-flex directday-gap10"><p style="margin-top: -15px" class="directday-lg-font black-color caps">Subscribe to our newsletter</p><p style="margin-top: 12px;">And be up to date</p></div>';
    $output .= '<div style="height: 50px;" class="directday-text-input"><input placeholder="Your Email Adress" type="text" /><span class="directday-button">Subscribe</span></div>';
    $output .= '</div>';
    return $output;

}

function do_create_posts($posts) {

	$output = "";

    foreach($posts as $post) {

        $image = get_the_post_thumbnail_url($post->ID);
        $output .= '<div class="directday-recent-article-card">';
        $output .= '<div><img src="' . $image . '" />';
        $output .= '<p class="date">Published on ' . $post->post_date . '</p>';
        $output .= '<p class="title">' . $post->post_title . '</p></div>';


        $cats = get_the_category($post->ID);
        
        if(count($cats) == 2 || count($cats) > 3)
            $output .= '<div class="tags directday-flex-center">';
        else if(count($cats) == 3)
            $output .= '<div class="tags directday-flex-space-between" style="gap: 10px">';

        foreach($cats as $cat) {
		if($cat->name == 'blog')
			continue;
            $output .= '<p class="tag">' . $cat->name . '</p>';
	}

        $output .= '</div>';
        $output .= '</div>';
    }

	return $output;

}

function recent_posts() {

    $output = '<div class="directday-component-gap recent-posts-container alignwide">';
    $output .= '<p class="directday-page-title">RECENT ARTICLES</p>';
    $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap">';


    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'blog',
        'posts_per_page'   => 16,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;

    $output .= do_create_posts($posts);
    $output .= '</div>';
    $output .= '</div>';
    return $output;



}

function most_read_posts() {

    $output = '<div class="directday-component-gap recent-posts-container alignwide">';
    $output .= '<p class="directday-page-title">Most read Articles</p>';
    $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap">';


    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'blog',
	'tag' => 'most_read',
        'posts_per_page'   => 4,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;

    $output .= do_create_posts($posts);
    $output .= '</div>';
    $output .= '</div>';
    return $output;

}

function featured_post() {

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => 'blog',
	'tag' => 'featured',
        'posts_per_page'   => 12,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;
	if(count($posts) == 0) return "";


    $output = '<div class="directday-component-gap alignwide">';
    $output .= '<p class="directday-page-title">Featured Article</p>';
    $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap  directday-marginTop64">';

for($i = 0; $i < count($posts); $i++) {

	$post = $posts[$i];
	if($i != 0)
		$output .= '<div class="featured-article-container hidden">';
	else
		$output .= '<div class="featured-article-container">';

	$output .= '<div>';
        $image = get_the_post_thumbnail_url($post->ID);
        $output .= '<img src="' . $image . '" />';
	$output .= '</div>';

	$output .= '<div>';
        $output .= '<p class="date">Published on ' . $post->post_date . '</p>';
        $output .= '<p class="title">' . $post->post_title . '</p>';
        $output .= '<p class="desc normal-text-box">' . $post->post_excerpt . '</p>';
	$output .= '<div class="featured-links">';
	$output .= '<a href="' . get_permalink($post->ID) . '" class="directday-button">Read more</a>';
	if(count($posts) - 1 != $i)
		$output .= '<a data-idx="' . $i . '" class="directday-button white-button next-featured-article">NEXT <span class="fa fa-angle-right"></span></a>';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '</div>';
}
        $output .= '</div>';
	$output .= '</div>';

    return $output;

}

function most_read_articles() {

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'ASC',
        'category_name' => 'blog',
	'tag' => 'most_read',
        'posts_per_page'   => 6,
    );

    $query = new WP_Query( $args );
    $posts = $query->posts;
	if(count($posts) == 0) return "";


    $output = '<div class="directday-component-gap alignwide responsive-alignwide">';
    $output .= '<p class="directday-page-title">Most read Articles</p>';
	$i = 0;
    $output .= '<div id="all-most-read-posts">';

    foreach($posts as $post) {

	if($i == 0)
	        $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap directday-marginTop64 most-read-articles-container">';

	if($i == 3)
	        $output .= '<div class="directday-flex directday-row-flex directday-flex-wrap most-read-articles-container second-row">';

        $image = get_the_post_thumbnail_url($post->ID);
	$output .= '<div style="background: linear-gradient(to bottom, #000000c4, rgba(0, 0, 0, 0)), url(\'' . $image . '\')">';

	$output .= '<div class="desc">';
        $output .= '<p class="date">Published on ' . $post->post_date . '</p>';
        $output .= '<p class="title">' . $post->post_title . '</p>';

        $cats = get_the_tags($post->ID);
	$is_video = false;
	foreach($cats as $cat) {
		if($cat->name == 'video') {
			$is_video = true;
			break;
		}
	}

	if(!$is_video)
		$output .= '<a href="' . get_permalink($post->ID) . '" class="directday-button">Read now</a>';
	else {
		$output .= '<div data-idx="' . $i . '" class="directday-play"><div></div><div><span class="fa fa-play"></span></div></div>';
	}

	$output .= '</div>';

	if($is_video)
		$output .= '<div class="post_video hidden" id="post_video_' . $i . '">' . $post->post_content . '</div>';


        $cats = get_the_category($post->ID);

        if(count($cats) == 2 || count($cats) > 3)
            $output .= '<div class="blog-tags directday-flex-center">';
        else if(count($cats) == 3)
            $output .= '<div class="blog-tags directday-flex-space-between" style="gap: 10px">';

        foreach($cats as $cat) {
		if($cat->name == 'blog')
			continue;
            $output .= '<p class="tag">' . $cat->name . '</p>';
	}

	$output .= '</div>';
	$output .= '</div>';


	if($i == 2)
	        $output .= '</div>';

	$i++;
    }

	if($i > 3) {
		for($j = $i; $j < 6; $j++)
			$output .= '<div></div>';

	        $output .= '</div>';
	}




	$output .= '</div>';
        $output .= '</div>';

    return $output;

}


add_shortcode('articles_cats', 'create_articles_cats');
add_shortcode('articles_subscribe', 'subscribe');
add_shortcode('articles_recent', 'recent_posts');
add_shortcode('featured_post', 'featured_post');
add_shortcode('most_read_articles', 'most_read_articles');
add_shortcode('most_read_posts', 'most_read_posts');

?>
