<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>EXETER</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600&amp;subset=latin-ext" rel="stylesheet">

    <!-- CSS -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>

    <script>
        function ajsearch () {
            // (A) GET SEARCH TERM
            var data = new FormData();
            data.append("search", document.getElementById("search").value);
            data.append("ajax", 1);

            // (B) AJAX SEARCH REQUEST
            fetch("search.php", { method:"POST", body:data })
                .then(res => res.json()).then((results) => {
                var wrapper = document.getElementById("results");
                if (results.length > 0) {
                    wrapper.innerHTML = "";
                    for (let res of results) {
                        let line = document.createElement("div");
                        line.innerHTML = `${res["name"]} - ${res["email"]}`;
                        wrapper.appendChild(line);
                    }
                } else { wrapper.innerHTML = "No results found"; }
            });
            return false;
        }
    </script>

    <!-- CSS Search Bar -->
    <style>
        input[type=text] {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            transition: width 0.4s ease-in-out;
            color: blue;
        }
        input[type=text]:focus {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="site" id="page">


    <!-- Options headline effects: .rotate | .slide | .zoom | .push | .clip -->
    <section class="hero-section hero-section--image clearfix clip">
        <div class="hero-section__wrap">
            <div class="hero-section__option">
            </div>
            <!-- .hero-section__option -->

            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <div class="title-01 title-01--11 text-center">
                            <h2 class="title__heading">
                                <span>Always</span>
                                <strong class="hero-section__words">
                                    <span class="title__effect is-visible">safe</span>
                                    <span class="title__effect">free</span>
                                    <span class="title__effect">easy</span>
                                </strong>
                            </h2>
                            <div class="title__description">Easy extension security analysis</div>

                            <br>

                            <br>

                            <br>
                            <!-- (A) SEARCH FORM -->
                            <form method="post" action="welcome.php">
                                <input type="text" name="search" required/>
                                <br>
                                <input type="submit" value="Search"/>
                            </form>
                            <?php
                            // (B) PROCESS SEARCH WHEN FORM SUBMITTED
                            if (isset($_POST["search"])) {
                                // (B1) SEARCH FOR USERS
                                require "search.php";

                                // (B2) DISPLAY RESULTS
                                if (count($results) > 0) { foreach ($results as $r) {
                                    printf("<div>%s - %s</div>", $r["name"], $r["alternative"]);
                                }} else { echo "No results found"; }
                            }
                            ?>


                            <br>

                            <br>
                            <!-- (B) SEARCH RESULTS -->
                            <div id="results"></div>

                            <br>

                            <br>

                            <br>

                            <br>

                            <br>

                            <br>

                            <br>



                            <div class="title__action"><a href="uploadView.php" class="btn btn-success">Upload your JSON File</a></div>

                            <br>

                            <br>
                            <div class="title__action"><a href="uploadViewCRX.php" class="btn btn-success">Upload a CRX/ZIP File</a></div>

                            <br>

                            <br>
                            <div class="title__action"><a href="uploadViewBash.php" class="btn btn-success">Upload multiple for Analysis</a></div>
                            <br>

                            <br>
                        </div>
                        <!-- .title-01 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- .hero-section -->
</div>

<!-- JS -->
<script src="assets/js/plugins/animate-headline.js"></script>

</body>
</html>



