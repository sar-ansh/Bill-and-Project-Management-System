<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php
	if(isset($_POST['gnrt_report'])){
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
		if($sort_mode!="name_of_work" && $sort_mode!="agency" && $sort_mode!="client"&& $sort_mode!="head_of_account"){
			$sort_mode="name_of_work";
		}
		 ?>
		 <div class="container">
		<h1>List of Projects sorted by <?php echo fieldname_as_text($sort_mode); ?></h1><hr/>
		<div id="view_list">
		<?php
			$query="SELECT * FROM projects ORDER BY $sort_mode";
			$result=mysqli_query($connection,$query);
			$count=1;
				echo "<table width=1000 cellpadding=5 style=\"text-align: left;\"";
						echo "<tr>";
							echo "<td>Sl No.</td>";
							echo "<td>Name of Work</td>";
							echo "<td>Agency</td>";
							echo "<td>Client</td>";
							echo "<td>Head of Account</td>";
							echo "<td>Date of Start</td>";
							echo "<td>Date of Completion</td>";
							echo "<td>PE No.</td>";
							echo "<td>NIT No.</td>";
							echo "<td>AA & ES No.</td>";
							echo "<td>NIJ TS Code</td>";
						echo "</tr>";
					while($row=mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td>$count</td>";
							echo "<td>".$row["name_of_work"]."</td>";
							echo "<td>".$row["agency"]."</td>";
							echo "<td>".$row["client"]."</td>";
							echo "<td>".$row["head_of_account"]."</td>";
							echo "<td>".$row["date_of_start"]."</td>";
							echo "<td>".$row["actual_date_of_completion"]."</td>";
							echo "<td>".$row["pe_no"]."</td>";
							echo "<td>".$row["nit_no"]."</td>";
							echo "<td>".$row["aa_es_no"]."</td>";
							echo "<td>".$row["nij_ts_code"]."</td>";
						echo "</tr>";
						$count++;
					}
				echo "</table>";
		?>	
			</div>
			<hr>
			<hr>
			<div style="display:flex; justify-content:space-around;">
				<div id="details" style="width:700px;">
					<h2>Agency-Wise Report: <h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted agency-wise.</h3>
					<h2>Client-Wise Report: </h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted client-wise.</h3>
					<h2>Head-of-Account-Wise Report: </h2>
						<h3 style="margin: 20px;">Allows users to view project reports for all the works undertaken sorted head-of-account-wise.</h3>				</div>
				<div id="sort_type" style="width:400px;">
					<form action="generate_project.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
		<table cellspacing="10" >
			<tr>
				<td>Select an option to generate report :</td>
				<td>Type of work: </td>
			</tr>
			<tr>
				<td>
					&nbsp;&nbsp;&nbsp;<select name="sort_mode">
						<option value="agency">Agency</option>
						<option value="client">Client</option>
						<option value="head_of_account">Head of Account</option>
					</select>
				</td>

				
			</tr>
			<tr>
				<td colspan=2 align=center><input type="submit" name="gnrt_report" value="Generate Report" /></td>
			</tr>
		</table>
	</form>





				</div>
			</div>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>










