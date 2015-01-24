<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');

$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name',$flashdblink);
	$rows = mysql_fetch_all($result);


	printf('District: <select name="d" id="d" onchange="return handlechange(this, event);">');
	printf('<option value="">- Select District -</option>');
	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']),$flashdblink);
		$rows = mysql_fetch_all($result);


		printf('VDC: <select name="v" id="v" onchange="return handlechange(this, event);">');
		printf('<option value="">- Select VDC -</option>');
		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

		}
		printf('</select>');
	}

}


if ($req=='clclist'){
	$dist=$_GET['distcode'];
	$yr=$_GET['y'];

	if (1==0){
		echo '';
	}
	else{
	
		$result = mysql_query(sprintf('select * from nfe_mast_agency join nfe_agency_details using (center_id, year) where dist_code="%s" and year="%s" and `nfe_agency_details`.agency_type=1 order by `nfe_mast_agency`.agency_name',$dist, $yr),$dblink);
		$rows = mysql_fetch_all($result);
		echo 'CLC : <select name="c" id="c">';
		printf('<option value="">- All CLCs -</option>');
		
		foreach($rows as $r){
			printf("<option value='%s'>%s - %s</option>",$r['center_id'],$r['center_id'],$r['agency_name']);
		}
		echo '</select>';
	}

	//if ($vdc=='0') echo "<input type='checkbox' id='s' name='s' value='0'> School Expanded";




}

if ($req=='schoollist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	$yr=$_GET['y'];

	if ($vdc==0){
		echo '';
	}
	else{
	
		$result = mysql_query(sprintf('select *, TRIM(nm_sch) as schoolname from mast_schoollist left join mast_school_type using (sch_num, sch_year) where dist_code="%s" and vdc_code="%s" and sch_year="%s" AND flash1=1 group by sch_num order by schoolname',$dist, $vdc,$yr),$flashdblink);
		$rows = mysql_fetch_all($result);
		echo 'School: <select name="s" id="s">';
		printf('<option value="">- All Schools -</option>');
		
		foreach($rows as $r){
			printf("<option value='%s'>%s - %s</option>",$r['sch_num'],$r['sch_num'],$r['schoolname']);
		}
		echo '</select>';
	}

	//if ($vdc=='0') echo "<input type='checkbox' id='s' name='s' value='0'> School Expanded";
}


if ($req=='reporttype'){
	$cat=$_GET['reportcategory'];
	$o=array();
	
	if ($cat==1){
		$o[]='By type';
		$o[]='By Grade';
	}
	
	echo 'Select Type: <select name="reporttype" id="reporttype">'; 
	for ($i=0;i<2;$i++){
		printf("<option value='%s'>%s</option>",$i+1,$o[$i]);
		
	}
	echo '</select>';

	
}


?>
