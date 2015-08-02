<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$username="";
	if(isset($_POST['submit'])){
		// Process the form

		// Validations
		$required_fields=array("username","password");
		validate_presences($required_fields);

		if(empty($errors)){
			//Attempt Login
			
			$username=$_POST["username"];
			$password=$_POST["password"];

			if($found_admin=attempt_login_admin($username,$password)){
				// Success
				// Mark admin as logged in
				$_SESSION["admin_id"]=$found_admin["id"];
				$_SESSION["username"]=$found_admin["username"];
				redirect_to("admin.php"); 
			}
			else if($found_user=attempt_login_user($username,$password)){
				// Success
				// Mark user as logged in
				$_SESSION["admin_id"]=$found_user["id"];
				$_SESSION["username"]=$found_user["username"];
				redirect_to("manage_content.php");
			}
			else{ 
				//Failure
				$_SESSION["message"]="Username/password not found."; 
			}
		}
	}
	else{
		// 	This is probably a GET request
	}
?>  

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Login</h2>
		<form action="login.php" method="post">
			<p>Username:
				&nbsp;
				<input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
			</p>
			<p>Password:
				&nbsp;
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Login" />
		</form>
		<br />
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

