<?php

require("../includes/vars.php");

// connect to flash db
$dblink = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$dblink) die('Could not connect to MySQL server: ' . mysql_error());
if (!mysql_select_db($dbname, $dblink)){
	die('Flash Database not found');
}

ini_set('memory_limit',"256M");
ini_set('max_execution_time',"600");

?>