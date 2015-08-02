<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>
<!DOCTYPE html>

<?php include("../includes/layouts/header.php"); ?>
 
<div id="main">
	<div id="navigation">
		<br />
		<a href="logout.php">&laquo; Logout</a><br>
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h1>Generate Monthly Bill Report</h1><br /><hr/>
<FORM enctype="multipart/form-data" action="ImportInsertFinalState.php" method="POST" >
<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
<INPUT type="file" name="fileToUpload" id="fileToUpload" class='dec'/><BR><BR>
<input name="submit" value="submit" type = "submit" class='dec' />

</FORM>

	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

