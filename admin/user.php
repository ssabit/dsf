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
  <title>DSF | Manage User</title>
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
        <small>Manage User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage User</li>
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
								<div class="container">

									<!-- Trigger the modal with a button -->
									<button id="closebtn1" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Add User</button>

									<!-- Insert Modal -->
									<div class="modal fade" id="myModal" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="btn btn-warning btn-circle pull-right" data-dismiss="modal">&times;</button>
													<h3 class="modal-title text-center">Add User</h3>
												</div>
												<div class="modal-body">
													<form id="addform"  action="" method="post">
														<div class="form-group">
																<label for="first_name">First Name:</label>
																<input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
														</div>

														<div class="form-group">
															<label for="last_name">Last Name:</label>
															<input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name">
													</div>



														<div class="form-group">
															<label for="email">Email:</label>
															<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required >
														</div>
														<div class="form-group">
															<label for="password">Password:</label>
															<input type="text" class="form-control" id="password" placeholder="Enter Password" name="password" required>
														</div>

														<div class="form-group ">
															<label for="role">Role:</label>
															<div class="role">
																<input id="role" name="role" placeholder="role" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.role.value=this.options[this.selectedIndex].value">
																<OPTION VALUE="">Select
																		<OPTION VALUE="1">General User
																			<OPTION VALUE="2">Service Provider
																				<OPTION VALUE="3">Admin
																				<OPTION VALUE="4">Block

																</SELECT>
															</div>
														</div>

														<div class="form-group ">
															<label for="designation">Designation:</label>
															<div class="">
																<input id="designation" name="designation" placeholder="designation" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.designation.value=this.options[this.selectedIndex].value">
																<OPTION VALUE="">Select
																		<OPTION VALUE="1">Staff
																			<OPTION VALUE="2">Faculty Member
																				<OPTION VALUE="3">Register


																</SELECT>
															</div>
														</div>
														<div class="form-group ">
															<label for="service">Service:</label>
															<div class="">
																<input id="service" name="Service" placeholder="service" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.service.value=this.options[this.selectedIndex].value">
																<option value="0">Select</option>
																	<?php

																	$sql = mysqli_query( $con, "select * from form_types" );
																	while ( $row = mysqli_fetch_array( $sql ) ) {
																		echo '<option value="' . $row[ 'type_name' ] . '">' . $row[ 'type_name' ] . '</option>';
																	}
																	?>

																</SELECT>
															</div>
														</div>
														<div class="form-group">
															<label for="phone">Phone Number:</label>
															<input type="text" class="form-control" id="phone" placeholder="Enter contact number" name="phone">
														</div>
														<button onclick="addRecords();" type="button" name="submit" id="submit" class="btn btn-success">Save</button>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>

										</div>
									</div>


									<!--Update Modal -->
									<div class="modal fade" id="myEditModal" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button id="closebtn2" type="button" class="btn btn-warning btn-circle pull-right" data-dismiss="modal">&times;</button>
													<h3 class="modal-title text-center">Edit User</h3>
												</div>
												<div class="modal-body">
													<form id="updateform" action="" method="post">
													<div class="form-group">
															<label for="fname">First Name:</label>
															<input type="text" class="form-control" id="u_fname" placeholder="Enter First Name" name="fname">
														</div>
														<div class="form-group">
															<label for="lname">Last Name:</label>
															<input type="text" class="form-control" id="u_lname" placeholder="Enter Last Name" name="lname">
														</div>

														<div class="form-group">
															<label for="email">Email:</label>
															<input type="text" class="form-control" id="u_email" placeholder="Enter Email" name="email">
														</div>
														<div class="form-group">
															<label for="password">Password:</label>
															<input type="text" class="form-control" id="u_password" placeholder="Enter Password" name="password">
														</div>

														<div class="form-group ">
															<label for="role">Role:</label>
															<div class="role">
																<input id="u_role" name="role" placeholder="role" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.role.value=this.options[this.selectedIndex].value">
																	<OPTION VALUE="">Select
																		<OPTION VALUE="1">General User
																			<OPTION VALUE="2">Service Provider
																				<OPTION VALUE="3">Admin
																				<OPTION VALUE="4">Block

																</SELECT>
															</div>
														</div>

														<div class="form-group ">
															<label for="designation">Designation:</label>
															<div class="">
																<input id="u_designation" name="designation" placeholder="designation" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.designation.value=this.options[this.selectedIndex].value">
																	<OPTION VALUE="">Select
																		<OPTION VALUE="1">Staff
																			<OPTION VALUE="2">Faculty Member
																				<OPTION VALUE="3">Register

																</SELECT>
															</div>
														</div>
														<div class="form-group ">
															<label for="service">Service:</label>
															<div class="">
																<input id="u_service" name="Service" placeholder="service" class="form-control" type="hidden" style="width:50%;float:left;" value="">

																<SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.Service.value=this.options[this.selectedIndex].value">
																<option value="0">Select</option>
																	<?php

																	$sql = mysqli_query( $con, "select * from form_types" );
																	while ( $row = mysqli_fetch_array( $sql ) ) {
																		echo '<option value="' . $row[ 'type_name' ] . '">' . $row[ 'type_name' ] . '</option>';
																	}
																	?>

																</SELECT>
															</div>
														</div>
														<div class="form-group">
															<label for="phone">Phone Number:</label>
															<input type="text" class="form-control" id="u_phone" placeholder="Enter contact number" name="phone">
														</div>
														<div>
															<input type="hidden" name="u_id" id="u_id">
														</div>
														<button onclick="updateRecords();" type="button" name="submit" id="u_submit" class="btn btn-success">Update</button>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>

										</div>
									</div>

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
<script src="../lugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
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
$("#closebtn1").click(function () {
	$('#addform')[0].reset();
});

