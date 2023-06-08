<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  


#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

$user_id = $_SESSION["id"];
$login = false;
if (
    isset($_SESSION['nameuser']) &&
    isset($_SESSION['emailuser']) &&
    isset($_SESSION['passworduser']) &&
    isset($_SESSION['verifyemail']) &&
    $_SESSION['verifyemail'] == "verified"
) {
    $login = true;
} else {
    $login = false;
}


if (isset($_GET["addquantity"])) {
    $p_id = $_POST["p_id"];
    $number = intval($_POST["number"]) + 1;

    $query  = $mysqli->query("UPDATE cart SET  quantity='$number'  WHERE  user_id='$user_id' AND  p_id='$p_id' ");
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




if (isset($_GET["minusquantity"])) {
    $p_id = $_POST["p_id"];
    $number = intval($_POST["number"]) - 1;
    if ($number ==  0) {
        $query  = $mysqli->query("DELETE  FROM  cart  WHERE user_id='$user_id' AND p_id='$p_id' ");
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
    } else {
        $query  = $mysqli->query("UPDATE cart SET  quantity='$number'  WHERE  user_id='$user_id' AND  p_id='$p_id' ");
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
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Home</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        header {
            width: 100%;
            height: 90px;
            background-color: white;
            color: black;
            line-height: 50px;
            box-shadow: 0px 2px 0px 0px gray;
            position: fixed;
            top: 0;
            left: 0;
            background-color: white;
            z-index: 1000;
        }

        header a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: black;
        }

        .logo {
            font-size: 30px;
        }

        .navigationbar {
            background-color: #283546;
            position: fixed;
            top: 80px;
            margin-top: 10px;
            height: 60px;
            width: 100%;
            line-height: 60px;
            z-index: 500;
        }

        .navigationbar a:hover {
            text-decoration: none;
        }

        .navigationbar ul {
            list-style: none;
            padding: 0;
        }

        .navigationbar ul li {
            display: inline-block;
            color: gray;
        }

        .navigationbar ul li a {
            display: block;
            color: white;
            padding-right: 25px;
            font-size: 15px;
        }

        .acount {
            position: absolute;
            right: 100px;
            top: 50px;
        }

        i {
            cursor: pointer;
        }

        .userbox {
            width: 250px;
            border: solid black 1px;
            box-shadow: 2px 2px 2px 2px gray;
            border-radius: 5px;
            position: absolute;
            background-color: white;
            top: 50px;
            right: 10px;
            height: auto;
            display: none;
            visibility: hidden;
            z-index: 2000;
        }

        ul {
            padding: 0;
        }

        .profileuser {
            padding: 0;
            list-style: none;
        }

        .userbox li {
            display: block;
            text-align: right;
            transition: all 1s;
            padding: 0px;
        }

        .profileuser li a {
            margin: 0px;
            font-size: 24px;
            padding: 10px;
            width: 100%;
            display: block;
        }

        .profileuser li:hover {
            background-color: #e0e0e0;
        }

        .profileuser a:hover {
            text-decoration: none;
            color: black;
        }

        .user_click {
            border-radius: 10px;
            width: 40px;
            height: 30px;
        }

        p {
            padding: 0;
            margin: 0;
        }

        .profileuser i {
            float: left;
            margin-top: 15px;
            margin-left: 5px;
        }

        .p {
            border-radius: 5px 5px 0px 0px;
        }

        .alertmessage {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 5000;
            display: none;
            visibility: hidden;
        }

        .navbar {
            position: absolute;
            top: -16px;
            background-color: #F3F2F3;
            border: solid black 1px;
            width: 100%;
            height: auto;
            z-index: 9000;
            display: none;
            visibility: hidden;
            border-radius: 0px 0px 5px 5px;
        }

        .navbar a {
            font-size: 20px;
            color: red;
        }

        .navbar a:hover {
            color: red;
        }

        .navbar .midcat {
            font-size: 15;
            margin: 0;
            padding: 0;
            cursor: pointer;
            margin-top: -20px;
            border-radius: 5px;
        }


        .container-fluid {
            max-width: 1200;
        }

        .navigationul a {
            color: white;
            font-size: 15px;
        }

        .navigationul a:hover {
            color: white;
            text-decoration: none;
        }

        .logo {
            position: relative;
            top: 40px;
        }

        .logo a {
            color: black;

        }

        .logo a:hover {
            color: black;
            text-decoration: none;
        }

        .acount a {
            color: black;
        }

        .acount a:hover {
            color: black;
            text-decoration: none;
        }

        .info {
            width: 100%;
            height: 40px;
            background-color: black;
            position: fixed;
            top: 0;
            left: 0;
            color: white;
            z-index: 5000;
            font-size: 20px;
            line-height: 40px;
        }

        .info i {
            width: 20px;
            height: 20px;
            color: white;
            margin-left: 10px;
        }

        .info a:hover {
            text-decoration: none;
        }

        .cart_counter {
            width: 18px;
            height: 18px;
            background-color: #EE4055;
            font-size: 16px;
            text-align: center;
            line-height: 18px;
            position: absolute;
            top: 17px;
            right: -8px;
            border-radius: 5px;
            color: white;
        }

        .cart {
            position: absolute;
            top: 30px;
            right: 5px;
            width: 400px;
            height: 450px;
            background-color: #FFFFFF;
            display: none;
            visibility: hidden;
            border-radius: 5px;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 20px;
            box-shadow: 1px 1px 1px 1px black;
        }

        .cart img {
            padding: 5px;
        }


        .bx-cart:hover {
            background-color: #FFCCCC;
            border-radius: 5px;
        }

        .bx-cart:hover .cart {
            display: block;
            visibility: visible;
        }

        .counter {
            display: flex;
            align-items: center;
            border: solid #999 1px;
            border-radius: 5px;
            padding: 3px;
            font-size: 19px;
            margin-left: 100px;
            width: 100px;
            margin-top: 30px;
        }

        .counter span {
            display: inline-block;
            color: #EE4055;
            cursor: pointer;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            text-align: center;
        }

        .counter span:not(:first-child):not(:last-child) {
            border-left: none;
            border-right: none;
        }


        .counter span:hover {
            filter: brightness(110%);
        }

        .counter span:active {
            filter: brightness(90%);
        }

        .delete_cart {
            margin-top: 7px;
        }

        .empty_cart {
            position: absolute;
            top: 20px;
            margin: auto;
        }

        .confirm_cart {
            width: 200px;
            height: 40px;
            color: #EE4055;
            text-align: center;
            line-height: 40px;
            font-size: 20px;
            border: solid #EE4055 1px;
            border-radius: 5px;
            margin: auto;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
    </div>
    <header>
        <div class="container ">

            <div class="info">
                <?php
                $socialquery  = $mysqli->query("SELECT * FROM  tbl_social ");
                while ($r = mysqli_fetch_assoc($socialquery)) {
                    if ($r["social_url"] != "") {
                        echo  "<a href= " . $r['social_url'] . ">";
                        echo  ' <i class=" ' . $r["social_icon"] . ' mr-2"></i>';
                        echo "</a>";
                    }
                }
                ?>

            </div>
            <span class="logo"><a href="#">Shoppie.</a></span>
            <div class="acount ">
                <a class="p1">
                    <i class='bx bx-user-circle  user_click' style="font-size: 30px;position:relative"></i>
                </a>
                <?php
                if ($login) {
                    echo "
                    <script src=' ./bootstrap-4.3.1-dist/jquery-3.6.1.min.js'></script>
                    <script src='./bootstrap-4.3.1-dist/js/bootstrap.min.js'></script>
                    <script>
                    $('.user_click').removeClass('bx-log-in') ;
                    $('.user_click').addClass(' bx-user-circle') ;
                    </script>
                  ";
                } else {
                    echo "
                  <script src=' ./bootstrap-4.3.1-dist/jquery-3.6.1.min.js'></script>
                  <script src='./bootstrap-4.3.1-dist/js/bootstrap.min.js'></script>
                  <script>
                  $('.user_click').removeClass('bx-user-circle ') ;
                  $('.user_click').addClass(' bx-log-in ') ;
                  $('.p1').attr('href','login.php')
                  </script>
                ";
                }
                ?>

                <div class="userbox">
                    <ul class="profileuser">
                        <li class="p"><a href="http://shop.test/userdetails.php?profile=true"> <i class='bx bxs-user-pin '></i> Profile</a></li>
                        <li><a href="http://shop.test/userdetails.php?profile/orders"><i class='bx bx-shopping-bag'></i> Orders</a></li>
                        <li><a href="http://shop.test/userdetails.php?profile/favorite"><i class='bx bx-heart'></i>Favorite</a></li>
                        <li><a href="http://shop.test/userdetails.php?profile/comments=true"><i class='bx bx-comment'></i> Comments</a></li>
                        <li><a href="./logout.php?"> <i class='bx bx-log-out'></i> Logout</a></li>
                    </ul>
                </div>

                </i>
                <i class='bx bx-cart' style="position: relative;font-size:30px">
                    <div class="cart" id="cart">
                        <?php
                        $query  = $mysqli->query("SELECT * FROM cart WHERE user_id='$user_id'");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $pr_id = $row["p_id"];
                                $query2 = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$pr_id'");
                                while ($row2 = mysqli_fetch_assoc($query2)) {
                                    echo "<div class='row'>";
                                    echo '<div class="col-4">';
                                    echo  ' <img   width="100" height="100"  src="./Uploaded_images/' . $row2['p_featured_photo'] . '  "alt="" >';
                                    echo  "</div>";
                                    echo '<div class="col-8">';
                                    echo "<span style='font-size:15px'>" . $row2["p_name"] . "</span>";
                                    echo '
                                <form  method="post"  id="add_delete_cart_form">

                                <div class="counter">';

                                    if ($row["quantity"] == 1) {
                                        echo "<span class='trash  minus'>";
                                        echo "<i class='bx bxs-trash  delete_cart'></i>";
                                    } else {
                                        echo  '<span class="minus">';
                                        echo   "-";
                                    };
                                    echo  '</span>';
                                    echo  ' <span class="number">' . $row["quantity"];
                                    echo  ' </span>
                               <span class="plus">+</span>
                                </div>';

                                    echo   '<input   hidden  type="text" value=' . $row2['p_id'] . ">";
                                    echo  '</form>';
                                    echo  "</div>";
                                    echo "</div>";
                                    echo "<hr>";
                                }
                            }
                            echo " <a  href='http://shop.test/confirm_pr_page.php'>  <div  class='confirm_cart'> Confirm </div>  </a> ";
                        } else {
                        ?>
                            <div>
                                <img class="empty_cart" src="./images/empty-cart.svg" alt="empty cart image  svg ">
                                <span style="position: absolute;top:50%">Your cart is empty
                                </span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <span class="cart_counter" id="cart_counter">
                        <?php
                        $query = $mysqli->query("SELECT * FROM cart WHERE user_id='$user_id'");
                        if (mysqli_num_rows($query) > 0) {
                        ?>
                            <?php echo  mysqli_num_rows($query); ?>
                        <?php } else {
                            echo  "0";
                        } ?>
                    </span>

                </i>

            </div>
        </div>
    </header>


    <div class="navigationbar">
        <div class="container">
            <ul class="navigationul">
                <?php
                $query44 = $mysqli->query("SELECT * FROM  tbl_top_category  ");
                echo  "<li><a href='http://shop.test'>";
                echo "Home</a></li>";
                while ($row = mysqli_fetch_assoc($query44)) {
                    if ($row["show_on_menu"] == 1) {
                        echo  "<li><a class='openmenuebar' href='index.php?tcat_id=" . $row["tcat_id"] . "'>" .
                            $row["tcat_name"] . "</li></a>";
                    }
                }
                echo  "<li><a href='#'>";
                echo "About Us</a></li>";
                echo  "<li><a href='#'>";
                echo "Faq Us</a></li>";
                echo  "<li><a href='#'>";
                echo "Contant Us</a></li>";
                ?>
            </ul>
        </div>
        <div class="navbar container" id="navbar">
            <div class="row  navbarrow">

            </div>
        </div>
    </div>


    <script src=" ./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script>
        let userbox = document.querySelector(".userbox");
        let user_click = document.querySelector(".user_click")


        $(".user_click").click(function(event) {
            event.stopImmediatePropagation();
            if (userbox.style.display == "none") {
                userbox.style.display = "block";
                userbox.style.visibility = "visible";
                user_click.style.backgroundColor = "#FFCCCC";
            } else {
                userbox.style.display = "none";
                userbox.style.visibility = "hidden";
                user_click.style.backgroundColor = "white";
            }
        })
        document.body.addEventListener("click", function() {
            userbox.style.display = "none";
            userbox.style.visibility = "hidden";
            user_click.style.backgroundColor = "white";
            $(".editusername").css("visibility", "hidden");
            $(".editusername").css("display", "none");
        })
        $(".navigationul .openmenuebar ").mouseover(function(e) {
            e.stopPropagation()
            $(".navbar").css("display", "block");
            $(".navbar").css("visibility", "visible");

            var topcategorymame = $(this).html();
            $.ajax({
                type: "post",
                url: "./fetchdata/fetchmenuedata.php",
                data: {
                    category: topcategorymame
                },
                success: function(data) {
                    $(".navbarrow").html(data);
                }
            });

        })
        $(document).mouseover(function(e) {
            $(".navbar").css("display", "none");
            $(".navbar").css("visibility", "hidden");
        });
        $(".navbar").mouseover(function(e) {
            e.stopPropagation();
            $(".navbar").css("display", "block");
            $(".navbar").css("visibility", "visible");
        });
    </script>

    <script>
        $('#cart').on('click', '.plus', function() {
            var p_id = $(this).parent().parent().find("input").val();
            var number = parseInt($(this).parent().find(".number").html());

            if (number + 1 > 1) {
                $(this).parent().find(".minus").html("<span class='minus'> - </span>");
            }
            $(this).parent().find(".number").html(number + 1);
            $.ajax({
                type: "post",
                url: "header.php?addquantity=true",
                data: {
                    number: number,
                    p_id: p_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {} else if (res.status == 400) {}
                }
            });
        })

        $('#cart').on('click', '.minus', function() {
            var p_id = $(this).parent().parent().find("input").val();
            var number = parseInt($(this).parent().find(".number").html());
            if (number - 1 == 1) {
                $(this).html("<i class='bx bxs-trash  delete_cart'></i>");
                $(this).removeClass(".minus");
            }
            $(this).parent().find(".number").html(number - 1);

            $.ajax({
                type: "post",
                url: "header.php?minusquantity=true",
                data: {
                    number: number,
                    p_id: p_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        if (number - 1 == 0) {
                            $("#button_for_cart").load(" #button_for_cart > *");
                            $("#cart").load(" #cart > *");
                            var cart_counter = $(".cart_counter").html().trim();
                            cart_counter = parseInt(cart_counter);
                            cart_counter = cart_counter - 1;
                            $(".cart_counter").html(cart_counter);
                        }
                    } else if (res.status == 400) {}
                }
            });
        })
   
    </script>
</body>

</html>