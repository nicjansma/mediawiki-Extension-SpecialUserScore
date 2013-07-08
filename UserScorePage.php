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
                                            'user_name as title',
                                            NS_USER . ' as namespace' ),
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

                $title = Title::makeTitle( NS_USER, $result->title );
                $userLink = $skin->makeLinkObj( $title, $title->getText() );

                $contribLinkText = $result->value . " edits";

                if (isset($result->page_value)) {
                    // Only the 'value' field is cached in Miser mode
                    $contribLinkText .= " on " . $result->page_value . " pages";
                }

                $contribLink = Linker::linkKnown(
                                SpecialPage::getTitleFor( 'Contributions' ),
                                $contribLinkText,
                                array(),
                                array( 'target' => $result->title ) );
                return "$userLink ($contribLink)";
        }
}

function wfSpecialUserScore() {
        list( $limit, $offset ) = wfCheckLimits();
        $cap = new UserScorePage();
        return $cap->execute(array());
}

?>