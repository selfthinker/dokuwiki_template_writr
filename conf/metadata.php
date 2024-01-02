<?php
/*
 * Configuration Metadata
 *
 * @author   Louis Ouellet <louis_ouellet@hotmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();

$meta['showPageToolsTitle']   = array('onoff');
$meta['showSiteToolsTitle']   = array('onoff');
$meta['showUserToolsTitle']   = array('onoff');

$meta['doSiteToolsRequireLogin']   = array('onoff');
$meta['doLogoChangesByNamespace'] = array('onoff');

$meta['defaultAddNewPage'] = array('string');

$meta['font']     = array('multichoice', '_choices' => array('Montserrat, sans-serif'));