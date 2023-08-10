<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "./config_database.php" ;

if (isset($_GET["delete_fav"])) {
    $user_id  =$_POST['user_id'] ;
    $p_id  = $_POST["p_id"] ;
    $query  =$mysqli->query("  DELETE  FROM favorite WHERE user_id='$user_id' AND  p_id='$p_id' ") ;
    if ($query) {
        $res = [
            'status' =>200
        ];
        echo json_encode($res);
        return false;
    }

    
    
} else if (isset($_GET["add_fav"])) {
  $user_id  =$_POST['user_id'] ;
  $p_id  = $_POST["p_id"] ;
  $query = $mysqli->query("SELECT * FROM favorite WHERE user_id='$user_id' AND p_id='$p_id'") ;
  if (mysqli_num_rows($query) == 0)  {
    $query  =$mysqli->query("  INSERT INTO  favorite  (user_id , p_id) VALUES 
    ('$user_id', '$p_id') 
     ") ;

     if ($query) {
        $res = [
            'status' =>200
        ];
        echo json_encode($res);
        return false;
        
    
     }
  }
 
}


?>