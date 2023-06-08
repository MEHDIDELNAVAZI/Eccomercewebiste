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
$userid = $_SESSION["id"] ;
$previosupassword  = trim($mysqli->real_escape_string($_POST['previouspass'])) ; 
$newpassword  = trim($mysqli->real_escape_string($_POST['newpass'])) ; 
$confirmpass  = trim($mysqli->real_escape_string($_POST['confirmpass'])) ; 


$query = $mysqli->query("SELECT * FROM users WHERE 
 id = '$_SESSION[id]'") ;
 while($row = mysqli_fetch_assoc($query)) {
   if  (password_verify($previosupassword , $row['password'])) {
     if ($newpassword == $confirmpass) {
        $newpasshashed  = password_hash($newpassword, PASSWORD_DEFAULT) ;
         $queryeditpass = $mysqli->query("UPDATE  users 
         SET password = '$newpasshashed' WHERE  id = '$userid'");
        
        if($queryeditpass) {
            $res= [
                'status'=> 200,
                'message' => "Your password updated succesfully !"
            ] ;
            echo json_encode($res) ;
            return false  ;
        } else {
            $res= [
                'status'=> 421,
                'message' => "updating password  failed !"
            ] ;
            echo json_encode($res) ;
            return false  ;
        }
     }else {
        
        $res= [
            'status'=> 420,
            'message' => "Your new password and confirmed password is not same !!"
        ] ;
        echo json_encode($res) ;
        return false  ;
     }
   } 
   else {
    $res= [
        'status'=> 422,
        'message' => "You enterd the previous password wrong !!"
    ] ;
    echo json_encode($res) ;
    return false  ;

   }
 }











?>