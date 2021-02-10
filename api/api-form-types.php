<?php

	header('content.type: application/json');

	$request=$_SERVER['REQUEST_METHOD'];

	if($request=='GET'){

		form_types_list();

	}else if($request=='POST'){

		$data=json_decode(file_get_contents('php://input'),true);
		form_types_post($data);

	}
	else if($request=='PUT'){

		$data=json_decode(file_get_contents('php://input'),true);
		form_types_list_update($data);

	}else if($request=='DELETE'){

		$data=json_decode(file_get_contents('php://input'),true);
		Delete_form_types($data);

	}else{

		echo '{"name":"Response Error" }';
	}

	function  form_types_list(){

		include "../includes/db.php";

		$sql="SELECT * FROM form_types";

		$result=mysqli_query($con,$sql);
			if (mysqli_num_rows($result) > 0 ) {
				$rows=array();
				while ($row = mysqli_fetch_assoc($result)) {
					$rows["result"][]=$row;
				}
				echo json_encode($rows);
			}else{
				echo '{"result": "No Form Type Found"}';
			}
		}

	function form_types_post($data){

		include "../includes/db.php";

		$type_name=$data["type_name"];

		$sql="INSERT INTO form_types (type_name) VALUES ('$type_name')";

		if(mysqli_query($con,$sql)){

			echo '{"result":"New Form Type Added"}';
		}else{
			echo '{"result":"Form Type Not Added"}';
		}

	}

	function  form_types_list_update($data){

		include "../includes/db.php";

		$id=$data['id'];
		$type_name=$data['type_name'];

		$sql="UPDATE form_types SET id='$id', type_name='$type_name' WHERE id='$id'";

		if(mysqli_query($con,$sql)){

			echo '{"result":"Update Success"}';
		}else{
			echo '{"result":"Update Error"}';
		}
	}

	function Delete_form_types($data){

		include "../includes/db.php";

		$id=$data["id"];

		$sql="DELETE from form_types WHERE id='$id'";

		if(mysqli_query($con,$sql)){

			echo '{"result":"Delete Success"}';
		}else{
			echo '{"result":"Delete Error"}';
		}

	}
?>
