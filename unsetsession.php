<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$res = [
    'status' => 200,
    'message' => " session  succefully  expired !" 
];
echo json_encode($res);
return false;

?>