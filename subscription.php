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
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
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
            <li class="active"><a >Services</a></li>
            <li><a href="contact.php">Contact</a></li>

          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
			<li class="dropdown notifications-menu">
            <a href="login.php" >
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
      <section class="content" >
        <div class="container">
      <div class="row">
      <h1>Dynamic Service Form is according to your facility’s needs and the number of facilities. Here are the packages it offers:</h1>
        <div class="col-md-4">
          <div class="card text-center">
            <div class="card-header">
              <h3>Basic</h3>
            </div>
            <div class="card-body">

              <div class="card-title">
                <h4>$24.99/Month</h4>
              </div>
              <div class="card-text">
                <p class="lead"></p>
              </div>
              <ul class="list-group">
                <li class="list-group-item">
                  <i class="fa fa-check"></i>  Unlimited Custom Designed Form Create
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Form Modification
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Employee Assign
                </li>
                <li class="list-group-item">
                  <i class="fa fa-times"></i> Form Publish Limit
                </li>
                <li class="list-group-item">
                  <i class="fa fa-times"></i> Email Notification
                </li>
              </ul>
              <a href="transaction/checkout.php?price=50&sub=basic" class="btn btn-block btn-primary mt-2">Order Now</a>
            </div>
            <div class="card-footer">
              <p class="text-muted mb-0">1 Year Plan </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center">
            <div class="card-header">
              <h3>Standard</h3>
            </div>
            <div class="card-body">
              <div class="card-title">
                <h4>$39.99/Month</h4>
              </div>
              <div class="card-text">
                <p class="lead"></p>
              </div>
              <ul class="list-group">
                <li class="list-group-item">
                  <i class="fa fa-check"></i>  Unlimited Custom Designed Form Create
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Form Modification
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Employee Assign
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Form Publish Limit
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Email Notification
                </li>
              </ul>
              <a href="transaction/checkout.php?price=150&sub=standard" class="btn btn-block btn-primary mt-2">Order Now</a>
            </div>
            <div class="card-footer">
              <p class="text-muted mb-0">1 Year Plan</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center">
            <div class="card-header">
              <h3>Premium</h3>
            </div>
            <div class="card-body">
              <div class="card-title">
                <h4>$49.99/Month</h4>
              </div>
              <div class="card-text">
                <p class="lead"></p>
              </div>
              <ul class="list-group">
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Unlimited Custom Designed Form Create
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Form Modification
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Employee Assign
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Offline Text SMS
                </li>
                <li class="list-group-item">
                  <i class="fa fa-check"></i> Email Notification
                </li>
              </ul>
              <a href="transaction/checkout.php?price=180&sub=premium" class="btn btn-block btn-primary mt-2">Order Now</a>
            </div>
            <div class="card-footer">
              <p class="text-muted mb-0">1 Year Plan </p>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
 <!-- /Include footer -->
 <?php include_once( "includes/footer.php" );?>
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
