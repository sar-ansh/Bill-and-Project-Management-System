<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	if(isset($_POST['head_of_account_add'])){
		// Process the form

		// Validations
		$required_fields=array("head_of_account");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("head_of_account" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Create

			$head_of_account=mysql_prep($_POST["head_of_account"]);

			$query="INSERT INTO head_of_accounts (";
			$query.=" head_of_account"; 
			$query.=") VALUES (";
			$query.=" '{$head_of_account}'";
			$query.=")";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="Head_of_Account added.";
				redirect_to("manage_head_of_accounts.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Head_of_Account addition failed.";
				redirect_to("manage_head_of_accounts.php");
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
		<h2>Add New Head of Account:</h2>
		<form action="new_head_of_account.php" method="post">
			<p>Name of the Head of Account :
				&nbsp;
				<input type="text" name="head_of_account" value="" />
			</p>
			<input type="submit" name="head_of_account_add" value="Add Head of Account" />
		</form>
		<br />
		<a href="manage_head_of_accounts.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>