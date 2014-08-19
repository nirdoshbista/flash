<?php

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

$from = $_POST['referer'];
$schoolcode = $_POST['schoolcode'];

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
	$dt['flash1']=1;
	
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_year='$currentyear' AND sch_num='$schoolcode'");
	if (mysql_num_rows($result)==0){
		idata('mast_schoollist',$dt);
	}
	else{
		
		// update data
		$updatelist = array();
		foreach ($dt as $k=>$v){
			if ($k=='sch_year' || $k=='sch_num') continue;
			$updatelist[] = "`$k`=\"$v\"";
		}
		$query = "UPDATE mast_schoollist SET ".implode(",",$updatelist)." WHERE sch_year='$currentyear' AND sch_num='$schoolcode'";
		mysql_query($query);	
	}
		
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
	
	//$cdt['flash']=1;
	
	mysql_query("delete from mast_school_type where sch_num='".$dt['sch_num']."' and sch_year='$currentyear'");
	idata('mast_school_type',$cdt);
	
	
	// slc hseb info
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['hseb_estd_date']="{$_POST['hseb_estd_y']}-{$_POST['hseb_estd_m']}-{$_POST['hseb_estd_d']}";
	$dt['slc_board_code']=$_POST['slc_board_code'];
	$dt['hseb_code']=$_POST['hseb_code'];
	
	$dt['hseb_faculty_1']=$_POST['hseb_faculty_1'];
	$dt['hseb_faculty_2']=$_POST['hseb_faculty_2'];
	$dt['hseb_faculty_3']=$_POST['hseb_faculty_3'];
	$dt['hseb_faculty_4']=$_POST['hseb_faculty_4'];
	$dt['hseb_faculty_5']=$_POST['hseb_faculty_5'];
	$dt['hseb_faculty_6']=$_POST['hseb_faculty_6'];
	$dt['hseb_faculty_7']=$_POST['hseb_faculty_7'];
	$dt['hseb_faculty_8']=$_POST['hseb_faculty_8'];
	
	mysql_query("delete from slc_hseb_info_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	if (!checkblank($dt)) idata('slc_hseb_info_f1',$dt,'sch_num');
	
	
}

if ($from == 'ecd_details.php'){
	// students data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];

	echo2file("ecd_num: ".$_POST['ecd_num']);
	
	for ($i=1;$i<=6;$i++){
		
		mysql_query("delete from ecdppc_enroll_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}' and ecd_class_type='$i'");		
		
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
		$dt['tot_new_enroll_f']=$_POST['ep_a_g'][$i];
		$dt['tot_new_enroll_m']=$_POST['ep_a_b'][$i];
		$dt['tot_new_enroll_t']=$_POST['ep_a_t'][$i];
		
		idata('ecdppc_enroll_f1',$dt);

	}
	unset($dt);
	

	// enr by  age
	
	$dt=array();

	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];
	
	$dt['f_l3']=$_POST['ecd_age_total_f_0'];
	$dt['m_l3']=$_POST['ecd_age_total_m_0'];

	$dt['f3']=$_POST['ecd_age_total_f_1'];
	$dt['m3']=$_POST['ecd_age_total_m_1'];

	$dt['f4']=$_POST['ecd_age_total_f_2'];
	$dt['m4']=$_POST['ecd_age_total_m_2'];

	$dt['f5']=$_POST['ecd_age_total_f_3'];
	$dt['m5']=$_POST['ecd_age_total_m_3'];

	$dt['f_g5']=$_POST['ecd_age_total_f_4'];
	$dt['m_g5']=$_POST['ecd_age_total_m_4'];

	mysql_query("delete from ecd_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}'");
	if (!checkblank($dt)) idata('ecd_total_enroll_age_f1',$dt,'sch_num');
	
	$dt['f_l3']=$_POST['ecd_age_dalit_f_0'];
	$dt['m_l3']=$_POST['ecd_age_dalit_m_0'];

	$dt['f3']=$_POST['ecd_age_dalit_f_1'];
	$dt['m3']=$_POST['ecd_age_dalit_m_1'];

	$dt['f4']=$_POST['ecd_age_dalit_f_2'];
	$dt['m4']=$_POST['ecd_age_dalit_m_2'];

	$dt['f5']=$_POST['ecd_age_dalit_f_3'];
	$dt['m5']=$_POST['ecd_age_dalit_m_3'];

	$dt['f_g5']=$_POST['ecd_age_dalit_f_4'];
	$dt['m_g5']=$_POST['ecd_age_dalit_m_4'];

	mysql_query("delete from ecd_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}'");
	if (!checkblank($dt)) idata('ecd_dalit_enroll_age_f1',$dt,'sch_num');
	
	$dt['f_l3']=$_POST['ecd_age_janjati_f_0'];
	$dt['m_l3']=$_POST['ecd_age_janjati_m_0'];

	$dt['f3']=$_POST['ecd_age_janjati_f_1'];
	$dt['m3']=$_POST['ecd_age_janjati_m_1'];

	$dt['f4']=$_POST['ecd_age_janjati_f_2'];
	$dt['m4']=$_POST['ecd_age_janjati_m_2'];

	$dt['f5']=$_POST['ecd_age_janjati_f_3'];
	$dt['m5']=$_POST['ecd_age_janjati_m_3'];

	$dt['f_g5']=$_POST['ecd_age_janjati_f_4'];
	$dt['m_g5']=$_POST['ecd_age_janjati_m_4'];
	
	mysql_query("delete from ecd_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}'");
	if (!checkblank($dt)) idata('ecd_janjati_enroll_age_f1',$dt,'sch_num');
	

	unset($dt);	
	
        $dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['ecd_num']=$_POST['ecd_num'];

	mysql_query("delete from ecdppc_info_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and ecd_num='${dt['ecd_num']}'");		

        $dt['estd_year']=$_POST['estd_year'];
        $dt['mother_school_code']=$_POST['parent_sch_num'];
		
        $dt['ecd_type']=$_POST['ecd_type'];
      	$dt['ecd_vdc']=$_POST['vdclist'];
        $dt['ecd_ward']=$_POST['ecd_ward'];
	$dt['ecd_tole']=$_POST['ecd_tole'];
                
	$dt['ngo_name']=$_POST['ecd_ngo_name'];
	$dt['ngo_tole']=$_POST['ecd_ngo_add'];
			
	idata('ecdppc_info_f1',$dt);		
	
}

if ($from=='fspsop_details.php'){
	
		// enroll data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['sopfsp_num']=$_POST['sopfsp_num'];	
	
	mysql_query("delete from sopfsp_enroll_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='${dt['sopfsp_num']}'");		

	if ($_POST['alternate_total_t']>0){
		$dt['tot_enroll_total_f']=$_POST['alternate_total_f'];
		$dt['tot_enroll_total_m']=$_POST['alternate_total_m'];
		$dt['tot_enroll_total_t']=$_POST['alternate_total_t'];
		$dt['tot_enroll_dalit_f']=$_POST['alternate_dalit_f'];
		$dt['tot_enroll_dalit_m']=$_POST['alternate_dalit_m'];
		$dt['tot_enroll_dalit_t']=$_POST['alternate_dalit_t'];
		$dt['tot_enroll_janjati_f']=$_POST['alternate_janjati_f'];
		$dt['tot_enroll_janjati_m']=$_POST['alternate_janjati_m'];
		$dt['tot_enroll_janjati_t']=$_POST['alternate_janjati_t'];
	
		
		idata('sopfsp_enroll_f1',$dt);
		
	}
	
	unset($dt);
	
	
	// sop fsp agewise data
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['sopfsp_num']=$_POST['sopfsp_num'];	
	
	mysql_query("delete from sopfsp_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='${dt['sopfsp_num']}'");		

	if ($_POST['alt_age_t_t']>0){

		$dt['d_l5']=$_POST['alt_age_d_l5'];
		$dt['j_l5']=$_POST['alt_age_j_l5'];
		$dt['t_l5']=$_POST['alt_age_t_l5'];
		$dt['d_5']=$_POST['alt_age_d_5'];
		$dt['j_5']=$_POST['alt_age_j_5'];
		$dt['t_5']=$_POST['alt_age_t_5'];
		$dt['d_6']=$_POST['alt_age_d_6'];
		$dt['j_6']=$_POST['alt_age_j_6'];
		$dt['t_6']=$_POST['alt_age_t_6'];
		$dt['d_7']=$_POST['alt_age_d_7'];
		$dt['j_7']=$_POST['alt_age_j_7'];
		$dt['t_7']=$_POST['alt_age_t_7'];
		$dt['d_8']=$_POST['alt_age_d_8'];
		$dt['j_8']=$_POST['alt_age_j_8'];
		$dt['t_8']=$_POST['alt_age_t_8'];
		$dt['d_9']=$_POST['alt_age_d_9'];
		$dt['j_9']=$_POST['alt_age_j_9'];
		$dt['t_9']=$_POST['alt_age_t_9'];
		$dt['d_10']=$_POST['alt_age_d_10'];
		$dt['j_10']=$_POST['alt_age_j_10'];
		$dt['t_10']=$_POST['alt_age_t_10'];
		$dt['d_11']=$_POST['alt_age_d_11'];
		$dt['j_11']=$_POST['alt_age_j_11'];
		$dt['t_11']=$_POST['alt_age_t_11'];
		$dt['d_12']=$_POST['alt_age_d_12'];
		$dt['j_12']=$_POST['alt_age_j_12'];
		$dt['t_12']=$_POST['alt_age_t_12'];
		$dt['d_13']=$_POST['alt_age_d_13'];
		$dt['j_13']=$_POST['alt_age_j_13'];
		$dt['t_13']=$_POST['alt_age_t_13'];
		$dt['d_14']=$_POST['alt_age_d_14'];
		$dt['j_14']=$_POST['alt_age_j_14'];
		$dt['t_14']=$_POST['alt_age_t_14'];
		$dt['d_g14']=$_POST['alt_age_d_g14'];
		$dt['j_g14']=$_POST['alt_age_j_g14'];
		$dt['t_g14']=$_POST['alt_age_t_g14'];
		
		
		idata('sopfsp_enroll_age_f1',$dt);
		
	}
	
	unset($dt);	
	
	// info
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['sopfsp_num']=$_POST['sopfsp_num'];

	mysql_query("delete from sopfsp_info_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and sopfsp_num='${dt['sopfsp_num']}'");		
	echo2file(mysql_error());

	$dt['sopfsp_type']=$_POST['alternate_school'];
	$dt['mother_school_code']=$_POST['mother_school_code'];

	idata('sopfsp_info_f1',$dt);
	
}
if($from=='openschool.php')
{
    mysql_query("delete from opensch_info_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
    mysql_query("delete from nf_info_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
    foreach(array(1=>'lsec1',2=>'lsec2',3=>'secon') as $key=>$value)
    {
        unset($dt);
        $dt['sch_num']=$schoolcode;
        $dt['sch_year']=$currentyear;
        $dt['parent_code']=$_POST['parent_sch_num_open'];
        $dt['opensch_level']=$key;
        if($_POST[$value."_1_f"])
            $dt['total_f']=$_POST[$value."_1_f"];
        if($_POST[$value."_1_m"])
            $dt['total_m']=$_POST[$value."_1_m"];
        if($_POST[$value."_2_f"])
            $dt['dalit_f']=$_POST[$value."_2_f"];
        if($_POST[$value."_2_m"])
            $dt['dalit_m']=$_POST[$value."_2_m"];
        if($_POST[$value."_3_f"])
            $dt['janajati_f']=$_POST[$value."_3_f"];
        if($_POST[$value."_3_m"])
            $dt['janajati_m']=$_POST[$value."_3_m"];
        
        idata('opensch_info_f1',$dt);
    }
    
    
    for($i=1;$i<11;$i++)
    {
        unset($dt);
        
        $dt['sch_num']=$schoolcode;
        $dt['sch_year']=$currentyear;
        $dt['parent_code']=$_POST['parent_sch_num_nf'];
        $dt['nf_class']=$i;
        if($_POST['total_'.$i])
            $dt['no_total']=$_POST['total_'.$i];
        if($_POST['dalit_'.$i])
            $dt['no_dalit']=$_POST['dalit_'.$i];
        if($_POST['janaj_'.$i])
            $dt['no_janajati']=$_POST['janaj_'.$i];
        
        idata('nf_info_f1',$dt);
    }    
}

if ($from=='last_enroll_pr.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from last_class1_5_enroll_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=1;$i<=5;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_appeared_exam_total_t'][$i]==0 && $_POST['tot_passed_exam_total_t'][$i]==0) continue;
		
		$dt['class']=$i;
		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_appeared_exam_total_f']=$_POST['tot_appeared_exam_total_f'][$i];
		$dt['tot_appeared_exam_total_m']=$_POST['tot_appeared_exam_total_m'][$i];
		$dt['tot_appeared_exam_total_t']=$_POST['tot_appeared_exam_total_t'][$i];
		$dt['tot_passed_exam_total_f']=$_POST['tot_passed_exam_total_f'][$i];
		$dt['tot_passed_exam_total_m']=$_POST['tot_passed_exam_total_m'][$i];
		$dt['tot_passed_exam_total_t']=$_POST['tot_passed_exam_total_t'][$i];
		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_appeared_exam_dalit_f']=$_POST['tot_appeared_exam_dalit_f'][$i];
		$dt['tot_appeared_exam_dalit_m']=$_POST['tot_appeared_exam_dalit_m'][$i];
		$dt['tot_appeared_exam_dalit_t']=$_POST['tot_appeared_exam_dalit_t'][$i];
		$dt['tot_passed_exam_dalit_f']=$_POST['tot_passed_exam_dalit_f'][$i];
		$dt['tot_passed_exam_dalit_m']=$_POST['tot_passed_exam_dalit_m'][$i];
		$dt['tot_passed_exam_dalit_t']=$_POST['tot_passed_exam_dalit_t'][$i];
		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_appeared_exam_janjati_f']=$_POST['tot_appeared_exam_janjati_f'][$i];
		$dt['tot_appeared_exam_janjati_m']=$_POST['tot_appeared_exam_janjati_m'][$i];
		$dt['tot_appeared_exam_janjati_t']=$_POST['tot_appeared_exam_janjati_t'][$i];
		$dt['tot_passed_exam_janjati_f']=$_POST['tot_passed_exam_janjati_f'][$i];
		$dt['tot_passed_exam_janjati_m']=$_POST['tot_passed_exam_janjati_m'][$i];
		$dt['tot_passed_exam_janjati_t']=$_POST['tot_passed_exam_janjati_t'][$i];
		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_appeared_exam_others_f']=$_POST['tot_appeared_exam_others_f'][$i];
		$dt['tot_appeared_exam_others_m']=$_POST['tot_appeared_exam_others_m'][$i];
		$dt['tot_appeared_exam_others_t']=$_POST['tot_appeared_exam_others_t'][$i];
		$dt['tot_passed_exam_others_f']=$_POST['tot_passed_exam_others_f'][$i];
		$dt['tot_passed_exam_others_m']=$_POST['tot_passed_exam_others_m'][$i];
		$dt['tot_passed_exam_others_t']=$_POST['tot_passed_exam_others_t'][$i];
		
		idata('last_class1_5_enroll_f1',$dt);
	}


}

