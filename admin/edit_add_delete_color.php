<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;
if (isset($_GET["edit"])) {
    
if 
(isset($_POST["editedcolor"]) && $_POST["colorid"]) { 
$editedcolor = $_POST["editedcolor"] ; 
$colorid = $_POST["colorid"] ;

$q= $mysqli->query("SELECT * FROM tbl_color WHERE color_name = '$editedcolor'")  ;

if (mysqli_num_rows($q) > 0 ) {

    $res= [
        'status'=> 405,
        'message' => " This Color  name is already exist !"
    ] ;
    echo json_encode($res) ;
    return false  ;

} 

if ( $editedcolor !=""  ) {   
   
    $query  = $mysqli->query(" UPDATE tbl_color SET  color_name='$editedcolor'   WHERE  color_id = '$colorid' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " Color edited succefully!"
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
        'message' => "Color  name  should not be empty!"
    ] ;
    echo json_encode($res) ;
    return false  ;
}



}  else {
    $res= [
        'status'=> 302,
        'message' => "Color name should not be empty!"
    ] ;
    echo json_encode($res) ;
    return false  ;
}

} else if (isset($_GET["delete"])) {  
    $id  = $_POST["color_id"] ;  
    
    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_color`WHERE 
 color_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Color deleted succefully!"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Color  deleted failed!" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  

} else if (isset($_GET["add"])) {   
    $colorname     = $_POST["colorname"] ;

    $querycheak  = $mysqli->query("SELECT * FROM tbl_color WHERE  color_name = '$colorname'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Color is already exist!" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_color
        (color_name) 
        VALUES ('$colorname') 
       ");
    }
    


   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " Color  added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " Color    adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}




?>
