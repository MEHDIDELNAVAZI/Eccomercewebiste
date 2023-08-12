<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:http://shop.test/not_found_page.php'));
}
?>

<!DOCTYPE html>
<html>
<title>Admin pannel </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    .w3-teal {
        color: white !important;
        background-color: black !important;
        height: 60px;
        line-height: 60px;
        position: fixed;
        top: 0;
        width: 100%;
        text-align: left;
        color: black;
        z-index: 1000;
    }

    .w3-teal button {
        background-color: black !important;
        height: 50px;
        line-height: 0px;
        padding: 20px;
    }

    #openNav:hover {
        background-color: black !important;
        color: white !important;
    }

    .w3-sidebar {
        width: 20% !important;
        background-color: #283546;
        color: white;
    }

    .w3-sidebar button:hover {
        color: white !important;
    }

    .w3-sidebar ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .w3-sidebar ul li {
        color: white;
        padding: 0px
    }

    .w3-sidebar ul>li:hover {
        color: white !important;
    }

    .w3-sidebar ul li {
        cursor: pointer;
        width: 100%;
        height: 100%;
        display: block;
        color: white;
        text-decoration: none;
        padding: 14px;
    }

    .w3-sidebar ul ul li {
        width: 100%;
        font-size: 14px;


    }

    .closebtn {
        color: #EF4056 !important;
        float: right;
    }

    .closebtn:hover {
        background-color: #283546 !important;
    }

    .main_pannel {
        padding: 20px;
        color: black;
    }

    .w3-teal {
        position: fixed;
        width: 100%;
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

<!-- message box   -->
<div class="message"></div>
<!-- message box   -->

<body>
    <div class="message"></div>
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class=" w3-button w3-large closebtn" onclick="w3_close()"> &times;</button>
        <br>
        <br>

        <ul>
            <li class="d"> <i class='bx bxs-dashboard'></i><span class="data"> Dashboard </span> </li>
            <li style="position: relative;">
                <i class='bx bx-outline'></i> Shopp Setting
                <ul>
                    <li class="d"> <i class='bx bx-circle'></i> <span class="data">Size</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i><span class="data">Color</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i><span class="data">Country</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i><span class="data">Shipping Cost</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i><span class="data">Top Level Category</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i><span class="data">Mid Level Category</span> </li>
                    <li class="d"> <i class='bx bx-circle'></i> <span class="data">End Level Category</span></li>
                </ul>

                </i>
            </li>



            <li class="d"> <i class='bx bxl-product-hunt'></i> <span class="data">Product Managment</span></li>
            <li class="d"> <i class='bx bx-slider'></i> <span class="data">Manage Sliders</span></li>
            <li class="d"> <i class='bx bx-server'></i> <span class="data">Services</span></li>
            <li class="d"> <i class='bx bx-question-mark'></i> <span class="data">FaQ</span></li>
            <li class="d"><i class='bx bxl-vk'></i><span class="data"> Social Media</span></li>
        </ul>


    </div>

    <div id="main">
        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;
                <span style="font-size: 25px;padding:10px" class="ED">Admin Pannel</span>

            </button>
            <span style="font-size: 25px;padding:30px" class="ED">Admin Pannel</span>
        </div>
        <br>
        <br>
        <br>
        <div class="main_pannel">
            <?php
            include "../admin/Dashboard.php";
            ?>

        </div>
    </div>
    <script src="../bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "20%";
            document.getElementById("mySidebar").style.width = "20%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }

        $("#mySidebar .d ").click(function(e) {
            var data = $(this).find(".data").html();
            var data1 = $(this).find(".data").html();

            data = data.replace(/\s/g, '');
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: data
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                    $(".ED").html(data1);
                }
            });
        })
    </script>


</body>

</html>