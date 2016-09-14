<?php
/**
 * The Template for displaying all single posts.
 *
 * @package tdPersona
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content', 'single' ); ?>

            <?php the_post_navigation(); ?>

            <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            ?>

        <?php endwhile; ?>

        </div><!-- #content .site-content -->
    </div><!-- #primary .content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
