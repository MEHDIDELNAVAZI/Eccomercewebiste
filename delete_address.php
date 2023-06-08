<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  


include "./config_database.php" ;

if (isset($_GET["daddress"])) {
    $ad_id = $_POST["ad_id"] ;
    $query = $mysqli->query("DELETE FROM  addresses  WHERE ad_id = '$ad_id'
    ");
    if ($query) {
        $res = [
            'status' => 200,
            'message' => "Address deleted !"

        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 400,
            'message' => "Deleiting failed!"
        ];
        echo json_encode($res);
        return false;
    }
}

?>