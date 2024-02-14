/* DOKUWIKI:include js/skip-link-focus-fix.js */

jQuery(document).ready(function() {
    /*
     * Click to toggle sidebar.
     */
    function toggleSidebar() {
        jQuery( '#writr__sidebar' ).on( 'click', '#writr__sidebar-toggle', function( e ) {
            e.preventDefault();
            jQuery( 'html, body' ).scrollTop( 0 );
            jQuery( this ).toggleClass( 'open' );
            jQuery( 'body' ).toggleClass( 'sidebar-closed' );
            jQuery( '#writr__secondary' ).resize();
        } );
    }

    /**
     * Handles toggling the navigation menu for small screens.
     */
    function toggleNavigation() {
        var $container = jQuery('#writr__site-navigation');
        if (!$container.length) return;
        var $button = jQuery('.menu-toggle', $container);
        if (!$button.length) return;
        var $menu = jQuery('ul', $container);
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
        jQuery( '.main-navigation .node > div > a' ).append( '<span class="dropdown-icon" />' );
        jQuery( '#writr__site-navigation' ).on( 'click', '.dropdown-icon', function( e ) {
            e.preventDefault();
            jQuery( this ).toggleClass( 'open' );
            if ( jQuery( this ).hasClass( 'open' ) ) {
                jQuery( this ).parent().parent().next( 'ul' ).show();
            } else {
                jQuery( this ).parent().parent().next( 'ul' ).hide();
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
        var $searchForm = jQuery('.search-form > form > div');
        var $searchButton = jQuery('input[type="submit"]', $searchForm).detach();
        var title = $searchButton.attr('title');
        var value = $searchButton.val();
        $searchForm.append('<button type="submit" title="'+title+'">'+value+'</button>');
    }

    /*
     * Enable add new page dropdown
     */
    function enableAddNewPage() {
        jQuery('.action.AddNewPage').click(function(event) {
            event.preventDefault();
            const button = jQuery(this);
            jQuery('.addnewpage').toggle(0,function(){
                // set aria-expanded attribute based on visibility
                button.attr('aria-expanded', jQuery(this).is(':visible'));
            });
        });

        jQuery(document).click(function(event) {
            if (!jQuery(event.target).closest('.action.AddNewPage, .addnewpage').length) {
                jQuery('.addnewpage').hide();
            }
        });
    }

    /*
     * Enable translation dropdown
     */
    function enableTranslation() {
        jQuery('.action.Translation').click(function(event) {
            event.preventDefault();
            const button = jQuery(this);
            jQuery('.plugin_translation').toggle(0,function(){
                // set aria-expanded attribute based on visibility
                button.attr('aria-expanded', jQuery(this).is(':visible'));
            });
        });

        jQuery(document).click(function(event) {
            if (!jQuery(event.target).closest('.action.Translation, .plugin_translation').length) {
                jQuery('.plugin_translation').hide();
            }
        });
    }

    jQuery(function(){
        toggleSidebar();
        toggleNavigation();
        toggleSubmenu();
        closeToc();
        changeSearchInput();
        enableAddNewPage();
        enableTranslation();
    });
});
