<?php
include_once( "database_connection.php" );
if(isset($_POST["item_name"]))
{

 //$order_id = uniqid();
 $drop_down_name=$_POST["dropdown"];

 $form_id = $connect->query("SELECT form_id FROM fields where component_name='combo-box' and label='$drop_down_name'")->fetch();

 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {
  $query = "INSERT INTO problem
  (label,option_name,form_id)
  VALUES (:dropdown_name, :item_name, :form_id)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':form_id'   => $form_id['form_id'],
    ':item_name'  => $_POST["item_name"][$count],
    ':dropdown_name'  => $_POST["dropdown"]
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
