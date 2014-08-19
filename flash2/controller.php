<?php

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

$from = $_POST['referer'];
$schoolcode = $_POST['schoolcode'];

//echo2file($from);
//echo2file(print_r($_POST,true));

if ($from == 'basicinfo.php'){
	
	$result = mysql_query("select * from mast_schoollist where sch_num='$schoolcode' order by sch_year desc");
	$row = mysql_fetch_array($result);
	
	$dcode = $row['dist_code'];
	$vcode = $row['vdc_code'];
	$scode = $row['sch_code'];
	$nm_sch = $row['nm_sch'];	

	// 
	$dt=array();
	$dt['sch_year']=$currentyear;
	
	$dt['dist_code']=$dcode;
	$dt['vdc_code']=$vcode;
	$dt['sch_code']=$scode;
	
	$dt['nm_sch']=$nm_sch;	
	
	$dt['estd_date']="{$_POST['estd_y']}-{$_POST['estd_m']}-{$_POST['estd_d']}";
	$dt['location']=$_POST['sch_add'];
	$dt['wardno']=$_POST['sch_ward'];
	$dt['region']=$_POST['sch_region'];
	$dt['telno']=$_POST['sch_phone'];
	$dt['email']=$_POST['sch_email'];
	$dt['account_no']=$_POST['account_no'];
	
	$dt['sch_num']=$schoolcode;
	$dt['flash2']=1;
	$dt['entry_timestamp'] = date("Y-m-d H:i:s");
	
	// update data
	$updatelist = array();
	foreach ($dt as $k=>$v){
		if ($k=='sch_year' || $k=='sch_num') continue;
		$updatelist[] = "`$k`=\"$v\"";
	}
	$query = "UPDATE mast_schoollist SET ".implode(",",$updatelist)." WHERE sch_year='$currentyear' AND sch_num='$schoolcode'";
	mysql_query($query);


	/*
	mysql_query("delete from mast_schoollist where sch_num='".$dt['sch_num']."' and sch_year='$currentyear'");
	idata('mast_schoollist',$dt);
	*/
	
	
	//
	// MODIFICATION : CLASS DATA WONT BE MODIFIED IN FLASH II
	//
	
	/*
	
	// class data
	$cdt=array();
	$cdt['sch_num']=$dt['sch_num'];
	$cdt['sch_year']=$currentyear;
		
	for ($i=0;$i<=12;$i++){ // class
		$t=0;
		for ($j=1;$j<=12;$j++){ // school type
			if ($_POST['st_'.$j.'_'.$i]){
				$t=$j;
				break;
			}
			
		}
		if ($i==0) // ecd
			$cdt['ecd']=$t;
		else
			$cdt['class'.$i]=$t;
	}
	
	$cdt['flash']=2;
	
	mysql_query("delete from mast_school_type where sch_num='".$dt['sch_num']."' and sch_year='$currentyear' and flash='2'");
	idata('mast_school_type',$cdt);
	
	*/

}


if ($from=='enrollment.php'){
	
	// smc data
	$smcdt = array();
	$smcdt['sch_num']=$schoolcode;
	$smcdt['sch_year']=$currentyear;
	
	$smcdt['smc_year']=$_POST['smc_y'];
	$smcdt['smc_month']=$_POST['smc_m'];
	$smcdt['smc_day']=$_POST['smc_d'];
	$smcdt['election']=($_POST['smc_method']==2?'1':'0');
	$smcdt['selection']=($_POST['smc_method']==1?'1':'0');
	
	$smcdt['tot_members']=$_POST['smc_tot_t'];
	$smcdt['tot_f']=$_POST['smc_tot_f'];
	$smcdt['tot_m']=$_POST['smc_tot_t']-$_POST['smc_tot_f'];
	$smcdt['tot_dalit']=$_POST['smc_tot_d'];
	$smcdt['tot_janjati']=$_POST['smc_tot_j'];
	
	mysql_query("delete from inf_sch_smc where sch_num='$schoolcode' and sch_year='$currentyear'");
	idata('inf_sch_smc',$smcdt);
	
	// pta info
	$ptadt = array();
	$ptadt['sch_num']=$schoolcode;
	$ptadt['sch_year']=$currentyear;
	
	$ptadt['pta_year']=$_POST['pta_y'];
	$ptadt['pta_month']=$_POST['pta_m'];
	$ptadt['pta_day']=$_POST['pta_d'];
	$ptadt['election']=($_POST['pta_method']==2?'1':'0');
	$ptadt['selection']=($_POST['pta_method']==1?'1':'0');
	
	$ptadt['tot_members']=$_POST['pta_tot_t'];
	$ptadt['tot_f']=$_POST['pta_tot_f'];
	$ptadt['tot_m']=$_POST['pta_tot_t']-$_POST['pta_tot_f'];
	$ptadt['tot_dalit']=$_POST['pta_tot_d'];
	$ptadt['tot_janjati']=$_POST['pta_tot_j'];
	
	mysql_query("delete from inf_sch_pta where sch_num='$schoolcode' and sch_year='$currentyear'");
	idata('inf_sch_pta',$ptadt);	
	
	// class 1-12 enrollment data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	for ($i=1;$i<=12;$i++){
		
		if ($i>=1 && $i<=5) $table = 'class1_5_enroll_app';
		if ($i>=6 && $i<=8) $table = 'class6_8_enroll_app';
		if ($i>=9 && $i<=10) $table = 'class9_10_enroll_app';
		if ($i>=11 && $i<=12) $table = 'class11_12_enroll_app';
		
		if ($_POST["t_e_t"][$i]==0) continue; // no data for that class
		
		$dt['class']=$i;
		$dt['tot_enroll_total_f']=$_POST["t_e_g"][$i];
		$dt['tot_enroll_total_m']=$_POST["t_e_b"][$i];
		$dt['tot_enroll_total_t']=$_POST["t_e_t"][$i];
		$dt['tot_appeared_exam_total_f']=$_POST["t_a_g"][$i];
		$dt['tot_appeared_exam_total_m']=$_POST["t_a_b"][$i];
		$dt['tot_appeared_exam_total_t']=$_POST["t_a_t"][$i];
		$dt['tot_enroll_dalit_f']=$_POST["d_e_g"][$i];
		$dt['tot_enroll_dalit_m']=$_POST["d_e_b"][$i];
		$dt['tot_enroll_dalit_t']=$_POST["d_e_t"][$i];
		$dt['tot_appeared_exam_dalit_f']=$_POST["d_a_g"][$i];
		$dt['tot_appeared_exam_dalit_m']=$_POST["d_a_b"][$i];
		$dt['tot_appeared_exam_dalit_t']=$_POST["d_a_t"][$i];
		$dt['tot_enroll_janjati_f']=$_POST["j_e_g"][$i];
		$dt['tot_enroll_janjati_m']=$_POST["j_e_b"][$i];
		$dt['tot_enroll_janjati_t']=$_POST["j_e_t"][$i];
		$dt['tot_appeared_exam_janjati_f']=$_POST["j_a_g"][$i];
		$dt['tot_appeared_exam_janjati_m']=$_POST["j_a_b"][$i];
		$dt['tot_appeared_exam_janjati_t']=$_POST["j_a_t"][$i];
		
		mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear' and class='$i'");
		idata($table,$dt);
	}
	
	// attendance
	mysql_query("delete from attendance where sch_num='$schoolcode' and sch_year='$currentyear'");
	$adt=array();
	
	for ($i=1;$i<=3;$i++){
		if ($i==1) $dte="1";
		if ($i==2) $dte="2";
		if ($i==3) $dte="3";
		
		if ($_POST["enr_".$i."_tot"]==0) continue;
		
		$adt['sch_num']=$schoolcode;
		$adt['sch_year']=$currentyear;
		$adt['attendance_date']=$dte;
		$adt['ecd']=$_POST["enr_".$i."_0"];
		for ($cl=1;$cl<=12;$cl++){
			$adt["class$cl"]=$_POST["enr_".$i."_".$cl];
		}
		
		idata('attendance',$adt);
		
	}
}
if($from == 'avgmarks.php'){
    
    mysql_query("delete from pr_scores where sch_num='$schoolcode' and sch_year='$currentyear'");	
    mysql_query("delete from lsec_scores where sch_num='$schoolcode' and sch_year='$currentyear'");	
    mysql_query("delete from sec_scores where sch_num='$schoolcode' and sch_year='$currentyear'");	
    
    $dt=array();
    $dt['sch_num']=$schoolcode;
    $dt['sch_year']=$currentyear;
    for ($i=1;$i<=10;$i++){		
	if ($i>=1 && $i<=5) {$table = 'pr_scores'; $subcount=6;}
	if ($i>=6 && $i<=8) {$table = 'lsec_scores'; $subcount=9;}
	if ($i>=9 && $i<=10) {$table = 'sec_scores'; $subcount=6;}
        
         $dt['class']=$i;
         for($sub=1;$sub<=$subcount;$sub++)
         {
              $sex=$dt['sex']="F";
              $dt['subject_id']=$sub;
              $dt['total']=$_POST["sch_g_".$i][$sub];
              
              if($_POST["sch_g_".$i][$sub]==NULL)   continue;
              
              //mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear' and class='$i' and subject_id='$sub' and sex='$sex'");	
              idata($table,$dt);
             
              $sex=$dt['sex']="M";
              $dt['subject_id']=$sub;
              $dt['total']=$_POST["sch_b_".$i][$sub];
              
              if($_POST["sch_g_".$i][$sub]==NULL)   continue;
               
              //mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear' and class='$i' and subject_id='$sub' and sex='$sex'");	
              idata($table,$dt);
         }
		  $dt['class']=$i;
         for($sub=1;$sub<=$subcount;$sub++)
         {
              $sex=$dt['sex']="M";
              $dt['subject_id']=$sub;
              $dt['total']=$_POST["sch_b_".$i][$sub];
              
              if($_POST["sch_b_".$i][$sub]==NULL)   continue;
              
              //mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear' and class='$i' and subject_id='$sub' and sex='$sex'");	
              idata($table,$dt);
             
              $sex=$dt['sex']="F";
              $dt['subject_id']=$sub;
              $dt['total']=$_POST["sch_g_".$i][$sub];
              
              if($_POST["sch_b_".$i][$sub]==NULL)   continue;
               
              //mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear' and class='$i' and subject_id='$sub' and sex='$sex'");	
              idata($table,$dt);
         }
    }
}
if ($from=='scholarship.php'){
	
	// class 1-5 scholarship
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from pr_scholarship where sch_num='$schoolcode' and sch_year='$currentyear'");	
	
	for ($schid=1;$schid<=9;$schid++){
		for ($cl=1;$cl<=5;$cl++){
			
			if ($_POST['sch_t_'.$cl][$schid]==0) continue;
			
			$dt['class']=$cl;
			$dt['scholarship_type_id']=$schid;
			$dt['female']=$_POST['sch_g_'.$cl][$schid];
			$dt['male']=$_POST['sch_b_'.$cl][$schid];
			$dt['total']=$_POST['sch_t_'.$cl][$schid];
			
			idata('pr_scholarship',$dt);
			
		}
	}
	
	// lss scholarship
	mysql_query("delete from lss_scholarship where sch_num='$schoolcode' and sch_year='$currentyear'");	
	
	for ($schid=1;$schid<=11;$schid++){
		for ($cl=6;$cl<=10;$cl++){
			if ($_POST['sch_t_'.$cl][$schid]==0) continue;
			
			$dt['class']=$cl;
			$dt['scholarship_type_id']=$schid;
			$dt['female']=$_POST['sch_g_'.$cl][$schid];
			$dt['male']=$_POST['sch_b_'.$cl][$schid];
			$dt['total']=$_POST['sch_t_'.$cl][$schid];
			
			idata('lss_scholarship',$dt);
			
		}
	}
	
}

