<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

	</div><!-- #main .site-main -->

	<div class="footer-container">
		<footer id="colophon" class="site-footer container" role="contentinfo">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
					<?php endif; ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
					<?php endif; ?>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
					<?php endif; ?>
				</div>
			</div><!-- .row -->
			<div class="site-info">
				<div class="site-info-inner">
					&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<span class="sep">&mdash;</span>
					<?php echo sprintf( __( '%1$s by %2$s', 'tdpersona' ), '<a href="http://demo.tdwp.us/tdpersona/" target="_blank">tdPersona Theme</a>', 'Taras Dashkevych' ); ?>
				</div><!-- .site-info-inner -->
			</div><!-- .site-info -->
		</footer><!-- #colophon .site-footer -->
	</div><!-- .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>