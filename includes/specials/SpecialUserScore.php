<?php

#
# SpecialUserScore MediaWiki extension
#
# Copyright (C) 2006 Mathias Feindt
# http://www.mediawiki.org/
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along
# with this program; if not, write to the Free Software Foundation, Inc.,
# 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
# http://www.gnu.org/copyleft/gpl.html
#
#
# Revisions
# 5-12-2006 MPalmer
# I changed the SQL (also changed SQL to use SQL aliases and FROM clause) statement and modifed
# formatResult to report n Edits on m pages
# I thought it would be useful to know how many actual pages were being edited...

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