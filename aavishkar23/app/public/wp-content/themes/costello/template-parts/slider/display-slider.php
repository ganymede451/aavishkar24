<?php

/**
 * The template used for displaying slider
 *
 * @package Costello
 */

$costello_enable_slider = get_theme_mod('costello_slider_option', 'disabled');

if ( ! costello_check_section( $costello_enable_slider ) ) {
	return;
}

?>

<div id="feature-slider-section" class="feature-slider-section section text-align-left content-align-left">
	<div class="wrapper section-content-wrapper feature-slider-wrapper">
		<div class="main-slider owl-carousel">
			<?php get_template_part('template-parts/slider/post-type-slider'); ?>
		</div><!-- .main-slider -->

		<div class="scroll-down">
			<span><?php esc_html_e('Scroll Down', 'costello'); ?></span>
			<?php echo costello_get_svg(array('icon' => 'angle-down')); ?>
		</div><!-- .scroll-down -->
	</div><!-- .wrapper -->
</div><!-- #feature-slider -->
