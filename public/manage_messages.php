<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $message_set=find_all_messages(); ?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Admin Menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage News-Feed</h2>
		<div class="container">
			<div id="news_feed">
				<table width="100%">
					<tr>
						<th style="text-align: left; width: 200px;">Previous Messages</th>
						<th colspan="2" style="text-align: center;">Actions</th>
					</tr>
					<tr>
					<td>&nbsp;</td>	
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<?php 
					$count=1;
					while($message=mysqli_fetch_assoc($message_set)){ ?>
					<tr>
						<td><div id="news"><?php echo $count.". ".$message["content"]; $count++; ?></div><br></td>
						<td><a style="width: 200px;" href="edit_message.php?id=<?php echo urlencode($message["id"]); ?>">Edit</a></td>
						<td><a style="width: 200px;" href="delete_message.php?id=<?php echo urlencode($message["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		<br />
		<a href="new_message.php">Add new message.</a>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
