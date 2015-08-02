<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	if(isset($_POST['submit'])){
		// Process the form

		// Validations
		$required_fields=array("username","password");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Create

			$username=mysql_prep($_POST["username"]);
			$hashed_password=password_encrypt($_POST["password"]);

			$query="INSERT INTO users (";
			$query.=" username, hashed_password";
			$query.=") VALUES (";
			$query.=" '{$username}','{$hashed_password}'";
			$query.=")";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="user created.";
				redirect_to("manage_users.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="user creation failed."; 
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
		<h2>Create user</h2>
		<form action="new_user.php" method="post">
			<p>Username:
				&nbsp;
				<input type="text" name="username" value="" />
			</p>
			<p>Password:
				&nbsp;
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Create user" />
		</form>
		<br />
		<a href="manage_users.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>