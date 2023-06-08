<?php 
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
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
    </style>
</head>

<body>

    <div class="message"></div>
    <!-- Modal for  delete size  -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Slider </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:black">Are you sure you want to delete this Slider ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_slider" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for  delete size  -->


    <div class="container">
        <button class="btn btn-primary addslider" style="float:right ">Add Slider</button>
        <h2>View Sliders </h2>
        <hr>
        <table>
            <tr>
                <th>#</th>
                <th>slider Image</th>
                <th>Heading</th>
                <th>Content</th>
                <th>Button text</th>
                <th>Button url</th>
                <th>Position</th>
                <th>Action</th>

            </tr>
            <?php
            $counter  = 1;
            $query = $mysqli->query("SELECT * FROM tbl_slider");
            if (mysqli_num_rows($query) >= 1) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo  " <tr>";
                    echo "<td>";
                    echo $counter;
                    echo "</td>";
                    echo "<td>";
                    echo  "<img   width='140px' height='80px'  src=../Uploaded_images/" . $row["photo"] . ">";
                    echo "</td>";

                    echo "<td>";
                    echo $row["heading"];
                    echo "</td>";

                    echo "<td  style='width:200px'>";
                    echo $row["content"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["button_text"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["button_url"];
                    echo "</td>";

                    echo "<td>";
                    echo $row["position"];
                    echo "</td>";
                    echo "</td>";
                    echo "<td class='action'>";
                    echo "<form method='post'>";
                    echo  "<button  type='button' class='btn btn-primary  edit'>";
                    echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                    echo  "<button type='button' class='btn btn-danger  d   ml-3' data-toggle='modal' data-target='#deletemodal'>
                   <i class='bx bx-message-square-minus'></i>
                   </button>";
                    echo  '<input  hidden  type="text"  name ="slider_id" value="' . $row["id"] . '">';
                    echo "</form>";
                    echo "</td>";
                    echo " </tr>";
                    $counter = $counter + 1;
                }
            } else {
                echo  " <tr>";
                echo "<td>";
                echo "There is not any Slider  !";
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
        $(".addslider").click(function() {
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "addslider"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })
        $(".edit").click(function() {
            var slider_id = $(this).parent().find("input").val();
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "editslider",
                    slider_id: slider_id
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })


        $(".d").click(function() {
            var id = $(this).parent().find("input").val();

            $("#delete_slider").click(function() {

                setTimeout(function() {

                    $.ajax({
                        type: "post",
                        url: "edit_add_delete_slider.php",
                        data: {
                            id: id,
                            type: "delete"
                        },

                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 200) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                $('#reload').load(location.href + " #reload");
                                setInterval(() => $(".message").fadeOut(), 5000)

                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "ManageSliders"
                                    },
                                    success: function(d) {
                                        $('#deletemodal').modal('hide');
                                        $(".main_pannel").html(d);
                                    }
                                });

                            } else if (res.status == 400) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "ManageSliders"
                                    },
                                    success: function(d) {
                                        $('#deletemodal').modal('hide');
                                        $(".main_pannel").html(d);
                                    }
                                });

                            }
                        }
                    });
                }, 200);

            })

        })
    </script>
</body>

</html>