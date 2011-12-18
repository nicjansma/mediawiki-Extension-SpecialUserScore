# Installation

Copy the following files into their respective directories:

1. `extensions/SpecialUserScore.php`
2. `includes/specials/SpecialUserScore.php`

Add the following line to the end of LocalSettings.php:

    require_once( "$IP/extensions/SpecialUserScore.php" );

# Version History

Version 1.0 (Mathias Feindt et al):

* Initial import from http://www.mediawiki.org/wiki/Extension:SpecialUserScore.
* Was working as of MediaWiki v1.15.0, but broken as of v1.18.0.

Version 2.0 (Nic Jansma):

* Works with MediaWiki v1.18.0
* `$wgMessageCache->addMessages` no longer supported, so added `SpecialUserScore.i18n.php` and added to `$wgExtensionMessagesFiles` instead.
* Removed require_once of `QueryPage.php`, as it will be auto-loaded.
* Changed `UserScorePage::getSQL()` to use `getQueryInfo()` instead.
* Changed `UserScorePage::formatResult()` to use `Linker::linkKnown` instead of `$skin->makeKnownLink`, which is no longer available.
* Changed `UserScorePage::formatResult()` to not show a user's real name.
