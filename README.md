# Special:UserScore

The SpecialUserScore extension for [MediaWiki](http://www.mediawiki.org) measures user scores by the number of contributions.

See the [MediaWiki.org extension page](http://www.mediawiki.org/wiki/Extension:SpecialUserScore) for details.

# Installation

Create a new directory `extensions/SpecialUserScore/`, and copy all of these files into it.

Add the following line to the end of LocalSettings.php:

    wfLoadExtension( 'SpecialUserScore' );

# Version History

Version 1.0 (Mathias Feindt et al):

* Initial import from http://www.mediawiki.org/wiki/Extension:SpecialUserScore.
* Was working as of MediaWiki v1.15.0, but broken as of v1.18.0.

Version 2.0 2011-12-18 (Nic Jansma):

* Works with MediaWiki v1.18.0
* `$wgMessageCache->addMessages` no longer supported, so added `SpecialUserScore.i18n.php` and added to `$wgExtensionMessagesFiles` instead.
* Removed require_once of `QueryPage.php`, as it will be auto-loaded.
* Changed `UserScorePage::getSQL()` to use `getQueryInfo()` instead.
* Changed `UserScorePage::formatResult()` to use `Linker::linkKnown` instead of `$skin->makeKnownLink`, which is no longer available.
* Changed `UserScorePage::formatResult()` to not show a user's real name.

Version 2.0.1 2011-12-18 (Nic Jansma)

* Following best practices for Special page extensions, all files are now placed in `extensions/SpecialUserScore/` (nothing needs to be added to `includes/specials/`)

Version 2.1 2012-04-02 (Nic Jansma)

* Added hook and to register page with $wgQueryPages and updated the query so it works cached in $wgMiserMode

Version 2.1.1 2013-07-08 (Nic Jansma)

* Fixed PHP errors when run in Miser mode

Version 2.2 2016-01-25 (Lojjik Braughler)

* Extension is now only compatible with MediaWiki 1.25+
* Messages can now be internationalized

Version 2.3 2017-03-30 (Nic Jansma)

* Works with `$wgMiserMode` enabled

Version 2.4 2020-12-21 (Clint L. Johnson)

* Updated SQL Query to work with [Actor Migration](https://www.mediawiki.org/wiki/Actor_migration) in MediaWiki 1.35.1

Version 2.5 2025-04-23 (Nic Jansma)

* Updated SQL Query to work with the final stage of the [Actor Migration](https://www.mediawiki.org/wiki/Actor_migration) that removed the `revision_actor_temp` table in MediaWiki 1.39+
