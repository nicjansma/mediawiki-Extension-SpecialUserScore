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
# 5-12-2006 MPalmer
# I changed the SQL (also changed SQL to use SQL aliases and FROM clause) statement and modifed
# formatResult to report n Edits on m pages
# I thought it would be useful to know how many actual pages were being edited...
#
# 12-18-2011 Nic Jansma
# (details in README.md)
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
        'version' => '2.0.1'
);

$wgSpecialPages['UserScore'] = 'UserScorePage';

$wgSpecialPageGroups['UserScore'] = 'users'; 

?>
