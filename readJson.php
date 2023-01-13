<?php

$data = file_get_contents('uploads/1-manifest.json');
//print_r($data);
$obj = json_decode($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload View & Download file in PHP and MySQL | Demo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
</head>
<h1>GENERAL INFORMATION</h1>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Update URL</th>
                <th>Manifest Version</th>
                <th>Name</th>
                <th>Short Name</th>
                <th>Description</th>
                <th>Default Locale</th>
                <th>Version</th>
                <th>Version Name</th>
                <th>Minimum Chrome Version</th>
                <th>HomePage URL</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $obj->update_url; ?></td>
                    <td><?php echo $obj->manifest_version; ?></td>
                    <td><?php echo $obj->name; ?></td>
                    <td><?php echo $obj->short_name; ?></td>
                    <td><?php echo $obj->description; ?></td>
                    <td><?php echo $obj->default_locale; ?></td>
                    <td><?php echo $obj->version; ?></td>
                    <td><?php echo $obj->version_name; ?></td>
                    <td><?php echo $obj->minimum_chrome_version; ?></td>
                    <td><?php echo $obj->homepage_url; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1>BACKGROUND</h1>
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Scripts</th>
                <th>Persistent</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $obj->scripts; ?></td>
                <td><?php echo $obj->persistent; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h1>CONTENT SCRIPTS</h1>
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>CSS</th>
                <th>JS</th>
                <th>Matches</th>
                <th>Run At</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $obj->scripts; ?></td>
                <td><?php echo $obj->persistent; ?></td>
                <td><?php echo $obj->persistent; ?></td>
                <td><?php echo $obj->persistent; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h1>BROWSER ACTION</h1>
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Default Icon</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $obj->default_icon; ?></td>

            </tr>
            </tbody>
        </table>
    </div>
    <h1>MISC</h1>
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Web Accessible Resources</th>
                <th>Content Security Policy</th>
                <th>Incognito</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $obj->web_accessible_resource; ?></td>
                <td><?php echo $obj->content_security_policy; ?></td>
                <td><?php echo $obj->incognito; ?></td>

            </tr>
            </tbody>
        </table>
    </div>
    <h1>PERMISSIONS</h1>
    <div class="col-xs-8 col-xs-offset-2">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Permissions</th>
                <th>Optional Permissions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $obj->permissions; ?></td>
                <td><?php echo $obj->optional_permissions; ?></td>


            </tr>
            </tbody>
        </table>
    </div>

    <a href="welcome.php">
        <button2>Go back</button2>
</div>
