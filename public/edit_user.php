<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$user=find_user_by_id($_GET["id"]);
	if(!$user){
		redirect_to("manage_users.php");
	}
?>

<?php
	if(isset($_POST['submit'])){
		// Process the form

		// Validations
		$required_fields=array("username","password");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			//Perform Update

			$id=$user["id"];
			$username=mysql_prep($_POST["username"]);
			$hashed_password=password_encrypt($_POST["password"]);

			$query="UPDATE users SET ";
			$query.="username='{$username}', ";
			$query.="hashed_password='{$hashed_password}' ";
			$query.="WHERE id={$id} ";
			$query.="LIMIT 1";
			$result=mysqli_query($connection,$query);

			if($result && mysqli_affected_rows($connection)==1){
				// Success
				$_SESSION["message"]="user updated.";
				redirect_to("manage_users.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="user update failed.";
				redirect_to("manage_users.php");
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
		<h2>Edit user: <?php echo htmlentities($user["username"]); ?></h2>
		<form action="edit_user.php?id=<?php echo urlencode($user["id"]); ?>" method="post">
			<p>Username:
				<input type="text" name="username" value="<?php echo htmlentities($user["username"]); ?>" />
			</p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Edit user" />
		</form>
		<br />
		<a href="manage_users.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>