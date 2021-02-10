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
              <li class="active"><a>Contact</a></li>

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
        <section class="content">
          <div class="container">
            <div class="row">
              <!-- Section Titile -->
              <div class="col-md-12 wow animated fadeInLeft" data-wow-delay=".2s">
                <h1 class="section-title"> <span style="color:#FF0400;"> Don’t be a stranger</span> <br>just say hello.</h1>
              </div>
            </div>
            <div class="row">
              <!-- Section Titile -->
              <div class="col-md-6 mt-3 contact-widget-section2">
                <h3 class="display-3">Feel free to get in touch with us.</h3>
              </div>
              <!-- contact form -->
              <div class="col-md-6 wow animated fadeInRight" data-wow-delay=".2s">
                <form action="thank-you.php" class="shake" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator">
                  <!-- Name -->
                  <div class="form-group label-floating">
                    <label class="control-label" for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="name" required data-error="Please enter your name">
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- email -->
                  <div class="form-group label-floating">
                    <label class="control-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" required data-error="Please enter your Email">
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- Subject -->
                  <div class="form-group label-floating">
                    <label class="control-label">Subject</label>
                    <input class="form-control" id="msg_subject" type="text" name="subject" required data-error="Please enter your message subject">
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- Message -->
                  <div class="form-group label-floating">
                    <label for="message" class="control-label">Message</label>
                    <textarea class="form-control" rows="3" id="message" name="message" required data-error="Write your message"></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- Form Submit -->
                  <div class="form-submit mt-5">
                    <button class="btn btn-primary" type="submit" id="form-submit"><i class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                  </div>
                </form>
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
