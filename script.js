/* DOKUWIKI:include js/skip-link-focus-fix.js */

( function( $ ) {
    /*
     * Click to toggle sidebar.
     */
    function toggleSidebar() {
        $( '#writr__sidebar' ).on( 'click', '#writr__sidebar-toggle', function( e ) {
            e.preventDefault();
            $( 'html, body' ).scrollTop( 0 );
            $( this ).toggleClass( 'open' );
            $( 'body' ).toggleClass( 'sidebar-closed' );
            $( '#writr__secondary' ).resize();
        } );
    }

    /**
     * Handles toggling the navigation menu for small screens.
     */
    function toggleNavigation() {
        var $container = $('#writr__site-navigation');
        if (!$container.length) return;
        var $button = $('.menu-toggle', $container);
        if (!$button.length) return;
        var $menu = $('ul', $container);
        if (!$menu.length) {
            $menu.hide();
            return;
        }
        $button.click(function(){
            $container.toggleClass('toggled');
        });
    }

    /*
     * A function to enable/disable a dropdown submenu.
     */
    function toggleSubmenu() {
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

    /*
     * Close TOC by default
     */
    function closeToc() {
        var $toc = jQuery('#dw__toc .toggle');
        if($toc.length) {
            $toc[0].setState(-1);
        }
    }

    /*
     * Change search submit input to submit button to make it easier to style
     * @deprecated since Detritus
     */
    function changeSearchInput() {
        var $searchForm = $('.search-form > form > div');
        var $searchButton = $('input[type="submit"]', $searchForm).detach();
        var title = $searchButton.attr('title');
        var value = $searchButton.val();
        $searchForm.append('<button type="submit" title="'+title+'">'+value+'</button>');
    }

    $(function(){
        toggleSidebar();
        toggleNavigation();
        toggleSubmenu();
        closeToc();
        changeSearchInput();
    });
} )( jQuery );
