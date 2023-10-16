<?php
/**
 * The template for displaying featured content
 *
 * @package Costello
 */

$costello_enable_content = get_theme_mod( 'costello_featured_content_option', 'disabled' );

if ( ! costello_check_section( $costello_enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$costello_title   = get_option( 'featured_content_title', esc_html__( 'Contents', 'costello' ) );
$costello_tagline = get_option( 'featured_content_content' );

$costello_classes[] = 'section';
$costello_classes[] = 'featured-content';
$costello_classes[] = 'layout-three';


if( ! $costello_title && ! $costello_tagline ) {
	$costello_classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="<?php echo esc_attr( implode( ' ', $costello_classes ) ); ?>">
	<div class="wrapper">
		<?php costello_section_heading( $costello_tagline, $costello_title ); ?>

		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php get_template_part( 'template-parts/featured-content/content-featured' ); ?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
