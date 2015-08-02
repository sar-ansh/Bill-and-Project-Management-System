<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<h2>Admin Menu</h2>
		<h3>Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.</h3>
		<?php echo message(); ?>
		<ul>
			<li><a href="manage_content.php">Manage Website Content</a></li><br>
			<li><a href="manage_admins.php">Manage Admins</a></li><br>
			<li><a href="manage_users.php">Manage Users</a></li><br>
			<li><a href="manage_agencies.php">Manage Agencies</a></li><br>
			<li><a href="manage_clients.php">Manage Clients</a></li><br>
			<li><a href="manage_head_of_accounts.php">Manage Head-of-Accounts</a></li><br>
			<li><a href="manage_messages.php">Manage News-Feed</a></li><br>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>