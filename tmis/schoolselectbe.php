<?php


require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');


$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name',$dblink);
	$rows = mysql_fetch_all($result);


	printf('<select name="distlist" id="distlist" onchange="districtChange()">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']),$dblink);
		$rows = mysql_fetch_all($result);

		if ($_GET['id']=='') printf('<select name="vdclist" id="vdclist" onchange="vdcChange()">');
		else printf("<select name='{$_GET['id']}' id='{$_GET['id']}' onchange='vdcChange()'>");

		if (mysql_num_rows($result)==0){
			printf('<option value="%s">%s</option>', '', '-- Select District first --');
		}
		else printf('<option value="%s">%s</option>', '', '-- VDC --');
		

		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

		}
		

		printf('</select>');
	}

}

if ($req == 'schoollist_e' || $req == 'schoollist_ne'){
	$dist=$_GET['d'];
	$vdc=$_GET['v'];
	$order = ($_GET['o']=='code'?'sch_num':'nm_sch');
	$class = $_GET['c'];
        $last_year=--$currentyear;
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE dist_code='$dist' AND vdc_code='$vdc' AND sch_year='$last_year' AND mast_schoollist.flash1='1' ORDER BY $order",$dblink);
	$schools = mysql_fetch_all($result);
	
	if ($req == 'schoollist_e') $id='slist_e';
	else $id='slist_ne';
	
	echo "<select size='20' style='width:300px;' id='$id' onchange='schoolSelect(this);'>\n";

	foreach($schools as $s){
		
		$result = mysql_query("SELECT count(tid) as n FROM tmis_main WHERE sch_num LIKE '{$s['sch_num']}%'");
		$row = mysql_fetch_assoc($result);
		
		if ($req == 'schoollist_e' && $row['n']==0) continue;
		if ($req == 'schoollist_ne' && $row['n']!=0) continue;
		
	
		if ($order=='sch_num')	printf("<option value='%s'>[%s] %s</option>",$s['sch_num'],$s['sch_num'],$s['nm_sch']);
		else printf("<option value='%s'>%s [%s]</option>",$s['sch_num'],$s['nm_sch'],$s['sch_num']);
	}
	
	echo "</select>\n";
}
