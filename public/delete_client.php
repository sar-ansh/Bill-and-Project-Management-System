<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$client=find_client_by_id($_GET["id"]); 
	if(!$client){
		redirect_to("manage_clients.php");
	}

	$id=$client["id"];
	$query="DELETE FROM clients WHERE id = {$id} LIMIT 1";
	$result=mysqli_query($connection,$query);

	if($result && mysqli_affected_rows($connection)==1){
		// Success
		$_SESSION["message"]="Client deleted.";
		redirect_to("manage_clients.php"); 
	}
	else{ 
		//Failure
		$_SESSION["message"]="Client deletion failed.";
		redirect_to("manage_clients.php"); 
	}
?>
