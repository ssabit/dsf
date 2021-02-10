<?php
session_start();

if(isset($_POST['login'])){

	include('db.php');


	$uid=mysqli_real_escape_string($con,$_POST['email']);

	$pwd=mysqli_real_escape_string($con,$_POST['password']);


	if(empty($uid)||empty($pwd)){
		header("Location: ../index.php?login=empty");

	}else{

		$q = "SELECT * FROM `subscription`";
					$res = mysqli_query($con,$q);
					  if (mysqli_num_rows($res) >0 ) {
					  while ($row = mysqli_fetch_array($res)) {


						$_SESSION['package']=$row['package'];
						//echo "login".$_SESSION['package'];
						//return;


					  }
					}


		$sql="SELECT * FROM users WHERE email='$uid'";

		$result=mysqli_query($con,$sql);
		$resultCheck=mysqli_num_rows($result);

		if($resultCheck<1){
			header("Location: ../index.php?login=credentialserror");
                        exit();

		}else{
			if($row=mysqli_fetch_assoc($result)){
			if(password_verify($pwd, $row['password'])){

				//login the user here
					$_SESSION['u_id']=$row['email'];
					$_SESSION['u_pwd']=$row['password'];
					$_SESSION['id']=$row['user_id'];
					$_SESSION['form_name']="";
					$_SESSION['image']=$row['image_name'];
					$_SESSION['service']=$row['service'];
					$_SESSION['designation']=$row['designation'];
					$_SESSION['u_level']=$row['role'];

					if($row['role']==1){


						header("Location: ../general_user/general_user.php");
						exit();
					}
					else if($row['role']==2){
							//echo "2";

						header("Location: ../service_provider/service_provider.php");
						exit();
					}
					else if($row['role']==3){


						header("Location: ../admin/admin.php");
						exit();
					}
					else{
						//echo "4";
						header("Location: ../index.php");
						exit();

					}

				}else{

                  header("Location: ../index.php?login=passworderror");
				}

			}

		}
        }
}else{

	header("Location: ../index.php?login=error");
	//echo "login error";
	//echo "<script>window.alert('Invalid User Name or Password')</script>";
	exit();

}

?>
