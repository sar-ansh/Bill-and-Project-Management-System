<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $client_set=find_all_clients(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Admin Menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Clients</h2>
		<table width="200%">
			<tr>
				<th style="text-align: left; width: 200px;">Name of Client</th>
				<th colspan="2" style="text-align: center;">Actions</th>
			</tr>
			<tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
			</tr>
			</tr>
			<?php while($client=mysqli_fetch_assoc($client_set)){ ?>
			<tr>
				<td><?php echo htmlentities($client["name_of_client"]); ?></td>
				<td><a href="edit_client.php?id=<?php echo urlencode($client["id"]); ?>">Edit</a></td>
				<td><a href="delete_client.php?id=<?php echo urlencode($client["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
		<br />
		<a href="new_client.php">Add new client</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
