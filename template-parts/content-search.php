<?php
/**
 *  The template used for displaying search content.
 *
 * @package tdpersona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="responsive-date">
				<?php tdpersona_post_date_alt(); ?>
			</div><!-- .responsive-date -->
			<?php tdpersona_post_date(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-meta bottom">
		<?php tdpersona_posted_on(); ?>
        
        <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
        <span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'tdpersona' ), esc_html__( '1 Comment', 'tdpersona' ), esc_html__( '% Comments', 'tdpersona' ) ); ?></span>
        <?php endif; ?>
        
		<?php edit_post_link( esc_html__( 'Edit', 'tdpersona' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

	<div class="post-seperator">
        <button class="go-top-box border-radius-circle has-icon">
            <span class="screen-reader-text"><?php esc_html_e( 'Go to the Top', 'tdpersona' ); ?></span>
        </button><!-- .go-top-box -->
	</div><!-- .post-seperator -->

</article><!-- #post-<?php the_ID(); ?> -->
