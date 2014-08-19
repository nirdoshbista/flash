<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

$path=$_GET['p'];

if (!is_dir($path)){

	die();
}

if ($path!='reports/') {
	printf("<br><a href='#' onclick='openFolder(\"%s/\")'><img src='../images/go-up.png' border='0'> %s</a>&nbsp; &nbsp; &nbsp; &nbsp;",dirname($path), 'Up');
	printf("<a href='#' onclick='openFolder(\"%s\")'><img src='../images/go-home.png' border='0'> %s</a><br />",'reports/', 'Report Home');
	printf("<br><hr>");
	
}

// show subfolders
$lines = @file($path.'folders.txt');

if ($lines){
	foreach ($lines as $l) {
	   if (trim($l)=='') continue;
	   $parts=explode(',',$l);
	   //echo "<br /><img src='../images/folder.png'> ";
	   //printf("<a href='#' onclick='openFolder(\"%s\")'>%s</a><br />",$path.trim($parts[1]), $parts[0]);
	   printf("<div class='reportfolder'><a href='#' onclick='openFolder(\"%s\")'>%s</a></div>",$path.trim($parts[1]), $parts[0]);
	   
	}
}


// show files
$lines = @file($path.'reports.txt');

if ($lines){
	foreach ($lines as $l) {
	   if (trim($l)=='') continue;
	   $parts=explode(',',$l);
	   //echo "<br /><img src='../images/report.png'> ";
	   printf("<div class='reportlink'><a href='#' onclick='openReport(\"%s\")'>%s</a></div>",$path.trim($parts[1]), $parts[0]);

	}
}





?>
