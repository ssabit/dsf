<?php
//insert.php;
session_start();
include_once( "database_connection.php" );
if(isset($_POST["form_label"]))
{

 $form_name=$_POST["form_name"];
 $form_type=$_POST["form_type"];
 $_SESSION['form_name']=$form_name;

 $sql = "INSERT INTO forms (form_name,type_name) VALUES ('$form_name','$form_type')";
 $stmt= $connect->prepare($sql);
 $stmt->execute([$form_name]);
 $form_id = $connect->query("SELECT form_id FROM  forms WHERE form_name='$form_name' ORDER BY form_id DESC LIMIT 1")->fetch();



 for($count = 0; $count < count($_POST["form_label"]); $count++)
 {
  $query = "INSERT INTO fields
  (label,component_name,form_id)
  VALUES (:form_label,:item_type,:form_id)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':form_id'   => $form_id['form_id'],
    ':form_label'  => $_POST["form_label"][$count],
    ':item_type'  => $_POST["item_type"][$count]
   )
  );
 }

 $result = $statement->fetchAll();
 if(isset($result))
 {

  echo 'ok';
 }
}
?>
