<?php
include_once( "../includes/db.php" );
session_start();
$package=$_SESSION['package'];

echo "Transaction Success.";
$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("secret");
$store_passwd=urlencode("secret@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;

	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;

	echo "<br>Status: ".$status."<br>";
	echo "Transaction ID: ".$tran_id."<br>";
	echo "Transaction Date :".$tran_date."<br>";
	echo "Card Type: ".$card_type;

///Key Generate

for ($i = -1; $i <= 5; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex   = bin2hex($bytes);
echo $hex;
}
$date = new DateTime();
$date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
$get_datetime = $date->format( 'Y-m-d' );

$expdate = date('Y-m-d', strtotime('+1 years'));

if($package=='standard'){
	$package=2;
}else if($package=='premium'){
	$package=3;
}else{
	$package=1;
}


$sqldel="DELETE FROM `subscription`";
mysqli_query($con,$sqldel);

if($package==1){
	$sql="INSERT INTO `subscription`(`subscription_key`, `package`,`exp_date`) VALUES ('$hex',$package,'$expdate')";
	mysqli_query($con,$sql);

	mysqli_query($con,"UPDATE `settings` SET `name`='email',`status`=0 WHERE id=1");
	mysqli_query($con,"UPDATE `settings` SET `name`='sms',`status`=0 WHERE id=2");
}else if($package==2){
	$sql="INSERT INTO `subscription`(`subscription_key`, `package`,`exp_date`) VALUES ('$hex',$package,'$expdate')";
	mysqli_query($con,$sql);

	mysqli_query($con,"UPDATE `settings` SET `name`='email',`status`=1 WHERE id=1");
	mysqli_query($con,"UPDATE `settings` SET `name`='sms',`status`=0 WHERE id=2");
}else if($package==3){
	$sql="INSERT INTO `subscription`(`subscription_key`, `package`,`exp_date`) VALUES ('$hex',$package,'$expdate')";
	mysqli_query($con,$sql);

	mysqli_query($con,"UPDATE `settings` SET `name`='email',`status`=1 WHERE id=1");
	mysqli_query($con,"UPDATE `settings` SET `name`='sms',`status`=1 WHERE id=2");
}



header("Location:../index.php?payment=success");

} else {

	echo "Failed to connect with SSLCOMMERZ";
}
?>
