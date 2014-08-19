<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Tag Export</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
Exporting Database... <br>

<?php

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

$d = $_POST['d'];

// filename for db export

$query = "select * from mast_district";
if ($d!='') $query .= " WHERE dist_code='$d'";

$result = mysql_query($query);
if (mysql_num_rows($result)==1){
	// use filename as district name
	
	$row = mysql_fetch_array($result);
	$filename = $row['dist_name'];
	
}
else $filename = "dbexport";

$filename .= "_tags";

$filename.="_";
$filename.=date("YmdHis");

exportsqlheader($filename.'.sql');
exporttable($filename.'.sql','tags','1=1');

require_once('../lib/zip.lib.php');

$zipfile = new zipfile();

$handle = fopen($filename.'.sql', "r");
$contents = fread($handle, filesize($filename.'.sql'));
fclose($handle);

$zipfile -> addFile($contents, $filename.'.sql');
$dump_buffer = $zipfile -> file();

$path = getenv('ALLUSERSPROFILE')."\\Desktop\\$filename.zip";

$handle = fopen($path, "w");
fwrite($handle, $dump_buffer);
fclose($handle);


echo "Done <br>";

unlink($filename.'.sql');

?>

<script>
alert('The Database export has been saved to the Desktop');
window.location = '../index.php';

</script>

</body>
