<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
    
include "../admin/functions/ecat_id_to_catgeory.php" ;
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

$p_id =$id ;
$query = $mysqli->query("SELECT * FROM tbl_product WHERE p_id ='$p_id'");
while ($rr = mysqli_fetch_assoc($query)) {
    $tcat_id = $rr["tcat_id"];
    $mcat_id = $rr["mcat_id"];
    $ecat_id = $rr["ecat_id"];
}

$querysize = $mysqli->query("SELECT * FROM tbl_product_size WHERE p_id ='$p_id'");
if (mysqli_num_rows($querysize) > 0) {
    while ($rowsize = mysqli_fetch_assoc($querysize)) {
        $size_id = $rowsize["size_id"];
    }
}

$querycolor = $mysqli->query("SELECT * FROM tbl_product_color WHERE p_id ='$p_id'");
if (mysqli_num_rows($querycolor) > 0) {
    while ($rowcolor = mysqli_fetch_assoc($querycolor)) {
        $color_id = $rowcolor["color_id"];
    }
}

$Category  = Convert_ecatid_tocatgeory($ecat_id,2);

if (isset($_GET["type"])) {
    if ($_GET["type"] == "delete") {
        $pp_id = $_POST["pp_id"];
        $deletequery = $mysqli->query("DELETE  FROM `tbl_product_photo` WHERE pp_id='$pp_id'");
        if ($deletequery) {
            $res = [
                'status' => 200,
                'message' => "Photo deleted!"
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 400,
                'message' => "Deleting photo failed !"
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
    <title>Edit product</title>
    <style>
        label {
            width: 200px;
        }

        input {
            width: 300px;
            height: 34px;
            padding: 5px;
        }

        .imageSlides {
            display: none;
            padding: 20px;
            position: relative;
            z-index: 1;
            box-shadow: 1px 1px 1px 1px gray;
            border-radius: 5px;
        }

        img {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* Our main images-slideshow container */
        .images-slideshow {
            max-width: 300px;
            position: relative;
            z-index: 0;
        }

        /*Style for ">" next and "<" previous buttons */
        .slider-btn {
            cursor: pointer;
            position: relative;
            top: 60%;
            width: auto;
            padding: 8px 16px;
            margin-top: -22px;
            color: rgb(0, 0, 0);
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            z-index: 3000;
        }

        /* setting the position of the previous button towards left */
        .previous {
            left: -2%;
            top: 20px;
        }

        /* setting the position of the next button towards right */
        .next {
            left: 70%;
            top: 20px;
        }
        /* On hover, adding a background color */
        .previous:hover,
        .next:hover {
            color: rgb(255, 253, 253);
            background-color: rgba(0, 0, 0, 0.8);
        }

        .edit_btn {
            float: right;
        }

        .d_btn {
            float: right;
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

        select {
            padding: 5px;
            width: 300px;
            height: 34px;
        }

        textarea {
            padding: 5px;
        }
        .d_btn2 {
            visibility: hidden;
        }
        .error {
            font-size: 15px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="message"></div>

    <div class="container">

        <button style="float:right;" class="btn btn-primary add-pr  ">Add Product</button>
        <button class="btn btn-primary show_p mr-3" style="float:right">View Products </button>

        <h3>Edit product</h3>
        <hr> 
        <h6><?php echo  "   <span style='color:gray'>  Catgeory > " .$Category . "</span>"?></h6>
        <br>

        <div class="images-slideshow">
            <?php
            $querycheak = $mysqli->query("SELECT * FROM  tbl_product_photo WHERE p_id='$id' ");
            if (mysqli_num_rows($querycheak) > 0) {
                echo '<div class="imageSlides  fetured_photo ">';
                echo  "<button type='button' class='btn btn-danger  d_btn2   mb-3' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>";
                $query = $mysqli->query("SELECT * FROM  tbl_product WHERE p_id='$id' ");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<img    width="300px" height="300px"  src="../Uploaded_images/' . $row["p_featured_photo"] . '" >';
                };
                echo "</div>";
                $query2 = $mysqli->query("SELECT * FROM  tbl_product_photo WHERE p_id='$id' ");
                while ($row2 = mysqli_fetch_assoc($query2)) {
                    echo '<div class="imageSlides ">';
                    echo  "<button type='button' class='btn btn-danger  d_btn   mb-3' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>";
                    echo "<input hidden type='text' value=" . $row2["pp_id"] . ">";
                    echo '<img    width="300px" height="300px"  src="../Uploaded_images/' . $row2["photo"] . '"  class="fetured_photo"  >';
                    echo "</div>";
                }
                echo "<div class='append'></div>";
                echo "<div class='sliderbtns'>";
                echo  '<a class="slider-btn previous" onclick="setSlides(-1)">❮</a>';
                echo   '<a class="slider-btn next" onclick="setSlides(1)">❯</a>';
                echo "</div>";
            } else {

                echo '<div class="imageSlides  fetured_photo ">';

                $query = $mysqli->query("SELECT * FROM  tbl_product WHERE p_id='$id' ");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo  "<button  type='button' class='btn btn-danger  d_btn2   mb-3' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>";
                    echo '<img   width="300px" height="300px"  src="../Uploaded_images/' . $row["p_featured_photo"] . '">';
                };
                echo "</div>";
                echo "<div class='append'></div>";
                echo "<div class='sliderbtns' style='display:none'>";
                echo  '<a class="slider-btn previous" onclick="setSlides(-1)">❮</a>';
                echo   '<a class="slider-btn next" onclick="setSlides(1)">❯</a>';
                echo "</div>";
            }
            ?>

        </div>
        <br>
        <br>
        <form id="addphoto">
            <label for="addphoto">
                <h5>Add photo *</h5>
            </label>
            <input type="file" id="addphoto_input">
            <button type="button" class="btn btn-primary add_photo">Add</button>
        </form>
        <form id="edit_feturedphoto">
            <label for="editphoto">
                <h5>Edit fitured photo *</h5>
            </label>
            <input type="file" id="editphoto">
            <button type="button" class="btn btn-primary Edit_photo_fetured">Edit</button>
        </form>
        <br>
        <br>
        <form method="post" id="editform">
            <?php
            $query = $mysqli->query("SELECT * FROM tbl_product WHERE p_id='$id'");
            while ($r = mysqli_fetch_assoc($query)) {
            ?>
                <label for="t_c_name">
                    <h5>Top Category Name *</h5>
                </label>
                <select name="topcatgeoryname" id="t_cat_name">
                    <?php
                    $query = $mysqli->query("SELECT * FROM tbl_top_category ");
                    while ($row = mysqli_fetch_assoc($query)) {
                        if ($row["tcat_id"] == $r["tcat_id"]) {
                            echo  "<option selected  value=" . $row['tcat_id'] . ">" . $row['tcat_name'] . "</option>";
                        } else {
                            echo  "<option value=" . $row['tcat_id'] . ">" . $row['tcat_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br>
                <!-- this is  the  Mid category section -->
                <label for="m_c_name">
                    <h5>Mid Category Name *</h5>
                </label>
                <select name="midcatgeoryname" id="m_cat_name"> </select>
                <br>

                <!-- this is  the  End category section -->
                <label for="m_c_name">
                    <h5>End Category Name *</h5>
                </label>
                <select name="Endcatgeoryname" id="E_cat_name">
                </select>
                <br>
                <label for="productname">
                    <h5>Product name * </h5>
                </label>
                <input type="text" value='<?php echo $r["p_name"]?>' placeholder="Product name ">
                <span class="Product_name_error  input_empty_error  error"></span>

                <br>
                <label for="oldprice">
                    <h5>Product Old price *</h5>
                </label>
                <input type="number" value=<?php echo $r["p_old_price"] ?> placeholder="Product old price  ">
                <span class="old_price_errro  input_empty_error  error"></span>

                <br>
                <label for="cprice">
                    <h5>Product Current price * </h5>

                </label>
                <input type="number" value=<?php echo $r["p_current_price"] ?> placeholder="Product Current price  ">
                <span class="currentprice_empty_error   input_empty_error  error"></span>

                <br>
                <label for="q">
                    <h5>Quantity * </h5>
                </label>
                <input type="number" value=<?php echo $r["p_qty"] ?> placeholder="Quantity ">
                <span class="Quantity_error  input_empty_error  error"></span>
                <br>

                <label for="size">
                    <h5>Size * 
                    <?php if (isset($size_id)) {echo "<span  style='font-size:15px' >(Already)</span>";}?>
                    </h5>
                </label>
                <select name="Size" id="Size">
                    <option disabled selected value> -- Select an Option -- </option>
                    <?php
                    if (isset($size_id)) {
                        $query  = $mysqli->query("SELECT * FROM tbl_size ");
                        while ($r3 = mysqli_fetch_assoc($query)) {
                            if ($r3["size_id"] == $size_id) {
                                echo  "<option  selected value = " . $r3["size_id"] . ">" . $r3["size_name"] . "</option>";
                            } else {
                                echo  "<option   value = " . $r3["size_id"] . ">" . $r3["size_name"] . "</option>";
                            }
                        }
                    } else {
                        $query  = $mysqli->query("SELECT * FROM tbl_size ");
                        while ($r3 = mysqli_fetch_assoc($query)) {
                            echo  "<option   value = " . $r3["size_id"] . ">" . $r3["size_name"] . "</option>";
                        }
                    }

                    ?>
                </select>


                <br>
                <label for="color">
                    <h5>Color * 
                    <?php if (isset($color_id)) {echo "<span style='font-size:15px'>(Already)</span>";}?>
                    </h5>
                </label>
                <select name="color" id="color">
                    <option disabled selected value> -- Select an Option -- </option>
                    <?php
                    if (isset($color_id)) {
                        $query  = $mysqli->query("SELECT * FROM tbl_color ");
                        while ($rcolor = mysqli_fetch_assoc($query)) {
                            if ($rcolor["color_id"] == $color_id) {
                                echo  "<option  selected value = " . $rcolor["color_id"] . ">" . $rcolor["color_name"] . "</option>";
                            } else {
                                echo  "<option  value = " . $rcolor["color_id"] . ">" . $rcolor["color_name"] . "</option>";
                            }
                        }
                    } else {
                        $query  = $mysqli->query("SELECT * FROM tbl_color ");
                        while ($rcolor = mysqli_fetch_assoc($query)) {
                            echo  "<option  value = " . $rcolor["color_id"] . ">" . $rcolor["color_name"] . "</option>";
                        }
                    }

                    ?>

                </select>

                <br>

                <label for="description">
                    <h5>Description *</h5>
                </label>
                <textarea placeholder="Description for this Product " id="txt1" rows="10" cols="60" style="display: block;"><?php echo $r["p_description"] ?> 
               </textarea>
                <span class="txt1_error  error  "></span>
                <br>
                <br>
                <label for="description">
                    <h5> Short Description *</h5>
                </label>
                <textarea placeholder="Short Description for this Product " id="txt2" rows="10" cols="60" style="display: block;"><?php echo $r["p_short_description"] ?>
            </textarea>
                <span class="txt2_error  error  "></span>
                <br>
                <br>
                <label for="fetures">
                    <h5> Features *</h5>
                </label>
                <textarea placeholder="Fetures for this Product " id="txt3" rows="10" cols="60" style="display: block;"><?php echo $r["p_feature"] ?>
            </textarea>
                <span class="txt3_error  error  "></span>
                <br>
                <br>
                <label for="consditions">
                    <h5> Conditions *</h5>
                </label>
                <textarea placeholder=" Conditions of this Product " id="txt4" rows="10" cols="60" style="display: block;"><?php echo $r["p_condition"] ?>
                </textarea>
                <span class="txt4_error  error  "></span>
                <br>
                <br>
                <label for="description">
                    <h5> Return Policy *</h5>
                </label>
                <textarea placeholder=" Return Policy" id="txt5" rows="10" cols="60" style="display: block;"><?php echo $r["p_return_policy"] ?>

            </textarea>
                <span class="txt5_error  error  "></span>

                <br>
                <label for="description">
                    <h5> Is fetured ? *</h5>
                    <select name="isfetured_selection">
                        <?php
                        $slected  = $r['p_is_featured'];
                        if ($slected == 1) {
                            echo    '<option    selected="selected"   value="1">Yes</option>';
                            echo   '<option value="0">No</option>';
                        } else {
                            echo    '<option value="1">Yes</option>';
                            echo   '<option  selected="selected"  value="0">No</option>';
                        }
                        ?>
                    </select>
                </label>
                <br>
                <label for="Active">
                    <h5> Is Active ? *</h5>
                    <select name="isactive_selection" style="display:inline-block">
                        <?php
                        $slected  = $r['p_is_active'];
                        if ($slected == 1) {
                            echo    '<option    selected="selected"   value="1">Yes</option>';
                            echo   '<option value="0">No</option>';
                        } else {
                            echo    '<option value="1">Yes</option>';
                            echo   '<option  selected="selected"  value="0">No</option>';
                        }
                        ?>
                    </select>
                </label>
                <br>
                <button type='button' class="btn btn-primary  update_btn">Update</button>
            <?php } ?>
        </form>
    </div>
    <script src="../bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script>
        $(".add-pr").click(function() {
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "ProductManagment"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })
        $(".show_p").click(function() {
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "view_products"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })



        //slider 

        var currentIndex = 1;
        displaySlides(currentIndex);

        function displaySlides(num) {
            var x;
            var slides = document.getElementsByClassName("imageSlides");
            if (num > slides.length) {
                currentIndex = 1
            }
            if (num < 1) {
                currentIndex = slides.length
            }
            for (x = 0; x < slides.length; x++) {
                slides[x].style.display = "none";
            }
            slides[currentIndex - 1].style.display = "block";
        }

        function setSlides(num) {
            displaySlides(currentIndex += num);
        }
        $(".d_btn").click(function() {
            var imageslide = $(this).parent();
            var pp_id = $(this).parent().find("input").val();
            $.ajax({
                type: "post",
                url: "edit_product.php?type=delete",
                data: {
                    pp_id: pp_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                        imageslide.remove();
                        setSlides(1);
                        var photolenghs = $(".images-slideshow .imageSlides").length;
                        if (photolenghs < 2) {
                            $(".sliderbtns").css("display", "none");
                        }
                    }
                }
            });
        })


        var product_id = <?php
                            echo $id; ?>


        $(".add_photo").click(function() {
            var fd = new FormData();
            var files = $('#addphoto_input')[0].files;

            if (files.length > 0) {
                var filename = document.getElementById('addphoto_input').files[0].name;
                fd.append('file', files[0]);
                fd.append('P_id', product_id);

                $.ajax({
                    url: 'edit_add_delete_products.php?addphoto=true',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                            $(".append").append(`<div class="imageSlides">
                      <button type='button' class='btn btn-danger  d_btn   mb-3' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>
                     <input hidden type='text' value=${product_id}>
                     <img   width="300px" height="300px"  src="../Uploaded_images/${filename}">
                     </div>`)
                        }
                        $(".sliderbtns").css("display", "block");
                        $("#addphoto_input").val("");
                    }
                });

            } else {
                alert("Please select a file.");
            }
        })

        $('.append').on('click', '.d_btn', function() {
            var imageslide = $(this).parent();
            var pp_id = $(this).parent().find("input").val();
            $.ajax({
                type: "post",
                url: "edit_product.php?type=delete",
                data: {
                    pp_id: pp_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                        imageslide.remove();
                        setSlides(1);
                        var photolenghs = $(".images-slideshow .imageSlides").length;
                        if (photolenghs < 2) {
                            $(".sliderbtns").css("display", "none");
                        }
                    } else if (res.status == 400) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    } else if (res.status == 404) {
                        $(".message").css("display", "block");
                        $(".message").html(res.message);
                        setInterval(() => $(".message").fadeOut(), 5000)
                    }
                }
            });
        });

        $(".Edit_photo_fetured").click(function() {
            var fd = new FormData();
            var files = $('#editphoto')[0].files;
            if (files.length > 0) {
                var filename = document.getElementById('editphoto').files[0].name;
                fd.append('file', files[0]);
                fd.append('P_id', product_id);

                $.ajax({
                    url: 'edit_add_delete_products.php?editphoto=true',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000);
                            $("#editphoto").val("");
                            var src = "../Uploaded_images/" + filename;
                            console.log(src);
                            $(".fetured_photo img").attr("src", src);
                        }
                    }
                });
            } else {
                alert("Please select a file.");
            }
        })

        $(".update_btn").click(function() {
            // inputs 
            var inputs = $("#editform input");
            var productname = inputs[0].value.trim();
            var Old_price = inputs[1].value.trim();
            var Current_price = inputs[2].value.trim();
            var Quantity = inputs[3].value.trim();

            //textarea
            var Description = $("#txt1").val().trim();
            var ShortDes = $("#txt2").val().trim();
            var Fetures = $("#txt3").val().trim();
            var Conditions = $("#txt4").val().trim();
            var ReturnPolicy = $("#txt5").val().trim(); 

            //seelctions 
            var selections = $("#editform select");
            var topcatgeoryid = selections[0].value;
            var midcategoryid = selections[1].value;
            var endcategoryid = selections[2].value;
            var size = selections[3].value;
            var color = selections[4].value;
            var isfetured = selections[5].value;
            var isactive = selections[6].value;

            if (productname == "" || Old_price == "" || Current_price == "" || Quantity == "" ||
                Description == "" || ShortDes == "" || Fetures == "" || Conditions == "" ||
                ReturnPolicy == "") {

                if (productname == "") {
                    window.scrollTo({
                        top: 600,
                        behavior: 'smooth'
                    });
                    $(".Product_name_error").html("Fill this input please !!");

                } else {
                    $(".Product_name_error").html("");
                }
                if (Old_price == "") {
                    window.scrollTo({
                        top: 600,
                        behavior: 'smooth'
                    });
                    $(".old_price_errro").html("Fill this input please !!");
                } else {
                    $(".old_price_errro").html("");
                }
                if (Current_price == "") {
                    window.scrollTo({
                        top: 600,
                        behavior: 'smooth'
                    });
                    $(".currentprice_empty_error").html("Fill this input please !!");
                } else {
                    $(".currentprice_empty_error").html("");
                }
                if (Quantity == "") {
                    window.scrollTo({
                        top: 600,
                        behavior: 'smooth'
                    });
                    $(".Quantity_error").html("Fill this input please !!");
                } else {
                    $(".Quantity_error").html("");
                }

                if (Description == "") {
                    window.scrollTo({
                        top: 1100,
                        behavior: 'smooth'
                    });
                    $(".txt1_error").html("fill this Textarea !!");
                } else {
                    $(".txt1_error").html("");
                }
                if (ShortDes == "") {
                    window.scrollTo({
                        top: 1100,
                        behavior: 'smooth'
                    });
                    $(".txt2_error").html("fill this Textarea !!");
                } else {
                    $(".txt2_error").html("");
                }
                if (Fetures == "") {
                    window.scrollTo({
                        top: 1700,
                        behavior: 'smooth'
                    });
                    $(".txt3_error").html("fill this Textarea !!");
                } else {
                    $(".txt3_error").html("");
                }
                if (Conditions == "") {
                    window.scrollTo({
                        top: 1700,
                        behavior: 'smooth'
                    });
                    $(".txt4_error").html("fill this Textarea !!");
                } else {
                    $(".txt4_error").html("");
                }
                if (ReturnPolicy == "") {
                    window.scrollTo({
                        top: 2000,
                        behavior: 'smooth'
                    });
                    $(".txt5_error").html("fill this Textarea !!");
                } else {
                    $(".txt5_error").html("");
                }

            } else {
                $(".txt1_error").html("");
                $(".txt2_error").html("");
                $(".txt3_error").html("");
                $(".txt4_error").html("");
                $(".txt5_error").html("");
                $(".Product_name_error").html("");
                $(".old_price_errro").html("");
                $(".currentprice_empty_error").html("");
                $(".Quantity_error").html("");
                var data = new FormData();
                var p_id = <?php echo $id ?> 
                //inputs
                data.append('P_name', productname);
                data.append('O_price', Old_price);
                data.append('C_price', Current_price);
                data.append('qunatity', Quantity);
                //selections
                data.append('topcatid', topcatgeoryid);
                data.append('midcatid', midcategoryid);
                data.append('endcatid', endcategoryid);
                data.append('size', size);
                data.append('color', color);
                data.append('isfetured', isfetured);
                data.append('isactive', isactive);
                //textareas
                data.append('Description', Description);
                data.append('ShortDes', ShortDes);
                data.append('Fetures', Fetures);
                data.append('Conditions', Conditions);
                data.append('ReturnPolicy', ReturnPolicy);
                data.append('p_id',p_id);

                $.ajax({
                        url: './edit_add_delete_products.php?Update=true',
                        type: 'POST',
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 200) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                               
                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "view_products"
                                    },
                                    success: function(d) {
                                        $(".main_pannel").html(d);
                                    }
                                });
                                setTimeout(() => {
                                    window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                                }, 300);
                                

                            } else if (res.status == 404) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            }
                        },
                        error: function(error) {}
                    });

            }
        })


        var tcat_id = $("#t_cat_name").val();
        var mcat_id = <?php echo $mcat_id ?>;
        var ecat_idd = <?php echo $ecat_id ?>;

        $.ajax({
            type: "post",
            url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
            data: {
                topcategory: tcat_id,
            },
            success: function(d) {
                $("#m_cat_name").html(d);
                document.getElementById('m_cat_name').value = mcat_id;
            }
        });

        setTimeout(() => {
            var mcat_id = $("#m_cat_name").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_endcategory_by_midcategory.php",
                data: {
                    mcat_id: mcat_id
                },
                success: function(d) {
                    $("#E_cat_name").html(d);
                }
            });
        }, 10);


        $("#t_cat_name").change(function() {
            var tcat_id = $("#t_cat_name").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_midcategory_by_topcategory_id.php",
                data: {
                    topcategory: tcat_id
                },
                success: function(d) {
                    $("#m_cat_name").html(d);
                }
            });

            setTimeout(() => {
                var mcat_id = $("#m_cat_name").val();
                $.ajax({
                    type: "post",
                    url: "../fetchdata/fetch_endcategory_by_midcategory.php",
                    data: {
                        mcat_id: mcat_id
                    },
                    success: function(d) {
                        $("#E_cat_name").html(d);
                    }
                });
            }, 200);

        })

        $("#m_cat_name").change(function() {
            var mcat_id = $("#m_cat_name").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_endcategory_by_midcategory.php",
                data: {
                    mcat_id: mcat_id
                },
                success: function(d) {
                    $("#E_cat_name").html(d);
                }
            });
        })

        setTimeout(() => {
            var mcat_id = $("#m_cat_name").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetch_endcategory_by_midcategory.php",
                data: {
                    mcat_id: mcat_id
                },
                success: function(d) {
                    $("#E_cat_name").html(d);
                    document.getElementById('E_cat_name').value = ecat_idd;
                }
            });
        }, 200);
    </script>

</body>

</html>