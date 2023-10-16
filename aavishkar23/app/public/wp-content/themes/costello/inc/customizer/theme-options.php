<?php
/**
 * Theme Options
 *
 * @package Costello
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'costello_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'costello' ),
		'priority' => 130,
	) );

	// Layout Options
	$wp_customize->add_section( 'costello_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'costello' ),
		'panel' => 'costello_theme_options',
		)
	);

	/* Default Layout */
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'costello_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'costello' ),
			'section'           => 'costello_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'costello' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'costello' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_homepage_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'costello_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'costello' ),
			'section'           => 'costello_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'costello' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'costello' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'costello_excerpt_options', array(
		'panel'     => 'costello_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'costello' ),
	) );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_excerpt_length',
			'default'           => '25',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 80px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'costello' ),
			'section'  => 'costello_excerpt_options',
			'type'     => 'number',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'costello' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'costello' ),
			'section'           => 'costello_excerpt_options',
			'type'              => 'text',
		)
	);

	// Search Options.
	$wp_customize->add_section( 'costello_search_options', array(
		'panel'     => 'costello_theme_options',
		'title'     => esc_html__( 'Search Options', 'costello' ),
	) );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_search_text',
			'default'           => esc_html__( 'Search a keyword', 'costello' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'costello' ),
			'section'           => 'costello_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'costello_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'costello' ),
		'panel'       => 'costello_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'costello' ),
	) );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_recent_posts_title',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'From Our Blog', 'costello' ),
			'label'             => esc_html__( 'Recent Posts Title', 'costello' ),
			'section'           => 'costello_homepage_options',
		)
	);

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_front_page_category',
			'sanitize_callback' => 'costello_sanitize_category_list',
			'custom_control'    => 'Costello_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'costello' ),
			'section'           => 'costello_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	//Menu Options
	$wp_customize->add_section('costello_menu_options', array(
		'description' => esc_html__('Extra Menu Options specific to this theme', 'costello'),
		'title'       => esc_html__('Menu Options', 'costello'),
		'panel'       => 'costello_theme_options',
	));

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_menu_type',
			'default'           => 'classic',
			'description'		=> esc_html__('If you’re using Classic Menu, the recommended displaying item is 5 max. on the primary menu.', 'costello'),
			'sanitize_callback' => 'costello_sanitize_select',
			'label'             => esc_html__('Menu Type', 'costello'),
			'section'           => 'costello_menu_options',
			'type'              => 'radio',
			'choices'           => array(
				'modern'  => esc_html__('Modern', 'costello'),
				'classic' => esc_html__('Classic', 'costello'),
			),
		)
	);
	//Menu Options End

	// Pagination Options.
	$pagination_type = get_theme_mod( 'costello_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'costello' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'costello_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'costello_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'costello' ),
		'active_callback' => 'costello_scroll_plugins_inactive'
	) );

	costello_register_option( $wp_customize, array(
			'name'              => 'costello_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'costello_sanitize_select',
			'choices'           => costello_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'costello' ),
			'section'           => 'costello_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'costello_scrollup', array(
		'panel'    => 'costello_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'costello' ),
	) );

	$action = 'install-plugin';
	$slug   = 'to-top';

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

	// Add note to Scroll up Section
	costello_register_option( $wp_customize, array(
			'name'              => 'costello_to_top_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Costello_Note_Control',
			'active_callback'   => 'costello_is_to_top_inactive',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf(
				esc_html__('For Scroll Up, install %1$sTo Top%2$s Plugin', 'costello'),
				'<a target="_blank" href="' . esc_url($install_url) . '">',
				'</a>'

			),
			'section'            => 'costello_scrollup',
			'type'              => 'description',
			'priority'          => 1,
		)
	);
}
add_action( 'customize_register', 'costello_theme_options' );

/** Active Callback Functions */
if ( ! function_exists( 'costello_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since 1.0.0
	*/
	function costello_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'costello_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since 1.0.0
	*/
	function costello_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if (!function_exists('costello_is_to_top_inactive')) :
	/**
	 * Return true if featured_content is active
	 *
	 * @since Simclick 0.1
	 */
	function costello_is_to_top_inactive($control)
	{
		return !(class_exists('To_Top'));
	}
endif;
