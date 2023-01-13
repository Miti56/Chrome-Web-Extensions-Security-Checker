<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);






$sql = "select * from `extensionsV3` where nameUser= '1-testFile.json'";
$result = mysqli_query($con, $sql);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysqli_fetch_array($result)) {
        echo $row['id'];
        echo $row['nameUser'];
        echo $row['name'];
        echo $row['manifestVersion'];
        echo $row['description'];
        echo $row['author'];
        echo $row['versionName'];
        echo $row['minimumChromeVersion'];
        echo $row['shortName'];
        echo $row['key'];
    }
}