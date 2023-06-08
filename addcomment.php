<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  header('HTTP/1.0 403 Forbidden', TRUE, 403);
  die(header('location:http://shop.test/not_found_page.php'));
}


include "./config_database.php";
$title  = $_POST["title"];
$opinion = $_POST["opinion"];
$opinion = htmlentities(htmlspecialchars($opinion));

$activecoise = trim($_POST["activecoise"]);
$activecoise = preg_replace('/\s+/', '', $activecoise);
$pos_array = $_POST["pos_array"];
$neg_array = $_POST["neg_array"];
$user_id = $_POST["user_id"];
$p_id = $_POST["p_id"];
$date  = $_POST["date"];
$score  = 0;


if (is_null($pos_array)) {
  $pos_array = "";
} else {
  for ($i = 0; $i < count($pos_array); $i++) {
    $positive_op .= "<li> <i class='bx bx-plus-medical' style='color:green;font-size:15px;padding:10px'></i> " . $pos_array[$i] . " </li> ";
    $positive_op = htmlentities(htmlspecialchars($positive_op));
  };
}


if (is_null($neg_array)) {
  $pos_array = "";
} else {
  for ($i = 0; $i < count($neg_array); $i++) {
    $negative_op .=  "<li><i class='bx bx-minus'  style='color:red;font-size:15px;padding:10px;font-weight:300'></i>" . $pos_array[$i] . "</li>";
    $negative_op = htmlentities(htmlspecialchars($negative_op));
  };
}


switch ($activecoise) {
  case  "Verygood":
    $score = 5;
    break;

  case  "Good":
    $score = 3.5;
    break;

  case  "Medium":
    $score = 2;
    break;

  case  "VeryBad":
    $score = 1;
    break;
}

$query  = $mysqli->query("INSERT INTO  comment 
  (p_id,user_id,comment_likes,comment_dislike,title,rate,positive_points,negative_points,idea,date)
  VALUES  ('$p_id','$user_id',0,0,'$title','$score','$positive_op','$negative_op','$opinion','$date')");

if ($query) {
  $res = [
    'status' => 200,
    'message' => " Succefully added !"
  ];
  echo json_encode($res);
  return false;
} else {
  $res = [
    'status' => 400,
    'message' => " failed !"
  ];
  echo json_encode($res);
  return false;
}
