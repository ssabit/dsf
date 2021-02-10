<?php
include('includes/db.php');
include("includes/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$error = "";
if (isset($_POST["email"]) && (!empty($_POST["email"])) && (!empty($_POST["name"])) && (!empty($_POST["subject"])) && (!empty($_POST["message"]))) {
  $email = $_POST["email"];
  $name = $_POST["name"];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);


  $subject = $_POST["subject"];
  $body = '<p>Hi, I am ' . $name . '</p><br>';
  $body .= $_POST["message"] . '<br>';
  $body .= $email;

  $email_to = $mail_username;;
  $fromserver = "contact@dfs.com";
  require 'vendor/autoload.php';
  $mail = new PHPMailer(true);
  $mail->IsSMTP();
  $mail->Host = "tls://smtp.gmail.com:587"; // Enter your host here
  $mail->SMTPAuth = true;
  $mail->Username = $mail_username; // Enter your email here
  $mail->Password = $mail_password;  //Enter your password here
  $mail->Port = 587;
  $mail->IsHTML(true);
  $mail->setFrom($mail_username, 'Contact');
  $mail->FromName = $softname;
  $mail->Sender = $fromserver; // indicates ReturnPath header
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AddAddress($email_to);
  if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSF</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/skin-yellow-light.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" type="image/png"  href="dist/img/favicon.ico">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-yellow-light layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="index.php" class="navbar-brand"><b>D</b>SF</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">

              <li><a href="index.php">Home</a></li>
              <li><a href="subscription.php">Services</a></li>
              <li><a href="contact.php">Contact</a></li>

            </ul>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown notifications-menu">
                <a href="login.php">
                  <i class="fa fa-sign-out"> Login</i>
                  <span class="label"></span>
                </a>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <h1 class=" jumbotron section text-center pagination-centered"> Thank you for contacting us.</h1>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /Include footer -->
    <?php include_once("includes/footer.php"); ?>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>