$("#closebtn2").click(function () {
	$('#updateform')[0].reset();
});

	$( function () {
		readRecords();
	} );


	function readRecords() {
		var readRecords = "readRecords";
		$.post( {
			url: 'user_manage_ajax.php',
			type: 'post',
			data: {
				readRecords: readRecords
			},
			success: function ( data, status ) {
				$( '#records_content' ).html( data )

			}
		} )
	}


	function addRecords() {
		var email = $( '#email' ).val();
		var password = $( '#password' ).val();
		var designation = $( '#designation' ).val();
		var role = $( '#role' ).val();
		var phone = $( '#phone' ).val();
		var first_name = $( '#first_name' ).val();
		var last_name = $( '#last_name' ).val();
		var service = $( '#service' ).val();


		$.post( {
			url: 'user_manage_ajax.php',
			type: 'post',
			data: {
				email: email,
				password: password,
				designation: designation,
				role: role,
				phone: phone,
				fname:first_name,
				lname:last_name,
				service:service
				},
			success: function ( data, status ) {
				$("#myModal").modal('hide');
				$('#myModal form :input').val("");
				readRecords();
			}
		} );

	}


	function deleteRecord( deleteId ) {
		var conf = confirm( 'Do you want to delete data?' );
		if ( conf == true ) {
			$.post( {
				url: 'user_manage_ajax.php',
				type: 'post',
				data: {
					deleteId: deleteId
				},
				success: function ( data, status ) {
					$( '#records_content' ).html( data );
					$('#myModal form :input').val("");
					readRecords();
				}
			} );
		}
	}

	///////fetching data from database in this function

	function editRecord( user_id ) {
		$( '#u_id' ).val( user_id );
		$.post( {
			url: 'user_manage_ajax.php',
			type: 'post',
			data: {
				id: user_id
			},
			success: function ( data, status ) {
				var user = JSON.parse( data );

				$( '#u_email' ).val( user.email );
				//$( '#u_password' ).val( user.password );
				$( '#u_designation' ).val( user.designation );
				$( '#u_phone' ).val( user.phone );
				$( '#u_role' ).val( user.role );
				$( '#u_fname' ).val( user.first_name );
				$( '#u_lname' ).val( user.last_name );
				$( '#u_service' ).val( user.service );

			}
		} );

		$( "#myEditModal" ).modal( 'show' );
	}



	function updateRecords() {
		var u_email = $( '#u_email' ).val();
		var u_password = $( '#u_password' ).val();
		var u_designation = $( '#u_designation' ).val();
		var u_phone = $( '#u_phone' ).val();
		var u_role = $( '#u_role' ).val();
		var u_id = $( '#u_id' ).val();
		var u_fname = $( '#u_fname' ).val();
		var u_lname = $( '#u_lname' ).val();
		var u_service = $( '#u_service' ).val();
		console.log(u_service);


		$.post( {
			url: 'user_manage_ajax.php',
			type: 'post',
			data: {
				u_email: u_email,
				u_password: u_password,
				u_designation: u_designation,
				u_phone: u_phone,
				u_fname: u_fname,
				u_lname: u_lname,
				updateId: u_id,
				u_role: u_role,
				u_service: u_service

			},
			success: function ( data, status ) {
				$( "#myEditModal" ).modal( 'hide' );
				$('#myModal form :input').val("");
				readRecords();
			}
		} );
	}

</script>
