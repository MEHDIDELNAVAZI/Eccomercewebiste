<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->
<?php



include './config_database.php';
$msg = "";


if (isset($_GET['verification'])) {
  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
    $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");

    if ($query) {
      $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
    }
  } else {
    header("Location:http://shop.test/register.php");
  }
}


if (isset($_GET['verification'])) {
  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
    $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");

    if ($query) {
      $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
    }
  } else {
    header("Location:http://shop.test/register.php");
  }
}


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
    $response = json_decode($result,true);


    if ($response['success']) {

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, md5($_POST['password']));

      $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
          $_SESSION['SESSION_EMAIL'] = $email;
          $_SESSION['USER_ID'] = $row["id"];
        
          header("Location:http://shop.test");
        } else {
          $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
        }
      } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
      }
    } else {
      $msg = "<div class='alert alert-danger'> Captcha fialed ! </div>";
    }
  } else {
    $msg = "<div class='alert alert-danger'> Captcha failed ! </div>";
  }
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>

  <!-- Meta tag Keywords -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8" />
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
            <h2>Login Now</h2>
            <?php echo $msg; ?>
            <form method="post">
              <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
              <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
              <br>
              <br>
              <p><a href="http://shop.test/forgotpassword.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
              <br>
              <div class="g-recaptcha" data-sitekey="6LenRpUnAAAAAE4iI0dXrVtVTfwagIJ4wp8gFaig"></div>
              <br>
              <button name="submit" name="submit" class="btn" type="submit">Login</button>
            </form>
            <div class="social-icons">
              <p>Create Account! <a href="http://shop.test/register.php">Register</a>.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- //form -->
    </div>
  </section>
  <!-- //form section start -->

  <script src="js/jquery.min.js"></script>
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