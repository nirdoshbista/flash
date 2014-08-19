<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('includes/vars.php');
require_once('includes/dbfunctions.php');
$link = dbconnect();

$req=$_GET['req'];

if($req=='inserttmis'){
	$tn=$_GET['tname'];
	$sn=$_GET['schcode'];
	
	// get the max id
	$maxid=0;
	
	$result = mysql_query("select max(tid) as tid from tmis_main");
	if (mysql_num_rows($result)>0){
		$row = mysql_fetch_assoc($result);
		$maxid = $row['tid'];
	}
	
	$maxid++;
	
	$result = mysql_query(sprintf("insert into tmis_main (tid,sch_year,sch_num,t_name,entry_timestamp) values('%s','%s','%s','%s','%s')",$maxid,$currentyear, $sn, $tn,date("Y-m-d H:i:s")));
	
	echo $maxid;
}

if($req=='gen_tmis_link'){
	$tn=$_GET['t'];
	$sn=$_GET['s'];
	$result = mysql_query("select tid from tmis_main where sch_num=".$sn." and t_name='".$tn."'");
	mysql_error();
	$rows=mysql_fetch_all($result);
	foreach($rows as $r){
		echo $r['tid'];
		
	}
}



if($req=='writemenutofile'){
	$valtowrite=$_GET['val']."\n";
	$filetowrite="data/".$_GET['file'];
	if(!($file=fopen($filetowrite,"a+"))){
	//error
	die('error reading file');
	}

	fputs($file,$valtowrite);
}

if($req=='teacherlist'){
	$code=$_GET['code'];
	//echo $req;
	$result = mysql_query("select * from mast_schoollist where sch_num='".$code."' and sch_year='$currentyear'");
	echo '<select name="teacherlist" id="teacherlist" onchange="return teacherchange(this.value);">';
	if(mysql_num_rows($result)==0){
			echo('<option value="0">-- Add New --</option>');
		}
	else{
		$result = mysql_query("select * from tmis_main where sch_num='".$code."'  and sch_year='$currentyear' order by t_name");
		$rows = mysql_fetch_all($result);
		
		if (mysql_num_rows($result)==0){
				//echo '<input name="teacherName" type="text" id="teacherName" size="30" maxlength="50" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);">';
				echo ('<option value="0">-- Add New --</option>');
			}
		else {
			printf('<option value="0">%s</option>', '-- Add New --');
			
		foreach($rows as $r){
				
				printf("<option value=%s>%s</option>", $r['tid'], $r['t_name']);
				}
		
		}
	}
	printf('</select>');
}

