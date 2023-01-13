<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$fileName = $_SESSION['fileName'];


$sql = "select * from `extensionsV3` where nameUser= '$fileName'";
$result = mysqli_query($con, $sql);
if (!$result) exit("The query did not succeded");
else {
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $nameUser = $row['nameUser'];
        $cSM = $row['contentScriptsMatches'];
        $cSCSS = $row['contentScriptsCSS'];
        $cSJS = $row['contentScriptsJS'];
        $cSRun = $row['contentScriptsRUN'];
        $cSFrames = $row['contentScriptsFRAMES'];
        $incognito = $row['incognito'];
        $optPermissions = $row['optionalPermissions'];
        $permissions = $row['permissions'];
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
            fillValues2();
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

        function fillValues2() {
            //------Feedback CSM---------
            var cSM = "<?php echo $cSM ?>";
            var cSMCropped = cSM.replace(/[^a-zA-Z0-9]/g, '');
            var cSMCropped2 = cSMCropped.substr(4, 13);
            var conclusioncSM;
            if (cSM ==="") {
                conclusioncSM = "The Extension doesn't run inside specific websites";
                document.getElementById("feedbackcSM").style.background="lightgreen";
            } else if (cSM === "all_urls") {
                conclusioncSM = "Extension can run in all the website";
                document.getElementById("feedbackcSM").style.background="red";
            } else {
                conclusioncSM = "Extension runs inside: " + cSMCropped2;
                document.getElementById("feedbackcSM").style.background="orange";
            }
            document.getElementById("feedbackcSM").value = conclusioncSM;

            //------Feedback CSCSS---------
            var cSCSS = "<?php echo $cSCSS ?>";
            var conclusioncSCSS;
            if (cSCSS ==="") {
                if (cSM === ""){
                    conclusioncSCSS = "As expected, the extension doesnt use any CSS";
                    document.getElementById("feedbackcSCSS").style.background="lightgreen";
                }
                else {
                    conclusioncSCSS = "Extension reports changing website but doesnt report how";
                    document.getElementById("feedbackcSCSS").style.background="red";
                }
            } else {
                conclusioncSCSS = "Extension uses : " + cSCSS +" to modify the appearance ";
                document.getElementById("feedbackcSCSS").style.background="orange";
            }
            document.getElementById("feedbackcSCSS").value = conclusioncSCSS;

            //------Feedback CSJS---------
            var cSJS = "<?php echo $cSJS ?>";
            var conclusioncSJS;
            if (cSJS ==="") {
                if (cSM === ""){
                    conclusiconclusioncSJSoncSCSS = "As expected, the extension doesnt use any JS";
                    document.getElementById("feedbackcSJS").style.background="lightgreen";
                }
                else {
                    conclusioncSJS = "Extension reports having activity in website but doesnt report how";
                    document.getElementById("feedbackcSJS").style.background="red";
                }
            } else {
                conclusioncSJS = "Extension uses : " + cSCSS +" to modify the behaviour ";
                document.getElementById("feedbackcSJS").style.background="orange";
            }
            document.getElementById("feedbackcSJS").value = conclusioncSJS;

            //------Feedback CSRUN---------
            var cSRun = "<?php echo $cSRun ?>";
            var conclusioncSRun;
            if (cSRun ==="") {
                if (cSM === ""){
                    conclusioncSRun = "As expected, the extension doesnt have to specify this data";
                    document.getElementById("feedbackcSRun").style.background="lightgreen";
                }
                else {
                    conclusioncSRun = "Extension reports having activity in website but doesnt report when ";
                    document.getElementById("feedbackcSRun").style.background="red";
                }
            } else if (cSRun ==="document_end"){
                conclusioncSRun = "Extension starts at document_end ";
                document.getElementById("feedbackcSRun").style.background="lightgreen";

            } else if (cSRun ==="document_start"){
                conclusioncSRun = "Extension starts at document_start ";
                document.getElementById("feedbackcSRun").style.background="lightgreen";

            } else if (cSRun ==="document_idle"){
                conclusioncSRun = "Extension starts at document_idle ";
                document.getElementById("feedbackcSRun").style.background="lightgreen";

            } else {
                conclusioncSRun = "Invalid Data ";
                document.getElementById("feedbackcSRun").style.background="red";
            }
            document.getElementById("feedbackcSRun").value = conclusioncSRun;

            //------Feedback CSFrames---------
            var cSFrames = "<?php echo $cSFrames ?>";
            var conclusioncSFrames;
            if (cSFrames ==="True") {
                conclusioncSFrames = "Look Meaning of True";
                document.getElementById("feedbackcSFrames").style.background="lightgreen";
            } else if (cSFrames ==="False"){
                conclusioncSFrames = "Look Meaning of False ";
                document.getElementById("feedbackcSFrames").style.background="lightgreen";

            } else {
                conclusioncSFrames = "Invalid Data ";
                document.getElementById("feedbackcSFrames").style.background="red";
            }
            document.getElementById("feedbackcSFrames").value = conclusioncSFrames;

            //------Feedback Incognito---------
            var incognito = "<?php echo $incognito ?>";
            var conclusionIncognito;
            if (incognito ==="split") {
                conclusionIncognito = "Look Meaning of Split";
                document.getElementById("feedbackIncognito").style.background="red";
            } else if (incognito ==="not_allowed"){
                conclusionIncognito = "Extension can't access incognito ";
                document.getElementById("feedbackIncognito").style.background="lightgreen";

            } else if (incognito ==="spanning"){
                conclusionIncognito = "Look Meaning of Spanning ";
                document.getElementById("feedbackIncognito").style.background="orange";
            }else {
                conclusionIncognito = "Developer hasn't specified this information ";
                document.getElementById("feedbackIncognito").style.background="red";
            }
            document.getElementById("feedbackIncognito").value = conclusionIncognito;




            //------Feedback Optional Permission---------

            var optPermissions = "<?php echo $optPermissions ?>";
            var conclusionoptPermission;
            if (optPermissions.includes("tabs")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more"  ;
                document.getElementById("feedbackoptPermissions").style.background="red";

            } else if (optPermissions.includes("cookies")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("topSites")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("management")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("bookmarks")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("storage")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("geolocation")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("activeTab")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("downloads")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if (optPermissions.includes("history")){
                conclusionoptPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackoptPermissions").style.background="red";

            }else if(optPermissions === "//////"){
                conclusionoptPermission = "Developer is not using this type of permissions";
                document.getElementById("feedbackoptPermissions").style.background="lightgreen";

            } else {
                conclusionoptPermission = "Invalid Data ";
                document.getElementById("feedbackoptPermissions").style.background="red";
            }
            document.getElementById("feedbackoptPermissions").value = conclusionoptPermission;

            //------Feedback Permission---------

            var permissions = "<?php echo $permissions ?>";
            var conclusionPermission;
            if (optPermissions.includes("tabs")){
                conclusionPermission = "Dangerous permission detected. Press + to know more"  ;
                document.getElementById("feedbackPermissions").style.background="red";

            } else if (optPermissions.includes("cookies")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("unlimitedStorage")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("identity")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("videoCapture")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("activeTabs")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("geolocation")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("activeTab")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("proxy")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("<"+"allurls"+">")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("bookmarks")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("notifications")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if (optPermissions.includes("history")){
                conclusionPermission = "Dangerous permission detected. Press + to know more";
                document.getElementById("feedbackPermissions").style.background="red";

            }else if(optPermissions === "//////"){
                conclusionPermission = "Developer is not using this type of permissions";
                document.getElementById("feedbackPermissions").style.background="lightgreen";

            } else {
                conclusionPermission = "Invalid Data ";
                document.getElementById("feedbackPermissions").style.background="red";
            }
            document.getElementById("feedbackPermissions").value = conclusionPermission;





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
            <li class="nav-item">
                <a class="nav-link" href="analyzeIndividual.php">General <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
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
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<h1 class="content">Security Information From <?php echo $name ?> </h1>

<div class="content">
    File Name: <?php echo $nameUser ?>
    <br>

    Content Scripts Matches: <?php echo $cSM ?>
    <br>
    <input type="text" name="feedbackcSM" id="feedbackcSM" readonly>
    <p id='info' style='display: none'>DESCRIPTION</p>
    <button id='info' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Content Scripts CSS: <?php echo $cSCSS ?>
    <br>
    <input type="text" name="feedbackcSCSS" id="feedbackcSCSS" readonly>
    <p id='info2' style='display: none'>DESCRIPTION</p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Content Scripts JS: <?php echo $cSJS?>
    <br>
    <input type="text" name="feedbackcSJS" id="feedbackcSJS" readonly>
    <p id='info3' style='display: none'>DESCRIPTION</p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Content Scripts Run: <?php echo $cSRun?>
    <br>
    <input type="text" name="feedbackcSRun" id="feedbackcSRun" readonly>
    <p id='info4' style='display: none'>DESCRIPTION</p>
    <button id='info4' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Content Scripts Frames: <?php echo $cSFrames?>
    <br>
    <input type="text" name="feedbackcSFrames" id="feedbackcSFrames" readonly>
    <p id='info5' style='display: none'>DESCRIPTION</p>
    <button id='info5' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Incognito: <?php echo $incognito?>
    <br>
    <input type="text" name="feedbackIncognito" id="feedbackIncognito" readonly>
    <p id='info6' style='display: none'>DESCRIPTION</p>
    <button id='info6' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Optional Permission: <?php echo $optPermissions?>
    <br>
    <input type="text" name="feedbackoptPermissions" id="feedbackoptPermissions" readonly>
    <p id='info7' style='display: none'>DESCRIPTION</p>
    <button id='info7' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Permission: <?php echo $permissions?>
    <br>
    <input type="text" name="feedbackPermissions" id="feedbackPermissions" readonly>
    <p id='info8' style='display: none'>DESCRIPTION</p>
    <button id='info8' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

</div>




</body>
</html>