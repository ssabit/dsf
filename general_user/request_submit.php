<?php
include_once( "../includes/db.php" );
session_start();
$userid=$_SESSION['id'];
echo $_SESSION['text-box'];
echo $_SESSION['combo-box'];
echo $_SESSION['text-area'];
echo $_SESSION['date'];
echo "Form ID:".$_SESSION['formid'];
$formid=$_SESSION['formid'];

//get form type
$q1="SELECT * FROM `forms` where form_id=$formid";
$r1 = mysqli_query($con,$q1);
$ro1 = mysqli_fetch_array($r1);
$form_type=$ro1['type_name'];


$date = new DateTime();
$date->setTimeZone( new DateTimeZone( "Asia/Dhaka" ) );
$get_datetime = $date->format( 'Y-m-d H:i:s' );

echo "<br>";
 // Check if the form is submitted
$tbox="";
$cbox="";
$tarea="";
$cboxid="";
$tboxid="";
$tareaid="";
$dateid="";
$date="";
if (isset( $_POST['submit'] ) ) {

	$q = "INSERT INTO `request`(`service_receiver_id`,`form_id`,`date_time`,`form_type`,`updated_on`) VALUES ($userid,$formid,'$get_datetime','$form_type','$get_datetime')";
	mysqli_query($con,$q);

	$q1="Select requiest_id from request where form_id=$formid and date_time='$get_datetime'";
	$res = mysqli_query($con,$q1);


	$row = mysqli_fetch_array($res);
	//echo "ResID".$row['requiest_id'];
	$reqid=$row['requiest_id'];

for( $i=0;$i<$_SESSION['text-box'];$i++){

$tboxid= $_POST["textboxid".$i];

$tbox= $_POST["textbox".$i];

	//echo $tboxid.":".$tbox."<br>";

	$q = "INSERT INTO `request_type_textbox`(`type_textbox_label`,`type_textbox_value`,`type_textbox_requestid`) VALUES ('$tboxid','$tbox',$reqid)";
	mysqli_query($con,$q);

}

echo "<br>";

for( $i=0;$i<$_SESSION['combo-box'];$i++){

	$cboxid= $_POST["comboxid".$i];
	$cbox= $_POST["combox".$i];

	//echo $cboxid.":".$cbox."<br>";

	$q = "INSERT INTO `request_type_dropdown`(`type_dropdown_label`,`type_dropdown_value`,`type_dropdown_requestid`) VALUES ('$cboxid','$cbox',$reqid)";
	mysqli_query($con,$q);




}

echo "<br>";


for( $i=0;$i<$_SESSION['date'];$i++){

	$dateid= $_POST["dateid".$i];
	$date= $_POST["date".$i];
	//echo $dateid.":".$date."<br>";



	$q = "INSERT INTO `request_type_date`(`type_date_label`,`type_date`,`type_date_requestid`) VALUES ('$dateid','$date',$reqid)";
	mysqli_query($con,$q);

}


for( $i=0;$i<$_SESSION['text-area'];$i++){


$tareaid= $_POST["textareaid".$i];
$tarea= $_POST["text-area".$i];

	//echo $tarea;
echo $tareaid.":".$tarea."<br>";

$q = "INSERT INTO `request_type_text`(`type_text_label`,`type_text_value`,`type_text_requestid`) VALUES ('$tareaid','$tarea',$reqid)";
	mysqli_query($con,$q);



}
header("Location:request_service.php");
}
else
	//echo "Not Get";

?>
