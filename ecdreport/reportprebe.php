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
	printf('<option value="">- Select District -</option>');
	printf('<option value="-1">- All Districts -</option>');
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
		printf('<option value="">- District Report Card -</option>');
		printf('<option value="-1">- All VDCs -</option>');
		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

		}
		printf('</select>');
	}

}


if ($req=='schoollist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	$yr=$_GET['y'];
	$r=$_GET['reporttype'];

	if ($vdc<=0){
		echo '';
	}
	else{
		
		if ($r=='7'){
			// ecd report
			$query = sprintf('select *, TRIM(nm_sch) as schoolname from mast_schoollist join mast_school_type using (sch_num, sch_year) where dist_code="%s" and vdc_code="%s" and mast_schoollist.sch_year="%s" and flash1="1" and flash2="1" and ecd>0 order by schoolname',$dist, $vdc,$yr);
			
			$result = mysql_query($query);
			//$rows = mysql_fetch_all($result);
			echo 'School: <select name="s" id="s" onchange="return handlechange(this, event);">';
			printf('<option value="">- VDC Report Card -</option>');
			printf('<option value="-1">- All Schools -</option>');
			
			while ($r=mysql_fetch_assoc($result)){
				printf("<option value='%s'>%s - %s</option>",$r['sch_num'],$r['sch_num'],$r['schoolname']);
			}
			echo '</select>';			
		}
		
		if ($r=='8'){
			// sop/fsp report
			
			// get all schools first
			$query = sprintf('select *, TRIM(nm_sch) as schoolname from mast_schoollist join mast_school_type using (sch_num, sch_year) where dist_code="%s" and vdc_code="%s" and mast_schoollist.sch_year="%s" and flash1="1" and flash2="1" order by schoolname',$dist, $vdc,$yr);
			
			$result = mysql_query($query);
			//$rows = mysql_fetch_all($result);
			echo 'School: <select name="s" id="s" onchange="return handlechange(this, event);">';
			printf('<option value="">- VDC Report Card -</option>');
			printf('<option value="-1">- All Schools -</option>');
			
		
			while ($r=mysql_fetch_assoc($result)){
				// check if the school has sop/fsp
				// school has sop/fsp if the school type is sop/fsp (11)
				// or school has run sop/fsp
				
				$result = mysql_query("select sch_num from sopfsp_info_f1 where sch_num='{$r['sch_num']}' and sch_year='{$yr}'");
				echo "select sch_num from sopfsp_info_f1 where sch_num='{$r['sch_num']}' and sch_year='{$yr}'";
				if (mysql_num_rows($result)>0){
					printf("<option value='%s'>%s - %s</option>",$r['sch_num'],$r['sch_num'],$r['schoolname']);
				}
			}
			echo '</select>';			
			
		}
	

	}

	//if ($vdc=='0') echo "<input type='checkbox' id='s' name='s' value='0'> School Expanded";




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
