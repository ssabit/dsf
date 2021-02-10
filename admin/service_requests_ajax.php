<?php
  include '../includes/db.php';
  session_start();
  $service="service";
?>

<?php

  $GLOBALS['employee_name']="";
  $GLOBALS['emid']=0;
	extract($_POST);

    // View records

	if (isset($_POST['readRecords'])) {

		if($service!="Application"){
      $data = '<div class="box-body table-responsive no-padding"><table id="example1" class="table table-bordered table-hover bg-success">
		<thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Requested</th>
        <th>Require</th>
        <th>Status</th>
        <th>Options</th>
        <th>Update</th>
        <th>Employee</th>
        <th>Last Modified</th>
      </tr>
		</thead>
		<tbody>';

  $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request.form_type!='Application' GROUP BY request.requiest_id";

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
    $status="<small class='label bg-blue'><i class='fa fa-get-pocket' aria-hidden='true'></i> New</small>";
  }
  else if($row['status']==1){
    $status="<small class='label bg-yellow'><i class='fa fa-spinner' aria-hidden='true'></i> In Progress</small>";
  }else if($row['status']==2){
    $status="<small class='label bg-red'><i class='fa fa-paper-plane' aria-hidden='true'></i> Dispatched</small>";
  }else if($row['status']==3){
    $status="<small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> Complete</small>";
  }else if($row['status']==4){
    $status="<small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</small>";
  }


    $data.='<tr>
        <td><small class="label bg-blue">'.$row['requiest_id'].'</td>
				<td>'. $read_full_name.'</td>
				<td>'.date("Y-M-d h:i A", strtotime($row['date_time'])).'</td>


				<td>'.date("Y-M-d", strtotime($row['type_date'])).'</td>
				<td>'.$status.'</td>
				<td width="10%">
        <a class="btn bg-purple btn-xs details" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>';





      if($row[ 'status' ]==0)
      {
        $stat="In Progess";
        if($row['employee_id']==0){
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);". ><i class="fa fa-spinner" aria-hidden="true"></i>'. $stat.'</a></td>';
        }else{
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"><i class="fa fa-spinner" aria-hidden="true"></i> '.$stat.'</a></td>';
        }
      }else if($row[ 'status' ]==1)
      {
        $stat="Dispatched";
        if($row['employee_id']==0){
          $data.='<td><a class="btn btn-danger btn-xs details" href="javascript:void(0);".><i class="fa fa-paper-plane" aria-hidden="true"></i> '. $stat.'</a></td>';
        }
        else{
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"><i class="fa fa-paper-plane" aria-hidden="true"></i> '.$stat.'</a></td>';
        }


      }else if($row['status']==2){
        $stat="Complete";
        $data.='<td><small class="btn btn-info btn-xs details"><i class="fa fa-clock-o" aria-hidden="true"></i> Waiting for confirmation</small></td>';
      }else if($row['status']==3){
        $stat="Complete";
        $data.='<td><small class="btn btn-success btn-xs details">Done</small></td>';
      }

      if($row['status']==4){

        $data.='<td>No Data Available</td>';
        $data.='<td>No Data Available</td>';
        $data.='<td>No Data Available</td>';

      }else {

        if($row['employee_id']==0 ){
          $id=$row['requiest_id'];
          $data.='<td>No one is Assigned</td>';
          $data.='<td>Not Started</td>';
        }else{
            $data.='<td>'. $GLOBALS['employee_name'].'</td>';
            $data.='<td>'.date("Y-M-d h:i A", strtotime($row['updated_on'])).'</td>';
        }
      }




      $data.='</tr>';
    }
  }


    echo $data;

    }
  }

?>
