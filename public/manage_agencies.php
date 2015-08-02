<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $agency_set=find_all_agencies(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Admin Menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Agencies</h2>
		<table width="200%">
			<tr>
				<th style="text-align: left; width: 200px;">Name of Agency</th>
				<th colspan="2" style="text-align: center;">Actions</th>
			</tr>
			<tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
			</tr>
			</tr>
			<?php while($agency=mysqli_fetch_assoc($agency_set)){ ?>
			<tr>
				<td><?php echo htmlentities($agency["name_of_agency"]); ?></td>
				<td><a href="edit_agency.php?id=<?php echo urlencode($agency["id"]); ?>">Edit</a></td>
				<td><a href="delete_agency.php?id=<?php echo urlencode($agency["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
		<br />
		<a href="new_agency.php">Add new agency</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
