<?php
//including the database connection file
include("../includes/db.php");
session_start();

//getting id of the data from url
$id = $_GET['id'];



mysqli_query($con, "UPDATE forms SET visible=-1 WHERE form_id =$id");

header("Location:form.php");


?>