if ($from == 'teachers.php'){
	
	
	// headmaster
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	mysql_query("delete from headmaster where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt['headmaster']=$_POST['headmaster_sex'];
	$dt['hmaster_status']=$_POST['headmaster_caste'];
	$dt['hmaster_initial_status']=$_POST['headmaster_initial_status'];
	$dt['hmaster_training']=$_POST['headmaster_training'];
	
	if (!checkblank($dt)) idata('headmaster',$dt,'sch_num');
	
	unset($dt);
	
	// pcf
	mysql_query("delete from teachers_pcf where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['pcf_full_pri']=$_POST['pcf_full_pri'];
	$dt['pcf_full_lsec']=$_POST['pcf_full_lsec'];
	$dt['pcf_par_pri']=$_POST['pcf_par_pri'];
	$dt['pcf_par_lsec']=$_POST['pcf_par_lsec'];
	
	if (!checkblank($dt)) {
		idata('teachers_pcf',$dt,'sch_num');
	}
	unset($dt);
	
	
	// teacher licensed
	mysql_query("delete from teachers_licensed where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['pri_f']=$_POST['pri_f'];
	$dt['pri_m']=$_POST['pri_m'];
	$dt['pri_t']=$_POST['pri_t'];
	$dt['lsec_f']=$_POST['lsec_f'];
	$dt['lsec_m']=$_POST['lsec_m'];
	$dt['lsec_t']=$_POST['lsec_t'];
	$dt['sec_f']=$_POST['sec_f'];
	$dt['sec_m']=$_POST['sec_m'];
	$dt['sec_t']=$_POST['sec_t'];
	$dt['hsec_f']=$_POST['hsec_f'];
	$dt['hsec_m']=$_POST['hsec_m'];
	$dt['hsec_t']=$_POST['hsec_t'];	
	
	if (!checkblank($dt)) {
		idata('teachers_licensed',$dt,'sch_num');
	}
	unset($dt);
	
	
	// teachers
	mysql_query("delete from teachers where sch_num='$schoolcode' and sch_year='$currentyear'");
	foreach (array("approved","permanent","temporary","rahat","private","total") as $type){
		foreach (array(1,2,3,4) as $level){
			$dt = array();
                        $flag=0;
			$dt['sch_num']=$schoolcode;
			$dt['sch_year']=$currentyear;
			$dt['type']	= $type;
			$dt['level']	= $level;
			
			foreach (array("total","female", "male","dalit","janjati","disabled") as $category){
                            $id = "{$type}_{$category}";
                            if(isset($_POST[$id][$level]) AND $_POST[$id][$level]>0)
                            {
				$dt[$category] = $_POST[$id][$level];
                                $flag=1;
                            }
			}
			if (!checkblank($dt) AND $flag) {
				idata('teachers',$dt,'sch_num');
			}
			unset($dt);			
		}
	}
	

	// teachers education

	mysql_query("delete from teachers_edu where sch_num='$schoolcode' and sch_year='$currentyear'");
	foreach (array(1,2,3,4) as $level){
	

		$dt = array();
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;
		$dt['level']	= $level;
		
		foreach (array("under_slc"=>"Under SLC","slc"=>"SLC","ia"=>"IA","ba"=>"BA","ma"=>"MA","phd"=>"PhD") as $type=>$label){

		
			foreach (array("f","m", "t") as $category){
				$id = "{$type}_{$category}";
				$dt["{$type}_{$category}"] = $_POST[$id][$level];
				
			}
			
		}
		if (!checkblank($dt)) {
			idata('teachers_edu',$dt,'sch_num');
		}
		unset($dt);			
	}	
	

}

if ($from=='teacher_training.php'){
	//primary
	mysql_query("delete from pri_teacher_training where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['fully_trained_total_f']=$_POST['pri_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['pri_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['pri_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['pri_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['pri_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['pri_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['pri_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['pri_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['pri_fully_trained_janjati_t'];
        $dt['fully_trained_currentyear_f']=$_POST['pri_fully_trained_current_f'];
	$dt['fully_trained_currentyear_m']=$_POST['pri_fully_trained_current_m'];
	$dt['fully_trained_currentyear_t']=$_POST['pri_fully_trained_current_t'];
        
        $dt['tpd1_trained_total_f']=$_POST['pri_tpd1_trained_total_f'];
	$dt['tpd1_trained_total_m']=$_POST['pri_tpd1_trained_total_m'];
	$dt['tpd1_trained_total_t']=$_POST['pri_tpd1_trained_total_t'];
	$dt['tpd1_trained_dalit_f']=$_POST['pri_tpd1_trained_dalit_f'];
	$dt['tpd1_trained_dalit_m']=$_POST['pri_tpd1_trained_dalit_m'];
	$dt['tpd1_trained_dalit_t']=$_POST['pri_tpd1_trained_dalit_t'];
	$dt['tpd1_trained_janjati_f']=$_POST['pri_tpd1_trained_janjati_f'];
	$dt['tpd1_trained_janjati_m']=$_POST['pri_tpd1_trained_janjati_m'];
	$dt['tpd1_trained_janjati_t']=$_POST['pri_tpd1_trained_janjati_t'];
        $dt['tpd1_trained_currentyear_f']=$_POST['pri_tpd1_trained_current_f'];
	$dt['tpd1_trained_currentyear_m']=$_POST['pri_tpd1_trained_current_m'];
	$dt['tpd1_trained_currentyear_t']=$_POST['pri_tpd1_trained_current_t'];
        
        $dt['tpd2_trained_total_f']=$_POST['pri_tpd2_trained_total_f'];
	$dt['tpd2_trained_total_m']=$_POST['pri_tpd2_trained_total_m'];
	$dt['tpd2_trained_total_t']=$_POST['pri_tpd2_trained_total_t'];
	$dt['tpd2_trained_dalit_f']=$_POST['pri_tpd2_trained_dalit_f'];
	$dt['tpd2_trained_dalit_m']=$_POST['pri_tpd2_trained_dalit_m'];
	$dt['tpd2_trained_dalit_t']=$_POST['pri_tpd2_trained_dalit_t'];
	$dt['tpd2_trained_janjati_f']=$_POST['pri_tpd2_trained_janjati_f'];
	$dt['tpd2_trained_janjati_m']=$_POST['pri_tpd2_trained_janjati_m'];
	$dt['tpd2_trained_janjati_t']=$_POST['pri_tpd2_trained_janjati_t'];
        $dt['tpd2_trained_currentyear_f']=$_POST['pri_tpd2_trained_current_f'];
	$dt['tpd2_trained_currentyear_m']=$_POST['pri_tpd2_trained_current_m'];
	$dt['tpd2_trained_currentyear_t']=$_POST['pri_tpd2_trained_current_t'];
        
        $dt['tpd3_trained_total_f']=$_POST['pri_tpd3_trained_total_f'];
	$dt['tpd3_trained_total_m']=$_POST['pri_tpd3_trained_total_m'];
	$dt['tpd3_trained_total_t']=$_POST['pri_tpd3_trained_total_t'];
	$dt['tpd3_trained_dalit_f']=$_POST['pri_tpd3_trained_dalit_f'];
	$dt['tpd3_trained_dalit_m']=$_POST['pri_tpd3_trained_dalit_m'];
	$dt['tpd3_trained_dalit_t']=$_POST['pri_tpd3_trained_dalit_t'];
	$dt['tpd3_trained_janjati_f']=$_POST['pri_tpd3_trained_janjati_f'];
	$dt['tpd3_trained_janjati_m']=$_POST['pri_tpd3_trained_janjati_m'];
	$dt['tpd3_trained_janjati_t']=$_POST['pri_tpd3_trained_janjati_t'];
        $dt['tpd3_trained_currentyear_f']=$_POST['pri_tpd3_trained_current_f'];
	$dt['tpd3_trained_currentyear_m']=$_POST['pri_tpd3_trained_current_m'];
	$dt['tpd3_trained_currentyear_t']=$_POST['pri_tpd3_trained_current_t'];
        
        /*
	$dt['hour_trained_total_f']=$_POST['pri_hour_trained_total_f'];
	$dt['hour_trained_total_m']=$_POST['pri_hour_trained_total_m'];
	$dt['hour_trained_total_t']=$_POST['pri_hour_trained_total_t'];
	$dt['hour_trained_dalit_f']=$_POST['pri_hour_trained_dalit_f'];
	$dt['hour_trained_dalit_m']=$_POST['pri_hour_trained_dalit_m'];
	$dt['hour_trained_dalit_t']=$_POST['pri_hour_trained_dalit_t'];
	$dt['hour_trained_janjati_f']=$_POST['pri_hour_trained_janjati_f'];
	$dt['hour_trained_janjati_m']=$_POST['pri_hour_trained_janjati_m'];
	$dt['hour_trained_janjati_t']=$_POST['pri_hour_trained_janjati_t'];
	$dt['first_package_total_f']=$_POST['pri_first_package_total_f'];
	$dt['first_package_total_m']=$_POST['pri_first_package_total_m'];
	$dt['first_package_total_t']=$_POST['pri_first_package_total_t'];
	$dt['first_package_dalit_f']=$_POST['pri_first_package_dalit_f'];
	$dt['first_package_dalit_m']=$_POST['pri_first_package_dalit_m'];
	$dt['first_package_dalit_t']=$_POST['pri_first_package_dalit_t'];
	$dt['first_package_janjati_f']=$_POST['pri_first_package_janjati_f'];
	$dt['first_package_janjati_m']=$_POST['pri_first_package_janjati_m'];
	$dt['first_package_janjati_t']=$_POST['pri_first_package_janjati_t'];
	$dt['second_package_total_f']=$_POST['pri_second_package_total_f'];
	$dt['second_package_total_m']=$_POST['pri_second_package_total_m'];
	$dt['second_package_total_t']=$_POST['pri_second_package_total_t'];
	$dt['second_package_dalit_f']=$_POST['pri_second_package_dalit_f'];
	$dt['second_package_dalit_m']=$_POST['pri_second_package_dalit_m'];
	$dt['second_package_dalit_t']=$_POST['pri_second_package_dalit_t'];
	$dt['second_package_janjati_f']=$_POST['pri_second_package_janjati_f'];
	$dt['second_package_janjati_m']=$_POST['pri_second_package_janjati_m'];
	$dt['second_package_janjati_t']=$_POST['pri_second_package_janjati_t'];
	$dt['untrained_total_f']=$_POST['pri_untrained_total_f'];
         * 
         */
        
        $dt['untrained_total_f']=$_POST['pri_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['pri_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['pri_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['pri_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['pri_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['pri_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['pri_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['pri_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['pri_untrained_janjati_t'];
        $dt['untrained_currentyear_f']=$_POST['pri_untrained_current_f'];
	$dt['untrained_currentyear_m']=$_POST['pri_untrained_current_m'];
	$dt['untrained_currentyear_t']=$_POST['pri_untrained_current_t'];
        
	
	if (!checkblank($dt)) idata('pri_teacher_training',$dt,'sch_num');
	
	unset($dt);
	
	
	// lsec
	mysql_query("delete from lsec_teacher_training where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
        
        $dt['fully_trained_total_f']=$_POST['lsec_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['lsec_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['lsec_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['lsec_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['lsec_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['lsec_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['lsec_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['lsec_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['lsec_fully_trained_janjati_t'];
        $dt['fully_trained_currentyear_f']=$_POST['lsec_fully_trained_current_f'];
	$dt['fully_trained_currentyear_m']=$_POST['lsec_fully_trained_current_m'];
	$dt['fully_trained_currentyear_t']=$_POST['lsec_fully_trained_current_t'];
        
        $dt['tpd1_trained_total_f']=$_POST['lsec_tpd1_trained_total_f'];
	$dt['tpd1_trained_total_m']=$_POST['lsec_tpd1_trained_total_m'];
	$dt['tpd1_trained_total_t']=$_POST['lsec_tpd1_trained_total_t'];
	$dt['tpd1_trained_dalit_f']=$_POST['lsec_tpd1_trained_dalit_f'];
	$dt['tpd1_trained_dalit_m']=$_POST['lsec_tpd1_trained_dalit_m'];
	$dt['tpd1_trained_dalit_t']=$_POST['lsec_tpd1_trained_dalit_t'];
	$dt['tpd1_trained_janjati_f']=$_POST['lsec_tpd1_trained_janjati_f'];
	$dt['tpd1_trained_janjati_m']=$_POST['lsec_tpd1_trained_janjati_m'];
	$dt['tpd1_trained_janjati_t']=$_POST['lsec_tpd1_trained_janjati_t'];
        $dt['tpd1_trained_currentyear_f']=$_POST['lsec_tpd1_trained_current_f'];
	$dt['tpd1_trained_currentyear_m']=$_POST['lsec_tpd1_trained_current_m'];
	$dt['tpd1_trained_currentyear_t']=$_POST['lsec_tpd1_trained_current_t'];
        
        $dt['tpd2_trained_total_f']=$_POST['lsec_tpd2_trained_total_f'];
	$dt['tpd2_trained_total_m']=$_POST['lsec_tpd2_trained_total_m'];
	$dt['tpd2_trained_total_t']=$_POST['lsec_tpd2_trained_total_t'];
	$dt['tpd2_trained_dalit_f']=$_POST['lsec_tpd2_trained_dalit_f'];
	$dt['tpd2_trained_dalit_m']=$_POST['lsec_tpd2_trained_dalit_m'];
	$dt['tpd2_trained_dalit_t']=$_POST['lsec_tpd2_trained_dalit_t'];
	$dt['tpd2_trained_janjati_f']=$_POST['lsec_tpd2_trained_janjati_f'];
	$dt['tpd2_trained_janjati_m']=$_POST['lsec_tpd2_trained_janjati_m'];
	$dt['tpd2_trained_janjati_t']=$_POST['lsec_tpd2_trained_janjati_t'];
        $dt['tpd2_trained_currentyear_f']=$_POST['lsec_tpd2_trained_current_f'];
	$dt['tpd2_trained_currentyear_m']=$_POST['lsec_tpd2_trained_current_m'];
	$dt['tpd2_trained_currentyear_t']=$_POST['lsec_tpd2_trained_current_t'];
        
        $dt['tpd3_trained_total_f']=$_POST['lsec_tpd3_trained_total_f'];
	$dt['tpd3_trained_total_m']=$_POST['lsec_tpd3_trained_total_m'];
	$dt['tpd3_trained_total_t']=$_POST['lsec_tpd3_trained_total_t'];
	$dt['tpd3_trained_dalit_f']=$_POST['lsec_tpd3_trained_dalit_f'];
	$dt['tpd3_trained_dalit_m']=$_POST['lsec_tpd3_trained_dalit_m'];
	$dt['tpd3_trained_dalit_t']=$_POST['lsec_tpd3_trained_dalit_t'];
	$dt['tpd3_trained_janjati_f']=$_POST['lsec_tpd3_trained_janjati_f'];
	$dt['tpd3_trained_janjati_m']=$_POST['lsec_tpd3_trained_janjati_m'];
	$dt['tpd3_trained_janjati_t']=$_POST['lsec_tpd3_trained_janjati_t'];
        $dt['tpd3_trained_currentyear_f']=$_POST['lsec_tpd3_trained_current_f'];
	$dt['tpd3_trained_currentyear_m']=$_POST['lsec_tpd3_trained_current_m'];
	$dt['tpd3_trained_currentyear_t']=$_POST['lsec_tpd3_trained_current_t'];
        
        $dt['untrained_total_f']=$_POST['lsec_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['lsec_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['lsec_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['lsec_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['lsec_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['lsec_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['lsec_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['lsec_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['lsec_untrained_janjati_t'];
        $dt['untrained_currentyear_f']=$_POST['lsec_untrained_current_f'];
	$dt['untrained_currentyear_m']=$_POST['lsec_untrained_current_m'];
	$dt['untrained_currentyear_t']=$_POST['lsec_untrained_current_t'];
        
        /*    
	$dt['fully_trained_total_f']=$_POST['lsec_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['lsec_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['lsec_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['lsec_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['lsec_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['lsec_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['lsec_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['lsec_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['lsec_fully_trained_janjati_t'];
	$dt['first_package_total_f']=$_POST['lsec_first_package_total_f'];
	$dt['first_package_total_m']=$_POST['lsec_first_package_total_m'];
	$dt['first_package_total_t']=$_POST['lsec_first_package_total_t'];
	$dt['first_package_dalit_f']=$_POST['lsec_first_package_dalit_f'];
	$dt['first_package_dalit_m']=$_POST['lsec_first_package_dalit_m'];
	$dt['first_package_dalit_t']=$_POST['lsec_first_package_dalit_t'];
	$dt['first_package_janjati_f']=$_POST['lsec_first_package_janjati_f'];
	$dt['first_package_janjati_m']=$_POST['lsec_first_package_janjati_m'];
	$dt['first_package_janjati_t']=$_POST['lsec_first_package_janjati_t'];
	$dt['second_package_total_f']=$_POST['lsec_second_package_total_f'];
	$dt['second_package_total_m']=$_POST['lsec_second_package_total_m'];
	$dt['second_package_total_t']=$_POST['lsec_second_package_total_t'];
	$dt['second_package_dalit_f']=$_POST['lsec_second_package_dalit_f'];
	$dt['second_package_dalit_m']=$_POST['lsec_second_package_dalit_m'];
	$dt['second_package_dalit_t']=$_POST['lsec_second_package_dalit_t'];
	$dt['second_package_janjati_f']=$_POST['lsec_second_package_janjati_f'];
	$dt['second_package_janjati_m']=$_POST['lsec_second_package_janjati_m'];
	$dt['second_package_janjati_t']=$_POST['lsec_second_package_janjati_t'];
	$dt['third_package_total_f']=$_POST['lsec_third_package_total_f'];
	$dt['third_package_total_m']=$_POST['lsec_third_package_total_m'];
	$dt['third_package_total_t']=$_POST['lsec_third_package_total_t'];
	$dt['third_package_dalit_f']=$_POST['lsec_third_package_dalit_f'];
	$dt['third_package_dalit_m']=$_POST['lsec_third_package_dalit_m'];
	$dt['third_package_dalit_t']=$_POST['lsec_third_package_dalit_t'];
	$dt['third_package_janjati_f']=$_POST['lsec_third_package_janjati_f'];
	$dt['third_package_janjati_m']=$_POST['lsec_third_package_janjati_m'];
	$dt['third_package_janjati_t']=$_POST['lsec_third_package_janjati_t'];
	$dt['untrained_total_f']=$_POST['lsec_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['lsec_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['lsec_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['lsec_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['lsec_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['lsec_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['lsec_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['lsec_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['lsec_untrained_janjati_t'];
	*/
	if (!checkblank($dt)) idata('lsec_teacher_training',$dt,'sch_num');
	
	unset($dt);


	// sec
	mysql_query("delete from sec_teacher_training where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
        
        $dt['fully_trained_total_f']=$_POST['sec_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['sec_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['sec_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['sec_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['sec_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['sec_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['sec_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['sec_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['sec_fully_trained_janjati_t'];
        $dt['fully_trained_currentyear_f']=$_POST['sec_fully_trained_current_f'];
	$dt['fully_trained_currentyear_m']=$_POST['sec_fully_trained_current_m'];
	$dt['fully_trained_currentyear_t']=$_POST['sec_fully_trained_current_t'];
        
        $dt['tpd1_trained_total_f']=$_POST['sec_tpd1_trained_total_f'];
	$dt['tpd1_trained_total_m']=$_POST['sec_tpd1_trained_total_m'];
	$dt['tpd1_trained_total_t']=$_POST['sec_tpd1_trained_total_t'];
	$dt['tpd1_trained_dalit_f']=$_POST['sec_tpd1_trained_dalit_f'];
	$dt['tpd1_trained_dalit_m']=$_POST['sec_tpd1_trained_dalit_m'];
	$dt['tpd1_trained_dalit_t']=$_POST['sec_tpd1_trained_dalit_t'];
	$dt['tpd1_trained_janjati_f']=$_POST['sec_tpd1_trained_janjati_f'];
	$dt['tpd1_trained_janjati_m']=$_POST['sec_tpd1_trained_janjati_m'];
	$dt['tpd1_trained_janjati_t']=$_POST['sec_tpd1_trained_janjati_t'];
        $dt['tpd1_trained_currentyear_f']=$_POST['sec_tpd1_trained_current_f'];
	$dt['tpd1_trained_currentyear_m']=$_POST['sec_tpd1_trained_current_m'];
	$dt['tpd1_trained_currentyear_t']=$_POST['sec_tpd1_trained_current_t'];
        
        $dt['tpd2_trained_total_f']=$_POST['sec_tpd2_trained_total_f'];
	$dt['tpd2_trained_total_m']=$_POST['sec_tpd2_trained_total_m'];
	$dt['tpd2_trained_total_t']=$_POST['sec_tpd2_trained_total_t'];
	$dt['tpd2_trained_dalit_f']=$_POST['sec_tpd2_trained_dalit_f'];
	$dt['tpd2_trained_dalit_m']=$_POST['sec_tpd2_trained_dalit_m'];
	$dt['tpd2_trained_dalit_t']=$_POST['sec_tpd2_trained_dalit_t'];
	$dt['tpd2_trained_janjati_f']=$_POST['sec_tpd2_trained_janjati_f'];
	$dt['tpd2_trained_janjati_m']=$_POST['sec_tpd2_trained_janjati_m'];
	$dt['tpd2_trained_janjati_t']=$_POST['sec_tpd2_trained_janjati_t'];
        $dt['tpd2_trained_currentyear_f']=$_POST['sec_tpd2_trained_current_f'];
	$dt['tpd2_trained_currentyear_m']=$_POST['sec_tpd2_trained_current_m'];
	$dt['tpd2_trained_currentyear_t']=$_POST['sec_tpd2_trained_current_t'];
        
        $dt['tpd3_trained_total_f']=$_POST['sec_tpd3_trained_total_f'];
	$dt['tpd3_trained_total_m']=$_POST['sec_tpd3_trained_total_m'];
	$dt['tpd3_trained_total_t']=$_POST['sec_tpd3_trained_total_t'];
	$dt['tpd3_trained_dalit_f']=$_POST['sec_tpd3_trained_dalit_f'];
	$dt['tpd3_trained_dalit_m']=$_POST['sec_tpd3_trained_dalit_m'];
	$dt['tpd3_trained_dalit_t']=$_POST['sec_tpd3_trained_dalit_t'];
	$dt['tpd3_trained_janjati_f']=$_POST['sec_tpd3_trained_janjati_f'];
	$dt['tpd3_trained_janjati_m']=$_POST['sec_tpd3_trained_janjati_m'];
	$dt['tpd3_trained_janjati_t']=$_POST['sec_tpd3_trained_janjati_t'];
        $dt['tpd3_trained_currentyear_f']=$_POST['sec_tpd3_trained_current_f'];
	$dt['tpd3_trained_currentyear_m']=$_POST['sec_tpd3_trained_current_m'];
	$dt['tpd3_trained_currentyear_t']=$_POST['sec_tpd3_trained_current_t'];
        
        $dt['untrained_total_f']=$_POST['sec_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['sec_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['sec_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['sec_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['sec_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['sec_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['sec_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['sec_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['sec_untrained_janjati_t'];
        $dt['untrained_currentyear_f']=$_POST['sec_untrained_current_f'];
	$dt['untrained_currentyear_m']=$_POST['sec_untrained_current_m'];
	$dt['untrained_currentyear_t']=$_POST['sec_untrained_current_t'];
        
        
        /*
	$dt['fully_trained_total_f']=$_POST['sec_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['sec_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['sec_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['sec_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['sec_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['sec_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['sec_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['sec_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['sec_fully_trained_janjati_t'];
	$dt['first_package_total_f']=$_POST['sec_first_package_total_f'];
	$dt['first_package_total_m']=$_POST['sec_first_package_total_m'];
	$dt['first_package_total_t']=$_POST['sec_first_package_total_t'];
	$dt['first_package_dalit_f']=$_POST['sec_first_package_dalit_f'];
	$dt['first_package_dalit_m']=$_POST['sec_first_package_dalit_m'];
	$dt['first_package_dalit_t']=$_POST['sec_first_package_dalit_t'];
	$dt['first_package_janjati_f']=$_POST['sec_first_package_janjati_f'];
	$dt['first_package_janjati_m']=$_POST['sec_first_package_janjati_m'];
	$dt['first_package_janjati_t']=$_POST['sec_first_package_janjati_t'];
	$dt['second_package_total_f']=$_POST['sec_second_package_total_f'];
	$dt['second_package_total_m']=$_POST['sec_second_package_total_m'];
	$dt['second_package_total_t']=$_POST['sec_second_package_total_t'];
	$dt['second_package_dalit_f']=$_POST['sec_second_package_dalit_f'];
	$dt['second_package_dalit_m']=$_POST['sec_second_package_dalit_m'];
	$dt['second_package_dalit_t']=$_POST['sec_second_package_dalit_t'];
	$dt['second_package_janjati_f']=$_POST['sec_second_package_janjati_f'];
	$dt['second_package_janjati_m']=$_POST['sec_second_package_janjati_m'];
	$dt['second_package_janjati_t']=$_POST['sec_second_package_janjati_t'];
	$dt['third_package_total_f']=$_POST['sec_third_package_total_f'];
	$dt['third_package_total_m']=$_POST['sec_third_package_total_m'];
	$dt['third_package_total_t']=$_POST['sec_third_package_total_t'];
	$dt['third_package_dalit_f']=$_POST['sec_third_package_dalit_f'];
	$dt['third_package_dalit_m']=$_POST['sec_third_package_dalit_m'];
	$dt['third_package_dalit_t']=$_POST['sec_third_package_dalit_t'];
	$dt['third_package_janjati_f']=$_POST['sec_third_package_janjati_f'];
	$dt['third_package_janjati_m']=$_POST['sec_third_package_janjati_m'];
	$dt['third_package_janjati_t']=$_POST['sec_third_package_janjati_t'];
	$dt['untrained_total_f']=$_POST['sec_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['sec_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['sec_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['sec_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['sec_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['sec_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['sec_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['sec_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['sec_untrained_janjati_t'];
	*/
	if (!checkblank($dt)) idata('sec_teacher_training',$dt,'sch_num');
	
	unset($dt);
	
	mysql_query("delete from hsec_teacher_training where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['fully_trained_total_f']=$_POST['hsec_fully_trained_total_f'];
	$dt['fully_trained_total_m']=$_POST['hsec_fully_trained_total_m'];
	$dt['fully_trained_total_t']=$_POST['hsec_fully_trained_total_t'];
	$dt['fully_trained_dalit_f']=$_POST['hsec_fully_trained_dalit_f'];
	$dt['fully_trained_dalit_m']=$_POST['hsec_fully_trained_dalit_m'];
	$dt['fully_trained_dalit_t']=$_POST['hsec_fully_trained_dalit_t'];
	$dt['fully_trained_janjati_f']=$_POST['hsec_fully_trained_janjati_f'];
	$dt['fully_trained_janjati_m']=$_POST['hsec_fully_trained_janjati_m'];
	$dt['fully_trained_janjati_t']=$_POST['hsec_fully_trained_janjati_t'];
	$dt['untrained_total_f']=$_POST['hsec_untrained_total_f'];
	$dt['untrained_total_m']=$_POST['hsec_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['hsec_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['hsec_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['hsec_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['hsec_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['hsec_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['hsec_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['hsec_untrained_janjati_t'];
	
	if (!checkblank($dt)) idata('hsec_teacher_training',$dt,'sch_num');
	
	unset($dt);	
	
	// non teaching
	mysql_query("delete from non_teaching_staff where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['account_f']=$_POST['non_teaching_account_f'];
	$dt['account_m']=$_POST['non_teaching_account_m'];
	$dt['account_t']=$_POST['non_teaching_account_t'];
	
	$dt['admin_f']=$_POST['non_teaching_admin_f'];
	$dt['admin_m']=$_POST['non_teaching_admin_m'];
	$dt['admin_t']=$_POST['non_teaching_admin_t'];

	$dt['other_f']=$_POST['non_teaching_other_f'];
	$dt['other_m']=$_POST['non_teaching_other_m'];
	$dt['other_t']=$_POST['non_teaching_other_t'];
		
	if (!checkblank($dt)) idata('non_teaching_staff',$dt,'sch_num');
	
	unset($dt);	
	
	
}

if ($from == 'schoolinfo1.php'){
	// school program data
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
		
	$dt['govt_funds_q1_1st']=$_POST['i1_1'];
	$dt['govt_funds_q1_2nd']=$_POST['i1_2'];
	$dt['govt_funds_q1_3rd']=$_POST['i1_3'];
	$dt['govt_funds_q1_4th']=$_POST['i1_4'];
	$dt['govt_funds_q2_1st']=$_POST['i1_5'];
	$dt['govt_funds_q2_2nd']=$_POST['i1_6'];
	$dt['govt_funds_q2_3rd']=$_POST['i1_7'];
	$dt['govt_funds_q2_4th']=$_POST['i1_8'];
	$dt['school_improve_plan']=$_POST['i2_1'];
	$dt['school_improve_plan_first']=$_POST['i2_2'];
	$dt['social_audit']=$_POST['i3_1'];
	$dt['social_audit_month']=$_POST['i3_2'];
	$dt['social_audit_day']=$_POST['i3_3'];
	$dt['public_disclose_acc']=$_POST['i4_1'];
	$dt['public_disclose_acc_month']=$_POST['i4_2'];
	$dt['public_disclose_acc_day']=$_POST['i4_3'];
	$dt['standardization']=$_POST['i5_1'];
	$dt['standardization_level']=$_POST['i5_2'];
	$dt['govt_grant']=$_POST['i6_1'];
	$dt['grant_amount']=$_POST['i6_2'];
	$dt['per_student_grant']=$_POST['i7_1'];
	$dt['sch_mgmt_transferred']=$_POST['i8_1'];
	$dt['mgmt_transferred_year']=$_POST['i8_2'];
	$dt['mgmt_transferred_level']=$_POST['i8_3'];
	$dt['new_classrooms']=$_POST['i9_1'];
	$dt['new_classrooms_govt']=$_POST['i9_2'];
	$dt['new_classrooms_others']=$_POST['i9_3'];
	$dt['rehab_classrooms']=$_POST['i10_1'];
	$dt['rehab_classrooms_govt']=$_POST['i10_2'];
	$dt['rehab_classrooms_others']=$_POST['i10_3'];
	$dt['school_fence']=$_POST['i11_1'];
	$dt['school_fence_govt']=$_POST['i11_2'];
	$dt['school_fence_local']=$_POST['i11_3'];
	$dt['school_fence_others']=$_POST['i11_4'];
	$dt['school_toilets']=$_POST['i12_1'];
	$dt['school_toilets_govt']=$_POST['i12_2'];
	$dt['school_toilets_local']=$_POST['i12_3'];
	$dt['school_toilets_others']=$_POST['i12_4'];
	$dt['water']=$_POST['i13_1'];
	$dt['water_govt']=$_POST['i13_2'];
	$dt['water_local']=$_POST['i13_3'];
	$dt['water_others']=$_POST['i13_4'];
	$dt['sch_oper_cal']=$_POST['i14_1'];
	$dt['diss_calendar']=$_POST['i14_2'];
	$dt['diss_notice']=$_POST['i14_3'];
	$dt['diss_others']=$_POST['i14_4'];
	$dt['school_open']=$_POST['i15_1'];
	$dt['school_open_teaching']=$_POST['i15_2'];
	$dt['school_open_exams']=$_POST['i15_3'];
	$dt['school_open_eca']=$_POST['i15_4'];
	$dt['school_open_holidays']=$_POST['i15_5'];
	$dt['school_open_festivals']=$_POST['i15_6'];
	$dt['school_open_others']=$_POST['i15_7'];
	$dt['school_act_open']=$_POST['i16_1'];
	$dt['school_act_teaching']=$_POST['i16_2'];
	$dt['school_act_eca']=$_POST['i16_3'];
	$dt['smc_meetings']=$_POST['i17_1'];
	$dt['monitor_total']=$_POST['i18_1'];
	$dt['monitor_rp']=$_POST['i18_2'];
	$dt['monitor_ss']=$_POST['i18_3'];
	$dt['monitor_others']=$_POST['i18_4'];
	$dt['health_facility']=$_POST['i19_1'];
	$dt['health_distance']=$_POST['i19_2'];
	$dt['textbook_pri']=$_POST['i20_1_1'];
	$dt['textbook_lsec']=$_POST['i20_1_2'];
	$dt['textbook_sec']=$_POST['i20_1_3'];
	$dt['textbook_hsec']=$_POST['i20_1_4'];
	$dt['teachingmanual_pri']=$_POST['i20_2_1'];
	$dt['teachingmanual_lsec']=$_POST['i20_2_2'];
	$dt['teachingmanual_sec']=$_POST['i20_2_3'];
	$dt['teachingmanual_hsec']=$_POST['i20_2_4'];
	$dt['localcurr_dev_pri']=$_POST['i20_3_1'];
	$dt['localcurr_dev_lsec']=$_POST['i20_3_2'];
	$dt['localcurr_dev_sec']=$_POST['i20_3_3'];
	$dt['localcurr_dev_hsec']=$_POST['i20_3_4'];
	$dt['localcurr_usage_pri']=$_POST['i20_4_1'];
	$dt['localcurr_usage_lsec']=$_POST['i20_4_2'];
	$dt['localcurr_usage_sec']=$_POST['i20_4_3'];
	$dt['localcurr_usage_hsec']=$_POST['i20_4_4'];
	$dt['library']=$_POST['i20_5_1'];
	
	
	//mysql_query("delete from school_program where sch_num='$schoolcode' and sch_year='$currentyear'");
	iudata('school_program',$dt,'sch_num');	
}

if ($from == 'schoolinfo2.php'){
	
	// physical data
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	

	$dt['land_bigaha']=$_POST['i1_1'];
	$dt['land_kattha']=$_POST['i1_2'];
	$dt['land_dhur']=$_POST['i1_3'];
	$dt['land_ropani']=$_POST['i1_4'];
	$dt['land_aana']=$_POST['i1_5'];
	$dt['land_paisa']=$_POST['i1_6'];
	$dt['land_daam']=$_POST['i1_7'];
	$dt['compound_bigaha']=$_POST['i2_1'];
	$dt['compound_kattha']=$_POST['i2_2'];
	$dt['compound_dhur']=$_POST['i2_3'];
	$dt['compound_ropani']=$_POST['i2_4'];
	$dt['compound_aana']=$_POST['i2_5'];
	$dt['compound_paisa']=$_POST['i2_6'];
	$dt['compound_daam']=$_POST['i2_7'];
	
	
	$dt['compound']=$_POST['compound'];
	$dt['cstatus']=$_POST['cstatus'];

	$dt['water']=$_POST['water'];
	$dt['water_tap']=$_POST['water_tap'];
	$dt['water_tubewell']=$_POST['water_tubewell'];
	$dt['water_well']=$_POST['water_well'];
	$dt['water_other']=$_POST['water_other'];

	$dt['toilet']=$_POST['toilet'];
	$dt['t_total']=$_POST['t_total'];
	$dt['t_all']=$_POST['t_all'];
	$dt['t_girls']=$_POST['t_girls'];
	$dt['t_teachers']=$_POST['t_teachers'];

	$dt['urinal']=$_POST['urinal'];
	$dt['urinal_girls']=$_POST['urinal_girls'];
	$dt['urinal_teachers']=$_POST['urinal_teachers'];

	$dt['pground']=$_POST['pground'];
	$dt['pground_enough_space']=$_POST['pground_enough_space'];
	
	$dt['computer_room']=$_POST['computer_room'];
	$dt['num_computers']=$_POST['num_computers'];
	$dt['admin_computers']=$_POST['admin_computers'];
	$dt['teaching_computers']=$_POST['teaching_computers'];
	
	$dt['electricity']=$_POST['electricity'];

	$dt['num_buildings']=$_POST['num_buildings'];
	$dt['rigid_buildings']=$_POST['rigid_buildings'];
	$dt['weak_buildings']=$_POST['weak_buildings'];
	
	iudata('school_physical',$dt,'sch_num');
	
	unset($dt);
	
	// classrooms and sections
	
	mysql_query("delete from sections where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	for ($i=0;$i<=10;$i++){
		$dt['class']=$i;
		$dt['sections']=$_POST['sections_'.$i];
		$dt['classrooms']=$_POST['classrooms_'.$i];
		if (!checkblank($dt)) idata('sections',$dt);
	}	
}

if ($from == 'schoolinfo3.php'){
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
		
	$dt['buildings_govt']=$_POST['buildings_govt'];
	$dt['buildings_community']=$_POST['buildings_community'];
	$dt['buildings_localresource']=$_POST['buildings_localresource'];
	$dt['buildings_others']=$_POST['buildings_others'];
	$dt['classroom_rigid']=$_POST['classroom_rigid'];
	$dt['classroom_weak']=$_POST['classroom_weak'];
	$dt['classroom_govt']=$_POST['roomscons_govt'];
	$dt['classroom_community']=$_POST['roomscons_comm'];
	$dt['classroom_localresource']=$_POST['roomscons_local'];
	$dt['classroom_others']=$_POST['roomscons_other'];
	$dt['classroom_usable']=$_POST['rooms_used'];
	$dt['classroom_unused']=$_POST['rooms_unused'];
	$dt['classroom_inadequate']=$_POST['additional_rooms_num'];
	$dt['classroom_land_available']=$_POST['additional_rooms_land'];
	$dt['recons_needed_rooms']=$_POST['recons_needed_rooms'];
	$dt['num_desk']=$_POST['num_desk'];
	$dt['usable_desk_students']=$_POST['usable_desk_students'];
	$dt['inadequate_desk_students']=$_POST['inadequate_desk_students'];
	$dt['num_table']=$_POST['num_table'];
	$dt['usable_table']=$_POST['usable_table'];
	$dt['num_chair']=$_POST['num_chair'];
	$dt['usable_chair']=$_POST['usable_chair'];
	
	iudata("school_physical",$dt,'sch_num');
	
}

if ($from == 'ecd.php'){
	
	
	// students data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];
	
	for ($i=1;$i<=6;$i++){
		
		mysql_query("delete from ecdppc_enroll where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}' and ecd_class_type='$i'");		
		
		if ($_POST['ep_t_t'][$i]==0) continue;
		
		$dt['ecd_class_type']=$i;
		$dt['tot_enroll_total_f']=$_POST['ep_t_g'][$i];
		$dt['tot_enroll_total_m']=$_POST['ep_t_b'][$i];
		$dt['tot_enroll_total_t']=$_POST['ep_t_t'][$i];
		$dt['tot_enroll_dalit_f']=$_POST['ep_d_g'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['ep_d_b'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['ep_d_t'][$i];
		$dt['tot_enroll_janjati_f']=$_POST['ep_j_g'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['ep_j_b'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['ep_j_t'][$i];
		
		idata('ecdppc_enroll',$dt);

	}
	unset($dt);
	
	
	// teachers data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];
	
	for ($i=1;$i<=5;$i++){
		
		mysql_query("delete from ecdppc_teacher where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}' and ecd_class_type='$i'");		
		
		if ($_POST['ep_a_t'][$i]==0) continue;
		
		$dt['ecd_class_type']=$i;
		$dt['total_f']=$_POST['ep_a_g'][$i];
		$dt['total_m']=$_POST['ep_a_b'][$i];
		$dt['total_t']=$_POST['ep_a_t'][$i];
		$dt['training_received']=$_POST['ep_r_y'][$i];
		$dt['training_not_received']=$_POST['ep_r_n'][$i];
		
		idata('ecdppc_teacher',$dt);

	}
	unset($dt);	
	
	// 
	
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];

	mysql_query("delete from ecdppc_info where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}'");		

		$dt['smc_year']=$_POST['estd_year'];
		$dt['parent_sch_num']=$_POST['parent_sch_num'];
		$dt['sections']=$_POST['ecd_sections'];
		
                $dt['ecd_type']=$_POST['ecd_type'];
		$dt['ecd_vdc']=$_POST['vdclist'];
		$dt['ecd_ward']=$_POST['ecd_ward'];
		$dt['ecd_tole']=$_POST['ecd_tole'];
                
                $dt['reg_vdc']=$_POST['reg_vdc'];
		$dt['reg_vdc_year']=$_POST['ecd_reg_vdc'];
		$dt['priv_bnk_ac']=$_POST['priv_bnk_ac'];
		$dt['matching_fund']=$_POST['matching_fund'];
                $dt['ecd_aaya']=$_POST['ecd_aaya'];
		
		$dt['smc_y']=$_POST['ecd_mc_y'];
		$dt['smc_m']=$_POST['ecd_mc_m'];
		$dt['smc_d']=$_POST['ecd_mc_d'];
		/*
		$dt['smc_total']=$_POST['ecd_mc_t'];
		$dt['smc_female']=$_POST['ecd_mc_f'];
		$dt['smc_male']=$_POST['ecd_mc_t']-$_POST['ecd_mc_f'];
		$dt['smc_dalit']=$_POST['ecd_mc_dl'];
		*/
	
		$dt['separate_room']=$_POST['ecd_room'];
		$dt['separate_building']=$_POST['ecd_building'];
	
		$dt['adequate_space']=$_POST['ecd_space'];
		$dt['adequate_material']=$_POST['ecd_material'];
		$dt['adequate_classroom']=$_POST['ecd_building_classroom'];
	
		$dt['ngo_name']=$_POST['ecd_ngo_name'];
		$dt['ngo_add']=$_POST['ecd_ngo_add'];
			
		idata('ecdppc_info',$dt);		
		
	
	// ecd facilitators
	//
	$dt=array();

	mysql_query("delete from ecd_facilitator where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='{$_POST['ecd_num']}'");
	
	for ($i=1;$i<=10;$i++){
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;
		$dt['ecd_num']=$_POST['ecd_num'];
	
		$dt['name']=$_POST['ecd_teacher_name_'.$i];
		
		if (trim($dt['name'])=='') continue;
		
		$dt['sex']=$_POST['ecd_teacher_sex_'.$i];
		$dt['caste']=$_POST['ecd_teacher_caste_'.$i];
		
		if ($dt['sex']=='1'){ // female
			if ($_POST['ecd_teacher_edu_'.$i]==1) $dt['less_slc_f']=1;
			if ($_POST['ecd_teacher_edu_'.$i]==2) $dt['slc_f']=1;
			if ($_POST['ecd_teacher_edu_'.$i]==3) $dt['greater_slc_f']=1;
			if ($_POST['ecd_teacher_training_'.$i]==1) $dt['trained_f']=1;
			if ($_POST['ecd_teacher_training_'.$i]==2) $dt['untrained_f']=1;
			
		}
		else if ($dt['sex']=='2'){  // male
			if ($_POST['ecd_teacher_edu_'.$i]==1) $dt['less_slc_m']=1;
			if ($_POST['ecd_teacher_edu_'.$i]==2) $dt['slc_m']=1;
			if ($_POST['ecd_teacher_edu_'.$i]==3) $dt['greater_slc_m']=1;			
			if ($_POST['ecd_teacher_training_'.$i]==1) $dt['trained_m']=1;
			if ($_POST['ecd_teacher_training_'.$i]==2) $dt['untrained_m']=1;
		}
		
		idata('ecd_facilitator',$dt);
		unset($dt);	
	}		
	
	
	
	// re-number ecds
	
	$result = mysql_query("select ecd_num from ecdppc_info where sch_num='$schoolcode' and sch_year='$currentyear'");		
	$row = mysql_fetch_all($result);
	
	$count = 0;
	$po = 0;
	
	// find the discontinuity
	foreach ($row as $r){
		if ($r['ecd_num']-$count > 1) {
			$po = 1;
			$count = $r['ecd_num'];
			break;
		}
		$count = $r['ecd_num'];
	}
	
	if ($po==1){
		mysql_query("update ecdppc_enroll set ecd_num = ecd_num-1 where ecd_num>='$count'");
		mysql_query("update ecdppc_teacher set ecd_num = ecd_num-1 where ecd_num>='$count'");
		mysql_query("update ecdppc_info set ecd_num = ecd_num-1 where ecd_num>='$count'");
		mysql_query("update ecd_facilitator set ecd_num = ecd_num-1 where ecd_num>='$count'");
	}

	
}

if ($from == 'alternate.php'){
	
	// enroll data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['sopfsp_num']=$_POST['sopfsp_num'];	
	
	mysql_query("delete from sopfsp_enroll where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='${dt['sopfsp_num']}'");		

	if ($_POST['alternate_total_t']>0 && $_POST['alternate_school']>0){
		$dt['tot_enroll_total_f']=$_POST['alternate_total_f'];
		$dt['tot_enroll_total_m']=$_POST['alternate_total_m'];
		$dt['tot_enroll_total_t']=$_POST['alternate_total_t'];
		$dt['tot_enroll_dalit_f']=$_POST['alternate_dalit_f'];
		$dt['tot_enroll_dalit_m']=$_POST['alternate_dalit_m'];
		$dt['tot_enroll_dalit_t']=$_POST['alternate_dalit_t'];
		$dt['tot_enroll_janjati_f']=$_POST['alternate_janjati_f'];
		$dt['tot_enroll_janjati_m']=$_POST['alternate_janjati_m'];
		$dt['tot_enroll_janjati_t']=$_POST['alternate_janjati_t'];
		$dt['tot_enroll_dropout_f']=$_POST['alternate_dropout_f'];
		$dt['tot_enroll_dropout_m']=$_POST['alternate_dropout_m'];
		$dt['tot_enroll_dropout_t']=$_POST['alternate_dropout_t'];		
		
		idata('sopfsp_enroll',$dt);
		
	}
	
	unset($dt);

	// info
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['sopfsp_num']=$_POST['sopfsp_num'];

	mysql_query("delete from sopfsp_info where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='${dt['sopfsp_num']}'");		
	echo2file(mysql_error());

	if ($_POST['alternate_school']>0){
		$dt['sopfsp_type']=$_POST['alternate_school'];
		$dt['parent_sch_num']=$_POST['parent_sch_num'];
		$dt['start_y']=$_POST['starts_y'];
		$dt['start_m']=$_POST['starts_m'];
		$dt['start_d']=$_POST['starts_d'];
		$dt['start_level']=$_POST['starts_level'];
		$dt['start_time']=$_POST['starts_time'];
		$dt['repeat_y']=$_POST['startr_y'];
		$dt['repeat_m']=$_POST['startr_m'];
		$dt['repeat_d']=$_POST['startr_d'];
		$dt['repeat_level']=$_POST['startr_level'];
		$dt['repeat_time']=$_POST['startr_time'];

		$dt['vdc']=$_POST['vdclist'];
		$dt['ward']=$_POST['alternate_ward'];
		$dt['tole']=$_POST['alternate_tole'];

		$dt['helper_name']=$_POST['helper_name'];
		$dt['helper_add']=$_POST['helper_add'];
		$dt['helper_sex']=$_POST['helper_sex'];
		$dt['helper_caste']=$_POST['helper_caste'];
		$dt['helper_edu_status']=$_POST['helper_qual'];
		$dt['helper_training']=$_POST['helper_training'];
		
		$dt['ngo_name']=$_POST['ngo_name'];
		$dt['ngo_add']=$_POST['ngo_add'];		
		
		idata('sopfsp_info',$dt);
	}
	
	
	// ecd facilitators
	//
	$dt=array();

	mysql_query("delete from sopfsp_facilitator where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='{$_POST['sopfsp_num']}'");
	
	for ($i=1;$i<=10;$i++){
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;
		$dt['sopfsp_num']=$_POST['sopfsp_num'];
	
		$dt['name']=$_POST['sopfsp_teacher_name_'.$i];
		
		if ($dt['name']=='') continue;
		
		$dt['sex']=$_POST['sopfsp_teacher_sex_'.$i];
		$dt['caste']=$_POST['sopfsp_teacher_caste_'.$i];
		
		if ($dt['sex']=='1'){ // female
			if ($_POST['sopfsp_teacher_edu_'.$i]==1) $dt['less_slc_f']=1;
			if ($_POST['sopfsp_teacher_edu_'.$i]==2) $dt['slc_f']=1;
			if ($_POST['sopfsp_teacher_edu_'.$i]==3) $dt['greater_slc_f']=1;
			
			$dt['trained_f'] = $_POST['sopfsp_teacher_training_'.$i];
			/*
			if ($_POST['sopfsp_teacher_training_'.$i]==1) $dt['trained_f']=1;
			if ($_POST['sopfsp_teacher_training_'.$i]==2) $dt['untrained_f']=1;
			*/
			
		}
		else if ($dt['sex']=='2'){  // male
			if ($_POST['sopfsp_teacher_edu_'.$i]==1) $dt['less_slc_m']=1;
			if ($_POST['sopfsp_teacher_edu_'.$i]==2) $dt['slc_m']=1;
			if ($_POST['sopfsp_teacher_edu_'.$i]==3) $dt['greater_slc_m']=1;			
			
			$dt['trained_m'] = $_POST['sopfsp_teacher_training_'.$i];
			/*
			if ($_POST['sopfsp_teacher_training_'.$i]==1) $dt['trained_m']=1;
			if ($_POST['sopfsp_teacher_training_'.$i]==2) $dt['untrained_m']=1;
			*/
		}
		
		idata('sopfsp_facilitator',$dt);
		unset($dt);	
	}	
	
	
	// re-number ecds
	
	$result = mysql_query("select sopfsp_num from sopfsp_info where sch_num='$schoolcode' and sch_year='$currentyear'");		
	$row = mysql_fetch_all($result);
	
	$count = 0;
	$po = 0;
	
	// find the discontinuity
	foreach ($row as $r){
		if ($r['sopfsp_num']-$count > 1) {
			$po = 1;
			$count = $r['sopfsp_num'];
			break;
		}
		$count = $r['sopfsp_num'];
	}
	
	if ($po==1){
		mysql_query("update sopfsp_enroll set sopfsp_num = sopfsp_num-1 where sopfsp_num>='$count'");
		mysql_query("update sopfsp_facilitator set sopfsp_num = sopfsp_num-1 where sopfsp_num>='$count'");
		mysql_query("update sopfsp_info set sopfsp_num = sopfsp_num-1 where sopfsp_num>='$count'");
	}	
	
	

}

if ($from=='buildings.php'){
	
	// building material
	
	//echo2file(print_r($_POST,true));
	
	mysql_query("delete from building_material where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($b=1;$b<=11;$b++){
		
		$dt=array();
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;
		$dt['building_no']=$b;
		
		// roof
		$dt['roof'] = str_replace('0','',implode('',$_POST['roof'][$b]));
		// truss
		$dt['truss'] = str_replace('0','',implode('',$_POST['truss'][$b]));
		// wall
		$dt['wall'] = str_replace('0','',implode('',$_POST['wall'][$b]));
		
		echo2file($dt['roof']);
		
		if ($dt['roof']!=0 || $dt['truss']!=0 || $dt['wall']!=0){
			idata('building_material',$dt);
			
		}
		unset($dt);
	}
	
	
	// room data
	
	mysql_query("delete from building_rooms where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($b=1;$b<=11;$b++){
		for ($r=1;$r<=12;$r++){
			if ($_POST['l'][$b][$r]=='') continue;
		
			$dt=array();
			$dt['sch_num']=$schoolcode;
			$dt['sch_year']=$currentyear;
			$dt['building_no']=$b;
			$dt['room_no']=$r;
			
			$dt['`length`']= $_POST['l'][$b][$r];
			$dt['width']= $_POST['b'][$b][$r];
			$dt['height']= $_POST['h'][$b][$r];
			$dt['`usage`']= $_POST['roomtype'][$b][$r];
			
			//if ($dt['length']!='' || $dt['width']!='' || $dt['height']!='' || $dt['usage']!=''){
				idata('building_rooms',$dt);
				
			//}
			unset($dt);			
			
			
		}

	}	
	
}


if ($from == 'schoolprogram.php'){
	// school program data

	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
		
	$dt['govt_funds_q1_1st']=$_POST['govt_funds_q1_1st'];
	$dt['govt_funds_q1_2nd']=$_POST['govt_funds_q1_2nd'];
	$dt['govt_funds_q1_3rd']=$_POST['govt_funds_q1_3rd'];
	$dt['govt_funds_q1_4th']=$_POST['govt_funds_q1_4th'];
	$dt['govt_funds_q2_1st']=$_POST['govt_funds_q2_1st'];
	$dt['govt_funds_q2_2nd']=$_POST['govt_funds_q2_2nd'];
	$dt['govt_funds_q2_3rd']=$_POST['govt_funds_q2_3rd'];
	$dt['govt_funds_q2_4th']=$_POST['govt_funds_q2_4th'];
	$dt['school_improve_plan']=$_POST['school_improve_plan'];
	$dt['school_improve_plan_date']=$_POST['school_improve_plan_date'];
	$dt['school_improve_plan_date_updated']=$_POST['school_improve_plan_date_updated'];
	$dt['social_audit']=$_POST['social_audit'];
	$dt['social_audit_year']=$_POST['social_audit_year'];
	$dt['social_audit_month']=$_POST['social_audit_month'];
	$dt['social_audit_day']=$_POST['social_audit_day'];
	$dt['public_disclose_acc']=$_POST['public_disclose_acc'];
	$dt['public_disclose_acc_year']=$_POST['public_disclose_acc_year'];
	$dt['public_disclose_acc_month']=$_POST['public_disclose_acc_month'];
	$dt['public_disclose_acc_day']=$_POST['public_disclose_acc_day'];
	$dt['standardization']=$_POST['standardization'];
	$dt['standardization_level']=$_POST['standardization_level'];
	$dt['sch_mgmt_transferred']=$_POST['sch_mgmt_transferred'];
	$dt['mgmt_transferred_year']=$_POST['mgmt_transferred_year'];
	$dt['mgmt_transferred_level']=$_POST['mgmt_transferred_level'];
	$dt['sch_oper_cal']=$_POST['sch_oper_cal'];
	$dt['diss_calendar']=$_POST['diss_calendar'];
	$dt['diss_notice']=$_POST['diss_notice'];
	$dt['diss_others']=$_POST['diss_others'];
	$dt['smc_meetings']=$_POST['smc_meetings'];
	$dt['monitor_total']=$_POST['monitor_total'];
	$dt['monitor_rp']=$_POST['monitor_rp'];
	$dt['monitor_ss']=$_POST['monitor_ss'];
	$dt['monitor_gco']=$_POST['monitor_gco'];
	$dt['monitor_deo']=$_POST['monitor_deo'];
	$dt['monitor_others']=$_POST['monitor_others'];
	$dt['health_facility']=$_POST['health_facility'];
	$dt['health_distance']=$_POST['health_distance'];
	$dt['children_club']=$_POST['children_club'];
	$dt['worm_medicine']=$_POST['worm_medicine'];
	$dt['first_aid']=$_POST['first_aid'];	
	
	mysql_query("delete from school_program where sch_num='$schoolcode' and sch_year='$currentyear'");
	idata('school_program',$dt);	
	
	
	// grant amount
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['pri_books']=$_POST['pri_books'];
	$dt['pri_scholarship']=$_POST['pri_scholarship'];
	$dt['pri_pcf']=$_POST['pri_pcf'];
	$dt['pri_student_evaluation']=$_POST['pri_student_evaluation'];
	$dt['pri_misc']=$_POST['pri_misc'];
	$dt['lsec_books']=$_POST['lsec_books'];
	$dt['lsec_scholarship']=$_POST['lsec_scholarship'];
	$dt['lsec_pcf']=$_POST['lsec_pcf'];
	$dt['lsec_student_evaluation']=$_POST['lsec_student_evaluation'];
	$dt['lsec_misc']=$_POST['lsec_misc'];
	$dt['sec_books']=$_POST['sec_books'];
	$dt['sec_scholarship']=$_POST['sec_scholarship'];
	$dt['sec_pcf']=$_POST['sec_pcf'];
	$dt['sec_student_evaluation']=$_POST['sec_student_evaluation'];
	$dt['sec_misc']=$_POST['sec_misc'];	
	
	mysql_query("delete from school_grant where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_grant',$dt);	
	
	// school improvement
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	foreach (array("new_building","new_classrooms","recon_building","recon_classrooms","toilet","toilet_girls","water") as $type){
	  foreach (array("deo","local","others") as $source){
			$var = "{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	}
	mysql_query("delete from school_improvement where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_improvement',$dt);	
	

	// school calendar
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	  foreach (array("open_days","teaching","exams","eca","holidays","festivals","others") as $type){
	      foreach (array("planned","actual") as $source){
				$var = "{$type}_{$source}";
				$dt[$var]=$_POST[$var];	
		  }
	  }
	mysql_query("delete from school_calendar where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_calendar',$dt);	
	
	
	// school textbooks
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	  foreach (array("textbook","teaching_manual","child_material","book_corner","library","library_books","local_curriculum","local_curriculum_usage") as $type){
	      foreach (array("pri","lsec","sec","hsec") as $source){
				$var = "{$type}_{$source}";
				$dt[$var]=$_POST[$var];				
		  }
	  }
	 
	mysql_query("delete from school_textbook where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_textbook',$dt);		 
	
		

}

if ($from == 'schoolphysical.php'){
	// school physical data

	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['land_bigaha']=$_POST['land_bigaha'];
	$dt['land_kattha']=$_POST['land_kattha'];
	$dt['land_dhur']=$_POST['land_dhur'];
	$dt['land_ropani']=$_POST['land_ropani'];
	$dt['land_aana']=$_POST['land_aana'];
	$dt['land_paisa']=$_POST['land_paisa'];
	$dt['land_daam']=$_POST['land_daam'];
	$dt['water']=$_POST['water'];
	$dt['water_tap']=$_POST['water_tap'];
	$dt['water_tubewell']=$_POST['water_tubewell'];
	$dt['water_well']=$_POST['water_well'];
	$dt['water_other']=$_POST['water_other'];
	$dt['toilet']=$_POST['toilet'];
	$dt['t_total']=$_POST['t_total'];
	$dt['t_girls']=$_POST['t_girls'];
	$dt['t_all']=$_POST['t_all'];
	$dt['t_teachers']=$_POST['t_teachers'];
	$dt['urinal']=$_POST['urinal'];
	$dt['urinal_teachers']=$_POST['urinal_teachers'];
	$dt['urinal_girls']=$_POST['urinal_girls'];
	$dt['num_buildings']=$_POST['num_buildings'];
	$dt['rigid_buildings']=$_POST['rigid_buildings'];
	$dt['weak_buildings']=$_POST['weak_buildings'];
	$dt['classroom_total']=$_POST['classroom_total'];
	$dt['classroom_rigid']=$_POST['classroom_rigid'];
	$dt['classroom_weak']=$_POST['classroom_weak'];
	$dt['rooms_used']=$_POST['rooms_used'];
	$dt['rooms_unused']=$_POST['rooms_unused'];
	$dt['additional_rooms']=$_POST['additional_rooms'];
	$dt['additional_rooms_num']=$_POST['additional_rooms_num'];
	$dt['additional_rooms_land']=$_POST['additional_rooms_land'];
	$dt['reconstruction_rooms']=$_POST['reconstruction_rooms'];
	$dt['reconstruction_rooms_num']=$_POST['reconstruction_rooms_num'];
        $dt['is_retrofitting']=$_POST['is_retrofitting'];
        $dt['retrofitting_num']=$_POST['retrofitting_num'];
	$dt['compound']=$_POST['compound'];
	$dt['cstatus']=$_POST['cstatus'];
	$dt['num_desk']=$_POST['num_desk'];
	$dt['usable_desk_students']=$_POST['usable_desk_students'];
	$dt['inadequate_desk_students']=$_POST['inadequate_desk_students'];
	$dt['num_table']=$_POST['num_table'];
	$dt['usable_table']=$_POST['usable_table'];
	$dt['num_chair']=$_POST['num_chair'];
	$dt['usable_chair']=$_POST['usable_chair'];
	$dt['pground']=$_POST['pground'];
	$dt['pground_enough_space']=$_POST['pground_enough_space'];
	$dt['electricity']=$_POST['electricity'];
	$dt['computer_room']=$_POST['computer_room'];
	$dt['num_computers']=$_POST['num_computers'];
	$dt['teaching_computers']=$_POST['teaching_computers'];
	$dt['admin_computers']=$_POST['admin_computers'];
	$dt['other_computers']=$_POST['other_computers'];
	$dt['internet']=$_POST['internet'];
	$dt['internet_all']=$_POST['internet_all'];
	
	mysql_query("delete from school_physical where sch_num='$schoolcode' and sch_year='$currentyear'");
	iudata('school_physical',$dt,'sch_num');	
	
	// classrooms and sections
	
	mysql_query("delete from sections where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	for ($i=0;$i<=10;$i++){
		$dt['class']=$i;
		$dt['sections']=$_POST['sections_'.$i];
		$dt['classrooms']=$_POST['classrooms_'.$i];
		if (!checkblank($dt)) idata('sections',$dt);
	}	
	
	// school improvement
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	foreach (array("new_building","new_classrooms","recon_building","recon_classrooms","toilet","toilet_girls","water") as $type){
	  foreach (array("deo","local","others") as $source){
			$var = "{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	}
	mysql_query("delete from school_construction where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_construction',$dt);		
	
	// school exam
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	foreach (array("enrollment","test_pass","slc","slc_pass") as $type){
	  foreach (array("f","m","t") as $source){
			$var = "slc_prev_{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	  foreach (array("f","m","t") as $source){
			$var = "slc_pprev_{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	}

	foreach (array("enrollment","test_appeared","passed") as $type){
	  foreach (array("f","m","t") as $source){
			$var = "hsec_prev_{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	  foreach (array("f","m","t") as $source){
			$var = "hsec_pprev_{$type}_{$source}";
			$dt[$var]=$_POST[$var];	
	  }
	}
	
	mysql_query("delete from school_exam where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('school_exam',$dt);		
	
	
	
}
