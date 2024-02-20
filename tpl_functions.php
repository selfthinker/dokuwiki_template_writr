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
