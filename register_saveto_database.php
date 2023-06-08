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

if (isset($_SESSION["verifyemail"])) {
    if (!$conn) {
        //connection to data base is  rejected
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // connected to the data base 
        $name = $_SESSION['nameuser'];
        $email = $_SESSION["emailuser"];
        $password = $_SESSION['passworduser'];

        $select_users = $mysqli->query(" SELECT * From  `users` WHERE 
         email='$email' 
");
        if (mysqli_num_rows($select_users)  > 0) {
            $message[] = "This email is already have an acount ! ";
            header("location:register.php?userexist=true");
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $mysqli->query("INSERT INTO  users
               (name ,email,password)  
               VALUES 
               ( '$name' ,'$email', '$hashed_password')
                ");



            $query  = $mysqli->query("SELECT * FROM  users  WHERE 
            email = '$email'
");
            if (mysqli_num_rows($query) == 1) {
                while ($row = mysqli_fetch_assoc($query)) {
                        $_SESSION['id'] = $row['id'];
                }
            }




            header("location:index.php?registerdsuccefully");
        }
    }
} else {
    foreach ($_POST  as  $key => $value) {
        $$key = trim($mysqli->real_escape_string($_POST[$key]));
    }
    $_SESSION["nameuser"] = $name;
    $_SESSION["emailuser"] = $email;
    $_SESSION["passworduser"] = $password;


    $select_users = $mysqli->query(" SELECT * From  users  WHERE 
    email='$email' 
");
    if (mysqli_num_rows($select_users)  > 0) {
        header("location:register.php?userexist=true");
    } else {
        header("location:verifyemail.php?verifyemail=notverified");
    }
}
