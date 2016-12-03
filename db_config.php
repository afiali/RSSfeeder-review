<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rssfeeder";

$link = mysqli_connect($servername, $username, $password, $database);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>