<?php
require_once('../includes/reportfunctions.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();


// get essential variables
$D = $_GET['d'];	// district
$V = $_GET['v'];	// district
$S = $_GET['s'];	// school expand or not
$R = $_GET['r'];	// reportfile
$T = $_GET['t'];	// tag id 
$TN = $_GET['tn'];  // tag name
$TE = $_GET['te'];  // tag - expand school


// check if called properly
if (!file_exists($R)) die();

// parse the $R file
$ro = parse_ini_file($R,true);
reportfix($ro);

// get years
$Y = array();
$years = explode(",",$_GET['year']);
foreach ($years as $yr){
	if (trim($yr)!=''){
		$Y[] = trim($yr);
	}
}

if ($T==''){
	
	$reporttype=0;
	if ($D==false) $reporttype=1; // districtwise
	if ($D==true && $S==false) $reporttype=2; //vdcwise
	if ($D==true && $S==true) $reporttype=3; // vdcwise with school expanded
	if ($D==true && $V==true) $reporttype=4; // schoolwise

	if ($reporttype==0) die();
	if ($reporttype==1) $rtypestr="District wise";
	if ($reporttype==2) $rtypestr="VDC wise";
	if ($reporttype==3) $rtypestr="VDC wise (School expanded)";
	if ($reporttype==4) $rtypestr="School wise";


}
else{
	// tagwise
	$rtypestr = "$T wise";

}




// throw page header
pageheader();


// show the table

if ($T=='')
	tablebody();
else
	tablebody_bytag();


// close page
pagefooter();


?>
