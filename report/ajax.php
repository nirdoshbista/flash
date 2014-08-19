<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('District: <select name="d" id="d" onchange="return handlechange(this, event);">');
	printf('<option value="0">- District Wise -</option>');
	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']));
		$rows = mysql_fetch_all($result);


		printf('VDC: <select name="v" id="v" onchange="return handlechange(this, event);">');
		printf('<option value="0">- VDC Wise -</option>');
		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

		}
		printf('</select>');
	}

}


if ($req=='schoollist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];

	if ($vdc=='0') echo "<input type='checkbox' id='s' name='s' value='0'> School Expanded";

}

if ($req=='taglist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	
	$query="select distinct tag_category from tags order by tag_category";

	
	$result = mysql_query($query);
	$rows = mysql_fetch_all($result);
	
	if (mysql_num_rows($result)>0){
		printf('Report by Tag: <select name="t" id="t" onchange="return handlechange(this, event);">');
		printf('<option value="">- Select Category -</option>');
		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['tag_category'], $r['tag_category']);

		}
		printf('</select>');
	}
	else{
		printf('Report by Tag: <select name="t" id="t" onchange="return handlechange(this, event);">');
		printf('<option value="">- No Categories defined -</option>');
		printf('</select>');	
	
	}
	
}


if ($req=='tagname'){
	$tc=$_GET['t'];

	
	$query="select * from tags where tag_category='$tc' order by tag_name";

	
	$result = mysql_query($query);
	$rows = mysql_fetch_all($result);
	
	if (mysql_num_rows($result)>0){
		printf(' Tag: <select name="tn" id="tn" onchange="return handlechange(this, event);">');
		printf("<option value=''>- $tc wise -</option>");
		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['tag_id'], $r['tag_name']);

		}
		printf('</select>');
	}
	else{
		printf(' Tag: <select name="tn" id="tn" onchange="return handlechange(this, event);">');
		printf('<option value="">- No Tags defined -</option>');
		printf('</select>');	
	
	}
	
	echo "<input type='checkbox' name='expandschool' id='expandschool'> Expand School";
	
}


?>
