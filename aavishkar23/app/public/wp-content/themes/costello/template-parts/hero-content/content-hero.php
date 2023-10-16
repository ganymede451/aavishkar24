<?php
/**
 * The template used for displaying hero content
 *
 * @package Costello
 */

$costello_enable_section = get_theme_mod( 'costello_hero_content_visibility', 'disabled' );

if ( ! costello_check_section( $costello_enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type-hero' );

