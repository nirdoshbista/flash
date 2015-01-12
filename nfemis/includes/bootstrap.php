<?php

require("includes/vars.php");

// connect to flash db
$flashdblink = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$flashdblink) die('Could not connect to MySQL server: ' . mysql_error());
if (!mysql_select_db($flashdbname, $flashdblink)){
	die('Flash Database not found');
}

// connect to db
$dblink = mysql_connect($dbserver, $dbusername, $dbpassword,true);
if (!$dblink) die('Could not connect to MySQL server: ' . mysql_error());
if (!mysql_select_db($dbname, $dblink)){
	header('Location: install.php');
	exit();
}

ini_set('memory_limit',"1024M");
ini_set('max_execution_time',"600");

// load printer extension
/*
if (!extension_loaded('printer')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        dl('php_printer.dll');
    }
}
*/

?>
