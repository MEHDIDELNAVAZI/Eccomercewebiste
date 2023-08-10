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
$userid = $_SESSION["USER_ID"];


if (isset($_POST["date"])) {
    
    $date  = trim($mysqli->real_escape_string($_POST["date"]));
    $date = explode("/", $date);
    $day  = $date[1] ;
    $year  = $date[2] ;
    $month  = $date[0] ;  
    

    if ($year !="" && $year != "" && $day!="") {
    
    if($date != "") {

    $Querycheakcode  = $mysqli->query("SELECT * From Birthday WHERE 
          userid ='$userid'
");


    if (mysqli_num_rows($Querycheakcode) > 0) {
        $res = [
            'status' => 401,
            'message' => "this code for this user is already  exist !"
        ];
        echo json_encode($res);
        return false;
    }  
    
    else {
        $queryaddcode  = $mysqli->query(" INSERT INTO  Birthday
    (userid , year , month , day ) 
    VALUES ('$userid','$year','$month' , '$day')
    ");
    
        if ($queryaddcode) {
            $res = [
                'status' =>200,
                'message' => "Date  added succefully !"
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 422,
                'message' => " Adding  Date failed  ! "
            ];
            echo json_encode($res);
            return false;
        }
    }
} else {
    $res = [
        'status' =>423,
        'message' => "date  field should not be empty pick a date  !"
    ];
    echo json_encode($res);
    return false;
}

    } else {
        $res = [
            'status' =>423,
            'message' => "day or year or month  field should not be empty !"
        ];
        echo json_encode($res);
        return false;
    }


}else {
    header("location:Homepage.php?addbirthday=failed");
}


?>