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
 $panel  = $_POST["panel"] ;
 $id = $_POST["id"];
 if (isset($_POST["slider_id"])){
    $slider_id= $_POST["slider_id"];
 }
 if(isset($id)){
     include  "../admin/".$panel.".php" ;
    } 
    else if (isset ($slider_id)) {
    include  "../admin/".$panel.".php" ;
    }
 else {
 if (isset($_POST["type"])) { 
    if ($_POST["type"] == "search") {
         $str  = $_POST["searchstr"] ;
         $url  = "location:SocialMedia.php?str=".$str ;
         header($url);
 }
}
 include  "../admin/".$panel.".php" ;

$res = [
    'status' => 200,
    'message' => "success"
];
return false;
 }
?>
