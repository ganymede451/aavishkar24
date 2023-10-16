<?php
/**
 * Customizer functionality
 *
 * @package Costello
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since 1.0
 *
 * @see costello_header_style()
 */
function costello_custom_header_and_bg() {
	$default_background_color = '#ffffff';
	$default_text_color       = '#000000';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Zubin.
	 *
	 * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */

	// Adds a class of (full-width|box) to blogs.
	add_theme_support('custom-background', apply_filters('costello_custom_bg_args', array(
		'default-color' => $default_background_color,
	)));
	/**
	 * Filter the arguments used when adding 'custom-header' support in Zubin.
	 *
	 * @since 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'costello_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/assets/images/header-image.jpg' ),
		'default-text-color' => $default_text_color,
		'width'              => 1920,
		'height'             => 1080,
		'flex-height'        => true,
		'flex-height'        => true,
		'wp-head-callback'   => 'costello_header_style',
		'video'              => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-image.jpg',
			'thumbnail_url' => '%s/assets/images/header-image-275x155.jpg',
			'description'   => esc_html__( 'Default Header Image', 'costello' ),
		)
	) );
}
add_action( 'after_setup_theme', 'costello_custom_header_and_bg' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since 1.0
 */
function costello_customize_control_js()
{
	$min  = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	$path = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';


	wp_enqueue_style('costello-custom-controls-css', trailingslashit(esc_url(get_template_directory_uri())) . 'assets/css/customizer.css');
}
add_action('customize_controls_enqueue_scripts', 'costello_customize_control_js');
