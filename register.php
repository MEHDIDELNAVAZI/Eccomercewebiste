<?php
include  "../shop/config_database.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: http://shop.test");
    die();
}


require   "../shop/assets/phpmailer/Exception.php";
require  "../shop/assets/phpmailer/SMTP.php";
require  "../shop/assets/phpmailer/PHPMailer.php";
$msg = "";

if (isset($_POST['submit'])) {
    if (isset($_POST['g-recaptcha-response'])) {

        $recaptcha_response = $_POST['g-recaptcha-response'];
        $secret_key = '6LenRpUnAAAAAL0fa6vCCbLkrmSRAUYprmNmC1Hp';
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = array(
            'secret' => $secret_key,
            'response' => $recaptcha_response
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if ($response['success']) {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
            $code = mysqli_real_escape_string($conn, md5(rand()));

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
                $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
            } else {
                if ($password === $confirm_password) {
                    $sql = "INSERT INTO users (name, email, password, code ) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<div style='display: none;'>";
                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);

                        try {
                            //Server settings
                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'delnavazi1029@gmail.com';                     //SMTP username
                            $mail->Password   = 'tovazfehwkvhnibc';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                            //Recipients
                            $mail->setFrom('delnavazi1029@gmail.com');
                            $mail->addAddress($email);

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'no reply';
                            $mail->Body    = 'Here is the verification link <b><a href="http://shop.test/login.php?verification=' . $code . '">http://localhost/login.php?verification=' . $code . '</a></b>';
                            $mail->send();
                            echo 'Message has been sent';
                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        echo "</div>";
                        $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                    } else {
                        $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
                }
            }
        } else {
            $msg = "<div class='alert alert-danger'> Captcha failed ! </div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'> Captcha failed ! </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login page </title>

    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/public/assets/css/style.css">

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">

                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>


                        <?php echo $msg; ?>
                        <form action="http://shop.test/register.php" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                                    echo $name;
                                                                                                                } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) {
                                                                                                                        echo $email;
                                                                                                                    } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" required>
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                            <br>
                            <div class="g-recaptcha" data-sitekey="6LenRpUnAAAAAE4iI0dXrVtVTfwagIJ4wp8gFaig"></div>
                            <br>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="http://shop.test/login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="./bootstrap-4.3.1-dist/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>