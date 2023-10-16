<?php

/**
 * The template for displaying testimonial items
 *
 * @package Costello
 */

$enable = get_theme_mod('costello_testimonial_option', 'disabled');

if (!costello_check_section($enable)) {
	// Bail if featured content is disabled
	return;
}
$costello_subtitle = get_theme_mod('costello_testimonial_subtitle');

$costello_tagline = get_option('jetpack_testimonial_content');
$costello_title    = get_option('jetpack_testimonial_title', esc_html__('Testimonials', 'costello'));

$classes[] = 'section testimonial-content-section';

if (!$costello_title && !$costello_description && !$costello_subtitle) {
	$classes[] = 'no-section-heading';
}

$costello_image    = get_theme_mod('costello_testimonial_image') ? get_theme_mod('costello_testimonial_image') : trailingslashit(esc_url(get_template_directory_uri())) . 'assets/images/no-thumb-666x666.jpg';;
?>

<div id="testimonial-content-section" class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<div class="wrapper">
		<div class="half-background" style="background-image: url( '<?php echo esc_url($costello_image); ?>' )"></div>
		<div class="half-content">
			<?php costello_section_heading($costello_tagline, $costello_title); ?>

			<div class="section-content-wrapper testimonial-content-wrapper testimonial-slider owl-carousel">
				<?php get_template_part('template-parts/testimonial/post-types-testimonial'); ?>
			</div><!-- .section-content-wrapper -->
		</div><!-- .half-content -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
