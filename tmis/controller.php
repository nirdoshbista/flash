<?php

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');

$from = $_POST['referer'];
$tid = $_POST['t_id'];

if($from == 'tmis_general.php'){
	
	$dt=array();
	$dt['sch_num']= $_POST['sch_code'];
	$dt['sch_year']= $currentyear;
  	$dt['tid']= $_POST['t_id'];
  	$dt['t_name']= $_POST['teacherName'];
  	
  	mysql_query("DELETE FROM tmis_main WHERE tid='{$dt['tid']}' AND sch_year='$currentyear'");
  	idata('tmis_main',$dt,'tid');
  	  	
  	$cdt=array();
	$cdt['tid']= $_POST['t_id'];
	$cdt['sch_year']= $currentyear;
	$cdt['pf_no']= $_POST['teacherPfNo'];
 	$cdt['nationality']= $_POST['teacherNationality'];
 	$cdt['sex']= $_POST['t_sex'];
	$cdt['caste']= $_POST['teacherCaste'];
 	$cdt['t_caste']= $_POST['t_caste'];
 	$cdt['insurance_no']= $_POST['teacherInsurNo'];
        $cdt['account_no']= $_POST['teacherAcNo'];
        $cdt['trk_no']= $_POST['teacherTrkNo'];
 	$cdt['license_no']= $_POST['teacherLicense'];
        $cdt['disability_status']= $_POST['disabilityStatus'];
 	$cdt['mother_tongue']= $_POST['motherTongue'];
 	$cdt['teaching_lang']= $_POST['teachingLang'];
 	$cdt['first_app_type']= $_POST['t_firstAppType'];
 	$cdt['first_app_year']= $_POST['t_firstAppYear'];
 	$cdt['first_app_month']= $_POST['t_firstAppMonth'];
 	$cdt['first_app_day']= $_POST['t_firstAppDay'];
 	$cdt['first_app_level']= $_POST['t_firstAppLevel'];
        $cdt['first_app_rank']= $_POST['t_firstAppRank'];
 	$cdt['first_app_sec_subject']= $_POST['firstAppSecSubject'];
 	$cdt['teachingSub1']=$_POST['teachingSub1'];
 	$cdt['teachingSub2']=$_POST['teachingSub2'];
        $cdt['curr_perm_type']= $_POST['currPermType'];
 	$cdt['curr_perm_level']= $_POST['currPermLevel'];
 	$cdt['curr_perm_rank']= $_POST['currPermRank'];
        $cdt['head_teacher']= $_POST['t_head_teacher'];
        $cdt['head_teacher_training']= $_POST['headTeachertraining'];
		$cdt['special_promotion']= $_POST['special_promotion'];
	$cdt['current_app_year']= $_POST['current_app_year'];
	$cdt['current_app_month']= $_POST['current_app_month'];
	$cdt['current_app_day']= $_POST['current_app_day'];
	$cdt['bs_dob_year1']= $_POST['bsDobYear1'];
 	$cdt['bs_dob_month1']= $_POST['bsDobMonth1'];
 	$cdt['bs_dob_day1']= $_POST['bsDobDay1'];
 	$cdt['ad_dob_year1']= $_POST['adDobYear1'];
 	$cdt['ad_dob_month1']= $_POST['adDobMonth1'];
 	$cdt['ad_dob_day1']= $_POST['adDobDay1'];
 	$cdt['bs_dob_year2']= $_POST['bsDobYear2'];
 	$cdt['bs_dob_month2']= $_POST['bsDobMonth2'];
 	$cdt['bs_dob_day2']= $_POST['bsDobDay2'];
 	$cdt['ad_dob_year2']= $_POST['adDobYear2'];
 	$cdt['ad_dob_month2']= $_POST['adDobMonth2'];
 	$cdt['ad_dob_day2']= $_POST['adDobDay2'];
 	$cdt['marital_status']= $_POST['maritalStatus'];
 	$cdt['nof_daughter']= $_POST['nofDaughter'];
 	$cdt['nof_son']= $_POST['nofSon'];
 	$cdt['nof_total']= $_POST['nofTotal'];
 	$cdt['citizenship_no']= $_POST['citizenshipNo'];
 	$cdt['citizenship_year']= $_POST['citizenshipYear'];
 	$cdt['citizenship_month']= $_POST['citizenshipMonth'];
 	$cdt['citizenship_day']= $_POST['citizenshipDay'];
 	$cdt['citizenship_dist']= $_POST['citizenshipDistrict'];
 	$cdt['name_father']= $_POST['nameFather'];
 	$cdt['name_mother']= $_POST['nameMother'];
 	$cdt['name_spouse']= $_POST['nameSpouse'];
 	$cdt['name_willper']= $_POST['nameWillper'];
 	$cdt['perm_addr_dist']= $_POST['permAddrDist'];
 	$cdt['perm_addr_vdc']= $_POST['permAddrVdc'];
 	$cdt['perm_addr_ward']= $_POST['permAddrWard'];
 	$cdt['perm_addr_locality']= $_POST['permAddrLocality'];
 	$cdt['perm_addr_house']= $_POST['permAddrHouse'];
 	$cdt['perm_addr_region']= $_POST['permAddrRegion'];
 	$cdt['perm_addr_phone']= $_POST['permAddrPhone'];
 	$cdt['perm_addr_email']= $_POST['permAddrEmail'];
 	$cdt['temp_addr_dist']= $_POST['tempAddrDist'];
 	$cdt['temp_addr_vdc']= $_POST['tempAddrVdc'];
 	$cdt['temp_addr_ward']= $_POST['tempAddrWard'];
 	$cdt['temp_addr_locality']= $_POST['tempAddrLocality'];
 	$cdt['temp_addr_house']= $_POST['tempAddrHouse'];
 	$cdt['temp_addr_region']= $_POST['tempAddrRegion'];
 	$cdt['temp_addr_phone']= $_POST['tempAddrPhone'];
 	$cdt['temp_addr_email']= $_POST['tempAddrEmail'];
 
	mysql_query("DELETE FROM tmis_sec1 WHERE tid='{$cdt['tid']}' AND sch_year='$currentyear'");
	idata('tmis_sec1',$cdt);
}


