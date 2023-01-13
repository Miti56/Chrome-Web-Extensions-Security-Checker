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
        $action = $row['action'];
        $automation = $row['automation'];
        $backgroundScripts = $row['backgroundScripts'];
        $backgroundPersistent = $row['backgroundPersistent'];
        $chromeUON= $row['chromeUrlOverridesNewTab'];
        $chromeUOB = $row['chromeUrlOverridesBooks'];
        $chromeUOH = $row['chromeUrlOverridesHistory'];
        $eventRulesEvent = $row['eventRulesEvent'];
        $eventRulesActionType = $row['eventRulesActionsType'];
        $eventRulesConditionType = $row['eventRulesConditionsType'];
        $eventRulesConditionCss = $row['eventRulesConditionsCss'];
        $offlineEnabled = $row['offlineEnabled'];
        $webAR= $row['WebAccessibleResources'];

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
            fillValues3();
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

        function fillValues3() {

            //------Feedback Action---------
            var action = "<?php echo $action ?>";
            var conclusionAction;
            if (action ==="") {
                conclusionAction = "No actions performed";
                document.getElementById("feedbackAction").style.background="lightgreen";
            } else {
                conclusionAction = "Extension can perform the following actions: " + action;
                document.getElementById("feedbackAction").style.background="orange";
            }
            document.getElementById("feedbackAction").value = conclusionAction;

            //------Feedback automation---------
            var automation = "<?php echo $automation ?>";
            var conclusionAutomation;
            if (automation ==="") {
                conclusionAutomation = "No automations performed";
                document.getElementById("feedbackAutomation").style.background="lightgreen";
            } else {
                conclusionAutomation = "Extension can perform the following actions: " + automation;
                document.getElementById("feedbackAutomation").style.background="orange";
            }
            document.getElementById("feedbackAutomation").value = conclusionAutomation;

            //------Feedback Background Scripts---------
            var bs = "<?php echo $backgroundScripts ?>";
            var conclusionBS;
            if (bs ==="//////") {
                conclusionBS = "Developer didnt supply information";
                document.getElementById("feedbackBS").style.background="orange";
            } else if (bs.includes("background")){
                conclusionBS = "Extension has valid Background Scripts";
                document.getElementById("feedbackBS").style.background="lightgreen";
            }else {
                conclusionBS = "Background script not recognize, press + to see the dangers";
                document.getElementById("feedbackBS").style.background="orange";
            }
            document.getElementById("feedbackBS").value = conclusionBS;

            //------Feedback Background Script Persisten---------
            var persistent = "<?php echo $backgroundPersistent ?>";
            var conclusionPersistent;
            if (persistent ==="True") {
                conclusionPersistent = "Put meaning persistent";
                document.getElementById("feedbackPersistent").style.background="orange";
            } else {
                conclusionPersistent = "Non persistent" ;
                document.getElementById("feedbackPersistent").style.background="lightgreen";
            }
            document.getElementById("feedbackPersistent").value = conclusionPersistent;


            //------Feedback Chrome URL Overrides Bookmarks---------
            var books = "<?php echo $chromeUOB ?>";
            var conclusionBooks;
            if (books ==="") {
                conclusionBooks = "No overrides done by this extension";
                document.getElementById("feedbackBooks").style.background="lightgreen";
            } else {
                conclusionBooks = "This extension overrides the bookmark page using: " + books ;
                document.getElementById("feedbackBooks").style.background="red";
            }
            document.getElementById("feedbackBooks").value = conclusionBooks;

            //------Feedback Chrome URL Overrides New Tab---------
            var newTab = "<?php echo $chromeUON ?>";
            var conclusionNewTab;
            if (newTab ==="") {
                conclusionNewTab = "No overrides done by this extension";
                document.getElementById("feedbackNewTab").style.background="lightgreen";
            } else {
                conclusionNewTab = "This extension overrides the NewTab page using: " + newTab ;
                document.getElementById("feedbackNewTab").style.background="red";
            }
            document.getElementById("feedbackNewTab").value = conclusionNewTab;

            //------Feedback Chrome URL Overrides History---------
            var history = "<?php echo $chromeUOH ?>";
            var conclusionHistory;
            if (history ==="") {
                conclusionHistory = "No overrides done by this extension";
                document.getElementById("feedbackHistory").style.background="lightgreen";
            } else {
                conclusionHistory = "This extension overrides the NewTab page using: " + history ;
                document.getElementById("feedbackHistory").style.background="red";
            }
            document.getElementById("feedbackHistory").value = conclusionHistory;

            //------Feedback Event Rules Events---------
            var eRE = "<?php echo $eventRulesEvent ?>";
            var conclusioneRE;
            if (eRE ==="") {
                conclusioneRE = "No event rules reported by the extension";
                document.getElementById("feedbackeRE").style.background="lightgreen";
            } else {
                conclusioneRE = "This extension runs when the following happens " + eRE ;
                document.getElementById("feedbackeRE").style.background="orange";
            }
            document.getElementById("feedbackeRE").value = conclusioneRE;

            //------Feedback Event Rules Actions Types---------
            var eRAT = "<?php echo $eventRulesActionType ?>";
            var conclusioneRAT;
            if (eRAT ==="") {
                conclusioneRAT = "No event actions reported by the extension";
                document.getElementById("feedbackeRAT").style.background="lightgreen";
            } else {
                conclusioneRAT = "This extension perform the following: " + eRAT + " action when the following happens " + eRE ;
                document.getElementById("feedbackeRAT").style.background="orange";
            }
            document.getElementById("feedbackeRAT").value = conclusioneRAT;

            //------Feedback Event Rules Condition Types---------
            var eRCT = "<?php echo $eventRulesConditionType ?>";
            var conclusioneRCT;
            if (eRCT ==="") {
                conclusioneRCT = "No event conditions reported by the extension";
                document.getElementById("feedbackeRCT").style.background="lightgreen";
            } else {
                conclusioneRCT = "This extension perform the following: " + eRAT + " action when the following happens " + eRCT ;
                document.getElementById("feedbackeRCT").style.background="orange";
            }
            document.getElementById("feedbackeRCT").value = conclusioneRCT;

            //------Feedback Event Rules Condition Css---------
            var eRCC = "<?php echo $eventRulesConditionCss ?>";
            var conclusioneRCC;
            if (eRCC ==="") {
                conclusioneRCC = "No CSS is affected by the rules";
                document.getElementById("feedbackeRCC").style.background="lightgreen";
            } else {
                conclusioneRCC = "This extension perform modifies the " + eRCC + " aspect of the CSS";
                document.getElementById("feedbackeRCC").style.background="orange";
            }
            document.getElementById("feedbackeRCC").value = conclusioneRCC;

            //------Feedback Offline Enabled---------
            var offline = "<?php echo $offlineEnabled ?>";
            var conclusionOffline;
            if (offline ==="True") {
                conclusionOffline = "This extension is able to work without internet conection";
                document.getElementById("feedbackOffline").style.background="lightgreen";
            } else {
                conclusionOffline = "This extension is unable to work without internet connection";
                document.getElementById("feedbackOffline").style.background="orange";
            }
            document.getElementById("feedbackOffline").value = conclusionOffline;

            //------Feedback Web Accesible Resources---------
            var webAR = "<?php echo $webAR ?>";
            var conclusionWebAR;
            if (webAR ==="//////") {
                conclusionWebAR = "Developer doesnt provide information about external resources";
                document.getElementById("feedbackwebAR").style.background="orange";
            } else if (webAR.includes("js")){
                conclusionWebAR = "Extension doesnt provide safe resources";
                document.getElementById("feedbackwebAR").style.background="orange";
            }else {
                conclusionWebAR = "Extension provides valid resources";
                document.getElementById("feedbackwebAR").style.background="lightgreen";
            }
            document.getElementById("feedbackwebAR").value = conclusionWebAR;


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
            <li class="nav-item">
                <a class="nav-link" href="analyzeIndividual2.php">Security</a>
            </li>
            <li class="nav-item active">
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
<h1 class="content">Behaviour Information From <?php echo $name ?> </h1>
<div class="content">
    File Name: <?php echo $nameUser ?>
    <br>

    Actions: <?php echo $action?>
    <br>
    <input type="text" name="feedbackAction" id="feedbackAction" readonly>
    <p id='info' style='display: none'>DESCRIPTION</p>
    <button id='info' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Automations: <?php echo $automation?>
    <br>
    <input type="text" name="feedbackAutomation" id="feedbackAutomation" readonly>
    <p id='info1' style='display: none'>DESCRIPTION</p>
    <button id='info1' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Background Scripts: <?php echo $backgroundScripts?>
    <br>
    <input type="text" name="feedbackBS" id="feedbackBS" readonly>
    <p id='info2' style='display: none'>DESCRIPTION</p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Background Scripts Persistent: <?php echo $backgroundPersistent?>
    <br>
    <input type="text" name="feedbackPersistent" id="feedbackPersistent" readonly>
    <p id='info3' style='display: none'>DESCRIPTION</p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Chrome URL Overrides Bookmarks: <?php echo $chromeUOB?>
    <br>
    <input type="text" name="feedbackBooks" id="feedbackBooks" readonly>
    <p id='info4' style='display: none'>DESCRIPTION</p>
    <button id='info4' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Chrome URL Overrides Net Tab : <?php echo $chromeUON?>
    <br>
    <input type="text" name="feedbackNewTab" id="feedbackNewTab" readonly>
    <p id='info5' style='display: none'>DESCRIPTION</p>
    <button id='info5' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Chrome URL Overrides History: <?php echo $chromeUOH?>
    <br>
    <input type="text" name="feedbackHistory" id="feedbackHistory" readonly>
    <p id='info6' style='display: none'>DESCRIPTION</p>
    <button id='info6' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Event Rules Event: <?php echo $eventRulesEvent?>
    <br>
    <input type="text" name="feedbackeRE" id="feedbackeRE" readonly>
    <p id='info7' style='display: none'>DESCRIPTION</p>
    <button id='info7' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Event Rules Action Type: <?php echo $eventRulesActionType?>
    <br>
    <input type="text" name="feedbackeRAT" id="feedbackeRAT" readonly>
    <p id='info8' style='display: none'>DESCRIPTION</p>
    <button id='info8' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Event Rules Condition Type: <?php echo $eventRulesConditionType?>
    <br>
    <input type="text" name="feedbackeRCT" id="feedbackeRCT" readonly>
    <p id='info9' style='display: none'>DESCRIPTION</p>
    <button id='info9' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Event Rules Conditions Css: <?php echo $eventRulesConditionCss?>
    <br>
    <input type="text" name="feedbackeRCC" id="feedbackeRCC" readonly>
    <p id='info10' style='display: none'>DESCRIPTION</p>
    <button id='info10' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Offline Enabled: <?php echo $offlineEnabled?>
    <br>
    <input type="text" name="feedbackOffline" id="feedbackOffline" readonly>
    <p id='info11' style='display: none'>DESCRIPTION</p>
    <button id='info11' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Web Accesible Resouces: <?php echo $webAR?>
    <br>
    <input type="text" name="feedbackwebAR" id="feedbackwebAR" readonly>
    <p id='info12' style='display: none'>DESCRIPTION</p>
    <button id='info12' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>


</div>
</body>
</html>