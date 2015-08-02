<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php
	$head_of_account=find_head_of_account_by_id($_GET["id"]); 
	if(!$head_of_account){
		redirect_to("manage_head_of_accounts.php");
	}

	$id=$head_of_account["id"];
	$query="DELETE FROM head_of_accounts WHERE id = {$id} LIMIT 1";
	$result=mysqli_query($connection,$query);

	if($result && mysqli_affected_rows($connection)==1){
		// Success
		$_SESSION["message"]="Head_of_Account deleted.";
		redirect_to("manage_head_of_accounts.php"); 
	}
	else{ 
		//Failure
		$_SESSION["message"]="Head_of_Account deletion failed.";
		redirect_to("manage_head_of_accounts.php"); 
	}
?>