if ($from=='last_enroll_lsec.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from last_class6_8_enroll_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=6;$i<=8;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_appeared_exam_total_t'][$i]==0 && $_POST['tot_passed_exam_total_t'][$i]==0) continue;
		
		$dt['class']=$i;
		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_appeared_exam_total_f']=$_POST['tot_appeared_exam_total_f'][$i];
		$dt['tot_appeared_exam_total_m']=$_POST['tot_appeared_exam_total_m'][$i];
		$dt['tot_appeared_exam_total_t']=$_POST['tot_appeared_exam_total_t'][$i];
		$dt['tot_passed_exam_total_f']=$_POST['tot_passed_exam_total_f'][$i];
		$dt['tot_passed_exam_total_m']=$_POST['tot_passed_exam_total_m'][$i];
		$dt['tot_passed_exam_total_t']=$_POST['tot_passed_exam_total_t'][$i];
		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_appeared_exam_dalit_f']=$_POST['tot_appeared_exam_dalit_f'][$i];
		$dt['tot_appeared_exam_dalit_m']=$_POST['tot_appeared_exam_dalit_m'][$i];
		$dt['tot_appeared_exam_dalit_t']=$_POST['tot_appeared_exam_dalit_t'][$i];
		$dt['tot_passed_exam_dalit_f']=$_POST['tot_passed_exam_dalit_f'][$i];
		$dt['tot_passed_exam_dalit_m']=$_POST['tot_passed_exam_dalit_m'][$i];
		$dt['tot_passed_exam_dalit_t']=$_POST['tot_passed_exam_dalit_t'][$i];
		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_appeared_exam_janjati_f']=$_POST['tot_appeared_exam_janjati_f'][$i];
		$dt['tot_appeared_exam_janjati_m']=$_POST['tot_appeared_exam_janjati_m'][$i];
		$dt['tot_appeared_exam_janjati_t']=$_POST['tot_appeared_exam_janjati_t'][$i];
		$dt['tot_passed_exam_janjati_f']=$_POST['tot_passed_exam_janjati_f'][$i];
		$dt['tot_passed_exam_janjati_m']=$_POST['tot_passed_exam_janjati_m'][$i];
		$dt['tot_passed_exam_janjati_t']=$_POST['tot_passed_exam_janjati_t'][$i];
		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_appeared_exam_others_f']=$_POST['tot_appeared_exam_others_f'][$i];
		$dt['tot_appeared_exam_others_m']=$_POST['tot_appeared_exam_others_m'][$i];
		$dt['tot_appeared_exam_others_t']=$_POST['tot_appeared_exam_others_t'][$i];
		$dt['tot_passed_exam_others_f']=$_POST['tot_passed_exam_others_f'][$i];
		$dt['tot_passed_exam_others_m']=$_POST['tot_passed_exam_others_m'][$i];
		$dt['tot_passed_exam_others_t']=$_POST['tot_passed_exam_others_t'][$i];
		
		idata('last_class6_8_enroll_f1',$dt);
	}


}




if ($from=='last_enroll_sec.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from last_class9_10_enroll_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=9;$i<=10;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_appeared_exam_total_t'][$i]==0 && $_POST['tot_passed_exam_total_t'][$i]==0) continue;
		
		$dt['class']=$i;
		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_appeared_exam_total_f']=$_POST['tot_appeared_exam_total_f'][$i];
		$dt['tot_appeared_exam_total_m']=$_POST['tot_appeared_exam_total_m'][$i];
		$dt['tot_appeared_exam_total_t']=$_POST['tot_appeared_exam_total_t'][$i];
		$dt['tot_passed_exam_total_f']=$_POST['tot_passed_exam_total_f'][$i];
		$dt['tot_passed_exam_total_m']=$_POST['tot_passed_exam_total_m'][$i];
		$dt['tot_passed_exam_total_t']=$_POST['tot_passed_exam_total_t'][$i];
		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_appeared_exam_dalit_f']=$_POST['tot_appeared_exam_dalit_f'][$i];
		$dt['tot_appeared_exam_dalit_m']=$_POST['tot_appeared_exam_dalit_m'][$i];
		$dt['tot_appeared_exam_dalit_t']=$_POST['tot_appeared_exam_dalit_t'][$i];
		$dt['tot_passed_exam_dalit_f']=$_POST['tot_passed_exam_dalit_f'][$i];
		$dt['tot_passed_exam_dalit_m']=$_POST['tot_passed_exam_dalit_m'][$i];
		$dt['tot_passed_exam_dalit_t']=$_POST['tot_passed_exam_dalit_t'][$i];
		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_appeared_exam_janjati_f']=$_POST['tot_appeared_exam_janjati_f'][$i];
		$dt['tot_appeared_exam_janjati_m']=$_POST['tot_appeared_exam_janjati_m'][$i];
		$dt['tot_appeared_exam_janjati_t']=$_POST['tot_appeared_exam_janjati_t'][$i];
		$dt['tot_passed_exam_janjati_f']=$_POST['tot_passed_exam_janjati_f'][$i];
		$dt['tot_passed_exam_janjati_m']=$_POST['tot_passed_exam_janjati_m'][$i];
		$dt['tot_passed_exam_janjati_t']=$_POST['tot_passed_exam_janjati_t'][$i];
		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_appeared_exam_others_f']=$_POST['tot_appeared_exam_others_f'][$i];
		$dt['tot_appeared_exam_others_m']=$_POST['tot_appeared_exam_others_m'][$i];
		$dt['tot_appeared_exam_others_t']=$_POST['tot_appeared_exam_others_t'][$i];
		$dt['tot_passed_exam_others_f']=$_POST['tot_passed_exam_others_f'][$i];
		$dt['tot_passed_exam_others_m']=$_POST['tot_passed_exam_others_m'][$i];
		$dt['tot_passed_exam_others_t']=$_POST['tot_passed_exam_others_t'][$i];
		
		idata('last_class9_10_enroll_f1',$dt);
	}


}

if ($from=='alternate_sch.php'){

	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from alternate_sch_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($i=1;$i<=6;$i++){
		if ($_POST['alt_sch_t_t'][$i]==0) continue;
	
		$dt['class']=$i;
		$dt['tot_enroll_dalit_f']=$_POST['alt_sch_d_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['alt_sch_d_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['alt_sch_d_t'][$i];
		$dt['tot_enroll_janjati_f']=$_POST['alt_sch_j_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['alt_sch_j_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['alt_sch_j_t'][$i];
		$dt['tot_enroll_others_f']=$_POST['alt_sch_o_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['alt_sch_o_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['alt_sch_o_t'][$i];
		$dt['tot_enroll_total_f']=$_POST['alt_sch_t_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['alt_sch_t_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['alt_sch_t_t'][$i];
		
		idata('alternate_sch_f1',$dt);
	}
	
	
	// after ecd enrollment
	mysql_query("delete from afterecd_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['total_f']=$_POST['ecd_after_total_f_1'];
	$dt['total_m']=$_POST['ecd_after_total_m_1'];
	$dt['total_t']=$_POST['ecd_after_total_t_1'];
	$dt['dalit_f']=$_POST['ecd_after_dalit_f_1'];
	$dt['dalit_m']=$_POST['ecd_after_dalit_m_1'];
	$dt['dalit_t']=$_POST['ecd_after_dalit_t_1'];
	$dt['janjati_f']=$_POST['ecd_after_janjati_f_1'];
	$dt['janjati_m']=$_POST['ecd_after_janjati_m_1'];
	$dt['janjati_t']=$_POST['ecd_after_janjati_t_1'];
	
	if (!checkblank($dt)) idata('afterecd_f1',$dt,'sch_num');	


}

if ($from=='enr_rep_mig_pr.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from enr_rep_mig_class1_5_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=1;$i<=5;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_rep_total_t'][$i]==0 && $_POST['tot_new_enroll_total_t'][$i]==0 && $_POST['tot_tran_total_t'][$i]==0) continue;
		
		$dt['class']=$i;

		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_rep_total_f']=$_POST['tot_rep_total_f'][$i];
		$dt['tot_rep_total_m']=$_POST['tot_rep_total_m'][$i];
		$dt['tot_rep_total_t']=$_POST['tot_rep_total_t'][$i];
		$dt['tot_prom_total_f']=$_POST['tot_prom_total_f'][$i];
		$dt['tot_prom_total_m']=$_POST['tot_prom_total_m'][$i];
		$dt['tot_prom_total_t']=$_POST['tot_prom_total_t'][$i];
		$dt['tot_new_enroll_total_f']=$_POST['tot_new_enroll_total_f'][$i];
		$dt['tot_new_enroll_total_m']=$_POST['tot_new_enroll_total_m'][$i];
		$dt['tot_new_enroll_total_t']=$_POST['tot_new_enroll_total_t'][$i];
		$dt['tot_tran_total_f']=$_POST['tot_tran_total_f'][$i];
		$dt['tot_tran_total_m']=$_POST['tot_tran_total_m'][$i];
		$dt['tot_tran_total_t']=$_POST['tot_tran_total_t'][$i];

		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_rep_dalit_f']=$_POST['tot_rep_dalit_f'][$i];
		$dt['tot_rep_dalit_m']=$_POST['tot_rep_dalit_m'][$i];
		$dt['tot_rep_dalit_t']=$_POST['tot_rep_dalit_t'][$i];
		$dt['tot_prom_dalit_f']=$_POST['tot_prom_dalit_f'][$i];
		$dt['tot_prom_dalit_m']=$_POST['tot_prom_dalit_m'][$i];
		$dt['tot_prom_dalit_t']=$_POST['tot_prom_dalit_t'][$i];
		$dt['tot_new_enroll_dalit_f']=$_POST['tot_new_enroll_dalit_f'][$i];
		$dt['tot_new_enroll_dalit_m']=$_POST['tot_new_enroll_dalit_m'][$i];
		$dt['tot_new_enroll_dalit_t']=$_POST['tot_new_enroll_dalit_t'][$i];
		$dt['tot_tran_dalit_f']=$_POST['tot_tran_dalit_f'][$i];
		$dt['tot_tran_dalit_m']=$_POST['tot_tran_dalit_m'][$i];
		$dt['tot_tran_dalit_t']=$_POST['tot_tran_dalit_t'][$i];

		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_rep_janjati_f']=$_POST['tot_rep_janjati_f'][$i];
		$dt['tot_rep_janjati_m']=$_POST['tot_rep_janjati_m'][$i];
		$dt['tot_rep_janjati_t']=$_POST['tot_rep_janjati_t'][$i];
		$dt['tot_prom_janjati_f']=$_POST['tot_prom_janjati_f'][$i];
		$dt['tot_prom_janjati_m']=$_POST['tot_prom_janjati_m'][$i];
		$dt['tot_prom_janjati_t']=$_POST['tot_prom_janjati_t'][$i];
		$dt['tot_new_enroll_janjati_f']=$_POST['tot_new_enroll_janjati_f'][$i];
		$dt['tot_new_enroll_janjati_m']=$_POST['tot_new_enroll_janjati_m'][$i];
		$dt['tot_new_enroll_janjati_t']=$_POST['tot_new_enroll_janjati_t'][$i];
		$dt['tot_tran_janjati_f']=$_POST['tot_tran_janjati_f'][$i];
		$dt['tot_tran_janjati_m']=$_POST['tot_tran_janjati_m'][$i];
		$dt['tot_tran_janjati_t']=$_POST['tot_tran_janjati_t'][$i];

		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_rep_others_f']=$_POST['tot_rep_others_f'][$i];
		$dt['tot_rep_others_m']=$_POST['tot_rep_others_m'][$i];
		$dt['tot_rep_others_t']=$_POST['tot_rep_others_t'][$i];
		$dt['tot_prom_others_f']=$_POST['tot_prom_others_f'][$i];
		$dt['tot_prom_others_m']=$_POST['tot_prom_others_m'][$i];
		$dt['tot_prom_others_t']=$_POST['tot_prom_others_t'][$i];
		$dt['tot_new_enroll_others_f']=$_POST['tot_new_enroll_others_f'][$i];
		$dt['tot_new_enroll_others_m']=$_POST['tot_new_enroll_others_m'][$i];
		$dt['tot_new_enroll_others_t']=$_POST['tot_new_enroll_others_t'][$i];
		$dt['tot_tran_others_f']=$_POST['tot_tran_others_f'][$i];
		$dt['tot_tran_others_m']=$_POST['tot_tran_others_m'][$i];
		$dt['tot_tran_others_t']=$_POST['tot_tran_others_t'][$i];		

		idata('enr_rep_mig_class1_5_f1',$dt);
	}


}


if ($from=='enr_rep_mig_lsec.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from enr_rep_mig_class6_8_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=6;$i<=8;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_rep_total_t'][$i]==0 && $_POST['tot_new_enroll_total_t'][$i]==0 && $_POST['tot_tran_total_t'][$i]==0) continue;
		
		$dt['class']=$i;

		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_rep_total_f']=$_POST['tot_rep_total_f'][$i];
		$dt['tot_rep_total_m']=$_POST['tot_rep_total_m'][$i];
		$dt['tot_rep_total_t']=$_POST['tot_rep_total_t'][$i];
		$dt['tot_prom_total_f']=$_POST['tot_prom_total_f'][$i];
		$dt['tot_prom_total_m']=$_POST['tot_prom_total_m'][$i];
		$dt['tot_prom_total_t']=$_POST['tot_prom_total_t'][$i];
		$dt['tot_new_enroll_total_f']=$_POST['tot_new_enroll_total_f'][$i];
		$dt['tot_new_enroll_total_m']=$_POST['tot_new_enroll_total_m'][$i];
		$dt['tot_new_enroll_total_t']=$_POST['tot_new_enroll_total_t'][$i];
		$dt['tot_tran_total_f']=$_POST['tot_tran_total_f'][$i];
		$dt['tot_tran_total_m']=$_POST['tot_tran_total_m'][$i];
		$dt['tot_tran_total_t']=$_POST['tot_tran_total_t'][$i];

		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_rep_dalit_f']=$_POST['tot_rep_dalit_f'][$i];
		$dt['tot_rep_dalit_m']=$_POST['tot_rep_dalit_m'][$i];
		$dt['tot_rep_dalit_t']=$_POST['tot_rep_dalit_t'][$i];
		$dt['tot_prom_dalit_f']=$_POST['tot_prom_dalit_f'][$i];
		$dt['tot_prom_dalit_m']=$_POST['tot_prom_dalit_m'][$i];
		$dt['tot_prom_dalit_t']=$_POST['tot_prom_dalit_t'][$i];
		$dt['tot_new_enroll_dalit_f']=$_POST['tot_new_enroll_dalit_f'][$i];
		$dt['tot_new_enroll_dalit_m']=$_POST['tot_new_enroll_dalit_m'][$i];
		$dt['tot_new_enroll_dalit_t']=$_POST['tot_new_enroll_dalit_t'][$i];
		$dt['tot_tran_dalit_f']=$_POST['tot_tran_dalit_f'][$i];
		$dt['tot_tran_dalit_m']=$_POST['tot_tran_dalit_m'][$i];
		$dt['tot_tran_dalit_t']=$_POST['tot_tran_dalit_t'][$i];

		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_rep_janjati_f']=$_POST['tot_rep_janjati_f'][$i];
		$dt['tot_rep_janjati_m']=$_POST['tot_rep_janjati_m'][$i];
		$dt['tot_rep_janjati_t']=$_POST['tot_rep_janjati_t'][$i];
		$dt['tot_prom_janjati_f']=$_POST['tot_prom_janjati_f'][$i];
		$dt['tot_prom_janjati_m']=$_POST['tot_prom_janjati_m'][$i];
		$dt['tot_prom_janjati_t']=$_POST['tot_prom_janjati_t'][$i];
		$dt['tot_new_enroll_janjati_f']=$_POST['tot_new_enroll_janjati_f'][$i];
		$dt['tot_new_enroll_janjati_m']=$_POST['tot_new_enroll_janjati_m'][$i];
		$dt['tot_new_enroll_janjati_t']=$_POST['tot_new_enroll_janjati_t'][$i];
		$dt['tot_tran_janjati_f']=$_POST['tot_tran_janjati_f'][$i];
		$dt['tot_tran_janjati_m']=$_POST['tot_tran_janjati_m'][$i];
		$dt['tot_tran_janjati_t']=$_POST['tot_tran_janjati_t'][$i];

		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_rep_others_f']=$_POST['tot_rep_others_f'][$i];
		$dt['tot_rep_others_m']=$_POST['tot_rep_others_m'][$i];
		$dt['tot_rep_others_t']=$_POST['tot_rep_others_t'][$i];
		$dt['tot_prom_others_f']=$_POST['tot_prom_others_f'][$i];
		$dt['tot_prom_others_m']=$_POST['tot_prom_others_m'][$i];
		$dt['tot_prom_others_t']=$_POST['tot_prom_others_t'][$i];
		$dt['tot_new_enroll_others_f']=$_POST['tot_new_enroll_others_f'][$i];
		$dt['tot_new_enroll_others_m']=$_POST['tot_new_enroll_others_m'][$i];
		$dt['tot_new_enroll_others_t']=$_POST['tot_new_enroll_others_t'][$i];
		$dt['tot_tran_others_f']=$_POST['tot_tran_others_f'][$i];
		$dt['tot_tran_others_m']=$_POST['tot_tran_others_m'][$i];
		$dt['tot_tran_others_t']=$_POST['tot_tran_others_t'][$i];		

		idata('enr_rep_mig_class6_8_f1',$dt);
	}


}