if ($from == 'tmis_sec2.php'){
	
	mysql_query("DELETE FROM tmis_sec2 WHERE tid='$tid' AND sch_year='$currentyear'");
	
	$dt=array();
	for($k=1;$k<=14;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['SN'.$k];
		$dt['appoint_level']=$_POST['appointLevel'.$k];
		$dt['appoint_rank']=$_POST['appointRank'.$k];
		$dt['appoint_position']=$_POST['appointPosition'.$k];
		$dt['dec_year']=$_POST['decYear'.$k];
		$dt['dec_month']=$_POST['decMonth'.$k];
		$dt['dec_day']=$_POST['decDay'.$k];
		$dt['app_year']=$_POST['appYear'.$k];
		$dt['app_month']=$_POST['appMonth'.$k];
		$dt['app_day']=$_POST['appDay'.$k];
		$dt['app_district']=$_POST['appDistrict'.$k];
		$dt['app_school']=$_POST['appSchool'.$k];
		$dt['subj_sec']=$_POST['subjSec'.$k];
		$dt['appoint_type']=$_POST['appointType'.$k];
		$dt['appoint_type_other']=$_POST['appointTypeOther'.$k];
                
		if($_POST['appointLevel'.$k]!=0) idata('tmis_sec2',$dt);
		unset($dt);
	}
}

