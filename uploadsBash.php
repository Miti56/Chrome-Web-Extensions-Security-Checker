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
//check if form is submitted
if (isset($_POST['submit']))
{
    $filename = $_FILES['file1']['name'];
    $description = $_POST['description'];

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['json', 'zip' , 'txt'];

        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            // get last record id
            $sql = 'select max(id) as id from filesBash';
            $result = mysqli_query($con, $sql);
            if (count($result) > 0)
            {
                $row = mysqli_fetch_array($result);
                $filename = ($row['id']+1) . '-' . $filename;
            }
            else
                $filename = '1' . '-' . $filename;

            //set target directory
            $path = 'uploadsBash/';

            $created = @date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));

            $versionManifest = '2';

            // insert file details into database
            $sql = "INSERT INTO filesBash(filename, description ,created, manifestversion ) VALUES('$filename', '$description' ,'$created', '$versionManifest')";
            mysqli_query($con, $sql);



            //------START UPLOADING DATABASE----

            //CREATE NEW DB FOR UPLOAD
            $zip = new ZipArchive;
            $res = $zip->open('uploadsBash/'.$filename);
            //get name inside the zip file
            $nameInsideZip='';
            for($i = 0; $i < 1; $i++)
            {
                $nameInsideZip = $zip->getNameIndex($i) ;
                $nameInsideZip = substr_replace($nameInsideZip, "", -1);

            }
            $dbName= $nameInsideZip;


            $query = "create table ".$dbName."
