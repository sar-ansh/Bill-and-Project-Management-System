<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	if(isset($_POST['agency_add'])){
		// Process the form

		// Validations
		$required_fields=array("name_of_agency","pan_no","tin_no","address_1","phone_no");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("name_of_agency" => 60,"pan_no" => 30,"tin_no" => 30,"address_1" => 200,"address_2" => 200,"address_3" => 200);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Create

			$name_of_agency=mysql_prep($_POST["name_of_agency"]);
			$pan_no=mysql_prep($_POST["pan_no"]);
			$tin_no=mysql_prep($_POST["tin_no"]);
			$address_1=mysql_prep($_POST["address_1"]);
			$address_2=mysql_prep($_POST["address_2"]);
			$address_3=mysql_prep($_POST["address_3"]);
			$phone_no=mysql_prep($_POST["phone_no"]);

			$query="INSERT INTO agencies (";
			$query.=" name_of_agency, pan_no, tin_no, address_1, address_2, address_3, phone_no";
			$query.=") VALUES (";
			$query.=" '{$name_of_agency}','{$pan_no}','{tin_no}','{$address_1}','{$address_2}','{$address_3}','{$phone_no}'";
			$query.=")";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="Agency added.";
				redirect_to("manage_agencies.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Agency addition failed.";
				redirect_to("manage_agencies.php");
			}
		}
	}
	else{
		// 	This is probably a GET request
	}
?>  

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Add New Agency:</h2>
		<form action="new_agency.php" method="post">
			<p>Name of the Agency :
				&nbsp;
				<input type="text" name="name_of_agency" value="" />
			</p>
			<p>Personal Account No.(PAN) :
				&nbsp;
				<input type="text" name="pan_no" value="" />
			</p>
			<p>Tax-Payer Identification No.(TIN) :
				&nbsp;
				<input type="text" name="tin_no" value="" />
			</p>
			<p>Address 1 :
				&nbsp;
				<input type="text" name="address_1" value="" />
			</p>
			<p>Address 2 :
				&nbsp;
				<input type="text" name="address_2" value="" />
			</p>
			<p>Address 3 :
				&nbsp;
				<input type="text" name="address_3" value="" />
			</p>
			<p>Phone No. :
				&nbsp;
				<input type="text" name="phone_no" value="" />
			</p>
			<input type="submit" name="agency_add" value="Add Agency" />
		</form>
		<br />
		<a href="manage_agencies.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>