<?php include '../includes/db.php';
session_start();
?>

<?php

extract($_POST);


if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['designation']) && isset($_POST['phone']) && isset($_POST['role'])) {
	$image_name = "profile2.png";
	$hashpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);




	$q = "INSERT INTO `users`(`first_name`,`last_name`,`email`, `password`, `phone`, `role`,`designation`,`image_name`,`service`) VALUES ('$fname','$lname','$email','$hashpassword','$phone',$role,'$designation','$image_name','$service')";
	$res = mysqli_query($con, $q);
}

// View recordss

if (isset($_POST['readRecords'])) {

	$data = '<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage User</h3>
            </div><div class="box-body table-responsive no-padding">
              <table class="table table-hover">
    				<thead>
    				  <tr>
    				    <th>S.No.</th>
						<th>Email</th>
						<th>First Name</th>
						<th>Last Name</th>
    				    <th>Designation</th>
    				    <th>Phone</th>
						<th>Role</th>
						<th>Service</th>
    				    <th>Actions</th>

    				  </tr>
    				</thead>';

	$q = "SELECT * FROM `users` WHERE role!=-1";
	$res = mysqli_query($con, $q);
	if (mysqli_num_rows($res) > 0) {
		$s_no = 1;
		$role = "";
		$designation = "";
		while ($row = mysqli_fetch_array($res)) {

			if ($row['role'] == 1) {
				$role ="<small class='label bg-green'>General User</small>";
			} elseif ($row['role'] == 2) {
				$role = "<small class='label bg-yellow'>Service Provider</small>";
			} elseif ($row['role'] == 3) {
				$role = "<small class='label bg-blue'>Admin</small>";
			} elseif ($row['role'] == 4) {
				$role = "<small class='label bg-red'>Blocked</small>";
			} else {
				$role = "none";
			}
			if ($row['designation'] == '1') {
				$designation = "<small class='label bg-purple'>Staff</small>";
			} elseif ($row['designation'] == '2') {
				$designation = "<small class='label bg-purple'>Faculty Member</small>";
			} elseif ($row['designation'] == '3') {
				$designation = "<small class='label bg-purple'>Register</small>";
			} else {
				$designation = "<small class='label bg-purple'>None</small>";
			}






			$data .= '<tbody>
    					  <tr>
    					    <td>' . $s_no . '</td>
							<td>' . $row['email'] . '</td>
							<td>' . $row['first_name'] . '</td>
							<td>' . $row['last_name'] . '</td>
    					   <td>' . $designation . '</td>
    					    <td>' . $row['phone'] . '</td>
							<td>' . $role . '</td>
							<td><small class="label bg-purple">'.$row['service'] .'</small></td>



    					    <td><a href="javascript:void(0);"  onclick="editRecord(' . $row['user_id'] . ')" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</a> &nbsp;
    					        <a href="javascript:void(0);" style="margin-top:3px;" onclick="deleteRecord(' . $row['user_id'] . ')"  class="btn btn-danger btn-sm"><i class="fa fa-user-times"></i> Delete</a></td>
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

	//$q = "DELETE FROM `users` WHERE user_id = $deleteId";
	$q="UPDATE `users` SET `role`=-1 WHERE user_id =$deleteId";
	$res = mysqli_query($con, $q);
}


// Get data id for update

if (isset($_POST['id']) && isset($_POST['id']) != "") {
	$u_id = $_POST['id'];

	$q = "SELECT * FROM `users` WHERE user_id = $u_id";
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
	$u_email = $_POST['u_email'];
	$u_password = $_POST['u_password'];
	$u_designation = $_POST['u_designation'];
	$u_phone = $_POST['u_phone'];
	$u_role = $_POST['u_role'];
	$u_fname = $_POST['u_fname'];
	$u_lname = $_POST['u_lname'];
	$u_service = $_POST['u_service'];


	if ($u_password == "") {
		$hashpassword = $_SESSION['u_pwd'];
		$query = "UPDATE `users` SET `first_name`='$u_fname',`last_name`='$u_lname',`email`='$u_email',`designation`='$u_designation',`phone`='$u_phone',`role`=$u_role,`service`='$u_service' WHERE user_id = '$u_id' ";

		$result = mysqli_query($con, $query);
	} else {
		$hashpassword = password_hash($u_password, PASSWORD_BCRYPT);
		$query = "UPDATE `users` SET `first_name`='$u_fname',`last_name`='$u_lname',`email`='$u_email',`password`='$hashpassword',`designation`='$u_designation',`phone`='$u_phone',`role`=$u_role,`service`='$u_service' WHERE user_id = '$u_id' ";
		$result = mysqli_query($con, $query);
	}
}

?>
