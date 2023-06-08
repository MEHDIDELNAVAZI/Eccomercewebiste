<?php
include "./config_database.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <title>Confirm Order</title>
    <style>
        .top_row {
            width: 100%;
            height: 150px;
            border: solid 1px gray;
            border-radius: 5px;
            text-align: center;
            line-height: 150px;
            color: #EE3D53;
            font-size: 50px;
            margin-top: 10px;
            align-items: center;
            padding-left: 20px;

        }

        .info {
            width: 100%;
            height: 300px;
            border: solid gray 1px;
            border-radius: 5px;
            margin-top: 20px;
            padding: 10px;

        }

        .addres {
            width: 92%;
            height: auto;
            border: solid gray 1px;
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;
        }

        .pr {
            width: 92%;
            height: 400px;
            border: solid gray 1px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .confirm_cart {
            width: 100px;
            height: 30px;
            color: #EE4055;
            text-align: center;
            line-height: 30px;
            font-size: 20px;
            border: solid #EE4055 1px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20px;
        }

        a {
            text-decoration: none;
            color: #EE4055;
        }

        a:hover {
            text-decoration: none;
            color: #EE4055;
        }

        .confirm_order {
            width: 200px;
            height: 40px;
            color: #EE4055;
            text-align: center;
            line-height: 40px;
            font-size: 20px;
            border: solid #EE4055 1px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20px;
            margin-top: 40px;
        }

        .addreses {
            width: 300px;
            height: 40px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .empty_div {
            width: 100%;
            height: 300px;
            border: solid gray 1px;
            border-radius: 5px;
            line-height: 300px;
            margin-top: 20px;
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
    </style>
</head>

<body>
    <div class="message"></div>




    <div class="container-fluid" style="width:90%">

        <div class="row top_row">
            <p>
                <a href="http://shop.test/">Shoppifiye</a>
            </p>
        </div>

        <?php
        $query = $mysqli->query("SELECT * FROM cart WHERE  user_id='$_SESSION[id]'");
        if (mysqli_num_rows($query) > 0) {
        ?>

            <div class="row">
                <div class="col-3 info ">
                    <?php
                    $total_order = 0;
                    $number_of_pr = 0;
                    $user_id = $_SESSION["id"];
                    $query  = $mysqli->query("SELECT * FROM cart WHERE user_id='$user_id'");
                    if (mysqli_num_rows($query) > 0) {
                        $number_of_pr = mysqli_num_rows($query);
                        while ($row = mysqli_fetch_assoc($query)) {
                            $total_order += $row['price'] * $row["quantity"];
                        }
                        echo "<span style='font-size:20px;padding:10px;width:'>Total Price </span> <span class='t_price' style='font-size:20px;color:gray;float:right'>" . $total_order . " $ </span> <hr>";
                    } else {
                    }
                    ?>

                    <div class="shipping_cost"> <span style='font-size:18px;padding:10px'> Shipping Cost </span> <span style='font-size:20px;color:gray;float:right' class="t_price">39 $</span>
                        <hr>
                    </div>
                    <div class="total_to_pay"><span style='font-size:20px;padding:10px'>Have to Pay : </span><span class='t_price' style='font-size:20px;color:gray;float:right'> <?php echo  $total_order + 39 ?> $</span></div>
                    <div class="confirm">
                        <div class='confirm_order'> Confirm </div>

                    </div>

                </div>



                <div class="col-9 ">
                    <div class="row">
                        <div class="addres ml-5">
                            <span style="font-size: 20px;color:#EF394D;padding:10px"> Address to Deliver </span>

                            <div class="address">
                                <?php
                                $query = $mysqli->query("SELECT * FROM addresses WHERE user_id='$user_id'");

                                if (mysqli_num_rows($query) > 0) {
                                    echo  "<select class='addreses'>";
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo  "<option value = ' " . $row['ad_id'] . "'>" . $row["address_line1"] . " , " . $row["address_line2"]  . "</option>";
                                    }
                                    echo  "</select>";
                                    echo " <a  href='http://shop.test/userdetails.php?profile/addresses=true'>  <div  class='confirm_cart' style='float:right'> Edit  </div>  </a> ";
                                } else {
                                    echo " <img src='./images/empty-cart.svg' alt='empty cart image  svg '>
                         <span style='font-size:17px;''> There is not any Address !
                         </span>";
                                    echo " <a  href='http://shop.test/userdetails.php?profile/addresses=true'>  <div  class='confirm_cart'> Add </div>  </a> ";
                                }


                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="pr ml-5  mb-5">
                            <img src="./images/16060530.png" alt="delivery" width="50px" height="50px" style="margin-left: 20px;">
                            <div class="row">
                                <?php
                                $query = $mysqli->query("SELECT * FROM cart WHERE  user_id='$_SESSION[id]'");

                                while ($row = mysqli_fetch_assoc($query)) {

                                    $p_id_pr = $row["p_id"];
                                    $query2 = $mysqli->query("SELECT * FROM tbl_product  WHERE  p_id='$p_id_pr'");
                                    while ($row2 = mysqli_fetch_assoc($query2)) {
                                        echo "<div class='col-3''>";
                                        echo "<div style='padding:20px'>";
                                        echo   "<img  width='100px' height='100px' src=./Uploaded_images/" . $row2["p_featured_photo"] . ">";
                                        echo "<div style='width:200px'>";
                                        echo "<span style='font-size:16px;padding:10px'>" . $row2["p_name"]  . "</span>";
                                        echo "</div>";
                                        echo  "</div>";
                                        echo "</div>";
                                    }
                                }


                                ?>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php  } else {
        ?>

            <div class="row empty_div">

                <img src="./images/empty-cart.svg" alt="empty cart image  svg ">
                <span style="font-size:17px;"> There is not any product in your cart !
                </span>
            </div>
    </div>
<?php
        }
?>


<script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
<script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script>
    $(".confirm_order").click(function() {
        var user_id = <?php echo  $user_id; ?>;
        var address_id = $(".addreses").val();
        var status = "Pending";

        if (typeof address_id == "undefined") {
            $(".message").css("display", "block");
            $(".message").html("Add address to your acount for delivering !");
            setInterval(() => $(".message").fadeOut(), 5000)
        } else {

            $.ajax({
                url: 'delete_add_order.php?add_order=true',
                type: 'post',
                data: {
                    user_id: user_id,
                    address_id: address_id,
                    status: status
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $(".message").css("display", "block");
                        $(".message").html("Order added succefully!");
                        setInterval(() => $(".message").fadeOut(), 4000);
                        setInterval(() => 
                        window.location.replace("http://shop.test/userdetails.php?profile/orders")
                        , 4000);

                           

                    } else if (res.status == 400) {

                    }
                },
            });









        }



    })
</script>
</body>

</html>