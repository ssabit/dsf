<?php
include_once( "../includes/db.php" );
session_start();
$sid=$_SESSION['id'];
$_SESSION['package'];
$directoryURI =basename($_SERVER['SCRIPT_NAME']);
if($_SESSION['u_id']==NULL){

    header("Location: ../index.php?login=error");
}
?>
<?php

if(isset($_POST['logout'])){

	header("Location: ../includes/logout.php");
	exit();

}
?>
 <?php

Global $read_first_name;
$sql = "SELECT * from users where user_id=$sid";

$res = mysqli_query( $con, $sql );

while ( $row = mysqli_fetch_array( $res ) ) {
  $read_first_name=$row[ 'first_name' ];
  $read_last_name=$row[ 'last_name' ];
  $read_full_name=$read_first_name." ".$read_last_name;

}
?>

<?php
//Forms Count
$sql="SELECT COUNT(form_id) as formCount from forms where visible=1";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
//echo $row['formCount'];
//User Count
$sql="SELECT COUNT(user_id) as userCount from users";
$result=mysqli_query($con,$sql);
$row1 = mysqli_fetch_array($result);
//echo $row1['userCount'];
//Request Pending Count
$sql="SELECT COUNT(requiest_id) as pendingCount from request where status=0";
$result=mysqli_query($con,$sql);
$row2 = mysqli_fetch_array($result);
//echo $row2['pendingCount'];

//Request served Count
$sql="SELECT COUNT(requiest_id) as servedCount from request where status=5";
$result=mysqli_query($con,$sql);
$row3 = mysqli_fetch_array($result);
//echo $row3['servedCount'];


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSF | Configure</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-yellow-light.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" type="image/png"  href="../dist/img/favicon.ico">
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="admin.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>SF</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>D</b>SF</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<?php echo '<img src="../uploads/'.$_SESSION['image'].'" class="user-image" alt="User Image">'; ?>
              <span class="hidden-xs"><?php echo $read_full_name;?></span>
            </a>
              <!-- Menu Footer-->
              <!-- Notifications: style can be found in dropdown.less -->

          <li class="dropdown notifications-menu"  style="margin-top:10px;margin-right:5px;">
             <form action="<?php $_PHP_SELF?>" method="post">
				<li id="button" class="nav-item"><button  name="logout" type="submit" class="btn btn-danger btn-sm">
					Log out
					</button>
				</li>
			</form>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php include_once( "menu.php" );?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Configure</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Configure</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">


          <!-- Add content Here-->

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">

						<div class="row">
							<div class="col-md-12">
								<div id="records_content">
									<!-- Data record Table -->
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
        </section>
        <!-- /.Left col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- /Include footer -->
 <?php include_once( "../includes/footer.php" );?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
<script>
	$( function () {
		readRecords();
	} );


	function readRecords() {
		var readRecords = "readRecords";
		$.post( {
			url: 'config_ajax.php',
			type: 'post',
			data: {
				readRecords: readRecords
			},
			success: function ( data, status ) {
				$( '#records_content' ).html( data )

			}
		} )
	}



function updateSetings(id1,id2) {

//console.log(id1);
//console.log(id2);

$.post( {
	url: 'config_ajax.php',
	type: 'post',
	data: {
	id: id1,
	status: id2
	},
	success: function ( data, status ) {

	readRecords();
	}
} );
}
</script>
