<?php
#
# SpecialUserScore MediaWiki extension
#
# Copyright (C) 2006 Mathias Feindt
# http://www.mediawiki.org/
#
# Updated for MediaWiki 1.18.0 by Nic Jansma
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
# Revisions
# ---------
# (see README.md)
#
# Installation
# ------------
# (see README.md)
#

if (!defined('MEDIAWIKI')) {
        exit( 1 );
}

$wgExtensionMessagesFiles['SpecialUserScore'] = dirname( __FILE__ ) . '/SpecialUserScore.i18n.php';
$wgAutoloadClasses['UserScorePage'] = dirname( __FILE__ ) . '/UserScorePage.php';

// Extension credits that show up on Special:Version
$wgExtensionCredits['specialpage'][] = array(
        'name' => 'Special:UserScore',
        'author' => 'Mathias Feindt, Nic Jansma, et al.',
        'url' => 'http://www.mediawiki.org/wiki/Extension:SpecialUserScore',
        'description' => 'Special page for displaying user score as measured by number of contributions.',
        'version' => '2.1'
);

$wgSpecialPages['UserScore'] = 'UserScorePage';

$wgSpecialPageGroups['UserScore'] = 'users'; 

$wgHooks['wgQueryPages'][] = 'wfSpecialUserScoreHook';

function wfSpecialUserScoreHook( &$queryPages ) {
        $queryPages[] = array( 'UserScorePage' , 'UserScore' );
        return true;
}

?>
