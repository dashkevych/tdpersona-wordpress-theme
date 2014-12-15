<?php
/**
 *  The template used for displaying search content
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
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
		<?php edit_post_link( esc_html__( 'Edit', 'tdpersona' ), '<span class="sep"> / </span> <span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

	<div class="post-seperator">
		<div class="go-top-box border-radius-circle"><i class="fa fa-arrow-up"></i></div>
	</div><!-- .post-seperator -->

</article><!-- #post-<?php the_ID(); ?> -->
