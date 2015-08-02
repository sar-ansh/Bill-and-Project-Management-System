<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?> 

<div id="main">
	<div id="navigation">
		<br />
		<a href="logout.php">&laquo; Logout</a><br>
		<a href="manage_content.php?page=2">&laquo; Back</a><br />
		<a href="manage_content.php.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<h1>Notice Inviting Tender</h1><div style="margin-top: 0.5em; border-top: 1px #000000;"><hr/>
		<div>
			<?php
				$dir="files/nit/";
				$dh=opendir($dir);
				while(false!==($filename=readdir($dh))){
					$files[]=$filename;
				}
				$count=0;
				foreach ($files as $value) {
					$count++;
				}
				sort($files);
			?>
			<div id="view_files">
				<table cellpadding="10" cellspacing="10">
					<?php for($i=2;$i<$count;$i++){ ?>
					<tr>
						<td><?php echo $files[$i]; ?></td>
						<td><a href="excel_reader/example2.php?id=<?php echo $i; ?>&path=<?php echo urlencode("nit"); ?>">View</a><a href="download.php?filename=<?php echo $files[$i]; ?>&path=<?php echo urlencode("nit"); ?>" >Download</a></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>