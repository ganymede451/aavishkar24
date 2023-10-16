<?php
/**
 * Promotion Headline Options
 *
 * @package Costello_Dark
 */

/**
 * Add promotion headline options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_promo_head_options( $wp_customize ) {
	$wp_customize->add_section( 'costello_promotion_headline', array(
			'title' => esc_html__( 'Promotion Headline', 'costello-dark' ),
			'panel' => 'costello_theme_options',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_promo_head_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'costello-dark' ),
			'section'           => 'costello_promotion_headline',
			'type'              => 'select',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_promo_head_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'costello_is_promotion_headline_active',
			'label'             => esc_html__( 'Section Tagline', 'costello-dark' ),
			'section'           => 'costello_promotion_headline',
			'type'              => 'text',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_promotion_headline',
			'default'           => '0',
			'sanitize_callback' => 'costello_sanitize_post',
			'active_callback'   => 'costello_is_promotion_headline_active',
			'label'             => esc_html__( 'Page', 'costello-dark' ),
			'section'           => 'costello_promotion_headline',
			'type'              => 'dropdown-pages',
		)
	);

}
add_action( 'customize_register', 'costello_promo_head_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'costello_is_promotion_headline_active' ) ) :
	/**
	* Return true if promotion headline is active
	*
	* @since 1.0.0
	*/
	function costello_is_promotion_headline_active( $control ) {
		$enable = $control->manager->get_setting( 'costello_promo_head_visibility' )->value();

		return costello_check_section( $enable );
	}
endif;

