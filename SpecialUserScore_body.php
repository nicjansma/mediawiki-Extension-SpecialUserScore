<?php

class SpecialUserScore extends QueryPage {
	protected $requestedNamespace = false;

	function __construct( $name = 'UserScore' ) {
		parent::__construct( $name );
	}

	function getName() {
		return 'UserScore';
	}

	protected function getGroupName() {
		return 'users';
	}

	function isExpensive() {
		return true;
	}

	function isSyndicated() {
		return false;
	}

	function sortDescending() {
		return true;
	}

	function getQueryInfo() {
		return array (
			'tables' => array ( 'actor', 'revision', 'page', 'revision_actor_temp' ),
			'fields' => array ( 'COUNT(rev_id) as value',
					    'COUNT(DISTINCT rev_page) as page_value',
					    'actor_name as title',
					    NS_USER . ' as namespace' ),
			'conds' => array ( 'revactor_rev = rev_id',
					   'actor_id = revactor_actor',
					   'page_id = rev_page',
					   'page_namespace = 0' ),
			'options' => array( 'GROUP BY' => 'actor_name' )
		);
	}

	function getOrderFields() {
		return array( 'value' );
	}

	public static function onwgQueryPages( &$queryPages ) {
		$queryPages[] = array( 'SpecialUserScore', 'UserScore' );
		return true;
	}

	function formatResult( $skin, $result ) {
		global $wgContLang;

		$title = Title::makeTitle( NS_USER, $result->title );
		$userLink = Linker::linkKnown( $title, $title->getText() );

		// Only value field is cached in miser mode
		if ( isset( $result->page_value ) ) {
			$contribLinkText = $this->msg( 'userscore-result-both' )->params( $result->value, $result->page_value )->parse();
		} else {
			$contribLinkText = $this->msg( 'userscore-result-edits' )->params( $result->value )->parse();
		}

		$contribLink = Linker::linkKnown(
			SpecialPage::getTitleFor( 'Contributions' ),
			$contribLinkText,
			array(),
			array( 'target' => $result->title ) );

		return $this->msg( 'userscore-result' )->params( $userLink, $contribLink )->plain();
	}
}
