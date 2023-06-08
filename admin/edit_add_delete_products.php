<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die( header( 'location:http://shop.test/not_found_page.php' ) );
  }  
  
  
include "../config_database.php";

if (isset($_GET["add"])) {

  $picture_files_lengh = $_POST["picture_files_lengh"];
  //cheak size and color 
  $size_id = $_POST["size"];
  $color_id = $_POST["color"];
  //cheak size and color 
  $productname = trim($mysqli->real_escape_string($_POST["P_name"]));
  $O_price = $mysqli->real_escape_string($_POST["O_price"]);
  $C_price = $mysqli->real_escape_string($_POST["C_price"]);
  $qunatity = $mysqli->real_escape_string($_POST["qunatity"]);
  $topcatid = $mysqli->real_escape_string($_POST["topcatid"]);
  $midcatid = $mysqli->real_escape_string($_POST["midcatid"]);
  $endcatid = $mysqli->real_escape_string($_POST["endcatid"]);
  $view = 0;
  $isfetured = $_POST["isfetured"];
  $isactive = $_POST["isactive"];
  $Description = trim($mysqli->real_escape_string($_POST["Description"]));
  $ShortDes = $mysqli->real_escape_string($_POST["ShortDes"]);
  $Fetures = trim($mysqli->real_escape_string($_POST["Fetures"]));
  $Conditions = trim($mysqli->real_escape_string($_POST["Conditions"]));
  $ReturnPolicy = trim($mysqli->real_escape_string($_POST["ReturnPolicy"]));
  $ShortDes = trim($mysqli->real_escape_string($_POST["ShortDes"]));
  $product_fetured_photo = $_FILES["file1"]["name"];


  $cheakquery_duplicate = $mysqli->query("SELECT *  FROM tbl_product WHERE p_name = '$productname' AND  ecat_id = '$endcatid' ");
  if (mysqli_num_rows($cheakquery_duplicate) > 0) {
    $res = [
      'status' => 405,
      'message' => "This product is Already exist  !"
    ];
    echo json_encode($res);
    return false;
  }

  $insertproduct  = $mysqli->query("INSERT INTO tbl_product  (p_name ,	p_old_price	 , p_current_price ,	p_qty ,	
p_featured_photo	 , p_description , 	p_short_description ,	p_feature ,	p_condition	 ,
p_return_policy ,	p_total_view , 	p_is_featured ,p_is_active , tcat_id , mcat_id , ecat_id)  

VALUES  ('$productname','$O_price','$C_price','$qunatity','$product_fetured_photo','$Description'
,'$ShortDes','$Fetures','$Conditions','$ReturnPolicy','$view','$isfetured','$isactive','$topcatid','$midcatid','$endcatid'
)
");
  if ($insertproduct) {

    $getnextid = $mysqli->query(
      "SELECT p_id FROM   tbl_product ORDER BY p_id DESC LIMIT 1"
    );
    while ($r = mysqli_fetch_assoc($getnextid)) {
      $lastid = $r["p_id"];
    };
    $nextid = $lastid;
    $filename = $_FILES["file1"]['name'];
    /* Location */
    $location = "../Uploaded_images/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png");
    $response = 0;
    /* Check file extension */
    if (in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      move_uploaded_file($_FILES["file1"]['tmp_name'], $location);
    }

    for ($i = 2; $i <= $picture_files_lengh; $i++) {
      $filenametr = "file" . $i;
      $filename = $_FILES[$filenametr]['name'];
      /* Location */
      $location = "../Uploaded_images/" . $filename;
      $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);
      /* Valid extensions */
      $valid_extensions = array("jpg", "jpeg", "png");
      $response = 0;
      /* Check file extension */
      if (in_array(strtolower($imageFileType), $valid_extensions)) {
        /* Upload file */
        $insertphoto_to_tbl_product_photo = $mysqli->query("INSERT INTO tbl_product_photo 
      (photo,p_id) 
      VALUES  ('$filename' , '$nextid')
       ");
        if ($insertphoto_to_tbl_product_photo) {
          move_uploaded_file($_FILES[$filenametr]['tmp_name'], $location);
        }
      }
    }

    if ($size_id != "") {
      $query_add_size = $mysqli->query("INSERT INTO tbl_product_size (size_id ,p_id)
   VALUES ('$size_id','$nextid')
   ");
    }
    if ($color_id != "") {
      $query_add_color = $mysqli->query("INSERT INTO tbl_product_color (color_id ,p_id)
   VALUES ('$color_id','$nextid')
   ");
    }

    $res = [
      'status' => 200,
      'message' => "Product added succefully !"
    ];
    echo json_encode($res);
    return false;
  } else {
    $res = [
      'status' => 400,
      'message' => "Adding product failed !"
    ];
    echo json_encode($res);
    return false;
  }
} 

else if (isset($_GET["delete"])) {
  $p_id = $_POST["p_id"];
  $cheakdeletesize  = $mysqli->query("SELECT * FROM  tbl_product_size WHERE  p_id='$p_id'");
  if (mysqli_num_rows($cheakdeletesize) > 0) {
    $deletesize  = $mysqli->query("DELETE  FROM tbl_product_size WHERE  p_id='$p_id'");
  }

  $cheakdeletecolor  = $mysqli->query("SELECT * FROM  tbl_product_color WHERE  p_id='$p_id'");
  if (mysqli_num_rows($cheakdeletecolor) > 0) {
    $deletecolor = $mysqli->query("DELETE  FROM tbl_product_color WHERE  p_id='$p_id'");
  }


  $cheakdeletphoto  = $mysqli->query("SELECT * FROM  tbl_product_photo WHERE  p_id='$p_id'");
  if (mysqli_num_rows($cheakdeletphoto) > 0) {
    $deletephoto = $mysqli->query("DELETE  FROM tbl_product_photo WHERE  p_id='$p_id'");
  }

  $deletequery = $mysqli->query(" DELETE  FROM  tbl_product WHERE 
 p_id='$p_id'
");

  if ($deletequery) {

    $res = [
      'status' => 200,
      'message' => "Product deleted sucessfully!"
    ];
    echo json_encode($res);
    return false;
  } else {

    $res = [
      'status' => 400,
      'message' => "Deleting product failed "
    ];
    echo json_encode($res);
    return false;
  }
} else if (isset($_GET["addphoto"])) {
  $filename = $_FILES['file']['name'];
  $P_id =  $_POST["P_id"];

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
      $insertinto_photo_table = $mysqli->query("INSERT INTO tbl_product_photo 
              (photo , p_id) VALUES ('$filename' , '$P_id')
              ");
      if ($insertinto_photo_table) {
        $res = [
          'status' => 200,
          'message' => " Photo added succesfuly!"
        ];
        echo json_encode($res);
        return false;
      } else {
        $res = [
          'status' => 400,
          'message' => "Adding photo Failed !"
        ];
        echo json_encode($res);
        return false;
      }
    } else {
      $res = [
        'status' => 404,
        'message' => "Uploading photo Failed!"
      ];
      echo json_encode($res);
      return false;
    }
  }
} else if (isset($_GET["editphoto"])) {

  $filename = $_FILES['file']['name'];
  $P_id =  $_POST["P_id"];

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
      $update_photo = $mysqli->query("UPDATE  tbl_product 
      SET p_featured_photo='$filename'  WHERE p_id='$P_id'
      ");
      if ($update_photo) {
        $res = [
          'status' => 200,
          'message' => " Photo Updated succesfuly!"
        ];
        echo json_encode($res);
        return false;
      } else {
        $res = [
          'status' => 400,
          'message' => "Updating photo Failed !"
        ];
        echo json_encode($res);
        return false;
      }
    } else {
      $res = [
        'status' => 404,
        'message' => "Updating photo Failed!"
      ];
      echo json_encode($res);
      return false;
    }
  }
}  else if (isset($_GET['Update'])) {

  $size_id = $_POST["size"];
  $color_id = $_POST["color"];
  //cheak size and color 
  $productname = trim($mysqli->real_escape_string($_POST["P_name"]));
  $O_price = $mysqli->real_escape_string($_POST["O_price"]);
  $C_price = $mysqli->real_escape_string($_POST["C_price"]);
  $qunatity = $mysqli->real_escape_string($_POST["qunatity"]);
  $topcatid = $mysqli->real_escape_string($_POST["topcatid"]);
  $midcatid = $mysqli->real_escape_string($_POST["midcatid"]);
  $endcatid = $mysqli->real_escape_string($_POST["endcatid"]);
  $view = 0;
  $isfetured = $_POST["isfetured"];
  $isactive = $_POST["isactive"];
  $Description = trim($mysqli->real_escape_string($_POST["Description"]));
  $ShortDes = $mysqli->real_escape_string($_POST["ShortDes"]);
  $Fetures = trim($mysqli->real_escape_string($_POST["Fetures"]));
  $Conditions = trim($mysqli->real_escape_string($_POST["Conditions"]));
  $ReturnPolicy = trim($mysqli->real_escape_string($_POST["ReturnPolicy"]));
  $ShortDes = trim($mysqli->real_escape_string($_POST["ShortDes"]));
  $product_fetured_photo = $_FILES["file1"]["name"];
  $p_id =$_POST["p_id"] ; 

  $cheakquery_duplicate = $mysqli->query("SELECT *  FROM tbl_product WHERE p_name = '$productname' AND  ecat_id = '$endcatid' ");
  if (mysqli_num_rows($cheakquery_duplicate) > 1) {
    $res = [
      'status' => 405,
      'message' => "This product is Already exist  !"
    ];
    echo json_encode($res);
    return false;
  }
   else {
  $updateproduct  = $mysqli->query("UPDATE  tbl_product  SET
   p_name='$productname',
   p_old_price ='$O_price',
   p_current_price = '$C_price',
   p_qty = '$qunatity',
   p_description = '$Description' ,
   p_short_description ='$ShortDes',
   p_feature = '$Fetures',	
   p_condition = '$Conditions',
   p_return_policy='$ReturnPolicy',
   p_is_featured = '$isfetured' ,
   p_is_active  ='$isactive', 
   tcat_id= '$topcatid', 
   mcat_id ='$midcatid',
   ecat_id = '$endcatid'
   WHERE  p_id = '$p_id'" );
  if ($updateproduct) {
    $res = [
      'status' => 200,
      'message' => "Product Updated succefully !"
    ];
    echo json_encode($res);
    return false;
  } else {
    $res = [
      'status' => 404,
      'message' => "Updating product failed !"
    ];
    echo json_encode($res);
    return false;
  }
   }
}

?>