if ($from == 'tmis_sec3.php'){
	
	$dt=array();
	mysql_query("DELETE FROM tmis_edu WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=9;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['eduSN'.$k];
		$dt['qualif']=$_POST['eduQualif'.$k];
		$dt['board']=$_POST['eduBoard'.$k];
		$dt['year']=$_POST['eduYear'.$k];
		$dt['division']=$_POST['eduDiv'.$k];
		$dt['stream']=$_POST['eduStream'.$k];
		$dt['subj']=$_POST['eduSubj'.$k];
		$dt['school']=$_POST['eduSchool'.$k];
		$dt['country']=$_POST['eduCountry'.$k];
                $dt['is_education']=$_POST['educationChk'.$k];

		if($_POST['eduQualif'.$k]!='0') idata('tmis_edu',$dt);
		unset($dt);		
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_train WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=7;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['trainSN'.$k];
		$dt['name']=$_POST['trainName'.$k];
		$dt['type']=$_POST['trainTyp'.$k];
		$dt['subj']=$_POST['trainSub'.$k];
		$dt['year']=$_POST['trainYear'.$k];
		$dt['duration']=$_POST['trainDuration'.$k];
		$dt['division']=$_POST['trainDiv'.$k];
		$dt['org']=$_POST['trainOrg'.$k];
		$dt['country']=$_POST['trainCountry'.$k];
		
		if($_POST['trainName'.$k]!=0) idata('tmis_train',$dt);
		unset($dt);		
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_award WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=9;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['awardSN'.$k];
		$dt['rank']=$_POST['awardRank'.$k];
		$dt['type']=$_POST['awardType'.$k];
		$dt['org']=$_POST['awardOrg'.$k];
		$dt['year']=$_POST['awardYear'.$k];
		$dt['month']=$_POST['awardMonth'.$k];
		$dt['day']=$_POST['awardDay'.$k];
		
		if($_POST['awardRank'.$k]!=0) idata('tmis_award',$dt);
		unset($dt);		
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_leave WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=5;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['leaveSN'.$k];
		$dt['type']=$_POST['leaveType'.$k];
		$dt['dist']=$_POST['leaveDist'.$k];
		$dt['school']=$_POST['leaveSchool'.$k];
		$dt['year_from']=$_POST['leaveYearFrom'.$k];
		$dt['month_from']=$_POST['leaveMonthFrom'.$k];
		$dt['day_from']=$_POST['leaveDayFrom'.$k];
		$dt['year_to']=$_POST['leaveYearTo'.$k];
		$dt['month_to']=$_POST['leaveMonthTo'.$k];
		$dt['day_to']=$_POST['leaveDayTo'.$k];
		$dt['dur_year']=$_POST['leaveDurYear'.$k];
		$dt['dur_month']=$_POST['leaveDurMonth'.$k];
		$dt['dur_day']=$_POST['leaveDurDay'.$k];
		$dt['remarks']=$_POST['leaveRemarks'.$k];
		
		if(($_POST['leaveType'.$k]!='')) idata('tmis_leave',$dt);
		unset($dt);		
	}
}


