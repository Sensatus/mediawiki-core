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
        $this->html( 'headelement' );
        echo $this->getHeaderHTML(); ?>

        <div id='content'>
            <?php $this->html('bodytext') ?>
        </div>

        <?php $this->printTrail(); ?>
        </body>
        </html><?php
        wfRestoreWarnings();
    }


    /**
     * Returns the html for the Timetotrade header bar with logo,
     * generic navigation links, and the wiki search text box
     *
     * @return string HTML
     */
    public function getHeaderHTML() {
        $html = <<<EOF
<div id='wikiHeader'>
    <header>

        <a href="/">
            <img src="//cdn.sensatus.org.uk/images/logos/25px.png" alt="timetotrade">
        </a>

        {$this->getNavigationHTML()}

        {$this->searchBox()}

    </header>
</div>
EOF;

//        <form id='searchform' action="<? php $this->text('wgScript') php>">
//            <input type="text" name="search" accesskey="f" id="llookup" placeholder="Search help manual">
//        </form>
        return $html;
    }

    function searchBox() {
        $params = array( "id" => "searchInput", "type" => "text" );
        $html = '<form action="" id="searchform" class="symbolLookup">';
        $html .= '<input type="hidden" name="title" value="Special:Search"/>';
        $html .= $this->makeSearchInput($params);
        $html .= '</form>';
        return $html;
    }
    /**
     * Contains generic timetotrade navigation links
     *
     * @return string HTML
     */
    public function getNavigationHTML() {

        $html = <<<EOF
<nav class="noJS">
<ul>
  <li class="hasChildren">
    <a href="/summary.php" id="tl_portfolio">Portfolio</a>
    <ul>
      <li>
        <a href="/summary.php" id="portfolio">Portfolio</a>
      </li>
      <li class="hasChildren">
        <a href="/ledger.php" id="accounts">Accounts</a>
        <ul>
          <li class="hasChildren">
            <a href="/ledger.php" id="actual_accounts">Actual</a>
          </li>
          <li class="hasChildren">
            <a href="/ledger.php?category=simulated" id="simulated_accounts">Simulated</a>
          </li>
          <li>
            <a href="/ledger.php?category=competition" id="competition_accounts">Competition</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="/markets.php" id="markets">Markets</a>
      </li>
      <li>
        <a href="/portfolio.php" id="watchlists">Watchlists</a>
      </li>
      <li class="hasChildren">
        <a href="/competitions.php" id="competitions">Competitions</a>
        <ul>
          <li>
            <a href="/competitions.php" id="enterCompetitions">Competitions</a>
          </li>
          <li>
            <a href="/competitions.php?show=entry" id="createCompetitions">Create&nbsp;Competitions</a>
          </li>
        </ul>
      </li>
      <li class="hasChildren">
        <a href="/performance_portfolio.php" id="performance">Performance</a>
        <ul>
          <li>
            <a href="/performance_club.php">club</a>
          </li>
          <li>
            <a href="/performance_portfolio.php" id="performanceWeighting">Weighting</a>
          </li>
          <li>
            <a href="/performance_report.php" id="performancePortfolio">Portfolio</a>
          </li>
          <li>
            <a href="/performance_investments.php" id="performanceInvestments">Investments</a>
          </li>
          <li>
            <a href="/performance_taxation.php" id="performanceTaxation">Taxation</a>
          </li>
        </ul>
      </li>
      <li class="hasChildren">
        <a href="/taxation.php" id="taxation">Taxation</a>
        <ul>
          <li>
            <a href="/185new.php">Form&nbsp;185</a>
          </li>
          <li>
            <a href="/cgt_uk.php" id="captialGains">Capital&nbsp;Gains</a>
          </li>
          <li>
            <a href="/income_tax_personal.php" id="incomeTax">Income&nbsp;Tax</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="/reports.php" id="reports">Reports</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="/trade.php?show=orderhistory" id="tl_trade">Trade</a>
    <ul>
      <li>
        <a href="/trade.php?show=orderhistory" id="orderHistory">Order&nbsp;History</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="/buildalert.php" id="tl_charts">Charts</a>
    <ul>
      <li>
        <a href="/buildalert.php" id="fullWidth">Full&nbsp;Width</a>
      </li>
      <li>
        <a href="/buildalert.php?fullscreen=0" id="tools">Tools</a>
      </li>
      <li>
        <a href="#" onclick="tttpopup('/tearaway/'); return false" id="tearaway">Tearaway</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="/community" id="tl_river">Community</a>
    <ul>
      <li>
        <a href="/community" id="publicForum">Public&nbsp;Forum</a>
      </li>
      <li>
        <a href="/managefiles.php" id="documentLibrary">Document&nbsp;Library</a>
      </li>
      <li>
        <a href="http://blog.timetotrade.eu/" id="blog">Blog</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="http://www.timetotrade.eu/wiki/" id="tl_help">Help</a>
    <ul>
      <li>
        <a href="http://forum.timetotrade.eu/forums/help_videos/" id="helpVideos">Help&nbsp;Videos</a>
      </li>
      <li>
        <a href="http://wiki.timetotrade.eu/" id="helpManual">Help&nbsp;Manual</a>
      </li>
      <li>
        <a href="/packages.php" id="packages">Pricing</a>
      </li>
      <li>
        <a href="/tickets.php?view=createticket" id="contactUs">Contact&nbsp;Us</a>
      </li>
    </ul>
  </li>
</ul>
</nav>
EOF;
        return $html;
    }
}