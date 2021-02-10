<?php include '../includes/db.php'; ?>

<?php

	extract($_POST);
  $service="Application";
    // View records
  if (isset($_POST['readRecords'] )|| $service=="Application") {

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


  $sql="SELECT request.requiest_id,request.service_receiver_id,request.date_time,request.status, request.form_type,request.updated_on FROM request WHERE request.form_type='Application'";

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
				<a class="btn bg-purple btn-xs details" style="margin-left:5px;" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>
      ';

      $data.='<td>'.date("Y-M-d h:i:s A ", strtotime($row['updated_on'])).'</td>';

      $data.='</tr>';
    }
  }


    echo $data;
	}

 ?>
