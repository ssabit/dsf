<?php include '../includes/db.php'; ?>

<?php

	extract($_POST);


    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone'])) {

        $q = "INSERT INTO `employee`(`first_name`,`last_name`,`phone`,`dept`) VALUES ('$fname','$lname','$phone','$service')";
        $res = mysqli_query($con,$q);
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
						<th>First Name</th>
						<th>Last Name</th>
    				    <th>Phone</th>
						<th>Dept</th>
    				    <th>Actions</th>

    				  </tr>
    				</thead>';

    	$q = "SELECT * FROM `employee`";
    	$res = mysqli_query($con,$q);
    	 if (mysqli_num_rows($res) > 0 ) {
    	 	$s_no = 1;

			 while ($row = mysqli_fetch_array($res)) {

    	 		$data.='<tbody>
    					  <tr>
    					    <td>'.$s_no.'</td>
							<td>'.$row['first_name'].'</td>
							<td>'.$row['last_name'].'</td>
    					    <td>'.$row['phone'].'</td>
							<td>'.$row['dept'].'</td>

    					    <td><a href="javascript:void(0);"  onclick="editRecord('.$row['id'].')" class="btn btn-info"><i class="fa fa-pencil"></i>  Edit</a> &nbsp;
    					        <a href="javascript:void(0);" onclick="deleteRecord('.$row['id'].')"  class="btn btn-danger"><i class="fa fa-user-times"></i>  Delete</a></td>
    					  </tr>
    					</tbody>';
    					$s_no++;
    	 	}
    	 }
    	 $data.='</table></div></div>';

    	 echo $data;
	}

// Delete records

    if (isset($_POST['deleteId'])) {
        $deleteId = $_POST['deleteId'];

        $q = "DELETE FROM `employee` WHERE id = $deleteId";
        $res = mysqli_query($con, $q);
    }


// Get data id for update

    if (isset($_POST['id']) && isset($_POST['id']) != "") {
        $u_id = $_POST['id'];

        $q = "SELECT * FROM `employee` WHERE id = $u_id";
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
		$u_fname = $_POST['u_fname'];
		$u_lname = $_POST['u_lname'];
		$u_service = $_POST['u_service'];

		echo $u_id;
		echo $u_phone;
		echo $u_fname;
		echo $u_lname;
		echo $u_service;


        $query = "UPDATE `employee` SET `first_name`='$u_fname',`last_name`='$u_lname',`phone`='$u_phone',`dept`='$u_service' WHERE id =$u_id";
		var_dump( $query );
		//return;

        $result = mysqli_query($con,$query);

    }

 ?>
