<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$id = get_the_ID();
$the_post = get_post($id);

$cats = get_the_category($post->ID);
$allow = false;

foreach($cats as $cat) {

	if($cat->name == "blog") {
		$allow = true;
		break;
	}
}

if(!$allow) {
	echo "404 not found";
	die();
}

?>

<div class="post alignwide">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php $url = wp_get_attachment_url( get_post_thumbnail_id($the_post->ID), 'thumbnail' ); ?>
<img src="<?php echo $url ?>" />


<div class="align-semi-wide content">
	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="title">', '</h1>' ); ?>
	</header><!-- .entry-header -->


        <p class="date">Published on <?php echo explode(' ', $post->post_date)[0] ?> </p>

	<div class="tags">
	<?php

        	foreach($cats as $cat) {
			if($cat->name == "blog")
				continue;
	            echo '<p class="tag">' . $cat->name . '</p>';
		}

	?>

	</div>

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div>

	<div class="directday-flex share-article-container">

	<?php
		$next_link = get_next_post_link($format = '%link &raquo;', $link = '%title', $in_same_term = true, $excluded_terms = '', $taxonomy = 'category' );
		$from = strpos($next_link, "href=") + 6;
		$to = strpos($next_link, "rel=") - 2;

		$next_link = substr($next_link, $from, $to - $from);
	?>

			<a class="directday-button white-button">Share</a>
			<a href="<?php echo $next_link ?>" class="directday-button">Next Article <span class="fa fa-angle-right"></span></a>
	</div>

</div>


<div class="directday-blue-box directday-component-gap alignwide directday-flex directday-flex-space-between directday-subscription">
	<div class="directday-flex directday-col-flex directday-gap10">
		<p style="margin-top: -15px" class="directday-lg-font black-color">Subscribe to our newsletter</p>
		<p>And be up to date</p>
	</div>
	<div class="directday-text-input">
		<input placeholder="Your Email Adress" type="text"><span class="directday-button">Subscribe</span>
	</div>
</div>

<?php echo most_read_posts(); ?>

<div class="directday-marginTop64 alignwide directday-flex">
	<a style="margin: 0 auto" href="/blogs" class="directday-silver-button directday-blue-border">VISIT OUR BLOG</a>
</div>

</article>
</div>
