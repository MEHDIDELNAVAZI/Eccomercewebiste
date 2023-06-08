<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }   
    
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";

$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);
$Service_id  = $_POST["Service_id"];
if (isset($Service_id)){

    $queryfor_picture = $mysqli->query("SELECT * FROM tbl_service WHERE 
    id = '$Service_id'
    ");
    while ($row = mysqli_fetch_assoc($queryfor_picture)) {
        $photo = $row["photo"] ;
    }
    echo  "<img      width='80px' height='80px'    src=../Uploaded_images/".$photo . ">"  ;
    
    $res = [
        'status' => 200,
        'message' => "success"
    ];
    return false;
    
}

else {

    $res = [
        'status' => 400,
        'message' => "Error"
    ];
    return false;
}


