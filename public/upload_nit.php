<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php

	$error="Upload NIT";

	 if(isset($_POST['upload_nit'])){
		$name=$_FILES['file']['name'];
		$extension=strtolower(substr($name, strpos($name,'.')+1));
		
		$type=$_FILES['file']['type'];
		
		$size=$_FILES['file']['size'];
		$max_size=20000000;

		$tmp_name=$_FILES['file']['tmp_name'];

		if(isset($name)){
			if(!empty($name)){
				if(($extension=='xls'||$extension=='xlsx'||$extension=='pdf')&&($type=='application/vnd.ms-excel'||$type=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'||$type=='application/pdf')&&($size<=$max_size)){
					$location='files/nit/';
					if(move_uploaded_file($tmp_name, $location.$name)){
					$error="Uploaded";
					}
					else{
						$error="There was an error";
					}
				}
				else{
					$error="Invalid file";
				}
			}
			else{
				$error="Please choose a file.";
			}
		}
	}
	else{
		// 	This is probably a GET request
	}
?>

<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?> 

<div id="main">
	<div id="navigation">
		<br />
		<a href="logout.php">&laquo; Logout</a><br>
		<a href="manage_content.php?page=2">&laquo; Back</a><br />
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<h1>Notice Inviting Tender</h1><div style="margin-top: 0.5em; border-top: 1px #000000;"><hr/>
		<div class="error">
			<?php echo $error; ?>
		</div>
		<form action="upload_nit.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file">
			<input type="submit" name="upload_nit" value="Upload" />
		</form>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>