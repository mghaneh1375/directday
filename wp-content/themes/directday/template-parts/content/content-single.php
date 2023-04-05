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
	        $cats = get_the_category($post->ID);

        	foreach($cats as $cat)
	            echo '<p class="tag">' . $cat->name . '</p>';

	?>
	</div>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
	</div>
</div>


<div class="directday-blue-box directday-component-gap alignwide directday-flex directday-flex-space-between">
	<div class="directday-flex directday-col-flex directday-gap10">
		<p style="margin-top: -15px" class="directday-lg-font black-color">Subscribe to our newsletter</p>
		<p>And be up to date</p>
	</div>
	<div class="directday-text-input">
		<input placeholder="Your Email Adress" type="text"><span class="directday-button">Subscribe</span>
	</div>
</div>

<?php echo recent_posts(); ?>

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article>
</div>
