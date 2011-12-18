<?php

class UserScorePage extends QueryPage {
        protected $requestedNamespace = false;

        function __construct( $name = 'UserScore' ) {
                parent::__construct( $name );
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
                        'tables' => array ( 'user', 'revision', 'page' ),
                        'fields' => array ( 'COUNT(rev_id) as value',
                                            'COUNT(DISTINCT rev_page) as page_value',
                                            'user_name as name' ),
                        'conds' => array ( 'user_id = rev_user',
                                           'page_id = rev_page',
                                           'page_namespace = 0' ),
                        'options' => array( 'GROUP BY' => 'user_name' )
                );
        }

        function getOrderFields() {
                return array( 'value' );
        }

        function formatResult( $skin, $result ) {
                global $wgContLang;

                $title = Title::makeTitle( NS_USER, $result->name );
                $userLink = $skin->makeLinkObj( $title, $title->getText() );

                $contribLinkText = $result->value . " edits on " . $result->page_value . " pages";
                $contribLink = Linker::linkKnown(
                                SpecialPage::getTitleFor( 'Contributions' ),
                                $contribLinkText,
                                array(),
                                array( 'target' => $result->name ) );
                return "$userLink ($contribLink)";
        }
}

function wfSpecialUserScore() {
        list( $limit, $offset ) = wfCheckLimits();
        $cap = new UserScorePage();
        return $cap->execute(array());
}

?>