<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = dbconnect($dbname);

$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('<select name="distlist" id="distlist" onChange="validateInput();">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], '['.$r['dist_code'].']'.$r['dist_name']);

	}
	printf('</select>');

}

?>
