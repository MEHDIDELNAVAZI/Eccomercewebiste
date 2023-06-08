<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
    
include "../config_database.php" ;

if (isset ($_POST["type"])) {
    if ($_POST["type"] == "add") {
        $filename = $_FILES['file']['name'];
        $heading=$mysqli->real_escape_string($_POST["heading"]) ;
        $buttontext=$mysqli->real_escape_string($_POST["buttontext"]) ;
        $url=$mysqli->real_escape_string($_POST["url"]) ;
        $content=$mysqli->real_escape_string($_POST["content"]) ;
        $position=  $mysqli->real_escape_string ($_POST["position"]) ;

         if (isset($filename)) {
            $location = "../Uploaded_images/" . $filename;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            /* Valid extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            $response = 0;
            /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions)) {
                /* Upload file */
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) { 
                $addquery  = $mysqli->query("INSERT INTO tbl_slider  (photo,heading,content,button_text,button_url ,position)
                VALUES ('$filename' ,'$heading', '$content' ,'$buttontext' ,'$url' , '$position' )
                ");
                if ($addquery) {
                    $res= [
                        'status'=> 200,
                        'message' => "Slider Added successfulyy!"
                    ] ;
                    echo json_encode($res) ;
                    return false  ;
                }
                }

            }}
    } else if ($_POST["type"] == "edit") {
        $heading=$mysqli->real_escape_string($_POST["heading"]) ;
        $buttontext=$mysqli->real_escape_string($_POST["buttontext"]) ;
        $url=$mysqli->real_escape_string($_POST["url"]) ;
        $content=$mysqli->real_escape_string($_POST["content"]) ;
        $position=$mysqli->real_escape_string ($_POST["position"]) ;
        $slider_id=$mysqli->real_escape_string ($_POST["slider_id"]) ;
        $updatequery  = $mysqli->query("UPDATE tbl_slider SET  heading='$heading' ,content='$content', button_text='$buttontext',
        button_url='$url',position = '$position'  WHERE id='$slider_id'
          ") ;
          if ($updatequery) {
            $res= [
                'status'=> 200,
                'message' => "Slider updated succefully!"
            ] ;
            echo json_encode($res) ;
            return false  ;
          } else {
            $res= [
                'status'=> 400,
                'message' => "Updating slider failed !"
            ] ;
          }
     


    

    } else if ($_POST["type"] == "delete") { 
        $id =$_POST["id"] ;
        $deletequery  =$mysqli->query("DELETE FROM  tbl_slider WHERE id= '$id' ") ;
        if ($deletequery) {
            $res= [
                'status'=> 200,
                'message' => "Slider deleted  !"
            ] ;
            echo json_encode($res) ;

            return false  ;
        } else {
            $res= [
                'status'=> 400,
                'message' => "deleting failed !"
            ] ;
            echo json_encode($res) ;
            return false  ;
        
        }

    
    
    } else if ($_POST["type"] == "editphoto") { 

        $filename = $_FILES['file']['name'];
        $slider_id = $_POST["slider_id"] ;
        $heading=$mysqli->real_escape_string($_POST["heading"]) ;
        $buttontext=$mysqli->real_escape_string($_POST["buttontext"]) ;
        $url=$mysqli->real_escape_string($_POST["url"]) ;
        $content=$mysqli->real_escape_string($_POST["content"]) ;
        $position=  $mysqli->real_escape_string ($_POST["position"]) ;

         if (isset($filename)) {
            $location = "../Uploaded_images/" . $filename;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            /* Valid extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            $response = 0;
            /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions)) {
                /* Upload file */
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) { 
                 $updatequery = $mysqli->query("UPDATE tbl_slider SET photo = '$filename' WHERE id='$slider_id'") ;
                 if ($updatequery ) {
                    $res= [
                        'status'=> 200,
                        'message' => "Photo updated !"
                    ] ;
                    echo json_encode($res) ;
                    return false  ;
                 } else {
                    $res= [
                        'status'=> 400,
                        'message' => "Updating Photo Failed!"
                    ] ;
                    echo json_encode($res) ;
                    return false  ;
                 }
                }
            }
        }
    
    }
    
} else {
    $res= [
        'status'=> 401,
        'message' => " Type not set!"
    ] ;
    echo json_encode($res) ;
    return false  ;
}
?>