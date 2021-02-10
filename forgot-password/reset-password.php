<?php
include('../includes/db.php');
include( "../includes/connection.php" );
$del=$_GET["email"];
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];

  $curDate = date("Y-m-d H:i:s");
  $query = mysqli_query($con,
  "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';"
  );

  $row = mysqli_num_rows($query);
  if ($row==""){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is
deactivated.</p><p><a href="https://'.$link.'/forgot-password.php">
Click here</a> to reset password.</p>';

}else{
  echo "this is rest-password else";
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
  ?>
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  }
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{
  $pass1  = password_hash($pass1, PASSWORD_BCRYPT);
mysqli_query($con,
"UPDATE `users` SET `password`='".$pass1."', `trn_date`='".$curDate."'
WHERE `email`='".$email."';"
);

$sql="DELETE FROM `password_reset_temp` WHERE `email`='$del'";

mysqli_query($con,$sql);

echo '<script type="text/javascript">';
echo 'alert("Congratulations! Your password has been updated successfully.");';
echo 'window.location.href = "https://'.$link.'login.php";';
echo '</script>';

  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSR | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" action="" name="update">
  <input type="hidden" name="action" value="update" />
      <div class="form-group">
				<label for="pass1">Enter New Password:</label>
				<input type="password" maxlength="15" class="form-control" id="pass1" placeholder="Enter Password" name="pass1" required>
		  </div>

      <div class="form-group">
				<label for="pass2">Re-Enter New Password:</label>
				<input type="password" maxlength="15" class="form-control" id="pass2" placeholder="Enter Confirm Password" name="pass2" required>
			</div>
  <input type="hidden" name="email" value="<?php echo $email;?>"/>
  <input type="submit" class="btn btn-primary btn-block btn-flat" value="Reset Password" />
  </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
</body>
</html>
