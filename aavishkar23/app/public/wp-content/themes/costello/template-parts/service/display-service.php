<?php

/**
 * The template for displaying service content
 *
 * @package Costello
 */

$costello_enable_content = get_theme_mod('costello_service_option', 'disabled');

if (!costello_check_section($costello_enable_content)) {
	// Bail if service content is disabled.
	return;
}

$costello_tagline  = get_option('ect_service_content');
$costello_title    = get_option('ect_service_title', esc_html__('Services', 'costello'));

$costello_classes[] = 'service-section';
$costello_classes[] = 'section';

if (!$costello_title && !$costello_tagline) {
	$costello_classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr(implode(' ', $costello_classes)); ?>">
	<div class="wrapper">
		<?php costello_section_heading($costello_tagline, $costello_title); ?>

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php get_template_part('template-parts/service/content-service'); ?>
		</div><!-- .section-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
