<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

<?php include("../includes/layouts/header.php"); ?>

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
		<h1>List of Projects</h1><hr/>
		<div class="container">
		<div id="view_project_list">
			<?php
				$query="SELECT * FROM projects ORDER BY name_of_work";
				$result=mysqli_query($connection,$query);
				$count=1;
				echo "<table width=1000 cellpadding=5 style=\"text-align: left;\">";
						echo "<tr>";
							echo "<td>Sl No.</td>";
							echo "<td>Name of Work</td>";
							echo "<td>Agency</td>";
							echo "<td>Client</td>";
							echo "<td>Head of Account</td>";
							echo "<td>Date of Start</td>";
							echo "<td>Date of Completion</td>";
							echo "<td>NIT No.</td>";
							echo "<td>NIJ TS Code</td>";
							echo "<td align=\"center\">Action</td>";
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
							echo "<td>".$row["nit_no"]."</td>";
							echo "<td>".$row["nij_ts_code"]."</td>";
							echo "<td><a href=\"edit_project.php?id=".$row["id"]."\">Edit</a><a href=\"upload_file.php?id=".$row["id"]."\">Upload File</a></td>";
						echo "</tr>";
						$count++;
					}
				echo "</table>";
			?>	
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
