<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
    
include "../config_database.php" ;
//edit  
if (isset($_GET["edit"])) {
if 
(isset($_POST["faq_id"]) &&  isset($_POST["new_content"])) { 
$faq_id = $_POST["faq_id"] ; 
$new_content = $_POST["new_content"] ;
$new_content = trim($mysqli->real_escape_string($new_content)) ;

    $query  = $mysqli->query(" UPDATE  tbl_faq  SET faq_content='$new_content'   WHERE  faq_id='$faq_id'  ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " FAQ edited succefully!"
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

}  else {
    $res= [
        'status'=> 302,
        'message' => "Somthing went Wrong !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}






//delete
} else if (isset($_GET["delete"])) {  
    $faq_id  = $_POST["faq_id"];
    if (isset($faq_id)) {
    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_faq`WHERE 
 faq_id='$faq_id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "FaQ deleted succefully!"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "FaQ  deleted failed!" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  
    } else {
        $res= [
            'status'=> 405,
            'message' => "Faq_id is not set try again !!!!" 
        ] ;
        echo json_encode($res) ;
        return false  ;
    }






    //add
} else if (isset($_GET["add"])) {   
    $content = $_POST["content"] ;
    $title = $_POST["title"] ;

    $querycheak  = $mysqli->query("SELECT * FROM tbl_faq WHERE  faq_title = '$title'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This FAQ is already exist!" 
        ] ;
        echo json_encode($res) ;
        return false  ;
    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_faq
        (faq_title , faq_content) 
        VALUES ('$title','$content')
       ");
    }
    


   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " FAQ  added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " FAQ    adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}
