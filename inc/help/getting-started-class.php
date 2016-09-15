<?php
/**
 * Getting Started class.
 */

class Themes_Harbor_Getting_Started_Admin {
    
    /**
	 * Variables required for the theme helper.
	 *
	 * @since 1.0.0
	 */
	 protected $theme_slug = null;
     protected $strings = null;
     protected $rating_url = null;
    
    /**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
    function __construct( $config = array() ) {
        
        $config = wp_parse_args( $config, array(
			'remote_api_url' => '',
			'theme_slug' => '',
            'rating_url' => '',
		) );
        
        // Set config arguments.
		$this->remote_api_url = esc_url( $config['remote_api_url'] );
		$this->theme_slug = sanitize_key( $config['theme_slug'] );
        $this->rating_url = esc_url( $config['rating_url'] );
        
        $this->strings = array(
            'page-title' => esc_html__( 'Getting Started', 'tdpersona' ),
        );
        
        add_action( 'admin_menu', array( $this, 'help_menu' ) );
        add_action( 'admin_init', array( $this, 'redirect_on_activation' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }
    
    /**
	 * Adds a menu item for the theme help under the appearance menu.
	 *
	 * since 1.0.0
	 */
	function help_menu() {

		$strings = $this->strings;

		add_theme_page(
			$strings['page-title'],
			$strings['page-title'],
			'manage_options',
			$this->theme_slug . '-help',
			array( $this, 'getting_started_page' )
		);
	}
    
    /**
	 * Outputs the markup used on the theme getting started page.
	 *
	 * since 1.0.0
	 */
	function getting_started_page() { 
        
        // Get theme information
        $theme = wp_get_theme( $this->theme_slug );    
        
    ?>

        <div id="getting-started-wrap" class="wrap getting-started">
            
            <div class="page-header clearfix">
                <div class="theme-info">
				    <h2 class="section-title"><?php printf( esc_html__( 'Getting Started with %s theme.', 'tdpersona' ), $theme['Name'] ); ?></h2>
                    <div class="theme-description"><?php echo esc_html( $theme['Description'] ); ?></div><!-- .theme-description -->
                    
                    <div class="theme-meta clearfix">
                        <p class="theme-author"><?php esc_html_e( 'Author:', 'tdpersona' ); ?> <a href="<?php echo esc_url( $theme['AuthorURI'] ); ?>" target="_blank"><?php echo $theme['Author']; ?></a></p>
                        <p class="theme-version"><?php esc_html_e( 'Version:', 'tdpersona' ); ?> <span><?php echo $theme['Version']; ?></span></p>
                    </div><!-- .theme-meta -->
				</div><!-- .theme-info -->
                
                <div class="theme-screenshot">
                    <img  src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" alt="<?php esc_attr( $theme['Name'] ); ?>" />
                </div><!-- .theme-screenshot -->
            </div><!-- .page-header -->
            
            <div class="page-body clearfix">
                <div class="page-content">
                <?php
                
                    include_once( ABSPATH . WPINC . '/feed.php' );

                    $rss_url = esc_url( $this->remote_api_url . '/documentation/' . $this->theme_slug . '/feed/?withoutcomments=1' );        
                    $rss = fetch_feed( $rss_url );
        
                    if ( ! is_wp_error( $rss ) ) {
                        $maxitems = $rss->get_item_quantity( 1 );
                        $rss_items = $rss->get_items( 0, $maxitems );

                        if ( !empty( $rss_items ) ) {
                            foreach ( $rss_items as $item )  {
                                echo $item->get_content();
                            }
                        }

                    } else {
                        esc_html_e( 'This help file feed seems to be temporarily unavailable but you can always view it on Themes Harbor website.', 'tdpersona' );
                    }

                ?>
                </div><!-- .page-content -->
                
                <div class="page-sidebar">
                    
                    <div class="support-widget page-widget">
                        <h3 class="widget-title"><?php esc_html_e( 'Looking for help?', 'tdpersona' ); ?></h3>
                        <p><?php esc_html_e( 'We have collected some resources that you may find helpful:', 'tdpersona' ); ?></p>
                        
                        <?php 
                            $general_questions_link = '<a href="https://wordpress.org/support/forum/how-to-and-troubleshooting/" target="_blank">' . esc_html__( 'How-To and Troubleshooting', 'tdpersona' ) . '</a>';
                            $customization_link = '<a href="https://wordpress.org/support/forum/themes-and-templates/" target="_blank">' . esc_html__( 'Themes and Templates', 'tdpersona' ) . '</a>';
                            $contact_form_link = '<a href="https://themesharbor.com/contacts/" target="_blank">' . esc_html__( 'contact form', 'tdpersona' ) . '</a>';
                        ?>
                        
                        <ul>
                            <li><?php printf( esc_html__( 'If you have a general question related to WordPress, please post it on WordPress.org %s forum.', 'tdpersona' ), $general_questions_link ); ?></li>
                            <li><?php printf( esc_html__( 'If you have a customization question, please post it on WordPress.org %s forum.', 'tdpersona' ), $customization_link ); ?></li>
                            <li><?php printf( esc_html__( 'If your answer can not be found in this help file and links that are posted above, please use our %s.', 'tdpersona' ), $contact_form_link ); ?></li>
                        </ul>
                    </div><!-- .support-widget -->
                    
                    <div class="rating-widget page-widget">
                        <h3 class="widget-title"><?php  printf( esc_html__( 'Thank you for using %s!', 'tdpersona' ), $theme['Name'] ); ?></h3>
                        <?php 

                            $rating_link = '<a href="' . $this->rating_url . '" target="_blank">&bigstar;&bigstar;&bigstar;&bigstar;&bigstar;</a>';

                            printf( esc_html__( 'If you enjoy using %1s theme, please leave us a %2s rating. We appreciate your kind comments and taking the time to rate us!', 'tdpersona' ), $theme['Name'], $rating_link );

                        ?>
                    </div><!-- .rating-widget -->
                    
                    
                                   
                </div><!-- .page-sidebar -->
            </div><!-- .page-body -->
            
        </div><!-- #getting-started-wrap -->

    <?php
    }
    
    /**
     * Redirect to Getting Started page on theme activation.
     *
     * since 1.0.0
     */
    function redirect_on_activation() {
        global $pagenow;

        if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
            wp_redirect( admin_url( 'themes.php?page=' . $this->theme_slug . '-help' ) );
        }
    }
    
     /**
     * Load Getting Started styles in the dashboard.
     *
     * since 1.0.0
     */
    function admin_scripts() {

        global $pagenow;
        
        if( 'themes.php' != $pagenow ) {
            return;   
        }

        // Getting Started javascript
        wp_enqueue_script( 'getting-started', get_template_directory_uri() . '/inc/help/assets/getting-started.js', array( 'jquery' ), '1.0.0', true );
        
        // Getting Started styles
        wp_enqueue_style( 'getting-started', get_template_directory_uri() . '/inc/help/assets/getting-started.css', false, '1.0.0' );
    }
    
}