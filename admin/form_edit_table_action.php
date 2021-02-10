<?php
session_start();
//action.php
$getid=$_SESSION['sid'];
include_once( "database_connection.php" );
if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "INSERT INTO fields (label, component_name,form_id) VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."',$getid)";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM fields WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['first_name'] = $row['label'];
			$output['last_name'] = $row['component_name'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE fields
		SET label= '".$_POST["first_name"]."',
		component_name = '".$_POST["last_name"]."'
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM fields WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>
