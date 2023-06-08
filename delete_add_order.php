<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:http://shop.test/not_found_page.php'));
}
include "./config_database.php" ;


function getNextIncrement($table)
{
    $sql_db_host = "localhost"; // MySQL Hostname
    $sql_db_user = "root"; // MySQL Database User
    $sql_db_pass = ""; // MySQL Database Password
    $sql_db_name = "EcommerceWebsite"; // MySQL Database Name
    $conn = new mysqli($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name);

    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
    $next_increment = 1;
    $table = mysqli_escape_string($conn, $table);
    $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$sql_db_name' AND TABLE_NAME = '$table'";
    $results = $conn->query($sql);
    while ($row = $results->fetch_assoc()) {
        $next_increment = $row['AUTO_INCREMENT'];
    }
    return $next_increment;
}


if (isset($_GET['add_order'])) {
    $user_id = $_POST['user_id'];
    $address_id = $_POST['address_id'];
    $status = $_POST['status'];
    $query  =  $mysqli->query("INSERT INTO orders (user_id,address_id,status) VALUES
    ('$user_id' , '$address_id' , '$status') 
    ");
    if ($query) {
        $query2 = $mysqli->query("SELECT * FROM cart WHERE user_id='$user_id'") ;
        while($row2 = mysqli_fetch_assoc($query2)) {
        $next_order =  getNextIncrement('orders')-1; 
        $query3 = $mysqli->query("INSERT INTO order_product  (order_id ,p_id) VALUES
        ('$next_order' , '$row2[p_id]')
        ") ;
        }

        if ($query3) {
            $query_delete_cart =$mysqli->query("DELETE FROM cart WHERE user_id='$user_id'") ;
            if ($query_delete_cart) {
                $res = [
                    'status' => 200,
                  ];
                  echo json_encode($res);
                  return false;
            }else {
                $res = [
                    'status' => 400,
                  ];
                  echo json_encode($res);
                  return false;
            }
        } else {
            $res = [
                'status' => 400,
              ];
              echo json_encode($res);
              return false;
        }

        

        
    }
}
