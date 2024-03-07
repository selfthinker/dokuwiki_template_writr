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
 * Generate the HTML for the Site-Branding Area
 *
 * @return string
 */
if (!function_exists('tpl_getSiteBranding')) {
    function tpl_getSiteBranding()
    {
        // Retrieve the global variables
        global $ID,$conf;

        // Initialize the return value
        $return = '';

        // Initialize the site branding configurations
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
        $link = wl();
        if(tpl_getConf('doLogoLinkChangesByNamespace')){
            $link = str_replace(['/_media','logo.png'],['',$conf['start']],$logo);
        }
        $title = $conf['title'];
        if(tpl_getConf('doTitleChangesByNamespace')){
            $nstitle = tpl_include_page('nstitle', 0, 1);
            if ($nstitle) {
                $title = $nstitle;
            }
        }
        $tagline = $conf['tagline'];
        if(tpl_getConf('doTaglineChangesByNamespace')){
            $nstagline = tpl_include_page('nstagline', 0, 1);
            if ($nstagline) {
                $tagline = $nstagline;
            }
        }

        // Initialize the logo
        $return .= '<a class="site-logo" href="'.$link.'" title="'.$title.'" rel="home" accesskey="h" title="[H]">';
        $return .= '<img src="'.$logo.'" '.$logoSize[3].' alt="" class="no-grav header-image" />';
        $return .= '</a>';

        // Initialize the site branding
        $return .= '<div class="site-branding">';
        $return .= '<h1 class="site-title"><a href="'.$link.'" rel="home" accesskey="h" title="[H]">'.$title.'</a></h1>';
        if($tagline){
            $return .= '<h2 class="site-description">'.$tagline.'</h2>';
        }
        $return .= '</div>';

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
            case 'sidebarmenu':
                return tpl_getSidebarMenu();
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
                $return .= '<a href="'.wl($ID).'" class="dropdown-toggle" title="'.$lang['user_tools'].'" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
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

/**
 * Generate the HTML for the sidebar menus
 *
 * @return string
 */
if (!function_exists('tpl_getSidebarMenu')) {
    function tpl_getSidebarMenu()
    {
        global $lang,$ID,$conf,$INFO;

        $userItems = (new \dokuwiki\Menu\UserMenu())->getItems();
        $siteItems = (new \dokuwiki\Menu\SiteMenu())->getItems();

        $return = '';

        $return .= '<div id="writr__sidebar__tools">';

        if(isset($INFO['userinfo'])){
            $return .= '<div class="user-tools">';
                $return .= '<a href="'.wl($ID).'" class="" title="'.$lang['user_tools'].'" data-target="#user-tools-menu" data-toggle="collapse" role="button" aria-haspopup="true" aria-expanded="false">';
                    $return .= '<img alt="'.$INFO['userinfo']['name'].'" src="'.tpl_getGravatarURL($INFO['userinfo']['mail'], 32).'" />';
                    $return .= '<span>'.$INFO['userinfo']['name'].'</span>';
                $return .= '</a>';
                $return .= '<div id="user-tools-menu" class="collapsed">';
                    $return .= '<ul class="menu" role="menu">';
                        foreach($userItems as $item) {
                            $return .= '<li>'
                                .'<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                                .'<i></i> '
                                .$item->getLabel()
                                .'</a></li>';
                        }
                    $return .= '</ul>';
                $return .= '</div>';
            $return .= '</div>';
        } else {
            $return .= '<div class="user-tools">';
            foreach($userItems as $item) {
                $return .= '<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                    .'<i></i> '
                    .$item->getLabel()
                    .'</a>';
            }
            $return .= '</div>';
        }

        $return .= '</div>';

        return $return;
    }
}
