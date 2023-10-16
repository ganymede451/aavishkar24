<?php
/**
 * Services options
 *
 * @package Costello
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    costello_register_option( $wp_customize, array(
            'name'              => 'costello_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Costello_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options, go %1$shere%2$s', 'costello' ),
                '<a href="javascript:wp.customize.section( \'costello_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'costello_service', array(
			'title' => esc_html__( 'Services', 'costello' ),
			'panel' => 'costello_theme_options',
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
			'name'              => 'costello_service_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Costello_Note_Control',
			'active_callback'   => 'costello_is_ect_services_inactive',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf(
				esc_html__('For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'costello'),
				'<a target="_blank" href="' . esc_url($install_url) . '">',
				'</a>'

			),
			'section'            => 'costello_service',
			'type'              => 'description',
			'priority'          => 1,
		)
	);


	// Add color scheme setting and control.
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_service_option',
			'default'           => 'disabled',
			'active_callback'   => 'costello_is_ect_services_active',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'costello' ),
			'section'           => 'costello_service',
			'type'              => 'select',
		)
	);

    costello_register_option( $wp_customize, array(
            'name'              => 'costello_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Costello_Note_Control',
            'active_callback'   => 'costello_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'costello' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'costello_service',
            'type'              => 'description',
        )
    );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_service_number',
			'default'           => 3,
			'sanitize_callback' => 'costello_sanitize_number_range',
			'active_callback'   => 'costello_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'costello' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'costello' ),
			'section'           => 'costello_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
		);

	$number = get_theme_mod( 'costello_service_number', 3 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		costello_register_option( $wp_customize, array(
				'name'              => 'costello_service_cpt_' . $i,
				'sanitize_callback' => 'costello_sanitize_post',
				'active_callback'   => 'costello_is_service_active',
				'label'             => esc_html__( 'Services', 'costello' ) . ' ' . $i ,
				'section'           => 'costello_service',
				'type'              => 'select',
                'choices'           => costello_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'costello_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'costello_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since 1.0.0
	*/
	function costello_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'costello_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return (costello_is_ect_services_active($control) && costello_check_section($enable));
	}
endif;

if (!function_exists('costello_is_ect_services_inactive')) :
	/**
	 * Return true if service is active
	 *
	 * @since Costello 1.0
	 */
	function costello_is_ect_services_inactive($control)
	{
		return !(class_exists('Essential_Content_Service') || class_exists('Essential_Content_Pro_Service'));
	}
endif;

if (!function_exists('costello_is_ect_services_active')) :
	/**
	 * Return true if service is active
	 *
	 * @since Costello 1.0
	 */
	function costello_is_ect_services_active($control)
	{
		return (class_exists('Essential_Content_Service') || class_exists('Essential_Content_Pro_Service'));
	}
endif;
