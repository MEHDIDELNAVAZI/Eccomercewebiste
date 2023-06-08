<?php

    
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$Db_name  = "EcommerceWebsite";
$mysqli = new mysqli;
$conn = $mysqli->connect($servername, $username, $password, $Db_name);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (
    isset($_GET["resendcode"])
    && $_GET["resendcode"] == "yep"
) {
    require "./phpmailer/Exception.php";
    require  "./phpmailer/SMTP.php";
    require  "./phpmailer/PHPMailer.php";

    $_SESSION["timer"] = 60;
    $_SESSION["varifyrandomcode"] = random_int(1000, 9999);
    // verify code will send to the email 
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "delnavazi1029@gmail.com";
    $mail->Password = "hfairhsvdqlguwwm ";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom("delnavazi1029@gmail.com");
    $mail->addAddress($_SESSION["emailuser"]);
    $mail->isHTML(true);
    $mail->Subject = "verify code for email :| ";
    $mail->Body = "please write this code to the verify paeg :  " . $_SESSION["varifyrandomcode"];
    $mail->send();
}

if (!(isset($_SESSION["verifyemail"])) && !($_SESSION['verifyemail'] == "verified")) {

    if (isset($_GET["verifyemail"])) {
        if ($_SESSION["verifyemail"] != "verified") {
            if ($_GET["verifyemail"] == "notverified") {

                require "./phpmailer/Exception.php";
                require  "./phpmailer/SMTP.php";
                require  "./phpmailer/PHPMailer.php";

                $_SESSION["timer"] = 60;
                $_SESSION["varifyrandomcode"] = random_int(1000, 9999);
                // verify code will send to the email 
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "delnavazi1029@gmail.com";
                $mail->Password = "hfairhsvdqlguwwm ";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->setFrom("delnavazi1029@gmail.com");
                $mail->addAddress($_SESSION["emailuser"]);
                $mail->isHTML(true);
                $mail->Subject = "verify code for email :| ";
                $mail->Body = "please write this code to the verify paeg :  " . $_SESSION["varifyrandomcode"];
                $mail->send();
            }
        } else {
            header("location:index.php");
        }
    } else {
        if (isset($_GET["cheakverify"])) {
            if ($_GET["cheakverify"] ==  "true") {
                $inputnumber  =  1000 * $_POST["1000gan"] + 100 * $_POST["100gan"] + 10 * $_POST["10gan"]
                    + $_POST["yekan"];
                if ($inputnumber === $_SESSION["varifyrandomcode"]) {

                    $_SESSION["verifyemail"] = "verified";
                    
                    header("location:register_saveto_database.php?registered=successfull");
                } else {
                    header("location:verifyemail.php?verifycode=false");
                }
            }
        } else {

            if (isset($_GET["verifycode"])) {
                if ($_GET["verifycode"] == "false ") {
                    header("location:index.php?login=success");
                }
            } else {
                header("location:register.php");
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


        <style>
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background: linear-gradient(#FFCCFF, #CCFFFF)
            }

            .verifybox {
                width: 550px;
                height: 400px;
                border: solid black 1px;
                position: absolute;
                right: 0;
                left: 0;
                bottom: 0;
                top: 0;
                margin: auto;
                box-shadow: solid black 2px;
                background-color: white;
                text-align: center;
                border-radius: 10px;
            }

            form {
                margin-top: 50px;

            }

            input[type="number"] {
                width: 100px;
                height: 100px;
                font-size: 60px;
                text-align: center;
                border-radius: 5px;
                padding: 10px;
                margin-left: 20px;
            }

            .code::-webkit-outer-spin-button,
            .code::-webkit-inner-spin-button {
                margin: 0;
                -webkit-appearance: none;
            }

            input[type="submit"] {
                font-size: 20px;
                width: 40%;
                height: 40px;
                background-color: greenyellow;
                color: black;
                border-radius: 5px;
                margin-top: 50px;
                cursor: pointer;
            }

            input[type="submit"]::after {
                width: 50px;
                height: 40px;
                background-color: red;
                content: "";
            }

            .error {
                color: red;
                font-size: 15px;
                display: block;
                margin-top: 10px;
            }

            .resendcodebtn {
                width: 200px;
                height: 40px;
                background-color: gray;
                color: black;
                border-radius: 5px;
                border: solid black 1px;
                line-height: 40px;
                align-items: center;
                margin: auto;
                cursor: pointer;
            }

            .timer {
                float: right;
                margin-right: 10px;
            }
        </style>
    </head>

    <body>

        <div class="verifybox">
            <?php
            echo  " <h1> verify code Sent to : </h1> " .
                $_SESSION["emailuser"];
            ?>
            <form action="verifyemail.php?cheakverify=true" method="post">
                <input type="number" placeholder="0" required min="0" max="9" class="code   " name="1000gan">
                <input type="number" placeholder="0" required min="0" max="9" class="code   " name="100gan">
                <input type="number" placeholder="0" required min="0" max="9" class="code   " name="10gan">
                <input type="number" placeholder="0" required min="0" max="9" class="code   " name="yekan">
                <span class="error"></span>
                <input type="submit" value="Verify">
            </form>

            <button disabled  class="resendcodebtn">
                <span>Resend code</span>
                <span class="timer">
                </span>

            </button>

        </div>

        <script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
        <script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

        <script>
            var verifycode = <?php echo  $_SESSION["varifyrandomcode"]  ?>;
            var timer  = 60  ;
            
            const codes = document.querySelectorAll(".code");
            let Codes = $(".code");

            var timerfornumber = setInterval(() => {
                 timer-- ;
                if (timer  ==  0) {
                    clearInterval(timerfornumber);
                    $(".resendcodebtn").prop('disabled', false);
                    $(".resendcodebtn").css("background","greenyellow")
                    <?php
                    $_SESSION["timer"]  = $_SESSION["timer"] - 1;
                    ?>
                }
                document.querySelector(".timer").innerHTML = timer ;
            }, 1000);


            codes.forEach((code, idx) => {
                code.addEventListener("keydown", (e) => {
                    console.log(code.value);
                    if (e.key >= 0 && e.key <= 9) {
                        codes[idx].value = "";
                        setTimeout(() => {
                            codes[idx + 1].focus()
                        }, 10);
                    } else if (e.key === "Backspace") {
                        setTimeout(() => codes[idx - 1].focus(), 10);
                    }
                });
            });



            $(".resendcodebtn").click(function() {
                timer = 60  ;
                $(".resendcodebtn").prop('disabled', true);
                    $(".resendcodebtn").css("background","gray")
                $.ajax({
                    url: "verifyemail.php?resendcode=yep",
                    type: "post",
                    data: {},
                    cache: false,
                    success: function(dataresult) {
                        var dataresult = JSON.parse(dataresult);
                        if (dataresult.statusCode == 200) {

                        } else if (dataresult.statusCode == 201) {

                        } else if (dataresult.error_status == 300) {

                        }

                    }
                })


            })
        </script>
    </body>

    </html>


<?php

} else {
    header("location:index.php");
}
?>