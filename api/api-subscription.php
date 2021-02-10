<?php

	header('content.type: application/json');

	$request=$_SERVER['REQUEST_METHOD'];

	if($request=='GET'){
		subscription_get_info();
	}else if($request=='PUT'){
		$data=json_decode(file_get_contents('php://input'),true);
		subscription_update_info($data);
	}else{
		echo '{"name":"Response Error" }';
	}



	function  subscription_get_info(){

		include "../includes/db.php";
		$sql="SELECT * FROM subscription";

		$result=mysqli_query($con,$sql);
			if (mysqli_num_rows($result) > 0 ) {
				$rows=array();
				while ($row = mysqli_fetch_assoc($result)) {
					$rows["result"][]=$row;
				}
				echo json_encode($rows);
			}else{
				echo '{"result": "Subscription Data Not Found"}';
			}
		}


	function  subscription_update_info($data){

		include "../includes/db.php";
		$id=$data['id'];
		$subscription_key=$data['subscription_key'];
		$package=$data['package'];
		$exp_date=$data['exp_date'];

		$sql="UPDATE subscription SET subscription_key='$subscription_key', package=$package,exp_date='$exp_date' WHERE id='$id'";

		if(mysqli_query($con,$sql)){

			echo '{"result":"Update Success"}';
		}else{
			echo '{"result":"Update Error"}';
		}
	}


?>
