/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
jQuery(function(){
    var container, button, menu;

    container = document.getElementById( 'writr__site-navigation' );
    if ( ! container )
        return;

    button = container.getElementsByTagName( 'h3' )[0];
    if ( 'undefined' === typeof button )
        return;

    menu = container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu ) {
        button.style.display = 'none';
        return;
    }

    if ( -1 === menu.className.indexOf( 'nav-menu' ) )
        menu.className += ' nav-menu';

    button.onclick = function() {
        if ( -1 !== container.className.indexOf( 'toggled' ) )
            container.className = container.className.replace( ' toggled', '' );
        else
            container.className += ' toggled';
    };
});
