<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $user_set=find_all_users(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Admin Menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Users</h2>
			<table width="200%">
				<tr>
					<th style="text-align: left; width: 200px;">Username</th>
					<th colspan="2" style="text-align: center;">Actions</th>
				</tr>
				<tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
				</tr>
				</tr>
				<?php while($user=mysqli_fetch_assoc($user_set)){ ?>
				<tr>
					<td><?php echo htmlentities($user["username"]); ?></td>
					<td><a href="edit_user.php?id=<?php echo urlencode($user["id"]); ?>">Edit</a></td>
					<td><a href="delete_user.php?id=<?php echo urlencode($user["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
				</tr>
				<?php } ?>
			</table>
		<br />
		<a href="new_user.php">Add new user</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
