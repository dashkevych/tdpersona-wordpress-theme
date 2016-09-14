<?php
/**
 *  The template used for displaying post formats navigation.
 *
 * @package tdPersona
 */

$home_url = get_home_url();

?>

<div class="post-formats-navigation">
    <div class="pf-open-btn">
        <a id="post-formats-open-btn" class="border-radius-circle td-tooltip" href="#" title="<?php esc_attr_e( 'Open', 'tdpersona' ); ?>"><i class="fa fa-plus"></i></a>
    </div><!-- .pf-open-btn -->

    <div class="post-formats-navigation-container">
        <ul class="list-unstyled">
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/standard/' ); ?>" title="<?php esc_attr_e( 'Text', 'tdpersona' ); ?>"><i class="fa fa-pencil"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/audio/' ); ?>" title="<?php esc_attr_e( 'Audio', 'tdpersona' ); ?>"><i class="fa fa-music"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/gallery/' ); ?>" title="<?php esc_attr_e( 'Gallery', 'tdpersona' ); ?>"><i class="fa fa-camera"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/image/' ); ?>" title="<?php esc_attr_e( 'Photo', 'tdpersona' ); ?>"><i class="fa fa-picture-o"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/video/' ); ?>" title="<?php esc_attr_e( 'Video', 'tdpersona' ); ?>"><i class="fa fa-film"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/quote/' ); ?>" title="<?php esc_attr_e( 'Quote', 'tdpersona' ); ?>"><i class="fa fa-quote-right"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/link/' ); ?>" title="<?php esc_attr_e( 'Link', 'tdpersona' ); ?>"><i class="fa fa-link"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/aside/' ); ?>" title="<?php esc_attr_e( 'Aside', 'tdpersona' ); ?>"><i class="fa fa-thumb-tack"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/status/' ); ?>" title="<?php esc_attr_e( 'Status', 'tdpersona' ); ?>"><i class="fa fa-bullhorn"></i></a></li>
            <li><a class="border-radius-circle td-tooltip" href="<?php echo esc_url( $home_url . '/type/chat/' ); ?>" title="<?php esc_attr_e( 'Chat', 'tdpersona'); ?>"><i class="fa fa-comments-o"></i></a></li>
            <li><a id="post-formats-hide-btn" class="border-radius-circle td-tooltip" href="#" title="<?php esc_attr_e( 'Close', 'tdpersona' ); ?>"><i class="fa fa-times"></i></a></li>
        </ul><!-- .list-unstyled -->
    </div><!-- .post-formats-navigation-container -->
</div><!-- .post-formats-navigation -->
