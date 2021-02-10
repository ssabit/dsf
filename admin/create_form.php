<?php
include_once("../includes/db.php");
session_start();
$sid = $_SESSION['id'];
$_SESSION['package'];
$directoryURI = basename($_SERVER['SCRIPT_NAME']);
if ($_SESSION['u_id'] == NULL) {

  header("Location: ../index.php?login=error");
}
?>
<?php

if (isset($_POST['logout'])) {

  header("Location: ../includes/logout.php");
  exit();
}
?>
<?php

global $read_first_name;
$sql = "SELECT * from users where user_id=$sid";

$res = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($res)) {
  $read_first_name = $row['first_name'];
  $read_last_name = $row['last_name'];
  $read_full_name = $read_first_name . " " . $read_last_name;
}

?>
<?php
//index.php
include_once("database_connection.php");
function fill_unit_select_box($connect)
{
  $output = '';
  $query = "SELECT * FROM field_types ORDER BY field_name ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as $row) {
    $output .= '<option value="' . $row["field_type"] . '">' . $row["field_name"] . '</option>';
  }
  return $output;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DSF | Create Form</title>
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
                <?php echo '<img src="../uploads/' . $_SESSION['image'] . '" class="user-image" alt="User Image">'; ?>
                <span class="hidden-xs"><?php echo $read_full_name; ?></span>
              </a>
              <!-- Menu Footer-->
              <!-- Notifications: style can be found in dropdown.less -->

            <li class="dropdown notifications-menu" style="margin-top:10px;margin-right:5px;">
              <form action="<?php $_PHP_SELF ?>" method="post">
            <li id="button" class="nav-item"><button name="logout" type="submit" class="btn btn-danger btn-sm">
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
        <?php include_once("menu.php"); ?>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Create Form</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Forms</li>
          <li class="active">Create Form</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">

            <form method="POST" id="insert_form">
              <div class="table-repsonsive">
                <span id="error"></span>
                <table class="table table-bordered" id="item_table">

                  <tr>
                    <th>Form Name</th>
                    <td><input id="form_name" type="text" name="form_name" class="form-control item_name" required /></td>
                    <th>Form Category</th>
                    <td><input id="form_type" name="form_type" placeholder="form_type" class="form-control" type="hidden" style="width:50%;float:left;" required>

                      <SELECT class="form-control" style="width:40%; padding-left:10px; " onChange="this.form.form_type.value=this.options[this.selectedIndex].value">
                        <option value="0">--Select--</option>
                        <?php

                        $sql = mysqli_query($con, "select * from form_types");
                        while ($row = mysqli_fetch_array($sql)) {
                          echo '<option value="' . $row['type_name'] . '">' . $row['type_name'] . '</option>';
                        }
                        ?>

                      </SELECT>
                    </td>


                  </tr>


                  <tr>
                    <th>Field Name</th>
                    <th>Type</th>

                    <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
                  </tr>
                </table>
                <div align="center">
                  <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                </div>
              </div>
            </form>

          </section>
          <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /Include footer -->
    <?php include_once("../includes/footer.php"); ?>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
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
  $(document).ready(function() {

    $(document).on('click', '.add', function() {
      var html = '';
      html += '<tr>';
      html += '<td><input type="text" name="form_label[]" class="form-control form_label" required/></td>';
      html += '<td><select name="item_type[]" class="form-control item_type" required><option value="">Select Type</option><?php echo fill_unit_select_box($connect); ?></select></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus"></span></button></td></tr>';
      $('#item_table').append(html);
    });

    $(document).on('click', '.remove', function() {
      $(this).closest('tr').remove();
    });

    $('#insert_form').on('submit', function(event) {
      var form_name = $('#form_name').val();
      var form_type = $('#form_type').val();


      event.preventDefault();
      //console.log(form_name);
      //console.log(form_type);

      event.preventDefault();
      var error = '';
      $('.form_label').each(function() {
        var count = 1;
        if ($(this).val() == '') {
          error += "<p>Enter Item Name at " + count + " Row</p>";
          return false;
        }
        count = count + 1;
      });

      $('#form_type').each(function() {
        if ($(this).val() == '') {
          error += "<p>Form Category</p>";
          return false;
        }

      });

      $('.item_type').each(function() {
        var count = 1;
        if ($(this).val() == '') {
          error += "<p>Select Type at " + count + " Row</p>";
          return false;
        }
        count = count + 1;
      });
      var form_data = $(this).serialize();
      if (error == '') {
        $.ajax({
          url: "create_form_ajax.php",
          method: "POST",
          data: form_data,
          form_name,
          form_type,

          success: function(data) {
            if (data == 'ok') {
              $('#item_table').find("tr:gt(0)").remove();
              $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
              window.location.replace("manage_dropdown.php");
            }
          }
        });
      } else {
        $('#error').html('<div class="alert alert-danger">' + error + '</div>');
      }
    });

  });
</script>
