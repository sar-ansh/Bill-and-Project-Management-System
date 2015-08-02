<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
	if(isset($_POST['submit'])){
		// Process the form
		$id=$_GET["id"];
		$nij_code=mysql_prep($_POST["nij_code"]);
		$mb_no=mysql_prep($_POST["mb_no"]);
		$bill_no=mysql_prep($_POST["bill_no"]);
		$s_no_of_bill=mysql_prep($_POST["s_no_of_bill"]);
		$date=mysql_prep($_POST["date"]);
		$ra_fa=mysql_prep($_POST["ra_fa"]);
		$name_of_work=mysql_prep($_POST["name_of_work"]);
		$agreement_no=mysql_prep($_POST["agreement_no"]);
		$name_of_agency=mysql_prep($_POST["name_of_agency"]);
		$head_of_account=mysql_prep($_POST["head_of_account"]);
		$wb_pms_id=mysql_prep($_POST["wb_pms_id"]);

		// Validations
		$required_fields=array("nij_code","mb_no","bill_no","s_no_of_bill","date","ra_fa");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("nij_code" => 30,"mb_no" => 30,"bill_no" => 30,"s_no_of_bill" => 30,"date" => 30,"ra_fa" => 30
										,"name_of_work" => 500,"agreement_no" => 30,"name_of_agency" => 60,"head_of_account" => 30,"wb_pms_id" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)){
			// Perform Create

			$query="UPDATE bills SET";
			$query.=" nij_code='{$nij_code}',";
			$query.=" mb_no='{$mb_no}',";
			$query.=" bill_no='{$bill_no}',";
			$query.=" s_no_of_bill='{$s_no_of_bill}',";
			$query.=" date='{$date}',";
			$query.=" ra_fa='{$ra_fa}',";
			$query.=" name_of_work='{$name_of_work}',";
			$query.=" agreement_no='{$agreement_no}',";
			$query.=" name_of_agency='{$name_of_agency}',";
			$query.=" head_of_account='{$head_of_account}',";
			$query.=" wb_pms_id='{$wb_pms_id}'";
			$query.=" WHERE id = {$id} ";
			$query.=" LIMIT 1";
			$result=mysqli_query($connection,$query);

			if($result && mysqli_affected_rows($connection)>=0){
				// Success
				$_SESSION["message"]="Bill Entry Update successful.";
				redirect_to("view_bills.php"); 
			}
			else{
				//Failure
				$_SESSION["message"]="Bill Entry Update failed.";
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
		<a href="view_bills.php">&laquo; Back</a><br />
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<?php 
			$query="SELECT * FROM bills";
			$result=mysqli_query($connection,$query);
			while($row=mysqli_fetch_array($result)){
				if($row["id"]==$_GET["id"]){
					echo "<h1>Bill with NIJ Code: ".htmlentities($row["nij_code"])."	</h1><br /><hr/>";
					break;
				}
			}
		?>
		<form action="edit_bill.php?id=<?php echo urlencode($row["id"]); ?>" method="post">
			<table cellspacing=5>
				<tr>
					<td>NIJ TS Code : </td><td><input type="text" name="nij_code" value="<?php echo htmlentities($row["nij_code"]); ?>"></td>
					<td>M.B. No. : </td><td><input type="text" name="mb_no" value="<?php echo htmlentities($row["mb_no"]); ?>"></td>
				</tr>
				<tr>
					<td>Bill No. : </td><td><input type="text" name="bill_no"value="<?php echo htmlentities($row["bill_no"]); ?>"></td>
					<td>S. No. of Bill : </td><td><input type="text" name="s_no_of_bill" value="<?php echo htmlentities($row["s_no_of_bill"]); ?>"></td>
				</tr>
				<tr>
					<td>Date : </td><td><input type="date" name="date" value="<?php echo htmlentities($row["date"]); ?>"></td>
					<td>RA/FA : </td><td><input type="text" name="ra_fa" value="<?php echo htmlentities($row["ra_fa"]); ?>"></td>
				</tr>
				<tr>
					<td>Name of Work : </td><td><input type="text" name="name_of_work" value="<?php echo htmlentities($row["name_of_work"]); ?>"></td>
					<td>Agreement/SO/WO No. : </td><td><input type="text" name="agreement_no"value="<?php echo htmlentities($row["agreement_no"]); ?>"></td>
				</tr>
				<tr>
					<td>Name of Agency : </td><td><input type="text" name="name_of_agency" value="<?php echo htmlentities($row["name_of_agency"]); ?>"></td>
					<td>Head of Account : </td><td><input type="text" name="head_of_account" value="<?php echo htmlentities($row["head_of_account"]); ?>"></td>
				</tr>
				<tr align=center>
					<td colspan=4>WB PMS ID : <input type="text" name="wb_pms_id" value="<?php echo htmlentities($row["wb_pms_id"]); ?>"></td>
					<td><input type="hidden" name="id" value="<?php echo $id1; ?>"></td>
				</tr>
				<tr align=center>
					<td colspan=4><input type="submit" name="submit" value="Edit" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>