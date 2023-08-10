<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

include "./config_database.php";
$p_id = $_GET["p_id"];

$query6  = $mysqli->query("SELECT * FROM comment WHERE p_id='$p_id'");
$numberof_comment  = mysqli_num_rows($query6);
$user_id = $_SESSION["USER_ID"];

$querycheak = $mysqli->query("SELECT * FROM  recentcheak WHERE userid='$user_id' AND productid='$p_id'");
if (mysqli_num_rows($querycheak) == 0  && isset($p_id)  && isset($user_id)) {
    $query_add = $mysqli->query("INSERT INTO recentcheak (userid,productid) 
   VALUES  ('$user_id','$p_id')
  ");
}
if (isset($_GET["addcart"])) {
    $userid = $_POST['userid'];
    $p_id = $_POST["p_id"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $query  = $mysqli->query("INSERT INTO cart  (user_id,p_id,quantity,price) VALUES 
    ('$userid', '$p_id' , '$quantity' , '$price')
  ");
    if ($query) {
        $res = [
            'status' => 200,
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 400,
            'message' => " Error just acuured!"
        ];
        echo json_encode($res);
        return false;
    }
}


$query = $mysqli->query("SELECT * FROM  tbl_product WHERE p_id='$p_id'");
while ($r = mysqli_fetch_assoc($query)) {
    $pname  = $r["p_name"];
    $ecat_id = $r["ecat_id"];
}
if (isset($p_id)) {
    include "./header.php";
} else {
    header("location:index.php?pidfaield");
}
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Bootstrap CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="./slick-1.8.1/slick/slick-theme.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #navbar2 {
            width: 100%;
            color: gray;
            padding: 10px;
            border-bottom: solid gray 1px;
            background-color: white !important;
            font-size: 15px;
        }

        #navbar2 a {
            text-decoration: none;
            color: gray;
            font-weight: bold;
            margin-left: 20px;
        }

        #navbar2 .active {
            border-bottom: solid red 5px;
            border-radius: 5px;
            padding: 10px;
            color: red;
        }

        .page {
            min-height: 100px;
            display: flex;
            flex-direction: column;
            font-size: 2rem;
            padding: 20px;
        }

        #home {
            background-color: #eee;
        }

        #about {
            background-color: #ccc;
        }

        #services {
            background-color: #aaa;
        }

        #contact {
            background-color: #888;
        }

        .product {
            width: 98%;
            height: auto;
            border: solid 1px #E0E0E0;
            margin: 170px auto;
            border-radius: 5px;
            padding: 10px;
        }

        .pictures {
            margin-top: 40px;

        }

        .dots {
            position: absolute;
        }


        #add_to_cart {
            width: 400px;
            height: auto;
            background-color: #F6F6F7;
            border-radius: 5px;
            padding: 10px;
            border: solid gray 1px;
            z-index: 100;
        }

        .addtocartbtn {
            background-color: #EE4055;
            cursor: pointer;
            color: white;
            outline: none;
            width: 200px;
            height: 40px;
            line-height: 40px;
            border-radius: 10px;
            font-size: 17px;
            text-align: center;
            margin-top: 10px;
        }

        .open_add_comment_btn {
            color: #EE4055;
            border: solid #EE4055 1px;
            text-align: center;
            font-size: 17px;
            width: 200px;
            height: 40px;
            border-radius: 10px;
            line-height: 40px;
            cursor: pointer;
            margin-top: 10px;

        }

        .range-selector {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            font-size: 14px;
            font-weight: bold;
        }

        label {
            flex-grow: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            color: #999;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked+label {
            color: #007bff;
            background-color: #eee;
        }

        #addcomment_form input {
            width: 80%;
            height: 40px;
            border-radius: 5px;
            border: solid gray 1px;
            padding: 10px;
            outline: none;
            margin-top: -15px;
            font-size: 16px;
        }

        #addcomment_form label {
            font-size: 18px;
        }

        .addpoint {
            position: relative;
        }

        .addbtn {
            position: absolute;
            right: 80px;
            bottom: 10px;
            font-size: 18px;
        }

        .pos_points_ul {
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .neg_points_ul {
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .neg_points_ul li {
            padding: 5px;
            height: 20px;
            min-width: 300px;
        }

        .pos_points_ul li {
            padding: 5px;
            height: 20px;
            min-width: 300px;
        }

        .delete_btn_positive {
            float: right;
            font-size: 18px;
            color: red;
        }

        .delete_btn_negitive {
            float: right;
            font-size: 18px;
            color: red;
        }

        .message {
            width: 200px;
            height: 100px;
            padding: 10px;
            color: black;
            background-color: #EF4056;
            border-radius: 5px;
            font-size: 17px;
            position: fixed;
            top: 30px;
            z-index: 8000;
            left: 50%;
            transform: translateX(-50%);
            display: none;
        }

        .score {
            width: 50px;
            height: 20px;
            border: solid black 1px;
            border-radius: 5px;
            text-align: center;
            line-height: 20px;
            display: inline-block;
        }

        li {
            list-style: none;
        }

        .discuss_comments_in_categories {
            height: auto;
            border-radius: 5px;
            width: 90%;
            padding: 5px;
        }

        .for_rate {
            border: solid #E0E0E5 1px;
            border-radius: 5px;
            color: black;
            height: auto;
            line-height: 30px;
            width: 100%;
            margin-top: 10px;
            padding-left: 10px;
            width: 250px;
        }

        .rate_bar {
            width: 230px;
            border: solid black 1px;
            border-radius: 5px;
            height: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            background-color: #E0E0E5;
        }

        .rating {
            font-size: 30px;
        }

        .star {
            color: #ccc;
            cursor: pointer;
        }

        .gold {
            color: gold;
        }

        #navbar2 a.activ {
            border-bottom: 2px #EE4055 solid;
        }

        .slider:hover .slick-next {
            transition: all 2s;
            display: block;
            visibility: visible;
        }

        .p_slider:hover .slick-prev {
            transition: all 1s;
            display: block;
            visibility: visible;
        }

        .p_slider:hover .slick-next {
            transition: all 1s;
            display: block;
            visibility: visible;
        }

        .Fetured_product_slider {
            margin-top: 40px;
            height: 400px;
            padding: 10px;

        }


        .fetured_p {
            text-align: center;
        }

        .Fetured_product_slider div {
            border-right: solid #E0E0E0 1px;
            margin-top: 2px;
            cursor: pointer;
            height: 350px;
        }

        .Fetured_product_slider .pr:hover {
            box-shadow: 1px 1px 1px 1px #E0E0E0;
            transform: translateY(-10px);
        }

        .slick-initialized .slick-slide {
            color: #FFF;
        }

        .slick-next,
        .slick-prev {
            z-index: 5;

        }

        .slick-next {
            right: 15px;
            display: none;
            visibility: hidden;
        }

        .slick-prev {
            left: 15px;
            display: none;
            visibility: hidden;
        }

        .slick-next:before,
        .slick-prev:before {
            color: #000;
            font-size: 26px;
        }

        .slider1_p {
            border: solid #E0E0E0 1px;
            width: 95%;
            margin: auto;
            border-radius: 10px;
        }

        .p_name {
            font-size: 15px;
            color: black;
            padding: 20px;
        }

        .products_by_menue {
            margin-top: 140px;
        }

        .samepr img {
            padding: 20px;
            border: solid #E0E0E0 1px;
            border-radius: 5px
        }

        .samepr a {
            text-decoration: none;
            color: black;
        }

        .pr a:hover {
            text-decoration: none;
        }

        .p_name {
            padding: 20px;
            width: 200px;
        }

        .log-in {
            color: #EE4055;
            text-decoration: none;
        }

        .log-in:hover {
            color: #EE4055;
            text-decoration: none;
        }

        .log-div {
            border: solid #EE4055 1px;
            border-radius: 5px;
            color: #EE4055;
            font-size: 15px;
            width: 100px;
            padding: 5px;
            margin-top: 20px;
            text-align: center;
            cursor: pointer;
        }

        .quality {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .price2 {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .original {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .size {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .garanty {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .similarity {
            background-color: #4CAF4F;
            height: 8px;
            border-radius: 5px;
            width: 0;
        }

        .login a {
            text-decoration: none;
            color: #EE4054;
            font-size: 18px;

        }

        .login a:hover {
            text-decoration: none;
            color: #EE4054;
            font-size: 18px;
        }

        .add_to_favorite {
            width: 100px;
            height: 40px;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #3F4063;
            color: white;
            border-radius: 5px;
            line-height: 40px;
            z-index: 20000;
            font-size: 16px;
            text-align: center;
            display: none;
            visibility: hidden;
        }

        .bx-heart:hover .add_to_favorite {
            display: block;
            visibility: visible;
        }
    </style>
</head>

<body>

    <div class="message"></div>
    <div class="product">
        <div class="row">
            <div class="flex-auto  flex-col  ml-5">
                <?php
                include "./admin/functions/ecat_id_to_catgeory.php";
                $query = $mysqli->query("SELECT * FROM   tbl_product  WHERE p_id = '$p_id'");
                while ($row = mysqli_fetch_assoc($query)) {
                    $ecat_id = $row["ecat_id"];
                };
                echo  "<span  style='font-size:15px ; color:gray'>" .  Convert_ecatid_tocatgeory($ecat_id, 2) . "</span>";
                ?>
                <div class="pictures" style="position: relative;" id="pic">
                    <?php  
                    $query = $mysqli->query("SELECT * FROM favorite WHERE user_id='$_SESSION[USER_ID]' AND p_id='$p_id'");
                    if(mysqli_num_rows($query) > 0) {
                    ?>
                    <i class='bx bxs-heart' style="font-size:20px;color:red;position:relative">
                        <div class="add_to_favorite">Add Favorite</div>
                    </i>

                    <?php   } else { ?> 
                        <i class='bx bx-heart' style="font-size:20px;color:red;position:relative">
                    </i>
                        <?php   } ?>


                    <div class="slider" style="width:300px">
                        <?php
                        $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                        while ($r = mysqli_fetch_assoc($query)) {
                            echo  "<div class='image_pr'>";
                            echo    '<img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="300px" height="300px">';
                            echo  "</div>";
                        }
                        $query2  = $mysqli->query("SELECT *  FROM  tbl_product_photo WHERE  p_id='$p_id' ");
                        if (mysqli_num_rows($query2) > 0) {
                            while ($r2 = mysqli_fetch_assoc($query2)) {
                                echo  "<div class='image_pr'>";
                                echo    '<img src="./Uploaded_images/' . $r2["photo"] . '"alt="" width="300px" height="300px">';
                                echo  "</div>";
                            }
                        }
                        ?>

                    </div>

                </div>

                <?php
                $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                while ($r = mysqli_fetch_assoc($query)) {
                    echo    '<img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="60px" height="60px">';
                }
                $query2  = $mysqli->query("SELECT *  FROM  tbl_product_photo WHERE  p_id='$p_id' ");
                if (mysqli_num_rows($query2) > 0) {
                    while ($r2 = mysqli_fetch_assoc($query2)) {
                        echo    '<img src="./Uploaded_images/' . $r2["photo"] . '"alt="" width="60px" height="60px">';
                    }
                }
                ?>
            </div>


            <div class="col   ml-3" style="padding :10px ">
                <?php
                $query2  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                while ($r2 = mysqli_fetch_assoc($query2)) {
                    echo  "<span style='font-size : 17px ;color:gray'>"  . $r2["p_short_description"] . "</span>";
                    $cheakcolor = $mysqli->query("SELECT * FROM tbl_product_color WHERE p_id='$p_id'");
                    if (mysqli_num_rows($cheakcolor) > 0) {
                        while ($rowcheak  = mysqli_fetch_assoc($cheakcolor)) {
                            $color_id = $rowcheak["color_id"];
                            $colorname  = $mysqli->query("SELECT * FROM  tbl_color WHERE  color_id='$color_id'");
                            while ($colornamerow = mysqli_fetch_assoc($colorname)) {
                                $colornametowshow = $colornamerow["color_name"];
                            }
                            echo " <span style='font-size:20px'> Color </span>: " .  $colornametowshow;
                        }
                    }
                    echo " <div style='font-size:20px'> Condition : </div> ";
                    echo  $r2["p_condition"];
                };
                ?>
            </div>
            <div class="col-lg">
                <div class="gray-box">

                    <?php
                    $queryy  = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                    while ($rr = mysqli_fetch_assoc($queryy)) {
                        $active_or_not  = $rr["p_is_active"];
                        if ($active_or_not == "1") {
                            echo  "<i class='bx bx-package' style='font-size:20px ; padding:5px;color:#3F4063'></i>";
                            echo  "This Product is Available  ";
                            echo  "<ul>";
                            echo  "<li class='pl-4  pt-2'>";
                            echo "Delivier by Shoppie ";
                            echo  "</li>";
                            echo  "<li class='pl-4  pt-2'>";
                            echo "Express Deliviery by Shoppie ";
                            echo  "</li>";
                            echo  "</ul>";
                            echo  "<i class='bx bx-shield-alt-2' style='color:#3F4063'></i> Garanty Shield for Products ";
                        } else {
                            echo  "This Product is not  Available  ";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <div>
        <div id="navbar2">
            <a href="#page1">Introduction</a>
            <a href="#page2">Specific Сheak</a>
            <a href="#page3">Fetures</a>
            <a href="#page4">Comments</a>
            <a href="#page5" style="display: none;"></a>

        </div>
        <!-- Four pages -->
        <div id="page1" class="page">
            <h2 style="color:red">Introduction </h2>
            <div class="row">
                <div class="col-md-8">
                    <?php
                    $queryyfor_intro  = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                    while ($R = mysqli_fetch_assoc($queryyfor_intro)) {
                        echo  "<span style='font-size:15px'>"   . $R['p_description'] . "</span>";
                    }
                    ?>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div id="add_to_cart">
                        <div class="feturepic">

                            <div class="row">

                                <div class="col-4">
                                    <?php
                                    $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                                    while ($r = mysqli_fetch_assoc($query)) {
                                        echo  "<div class='image_pr' style='padding:10px'>";
                                        echo    '<img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="100px" height="100px">';
                                        echo  "</div>";
                                    }
                                    ?>
                                </div>


                                <div class="col-8">
                                    <?php
                                    $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");

                                    while ($r = mysqli_fetch_assoc($query)) {
                                        echo "<span style='font-size:15px;'>" . $r['p_name'] . "</span>";
                                    }  ?>
                                    <div><i class='bx bx-shield-alt-2' style="font-size: 17px;color:#3F4063"></i>
                                        <span style="font-size: 15px;"> Garenty for 18 month </span>
                                    </div>
                                    <?php
                                    $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                                    while ($r = mysqli_fetch_assoc($query)) {
                                        if ($r['p_is_active'] == "1") {
                                            echo  '<i class="bx bxs-check-square" style="font-size: 17px;color:#3F4063"></i>';
                                            echo    "<span style='font-size: 15px;'> This product is available  </span>";
                                        } else {
                                            echo    "<span style='font-size: 15px;'> This product is not  available  </span>";
                                        }
                                    }
                                    ?>
                                    <div>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="price">
                                    <?php
                                    $query  = $mysqli->query("SELECT *  FROM tbl_product WHERE  p_id='$p_id' ");
                                    while ($r = mysqli_fetch_assoc($query)) {
                                        echo   "<span style='font-size:20px;padding:30px'>" . $r['p_current_price'] . " $ </span>";
                                    }
                                    ?>
                                </div>
                                <div class="button_for_cart" id="button_for_cart">
                                    <?php if (isset($_SESSION['USER_ID'])) { ?>
                                        <?php
                                        $query = $mysqli->query("SELECT * FROM cart WHERE user_id='$user_id' AND p_id='$p_id'");
                                        if (mysqli_num_rows($query)  == 1) {
                                        ?>
                                            <span style="color:#EE4054 ; font-size:18px">Already added</span>
                                        <?php  } else {
                                        ?>
                                            <div class="addtocartbtn"> Add to Cart </div>
                                        <?php   } ?>


                                    <?php } else { ?>
                                        <div class="login"> <a href="./login.php"> Login </a> </div>
                                    <?php  } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="page2" class="page">
            <h2 style="color:red">Specific Сheak </h2>
            <div class="row">
                <div class="col-md-8">
                    <?php
                    $queryyfor_intro  = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                    while ($R = mysqli_fetch_assoc($queryyfor_intro)) {
                        echo  "<span style='font-size:15px'>"   . $R['p_short_description'] . "</span>";
                        echo  "<span style='font-size:15px'>"   . $R['p_condition'] . "</span>";
                    }
                    ?>
                    <hr>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div id="page3" class="page">
            <h2 style="color:red">Fetures </h2>
            <div class="row">
                <div class="col-md-8">
                    <?php
                    $queryyfor_intro  = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$p_id'");
                    while ($R = mysqli_fetch_assoc($queryyfor_intro)) {
                        echo  "<span style='font-size:16px;padding:10px'>"   . $R['p_feature'] . "</span>";
                    }
                    ?>
                    <hr>
                </div>

                <div class="col-md-4">
                </div>
            </div>

        </div>

        <div id="page4" class="page">
            <h2 style="color:red">Comments </h2>
            <hr>
            <?php if (isset($_SESSION['USER_ID'])) {
            ?>
                <?php
                $query  = $mysqli->query("SELECT * FROM comment WHERE p_id='$p_id'");
                if ($numberof_comment > 0) {
                ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="discuss_comments_in_categories" id="comment_analise">
                                <div class="average-rate">
                                    <?php
                                    $rate_from_5 = 0;
                                    if ($numberof_comment > 0) {
                                        while ($r = mysqli_fetch_assoc($query6)) {
                                            $rate_from_5 += $r["rate"];
                                        }
                                        $average_rate  = $rate_from_5 / $numberof_comment;
                                        echo  $average_rate . "<span style='font-size:14px;color:gray;padding:10px'>from / 5 </span>";
                                        $average_rate = ceil($average_rate);
                                    }
                                    ?>
                                    <div class="rating">
                                        <span class="star" id="star1">&#9734;</span>
                                        <span class="star" id="star2">&#9734;</span>
                                        <span class="star" id="star3">&#9734;</span>
                                        <span class="star" id="star4">&#9734;</span>
                                        <span class="star" id="star5">&#9734;</span>
                                    </div>
                                    <div class="total-comments" style="font-size:14px;color:gray">From total comments <?php echo $numberof_comment; ?></div>
                                </div>
                                <div style="font-size: 15px;color:#595C7A ; position:relative" class="for_rate">Quality and performance
                                    <div class="rate_bar">

                                        <?php
                                        $quality_rate =  0;
                                        $sql1 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%quality%'  ");
                                        $number_of_quality_comment  = mysqli_num_rows($sql1);


                                        if (mysqli_num_rows($sql1) > 0) {
                                            while ($row1 = mysqli_fetch_assoc($sql1)) {
                                                $quality_rate += $row1["rate"];
                                            }
                                        } else {
                                            $quality_rate = 0;
                                        }    ?>
                                        <div class="quality"> </div>
                                    </div>
                                    <span style="position:absolute;top:5;right:10"> <?php echo $number_of_quality_comment; ?></span>

                                </div>
                                <div style="font-size: 15px;color:#595C7A;position:relative" class="for_rate"> Price and worth of buying
                                    <div class="rate_bar">
                                        <?php
                                        $price_rate =  0;
                                        $sql2 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%price%'  ");
                                        $number_of_price_comment  = mysqli_num_rows($sql2);

                                        if (mysqli_num_rows($sql2) > 0) {
                                            while ($row2 = mysqli_fetch_assoc($sql2)) {
                                                $price_rate += $row2["rate"];
                                            }
                                        } else {
                                            $price_rate = 0;
                                        }    ?>
                                        <div class="price2"> </div>
                                    </div>
                                    <span style="position:absolute;top:5;right:10;"> <?php echo $number_of_price_comment ?></span>
                                </div>



                                <div style="font-size: 15px;color:#595C7A;position:relative" class="for_rate"> Original
                                    <div class="rate_bar">
                                        <?php
                                        $o_rate =  0;
                                        $sql3 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%original%'  ");
                                        $number_of_o_comment  = mysqli_num_rows($sql3);

                                        if (mysqli_num_rows($sql3) > 0) {
                                            while ($row3 = mysqli_fetch_assoc($sql3)) {
                                                $o_rate += $row3["rate"];
                                            }
                                        } else {
                                            $o_rate = 0;
                                        }    ?>
                                        <div class="original"> </div>
                                        <span style="position:absolute;top:5;right:10;"> <?php echo $number_of_o_comment ?></span>



                                    </div>
                                </div>
                                <div style="font-size: 15px;color:#595C7A ;position:relative " class="for_rate"> Size
                                    <div class="rate_bar">
                                        <?php
                                        $size_rate =  0;
                                        $sql4 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%size%'  ");
                                        $number_of_size_comment  = mysqli_num_rows($sql4);

                                        if (mysqli_num_rows($sql4) > 0) {
                                            while ($row4 = mysqli_fetch_assoc($sql4)) {
                                                $size_rate += $row4["rate"];
                                            }
                                        } else {
                                            $size_rate = 0;
                                        }    ?>
                                        <div class="size"> </div>
                                        <span style="position:absolute;top:5;right:10;"> <?php echo $number_of_size_comment ?></span>


                                    </div>
                                </div>
                                <div style="font-size: 15px;color:#595C7A;position:relative" class="for_rate"> Garanty
                                    <div class="rate_bar">
                                        <?php
                                        $garanty_rate =  0;
                                        $sql5 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%garanty%'  ");
                                        $number_of_garanty_comment  = mysqli_num_rows($sql5);

                                        if (mysqli_num_rows($sql5) > 0) {
                                            while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                $garanty_rate += $row5["rate"];
                                            }
                                        } else {
                                            $garanty_rate = 0;
                                        }    ?>
                                        <div class="garanty"> </div>
                                        <span style="position:absolute;top:5;right:10;"> <?php echo $number_of_garanty_comment ?></span>
                                    </div>
                                </div>

                                <div style="font-size: 15px;color:#595C7A;position:relative" class="for_rate"> Similarity
                                    <div class="rate_bar">
                                        <?php
                                        $similar_rate =  0;
                                        $sql6 = $mysqli->query("SELECT * FROM comment WHERE   p_id='$p_id' AND  idea  LIKE '%similar%'  ");
                                        $number_of_similar_comment  = mysqli_num_rows($sql6);

                                        if (mysqli_num_rows($sql6) > 0) {
                                            while ($row6 = mysqli_fetch_assoc($sql6)) {
                                                $similar_rate += $row6["rate"];
                                            }
                                        } else {
                                            $similar_rate = 0;
                                        }    ?>
                                        <div class="similarity"> </div>
                                        <span style="position:absolute;top:5;right:10;"> <?php echo $number_of_similar_comment ?></span>

                                    </div>
                                </div>
                                <span style="font-size:13px;color:red;margin-top:10px">This analise about Comments is not 100% accuracy.</span>
                                <div class="open_add_comment_btn"> Submit your idea</div>

                            </div>

                        </div>
                        <div class="col-md-5">
                            <?php
                            while ($row = mysqli_fetch_assoc($query)) {
                                $userid = $row["user_id"];
                                $query_username = $mysqli->query("SELECT * FROM users WHERE id='$userid'");
                                while ($userrow = mysqli_fetch_assoc($query_username)) {
                                    $useranme  =  $userrow["name"];
                                }
                            ?>
                                <div class="headercomment">
                                    <?php
                                    $score  = $row["rate"];
                                    if ($score == 5) {
                                        echo "<span class='score' style='font-size:17px;background-color:#00FF00'>" . $score;
                                    } else if ($score == 3.5) {
                                        echo "<span class='score' style='font-size:17px;background-color:#00FF00'>" . $score;
                                    } else if ($score == 2) {
                                        echo "<span class='score' style='font-size:17px;background-color:#FF8000'>" . $score;
                                    } else if ($score == 4) {
                                        echo "<span class='score' style='font-size:17px;background-color:#CCFFCC'>" . $score;
                                    } else {
                                        echo "<span class='score' style='font-size:17px;background-color:red'>" . $score;
                                    }
                                    ?>
                                    </span>
                                    <span style="font-size:20px;padding:5px"><?php echo $row["title"]; ?></span>
                                    <span class="time" style="color:gray;font-size:16px"><?php echo $row["date"]; ?></span>
                                </div>
                                <hr>

                                <div class="opinion_coment" style="font-size:17px"> <?php echo html_entity_decode(htmlspecialchars_decode($row["idea"]));
                                                                                    ?></div>
                                <hr>
                                <div class="points">
                                    <span style="font-size: 20px;"> Positive fetures </span>
                                    <span style="font-size: 18px;">
                                        <?php echo html_entity_decode(htmlspecialchars_decode($row["positive_points"]));
                                        ?>
                                    </span>
                                    <span style="font-size: 20px;"> Negetive fetures </span>
                                    <span style="font-size: 18px;">
                                        <?php echo html_entity_decode(htmlspecialchars_decode($row["negative_points"]));
                                        ?>
                                    </span>
                                </div>
                                <hr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-3">
                                    <span style="font-size: 15px;">
                                        There is not any idea about this product !
                                    </span>
                                    <hr>
                                    <span style="font-size: 15px;">
                                        You can also add your idea about this product !
                                    </span>
                                    <div class="open_add_comment_btn"> Submit your idea</div>
                                </div>
                                <div class="col-9">
                                    <h4>You can write your idea about this product </h4>
                                    <span style="font-size: 16px;">If you buy this product you can write your idea about this produt </span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-3">
                                <span style="font-size: 15px;">
                                    You have to login to put a comment !
                                </span>
                                <hr>
                                <span style="font-size: 15px;">
                                    You can also add your idea about this product !
                                </span>
                                <a href="./login.php" class="log-in">
                                    <div class="log-div ">Login</div>
                                </a>
                            </div>
                            <div class="col-9">
                                <h4>You can write your idea about this product </h4>
                                <span style="font-size: 16px;">If you buy this product you can write your idea about this produt </span>
                            </div>
                        </div>

                    <?php } ?>


                    <div class="addcomment ">

                        <!-- Modal -->
                        <div class="modal fade" id="addcomment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Comment </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <span class="pname" style="font-size: 15px;color:gray;padding:10px"></span>

                                    <div class="modal-body">
                                        <div class="range-selector">
                                            <form method="post" id="addcomment_form">
                                                <input type="radio" name="range" id="range-well" value="well" checked>
                                                <label for="range-well">Very good</label>

                                                <input type="radio" name="range" id="range-good" value="good">
                                                <label for="range-good">Good</label>

                                                <input type="radio" name="range" id="range-medium" value="medium">
                                                <label for="range-medium">Medium</label>

                                                <input type="radio" name="range" id="range-bad" value="bad">
                                                <label for="range-bad">Very Bad </label>

                                                <div style="font-size:18px">Submit your Opinioun </div>
                                                <br>
                                                <label for="title">Title <span style="color:#EE4055">*</span> </label>
                                                <br>
                                                <input type="text" id="title" placeholder="Title">
                                                <div class="title_error" style="color:red"></div>

                                                <label for="positive_points" style="margin-top:30px">
                                                    Positve Points
                                                </label>
                                                <div class="addpoint">
                                                    <div class="addbtn  addpos_points_btn"><i class='bx bx-add-to-queue'></i></div>
                                                    <input type="text" class="pos_points">
                                                </div>
                                                <div class="error_pos_points" style="color:red"></div>
                                                <ul class="pos_points_ul">
                                                </ul>


                                                <label for="negative_points" style="margin-top:30px">
                                                    Negitive Points
                                                </label>
                                                <div class="addpoint">
                                                    <div class="addbtn  addneg_points_btn"><i class='bx bx-add-to-queue  '></i></div>
                                                    <input type="text" class="neg_points">
                                                </div>
                                                <div class="error_neg_points" style="color:red"></div>
                                                <ul class="neg_points_ul">
                                                </ul>


                                                <label for="opinioun" style="margin-top:30px">Your Opinion <span style="color:#EE4055">*</span></label>
                                                <br>
                                                <textarea name="opinioun" id="opinioun" cols="40" rows="10" style="outline:none" placeholder="Op"></textarea>
                                                <div class="opinion_error" style="color:red"></div>


                                            </form>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary   addbtn_for_comment"> Add </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>

                    </div>

        </div>
    </div>



    <div id="page5" class="page">
        <?php $query  = $mysqli->query("SELECT *  FROM  tbl_product WHERE ecat_id='$ecat_id'");
        if (mysqli_num_rows($query) > 4) {
        ?>
            <div class="slider1_p  p_slider">
                <h1 class="fetured_p" style="padding: 10px;">Same category </h1>
                <span class="Fetured_product_slider">
                    <?php
                    $query  = $mysqli->query("SELECT *  FROM  tbl_product WHERE ecat_id='$ecat_id'");
                    while ($r = mysqli_fetch_assoc($query)) {
                        echo "<a href=showproduct.php?p_id=" . $r["p_id"] . ">";
                        echo  '<div class="pr">
             <img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="200px" height="200px"> ';
                        echo   "<br>
                    <span class='p_name'>" . $r["p_name"] . "</span>";
                        echo  ' </div>';
                        echo "</a>";
                    }
                    ?>
                </span>
            </div>
        <?php
        } else {
        ?>
            <hr>
            <div class="samecategory_p" style="border: solid #E0E0E0 1px;border-radius:5px;width:97%;margin:auto ;box-shadow: 1px 1px 1px 1px  #E0E0E0 ">
                <h2 style="padding:20px;width:300px">Same Category</h2>
                <div style="border-bottom:#EF4056 solid  2px; width:200px" class="ml-4  mt-1"></div>
                <div class="slide row ">
                    <?php
                    while ($r = mysqli_fetch_assoc($query)) {
                        echo  "<span class='flex-auto  flex-col   ml-5  mt-4 '>";
                        echo "<a href=showproduct.php?p_id=" . $r["p_id"] . ">";
                        echo  '<span class="samepr">
                     <img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="200px" height="200px"> ';
                        echo "</a>";
                        echo   "<br>
                    <div class='p_name'>" . $r["p_name"] . "</div>";
                        echo "</span>";
                        echo "</span>";
                    }
                    ?>
                    <span class="flex-auto  flex-col  ml-5  mt-4 "></span>
                    <span class="flex-auto  flex-col   ml-5  mt-4 "></span>
                </div>
            </div>
        <?php
        } ?>

    </div>

    <footer>
        <?php include  "./footer.php"; ?>
    </footer>


    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./slick-1.8.1/slick/slick.min.js"></script>
    <script>
        $('.Fetured_product_slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            speed: 300,
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: true,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    </script>
    <script>
        window.onbeforeunload = function() {
            window.scrollTo(0, 0);
        }
    </script>
    <script>
        $('.slider').slick({});
        // get the element you want to make fixed
        var element = document.getElementById("navbar2");
        var addtocart = document.getElementById("add_to_cart");
        // get the offsetTop of the element
        var elementOffsetTop = element.offsetTop;
        var comment_analise = document.getElementById("comment_analise");
        // add an event listener to the window object to detect when the user scrolls
        window.onscroll = function() {
            // check if the user has scrolled down to the element
            if (window.pageYOffset >= 600) {
                if (window.pageYOffset >= 2000) {} else {
                    // set the element's position to fixed
                    element.style.position = "fixed";
                    element.style.zIndex = "200";
                    element.style.top = "150px";
                    addtocart.style.position = "fixed";
                    addtocart.style.top = "225px";
                }
            } else {
                // set the element's position back to its original position
                element.style.position = "static";
                addtocart.style.position = "static";
            }
        };

        $(".open_add_comment_btn").click(function() {
            $('#addcomment').modal('show');
            var productname = "<?php echo "About : " . $pname ?>";
            $(".pname").html(productname);
        })
        $(".addcomment_btn_b").click(function() {})
        $(".addpos_points_btn").click(function() {
            var input = $(".pos_points").val();
            if (input == "") {
                $(".error_pos_points").html("Do not leave this input empty !");
            } else {
                $(".error_pos_points").html("");
                $(".pos_points_ul").append(`<li class='pos_op'>   ${input}  <i class='bx bx-message-alt-minus delete_btn_positive'>  </i></li> `);
                $(".pos_points").val("");
            }
        })
        $(".addneg_points_btn").click(function() {
            var input = $(".neg_points").val();
            if (input == "") {
                $(".error_neg_points").html("Do not leave this input empty !");
            } else {
                $(".error_neg_points").html("");
                $(".neg_points_ul").append(`<li class='neg_op'>    ${input}  <i class='bx bx-message-alt-minus delete_btn_negitive'>  </i></li> `);
                $(".neg_points").val("");
            }
        })
        $(".pos_points_ul").on("click", ".delete_btn_positive", function() {
            $(this).parent().remove();
        });

        $(".neg_points_ul").on("click", ".delete_btn_negitive", function() {
            $(this).parent().remove();
        });
    </script>

    <script>
        const rangeSelector = document.querySelector('.range-selector');
        const labels = Array.from(rangeSelector.querySelectorAll('label'));

        function updateLabels() {
            labels.forEach((label) => {
                if (label.previousElementSibling.checked) {
                    label.classList.add('active2');
                } else {
                    label.classList.remove('active2');
                }
            });
        }
        rangeSelector.addEventListener('change', updateLabels);
        updateLabels();
    </script>

    <script>
        $(".addbtn_for_comment").click(function() {
            var activecoise = $(".active2").html();
            var title = $("#title").val().trim();
            if (title == "") {
                $(".title_error").html("title field should filled !")
                var opinion = $("#opinioun").val().trim();
                if (opinion == "") {
                    $(".opinion_error").html("title field should filled !")
                } else {
                    $(".opinion_error").html("")
                }
            } else {

                var opinion = $("#opinioun").val();
                if (opinion == "") {
                    $(".opinion_error").html("title field should filled !")
                } else {
                    $(".opinion_error").html("")
                }

                $(".title_error").html("");
                var pos_array = new Array();
                var neg_array = new Array();
                var positive_opinions = $(".pos_op");

                for (let i = 0; i < positive_opinions.length; i++) {
                    pos_array[i] = positive_opinions.eq(i).html().replace(/(<([^>]+)>)/gi, "").trim();
                }

                var neg_opinions = $(".neg_op");
                for (let i = 0; i < neg_opinions.length; i++) {
                    neg_array[i] = neg_opinions.eq(i).html().replace(/(<([^>]+)>)/gi, "").trim();
                }

                var p_id = <?php echo $p_id ?>;
                var user_id = <?php echo $_SESSION['USER_ID']; ?>;
                const date = new Date();
                const year = date.getFullYear();
                const month = date.getMonth() + 1;
                const day = date.getDate();
                const withSlashes = [year, month, day].join('/');

                $.ajax({
                    type: "post",
                    url: "addcomment.php",
                    data: {
                        title: title,
                        opinion: opinion,
                        activecoise: activecoise,
                        pos_array: pos_array,
                        neg_array: neg_array,
                        p_id: p_id,
                        user_id: user_id,
                        date: date
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            $('#addcomment').modal('hide');
                            $("#title").val("");
                            $(".pos_points_ul").children().remove();
                            $(".neg_points_ul").children().remove();
                            $("#opinioun").val("");

                            setInterval(() => $(".message").fadeOut(), 5000)

                        } else if (res.status == 400) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)

                        }
                    }
                });
            }
        })
    </script>

    <script>
        const stars = document.querySelectorAll('.star');
        let rating = <?php if (isset($average_rate)) {
                            echo $average_rate;
                        } else {
                            echo 0;
                        } ?>; // set the initial rating value here
        // color the stars according to the initial rating
        for (let i = 0; i < rating; i++) {
            stars[i].classList.add('gold');
        }
        for (let i = 0; i < stars.length; i++) {
            stars[i].addEventListener('click', function() {
                rating = i + 1; // update the rating value based on the clicked star
                // color the stars based on the new rating value
                for (let j = 0; j < stars.length; j++) {
                    if (j < rating) {
                        stars[j].classList.add('gold');
                    } else {
                        stars[j].classList.remove('gold');
                    }
                }
            });
        }
    </script>
    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar2');
            const pages = document.querySelectorAll('.page');
            const links = navbar.getElementsByTagName('a');
            let current = '';
            var numberof_comment = <?php echo  $numberof_comment; ?>;


            // Loop through pages to find the current one
            for (let i = 0; i < pages.length; i++) {
                const pageTop = pages[i].offsetTop - navbar.offsetHeight;
                const pageBottom = pageTop + pages[i].offsetHeight;
                if (window.scrollY >= pageTop - 250 && window.scrollY < pageBottom) {
                    current = pages[i].getAttribute('id');
                    if (current == "page5") {
                        navbar.style.transform = `translateY(${-60}px)`;
                    } else if (current == "page4") {
                        navbar.style.transform = `translateY(${0}px)`;
                        navbar.style.transition = `all 1s`;
                    }
                }
            }
            // Loop through links to update the active one
            for (let i = 0; i < links.length; i++) {
                if (links[i].getAttribute('href') === '#' + current) {
                    links[i].classList.add('active');
                } else {
                    links[i].classList.remove('active');
                }
            }
        });
    </script>

    <script>
        const targetDiv = document.getElementById('page4'); // replace 'my-div' with the ID of your target div
        const targetTop = targetDiv.offsetTop;
        const page4_heght = targetDiv.offsetHeight;
        const scrollAmount = targetTop - window.scrollY - 250;

        window.addEventListener("scroll", function() {

            var scrollconverter = page4_heght + scrollAmount;
            if (window.scrollY >= scrollconverter - 300) {
                document.getElementById("add_to_cart").style.position = "absolute";
                document.getElementById("add_to_cart").style.zIndex = 1;

                document.getElementById("add_to_cart").style.top = scrollconverter - 1000;
            }
            if (window.scrollY > scrollconverter - page4_heght + 100) {
                <?php
                if ($numberof_comment > 1) {
                ?>
                    document.getElementById("comment_analise").style.position = "fixed";
                    document.getElementById("comment_analise").style.top = "180px";
                <?php
                } else {
                ?>
                <?php } ?>

            } else {
                document.getElementById("comment_analise").style.position = "static";
            }
            if (window.scrollY > scrollconverter - 500) {
                <?php
                if ($numberof_comment > 1) {

                ?>
                    document.getElementById("comment_analise").style.position = "absolute";
                    document.getElementById("comment_analise").style.top = "50px";
                <?php
                } else {
                ?>
                <?php } ?>
            }


        });
    </script>


    <script>
        var quality_rate = <?php
                            if ($number_of_quality_comment > 0) {
                                echo ($quality_rate / ($number_of_quality_comment * 5)) * 100;
                            } else {
                                echo 0;
                            }
                            ?>;

        var price_rate = <?php
                            if ($number_of_price_comment > 0) {
                                echo ($price_rate / ($number_of_price_comment * 5)) * 100;
                            } else {
                                echo 0;
                            }
                            ?>;
        var o_rate = <?php
                        if ($number_of_o_comment > 0) {
                            echo ($o_rate / ($number_of_o_comment * 5)) * 100;
                        } else {
                            echo 0;
                        }
                        ?>;
        var size_rate = <?php
                        if ($number_of_size_comment > 0) {
                            echo ($size_rate / ($number_of_size_comment * 5)) * 100;
                        } else {
                            echo 0;
                        }
                        ?>;
        var g_rate = <?php
                        if ($number_of_garanty_comment > 0) {
                            echo ($garanty_rate / ($number_of_garanty_comment * 5)) * 100;
                        } else {
                            echo 0;
                        }
                        ?>;


        var s_rate = <?php
                        if ($number_of_similar_comment > 0) {
                            echo ($similar_rate / ($number_of_similar_comment * 5)) * 100;
                        } else {
                            echo 0;
                        }
                        ?>;

        $(".quality").css("width", `${quality_rate}%`);
        $(".price2").css("width", `${price_rate}%`);
        $(".original").css("width", `${o_rate}%`);
        $(".size").css("width", `${size_rate}%`);
        $(".garanty").css("width", `${g_rate}%`);
        $(".similarity").css("width", `${s_rate}%`);
    </script>

    <script>
        $('#button_for_cart').on('click', '.addtocartbtn', function() {
            $(".button_for_cart").html("<span style='color:#EE4054 ; font-size:16px'>Already added </span>")
            var userid = <?php echo $user_id  ?>;
            var p_id = <?php echo $p_id   ?>;
            var quantity = 1;
            var current_price = <?php
                                $query  = $mysqli->query("SELECT p_current_price FROM tbl_product WHERE p_id= '$p_id'");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo $row["p_current_price"];
                                }
                                ?>


            $.ajax({
                url: 'showproduct.php?addcart=true',
                type: 'post',
                data: {
                    userid: userid,
                    p_id: p_id,
                    quantity: quantity,
                    price: current_price
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        var cart_counter = $(".cart_counter").html().trim();
                        cart_counter = parseInt(cart_counter);
                        cart_counter = cart_counter + 1;
                        $(".cart_counter").html(cart_counter);
                        $("#cart").load(" #cart > *");

                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                },
            });
        })
    </script>


    <script>
        $('#pic').on('click', '.bx-heart', function() {
            console.log("clicked");
            $(this).removeClass("bx-heart");
            $(this).addClass("bxs-heart");
            var p_id = <?php echo $p_id ?>;
            var user_id = <?php echo $_SESSION['USER_ID']; ?>;

            $.ajax({
                url: 'add_delet_favorite.php?add_fav=true',
                type: 'post',
                data: {
                    user_id:user_id,
                    p_id: p_id
                },

                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                },
            });

        })
        
        $('#pic').on('click', '.bxs-heart', function() {
            $(this).removeClass("bxs-heart");
            $(this).addClass("bx-heart");
            var p_id = <?php echo $p_id ?>;
            var user_id = <?php echo $_SESSION['USER_ID']; ?>;
            $.ajax({
                url: 'add_delet_favorite.php?delete_fav=true',
                type: 'post',
                data: {
                    user_id: user_id,
                    p_id: p_id
                },

                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {

                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                },
            });

        })
    </script>




</html>