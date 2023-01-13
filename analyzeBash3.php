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

            //------Feedback BACKGROUND SCRIPTS---------
            var conclusionBS;
            if (parseInt(<?php echo json_encode($nErrorsBS); ?>) > 0) {
                conclusionBS = " <?php echo json_encode($nErrorsBS); ?> extensions don't provide Background Scripts Information";
                document.getElementById("feedbackBS").style.background="red";
            } else {
                conclusionBS = " <?php echo json_encode($nGoodBS); ?> extensions provide good Background Scripts information";
                document.getElementById("feedbackBS").style.background="lightgreen";
            }
            document.getElementById("feedbackBS").value = conclusionBS;

            //------Feedback CHROME URL OVERRIDE NEW TAB---------
            var conclusionCUONT;
            if (parseInt(<?php echo json_encode($nErrorsCUONT); ?>) > 0) {
                conclusionCUONT = " <?php echo json_encode($nErrorsCUONT); ?> extensions don't provide New Tab Override Information";
                document.getElementById("feedbackCUONT").style.background="red";
            } else {
                conclusionCUONT = " <?php echo json_encode($nGoodCUONT); ?> extensions provide valid New Tab Override information";
                document.getElementById("feedbackCUONT").style.background="lightgreen";
            }
            document.getElementById("feedbackCUONT").value = conclusionCUONT;

            //------Feedback Search Provider---------
            var conclusionSP;
            if (parseInt(<?php echo json_encode($nErrorsCUONT); ?>) > 0) {
                conclusionSP = " <?php echo json_encode($nErrorsCUONT); ?> extensions don't provide Search Provider Information";
                document.getElementById("feedbackSP").style.background="red";
            } else {
                conclusionSP = " <?php echo json_encode($nGoodCUONT); ?> extensions provide valid Search Provider information";
                document.getElementById("feedbackSP").style.background="lightgreen";
            }
            document.getElementById("feedbackSP").value = conclusionSP;

            //------Feedback OFFLINE ENABLED---------
            var conclusionOffline;
            if (parseInt(<?php echo json_encode($nErrorsCUONT); ?>) > 0) {
                conclusionOffline = " <?php echo json_encode($nErrorsCUONT); ?> extensions don't provide Offline Information";
                document.getElementById("feedbackOffline").style.background="red";
            } else {
                conclusionOffline = " <?php echo json_encode($nGoodCUONT); ?> extensions provide valid Offline information";
                document.getElementById("feedbackOffline").style.background="lightgreen";
            }
            document.getElementById("feedbackOffline").value = conclusionOffline;

            //------Feedback WEB ACCESSIBLE RESOURCES---------
            var conclusionWAR;
            if (parseInt(<?php echo json_encode($nErrorsWAR); ?>) > 0) {
                conclusionWAR = " <?php echo json_encode($nErrorsWAR); ?> extensions don't provide information about external resource access";
                document.getElementById("feedbackWAR").style.background="red";
            } else {
                conclusionWAR = " <?php echo json_encode($nGoodWAR); ?> extensions provide valid external resource access";
                document.getElementById("feedbackWAR").style.background="lightgreen";
            }
            document.getElementById("feedbackWAR").value = conclusionWAR;

            //------Feedback TTS---------
            var conclusionTTS;
            if (parseInt(<?php echo json_encode($nErrorsWAR); ?>) > 0) {
                conclusionTTS = " <?php echo json_encode($nErrorsWAR); ?> extensions don't provide support for TTS";
                document.getElementById("feedbackTTS").style.background="red";
            } else {
                conclusionTTS = " <?php echo json_encode($nGoodWAR); ?> extensions that provide support for TTS";
                document.getElementById("feedbackTTS").style.background="lightgreen";
            }
            document.getElementById("feedbackTTS").value = conclusionTTS;
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
            <li class="nav-item ">
                <a class="nav-link" href="analyzeBash2.php">Security</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="analyzeBash3.php">Behaviour</a>
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

    Background Scripts:
    <br>
    <input type="text" name="feedbackBS" id="feedbackBS" readonly>
    <p id='info1' style='display: none'>
        <?php echo json_encode($nErrorsBS); ?> EXTENSIONS WITHOUT BS INFORMATION: <?php
        echo "<br>";
        echo json_encode($BSErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageBS); ?> EXTENSIONS WITH BS THAT CAN RUN REMOTELY: <?php
        echo "<br>";
        echo json_encode($BSAverage);
        echo "<br>";
        ?> Persistent background: <?php
        echo json_encode($nAverageBP);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageBS2); ?> EXTENSIONS WITH BS THAT HAVE VALID INFORMATION: <?php
        echo "<br>";
        echo json_encode($BSAverage2);
        echo "<br>";
        ?> Persistent background: <?php
        echo json_encode($nGoodBP);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodBS); ?> EXTENSIONS THAT HAVE BS but no JS file is detected: <?php
        echo "<br>";
        echo json_encode($BSGood);
        echo "<br>";
        ?> Persistent background: <?php
        echo json_encode($nBadBP);
        ?>
    </p>
    <button id='info1' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Override New Tab:
    <br>
    <input type="text" name="feedbackCUONT" id="feedbackCUONT" readonly>
    <p id='info2' style='display: none'>
        <?php echo json_encode($nErrorsCUONT); ?> EXTENSIONS WITHOUT NEW TAB OVERRIDE INFORMATION: <?php
        echo "<br>";
        echo json_encode($CUONTErrors);
        ?>

        <br>
        <br>
        <?php echo json_encode($nGoodCUONT); ?> EXTENSIONS WITH VALID NEW TAB OVERRIDE INFORMATION: <?php
        echo "<br>";
        echo json_encode($CUONTGood);
        echo "<br>";
        ?> HTML Files Used: <?php
        echo json_encode($namesCUONT);
        ?>
    </p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Search Provider:
    <br>
    <input type="text" name="feedbackSP" id="feedbackSP" readonly>
    <p id='info3' style='display: none'>
        <?php echo json_encode($nErrorsSP); ?> EXTENSIONS WITHOUT SEARCH PROVIDER OVERRIDE INFORMATION: <?php
        echo "<br>";
        echo json_encode($SPErrors);
        ?>

        <br>
        <br>
        <?php echo json_encode($nGoodSP); ?> EXTENSIONS WITH VALID SEARCH PROVIDER OVERRIDE INFORMATION: <?php
        echo "<br>";
        echo json_encode($SPGood);
        echo "<br>";
        ?> Search Providers Used: <?php
        echo json_encode($namesSP);
        ?>
    </p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Offline Enabled:
    <br>
    <input type="text" name="feedbackOffline" id="feedbackOffline" readonly>
    <p id='info4' style='display: none'>
        <?php echo json_encode($nErrorsOFFLINE); ?> EXTENSIONS THAT CAN WORK OFFLINE: <?php
        echo "<br>";
        echo json_encode($OFFLINEErrors);
        ?>

        <br>
        <br>
        <?php echo json_encode($nGoodOFFLINE); ?> EXTENSIONS THAT CAN'T WORK OFFLINE: <?php
        echo "<br>";
        echo json_encode($OFFLINEGood);
        echo "<br>";

        ?>
    </p>
    <button id='info4' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Web Accesible Resources:
    <br>
    <input type="text" name="feedbackWAR" id="feedbackWAR" readonly>
    <p id='info5' style='display: none'>
        <?php echo json_encode($nErrorsWAR); ?> EXTENSIONS WITHOUT WEB ACCESSIBLE RESOURCES: <?php
        echo "<br>";
        echo json_encode($WARErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageWAR); ?> EXTENSIONS WITH WEB ACCESSIBLE RESOURCES THAT CONTAIN JS (DANGEROUS): <?php
        echo "<br>";
        echo json_encode($WARAverage);
        echo "<br>";
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodWAR); ?> EXTENSIONS WITH WEB ACCESSIBLE RESOURCES THAT ARE VALID: <?php
        echo "<br>";
        echo json_encode($WARGood);
        echo "<br>";

        ?>
    </p>
    <button id='info5' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    TTS Enabled:
    <br>
    <input type="text" name="feedbackTTS" id="feedbackTTS" readonly>
    <p id='info6' style='display: none'>
        <?php echo json_encode($nErrorsTTS); ?> EXTENSIONS THAT DON'T SUPPORT TEXT TO SPEECH: <?php
        echo "<br>";
        echo json_encode($TTSErrors);
        ?>

        <br>
        <br>
        <?php echo json_encode($nGoodTTS); ?> EXTENSIONS THAT SUPPORT TExT TO SPEECH: <?php
        echo "<br>";
        echo json_encode($TTSGood);
        echo "<br>";

        ?>
    </p>
    <button id='info6' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>





</div>













</body>
</html>
