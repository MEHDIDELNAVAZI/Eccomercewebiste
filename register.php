<?php
session_start() ;
if(isset($_GET["userexist"]) && $_GET["userexist"] == "true") {
   echo  "
   <script>
   document.getElementsByClassName('.message').style.display = 'block' ;
   document.getElementsByClassName('.message').style.visibility = 'visibile' ;
   </script>
   ";
}
if(isset($_SESSION["verifyemail"])) {
    if($_SESSION["verifyemail"] == "verified") {
        header("location:index.php") ;
    }
}

else {

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title> Register page for user </title>
    <style>
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(#FFCCFF, #CCFFFF)
        }

        .login-box {
            width: 500px;
            height: 470px;
            color: black;
            font-size: 20px;
            border-radius: 10px;
            border: solid black 1px;
            box-shadow: 1px 1px 1px 1px gray;
            position: absolute;
            background-color: white;
            text-align: center;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .login-box input[type="text"],
        input[type="password"] {
            width: 70%;
            height: 20px;
            height: 30px;
            font-size: 15px;
            padding: 10px;
            border: none;
            border-bottom: solid black 2px;
            position: relative;
        }

        .login-box input[type="submit"] {
            width: 40%;
            height: 40px;
            line-height: 30px;
            background-color: aquamarine;
            border-radius: 10px;
            margin-top: 50px;
        }
        .login-box input[type="text"],
        input[type="password"] {
            margin-top: 20px;
            outline: none;
            position: relative;
        }
        .title {
            font-size: 30px;
        }

        .txtfield {
            width: 500px;
            text-align: center;
        }

        a {
            font-size: 14px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .email-validation-error {
            display: block;
            color: red;
            font-size: 15px;
            text-align: left;
            margin-left: 85px;
            margin-top: 5px;
        }

        .text-error {
            display: block;
            color: red;
            font-size: 15px;
            text-align: left;
            margin-left: 85px;
            margin-top: 5px;
        }

        .password-power {

            width: 65%;
            height: 10px;
            background-color: white;
            border: solid black 1px;
            text-align: left;
            margin-left: 85px;
            margin-top: 20px;
            display: block;
            border-radius: 10px;
            display: none;
        }

        .fillpower {
            height: 8px;
            display: inline-block;
            border-radius: 20px;
        }

        label {
            position: absolute;
            left: 400px;
        }

        .input-container {
            position: relative;
        }

        .input-container2 {
            position: relative;
        }

        .input-container img {
            position: absolute;
            right: 60px;
            top: 20px;
            cursor: pointer;
        }

        .input-container2 img {
            position: absolute;
            right: 60px;
            top: 20px;
            cursor: pointer;
        }

        .message {
        width: 100%;
        background-color: black;
        opacity: 0.4;
        color: black;
        height: 50px;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        visibility: hidden;
        }




        @media (max-width: 641px) {
            .login-box {
                width: 400px;
            }

            .txtfield {
                width: 400px !important;
            }
        }

        @media (max-width: 420px) {
            .login-box {
                width: 320px;
            }

            .txtfield {
                width: 320px !important;
            }

            .email-validation-error {
                margin-left: 40px;
            }
        }
    </style>
</head>

<body>
  <div class="message"><span  class="messagetext">error</span></div>
    <div class="login-box">

        <div class="center">
            <div class="title">Register</div>
            <hr>
            <form action="register_saveto_database.php" method="post">
                <div class="txtfield">
                    <input class="name" type="text" placeholder="Enter you name " name="name" required>
                    <input type="hidden" value="emailverify_notverfied" name="emailverify">
                    <span class="text-error"></span>

                    <input class="email" type="text" placeholder="Enter you email " name="email" required>
                    <span class="email-validation-error"></span>
                    <div class="input-container">
                        <input class="password" type="password" placeholder="Enter your password " name="password" required>

                        <img src="./icons/icons8-hide-30.png" alt="hide eyes for  password" width="20" height="20">

                    </div>
                    <span class="password-power">
                        <span class="fillpower"></span>
                    </span>

                    <div class="input-container2">
                        <input class="confirm_passwword" type="password" placeholder="Confirm-password " name="Confirm-password" required>

                        <img src="./icons/icons8-hide-30.png" alt="hide eyes for  password" width="20" height="20">

                    </div>

                    <input type="submit" value="Register" class="submit" disabled>
                    <p class="registerpage">
                        <span style="color:gray;font-size : 16px"> Already have an acount ?</span>
                        <a href="./login.php">Login</a>
                    </p>
                </div>
            </form>



        </div>
    </div>


    <script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script>
        var emailvalidation = false;
        var namevalidation = false;
        var passwordconfirmvalidation = false;


        //chek for password strengh  in this function 
        function checkPasswordStrength(password) {
            // Initialize variables
            var strength = 0;
            var tips = "";

            // Check password length
            if (password.length < 8) {
                tips += "Make the password longer. ";
            } else {
                strength += 1;
            }

            // Check for mixed case
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
                strength += 1;
            } else {
                tips += "Use both lowercase and uppercase letters. ";
            }

            // Check for numbers
            if (password.match(/\d/)) {
                strength += 1;
            } else {
                tips += "Include at least one number. ";
            }

            // Check for special characters
            if (password.match(/[^a-zA-Z\d]/)) {
                strength += 1;
            } else {
                tips += "Include at least one special character. ";
            }

            // Return results
            return strength
        }


        //end of the password strengh function
        //is numeric function in js 
        function containsNumbers(str) {
            return Boolean(str.match(/\d/));
        }
        //end fo the isnumbric fucntion 


        var emialinput = $(".email")
        var passwordpower = $(".fillpower")
        var password = $(".password")
        emialinput.keydown(function() {

            var emialvalidation = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-][a-zA-Z0-9-]+$/;

            if (emialinput.val().match(emialvalidation)) {
                emailvalidation = true;
                document.querySelector(".email-validation-error").innerHTML = '<img src="./icons/icons8-checkmark-48.png" alt="cheak icon" width="20" height="20">'
            } else {
                document.querySelector(".email-validation-error").innerHTML = "Format of the email is not Correct !"
                emailvalidation = false;
            }
            if (emailvalidation && passwordconfirmvalidation && namevalidation) {
                $(".submit").prop('disabled', false);
            } else {
                $(".submit").prop('disabled', true);
            }




        })
        password.focus(function() {
            $(".password-power ").css("display", "block")
        })
        password.keydown(function() {

            if (checkPasswordStrength(password.val()) < 2) {
                $(".fillpower").css("width", "20%")
                $(".fillpower").css("background-color", "#FF6666")
            } else if (checkPasswordStrength(password.val()) === 2) {
                $(".fillpower").css("width", "40%")
                $(".fillpower").css("background-color", "#FF9933")
            } else if (checkPasswordStrength(password.val()) === 3) {
                $(".fillpower").css("width", "60%")
                $(".fillpower").css("background-color", "#99FF99")
            } else {
                $(".fillpower").css("width", "100%")
                $(".fillpower").css("background-color", "#00FF00")
            }
        })



        //hide eye for  password  
        var hide = $(".input-container img ");
        var hidebool = true;
        hide.click(function() {
            if (hidebool) {
                hidebool = false
                $(".input-container img ").attr("src", "./icons/icons8-eye-30 (1).png")
                $(".password").attr("type", "text")
            } else {
                hidebool = true;
                $(".input-container img ").attr("src", "./icons/icons8-hide-30.png")
                $(".password").attr("type", "password")
            }
        })

        var hide2 = $(".input-container2 img ");
        var hidebool2 = true;
        hide2.click(function() {
            if (hidebool2) {
                hidebool2 = false
                $(".input-container2 img ").attr("src", "./icons/icons8-eye-30 (1).png")
                $(".confirm_passwword").attr("type", "text")
            } else {
                hidebool2 = true;
                $(".input-container2 img ").attr("src", "./icons/icons8-hide-30.png")
                $(".confirm_passwword").attr("type", "password")
            }
        })

        $(".confirm_passwword").keyup(function() {
            var passwordvalue = $(".password").val()
            if ($(".confirm_passwword").val() !== passwordvalue) {
                $(".confirm_passwword").css("border-bottom", "solid red 3px")
                passwordconfirmvalidation = false;
            } else {
                passwordconfirmvalidation = true;
                $(".confirm_passwword").css("border-bottom", "solid green 3px")
            }

            if (emailvalidation && passwordconfirmvalidation && namevalidation) {
                $(".submit").prop('disabled', false);
            } else {
                $(".submit").prop('disabled', true);
            }
        })
        password.keyup(function() {
            var passwordvalue = $(".password").val()
            if ($(".confirm_passwword").val() !== passwordvalue) {
                $(".confirm_passwword").css("border-bottom", "solid red 3px")
            } else {
                $(".confirm_passwword").css("border-bottom", "solid green 3px")
            }

            if ($(".confirm_passwword").val() !== password.val()) {
                passwordconfirmvalidation = false;
            } else {
                passwordconfirmvalidation = true;
            }

            if (emailvalidation && passwordconfirmvalidation && namevalidation) {
                $(".submit").prop('disabled', false);
            } else {
                $(".submit").prop('disabled', true);
            }
        })

        $(".name").keyup(function() {
            if (containsNumbers($(".name").val())) {
                document.querySelector(".text-error").innerHTML = "Do not enter numbers for name field !"
                namevalidation = false;
            } else {
                namevalidation = true;
                document.querySelector(".text-error").innerHTML = "";
            }

            if (emailvalidation && passwordconfirmvalidation && namevalidation) {
                $(".submit").prop('disabled', false);
            } else {
                $(".submit").prop('disabled', true);
            }
        })



    </script>
</body>

</html>

<?php
}
?>