<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

if ( ! function_exists( 'tdpersona_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since tdpersona 1.0
 */
function tdpersona_posted_on() {
    
    $byline = sprintf(
		'%s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
    
    if ( 'post' === get_post_type() )  {
        echo '<span class="byline"> ' . $byline . '</span><span class="entry-cats">' . get_the_category_list( ', ' ) . '</span>'; // WPCS: XSS OK.
	} else {
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
    
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since tdpersona 1.0
 */
function tdpersona_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _s_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _s_categorized_blog should return false.
		return false;
	}
}

/**
 * Returns post date
 *
 * @since tdpersona 1.0
 */
 function tdpersona_post_date() {
 	$day = get_the_time('d');
 	$month = get_the_time('m');
 	$year = get_the_time('Y');

 	if( 'dmy' === get_theme_mod( 'tdpersona_blog_date_format', 'mdy' ) ) {
 		$date_format_html = '<span class="m-d">'.$day.'/'.$month.'</span><span class="year">'.$year.'</span>';
 	} else {
		$date_format_html = '<span class="m-d">'.$month.'/'.$day.'</span><span class="year">'.$year.'</span>';
 	}

 	$current_format = get_post_format();

 	if ( 'quote' === $current_format ) {
 		$post_icon = '<i class="fa fa-quote-right"></i>';
 	} else if ( 'aside' === $current_format ) {
 		$post_icon = '<i class="fa fa-thumb-tack"></i>';
 	} else if ( 'gallery' === $current_format ) {
 		$post_icon = '<i class="fa fa-camera"></i>';
 	} else if ( 'image' === $current_format ) {
 		$post_icon = '<i class="fa fa-picture-o"></i>';
 	} else if ( 'status' === $current_format ) {
 		$post_icon = '<i class="fa fa-bullhorn"></i>';
 	} else if ( 'video' === $current_format ) {
 		$post_icon = '<i class="fa fa-film"></i>';
 	} else if ( 'audio' === $current_format ) {
 		$post_icon = '<i class="fa fa-music"></i>';
 	} else if ( 'chat' === $current_format ) {
 		$post_icon = '<i class="fa fa-comments-o"></i>';
 	} else if ( 'link' === $current_format ) {
 		$post_icon = '<i class="fa fa-link"></i>';
 	}  else {
 		$post_icon = '<i class="fa fa-pencil"></i>';
 	}

 	$output = '<div class="post-icon-box border-radius-circle">';
	$output .= '<a href="'.esc_url( get_permalink() ).'">'.$post_icon.'</a>';
	$output .= '</div><!-- .post-icon-box -->';

	$output .= '<div class="entry-date">';
	$output .= '<a href="'.esc_url( get_permalink() ).'">'.$date_format_html.'</a>';
	$output .= '</div><!-- .entry-date -->';

	echo $output;
 }

/**
 * Returns post date (Alternative)
 *
 * @since tdpersona 1.0
 */
function tdpersona_post_date_alt() {
	// Set up and print post meta information.
	printf( '<span class="entry-date-alt"><a href="%1$s" rel="bookmark"><time class="entry-date-time" datetime="%2$s">%3$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}

/**
 * Flush out the transients used in tdpersona_categorized_blog
 *
 * @since tdpersona 1.0
 */
function tdpersona_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'tdpersona_category_transient_flusher' );
add_action( 'save_post', 'tdpersona_category_transient_flusher' );


if ( ! function_exists( 'tdpersona_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since tdpersona 2.0
 */
function tdpersona_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Adds custom class to uploaded logo.
 *
 * @since tdpersona 2.0
 */
function tdpersona_the_custom_logo_class( $attr ) {
    if( isset( $attr['class'] )  && 'custom-logo' === $attr['class'] ) {
        $attr['class'] .= ' ' . esc_attr( tdpersona_get_logo_class() );   
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'tdpersona_the_custom_logo_class' );