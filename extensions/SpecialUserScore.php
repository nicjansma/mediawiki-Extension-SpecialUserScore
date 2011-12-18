<?php
$wgExtensionFunctions[] = "wfExtensionSpecialUserScore";

// load message file
$wgExtensionMessagesFiles['SpecialUserScore'] = dirname( __FILE__ ) . "/SpecialUserScore.i18n.php";

// Extension credits that show up on Special:Version
$wgExtensionCredits['specialpage'][] = array(
        'name' => 'Special:UserScore',
        'author' => 'Mathias Feindt and Nic Jansma',
        'url' => 'http://www.mediawiki.org/wiki/Extension:SpecialUserScore',
        'description' => 'Special page for displaying user score as measured by number of contributions.',
        'version' => '2.0'
);

function wfExtensionSpecialUserScore() {
    SpecialPage::addPage( new SpecialPage( 'UserScore' , 'userrights' ) );
}
?>
