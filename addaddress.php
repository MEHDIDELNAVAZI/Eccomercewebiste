<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  

    
include "./config_database.php" ;

if (isset($_GET["addaddress"])) {
    $line1  = $_POST["addresline1"];
    $line2  = $_POST["addresline2"];
    $user_id  = $_POST['user_id'];
    $query = $mysqli->query("INSERT INTO addresses  (user_id,address_line1,address_line2) 
    VALUES   ('$user_id' , '$line1' , '$line2') 
    ");
    if ($query) {
        $res = [
            'status' => 200,
            'message' => "Adrress added sucfully"

        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 400,
            'message' => "Adding address failed !"
        ];
        echo json_encode($res);
        return false;
    }
}
?>