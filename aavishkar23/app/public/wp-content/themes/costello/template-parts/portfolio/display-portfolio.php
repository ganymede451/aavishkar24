<?php

/**
 * The template for displaying portfolio items
 *
 * @package Costello
 */

$enable = get_theme_mod('costello_portfolio_option', 'disabled');

if (!costello_check_section($enable)) {
	// Bail if portfolio section is disabled.
	return;
}

$costello_tagline = get_option('jetpack_portfolio_content');
$costello_title   = get_option('jetpack_portfolio_title', esc_html__('Projects', 'costello'));
?>

<div id="portfolio-content-section" class="section jetpack-portfolio layout-three">
	<div class="wrapper">
		<?php costello_section_heading($costello_tagline, $costello_title); ?>

		<div class="section-content-wrapper portfolio-content-wrapper layout-three">
			<div class="grid">
				<?php get_template_part('template-parts/portfolio/post-types', 'portfolio'); ?>
			</div>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
