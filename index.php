<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
session_start();
include "./header.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="./slick-1.8.1/slick/slick-theme.css" />
    </link>

    <title>Homepage</title>
    <style>
        .slider {
            width: 100%;
            height: 500px;
            opacity: 0.9;
            position: relative;
            top: 150px;
        }

        .slider .heading {
            position: absolute;
            height: auto;
            width: auto;
            font-size: 60px;
            color: black;
            margin: auto;
            top: 30%;
            transform: translateX(45%);
            font-weight: 700;

        }

        .bk {
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/opacity/see-through */
            position: absolute;
            z-index: 8000;
            width: 100%;
            height: 100%;
        }

        .s {
            position: relative;
        }


        .slick-dots {
            color: black;
            font-size: 30px !important;
        }

        .blur {
            background-color: gray;
        }

        .content {
            font-size: 16px !important;
        }

        .btnurl {
            margin-top: 30px;
        }

        @media all and (max-width: 1255px) {
            .slider {
                height: 400px !important;
            }
        }

        @media all and (max-width: 1300px) {
            .slider .heading {
                transform: translateX(35%);
                font-weight: 500;
            }

        }

        @media all and (max-width: 1050px) {
            .slider .heading {
                transform: translateX(15%);
                font-weight: 400;
                font-size: 50px;

            }

        }

        @media all and (max-width: 836px) {
            .slider .heading {
                transform: translateX(5%);
                font-weight: 400;
                font-size: 45px;

            }

        }

        @media all and (max-width: 730px) {
            .slider .heading {
                width: 400px !important;
            }

            .slider {
                height: 300px !important;
            }

            .slider .heading {
                font-weight: 350;
                font-size: 35px;
            }

        }

        .slider:hover .slick-prev {
            transition: all 2s;
            display: block;
            visibility: visible;
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

        .services {
            margin: 140px auto;
            background-color: #FFFFFF;
            text-align: center;
        }

        .title {
            font-size: 25px;
        }

        .content {
            font-size: 13px !important;
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

        .pr_name_find{
        text-align: center;
        }

        .pborder{
        border: solid 1px gray;
        }
     
    </style>
</head>

<body>
    <br>
    <?php
    if (isset($_GET["tcat_id"]) ||  isset($_GET["mid_category"]) || isset($_GET["ecat_id"])) {
    ?>
        <div class="products_by_menue container">
        <div class="row">
        <?php  
        if ($_GET['tcat_id']) {
        $query_index = $mysqli->query("SELECT * FROM tbl_product WHERE  tcat_id = $_GET[tcat_id]");
        }

        if ($_GET['mid_category']) {
            $query_index = $mysqli->query("SELECT * FROM tbl_product WHERE  mcat_id = $_GET[mid_category]");
        }

        if ($_GET['ecat_id']) {
            $query_index = $mysqli->query("SELECT * FROM tbl_product WHERE  ecat_id = $_GET[ecat_id]");
        }        
       if (mysqli_num_rows($query_index) > 0)  {
            while ($r = mysqli_fetch_assoc($query_index)) {

                echo  "<div class='col-4 p-4 pr_name_find pborder'>" ;
                echo "<a href=showproduct.php?p_id=" . $r["p_id"] . ">";
                echo  '<div class="pr">
         <img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="200px" height="200px"> ';
                echo   "<br><br><br>
                <span class='p_name'>" . $r["p_name"] . "</span>";
                echo  ' </div>';
                echo "</a>";
                echo  "</div>" ;
        }

       }else {
       echo "there is not any products in this filed  !";
       }
    
        ?>
        </div>

      

        
        </div>
        <?php include "./footer.php" ;?>

    <?php
    } else {


    ?>

        <div class="slider">
            <?php
            $query  = $mysqli->query("SELECT *  FROM tbl_slider ");
            while ($r = mysqli_fetch_assoc($query)) {
                echo "<a href=" . $r["button_url"] . ">";
                echo  '<div>';
                echo  "<div class='image_pr'>";
                echo    '<img src="./Uploaded_images/' . $r["photo"] . '"alt="" width="100%" height="500px">';
                echo  "</div>";
                echo "<div class='heading'>";
                echo $r["heading"];
                echo   "</div>";
                echo "<div class='content'>" . $r["content"] . "</div>";
                echo  '</div>';
                echo "</a>";
            }
            ?>
            <button type="button" class="slick-next"></button>
            <button type="button" class="slick-prev"></button>
        </div>
        <br>
        <br>
        <br>
        <div class="services">
            <div class="row">
                <?php
                $counter = 1;
                $servicequery  = $mysqli->query("SELECT * FROM tbl_service");
                while ($service = mysqli_fetch_assoc($servicequery)) {
                    if ($counter == 4) {
                        echo  "</div>";
                        echo "<div class='row  mt-4'>";
                    }
                    echo "<div class='col-sm'>";
                    echo "<img  width='150px' height='150px'  src='./Uploaded_images/" . $service["photo"] . "'>";
                    echo "<div class='title'>";
                    echo  $service["title"];
                    echo "</div>";
                    echo "<span class='content'>";
                    echo  $service["content"];
                    echo "</span>";
                    echo "</div>";
                    $counter++;
                }
                ?>
            </div>
        </div>

        <div class="slider1_p  p_slider">
            <h1 class="fetured_p">Fetured Produts</h1>
            <span class="Fetured_product_slider pr_name_find">
                <?php
                $query  = $mysqli->query("SELECT *  FROM  tbl_product ");
                while ($r = mysqli_fetch_assoc($query)) {
                    echo "<a href=showproduct.php?p_id=" . $r["p_id"] . ">";
                    echo  '<div class="pr">
             <img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="200px" height="200px"> ';
                    echo   "<br><br><br>
                    <span class='p_name'>" . $r["p_name"] . "</span>";
                    echo  ' </div>';
                    echo "</a>";
                }
                ?>
            </span>
        </div>
        <br>
        <br>
        <br>
        <div class="slider1_p  p_slider">
            <h1 class="fetured_p">Latest Produts</h1>
            <span class="Fetured_product_slider pr_name_find">
                <?php
                $query  = $mysqli->query("SELECT *  FROM  tbl_product ORDER BY p_id DESC LIMIT 10");
                while ($r = mysqli_fetch_assoc($query)) {
                    echo "<a href=showproduct.php?p_id=" . $r["p_id"] . ">";
                    echo  '<div class="pr">
             <img src="./Uploaded_images/' . $r["p_featured_photo"] . '"alt="" width="200px" height="200px"> ';
                    echo   "<br><br><br>
                    <span class='p_name'>" . $r["p_name"] . "</span>";
                    echo  ' </div>';
                    echo "</a>";
                }
                ?>
            </span>
        </div>
        <br>
        <br>
        <?php include "./footer.php" ?>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="./slick-1.8.1/slick/slick.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('.slider').slick({
                    dots: true
                });


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
            });
        </script>
      
</body>

</html>

<?php
    }
?>