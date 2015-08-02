<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $head_of_account_set=find_all_head_of_accounts(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Admin Menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Head of Accounts</h2>
		<table width="200%">
			<tr>
				<th style="text-align: left; width: 200px;">Name of the Head of Account</th>
				<th colspan="2" style="text-align: center;">Actions</th>
			</tr>
			<tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
			</tr>
			</tr>
			<?php while($head_of_account=mysqli_fetch_assoc($head_of_account_set)){ ?>
			<tr>
				<td><?php echo htmlentities($head_of_account["head_of_account"]); ?></td>
				<td><a href="edit_head_of_account.php?id=<?php echo urlencode($head_of_account["id"]); ?>">Edit</a></td>
				<td><a href="delete_head_of_account.php?id=<?php echo urlencode($head_of_account["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
		<br />
		<a href="new_head_of_account.php">Add new Head of Account</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
