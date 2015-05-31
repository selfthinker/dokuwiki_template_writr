( function( $ ) {
$(function(){
    /*
     * Click to toggle sidebar.
     */
    $( '#writr__sidebar' ).on( 'click', '#writr__sidebar-toggle', function( e ) {
        e.preventDefault();
        $( 'html, body' ).scrollTop( 0 );
        $( this ).toggleClass( 'open' );
        $( 'body' ).toggleClass( 'sidebar-closed' );
        $( '#writr__secondary' ).resize();
    } );

    /*
     * A function to enable/disable a dropdown submenu.
     */
    function submenu() {
        var dropdown_icon = $( '.dropdown-icon' );

        $( '.main-navigation .node > div > a' ).append( '<span class="dropdown-icon" />' );
        $( '#writr__site-navigation' ).on( 'click', '.dropdown-icon', function( e ) {
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
