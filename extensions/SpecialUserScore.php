<?php
$wgExtensionFunctions[] = "wfExtensionSpecialUserScore";
 
// Extension credits that show up on Special:Version
$wgExtensionCredits['specialpage'][] = array(
        'name' => 'Special:UserScore',
        'author' => 'Mathias Feindt',
        'url' => 'http://www.mediawiki.org/wiki/Extension:SpecialUserScore',
        'description' => 'Special page for displaying user score as measured by number of contributions.'
);
 
function wfExtensionSpecialUserScore() {
    global $wgMessageCache;
    $wgMessageCache->addMessages(array('userscore' => 'UserScore')); 
    SpecialPage::addPage( new SpecialPage( 'UserScore' , 'userrights') );
}
?>