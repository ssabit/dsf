<?php include '../includes/db.php'; ?>

<?php
  $sort="";
	extract($_POST);

    // View records
    $sid;
    if(isset($_POST['uid'])){
      $sid=$_POST['uid'];
    }

	if (isset($_POST['readRecords']) || isset($_POST['uid']) || isset($_POST['sort'])) {

    if (isset($_POST['uid'])){
			$sid=$_POST['uid'];
		}else{
			$sid=$_POST['user_id'];
		}

		$data = '<div class="box-body table-responsive no-padding"><table id="example1" class="table table-bordered table-hover bg-success">
    <thead>
    <tr>
      <th>Serial</th>
      <th>Priority</th>
      <th>Requested</th>
      <th>Require</th>
      <th>Status</th>
      <th>Employee</th>
      <th>Options</th>
    </tr>
    </thead>
    <tbody>';

    if($sort==NULL){
      $sort="";
    }

    if($sort=="submitted"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER by request.status=0 DESC";
    }else if($sort=="progress"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER by request.status=1 DESC";

    }else if($sort=="dispatched"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER by request.status=2 DESC";

    }else if($sort=="cancelled"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER by request.status=4 DESC";

    }else if($sort=="priority"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER BY request_type_dropdown.type_dropdown_value DESC";


    }else if($sort=="rdate"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER BY request_type_date.type_date ASC";

    }else if($sort=="rcvdate"){
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER BY request.date_time DESC";

    }else{
      $sql="SELECT request.requiest_id,request.employee_id,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.service_receiver_id=$sid and request.status!=3 ORDER BY request.date_time DESC";
    }

$result=mysqli_query($con,$sql);
if (mysqli_num_rows($result) > 0 ) {
while ($row = mysqli_fetch_array($result)) {




  $status="";
  if($row['status']==0){
    $status="<small class='label bg-blue'><i class='fa fa-paper-plane' aria-hidden='true'></i> Submitted</small>";
  }
  else if($row['status']==1){
    $status="<small class='label bg-yellow'>In Progress</small>";
  }else if($row['status']==2){
    $status="<small class='label bg-red'><i class='fa fa-get-pocket' aria-hidden='true'>  Dispatched</small>";
  }else if($row['status']==3){
    $status="<small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> Complete</small>";
  }else if($row['status']==4){
    $status="<small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</small>";
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

    $data.='<tr>
        <td><small class="label bg-blue">'.$row['requiest_id'].'</small></td>


				<td>'.$priority.'</td>
				<td>'.date("Y-M-d h:i A", strtotime($row['date_time'])).'</td>';


        $data.=' <td>'.date("Y-M-d", strtotime($row['type_date'])).'</td>';

        $data.='<td>'.$status.'</td>';

        if($row['employee_id']==0){
          $data.='<td>No one is Assigned</td>';
        }else{
          $empid=$row['employee_id'];
          $sqlname="SELECT * FROM `employee` WHERE id=$empid";
          $r=mysqli_query($con,$sqlname);
          $r1 = mysqli_fetch_array($r);
          $data.='<td>'.$r1['first_name']." ".$r1['last_name'].'</td>';

        }
				$data.='<td width="10%">
				<a class="btn btn-warning btn-xs details" style="margin-left:5px;" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>
      ';
      if($row[ 'status' ]==0)
      {

        $data.='<a class="btn btn-danger btn-xs details" style="margin-left:5px;" href="javascript:void(0);"  onclick="updateRecords('.$row['requiest_id'].',4)".><i class="fa fa-times" aria-hidden="true" title="Cancel"></i></a></td>';
      }else if($row['status']==2){

        $data.='<a class="btn btn-success btn-xs details" style="margin-left:5px;" href="javascript:void(0);"  onclick="updateRecords('.$row['requiest_id'].',3)".><i class="fa fa-check-circle" aria-hidden="true" title="Resolve"></i> </a></td>';
      }

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
