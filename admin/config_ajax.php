<?php include '../includes/db.php';
session_start();
$_SESSION['package'];
?>

<?php

	//extract($_POST);


	if (isset($_POST['readRecords'])) {

		$data = '<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage User</h3>
            </div><div class="box-body table-responsive no-padding">
              <table class="table table-hover">
    				<thead>
    				  <tr>
    				    <th>S.No.</th>
						<th>Settings</th>
						<th>Status</th>
    				    <th>Actions</th>

    				  </tr>
					</thead>';

	if($_SESSION['package']==2){

		$q = "SELECT * FROM `settings` limit 1";
    	$res = mysqli_query($con,$q);
    	 if (mysqli_num_rows($res) > 0 ) {
    $s_no = 1;

		while ($row = mysqli_fetch_array($res)) {





    $data.="<tbody>
						<tr>";
						$id=$row['id'];
							$data.=" <td>".$s_no."</td>";

							if($row['name']=='email'){
								$data.="<td><small class='label bg-blue'><i class='fa fa-envelope' aria-hidden='true'></i> Email</small></td>";
							}else{
								$data.="<td><small class='label bg-blue'><i class='fa fa-commenting' aria-hidden='true'></i>SMS</small></td>";
							}

							if($row['status']==0){
								$data.="<td><small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> OFF</small></td>";
							}else{
								$data.="<td><small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> ON</small></td>";
							}





			if($row['status']==0)
				{
        			$stat="ON";

				$data.='<td><a class="btn btn-success btn-xs details" onclick="updateSetings('.$id.',1)".><i class="fa fa-toggle-on" aria-hidden="true"></i>'. $stat.'</a></td>';
        }else{
			$stat="OFF";
			$data.='<td><a class="btn btn-danger btn-xs details"  onclick="updateSetings('.$id.',0)".><i class="fa fa-toggle-off aria-hidden="true"></i> '.$stat.'</a></td>';
        }


			$data.="</tr>
    </tbody>";
$s_no++;
}
}


					}else if($_SESSION['package']==3){
						$q = "SELECT * FROM `settings`";
						$res = mysqli_query($con,$q);
						 if (mysqli_num_rows($res) > 0 ) {
					$s_no = 1;

						while ($row = mysqli_fetch_array($res)) {

					$data.="<tbody>
										<tr>";
										$id=$row['id'];
											$data.=" <td>".$s_no."</td>";
											if($row['name']=='email'){
												$data.="<td><small class='label bg-blue'><i class='fa fa-envelope' aria-hidden='true'></i> Email</small></td>";
											}else{
												$data.="<td><small class='label bg-blue'><i class='fa fa-commenting' aria-hidden='true'></i> SMS</small></td>";
											}

											if($row['status']==0){
												$data.="<td><small class='label bg-red'><i class='fa fa-times' aria-hidden='true'></i> OFF</small></td>";
											}else{
												$data.="<td><small class='label bg-green'><i class='fa fa-check' aria-hidden='true'></i> ON</small></td>";
											}





							if($row['status']==0)
								{
									$stat="ON";

								$data.='<td><a class="btn btn-success btn-xs details" onclick="updateSetings('.$id.',1)".><i class="fa fa-toggle-on" aria-hidden="true"></i>'. $stat.'</a></td>';
						}else{
							$stat="OFF";
							$data.='<td><a class="btn btn-danger btn-xs details"  onclick="updateSetings('.$id.',0)".><i class="fa fa-toggle-off aria-hidden="true"></i> '.$stat.'</a></td>';
						}


							$data.="</tr>
					</tbody>";
				$s_no++;
				}
				}



					}


$data.='</table></div></div>';

echo $data;
	}


////Update status

if (isset($_POST['status'])) {
    $iid = $_POST['id'];
    $sts = $_POST['status'];


    $query = "UPDATE settings SET status=$sts WHERE id=$iid";

    $result = mysqli_query($con,$query);


}
 ?>
