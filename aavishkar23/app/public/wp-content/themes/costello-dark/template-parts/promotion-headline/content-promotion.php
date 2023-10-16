<?php
/**
 * The template used for displaying hero content
 *
 * @package Costello_Dark
 */

$costello_enable_section = get_theme_mod( 'costello_promo_head_visibility', 'disabled' );

if ( ! costello_check_section( $costello_enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/promotion-headline/post-type', 'promotion' );
