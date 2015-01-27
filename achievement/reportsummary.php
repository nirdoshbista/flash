<?php

require_once("includes/bootstrap.php");

$caste = $_GET['caste'];
$sex = $_GET['sex'];
$sort = $_GET['sort'];
$sch_code = $_GET['s'];
$sch_year = $_GET['y'];
$class = $_GET['c'];
$sch_type=$_GET['sch_type'];

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

//get the dist_code and vdc code as well as the schoolcode if given
$s=$sch_code;


$query = "SELECT stu_num, sch_num, sch_year, `student_main`.`class` as `class`, reg_id, first_name, last_name, sex, caste_ethnicity, disability, 
				 s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s1+s2+s3+s4+s5+s6+s7+s8+s9+s10+s11+s12 as total
			FROM `student_main`
			LEFT JOIN `student_marks` USING (`stu_num`, `sch_year`)
			WHERE stu_num LIKE '$s%'
				AND sch_year = '$sch_year'
				AND	`student_main`.`class` = '$class' ";
				
if ($caste!='') { $query .= " AND caste_ethnicity='$caste' "; $hstr[] = "Caste: ".$caste_[$caste]; }
if ($sex!='') { $query .= " AND sex='$sex' "; $hstr[] = "Sex: ".$sex_[$sex]; }

// get subjects
$result = mysql_query("SELECT * FROM subjects WHERE dist_code='$dist_code' AND `class`='$class' and sch_year='$sch_year' ORDER BY subject_sn");
$subjects = array();


$pass_condition = array();
$fail_condition = array();

$total_mark = 0;
while ($row=mysql_fetch_assoc($result)) {
	$subjects[$row['subject_sn']]=$row['subject_name'];
	
	$pass_condition[] = "COALESCE(s{$row['subject_sn']}_theory+s{$row['subject_sn']}_grace,0)>={$row['subject_theory_pass_mark']}";
	$pass_condition[] = "COALESCE(s{$row['subject_sn']}_practical,0)>={$row['subject_practical_pass_mark']}";
	
	$fail_condition[] = "COALESCE(s{$row['subject_sn']}_theory+s{$row['subject_sn']}_grace,0)<{$row['subject_theory_pass_mark']}";
	$fail_condition[] = "COALESCE(s{$row['subject_sn']}_practical,0)<{$row['subject_practical_pass_mark']}";
	
	$total_mark += ((int)$row['subject_theory_full_mark'] + (int)$row['subject_practical_full_mark']);

}

$dist = $total_mark * 0.8;
$first = $total_mark * 0.6;
$second = $total_mark * 0.45;
$third = $total_mark * 0.32;

if($total_mark>0)
{
    $pass = " AND (".implode(" AND ", $pass_condition).")";
    $fail = " AND (".implode(" OR ", $fail_condition).")";
    $dist_condition=" HAVING (total>=$dist)";
    $firstdiv_condition=" HAVING (total>=$first AND total<$dist)";
    $seconddiv_condition=" HAVING (total>=$second AND total<$first)";
    $thirddiv_condition=" HAVING (total>=$third AND total<$second)";
}


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

function get_school_type($s, $class, $sch_year){
	global $flashdblink, $currentyear;
	
	$result = mysql_query("SELECT class$class class FROM mast_school_type WHERE sch_num='$s' AND sch_year='$sch_year'", $flashdblink);
	$r = mysql_fetch_assoc($result);
	
	return $r['class'];
}

function get_total($q){
       // echo $q;
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
                            <th></th>
                            <td>Male</td>
                            <td>Female</td>
                            <td>Dalit</td>
                            <td>Janajati</td>
                            <td>Brahmin/Chhetri</td>
                            <td>Others</td>
                            <td>Total</td>
                        </tr>
			<tr>
				<th>Total Students</th>
                                <td><?php echo get_total($query." AND sex='1'"); ?></td>
                                <td><?php echo get_total($query." AND sex='2'"); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query." AND caste_ethnicity='$caste' "); ?></td>
                                <?php } ?>
                                <td><?php echo get_total($query); ?></td>
                                
			</tr>
			<tr>
				<th>Total Pass</th>
                                <td><?php echo get_total($query.$pass." AND sex='1'"); ?></td>
                                <td><?php echo get_total($query.$pass." AND sex='2'"); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$pass." AND caste_ethnicity='$caste' "); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$pass); ?></td>
			</tr>
			<tr>
				<th>Total Fail</th>
                                <td><?php echo get_total($query.$fail." AND sex='1'"); ?></td>
                                <td><?php echo get_total($query.$fail." AND sex='2'"); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$fail." AND caste_ethnicity='$caste' "); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$fail); ?></td>
			</tr>
			<tr>
				<th>Distinction</th>
                                <td><?php echo get_total($query.$pass." AND sex='1'".$dist_condition); ?></td>
                                <td><?php echo get_total($query.$pass." AND sex='2'".$dist_condition); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$pass." AND caste_ethnicity='$caste' ".$dist_condition); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$pass.$dist_condition); ?></td>
			</tr>
			<tr>
				<th>First Division</th>
                                <td><?php echo get_total($query.$pass." AND sex='1'".$firstdiv_condition); ?></td>
                                <td><?php echo get_total($query.$pass." AND sex='2'".$firstdiv_condition); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$pass." AND caste_ethnicity='$caste' ".$firstdiv_condition); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$pass.$firstdiv_condition ); ?></td>
			</tr>
			<tr>
				<th>Second Division</th>
                                <td><?php echo get_total($query.$pass." AND sex='1'".$seconddiv_condition); ?></td>
                                <td><?php echo get_total($query.$pass." AND sex='2'".$seconddiv_condition); ?></td>
                                <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$pass." AND caste_ethnicity='$caste' ".$seconddiv_condition); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$pass.$seconddiv_condition ); ?></td>
			</tr>
			<tr>
				<th>Third Division</th>
                                <td><?php echo get_total($query.$pass." AND sex='1'".$thirddiv_condition); ?></td>
                                <td><?php echo get_total($query.$pass." AND sex='2'".$thirddiv_condition); ?></td>
                                 <?php for ($caste = 1; $caste <= 4; $caste++) { ?>
                                <td><?php echo get_total($query.$pass." AND caste_ethnicity='$caste' ".$thirddiv_condition); ?></td>
                                <?php } ?>
				<td><?php echo get_total($query.$pass.$thirddiv_condition ); ?></td>
			</tr>
			
			

		</table>
		</p>
	
	</body>
	
</html>
