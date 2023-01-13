<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <title>Extension Analyzer</title>
</head>
<body>
<?php
$fileName = $_POST['fileName'];
$data = file_get_contents('uploadsUnzippedCRX/'.$fileName.'/manifest.json');
//print_r($data);
$obj = json_decode($data);
?>
<h1> Analysing <?php echo $fileName ?></h1>
<table class="table table-striped table-hover">
    </br>
    </br>
    <h2> GENERAL INFO </h2>
    <thead>
    <tr>
        <th>Name</th>
        <th>Manifest Version</th>
        <th>Version</th>
        <th>Description</th>
        <th>Author</th>
        <th>Version Name</th>
        <th>Minimum Chrome Version</th>
        <th>Short Name</th>
        <th>Key</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <!-- Introduction -->
        <td><?php echo $obj->name ?></td>
        <td><?php echo $obj->manifest_version; ?></td>
        <td><?php echo $obj->version; ?></td>
        <td><?php echo $obj->description ?></td>
        <td><?php echo $obj->author ?></td>
        <td><?php echo $obj->version_name ?></td>
        <td><?php echo $obj->minimum_chrome_version ?></td>
        <td><?php echo $obj->short_name ?></td>
        <td><?php echo $obj->key?></td>
    </tr>
    </tbody>
</table>
<table class="table table-striped table-hover">
    </br>
    </br>
    <h2> SECURITY </h2>
    <thead>
    <tr>
        <th>Content Scripts</th>
        <th>Incognito</th>
        <th>Optional Permissions</th>
        <th>Permissions</th>
        <th>Content Security Policy</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <!-- SECURITY -->
        <td><?php
            $contentScriptsMatches = $obj->content_scripts['0']->matches[0];
            $contentScriptsCSS = $obj->content_scripts['0']->css[0];
            $contentScriptsJS = $obj->content_scripts['0']->js[0];
            $contentScriptsRUN = $obj->content_scripts['0']->run_at;
            $contentScriptsFRAMES = $obj->content_scripts['0']->all_frames;

            echo "This extension used this website: ".$contentScriptsMatches;
            echo "<br>";
            echo "Name of the script activated: ".$contentScriptsCSS.', '.$contentScriptsJS;
            echo "<br>";
            echo "Activated when: ".$contentScriptsRUN;
            echo "<br>";
            if ($contentScriptsFRAMES== '1' ){
                echo "whatever true means";
            }
            else {
                echo "whatever false means";
            }

            ?></td>
        <td><?php echo $obj->incognito; ?></td>
        <td><?php for ($x = 0; $x <= 10; $x++) {
                echo $obj->optional_permissions[strval($x)];
                echo "<br>";} ?></td>
        <td><?php for ($x = 0; $x <= 10; $x++) {
                echo $obj->permissions[strval($x)];
                echo "<br>";} ?></td>
        <td><?php echo $obj->content_security_policy ?></td>
    </tr>
    </tbody>
</table>
<table class="table table-striped table-hover">
    </br>
    </br>
    <h2> BEHAVIOUR </h2>
    <thead>
    <tr>
        <th>Action</th>
        <th>Automation</th>
        <th>Background</th>
        <th>Chrome URL Overrides</th>
        <th>Chrome Settings Overrides</th>
        <th>Event Rules</th>
        <th>Homepage URL</th>
        <th>Offline Behaviour</th>
        <th>Web Accessible Resources</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <!-- BEHAVIOUR -->
        <td><?php echo $obj->action; ?></td>
        <td><?php echo $obj->automation; ?></td>
        <td><?php
            for ($x = 0; $x <= 5; $x++) {
                echo $obj->background->scripts[strval($x)];
                echo "<br>";}

            if ($obj->background->persistent == '1' ){
                echo "PERSISTENT";
                echo "<br>";
            }
            else {
                echo "NON PERSISTENT";
                echo "<br>";
            }
            ?></td>
        <!-- BEHAVIOUR -->
        <td><?php
            $books = $obj->chrome_url_overrides->bookmarks;
            $history = $obj->chrome_url_overrides->history;
            $newtab = $obj->chrome_url_overrides->newtab;

            echo 'If bookmark is modified, will look like this: ' .$books;
            echo "<br>";
            echo 'If history page is modified, will look like this: ' .$history;
            echo "<br>";
            echo 'If newtab is modified, will look like this: ' .$newtab;
            ?></td>
        <!-- BEHAVIOUR -->
        <td><?php
            $homepage = $obj->chrome_settings_overrides->homepage;
            $startup_pages = $obj->chrome_settings_overrides->startup_pages[0];
            $searchProvider2 = $obj->chrome_settings_overrides->search_provider->name;
            $alternateURL= $obj->chrome_settings_overrides->search_provider->alternate_urls[0];

            echo 'Homepage link: '.$homepage;
            echo "<br>";
            echo 'Startup Page : '.$startup_pages;
            echo "<br>";
            echo 'Search Provider: '.$searchProvider2 ;
            echo "<br>";
            echo 'Other URls used: '.$alternateURL;
            echo "<br>";

            ?></td>
        <!-- BEHAVIOUR -->
        <td><?php
            $x = 0;
            while($obj->event_rules[strval($x)]->event !== null) {
                $event =  $obj->event_rules[$x]->event;
                echo "This event activated is: ".$event;
                echo "<br>";
                $x++;
            }
            $action =  $obj->event_rules[0]->actions[0]->type;
            echo "The action performed is: ".$action;
            echo "<br>";
            $condition =  $obj->event_rules[0]->conditions[0]->type;
            echo "The condition used is: ".$condition;
            echo "<br>";
            $css =  $obj->event_rules[0]->conditions[0]->css[0];
            echo "Interacts with the ".$css." part of the website ";
            echo "<br>";



            ?></td>
        <!-- BEHAVIOUR -->
        <td><?php echo $obj->homepage_url ?></td>
        <!-- BEHAVIOUR -->
        <td><?php
            if ($obj->offline_enabled == '1' ){
                echo "Extension works without online connection";
                echo "<br>";
            }
            else {
                echo "Extension is not able to run without internet connection";
                echo "<br>";
            }?></td>
        <!-- BEHAVIOUR -->
        <td><?php
            for ($x = 0; $x <= 5; $x++) {
                echo $obj->web_accessible_resources[strval($x)];
                echo "<br>";}

            ?></td>
    </tr>
    </tbody>
</table>
<table class="table table-striped table-hover">
    </br>
    </br>
    <h2> MISC </h2>
    <thead>
    <tr>
        <th>Omnibox</th>
        <th>Storage</th>
        <th>TTS Engine</th>
        <th>Import</th>
        <th>Export</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <!-- MISC -->
        <td><?php echo $obj->omnibox->keyword; ?></td>
        <!-- MISC -->
        <td><?php echo $obj->storage->managed_schema; ?></td>
        <!-- MISC -->
        <td><?php
            if ($obj->tts_engine == null ){
                echo "NO TTS SUPPORT";
                echo "<br>";
            }
            else {
                echo "TTS SUPPORT";
                echo "<br>";
            }
            ?></td>
        <!-- MISC -->
        <td><?php echo print_r($obj->import,true); ?></td>
        <!-- MISC -->
        <td><?php echo print_r($obj->export,true); ?></td>
    </tr>
    </tbody>
</table>
<a href="uploadView.php">
    <button2>Go back</button2>

</body>
</html>

