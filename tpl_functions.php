<?php
/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/**
 * Get the logo of the wiki
 *
 * @return string
 */
if (!function_exists('tpl_getLogo')) {
    function tpl_getLogo()
    {
        global $ID,$conf;

        $return = '';
        $logoSize = array();
        $logoImages = array();
        if(tpl_getConf('doLogoChangesByNamespace')){
            $namespace = "";
            $namespaces = array();
            foreach(explode(':',getNS($ID)) as $ns){
                $namespace .= "$ns:";
                $namespaces[] = $namespace;
            }
            foreach(array_reverse($namespaces)  as $namespace){
                $logoImages[] = ":".trim($namespace,":").":logo.png";
            }
        }
        $logoImages[] = ':logo.png';
        $logoImages[] = ':wiki:logo.png';
        $logoImages[] = 'images/logo.png';
        $logo = tpl_getMediaFile($logoImages, false, $logoSize);

        $return .= '<a class="site-logo"  href="'.wl().'" title="'.$conf['title'].'" rel="home" accesskey="h" title="[H]">';
        $return .= '<img src="'.$logo.'" '.$logoSize[3].' alt="" class="no-grav header-image" />';
        $return .= '</a>';

        return $return;
    }
}

/**
 * Generate the gravatar URL for a given email
 *
 * @return string
 */
if (!function_exists('tpl_getGravatarURL')) {
    function tpl_getGravatarURL($email, $size = 96)
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?s='.$size;
    }
}


/**
 * Generate the HTML for a menu
 *
 * @return string
 */
if (!function_exists('tpl_getMenu')) {
    function tpl_getMenu($menu)
    {
        switch($menu){
            case 'usermenu':
                return tpl_getUserMenu();
                break;
        }
    }
}

/**
 * Generate the HTML for the user menu
 *
 * @return string
 */
if (!function_exists('tpl_getUserMenu')) {
    function tpl_getUserMenu()
    {
        global $lang,$ID,$conf,$INFO;

        $return = '';

        $items = (new \dokuwiki\Menu\UserMenu())->getItems();

        if(isset($INFO['userinfo'])){
            $return .= '<div class="dropdown user-tools">';
                $return .= '<a href="'.wl($ID).'" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                    $return .= '<i class="bi bi-person"></i>'.$INFO['userinfo']['name'];
                $return .= '</a>';
                $return .= '<ul class="dropdown-menu" role="menu">';
                    $return .= '<li>';
                        $return .= '<p class="avatar">';
                            $return .= '<img alt="'.$INFO['userinfo']['name'].'" src="'.tpl_getGravatarURL($INFO['userinfo']['mail']).'" />';
                        $return .= '</p>';
                    $return .= '</li>';
                    foreach($items as $item) {
                        $return .= '<li>'
                            .'<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                            .'<i></i> '
                            .$item->getLabel()
                            .'</a></li>';
                    }
                $return .= '</ul>';
            $return .= '</div>';
        } else {
            $return .= '<div class="inline user-tools">';
            foreach($items as $item) {
                $return .= '<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                    .'<i></i> '
                    .$item->getLabel()
                    .'</a>';
            }
            $return .= '</div>';
        }

        return $return;
    }
}
