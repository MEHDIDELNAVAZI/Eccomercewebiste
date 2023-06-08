<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include  "../config_database.php"; 
$topcategory_id = $_POST["topcategory"] ;

if (isset($topcategory_id)) {
$query  = $mysqli->query("SELECT * FROM     tbl_mid_category  WHERE tcat_id = '$topcategory_id'") ;
while($row=mysqli_fetch_assoc($query)) {
 echo "<option  value=". $row["mcat_id"] . ">" ;
 echo $row["mcat_name"] ;
 echo "</option>" ;
}
$res= [
    'status'=> 200
    ] ;
echo json_encode($res) ;
return false  ;

}else if(isset($tcat_id)) {
$query  = $mysqli->query("SELECT * FROM   tbl_mid_category  WHERE tcat_id = '$tcat_id'") ;
while($row=mysqli_fetch_assoc($query)) {
 echo '<option  value="'. $row["mcat_id"].'">'  ;
 echo $row["mcat_name"] ;
 echo "</option>" ;
}
$res= [
    'status'=> 200
    ] ;
echo json_encode($res) ;
return false  ;
}


?>