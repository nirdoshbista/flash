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
<body>



<?php

$D = $_GET['d'];	// district
$V = $_GET['v'];	// vdc
$S = $_GET['s'];	// school expand or not
$TN = $_GET['tn'];  // tag name
$currentyear = $_GET['yr'];


if ($TN!=''){
	// show aggregate according to tag
	
	$result= mysql_query("select * from tags where tag_id='$TN'");
	$row=mysql_fetch_array($result);
	
	$report_title = $row['tag_category'].' '.$row['tag_name'];
	
	$tags = explode(' ',$row['codes']);
	
	$clauselist = array();
	foreach ($tags as $t){
		$clauselist[]="sch_num like '$t'";
	}
	
	$clause = implode(' or ',$clauselist);
	
	$wc = " ($clause) and sch_year='$currentyear' ";
	
	include "showcomparison.php";

	$result=mysql_query("select * from mast_schoollist where $wc and flash1='1' and flash2='1' order by sch_num");
	$schools = mysql_fetch_all($result);
	
	/*
	
	// Multiple school view restriction

	if (mysql_num_rows($result)>1 && !checkcookie()){
		include "restrict.php";
		die("</body>\n</html>");	
	}
	*/
	
	foreach ($schools as $sch){
		$sch_num=$sch['sch_num'];
		$wc = " sch_num like '$sch_num' and sch_year='$currentyear' ";
	
		showcomparison(); 
		
		echo "<br class='page' />";
		
		echo "$sch_num<br>";
		
	}
	die("</body>\n</html>");	
	
	
}
else{
	
	if ($D!='' && $V!='' && $S!='') $wc = " sch_num like '$S' and sch_year='$currentyear' ";
	if ($D!='' && $V!='' && $S=='') $wc = " sch_num like '$D$V%' and sch_year='$currentyear' ";
	if ($D!='' && $V=='' && $S=='') $wc = " sch_num like '$D%' and sch_year='$currentyear' ";
	
	include "showcomparison.php";

	$result=mysql_query("select * from mast_schoollist where $wc and flash1='1' and flash2='1' order by sch_num");
	$schools = mysql_fetch_all($result);
	
	/*
	if (mysql_num_rows($result)>1 && !checkcookie()){
		include "restrict.php";
		die("</body>\n</html>");	
	}	
	*/
	foreach ($schools as $sch){
		$sch_num=$sch['sch_num'];
		$wc = " sch_num like '$sch_num' and sch_year='$currentyear' ";
	
		showcomparison(); 
		
		//echo "<br class='page' />";
		
		//echo "$sch_num<br>";
		
	}
	die("</body>\n</html>");
	
}





/*
if ($TN!='') {

	include "reportagg.php";

	$agg_level = "tag";

	showreport();	
	
	//die("</body>\n</html>");
}

if (strlen($S)==9) { 
	// show school report (single)
	include "reportschool.php";
	
	$sch_num=$_GET['s'];
	$wc = " sch_num like '$sch_num' and sch_year='2063' ";
	
	showreport(); 
	die("</body>\n</html>"); 
}
if ($D!='' && $V!='' && $S=='-1') {
	// show all schools in vdc
	include "reportschool.php";
	
	$result=mysql_query("select * from mast_schoollist where dist_code='$D' and vdc_code='$V' and sch_year='2063' order by sch_num");
	$schools = mysql_fetch_all($result);
	
	foreach ($schools as $sch){
		$sch_num=$sch['sch_num'];
		$wc = " sch_num like '$sch_num' and sch_year='2063' ";
	
		showreport(); 
		echo "<br class='page' />";
		
	}
	
	die("</body>\n</html>"); 
}

if ($D!='' && $V!='' && $S=='0') {
	// vdc report card
	
	$wc = " sch_num like '$D$V%' and sch_year='2063' ";
	include "reportagg.php";
	
	$result = mysql_query("select * from mast_vdc where dist_code='$D' and vdc_code='$V'");
	$row = mysql_fetch_array($result);
	
	$report_title = $row['vdc_name_e'];
	$agg_level = "vdc";
	$dist_code=$D;
	
	$result = mysql_query("select * from mast_district where dist_code='$D'");
	$row = mysql_fetch_array($result);
	
	$districtname = $row['dist_name'];
	
	$report_title .= " $districtname";
	
	showreport();	
	
	die("</body>\n</html>"); 
}

if ($D!='' && $V=='0') {
	// district report card
	
	$wc = " sch_num like '$D%' and sch_year='2063' ";
	include "reportagg.php";
	
	$result = mysql_query("select * from mast_district where dist_code='$D'");
	$row = mysql_fetch_array($result);
	
	$report_title = $row['dist_name'];
	$agg_level = "district";
	$dist_code=$D;
	
	showreport();	
	
	die("</body>\n</html>"); 

}

*/
?>

Undefined.

</body>
</html>
