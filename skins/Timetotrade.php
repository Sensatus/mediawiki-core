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

#Add the timetotrade skin and resourceloader module
$wgValidSkinNames['timetotrade'] = 'Timetotrade';
$wgResourceModules['skins.timetotrade'] = array(
    'styles' => array(
        'timetotrade/skin.css' => array( 'media' => 'screen' ),
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);



/**
 * SkinTemplate class for Timetotrade skin
 *
 * @ingroup Skins
 */

class SkinTimetotrade extends SkinTemplate {

    var $skinname = 'timetotrade', $stylename = 'timetotrade',
        $template = 'TimetotradeTemplate', $useHeadElement = true;

    /**
     * Get the style sheets, using the timetotrade CSS where possible
     *
     * @param $out OutputPage object
     */
    function setupSkinUserCss( OutputPage $out ){
        parent::setupSkinUserCss( $out );
        $out->addModuleStyles( "skins.timetotrade" );

        $out->addHeadItem('timetotradeCSS',
            '<link rel="stylesheet" href="//timetotrade.eu/sensatus_css.php">'
        );

        $out->addHeadItem('timetotradeLess',
            '<link rel="stylesheet" href="//cdn.sensatus.org.uk/min/css/less/site.css">'
        );

        $out->addHeadItem('timetotradeAlerts',
            '<link rel="stylesheet" href="//cdn.sensatus.org.uk/alerts.css">'
        );
    }
}

/**
 * BaseTemplate class for Timetotrade skin
 *
 * @ingroup Skins
 */
class TimetotradeTemplate extends BaseTemplate {

    /**
     * Outputs the entire contents of the page
     */
    public function execute() {

        //Suppress warnings to prevent notices about missing
        //indexes in $this->data
        wfSuppressWarnings();

        // Keep in mind that headelement defines the <body>
        //tag itself you shouldn't include one
        $this->html( 'headelement' ); ?>
        <div id='timetotradeBody'>
            <div id='wikiNavigation'>

                <p>Timetotrade Logo</p>

                <form id='searchform' action="<?php $this->text( 'wgScript' ); ?>">
                    <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
                    <?php echo $this->makeSearchInput(); ?>
                </form>

            </div>


            <div id='content'>
                <?php $this->html('bodytext') ?>
            </div>

        </div>

        <?php $this->printTrail(); ?>
        </body>
        </html><?php
        wfRestoreWarnings();
    }

}