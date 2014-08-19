<?php

require_once("includes/bootstrap.php");

$caste = $_GET['caste'];
$sex = $_GET['sex'];
$sort = $_GET['sort'];
$sch_code = $_GET['s'];
$sch_year = $_GET['y'];
$class = $_GET['c'];

// prepare hashes
$sex_ = array(1=>"M",2=>"F");
$caste_ = array(1=>"Dalit", "Janjati", "Badi", "Brahmin/Chhetri", "Tharu", "Raji", "Sonaha", "Mukta", "Kamaiya", "Madheshi", "Muslim", "Others");
$disability_ = array(1=>"", "Deaf", "Blind", "Dumb", "Physically Disabled", "Mentally Disabled", "Others");

// extract district and vdc code
$dist_code = substr($sch_code, 0,2);
$vdc_code = substr($sch_code, 2,3);

// heading string
$hstr = array();
$hstr[] = get_dist_vdc($sch_code);

$query = "SELECT stu_num, sch_num, sch_year, `student_main`.`class` as `class`, reg_id, first_name, last_name, sex, caste_ethnicity, disability, 
				 s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s1+s2+s3+s4+s5+s6+s7+s8+s9+s10+s11+s12 as total
			FROM `student_main`
			LEFT JOIN `student_marks`
			USING (`stu_num`, `sch_year`)
			WHERE stu_num LIKE '$s%'
				AND sch_year = '$sch_year'
				AND	`student_main`.`class` = '$class' ";
				
if ($caste!='') { $query .= " AND caste_ethnicity='$caste' "; $hstr[] = "Caste: ".$caste_[$caste]; }
if ($sex!='') { $query .= " AND sex='$sex' "; $hstr[] = "Sex: ".$sex_[$sex]; }

// get subjects
$result = mysql_query("SELECT * FROM subjects WHERE dist_code='$dist_code' AND `class`='$class' ORDER BY subject_sn");
$subjects = array();


$pass_condition = array();
$fail_condition = array();

$total_mark = 0;
while ($row=mysql_fetch_assoc($result)) {
	$subjects[$row['subject_sn']]=$row['subject_name'];
	
	$pass_condition[] = "s{$row['subject_sn']}_theory>={$row['subject_theory_pass_mark']}";
	$pass_condition[] = "s{$row['subject_sn']}_practical>={$row['subject_practical_pass_mark']}";
	
	$fail_condition[] = "s{$row['subject_sn']}_theory<{$row['subject_theory_pass_mark']}";
	$fail_condition[] = "s{$row['subject_sn']}_practical<{$row['subject_practical_pass_mark']}";
	
	$total_mark += ((int)$row['subject_theory_full_mark'] + (int)$row['subject_practical_full_mark']);

}

$pass = "(".implode(" AND ", $pass_condition).")";
$fail = "(".implode(" OR ", $fail_condition).")";

$dist = $total_mark * 0.8;
$first = $total_mark * 0.6;
$second = $total_mark * 0.45;
$third = $total_mark * 0.32;

function get_dist_vdc($sch_code){
	global $flashdblink;
	
	$dist_code = substr($sch_code, 0,2);
	$vdc_code = substr($sch_code, 2,3);
	
	$result = mysql_query("SELECT * FROM mast_district WHERE dist_code='$dist_code'",$flashdblink);
	$row = mysql_fetch_assoc($result);
	
	$str = $row['dist_name'];
	
	if ($vdc_code!=''){
		$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$dist_code' AND vdc_code='$vdc_code'",$flashdblink);
		$row = mysql_fetch_assoc($result);
		
		$str .= ", ".$row['vdc_name_e'];
		
	}
	
	return $str;
	
}

function get_nm_sch($s){
	
	global $flashdblink, $currentyear;
	
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$s' AND flash1='1' ORDER BY sch_year DESC LIMIT 0,1",$flashdblink);
	$row = mysql_fetch_assoc($result);

	return $row['nm_sch'];

}

function get_total($q){
	global $dblink;
	
	$result = mysql_query($q);

	return mysql_num_rows($result);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Flash Achievement Report</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery/jquery.tablesorter.css" />
		<style type="text/css">
			h1{font-size: 1.4em;}
			h2{font-size: 1.1em;}
			h3{font-size: 1em;}
			th,td{font-size: 1.1em;padding: 10px; font-weight: bold;}

		</style>
	</head>
	<body>
	
		<h1 align='center'>Flash Achievement Report</h1>
		<h2 align='center'><?php echo implode("<br />", $hstr); ?></h2>
		<p align='center'>
		<table style="width: 200px;" align='center'>
			<tr>
				<th>Total Students</th>
				<td><?php echo get_total($query); ?></td>
			</tr>
			<tr>
				<th>Total Pass</th>
				<td><?php echo get_total($query." AND ".$pass); ?></td>
			</tr>
			<tr>
				<th>Total Fail</th>
				<td><?php echo get_total($query." AND ".$fail); ?></td>
			</tr>
			<tr>
				<th>Distinction</th>
				<td><?php echo get_total($query." AND ".$pass. " HAVING (total>=$dist)"); ?></td>
			</tr>
			<tr>
				<th>First Division</th>
				<td><?php echo get_total($query." AND ".$pass. " HAVING (total>=$first AND total<$dist)"); ?></td>
			</tr>
			<tr>
				<th>Second Division</th>
				<td><?php echo get_total($query." AND ".$pass. " HAVING (total>=$second AND total<$first)"); ?></td>
			</tr>
			<tr>
				<th>Third Division</th>
				<td><?php echo get_total($query." AND ".$pass. " HAVING (total>=$third AND total<$second)"); ?></td>
			</tr>
			
			

		</table>
		</p>
	
	</body>
	
</html>
