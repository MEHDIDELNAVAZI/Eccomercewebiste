<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php";

if (isset($_GET["edit"])) {

if (isset($_POST["newshippingcost"]) && $_POST["shipping_id_toedit"]) { 
$newshippingcost = $_POST["newshippingcost"]; 
$shipping_id_toedit = $_POST["shipping_id_toedit"]; 


if ( $newshippingcost !="") {   

    $queryedit=$mysqli->query("UPDATE tbl_shipping_cost SET  amount='$newshippingcost' WHERE shipping_cost_id='$shipping_id_toedit' ") ;

    if ($queryedit ) {
        $res= [
            'status'=> 200,
            'message' => " Shippingcost edited succefully !"
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
        'message' => "Shipping cost should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
}  else {
    $res= [
        'status'=> 302,
        'message' => "Shipping  cost should not be empty  !"
    ] ;
    echo json_encode($res) ;
    return false  ;
}

//delete
} else if (isset($_GET["delete"])) {  
    $id  = $_POST["country_id"] ;  
 $deletequery = $mysqli->query(" DELETE  FROM  tbl_shipping_cost WHERE 
 country_id='$id'
");
if ($deletequery)
 {
    $res= [
    'status'=> 200,
    'message' => " Shipping cost deleted succefully !"
] ;
echo json_encode($res) ;
return false  ;

 } else {
    $res= [
        'status'=> 400,
        'message' => "Shipping cost deleted failed !" 
    ] ;
    echo json_encode($res) ;
    return false  ;
 }

} 
//add
else if (isset($_GET["add"])) {   
    $country_id   = $_POST["Country_id"] ;
    $amount  = $_POST["Amount"] ;

    if (isset($country_id)) {
    
    
    $querycheak  = $mysqli->query("SELECT * FROM tbl_shipping_cost WHERE  country_id = '$country_id'") ;
    if (mysqli_num_rows($querycheak) > 0 )  {
        $res= [
            'status'=> 201,
            'message' => "This Shipping cost  is already exist !" 
        ] ;
        echo json_encode($res) ;
        return false  ;


    } else {
        $q = $mysqli->query("SELECT * FROM tbl_country WHERE  country_id= '$country_id'") ;
        while($r = mysqli_fetch_assoc($q)) {
        $countryname  = $r["country_name"] ;
        }
        $addquery = $mysqli->query(" INSERT INTO  tbl_shipping_cost 
        (country_id  , amount ,country_name) 
        VALUES ('$country_id'  , '$amount' ,'$countryname' )  
       ");
    }
    
   if ($addquery)
    {
       $res= [
       'status'=> 200,
       'message' => "  Shipping cost added succefully !"
   ] ;
   echo json_encode($res) ;
   return false  ;
   
    } else {
       $res= [
           'status'=> 400,
           'message' => " Shipping cost adding  failed !" 
       ] ;
       echo json_encode($res) ;
       return false  ;
    }

}
else {
    $res= [
        'status'=> 405,
        'message' => " Choose country name!" 
    ] ;
    echo json_encode($res) ;
    return false  ;
}
}
else {
  header("loction:index.php") ;
}
?>