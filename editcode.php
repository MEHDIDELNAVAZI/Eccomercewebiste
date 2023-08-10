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
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);
$userid = $_SESSION["USER_ID"] ;


if(isset($_POST["newcode"])) {
$newcode  = trim($mysqli->real_escape_string($_POST["newcode"]) );

if($newcode !="") {
$query  = $mysqli->query(" UPDATE identifynumber SET identifynumber='$newcode'    WHERE  userid = '$userid'
") ; 

if($query) {
    $res= [
        'status'=> 200,
        'message' => "Your code  updated succesfully !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
else {
    $res= [
        'status'=> 422,
        'message' => "Your code updated failed !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
}
else {
    $res= [
        'status'=> 423,
        'message' => "code field should not be empty !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
}
} 
else {
    header("location:Homepage.php?eidtcode=failed") ;
}
