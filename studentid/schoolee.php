<?php
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = dbconnect();


?>

<html>
<head>
<title>Flash School Report Card</title>
<style>
TABLE{
	border-collapse:collapse;
}
TD {
	font: 10px Verdana, Arial, Helvetica, sans-serif; color: #000000; text-align:center;
}
P {
	font: 10px Verdana, Arial, Helvetica, sans-serif; color: #000000
}
BODY {
	padding:5px; font-size: 10px; margin: 0px; font-family: Verdana, Arial, Helvetica, sans-serif;
}
.tiny{
	font-size: 10px;
}
BR.page { page-break-after: always }

h1{font-size: large;}
</style>
</head>

<?php

	$result=mysql_query("select * from mast_schoollist where $wc and flash1='1' and flash2='1' order by sch_num");
	$schools = mysql_fetch_all($result);
	var_dump($schools);die;
?>

