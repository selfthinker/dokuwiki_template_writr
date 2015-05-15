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
 * Create event for tools menues
 *
 * @author Anika Henke <anika@selfthinker.org>
 */
function _tpl_toolsevent($toolsname, $items, $view='main') {
    $data = array(
        'view'  => $view,
        'items' => $items
    );

    $hook = 'TEMPLATE_'.strtoupper($toolsname).'_DISPLAY';
    $evt = new Doku_Event($hook, $data);
    if($evt->advise_before()){
        foreach($evt->data['items'] as $k => $html) echo $html;
    }
    $evt->advise_after();
}
