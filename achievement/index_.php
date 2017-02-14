<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include 'includes/dbfunctions.php';
include 'includes/vars.php';
include 'includes/users.php';

if (!isset($pageuser)){
	header("Location: createuser.php");
	die();
}

if (!checkcookie())
	header("Location: login.php");

	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>District Level Examination - Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
.lb{
	color:  #505050;
	margin: 2px;
	text-decoration:none;
	background:#e0e0e0;
	padding:6px 12px 6px 12px;
	clear: none;
	float:left;
}

.lb:hover{
	background:#d0d0d0;
}

.sectionbox{
	width:200px;
	margin: 10px; 
	float: left;
}

.sectionbox h2{
	color: #003366;
	font-size: 1.6em;
	padding:15px 5px;
}

.sectionbox a{
	padding:5px 10px;
	background-color: #ddd;
	color: #333;
	text-decoration: none;
	display: block;
	margin: 5px;
}

.sectionbox a:hover{
	background-color: #ccc;
}

.sectionbox p{
	padding-left:75px;
}



</style>
</head>

<body>
<div style="position:absolute; top:10px; right:10px;">
<a href="createuser.php">Change password</a> | <a href="logout.php">Logout</a></div>
<p>&nbsp;</p>
<p align="center">
<img src="images/dle.png">
</p>
<p>&nbsp;</p>
<div style="width: 700px; padding: 20px; background-color: white; border: 10px solid #999; margin: 0 auto;">

	<div class='sectionbox'>
		<h2>Data Entry</h2>
		<span style='float:left'><img src='images/entry.png' width="75%"></span>
		<p>
		
		<a href='entrypre.php'>Entry / Update</a>
		</p>
	
	</div>

	<div class='sectionbox'>
		<h2>Reports</h2>
		<span style='float:left'><img src='images/reports.png' width="75%"></span>
		<p>
		<a href='reportpre.php'>School Reports</a>
		</p>
	</div>

	<div class='sectionbox'>
		<h2>Database</h2>
		<span style='float:left'><img src='images/savedb.png' width="75%"></span>
		<p>
		<a href='dbimport.php'>Import</a>
		<a href='dbexport.php'>Export</a>
		<a href='dbrepair.php'>Repair</a>
		</p>
	</div>
	
	<div style="clear:both">&nbsp;</div>
</div>
<p>&nbsp;</p>
<p align="center" class="ewListAdd">&copy; Copyright 2008. All rights reserved</p>
<p>&nbsp;</p>
</body>
</html>
