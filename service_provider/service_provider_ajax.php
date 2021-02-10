<?php
  include '../includes/db.php';
  include '../includes/mail.php';
  session_start();
  $service=$_SESSION['service'];
?>

<?php
  $sort="";
  $GLOBALS['client_mail']="";
  $GLOBALS['employee_name']="";
  $GLOBALS['emid']=0;
  $GLOBALS['emp_phone']=0;
  $GLOBALS['user_phone']=0;


	extract($_POST);

    // View records

	if (isset($_POST['readRecords']) || isset($_POST['sort'])) {

		if($service!="Application"){
      $data = '<div class="box-body table-responsive no-padding"><table id="example1" class="table table-bordered table-hover bg-success">
		<thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Priority</th>
        <th>Requested</th>
        <th>Require</th>
        <th>Status</th>
        <th>Options</th>
        <th>Update</th>
        <th>Assign</th>
        <th>Last Modified</th>
      </tr>
		</thead>
		<tbody>';


    if($sort==NULL){
      $sort="";
    }

    if($sort=="new"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request.status=0 DESC";
    }else if($sort=="progress"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request.status=1 DESC";

    }else if($sort=="dispatched"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request.status=2 DESC";

    }else if($sort=="rdate"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request_type_date.type_date ASC";

    }else if($sort=="priority"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request_type_dropdown.type_dropdown_value DESC";


    }else if($sort=="rcvdate"){
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service' ORDER BY request.date_time DESC";

    }
    else{
      $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request_type_dropdown.type_dropdown_value,request.date_time,request_type_date.type_date,request.status,request.employee_id  FROM request INNER JOIN request_type_date ON request.requiest_id=request_type_date.type_date_requestid INNER JOIN request_type_dropdown ON request.requiest_id=request_type_dropdown.type_dropdown_requestid WHERE request_type_dropdown.type_dropdown_label='Priority' and request.status!=3 AND request.form_type='$service'";
    }





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
    $GLOBALS['client_mail']=$r1['email'];
    $GLOBALS['user_phone']=$r1['phone'];

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
          $GLOBALS['emp_phone']=$s1['phone'];

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
  $abc=$GLOBALS['client_mail'];
    $data.='<tr>
        <td><small class="label bg-blue">'.$row['requiest_id'].'</td>
				<td>'. $read_full_name.'</td>
        <td>'.$priority.'</td>

				<td>'.date("Y-M-d h:i A", strtotime($row['date_time'])).'</td>


				<td>'.date("Y-M-d", strtotime($row['type_date'])).'</td>
				<td>'.$status.'</td>
				<td width="10%">
        <a class="btn bg-purple btn-xs details" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>';
    if($row[ 'status' ]==0)
      {
        $data.='<a class="btn bg-orange btn-xs details" style="margin-left:3px;" href="javascript:void(0); "><i class="fa fa-envelope-square" title="Send SMS Employee"></i></a>
                <a class="btn bg-blue btn-xs details" style="margin-left:3px;"  href="javascript:void(0);"><i class="fa fa-envelope-square" title="Send SMS User"></i></a>
      </td>';

      }
    else{

        $config="SELECT * FROM `settings` WHERE name='sms'";
        $c=mysqli_query($con,$config);
        while ( $c1 = mysqli_fetch_array( $c ) ) {

          $settings_sms=$c1['status'];


        }

        if($settings_sms==1){


          $data.='<a class="btn bg-orange btn-xs details" style="margin-left:3px;"  href=send_sms.php?empnum='.urlencode(base64_encode($GLOBALS['emp_phone'])).'><i class="fa fa-envelope-square" title="Send SMS Employee"></i></a>
          <a class="btn bg-blue btn-xs details" style="margin-left:3px;"  href=send_sms.php?usernum='.urlencode(base64_encode($GLOBALS['user_phone'])).'&&status='.$row['status'].'><i class="fa fa-envelope-square" title="Send SMS User"></i></a>';


        }else{
          $data.='<a class="btn bg-orange btn-xs details" style="margin-left:3px;"  disabled><i class="fa fa-envelope-square" title="Send SMS Employee"></i></a>
          <a class="btn bg-blue btn-xs details" style="margin-left:3px;"  disabled><i class="fa fa-envelope-square" title="Send SMS User"></i></a>';
        }

        $data.='</td>';

      }




      if($row[ 'status' ]==0)
      {
        $stat="In Progess";
        if($row['employee_id']==0){
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);". ><i class="fa fa-spinner" aria-hidden="true"></i>'. $stat.'</a></td>';
        }else{
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"  onclick="updateRecords(\''.$abc.'\','.$row['requiest_id'].',1)".><i class="fa fa-spinner" aria-hidden="true"></i> '.$stat.'</a></td>';
        }
      }else if($row[ 'status' ]==1)
      {
        $stat="Dispatched";
        if($row['employee_id']==0){
          $data.='<td><a class="btn btn-danger btn-xs details" href="javascript:void(0);".><i class="fa fa-paper-plane" aria-hidden="true"></i> '. $stat.'</a></td>';
        }
        else{
          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"  onclick="updateRecords(\''.$abc.'\','.$row['requiest_id'].',2)".><i class="fa fa-paper-plane" aria-hidden="true"></i> '.$stat.'</a></td>';
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
          $data.="<td>

          <SELECT id='$id' class='form-control' style=' pading-left:10px;'>
                                  <option value=''>--Select--</option>";

                                    $sql = mysqli_query( $con, 'select * from employee' );
                                    while ( $row = mysqli_fetch_array( $sql ) ) {
                                      $data.="<option value='".$row['id']."'>".$row['first_name'].' '.$row['last_name']."</option>
                                      ";
                                    }
        $data.="</SELECT>	<a class='btn btn-primary btn-xs details' href='javascript:void(0);' onclick='updateEmployee($id,\"".$abc."\")' >Assign</a>

          </td>";
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

    }else{
      $data = '<div class="box-body table-responsive no-padding"><table id="example1" class="table table-bordered table-hover bg-success">
		<thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Requested</th>
        <th>Status</th>
        <th>Options</th>
        <th>Update</th>
        <th>Last Modified</th>
      </tr>
		</thead>
		<tbody>';

  $sql="SELECT request.requiest_id,request.updated_on,request.service_receiver_id,request.date_time,request.status, request.form_type FROM request WHERE request.form_type='Application' and request.status!=3 ORDER BY request.date_time DESC";

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
    $GLOBALS['client_mail']=$r1['email'];
    $GLOBALS['user_phone']=$r1['phone'];

  }


  $status="";
  if($row['status']==0){
    $status="<small class='label bg-blue'><i class='fa fa-get-pocket' aria-hidden='true'></i> New</small>";
  }
  else if($row['status']==1){
    $status="<small class='label bg-yellow'><i class='fa fa-spinner' aria-hidden='true'></i> In Process</small>";
  }else if($row['status']==2){
    $status="<small class='label bg-primary'><i class='fa fa-paper-plane' aria-hidden='true'></i> Accept</small>";
  }else if($row['status']==3){
    $status="<small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> Complete</small>";
  }else if($row['status']==4){
    $status="<small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> Cancelled</small>";
  }

  $abc=$GLOBALS['client_mail'];
    $data.='<tr>
        <td><small class="label bg-blue">'.$row['requiest_id'].'</td>
				<td>'. $read_full_name.'</td>


				<td>'.date("Y-M-d h:i:s A", strtotime($row['date_time'])).'</td>

				<td>'.$status.'</td>
				<td width="10%">
        <a class="btn bg-purple btn-xs details" target="_blank" href=request_details.php?id='.$row['requiest_id'].'><i class="fa fa-eye" title="Details"></i></a>';
    if($row[ 'status' ]==0)
      {
        $data.='<a class="btn bg-blue btn-xs details" style="margin-left:3px;"  href="javascript:void(0);"><i class="fa fa-envelope-square" title="Send SMS User"></i></a>
      </td>';

      }
    else{

        $config="SELECT * FROM `settings` WHERE name='sms'";
        $c=mysqli_query($con,$config);
        while ( $c1 = mysqli_fetch_array( $c ) ) {

          $settings_sms=$c1['status'];


        }

        if($settings_sms==1){


          $data.='<a class="btn bg-blue btn-xs details" style="margin-left:3px;"  href=send_sms_app.php?usernum='.urlencode(base64_encode($GLOBALS['user_phone'])).'&&status='.$row['status'].'><i class="fa fa-envelope-square" title="Send SMS User"></i></a>';


        }else{
          $data.='<a class="btn bg-blue btn-xs details" style="margin-left:3px;"  disabled><i class="fa fa-envelope-square" title="Send SMS User"></i></a>';
        }

        $data.='</td>';

      }
      if($row[ 'status' ]==0)
      {
        $stat="In Process";
        $stat2="Reject";

          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"  onclick="updateRecordsapp(\''.$abc.'\','.$row['requiest_id'].',1)".><i class="fa fa-spinner" aria-hidden="true"></i> '.$stat.'</a> <a class="btn btn-danger btn-xs details" href="javascript:void(0);"  onclick="updateRecordsapp(\''.$abc.'\','.$row['requiest_id'].',4)".><i class="fa fa-times" aria-hidden="true"></i> '.$stat2.'</a></td>';

      }else if($row[ 'status' ]==1)
      {
        $stat="Accept";

          $data.='<td><a class="btn btn-primary btn-xs details" href="javascript:void(0);"  onclick="updateRecordsapp(\''.$abc.'\','.$row['requiest_id'].',2)".><i class="fa fa-paper-plane" aria-hidden="true"></i> '.$stat.'</a></td>';



      }else if($row['status']==2){
        $data.='<td><small class="btn btn-info btn-xs details"><i class="fa fa-clock-o" aria-hidden="true"></i> Waiting for confirmation</small></td>';
      }else if($row['status']==3){
        $stat="Complete";
        $data.='<td><small class="btn btn-success btn-xs details">Done</small></td>';
      }

      if($row['status']==4){

        $data.='<td><a class="btn btn-primary btn-xs details" disabled><i class="fa fa-spinner" aria-hidden="true"></i>Accept</a> <a class="btn btn-danger btn-xs details" disabled><i class="fa fa-times" aria-hidden="true"></i>Cancel</a></td>';
        $data.='<td>'.date("Y-M-d h:i:s A", strtotime($row['updated_on'])).'</td>';


      }else {

        if($row['status']==0 ){


          $data.='<td>Not Started</td>';
        }else{
            $data.='<td>'.date("Y-M-d h:i A", strtotime($row['updated_on'])).'</td>';
        }
      }
      $data.='</tr>';
    }

  }
    echo $data;

    }
  }
  ////Update status

  if (isset($_POST['status']) && isset($_POST['email']) ) {
    $id = $_POST['id'];
    $sts = $_POST['status'];
    $Email=$_POST['email'];
    $date = new DateTime();
    $date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
    $get_datetime = $date->format( 'Y-m-d H:i:s' );

    $status="";

    if($sts==1){
      $status="Your request is In Progress.Thank you!";

    }else if($sts==2){
      $status="Your request is Dispatched and Waiting for your confirmation.Thank you!";

    }else if($sts==3){
      $status="Your request is Completed.Thank you!";
    }else{
      $status="ERROR!!";
    }

    $query = "UPDATE request SET status=$sts, updated_on='$get_datetime' WHERE requiest_id=$id";

    $result = mysqli_query($con,$query);

    $config="SELECT * FROM `settings` WHERE name='email'";
    $c=mysqli_query($con,$config);
    while ( $c1 = mysqli_fetch_array( $c ) ) {

      $settings_email=$c1['status'];

    }

    if($settings_email==1){
      $mail->addAddress($Email);
      $mail->Body = ($status);
      $mail->send();
    }

  }

////Update status application

if (isset($_POST['statusapp']) && isset($_POST['emailapp']) ) {
  $id = $_POST['id'];
  $sts = $_POST['statusapp'];
  $Email=$_POST['emailapp'];
  $date = new DateTime();
  $date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
  $get_datetime = $date->format( 'Y-m-d H:i:s' );

  $status="";

  if($sts==1){
    $status="Your application is In Process.Thank you!";

  }else if($sts==2){
    $status="Your application is Accept and Waiting for your confirmation.Thank you!";

  }else if($sts==3){
    $status="Your application is Completed.Thank you!";
  }else{
    $status="Your application is Rejected.Thank you!!!";
  }

  $query = "UPDATE request SET status=$sts, updated_on='$get_datetime' WHERE requiest_id=$id";

  $result = mysqli_query($con,$query);

  $config="SELECT * FROM `settings` WHERE name='email'";
  $c=mysqli_query($con,$config);
  while ( $c1 = mysqli_fetch_array( $c ) ) {

    $settings_email=$c1['status'];

  }

  if($settings_email==1){
    $mail->addAddress($Email);
    $mail->Body = ($status);
    $mail->send();
  }

}

  ////Update Employee

  if (isset($_POST['employee'])&& isset($_POST['email'])) {

  $id = $_POST['id'];
  $emp = $_POST['employee'];
  $Email = $_POST['email'];
  $date = new DateTime();
  $date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
  $get_datetime = $date->format( 'Y-m-d H:i:s' );

  $query = "UPDATE request SET employee_id=$emp,updated_on='$get_datetime'  WHERE requiest_id=$id";
  $result = mysqli_query($con,$query);

  $config="SELECT * FROM `settings` WHERE name='email'";
  $c=mysqli_query($con,$config);
  while ( $c1 = mysqli_fetch_array( $c ) ) {

    $settings_email=$c1['status'];

  }


  if($settings_email==1){
    if($_POST['employee']!=NULL){
      $eid=$_POST['employee'];
        $sqlname="SELECT * FROM `employee` WHERE id=$eid";
        $s=mysqli_query($con,$sqlname);
        while ( $s1 = mysqli_fetch_array( $s ) ) {
          $emp_first=$s1['first_name'];
          $emp_last=$s1['last_name'];
          $empfull=$emp_first." ".$emp_last;
        }


      $mail->addAddress($Email);
      $mail->Body = ('Hi,'.$empfull.' is assigned for your request');
      $mail->send();
    }

  }

}
?>
