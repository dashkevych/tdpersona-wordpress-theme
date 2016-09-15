<?php
/**
 * tdpersona functions and definitions
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since tdpersona 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */

if ( ! function_exists( 'tdpersona_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since tdpersona 1.0
 */
function tdpersona_setup() {
    
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'tdpersona', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Custom Background
	 */
	add_theme_support( 'custom-background', apply_filters( 'tdpersona_custom_background_args', array(
		'default-color' => 'fbfbfb',
		'default-image' => '',
	) ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'tdpersona' ),
	) );
    
    // Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'video', 'quote', 'link', 'aside', 'status', 'chat' ) );

	/*
	 * Enable support for custom logo.
	 */
    add_theme_support( 'custom-logo', array(
		'height'      => 600,
		'width'       => 600,
		'flex-height' => true,
        'header-text' => array( 'site-title', 'site-description' ),
	) );
}
endif; // tdpersona_setup
add_action( 'after_setup_theme', 'tdpersona_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since tdpersona 1.0
 */
function tdpersona_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'tdpersona' ),
        'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'tdpersona' ),
		'id' => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Footer', 'tdpersona' ),
        'description'   => esc_html__( 'Appears in the footer section of the site.', 'tdpersona' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div class="footer-widget col-lg-4 col-md-4"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'tdpersona_widgets_init' );

/**
 * Register Google Fonts.
 */
function tdpersona_google_fonts() {
	$fonts_url = '';
    
    /* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sans_font = _x( 'on', 'Source Sans Pro: on or off', 'tdpersona' );

	if ( 'off' !== $sans_font ) {
		$font_families = array();
		$font_families[] = 'Source Sans Pro:300,300i,600,600i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext,cyrillic,cyrillic-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles
 */
function tdpersona_scripts() {
	wp_enqueue_style( 'tdpersona-googlefonts', tdpersona_google_fonts(), array(), null );
	wp_enqueue_style( 'tdpersona-icons', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'tdpersona-framework', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'tdpersona-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_register_script( 'tdpersona-js-assets', get_template_directory_uri() . '/js/jquery.assets.js', array( 'jquery' ), '201401', true  );
	wp_enqueue_script( 'tdpersona-script', get_template_directory_uri() . '/js/tdpersona.js', array( 'tdpersona-js-assets' ), '201301', true  );

}
add_action( 'wp_enqueue_scripts', 'tdpersona_scripts' );

/**
 *	Custom style/script to website head
 *	@since tdpersona 1.0
 */
function tdpersona_head() {
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
	<script src="<?php echo get_template_directory_uri() ?>/js/respond.min.js"></script>
	<![endif]-->
	<?php
}
add_action( 'wp_head', 'tdpersona_head' );

/**
 *	Customize excerpts more tag
 *	@since tdpersona 1.0
 */
function tdpersona_excerpt_more( $more ) {
	return '... <a class="moretag" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">'.esc_html__( 'Continue reading...', 'tdpersona' ).'</a>';
}
add_filter( 'excerpt_more', 'tdpersona_excerpt_more' );

/**
*	Add class to excerpt paragraph
*	@since tdpersona 1.0
*/
function tdpersona_add_class_to_excerpt( $excerpt ) {
    return str_replace( '<p', '<p class="excerpt"', $excerpt );
}
add_filter( "the_excerpt", "tdpersona_add_class_to_excerpt" );

/**
*	Add standart post format to archive
*	@since tdpersona 1.0
*/
function tdpersona_add_format_standard_archive($query) {
	if( isset($query->query_vars['post_format'] ) && $query->query_vars['post_format'] == 'post-format-standard' ) {
		if (($post_formats = get_theme_support('post-formats')) &&
			is_array($post_formats[0]) && count($post_formats[0])) {
			$terms = array();

			foreach ($post_formats[0] as $format) {
				$terms[] = 'post-format-'.$format;
			}

			$query->is_tax = null;
			unset($query->query_vars['post_format']);
			unset($query->query_vars['taxonomy']);
			unset($query->query_vars['term']);
			unset($query->query['post_format']);

			$query->set('tax_query', array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'terms' => $terms,
					'field' => 'slug',
					'operator' => 'NOT IN'
				)
			));
		}
	}
}
add_action('pre_get_posts', 'tdpersona_add_format_standard_archive');

/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates
 */
require( get_template_directory() . '/inc/extras.php' );

/**
 * Customizer additions
 */
require( get_template_directory() . '/inc/customizer.php' );

/**
 * Load Dashboard help file.
 */
require get_template_directory() . '/inc/help/helper.php';