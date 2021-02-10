<?php
include_once( "../includes/db.php" );
session_start();
$requestid = $_GET['id'];
$sid=$_SESSION['id'];
$img=$_SESSION['image'];
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-yellow-light.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          <a href="index.html" class="navbar-brand"><b>D</b>SF</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="general_user.php">Request Controller <span class="sr-only">(current)</span></a></li>
            <li><a href="general_user_application.php">Request Application</a></li>
            <li><a href="request_Service.php">Request Service</a></li>

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
          General User
          <small>Request Details</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Requests</a></li>
          <li class="active"><a href="#">Request Details</a></li>

        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
      <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Request Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered">
                <tbody>

            <?php
            ////Text Box/////
            $sql="SELECT * FROM `request_type_textbox` WHERE type_textbox_requestid=$requestid";
            $result=mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0 ) {
            while ($row = mysqli_fetch_array($result)) {

            echo ' <tr>';
              echo '<td style="width: 10px">'.$row["type_textbox_label"].'</td>';
              echo '<td style="width: 150px">'.$row["type_textbox_value"].'</td>';

              echo ' </tr>';

            }
          }
           ////Drop-Down/////
          $sql="SELECT * FROM `request_type_dropdown` WHERE type_dropdown_requestid=$requestid";
            $result=mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0 ) {
            while ($row = mysqli_fetch_array($result)) {

            echo ' <tr>';
            echo '<td style="width: 10px">'.$row["type_dropdown_label"].'</td>';
            echo '<td style="width: 150px">'.$row["type_dropdown_value"].'</td>';
            echo ' </tr>';

            }
          }


          ////Date/////
          $sql="SELECT * FROM `request_type_date` WHERE type_date_requestid=$requestid";
            $result=mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0 ) {
            while ($row = mysqli_fetch_array($result)) {

            echo ' <tr>';
              echo '<td style="width: 10px">'.$row["type_date_label"].'</td>';
              echo '<td style="width: 150px">'.date("Y-M-d h:i A", strtotime($row['type_date'])).'</td>';

              echo ' </tr>';

            }
          }


          ////Text Area/////
          $sql="SELECT * FROM `request_type_text` WHERE type_text_requestid=$requestid";
            $result=mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0 ) {
            while ($row = mysqli_fetch_array($result)) {

            echo ' <tr>';
            echo '<td style="width: 10px">'.$row["type_text_label"].'</td>';
            echo '<td style="width: 150px">'.$row["type_text_value"].'</td>';
            echo ' </tr>';

            }
          }

            ?>


              </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-body -->
            <div id="comment-box" class="box-footer box-comments">

            </div>


<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='' enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control' ><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>

    </div>

  </div>
</div>
          <!-- /.box -->
          <div class="box-footer">
              <form action="#" method="post">
              <?php echo '<img class="img-responsive img-circle img-sm" src="../uploads/'.$_SESSION['image'].'" alt="Profile Picture">'; ?>

                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input  id="comment" type="text" class="form-control input-sm" placeholder="Write comment..." value="">
                  <button onkeypress="addRecords();" onclick="addRecords();" style="margin-top:3px;" type="button" name="submit" id="submit" class="btn btn-success pt-1">Comment</button>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Upload file</button>


                </div>

              </form>
            </div>


      </section>
      <!-- /.content -->



    </div>
    <!-- /.container -->
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
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

</body>
<script>
$(document).ready(function(){
  $('#btn_upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          $('#preview').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
        }else{
          alert('file not uploaded');
        }
      }
    });
  });
});

	$( function () {
		readRecords();
	} );


	function readRecords() {
		var readRecords = "readRecords";
    var request_id = <?php echo $requestid;?>;


		$.post( {
			url: 'comment_ajax.php',
			type: 'post',
			data: {
				readRecords: readRecords,
        request_id: request_id

			},
			success: function ( data, status ) {
        $( '#comment-box' ).html( data )
			}
    } )

 setInterval(function(){
  $("#comment-box").load('comment_ajax.php',{req_id:request_id});
}, 2000)
	}

  function addRecords() {
		var comment = $('#comment').val();
    var user_id = <?php echo $sid?>;
    var request_id = <?php echo $requestid?>;
    var image=" <?php echo $img?>";


    if($('#comment').val() == ''){
      alert('Comment Can not be  empty!');
      return false;
  }

		$.post( {
			url: 'comment_ajax.php',
			type: 'post',
			data: {
        request_id: request_id,
				user_id: user_id,
        comment: comment,
        image:image
			},
			success: function ( data, status ) {
        $('#comment').val("");
				readRecords();
			}
		} );

	}
</script>
</html>
