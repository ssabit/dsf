<?php
session_start();
if($_SESSION['u_id']==NULL){

    header("Location: ../index.php?login=error");
}
session_unset(); 
session_destroy(); 
header("Location: ../index.php");
?>