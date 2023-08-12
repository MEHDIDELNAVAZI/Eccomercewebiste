<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:http://shop.test/not_found_page.php'));
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <title>Dashboard</title>
    <style>
        .info {
            width: 300px;
            background-color:cornflowerblue;
            border-radius: 5px;
            height: 100px;
            padding: 10px;
            margin: auto;
            margin-top: 10px !important;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="row ">
        <div class="info col-sm-3">
            <h3>Total Products</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_product ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>
        </div>
        <div class="info col-sm-3">
            <h3>Total Users</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM users ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>

        </div>
        <div class="info col-sm-3">
            <h3>Total Comments </h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM comment ");
            echo  "<span  class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>


        </div>

    </div>

    <div class="row ">
        <div class="info col-sm-3">
            <h3>Total Topcategory</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_top_category ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>
        </div>
        <div class="info col-sm-3">
            <h3>Total Midcategory</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_mid_category ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>

        </div>
        <div class="info col-sm-3">
            <h3>Total Endcategory </h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_end_category ");
            echo  "<span  class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>


        </div>

    </div>



    <div class="row ">
        <div class="info col-sm-3">
            <h3>Total Colors</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_product_color ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>
        </div>
        <div class="info col-sm-3">
            <h3>Total product size</h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_product_size ");
            echo  "<span class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>

        </div>
        <div class="info col-sm-3">
            <h3>Total Socials </h3>
            <?php
            include "./config_database.php";
            $query = $mysqli->query("SELECT * FROM tbl_social ");
            echo  "<span  class='number' style='font-size:20px'>";
            echo   mysqli_num_rows($query);
            echo  "</span>";
            ?>


        </div>

    </div>


    </div>

</body>

</html>