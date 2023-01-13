<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if(!isset($_SESSION)) {
    $fileName = $_SESSION['fileName'];
}else {

    $fileNameRaw = $_POST['fileName'];
    $fileNameClean = $title = str_replace( array( '\'', '"', ',' , '-', '.', '>' ), ' ', $fileNameRaw);
    $fileNameNum = preg_replace('/[0-9]+/', '', $fileNameClean);
    $fileNameSpace = str_replace(' ','',$fileNameNum);
    $fileName= substr_replace($fileNameSpace, "", -3);
}

$_SESSION['fileName'] = "$fileName";
include 'testBshAnal.php';

//VARIABLES NEEDED FOR PROGRAM



?>

<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Hello</title>

    <style>
        input {
            width:45%;
            background: lightgray;
        }
        .content {
            max-width: 1000px;
            margin: auto;
    </style>
    <script>
        window.onload = function(){
            fillValues();
        };

        var button_id;
        function reply_click(clicked_id)
        {
            button_id = clicked_id;
        }

        function toggleText() {
            var text = document.getElementById(button_id);
            if (text.style.display === "none") {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }

        function fillValues() {

            //------Feedback Name---------
            var conclusionName;
            if (parseInt(<?php echo json_encode($nTotalNameExtension); ?>) == parseInt(<?php echo json_encode($nTotalNumberExtension); ?>) ) {
                conclusionName = "All extensions have a valid name";
                document.getElementById("feedbackName").style.background="lightgreen";
            } else {
                conclusionName = "Some Extensions are missing the names";
                document.getElementById("feedbackName").style.background="orange";
            }
            document.getElementById("feedbackName").value = conclusionName;

            //------Feedback Manifest Version---------
            var conclusionManifestVersion;
            if (parseInt(<?php echo json_encode($nTotalNumberExtension); ?>) == parseInt(<?php echo json_encode($nErrorsManifest); ?>) ) {
                conclusionManifestVersion = "All <?php echo json_encode($nTotalNumberExtension); ?> extensions have a valid Manifest Version";
                document.getElementById("feedbackManifestVersion").style.background="lightgreen";
            } else {
                conclusionManifestVersion = " <?php echo json_encode($nErrorsManifest); ?> extensions have an invalid Manifest Version";
                document.getElementById("feedbackManifestVersion").style.background="orange";
            }
            document.getElementById("feedbackManifestVersion").value = conclusionManifestVersion;

            //------Feedback Version---------
            var conclusionVersion;
            if (parseInt(<?php echo json_encode($nErrorsVersion); ?>) >= 0) {
                conclusionVersion = " <?php echo json_encode($nErrorsVersion); ?> extensions have an invalid Version";
                document.getElementById("feedbackVersion").style.background="red";
            } else {
                conclusionVersion = " <?php echo json_encode($nGoodVersion); ?> extensions have an valid Version";
                document.getElementById("feedbackVersion").style.background="lightgreen";
            }
            document.getElementById("feedbackVersion").value = conclusionVersion;

            //------Feedback Description---------
            var conclusionDescription;
            if (parseInt(<?php echo json_encode($nErrorsDescription); ?>) >= 0) {
                conclusionDescription = " <?php echo json_encode($nErrorsDescription); ?> extensions have an invalid Description";
                document.getElementById("feedbackDescription").style.background="red";
            } else {
                conclusionDescription = " <?php echo json_encode($nGoodDescription); ?> extensions have an valid Description";
                document.getElementById("feedbackDescription").style.background="lightgreen";
            }
            document.getElementById("feedbackDescription").value = conclusionDescription;

            //------Feedback Author---------
            var conclusionAuthor;
            if (parseInt(<?php echo json_encode($nErrorsAuthor); ?>) >= 0) {
                conclusionAuthor = " <?php echo json_encode($nErrorsAuthor); ?> extensions have an invalid Author";
                document.getElementById("feedbackAuthor").style.background="red";
            } else {
                conclusionAuthor = " <?php echo json_encode($nGoodAuthor); ?> extensions have an valid Author";
                document.getElementById("feedbackAuthor").style.background="lightgreen";
            }
            document.getElementById("feedbackAuthor").value = conclusionAuthor;

            //------Feedback VERSION NAME---------
            var conclusionVersionName;
            if (parseInt(<?php echo json_encode($nErrorsVN); ?>) >= 0) {
                conclusionVersionName = " <?php echo json_encode($nErrorsVN); ?> extensions have an invalid Version Name";
                document.getElementById("feedbackVersionName").style.background="red";
            } else {
                conclusionVersionName = " <?php echo json_encode($nGoodVN); ?> extensions have an valid Version Name";
                document.getElementById("feedbackVersionName").style.background="lightgreen";
            }
            document.getElementById("feedbackVersionName").value = conclusionVersionName;

            //------Feedback MINIMUM CHROME VERSION---------
            var conclusionMCV;
            if (parseInt(<?php echo json_encode($nErrorsMCV); ?>) >= 0) {
                conclusionMCV = " <?php echo json_encode($nErrorsMCV); ?> extensions have an invalid Version Name";
                document.getElementById("feedbackMCV").style.background="red";
            } else {
                conclusionMCV = " <?php echo json_encode($nGoodMCV); ?> extensions have an valid Version Name";
                document.getElementById("feedbackMCV").style.background="lightgreen";
            }
            document.getElementById("feedbackMCV").value = conclusionMCV;

            //------Feedback SHORT NAME---------
            var conclusionShortName;
            if (parseInt(<?php echo json_encode($nErrorsSN); ?>) >= 0) {
                conclusionShortName = " <?php echo json_encode($nErrorsSN); ?> extensions have an invalid Short Name";
                document.getElementById("feedbackShortName").style.background="red";
            } else {
                conclusionShortName = " <?php echo json_encode($nGoodSN); ?> extensions have an valid Short Name";
                document.getElementById("feedbackShortName").style.background="lightgreen";
            }
            document.getElementById("feedbackShortName").value = conclusionShortName;

            //------Feedback HOMEPAGE---------
            var conclusionHomePage;
            if (parseInt(<?php echo json_encode($nErrorsHomepage); ?>) >= 0) {
                conclusionHomePage = " <?php echo json_encode($nErrorsHomepage); ?> extensions have an invalid HomePage";
                document.getElementById("feedbackHomePage").style.background="red";
            } else {
                conclusionHomePage = " <?php echo json_encode($nGoodHomepage); ?> extensions have an valid HomePage";
                document.getElementById("feedbackHomePage").style.background="lightgreen";
            }
            document.getElementById("feedbackHomePage").value = conclusionHomePage;
        }
    </script>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="welcome.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="analyzeIndividual.php">General <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analyzeBash2.php">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analyzeBash3.php">Behaviour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analyzeBash4.php">Misc</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Another Extension" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<h1 class="content">Analysis from <?php echo $fileName ?> </h1>
<div class="content">
    File Name: <?php echo $fileName ?>
    <br>

    Name: <?php echo "test" ?>
    <br>
    <input type="text" name="feedbackName" id="feedbackName" readonly>
    <p id='info' style='display: none'>
        <?php echo json_encode($nTotalNameExtension); ?> EXTENSION WITH CORRECT NAMES: <?php
        echo "<br>";
        echo json_encode($totalNameExtension);
        ?> </p>
    <button id='info' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Manifest Version:
    <br>
    <input type="text" name="feedbackManifestVersion" id="feedbackManifestVersion" readonly>
    <p id='info2' style='display: none'>
        <?php echo json_encode($nErrorsManifest); ?> EXTENSIONs WITH INCORRECT MANIFEST VERSIONS: <?php
        echo "<br>";
        echo json_encode($manifestErrors);
        ?> </p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Version:
    <br>
    <input type="text" name="feedbackVersion" id="feedbackVersion" readonly>
    <p id='info3' style='display: none'>
        <?php echo json_encode($nErrorsVersion); ?> EXTENSIONS WITH WRONG VERSIONS: <?php
        echo "<br>";
        echo json_encode($versionErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageVersion); ?> EXTENSIONS WITH TOO LOW OF A VERSIONS: <?php
        echo "<br>";
        echo json_encode($versionAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodVersion); ?> EXTENSIONS WITH GOOD VERSIONS: <?php
        echo "<br>";
        echo json_encode($versionPass);
        ?>
    </p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Description:
    <br>
    <input type="text" name="feedbackDescription" id="feedbackDescription" readonly>
    <p id='info4' style='display: none'>
        <?php echo json_encode($nErrorsDescription); ?> EXTENSIONS WITHOUT DESCRIPTIONS: <?php
        echo "<br>";
        echo json_encode($descriptionErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageDescription); ?> EXTENSIONS WITH EXTERNAL/INVALID DESCRIPTIONS: <?php
        echo "<br>";
        echo json_encode($descriptionAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodDescription); ?> EXTENSIONS WITH VALID DESCRIPTIONS: <?php
        echo "<br>";
        echo json_encode($descriptionGood);
        ?>
    </p>
    <button id='info4' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Author:
    <br>
    <input type="text" name="feedbackAuthor" id="feedbackAuthor" readonly>
    <p id='info5' style='display: none'>
        <?php echo json_encode($nErrorsAuthor); ?> EXTENSIONS WITHOUT AUTHOR: <?php
        echo "<br>";
        echo json_encode($authorErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodAuthor); ?> EXTENSIONS WITH VALID AUTHOR: <?php
        echo "<br>";
        echo json_encode($authorGood);
        ?>
    </p>
    <button id='info5' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Version Name:
    <br>
    <input type="text" name="feedbackVersionName" id="feedbackVersionName" readonly>
    <p id='info6' style='display: none'>
        <?php echo json_encode($nErrorsVN); ?> EXTENSIONS WITHOUT VERSION NAME: <?php
        echo "<br>";
        echo json_encode($vNErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodVN); ?> EXTENSIONS WITH VALID VERSION NAME: <?php
        echo "<br>";
        echo json_encode($vNGood);
        ?>
    </p>
    <button id='info6' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Minimum Chrome Version:
    <br>
    <input type="text" name="feedbackMCV" id="feedbackMCV" readonly>
    <p id='info7' style='display: none'>
        <?php echo json_encode($nErrorsMCV); ?> EXTENSIONS WITHOUT MCV SUPPORT INFO: <?php
        echo "<br>";
        echo json_encode($mCVErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageMCV); ?> EXTENSIONS WITH OLD CHROME SUPPORT: <?php
        echo "<br>";
        echo json_encode($mCVAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodMCV); ?> EXTENSIONS WITH ACCEPTABLE CHROME SUPPORT: <?php
        echo "<br>";
        echo json_encode($mCVGood);
        ?>
    </p>
    <button id='info7' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Short Name:
    <br>
    <input type="text" name="feedbackShortName" id="feedbackShortName" readonly>
    <p id='info8' style='display: none'>
        <?php echo json_encode($nErrorsSN); ?> EXTENSIONS WITHOUT SHORT NAME: <?php
        echo "<br>";
        echo json_encode($sNErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodSN); ?> EXTENSIONS WITH VALID SHORT NAME: <?php
        echo "<br>";
        echo json_encode($sNGood);
        ?>
    </p>
    <button id='info8' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    HomePage:
    <br>
    <input type="text" name="feedbackHomePage" id="feedbackHomePage" readonly>
    <p id='info9' style='display: none'>
        <?php echo json_encode($nErrorsHomepage); ?> EXTENSIONS WITHOUT HOMEPAGE INFO: <?php
        echo "<br>";
        echo json_encode($homepageErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageHomepage); ?> EXTENSIONS WITH INSECURE HOMEPAGES: <?php
        echo "<br>";
        echo json_encode($homepageAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodHomepage); ?> EXTENSIONS WITH SECURE CHROME SUPPORT: <?php
        echo "<br>";
        echo json_encode($homepageGood);
        ?>
    </p>
    <button id='info9' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>


</div>













</body>
</html>
