<?php
include_once( "../includes/db.php" );
session_start();
$sid=$_SESSION['id'];
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
Global $read_last_name;
Global $read_full_name;
Global $read_phone;
Global $read_floor;
Global $read_room;
Global $read_designation;
Global $read_email;
Global $file;
Global $read_image_name;

$sql = "SELECT * from users where user_id=$sid";


$res = mysqli_query( $con, $sql );

while ( $row = mysqli_fetch_array( $res ) ) {
  $read_first_name=$row[ 'first_name' ];
  $read_last_name=$row[ 'last_name' ];
  $read_full_name=$read_first_name." ".$read_last_name;
  $read_phone = $row[ 'phone' ];
  $read_floor = $row[ 'floor' ];
  $read_room = $row[ 'room' ];
  $read_designation = $row[ 'designation' ];
  $read_email = $row[ 'email' ];
  $read_image_name = $row[ 'image_name' ];

}


?>
<?php

 if(isset($_POST['submit']))
 {


  $file = $_FILES[ 'file' ];


	//print_r();


	$fileName = $_FILES[ 'file' ][ 'name' ];
	$fileTmpName = $_FILES[ 'file' ][ 'tmp_name' ];
	$fileSize = $_FILES[ 'file' ][ 'size' ];
	$fileError = $_FILES[ 'file' ][ 'error' ];
	$fileType = $_FILES[ 'file' ][ 'type' ];

	$fSize=$fileSize/1000;

	/*echo "Name:".$fileName."<br>";
	echo "TmpName:".$fileTmpName."<br>";
	echo "Size:".$fSize."KB"."<br>";
	echo "Error:".$fileError."<br>";
	echo "Type:".$fileType."<br>";
	//return;*/

	$fileExt = explode( '.', $fileName );
	$fileActualExt = strtolower( end( $fileExt ) );

	$allowed = array( 'jpg', 'jpeg', 'png' ); // Add all the file extensions


	if ( in_array( $fileActualExt, $allowed ) ) {

		if ( $fileError === 0 ) {
			if ( $fileSize < 500000 ) {
				$fileNameNew = uniqid( '', true ) . "." . $fileActualExt;
				$fileDestination = ( '../uploads/' . $fileNameNew );

				move_uploaded_file( $fileTmpName, $fileDestination );
				//echo $fileNameNew;
				//header("Location: upload.php?upload=success");

			} else {

				echo "Your file is too big!";
			}

		} else {
			echo "There was an error uploading your error!";
		}

	} else {

		//echo "You cannot upload files of this type!";

    //echo "<script>window.alert('You cannot upload this type of files!')</script>";
    $fileNameNew='5dc81765d54e03.76196265.png';

	}

     //$id =$_SESSION['id'];

     $first_name=$_POST['fname'];
     $last_name=$_POST['lname'];
     $floor=$_POST['floor'];
     $room=$_POST['room'];

     // checking empty fields
     if(empty($first_name) ||empty($last_name)||empty($floor)||empty($room)||empty($fileNameNew)) {
         if(empty($first_name)) {

             $first_name=$read_first_name;
         }
         if(empty($last_name)) {

          $last_name=$read_last_name;
         }
         if(empty($floor)) {

          $floor= $read_floor;
      }
      if(empty($room)) {

        $room=$read_room;
    }
    if(empty($fileNameNew)) {

      $fileNameNew=$read_image_name;
  }

     } else {
         //updating the table

     echo "else";
         $result = mysqli_query($con, "UPDATE users SET first_name='$first_name',last_name='$last_name',image_name='$fileNameNew',floor='$floor',room='$room' WHERE user_id=$sid");
        echo $first_name;
        echo $last_name;
        echo $floor;
        echo $room;
    echo "$result";
    // return;
     echo "$result";

         //redirectig to the display page. In our case, it is index.php
         header("Location: profile.php");
     }
 }
 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSF | General User</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-yellow-light.min.css">

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
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-yellow-light layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="general_user.php" class="navbar-brand"><b>D</b>SF</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="general_user.php">Request Controller</a></li>
          <li><a href="general_user_application.php">Request Application</a></li>
            <li><a href="completed_tasks.php">Completed Tasks</a></li>
            <li ><a href="request_service.php">Request Service</a></li>

          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">




            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <?php echo '<img src="../uploads/'.$_SESSION['image'].'" class="user-image" alt="User Image">'; ?>

                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $read_full_name; ?></span>
              </a>

            </li>
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
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        General User
          <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Profile</li>
        </ol>
      </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
      <?php echo '<img src="../uploads/'.$_SESSION['image'].'" class="profile-user-img img-responsive img-circle" alt="User profile picture">'; ?>


        <h3 class="profile-username text-center"><?php echo $read_full_name; ?></h3>

        <p class="text-muted text-center">
        <?php
            if($read_designation==1){
              echo "<td>Staff</td>";
            }else if($read_designation==2){
              echo "<td>Faculty Member</td>";

            }else if($read_designation==3){
              echo "<td>Register</td>";
            }else{
              echo "<td>Other</td>";
            }?>

        </p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->


    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-building margin-r-5"></i> Floor</strong>

        <p class="text-muted">
          <?php echo $read_floor;?>
        </p>
        <hr>
        <strong><i class="fa fa-building-o margin-r-5"></i> Room</strong>
        <p class="text-muted"> <?php echo $read_room;?></p>
        <hr>
        <strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>
        <p class="text-muted"> <?php echo $read_phone;?></p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
        <li><a href="#settings" data-toggle="tab">Settings</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="activity">

        <div class="table-responsive">
  <table class="table">

    <tr>
		<td>First Name</td>
		<td><?php echo $read_first_name;?></td>
  </tr>

	<tr>
        <td>Last Name</td>
        <td><?php echo $read_last_name;?></td>
     </tr>

		<tr>
        <td>Email</td>
        <td><?php echo $read_email;?></td>
     </tr>

     <tr>

        <td>Designation</td>
        <?php
          if($read_designation==1){
            echo "<td>Staff</td>";
          }else if($read_designation==2){
            echo "<td>Faculty Member</td>";

          }else if($read_designation==3){
            echo "<td>Register</td>";
          }else{
            echo "<td>Other</td>";
          }



        ?>
     </tr>



    </tbody>
  </table>
  </div>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="settings">

        <form class="form-horizontal" action="<?php $_PHP_Self;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

        <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Image</label>

                    <div class="col-sm-10">
                      <input name="file" type="file" class="form-control" id="file">
                      <p class="help-block">Only png , jpg and jpeg allowed</p>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="firstName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input name="fname" type="text" class="form-control" id="firstName" placeholder="Fist Name" value="<?php echo $read_first_name;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input name="lname" type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $read_last_name;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="floor" class="col-sm-2 control-label">Floor</label>

                    <div class="col-sm-10">
                      <input name="floor" type="text" class="form-control" id="floor" placeholder="Floor" value="<?php echo $read_floor;?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="room" class="col-sm-2 control-label">Room</label>

                    <div class="col-sm-10">
                      <input name="room" type="text" class="form-control" id="room" placeholder="Room" value="<?php echo $read_room;?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button name="submit" type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>
  </div>
  <!-- /.content-wrapper -->
    <!-- /Include footer -->
    <?php include_once( "../includes/footer.php" );?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
