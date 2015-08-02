<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?> 

<?php $agency_set=find_all_agencies(); ?>

<?php $head_of_account_set=find_all_head_of_accounts(); ?>

<?php $client_set=find_all_clients(); ?>

<?php
	if(isset($_POST['submit'])){
		// Process the form
		$id=$_GET["id"];
		$efc_scheme_no=mysql_prep($_POST["efc_scheme_no"]);
		$requisition_no=mysql_prep($_POST["requisition_no"]);
		$agreement_no=mysql_prep($_POST["agreement_no"]);
		$subwork_no=mysql_prep($_POST["subwork_no"]);
		$vide_letter_no=mysql_prep($_POST["vide_letter_no"]);
		$aa_es_no=mysql_prep($_POST["aa_es_no"]);
		$aa_es_date=mysql_prep($_POST["aa_es_date"]);
		$aa_es_amount=mysql_prep($_POST["aa_es_amount"]);
		$ts_no=mysql_prep($_POST["ts_no"]);
		$ts_date=mysql_prep($_POST["ts_date"]);
		$ts_amount=mysql_prep($_POST["ts_amount"]);
		$ts_authority=mysql_prep($_POST["ts_authority"]);
		$pe_no=mysql_prep($_POST["pe_no"]);
		$pe_date=mysql_prep($_POST["pe_date"]);
		$pe_amount_draft=mysql_prep($_POST["pe_amount_draft"]);
		$pe_sent_to=mysql_prep($_POST["pe_sent_to"]);
		$final_pe_sent_to_client=mysql_prep($_POST["final_pe_sent_to_client"]);
		$pe_amount_final=mysql_prep($_POST["pe_amount_final"]);
		$pe_final_date=mysql_prep($_POST["pe_final_date"]);
		$nit_no=mysql_prep($_POST["nit_no"]);
		$nit_date=mysql_prep($_POST["nit_date"]);
		$nit_amount=mysql_prep($_POST["nit_amount"]);
		$nit_time_in_months=mysql_prep($_POST["nit_time_in_months"]);
		$nij_ts_code=mysql_prep($_POST["nij_ts_code"]);
		$name_of_work=mysql_prep($_POST["name_of_work"]);
		$head_of_account=mysql_prep($_POST["head_of_account"]);
		$client=mysql_prep($_POST["client"]);
		$wb_pms_id=mysql_prep($_POST["wb_pms_id"]);
		$tendered_amount=mysql_prep($_POST["tendered_amount"]);
		$no_of_packages=mysql_prep($_POST["no_of_packages"]);
		$agency=mysql_prep($_POST["agency"]);
		$agency_address=mysql_prep($_POST["agency_address"]);
		$date_of_start=mysql_prep($_POST["date_of_start"]);
		$stipulated_date_of_completion=mysql_prep($_POST["stipulated_date_of_completion"]);
		$actual_date_of_completion=mysql_prep($_POST["actual_date_of_completion"]);


		// Validations
		$required_fields=array("nij_ts_code","name_of_work","agency","agency_address","head_of_account","client");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("efc_scheme_no" => 60,"requisition_no" => 60,"agreement_no" => 60,"subwork_no" => 60,"vide_letter_no" => 60,
									"aa_es_no" => 60,"aa_es_date" => 60,"aa_es_amount" => 60,"ts_no" => 60,"ts_date" => 60,
									"ts_amount" => 60,"ts_authority" => 60,"pe_no" => 60,"pe_date" => 60,"pe_amount_draft" => 60,
									"pe_sent_to" => 60,"final_pe_sent_to_client" => 60,"pe_amount_final" => 60,"pe_final_date" => 60,"nit_no" => 60,
									"nit_date" => 60,"nit_amount" => 60,"nit_time_in_months" => 60,"nij_ts_code" => 60,"name_of_work" => 500,
									"agency" => 60,"agency_address" => 60,"client" => 60,"head_of_account" => 60,"tendered_amount" => 60,"no_of_packages" => 60,
									"wb_pms_id" => 60,"date_of_start" => 60,"stipulated_date_of_completion" => 60,"actual_date_of_completion" => 60);
		validate_max_lengths($fields_with_max_lengths);


		if(empty($errors)){
			// Perform Update

			$query="UPDATE projects SET ";
			$query.=" efc_scheme_no='{$efc_scheme_no}',";
			$query.=" requisition_no='{$requisition_no}',";
			$query.=" agreement_no='{$agreement_no}',";
			$query.=" subwork_no='{$subwork_no}',";
			$query.=" vide_letter_no='{$vide_letter_no}',";
			$query.=" aa_es_no='{$aa_es_no}',";
			$query.=" aa_es_date='{$aa_es_date}',";
			$query.=" aa_es_amount='{$aa_es_amount}',";
			$query.=" ts_no='{$ts_no}',";
			$query.=" ts_date='{$ts_date}',";
			$query.=" ts_amount='{$ts_amount}',";
			$query.=" ts_authority='{$ts_authority}',";
			$query.=" pe_no='{$pe_no}',";
			$query.=" pe_date='{$pe_date}',";
			$query.=" pe_amount_draft='{$pe_amount_draft}',";
			$query.=" pe_sent_to='{$pe_sent_to}',";
			$query.=" final_pe_sent_to_client='{$final_pe_sent_to_client}',";
			$query.=" pe_amount_final='{$pe_amount_final}',";
			$query.=" pe_final_date='{$pe_final_date}',";
			$query.=" nit_no='{$nit_no}',";
			$query.=" nit_date='{$nit_date}',";
			$query.=" nit_amount='{$nit_amount}',";
			$query.=" nit_time_in_months='{$nit_time_in_months}',";
			$query.=" nij_ts_code='{$nij_ts_code}',";
			$query.=" name_of_work='{$name_of_work}',";
			$query.=" head_of_account='{$head_of_account}',";
			$query.=" client='{$client}',";
			$query.=" wb_pms_id='{$wb_pms_id}',";
			$query.=" tendered_amount='{$tendered_amount}',";
			$query.=" no_of_packages='{$no_of_packages}',";
			$query.=" agency='{$agency}',";
			$query.=" agency_address='{$agency_address}',";
			$query.=" date_of_start='{$date_of_start}',";
			$query.=" stipulated_date_of_completion='{$stipulated_date_of_completion}',";
			$query.=" actual_date_of_completion='{$actual_date_of_completion}'";
			$query.=" WHERE id = {$id} ";
			$query.=" LIMIT 1";
			$result=mysqli_query($connection,$query);

			if($result && mysqli_affected_rows($connection)>=0){
				// Success
				$_SESSION["message"]="Project Entry Update successful.";
				redirect_to("projects_list.php"); 
			}
			else{
				//Failure
				$_SESSION["message"]="Project Entry Update failed.";
				redirect_to("projects_list.php");
			}
		}
	}
	else{
		// 	This is probably a GET request 
	}
