<?php
/**
 * Custom timetotrade skin. Based on a wikimedia tutorial
 * https://www.mediawiki.org/wiki/Manual:Skinning_Part_2
 *
 * PHP version 5
 *
 *
 * @category   WIKI
 * @package    WIKI
 * @author     Dary McGovern <dary@sensatus.com>
 * @copyright  2016 Sensatus UK Ltd
 * @license    http://timetotrade.eu TimeToTrade
 * @link       http://wiki.timetotrade.eu
 *
 * @file
 * @ingroup Skins
 */


/**
 * SkinTemplate class for Timetotrade skin
 * @ingroup Skins
 */
class Skintimetotrade_v2 extends SkinTemplate {
    /** Using timetotrade_v2 */
    public $skinname = 'timetotrade_v2';
    public $stylename = 'timetotrade_v2';
    public $template = 'Timetotrade_v2Template';

    /**
     * Add CSS via ResourceLoader
     *
     * @param $out OutputPage
     */
    function setupSkinUserCss( OutputPage $out ) {
        parent::setupSkinUserCss( $out );

        $out->addModuleStyles( array(
	    'skins.timetotrade_v2.styles'
	));

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
class Timetotrade_v2Template extends BaseTemplate {

    /**
     * Outputs the entire contents of the page
     */
    public function execute()
    {

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

        <!--        <?php $this->printTrail(); ?>  -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-1534620-1', 'auto', {'allowLinker': true});
            ga('require', 'linker');
            ga('linker:autoLink', ['timetotrade.eu']);
            ga('send', 'pageview');
        </script>
	<?php
	$this->printTrail();
        echo Html::closeElement( 'body' );
        echo Html::closeElement( 'html' );
        echo "\n";
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
        $params = array( "id" => "searchInput", "type" => "text", "placeholder" => "Search Wiki..." );
	$html = '<div class="symbol-search">';
        $html .= '<form action="" id="searchform" class="symbolLookup">';
        $html .= '<input type="hidden" name="title" value="Special:Search"/>';
        $html .= $this->makeSearchInput($params);
	$html .= $this->makeSearchButton(
          "go",
          array(
	    "id" => "searchGoButton",
            "class" => "search-img btn grey",
            "type" => "image",
            "src" => "//cdn.timetotrade.eu/images/magnifyingGlassWhite.png"
          )
        );
        $html .= '</form>';
	$html .= '</div>';
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
    <a href="//timetotrade.eu/broker/registration/" id="tl_trade">Trade</a>
    <ul>
      <li>
        <a href="//timetotrade.eu/broker/registration/">Open&nbsp;Trading&nbsp;Account</a>
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
