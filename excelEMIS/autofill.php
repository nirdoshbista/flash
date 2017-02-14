<?php

//initalise the necessary includes and connect to the database
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('flash1_autofill_queries.php');
require_once('flash2_autofill_queries.php');


$link = dbconnect();
 //$total_queries_start=0;
  // $total_queries_end=0;
   // $total_queries=0;
function autofillFlash1($schoollist) 
{
    global $currentyear,$ecdppc_info_f1,$ecdppc_enroll_f1,$ecd_total_enroll_age_f1,$ecd_dalit_enroll_age_f1,$ecd_janjati_enroll_age_f1,
            $last_class1_5_enroll_f1,$last_class6_8_enroll_f1,$last_class9_10_enroll_f1,$enr_rep_mig_class1_5_f1,$enr_rep_mig_class6_8_f1,
            $enr_rep_mig_class9_10_f1,$new_total_enroll_age_f1,$new_dalit_enroll_age_f1,$new_janjati_enroll_age_f1,
            $pr_total_enroll_age_f1,$pr_dalit_enroll_age_f1,$pr_janjati_enroll_age_f1,$sec_total_enroll_age_f1,$sec_dalit_enroll_age_f1,
            $sec_janjati_enroll_age_f1,$hsec_total_enroll_age_f1,$hsec_dalit_enroll_age_f1,
            $hsec_janjati_enroll_age_f1,$ecd_disabled_f1,$pr_disabled_f1,$lsec_disabled_f1,$sec_disabled_f1,$hsec_disabled_f1,
            $afterecd_f1;
    
   // $total_queries_start=mysql_result(mysql_query("SHOW SESSION STATUS LIKE 'Questions'"),0,'Value');
    //auto fill ecd information
    mysql_query("delete from ecdppc_info_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from ecdppc_enroll_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from ecd_total_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from ecd_dalit_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from ecd_janjati_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($ecdppc_info_f1,$schoollist));
    mysql_query(sprintf($ecdppc_enroll_f1,$schoollist));
    mysql_query(sprintf($ecd_total_enroll_age_f1,$schoollist));
    mysql_query(sprintf($ecd_dalit_enroll_age_f1,$schoollist));
    mysql_query(sprintf($ecd_janjati_enroll_age_f1,$schoollist));
    
    //autofill last enrollment
    mysql_query("delete from last_class1_5_enroll_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from last_class6_8_enroll_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from last_class9_10_enroll_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($last_class1_5_enroll_f1,$schoollist));
    mysql_query(sprintf($last_class6_8_enroll_f1,$schoollist));
    mysql_query(sprintf($last_class9_10_enroll_f1,$schoollist));
    
    //autofill afterecd 
    mysql_query("delete from afterecd_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($afterecd_f1,$schoollist));
    
    
    //autofill enrollment,repetition,promotion and dropout
    mysql_query("delete from enr_rep_mig_class1_5_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from enr_rep_mig_class6_8_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from enr_rep_mig_class9_10_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($enr_rep_mig_class1_5_f1,$schoollist));
    mysql_query(sprintf($enr_rep_mig_class6_8_f1,$schoollist));
    mysql_query(sprintf($enr_rep_mig_class9_10_f1,$schoollist));
    
    //new enrollment by age
    mysql_query("delete from new_total_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from new_dalit_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from new_janjati_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($new_total_enroll_age_f1,$schoollist));
    mysql_query(sprintf($new_dalit_enroll_age_f1,$schoollist));
    mysql_query(sprintf($new_janjati_enroll_age_f1,$schoollist));
    
    //enrollment by age-primary
    mysql_query("delete from pr_total_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from pr_dalit_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from pr_janjati_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($pr_total_enroll_age_f1,$schoollist));
    mysql_query(sprintf($pr_dalit_enroll_age_f1,$schoollist));
    mysql_query(sprintf($pr_janjati_enroll_age_f1,$schoollist));
    
    //enrollment by age-lsec and sec
    mysql_query("delete from sec_total_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from sec_dalit_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from sec_janjati_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($sec_total_enroll_age_f1,$schoollist));
    mysql_query(sprintf($sec_dalit_enroll_age_f1,$schoollist));
    mysql_query(sprintf($sec_janjati_enroll_age_f1,$schoollist));
    
    //enrollment by age-hsec
    mysql_query("delete from hsec_total_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from hsec_dalit_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from hsec_janjati_enroll_age_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($hsec_total_enroll_age_f1,$schoollist));
    mysql_query(sprintf($hsec_dalit_enroll_age_f1,$schoollist));
    mysql_query(sprintf($hsec_janjati_enroll_age_f1,$schoollist));
    
    //disabled
    mysql_query("delete from ecd_disabled_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from pr_disabled_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from lsec_disabled_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from sec_disabled_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query("delete from hsec_disabled_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
    mysql_query(sprintf($ecd_disabled_f1,$schoollist));
    mysql_query(sprintf($pr_disabled_f1,$schoollist));
    mysql_query(sprintf($lsec_disabled_f1,$schoollist));
    mysql_query(sprintf($sec_disabled_f1,$schoollist));
    mysql_query(sprintf($hsec_disabled_f1,$schoollist));
	// $total_queries_end=mysql_result(mysql_query("SHOW SESSION STATUS LIKE 'Questions'"),0,'Value');	
		//janjati_f1
	
$janjati_list = array(
						"Bankaria",
						"Bankariya",
						"Baramu",
						"Bote",
						"Chepang",
						"Danuwar",
						"Dhanuk",
						"Hayu",
						"Jhagad",
						"Jhangad",
						"Kisan",
						"Kusunda",
						"Lopcha",
						"Majhi",
						"Meche",
						"Mushbadiya",
						"Raji",
						"Raute",
						"Satar",
						"Singsa",
						"Siyar",
						"Surel",
						"Thami",
						"Thunam",
						"Bantar",
						"Darai",
						"Dom",
						"Lepcha",
						"Limbu",
						"Lohar",
						"Ram",
						"Musahar",
						"Mandal",
						"Khatwe",
						"Khatbe",
						"Dusadh",
						"Chamar",
						"Paswan",
						"Halkhor",
						"Ansari",
						"Mallik",
						"Mijar",
						"Basnet",
						"Das",
						"Dash",
						"Miljhar",
						"Ali",
						"Mohd",
						"Khatun",
						"Khatoon",
						"Khan",
						"Kha",
						"Dhobi",
						"Mallah",
						"Sarbhang",
						"Dhuni",
						"Harijan"
						);
						
	
	mysql_query("delete from janjati_f1 where sch_num in (".$schoollist.") and sch_year=".$currentyear.";");
	for($j = 0; $j<sizeof($janjati_list); $j++){
		for($i = 1; $i <= 12; $i++){
			$class_condition = "";
			if($i == 0){
				$class_condition = "class <= 0";
			}else {
				$class_condition = "class = " . $i;
			}
			
			$sql = "insert into janjati_f1(sch_num, sch_year, janjati_type, class, total_f, total_m, total_t, entry_timestamp) 
select 
	t1.sch_num as sch_num, t1.sch_year as sch_year, t1.last_name as janjati_type, t1.class as class, IFNULL(t2.total_f, 0) as total_f, IFNULL(t3.total_m, 0) as total_m, IFNULL(t2.total_f,0)+IFNULL(t3.total_m,0) as total_t, NOW() 
	from 
	(SELECT id_students_main.sch_num, id_students_track.sch_year, id_students_track.class as class, '".$janjati_list[$j]."' as last_name from id_students_track join id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.".$class_condition." and id_students_track.sch_year='".$currentyear."' group by id_students_main.sch_num,id_students_track.sch_year order by class) as t1
	LEFT JOIN 
	(select  m1.sch_num, count(m1.reg_id) as total_f, m1.sch_year, m1.class, m2.gender, m2.last_name from id_students_track as m1 
join id_students_main as m2 
on m1.reg_id = m2.reg_id 
where m1.".$class_condition." and m1.sch_year = '".$currentyear."' and m2.gender = 'F' and m2.last_name = '".$janjati_list[$j]."' group by m2.sch_num, m1.sch_year) as t2 on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year
	LEFT JOIN 
	(select m1.sch_num, count(m1.reg_id) as total_m, m1.sch_year, m1.class, m2.gender, m2.last_name from id_students_track as m1 
join id_students_main as m2 
on m1.reg_id = m2.reg_id 
where m1.".$class_condition." and m1.sch_year = '".$currentyear."' and m2.gender = 'M' and m2.last_name = '".$janjati_list[$j]."' group by m2.sch_num, m1.sch_year) as t3 on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year;";
						//print_r($janjati_list[$j]);
						//print_r($i);
						//echo $i . "<br / >" . $sql . "<br /><br /><br />";
			mysql_query($sql);
		}
		
		
	}
	
	mysql_query("DELETE FROM janjati_f1 WHERE total_t=0;");
		
		// $total_queries= $total_queries_end - $total_queries_start ;
		 // echo $total_queries_start ."<br>";
		 // echo $total_queries_end ."<br>";
		 // echo $total_queries;
		
}


function autofillFlash2($schoollist)
{
    global $currentyear,$attendance,$pr_scores,$lsec_scores,$sec_scores,$pr_scholarship,$lss_scholarship,$school_physical,$school_program,$sections,
            $school_grant,$school_textbook,$school_construction,$school_calendar;
    $total_queries_start= $total_queries_start + mysql_result(mysql_query("SHOW SESSION STATUS LIKE 'Questions'"),0,'Value');	
    //autofill attendance
    mysql_query("delete from attendance where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query(sprintf($attendance,$schoollist));
	//var_dump($attendance);
    
    //autofill average marks
    mysql_query("delete from pr_scores where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from lsec_scores where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from sec_scores where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query(sprintf($pr_scores,$schoollist));
    mysql_query(sprintf($lsec_scores,$schoollist));
    mysql_query(sprintf($sec_scores,$schoollist));
    
    //autofill scholarship
    mysql_query("delete from pr_scholarship where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from lss_scholarship where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query(sprintf($pr_scholarship,$schoollist));
    mysql_query(sprintf($lss_scholarship,$schoollist));
    
    //autofill school physical
    mysql_query("delete from school_physical where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from school_program where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from sections where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from school_grant where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from school_textbook where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from school_construction where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query("delete from school_calendar where sch_num in (".$schoollist.") and sch_year=".($currentyear-1).";");
    mysql_query(sprintf($school_physical,$schoollist));
    mysql_query(sprintf($school_program,$schoollist));
    mysql_query(sprintf($sections,$schoollist));
    mysql_query(sprintf($school_grant,$schoollist));
    mysql_query(sprintf($school_textbook,$schoollist));
    mysql_query(sprintf($school_construction,$schoollist));
    mysql_query(sprintf($school_calendar,$schoollist));
	//$total_queries_end= $total_queries_end + mysql_result(mysql_query("SHOW SESSION STATUS LIKE 'Questions'"),0,'Value');	
	//$total_queries=$total_queries_end-$total_queries_start;
}




?>