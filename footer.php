<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package tdpersona
 */
?>

	</div><!-- #main .site-main -->

	<div class="footer-container">
		<footer id="colophon" class="site-footer container" role="contentinfo">
			<div class="row">

				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- .col -->
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div><!-- .col -->
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div><!-- .col -->
				<?php endif; ?>

			</div><!-- .row -->
            
			<div class="site-info">
				<div class="site-info-inner">
					&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<span class="sep">&mdash;</span>
					<?php printf( esc_html__( '%1$s by %2$s', 'tdpersona' ), 'tdPersona', '<a href="https://themesharbor.com/" rel="designer">Themes Harbor</a>' ); ?>
				</div><!-- .site-info-inner -->
			</div><!-- .site-info -->
		</footer><!-- #colophon .site-footer -->
	</div><!-- .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>