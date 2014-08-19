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


	printf('<select name="distlist" id="distlist" onchange="districtChange()">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']));
		$rows = mysql_fetch_all($result);


		printf('<select name="vdclist" id="vdclist" onchange="vdcChange()" onkeypress="return generalKeyPress(this, event);">');

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

if ($req=='schoolsuggest'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];

	$result = mysql_query(sprintf('select *, TRIM(nm_sch) as schoolname, max(sch_year) from mast_schoollist where dist_code="%s" and vdc_code="%s" group by sch_num order by schoolname',$dist, $vdc));
	$rows = mysql_fetch_all($result);

	foreach($rows as $r){
		printf($r['schoolname'].'~'.$r['sch_num'].'~');
	}

}


if ($req=='schoollist_e'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	$order = $_GET['order'];
	
	//schools entered
	if ($order=='code')
		$result=mysql_query("select distinct sch_num, nm_sch, closed, merged_with from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' and sch_year='$currentyear' and flash2>0 order by sch_num");
	else 
		$result=mysql_query("select distinct sch_num, nm_sch, closed, merged_with from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' and sch_year='$currentyear' and flash2>0 order by nm_sch");
		
	$schools = mysql_fetch_all($result);
	
	echo "<select size='20' style='width:300px;' id='slist_e' onchange='schoolSelect(this);'>\n";

	
	foreach($schools as $s){
		if ($s['closed']==1) $style = ' class="closedschool" '; else $style='';
		if ($s['merged_with']!='') $mwtext = "> [{$s['merged_with']}]"; else $mwtext ='';
		
		if ($order=='code')	printf("<option value='%s' $style>[%s] $mwtext %s</option>",$s['sch_num'],$s['sch_num'],$s['nm_sch']);
		else printf("<option value='%s' $style>%s [%s] $mwtext</option>",$s['sch_num'],$s['nm_sch'],$s['sch_num']);
	}
	echo "</select>\n";
	
}

if ($req=='schoollist_ne'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	$order = $_GET['order'];
	
	//schools not entered
	if ($order=='code')
		$result=mysql_query("select distinct sch_num from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' and sch_year='$currentyear' and flash1>0 order by sch_num");
	else 
		$result=mysql_query("select distinct sch_num from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' and sch_year='$currentyear' and flash1>0 order by nm_sch");
		
	$schools = mysql_fetch_all($result);
	
	echo "<select size='20' style='width:300px;' id='slist_ne' onchange='schoolSelect(this);'>\n";

	foreach($schools as $s){
		
		$result=mysql_query("select * from mast_schoollist where sch_year='$currentyear' and sch_num='${s['sch_num']}' and flash2>0");
		
		if (mysql_num_rows($result)==0){  // not entered
			$result=mysql_query("select * from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' and sch_num='${s['sch_num']}' order by sch_year desc");
			$row = mysql_fetch_array($result);
			
			if ($row['closed']==1) continue;
			
			if ($order=='code')	printf("<option value='%s'>[%s] %s</option>",$row['sch_num'],$row['sch_num'],$row['nm_sch']);
			else printf("<option value='%s'>%s [%s]</option>",$row['sch_num'],$row['nm_sch'],$row['sch_num']);			
		}
		
		

	}
	echo "</select>\n";
	
}

