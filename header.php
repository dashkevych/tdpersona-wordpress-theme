<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package tdpersona
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<div class="top-navigation">
		<nav role="navigation" id="site-navigation" class="site-navigation main-navigation" data-small-nav-title="<?php esc_html_e( 'Navigation', 'tdpersona' ); ?>">
			<div class="container">
				<?php if ( has_nav_menu( 'primary' ) ): ?>
					<?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'nav-bar', 'theme_location' => 'primary' ) ); ?>
				<?php else: ?>
					<ul class="nav-bar">
						<?php wp_list_pages('title_li=' ); ?>
					</ul><!-- .nav-bar -->
				<?php endif; ?>
			</div> <!-- .container -->

			<?php if( is_active_sidebar( 'sidebar-4' ) ): ?>
			<div class="sidebar-btn-container">
				<a id="sidebar-btn" href="#"><i class="fa fa-plus"></i></a>
			</div><!-- .sidebar-btn-container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->
	</div> <!-- .top-navigation -->

	<header id="masthead" class="site-header container" role="banner">
		<div class="brand <?php echo esc_attr( get_theme_mod( 'tdpersona_header_align', 'center' ) ); ?>">
	        
            <?php tdpersona_the_custom_logo(); ?>
            
			<div class="brand-meta">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div><!-- .brand-meta -->
            

			<?php if( 'hide' != get_theme_mod( 'tdpersona_post_formats_navigation', 'hide' ) ): ?>
                <?php get_template_part( 'template-parts/formats', 'navigation' ); ?>
			<?php endif; ?>

		</div><!-- .brand -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main container">
