<?php
/**
 * Header Media Options
 *
 * @package Costello
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'costello' );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_option',
			'default'           => 'entire-site',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'costello' ),
				'entire-site'            => esc_html__( 'Entire Site', 'costello' ),
				'disable'                => esc_html__( 'Disabled', 'costello' ),
			),
			'label'             => esc_html__( 'Enable on', 'costello' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'costello_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'costello' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 80px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_before_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Tagline', 'costello' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'costello' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'costello' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_url',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'costello' ),
			'section'           => 'header_image',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'costello' ),
			'section'           => 'header_image',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_header_url_target',
			'sanitize_callback' => 'costello_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'costello' ),
			'section'           => 'header_image',
			'custom_control'    => 'Costello_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'costello_header_media_options' );
