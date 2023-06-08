<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;
if (isset($_GET["edit"])) {
    
if 
(isset($_POST["editedcountryname"]) && $_POST["country_id"]) { 
$editedcountryname = $_POST["editedcountryname"] ; 
$country_id = $_POST["country_id"] ;
$q= $mysqli->query("SELECT * FROM tbl_country WHERE country_name = '$editedcountryname'")  ;

if (mysqli_num_rows($q) > 0 ) {

    $res= [
        'status'=> 405,
        'message' => " This Country  name is already exist !"
    ] ;
    echo json_encode($res) ;
    return false  ;

} 

if ( $editedcountryname !=""  ) {   
   
    $query  = $mysqli->query(" UPDATE tbl_country SET  country_name='$editedcountryname'   WHERE  country_id = '$country_id' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " Country  edited succefully!"
        ] ;
        echo json_encode($res) ;
        return false  ;
    }  else {
        $res= [
            'status'=> 201,
            'message' => "Updating failed!"
        ] ;
        echo json_encode($res) ;
        return false  ;
    }
} else {
    $res= [
        'status'=> 400,
        'message' => "Country name   should not be empty!"
    ] ;
    echo json_encode($res) ;
    return false  ;
}



}  else {
    $res= [
        'status'=> 302,
        'message' => "Country name should not be empty!"
    ] ;
    echo json_encode($res) ;
    return false  ;
}

} else if (isset($_GET["delete"])) {  
    $id  = $_POST["country_id"] ;  
    
    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_country`WHERE 
 country_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Country deleted succefully!"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Country  deleted failed!" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  

} else if (isset($_GET["add"])) {   
    $countryname     = $_POST["countryname"] ;

    $querycheak  = $mysqli->query("SELECT * FROM tbl_country WHERE  country_name = '$countryname'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Country  is already exist!" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_country
        (country_name) 
        VALUES ('$countryname') 
       ");
    }

   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " Country added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " Country adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}




?>
