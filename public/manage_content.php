<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $admin_set=find_all_admins(); ?>

<?php $message_set=find_all_messages(); ?>

<?php include("../includes/layouts/header.php"); ?>

 <?php find_selected_page(); ?> 

<div id="main">
	<div id="navigation">
		<br />
		<a href="logout.php">&laquo; Logout</a><br>

		<?php 
			while($admin=mysqli_fetch_assoc($admin_set)){
				if($admin["username"]==$_SESSION["username"]){
					echo "<a href=\"admin.php\">&laquo; Admin Menu</a><br />";
				}
			}
		?>

		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">
		<?php echo message(); ?>

		<?php if($current_subject){ ?>
				<h1><?php echo htmlentities($current_subject["menu_name"]); ?></h1><br /><hr/>
				<?php 
						if($current_subject["menu_name"]=="Project Section"){
							include("project_section.php");
						}
						else if($current_subject["menu_name"]=="Bill Section"){
							include("bill_section.php");
						}
					?>

		<?php } else if($current_page){ ?>
					<h1><?php echo htmlentities($current_page["menu_name"]); ?></h1><br /><hr/>
					<?php 
						if($current_page["menu_name"]=="New Project Entry"){
							redirect_to("new_project.php?page=".urlencode($current_page["id"]));
						}
						else if($current_page["menu_name"]=="View Previous Projects"){
							include("view_projects.php");
						}
						else if($current_page["menu_name"]=="Generate Project Report"){
							redirect_to("generate_project.php?page=".urlencode($current_page["id"]));	
						}
						else if($current_page["menu_name"]=="New Bill Entry"){
							redirect_to("new_bill.php?page=".urlencode($current_page["id"]));
						}
						else if($current_page["menu_name"]=="View Previous Bills"){
							redirect_to("view_bills.php?page=".urlencode($current_page["id"]));
						}
						else{
							redirect_to("generate_bill_report.php?page=".urlencode($current_page["id"]));
						}
					?>

		<?php } else{ ?>
			<p style="font-size: 20px;">Welcome <?php echo htmlentities($_SESSION["username"]); ?>. Please select an option from navigation menu to proceed.</p><br />
		<?php } ?>
				<?php 
					if(!(($current_subject["id"]!=0) || ($current_page["id"]!=0))){
						echo "<h2>News-Feed: </h2>";
						echo "<div class=\"container\">";
						echo "<div class=\"view_content\" style=\"overflow-y: auto; height: 200px\">";
						$count=1;
						while($message=mysqli_fetch_assoc($message_set)){
							echo $count; 
							$count++;
							echo ". ";
							echo $message["content"];
							echo "<hr>";
						}
						echo "</div>";					}
					else{
						
					}
				?>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



	
