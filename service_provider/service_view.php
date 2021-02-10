<?php
include_once( "../includes/db.php" );
session_start();
if($_SESSION['u_id']==NULL){
    //haven't log in
   // echo "You haven't log in";
    header("Location: ../index.php?login=error");
}
?>
<?php

if(isset($_POST['logout'])){

	header("Location: ../includes/logout.php");
	exit();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- MDBootstrap Datatables  -->
    <link href="../css/addons/datatables.min.css" rel="stylesheet">
    <title>DSF</title>
    <link rel="icon" type="image/png"  href="../dist/img/favicon.ico">
  </head>
<body style="background-color:deepskyblue">


    <!-- NAVBAR WITH RESPONSIVE TOGGLE -->
    <nav class="navbar navbar-light bg-light navbar-expand-md">
        <div class="container">
          <a class="navbar-brand" href="service_provider.php"><b>D</b>SF</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto" >
              <li class="nav-item">
                      <a class="nav-link" href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Service Request Overview</a>
                  </li>



                  <form action="<?php $_PHP_SELF?>" method="post">

				<li id="button" class="nav-item"><button  name="logout" type="submit" class="btn btn-danger btn-sm">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
				</li>
				</form>
              </ul>
            </div>
          </div>
    </nav>

    <br><br>

  <!-- Home Info -->
  <section id="home-info">
    <div class="container">
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">





  <thead>
    <tr>
      <th class="th-sm">Name
      </th>
      <th class="th-sm">Priority
      </th>
      <th class="th-sm">Requested Date
      </th>
      <th class="th-sm">Required Date
      </th>
      <th class="th-sm">Status
      </th>
    </tr>
  </thead>
  <tbody>

  <?php

$sql="SELECT request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority'";
$result=mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0 ) {
while ($row = mysqli_fetch_array($result)) {

  $service_receiver_name=$row['service_receiver_id'];
  $sqlname="SELECT email FROM `users` WHERE user_id='$service_receiver_name'";
  $r=mysqli_query($con,$sqlname);
  $r1 = mysqli_fetch_array($r);


  $status="";
  if($row['status']==0){
    $status="Pending";
  }
  else if($row['status']==1){
    $status="In Progress";
  }else if($row['status']==2){
    $status="Completed";
  }

echo "<tr>";
echo "<td>".$r1['email']."</td>";
echo "<td>".$row['type_dropdown_value']."</td>";
echo "<td>".$row['date_time']."</td>";
echo "<td>".$row['type_date']."</td>";
echo "<td>".$status."</td>";


echo "</tr>";
}
}
?>
  </tbody>

</table>
    </div>
  </section>

</div>


    </div>

	<!-- Footer -->
    <!-- /Include footer -->
    <?php include_once( "../includes/footer.php" );?>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="../js/addons/datatables.min.js"></script>
</body>
</html>
<script>
$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>
