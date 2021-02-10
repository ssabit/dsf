<?php include '../includes/db.php'; ?>

<?php
  $sort="";
	extract($_POST);

    // View records
    $sid;
    if(isset($_POST['uid'])){
      $sid=$_POST['uid'];
    }

	if (isset($_POST['readRecords']) || isset($_POST['uid'])) {

    if (isset($_POST['uid'])){
			$sid=$_POST['uid'];
		}else{
			$sid=$_POST['user_id'];
		}

		$data = '<div class="box-body table-responsive no-padding"><table id="example1" class="table table-bordered table-hover bg-success">
    <thead>
    <tr>
      <th>Serial</th>
      <th>Requested</th>
      <th>Status</th>
      <th>Options</th>
      <th>Last Modified</th>
    </tr>
    </thead>
    <tbody>';


  $sql="SELECT request.requiest_id,request.service_receiver_id,request.date_time,request.status, request.form_type,request.updated_on FROM request WHERE request.service_receiver_id=$sid and request.form_type='Application' and request.status=3 ORDER BY request.date_time DESC";

  $result=mysqli_query($con,$sql);
  if (mysqli_num_rows($result) > 0 ) {
  while ($row = mysqli_fetch_array($result)) {

  $status="";
  if($row['status']==0){
    $status="<small class='label bg-blue'><i class='fa fa-paper-plane' aria-hidden='true'></i> Submitted</small>";
  }
  else if($row['status']==1){
    $status="<small class='label bg-orange'><i class='fa fa-spinner' aria-hidden='true'> In Process</small>";
  }else if($row['status']==2){
    $status="<small class='label bg-green'><i class='fa fa-get-pocket' aria-hidden='true'>  Accept</i></small>  <small class='btn btn-info btn-xs details'><i class='fa fa-clock-o' aria-hidden='true'>  Waiting for confirmation</i></small>";
  }else if($row['status']==3){
    $status="<small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> Done</small>";
  }else if($row['status']==4){
    $status="<small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</small>";
  }


    $data.='<tr>
        <td><small class="label bg-blue">'.$row['requiest_id'].'</small></td>

				<td>'.date("Y-M-d h:i A", strtotime($row['date_time'])).'</td>';

        $data.='<td>'.$status.'</td>';

				$data.='<td width="10%">
				<a class="btn btn-warning btn-xs details" style="margin-left:5px;" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>
      ';
      if($row[ 'status' ]==0)
      {

        $data.='<a class="btn btn-danger btn-xs details" style="margin-left:5px;" href="javascript:void(0);"  onclick="updateRecords('.$row['requiest_id'].',4)".><i class="fa fa-times" aria-hidden="true" title="Cancel"></i></a></td>';
      }else if($row['status']==2){

        $data.='<a class="btn btn-success btn-xs details" style="margin-left:5px;" href="javascript:void(0);"  onclick="updateRecords('.$row['requiest_id'].',3)".><i class="fa fa-check-circle" aria-hidden="true" title="Resolve"></i> </a></td>';
      }
      $data.='<td>'.date("Y-M-d h:i:s A ", strtotime($row['updated_on'])).'</td>';

      $data.='</tr>';
    }
  }


    echo $data;
	}

////Update status

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sts = $_POST['status'];

    $query = "UPDATE request SET status=$sts WHERE requiest_id=$id";
    $result = mysqli_query($con,$query);

}

 ?>
