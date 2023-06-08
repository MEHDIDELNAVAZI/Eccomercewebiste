<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;

//edit
if (isset($_GET["edit"])) {
    
if 
(isset($_POST["updatetopcategory_id"]) && $_POST["editmdcatname"] && isset($_POST["mcat_id"])) { 

$updatetopcategory_id = $_POST["updatetopcategory_id"] ; 
$editmdcatname = $_POST["editmdcatname"] ;
$mcat_id = $_POST["mcat_id"] ; 
$queryduplicate = $mysqli->query("SELECT * FROM   tbl_mid_category WHERE  mcat_name = '$editmdcatname'  AND  tcat_id ='$updatetopcategory_id'  ");
if (mysqli_num_rows($queryduplicate) > 0){
    $res= [
        'status'=> 405,
        'message' => " This category is already exist !"
    ] ;
    echo json_encode($res) ;
    return false;
}

else {

    if ( $editmdcatname !=""  ) {   
   
        $query  = $mysqli->query(" UPDATE tbl_mid_category SET  mcat_name='$editmdcatname' ,  tcat_id='$updatetopcategory_id'   WHERE  mcat_id = '$mcat_id' ") ;
        if ($query ) {
            $res= [
                'status'=> 200,
                'message' => " Mid_cat  edited succefully !"
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
            'message' => "Category name should not be empty  !"
        ] ;
        echo json_encode($res) ;
        return false  ;
    }
}




}  else {
    $res= [
        'status'=> 302,
        'message' => "Category name should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}







//delete
} else if (isset($_GET["delete"])) {  
    $id  = $_POST["mcat_id"] ;  

    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_mid_category` WHERE 
 mcat_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Mid ctageory  deleted succefully !"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Mid ctageory  deleted failed !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  

} else if (isset($_GET["add"])) {   
    $nameformidcategory   = $_POST["nameformidcategory"] ;
    $topcategory  = $_POST["topcategory"] ;
    
    $query_for_id = $mysqli ->query("SELECT * FROM tbl_top_category  WHERE  tcat_name = '$topcategory' ") ;
    while($row = mysqli_fetch_assoc($query_for_id)) {
    $topcatid = $row["tcat_id"];
    }
   
    
    $querycheak  = $mysqli->query("SELECT * FROM tbl_mid_category WHERE  mcat_name = '$nameformidcategory'  AND   tcat_id = '$topcatid'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Catgeory  is already exist  !" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $addquery = $mysqli->query(" INSERT INTO  tbl_mid_category 
        (mcat_name  , tcat_id) 
        VALUES ('$nameformidcategory'  , '$topcatid' ) 
       ");
    }
    


   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " Mid category   added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " Mid category   adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}
