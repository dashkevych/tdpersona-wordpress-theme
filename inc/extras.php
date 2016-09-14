<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since tdpersona 1.0
 */
function tdpersona_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tdpersona_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since tdpersona 1.0
 */
function tdpersona_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'tdpersona_body_classes' );

/**
 * Return logo style class
 */
function tdpersona_get_logo_class() {
	if( 'round' === get_theme_mod( 'tdpersona_logo_img_style', 'round' ) ) {
		return 'border-radius-circle';
	}
}