<?php
/**
 * Hero Content Options
 *
 * @package Costello
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'costello_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'costello' ),
			'panel' => 'costello_theme_options',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'costello' ),
			'section'           => 'costello_hero_content_options',
			'type'              => 'select',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_hero_content_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'costello_is_hero_content_active',
			'label'             => esc_html__( 'Section Tagline', 'costello' ),
			'section'           => 'costello_hero_content_options',
			'type'              => 'text',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'costello_sanitize_post',
			'active_callback'   => 'costello_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'costello' ),
			'section'           => 'costello_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

}
add_action( 'customize_register', 'costello_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'costello_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since 1.0.0
	*/
	function costello_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'costello_hero_content_visibility' )->value();

		return costello_check_section( $enable );
	}
endif;
