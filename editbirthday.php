<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);
$userid = $_SESSION["id"];


if (isset($_POST["date"])) {
    
    $date  = trim($mysqli->real_escape_string($_POST["date"]));
    $date = explode("/", $date);
    $day  = $date[1] ;
    $year  = $date[2] ;
    $month  = $date[0] ;  
    

    if ($year !="" && $year != "" && $day!="") {
    
    if($date != "") {

    $query  = $mysqli->query( "UPDATE  Birthday   SET  year= '$year ' ,  month='$month'  ,  
    day='$day'  WHERE 
          userid ='$userid'
");

if ($query)  {
    $res= [
        'status'=> 200,
        'message' => "Your birthday updated succesfully !"
    ] ;
    echo json_encode($res) ;
    return false  ;

} 
 
else {
    $res= [
        'status'=> 422,
        'message' => "Your birthday updating failed !"
    ] ;
    echo json_encode($res) ;
    return false  ;


}

    }


}

}
