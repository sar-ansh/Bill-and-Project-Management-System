<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$message=find_message_by_id($_GET["id"]); 
	if(!$message){
		redirect_to("manage_messages.php");
	}

	$id=$message["id"];
	$query="DELETE FROM news_feed WHERE id = {$id} LIMIT 1";
	$result=mysqli_query($connection,$query);

	if($result && mysqli_affected_rows($connection)==1){
		// Success
		$_SESSION["message"]="message deleted.";
		redirect_to("manage_messages.php"); 
	}
	else{ 
		//Failure
		$_SESSION["message"]="message deletion failed.";
		redirect_to("manage_messages.php"); 
	}
?>