if ($req=='schoollist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];

$str = <<<EOD
<input type="radio" name="schlist_choose" checked value="1" onclick="document.getElementById('divlistbycode').className='divhide'; document.getElementById('divlistbyname_y').className='divhide'; document.getElementById('divlistbyname_n').className='';">Not Entered
<input type="radio" name="schlist_choose" value="2" onclick="document.getElementById('divlistbycode').className='divhide'; document.getElementById('divlistbyname_y').className=''; document.getElementById('divlistbyname_n').className='divhide';">Entered
<input type="radio" name="schlist_choose" value="3" onclick="document.getElementById('divlistbycode').className=''; document.getElementById('divlistbyname_y').className='divhide'; document.getElementById('divlistbyname_n').className='divhide';">By Code
<br>
EOD;
echo $str;

	
	
	
	//schools not entered
	$result=mysql_query("select distinct sch_num from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' order by nm_sch");
	$schools = mysql_fetch_all($result);
	
	echo mysql_error();
	echo '<div id="divlistbyname_n"><select size="20" style="width:305px" name="listbyname_n" id="listbyname_n" onclick="loadSchool(document.getElementById(\'listbyname_n\').value);">';
	foreach($schools as $s){
			
		$result=mysql_query("select *, TRIM(nm_sch) as schoolname from mast_schoollist where sch_num='".$s['sch_num']."' order by sch_year desc");
		$r=mysql_fetch_array($result);

		if ($r['sch_year']<$currentyear || ($r['sch_year']==$currentyear && $r['flash_i']!=1))
			printf("<option value='%s'>%s</option>",$r['sch_num'],$r['schoolname']);
	}
	echo '</select></div>';	
	
	
	//schools entered
	$result=mysql_query("select distinct sch_num from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' order by nm_sch");
	$schools = mysql_fetch_all($result);
	
	echo mysql_error();
	echo '<div id="divlistbyname_y" class="divhide"><select size="20" style="width:305px" name="listbyname_y" id="listbyname_y" onclick="loadSchool(document.getElementById(\'listbyname_y\').value);">';
	foreach($schools as $s){
			
		$result=mysql_query("select *, TRIM(nm_sch) as schoolname from mast_schoollist where sch_num='".$s['sch_num']."' order by sch_year desc");
		$r=mysql_fetch_array($result);

		if ($r['sch_year']==$currentyear && $r['flash_i']==1)
			printf("<option value='%s'>%s</option>",$r['sch_num'],$r['schoolname']);
	}
	echo '</select></div>';		
	
	//schools by code
	$result=mysql_query("select distinct sch_num from mast_schoollist where dist_code='$dist' and vdc_code='$vdc' order by sch_num");
	$schools = mysql_fetch_all($result);
	
	echo mysql_error();
	echo '<div id="divlistbycode" class="divhide"><select size="20" style="width:305px" name="listbycode" id="listbycode" onclick="loadSchool(document.getElementById(\'listbycode\').value);">';
	foreach($schools as $s){
			
		$result=mysql_query("select *, TRIM(nm_sch) as schoolname from mast_schoollist where sch_num='".$s['sch_num']."' order by sch_year desc");
		$r=mysql_fetch_array($result);

		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['sch_code'].' - '.$r['schoolname']);
	}
	echo '</select></div>';		



}

if ($req=='newschoolcode'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	
	$i=1;
	
	while (1){
		$schcode=str_pad($i, 4, "0", STR_PAD_LEFT);
		$result = mysql_query(sprintf('select sch_code from mast_schoollist where dist_code="%s" and vdc_code="%s" and sch_code="%s"',$dist, $vdc,$schcode));
		
		if (mysql_num_rows($result)==0){
			break;
		}
		
		$i++;
		
	
	}
	
	printf($schcode);
	
	
}

if ($req=='sch_close'){
	$sch_num = $_GET['s'];
	
	mysql_query("UPDATE mast_schoollist SET closed=1, flash2=1 WHERE sch_num='$sch_num' AND sch_year='$currentyear'");
	
	/*
	$result = mysql_query("select * from mast_schoollist where sch_num='$sch_num' order by sch_year desc");
	$row = mysql_fetch_array($result);
	
	// 
	$dt=array();
	$dt['sch_year']=$currentyear;
	
	$dt['dist_code']=$row['dist_code'];
	$dt['vdc_code']=$row['vdc_code'];
	$dt['sch_code']=$row['sch_code'];
	$dt['wardno']=$row['wardno'];
	$dt['location']=$row['location'];
	$dt['post_office']=$row['post_office'];
	$dt['telno']=$row['telno'];
	$dt['email']=$row['email'];
	$dt['account_no']=$row['account_no'];
	$dt['region']=$row['region'];	
	
	$dt['nm_sch']=$row['nm_sch'];

	$dt['sch_num']=$sch_num;
	$dt['closed']=1;
	
	mysql_query("delete from mast_schoollist where sch_num='".$dt['sch_num']."' and sch_year='$currentyear'");
	idata('mast_schoollist',$dt);
	*/
	
}

if ($req=='sch_merge'){
	$sch_num = $_GET['s'];
	$mw = $_GET['mw'];
	
	mysql_query("UPDATE mast_schoollist SET closed=1, merged_with='$mw', flash2=1 WHERE sch_num='$sch_num' AND sch_year='$currentyear'");
	
	/*
	$result = mysql_query("select * from mast_schoollist where sch_num='$sch_num' order by sch_year desc");
	$row = mysql_fetch_array($result);
	
	// 
	$dt=array();
	$dt['sch_year']=$currentyear;
	
	$dt['dist_code']=$row['dist_code'];
	$dt['vdc_code']=$row['vdc_code'];
	$dt['sch_code']=$row['sch_code'];
	$dt['wardno']=$row['wardno'];
	$dt['location']=$row['location'];
	$dt['post_office']=$row['post_office'];
	$dt['telno']=$row['telno'];
	$dt['email']=$row['email'];
	$dt['account_no']=$row['account_no'];
	$dt['region']=$row['region'];	
	
	$dt['nm_sch']=$row['nm_sch'];

	$dt['sch_num']=$sch_num;
	$dt['closed']=1;
	$dt['merged_with']=$mw;
	
	mysql_query("delete from mast_schoollist where sch_num='".$dt['sch_num']."' and sch_year='$currentyear'");
	idata('mast_schoollist',$dt);		
	*/
	
}


?>