if ($from == 'tmis_sec4.php'){

	$dt=array();
	mysql_query("DELETE FROM tmis_med WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=5;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['medSN'.$k];
		$dt['level']=$_POST['medLevel'.$k];
		$dt['org']=$_POST['medOrg'.$k];
		$dt['year_dec']=$_POST['medYearDec'.$k];
		$dt['month_dec']=$_POST['medMonthDec'.$k];
		$dt['day_dec']=$_POST['medDayDec'.$k];
		$dt['dist']=$_POST['medDist'.$k];
		$dt['amt']=$_POST['medAmt'.$k];
		$dt['year']=$_POST['medYear'.$k];
		$dt['month']=$_POST['medMonth'.$k];
		$dt['day']=$_POST['medDay'.$k];

		if($_POST['medLevel'.$k]!=0) idata('tmis_med',$dt);
		unset($dt);
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_punish WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=5;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['punishSN'.$k];
		$dt['level']=$_POST['punishLevel'.$k];
		$dt['type']=$_POST['punishType'.$k];
		$dt['org']=$_POST['punishOrg'.$k];
		$dt['person']=$_POST['punishPerson'.$k];
		$dt['year']=$_POST['punishYear'.$k];
		$dt['month']=$_POST['punishMonth'.$k];
		$dt['day']=$_POST['punishDay'.$k];

		if($_POST['punishLevel'.$k]!=0) idata('tmis_punish',$dt);
		unset($dt);
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_pub WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=5;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['pubSN'.$k];
		$dt['name']=$_POST['pubName'.$k];
		$dt['year']=$_POST['pubYear'.$k];
		$dt['month']=$_POST['pubMonth'.$k];
		$dt['day']=$_POST['pubDay'.$k];
		$dt['lang']=$_POST['pubLang'.$k];
		$dt['sub']=$_POST['pubSub'.$k];
		$dt['remarks']=$_POST['pubRemarks'.$k];

		if($_POST['pubName'.$k]!='') idata('tmis_pub',$dt);
		unset($dt);
	}

	$dt=array();
	mysql_query("DELETE FROM tmis_inc WHERE tid='$tid' AND sch_year='$currentyear'");
	for($k=1;$k<=5;$k++){
		$dt['tid']=$tid;
		$dt['sch_year']= $currentyear;
		$dt['sn']=$_POST['incSN'.$k];
		$dt['src']=$_POST['incSrc'.$k];
		$dt['scale']=$_POST['incScale'.$k];
		$dt['grade']=$_POST['incGrade'.$k];
		$dt['ta']=$_POST['incTA'.$k];
		$dt['ra']=$_POST['incRA'.$k];
		$dt['ma']=$_POST['incMA'.$k];
		$dt['mahangi']=$_POST['incMahangi'.$k];
		$dt['insurance']=$_POST['incInsurance'.$k];
		$dt['festival']=$_POST['incFestival'.$k];
		$dt['civil_investment']=$_POST['incCivil'.$k];
		$dt['dress']=$_POST['incDress'.$k];
		$dt['total']=$_POST['incTotal'.$k];
		
		if($_POST['incSrc'.$k]!="") idata('tmis_inc',$dt);
		unset($dt);
	}
}


/*
 * 
// update select item data

update_select_data("nationality","tmis_sec1","nationality");
update_select_data("caste","tmis_sec1","caste");
update_select_data("language","tmis_sec1","mother_tongue");
update_select_data("language","tmis_sec1","teaching_lang");
update_select_data("subject","tmis_sec1","first_app_sec_subject");
update_select_data("subject","tmis_sec1","teachingSub1");
update_select_data("subject","tmis_sec1","teachingSub2");
update_select_data("vdc","tmis_sec1","perm_addr_vdc");
update_select_data("vdc","tmis_sec1","temp_addr_vdc");

update_select_data("subject","tmis_sec2","subj_sec");

update_select_data("board","tmis_edu","board");
update_select_data("stream","tmis_edu","stream");
update_select_data("subject","tmis_edu","subj");
update_select_data("univ","tmis_edu","school");
update_select_data("country","tmis_edu","country");
update_select_data("train","tmis_train","train");
update_select_data("country","tmis_train","country");
update_select_data("award","tmis_award","type");
update_select_data("org","tmis_award","org");
update_select_data("leave","tmis_leave","type");

update_select_data("medorg","tmis_med","org");
update_select_data("type","tmis_punish","punish");
update_select_data("org","tmis_punish","org");

update_select_data("language","tmis_pub","lang");
update_select_data("subject","tmis_pub","sub");

update_select_data("income","tmis_inc","src");


function update_select_data($id, $table, $column){
	
	$file_contents = file_get_contents("data/$id");
	$data = array();
	$data = explode("\n",$file_contents);
	
	$result = mysql_query("SELECT DISTINCT($column) as c FROM $table");
	while ($row = mysql_fetch_assoc($result)){
		$data[] = $row["c"];
	}
	
	file_put_contents("data/$id", implode("\n",$data));
	
}

*/



