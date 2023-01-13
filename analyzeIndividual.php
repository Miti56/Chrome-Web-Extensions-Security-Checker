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

    $fileName = $_POST['fileName'];
}

$_SESSION['fileName'] = "$fileName";

$sql = "select * from `extensionsV3` where nameUser= '$fileName'";
$result = mysqli_query($con, $sql);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $nameUser = $row['nameUser'];
        $name = $row['name'];
        $manifestVersion = $row['manifestVersion'];
        $version = $row['version'];
        $description = $row['description'];
        $author = $row['author'];
        $versionName = $row['versionName'];
        $mCV = $row['minimumChromeVersion'];
        $shortName = $row['shortName'];
        $key = $row['key'];
        $homepageUrl = $row['homePageUrl'];
    }
}
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
            var name = "<?php echo $name ?>";
            var conclusionName;
            if (name !=="2") {
                conclusionName = "Valid Name Provided";
                document.getElementById("feedbackName").style.background="lightgreen";
            } else if (name === '__MSG_ext_name__') {
                conclusionName = "Value Not Provided By Developer";
            } else {
                conclusionName = "ERROR DATA";
            }
            document.getElementById("feedbackName").value = conclusionName;

            //------Feedback Manifest Version---------
            var manifestVersion = "<?php echo $manifestVersion ?>";
            var conclusionManifest;
            if (manifestVersion === "2") {
                conclusionManifest = "Valid Manifest Version Provided";
                document.getElementById("feedbackManifest").style.background="lightgreen";
            } else if (manifestVersion === '3') {
                conclusionManifest = "Invalid Version, problems with reading values might happen";
                document.getElementById("feedbackManifest").style.background="orange";
            } else {
                conclusionManifest = "Invalid Manifest Version";
                document.getElementById("feedbackManifest").style.background="red";
            }
            document.getElementById("feedbackManifest").value = conclusionManifest;

            //------Feedback Version---------
            var version = "<?php echo $version ?>";
            var conclusionVersion;
            if (version === "1") {
                conclusionVersion = "Valid Version Provided BUT";
                document.getElementById("feedbackVersion").style.background="orange";
            } else if (version === '1.0') {
                conclusionVersion = "Valid Version Provided BUT";
                document.getElementById("feedbackVersion").style.background="orange";
            } else if (version === '0.1') {
                conclusionVersion = "Valid Version Provided BUT";
                document.getElementById("feedbackVersion").style.background="orange";
            } else if (version === '0.0.1') {
                conclusionVersion = "Valid Version Provided BUT";
                document.getElementById("feedbackVersion").style.background="orange";
            } else if (version === '') {
                conclusionVersion = "Invalid Version Provided";
                document.getElementById("feedbackVersion").style.background="red";
            }else {
                conclusionVersion = "Valid Version";
                document.getElementById("feedbackVersion").style.background="lightgreen";
            }
            document.getElementById("feedbackVersion").value = conclusionVersion;

            //------Feedback Description---------
            var description = "<?php echo $description ?>";
            var conclusionDescription;
            if (description === "__MSG_ext_desc__") {
                conclusionDescription = "Description Not Provided by Author BUT";
                document.getElementById("feedbackDescription").style.background="orange";
            } else if (description === '__MSG_extdesc__') {
                conclusionDescription = "Description Not Provided by Author BUT";
                document.getElementById("feedbackDescription").style.background="orange";
            } else if (description === '__MSG_appDesc__') {
                conclusionDescription = "Description Not Provided by Author BUT";
                document.getElementById("feedbackDescription").style.background="orange";
            }else if (description === '__MSG_description__') {
                conclusionDescription = "Description Not Provided by Author BUT";
                document.getElementById("feedbackDescription").style.background="orange";
            }else if (description === '') {
                conclusionDescription = "Description Not Provided by Author";
                document.getElementById("feedbackDescription").style.background="red";
            } else {
                conclusionDescription = "Description is Valid";
                document.getElementById("feedbackDescription").style.background="lightgreen";
            }
            document.getElementById("feedbackDescription").value = conclusionDescription;

            //------Feedback Author---------
            var author = "<?php echo $author ?>";
            var conclusionAuthor;
            if (author === "") {
                conclusionAuthor = "Author didnt provide their name";
                document.getElementById("feedbackAuthor").style.background="orange";
            } else {
                conclusionAuthor = "Valid Author Name";
                document.getElementById("feedbackAuthor").style.background="lightgreen";
            }
            document.getElementById("feedbackAuthor").value = conclusionAuthor;

            //------Feedback Version Name---------
            var versionName = "<?php echo $versionName ?>";
            var conclusionVersionName;
            if (versionName === "") {
                conclusionVersionName = "Invalid Version Name";
                document.getElementById("feedbackversionName").style.background="red";
            }  else {
                conclusionVersionName = "Valid Version Name";
                document.getElementById("feedbackversionName").style.background="lightgreen";
            }
            document.getElementById("feedbackversionName").value = conclusionVersionName;

            //------Feedback MCV---------
            var mCV = parseInt("<?php echo $mCV ?>");
            var conclusionmCV;
            if (mCV === null) {
                conclusionmCV = "Invalid Minimum Chrome version";
                document.getElementById("feedbackmCV").style.background="orange";
            } else if (mCV >= 50) {
                conclusionmCV = "Only Chrome 50 and newer supported, GOOD";
                document.getElementById("feedbackmCV").style.background="lightgreen";
            } else if (mCV <= 50) {
                conclusionmCV = "Support older versions of chrome, BAD";
                document.getElementById("feedbackmCV").style.background="red";
            } else {
                conclusionmCV = "Invalid Chrome Version";
                document.getElementById("feedbackmCV").style.background="orange";
            }
            document.getElementById("feedbackmCV").value = conclusionmCV;

            //------Feedback Short Name---------
            var shortName = "<?php echo $shortName ?>";
            var conclusionshortName;
            if (shortName === "") {
                conclusionshortName = "Invalid Short Name";
                document.getElementById("feedbackshortName").style.background="red";
            }  else {
                conclusionshortName = "Valid Short Name";
                document.getElementById("feedbackshortName").style.background="lightgreen";
            }
            document.getElementById("feedbackshortName").value = conclusionshortName;

            //------Feedback Key---------
            var key = "<?php echo $key ?>";
            var conclusionKey;
            if (key === "") {
                conclusionKey = "Invalid Key";
                document.getElementById("feedbackKey").style.background="red";
            }  else {
                conclusionKey = "Valid Key";
                document.getElementById("feedbackKey").style.background="lightgreen";
            }
            document.getElementById("feedbackKey").value = conclusionKey;

            //------Feedback homePage---------
            var homepage = "<?php echo $homepageUrl ?>";
            var conclusionHomepage;
            if (homepage ==="") {
                conclusionHomepage = "This extension doesnt provide a HomePage";
                document.getElementById("feedbackHomepage").style.background="lightgreen";
            } else if (homepage.includes("https")){
                conclusionHomepage = "This extention provides a valid and secure homepage";
                document.getElementById("feedbackHomepage").style.background="lightgreen";

            } else {
                conclusionHomepage = "This extention provides a unsafe homepage";
                document.getElementById("feedbackHomepage").style.background="red";
            }
            document.getElementById("feedbackHomepage").value = conclusionHomepage;
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
                <a class="nav-link" href="analyzeIndividual2.php">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analyzeIndividual3.php">Behaviour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="analyzeIndividual4.php">Misc</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Another Extension" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<h1 class="content">General information from <?php echo $name ?> </h1>


