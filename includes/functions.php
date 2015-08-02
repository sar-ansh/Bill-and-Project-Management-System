<?php

	function redirect_to($new_location){
		header("Location: ".$new_location);
		exit;
	}
	
	function mysql_prep($string){
		global $connection;

		$escaped_string=mysqli_real_escape_string($connection,$string);
		return $escaped_string;
	}

	function confirm_query($result_set){
		if(!$result_set){
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()){
		$output="";
		if(!empty($errors)){
			$output.="<div class=\"error\">";
			$output.="Please fix the following errors:";
			$output.="<ul>";
			foreach($errors as $key => $error){
				$output.="<li>";
				$output.=htmlentities($error);
				$output.="</li>";
			}
			$output.="</ul>";
			$output.="</div>";
		}
		return $output;
	}

	function find_all_admins(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM admins ";
		$query.="ORDER BY username ASC";
		$admin_set=mysqli_query($connection,$query);
		confirm_query($admin_set);
		return $admin_set;
	}

	function find_admin_by_id($admin_id){
		global $connection;

		$safe_admin_id=mysqli_real_escape_string($connection,$admin_id);

		$query="SELECT * ";
		$query.="FROM admins ";
		$query.="WHERE id={$safe_admin_id} ";
		$query.="LIMIT 1";
		$admin_set=mysqli_query($connection,$query);
		confirm_query($admin_set);
		if ($admin=mysqli_fetch_assoc($admin_set)){
			return $admin;
		}
		else{
			return null;
		}
	}

	function find_all_users(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM users ";
		$query.="ORDER BY username ASC";
		$user_set=mysqli_query($connection,$query);
		confirm_query($user_set);
		return $user_set;
	}

	function find_user_by_id($user_id){
		global $connection;

		$safe_user_id=mysqli_real_escape_string($connection,$user_id);

		$query="SELECT * ";
		$query.="FROM users ";
		$query.="WHERE id={$safe_user_id} ";
		$query.="LIMIT 1";
		$user_set=mysqli_query($connection,$query);
		confirm_query($user_set);
		if ($user=mysqli_fetch_assoc($user_set)){
			return $user;
		}
		else{
			return null;
		}
	}

	function find_all_agencies(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM agencies ";
		$query.="ORDER BY name_of_agency ASC";
		$agency_set=mysqli_query($connection,$query);
		confirm_query($agency_set);
		return $agency_set;
	}

	function find_agency_by_id($agency_id){
		global $connection;

		$safe_agency_id=mysqli_real_escape_string($connection,$agency_id);

		$query="SELECT * ";
		$query.="FROM agencies ";
		$query.="WHERE id={$safe_agency_id} ";
		$query.="LIMIT 1";
		$agency_set=mysqli_query($connection,$query);
		confirm_query($agency_set);
		if ($agency=mysqli_fetch_assoc($agency_set)){
			return $agency;
		}
		else{
			return null;
		}
	}

	function find_all_clients(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM clients ";
		$query.="ORDER BY name_of_client ASC";
		$client_set=mysqli_query($connection,$query);
		confirm_query($client_set);
		return $client_set;
	}

	function find_client_by_id($client_id){
		global $connection;

		$safe_client_id=mysqli_real_escape_string($connection,$client_id);

		$query="SELECT * ";
		$query.="FROM clients ";
		$query.="WHERE id={$safe_client_id} ";
		$query.="LIMIT 1";
		$client_set=mysqli_query($connection,$query);
		confirm_query($client_set);
		if ($client=mysqli_fetch_assoc($client_set)){
			return $client;
		}
		else{
			return null;
		}
	}

	function find_all_head_of_accounts(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM head_of_accounts ";
		$query.="ORDER BY head_of_account ASC";
		$head_of_account_set=mysqli_query($connection,$query);
		confirm_query($head_of_account_set);
		return $head_of_account_set;
	}

	function find_head_of_account_by_id($head_of_account_id){
		global $connection;

		$safe_head_of_account_id=mysqli_real_escape_string($connection,$head_of_account_id);

		$query="SELECT * ";
		$query.="FROM head_of_accounts ";
		$query.="WHERE id={$safe_head_of_account_id} ";
		$query.="LIMIT 1";
		$head_of_account_set=mysqli_query($connection,$query);
		confirm_query($head_of_account_set);
		if ($head_of_account=mysqli_fetch_assoc($head_of_account_set)){
			return $head_of_account;
		}
		else{
			return null;
		}
	}
	
		function find_all_projects(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM projects ";
		$query.="ORDER BY name_of_work ASC";
		$project_set=mysqli_query($connection,$query);
		confirm_query($project_set);
		return $project_set;
	}

	function find_project_by_id($project_id){
		global $connection;

		$safe_project_id=mysqli_real_escape_string($connection,$project_id);

		$query="SELECT * ";
		$query.="FROM projects ";
		$query.="WHERE id={$safe_project_id} ";
		$query.="LIMIT 1";
		$project_set=mysqli_query($connection,$query);
		confirm_query($project_set);
		if ($project=mysqli_fetch_assoc($project_set)){
			return $project;
		}
		else{
			return null;
		}
	}

	function find_all_bills(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM bills ";
		$query.="ORDER BY id ASC";
		$bill_set=mysqli_query($connection,$query);
		confirm_query($bill_set);
		return $bill_set;
	}

	function find_bill_by_id($bill_id){
		global $connection;

		$safe_bill_id=mysqli_real_escape_string($connection,$bill_id);

		$query="SELECT * ";
		$query.="FROM bills ";
		$query.="WHERE id={$safe_bill_id} ";
		$query.="LIMIT 1";
		$bill_set=mysqli_query($connection,$query);
		confirm_query($bill_set);
		if ($bill=mysqli_fetch_assoc($bill_set)){
			return $bill;
		}
		else{
			return null;
		}
	}

	function find_all_messages(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM news_feed ";
		$query.="ORDER BY id ASC";
		$message_set=mysqli_query($connection,$query);
		confirm_query($message_set);
		return $message_set;
	}

	function find_message_by_id($message_id){
		global $connection;

		$safe_message_id=mysqli_real_escape_string($connection,$message_id);

		$query="SELECT * ";
		$query.="FROM news_feed ";
		$query.="WHERE id={$safe_message_id} ";
		$query.="LIMIT 1";
		$message_set=mysqli_query($connection,$query);
		confirm_query($message_set);
		if ($message=mysqli_fetch_assoc($message_set)){
			return $message;
		}
		else{
			return null;
		}
	}

	function find_all_subjects(){
		global $connection;

		$query="SELECT * ";
		$query.="FROM subjects ";
		$query.="ORDER BY position ASC";
		$subject_set=mysqli_query($connection,$query);
		confirm_query($subject_set);
		return $subject_set;
	}

	function find_pages_for_subject($subject_id){
		global $connection;

		$safe_subject_id=mysqli_real_escape_string($connection,$subject_id);

		$query="SELECT * ";
		$query.="FROM pages ";
		$query.="WHERE subject_id={$safe_subject_id} ";
		$query.="ORDER BY position ASC";
		$page_set=mysqli_query($connection,$query);
		confirm_query($page_set);
		return $page_set;
	}

	function find_subject_by_id($subject_id){
		global $connection;

		$safe_subject_id=mysqli_real_escape_string($connection,$subject_id);

		$query="SELECT * ";
		$query.="FROM subjects ";
		$query.="WHERE id={$safe_subject_id} ";
		$query.="LIMIT 1";
		$subject_set=mysqli_query($connection,$query);
		confirm_query($subject_set);
		if ($subject=mysqli_fetch_assoc($subject_set)){
			return $subject;
		}
		else{
			return null;
		}
	}

	function find_page_by_id($page_id){
		global $connection;

		$safe_page_id=mysqli_real_escape_string($connection,$page_id);

		$query="SELECT * ";
		$query.="FROM pages ";
		$query.="WHERE id={$safe_page_id} ";
		$query.="LIMIT 1";
		$page_set=mysqli_query($connection,$query);
		confirm_query($page_set);
		if ($page=mysqli_fetch_assoc($page_set)){
			return $page;
		}
		else{
			return null;
		}
	}

	function find_default_page_for_subject($subject_id){
		$page_set=find_pages_for_subject($subject_id);
		if ($first_page=mysqli_fetch_assoc($page_set)){
			return $first_page;
		}
		else{
			return null;
		}
	}

	function find_selected_page(){
		global $current_subject;
		global $current_page;
		
		if(isset($_GET["subject"])){
			$current_subject=find_subject_by_id($_GET["subject"]);
			if($current_subject){
				$current_page=find_default_page_for_subject($current_subject["id"]);
			}
			else{
				$current_page=null;	
			}
		}
		else if (isset($_GET["page"])){
			$current_subject=null;
			$current_page=find_page_by_id($_GET["page"]);
		}
		else{
			$current_subject=null;
			$current_page=null;
		}
	}

	function navigation($subject_array,$page_array){
		$output="<hr>";
		$output.="<ul class=\"subjects\">";
		$subject_set=find_all_subjects();
		while($subject=mysqli_fetch_assoc($subject_set)){
			$output.="<li";
			if($subject_array && $subject["id"]==$subject_array["id"]){
		  		$output.=" class=\"selected\"";
  			}	
			$output.=">"; 
			$output.="<a href=\"manage_content.php?subject=";
			$output.=urlencode($subject["id"]);
			$output.="\">";
			$output.= htmlentities($subject["menu_name"]);
			$output.="</a>";
			
			if($subject_array["id"]==$subject["id"] || $page_array["subject_id"]==$subject["id"]){
				$page_set=find_pages_for_subject($subject["id"]);
				$output.="<ul class=\"pages\">";
				while($page=mysqli_fetch_assoc($page_set)){
					$output.="<li";
					if($page_array && $page["id"]==$page_array["id"]){
		  				$output.= " class=\"selected\"";
					}
					$output.= ">"; 
					$output.="<a href=\"manage_content.php?page=";
					$output.=urlencode($page["id"]); 
					$output.="\">";
					$output.= htmlentities($page["menu_name"]);
					$output.="</a></li>";
				}
				$output.="</ul>";
				mysqli_free_result($page_set);	
			}
			$output.="</li>";
		}
		mysqli_free_result($subject_set);
		$output.="</ul>";
		return $output;
	}

	function password_encrypt($password){
		$hash_format="$2y$10$";			//Tells PHP to use Blowfish with a "cost" of 10
		$salt_length=22; 				//Blowfish salts should be 22-characters or more
		$salt=generate_salt($salt_length);
		$format_and_salt=$hash_format.$salt;
		$hash=crypt($password,$format_and_salt);
		return $hash;
	}

	function generate_salt($length){
		// MD5 returns 32 characters
		$unique_random_string=md5(uniqid(mt_rand(),true));

		//Valid characters for a salt are [a-z A-Z 0-9 . /]
		$base64_string=base64_encode($unique_random_string);

		// '+' is valid in base64 encoding but not in salt
		$modified_base64_string=str_replace('+','.',$base64_string);

		// Truncate string to the correct length;
		$salt=substr($modified_base64_string,0,$length);
		
		return $salt;
	}

	function password_check($password,$existing_hash){
		$hash=crypt($password,$existing_hash);
		if($hash===$existing_hash){
			return true;
		}
		else{
			return false;
		}
	}

	function attempt_login_admin($username,$password){
		$admin=find_admin_by_username($username);
		if($admin){
			if(password_check($password,$admin["hashed_password"])){
				return $admin;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function attempt_login_user($username,$password){
		$user=find_user_by_username($username);
		if($user){
			if(password_check($password,$user["hashed_password"])){
				return $user;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function find_admin_by_username($username){
		global $connection;

		$safe_username=mysqli_real_escape_string($connection,$username);

		$query="SELECT * ";
		$query.="FROM admins ";
		$query.="WHERE username='{$safe_username}' ";
		$query.="LIMIT 1";
		$admin_set=mysqli_query($connection,$query);
		confirm_query($admin_set);
		if ($admin=mysqli_fetch_assoc($admin_set)){
			return $admin;
		}
		else{
			return null;
		}
	}

	function find_user_by_username($username){
		global $connection;

		$safe_username=mysqli_real_escape_string($connection,$username);

		$query="SELECT * ";
		$query.="FROM users ";
		$query.="WHERE username='{$safe_username}' ";
		$query.="LIMIT 1";
		$user_set=mysqli_query($connection,$query);
		confirm_query($user_set);
		if ($user=mysqli_fetch_assoc($user_set)){
			return $user;
		}
		else{
			return null;
		}
	}

	function logged_in(){
		return isset($_SESSION['admin_id']);
	}

	function confirm_logged_in(){
		if(!logged_in()){
		redirect_to("login.php");
		}
	}

	function logged_in_as_admin(){
		return isset($_SESSION['admin_id']);
	}

	function confirm_logged_in_as_admin(){
		if(!logged_in()){
		redirect_to("login.php");
		}
	}
?>
