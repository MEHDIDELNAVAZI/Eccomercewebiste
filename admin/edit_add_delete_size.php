<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;

if (isset($_GET["edit"])) {
    
if 
(isset($_POST["editedsize"]) && $_POST["sizeid"]) { 
$editedsize = $_POST["editedsize"] ; 
$sizeid = $_POST["sizeid"] ;

$q= $mysqli->query("SELECT * FROM tbl_size WHERE size_name = '$editedsize'")  ;

if (mysqli_num_rows($q) > 0 ) {

    $res= [
        'status'=> 405,
        'message' => " This size name is already exist !"
    ] ;
    echo json_encode($res) ;
    return false  ;

} 

if ( $editedsize !=""  ) {   
   
    $query  = $mysqli->query(" UPDATE tbl_size SET  size_name='$editedsize'   WHERE  size_id = '$sizeid' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " Size  edited succefully !"
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
        'message' => "Szie name  should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}



}  else {
    $res= [
        'status'=> 302,
        'message' => "Size name  should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}

} else if (isset($_GET["delete"])) {  
    $id  = $_POST["size_id"] ;  
    
    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_size`WHERE 
 size_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Size  deleted succefully!"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Size deleted failed!" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  

} else if (isset($_GET["add"])) {   
    $sizename    = $_POST["sizename"] ;

    $querycheak  = $mysqli->query("SELECT * FROM tbl_size WHERE  size_name = '$sizename'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Size   is already exist  !" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_size
        (size_name) 
        VALUES ('$sizename') 
       ");
    }
    


   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " Size  added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " Size    adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }
}

else {
  header("loction:index.php") ;
}




?>
