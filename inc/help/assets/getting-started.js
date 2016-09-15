jQuery(document).ready(function() {
    
    var gettingStartedContainer = jQuery( document.getElementById( 'getting-started-wrap' ) );
    
    // Open documentation links in a new window.
    gettingStartedContainer.find( '.page-body a' ).each( function() {
        jQuery(this).attr( 'target', '_blank' );
    });

});