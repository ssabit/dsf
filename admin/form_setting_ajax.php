<?php include '../includes/db.php'; ?>

<?php

extract($_POST);



// View recordss

if (isset($_POST['readRecords'])) {

	$data = '<div class="box">
            <div class="box-header">
              <h3 class="box-title">Form Settings</h3>
            </div><div class="box-body table-responsive no-padding">
              <table class="table table-hover">
    				<thead>
    				  <tr>
    				    <th>S.No.</th>
						<th>Form Name</th>
						<th>Type Name</th>
						<th>Publish To</th>
    				    <th>Actions</th>

    				  </tr>
    				</thead>';

	$q = "SELECT * from forms where visible!=-1";
	$res = mysqli_query($con, $q);
	if (mysqli_num_rows($res) > 0) {
		$s_no = 1;
		$publish = "";
		while ($row = mysqli_fetch_array($res)) {
			if ($row['publish'] == 1) {
				$publish = "Register";
			} else if ($row['publish'] == 2) {
				$publish = "Faculty Member";
			} else if ($row['publish'] == 3) {
				$publish = "Staff";
			} else if ($row['publish'] == 4) {
				$publish = "All";
			} else {
				$publish = "None";
			}



			$data .= '<tbody>
    					  <tr>
    					    <td>' . $s_no . '</td>
							<td>' . $row['form_name'] . '</td>
							<td>' . $row['type_name'] . '</td>
							<td>' . $publish . '</td>
							<td><a href="javascript:void(0);"  onclick="editRecord(' . $row['form_id'] . ')" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;
    					  </tr>
    					</tbody>';
			$s_no++;
		}
	}
	$data .= '</table></div></div>';

	echo $data;
}

// Delete records

if (isset($_POST['deleteId'])) {
	$deleteId = $_POST['deleteId'];

	$q = "DELETE FROM `users` WHERE user_id = $deleteId";
	$res = mysqli_query($con, $q);
}


// Get data id for update

if (isset($_POST['id']) && isset($_POST['id']) != "") {
	$u_id = $_POST['id'];

	$q = "SELECT * FROM `forms` WHERE form_id = $u_id";
	if (!$result = mysqli_query($con, $q)) {
		exit(mysqli_error());
	}

	$response = array();

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$response = $row;
		}
	} else {
		$response['status'] = 200;
		$response['message'] = "Data not found";
	}

	echo json_encode($response);
} else {
	$response['status'] = 200;
	$response['message'] = "Invalid request";
}



// update / edit record data

if (isset($_POST['updateId'])) {
	$u_id = $_POST['updateId'];
	$u_type = $_POST['u_type'];
	$u_service = $_POST['u_service'];



	$query = "UPDATE `forms` SET `type_name`='$u_type',`publish`='$u_service' WHERE form_id = '$u_id' ";
	//var_dump( $query );
	//return;

	$result = mysqli_query($con, $query);
}

?>