if ($req=='loadteacher'){
	$tid=$_GET['code'];
	$result = mysql_query("select * from tmis_main where tid='".$tid."' order by tid");
	$r = mysql_fetch_array($result);
	
	echo $r['t_name'].'~';
	echo $r['sch_num'].'~';
	//echo $r['tid'].'~';
	echo $tid.'~';
	
	$result = mysql_query(sprintf('select * from tmis_sec1 where tid="%s"',$tid));
	$r = mysql_fetch_array($result);

	echo $r['nationality'].'~';
	echo $r['sex'].'~';
	echo $r['caste'].'~';
	echo $r['t_caste'].'~';
	echo $r['insurance_no'].'~';
	echo $r['pf_no'].'~';
	echo $r['license_no'].'~';
	echo $r['mother_tongue'].'~';
	echo $r['teaching_lang'].'~';
	echo $r['first_app_type'].'~';
	echo $r['first_app_year'].'~';
	echo $r['first_app_month'].'~';
	echo $r['first_app_day'].'~';
	echo $r['first_app_level'].'~';
	echo $r['first_app_sec_subject'].'~';
	echo $r['teachingSub1'].'~';
	echo $r['teachingSub2'].'~';
	echo $r['curr_perm_level'].'~';
	echo $r['curr_perm_rank'].'~';
	//echo $r['curr_temp_level'].'~';
	//echo $r['curr_temp_rank'].'~';
	echo $r['bs_dob_year1'].'~';
	echo $r['bs_dob_month1'].'~';
	echo $r['bs_dob_day1'].'~';
	echo $r['ad_dob_year1'].'~';
	echo $r['ad_dob_month1'].'~';
	echo $r['ad_dob_day1'].'~';
	echo $r['bs_dob_year2'].'~';
	echo $r['bs_dob_month2'].'~';
	echo $r['bs_dob_day2'].'~';
	echo $r['ad_dob_year2'].'~';
	echo $r['ad_dob_month2'].'~';
	echo $r['ad_dob_day2'].'~';
	echo $r['marital_status'].'~';
	echo $r['nof_daughter'].'~';
	echo $r['nof_son'].'~';
	echo $r['nof_total'].'~';
	echo $r['citizenship_no'].'~';
	echo $r['citizenship_year'].'~';
	echo $r['citizenship_month'].'~';
	echo $r['citizenship_day'].'~';
	echo $r['citizenship_dist'].'~';
	echo $r['name_father'].'~';
	echo $r['name_mother'].'~';
	echo $r['name_spouse'].'~';
	echo $r['name_willper'].'~';
	echo $r['perm_addr_dist'].'~';
	echo $r['perm_addr_vdc'].'~';
	echo $r['perm_addr_ward'].'~';
	echo $r['perm_addr_locality'].'~';
	echo $r['perm_addr_house'].'~';
	echo $r['perm_addr_region'].'~';
	echo $r['perm_addr_phone'].'~';
	echo $r['perm_addr_email'].'~';
	echo $r['temp_addr_dist'].'~';
	echo $r['temp_addr_vdc'].'~';
	echo $r['temp_addr_ward'].'~';
	echo $r['temp_addr_locality'].'~';
	echo $r['temp_addr_house'].'~';
	echo $r['temp_addr_region'].'~';
	echo $r['temp_addr_phone'].'~';
	echo $r['temp_addr_email'].'~';

	
}


if ($req=='sec2'){
	$tid=$_GET['code'];
	$result = mysql_query("select * from tmis_sec2 where tid='".$tid."' order by sn");
	
	
	
	for($i=0;$i<14;$i++){
	$r = mysql_fetch_array($result);
	echo $r['appoint_level'].'~';
	echo $r['appoint_rank'].'~';
	echo $r['appoint_position'].'~';
	echo $r['dec_year'].'~';
	echo $r['dec_month'].'~';
	echo $r['dec_day'].'~';
	echo $r['app_year'].'~';
	echo $r['app_month'].'~';
	echo $r['app_day'].'~';
	echo $r['app_district'].'~';
	echo $r['app_school'].'~';
	echo $r['subj_sec'].'~';
	echo $r['appoint_type'].'~';
	echo $r['appoint_type_other'].'~';
	}
	
	
}


if ($req=='edu'){
	$tid=$_GET['code'];
	$result = mysql_query("select * from tmis_edu where tid='".$tid."' order by sn");
	for($i=0;$i<9;$i++){
		$r = mysql_fetch_array($result);		
		echo $r['qualif'].'~';
		echo $r['board'].'~';
		echo $r['year'].'~';
		echo $r['division'].'~';
		echo $r['stream'].'~';
		echo $r['subj'].'~';
		echo $r['school'].'~';
		echo $r['country'].'~';
	}
}

if ($req=='train'){
	$tid=$_GET['code'];
	$result = mysql_query("select * from tmis_train where tid='".$tid."' order by sn");
	for($i=0;$i<7;$i++){
		$r = mysql_fetch_array($result);		
		echo $r['name'].'~';
		echo $r['type'].'~';
		echo $r['subj'].'~';
		echo $r['year'].'~';
		echo $r['duration'].'~';
		echo $r['division'].'~';
		echo $r['org'].'~';
		echo $r['country'].'~';
	}
}
if ($req=='award'){
	$tid=$_GET['code'];
	$result = mysql_query("select * from tmis_award where tid='".$tid."' order by sn");
	for($i=0;$i<9;$i++){
		$r = mysql_fetch_array($result);		
		echo $r['rank'].'~';
		echo $r['type'].'~';
		echo $r['org'].'~';
		echo $r['year'].'~';
		echo $r['month'].'~';
		echo $r['day'].'~';
	}
}

