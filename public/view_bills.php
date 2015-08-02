<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
	if(isset($_POST['view_bills_submit'])){
		// Process the form
		$sort_mode=mysql_prep($_POST["sort_mode"]);
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
		<?php 
		echo message();
		if($sort_mode!="name_of_work" && $sort_mode!="name_of_agency" && $sort_mode!="head_of_account"){
			$sort_mode="name_of_work";
		}
		 ?>
		 <div class="container">
		<h1>List of Bills sorted by <?php echo fieldname_as_text($sort_mode); ?></h1><hr/>
			<div id="view_bill_list">
				<?php

					$query="SELECT * FROM bills ORDER BY $sort_mode";
					$result=mysqli_query($connection,$query);
					$count=1;
					echo "<table width=1100 style=\"text-align: left;\">";
							echo "<tr>";
								echo "<td>Sl No.</td>";
								echo "<td>Name of Work</td>";
								echo "<td>NIJ TS Code</td>";
								echo "<td>Bill No.</td>";
								echo "<td>Sl No. of Bill</td>";
								echo "<td>Date</td>";
								echo "<td>Name of Agency</td>";
								echo "<td>Head of Account</td>";
								echo "<td align=\"center\">Action</td>";
							echo "</tr>";
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td>$count</td>";
								echo "<td>".$row["name_of_work"]."</td>";
								echo "<td>".$row["nij_code"]."</td>";
								echo "<td>".$row["bill_no"]."</td>";
								echo "<td>".$row["s_no_of_bill"]."</td>";
								echo "<td>".$row["date"]."</td>";
								echo "<td>".$row["name_of_agency"]."</td>";
								echo "<td>".$row["head_of_account"]."</td>";
								echo "<td><a href=\"edit_bill.php?id=".$row["id"]."\">Edit</a><a href=\"upload_bill.php?id=".$row["id"]."\">Upload Bill</a></td>";
							echo "</tr>";
							$count++;
						}
					echo "</table>";
				?>
			</div>
			<hr>
			<hr>
			<div style="display:flex; justify-content:space-around;">
				<div id="details">
					<h2>Agency-Wise Report: <h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted agency-wise.</h3>
					<h2>Client-Wise Report: </h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted client-wise.</h3>
					<h2>Head-of-Account-Wise Report: </h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted head-of-account-wise.</h3>
				</div>
				<div id="sort_type">
					<form action="view_bills.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
						<table cellspacing="10" >
							<tr>
								<td style="font-size:15px;">Select an option to generate report :</td>
							</tr>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;<select name="sort_mode">
										<option value="name_of_agency">Agency</option>
										<option value="head_of_account">Head of Account</option>
									</select>
								</td>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;<input type="submit" name="view_bills_submit" value="Sort Bills" /></td>
							</tr>
						</table>
					</form>
					<a style="margin: 5px;" href="view_download_bills.php">View/Download Bills</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
