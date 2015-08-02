<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $bill_set=find_all_bills(); ?>

<?php
	
	$error="Upload Bill";

	 if(isset($_POST['upload_bill'])){
	 	$name=$_FILES['file']['name'];
		$size=$_FILES['file']['size'];
		$max_size=20000000;

		$tmp_name=$_FILES['file']['tmp_name'];

		if(isset($name)){
			if(!empty($name)){
				$location='files/bill/';
				if(move_uploaded_file($tmp_name, $location.$name)){
					$error="Uploaded";
				}
				else{
					$error="There was an error";
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
		<a href="view_bills.php">&laquo; Back</a><br />
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<h1>For bill -> 
		<?php 
			while($bill=mysqli_fetch_assoc($bill_set)){ 
				if($_GET["id"]==$bill["id"]){
					echo $bill["nij_code"];
				}
			}
		?>
		</h1><div style="margin-top: 0.5em; border-top: 1px #000000;"><hr/>
			<div class="error">
				<?php echo $error; ?>
			</div>									
		<form action="upload_bill.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file">
			<input type="submit" name="upload_bill" value="Upload">
		</form> 
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>