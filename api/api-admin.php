<?php
header("Content-type: application/json");

$request=$_SERVER['REQUEST_METHOD'];

if($request=='GET'){

	users_list();

}else if($request=='POST'){

	$data=json_decode(file_get_contents('php://input'),true);
	add_user($data);

}
else if($request=='PUT'){

	$data=json_decode(file_get_contents('php://input'),true);
	user_update($data);

}else if($request=='DELETE'){

	$data=json_decode(file_get_contents('php://input'),true);
	delete_user($data);

}else{

	echo '{"name":"Response Error" }';
}

function users_list(){

	include "../includes/db.php";

	$sql="select * from users";

	$result=mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0){
		$rows=array();
		while($r=mysqli_fetch_assoc($result)){

			$rows["result"][]=$r;
		}
		echo json_encode($rows);
	}else{

		echo '{"result": "No User Found"}';

	}
}

function add_user($data){

	include "../includes/db.php";

	$email=$data['email'];
	$password=$data['password'];
	$role=$data['role'];

	$hashpassword = password_hash($password, PASSWORD_BCRYPT);
	$sql = "INSERT INTO `users`(`email`, `password`,`role`) VALUES ('$email','$hashpassword',$role)";

	if(mysqli_query($con,$sql)){

		echo '{"result":"New User Added"}';
	}else{
		echo '{"result":"User Not Added"}';
	}

}

function user_update($data){

	include "../includes/db.php";

	$id=$data['user_id'];
	$email=$data['email'];
	$password=$data['password'];
	$role=$data['role'];

	$hashpassword = password_hash($password, PASSWORD_BCRYPT);

	$sql="UPDATE users SET email='$email',password='$hashpassword',role='$role' WHERE user_id='$id'";

	if(mysqli_query($con,$sql)){

		echo '{"result":"Update Success"}';
	}else{
		echo '{"result":"Update Error"}';
	}


}

function delete_user($data){

	include "../includes/db.php";

	$user_id=$data["user_id"];

	$sql="DELETE from users WHERE user_id='$user_id'";

	if(mysqli_query($con,$sql)){

		echo '{"result":"Delete Success"}';
	}else{
		echo '{"result":"Delete Error"}';
	}

}

?>
