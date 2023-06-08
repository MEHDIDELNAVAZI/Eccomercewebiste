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
    <title>Add slider</title>
    <style>
        .error {
            font-size: 15px;
            color: red;
        }

        input {
            width: 300px;
            height: 34px;
            padding: 5px;
        }

        label {
            width: 200px;
        }

        select {
            padding: 5px;
            width: 300px;
            height: 34px;
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

    <div class="container">
        <button class="btn btn-primary Viewslider" style="float:right ">View Slider</button>
        <h2> Add Sliders </h2>
        <hr>

        <form method="post" class="addsliderform">
            <label for="tcat">
                <h5>Add Photo * </h5>
            </label>
            <input type="file" class="pic" id="picture">

            <br>

            <label for="tcat">
                <h5>Heading * </h5>
            </label>
            <input type="text" id="heading" placeholder="Heading">
            <span class="headingerror error"></span>


            <br>
            <label for="content">
                <h5>Button text *</h5>
            </label>
            <input type="text" id="buttontext" placeholder="Button text">
            <span class="buttontexterror  error  "></span>

            <br>
            <br>
            <label for="content">
                <h5>Content *</h5>
            </label>
            <textarea placeholder="Content for this Slider " id="txt1" rows="10" cols="60" style="display: block;"> </textarea>
            <span class="contenterror  error"></span>

            <br>
            <label for="position">
                <h5>Position *</h5>
            </label>
            <select name="position" id="position">
                <option value="top">Top</option>
                <option value="bottom">Bottom</option>
                <option value="center">Center</option>
                <option value="left">Left</option>
                <option value="right">Right</option>
            </select>
            <br>

            <label for="url">
                <h5>url *</h5>
            </label>
            <input type="text" id="url" placeholder="URL">
            <span class="urlerror  error  "></span>


        </form>

        <button class="btn btn-primary addbtn" style="width:200px;margin-top:20px">Add</button>

    </div>


    <script>
        $(".Viewslider").click(function() {
            $.ajax({
                type: "post",
                url: "../fetchdata/fetchdata_adminpanel.php",
                data: {
                    panel: "ManageSliders"
                },
                success: function(d) {
                    $(".main_pannel").html(d);
                }
            });
        })

        $(".addbtn").click(function() {

            var inputs = $(".addsliderform input");
            var heading = inputs[1].value;
            var buttontext = inputs[2].value;
            var url = inputs[3].value;
            var content = $("#txt1").val().trim();
            var position = $(".addsliderform  select").val();

            var fd = new FormData();
            var files = $('#picture')[0].files;
            if (files.length > 0) {

                if (heading == "" || buttontext == "" || url == "" || content == "") {

                    if (content == "") {
                        $(".contenterror").html("Fill this Field please !");
                    } else {
                        $(".contenterror").html("");
                    }
                    if (heading == "") {
                        $(".headingerror").html("Fill this Field please !");
                    } else {
                        $(".headingerror").html("");
                    }
                    if (buttontext == "") {
                        $(".buttontexterror").html("Fill this Field please !");
                    } else {
                        $(".buttontexterror").html("");
                    }
                    if (url == "") {
                        $(".urlerror").html("Fill this Field please !");
                    } else {
                        $(".urlerror").html("");
                    }
                } else {
                    $(".contenterror").html("");
                    $(".headingerror").html("");
                    $(".buttontexterror").html("");
                    $(".urlerror").html("");
                    fd.append('file', files[0]);
                    fd.append("heading", heading);
                    fd.append("buttontext", buttontext);
                    fd.append("url", url);
                    fd.append("content", content);
                    fd.append("position", position);
                    fd.append ("type","add")

                    $.ajax({
                        url: 'edit_add_delete_slider.php',
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

                                var inputs = $("input");
                                var textareas = $("textarea");

                                for (let i = 0; i < inputs.length; i++) {
                                    inputs.eq(i).val('');
                                }
                                for (let i = 0; i < textareas.length; i++) {
                                    textareas.eq(i).val('');
                                }
                                
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
            } else {
                alert("Please select a file.");
            }









        })
    </script>
</body>

</html>