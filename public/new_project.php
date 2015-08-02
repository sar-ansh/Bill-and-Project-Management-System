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
			// Perform Create

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
			$agency=mysql_prep($_POST["agency"]);
			$agency_address=mysql_prep($_POST["agency_address"]);
			$client=mysql_prep($_POST["client"]);
			$head_of_account=mysql_prep($_POST["head_of_account"]);
			$tendered_amount=mysql_prep($_POST["tendered_amount"]);
			$no_of_packages=mysql_prep($_POST["no_of_packages"]);
			$wb_pms_id=mysql_prep($_POST["wb_pms_id"]);
			$date_of_start=mysql_prep($_POST["date_of_start"]);
			$stipulated_date_of_completion=mysql_prep($_POST["stipulated_date_of_completion"]);
			$actual_date_of_completion=mysql_prep($_POST["actual_date_of_completion"]);

			$query="INSERT INTO projects (";
			$query.=" efc_scheme_no, requisition_no, agreement_no, subwork_no, vide_letter_no, aa_es_no, aa_es_date, aa_es_amount,
					ts_no, ts_date, ts_amount, ts_authority, pe_no, pe_date, pe_amount_draft, pe_sent_to,
					final_pe_sent_to_client, pe_amount_final, pe_final_date, nit_no, nit_date, nit_amount, nit_time_in_months, nij_ts_code,
					name_of_work, head_of_account, client, wb_pms_id, tendered_amount, no_of_packages, agency, agency_address,
					date_of_start, stipulated_date_of_completion, actual_date_of_completion ";
			$query.=") VALUES (";
			$query.=" '{$efc_scheme_no}','{$requisition_no}','{$agreement_no}','{$subwork_no}','{$vide_letter_no}','{$aa_es_no}','{$aa_es_date}','{$aa_es_amount}'
					,'{$ts_no}','{$ts_date}','{$ts_amount}','{$ts_authority}','{$pe_no}','{$pe_date}','{$pe_amount_draft}','{$pe_sent_to}'
					,'{$final_pe_sent_to_client}','{$pe_amount_final}','{$pe_final_date}','{$nit_no}','{$nit_date}','{$nit_amount}','{$nit_time_in_months}','{$nij_ts_code}'
					,'{$name_of_work}','{$head_of_account}','{$client}','{$wb_pms_id}','{$tendered_amount}','{$no_of_packages}','{$agency}','{$agency_address}'
					,'{$date_of_start}','{$stipulated_date_of_completion}','{$actual_date_of_completion}' ";
			$query.=")";
			$result=mysqli_query($connection,$query);

			if($result){
				// Success
				$_SESSION["message"]="New Project Entry successful.";
				redirect_to("manage_content.php?page=".urlencode($current_page["id"]+1)); 
			}
			else{
				//Failure
				$_SESSION["message"]="New Project Entry failed.";
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
		<a href="manage_content.php">&laquo; Main Menu</a><br />
		<?php echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">	
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<h1><?php echo htmlentities($current_page["menu_name"]); ?></h1><br /><hr/>

		<form action="new_project.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
			<table cellspacing="5">
				<tr>
					<td>EFC Scheme No. : </td><td><input type="text" name="efc_scheme_no" value=""></td>
					<td>PE No. : </td><td><input type="text" name="pe_no" value=""></td>
					<td>Name of Work : </td><td><input type="text" name="name_of_work" value=""></td>
				</tr>
				<tr>
					<td>Requistition No. : </td><td><input type="text" name="requisition_no" value=""></td>
					<td>PE Date : </td><td><input type="date" name="pe_date" value="" style="width: 96.5%; text-align: center;"></td>
					<td>Agency : </td>
					<td>
						<select name="agency" style="width: 96.5%; text-align: center;">
							<?php while($agency=mysqli_fetch_assoc($agency_set)){ ?>
								<option><?php echo htmlentities($agency["name_of_agency"]); ?></option>	
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Agreement No. : </td><td><input type="text" name="agreement_no" value=""></td>
					<td>PE Amount(Draft) : </td><td><input type="text" name="pe_amount_draft" value=""></td>
					<td>Agency Address : </td><td><input type="text" name="agency_address" value=""></td>
				</tr>
				<tr>
					<td>Subwork No. : </td><td><input type="text" name="subwork_no" value=""></td>
					<td>PE Send To : </td><td><input type="text" name="pe_sent_to" value=""></td>
					<td>Client : </td>
					<td>
						<select name="client" style="width: 96.5%; text-align: center;">
							<?php while($client=mysqli_fetch_assoc($client_set)){ ?>
								<option><?php echo htmlentities($client["name_of_client"]); ?></option>	
							<?php } ?>
						</select>
					</td>			
				</tr>
				<tr>
					<td>Vide Letter No. : </td><td><input type="text" name="vide_letter_no" value=""></td>
					<td>Final PE Send to Client : </td><td><input type="text" name="final_pe_sent_to_client" value=""></td>
					<td>Head of Account : </td>
					<td>
						<select name="head_of_account" style="width: 96.5%; text-align: center;">
							<?php while($head_of_account=mysqli_fetch_assoc($head_of_account_set)){ ?>
								<option><?php echo htmlentities($head_of_account["head_of_account"]); ?></option>	
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>AA & ES No. : </td><td><input type="text" name="aa_es_no" value=""></td>
					<td>PE Amount(Final) : </td><td><input type="text" name="pe_amount_final" value=""></td>
					<td>Tendered Amount : </td><td><input type="text" name="tendered_amount" value=""></td>
				</tr>
				<tr>
					<td>AA & ES Date : </td><td><input type="date" name="aa_es_date" value="" style="width: 96.5%; text-align: center;"></td>
					<td>PE Final Date : </td><td><input type="date" name="pe_final_date" value="" style="width: 96.5%; text-align: center;"></td>
					<td>Number of Packages : </td><td><input type="text" name="no_of_packages" value=""></td>
				<tr>
					<td>AA & ES Amount : </td><td><input type="text" name="aa_es_amount" value=""></td>
					<td>NIT No. : </td><td><input type="text" name="nit_no" value=""></td>
					<td>WB PMS ID : </td><td><input type="text" name="wb_pms_id" value=""></td>
				</tr>
				<tr>
					<td>T/S No. : </td><td><input type="text" name="ts_no" value=""></td>
					<td>NIT Date : </td><td><input type="date" name="nit_date" value="" style="width: 96.5%; text-align: center;"></td>
					<td>Date of Start : </td><td><input type="date" name="date_of_start" value="" style="width: 96.5%; text-align: center;"></td>
				</tr>
				<tr>
					<td>T/S Date : </td><td><input type="date" name="ts_date" value="" style="width: 96.5%; text-align: center;"></td>
					<td>NIT Amount : </td><td><input type="text" name="nit_amount" value=""></td>
					<td>Stipulated Date of Completion : </td><td><input type="date" name="stipulated_date_of_completion" value="" style="width: 96.5%; text-align: center;"></td>
				</tr>
				<tr>
					<td>T/S Amount : </td><td><input type="text" name="ts_amount" value=""></td>
					<td>NIT Time in Months : </td><td><input type="text" name="nit_time_in_months" value=""></td>
					<td>Actual Date of Completion : </td><td><input type="date" name="actual_date_of_completion" value="" style="width: 96.5%; text-align: center;"></td>
				</tr>
				<tr>
					<td>T/S Authority : </td><td><input type="text" name="ts_authority" value=""></td>
					<td>NIJ TS Code : </td><td><input type="text" name="nij_ts_code" value=""></td>
					<td>Submit : </td><td><input type="submit" name="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>