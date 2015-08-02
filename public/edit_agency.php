<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$agency=find_agency_by_id($_GET["id"]);
	if(!$agency){
		redirect_to("manage_agencies.php");
	}
?>

<?php
	if(isset($_POST['agency_submit'])){
		// Process the form
		$id=$agency["id"];
		$name_of_agency=mysql_prep($_POST["name_of_agency"]);
		$pan_no=mysql_prep($_POST["pan_no"]);
		$tin_no=mysql_prep($_POST["tin_no"]);
		$address_1=mysql_prep($_POST["address_1"]);
		$address_2=mysql_prep($_POST["address_2"]);
		$address_3=mysql_prep($_POST["address_3"]);
		$phone_no=mysql_prep($_POST["phone_no"]);

		// Validations
		$required_fields=array("name_of_agency","pan_no","tin_no","address_1","phone_no");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("name_of_agency" => 60,"pan_no" => 30,"tin_no" => 30,"address_1" => 200,"address_2" => 200,"address_3" => 200);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Update

			$query="UPDATE agencies SET ";
			$query.="name_of_agency='{$name_of_agency}', ";
			$query.="pan_no='{$pan_no}', "; 
			$query.="tin_no='{$tin_no}', "; 
			$query.="address_1='{$address_1}', "; 
			$query.="address_2='{$address_2}', "; 
			$query.="address_3='{$address_3}', "; 
			$query.="phone_no='{$phone_no}'  "; 
			$query.="WHERE id={$id} ";
			$query.="LIMIT 1";
			$result=mysqli_query($connection,$query);
			
			if($result && mysqli_affected_rows($connection)==1){
				// Success
				$_SESSION["message"]="Agency update successful.";
				redirect_to("manage_agencies.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Agency update failed.";
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
		<h2>Edit Agency: <?php echo htmlentities($agency["name_of_agency"]); ?></h2>
		<form action="edit_agency.php?id=<?php echo urlencode($agency["id"]); ?>" method="post">
			<p>Name of the Agency :
				&nbsp;
				<input type="text" name="name_of_agency" value="<?php echo htmlentities($agency["name_of_agency"]); ?>" />
			</p>
			<p>Personal Account No.(PAN) :
				&nbsp;
				<input type="text" name="pan_no" value="<?php echo htmlentities($agency["pan_no"]); ?>" />
			</p>
			<p>Tax-Payer Identification No.(TIN) :
				&nbsp;
				<input type="text" name="tin_no" value="<?php echo htmlentities($agency["tin_no"]); ?>" />
			</p>
			<p>Address 1 :
				&nbsp;
				<input type="text" name="address_1" value="<?php echo htmlentities($agency["address_1"]); ?>" />
			</p>
			<p>Address 2 :
				&nbsp;
				<input type="text" name="address_2" value="<?php echo htmlentities($agency["address_2"]); ?>" />
			</p>
			<p>Address 3 :
				&nbsp;
				<input type="text" name="address_3" value="<?php echo htmlentities($agency["address_3"]); ?>" />
			</p>
			<p>Phone No. :
				&nbsp;
				<input type="text" name="phone_no" value="<?php echo htmlentities($agency["phone_no"]); ?>" />
			</p>
			<input type="submit" name="agency_submit" value="Edit Agency" />
		</form>
		<br />
		<a href="manage_agencies.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>