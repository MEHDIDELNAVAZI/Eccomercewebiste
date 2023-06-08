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
$userid = $_SESSION["id"];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["email"])) {
    $email  = trim($mysqli->real_escape_string($_POST["email"]));
    $_SESSION["editedemail"] = $email  ;
    $query = $mysqli->query(" SELECT * FROM users WHERE  id = '$_SESSION[id]' 
");
    $queryserach  = $mysqli->query(" SELECT * FROM users
    ");

    
    while ($row = mysqli_fetch_assoc($query)) {
        $previousemail  = $row['email'];
    }
    while ($row = mysqli_fetch_assoc($queryserach)) {
          if ($email == $row["email"]){
            $res = [
                'status' => 600,
                'message' => "this emial is already exist!"
            ];
            echo json_encode($res);
            return false;

          }
    }


    if ($email != "") {
        if ($email == $previousemail) {
            $res = [
                'status' => 450,
                'message' => "this emial is already  used for this acount  !"
            ];
            echo json_encode($res);
            return false;
        } else {  
           //send email to the email that entered .  

    require "./phpmailer/Exception.php";
    require  "./phpmailer/SMTP.php";
    require  "./phpmailer/PHPMailer.php";
     
    $_SESSION["verifycodeforeditemail"] = random_int(1000, 9999);
    // verify code will send to the email 
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "delnavazi1029@gmail.com";
    $mail->Password = "hfairhsvdqlguwwm ";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom("delnavazi1029@gmail.com");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "verify code for email :| ";
    $mail->Body = "please write this code to the verify page :  " . $_SESSION["verifycodeforeditemail"];
     
    if ( $mail->send()) { 
        $res = [
            'status' => 200,
            'message' => "verification code sent to your email !"
        ];
        echo json_encode($res);
        return false;
    }else {
        $res = [

            'status' => 505,
            'message' => " this email is not exist !" 
        ];
        echo json_encode($res);
        return false;
    }


            
        }
    } else {
        $res = [
            'status' => 424,
            'message' => "email field should not  be empty !"
        ];
        echo json_encode($res);
        return false;
    }
} else {
   header("location:userdetails.php?verifyemail=failed") ;
}
