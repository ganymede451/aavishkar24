<?php
/**
 * Featured Slider Options
 *
 * @package Costello
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'costello_featured_slider', array(
			'panel' => 'costello_theme_options',
			'title' => esc_html__( 'Featured Slider', 'costello' ),
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'costello' ),
			'section'           => 'costello_featured_slider',
			'type'              => 'select',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'costello_sanitize_number_range',

			'active_callback'   => 'costello_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'costello' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'costello' ),
			'section'           => 'costello_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'costello_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		costello_register_option( $wp_customize, array(
				'name'              => 'costello_slider_page_' . $i,
				'sanitize_callback' => 'costello_sanitize_post',
				'active_callback'   => 'costello_is_slider_active',
				'label'             => esc_html__( 'Page', 'costello' ) . ' # ' . $i,
				'section'           => 'costello_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'costello_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'costello_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since 1.0.0
	*/
	function costello_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'costello_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return costello_check_section( $enable );
	}
endif;
