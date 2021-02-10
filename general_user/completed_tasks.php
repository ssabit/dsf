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
$GLOBALS['emid']=0;
Global $read_first_name;
$sql = "SELECT * from users where user_id=$sid";

$res = mysqli_query( $con, $sql );

while ( $row = mysqli_fetch_array( $res ) ) {
  $read_first_name=$row[ 'first_name' ];
  $read_last_name=$row[ 'last_name' ];
  $read_full_name=$read_first_name." ".$read_last_name;

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
            <li class="active"><a href="completed_tasks.php">Completed Tasks</a></li>
            <li ><a href="request_service.php">Request Service</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->




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
        General User
          <small>Completed Tasks</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Completed Tasks</li>
        </ol>
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Service Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>User</th>
                  <th>Priority</th>
                  <th>Requested</th>
                  <th>Require</th>
                  <th>Status</th>
                  <th>Employee</th>
                  <th>Completed On</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php

$sql="SELECT request.requiest_id,request.employee_id,request.updated_on ,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=8 and request.status=3 ORDER BY request.requiest_id DESC";
$result=mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0 ) {
while ($row = mysqli_fetch_array($result)) {

  $service_receiver_name=$row['service_receiver_id'];
  $sqlname="SELECT * FROM `users` WHERE user_id='$service_receiver_name'";
  $r=mysqli_query($con,$sqlname);
  while ( $r1 = mysqli_fetch_array( $r ) ) {
    $read_first_name=$r1['first_name'];
    $read_last_name=$r1['last_name'];
    $read_full_name=$read_first_name." ".$read_last_name;

  }

  $GLOBALS['emid']=$row['employee_id'];
  $emid=$GLOBALS['emid'];
  $sqlname="SELECT * FROM `employee` WHERE id=$emid";
  $s=mysqli_query($con,$sqlname);
  while ( $s1 = mysqli_fetch_array( $s ) ) {
    $read_first_name2=$s1['first_name'];
    $read_last_name2=$s1['last_name'];
    $read_full_name2=$read_first_name2." ".$read_last_name2;
    $GLOBALS['employee_name']=$read_full_name2;


  }


  $status="";
  if($row['status']==0){
    $status="<small class='label bg-blue'>new</small>";
  }
  else if($row['status']==1){
    $status="<small class='label bg-yellow'>In Progress</small>";
  }else if($row['status']==2){
    $status="<small class='label bg-red'>Dispatched</small>";
  }else if($row['status']==3){
    $status="<small class='label bg-green'><i class='fa fa-check' aria-hidden='true'  title='Complete'></i> Complete</small>";
  }else if($row['status']==4){
    $status="<small class='label bg-red'>Cancelled</small>";
  }

  $priority="";
  if($row['type_dropdown_value']=='Low'){
    $priority="<small class='label bg-gray'>Low</small>";
  }
  else if($row['type_dropdown_value']=='Normal'){
    $priority="<small class='label bg-yellow'>Normal </small>";
  }else if($row['type_dropdown_value']=='High'){
    $priority="<small class='label bg-green'>High </small>";
  } else if($row['type_dropdown_value']=='Urgent'){
    $priority="<small class='label bg-red'>Urgent </small>";
  }



echo "<tr>";
echo "<td>". $read_full_name."</td>";
echo "<td>".$priority."</td>";
echo "<td>".date("Y-M-d h:i A", strtotime($row['date_time']))."</td>";


echo "<td>".date("Y-M-d", strtotime($row['type_date']))."</td>";
echo "<td>".$status."</td>";
echo "<td>".$GLOBALS['employee_name']."</td>";
echo "<td>".date("Y-M-d h:i A", strtotime($row['updated_on']))."</td>";
echo "<td width='10%'>";
echo "<a class='btn btn-warning btn-xs details' target='_blank' href=\"request_details.php?id=$row[requiest_id]\"><i class='fa fa-eye' title='Details'></i></a>";
echo'</td>';

echo "</tr>";
}
}
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>User</th>
                  <th>Priority</th>
                  <th>Requested</th>
                  <th>Require</th>
                  <th>Status</th>
                  <th>Employee</th>
                  <th>Completed On</th>
                  <th>Options</th>
                </tr>
                </tfoot>
              </table>
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
</html>
