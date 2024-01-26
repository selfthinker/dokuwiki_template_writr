<?php
/*
 * Configuration Metadata
 *
 * @author   Louis Ouellet <louis_ouellet@hotmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();

$meta['_tools']                     = array('fieldset');
$meta['showPageToolsTitle']         = array('onoff');
$meta['showSiteToolsTitle']         = array('onoff');
$meta['showUserToolsTitle']         = array('onoff');
$meta['doSiteToolsRequireLogin']    = array('onoff');

$meta['_extra']                     = array('fieldset');
$meta['doLogoChangesByNamespace']   = array('onoff');

$meta['_plugins']                   = array('fieldset');
$meta['defaultAddNewPage']          = array('string');

$meta['_customizations']            = array('fieldset');