(
    id                        int auto_increment
        primary key,
    nameUser                  varchar(255) null,
    name                      varchar(255) null,
    manifestVersion           varchar(255) null,
    version                   varchar(255) null,
    description               longtext     null,
    author                    varchar(255) null,
    versionName               varchar(255) null,
    minimumChromeVersion      varchar(255) null,
    shortName                 varchar(255) null,
    `key`                     varchar(255) null,
    contentScriptsMatches     varchar(255) null,
    contentScriptsCSS         varchar(255) null,
    contentScriptsJS          varchar(255) null,
    contentScriptsRUN         varchar(255) null,
    contentScriptsFRAMES      varchar(255) null,
    incognito                 varchar(255) null,
    optionalPermissions       varchar(255) null,
    permissions               varchar(255) null,
    contentSecurityPolicy     varchar(255) null,
    action                    varchar(255) null,
    automation                varchar(255) null,
    backgroundScripts         varchar(255) null,
    backgroundPersistent      varchar(255) null,
    chromeUrlOverridesBooks   varchar(255) null,
    chromeUrlOverridesHistory varchar(255) null,
    chromeUrlOverridesNewTab  varchar(255) null,
    homepageLink              varchar(255) null,
    startupPage               varchar(255) null,
    searchProvider            varchar(255) null,
    otherUrls                 varchar(255) null,
    eventRulesEvent           varchar(255) null,
    eventRulesActionsType     varchar(255) null,
    eventRulesConditionsType  varchar(255) null,
    eventRulesConditionsCss   varchar(255) null,
    homePageUrl               varchar(255) null,
    offlineEnabled            varchar(255) null,
    webAccessibleResources    varchar(255) null,
    omniboxKeyword            varchar(255) null,
    storageManagedSchema      varchar(255) null,
    tts_engine                varchar(255) null,
    import                    varchar(255) null,
    export                    varchar(255) null
)";
//            $stmt = $sql->prepare($query);
//            $stmt->bind_param("test");
//            $stmt->execute();
            mysqli_query($con, $query);

            //unzip file
            $zip = new ZipArchive;
            $res = $zip->open('uploadsBash/'.$filename);
            $nameInsideZip='';
            //get name inside the zip file
            for($i = 0; $i < 1; $i++)
            {
                $nameInsideZip = $zip->getNameIndex($i) ;
                $nameInsideZip = substr_replace($nameInsideZip, "", -1);

            }
            //Delete MACOSX created folder
            if ($res === TRUE) {
                $zip->extractTo('uploadsUnzipped/');
                $zip->close();
                $files = [
                    'unziptest/_MACOSX'
                ];

                foreach ($files as $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    } else {
                        echo "File not found";
                    }
                }
                echo "yes and file deleted";
            } else {
                echo "no";
            }



            //ADD TO DATABASE
            $path = 'uploadsUnzipped/'.$nameInsideZip.'/';
            $files = array_values(array_filter(scandir($path), function($file) use ($path) {
                return !is_dir($path . '/' . $file);
            }));

            $n=1;
            foreach($files as $file) {
                $data = file_get_contents('uploadsUnzipped/'.$nameInsideZip.'/'.$file);
                $obj = json_decode($data);
                $n = $n + 1;
                echo 'uploadsUnzipped/'.$nameInsideZip.'/'.$files[$n];
                echo "<br>";
                echo $n;


                //introduction
                $nameUser = $filename;


                if ($obj->name == null) {
                    $name = "no_name";
                } else {
                    $name = $obj->name;
                }
                $manifestVersion = addslashes($obj->manifest_version);
                $version = addslashes($obj->version);
                $description = addslashes($obj->description);
                $author = addslashes($obj->author);
                $versionName = addslashes($obj->version_name);
                $minimumChromeVersion = addslashes($obj->minimum_chrome_version);
                $shortName = addslashes($obj->short_name);
                $key = addslashes($obj->key);

                //Security
                $contentScriptsMatches = addslashes($obj->content_scripts['0']->matches[0]);
                $contentScriptsCSS = addslashes($obj->content_scripts['0']->css[0]);
                $contentScriptsJS = addslashes($obj->content_scripts['0']->js[0]);
                $contentScriptsRUN = addslashes($obj->content_scripts['0']->run_at);
                if ($obj->content_scripts['0']->all_frames == '1') {
                    $contentScriptsFRAMES = "True";
                } else {
                    $contentScriptsFRAMES = "False";
                }
                $incognito = addslashes($obj->incognito);
                $optionalPermissions = '';
                for ($x = 0; $x <= 5; $x++) {
                    $optionalPermissions = $optionalPermissions . '/' . (addslashes($obj->optional_permissions[strval($x)]));
                }

                $permissions = '';
                for ($x = 0; $x <= 5; $x++) {
                    $permissions = $permissions . '/' . (addslashes($obj->permissions[strval($x)]));
                }
                $contentSecurityPolicy = addslashes($obj->content_security_policy);

                //Behaviour
                $action = addslashes($obj->action);
                $automation = addslashes($obj->automation);
                $backgroundScripts = '';
                for ($x = 0; $x <= 5; $x++) {
                    $backgroundScripts = $backgroundScripts . '/' . (addslashes($obj->background->scripts[strval($x)]));
                }
                if ($obj->background->persistent == '1') {
                    $backgroundPersistent = "True";
                    echo "<br>";
                } else {
                    $backgroundPersistent = "False";
                    echo "<br>";
                }
                $books = addslashes($obj->chrome_url_overrides->bookmarks);
                $history = addslashes($obj->chrome_url_overrides->history);
                $newtab = addslashes($obj->chrome_url_overrides->newtab);
                $homepage = addslashes($obj->chrome_settings_overrides->homepage);
                $startup_pages = addslashes($obj->chrome_settings_overrides->startup_pages[0]);
                $searchProvider2 = addslashes($obj->chrome_settings_overrides->search_provider->name);
                $alternateURL = addslashes($obj->chrome_settings_overrides->search_provider->alternate_urls[0]);
                $event = '';
                for ($x = 0; $x <= 5; $x++) {
                    $event = $event . '/' . addslashes($obj->event_rules[$x]->event);
                }
                $action = addslashes($obj->event_rules[0]->actions[0]->type);
                $condition = addslashes($obj->event_rules[0]->conditions[0]->type);
                $css = addslashes($obj->event_rules[0]->conditions[0]->css[0]);
                $homepageUrl = addslashes($obj->homepage_url);
                if ($obj->offline_enabled == '1') {
                    $offlineEnabled = "True";
                } else {
                    $offlineEnabled = "False";
                }
                $webAccessibleResources = '';
                for ($x = 0; $x <= 5; $x++) {
                    $webAccessibleResources = $webAccessibleResources . '/' . addslashes(($obj->web_accessible_resources[strval($x)]));
                }
                //Misc
                $omniboxKeyword = addslashes($obj->omnibox->keyword);
                $storageManagedSchema = addslashes($obj->storage->managed_schema);
                if ($obj->tts_engine == null) {
                    $ttsSupport = "False";
                } else {
                    $ttsSupport = "True";
                }
                $import = print_r($obj->import, true);
                $export = print_r($obj->export, true);


                $dbName= $nameInsideZip;
                $query = "INSERT INTO ".$dbName." (
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
,   export ) VALUES ('$nameUser',
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

//                $stmt = $sql->prepare($query);
//                $stmt->bind_param("test");
//                $stmt->execute();
                mysqli_query($con, $query);


                //-----------------------------
                header("Location: uploadViewBash.php?st=success");
            }
        }
        else
        {
            header("Location: uploadViewBash.php?st=error");
        }
    }
    else
        header("Location: uploadViewBash.php");
}
?>