?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="logout.php">&laquo; Logout</a><br>
		<a href="projects_list.php">&laquo; Back</a><br />
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<?php 
			$query="SELECT * FROM projects";
			$result=mysqli_query($connection,$query);
			while($row=mysqli_fetch_array($result)){
				if($row["id"]==$_GET["id"]){
					echo "<h1>Edit Project: </h1><hr/>";
					break;
				}
			}
		?>
		<form action="edit_project.php?id=<?php echo urlencode($row["id"]); ?>" method="post">
			<table cellspacing="5">
				<tr>
					<td>EFC Scheme No. : </td><td><input type="text" name="efc_scheme_no" value="<?php echo htmlentities($row["efc_scheme_no"]); ?>"></td>
					<td>PE No. : </td><td><input type="text" name="pe_no" value="<?php echo htmlentities($row["pe_no"]); ?>"></td>
					<td>Name of Work : </td><td><input type="text" name="name_of_work" value="<?php echo htmlentities($row["name_of_work"]); ?>"></td>
				</tr>
				<tr>
					<td>Requistition No. : </td><td><input type="text" name="requisition_no" value="<?php echo htmlentities($row["requisition_no"]); ?>"></td>
					<td>PE Date : </td><td><input type="date" name="pe_date" value="<?php echo htmlentities($row["pe_date"]); ?>"></td>
					<td>Agency : </td>
					<td>
						<select name="agency">
							<?php while($agency=mysqli_fetch_assoc($agency_set)){ ?>
								<option selected><?php echo htmlentities($agency["name_of_agency"]); ?></option>	
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Agreement No. : </td><td><input type="text" name="agreement_no" value="<?php echo htmlentities($row["agreement_no"]); ?>"></td>
					<td>PE Amount(Draft) : </td><td><input type="text" name="pe_amount_draft" value="<?php echo htmlentities($row["pe_amount_draft"]); ?>"></td>
					<td>Agency Address : </td><td><input type="text" name="agency_address" value="<?php echo htmlentities($row["agency_address"]); ?>"></td>
				</tr>
				<tr>
					<td>Subwork No. : </td><td><input type="text" name="subwork_no" value="<?php echo htmlentities($row["subwork_no"]); ?>"></td>
					<td>PE Send To : </td><td><input type="text" name="pe_sent_to" value="<?php echo htmlentities($row["pe_sent_to"]); ?>"></td>
					<td>Client : </td>
					<td>
						<select name="client" >
							<?php while($client=mysqli_fetch_assoc($client_set)){ ?>
								<option><?php echo htmlentities($client["name_of_client"]); ?></option>	
							<?php } ?>
						</select>
					</td>	
				</tr>
				<tr>
					<td>Vide Letter No. : </td><td><input type="text" name="vide_letter_no" value="<?php echo htmlentities($row["vide_letter_no"]); ?>"></td>
					<td>Final PE Send to Client : </td><td><input type="text" name="final_pe_sent_to_client" value="<?php echo htmlentities($row["final_pe_sent_to_client"]); ?>"></td>
					<td>Head of Account : </td>
					<td>
						<select name="head_of_account">>
							<?php while($head_of_account=mysqli_fetch_assoc($head_of_account_set)){ ?>
								<option><?php echo htmlentities($head_of_account["head_of_account"]); ?></option>	
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>AA & ES No. : </td><td><input type="text" name="aa_es_no" value="<?php echo htmlentities($row["aa_es_no"]); ?>"></td>
					<td>PE Amount(Final) : </td><td><input type="text" name="pe_amount_final" value="<?php echo htmlentities($row["pe_amount_final"]); ?>"></td>
					<td>Tendered Amount : </td><td><input type="text" name="tendered_amount" value="<?php echo htmlentities($row["tendered_amount"]); ?>"></td>
				</tr>
				<tr>
					<td>AA & ES Date : </td><td><input type="date" name="aa_es_date" value="<?php echo htmlentities($row["aa_es_date"]); ?>"></td>
					<td>PE Final Date : </td><td><input type="date" name="pe_final_date" value="<?php echo htmlentities($row["pe_final_date"]); ?>"></td>
					<td>Number of Packages : </td><td><input type="text" name="no_of_packages" value="<?php echo htmlentities($row["no_of_packages"]); ?>"></td>
				<tr>
					<td>AA & ES Amount : </td><td><input type="text" name="aa_es_amount" value="<?php echo htmlentities($row["aa_es_amount"]); ?>"></td>
					<td>NIT No. : </td><td><input type="text" name="nit_no" value="<?php echo htmlentities($row["nit_no"]); ?>"></td>
					<td>WB PMS ID : </td><td><input type="text" name="wb_pms_id" value="<?php echo htmlentities($row["wb_pms_id"]); ?>"></td>	
				</tr>
				<tr>
					<td>T/S No. : </td><td><input type="text" name="ts_no" value="<?php echo htmlentities($row["ts_no"]); ?>"></td>
					<td>NIT Date : </td><td><input type="date" name="nit_date" value="<?php echo htmlentities($row["nit_date"]); ?>"></td>
					<td>Date of Start : </td><td><input type="date" name="date_of_start" value="<?php echo htmlentities($row["date_of_start"]); ?>"></td>
				</tr>
				<tr>
					<td>T/S Date : </td><td><input type="date" name="ts_date" value="<?php echo htmlentities($row["ts_date"]); ?>"></td>
					<td>NIT Amount : </td><td><input type="text" name="nit_amount" value="<?php echo htmlentities($row["nit_amount"]); ?>"></td>
					<td>Stipulated Date of Completion : </td><td><input type="date" name="stipulated_date_of_completion" value="<?php echo htmlentities($row["stipulated_date_of_completion"]); ?>"></td>
				</tr>
				<tr>
					<td>T/S Amount : </td><td><input type="text" name="ts_amount" value="<?php echo htmlentities($row["ts_amount"]); ?>"></td>
					<td>NIT Time in Months : </td><td><input type="text" name="nit_time_in_months" value="<?php echo htmlentities($row["nit_time_in_months"]); ?>"></td>
					<td>Actual Date of Completion : </td><td><input type="date" name="actual_date_of_completion" value="<?php echo htmlentities($row["actual_date_of_completion"]); ?>"></td>
				</tr>
				<tr>
					<td>T/S Authority : </td><td><input type="text" name="ts_authority" value="<?php echo htmlentities($row["ts_authority"]); ?>"></td>
					<td>NIJ TS Code : </td><td><input type="text" name="nij_ts_code" value="<?php echo htmlentities($row["nij_ts_code"]); ?>"></td>
					<td>Edit: </td><td><input type="submit" name="submit" value="Edit" /></td>
				</tr>
			</table>
		</form>
		</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
