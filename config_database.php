<?php


#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli($servername, $username, $password, $Db_name);
$conn = mysqli_connect($servername, $username, $password, $Db_name);

if (!$conn) {
    echo "Connection Failed";
}