<div class="content">
    File Name: <?php echo $nameUser ?>
    <br>
    Name: <?php echo $name ?>
    <br>
    <input type="text" name="feedbackName" id="feedbackName" readonly>
    <p id='info' style='display: none'>DESCRIPTION</p>
    <button id='info' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Manifest Version: <?php echo $manifestVersion ?>
    <br>
    <input type="text" name="feedbackManifest" id="feedbackManifest" readonly>
    <p id='info2' style='display: none'>DESCRIPTION</p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Version: <?php echo $version ?>
    <br>
    <input type="text" name="feedbackVersion" id="feedbackVersion" readonly>
    <p id='info3' style='display: none'>DESCRIPTION</p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Description: <?php echo $description ?>
    <br>
    <input type="text" name="feedbackDescription" id="feedbackDescription" readonly>
    <p id='info4' style='display: none'>DESCRIPTION</p>
    <button id='info4' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Author: <?php echo $author ?>
    <br>
    <input type="text" name="feedbackAuthor" id="feedbackAuthor" readonly>
    <p id='info5' style='display: none'>DESCRIPTION</p>
    <button id='info5' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Version Name: <?php echo $versionName ?>
    <br>
    <input type="text" name="feedbackversionName" id="feedbackversionName" readonly>
    <p id='info6' style='display: none'>DESCRIPTION</p>
    <button id='info6' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Minimum Chrome Version: <?php echo $mCV ?>
    <br>
    <input type="text" name="feedbackmCV" id="feedbackmCV" readonly>
    <p id='info7' style='display: none'>DESCRIPTION</p>
    <button id='info7' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Short Name: <?php echo $shortName ?>
    <br>
    <input type="text" name="feedbackshortName" id="feedbackshortName" readonly>
    <p id='info8' style='display: none'>DESCRIPTION</p>
    <button id='info8' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Key Number: <?php echo $key ?>
    <br>
    <input type="text" name="feedbackKey" id="feedbackKey" readonly>
    <p id='info9' style='display: none'>DESCRIPTION</p>
    <button id='info9' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    HomePage: <?php echo $homepageUrl ?>
    <br>
    <input type="text" name="feedbackHomepage" id="feedbackHomepage" readonly>
    <p id='info9' style='display: none'>DESCRIPTION</p>
    <button id='info9' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>



</div>












</body>
</html>

