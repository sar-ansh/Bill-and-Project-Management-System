<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$agency=find_agency_by_id($_GET["id"]); 
	if(!$agency){
		redirect_to("manage_agencies.php");
	}

	$id=$agency["id"];
	$query="DELETE FROM agencies WHERE id = {$id} LIMIT 1";
	$result=mysqli_query($connection,$query);

	if($result && mysqli_affected_rows($connection)==1){
		// Success
		$_SESSION["message"]="Agency deleted.";
		redirect_to("manage_agencies.php"); 
	}
	else{ 
		//Failure
		$_SESSION["message"]="Agency deletion failed.";
		redirect_to("manage_agencies.php"); 
	}
?>
