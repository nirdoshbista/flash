<html>
<head>
<title>Flash DB Upgrade</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Flash DB Upgrade</h1>

<h3>Backing up existing data</h3>
<?php
require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);



// filename for db export
$result = mysql_query("select * from mast_district");
if (@mysql_num_rows($result)==1){
	// use filename as district name
	
	$row = mysql_fetch_array($result);
	$filename = $row['dist_name'];
	
}
else $filename = "dbexport";

$filename.="_";
$filename.=date("YmdHis");

echo "<p>Exporting database to {$filename}.sql ... ";
exportsqlheader($filename.'.sql');

foreach($t as $tablename){
	@exporttable($filename.'.sql',$tablename, "1=1");
}
echo "Done</p>";


?>

<h3>Upgrading table structure and index</h3>

<?php
echo "<p>Installing new structure ... ";
$flashblank = "flashblank.sql";
importsql($flashblank);
echo "Done</p>";
?>



<?php


echo "<h3>Restoring Data</h3>";

$sqlfile = "{$filename}.sql";
echo "<p>Importing {$sqlfile} ... ";
importsql($sqlfile);
echo "Done</p>";


?>

<h4><a href="../index.php">Proceed to main menu</a></h4>

</body>
</html>
<?php

function importsql($sqlpath){
	global $dbserver, $dbusername, $dbpassword, $dbname;

	$mysql_path = "..\\..\\..\\mysql\\bin\\mysql.exe";

	$mysql_command =sprintf("$mysql_path -v -h%s -u%s -p%s < %s",
        $dbserver, $dbusername, $dbpassword, $sqlpath);
	
	echo $mysql_command."<br />";
	
    shell_exec($mysql_command);
    
}

?>
