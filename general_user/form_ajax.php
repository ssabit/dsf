<?php
include_once( "../includes/db.php" );
session_start();
$_SESSION[ 'combo-box' ] = 0;
$_SESSION[ 'text-box' ] = 0;
$_SESSION[ 'text-area' ] = 0;
$_SESSION[ 'date' ] = 0;
if ($_POST[ 'id' ] ) {
	$id = $_POST[ 'id' ];
	if ( $id == 0 ) {
		echo "Not Selecsted";
	}else {
		$form_id = $id;
		$ftyp="SELECT `type_name` FROM `forms` WHERE `form_id`=$form_id ";
		$result = mysqli_query( $con, $ftyp );

		$res = mysqli_fetch_array( $result );
		$res['type_name'];
		if($res['type_name']!="Application"){
			$sql = "SELECT * FROM fields where component_name='combo-box' && form_id=$form_id OR (component_name='combo-box' && Form_id=0)";
			$result = mysqli_query( $con, $sql );

			//Combo box section
			$_SESSION[ 'formid' ] = $form_id;



			$loop=0;
			while ( $res = mysqli_fetch_array( $result ) ) {

				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				//echo $label;
				echo "<div name='$label' id='$label' class='form-group'>";
				echo "<label for=" . $res[ 'label' ] . ">" . $res[ 'label' ] . "</label>";

				echo "<input id='$label' name='comboxid" . $_SESSION[ 'combo-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input id='$label' name='combox" . $_SESSION[ 'combo-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value=''>";



				echo "<select id='$label' class='form-control' id=" . $res[ 'label' ] . "

				onChange='this.form.combox" . $_SESSION[ 'combo-box' ] . ".value=this.options[this.selectedIndex].value'
				required>";

				$sql1 = "SELECT * FROM problem where form_id=$abc && label='$label'";
				$result1 = mysqli_query( $con, $sql1 );


				echo "<option value='" . $res1[ 'option_name' ] . "'>" . '--Select--' . "</option>";


				while ( $res1 = mysqli_fetch_array( $result1 ) ) {
					echo "<option value='" . $res1[ 'option_name' ] . "'>" . $res1[ 'option_name' ] . "</option>";
				}
				echo "</select>";

				echo "</div>";
				$_SESSION[ 'combo-box' ]++;
			}

			//text box section
			$sql = "SELECT * FROM fields where component_name='text-box' && form_id=$form_id OR (component_name='text-box' && Form_id=0)";
			$result = mysqli_query( $con, $sql ); //text box section


			while ( $res = mysqli_fetch_array( $result ) ) {

				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='show_text-box' id='show_text-box' class='form-group'>";
				echo "<label for=" . $res[ 'label' ] . "class='form-label'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='textboxid" . $_SESSION[ 'text-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input id='$label' name='textbox" . $_SESSION[ 'text-box' ] . "' placeholder='' class='form-control' type='text' required>";
				echo "</div>";
				$_SESSION[ 'text-box' ]++;
			}
			//////Date
			//text area section
			$sql = "SELECT * FROM fields where component_name='date' && Form_id=0";
			$result = mysqli_query( $con, $sql );


			while ( $res = mysqli_fetch_array( $result ) ) {
				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='date' id='date' class='form-group'>";
				echo "<label for='date'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='dateid" . $_SESSION[ 'date' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input  min=".date('Y-m-d')."  id='$label' name='date" . $_SESSION[ 'date' ] . "'     placeholder='' class='form-control' type='date' required>";
				echo "</div>";
				$_SESSION[ 'date' ]++;
			}

			//text area section
			$sql = "SELECT * FROM fields where component_name='text-area' && form_id=$form_id OR (component_name='text-area' && Form_id=0)";
			$result = mysqli_query( $con, $sql );


			while ( $res = mysqli_fetch_array( $result ) ) {
				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='show_text-area' id='show_text-area' class='form-group'>";
				echo "<label for='comment'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='textareaid" . $_SESSION[ 'text-area' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<textarea name='text-area" . $_SESSION[ 'text-area' ] . "' class='form-control' rows='5' id='comment' required></textarea>";
				echo "</div>";
				$_SESSION[ 'text-area' ]++;
			}
		}else{
			$sql = "SELECT * FROM fields where component_name='combo-box' && form_id=$form_id";
			$result = mysqli_query( $con, $sql );

			//Combo box section
			$_SESSION[ 'formid' ] = $form_id;



			$loop=0;
			while ( $res = mysqli_fetch_array( $result ) ) {

				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				//echo $label;
				echo "<div name='$label' id='$label' class='form-group'>";
				echo "<label for=" . $res[ 'label' ] . ">" . $res[ 'label' ] . "</label>";

				echo "<input id='$label' name='comboxid" . $_SESSION[ 'combo-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input id='$label' name='combox" . $_SESSION[ 'combo-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value=''>";



				echo "<select id='$label' class='form-control' id=" . $res[ 'label' ] . "

				onChange='this.form.combox" . $_SESSION[ 'combo-box' ] . ".value=this.options[this.selectedIndex].value'
				required>";

				$sql1 = "SELECT * FROM problem where form_id=$abc && label='$label'";
				$result1 = mysqli_query( $con, $sql1 );


				echo "<option value='" . $res1[ 'option_name' ] . "'>" . '--Select--' . "</option>";


				while ( $res1 = mysqli_fetch_array( $result1 ) ) {
					echo "<option value='" . $res1[ 'option_name' ] . "'>" . $res1[ 'option_name' ] . "</option>";
				}
				echo "</select>";

				echo "</div>";
				$_SESSION[ 'combo-box' ]++;
			}

			//text box section
			$sql = "SELECT * FROM fields where component_name='text-box' && form_id=$form_id";
			$result = mysqli_query( $con, $sql ); //text box section


			while ( $res = mysqli_fetch_array( $result ) ) {

				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='show_text-box' id='show_text-box' class='form-group'>";
				echo "<label for=" . $res[ 'label' ] . "class='form-label'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='textboxid" . $_SESSION[ 'text-box' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input id='$label' name='textbox" . $_SESSION[ 'text-box' ] . "' placeholder='' class='form-control' type='text' required>";
				echo "</div>";
				$_SESSION[ 'text-box' ]++;
			}
			//////Date
			//text area section
			$sql = "SELECT * FROM fields where component_name='date' && Form_id=$form_id";
			$result = mysqli_query( $con, $sql );


			while ( $res = mysqli_fetch_array( $result ) ) {
				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='date' id='date' class='form-group'>";
				echo "<label for='date'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='dateid" . $_SESSION[ 'date' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<input  min=".date('Y-m-d')."  id='$label' name='date" . $_SESSION[ 'date' ] . "'     placeholder='' class='form-control' type='date' required>";
				echo "</div>";
				$_SESSION[ 'date' ]++;
			}

			//text area section
			$sql = "SELECT * FROM fields where component_name='text-area' && form_id=$form_id ";
			$result = mysqli_query( $con, $sql );


			while ( $res = mysqli_fetch_array( $result ) ) {
				$abc = $res[ 'form_id' ];
				$label = $res[ 'label' ];
				echo "<div  name='show_text-area' id='show_text-area' class='form-group'>";
				echo "<label for='comment'>" . $res[ 'label' ] . "</label>";
				echo "<input id='$label' name='textareaid" . $_SESSION[ 'text-area' ] . "'  placeholder='' class='form-control' type='hidden' style='width:50%;float:left;' value='$label'>";
				echo "<textarea name='text-area" . $_SESSION[ 'text-area' ] . "' class='form-control' rows='5' id='comment' required></textarea>";
				echo "</div>";
				$_SESSION[ 'text-area' ]++;
			}



		}




	}
}

?>
