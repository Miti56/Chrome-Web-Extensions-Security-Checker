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
        $id = $row['id'];
        $nameUser = $row['nameUser'];
        $name = $row['name'];
        $omnibox = $row['omniboxKeyword'];
        $storage = $row['storageManagedSchema'];
        $ttsSupport = $row['tts_engine'];

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
            width:50%;
            background: lightgray;
        }
        .content {
            max-width: 1000px;
            margin: auto;


    </style>

    <script>
        window.onload = function(){
            fillValues4();
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

        function fillValues4() {

            //------Feedback Omnibox---------
            var omnibox = "<?php echo $omnibox ?>";
            var conclusionOmnibox;
            if (omnibox ==="") {
                conclusionOmnibox = "Developer didnt provide this function";
                document.getElementById("feedbackOmnibox").style.background="lightgreen";
            } else {
                conclusionOmnibox = "If: " + omnibox + ": is typed on the search bar: extension provides extra functions";
                document.getElementById("feedbackOmnibox").style.background="lightgreen";
            }
            document.getElementById("feedbackOmnibox").value = conclusionOmnibox;

            //------Feedback Omnibox---------
            var tts = "<?php echo $ttsSupport?>";
            var conclusionTTS;
            if (tts ==="True") {
                conclusionTTS = "Developer Provides TTS support";
                document.getElementById("feedbackTTS").style.background="lightgreen";
            } else {
                conclusionTTS = "No TTS support is given by this extension";
                document.getElementById("feedbackTTS").style.background="orange";
            }
            document.getElementById("feedbackTTS").value = conclusionTTS;

            //------Feedback Storage---------
            var storage = "<?php echo $ttsSupport?>";
            var conclusionStorage;
            if (storage ==="") {
                conclusionStorage = "Developer didnt provide this information";
                document.getElementById("feedbackStorage").style.background="orange";
            } else {
                conclusionStorage = "Valid Storage Location";
                document.getElementById("feedbackStorage").style.background="lightgreen";
            }
            document.getElementById("feedbackStorage").value = conclusionStorage;

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
            <li class="nav-item">
                <a class="nav-link" href="analyzeIndividual3.php">Behaviour</a>
            </li>
            <li class="nav-item active">
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

    Omnibox: <?php echo $omnibox?>
    <br>
    <input type="text" name="feedbackOmnibox" id="feedbackOmnibox" readonly>
    <p id='info' style='display: none'>DESCRIPTION</p>
    <button id='info' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    TTS Support: <?php echo $ttsSupport?>
    <br>
    <input type="text" name="feedbackTTS" id="feedbackTTS" readonly>
    <p id='info2' style='display: none'>DESCRIPTION</p>
    <button id='info2' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>

    Storage: <?php echo $storage?>
    <br>
    <input type="text" name="feedbackStorage" id="feedbackStorage" readonly>
    <p id='info3' style='display: none'>DESCRIPTION</p>
    <button id='info3' type='button' onclick="reply_click(this.id);toggleText()">+</button>
    <br>


</div>

</body>
</html>