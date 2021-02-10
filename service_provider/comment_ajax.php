<?php include '../includes/db.php';?>

<?php

	extract($_POST);

    $date = new DateTime();
	$date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
	$get_datetime = $date->format( 'g:i A, d-M-y' );
	$reqid;
	if(isset($_POST['req_id'])){
		$reqid=$_POST['req_id'];
	}

	//$reqid=$_POST['request_id'];
    if (isset($_POST['request_id']) && isset($_POST['user_id']) && isset($_POST['comment'])) {
		$user_id=$_POST['user_id'];
		$image=$_POST['image'];
		$reqid=$_POST['request_id'];
		////Get User Name
		$read_full_name;
		$sql = "SELECT * from users where user_id=$user_id";
		$res = mysqli_query( $con, $sql );
		while ( $row = mysqli_fetch_array( $res ) ) {
		$read_first_name=$row[ 'first_name' ];
		$read_last_name=$row[ 'last_name' ];
		$read_full_name=$read_first_name." ".$read_last_name;

}
        $q = "INSERT INTO `comments`(`user_id`, `request_id`,`comment`,`user_name`,`image`) VALUES ($user_id,$request_id,'$comment','$read_full_name','$image')";
        $res = mysqli_query($con,$q);
    }

    // View records

	if (isset($_POST['readRecords']) || isset($_POST['req_id'])) {

		if (isset($_POST['req_id'])){
			$reqid=$_POST['req_id'];
		}else{
			$reqid=$_POST['request_id'];
		}




    $q = "SELECT * FROM `comments` where request_id=$reqid";
    $res = mysqli_query($con,$q);
    if (mysqli_num_rows($res) >= 0 ) {

	while ($row = mysqli_fetch_array($res)) {
    $data='<div class="box-comment">
	<!-- User image -->
	<img class="img-circle img-sm" src="../uploads/'.trim($row['image']).'" alt="User Image">
	<div id="comment-text" class="comment-text">

					<span class="username">'
					.$row['user_name'].
						'<span class="text-muted pull-right">'.date("Y-M-d h:i A", strtotime($row['time'])).'</span>
					</span>'
				.$row['comment'].
				'</div></div>
				</div>
			';
			echo $data;
		}

	};

    //echo $data;
	}

 ?>
