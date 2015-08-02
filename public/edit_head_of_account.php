<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$head_of_account=find_head_of_account_by_id($_GET["id"]);
	if(!$head_of_account){
		redirect_to("manage_head_of_accounts.php");
	}
?>

<?php
	if(isset($_POST['head_of_account_submit'])){
		// Process the form
		$id=$head_of_account["id"];
		$head_of_account=mysql_prep($_POST["head_of_account"]);

		// Validations
		$required_fields=array("head_of_account");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("head_of_account" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Update

			$query="UPDATE head_of_accounts SET ";
			$query.="head_of_account='{$head_of_account}' ";
			$query.="WHERE id={$id} ";
			$query.="LIMIT 1";
			$result=mysqli_query($connection,$query);
			
			if($result && mysqli_affected_rows($connection)==1){
				// Success
				$_SESSION["message"]="Head_of_Account update successful.";
				redirect_to("manage_head_of_accounts.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Head_of_Account update failed.";
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
		<h2>Edit Head of Account: <?php echo htmlentities($head_of_account["head_of_account"]); ?></h2>
		<form action="edit_head_of_account.php?id=<?php echo urlencode($head_of_account["id"]); ?>" method="post">
			<p>Name of the Head of Account :
				&nbsp;
				<input type="text" name="head_of_account" value="<?php echo htmlentities($head_of_account["head_of_account"]); ?>" />
			</p>
			<input type="submit" name="head_of_account_submit" value="Edit Head of Account" />
		</form>
		<br />
		<a href="manage_head_of_accounts.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>