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
            '<link rel="stylesheet" href="//cdn.timetotrade.eu/sensatus_css.php">'
        );

        $out->addHeadItem('timetotradeLess',
            '<link rel="stylesheet" href="//cdn.timetotrade.eu/min/css/less/site.css">'
        );

        $out->addHeadItem('timetotradeAlerts',
            '<link rel="stylesheet" href="//cdn.timetotrade.eu/alerts.css">'
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

        <footer>
            &#169; 2005-<?php echo date('Y'); ?> Sensatus (<a href="//timetotrade.eu/tickets.php?view=createticket">Contact Us</a>)
        </footer>

        <?php $this->printTrail(); ?>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-1534620-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>


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

        <a href="//timetotrade.eu">
            <img src="//cdn.timetotrade.eu/images/logos/25px.png" alt="timetotrade">
        </a>

        {$this->getNavigationHTML()}

        {$this->searchBox()}

    </header>
</div>
EOF;
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
    <a href="//timetotrade.eu/summary.php" id="tl_portfolio">Portfolio</a>
    <ul>
      <li>
        <a href="//timetotrade.eu/summary.php" id="portfolio">Portfolio</a>
      </li>
      <li class="hasChildren">
        <a href="//timetotrade.eu/ledger.php" id="accounts">Accounts</a>
        <ul>
          <li>
            <a href="//timetotrade.eu/ledger.php" id="actual_accounts">Actual</a>
          </li>
          <li>
            <a href="//timetotrade.eu/ledger.php?category=simulated" id="simulated_accounts">Simulated</a>
          </li>
          <li>
            <a href="//timetotrade.eu/ledger.php?category=competition" id="competition_accounts">Competition</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="//timetotrade.eu/markets.php" id="markets">Markets</a>
      </li>
      <li>
        <a href="//timetotrade.eu/portfolio.php" id="watchlists">Watchlists</a>
      </li>
      <li class="hasChildren">
        <a href="//timetotrade.eu/competitions.php" id="competitions">Competitions</a>
        <ul>
          <li>
            <a href="//timetotrade.eu/competitions.php" id="enterCompetitions">Competitions</a>
          </li>
          <li>
            <a href="//timetotrade.eu/competitions.php?show=entry" id="createCompetitions">Create&nbsp;Competitions</a>
          </li>
        </ul>
      </li>
      <li class="hasChildren">
        <a href="//timetotrade.eu/performance_portfolio.php" id="performance">Performance</a>
        <ul>
          <li>
            <a href="//timetotrade.eu/performance_club.php">club</a>
          </li>
          <li>
            <a href="//timetotrade.eu/performance_portfolio.php" id="performanceWeighting">Weighting</a>
          </li>
          <li>
            <a href="//timetotrade.eu/performance_report.php" id="performancePortfolio">Portfolio</a>
          </li>
          <li>
            <a href="//timetotrade.eu/performance_investments.php" id="performanceInvestments">Investments</a>
          </li>
          <li>
            <a href="//timetotrade.eu/performance_taxation.php" id="performanceTaxation">Taxation</a>
          </li>
        </ul>
      </li>
      <li class="hasChildren">
        <a href="//timetotrade.eu/taxation.php" id="taxation">Taxation</a>
        <ul>
          <li>
            <a href="//timetotrade.eu/185new.php">Form&nbsp;185</a>
          </li>
          <li>
            <a href="//timetotrade.eu/cgt_uk.php" id="captialGains">Capital&nbsp;Gains</a>
          </li>
          <li>
            <a href="//timetotrade.eu/income_tax_personal.php" id="incomeTax">Income&nbsp;Tax</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="//timetotrade.eu/reports.php" id="reports">Reports</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="//timetotrade.eu/trade.php?show=orderhistory" id="tl_trade">Trade</a>
    <ul>
      <li>
        <a href="//timetotrade.eu/trade.php?show=orderhistory" id="orderHistory">Order&nbsp;History</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="//timetotrade.eu/buildalert.php" id="tl_charts">Charts</a>
    <ul>
      <li>
        <a href="//timetotrade.eu/buildalert.php" id="fullWidth">Full&nbsp;Width</a>
      </li>
      <li>
        <a href="//timetotrade.eu/buildalert.php?fullscreen=0" id="tools">Tools</a>
      </li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="//timetotrade.eu/community" id="tl_river">Community</a>
    <ul>
      <li>
        <a href="//timetotrade.eu/community" id="publicForum">Public&nbsp;Forum</a>
      </li>
      <li>
        <a href="//timetotrade.eu/managefiles.php" id="documentLibrary">Document&nbsp;Library</a>
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
        <a href="//timetotrade.eu/packages.php" id="packages">Pricing</a>
      </li>
      <li>
        <a href="//timetotrade.eu/tickets.php?view=createticket" id="contactUs">Contact&nbsp;Us</a>
      </li>
    </ul>
  </li>
</ul>
</nav>
EOF;
        return $html;
    }
}