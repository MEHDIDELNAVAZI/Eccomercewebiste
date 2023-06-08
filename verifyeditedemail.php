

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
if (isset($_SESSION["verifycodeforeditemail"])) {

if 
(isset($_POST["hezargan"]  )  && isset ($_POST["sadgan"]) && isset($_POST["dahgan"]) && isset($_POST["yekan"] )) {
$hezargan = $_POST["hezargan"] ;
$sadgan = $_POST["sadgan"] ;
$dahgan = $_POST["dahgan"] ;
$yekan = $_POST["yekan"] ;
$code  = $hezargan*1000 +$sadgan * 100 + $dahgan * 10 + $yekan  ;

if ($hezargan!="" && $sadgan !="" && $dahgan !="" && $yekan!="") {


if ($code == $_SESSION["verifycodeforeditemail"] ) {
    unset($_SESSION["verifycodeforeditemail"]);
    $querychnageemail = $mysqli->query("UPDATE users set email = '$_SESSION[editedemail]' ") ;
    if ($querychnageemail) {
        $res = [
            'status' => 200,
            'message' => " Your email changed  successfully !"  
        ];
        echo json_encode($res);
        return false;
    }
    else {
        $res = [
            'status' => 245,
            'message' => " Changing email feiled  !"  
        ];
        echo json_encode($res);
        return false;
    }
    
}
else {
    $res = [
        'status' => 260,
        'message' => " verificationcode is wrong ! "  
    ];
    echo json_encode($res);
    return false;
}



} else {
    $res = [
        'status' => 344,
        'message' => " verify code fileds should not be empty  !" 
    ];
    echo json_encode($res);
    return false;
}






}
else {
    $res = [
        'status' => 420,
        'message' => "verifying code failed  !" 
    ];
    echo json_encode($res);
    return false;
}




} else {
    $res = [
        'status' => 333,
        'message' => "  code  expired !" 
    ];
    echo json_encode($res);
    return false;
}
?>



