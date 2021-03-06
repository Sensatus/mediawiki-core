<?php
/**
 * Implements Special:Newimages
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup SpecialPage
 */

class SpecialNewFiles extends IncludableSpecialPage {
	public function __construct() {
		parent::__construct( 'Newimages' );
	}

	public function execute( $par ) {
		$this->setHeaders();
		$this->outputHeader();

		$out = $this->getOutput();
		$this->addHelpLink( 'Help:New images' );

		$pager = new NewFilesPager( $this->getContext(), $par );

		if ( !$this->including() ) {
			$this->setTopText();
			$form = $pager->getForm();
			$form->prepareForm();
			$form->displayForm( '' );
		}

		$out->addHTML( $pager->getBody() );
		if ( !$this->including() ) {
			$out->addHTML( $pager->getNavigationBar() );
		}
	}

	protected function getGroupName() {
		return 'changes';
	}

	/**
	 * Send the text to be displayed above the options
	 */
	function setTopText() {
		global $wgContLang;

		$message = $this->msg( 'newimagestext' )->inContentLanguage();
		if ( !$message->isDisabled() ) {
			$this->getOutput()->addWikiText(
				Html::rawElement( 'p',
					[ 'lang' => $wgContLang->getHtmlCode(), 'dir' => $wgContLang->getDir() ],
					"\n" . $message->plain() . "\n"
				),
				/* $lineStart */ false,
				/* $interface */ false
			);
		}
	}
}

/**
 * @ingroup SpecialPage Pager
 */
class NewFilesPager extends ReverseChronologicalPager {
	/**
	 * @var ImageGallery
	 */
	protected $gallery;

	/**
	 * @var bool
	 */
	protected $showBots;

	/**
	 * @var bool
	 */
	protected $hidePatrolled;

	function __construct( IContextSource $context, $par = null ) {
		$this->like = $context->getRequest()->getText( 'like' );
		$this->showBots = $context->getRequest()->getBool( 'showbots', 0 );
		$this->hidePatrolled = $context->getRequest()->getBool( 'hidepatrolled', 0 );
		if ( is_numeric( $par ) ) {
			$this->setLimit( $par );
		}

		parent::__construct( $context );
	}

	function getQueryInfo() {
		$conds = $jconds = [];
		$tables = [ 'image' ];

		if ( !$this->showBots ) {
			$groupsWithBotPermission = User::getGroupsWithPermission( 'bot' );

			if ( count( $groupsWithBotPermission ) ) {
				$tables[] = 'user_groups';
				$conds[] = 'ug_group IS NULL';
				$jconds['user_groups'] = [
					'LEFT JOIN',
					[
						'ug_group' => $groupsWithBotPermission,
						'ug_user = img_user'
					]
				];
			}
		}

		if ( $this->hidePatrolled ) {
			$tables[] = 'recentchanges';
			$conds['rc_type'] = RC_LOG;
			$conds['rc_log_type'] = 'upload';
			$conds['rc_patrolled'] = 0;
			$jconds['recentchanges'] = [
				'INNER JOIN',
				[
					'rc_title = img_name',
					'rc_user = img_user',
					'rc_timestamp = img_timestamp'
				]
			];
		}

		if ( !$this->getConfig()->get( 'MiserMode' ) && $this->like !== null ) {
			$dbr = wfGetDB( DB_SLAVE );
			$likeObj = Title::newFromText( $this->like );
			if ( $likeObj instanceof Title ) {
				$like = $dbr->buildLike(
					$dbr->anyString(),
					strtolower( $likeObj->getDBkey() ),
					$dbr->anyString()
				);
				$conds[] = "LOWER(img_name) $like";
			}
		}

		$query = [
			'tables' => $tables,
			'fields' => '*',
			'join_conds' => $jconds,
			'conds' => $conds
		];

		return $query;
	}

	function getIndexField() {
		return 'img_timestamp';
	}

	function getStartBody() {
		if ( !$this->gallery ) {
			// Note that null for mode is taken to mean use default.
			$mode = $this->getRequest()->getVal( 'gallerymode', null );
			try {
				$this->gallery = ImageGalleryBase::factory( $mode, $this->getContext() );
			} catch ( Exception $e ) {
				// User specified something invalid, fallback to default.
				$this->gallery = ImageGalleryBase::factory( false, $this->getContext() );
			}
		}

		return '';
	}

	function getEndBody() {
		return $this->gallery->toHTML();
	}

	function formatRow( $row ) {
		$name = $row->img_name;
		$user = User::newFromId( $row->img_user );

		$title = Title::makeTitle( NS_FILE, $name );
		$ul = Linker::link( $user->getUserpage(), $user->getName() );
		$time = $this->getLanguage()->userTimeAndDate( $row->img_timestamp, $this->getUser() );

		$this->gallery->add(
			$title,
			"$ul<br />\n<i>"
				. htmlspecialchars( $time )
				. "</i><br />\n"
		);
	}

	function getForm() {
		$fields = [
			'like' => [
				'type' => 'text',
				'label-message' => 'newimages-label',
				'name' => 'like',
			],
			'showbots' => [
				'type' => 'check',
				'label-message' => 'newimages-showbots',
				'name' => 'showbots',
			],
			'hidepatrolled' => [
				'type' => 'check',
				'label-message' => 'newimages-hidepatrolled',
				'name' => 'hidepatrolled',
			],
			'limit' => [
				'type' => 'hidden',
				'default' => $this->mLimit,
				'name' => 'limit',
			],
			'offset' => [
				'type' => 'hidden',
				'default' => $this->getRequest()->getText( 'offset' ),
				'name' => 'offset',
			],
		];

		if ( $this->getConfig()->get( 'MiserMode' ) ) {
			unset( $fields['like'] );
		}

		if ( !$this->getUser()->useFilePatrol() ) {
			unset( $fields['hidepatrolled'] );
		}

		$context = new DerivativeContext( $this->getContext() );
		$context->setTitle( $this->getTitle() ); // Remove subpage
		$form = new HTMLForm( $fields, $context );

		$form->setSubmitTextMsg( 'ilsubmit' );
		$form->setSubmitProgressive();

		$form->setMethod( 'get' );
		$form->setWrapperLegendMsg( 'newimages-legend' );

		return $form;
	}
}