if ($req=='leave'){
	$tid=$_GET['code'];

	$result = mysql_query("select * from tmis_leave where tid='".$tid."' order by sn");
	for($i=0;$i<5;$i++){
		$r = mysql_fetch_array($result);		
		echo $r['type'].'~';
		echo $r['dist'].'~';
		echo $r['school'].'~';
		echo $r['year_from'].'~';
		echo $r['month_from'].'~';
		echo $r['day_from'].'~';
		echo $r['year_to'].'~';
		echo $r['month_to'].'~';
		echo $r['day_to'].'~';
		echo $r['dur_year'].'~';
		echo $r['dur_month'].'~';
		echo $r['dur_day'].'~';
		echo $r['remarks'].'~';
	}
}

if ($req=='med'){
	$tid=$_GET['code'];

	$result = mysql_query("select * from tmis_med where tid='".$tid."' order by sn");
	for($i=0;$i<5;$i++){
		$r = mysql_fetch_array($result);
		echo $r['level'].'~';
		echo $r['org'].'~';
		echo $r['year_dec'].'~';
		echo $r['month_dec'].'~';
		echo $r['day_dec'].'~';
		echo $r['dist'].'~';
		echo $r['amt'].'~';
		echo $r['year'].'~';
		echo $r['month'].'~';
		echo $r['day'].'~';
	}
}

if ($req=='punish'){
	$tid=$_GET['code'];

	$result = mysql_query("select * from tmis_punish where tid='".$tid."' order by sn");
	for($i=0;$i<5;$i++){
		$r = mysql_fetch_array($result);
		echo $r['level'].'~';
		echo $r['type'].'~';
		echo $r['org'].'~';
		echo $r['person'].'~';
		echo $r['year'].'~';
		echo $r['month'].'~';
		echo $r['day'].'~';
	}
}

if ($req=='pub'){
	$tid=$_GET['code'];

	$result = mysql_query("select * from tmis_pub where tid='".$tid."' order by sn");
	for($i=0;$i<5;$i++){
		$r = mysql_fetch_array($result);
		echo $r['name'].'~';
		echo $r['year'].'~';
		echo $r['month'].'~';
		echo $r['day'].'~';
		echo $r['lang'].'~';
		echo $r['sub'].'~';
		echo $r['remarks'].'~';
	}
}

if ($req=='inc'){
	$tid=$_GET['code'];

	$result = mysql_query("select * from tmis_inc where tid='".$tid."' order by sn");
	for($i=0;$i<5;$i++){
		$r = mysql_fetch_array($result);
		echo $r['src'].'~';
		echo $r['scale'].'~';
		echo $r['grade'].'~';
		echo $r['ta'].'~';
		echo $r['ra'].'~';
		echo $r['ma'].'~';
		echo $r['total'].'~';
	}
}

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


		printf('<select name="vdclist" id="vdclist" onchange="vdcChange()">');

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

		if ($r['sch_year']<$currentyear || ($r['sch_year']=$currentyear && $r['flash_i']!=1))
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




