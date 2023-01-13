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

            //------Feedback CONTENT SCRIPT MATCHES---------
            var conclusionCSM;
            if (parseInt(<?php echo json_encode($nErrorsCSM); ?>) >= 0) {
                conclusionCSM = " <?php echo json_encode($nErrorsCSM); ?> extensions have an invalid CSP";
                document.getElementById("feedbackCSM").style.background="red";
            } else {
                conclusionCSM = " <?php echo json_encode($nGoodCSM); ?> extensions have an valid CSP";
                document.getElementById("feedbackCSM").style.background="lightgreen";
            }
            document.getElementById("feedbackCSM").value = conclusionCSM;

            //------Feedback INCOGNITO---------
            var conclusionIncognito;
            if (parseInt(<?php echo json_encode($nGoodIncognito); ?>) > 0) {
                conclusionIncognito = " <?php echo json_encode($nGoodIncognito); ?> extensions can work while on Incognito";
                document.getElementById("feedbackIncognito").style.background="red";
            } else {
                conclusionIncognito = " <?php echo json_encode($nErrorsIncognito); ?> extensions dont provide Incognito information";
                document.getElementById("feedbackIncognito").style.background="orange";
            }
            document.getElementById("feedbackIncognito").value = conclusionIncognito;

            //------Feedback OPTIONAL PERMISSIONS---------
            var conclusionOP;
            if (parseInt(<?php echo json_encode($nErrorsOP); ?>) > 0) {
                conclusionOP = " <?php echo json_encode($nErrorsOP); ?> extensions don't provide Optional Permission Information";
                document.getElementById("feedbackOP").style.background="red";
            } else {
                conclusionOP = " <?php echo json_encode($nGoodOP); ?> extensions provide good permissions information";
                document.getElementById("feedbackOP").style.background="lightgreen";
            }
            document.getElementById("feedbackOP").value = conclusionOP;




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
            <li class="nav-item  active">
                <a class="nav-link" href="analyzeBash2.php">Security</a>
            </li>
            <li class="nav-item">
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

    Content Script Matches:
    <br>
    <input type="text" name="feedbackCSM" id="feedbackCSM" readonly>
    <p id='info9' style='display: none'>
        <?php echo json_encode($nErrorsCSM); ?> EXTENSIONS WITHOUT CSM INFO: <?php
        echo "<br>";
        echo json_encode($cSMErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageHomepage); ?> EXTENSIONS WITH CSM THAT CAN ACESS ALL WEBSITES: <?php
        echo "<br>";
        echo json_encode($homepageAverage);
        ?>
        <br>
        When is are the Script Runned: <?php echo json_encode($cSRUNUsed); ?>
        <br>
        Name of the CSS Used: <?php echo json_encode($cSCSSUsed); ?>
        <br>
        Name of the JS Used: <?php echo json_encode($cSJSUsed); ?>
        <br>
        <br>
        <?php echo json_encode($nGoodCSM); ?> EXTENSIONS WITH VALID CSM: <?php
        echo "<br>";
        echo json_encode($cSMGood);
        ?>
    </p>
    <button id='info9' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Incognito:
    <br>
    <input type="text" name="feedbackIncognito" id="feedbackIncognito" readonly>
    <p id='info10' style='display: none'>
        <?php echo json_encode($nErrorsIncognito); ?> EXTENSIONS WITHOUT INCOGNITO INFORMATION: <?php
        echo "<br>";
        echo json_encode($incognitoErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageIncognito); ?> EXTENSIONS WITH SPLIT INCOGNITO ACCESS: <?php
        echo "<br>";
        echo json_encode($incognitoAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageIncognito2); ?> EXTENSIONS WITH SPANNING INCOGNITO ACCESS: <?php
        echo "<br>";
        echo json_encode($incognitoAverage2);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodIncognito); ?> EXTENSIONS THAT DON'T ALLOW INCOGNITO ACCESS: <?php
        echo "<br>";
        echo json_encode($incognitoGood);
        ?>
    </p>
    <button id='info10' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Optional Permissions:
    <br>
    <input type="text" name="feedbackOP" id="feedbackOP" readonly>
    <p id='info11' style='display: none'>
        <?php echo json_encode($nErrorsOP); ?> EXTENSIONS WITHOUT OPTIONAL PERMISSIONS INFORMATION: <?php
        echo "<br>";
        echo json_encode($OPErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageOP); ?> EXTENSIONS WITH OP THAT CAN ACCESS PRIVATE INFORMATION: <?php
        echo "<br>";
        echo json_encode($OPAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageOP2); ?> EXTENSIONS WITH OP THAT CAN ACCESS ALL URLS (DANGEROUS): <?php
        echo "<br>";
        echo json_encode($OPAverage2);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodOP); ?> EXTENSIONS THAT HAVE SENSIBLE OPTIONAL PERMISSIONS: <?php
        echo "<br>";
        echo json_encode($OPGood);
        ?>
    </p>
    <button id='info11' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Permissions:
    <br>
    <input type="text" name="feedbackOP" id="feedbackOP" readonly>
    <p id='info12' style='display: none'>
        <?php echo json_encode($nErrorsOP); ?> EXTENSIONS WITHOUT OPTIONAL PERMISSIONS INFORMATION: <?php
        echo "<br>";
        echo json_encode($OPErrors);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageOP); ?> EXTENSIONS WITH OP THAT CAN ACCESS PRIVATE INFORMATION: <?php
        echo "<br>";
        echo json_encode($OPAverage);
        ?>
        <br>
        <br>
        <?php echo json_encode($nAverageOP2); ?> EXTENSIONS WITH OP THAT CAN ACCESS ALL URLS (DANGEROUS): <?php
        echo "<br>";
        echo json_encode($OPAverage2);
        ?>
        <br>
        <br>
        <?php echo json_encode($nGoodOP); ?> EXTENSIONS THAT HAVE SENSIBLE OPTIONAL PERMISSIONS: <?php
        echo "<br>";
        echo json_encode($OPGood);
        ?>
    </p>
    <button id='info12' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>






</div>













</body>
</html>
