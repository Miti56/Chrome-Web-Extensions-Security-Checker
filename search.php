<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'extensions';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// (B) CONNECT TO DATABASE
try {
    $pdo = new PDO(
        "mysql:host=".$DATABASE_HOST.";dbname=".$DATABASE_NAME,
        $DATABASE_USER, $DATABASE_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $ex) { exit($ex->getMessage()); }

// (C) SEARCH
$stmt = $pdo->prepare("SELECT * FROM `extensionsV3` WHERE `nameUser` LIKE ? OR `name` LIKE ?");
$stmt->execute(["%".$_POST["search"]."%", "%".$_POST["search"]."%"]);
//$stmt->execute(["%test%", "%test%"]);

$results = $stmt->fetchAll();
//echo json_encode($results);
//echo json_encode($results["nameUser"]);
//echo json_encode($results["name"]);
if (isset($_POST["ajax"])) { echo json_encode($results); }
