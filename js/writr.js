( function( $ ) {
$(function(){
    /*
     * Click to toggle sidebar.
     */
    $( '#sidebar' ).on( 'click', '#sidebar-toggle', function( e ) {
        e.preventDefault();
        $( 'html, body' ).scrollTop( 0 );
        $( this ).toggleClass( 'open' );
        $( 'body' ).toggleClass( 'sidebar-closed' );
        $( '#secondary' ).resize();
    } );

    /*
     * A function to enable/disable a dropdown submenu.
     */
    function submenu() {
        var dropdown_icon = $( '.dropdown-icon' );

        $( '.main-navigation .node > div > a' ).append( '<span class="dropdown-icon" />' );
        $( '#site-navigation' ).on( 'click', '.dropdown-icon', function( e ) {
            e.preventDefault();
            $( this ).toggleClass( 'open' );
            if ( $( this ).hasClass( 'open' ) ) {
                $( this ).parent().parent().next( 'ul' ).show();
            } else {
                $( this ).parent().parent().next( 'ul' ).hide();
            }
        } );
    }
    $( window ).load( submenu );

});
} )( jQuery );
