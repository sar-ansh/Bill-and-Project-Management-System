<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
	if(isset($_POST['submit'])){
		// Process the form
		
		// Validations
		$required_fields=array("nij_code","mb_no","bill_no","s_no_of_bill","date","ra_fa");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("nij_code" => 30,"mb_no" => 30,"bill_no" => 30,"s_no_of_bill" => 30,"date" => 30,"ra_fa" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			// Perform Create

			$nij_code=mysql_prep($_POST["nij_code"]);
			$mb_no=mysql_prep($_POST["mb_no"]);
			$bill_no=mysql_prep($_POST["bill_no"]);
			$s_no_of_bill=mysql_prep($_POST["s_no_of_bill"]);
			$date=mysql_prep($_POST["date"]);
			$ra_fa=mysql_prep($_POST["ra_fa"]);

			$query="INSERT INTO bills (nij_code, mb_no, bill_no, s_no_of_bill, date, ra_fa) VALUES ('{$nij_code}','{$mb_no}','{$bill_no}','{$s_no_of_bill}','{$date}','{$ra_fa}')";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="New Bill Entry in progress";
				redirect_to("final_bill.php?code=".urlencode($nij_code)); 
			}
			else{
				//Failure
				$_SESSION["message"]="New Bill Entry failed.";
				redirect_to("view_bills.php"); 
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
		<br />
		<a href="logout.php">&laquo; Logout</a><br>
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<h1>New Bill Entry</h1><br /><hr/>

		<form action="new_bill.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
			<table cellspacing=5>
				<tr>
					<td>NIJ TS Code : </td><td><input type="text" name="nij_code" value=""></td>
					<td>M.B. No. : </td><td><input type="text" name="mb_no" value=""></td>
				</tr>
				<tr>
					<td>Bill No. : </td><td><input type="text" name="bill_no" value=""></td>
					<td>S. No. of Bill : </td><td><input type="text" name="s_no_of_bill" value=""></td>
				</tr>
				<tr>
					<td>Date : </td><td><input type="date" name="date" value=""></td>
					<td>RA/FA : </td><td><input type="text" name="ra_fa" value=""></td>
				</tr>
				<tr align=center>
					<td colspan=4><input type="submit" name="submit" value="Next" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>