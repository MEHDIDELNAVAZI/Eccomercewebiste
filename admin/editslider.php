<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:http://shop.test/not_found_page.php'));
}
include "../config_database.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit slider </title>
    <style>
        img {
            box-shadow: 1px 1px 1px 1px gray;
            border-radius: 5px;
        }

        .error {
            font-size: 15px;
            color: red;
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

        label {
            width: 200px;
        }

        input {
            width: 300px;
            height: 34px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="message"></div>

    <div class="container">
        <button style="float:right;" class="btn btn-primary add-slider ">Add Slider</button>
        <button style="float:right;" class="btn btn-primary view_slider mr-3 ">View Sliders</button>
        <h2>Edit slider</h2>
        <hr>

        <?php
        $query  = $mysqli->query("SELECT * FROM tbl_slider WHERE id='$slider_id'");
        while ($r = mysqli_fetch_assoc($query)) {
            $pos = $r["position"];
        ?>
            <div class="imageSlides ">
                <img id="sliderimage_1" height="300px" src="../Uploaded_images/<?php echo $r["photo"] ?>" alt="slider image">
            </div>
            <br>
            <form id="editphoto" method="post">
                <label for="editphoto">
                    <h5>Edit photo *</h5>
                </label>
                <input type="file" id="picture">
                <button type="button" class="btn btn-primary Edit_photo_slider">Edit</button>
            </form>


            <form method="post" id="editslider">

                <label for="heading">
                    <h5>Heading * </h5>
                </label>
                <input type="text" id="heading" placeholder="Heading" value="<?php echo $r["heading"] ?>">
                <span class="headingerror error"></span>

                <br>
                <label for="content">
                    <h5>Button text *</h5>
                </label>
                <input type="text" id="buttontext" placeholder="Button text" value="<?php echo $r["button_text"] ?>">
                <span class="buttontexterror  error  "></span>

                <br>
                <br>
                <label for="content">
                    <h5>Content *</h5>
                </label>
                <textarea placeholder="Content for this Slider " id="txt1" rows="10" cols="60" style="display: block;"><?php echo $r["content"] ?></textarea>
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
                <input type="text" id="url" placeholder="URL" value="<?php echo $r["button_url"] ?>">
                <span class="urlerror  error  "></span>


            </form>


            <button class="btn btn-primary editslider" style="width: 200px;">Edit</button>


        <?php
        }
        ?>




    </div>
    <script>
        $(".add-slider").click(function() {
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
        $(".view_slider").click(function() {
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


        var pos = "<?php echo $pos ?>";

        $(".Edit_photo_slider").click(function() {
            var fd = new FormData();
            var files = $('#picture')[0].files;
            var slider_id = <?php echo $slider_id ?>;
            if (files.length > 0) {
                var filename = document.getElementById('picture').files[0].name;
                fd.append('file', files[0]);
                fd.append("type", "editphoto")
                fd.append("slider_id", slider_id)
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
                            var newsrc = "../Uploaded_images/" + filename;
                            $("#sliderimage_1").attr("src", newsrc);
                        } else if (res.status == 400) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                        }
                    },
                });
            } else {
                alert("Please select a file.");
            }
        })
        document.getElementById('position').value = pos;



        $(".editslider").click(function() {

            var inputs = $("#editslider input");
            var heading = inputs[0].value;
            var buttontext = inputs[1].value;
            var url = inputs[2].value;
            var content = $("#txt1").val().trim();
            var position = $("#editslider  select").val();
            var fd = new FormData();
            var slider_id = <?php echo $slider_id ?>


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
                fd.append("heading", heading);
                fd.append("buttontext", buttontext);
                fd.append("url", url);
                fd.append("content", content);
                fd.append("position", position);
                fd.append("type", "edit");
                fd.append("slider_id", slider_id);


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
                        } else if (res.status == 400) {
                            $(".message").css("display", "block");
                            $(".message").html(res.message);
                            setInterval(() => $(".message").fadeOut(), 5000)
                        }
                    },
                });
            }
        })
    </script>

</body>

</html>