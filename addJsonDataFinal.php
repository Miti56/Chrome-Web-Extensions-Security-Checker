<?php

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$data = file_get_contents('uploads/25-manifest.json');
$obj = json_decode($data);

//introduction
$name = $obj->name;
$manifestVersion = $obj->manifest_version;
$version= $obj->version;
$description=$obj->description;
$author=$obj->author;
$versionName=$obj->version_name;
$minimumChromeVersion=$obj->minimum_chrome_version ;
$shortName=$obj->short_name;
$key=$obj->key;

//Security
$contentScriptsMatches = $obj->content_scripts['0']->matches[0];
$contentScriptsCSS = $obj->content_scripts['0']->css[0];
$contentScriptsJS = $obj->content_scripts['0']->js[0];
$contentScriptsRUN = $obj->content_scripts['0']->run_at;
if ($obj->content_scripts['0']->all_frames== '1' ){
    $contentScriptsFRAMES = "True";
}
else {
    $contentScriptsFRAMES = "False";
}

$incognito = $obj->incognito;
for ($x = 0; $x <= 10; $x++) {
    $personalPermissions = $obj->optional_permissions[strval($x)];
    }

for ($x = 0; $x <= 10; $x++) {
    $permissions = $obj->permissions[strval($x)];
    }
$contentSecurityPolicy = $obj->content_security_policy;

//Behaviour
$action = $obj->action;
$automation = $obj->automation;
for ($x = 0; $x <= 5; $x++) {
    $backgroundScripts = $obj->background->scripts[strval($x)];
}

if ($obj->background->persistent == '1' ){
    $backgroundPersistent = "True";
    echo "<br>";
}
else {
    $backgroundPersistent = "False";
    echo "<br>";
}
$books = $obj->chrome_url_overrides->bookmarks;
$history = $obj->chrome_url_overrides->history;
$newtab = $obj->chrome_url_overrides->newtab;

$homepage = $obj->chrome_settings_overrides->homepage;
$startup_pages = $obj->chrome_settings_overrides->startup_pages[0];
$searchProvider2 = $obj->chrome_settings_overrides->search_provider->name;
$alternateURL= $obj->chrome_settings_overrides->search_provider->alternate_urls[0];

$x = 0;
while($obj->event_rules[strval($x)]->event !== null) {
    $event =  $obj->event_rules[$x]->event;
    $x++;
}
$action =  $obj->event_rules[0]->actions[0]->type;
$condition =  $obj->event_rules[0]->conditions[0]->type;
$css =  $obj->event_rules[0]->conditions[0]->css[0];
$homepageUrl = $obj->homepage_url;
if ($obj->offline_enabled == '1' ){
    $offlineEnabled = "True";
}
else {
    $offlineEnabled = "False";
}
for ($x = 0; $x <= 5; $x++) {
    $webAccessibleResources = $obj->web_accessible_resources[strval($x)];
    }

//Misc

$omniboxKeyword = $obj->omnibox->keyword;
$storageManagedSchema =$obj->storage->managed_schema;
if ($obj->tts_engine == null ){
    $ttsSupport = "False";
}
else {
    $ttsSupport = "True";
}

$import = print_r($obj->import,true);
$export =  print_r($obj->export,true);

$query = "INSERT INTO extensionsV3 (
    nameUser
,   name
,   manifestVersion
,   version
,   description
,   author
,   versionName
,   minimumChromeVersion
,   shortName
,   `key`
,   contentScriptsMatches
,   contentScriptsCSS
,   contentScriptsJS
,   contentScriptsRUN
,   contentScriptsFRAMES
,   incognito
,   optionalPermissions
,   permissions
,   contentSecurityPolicy
,   action
,   automation
,   backgroundScripts
,   backgroundPersistent
,   chromeUrlOverridesBooks
,   chromeUrlOverridesHistory
,   chromeUrlOverridesNewTab
,   homepageLink
,   startupPage
,   searchProvider
,   otherUrls
,   eventRulesEvent
,   eventRulesActionsType
,   eventRulesConditionsType
,   eventRulesConditionsCss
,   homePageUrl
,   offlineEnabled
,   webAccessibleResources
,   omniboxKeyword
,   storageManagedSchema
,   tts_engine
,   import
,   export ) VALUES ('test',
                                     '$name',
                                     '$manifestVersion',
                                     '$version',
                                     '$description',
                                     '$author',
                                     '$versionName',
                                     '$minimumChromeVersion',
                                     '$shortName',
                                     '$key',
                                     '$contentScriptsMatches',
                                     '$contentScriptsCSS',
                                     '$contentScriptsJS',
                                     '$contentScriptsRUN',
                                     '$contentScriptsFRAMES',
                                     '$incognito',
                                     '$personalPermissions',
                                     '$permissions',
                                     'COntent security privacy test', 
                                     '$action',
                                     '$automation',
                                     '$backgroundScripts',
                                     '$backgroundPersistent',
                                     '$books',
                                     '$history',
                                     '$newtab',
                                     '$homepage',
                                     '$startup_pages',
                                     '$searchProvider2',
                                     '$alternateURL',
                                     '$event',
                                    '$action',
                                    '$condition',
                                     '$css',
                                     '$homepageUrl',
                                     '$offlineEnabled',
                                     '$webAccessibleResources',
                                     '$omniboxKeyword',
                                     '$storageManagedSchema',
                                     '$ttsSupport',
                                     '$import',
                                     '$export')";
mysqli_query($con, $query);
echo "Uploaded to number 2";

?>
