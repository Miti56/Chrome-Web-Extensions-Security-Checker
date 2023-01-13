<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$path = 'manifestsProject/';

$files = array_values(array_filter(scandir($path), function($file) use ($path) {
    return !is_dir($path . '/' . $file);
}));

//echo $files[0];

//echo $files[17554];
$n=1;
foreach($files as $file){
    set_time_limit(600); //sets the time limit to 10 minutes
    ini_set('memory_limit', '400M'); //raises limit to 32 megabytes
    $data = file_get_contents('manifestsProject/'.$file);
    $obj = json_decode($data);
    $n= $n + 1;
    echo 'manifestsProject/'.$files[$n];
    echo "<br>";
    echo $n;


    //introduction
    if ($obj->name==null){
        $name = "no_name";
    } else{
        $name = $obj->name;
    }
    $manifestVersion = addslashes($obj->manifest_version);
    $version= addslashes($obj->version);
    $description= addslashes($obj->description);
    $author=addslashes($obj->author);
    $versionName=addslashes($obj->version_name);
    $minimumChromeVersion=addslashes($obj->minimum_chrome_version) ;
    $shortName=addslashes($obj->short_name);
    $key=addslashes($obj->key);

    //Security
    $contentScriptsMatches = addslashes($obj->content_scripts['0']->matches[0]);
    $contentScriptsCSS = addslashes($obj->content_scripts['0']->css[0]);
    $contentScriptsJS = addslashes($obj->content_scripts['0']->js[0]);
    $contentScriptsRUN = addslashes($obj->content_scripts['0']->run_at);
    if ($obj->content_scripts['0']->all_frames== '1' ){
        $contentScriptsFRAMES = "True";
    }
    else {
        $contentScriptsFRAMES = "False";
    }
    $incognito = addslashes($obj->incognito);
    $optionalPermissions ='';
    for ($x = 0; $x <= 5; $x++) {
        $optionalPermissions = $optionalPermissions.'/'.(addslashes($obj->optional_permissions[strval($x)]));
    }

    $permissions = '';
    for ($x = 0; $x <= 5; $x++) {
        $permissions = $permissions.'/'.(addslashes($obj->permissions[strval($x)]));
    }
    $contentSecurityPolicy = addslashes($obj->content_security_policy);

    //Behaviour
    $action = addslashes($obj->action);
    $automation = addslashes($obj->automation);
    $backgroundScripts = '';
    for ($x = 0; $x <= 5; $x++) {
        $backgroundScripts = $backgroundScripts.'/'.(addslashes($obj->background->scripts[strval($x)]));
    }
    if ($obj->background->persistent == '1' ){
        $backgroundPersistent = "True";
        echo "<br>";
    }
    else {
        $backgroundPersistent = "False";
        echo "<br>";
    }
    $books = addslashes($obj->chrome_url_overrides->bookmarks);
    $history = addslashes($obj->chrome_url_overrides->history);
    $newtab = addslashes($obj->chrome_url_overrides->newtab);
    $homepage = addslashes($obj->chrome_settings_overrides->homepage);
    $startup_pages = addslashes($obj->chrome_settings_overrides->startup_pages[0]);
    $searchProvider2 = addslashes($obj->chrome_settings_overrides->search_provider->name);
    $alternateURL= addslashes($obj->chrome_settings_overrides->search_provider->alternate_urls[0]);
    $event='';
    for($x = 0; $x <= 5; $x++) {
        $event = $event.'/'.addslashes($obj->event_rules[$x]->event);
    }
    $action =  addslashes($obj->event_rules[0]->actions[0]->type);
    $condition =  addslashes($obj->event_rules[0]->conditions[0]->type);
    $css =  addslashes($obj->event_rules[0]->conditions[0]->css[0]);
    $homepageUrl = addslashes($obj->homepage_url);
    if ($obj->offline_enabled == '1' ){
        $offlineEnabled = "True";
    }
    else {
        $offlineEnabled = "False";
    }
    $webAccessibleResources = '';
    for ($x = 0; $x <= 5; $x++) {
        $webAccessibleResources = $webAccessibleResources.'/'.addslashes(($obj->web_accessible_resources[strval($x)]));
    }
    //Misc
    $omniboxKeyword = addslashes($obj->omnibox->keyword);
    $storageManagedSchema = addslashes($obj->storage->managed_schema);
    if ($obj->tts_engine == null ){
        $ttsSupport = "False";
    }
    else {
        $ttsSupport = "True";
    }
    $import = print_r($obj->import,true);
    $export =  print_r($obj->export,true);

    $query = "INSERT INTO extensionsBash (
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
                                     '$optionalPermissions',
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
}


