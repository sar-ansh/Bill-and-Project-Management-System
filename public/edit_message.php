<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$message=find_message_by_id($_GET["id"]);
	if(!$message){
		redirect_to("manage_messages.php");
	}
?>

<?php
	if(isset($_POST['submit'])){
		// Process the form

		// Validations
		$required_fields=array("content");
		validate_presences($required_fields);

		if(empty($errors)){
			//Perform Update

			$id=$message["id"];
			$content=mysql_prep($_POST["content"]);

			$query="UPDATE news_feed SET ";
			$query.="content='{$content}' ";
			$query.="WHERE id={$id} ";
			$query.="LIMIT 1";
			$result=mysqli_query($connection,$query);

			if($result && mysqli_affected_rows($connection)==1){
				// Success
				$_SESSION["message"]="Message Updated.";
				redirect_to("manage_messages.php"); 
			}
			else{ 
				//Failure
				$_SESSION["message"]="Message Update failed.";
				redirect_to("manage_messages.php");
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
		<h2>Edit Message: </h2>
		<form action="edit_message.php?id=<?php echo urlencode($message["id"]); ?>" method="post">
			<p>Message:<br />
				<textarea name="content" rows="20" cols="80"><?php echo htmlentities($message["content"]); ?></textarea>
			</p>
			<input type="submit" name="submit" value="Edit Message" />
		</form>
		<br />
		<a href="manage_messages.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>