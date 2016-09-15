<?php
/**
 * Theme help template.
 */

// Includes the files needed for the theme updater.
if ( !class_exists( 'Themes_Harbor_Getting_Started_Admin' ) ) {
	include( dirname( __FILE__ ) . '/getting-started-class.php' );
}

// Get theme slug.
$theme_slug = get_template();

// Loads the getting started class.
$helper = new Themes_Harbor_Getting_Started_Admin(
    
    // Config settings.
	$config = array(
		'remote_api_url' => wp_get_theme( $theme_slug )->get( 'AuthorURI' ),
		'theme_slug' => $theme_slug, 
        'rating_url' => 'https://wordpress.org/support/theme/tdpersona/reviews/?rate=5#postform',
	)
    
);
