<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Costello
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Costello_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for Bold Photography Theme, go %1$shere%2$s', 'costello' ),
				 '<a href="javascript:wp.customize.section( \'costello_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'costello_portfolio', array(
			'panel'    => 'costello_theme_options',
			'title'    => esc_html__( 'Portfolio', 'costello' ),
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
		add_query_arg(
			array(
				'action' => $action,
				'plugin' => $slug
			),
			admin_url('update.php')
		),
		$action . '_' . $slug
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_portfolio_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Costello_Note_Control',
			'active_callback'   => 'costello_is_ect_portfolio_inactive',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf(
				esc_html__('For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'costello'),
				'<a target="_blank" href="' . esc_url($install_url) . '">',
				'</a>'

			),
			'section'            => 'costello_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_portfolio_option',
			'default'           => 'disabled',
			'active_callback'   => 'costello_is_ect_portfolio_active',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'costello' ),
			'section'           => 'costello_portfolio',
			'type'              => 'select',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Costello_Note_Control',
			'active_callback'   => 'costello_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'costello' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'costello_portfolio',
			'type'              => 'description',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'costello_sanitize_number_range',
			'active_callback'   => 'costello_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'costello' ),
			'section'           => 'costello_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'costello_portfolio_number', 6 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		costello_register_option( $wp_customize, array(
				'name'              => 'costello_portfolio_cpt_' . $i,
				'sanitize_callback' => 'costello_sanitize_post',
				'active_callback'   => 'costello_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'costello' ) . ' ' . $i ,
				'section'           => 'costello_portfolio',
				'type'              => 'select',
				'choices'           => costello_generate_post_array( 'jetpack-portfolio' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'costello_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'costello_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since 1.0.0
	*/
	function costello_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'costello_portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return (costello_is_ect_portfolio_active($control) && costello_check_section($enable));
	}
endif;

if (!function_exists('costello_is_ect_portfolio_inactive')) :
	/**
	 *
	 * @since Costello 1.0
	 */
	function costello_is_ect_portfolio_inactive($control)
	{
		return !(class_exists('Essential_Content_Jetpack_Portfolio') || class_exists('Essential_Content_Pro_Jetpack_Portfolio'));
	}
endif;

if (!function_exists('costello_is_ect_portfolio_active')) :
	/**
	 *
	 * @since Costello 1.0
	 */
	function costello_is_ect_portfolio_active($control)
	{
		return (class_exists('Essential_Content_Jetpack_Portfolio') || class_exists('Essential_Content_Pro_Jetpack_Portfolio'));
	}
endif;

