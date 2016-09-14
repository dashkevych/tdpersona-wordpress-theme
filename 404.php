<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package tdpersona
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tdpersona' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p class="sub-info"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try our search?', 'tdpersona' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>
