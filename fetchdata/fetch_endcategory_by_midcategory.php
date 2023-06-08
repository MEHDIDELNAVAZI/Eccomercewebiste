<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include  "../config_database.php"; 
$mcat_id = $_POST["mcat_id"] ;

if (isset($mcat_id)) {
$query  = $mysqli->query("SELECT * FROM     tbl_end_category  WHERE mcat_id = '$mcat_id'") ;
while($row=mysqli_fetch_assoc($query)) {
 echo "<option  value=". $row["ecat_id"] . ">"  ;
 echo $row["ecat_name"] ;
 echo "</option>" ;
}
$res= [
    'status'=> 200
    ] ;
echo json_encode($res) ;
return false  ;
}


?>