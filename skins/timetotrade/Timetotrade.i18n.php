<?php
/**
 * Custom timetotrade skin. Based on a wikimedia tutorial
 * http://www.mediawiki.org/wiki/Manual:Skinning/Tutorial
 *
 * PHP version 5
 *
 * @file
 * @ingroup   Skins
 * @category  category
 * @package   package
 * @author    Dary McGovern <dary@sensatus.com>
 * @copyright 2013 Sensatus UK Ltd
 * @license   http://timetotrade.eu TimeToTrade
 * @link      http://link.timetotrade.eu
 */

$messages = array();

/**
 * English
 *
 * @author Dary McGovern <dary@sensatus.com>
 */
$messages['en'] = array(
    'skinname-myskin' => "Timetotrade Skin",
    'myskin-desc' => "Stylise to integrate with the main timetotrade website",
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
     * @param $out OutputPage object
     */
    function setupSkinUserCss( OutputPage $out ){
        parent::setupSkinUserCss( $out );
        $out->addModuleStyles( "skins.timetotrade" );
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

        <?php $this->printTrail(); ?>
        </body>
        </html><?php
        wfRestoreWarnings();
    }

}




