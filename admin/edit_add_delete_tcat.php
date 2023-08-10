<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php" ;
if (isset($_GET["edit"])) {
   
    
if 
(isset($_POST["tcat_id"]) && $_POST["tcat_show"]  && isset($_POST["tcat_name"]))  {
$tcat_name  = trim($mysqli->real_escape_string($_POST["tcat_name"])) ;
$tcat_id = trim($mysqli->real_escape_string($_POST["tcat_id"])) ;
$tcat_show= trim($mysqli->real_escape_string($_POST["tcat_show"])) ;
 
if ($tcat_show == "Yes") {
    $tcat_show =1 ;
} else {
    $tcat_show =0 ;
}



if ($tcat_name !="") {  
    $query  = $mysqli->query(" UPDATE tbl_top_category SET tcat_name='$tcat_name' , show_on_menu ='$tcat_show'   WHERE  tcat_id = '$tcat_id' ") ;
    if ($query ) {
        $res= [
            'status'=> 200,
            'message' => " Top_Cat  edited succefully !"
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

} else if (isset($_GET["delete"])) {  
    $id   = $_POST["tcat_id"] ; 
    
 $deletequery = $mysqli->query(" DELETE  FROM `tbl_top_category`WHERE 
 tcat_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => "Top ctageory  deleted succefully !"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Top ctageory  deleted failed !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }
  

} else if (isset($_GET["add"])) {   
    $name  = $_POST["name"] ;
    $showmenue = $_POST["showmenue"] ;

    $querycheak  = $mysqli->query("SELECT * FROM tbl_top_category WHERE  tcat_name = '$name'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Topcatgeory  is already exist  !" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        if ($showmenue == "Yes") {
           $showmenue =1 ;
        } else {
            $showmenue =0;
        } 

        $addquery = $mysqli->query(" INSERT INTO  tbl_top_category 
        (tcat_name  , show_on_menu) 
        VALUES ('$name'  , '$showmenue' ) 
       ");

    }
    


   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => " TopCategory  added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " TopCategory  adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}

else {
  header("loction:index.php") ;
}




?>