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
$topcategory  = $_POST["category"];

$queryserachforid = $mysqli->query("SELECT * FROM tbl_top_category WHERE 
tcat_name = '$topcategory'
");


while ($row = mysqli_fetch_assoc($queryserachforid)) {
    $topcat_id = $row["tcat_id"];
};
$queryformidcat_id = $mysqli->query("SELECT * FROM tbl_mid_category WHERE 
tcat_id = '$topcat_id'
");
while ($row1 = mysqli_fetch_assoc($queryformidcat_id)) {
    $id = $row1["mcat_id"];

    $queryforendcat_id = $mysqli->query("SELECT * FROM tbl_end_category WHERE 
    mcat_id = '$id'
     ");
    echo    "<div class='flex-auto flex flex-col flex-wrap overflow-auto ml-5'>";
    echo    "<a    href=index.php?mid_category=" . $row1["mcat_id"] .">".$row1['mcat_name'];
    echo    "</a>";
    echo "<hr>";
    while ($rowendlevel = mysqli_fetch_assoc($queryforendcat_id)) {
        echo  "<a style='color: black;' href=index.php?ecat_id=".$rowendlevel["ecat_id"].">" ;
        echo "<div class='midcat'> " .   $rowendlevel['ecat_name']   . "</div>";
        echo  "</a>";
    }
    echo   "</div>";
}
$res = [
    'status' => 200,
    'message' => "success"
];
return false;
?>