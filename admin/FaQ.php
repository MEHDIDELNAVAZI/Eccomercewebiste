<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( 'location:http://shop.test/not_found_page.php' ) );
    }  
include "./config_database.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fontawesome cdn For Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>servises</title>
    <style>
        table {
            width: 100%;
            height: 40px;
            font-size: 16px;
            text-align: center;
            margin-top: 30px;
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

        .addform input[type="text"] {
            width: 30%;
            height: 30px;
            padding: 10px;


        }

        .addform input {
            margin-top: 20px;
            padding: 5px;
        }


        .addform button {
            margin-top: 20px;
        }

        h1 {
            padding-top: 40px;
            padding-bottom: 40px;
            text-align: center;
            color: #957dad;
            font-family: 'Montserrat', sans-serif;
        }

        .side {
            margin-left: 0;
        }

        .btnss button {
            margin-left: 5px;
            border-color: #957dad !important;
            color: #888888 !important;
            margin-bottom: 25px;
        }

        .btnss button:hover {
            background-color: #fec8d8 !important;
        }

        textarea {
            padding: 10px;
            border-color: black solid 3px;
        }

        .flex-box {
            display: block;
        }

        #add_btn {
            color: white !important;
            background-color: blue;
            border-radius: 5px;
            width: 15%;
            padding: 5px;
        }

        #add_btn:hover {
            color: white !important;
            background-color: blue !important;
        }

        .viewservices {
            margin-top: 40px;
        }

        #btns button {
            z-index: 20;

        }

        .error {
            color: red;
            font-size: 13px;
        }

        .edit {
            color: white !important;
        }

        .edit:hover {
            background-color: #017BFE !important;
        }

        .delete {
            color: white !important;
            margin-left: 10px;
        }

        .delete:hover {
            background-color: #EF4056 !important;
        }

        #edit_service_form input {
            width: 60%;
            padding: 5px;
        }

        .er {
            color: red;
        }
    </style>
</head>


