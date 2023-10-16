<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Costello
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function costello_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    costello_register_option( $wp_customize, array(
            'name'              => 'costello_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Costello_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Costello Theme, go %1$shere%2$s', 'costello' ),
                '<a href="javascript:wp.customize.section( \'costello_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'costello_testimonials', array(
            'panel'    => 'costello_theme_options',
            'title'    => esc_html__( 'Testimonials', 'costello' ),
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
            'name'              => 'costello_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Costello_Note_Control',
            'active_callback'   => 'costello_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf(
                esc_html__('For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'costello'),
                '<a target="_blank" href="' . esc_url($install_url) . '">',
                '</a>'

            ),
            'section'            => 'costello_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    costello_register_option( $wp_customize, array(
            'name'              => 'costello_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'costello_is_ect_testimonial_active',
            'sanitize_callback' => 'costello_sanitize_select',
            'choices'           => costello_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'costello' ),
            'section'           => 'costello_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    costello_register_option( $wp_customize, array(
            'name'              => 'costello_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Costello_Note_Control',
            'active_callback'   => 'costello_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'costello' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'costello_testimonials',
            'type'              => 'description',
        )
    );

    costello_register_option( $wp_customize, array(
            'name'              => 'costello_testimonial_image',
            'custom_control'    => 'WP_Customize_Image_Control',
            'sanitize_callback' => 'costello_sanitize_image',
            'active_callback'   => 'costello_is_testimonial_active',
            'label'             => esc_html__( 'Image', 'costello' ),
            'section'           => 'costello_testimonials',
        )
    );

    costello_register_option( $wp_customize, array(
            'name'              => 'costello_testimonial_number',
            'default'           => '4',
            'sanitize_callback' => 'costello_sanitize_number_range',
            'active_callback'   => 'costello_is_testimonial_active',
            'label'             => esc_html__( 'Number of items', 'costello' ),
            'section'           => 'costello_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'costello_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for CPT
        costello_register_option( $wp_customize, array(
                'name'              => 'costello_testimonial_cpt_' . $i,
                'sanitize_callback' => 'costello_sanitize_post',
                'active_callback'   => 'costello_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'costello' ) . ' ' . $i ,
                'section'           => 'costello_testimonials',
                'type'              => 'select',
                'choices'           => costello_generate_post_array( 'jetpack-testimonial' ),
            )
        );

    } // End for().
}
add_action( 'customize_register', 'costello_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'costello_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since 1.0
    */
    function costello_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'costello_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return costello_check_section( $enable );
    }
endif;

if (!function_exists('costello_is_ect_testimonial_inactive')) :
    /**
     *
     * @since Costello 1.0
     */
    function costello_is_ect_testimonial_inactive($control)
    {
        return !(class_exists('Essential_Content_Jetpack_testimonial') || class_exists('Essential_Content_Pro_Jetpack_testimonial'));
    }
endif;

if (!function_exists('costello_is_ect_testimonial_active')) :
    /**
     *
     * @since Costello 1.0
     */
    function costello_is_ect_testimonial_active($control)
    {
        return (class_exists('Essential_Content_Jetpack_testimonial') || class_exists('Essential_Content_Pro_Jetpack_testimonial'));
    }
endif;
