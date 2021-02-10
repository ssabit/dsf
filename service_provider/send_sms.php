<?php
include '../includes/db.php';
require __DIR__ . '/Twilio/autoload.php';
use Twilio\Rest\Client;

$num;
$sid;
$auth;
$number;

//echo $_GET['usernum'];
//echo $_GET['status'];
//return;
if(isset($_GET['empnum']) || isset($_GET['usernum'])){

	$q = "SELECT * FROM `twilio`";
    $res = mysqli_query($con,$q);
    if (mysqli_num_rows($res) > 0 ) {

			while ($row = mysqli_fetch_array($res)) {

				$sid=$row['sid'];
				$auth=$row['auth'];
				$number=$row['number'];
					}
		}

	if(isset($_GET['empnum'])!=NULL){

			$num=base64_decode(urldecode($_GET['empnum']));
			// Your Account SID and Auth Token from twilio.com/console
			$account_sid =$sid;
			$auth_token =$auth;
			// In production, these should be environment variables. E.g.:
			// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
			// A Twilio number you own with SMS capabilities
			$twilio_number=$number;
			$client = new Client($account_sid, $auth_token);
			$client->messages->create(
			// Where to send a text message (your cell phone?)
			'+88'.$num,
			array(
				'from' => $twilio_number,
				'body' => "You are assigned for a task. Please go to your office for more details.Thank you!"
		)
			);



	}else if (isset($_GET['usernum'])!=NULL){
		$num=base64_decode(urldecode($_GET['usernum']));;
			// Your Account SID and Auth Token from twilio.com/console
			$account_sid =$sid;
			$auth_token =$auth;
			// In production, these should be environment variables. E.g.:
			// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
			// A Twilio number you own with SMS capabilities
			$twilio_number =$number;
			$client = new Client($account_sid, $auth_token);
			$stat="";
			if($_GET['status']==1){
				$stat="Your request is In Progress.Thank you!";
			}
			else if($_GET['status']==2){
				$stat="Your request is Dispatched and Waiting for your confirmation.Thank you!";
			}else{
				$stat="Your request is Completed.Thank you!";
			}

			$client->messages->create(
			// Where to send a text message (your cell phone?)
			'+88'.$num,
			array(
				'from' => $twilio_number,
				'body' => $stat
		)
			);

	}else{
		echo "ERROR!";
	}

}

header("Location: service_provider.php");

?>
