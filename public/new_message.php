<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	if(isset($_POST['submit'])){
		// Process the form

		// Validations
		$required_fields=array("content");
		validate_presences($required_fields);

		if(empty($errors)){
			// Perform Create

			//make sure you add the subject_id
			$content=mysql_prep($_POST["content"]);

			$query="INSERT INTO news_feed ( content ) VALUES ('{$content}')";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="Message Posted.";
				redirect_to("manage_messages.php");
			}
			else{ 
				//Failure
				$_SESSION["message"]="Message Posting failed.";
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
		<br>
		<a href="admin.php">&laquo; Admin Menu</a><br>
	</div>
	<div id="page">
		<div style="display:flex; justify-content:space-around;">
			<div>
				<?php echo form_errors($errors); ?>
				<form action="new_message.php" method="post">
					<p>Message:<br />
						<textarea name="content" rows="20" cols="80"></textarea>
					</p>
					<input type="submit" name="submit" value="Post on news feed" />
				</form>
				<br />
			</div>
			<div>
				
			</div>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>