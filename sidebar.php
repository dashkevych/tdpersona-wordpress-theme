<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

 if ( ! is_active_sidebar( 'sidebar-4' ) )
	return;
?>

<div id="secondary" class="widget-area" role="complementary">
	<div id="sidebar-content" class="widget-inner">
		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside><!-- .widget -->

		<aside id="archives" class="widget">
			<h4 class="widget-title"><?php _e( 'Archives', 'tdpersona' ); ?></h4>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside><!-- .widget -->

		<aside id="meta" class="widget">
			<h4 class="widget-title"><?php _e( 'Meta', 'tdpersona' ); ?></h4>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside><!-- .widget -->
	</div><!-- .widget-inner -->
</div><!-- #secondary .widget-area -->