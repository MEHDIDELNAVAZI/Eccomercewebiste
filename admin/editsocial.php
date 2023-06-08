<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
    
include "../config_database.php" ;
if(isset($_GET["edit"])) {
if 
(isset($_POST["S_name"]) && $_POST["S_url"]  && isset($_POST["S_id"]))  {
$socialname  = trim($mysqli->real_escape_string($_POST["S_name"])) ;
$socialurl = trim($mysqli->real_escape_string($_POST["S_url"])) ;
$socialid= trim($mysqli->real_escape_string($_POST["S_id"])) ;

if ($socialname !="") {  
    $query  = $mysqli->query(" UPDATE tbl_social SET social_name='$socialname' , social_url ='$socialurl'   WHERE  social_id = '$socialid' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => "Social media edited succefully !"
        ] ;
        echo json_encode($res) ;
        return false  ;
    }  else {
        $res= [
            'status'=> 201,
            'message' => "Updating failed  !"
        ] ;
        echo json_encode($res) ;
        return false  ;
    }
} else {
    $res= [
        'status'=> 400,
        'message' => "Social name should not be  empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
}   

}
else if (isset ($_GET ["delete"])) {
 $id   = $_POST["S_id"] ; 
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_social`WHERE 
 social_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Social media deleted succefully !"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Social media deleted failed !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }


} 

else if (isset($_GET["add"])) {
    $name  = $_POST["name"] ;
    $url =  $_POST["url"] ;
    $icon = $_POST["icon"] ; 
    $querycheak  = $mysqli->query("SELECT * FROM tbl_social WHERE  social_name = '$name'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This socialmedia is already exist  !" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_social 
        (social_name  , social_url ,social_icon) 
        VALUES ('$name'  , '$url' ,'$icon') 
       ");

    }
    

   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => "Social media added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => "Social media added failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}
