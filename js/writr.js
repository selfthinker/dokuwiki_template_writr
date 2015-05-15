( function( $ ) {

    /*
     * Click to toggle sidebar.
     */
    $( '#sidebar' ).on( 'click', '#sidebar-toggle', function( e ) {
        e.preventDefault();
        $( 'html, body' ).scrollTop( 0 );
        $( this ).toggleClass( 'open' );
        $( 'body' ).toggleClass( 'sidebar-closed' );
        $( '#secondary, #colophon' ).toggleClass( 'block' );
        $( '#secondary' ).resize();
    } );

    /*
     * A function to reorganise DOM,
     * enable/disable a dropdown submenu
     * and resize thumbnails.
     */
    function responsive() {
        var sidebar = $( '#sidebar' ),
            header = $( '#masthead' ),
            footer = $( '#colophon' ),
            dropdown_icon = $( '.dropdown-icon' ),
            thumbnail = $( '.entry-thumbnail, .entry-attachment .attachment' );

        dropdown_icon.remove();

        if ( $( window ).width() > 959 ) {
            header.insertAfter( $( '#sidebar-toggle' ) ).s;
            footer.appendTo( sidebar );
            dropdown_icon.remove();
        } else {
            header.insertBefore( $( '#content' ) );
            footer.appendTo( sidebar );
            $( '.main-navigation .dropdown > a' ).append( '<span class="dropdown-icon" />' );
            $( '#site-navigation' ).on( 'click', '.dropdown-icon', function( e ) {
                e.preventDefault();
                $( this ).toggleClass( 'open' );
                if ( $( this ).hasClass( 'open' ) ) {
                    $( this ).parent().next( '.dropdown-menu' ).show();
                } else {
                    $( this ).parent().next( '.dropdown-menu' ).hide();
                }
            } );
        }

        header.show();
        footer.css( {
            'visibility': 'visible',
            'opacity': 1
        } );

        if ( $( window ).width() < 768 ) {
            thumbnail.css( 'width', '100%' ).css( 'width', '+=80px' );
        } else {
            thumbnail.removeAttr( 'style' );
        }
    }
    $( window ).load( responsive ).resize( /* TODO: use something else for this than loading a whole, big library */ _.debounce( responsive, 100 ) );

    /*
     * Resize thumbnails after Infinte Scroll load.
     */
    $( document ).on( 'post-load', function() {
        var thumbnail = $( '.entry-thumbnail' );
        if ( $( window ).width() < 768 ) {
            thumbnail.css( 'width', '100%' ).css( 'width', '+=80px' );
        } else {
            thumbnail.removeAttr( 'style' );
        }
    } );

} )( jQuery );
