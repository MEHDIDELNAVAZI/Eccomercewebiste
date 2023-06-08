<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
include "../config_database.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Managment</title>
    <style>
        select {
            padding: 5px;
            width: 300px;
            height: 34px;
        }

        label {
            width: 200px;
        }

        input {
            width: 300px;
            height: 34px;
            padding: 5px;
        }

        ul {
            padding: 0px;
            margin: 0px;
            list-style: none;
            display: inline-block;
        }

        ul li {
            display: block;
        }

        form {
            display: inline-block;
        }

        .photo {
            display: block;

        }

        .cke_button {
            display: block !important;

        }

        .input_empty_error {
            font-size: 15px;
            color: red;
        }

        .error {
            font-size: 15px;
            color: red;
        }

        textarea {
            padding: 10px;
            border-color: black solid 3px;
            box-shadow: 1px 1px 1px 1px gray;
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

    <div class="producst container">
        <button class="btn btn-primary show_p" style="float:right">View Products </button>

        <h2>Add Product</h2>
        <hr>
        <!-- this is  the  Top category section -->
        <form method="post" id="form1">
            <label for="t_c_name">
                <h5>Top Category Name *</h5>
            </label>
            <select name="topcatgeoryname" id="t_cat_name">
                <?php
                $query = $mysqli->query("SELECT * FROM tbl_top_category ");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo  "<option value=" . $row['tcat_id'] . ">" . $row['tcat_name'] . "</option>";
                }
                ?>
            </select>
            <br>
            <!-- this is  the  Mid category section -->
            <label for="m_c_name">
                <h5>Mid Category Name *</h5>
            </label>
            <select name="midcatgeoryname" id="m_cat_name">
            </select>
            <br>

            <!-- this is  the  End category section -->
            <label for="m_c_name">
                <h5>End Category Name *</h5>
            </label>
            <select name="Endcatgeoryname" id="E_cat_name">
            </select>
            <br>
            <!-- this is prodyct name section -->
            <label for="P_name">
                <h5>Product Name *</h5>
            </label>
            <input type="text" id="P_name" placeholder="Product name ">
            <span class="Product_name_error  input_empty_error"></span>
            <br>

            <!-- this is old price  section -->
            <label for="old_price">
                <h5>Old Price * <span style="font-size: 14px;">(in USD)</span> </h5>
            </label>
            <input type="number" id="o_price" placeholder="Old Price ">
            <span class="old_price_errro  input_empty_error"></span>

            <br>

            <!-- this is current price  section -->
            <label for="current_price">
                <h5>Current Price * <span style="font-size: 14px;">(in USD)</span> </h5>
            </label>
            <input type="number" id="o_price" placeholder="Current Price ">
            <span class="currentprice_empty_error   input_empty_error"></span>

            <br>
            <!-- this is for Quantity   section -->
            <label for="Quantity">
                <h5>Quantity* </h5>
            </label>
            <input type="number" id="Q" placeholder="Quantity">
            <span class="Quantity_error  input_empty_error"></span>
            <br>
            
            <!-- this is for Size   section -->
            <label for="Size">
                <h5> Select Size *
                    <span style="font-size: 13px;">(Optional)</span>
                </h5>
            </label>
            <select name="Size" id="Size">
                <option disabled selected value> -- Select an Option -- </option>
                <?php
                $query  = $mysqli->query("SELECT * FROM tbl_size ");
                while ($r = mysqli_fetch_assoc($query)) {
                    echo  "<option value = " . $r["size_id"] . ">" . $r["size_name"] . "</option>";
                }
                ?>
            </select>


            <br>


            <!-- this is for Color   section -->
            <label for="Color">
                <h5> Select Color *
                    <span style="font-size: 13px;">(Optional)</span>
                </h5>
            </label>
            <select name="color" id="color">
                <option disabled selected value> -- Select an Option -- </option>
                <?php
                $query  = $mysqli->query("SELECT * FROM tbl_color ");
                while ($r = mysqli_fetch_assoc($query)) {
                    echo  "<option value=" . $r["color_id"] . ">" . $r["color_name"] . "</option>";
                }
                ?>
            </select>

            <br>
            <!-- this is for  Fetured Photo  section -->
            <label for="f_photo">
                <h5> Add fetured photo * </h5>
            </label>
            <input type="file" class="pic" id="photo1" multiple="multiple">
            <span class="P_error_1 error"></span>

            <!-- this is for  add other  Photo  section -->
            <br>


            <!-- this is for  Fetured Photo  section -->

            <label for="f_photo">
                <h5> Add Other photoes * </h5> 
            </label>
            <span class="add_photo">
                <button type="button" class="btn btn-primary" style="display:inline; width:30%" id="add_file">Add</button>
            </span>
            <br>
            <br>
            <label for="description">
                <h5>Description *</h5>
            </label>
            <textarea placeholder="Description for this Product " id="txt1" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="txt1_error  error  "></span>

            <br>
            <br>
            <label for="description">
                <h5> Short Description *</h5>
            </label>
            <textarea placeholder="Short Description for this Product " id="txt2" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="txt2_error  error  "></span>

            <br>
            <br>
            <label for="description">
                <h5> Features *</h5>
            </label>
            <textarea placeholder="Fetures for this Product " id="txt3" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="txt3_error  error  "></span>

            <br>
            <br>
            <label for="description">
                <h5> Conditions *</h5>
            </label>
            <textarea placeholder=" Conditions of this Product " id="txt4" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="txt4_error  error  "></span>

            <br>
            <br>
            <label for="description">
                <h5> Return Policy *</h5>
            </label>
            <textarea placeholder=" Return Policy" id="txt5" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="txt5_error  error  "></span>

            <br>
            <label for="description">
                <h5> Is fetured ? *</h5>
                <select name="isfetured_selection">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
            <br>
            <label for="Active">
                <h5> Is Active ? *</h5>
                <select name="isactive_selection" style="display:inline-block">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
        </form>
        <button type="button" class="btn btn-primary  add_product_btn "> Add Product </button>

    </div>
    <script src="../bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script src="../bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
                }
            });



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
        
        var counter = 2;
        $('#add_file').click(function() {
            $(".add_photo").append(` <span class="photo">
                    <input type="file"   class="pic"  id='photo${counter}'">
                    <button   class='btn btn-danger'  id="det" onclick="dete(this);" >Dlete</button>
                    <span class='P_error_${counter} error'></span>
                </span>  
                `);
            counter++;
        });

        function dete(e) {
            e.parentElement.remove();
            counter = 2;
        }

        $(".add_product_btn").click(function() {
            //seelctions 
            var selections = $("#form1 select");
            var topcatgeoryid = selections[0].value;
            var midcategoryid = selections[1].value;
            var endcategoryid = selections[2].value;
            var size = selections[3].value;
            var color = selections[4].value;
            var isfetured = selections[5].value;
            var isactive = selections[6].value;
            //textarea
            var Description = $("#txt1").val().trim();
            var ShortDes = $("#txt2").val().trim();
            var Fetures = $("#txt3").val().trim();
            var Conditions = $("#txt4").val().trim();
            var ReturnPolicy = $("#txt5").val().trim();
            // inputs 
            var inputs = $("#form1 input");
            var productname = inputs[0].value.trim();
            var Old_price = inputs[1].value.trim();
            var Current_price = inputs[2].value.trim();
            var Quantity = inputs[3].value.trim();


            if (productname == "" || Old_price == "" || Current_price == "" || Quantity == "" ||
                Description == "" || ShortDes == "" || Fetures == "" || Conditions == "" ||
                ReturnPolicy == "") {

                if (productname == "") {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    $(".Product_name_error").html("Fill this input please !!");
                } else {
                    $(".Product_name_error").html("");
                }
                if (Old_price == "") {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    $(".old_price_errro").html("Fill this input please !!");
                } else {
                    $(".old_price_errro").html("");
                }
                if (Current_price == "") {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    $(".currentprice_empty_error").html("Fill this input please !!");
                } else {
                    $(".currentprice_empty_error").html("");
                }
                if (Quantity == "") {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    $(".Quantity_error").html("Fill this input please !!");
                } else {
                    $(".Quantity_error").html("");
                }

                if (Description == "") {
                    $(".txt1_error").html("fill this Textarea !!");
                } else {
                    $(".txt1_error").html("");
                }
                if (ShortDes == "") {
                    $(".txt2_error").html("fill this Textarea !!");
                } else {
                    $(".txt2_error").html("");
                }
                if (Fetures == "") {
                    $(".txt3_error").html("fill this Textarea !!");
                } else {
                    $(".txt3_error").html("");
                }
                if (Conditions == "") {
                    $(".txt4_error").html("fill this Textarea !!");
                } else {
                    $(".txt4_error").html("");
                }
                if (ReturnPolicy == "") {
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
                $(".Quantity_error").html("");
                $(".currentprice_empty_error").html("");
                $(".old_price_errro").html("");
                $(".Product_name_error").html("");
                
                var picture_files_lengh = $('input[type="file"]').length;
                var data = new FormData();


                var cheakif_all_photoes_uplouded_or_not = 0;
                for (let i = 1; i <= picture_files_lengh; i++) {
                    var files = $(`#photo${i}`)[0].files;
                    if (files.length > 0) {
                        cheakif_all_photoes_uplouded_or_not++;
                        $(`.P_error_${i}`).html("");
                        data.append(`file${i}`, files[0]);
                    } else {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        $(`.P_error_${i}`).html("Select Photo !!");
                    }
                }
                data.append('picture_files_lengh', picture_files_lengh);
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
                if (cheakif_all_photoes_uplouded_or_not == picture_files_lengh) {
                    $.ajax({
                        url: './edit_add_delete_products.php?add=true',
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
                                var inputs = $("#form1 input");
                                var textareas = $("#form1 textarea");
                                var seelctions = $("#form1 select");
                                for (let i = 0; i < inputs.length; i++) {
                                    inputs.eq(i).val('');
                                }
                                for (let i = 0; i < textareas.length; i++) {
                                    textareas.eq(i).val('');
                                }
                                for (let i = 0; i < seelctions.length; i++) {
                                    seelctions.eq(i).prop('selectedIndex', 0);
                                }
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                            } else if (res.status == 405) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            }
                        },
                        error: function(error) {}
                    });
                }
            }
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

    </script>
</body>

</html>