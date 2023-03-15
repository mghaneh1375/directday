<?php
/**
 * Template for Slider - Design 1
 *
 * @package WP Responsive Recent Post Slider
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="wppsac-post-slides">
	<div class="wppsac-post-content-position">
		<div class="wppsac-post-content-left wpcolumns">
			
			<?php

			if( $showContent ) { ?>
			<div class="wppsac-post-content">
				<div class="wppsac-sub-content"><?php echo get_the_content() ?></div>
			</div>
			<?php } ?>
		</div>
		<div class="wppsac-post-image-bg">
			<a href="<?php the_permalink(); ?>">
				<?php if( ! empty( $slider_orig_img ) ) { ?>
				<img class="wppsac-post-image" <?php if( $lazyload ) { ?>data-lazy="<?php echo esc_url( $slider_orig_img ); ?>" <?php } ?> src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title_attribute(); ?>" />
				<?php } ?>
			</a>
		</div>
	</div>
</div>