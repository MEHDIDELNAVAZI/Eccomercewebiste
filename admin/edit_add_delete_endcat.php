<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;
//edit
if (isset($_GET["edit"])) {
    
$top_cat_id = $_POST["top_cat_id"] ; 
$mid_cat_id = $_POST["mid_cat_id"] ;
$editedname_endcat = $_POST["editedname_endcat"] ; 
$ecat_id = $_POST["ecat_id"] ; 

if 
(isset($top_cat_id) && isset($mid_cat_id)  && isset($editedname_endcat)
&& isset($ecat_id)
) { 


if ( $editedname_endcat !=""  ) {   

$querycheak  = $mysqli->query("SELECT * FROM tbl_end_category WHERE  ecat_name = '$editedname_endcat'  AND   mcat_id = '$mid_cat_id'") ;
if (mysqli_num_rows($querycheak) >=1 )  {
    $res= [
        'status'=> 201,
        'message' => "This Catgeory  is already exist  !" 
    ] ;
    echo json_encode($res) ;
    return false  ;

} else {
    

    $query  = $mysqli->query(" UPDATE tbl_end_category SET  ecat_name='$editedname_endcat' ,  mcat_id='$mid_cat_id'  
    WHERE  ecat_id = '$ecat_id' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " End_cat  edited succefully !"
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


}
   
   
} else {
    $res= [
        'status'=> 400,
        'message' => "Category name should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
}  else {
    $res= [
        'status'=> 302,
        'message' => "Category name should not be empty    !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}







//delete
} else if (isset($_GET["delete"])) {  
    $id  = $_POST["ecat_id"] ;  

    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_end_category` WHERE 
 ecat_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "End ctageory  deleted succefully !"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "End ctageory  deleted failed !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }









 //add
} else if (isset($_GET["add"])) {   
    $topcategory_id   = $_POST["topcategory_id"] ;
    $midcategory_id  = $_POST["midcategory_id"] ; 
    $newendcat_name =$_POST["newendcat_name"] ;
    
    
    $querycheak  = $mysqli->query("SELECT * FROM tbl_end_category WHERE  ecat_name = '$newendcat_name'  AND   mcat_id = '$midcategory_id'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Catgeory  is already exist  !" 
        ] ;
        echo json_encode($res) ;
        return false  ;

    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_end_category 
        (ecat_name  , mcat_id) 
        VALUES ('$newendcat_name'  , '$midcategory_id' ) 
       ");
    }
    
   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " End category   added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " End category   adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}
else {
  header("loction:index.php") ;
}
?>
