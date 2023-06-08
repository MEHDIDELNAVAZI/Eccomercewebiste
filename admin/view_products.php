<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
include "../config_database.php";
include "../admin/functions/ecat_id_to_catgeory.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View products </title>
    <style>
        table {
            width: 100%;
            height: 40px;
            font-size: 16px;
            text-align: center;
        }

        table td,
        th {
            border: solid #DFDEE0 1px;
            padding: 5px;
            border: solid #808080 1px;

        }

        table th {
            background-color: #FFFFFF;
        }

        td {
            background-color: #E0E0E0;
        }

        .yes {
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }

        .no {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;

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
    <!-- Modal   -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:black">Are you sure you want to delete this Product ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_products" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal   -->


    <div class="container">
        <button style="float:right;" class="btn btn-primary add-pr ">Add Product</button>
        <h2>View Products</h2>
        <hr>
        <table>
            <tr>
                <th>#</th>
                <th>Product Image</th>
                <th>Product name</th>
                <th>Old Price</th>
                <th>Current Price</th>
                <th>Quantity</th>
                <th>Fetured ?</th>
                <th>Actived ?</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php
            $counter  = 1;

            $query = $mysqli->query("SELECT * FROM tbl_product");
            if (mysqli_num_rows($query) >= 1) {


                while ($row = mysqli_fetch_assoc($query)) {
                    echo  " <tr>";
                    echo "<td>";
                    echo $counter;
                    echo "</td>";


                    echo "<td>";
                    echo  "<img   width='80px' height='80px'  src=../Uploaded_images/" . $row["p_featured_photo"] . ">";
                    echo "</td>";

                    echo "<td>";
                    echo $row["p_name"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["p_old_price"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["p_current_price"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["p_qty"];
                    echo "</td>";

                    echo "<td>";
                    if ($row["p_is_featured"] == 1) {
                        echo "<span class='yes'>Yes</span>";
                    } else {
                        echo "<span class='no'>No</span>";
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($row["p_is_active"] == 1) {
                        echo "<span class='yes'>Yes</span>";
                    } else {
                        echo "<span class='no'>No</span>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo  Convert_ecatid_tocatgeory((int)$row["ecat_id"]);
                    echo "</td>";
                    echo "</td>";
                    echo "<td class='action'>";
                    echo "<form method='post'>";
                    echo  "<button  type='button' class='btn btn-primary  edit'>";
                    echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                    echo  "<button type='button' class='btn btn-danger  d   ml-3' data-toggle='modal' data-target='#deletemodal'>
                <i class='bx bx-message-square-minus'></i>
                </button>";
                    echo  '<input   hidden  type="text"  name ="P-id" value="' . $row["p_id"] . '">';
                    echo "</form>";
                    echo "</td>";
                    echo " </tr>";
                    $counter = $counter + 1;
                }
            } else {
                echo  " <tr>";
                echo "<td>";
                echo "There is not any product  !";
                echo "</td>";


                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";

                echo "<td>";
                echo "_______";
                echo "</td>";
                echo "<td>";
                echo "_______";
                echo "</td>";
                echo "</td>";
                echo "<td class='action'>";
                echo "_______";
                echo "</td>";
                echo " </tr>";
            }
            ?>
        </table>
    </div>
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


        $(".d").click(function() {
            id = $(this).parent().find("input").val();

            $("#delete_products").click(function() {
                $.ajax({
                    url: './edit_add_delete_products.php?delete=true',
                    type: 'POST',
                    data: {
                        p_id: id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                            setTimeout(function() {
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
                            }, 200);
                        } else if (res.status == 405) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                        }
                    }
                });
            })
        })
        $(".edit").click(function() {
            window.scrollTo({
            top: 0,
            behavior: 'smooth'
            });
            pid = $(this).parent().find("input").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "edit_product",
                    id:pid
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })
    </script>
</body>

</html>