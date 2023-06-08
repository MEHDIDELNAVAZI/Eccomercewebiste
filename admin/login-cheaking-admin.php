<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);
foreach ($_POST  as  $key => $value) {
    $$key = trim($mysqli->real_escape_string($_POST[$key]));
}
//cheak the format of the email  
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location:login.php?error=emailformat") ;
  }else {

$query  = $mysqli->query("SELECT * FROM  admins  WHERE 
 email = '$email'
") ;
if (mysqli_num_rows($query) == 1) {
    while ($row = mysqli_fetch_assoc($query)) {
    if ($password == $row["password"]) {
            $_SESSION["emailadmin"] =$row["email"] ;
            $_SESSION["passwordadmin"] =$row["password"]  ;
            $_SESSION['idadmin'] = $row['id'];
            header("location:index.php?loginadmin=succes");
    } else {
        header("location:login.php?error=wrongpass") ;
    }
}
}
else {
    header("location:login.php?email=notexist");
}
  }
}  else {
    header("location:login.php");
}