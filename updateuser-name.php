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
$userid = $_SESSION["USER_ID"] ;


if(isset($_POST["name"])) {

$name  = trim($mysqli->real_escape_string($_POST["name"]) );


if($name != "") {
$query  = $mysqli->query(" UPDATE users SET name='$name'    WHERE  id = '$userid'
") ; 

if($query) {
    
    $_SESSION["nameuser"]= $name ;
    $res= [
        'status'=> 200,
        'message' => "Your name updated succesfully !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
else {
    $res= [
        'status'=> 422,
        'message' => "Your name updated failed ! "
    ] ;
    echo json_encode($res) ;
    return false;
}
}

else {
    $res = [
        'status' =>423,
        'message' => "name  field should not be empty !"
    ];
    echo json_encode($res);
    return false;
} 

}

else {
    header("location:index.php?changename=failed") ;
}
