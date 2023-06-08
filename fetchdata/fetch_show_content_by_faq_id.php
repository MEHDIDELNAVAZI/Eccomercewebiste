<?php 
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;
$faq_id = $_POST["faq_id"] ;
if (isset($faq_id))  {
$query  = $mysqli->query("SELECT * FROM tbl_faq  WHERE  faq_id = '$faq_id'") ;
while($row = mysqli_fetch_assoc($query)) {
    echo $row ["faq_content"] ; 
$res = [
    'status' => 200,
    'message' => "success"
];
return false;
}
} 

else 
 {
$res = [
    'status' => 400,
    'message' => "failed"
];
return false;
 }
