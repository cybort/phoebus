<?php
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this
// file, You can obtain one at http://mozilla.org/MPL

// == | Vars | ================================================================

$strPaleMoonID = '{8de7fcbb-c55c-4fbe-bfc5-fc555c87dbc4}';
$strFirefoxID = '{ec8030f7-c20a-464f-9b0e-13a3a9e97384}';
$strFirefoxVersion = '28.9';

$arrayComponents = array(
    'site' => './phoebus/base/website.php',
    'aus' => './phoebus/components/aus/aus.php',
    'download' => './phoebus/components/download.php',
    'integration' => './phoebus/components/integration.php',
    'discover' => './phoebus/components/discover/discover.php',
    'playground' => './phoebus/components/playground.php'
);

$arrayModules = array(
    'dbExtensions' => './phoebus/modules/db/extensions.php',
    'dbThemes' => './phoebus/modules/db/themes.php',
    'dbLangPacks' => './phoebus/modules/db/langPacks.php',
    'dbSearchPlugins' => './phoebus/modules/db/searchPlugins.php',
    'dbAUSExternals' => './phoebus/modules/db/ausExternals.php',
    'dbSiteExternals' => './phoebus/modules/db/siteExternals.php',
    'dbExtCategories' => './phoebus/modules/db/extCategories.php',
    'readManifest' => './phoebus/modules/funcReadManifest.php',
    'processContent' => './phoebus/modules/funcProcessContent.php',
    'vc' => './phoebus/modules/nsIVersionComparator.php'
);

$strRequestComponent = funcHTTPGetValue('component');
$arrayArgsComponent = preg_grep('/^component=(.*)/', explode('&', parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)));
$strRequestPath = funcHTTPGetValue('path');

// ============================================================================

// == | Main | ================================================================

// Deal with unwanted entry points
if ($_SERVER['REQUEST_URI'] == '/') {
    $strRequestComponent = 'site';
    $strRequestPath = '/';
}
elseif ((count($arrayArgsComponent) > 1) || ($strRequestComponent != 'site' && $strRequestPath != null)) {
    header("HTTP/1.0 404 Not Found");
    exit();
}

// Load component based on strRequestComponent
if ($strRequestComponent != null) {
    if (array_key_exists($strRequestComponent, $arrayComponents)) {
        include_once($arrayComponents[$strRequestComponent]);
    }
    else {
        funcError($strRequestComponent . ' is an unknown component');
    }
}
else {
    funcError('You did not specify a component');
}

// ============================================================================
?>