if ($from=='enr_rep_mig_sec.php'){
	$dt=array();
	
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	mysql_query("delete from enr_rep_mig_class9_10_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=9;$i<=10;$i++){
	
		if ($_POST['tot_enroll_total_t'][$i]==0 && $_POST['tot_rep_total_t'][$i]==0 && $_POST['tot_new_enroll_total_t'][$i]==0 && $_POST['tot_tran_total_t'][$i]==0) continue;
		
		$dt['class']=$i;

		$dt['tot_enroll_total_f']=$_POST['tot_enroll_total_f'][$i];
		$dt['tot_enroll_total_m']=$_POST['tot_enroll_total_m'][$i];
		$dt['tot_enroll_total_t']=$_POST['tot_enroll_total_t'][$i];
		$dt['tot_rep_total_f']=$_POST['tot_rep_total_f'][$i];
		$dt['tot_rep_total_m']=$_POST['tot_rep_total_m'][$i];
		$dt['tot_rep_total_t']=$_POST['tot_rep_total_t'][$i];
		$dt['tot_prom_total_f']=$_POST['tot_prom_total_f'][$i];
		$dt['tot_prom_total_m']=$_POST['tot_prom_total_m'][$i];
		$dt['tot_prom_total_t']=$_POST['tot_prom_total_t'][$i];
		$dt['tot_new_enroll_total_f']=$_POST['tot_new_enroll_total_f'][$i];
		$dt['tot_new_enroll_total_m']=$_POST['tot_new_enroll_total_m'][$i];
		$dt['tot_new_enroll_total_t']=$_POST['tot_new_enroll_total_t'][$i];
		$dt['tot_tran_total_f']=$_POST['tot_tran_total_f'][$i];
		$dt['tot_tran_total_m']=$_POST['tot_tran_total_m'][$i];
		$dt['tot_tran_total_t']=$_POST['tot_tran_total_t'][$i];

		$dt['tot_enroll_dalit_f']=$_POST['tot_enroll_dalit_f'][$i];
		$dt['tot_enroll_dalit_m']=$_POST['tot_enroll_dalit_m'][$i];
		$dt['tot_enroll_dalit_t']=$_POST['tot_enroll_dalit_t'][$i];
		$dt['tot_rep_dalit_f']=$_POST['tot_rep_dalit_f'][$i];
		$dt['tot_rep_dalit_m']=$_POST['tot_rep_dalit_m'][$i];
		$dt['tot_rep_dalit_t']=$_POST['tot_rep_dalit_t'][$i];
		$dt['tot_prom_dalit_f']=$_POST['tot_prom_dalit_f'][$i];
		$dt['tot_prom_dalit_m']=$_POST['tot_prom_dalit_m'][$i];
		$dt['tot_prom_dalit_t']=$_POST['tot_prom_dalit_t'][$i];
		$dt['tot_new_enroll_dalit_f']=$_POST['tot_new_enroll_dalit_f'][$i];
		$dt['tot_new_enroll_dalit_m']=$_POST['tot_new_enroll_dalit_m'][$i];
		$dt['tot_new_enroll_dalit_t']=$_POST['tot_new_enroll_dalit_t'][$i];
		$dt['tot_tran_dalit_f']=$_POST['tot_tran_dalit_f'][$i];
		$dt['tot_tran_dalit_m']=$_POST['tot_tran_dalit_m'][$i];
		$dt['tot_tran_dalit_t']=$_POST['tot_tran_dalit_t'][$i];

		$dt['tot_enroll_janjati_f']=$_POST['tot_enroll_janjati_f'][$i];
		$dt['tot_enroll_janjati_m']=$_POST['tot_enroll_janjati_m'][$i];
		$dt['tot_enroll_janjati_t']=$_POST['tot_enroll_janjati_t'][$i];
		$dt['tot_rep_janjati_f']=$_POST['tot_rep_janjati_f'][$i];
		$dt['tot_rep_janjati_m']=$_POST['tot_rep_janjati_m'][$i];
		$dt['tot_rep_janjati_t']=$_POST['tot_rep_janjati_t'][$i];
		$dt['tot_prom_janjati_f']=$_POST['tot_prom_janjati_f'][$i];
		$dt['tot_prom_janjati_m']=$_POST['tot_prom_janjati_m'][$i];
		$dt['tot_prom_janjati_t']=$_POST['tot_prom_janjati_t'][$i];
		$dt['tot_new_enroll_janjati_f']=$_POST['tot_new_enroll_janjati_f'][$i];
		$dt['tot_new_enroll_janjati_m']=$_POST['tot_new_enroll_janjati_m'][$i];
		$dt['tot_new_enroll_janjati_t']=$_POST['tot_new_enroll_janjati_t'][$i];
		$dt['tot_tran_janjati_f']=$_POST['tot_tran_janjati_f'][$i];
		$dt['tot_tran_janjati_m']=$_POST['tot_tran_janjati_m'][$i];
		$dt['tot_tran_janjati_t']=$_POST['tot_tran_janjati_t'][$i];

		$dt['tot_enroll_others_f']=$_POST['tot_enroll_others_f'][$i];
		$dt['tot_enroll_others_m']=$_POST['tot_enroll_others_m'][$i];
		$dt['tot_enroll_others_t']=$_POST['tot_enroll_others_t'][$i];
		$dt['tot_rep_others_f']=$_POST['tot_rep_others_f'][$i];
		$dt['tot_rep_others_m']=$_POST['tot_rep_others_m'][$i];
		$dt['tot_rep_others_t']=$_POST['tot_rep_others_t'][$i];
		$dt['tot_prom_others_f']=$_POST['tot_prom_others_f'][$i];
		$dt['tot_prom_others_m']=$_POST['tot_prom_others_m'][$i];
		$dt['tot_prom_others_t']=$_POST['tot_prom_others_t'][$i];
		$dt['tot_new_enroll_others_f']=$_POST['tot_new_enroll_others_f'][$i];
		$dt['tot_new_enroll_others_m']=$_POST['tot_new_enroll_others_m'][$i];
		$dt['tot_new_enroll_others_t']=$_POST['tot_new_enroll_others_t'][$i];
		$dt['tot_tran_others_f']=$_POST['tot_tran_others_f'][$i];
		$dt['tot_tran_others_m']=$_POST['tot_tran_others_m'][$i];
		$dt['tot_tran_others_t']=$_POST['tot_tran_others_t'][$i];		

		idata('enr_rep_mig_class9_10_f1',$dt);
	}


}

