<?php

	header('content.type: application/json');

	$request=$_SERVER['REQUEST_METHOD'];

	if($request=='GET'){
		twilio_get_info();
	}else if($request=='PUT'){
		$data=json_decode(file_get_contents('php://input'),true);
		twilio_update_info($data);
	}else{
		echo '{"name":"Response Error" }';
	}



	function  twilio_get_info(){

		include "../includes/db.php";
		$sql="SELECT * FROM twilio";

		$result=mysqli_query($con,$sql);
			if (mysqli_num_rows($result) > 0 ) {
				$rows=array();
				while ($row = mysqli_fetch_assoc($result)) {
					$rows["result"][]=$row;
				}
				echo json_encode($rows);
			}else{
				echo '{"result": "Twilio Data Not Found"}';
			}
		}


	function  twilio_update_info($data){

		include "../includes/db.php";
		$id=$data['id'];
		$name=$data['sid'];
		$email=$data['auth'];
		$number=$data['number'];

		$sql="UPDATE twilio SET sid='$name', auth='$email',number='$number' WHERE id='$id'";

		if(mysqli_query($con,$sql)){

			echo '{"result":"Update Success"}';
		}else{
			echo '{"result":"Update Error"}';
		}
	}


?>
