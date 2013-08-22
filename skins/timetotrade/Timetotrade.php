<?php
/**
 * Custom timetotrade skin. Based on a wikimedia tutorial
 * http://www.mediawiki.org/wiki/Manual:Skinning/Tutorial
 *
 * PHP version 5
 *
 * @category   WIKI
 * @package    WIKI
 * @author     Dary McGovern <dary@sensatus.com>
 * @copyright  2013 Sensatus UK Ltd
 * @license    http://timetotrade.eu TimeToTrade
 * @link       http://wiki.timetotrade.eu
 */

#Prevent running standalone
if ( !defined( 'MEDIAWIKI' ) ) {
    die( "MediaWiki package that cannot be run standalone." );
}

#Add the timetotrade skin, autoload classes, add i18n,
#and add a resourceloader module:
$wgValidSkinNames['timetotrade'] = 'Timetotrade';
$wgAutoloadClasses['SkinTimetotrade'] = dirname(__FILE__).'/Timetotrade.skin.php';
$wgExtensionMessagesFiles['Timetotrade'] = dirname(__FILE__).'/Timetotrade.i18n.php';

$wgResourceModules['skins.timetotrade'] = array(
    'styles' => array(
        'timetotrade/css/skin.css' => array( 'media' => 'screen' ),
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);