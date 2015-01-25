<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

if ( ! function_exists( 'tdpersona_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since tdpersona 1.0
 */
function tdpersona_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<i class="fa fa-angle-double-left"></i>', 'Previous post link', 'tdpersona' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<i class="fa fa-angle-double-right"></i>', 'Next post link', 'tdpersona' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><i class="fa fa-angle-double-left"></i></span> Older posts', 'tdpersona' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><i class="fa fa-angle-double-right"></i></span>', 'tdpersona' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // tdpersona_content_nav

if ( ! function_exists( 'tdpersona_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since tdpersona 1.0
 */
function tdpersona_posted_on() {
	if ( 'post' == get_post_type() )  {
		$categories_list = get_the_category_list( __( ', ', 'tdpersona' ) );
	} else {
		$categories_list = '';
	}

	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
		ob_start();
		$comments_link = comments_popup_link( __( 'Leave a comment', 'tdpersona' ), __( '1 Comment', 'tdpersona' ), __( '% Comments', 'tdpersona' ) );
		$comments = ob_get_contents();
		ob_end_clean();

		$comment_sep = '<span class="sep"> / </span>';

	} else {
		$comments = '';
		$comment_sep = '';
	}

	printf( __( '
				<span class="author vcard">
					<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>
				</span>
				<span class="sep"> / </span>
				<span class="entry-cats">%4$s</span>
				<span class="sep"> / </span>
				<span class="entry-comments">%5$s</span>
				', 'tdpersona' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'tdpersona' ), get_the_author() ) ),
		get_the_author(),
		$categories_list,
		$comments
	);
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

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'tdpersona' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'tdpersona' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'tdpersona' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'tdpersona' ), get_the_date( _x( 'Y', 'yearly archives date format', 'tdpersona' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'tdpersona' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'tdpersona' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'tdpersona' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'tdpersona' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'tdpersona' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'tdpersona' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'tdpersona' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'tdpersona' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'tdpersona' );
	}
	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );
	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );
	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;