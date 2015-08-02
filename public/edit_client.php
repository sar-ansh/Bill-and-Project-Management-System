<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$client=find_client_by_id($_GET["id"]);
	if(!$client){
		redirect_to("manage_clients.php");
	}
?>

<?php
	if(isset($_POST['client_submit'])){
		// Process the form
		$id=$client["id"];
		$name_of_client=mysql_prep($_POST["name_of_client"]);
		$client_address=mysql_prep($_POST["client_address"]);

		// Validations
		$required_fields=array("name_of_client","client_address");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("name_of_client" => 30,"client_address" => 60);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Update

			$query="UPDATE clients SET ";
			$query.="name_of_client='{$name_of_client}', ";
			$query.="client_address='{$client_address}' ";  
			$query.="WHERE id={$id} ";
			$query.="LIMIT 1";
			$result=mysqli_query($connection,$query);
			
			if($result && mysqli_affected_rows($connection)==1){
				// Success
				$_SESSION["message"]="Client update successful.";
				redirect_to("manage_clients.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Client update failed.";
				redirect_to("manage_clients.php");
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
		<h2>Edit client: <?php echo htmlentities($client["name_of_client"]); ?></h2>
		<form action="edit_client.php?id=<?php echo urlencode($client["id"]); ?>" method="post">
			<p>Name of the client :
				&nbsp;
				<input type="text" name="name_of_client" value="<?php echo htmlentities($client["name_of_client"]); ?>" />
			</p>
			<p>Client Address :
				&nbsp;
				<input type="text" name="client_address" value="<?php echo htmlentities($client["client_address"]); ?>" />
			</p>
			<input type="submit" name="client_submit" value="Edit client" />
		</form>
		<br />
		<a href="manage_clients.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>