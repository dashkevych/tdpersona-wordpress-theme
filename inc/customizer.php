<?php
/**
 * tdpersona Theme Customizer
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since tdpersona 1.0
 */
function tdpersona_customize_register( $wp_customize ) {

	/**
	* Theme Options
 	*/
 	$wp_customize->add_section( 'tdpersona_blog_settings', array(
     	'title'    => esc_html__( 'Theme Options', 'tdpersona' ),
     	'priority' => 2000,
	) );
    
    /* Position of site title and description */
	$wp_customize->add_setting( 'tdpersona_header_align', array(
		'default' => 'center',
		'sanitize_callback' => 'tdpersona_sanitize_site_identity_align'
	) );

	$wp_customize->add_control( 'tdpersona_header_align', array(
		'type' => 'select',
		'label' =>  esc_html__( 'Site Identity Position', 'tdpersona' ),
		'section' => 'tdpersona_blog_settings',
		'choices' => array(
			'left' => esc_html__( 'Left', 'tdpersona' ),
			'center' => esc_html__( 'Center', 'tdpersona' ),
			'right' => esc_html__( 'Right', 'tdpersona' ),
		),
        'priority' => 1,
        'description' => esc_html__( 'Choose a position for your site title and description.', 'tdpersona' ),
	) );
    
    /* Logo Corner Settings */
	$wp_customize->add_setting( 'tdpersona_logo_img_style', array(
		'default' => 'round',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'tdpersona_logo_img_style', array(
		'type' => 'select',
		'label' => esc_html__( 'Logo Style', 'tdpersona' ),
		'section' => 'tdpersona_blog_settings',
		'choices' => array(
			'round' => esc_html__( 'Round', 'tdpersona' ),
			'square' => esc_html__( 'Square', 'tdpersona' ),
		),
        
        'priority' => 2,
        'description' => esc_html__( 'Choose a style for your uploaded logo.', 'tdpersona' ),
	) );

	/* Date Format */
	$wp_customize->add_setting( 'tdpersona_blog_date_format', array(
        'default' => 'mdy',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

	$wp_customize->add_control( 'tdpersona_blog_date_format', array(
        'type' => 'radio',
        'label' => esc_html__( 'Date Format', 'tdpersona' ),
        'section' => 'tdpersona_blog_settings',
        'choices' => array(
            'mdy' => esc_html__( 'Month-Day-Year', 'tdpersona' ),
            'dmy' => esc_html__( 'Day-Month-Year', 'tdpersona' ),
        ),
        'priority' => 3,
        'description' => esc_html__( 'Choose a desired date format for your blog posts.', 'tdpersona' ),
    ));

    /* Auto Post Summary */
	$wp_customize->add_setting( 'tdpersona_blog_auto_summary', array(
        'default' => '',
        'sanitize_callback' => 'tdpersona_sanitize_post_excerpt_option'
    ) );

	$wp_customize->add_control( 'tdpersona_blog_auto_summary', array(
        'type' => 'select',
        'label' => esc_html__( 'Automatic Excerpt', 'tdpersona' ),
        'section' => 'tdpersona_blog_settings',
        'choices' => array(
            '1' => esc_html__( 'Enable', 'tdpersona' ),
            '' => esc_html__( 'Disable', 'tdpersona' ),
        ),
        'priority' => 4,
        'description' => esc_html__( 'Enable this option to use automatic post excerpts.', 'tdpersona' ),
    ) );
    
    /* Post Formats Navigations */
	$wp_customize->add_setting( 'tdpersona_post_formats_navigation', array(
		'default' => 'hide',
		'sanitize_callback' => 'tdpersona_sanitize_post_formats_nav'
	) );

	$wp_customize->add_control( 'tdpersona_post_formats_navigation', array(
		'type' => 'select',
		'label' => esc_html__( 'Post Formats Navigation', 'tdpersona' ),
		'section' => 'tdpersona_blog_settings',
		'choices' => array(
			'show' => esc_html__( 'Enable', 'tdpersona' ),
			'hide' => esc_html__( 'Disable', 'tdpersona' ),
		),
        'priority' => 5,
        'description' => esc_html__( 'Enable this option to display post formats links in the header section.', 'tdpersona' ),
	) );
}
add_action( 'customize_register', 'tdpersona_customize_register');

/** 
 * Sanitization: Post Formats Navigations
 */
function tdpersona_sanitize_post_formats_nav( $value ) {    
    if ( in_array( $value, array( 'show', 'hide' ) ) ) {
        return $value;
    } else {
        return 'hide';
    }
}

/** 
 * Sanitization: Post Excerpts
 */
function tdpersona_sanitize_post_excerpt_option( $value ) {
    if ( '1' == $value ) {
        return true;
    } else {
        return false;
    }
}

/** 
 * Sanitization: Position of site title and description
 */
function tdpersona_sanitize_site_identity_align( $value ) {
    if ( in_array( $value, array( 'left', 'right', 'center' ) ) ) {
        return $value;
    } else {
        return 'center';
    }
}

/** 
 * Sanitization: Logo Style
 */
function tdpersona_sanitize_logo_style( $value ) {
    if ( in_array( $value, array( 'round', 'square' ) ) ) {
        return $value;
    } else {
        return 'round';
    }
}