<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	if(isset($_POST['client_add'])){
		// Process the form

		// Validations
		$required_fields=array("name_of_client","client_address");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("name_of_client" => 30,"client_address" => 60);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Create

			$name_of_client=mysql_prep($_POST["name_of_client"]);
			$client_address=mysql_prep($_POST["client_address"]);

			$query="INSERT INTO clients (";
			$query.=" name_of_client, client_address";
			$query.=") VALUES (";
			$query.=" '{$name_of_client}','{$client_address}'";
			$query.=")";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="Client added.";
				redirect_to("manage_clients.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Client addition failed.";
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
		<h2>Add New Client:</h2>
		<form action="new_client.php" method="post">
			<p>Name of the client :
				&nbsp;
				<input type="text" name="name_of_client" value="" />
			</p>
			<p>Client Address :
				&nbsp;
				<input type="text" name="client_address" value="" />
			</p>
			<input type="submit" name="client_add" value="Add client" />
		</form>
		<br />
		<a href="manage_clients.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>