<body>

    <!-- Modal for  edit faq   -->
    <div class="modal fade   " id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit FAQ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_service_form" method="post">

                        <span type="text" id="edit_title" style="color:red"></span>
                        <div class="edit_title_error er"></div>
                        <br>
                        <textarea name="txtarea" id="textarea_edit_service" cols="40" rows="5" placeholder="Edit content"></textarea>
                        <div class="textarea_edit_service_error er"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="eidt_faq_btn"> Edit </button>
                </div>
                </form>

            </div>
        </div>
    </div>



    <!-- Modal for  delete faq  -->
    <div class="modal fade  " id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete FAQ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:black">Are you sure you want to delete this FAQ?!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_faq" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for  show content  -->
    <div class="modal fade" id="show_C" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="title_show_faq" style="color:red;padding-left:20px;padding-top:10px;font-size:18px"></span>
                <span class="modal-body" id="show_content_onmodal">

                </span>

            </div>
        </div>
    </div>
    <div class="message"></div>

    <div class="addservices container ">
        <h2>Add FAQ</h2>
        <hr>
        <div class="addform ">
            <form method="post" id="formid">


                <input type="text" placeholder="Title name" required style="display:block" id="title">
                <div id="title_error" class="error"></div>

                <div class="btnss">
                    <button type="button" onclick="f1()" class=" shadow-sm btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Bold Text">
                        Bold</button>
                    <button type="button" onclick="f2()" class="shadow-sm btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Italic Text">
                        Italic</button>
                    <button type="button" onclick="f3()" class=" shadow-sm btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Left Align">
                        <i class="fas fa-align-left"></i></button>
                    <button type="button" onclick="f4()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Center Align">
                        <i class="fas fa-align-center"></i></button>
                    <button type="button" onclick="f5()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Right Align">
                        <i class="fas fa-align-right"></i></button>
                    <button type="button" onclick="f6()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Uppercase Text">
                        Upper Case</button>
                    <button type="button" onclick="f7()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Lowercase Text">
                        Lower Case</button>
                    <button type="button" onclick="f8()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Capitalize Text">
                        Capitalize</button>
                    <button type="button" onclick="f9()" class="btn shadow-sm btn-outline-primary side" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Clear Text</button>

                    <textarea style="display:block" id="textarea1" class="input shadow" name="name" rows="10" cols="40" placeholder="Content">
                    </textarea>
                    <div id="textarea_error" class="error"></div>

                    <button id="add_btn" type='button' class='btn'>Add
                    </button>

                </div>
            </form>

        </div>
        <div class="viewservices container">
            <h2>View All FAQS
            </h2>
            <hr>

            <table>
                <tr>
                    <th>#</th>
                    <th> Title </th>
                    <th> Content</th>
                    <th>Actions</th>
                </tr>

                <?php
                $query = $mysqli->query("SELECT * FROM tbl_faq ");
                $counter  = 1;
                if (mysqli_num_rows($query) == 0) {
                    echo  "<tr>";
                    echo "<td>";
                    echo "1";
                    echo "</td>";
                    echo "<td>";
                    echo "There is not any FAQ !";
                    echo "</td>";
                    echo "<td>";
                    echo "_______";
                    echo "</td>";
                    echo "<td>";
                    echo "_______";
                    echo "</td>";

                    echo "</tr>";
                } else {
                    while ($r = mysqli_fetch_assoc($query)) {
                        $faq_content  = $r["faq_content"];
                        $faq_title  = $r["faq_title"];
                        $faq_id = $r["faq_id"];
                        echo  "<tr>";
                        echo "<td>";
                        echo $counter;
                        echo "</td>";
                        echo "<td>";
                        echo $faq_title;
                        echo "</td>";
                        echo "<td>";
                        echo  "<div class= 'content'>";
                        echo "CONTENT : <button type='button' class='show_content' data-toggle='modal' data-target='#show_C'>
                        <i class='bx bxs-show'></i>
                        </button>";
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $faq_id . '">';
                        echo  '<input  hidden  type="text"  name ="tcat_id" value="' . $faq_title . '">';

                        echo  "</div>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='post' id='edittcat'>";
                        echo  '<input  hidden  type="text"  name ="faq_id" value="' . $faq_id . '">';
                        echo  '<input    hidden  type="text"  name ="faq_title" value="' . $faq_title . '">';

                        echo  "    <button   type='button' class='btn btn-primary   Edit  ' data-toggle='modal' data-target='#edit_modal'>";
                        echo  "<i class='bx bxs-edit-alt' style='font-size: 16px;' ></i>   </button>";
                        echo  "<button type='button' class='btn btn-danger  delete' data-toggle='modal' data-target='#deletemodal'>
            <i class='bx bx-message-square-minus'></i>
            </button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                }
                ?>
        </div>

        </table>

        <!--External JavaScript file-->
        <script>
            function f1() {
                //function to make the text bold using DOM method
                document.getElementById("textarea1").style.fontWeight = "bold";
            }

            function f2() {
                //function to make the text italic using DOM method
                document.getElementById("textarea1").style.fontStyle = "italic";
            }

            function f3() {
                //function to make the text alignment left using DOM method
                document.getElementById("textarea1").style.textAlign = "left";
            }

            function f4() {
                //function to make the text alignment center using DOM method
                document.getElementById("textarea1").style.textAlign = "center";
            }

            function f5() {
                //function to make the text alignment right using DOM method
                document.getElementById("textarea1").style.textAlign = "right";
            }

            function f6() {
                //function to make the text in Uppercase using DOM method
                document.getElementById("textarea1").style.textTransform = "uppercase";
            }

            function f7() {
                //function to make the text in Lowercase using DOM method
                document.getElementById("textarea1").style.textTransform = "lowercase";
            }

            function f8() {
                //function to make the text capitalize using DOM method
                document.getElementById("textarea1").style.textTransform = "capitalize";
            }

            function f9() {
                //function to make the text back to normal by removing all the methods applied 
                //using DOM method
                document.getElementById("textarea1").style.fontWeight = "normal";
                document.getElementById("textarea1").style.textAlign = "left";
                document.getElementById("textarea1").style.fontStyle = "normal";
                document.getElementById("textarea1").style.textTransform = "capitalize";
                document.getElementById("textarea1").value = " ";
            }

            $("#add_btn").click(function() {
                var title = $("#title").val().trim();
                var content = $("#textarea1").val().trim();

                if (content == "" || title == "") {

                    if (content == "") {
                        $("#textarea_error").html("Fill textarea  filed !");
                    } else {
                        $("#textarea_error").html("");
                    }
                    if (title == "") {
                        $("#title_error").html("Fill Title  filed !");
                    } else {
                        $("#title_error").html("");
                    }

                } else {
                    $("#title_error").html("");
                    $("#textarea_error").html("");
                    var fd = new FormData();
                    fd.append('content', content);
                    fd.append('title', title);

                    $.ajax({
                        url: 'edit_add_delete_faq.php?add=true',
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

                                $.ajax({
                                    type: "post",
                                    url: "../fetchdata/fetchdata_adminpanel.php",
                                    data: {
                                        panel: "FaQ"
                                    },
                                    success: function(d) {
                                        $(".main_pannel").html(d);
                                    }
                                });
                            } else if (res.status == 401) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            } else if (res.status == 405) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            } else if (res.status == 400) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            } else if (res.status == 202) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                            }



                        },
                    });

                }
            });


            $(".delete").click(function() {
                var s = $(this).parent().find("input");
                var Service_id = s[0].value;

                $("#delete_service").click(function() {

                    setTimeout(function() {

                        $.ajax({
                            type: "post",
                            url: "edit_add_delete_services.php?delete=true",
                            data: {
                                Service_id: Service_id
                            },
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
                                            panel: "Services"
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

                                }
                            }
                        });
                    }, 200);

                })
            })

            $(".show_content").click(function() {
                fg = $(this).parent().find("input");
                faq_id = fg[0].value;
                faq_title = fg[1].value;
                $("#title_show_faq").html(faq_title);

                $.ajax({
                    type: "post",
                    url: "../fetchdata/fetch_show_content_by_faq_id.php",
                    data: {
                        faq_id: faq_id
                    },
                    success: function(d) {
                        $("#show_content_onmodal").html(d);
                    }
                });

            })


            $(".delete").click(function() {
                faq_id = $(this).parent().find("input").val();
                $("#delete_faq").click(function() {
                    $.ajax({
                        type: "post",
                        url: "edit_add_delete_faq.php?delete=true",
                        data: {
                            faq_id: faq_id
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
                                            panel: "FaQ"
                                        },
                                        success: function(d) {
                                            $('#deletemodal').modal('hide');
                                            $(".main_pannel").html(d);
                                        }
                                    });
                                }, 200);


                            } else if (res.status == 400) {
                                $(".message").css("display", "block");
                                $(".message").html(res.message);
                                setInterval(() => $(".message").fadeOut(), 5000)
                                setTimeout(function() {
                                    $.ajax({
                                        type: "post",
                                        url: "../fetchdata/fetchdata_adminpanel.php",
                                        data: {
                                            panel: "FaQ"
                                        },
                                        success: function(d) {
                                            $('#deletemodal').modal('hide');
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
                });
            })

            //edit 
            $(".Edit").click(function() {
                inputs = $(this).parent().find("input");
                faq_id = inputs[0].value;


                $.ajax({
                    type: "post",
                    url: "../fetchdata/fetch_show_content_by_faq_id.php",
                    data: {
                        faq_id: faq_id
                    },
                    success: function(d) {
                        $("#textarea_edit_service").val(d);
                    }
                });


                $("#eidt_faq_btn").click(function() {
                    var title = $("#edit_title").val();
                    var content = $("#textarea_edit_service").val();

                    if (content == "") {
                        $(".textarea_edit_service_error").html("Fill textarea  filed !");
                    } else {
                        $(".textarea_edit_service_error").html("");

                        var new_content = $("#textarea_edit_service").val();

                        $.ajax({
                            url: 'edit_add_delete_faq.php?edit=true',
                            type: 'post',
                            data: {
                                faq_id: faq_id,
                                new_content: new_content
                            },
                            success: function(response) {
                                var res = jQuery.parseJSON(response);

                                if (res.status == 200) {
                                    $(".message").css("display", "block");
                                    $(".message").html(res.message);
                                    setInterval(() => $(".message").fadeOut(), 5000)
                                    $('#edit_modal').modal('hide');
                                    setTimeout(function() {
                                        $.ajax({
                                            type: "post",
                                            url: "../fetchdata/fetchdata_adminpanel.php",
                                            data: {
                                                panel: "FaQ"
                                            },
                                            success: function(d) {
                                                $(".main_pannel").html(d);
                                            }
                                        });
                                    }, 200);
                                } else if (res.status == 401) {
                                    $(".message").css("display", "block");
                                    $(".message").html(res.message);
                                    setInterval(() => $(".message").fadeOut(), 5000)
                                } else if (res.status == 405) {
                                    $(".message").css("display", "block");
                                    $(".message").html(res.message);
                                    setInterval(() => $(".message").fadeOut(), 5000)
                                } else if (res.status == 400) {
                                    $(".message").css("display", "block");
                                    $(".message").html(res.message);
                                    setInterval(() => $(".message").fadeOut(), 5000)
                                } else if (res.status == 202) {
                                    $(".message").css("display", "block");
                                    $(".message").html(res.message);
                                    setInterval(() => $(".message").fadeOut(), 5000)
                                }
                            },
                        });

                    }

                })


            })
        </script>
    </div>

</body>

</html>