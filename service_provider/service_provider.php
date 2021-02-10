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
$hide_sort;
$sql = "SELECT * from users where user_id=$sid";

$res = mysqli_query( $con, $sql );

while ( $row = mysqli_fetch_array( $res ) ) {
  $read_first_name=$row[ 'first_name' ];
  $read_last_name=$row[ 'last_name' ];
  $read_full_name=$read_first_name." ".$read_last_name;
  $hide_sort=$row[ 'service' ];

}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSF | Service Provider</title>
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
          <a href="service_provider.php" class="navbar-brand"><b>D</b>SF</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Controller Screen<span class="sr-only">(current)</span></a></li>
            <li class=""><a href="completed_tasks.php">Completed Tasks<span class="sr-only"></span></a></li>
            <li class=""><a href="application_complete.php">Completed Applicaiton<span class="sr-only"></span></a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="profile.php">
                <!-- The user image in the navbar-->
                <?php echo '<img src="../uploads/'.$_SESSION['image'].'" class="user-image" alt="User Image">'; ?>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $read_full_name;?></span>
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
        Service Provider
          <small>Controller Screen</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Controller Screen</li>
        </ol>
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Service Requests</h3>

              <div id="sort" class="form-group ">
															<label for="sort">Sort:</label>

																<SELECT id="sort"  class="col" style="width:20%; padding-left:10px;" onChange="	readRecords()">
																	<OPTION VALUE="">Select
																		<OPTION VALUE="new">New
																			<OPTION VALUE="progress">In Progress
                                      <OPTION VALUE="dispatched">Dispatched
                                      <OPTION VALUE="priority">Priority
                                      <OPTION VALUE="rdate">Required Date
                                      <OPTION VALUE="rcvdate">Received Date
																</SELECT>
								</div>
            </div>

            <!-- /.box-header -->
            <div id="records_content" class="box-body">
            <!-- Data record Table -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
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
<script>

var hide = "<?php echo $hide_sort ?>";
  if(hide=='Application'){
    $( "#sort" ).hide();
  }
	$( function () {
		readRecords();
	} );

  //read table
  function readRecords() {
      var readRecords = "readRecords";
      var sort=$('#sort :selected').val();
      $.post( {
        url: 'service_provider_ajax.php',
        type: 'post',
        data: {
          readRecords: readRecords,
          sort: sort
        },
        success: function ( data, status ) {
          $( '#records_content' ).html( data )

        }
      } )
      setInterval(function(){
    $("#records_content").load('service_provider_ajax.php',{readRecords: readRecords});
  }, 5000)

  }


  //Update status

  function updateRecords(id0,id1,id2) {

      var mail=id0;
      $.post( {
        url: 'service_provider_ajax.php',
        type: 'post',
        data: {
          id: id1,
          status: id2,
          email: mail
        },
        success: function ( data, status ) {

          readRecords();
        }
      } );
  }

  function updateRecordsapp(id0,id1,id2) {

var mail=id0;
$.post( {
  url: 'service_provider_ajax.php',
  type: 'post',
  data: {
    id: id1,
    statusapp: id2,
    emailapp: mail
  },
  success: function ( data, status ) {

    readRecords();
  }
} );
}

 //Update Employee

  function updateEmployee(id1,id2) {
    console.log(event);
    var emp=$('#'+id1+' :selected').val();
    var mail=id2;

    console.log(emp);
    console.log(emp);
		$.post( {
			url: 'service_provider_ajax.php',
			type: 'post',
			data: {
				id:id1,
        employee:emp,
        email:mail

			},
			success: function ( data, status ) {

				readRecords();
			}
		} );
  }

</script>
</html>
