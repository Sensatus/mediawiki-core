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
class Skintimetotrade_v3 extends SkinTemplate {
    /** Using timetotrade_v3 */
    public $skinname = 'timetotrade_v3';
    public $stylename = 'timetotrade_v3';
    public $template = 'Timetotrade_v3Template';

    /**
     * Add CSS via ResourceLoader
     *
     * @param $out OutputPage
     */
    function setupSkinUserCss( OutputPage $out ) {
        parent::setupSkinUserCss( $out );

        $out->addModuleStyles( array(
	    'skins.timetotrade_v3.styles'
	));

        $out->addHeadItem('timetotradeCSS',
            '<link rel="stylesheet" href="//timetotrade.eu/sensatus_css.php">'
        );

        $out->addHeadItem('timetotradeLess',
            '<link rel="stylesheet" href="//timetotrade.eu/min/css/less/site.css">'
        );

        $out->addHeadItem('timetotradeAlerts',
            '<link rel="stylesheet" href="//timetotrade.eu/alerts.css">'
        );
    }
}

/**
 * BaseTemplate class for Timetotrade skin
 *
 * @ingroup Skins
 */
class Timetotrade_v3Template extends BaseTemplate {

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
            &#169; 2005-<?php echo date('Y'); ?> Mercor Index Ltd.
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
            <img src="//timetotrade.eu/images/branding/logo-white-25px.png" srcset="//timetotrade.eu/images/branding/logo-white-25px.png 1x, //timetotrade.eu/images/branding/logo-white-50px.png 2x, //timetotrade.eu/images/branding/logo-white-75px.png 3x, //timetotrade.eu/images/branding/logo-white-100px.png 4x" alt="timetotrade">
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
            "src" => "//timetotrade.eu/images/magnifyingGlassWhite.png"
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
<ul class="root">
  <li class="hasChildren">
    <a href="/Introduction_to_timetotrade">Products</a>
    <ul>
      <li><a href="/Trigger_Trading_Technology">Trigger&nbsp;Trading</a></li>
      <li><a href="/Backtest_Trading_Strategies">Strategy&nbsp;Builder</a></li>
      <li><a href="/Trade_Off_The_Chart">Charts&nbsp;&amp;&nbsp;Alerts</a></li>
      <li><a href="/UK_HMRC_Capital_Gains_Tax_Calculator">CGT&nbsp;Calculator</a></li>
      <li><a href="/Investment_Club_Software">Investment&nbsp;Clubs</a></li>
      <li><a href="/Live_Account_Features">Live&nbsp;Account&nbsp;Features</a></li>
    </ul>
  </li>
  <li class="hasChildren">
    <a href="/">Information</a>
    <ul>
      <li><a href="/">Help Wiki</a></li>
      <li>
        <a href="https://platform.timetotrade.com/account/dealing-charges">Dealing&nbsp;Charges</a>
      </li>
      <li>
        <a href="https://platform.timetotrade.com/info/fee-schedule">Fee&nbsp;Schedule</a>
      </li>
      <li class="hasChildren">
        <a href="//timetotrade.eu/buildalert.php" id="tl_charts">Terms&nbsp;&amp;&nbsp;Conditions</a>
        <ul>
          <li>
            <a href="https://platform.timetotrade.com/info/terms/shares" id="terms">Share&nbsp;Terms&nbsp;&amp;&nbsp;Conditions</a>
          </li>
          <li>
            <a href="https://platform.timetotrade.com/info/risk-warnings/shares" id="sharesRiskWarning">Shares&nbsp;Risk&nbsp;Warning</a>
          </li>
          <li>
            <a href="https://platform.timetotrade.com/info/terms/leveraged" id="leveragedTerms">Spreadbet,&nbsp;CFD,&nbsp;FX&nbsp;Terms&nbsp;&amp;&nbsp;Conditions</a>
          </li>
          <li>
            <a href="https://platform.timetotrade.com/info/risk-warnings/leveraged" id="derivativeRiskWarning">Spreadbet,&nbsp;CFD,&nbsp;FX&nbsp;Risk&nbsp;Warning</a>
          </li>
          <li>
            <a href="https://platform.timetotrade.com/info/order-execution-policy" id="orderExecutionPolicy">Order&nbsp;Execution&nbsp;Policy</a>
          </li>
          <li>
            <a href="https://platform.timetotrade.com/info/conflicts-of-interest" id="conflictsOfInterest">Conflicts&nbsp;Of&nbsp;Interests</a>
          </li>
          <li>
            <a href="https://timetotrade.com/info/terms/subscription" id="subscriptionTerms">Subscription&nbsp;Terms</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <li><a href="//timetotrade.com/community">Community</a></li>
  <li><a href="/Contact_Us">Contact Us</a></li>
  <li><a href="//timetotrade.com/about-us">About</a></li>
</ul>
</nav>
EOF;
        return $html;
    }
}