if ($from=='enroll_age_pr.php'){
	
	$age_suffix[1]=array("_l5","_5","_6","_7","_8","_9","_g9","_t");
	$age_suffix[2]=array("_l6","_6","_7","_8","_9","_g9","_t");
	$age_suffix[3]=array("_l7","_7","_8","_9","_10","_g10","_t");
	$age_suffix[4]=array("_l8","_8","_9","_10","_11","_g11","_t");
	$age_suffix[5]=array("_l9","_9","_10","_11","_12","_g12","_t");
	
	// new enrollment
	
	mysql_query("delete from new_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from new_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from new_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=1;$i<=1;$i++){
		$dt=array();
		$dtd=array();
		$dtj=array();
		
		$dt['sch_num']=$dtd['sch_num']=$dtj['sch_num']=$schoolcode;
		$dt['sch_year']=$dtd['sch_year']=$dtj['sch_year']=$currentyear;
		$dt['class']=$dtd['class']=$dtj['class']=$i;

		if ($_POST['total_newenr_age_t_t'][$i]==0 && $_POST['dalit_newenr_age_t_t'][$i]==0 && $_POST['janjati_newenr_age_t_t'][$i]==0) continue;
		
		for ($j=0;$j<count($age_suffix[$i])-1;$j++){

			$dt['f'.$age_suffix[$i][$j]]=$_POST['total_newenr_age_f'.$age_suffix[$i][$j]][$i];
			$dt['m'.$age_suffix[$i][$j]]=$_POST['total_newenr_age_m'.$age_suffix[$i][$j]][$i];
			$dt['t'.$age_suffix[$i][$j]]=$_POST['total_newenr_age_t'.$age_suffix[$i][$j]][$i];

			$dtd['f'.$age_suffix[$i][$j]]=$_POST['dalit_newenr_age_f'.$age_suffix[$i][$j]][$i];
			$dtd['m'.$age_suffix[$i][$j]]=$_POST['dalit_newenr_age_m'.$age_suffix[$i][$j]][$i];
			$dtd['t'.$age_suffix[$i][$j]]=$_POST['dalit_newenr_age_t'.$age_suffix[$i][$j]][$i];

			$dtj['f'.$age_suffix[$i][$j]]=$_POST['janjati_newenr_age_f'.$age_suffix[$i][$j]][$i];
			$dtj['m'.$age_suffix[$i][$j]]=$_POST['janjati_newenr_age_m'.$age_suffix[$i][$j]][$i];
			$dtj['t'.$age_suffix[$i][$j]]=$_POST['janjati_newenr_age_t'.$age_suffix[$i][$j]][$i];
			
		
		}
		
		idata('new_total_enroll_age_f1',$dt);
		idata('new_dalit_enroll_age_f1',$dtd);
		idata('new_janjati_enroll_age_f1',$dtj);
		
		unset($dt);
		unset($dtd);
		unset($dtj);
	}
	
	
	
	mysql_query("delete from pr_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from pr_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from pr_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	//echo2file(serialize($_POST));
	
	for ($i=1;$i<=5;$i++){
		$dt=array();
		$dtd=array();
		$dtj=array();
		
		$dt['sch_num']=$dtd['sch_num']=$dtj['sch_num']=$schoolcode;
		$dt['sch_year']=$dtd['sch_year']=$dtj['sch_year']=$currentyear;
		$dt['class']=$dtd['class']=$dtj['class']=$i;

		if ($_POST['total_enroll_age_t_t'][$i]==0 && $_POST['dalit_enroll_age_t_t'][$i]==0 && $_POST['janjati_enroll_age_t_t'][$i]==0) continue;
		
		for ($j=0;$j<count($age_suffix[$i])-1;$j++){

			$dt['f'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dt['m'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dt['t'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtd['f'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtd['m'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtd['t'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtj['f'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtj['m'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtj['t'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_t'.$age_suffix[$i][$j]][$i];
			
		
		}
		
		idata('pr_total_enroll_age_f1',$dt);
		idata('pr_dalit_enroll_age_f1',$dtd);
		idata('pr_janjati_enroll_age_f1',$dtj);
		
		unset($dt);
		unset($dtd);
		unset($dtj);
	}

	
}



if ($from=='enroll_age_lsec.php'){
		
	$age_suffix[6]=array("_l10","_10","_11","_12","_13","_14","_g14","_t");
	$age_suffix[7]=array("_l11","_11","_12","_13","_14","_g14","_t");
	$age_suffix[8]=array("_l12","_12","_13","_14","_15","_g15","_t");

	mysql_query("delete from sec_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=6 || class=7 || class=8)");
	mysql_query("delete from sec_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=6 || class=7 || class=8)");
	mysql_query("delete from sec_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=6 || class=7 || class=8)");

	//echo2file(serialize($_POST));
	
	for ($i=6;$i<=8;$i++){
		$dt=array();
		$dtd=array();
		$dtj=array();
		
		$dt['sch_num']=$dtd['sch_num']=$dtj['sch_num']=$schoolcode;
		$dt['sch_year']=$dtd['sch_year']=$dtj['sch_year']=$currentyear;
		$dt['class']=$dtd['class']=$dtj['class']=$i;

		if ($_POST['total_enroll_age_t_t'][$i]==0 && $_POST['dalit_enroll_age_t_t'][$i]==0 && $_POST['janjati_enroll_age_t_t'][$i]==0) continue;
		
		for ($j=0;$j<count($age_suffix[$i])-1;$j++){

			$dt['f'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dt['m'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dt['t'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtd['f'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtd['m'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtd['t'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtj['f'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtj['m'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtj['t'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_t'.$age_suffix[$i][$j]][$i];
			
		
		}
		
		idata('sec_total_enroll_age_f1',$dt);
		idata('sec_dalit_enroll_age_f1',$dtd);
		idata('sec_janjati_enroll_age_f1',$dtj);
		
		unset($dt);
		unset($dtd);
		unset($dtj);
	}

	
}


if ($from=='enroll_age_sec.php'){
	
	$age_suffix[9]=array("_l13","_13","_14","_15","_16","_g16","_t");
	$age_suffix[10]=array("_l14","_14","_15","_16","_17","_g17","_t");
	
	mysql_query("delete from sec_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=9 || class=10)");
	mysql_query("delete from sec_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=9 || class=10)");
	mysql_query("delete from sec_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and (class=9 || class=10)");

	//echo2file(serialize($_POST));
	
	for ($i=9;$i<=10;$i++){
		$dt=array();
		$dtd=array();
		$dtj=array();
		
		$dt['sch_num']=$dtd['sch_num']=$dtj['sch_num']=$schoolcode;
		$dt['sch_year']=$dtd['sch_year']=$dtj['sch_year']=$currentyear;
		$dt['class']=$dtd['class']=$dtj['class']=$i;

		if ($_POST['total_enroll_age_t_t'][$i]==0 && $_POST['dalit_enroll_age_t_t'][$i]==0 && $_POST['janjati_enroll_age_t_t'][$i]==0) continue;
		
		for ($j=0;$j<count($age_suffix[$i])-1;$j++){

			$dt['f'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dt['m'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dt['t'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtd['f'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtd['m'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtd['t'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtj['f'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtj['m'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtj['t'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_t'.$age_suffix[$i][$j]][$i];
			
		
		}
		
		idata('sec_total_enroll_age_f1',$dt);
		idata('sec_dalit_enroll_age_f1',$dtd);
		idata('sec_janjati_enroll_age_f1',$dtj);
		
		unset($dt);
		unset($dtd);
		unset($dtj);
	}

	
}


if ($from=='disability.php'){

	mysql_query("delete from ecd_disabled_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from pr_disabled_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from lsec_disabled_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from sec_disabled_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from hsec_disabled_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	

	for ($i=0;$i<=12;$i++){
		for ($j=1;$j<=8;$j++){
			$dt=array();
			$dt['sch_num']=$schoolcode;
			$dt['sch_year']=$currentyear;	
			$dt['class']=$i;
			$dt['disability_type_id']=$j;
			$dt['disabled_f']=$_POST['disabled_'.$j.'_f'][$i];
			$dt['disabled_m']=$_POST['disabled_'.$j.'_m'][$i];
			$dt['disabled_t']=$_POST['disabled_'.$j.'_t'][$i];
			
			if ($dt['disabled_t']==0) continue;
			
			if ($i==0) idata('ecd_disabled_f1',$dt);
			if ($i>=1 && $i<=5) idata('pr_disabled_f1',$dt);
			if ($i>=6 && $i<=8) idata('lsec_disabled_f1',$dt);
			if ($i>=9 && $i<=10) idata('sec_disabled_f1',$dt);
			if ($i>=11 && $i<=12) idata('hsec_disabled_f1',$dt);
			
			unset($dt);
		
		}
	
	}
	
}

if ($from=='languages.php'){
	mysql_query("delete from language_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($i=1;$i<=5;$i++){
		if ($_POST["lang_$i"]=='') continue;
		
		for ($cl=1;$cl<=5;$cl++){
			
			$dt=array();
			$dt['sch_num']=$schoolcode;
			$dt['sch_year']=$currentyear;
			$dt['language']=$_POST["lang_$i"];
			$dt['class']=$cl;
			$dt['female']=$_POST["lang_class${cl}_f"][$i];
			$dt['male']=$_POST["lang_class${cl}_m"][$i];
			$dt['total']=$_POST["lang_class${cl}_t"][$i];
			
			if (!checkblank($dt)) idata('language_f1',$dt);
			
			unset($dt);			
			
		}


	}	
}

if ($from=='janjati.php'){
	mysql_query("delete from janjati_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$janjati_type = array('Kusunda',
							'Bankaria',
							'Raute',
							'Surel',
							'Hayu',
							'Raji',
							'Kisan',
							'Lopcha',
							'Meche',
							'Mushbadiya',
							'Majhi',
							'Siyar',
							'Singsa',
							'Thunam',
							'Dhanuk',
							'Chepang',
							'Satar',
							'Jhagad',
							'Thami',
							'Bote',
							'Danuwar',
							'Baramu');
	
	for ($c=1;$c<=12;$c++){
		foreach(array("t") as $t){
			for ($j=0;$j<22;$j++){
				if ($_POST["janjati_{$c}_{$j}_{$t}"]=='') continue;
				
				$dt=array();
				$dt['sch_num']=$schoolcode;
				$dt['sch_year']=$currentyear;
				$dt['janjati_type']=$janjati_type[$j];
				$dt['class']=$c;
				$dt['total_f']=$_POST["janjati_{$c}_{$j}_f"];
				$dt['total_m']=$_POST["janjati_{$c}_{$j}_m"];
				$dt['total_t']=$_POST["janjati_{$c}_{$j}_t"];
			
				if (!checkblank($dt)) idata('janjati_f1',$dt);
				
				unset($dt);				
			}
		}
	}
	
	mysql_query("delete from support_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;


	$dt['scholarship']=$_POST['scholarship'];
	$dt['scholarship_amount']=$_POST['scholarship_amount'];
	$dt['block_grant']=$_POST['block_grant'];
	$dt['block_grant_amount']=$_POST['block_grant_amount'];
	$dt['salary_support']=$_POST['salary_support'];
	$dt['salary_support_amount']=$_POST['salary_support_amount'];
	$dt['other_support']=$_POST['other_support'];
	$dt['other_support_amount']=$_POST['other_support_amount'];

	if (!checkblank($dt)) idata('support_f1',$dt,'sch_num');	
	
}


if ($from == 'teacher_details.php'){
	// headmaster
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	mysql_query("delete from headmaster_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt['headmaster']=$_POST['headmaster_sex'];
	$dt['hmaster_status']=$_POST['headmaster_caste'];
	$dt['hmaster_initial_status']=$_POST['headmaster_initial_status'];
	$dt['hmaster_training']=$_POST['headmaster_training'];
	
	if (!checkblank($dt)) idata('headmaster_f1',$dt,'sch_num');
	
	unset($dt);

	// rahat
	mysql_query("delete from teacher_rahat_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['rahat_pri']=$_POST['rahat_pri'];
	$dt['rahat_lsec']=$_POST['rahat_lsec'];
	$dt['rahat_sec']=$_POST['rahat_sec'];	
	$dt['rahat_hsec']=$_POST['rahat_hsec'];	
	
	if (!checkblank($dt)) {
		$dt['rahat_received']=1;
		idata('teacher_rahat_f1',$dt,'sch_num');
	}
	unset($dt);
	
	// pcf
	mysql_query("delete from teacher_pcf_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['pcf_full_pri']=$_POST['pcf_full_pri'];
	$dt['pcf_full_lsec']=$_POST['pcf_full_lsec'];
	$dt['pcf_full_sec']=$_POST['pcf_full_sec'];
	$dt['pcf_full_hsec']=$_POST['pcf_full_hsec'];
	$dt['pcf_par_pri']=$_POST['pcf_par_pri'];
	$dt['pcf_par_lsec']=$_POST['pcf_par_lsec'];
	$dt['pcf_par_sec']=$_POST['pcf_par_sec'];
	$dt['pcf_par_hsec']=$_POST['pcf_par_hsec'];
	
	if (!checkblank($dt)) {
		idata('teacher_pcf_f1',$dt,'sch_num');
	}
	unset($dt);	
	

	// mother language
	mysql_query("delete from teacher_language_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
		
	$dt['mother_lang']=$_POST['mother_lang'];
	$dt['teacher_available']=$_POST['mother_lang_teacher_available'];
	$dt['teacher_f']=$_POST['mother_lang_f'];
	$dt['teacher_m']=$_POST['mother_lang_m'];
	$dt['teacher_t']=$_POST['mother_lang_t'];
	
	if (!checkblank($dt)) idata('teacher_language_f1',$dt,'sch_num');
	
	unset($dt);	

	
	// teacher data
	for ($i=1;$i<=4;$i++){
		if ($i==1) $table = "pri_teacher_details_f1";
		if ($i==2) $table = "lsec_teacher_details_f1";
		if ($i==3) $table = "sec_teacher_details_f1";
		if ($i==4) $table = "hsec_teacher_details_f1";
		
		mysql_query("delete from $table where sch_num='$schoolcode' and sch_year='$currentyear'");
		
		$dt=array();
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;
		
		$dt['total_a_teachers']=$_POST['total_a_teachers'][$i];
		$dt['total_f_teachers']=$_POST['total_f_teachers'][$i];
		$dt['total_m_teachers']=$_POST['total_m_teachers'][$i];
		$dt['total_t_teachers']=$_POST['total_t_teachers'][$i];
		$dt['grant_f']=$_POST['grant_f'][$i];
		$dt['grant_m']=$_POST['grant_m'][$i];
		$dt['grant_t']=$_POST['grant_t'][$i];
		$dt['private_f']=$_POST['private_f'][$i];
		$dt['private_m']=$_POST['private_m'][$i];
		$dt['private_t']=$_POST['private_t'][$i];
		$dt['dalit_f_teachers']=$_POST['dalit_f_teachers'][$i];
		$dt['dalit_m_teachers']=$_POST['dalit_m_teachers'][$i];
		$dt['dalit_t_teachers']=$_POST['dalit_t_teachers'][$i];
		$dt['janjati_f_teachers']=$_POST['janjati_f_teachers'][$i];
		$dt['janjati_m_teachers']=$_POST['janjati_m_teachers'][$i];
		$dt['janjati_t_teachers']=$_POST['janjati_t_teachers'][$i];
		$dt['disabled_f_teachers']=$_POST['disabled_f_teachers'][$i];
		$dt['disabled_m_teachers']=$_POST['disabled_m_teachers'][$i];
		$dt['disabled_t_teachers']=$_POST['disabled_t_teachers'][$i];
		$dt['perm_f']=$_POST['perm_f'][$i];
		$dt['perm_m']=$_POST['perm_m'][$i];
		$dt['perm_t']=$_POST['perm_t'][$i];
		$dt['temp_f']=$_POST['temp_f'][$i];
		$dt['temp_m']=$_POST['temp_m'][$i];
		$dt['temp_t']=$_POST['temp_t'][$i];
		$dt['under_slc_f']=$_POST['under_slc_f'][$i];
		$dt['under_slc_m']=$_POST['under_slc_m'][$i];
		$dt['under_slc_t']=$_POST['under_slc_t'][$i];
		$dt['slc_f']=$_POST['slc_f'][$i];
		$dt['slc_m']=$_POST['slc_m'][$i];
		$dt['slc_t']=$_POST['slc_t'][$i];
		$dt['ia_f']=$_POST['ia_f'][$i];
		$dt['ia_m']=$_POST['ia_m'][$i];
		$dt['ia_t']=$_POST['ia_t'][$i];
		$dt['ba_f']=$_POST['ba_f'][$i];
		$dt['ba_m']=$_POST['ba_m'][$i];
		$dt['ba_t']=$_POST['ba_t'][$i];
		$dt['ma_f']=$_POST['ma_f'][$i];
		$dt['ma_m']=$_POST['ma_m'][$i];
		$dt['ma_t']=$_POST['ma_t'][$i];
		$dt['phd_f']=$_POST['phd_f'][$i];
		$dt['phd_m']=$_POST['phd_m'][$i];
		$dt['phd_t']=$_POST['phd_t'][$i];		
		
		if (!checkblank($dt)) idata($table,$dt,'sch_num');
		
		unset($dt);
		
	}
	
	
}

/*

if ($from == "teacher_details.php"){
	// headmaster
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['headmaster']=$_POST['headmaster_sex'];
	$dt['hmaster_status']=$_POST['headmaster_caste'];
	$dt['hmaster_initial_status']=$_POST['headmaster_initial_status'];
	$dt['hmaster_training']=$_POST['headmaster_training'];
	
	iudata('headmaster_f1',$dt,'sch_num');
	
	unset($dt);
	
	// rahat
	mysql_query("delete from teacher_rahat_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['rahat_received']=$_POST['teacher_rahat'];
	$dt['rahat_pri']=$_POST['teacher_rahat']==1?$_POST['teacher_rahat_pri']:'';
	$dt['rahat_lsec']=$_POST['teacher_rahat']==1?$_POST['teacher_rahat_lsec']:'';
	$dt['rahat_sec']=$_POST['teacher_rahat']==1?$_POST['teacher_rahat_sec']:'';
	
	if (!checkblank($dt)) idata('teacher_rahat_f1',$dt,'sch_num');
	
	unset($dt);	
	
	// mother language
	mysql_query("delete from teacher_language_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
		
	$dt['mother_lang']=$_POST['mother_lang'];
	$dt['teacher_available']=$_POST['mother_lang_teacher_available'];
	$dt['teacher_f']=$_POST['mother_lang_f'];
	$dt['teacher_m']=$_POST['mother_lang_m'];
	$dt['teacher_t']=$_POST['mother_lang_t'];
	
	if (!checkblank($dt)) idata('teacher_language_f1',$dt,'sch_num');
	
	unset($dt);		
	
	
	// primary
	
	mysql_query("delete from pri_teacher_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['total_a_teachers']=$_POST['pri_total_a_teachers'];
	$dt['total_f_teachers']=$_POST['pri_total_f_teachers'];
	$dt['total_m_teachers']=$_POST['pri_total_m_teachers'];
	$dt['total_t_teachers']=$_POST['pri_total_t_teachers'];

	$dt['dalit_f_teachers']=$_POST['pri_dalit_f_teachers'];
	$dt['dalit_m_teachers']=$_POST['pri_dalit_m_teachers'];
	$dt['dalit_t_teachers']=$_POST['pri_dalit_f_teachers']*1+$_POST['pri_dalit_m_teachers']*1;

	$dt['janjati_f_teachers']=$_POST['pri_janjati_f_teachers'];
	$dt['janjati_m_teachers']=$_POST['pri_janjati_m_teachers'];
	$dt['janjati_t_teachers']=$_POST['pri_janjati_f_teachers']*1+$_POST['pri_janjati_m_teachers']*1;

	$dt['disabled_f_teachers']=$_POST['pri_disabled_f_teachers'];
	$dt['disabled_m_teachers']=$_POST['pri_disabled_m_teachers'];
	$dt['disabled_t_teachers']=$_POST['pri_disabled_f_teachers']*1+$_POST['pri_disabled_m_teachers']*1;

	$dt['work_total']=$_POST['pri_work_total'];
	$dt['perm_f']=$_POST['pri_perm_f'];
	$dt['perm_m']=$_POST['pri_perm_m'];
	$dt['perm_t']=$_POST['pri_perm_f']*1+$_POST['pri_perm_m']*1;

	$dt['temp_f']=$_POST['pri_temp_f'];
	$dt['temp_m']=$_POST['pri_temp_m'];
	$dt['temp_t']=$_POST['pri_temp_f']*1+$_POST['pri_temp_m']*1;

	$dt['grant_f']=$_POST['pri_grant_f'];
	$dt['grant_m']=$_POST['pri_grant_m'];
	$dt['grant_t']=$_POST['pri_grant_f']*1+$_POST['pri_grant_m']*1;

	$dt['private_f']=$_POST['pri_private_f'];
	$dt['private_m']=$_POST['pri_private_m'];
	$dt['private_t']=$_POST['pri_private_f']*1+$_POST['pri_private_m']*1;

	$dt['under_slc_f']=$_POST['pri_under_slc_f'];
	$dt['under_slc_m']=$_POST['pri_under_slc_m'];
	$dt['under_slc_t']=$_POST['pri_under_slc_f']*1+$_POST['pri_under_slc_m']*1;

	$dt['slc_f']=$_POST['pri_slc_f'];
	$dt['slc_m']=$_POST['pri_slc_m'];
	$dt['slc_t']=$_POST['pri_slc_f']*1+$_POST['pri_slc_m']*1;

	$dt['ia_f']=$_POST['pri_ia_f'];
	$dt['ia_m']=$_POST['pri_ia_m'];
	$dt['ia_t']=$_POST['pri_ia_f']*1+$_POST['pri_ia_m']*1;

	$dt['ba_f']=$_POST['pri_ba_f'];
	$dt['ba_m']=$_POST['pri_ba_m'];
	$dt['ba_t']=$_POST['pri_ba_f']*1+$_POST['pri_ba_m']*1;

	$dt['ma_f']=$_POST['pri_ma_f'];
	$dt['ma_m']=$_POST['pri_ma_m'];
	$dt['ma_t']=$_POST['pri_ma_f']*1+$_POST['pri_ma_m']*1;

	$dt['first_level']=$_POST['pri_first_level'];
	$dt['second_level']=$_POST['pri_second_level'];
	$dt['third_level']=$_POST['pri_third_level'];
	$dt['teacher_deo']=$_POST['pri_teacher_deo'];
	$dt['teacher_community']=$_POST['pri_teacher_community'];
	$dt['teacher_others']=$_POST['pri_teacher_others'];	
	
	if (!checkblank($dt)) idata('pri_teacher_details_f1',$dt,'sch_num');
	unset($dt);
	

	// primary dalit teachers
	
	mysql_query("delete from pri_teacher_details_dalit_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['perm_f']=$_POST['pri_dalit_perm_f'];
	$dt['perm_m']=$_POST['pri_dalit_perm_m'];
	$dt['perm_t']=$_POST['pri_dalit_perm_f']*1+$_POST['pri_dalit_perm_m']*1;

	$dt['temp_f']=$_POST['pri_dalit_temp_f'];
	$dt['temp_m']=$_POST['pri_dalit_temp_m'];
	$dt['temp_t']=$_POST['pri_dalit_temp_f']*1+$_POST['pri_dalit_temp_m']*1;

	$dt['grant_f']=$_POST['pri_dalit_grant_f'];
	$dt['grant_m']=$_POST['pri_dalit_grant_m'];
	$dt['grant_t']=$_POST['pri_dalit_grant_f']*1+$_POST['pri_dalit_grant_m']*1;

	$dt['private_f']=$_POST['pri_dalit_private_f'];
	$dt['private_m']=$_POST['pri_dalit_private_m'];
	$dt['private_t']=$_POST['pri_dalit_private_f']*1+$_POST['pri_dalit_private_m']*1;

	$dt['under_slc_f']=$_POST['pri_dalit_under_slc_f'];
	$dt['under_slc_m']=$_POST['pri_dalit_under_slc_m'];
	$dt['under_slc_t']=$_POST['pri_dalit_under_slc_f']*1+$_POST['pri_dalit_under_slc_m']*1;

	$dt['slc_f']=$_POST['pri_dalit_slc_f'];
	$dt['slc_m']=$_POST['pri_dalit_slc_m'];
	$dt['slc_t']=$_POST['pri_dalit_slc_f']*1+$_POST['pri_dalit_slc_m']*1;

	$dt['ia_f']=$_POST['pri_dalit_ia_f'];
	$dt['ia_m']=$_POST['pri_dalit_ia_m'];
	$dt['ia_t']=$_POST['pri_dalit_ia_f']*1+$_POST['pri_dalit_ia_m']*1;

	$dt['ba_f']=$_POST['pri_dalit_ba_f'];
	$dt['ba_m']=$_POST['pri_dalit_ba_m'];
	$dt['ba_t']=$_POST['pri_dalit_ba_f']*1+$_POST['pri_dalit_ba_m']*1;

	$dt['ma_f']=$_POST['pri_dalit_ma_f'];
	$dt['ma_m']=$_POST['pri_dalit_ma_m'];
	$dt['ma_t']=$_POST['pri_dalit_ma_f']*1+$_POST['pri_dalit_ma_m']*1;

	$dt['first_level']=$_POST['pri_dalit_first_level'];
	$dt['second_level']=$_POST['pri_dalit_second_level'];
	$dt['third_level']=$_POST['pri_dalit_third_level'];
	
	if (!checkblank($dt)) idata('pri_teacher_details_dalit_f1',$dt,'sch_num');
	unset($dt);
	

	// primary janjati teachers
	
	mysql_query("delete from pri_teacher_details_janjati_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['perm_f']=$_POST['pri_janjati_perm_f'];
	$dt['perm_m']=$_POST['pri_janjati_perm_m'];
	$dt['perm_t']=$_POST['pri_janjati_perm_f']*1+$_POST['pri_janjati_perm_m']*1;

	$dt['temp_f']=$_POST['pri_janjati_temp_f'];
	$dt['temp_m']=$_POST['pri_janjati_temp_m'];
	$dt['temp_t']=$_POST['pri_janjati_temp_f']*1+$_POST['pri_janjati_temp_m']*1;

	$dt['grant_f']=$_POST['pri_janjati_grant_f'];
	$dt['grant_m']=$_POST['pri_janjati_grant_m'];
	$dt['grant_t']=$_POST['pri_janjati_grant_f']*1+$_POST['pri_janjati_grant_m']*1;

	$dt['private_f']=$_POST['pri_janjati_private_f'];
	$dt['private_m']=$_POST['pri_janjati_private_m'];
	$dt['private_t']=$_POST['pri_janjati_private_f']*1+$_POST['pri_janjati_private_m']*1;

	$dt['under_slc_f']=$_POST['pri_janjati_under_slc_f'];
	$dt['under_slc_m']=$_POST['pri_janjati_under_slc_m'];
	$dt['under_slc_t']=$_POST['pri_janjati_under_slc_f']*1+$_POST['pri_janjati_under_slc_m']*1;

	$dt['slc_f']=$_POST['pri_janjati_slc_f'];
	$dt['slc_m']=$_POST['pri_janjati_slc_m'];
	$dt['slc_t']=$_POST['pri_janjati_slc_f']*1+$_POST['pri_janjati_slc_m']*1;

	$dt['ia_f']=$_POST['pri_janjati_ia_f'];
	$dt['ia_m']=$_POST['pri_janjati_ia_m'];
	$dt['ia_t']=$_POST['pri_janjati_ia_f']*1+$_POST['pri_janjati_ia_m']*1;

	$dt['ba_f']=$_POST['pri_janjati_ba_f'];
	$dt['ba_m']=$_POST['pri_janjati_ba_m'];
	$dt['ba_t']=$_POST['pri_janjati_ba_f']*1+$_POST['pri_janjati_ba_m']*1;

	$dt['ma_f']=$_POST['pri_janjati_ma_f'];
	$dt['ma_m']=$_POST['pri_janjati_ma_m'];
	$dt['ma_t']=$_POST['pri_janjati_ma_f']*1+$_POST['pri_janjati_ma_m']*1;

	$dt['first_level']=$_POST['pri_janjati_first_level'];
	$dt['second_level']=$_POST['pri_janjati_second_level'];
	$dt['third_level']=$_POST['pri_janjati_third_level'];
	
	if (!checkblank($dt)) idata('pri_teacher_details_janjati_f1',$dt,'sch_num');
	unset($dt);	
	

	// lsec
	mysql_query("delete from lsec_teacher_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['total_a_teachers']=$_POST['lsec_total_a_teachers'];
	$dt['total_f_teachers']=$_POST['lsec_total_f_teachers'];
	$dt['total_m_teachers']=$_POST['lsec_total_m_teachers'];
	$dt['total_t_teachers']=$_POST['lsec_total_t_teachers'];

	$dt['dalit_f_teachers']=$_POST['lsec_dalit_f_teachers'];
	$dt['dalit_m_teachers']=$_POST['lsec_dalit_m_teachers'];
	$dt['dalit_t_teachers']=$_POST['lsec_dalit_f_teachers']*1+$_POST['lsec_dalit_m_teachers']*1;

	$dt['janjati_f_teachers']=$_POST['lsec_janjati_f_teachers'];
	$dt['janjati_m_teachers']=$_POST['lsec_janjati_m_teachers'];
	$dt['janjati_t_teachers']=$_POST['lsec_janjati_f_teachers']*1+$_POST['lsec_janjati_m_teachers']*1;

	$dt['disabled_f_teachers']=$_POST['lsec_disabled_f_teachers'];
	$dt['disabled_m_teachers']=$_POST['lsec_disabled_m_teachers'];
	$dt['disabled_t_teachers']=$_POST['lsec_disabled_f_teachers']*1+$_POST['lsec_disabled_m_teachers']*1;

	$dt['perm_f']=$_POST['lsec_perm_f'];
	$dt['perm_m']=$_POST['lsec_perm_m'];
	$dt['perm_t']=$_POST['lsec_perm_f']*1+$_POST['lsec_perm_m']*1;

	$dt['temp_f']=$_POST['lsec_temp_f'];
	$dt['temp_m']=$_POST['lsec_temp_m'];
	$dt['temp_t']=$_POST['lsec_temp_f']*1+$_POST['lsec_temp_m']*1;

	$dt['grant_f']=$_POST['lsec_grant_f'];
	$dt['grant_m']=$_POST['lsec_grant_m'];
	$dt['grant_t']=$_POST['lsec_grant_f']*1+$_POST['lsec_grant_m']*1;

	$dt['private_f']=$_POST['lsec_private_f'];
	$dt['private_m']=$_POST['lsec_private_m'];
	$dt['private_t']=$_POST['lsec_private_f']*1+$_POST['lsec_private_m']*1;

	$dt['under_ia_f']=$_POST['lsec_under_ia_f'];
	$dt['under_ia_m']=$_POST['lsec_under_ia_m'];
	$dt['under_ia_t']=$_POST['lsec_under_ia_f']*1+$_POST['lsec_under_ia_m']*1;

	$dt['ia_f']=$_POST['lsec_ia_f'];
	$dt['ia_m']=$_POST['lsec_ia_m'];
	$dt['ia_t']=$_POST['lsec_ia_f']*1+$_POST['lsec_ia_m']*1;

	$dt['ba_f']=$_POST['lsec_ba_f'];
	$dt['ba_m']=$_POST['lsec_ba_m'];
	$dt['ba_t']=$_POST['lsec_ba_f']*1+$_POST['lsec_ba_m']*1;

	$dt['ma_f']=$_POST['lsec_ma_f'];
	$dt['ma_m']=$_POST['lsec_ma_m'];
	$dt['ma_t']=$_POST['lsec_ma_f']*1+$_POST['lsec_ma_m']*1;

	$dt['teacher_by_subject_f']=$_POST['lsec_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['lsec_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['lsec_teacher_by_subject_f']*1+$_POST['lsec_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['lsec_first_level'];
	$dt['second_level']=$_POST['lsec_second_level'];
	$dt['third_level']=$_POST['lsec_third_level'];
	$dt['teacher_deo']=$_POST['lsec_teacher_deo'];
	$dt['teacher_community']=$_POST['lsec_teacher_community'];
	$dt['teacher_others']=$_POST['lsec_teacher_others'];
	
	
	if (!checkblank($dt)) idata('lsec_teacher_details_f1',$dt,'sch_num');
	unset($dt);
	
	// lsec dalit
	mysql_query("delete from lsec_teacher_details_dalit_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['perm_f']=$_POST['lsec_dalit_perm_f'];
	$dt['perm_m']=$_POST['lsec_dalit_perm_m'];
	$dt['perm_t']=$_POST['lsec_dalit_perm_f']*1+$_POST['lsec_dalit_perm_m']*1;

	$dt['temp_f']=$_POST['lsec_dalit_temp_f'];
	$dt['temp_m']=$_POST['lsec_dalit_temp_m'];
	$dt['temp_t']=$_POST['lsec_dalit_temp_f']*1+$_POST['lsec_dalit_temp_m']*1;

	$dt['grant_f']=$_POST['lsec_dalit_grant_f'];
	$dt['grant_m']=$_POST['lsec_dalit_grant_m'];
	$dt['grant_t']=$_POST['lsec_dalit_grant_f']*1+$_POST['lsec_dalit_grant_m']*1;

	$dt['private_f']=$_POST['lsec_dalit_private_f'];
	$dt['private_m']=$_POST['lsec_dalit_private_m'];
	$dt['private_t']=$_POST['lsec_dalit_private_f']*1+$_POST['lsec_dalit_private_m']*1;

	$dt['under_ia_f']=$_POST['lsec_dalit_under_ia_f'];
	$dt['under_ia_m']=$_POST['lsec_dalit_under_ia_m'];
	$dt['under_ia_t']=$_POST['lsec_dalit_under_ia_f']*1+$_POST['lsec_dalit_under_ia_m']*1;

	$dt['ia_f']=$_POST['lsec_dalit_ia_f'];
	$dt['ia_m']=$_POST['lsec_dalit_ia_m'];
	$dt['ia_t']=$_POST['lsec_dalit_ia_f']*1+$_POST['lsec_dalit_ia_m']*1;

	$dt['ba_f']=$_POST['lsec_dalit_ba_f'];
	$dt['ba_m']=$_POST['lsec_dalit_ba_m'];
	$dt['ba_t']=$_POST['lsec_dalit_ba_f']*1+$_POST['lsec_dalit_ba_m']*1;

	$dt['ma_f']=$_POST['lsec_dalit_ma_f'];
	$dt['ma_m']=$_POST['lsec_dalit_ma_m'];
	$dt['ma_t']=$_POST['lsec_dalit_ma_f']*1+$_POST['lsec_dalit_ma_m']*1;

	$dt['teacher_by_subject_f']=$_POST['lsec_dalit_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['lsec_dalit_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['lsec_dalit_teacher_by_subject_f']*1+$_POST['lsec_dalit_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['lsec_dalit_first_level'];
	$dt['second_level']=$_POST['lsec_dalit_second_level'];
	$dt['third_level']=$_POST['lsec_dalit_third_level'];
	
	
	if (!checkblank($dt)) idata('lsec_teacher_details_dalit_f1',$dt,'sch_num');
	unset($dt);

	// lsec janjati
	mysql_query("delete from lsec_teacher_details_janjati_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['perm_f']=$_POST['lsec_janjati_perm_f'];
	$dt['perm_m']=$_POST['lsec_janjati_perm_m'];
	$dt['perm_t']=$_POST['lsec_janjati_perm_f']*1+$_POST['lsec_janjati_perm_m']*1;

	$dt['temp_f']=$_POST['lsec_janjati_temp_f'];
	$dt['temp_m']=$_POST['lsec_janjati_temp_m'];
	$dt['temp_t']=$_POST['lsec_janjati_temp_f']*1+$_POST['lsec_janjati_temp_m']*1;

	$dt['grant_f']=$_POST['lsec_janjati_grant_f'];
	$dt['grant_m']=$_POST['lsec_janjati_grant_m'];
	$dt['grant_t']=$_POST['lsec_janjati_grant_f']*1+$_POST['lsec_janjati_grant_m']*1;

	$dt['private_f']=$_POST['lsec_janjati_private_f'];
	$dt['private_m']=$_POST['lsec_janjati_private_m'];
	$dt['private_t']=$_POST['lsec_janjati_private_f']*1+$_POST['lsec_janjati_private_m']*1;

	$dt['under_ia_f']=$_POST['lsec_janjati_under_ia_f'];
	$dt['under_ia_m']=$_POST['lsec_janjati_under_ia_m'];
	$dt['under_ia_t']=$_POST['lsec_janjati_under_ia_f']*1+$_POST['lsec_janjati_under_ia_m']*1;

	$dt['ia_f']=$_POST['lsec_janjati_ia_f'];
	$dt['ia_m']=$_POST['lsec_janjati_ia_m'];
	$dt['ia_t']=$_POST['lsec_janjati_ia_f']*1+$_POST['lsec_janjati_ia_m']*1;

	$dt['ba_f']=$_POST['lsec_janjati_ba_f'];
	$dt['ba_m']=$_POST['lsec_janjati_ba_m'];
	$dt['ba_t']=$_POST['lsec_janjati_ba_f']*1+$_POST['lsec_janjati_ba_m']*1;

	$dt['ma_f']=$_POST['lsec_janjati_ma_f'];
	$dt['ma_m']=$_POST['lsec_janjati_ma_m'];
	$dt['ma_t']=$_POST['lsec_janjati_ma_f']*1+$_POST['lsec_janjati_ma_m']*1;

	$dt['teacher_by_subject_f']=$_POST['lsec_janjati_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['lsec_janjati_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['lsec_janjati_teacher_by_subject_f']*1+$_POST['lsec_janjati_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['lsec_janjati_first_level'];
	$dt['second_level']=$_POST['lsec_janjati_second_level'];
	$dt['third_level']=$_POST['lsec_janjati_third_level'];
	
	
	if (!checkblank($dt)) idata('lsec_teacher_details_janjati_f1',$dt,'sch_num');
	unset($dt);

	
	
	//sec
	mysql_query("delete from sec_teacher_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['total_a_teachers']=$_POST['sec_total_a_teachers'];

	$dt['total_f_teachers']=$_POST['sec_total_f_teachers'];
	$dt['total_m_teachers']=$_POST['sec_total_m_teachers'];
	$dt['total_t_teachers']=$_POST['sec_total_f_teachers']*1+$_POST['sec_total_m_teachers']*1;

	$dt['dalit_f_teachers']=$_POST['sec_dalit_f_teachers'];
	$dt['dalit_m_teachers']=$_POST['sec_dalit_m_teachers'];
	$dt['dalit_t_teachers']=$_POST['sec_dalit_f_teachers']*1+$_POST['sec_dalit_m_teachers']*1;

	$dt['janjati_f_teachers']=$_POST['sec_janjati_f_teachers'];
	$dt['janjati_m_teachers']=$_POST['sec_janjati_m_teachers'];
	$dt['janjati_t_teachers']=$_POST['sec_janjati_f_teachers']*1+$_POST['sec_janjati_m_teachers']*1;

	$dt['disabled_f_teachers']=$_POST['sec_disabled_f_teachers'];
	$dt['disabled_m_teachers']=$_POST['sec_disabled_m_teachers'];
	$dt['disabled_t_teachers']=$_POST['sec_disabled_f_teachers']*1 + $_POST['sec_disabled_m_teachers']*1;

	$dt['perm_f']=$_POST['sec_perm_f'];
	$dt['perm_m']=$_POST['sec_perm_m'];
	$dt['perm_t']=$_POST['sec_perm_f']*1+$_POST['sec_perm_m']*1;

	$dt['temp_f']=$_POST['sec_temp_f'];
	$dt['temp_m']=$_POST['sec_temp_m'];
	$dt['temp_t']=$_POST['sec_temp_f']*1+$_POST['sec_temp_m']*1;

	$dt['grant_f']=$_POST['sec_grant_f'];
	$dt['grant_m']=$_POST['sec_grant_m'];
	$dt['grant_t']=$_POST['sec_grant_f']*1+$_POST['sec_grant_m']*1;

	$dt['private_f']=$_POST['sec_private_f'];
	$dt['private_m']=$_POST['sec_private_m'];
	$dt['private_t']=$_POST['sec_private_f']*1+$_POST['sec_private_m']*1;

	$dt['under_ba_f']=$_POST['sec_under_ba_f'];
	$dt['under_ba_m']=$_POST['sec_under_ba_m'];
	$dt['under_ba_t']=$_POST['sec_under_ba_f']*1+$_POST['sec_under_ba_m']*1;

	$dt['ba_f']=$_POST['sec_ba_f'];
	$dt['ba_m']=$_POST['sec_ba_m'];
	$dt['ba_t']=$_POST['sec_ba_f']*1+$_POST['sec_ba_m']*1;

	$dt['ma_f']=$_POST['sec_ma_f'];
	$dt['ma_m']=$_POST['sec_ma_m'];
	$dt['ma_t']=$_POST['sec_ma_f']*1+$_POST['sec_ma_m']*1;

	$dt['educ_faculty_f']=$_POST['sec_educ_faculty_f'];
	$dt['educ_faculty_m']=$_POST['sec_educ_faculty_m'];
	$dt['educ_faculty_t']=$_POST['sec_educ_faculty_f']*1+$_POST['sec_educ_faculty_m']*1;

	$dt['teacher_by_subject_f']=$_POST['sec_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['sec_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['sec_teacher_by_subject_f']*1+$_POST['sec_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['sec_first_level'];
	$dt['second_level']=$_POST['sec_second_level'];
	$dt['third_level']=$_POST['sec_third_level'];
	$dt['teacher_deo']=$_POST['sec_teacher_deo'];
	$dt['teacher_community']=$_POST['sec_teacher_community'];
	$dt['teacher_others']=$_POST['sec_teacher_others'];
	
	if (!checkblank($dt)) idata('sec_teacher_details_f1',$dt,'sch_num');
	unset($dt);

	
	//sec dalit
	mysql_query("delete from sec_teacher_details_dalit_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	

	$dt['perm_f']=$_POST['sec_dalit_perm_f'];
	$dt['perm_m']=$_POST['sec_dalit_perm_m'];
	$dt['perm_t']=$_POST['sec_dalit_perm_f']*1+$_POST['sec_dalit_perm_m']*1;

	$dt['temp_f']=$_POST['sec_dalit_temp_f'];
	$dt['temp_m']=$_POST['sec_dalit_temp_m'];
	$dt['temp_t']=$_POST['sec_dalit_temp_f']*1+$_POST['sec_dalit_temp_m']*1;

	$dt['grant_f']=$_POST['sec_dalit_grant_f'];
	$dt['grant_m']=$_POST['sec_dalit_grant_m'];
	$dt['grant_t']=$_POST['sec_dalit_grant_f']*1+$_POST['sec_dalit_grant_m']*1;

	$dt['private_f']=$_POST['sec_dalit_private_f'];
	$dt['private_m']=$_POST['sec_dalit_private_m'];
	$dt['private_t']=$_POST['sec_dalit_private_f']*1+$_POST['sec_dalit_private_m']*1;

	$dt['under_ba_f']=$_POST['sec_dalit_under_ba_f'];
	$dt['under_ba_m']=$_POST['sec_dalit_under_ba_m'];
	$dt['under_ba_t']=$_POST['sec_dalit_under_ba_f']*1+$_POST['sec_dalit_under_ba_m']*1;

	$dt['ba_f']=$_POST['sec_dalit_ba_f'];
	$dt['ba_m']=$_POST['sec_dalit_ba_m'];
	$dt['ba_t']=$_POST['sec_dalit_ba_f']*1+$_POST['sec_dalit_ba_m']*1;

	$dt['ma_f']=$_POST['sec_dalit_ma_f'];
	$dt['ma_m']=$_POST['sec_dalit_ma_m'];
	$dt['ma_t']=$_POST['sec_dalit_ma_f']*1+$_POST['sec_dalit_ma_m']*1;

	$dt['educ_faculty_f']=$_POST['sec_dalit_educ_faculty_f'];
	$dt['educ_faculty_m']=$_POST['sec_dalit_educ_faculty_m'];
	$dt['educ_faculty_t']=$_POST['sec_dalit_educ_faculty_f']*1+$_POST['sec_dalit_educ_faculty_m']*1;

	$dt['teacher_by_subject_f']=$_POST['sec_dalit_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['sec_dalit_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['sec_dalit_teacher_by_subject_f']*1+$_POST['sec_dalit_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['sec_dalit_first_level'];
	$dt['second_level']=$_POST['sec_dalit_second_level'];
	$dt['third_level']=$_POST['sec_dalit_third_level'];
	
	if (!checkblank($dt)) idata('sec_teacher_details_dalit_f1',$dt,'sch_num');
	unset($dt);

	//sec janjati
	mysql_query("delete from sec_teacher_details_janjati_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	

	$dt['perm_f']=$_POST['sec_janjati_perm_f'];
	$dt['perm_m']=$_POST['sec_janjati_perm_m'];
	$dt['perm_t']=$_POST['sec_janjati_perm_f']*1+$_POST['sec_janjati_perm_m']*1;

	$dt['temp_f']=$_POST['sec_janjati_temp_f'];
	$dt['temp_m']=$_POST['sec_janjati_temp_m'];
	$dt['temp_t']=$_POST['sec_janjati_temp_f']*1+$_POST['sec_janjati_temp_m']*1;

	$dt['grant_f']=$_POST['sec_janjati_grant_f'];
	$dt['grant_m']=$_POST['sec_janjati_grant_m'];
	$dt['grant_t']=$_POST['sec_janjati_grant_f']*1+$_POST['sec_janjati_grant_m']*1;

	$dt['private_f']=$_POST['sec_janjati_private_f'];
	$dt['private_m']=$_POST['sec_janjati_private_m'];
	$dt['private_t']=$_POST['sec_janjati_private_f']*1+$_POST['sec_janjati_private_m']*1;

	$dt['under_ba_f']=$_POST['sec_janjati_under_ba_f'];
	$dt['under_ba_m']=$_POST['sec_janjati_under_ba_m'];
	$dt['under_ba_t']=$_POST['sec_janjati_under_ba_f']*1+$_POST['sec_janjati_under_ba_m']*1;

	$dt['ba_f']=$_POST['sec_janjati_ba_f'];
	$dt['ba_m']=$_POST['sec_janjati_ba_m'];
	$dt['ba_t']=$_POST['sec_janjati_ba_f']*1+$_POST['sec_janjati_ba_m']*1;

	$dt['ma_f']=$_POST['sec_janjati_ma_f'];
	$dt['ma_m']=$_POST['sec_janjati_ma_m'];
	$dt['ma_t']=$_POST['sec_janjati_ma_f']*1+$_POST['sec_janjati_ma_m']*1;

	$dt['educ_faculty_f']=$_POST['sec_janjati_educ_faculty_f'];
	$dt['educ_faculty_m']=$_POST['sec_janjati_educ_faculty_m'];
	$dt['educ_faculty_t']=$_POST['sec_janjati_educ_faculty_f']*1+$_POST['sec_janjati_educ_faculty_m']*1;

	$dt['teacher_by_subject_f']=$_POST['sec_janjati_teacher_by_subject_f'];
	$dt['teacher_by_subject_m']=$_POST['sec_janjati_teacher_by_subject_m'];
	$dt['teacher_by_subject_t']=$_POST['sec_janjati_teacher_by_subject_f']*1+$_POST['sec_janjati_teacher_by_subject_m']*1;

	$dt['first_level']=$_POST['sec_janjati_first_level'];
	$dt['second_level']=$_POST['sec_janjati_second_level'];
	$dt['third_level']=$_POST['sec_janjati_third_level'];
	
	if (!checkblank($dt)) idata('sec_teacher_details_janjati_f1',$dt,'sch_num');
	unset($dt);

	
}

*/

if ($from=='teacher_training.php'){
	//primary
	mysql_query("delete from pri_teacher_training_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
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
	$dt['untrained_total_m']=$_POST['pri_untrained_total_m'];
	$dt['untrained_total_t']=$_POST['pri_untrained_total_t'];
	$dt['untrained_dalit_f']=$_POST['pri_untrained_dalit_f'];
	$dt['untrained_dalit_m']=$_POST['pri_untrained_dalit_m'];
	$dt['untrained_dalit_t']=$_POST['pri_untrained_dalit_t'];
	$dt['untrained_janjati_f']=$_POST['pri_untrained_janjati_f'];
	$dt['untrained_janjati_m']=$_POST['pri_untrained_janjati_m'];
	$dt['untrained_janjati_t']=$_POST['pri_untrained_janjati_t'];
	
	if (!checkblank($dt)) idata('pri_teacher_training_f1',$dt,'sch_num');
	
	unset($dt);
	
	
	// lsec
	mysql_query("delete from lsec_teacher_training_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
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
	
	if (!checkblank($dt)) idata('lsec_teacher_training_f1',$dt,'sch_num');
	
	unset($dt);


	// sec
	mysql_query("delete from sec_teacher_training_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
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
	
	if (!checkblank($dt)) idata('sec_teacher_training_f1',$dt,'sch_num');
	
	unset($dt);
	
	mysql_query("delete from hsec_teacher_training_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
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
	
	if (!checkblank($dt)) idata('hsec_teacher_training_f1',$dt,'sch_num');
	
	unset($dt);	
	
	
}


if ($from=='teaching_physical.php'){
	
	// teaching method
	mysql_query("delete from teaching_method_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	$dt['c1_teaching_method']=$_POST['teaching_method_1'];
	$dt['c2_teaching_method']=$_POST['teaching_method_2'];
	$dt['c3_teaching_method']=$_POST['teaching_method_3'];
	$dt['c4_teaching_method']=$_POST['teaching_method_4'];
	$dt['c5_teaching_method']=$_POST['teaching_method_5'];
	
	if (!checkblank($dt)) idata('teaching_method_f1',$dt,'sch_num');
	
	unset($dt);
	
	
	mysql_query("delete from language_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($i=1;$i<=5;$i++){
		if ($_POST["lang_$i"]=='') continue;
		
		for ($cl=1;$cl<=5;$cl++){
			
			$dt=array();
			$dt['sch_num']=$schoolcode;
			$dt['sch_year']=$currentyear;
			$dt['language']=$_POST["lang_$i"];
			$dt['class']=$cl;
			$dt['female']=$_POST["lang_class${cl}_f"][$i];
			$dt['male']=$_POST["lang_class${cl}_m"][$i];
			$dt['total']=$_POST["lang_class${cl}_t"][$i];
			
			if (!checkblank($dt)) idata('language_f1',$dt);
			
			unset($dt);			
			
		}


	}	
	
	// textbooks
	
	mysql_query("delete from textbooks_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	
	for ($i=1;$i<=10;$i++){
		$dt['class']=$i;
		$dt['full_students_no']=$_POST['full_students_no_'.$i];
		$dt['partial_students_no']=$_POST['partial_students_no_'.$i];
		$dt['none_students_no']=$_POST['none_students_no_'.$i];
		$dt['reuse_students_no']=$_POST['reuse_students_no_'.$i];
		if (!checkblank($dt)) idata('textbooks_f1',$dt);	
	}
		
	unset($dt);	
	
}

if ($from=='hsec_current.php'){

	
	
	//echo2file($_POST['faculty_11_5'].$_POST['faculty_11_6'].$_POST['faculty_12_5'].$_POST['faculty_12_6']);
	
	$faculties = array('','Humanities','Education','Science','Management',$_POST['faculty_11_5'],$_POST['faculty_11_6']);
	
	
	// class 11
	mysql_query("delete from hsec_current_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and class=11");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['class']=11;
		
	for ($i=1;$i<count($faculties);$i++){
		if ($_POST['tot_t_11_'.$i]=='') continue;
		
		$dt['faculty_list'] = $faculties[$i];
		$dt['tot_f']=$_POST['tot_f_11_'.$i];
		$dt['tot_m']=$_POST['tot_m_11_'.$i];
		$dt['tot_t']=$_POST['tot_t_11_'.$i];
		$dt['dalit_f']=$_POST['dalit_f_11_'.$i];
		$dt['dalit_m']=$_POST['dalit_m_11_'.$i];
		$dt['dalit_t']=$_POST['dalit_t_11_'.$i];
		$dt['janjati_f']=$_POST['janjati_f_11_'.$i];
		$dt['janjati_m']=$_POST['janjati_m_11_'.$i];
		$dt['janjati_t']=$_POST['janjati_t_11_'.$i];
		$dt['others_f']=$_POST['other_f_11_'.$i];
		$dt['others_m']=$_POST['other_m_11_'.$i];
		$dt['others_t']=$_POST['other_t_11_'.$i];
		if (!checkblank($dt)) idata('hsec_current_details_f1',$dt);
	}
	
	unset($dt);
	

	// class 12
	
	unset($faculties);
	$faculties = array('','Humanities','Education','Science','Management',$_POST['faculty_12_5'],$_POST['faculty_12_6']);

	mysql_query("delete from hsec_current_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and class=12");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['class']=12;
		
	for ($i=1;$i<count($faculties);$i++){
		if ($_POST['tot_t_12_'.$i]=='') continue;
		
		$dt['faculty_list'] = $faculties[$i];
		$dt['tot_f']=$_POST['tot_f_12_'.$i];
		$dt['tot_m']=$_POST['tot_m_12_'.$i];
		$dt['tot_t']=$_POST['tot_t_12_'.$i];
		$dt['dalit_f']=$_POST['dalit_f_12_'.$i];
		$dt['dalit_m']=$_POST['dalit_m_12_'.$i];
		$dt['dalit_t']=$_POST['dalit_t_12_'.$i];
		$dt['janjati_f']=$_POST['janjati_f_12_'.$i];
		$dt['janjati_m']=$_POST['janjati_m_12_'.$i];
		$dt['janjati_t']=$_POST['janjati_t_12_'.$i];
		$dt['others_f']=$_POST['other_f_12_'.$i];
		$dt['others_m']=$_POST['other_m_12_'.$i];
		$dt['others_t']=$_POST['other_t_12_'.$i];
		idata('hsec_current_details_f1',$dt);
	}
	unset($dt);
	
		
	
}
 
    
if ($from=='hsec_exam.php'){
	
	$faculties = array('','Humanities','Education','Science','Management',$_POST['faculty_5'],$_POST['faculty_6']);
	
	
	// class 11
	mysql_query("delete from hsec_last_exam_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and class=11");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['class']=11;
		
	for ($i=1;$i<count($faculties);$i++){
		if ($_POST['tot_app_t_11_'.$i]=='') continue;
		
		$dt['faculty_list'] = $faculties[$i];
		$dt['tot_app_f']=$_POST['tot_app_f_11_'.$i];
		$dt['tot_app_m']=$_POST['tot_app_m_11_'.$i];
		$dt['tot_app_t']=$_POST['tot_app_t_11_'.$i];
		$dt['dalit_app_f']=$_POST['dalit_app_f_11_'.$i];
		$dt['dalit_app_m']=$_POST['dalit_app_m_11_'.$i];
		$dt['dalit_app_t']=$_POST['dalit_app_t_11_'.$i];
		$dt['janjati_app_f']=$_POST['janjati_app_f_11_'.$i];
		$dt['janjati_app_m']=$_POST['janjati_app_m_11_'.$i];
		$dt['janjati_app_t']=$_POST['janjati_app_t_11_'.$i];
		$dt['tot_pass_f']=$_POST['tot_pass_f_11_'.$i];
		$dt['tot_pass_m']=$_POST['tot_pass_m_11_'.$i];
		$dt['tot_pass_t']=$_POST['tot_pass_t_11_'.$i];
		$dt['dalit_pass_f']=$_POST['dalit_pass_f_11_'.$i];
		$dt['dalit_pass_m']=$_POST['dalit_pass_m_11_'.$i];
		$dt['dalit_pass_t']=$_POST['dalit_pass_t_11_'.$i];
		$dt['janjati_pass_f']=$_POST['janjati_pass_f_11_'.$i];
		$dt['janjati_pass_m']=$_POST['janjati_pass_m_11_'.$i];
		$dt['janjati_pass_t']=$_POST['janjati_pass_t_11_'.$i];
		
		idata('hsec_last_exam_details_f1',$dt);
	}
	
	unset($dt);
	

	// class 12
	
	unset($faculties);
	$faculties = array('','Humanities','Education','Science','Management',$_POST['faculty_5'],$_POST['faculty_6']);

	mysql_query("delete from hsec_last_exam_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear' and class=12");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['class']=12;
		
	for ($i=1;$i<count($faculties);$i++){
		if ($_POST['tot_app_t_12_'.$i]=='') continue;
		
		$dt['faculty_list'] = $faculties[$i];
		$dt['tot_app_f']=$_POST['tot_app_f_12_'.$i];
		$dt['tot_app_m']=$_POST['tot_app_m_12_'.$i];
		$dt['tot_app_t']=$_POST['tot_app_t_12_'.$i];
		$dt['dalit_app_f']=$_POST['dalit_app_f_12_'.$i];
		$dt['dalit_app_m']=$_POST['dalit_app_m_12_'.$i];
		$dt['dalit_app_t']=$_POST['dalit_app_t_12_'.$i];
		$dt['janjati_app_f']=$_POST['janjati_app_f_12_'.$i];
		$dt['janjati_app_m']=$_POST['janjati_app_m_12_'.$i];
		$dt['janjati_app_t']=$_POST['janjati_app_t_12_'.$i];
		$dt['tot_pass_f']=$_POST['tot_pass_f_12_'.$i];
		$dt['tot_pass_m']=$_POST['tot_pass_m_12_'.$i];
		$dt['tot_pass_t']=$_POST['tot_pass_t_12_'.$i];
		$dt['dalit_pass_f']=$_POST['dalit_pass_f_12_'.$i];
		$dt['dalit_pass_m']=$_POST['dalit_pass_m_12_'.$i];
		$dt['dalit_pass_t']=$_POST['dalit_pass_t_12_'.$i];
		$dt['janjati_pass_f']=$_POST['janjati_pass_f_12_'.$i];
		$dt['janjati_pass_m']=$_POST['janjati_pass_m_12_'.$i];
		$dt['janjati_pass_t']=$_POST['janjati_pass_t_12_'.$i];
		idata('hsec_last_exam_details_f1',$dt);
	}
	unset($dt);
	
		
	
}
	

if ($from=='hsec_age.php'){
	$age_suffix[11]=array("_l15","_15","_15_16","_g16","_t");
	$age_suffix[12]=array("_l16","_16","_g16","_t");

	mysql_query("delete from hsec_total_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from hsec_dalit_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	mysql_query("delete from hsec_janjati_enroll_age_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	
	for ($i=11;$i<=12;$i++){
		$dt=array();
		$dtd=array();
		$dtj=array();
		
		$dt['sch_num']=$dtd['sch_num']=$dtj['sch_num']=$schoolcode;
		$dt['sch_year']=$dtd['sch_year']=$dtj['sch_year']=$currentyear;
		$dt['class']=$dtd['class']=$dtj['class']=$i;

		if ($_POST['total_enroll_age_t_t'][$i]==0 && $_POST['dalit_enroll_age_t_t'][$i]==0 && $_POST['janjati_enroll_age_t_t'][$i]==0) continue;
		
		for ($j=0;$j<count($age_suffix[$i])-1;$j++){

			$dt['f'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dt['m'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dt['t'.$age_suffix[$i][$j]]=$_POST['total_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtd['f'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtd['m'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtd['t'.$age_suffix[$i][$j]]=$_POST['dalit_enroll_age_t'.$age_suffix[$i][$j]][$i];

			$dtj['f'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_f'.$age_suffix[$i][$j]][$i];
			$dtj['m'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_m'.$age_suffix[$i][$j]][$i];
			$dtj['t'.$age_suffix[$i][$j]]=$_POST['janjati_enroll_age_t'.$age_suffix[$i][$j]][$i];
			
		
		}
		
		if (!checkblank($dt)) idata('hsec_total_enroll_age_f1',$dt);
		if (!checkblank($dtd)) idata('hsec_dalit_enroll_age_f1',$dtd);
		if (!checkblank($dtj)) idata('hsec_janjati_enroll_age_f1',$dtj);
		
		unset($dt);
		unset($dtd);
		unset($dtj);
	}

	
}


if ($from=='hsec_teacher.php'){
	
	mysql_query("delete from hsec_teacher_details_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['work_total']=$_POST['teacher_total'];
	$dt['teacher_deo']=$_POST['teacher_deo'];
	$dt['teacher_fulltimer']=$_POST['teacher_fulltimer'];
	$dt['teacher_parttimer']=$_POST['teacher_parttimer'];
	
	if (!checkblank($dt)) idata('hsec_teacher_details_f1',$dt,'sch_num');
	
	unset($dt);
	
	
	
	
	

}

if ($from == 'hsec_scholarship.php'){

	mysql_query("delete from hsec_total_passed_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	
	
	$dt['enr_male']=$_POST['enr_male'];
	$dt['enr_female']=$_POST['enr_female'];
	$dt['enr_total']=$_POST['enr_total'];
	$dt['passed_male']=$_POST['passed_male'];
	$dt['passed_female']=$_POST['passed_female'];
	$dt['passed_total']=$_POST['passed_total'];
	$dt['enr_dalit_female']=$_POST['enr_dalit_female'];
	$dt['enr_dalit_male']=$_POST['enr_dalit_male'];
	$dt['enr_dalit_total']=$_POST['enr_dalit_total'];
	$dt['passed_dalit_female']=$_POST['passed_dalit_female'];
	$dt['passed_dalit_male']=$_POST['passed_dalit_male'];
	$dt['passed_dalit_total']=$_POST['passed_dalit_total'];
	$dt['enr_janjati_female']=$_POST['enr_janjati_female'];
	$dt['enr_janjati_male']=$_POST['enr_janjati_male'];
	$dt['enr_janjati_total']=$_POST['enr_janjati_total'];
	$dt['passed_janjati_female']=$_POST['passed_janjati_female'];
	$dt['passed_janjati_male']=$_POST['passed_janjati_male'];
	$dt['passed_janjati_total']=$_POST['passed_janjati_total'];
	
	if (!checkblank($dt)) idata('hsec_total_passed_f1',$dt,'sch_num');
	
	unset($dt);
	
	
	

	mysql_query("delete from hsec_scholarship_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");	
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;
	$dt['class']=11;
	
	$dt['scholarship_total_f']=$_POST['hsec_total_f_11_1'];
	$dt['scholarship_total_m']=$_POST['hsec_total_m_11_1'];
	$dt['scholarship_total_t']=$_POST['hsec_total_t_11_1'];
	$dt['scholarship_dalit_f']=$_POST['hsec_dalit_f_11_1'];
	$dt['scholarship_dalit_m']=$_POST['hsec_dalit_m_11_1'];
	$dt['scholarship_dalit_t']=$_POST['hsec_dalit_t_11_1'];
	$dt['scholarship_janjati_f']=$_POST['hsec_janjati_f_11_1'];
	$dt['scholarship_janjati_m']=$_POST['hsec_janjati_m_11_1'];
	$dt['scholarship_janjati_t']=$_POST['hsec_janjati_t_11_1'];
	$dt['encourage_total_f']=$_POST['hsec_total_f_11_2'];
	$dt['encourage_total_m']=$_POST['hsec_total_m_11_2'];
	$dt['encourage_total_t']=$_POST['hsec_total_t_11_2'];
	$dt['encourage_dalit_f']=$_POST['hsec_dalit_f_11_2'];
	$dt['encourage_dalit_m']=$_POST['hsec_dalit_m_11_2'];
	$dt['encourage_dalit_t']=$_POST['hsec_dalit_t_11_2'];
	$dt['encourage_janjati_f']=$_POST['hsec_janjati_f_11_2'];
	$dt['encourage_janjati_m']=$_POST['hsec_janjati_m_11_2'];
	$dt['encourage_janjati_t']=$_POST['hsec_janjati_t_11_2'];
	$dt['loan_total_f']=$_POST['hsec_total_f_11_3'];
	$dt['loan_total_m']=$_POST['hsec_total_m_11_3'];
	$dt['loan_total_t']=$_POST['hsec_total_t_11_3'];
	$dt['loan_dalit_f']=$_POST['hsec_dalit_f_11_3'];
	$dt['loan_dalit_m']=$_POST['hsec_dalit_m_11_3'];
	$dt['loan_dalit_t']=$_POST['hsec_dalit_t_11_3'];
	$dt['loan_janjati_f']=$_POST['hsec_janjati_f_11_3'];
	$dt['loan_janjati_m']=$_POST['hsec_janjati_m_11_3'];
	$dt['loan_janjati_t']=$_POST['hsec_janjati_t_11_3'];
	$dt['others_total_f']=$_POST['hsec_total_f_11_4'];
	$dt['others_total_m']=$_POST['hsec_total_m_11_4'];
	$dt['others_total_t']=$_POST['hsec_total_t_11_4'];
	$dt['others_dalit_f']=$_POST['hsec_dalit_f_11_4'];
	$dt['others_dalit_m']=$_POST['hsec_dalit_m_11_4'];
	$dt['others_dalit_t']=$_POST['hsec_dalit_t_11_4'];
	$dt['others_janjati_f']=$_POST['hsec_janjati_f_11_4'];
	$dt['others_janjati_m']=$_POST['hsec_janjati_m_11_4'];
	$dt['others_janjati_t']=$_POST['hsec_janjati_t_11_4'];

	if (!checkblank($dt)) idata('hsec_scholarship_f1',$dt);
	
	$dt['class']=12;
	
	$dt['scholarship_total_f']=$_POST['hsec_total_f_12_1'];
	$dt['scholarship_total_m']=$_POST['hsec_total_m_12_1'];
	$dt['scholarship_total_t']=$_POST['hsec_total_t_12_1'];
	$dt['scholarship_dalit_f']=$_POST['hsec_dalit_f_12_1'];
	$dt['scholarship_dalit_m']=$_POST['hsec_dalit_m_12_1'];
	$dt['scholarship_dalit_t']=$_POST['hsec_dalit_t_12_1'];
	$dt['scholarship_janjati_f']=$_POST['hsec_janjati_f_12_1'];
	$dt['scholarship_janjati_m']=$_POST['hsec_janjati_m_12_1'];
	$dt['scholarship_janjati_t']=$_POST['hsec_janjati_t_12_1'];
	$dt['encourage_total_f']=$_POST['hsec_total_f_12_2'];
	$dt['encourage_total_m']=$_POST['hsec_total_m_12_2'];
	$dt['encourage_total_t']=$_POST['hsec_total_t_12_2'];
	$dt['encourage_dalit_f']=$_POST['hsec_dalit_f_12_2'];
	$dt['encourage_dalit_m']=$_POST['hsec_dalit_m_12_2'];
	$dt['encourage_dalit_t']=$_POST['hsec_dalit_t_12_2'];
	$dt['encourage_janjati_f']=$_POST['hsec_janjati_f_12_2'];
	$dt['encourage_janjati_m']=$_POST['hsec_janjati_m_12_2'];
	$dt['encourage_janjati_t']=$_POST['hsec_janjati_t_12_2'];
	$dt['loan_total_f']=$_POST['hsec_total_f_12_3'];
	$dt['loan_total_m']=$_POST['hsec_total_m_12_3'];
	$dt['loan_total_t']=$_POST['hsec_total_t_12_3'];
	$dt['loan_dalit_f']=$_POST['hsec_dalit_f_12_3'];
	$dt['loan_dalit_m']=$_POST['hsec_dalit_m_12_3'];
	$dt['loan_dalit_t']=$_POST['hsec_dalit_t_12_3'];
	$dt['loan_janjati_f']=$_POST['hsec_janjati_f_12_3'];
	$dt['loan_janjati_m']=$_POST['hsec_janjati_m_12_3'];
	$dt['loan_janjati_t']=$_POST['hsec_janjati_t_12_3'];
	$dt['others_total_f']=$_POST['hsec_total_f_12_4'];
	$dt['others_total_m']=$_POST['hsec_total_m_12_4'];
	$dt['others_total_t']=$_POST['hsec_total_t_12_4'];
	$dt['others_dalit_f']=$_POST['hsec_dalit_f_12_4'];
	$dt['others_dalit_m']=$_POST['hsec_dalit_m_12_4'];
	$dt['others_dalit_t']=$_POST['hsec_dalit_t_12_4'];
	$dt['others_janjati_f']=$_POST['hsec_janjati_f_12_4'];
	$dt['others_janjati_m']=$_POST['hsec_janjati_m_12_4'];
	$dt['others_janjati_t']=$_POST['hsec_janjati_t_12_4'];

	if (!checkblank($dt)) idata('hsec_scholarship_f1',$dt);	
	
	
}


if ($from=='finance.php'){
	
	mysql_query("delete from finance_income_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=1;$i<=4;$i++){
		
		$dt=array();
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;	
		$dt['level']=$i;	
	
		$dt['teacher_salary_darbandi']=$_POST['i_teacher_salary_darbandi'][$i];
		$dt['rahat_teacher_salary']=$_POST['i_rahat_teacher_salary'][$i];
		$dt['pcf_salary']=$_POST['i_pcf_salary'][$i];
		$dt['girls_scholarship']=$_POST['i_girls_scholarship'][$i];
		$dt['dalit_scholarship']=$_POST['i_dalit_scholarship'][$i];
		$dt['disadvantaged_scholarship']=$_POST['i_disadvantaged_scholarship'][$i];
		$dt['text_books_fund']=$_POST['i_text_books_fund'][$i];
		$dt['school_management_fund']=$_POST['i_school_management_fund'][$i];
		$dt['stationary_fund']=$_POST['i_stationary_fund'][$i];
		$dt['library_and_computer_fund']=$_POST['i_library_and_computer_fund'][5];
		$dt['sip_preparation_fund']=$_POST['i_sip_preparation_fund'][5];
		$dt['financial_social_audit_fund']=$_POST['i_financial_social_audit_fund'][5];
		$dt['incentive_fund']=$_POST['i_incentive_fund'][5];
		$dt['capacity_development_fund']=$_POST['i_capacity_development_fund'][5];
		$dt['day_meal_implementation_fund']=$_POST['i_day_meal_implementation_fund'][$i];
		$dt['new_building_construction_fund']=$_POST['i_new_building_construction_fund'][5];
		$dt['new_class_room_construction_fund']=$_POST['i_new_class_room_construction_fund'][5];
		$dt['school_building_rehabilitation_fund']=$_POST['i_school_building_rehabilitation_fund'][5];
		$dt['class_room_rehabilitation_fund']=$_POST['i_class_room_rehabilitation_fund'][5];
		$dt['external_environment_improvement_fund']=$_POST['i_external_environment_improvement_fund'][5];
		$dt['government_other_funds']=$_POST['i_government_other_funds'][$i];
		$dt['monthly_fees']=$_POST['i_monthly_fees'][$i];
		$dt['admission_yearly_fees']=$_POST['i_admission_yearly_fees'][$i];
		$dt['internal_income_service_fees']=$_POST['i_internal_income_service_fees'][5];
		$dt['investment_interest']=$_POST['i_investment_interest'][5];
		$dt['external_support']=$_POST['i_external_support'][5];
		$dt['debit']=$_POST['i_debit'][$i];
		$dt['total_income']=$_POST['i_total_income'][$i];
		$dt['debit_last_year']=$_POST['i_debit_last_year'][$i];
		$dt['debit_this_year']=$_POST['i_debit_this_year'][$i];	
		
		if (!checkblank($dt)) idata('finance_income_f1',$dt,'sch_num');
	
	}	
	
	
	mysql_query("delete from finance_expenditure_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

	for ($i=1;$i<=4;$i++){
		
		$dt=array();
		$dt['sch_num']=$schoolcode;
		$dt['sch_year']=$currentyear;	
		$dt['level']=$i;	
	
		$dt['teacher_salary_darbandi']=$_POST['e_teacher_salary_darbandi'][$i];
		$dt['rahat_teacher_salary']=$_POST['e_rahat_teacher_salary'][$i];
		$dt['pcf_salary']=$_POST['e_pcf_salary'][$i];
		$dt['girls_scholarship']=$_POST['e_girls_scholarship'][$i];
		$dt['dalit_scholarship']=$_POST['e_dalit_scholarship'][$i];
		$dt['disadvantaged_scholarship']=$_POST['e_disadvantaged_scholarship'][$i];
		$dt['text_books']=$_POST['e_text_books'][$i];
		$dt['school_management']=$_POST['e_school_management'][$i];
		$dt['stationary']=$_POST['e_stationary'][$i];
		$dt['library_computer']=$_POST['e_library_computer'][5];
		$dt['sip_preparation']=$_POST['e_sip_preparation'][5];
		$dt['financial_and_social_audit']=$_POST['e_financial_and_social_audit'][5];
		$dt['incentive']=$_POST['e_incentive'][5];
		$dt['capacity_development']=$_POST['e_capacity_development'][5];
		$dt['day_meal_implementation']=$_POST['e_day_meal_implementation'][$i];
		$dt['new_building_construction']=$_POST['e_new_building_construction'][5];
		$dt['new_class_room_construction']=$_POST['e_new_class_room_construction'][5];
		$dt['school_building_rehabilitation']=$_POST['e_school_building_rehabilitation'][5];
		$dt['class_room_rehabilitation']=$_POST['e_class_room_rehabilitation'][5];
		$dt['toilet_construction_girls_boys']=$_POST['e_toilet_construction_girls_boys'][5];
		$dt['girls_toilet_construction']=$_POST['e_girls_toilet_construction'][$i];
		$dt['examination_conduction']=$_POST['e_examination_conduction'][$i];
		$dt['extra_curricular_activities']=$_POST['e_extra_curricular_activities'][$i];
		$dt['miscellaneous']=$_POST['e_miscellaneous'][5];
		$dt['other_activities1']=$_POST['e_other_activities1'][5];
		$dt['other_activities2']=$_POST['e_other_activities2'][5];
		$dt['credit']=$_POST['e_credit'][$i];
		$dt['total']=$_POST['e_total'][$i];
		$dt['credit_last_year']=$_POST['e_credit_last_year'][$i];
		$dt['credit_this_year']=$_POST['e_credit_this_year'][$i];

		
		if (!checkblank($dt)) idata('finance_expenditure_f1',$dt,'sch_num');
	
	}	
	


}


if ($from=='electives.php'){
	
	mysql_query("delete from electives_f1 where sch_num='$schoolcode' and sch_year='$currentyear'");

			
	$dt=array();
	$dt['sch_num']=$schoolcode;
	$dt['sch_year']=$currentyear;	

	for ($e=1;$e<=2;$e++){
		for ($s=1;$s<=3;$s++){
			for ($c=9;$c<=10;$c++){
				$dt['elective_no']=$e;
				$dt['subject_no']=$s;
				$dt['subject_name']=$_POST["elective_${e}_${s}_title"];
				$dt['class']=$c;
				
				if ($dt['subject_name']=='') continue;
				$dt['total_f']=$_POST["elective_${e}_${s}_f_{$c}"];
				$dt['total_m']=$_POST["elective_${e}_${s}_m_{$c}"];
				$dt['total_t']=$_POST["elective_${e}_${s}_t_{$c}"];

				idata("electives_f1",$dt);
			}
		}
	}
	
}


?>
