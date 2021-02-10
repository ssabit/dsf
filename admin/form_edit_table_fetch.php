<?php
session_start();
$getid=$_SESSION['sid'];
//fetch.php

include_once( "database_connection.php" );

//$query = "SELECT * FROM tbl_sample";
$query = "SELECT fields.id ,fields.label, fields.component_name FROM forms INNER JOIN fields ON forms.form_id=fields.form_id WHERE fields.form_id=$getid";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '<div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Form Fields Manage Page</h3>
            </div>
<div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                <th>Label</th>
                <th>Type</th>
                <th>Edit</th>
                <th>Delete</th>

                </tr>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td width="40%">'.$row["label"].'</td>
			<td width="40%">'.$row["component_name"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
			</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table></div>

        </div>';
echo $output;
?>
