<?php
/*
 * This is the child theme for MusicFocus theme.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
function costello_dark_enqueue_styles() {
    // Include parent theme CSS.
    wp_enqueue_style( 'costello-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );
    
    // Include child theme CSS.
    wp_enqueue_style( 'costello-dark-style', get_stylesheet_directory_uri() . '/style.css', array( 'costello-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

    // Load the rtl.
    if ( is_rtl() ) {
        wp_enqueue_style( 'costello-rtl', get_template_directory_uri() . '/rtl.css', array( 'costello-style' ), $version );
    }

    // Enqueue child block styles after parent block style.
    wp_enqueue_style( 'costello-dark-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'costello-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'costello_dark_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function costello_dark_editor_style() {
    add_editor_style( array(
            'assets/css/child-editor-style.css',
            costello_fonts_url(),
        )
    );
}
add_action( 'after_setup_theme', 'costello_dark_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function costello_dark_block_editor_styles() {
    // Enqueue child block editor style after parent editor block css.
    wp_enqueue_style( 'costello-dark-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'costello-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'costello_dark_block_editor_styles', 11 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function costello_dark_body_classes( $classes ) {
    // Added color scheme to body class.
    $classes['color-scheme'] = 'color-scheme-dark';

    return $classes;
}
add_filter( 'body_class', 'costello_dark_body_classes', 100 );


/**
 * Include Promotion Headline
 */
require trailingslashit( get_stylesheet_directory() ) .  'inc/customizer/promotion-headline.php';

function costello_sections() {
    get_template_part('template-parts/header/header-media');
    get_template_part('template-parts/slider/display-slider');
    get_template_part('template-parts/promotion-headline/content-promotion');
    get_template_part('template-parts/portfolio/display-portfolio');
    get_template_part('template-parts/service/display-service');
    get_template_part('template-parts/hero-content/content-hero');
    get_template_part('template-parts/testimonial/display-testimonial');
    get_template_part('template-parts/featured-content/display-featured');

}