/*



	

	
	// schools not entered
	$result = mysql_query(sprintf("select distinct sch_num, TRIM(nm_sch) as schoolname, concat(sch_year, flash_i) as fi from mast_schoollist where dist_code='%s' and vdc_code='%s' having fi!='20631' order by schoolname;",$dist, $vdc));
	$rows = mysql_fetch_all($result);

	echo mysql_error();
	echo '<div id="divlistbyname_n"><select size="20" style="width:305px" name="listbyname_n" id="listbyname_n" onclick="loadSchool(document.getElementById(\'listbyname_n\').value);">';
	foreach($rows as $r){
		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['schoolname']);
	}
	echo '</select></div>';


	//schools entered
	
	$result = mysql_query(sprintf("select distinct sch_num, TRIM(nm_sch) as schoolname, concat(sch_year, flash_i) as fi from mast_schoollist where dist_code='%s' and vdc_code='%s' having fi='20631' order by schoolname;",$dist, $vdc));
	$rows = mysql_fetch_all($result);

	echo mysql_error();
	echo '<div id="divlistbyname_y" class="divhide"><select size="20" style="width:305px" name="listbyname_y" id="listbyname_y" onclick="loadSchool(document.getElementById(\'listbyname_y\').value);">';
	foreach($rows as $r){
		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['schoolname']);
	}
	echo '</select></div>';

	
	// schools by code

	$result = mysql_query(sprintf('select sch_num, sch_code, TRIM(nm_sch) as schoolname from mast_schoollist where dist_code="%s" and vdc_code="%s" group by sch_num order by sch_code',$dist, $vdc));
	$rows = mysql_fetch_all($result);
	
	echo mysql_error();

	echo '<div id="divlistbycode" class="divhide"><select size="20" style="width:305px" name="listbycode" id="listbycode" onclick="loadSchool(document.getElementById(\'listbycode\').value);">';
	foreach($rows as $r){
		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['sch_code'].' - '.$r['schoolname']);
	}
	echo '</select></div>';
	
	
*/	

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
	
	//printf($schcode);
	
	
}


if ($req=='loadschool'){
	$schoolcode=$_GET['schoolcode'];

	$result = mysql_query(sprintf('select * from mast_schoollist where sch_num="%s" order by sch_year desc',$schoolcode));
	$r = mysql_fetch_array($result);

	echo $r['nm_sch'].'~';
	echo $r['location'].'~';
	echo $r['wardno'].'~';
	echo $r['region'].'~';
	echo $r['telno'].'~';
	echo $r['email'].'~';
	echo $r['sch_code'].'~';

	$result = mysql_query(sprintf('select * from mast_school_type where sch_num="%s" order by sch_year desc',$schoolcode));
	$r = mysql_fetch_array($result);
	
	echo $r['ecd'].'~';
	echo $r['class1'].'~';
	echo $r['class2'].'~';
	echo $r['class3'].'~';
	echo $r['class4'].'~';
	echo $r['class5'].'~';
	echo $r['class6'].'~';
	echo $r['class7'].'~';
	echo $r['class8'].'~';
	echo $r['class9'].'~';
	echo $r['class10'].'~';
	echo $r['class11'].'~';
	echo $r['class12'].'~';

}

if ($req=='enrollment'){
	$schoolcode=$_GET['schoolcode'];
	$class=$_GET['class'];
	$sex=$_GET['sex'];
	
	if ($class>=1 && $class<=5) $result = mysql_query(sprintf('select * from enr_rep_mig_class1_5_f1 where sch_num="%s" and class="%s"',$schoolcode,$class));
	if ($class>=6 && $class<=8) $result = mysql_query(sprintf('select * from enr_rep_mig_class6_8_f1 where sch_num="%s" and class="%s"',$schoolcode,$class));
	if ($class>=9 && $class<=10) $result = mysql_query(sprintf('select * from enr_rep_mig_class9_10_f1 where sch_num="%s" and class="%s"',$schoolcode,$class));
	
	if (mysql_num_rows($result)>0){
		$r = mysql_fetch_array($result);
		if ($sex=='m')echo $r['tot_enroll_total_m'];
		if ($sex=='f')echo $r['tot_enroll_total_f'];
		if ($sex=='t')echo $r['tot_enroll_total_t'];
		
	}
	else{
		echo '9999';
	}
	
}

?>
