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

if (isset($_POST["number"])) {
    
    $number  = trim($mysqli->real_escape_string($_POST["number"]));
    if($number != "") {
    $Querycheaknuber  = $mysqli->query("SELECT * From phones WHERE 
    phonenumber='$number' and userid='$userid'
");


    if (mysqli_num_rows($Querycheaknuber) > 0) {
        $res = [
            'status' => 401,
            'message' => "this number  for this user is already  exist !"
        ];
        echo json_encode($res);
        return false;
    } 
    else {
        $queryaddnumber  = $mysqli->query(" INSERT INTO  phones
    (userid , phonenumber ) 
    VALUES ('$userid','$number')
    ");
        if ($queryaddnumber) {
            $res = [
                'status' =>200,
                'message' => "Number added succefully"
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 422,
                'message' => "Number added failed  "
            ];
            echo json_encode($res);
            return false;
        }
    }
    

    }

    else {
        $res = [
            'status' =>423,
            'message' => "number  field should not be empty !"
        ];
        echo json_encode($res);
        return false;
    } 

} else {
    header("location:Homepage.php?addnumber=failed");
}


?>