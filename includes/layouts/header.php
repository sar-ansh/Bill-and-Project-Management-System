<?php
	if(!isset($layout_context)){
		$layout_context="public";
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>CPWD <?php if($layout_context=="admin"){ echo "Admin";} else{ echo "User";}?></title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header">	
				<img style="position: absolute; top: 5px;" src="images/logo.gif" height="70px" alt="cpwd_logo" />
				<h1 style="position: absolute; top: 10px; left: 50px; font-size: 25px;">CENTRAL PUBLIC WORKS DEPARTMENT</h1>
		</div>			


