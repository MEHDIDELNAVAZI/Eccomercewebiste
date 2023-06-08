<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../config_database.php";

//////add
if (isset($_GET["add"])) {
    $filename = $_FILES['file']['name'];
    $title  = $mysqli->real_escape_string($_POST["title"]);
    $content  = $mysqli->real_escape_string($_POST["content"]);


    if (isset($_FILES['file']['name']) && isset($content) && isset($title)) {
        /* Getting file name */
        $filename = $_FILES['file']['name'];
        /* Location */
        $location = "../Uploaded_images/".$filename;
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        /* Valid extensions */
        $valid_extensions = array("jpg", "jpeg", "png");
        $response = 0;
        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $querycheak = $mysqli->query("SELECT * FROM  tbl_service  WHERE photo='$filename'  AND title='$title'");
                if (mysqli_num_rows($querycheak) > 0) {
                    $res = [
                        'status' => 401,
                        'message' => " Service Already exist!"
                    ];
                    echo json_encode($res);
                    return false;
                } else {
                    $query  = $mysqli->query("INSERT INTO tbl_service  (title , content , photo)
              VALUES ('$title' , '$content' , '$filename')              
              ");
                    if ($query) {
                        $res = [
                            'status' => 200,
                            'message' => " Service Added succefully  !"
                        ];
                        echo json_encode($res);
                        return false;
                    } else {
                        $res = [
                            'status' => 202,
                            'message' => " Service Added failed  !"
                        ];
                        echo json_encode($res);
                        return false;
                    }
                }
            } else {
                $res = [
                    'status' => 400,
                    'message' => " Uploude file failed  !"
                ];
                echo json_encode($res);
                return false;
            }
        }
    } else {
        $res = [
            'status' => 405,
            'message' => "Do not leave empty the inputs and files  !"
        ];
        echo json_encode($res);
        return false;


    }


    //////delete
} else if (isset($_GET["delete"])) {
    if (isset($_POST["Service_id"])) {
        $serviceid = $_POST["Service_id"];
        $queryfor_picutrname  = $mysqli->query("SELECT * FROM tbl_service WHERE id='$serviceid' ");
        while ($row = mysqli_fetch_assoc($queryfor_picutrname)) {
            $picname  = $row["photo"];
        }
        $queryfor_delete = $mysqli->query("DELETE FROM tbl_service WHERE  id='$serviceid'");
        if ($queryfor_delete) {
            $location  = "../Uploaded_images/" . $picname;
            unlink($location);
            $res = [
                'status' => 200,
                'message' => "Service deleted sucefully !"
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 400,
                'message' => "Service deleted failed !"
            ];
            echo json_encode($res);
            return false;
        }
    } else {
        $res = [
            'status' => 405,
            'message' => "Service id failed !"
        ];
        echo json_encode($res);
        return false;
    }


    ///////edit

} else if (isset($_GET["edit"])) {
        $filename = $_FILES['file']['name'];
        $content  = $mysqli->real_escape_string($_POST["content"]);
        $s_id = $_POST["service_id"] ;   
    
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
                    $q = $mysqli->query("SELECT * FROM  tbl_service WHERE  id= '$s_id' ") ;
                    while($r= mysqli_fetch_assoc($q)) {
                    $previousfilename  = $r["photo"] ;
                    }
                    $location_delete_preiouse_pic = "../Uploaded_images/".$previousfilename ;
                    unlink($location_delete_preiouse_pic) ;  
                
                    $updateQuery = $mysqli->query("UPDATE  tbl_service  SET content='$content' , photo='$filename'  WHERE id = '$s_id'") ;
                    if ($updateQuery) {
                        $res = [
                            'status' => 200,
                            'message' => " Service Updated succefully !"
                        ];
                        echo json_encode($res);
                        return false;
                    } else {
                        $res = [
                            'status' => 202,
                            'message' => " Updating Service  failed!"
                        ];
                        echo json_encode($res);
                        return false;
                    }
                }
         
        }

        }
         else {
            $updateQuery = $mysqli->query("UPDATE  tbl_service  SET content='$content'  WHERE id ='$s_id'") ;
            if($updateQuery) {
                
                $res = [
                    'status' => 200,
                    'message' => " Service Updated succefully !"
                ];
                echo json_encode($res);
                return false;
            }  
            else {
                echo "202" ;
                $res = [
                    'status' => 202,
                    'message' => " Updating Service  failed!"
                ];
                echo json_encode($res);
                return false;
            }
    
         }

        
        


    
}
