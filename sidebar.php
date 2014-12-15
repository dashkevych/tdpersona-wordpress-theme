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
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- .widget-inner -->
</div><!-- #secondary .widget-area -->