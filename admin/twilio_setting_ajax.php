<?php include '../includes/db.php'; ?>

<?php

	extract($_POST);

    // View recordss

	if (isset($_POST['readRecords'])) {

		$data = '<div class="box">
            <div class="box-header">

            </div><div class="box-body table-responsive no-padding">
              <table class="table table-hover">
    				<thead>
    				  <tr>
    				    <th>Account SID</th>
						<th>Authentication Token</th>
						<th>Number</th>
    				  </tr>
    				</thead>';

    	$q = "SELECT * FROM `twilio`";
		$res = mysqli_query($con,$q);
		//var_dump($res);
		//return;

    	 if (mysqli_num_rows($res) >0 ) {
			 while ($row = mysqli_fetch_array($res)) {

    	 		$data.='<tbody>
    					  <tr>
							<td>'.$row['sid'].'</td>
							<td>'.$row['auth'].'</td>
							<td>'.$row['number'].'</td>
    					  </tr>
    					</tbody>';

    	 	}
    	 }
    	 $data.='</table></div></div>';

    	 echo $data;
	}
// Get data id for update

    if (isset($_POST['id']) && isset($_POST['id']) != "") {
        $u_id = $_POST['id'];

        $q = "SELECT * FROM `twilio` WHERE id=1";
        if (!$result = mysqli_query($con,$q)) {
            exit(mysqli_error());
        }

        $response = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response = $row;
            }
        }else{
            $response['status'] = 200;
            $response['message'] = "Data not found";
        }

        echo json_encode($response);

    }else{
        $response['status'] = 200;
        $response['message'] = "Invalid request";
    }



// update / edit record data

    if (isset($_POST['updateId'])) {
        $u_id = $_POST['updateId'];
        $u_phone = $_POST['u_phone'];
		$u_sid = $_POST['u_sid'];
		$u_auth = $_POST['u_auth'];

        $query = "UPDATE `twilio` SET `sid`='$u_sid',`auth`='$u_auth',`number`='$u_phone' WHERE id=$u_id";
		//var_dump( $query );
		//return;

        $result = mysqli_query($con,$query);

    }

 ?>
