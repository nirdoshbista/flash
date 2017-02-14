<?php

require_once("../includes/vars.php");
require_once('../includes/dbfunctions.php');

$link = dbconnect();

// fix tables
include("../tmis/fixtables.php");

// update current values
include("../tmis/update_current_info.php");

$expandteacher = $_GET['expand'];
$sch_num=$_GET['s'];
$sch_year=$_GET['y'];

$report = $_GET['r'];
$sex = $_GET['sex'];
$ethnicity = $_GET['ethnicity'];
$level = $_GET['level'];
$rank = $_GET['rank'];
$apptype = $_GET['apptype'];
$schooltype = $_GET['schooltype'];


if (strlen($sch_num)>=2) $dist_code=substr($sch_num, 0,2);
if (strlen($sch_num)>=5) $vdc_code=substr($sch_num, 2,3);
//if ($sch_num!=9) $sch_num='';

$wc = " AND sch_year='{$sch_year}' ";

$sexes = array("", "Female", "Male", "Other");
$ethnicities = array("", "Dalit", "Janjati", "Brahmin/Chhetri", "Others");
$levels = array("", "ECD" ,"Pri", "Lsec", "Sec");
$ranks = array("", "1st", "2nd", "3rd");
$apptypes = array("", "ECD Facilitator","Permanent","Temporary","Rahat" ,"PCF","Private Sources", "Permanent Leon", "Temporary Leon");
$teachers = array(""," Teacher","Head Teacher");
$subjects = array("", "Nepali","English","Science","Social", "Accounts","Sanskrit", "Pop_Health");
$reporttypes = array("general"=>"General",
					 "salary"=>"Salary",
					 "award"=>"Award",
					 "edu"=>"Education",
					 "leave"=>"Leave",
					 "pub"=>"Publication",
					 "med"=>"Medical Imbursement",
					 "punish"=>"Punishment",
					 "train"=>"Training",
					 "information"=>"Information"
					 );
$schooltypes = array("","Public","Private","Religious");

$filter = '';
$tmissec1filter = '';
$schooltypefilter = '';
$filtertext = array();

if ($sex!='') {
	$filter .= " AND tmis_sec1.sex='$sex' ";
	$tmissec1filter .= " AND t1.sex='$sex' ";
	$filtertext[] = "Sex: ".$sexes[$sex];
}
if ($ethnicity!='') {
	$filter .= " AND tmis_sec1.t_caste=$ethnicity ";
	$tmissec1filter .= " AND t1.t_caste=$ethnicity ";
	$filtertext[] = "Level: ".$ethnicities[$ethnicity];
}
if ($level!='') {
	$filter .= " AND tmis_sec1.curr_perm_level=$level ";
	$tmissec1filter .= " AND t1.curr_perm_level=$level ";
	$filtertext[] = "Level: ".$levels[$level];
}
if ($rank!='') {
	$filter .= " AND tmis_sec1.curr_perm_rank=$rank ";
	$tmissec1filter .= " AND t1.curr_perm_rank=$rank ";
	$filtertext[] = "Rank: ".$ranks[$rank];
}
if ($apptype!='') {
	$filter .= "AND tmis_sec1.curr_perm_type=$apptype ";
	$tmissec1filter .= "AND t1.curr_perm_type=$apptype ";
	$filtertext[] = "Appointment Type: ".$apptypes[$apptype];
}
if ($teacher!='') {
	$filter .= "AND tmis_sec1.head_teacher=$teacher ";
	$tmissec1filter .= "AND t1.head_teacher=$teacher ";
	$filtertext[] = "Teacher:".$teachers[$teacher];
}
if($schooltype !=''){
	$schooltypefilter = "select * from mast_school_type ";
	if($schooltype==1){
		$schooltypefilter.= "where mast_school_type.class1 between 1 and 4 or mast_school_type.class6 between 1 and 4 or mast_school_type.class9 between 1 and 4 or mast_school_type.class11 between 1 and 4";
	} else if($schooltype==2){
		$schooltypefilter.="where mast_school_type.class1 between 5 and 7 or mast_school_type.class6 between 5 and 7 or mast_school_type.class9 between 5 and 7 or mast_school_type.class11 between 5 and 7";
	} else if ($schooltype==3){
		$schooltypefilter.="where mast_school_type.class1 between 8 and 10 or mast_school_type.class6 between 8 and 10 or mast_school_type.class9 between 8 and 10 or mast_school_type.class11 between 8 and 10";
	}
	$filtertext[] = "School Type:".$schooltypes[$schooltype];
}
//
// table data
//

$coldata["award"] = array(
	array("rank","Rank",array("","Pri, 3rd","Pri, 2nd","Pri, 1st","L-Sec, 3rd","L-Sec, 2nd","L-Sec, 1st","Sec, 3rd","Sec, 2nd","Sec, 1st")),
	array("type","Type",null),
	array("org","Organization",null),
	array("date","Date",null)
);

$coldata["edu"] = array(
	array("qualif","Qualification",null),
	array("board","Board",null),
	array("year","Year",null),
	array("division","Division",null),
	array("stream","Stream",null),
	array("subj","Subject",null),
	array("school","School",null),
	array("country","Country",null)
);

$coldata["leave"] = array(
	array("type","Type",null),
	array("dist","District",null),
	array("school","School",null),
	array("date_from","From",null),
	array("date_to","To",null),
	array("dur_year","Duration (Y)",null),
	array("dur_month","Duratiom (M)",null),
	array("dur_day","Duration (D)",null),
	array("remarks","Remarks",null)
);


$coldata["med"] = array(
	array("level","Level",null),
	array("org","Organization",null),
	array("date_dec","Decision Date",null),
	array("dist","District",null),
	array("amt","Amount",null),
	array("date","Date",null)
);

$coldata["pub"] = array(
	array("name","Name",null),
	array("date","Date",null),
	array("lang","Language",null),
	array("sub","Subject",null),
	array("remarks","Remarks",null)
);

$coldata["punish"] = array(
	array("level","Level",array("","Pri, 3rd","Pri, 2nd","Pri, 1st","L-Sec, 3rd","L-Sec, 2nd","L-Sec, 1st","Sec, 3rd","Sec, 2nd","Sec, 1st")),
	array("type","Type",null),
	array("org","Organization",null),
	array("person","Person",null),
	array("date","Date",null)
);

$coldata["train"] = array(
	array("name","Name",array("","Primary","LSec & Sec","Headmaster")),
	array("type","Type",null),
	array("subj","Subject",null),
	array("year","Year",null),
	array("duration","Duration",null),
	array("division","Division",null),
	array("org","Organization",array("","SJBK","TU","Other")),
	array("country","Country",null)
);
// $coldata["information"] = array(
	// array("nepali","Nepali"),
	// array("english","English",null),
	// array("maths","Maths",null),
	// array("science","Science",null),
	// array("social","Social",null),
	// array("accounts","Accounts",null),
	// array("sanskrit","Sanskrit"),
	// array("pop_health","Pop_Health",null),
	// array("environment","Environment",null),
	// array("economics","Economics",null),
	// array("optional","Optional",null),
	// array("others","Others",null),
	// array("ecd","ECD"),
	// array("class1","Class 1",null),
	// array("class2","Class 2",null),
	// array("class3","Class 3",null),
	// array("class4","Class 4",null),
	// array("class5","Class 5",null),
	// array("class6","Class 6"),
	// array("class7","Class 7",null),
	// array("class8","Class 8",null),
	// array("class9","Class 9",null),
	// array("class10","Class 10",null),
	// array("class11","Class 11",null),
	// array("class12","Class 12",null)
	
// );

$traindata["1"]=array("150 hr","180 hr","1st pkg","2nd pkg","3rd pkg","4th pkg","1st stage","2nd stage","3rd stage","Special","1st Sem","2nd Sem","SLC (Ed)","DAG","I Ed.","B Ed.","M Ed.","M Phil","PhD","Others");
$traindata["2"]=array("Mod I-1 mth","Mod I-1.5 mth","Mod I-2.5 mth","Mod II-5 mth","Mod III-1 mth","Mod III-1.5 mth","Mod III-2.5 mth","I Ed.","B Ed.","M Ed.","M Phil","PhD","Others");
$traindata["3"]=array("Primary","LSec/Sec");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>TMIS Report - <?php echo $reporttypes[$report]; ?></title>
<style>
body{ font-family: Verdana; font-size: x-small;}
table{ border-collapse: collapse; border-color: #c5c5c5;}
td{ padding: 2px 5px; font-size: x-small; text-align: center;}
.cu{ text-transform: uppercase; text-align: left; background: #ddd; }
.theader{ font-weight: bold; background-color: #516C89; color: #fff; text-align:left;}
.clear{clear:both;height:10px; text-align: center;}
br.page { page-break-after: always }
</style>
</head>
<body>

<h2 align='center'>TMIS Report - <?php echo $reporttypes[$report]; ?></h2>
<h3 align='center'><?php echo implode(", ",$filtertext); ?></h3>
<table border='1' width='100%'>
<?php if ($report == 'general'): ?>

	<tr class='theader'>
		<td rowspan='2'>Code</td>
		<td rowspan='2'>Name</td>
		<td rowspan='2'>Total</td>
		<td colspan='3'>Sex</td>
		<td colspan='5'>Caste</td>
		<td colspan='5'>Retirement in (year)</td>
		<td colspan='4'>Nationality</td>
		<td colspan='3'>Mother Tongue</td>
		<td colspan='5'>Level</td>
		<td colspan='4'>Rank</td>
		<td colspan='9'>Types</td>
		<td colspan='7'>Educational Status</td>
		<td colspan='3'>Maritial Status</td>
		
		
	</tr>
	<tr class='theader'>
		<td>F</td>
		<td>M</td>
		<td>N/A</td>
		
		<td>Dalit</td>
		<td>Janjati</td>
                <td>Brahmin/Chhetri</td>
		<td>Others</td>
		<td>N/A</td>
		
		<td><?php echo $currentyear; ?></td>
		<td><?php echo $currentyear+1; ?></td>
		<td><?php echo $currentyear+2; ?></td>
		<td><?php echo $currentyear+3; ?></td>
		<td><?php echo $currentyear+4; ?></td>
		
		<td>Nepali</td>
		<td>Indian</td>
		<td>Other</td>
		<td>N/A</td>
				
		<td>Nepali</td>
		<td>Other</td>
		<td>N/A</td>
		
                <td>ECD/PPC</td>
		<td>Pri</td>
		<td>LSec</td>
		<td>Sec</td>
		<td>N/A</td>
		
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>N/A</td>
		
		<td>ECD Facilitator</td>
		<td>Permanent</td>
		<td>Temporary</td>
		<td>Rahat</td>
                <td>PCF</td>
                <td>Private Sources</td>
                <td>Permanent Leon</td>
                <td>Temporary Leon</td>
		<td>N/A</td>
		
                <td>Doctorate</td>
		<td>Masters</td>
		<td>Bachelors</td>
		<td>Intermediate</td>
		<td>SLC</td>
		<td>Under SLC</td>
		<td>N/A</td>
		
		
		<td>Married</td>
		<td>Single</td>
		<td>N/A</td>
		
		
	</tr>
	<?php elseif ($report == 'information'): ?>

	<tr class='theader'>
		<td rowspan='1'>Code</td>
		<td rowspan='1'>Name</td>
		<td rowspan='1'>Total</td>
		<td rowspan='1'>Sex</td>
		<td colspan='1'>DOB</td>
		<td colspan='1'>Appointment Date</td>
		<td colspan='1'>Retirement Year</td>
		<td colspan='1'>Level</td>
		<td colspan='1'>Rank</td>
		<td colspan='1'>Appointment Type</td>
		<td colspan='12'>Teaching Subject</td>
		<td colspan='13'>Teaching Class</td>
		
		
	</tr>
	<tr class='theader'>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Nepali</td>
		<td>English</td>
		<td>Maths</td>
		<td>Science</td>
		<td>Social</td>
		<td>Accounts</td>
		<td>Sanskrit</td>
		<td>Popn_Health</td>
		<td>Environment</td>
		<td>Economics</td>
		<td>Optional</td>
		<td>Others</td>
		
		<td>ECD</td>
		<td>Class 1</td>
		<td>Class 2</td>
		<td>Class 3</td>
		<td>Class 4</td>
		<td>Class 5</td>
		<td>Class 6</td>
		<td>Class 7</td>
		<td>Class 8</td>
		<td>Class 9</td>
		<td>Class 10</td>
		<td>Class 11</td>
		<td>Class 12</td>
		
	</tr>
<?php elseif ($report == 'salary'): ?>
	<tr class='theader'>
		<td>Code</td>
		<td>Name</td>
		<td>Total</td>
		<td>Sex</td>
		<td>DOB</td>
		<td>Appointment Date</td>
		<td>Retirement Year</td>
		<td>Level</td>
		<td>Rank</td>
		<td>Appointment Type</td>
		<td>Teacher</td>
		<td>Telephone</td>
		<td>Bank Name</td>

		<td>Num of Income Sources</td>

		<td>Salary <br />Scale</td>
		<td>Grade</td>
		<td>Total</td>
		<td>Provident<br />Fund</td>
		<td>H.T. Allowance</td>
		<td>Mahangi</td>
		<td>Insurance</td>
		<td>Remote</td>
		<td>Monthly <br />Salary</td>
		<td>Yearly <br />Salary</td>
		<td>Festival </td>
		<td>Total</td>  

		
	</tr>
	
<?php else: ?>

	<tr class='theader'>
		<td rowspan='2'>Code</td>
		<td rowspan='2'>Name</td>
		<td rowspan='2'>Total</td>
		<td rowspan='2'>Sex</td>
		<td rowspan='2'>DOB</td>
		<td rowspan='2'>Appointment Date</td>
		<td rowspan='2'>Retirement Year</td>
		<td rowspan='2'>Level</td>
		<td rowspan='2'>Rank</td>
		<td rowspan='2'>Appointment Type</td>
		

<?php

	echo "<td colspan='".count($coldata[$report])."'>".$reporttypes[$report]."</td>";
	echo "</tr>\n";
	echo "<tr class='theader'>\n";

	foreach ($coldata[$report] as $cols){
		echo "<td>".$cols[1]."</td>";
	}

?>		
		
	</tr>

<?php endif; ?>



<?php 

$distarr = array();
$result = mysql_query("SELECT * FROM mast_district WHERE dist_code LIKE '$dist_code%' ORDER BY dist_code");
while ($row = mysql_fetch_assoc($result)){
	$distarr[$row['dist_code']] = $row['dist_name'];
}

// expand districts
foreach ($distarr as $dist_code=>$dist_name){
	
	if ((strlen($sch_num)>=0 && strlen($sch_num)<5) || $expandteacher) throwRow($dist_code, $dist_name);

	$vdcarr = array();
	$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$dist_code' AND vdc_code LIKE '{$vdc_code}%' ORDER BY vdc_code");
	while ($row = mysql_fetch_assoc($result)){
		$vdcarr[$row['vdc_code']]=$row['vdc_name_e'];
	}
	
	// expand vdcs
	foreach ($vdcarr as $vdc_code=>$vdc_name){
		
		if ((strlen($sch_num)>=2 && strlen($sch_num)<9) || $expandteacher) throwRow($dist_code.$vdc_code, $vdc_name);
		
		$scharr = array();
		if (strlen($sch_num)==9)
			$result = mysql_query("SELECT DISTINCT sch_num, nm_sch FROM mast_schoollist WHERE sch_num='$sch_num' ORDER BY sch_num");
		else		
			$result = mysql_query("SELECT DISTINCT sch_num, nm_sch FROM mast_schoollist WHERE dist_code='$dist_code' AND vdc_code='$vdc_code' AND sch_num LIKE '$sch_num%' ORDER BY sch_num");
			
		while ($row = mysql_fetch_assoc($result)){
			$scharr[$row['sch_num']]=$row['nm_sch'];
		}
		
		// expand schools
		foreach ($scharr as $sch_num_=>$nm_sch){
			
			if (strlen($sch_num)>=5 || $expandteacher) throwRow($sch_num_, $nm_sch);
			
			$tidarr = array();
			$result = mysql_query("SELECT * FROM tmis_main WHERE sch_num='$sch_num_' ORDER BY tid");
			while ($row = mysql_fetch_assoc($result)){
				$tidarr[$row['tid']]=$row['t_name'];
			}
			
			// expand teachers
			foreach ($tidarr as $tid=>$t_name){
				
				if (strlen($sch_num)>=9 || $expandteacher) throwRow($tid, $t_name);
			
			
			}
						
			
		
		}
		
		
	}
	
	
}


?>

</table>

</body>
</html>


<?php

function throwRow($code, $name){
	global $report;
	
	switch ($report){
		case 'general':
			throwRow_general($code, $name);
			break;
		case 'salary':
			throwRow_salary($code, $name);
			break;
		case 'information':
			throwRow_info($code, $name);
			break;
		default:
			throwRow_generic($code,$name);
			break;
		
		/*
		case 'award':
			throwRow_award($code, $name);
			break;
		case 'edu':
			throwRow_edu($code, $name);
			break;
		case 'leave':
			throwRow_leave($code, $name);
			break;
		case 'med':
			throwRow_med($code, $name);
			break;
		case 'pub':
			throwRow_pub($code, $name);
			break;
		case 'punish':
			throwRow_punish($code, $name);
			break;
		*/
			
	}
}

function throwRow_general($code, $name){
	
	global $currentyear;
	
	global $filter, $sch_year, $schooltypefilter, $tmissec1filter;
	
	$table = 'tmis_main';
	$wc = " AND $table.sch_year='{$sch_year}' ";
	
	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	$query = "SELECT COUNT($table.tid) as c FROM $table $join $table.tid LIKE '$code%' $wc $filter";
	
	$query1 = "SELECT Count(t0.tid) FROM tmis_main as t0
		inner join 
		(select * from tmis_sec1) as t1
		on t0.tid = t1.tid and t0.sch_year = t1.sch_year
		inner join 
		($schooltypefilter) as t2
		on t0.sch_year = t2.sch_year and t0.sch_num=t2.sch_num
		where (t0.inactive IS NULL OR t0.inactive='0') AND t0.tid LIKE '$code%' AND t0.sch_year='{$sch_year}' $tmissec1filter";
	
	//echo $query."<br />";
	// var_dump($query);
	// echo '<br />';
	// var_dump($query1);
	// echo '<br />';
	// die();
	$result = mysql_query($query1);
	$row = mysql_fetch_assoc($result);
	
	if ($row['c']==0) return;
	if (strlen($code)>9) $row['c']='';
	
	$color = '#FFF';
	if (strlen($code)==2) $color='#BAC0C9';
	if (strlen($code)==5) $color='#D0D4DA';
	if (strlen($code)==9) $color='#EEE';
	
	
	echo "<tr style='background-color:$color;'>";
	echo "<td style='text-align: left;'>$code</td>";
	echo "<td style='text-align: left;'>$name</td>";
	echo "<td style='text-align: left;'>{$row['c']}</td>";
	
	if (strlen($code)==14) $type = 'tick';
	else $type='count';
	
	
	// sex
	getCountValue('tmis_sec1', 'sex', $code, "sex='1'", $type);		
	getCountValue('tmis_sec1', 'sex', $code, "sex='2'", $type);		
	getCountValue('tmis_sec1', 'sex', $code, "sex=''", $type);		
	
	// caste
	getCountValue('tmis_sec1', 't_caste', $code, "t_caste='1'", $type);
	getCountValue('tmis_sec1', 't_caste', $code, "t_caste='2'", $type);
        getCountValue('tmis_sec1', 't_caste', $code, "t_caste='3'", $type);
	getCountValue('tmis_sec1', 't_caste', $code, "t_caste>3", $type);
	getCountValue('tmis_sec1', 't_caste', $code, "t_caste='0'", $type);
	
	// retirement
	getCountValue('tmis_sec1', 'tid', $code, "(bs_dob_year1 + 60) = $currentyear", $type);
	getCountValue('tmis_sec1', 'tid', $code, "(bs_dob_year1 + 59) = $currentyear", $type);
	getCountValue('tmis_sec1', 'tid', $code, "(bs_dob_year1 + 58) = $currentyear", $type);
	getCountValue('tmis_sec1', 'tid', $code, "(bs_dob_year1 + 57) = $currentyear", $type);
	getCountValue('tmis_sec1', 'tid', $code, "(bs_dob_year1 + 56) = $currentyear", $type);
	
	// nationality
	getCountValue('tmis_sec1', 'nationality', $code, "nationality='Nepalese'", $type);
	getCountValue('tmis_sec1', 'nationality', $code, "nationality='Indian'", $type);
	getCountValue('tmis_sec1', 'nationality', $code, "(nationality!='Nepalese' AND nationality!='Indian' AND nationality!='')", $type);
	getCountValue('tmis_sec1', 'nationality', $code, "nationality=''", $type);
	
	// mother tongue
	getCountValue('tmis_sec1', 'mother_tongue', $code, "mother_tongue='Nepali'", $type);
	getCountValue('tmis_sec1', 'mother_tongue', $code, "(mother_tongue!='Nepali' AND mother_tongue!='')", $type);
	getCountValue('tmis_sec1', 'mother_tongue', $code, "mother_tongue=''", $type);
	
	// position
	getCountValue('tmis_sec1', 'curr_perm_level', $code, "curr_perm_level='1'", $type);
	getCountValue('tmis_sec1', 'curr_perm_level', $code, "curr_perm_level='2'", $type);
	getCountValue('tmis_sec1', 'curr_perm_level', $code, "curr_perm_level='3'", $type);
        getCountValue('tmis_sec1', 'curr_perm_level', $code, "curr_perm_level='4'", $type);
	getCountValue('tmis_sec1', 'curr_perm_level', $code, "curr_perm_level=''", $type);
	
	// rank
	getCountValue('tmis_sec1', 'curr_perm_rank', $code, "curr_perm_rank='1'", $type);
	getCountValue('tmis_sec1', 'curr_perm_rank', $code, "curr_perm_rank='2'", $type);
	getCountValue('tmis_sec1', 'curr_perm_rank', $code, "curr_perm_rank='3'", $type);
	getCountValue('tmis_sec1', 'curr_perm_rank', $code, "curr_perm_rank=''", $type);
	
	// types
	getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='1'", $type);
	getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='2'", $type);
	getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='3'", $type);
	getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='4'", $type);
        getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='5'", $type);
        getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='6'", $type);
        getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='7'", $type);
        getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type='8'", $type);
	getCountValue('tmis_sec1', 'curr_perm_type', $code, "curr_perm_type=''", $type);
	
	// educational status
        getCountValue('tmis_edu', 'qualif', $code, "qualif='1'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif='2'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif='3'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif='4'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif='5'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif='6'", $type);
	getCountValue('tmis_edu', 'qualif', $code, "qualif=''", $type);
	
	// maritial status
	getCountValue('tmis_sec1', 'marital_status', $code, "marital_status='1'", $type);
	getCountValue('tmis_sec1', 'marital_status', $code, "marital_status='2'", $type);
	getCountValue('tmis_sec1', 'marital_status', $code, "marital_status=''", $type);


	echo "</tr>";
	
}

function getCountValue($table, $column, $code, $condition, $type){
	
	global $filter, $sch_year;
	
	$wc = " AND $table.sch_year='{$sch_year}' ";
	
	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	if ($type=='count') $query = "SELECT COUNT($table.tid) as c FROM $table $join  $table.tid LIKE '$code%' $wc $filter";
	else if ($type == 'sum') $query = "SELECT SUM($table.$column) as c FROM $table $join  $table.tid LIKE '$code%' $wc $filter";
	else $query = "SELECT $table.$column as c FROM $table $join  $table.tid LIKE '$code%' $wc $filter";
	
	
	
	if ($condition!='') $query .= " AND $condition";
	$result = mysql_query($query);
	
	echo "<td>";
	//echo $query;
	if ($row = mysql_fetch_assoc($result)){
		if ($type=='count' || $type=='sum') echo $row['c'];
		else if ($type=='tick') echo "✓"; 
		else echo $row['c'];
	}
	echo "</td>";
	
}

function throwRow_salary($code, $name){
	
	global $currentyear;
	global $wc, $filter, $sch_year;
	global $levels, $ranks, $apptypes, $sexes;
	global $teachers;
	
	$table = 'tmis_main';
	$wc = " AND $table.sch_year='{$sch_year}' ";
	
	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	$query = "SELECT COUNT($table.tid) as c FROM $table $join $table.tid LIKE '$code%' $wc $filter";
	$result = mysql_query($query);
	//echo $query;
	$row = mysql_fetch_assoc($result);
	
	if ($row['c']==0) return;
	if (strlen($code)>9) $row['c']='';
	
	$color = '#FFF';
	if (strlen($code)==2) $color='#BAC0C9';
	if (strlen($code)==5) $color='#D0D4DA';
	if (strlen($code)==9) $color='#EEE';
	
	
	echo "<tr style='background-color:$color;'>";
	echo "<td style='text-align: left;'>$code</td>";
	echo "<td style='text-align: left;'>$name</td>";
	echo "<td style='text-align: left;'>{$row['c']}</td>";
	
	if (strlen($code)==14) $type = 'tick';
	else $type='count';
		
	
	$tid = $code;
	$t_name = $name;
	
	if (strlen($tid)==14){
	
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year' LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		$data["sex"] = $sexes[$row['sex']];
		
		if ($row['bs_dob_year1']!=''){
			$data["DOB"] = $row['bs_dob_year1'].'/'.$row['bs_dob_month1'].'/'.$row['bs_dob_day1'];
			$ry = (int)($row['bs_dob_year1'])+60;
		}
		else {
			$data["DOB"] = "";
			$ry = "";
		}	
		

		
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		
		if ($row['current_app_year']!=''){
			$data["Appointment Date"] = $row['current_app_year'].'/'.$row['current_app_month'].'/'.$row['current_app_day'];
		}
		else $data["Appointment Date"] = '';
		
		$data["Retirement Year"]  = $ry;		
				
		$data["Level"] = $levels[$row['curr_perm_level']];
		$data["Rank"] = $ranks[$row['curr_perm_rank']];
		$data["Appointment Type"] = $apptypes[$row['curr_perm_type']];
		$data["Teacher"]=$teachers[$row['head_teacher']];
		$data["Contact"]=$row['perm_addr_phone'];
		$data["Bank"]=$row['bank_name'];
		
		// tmis_inc	
		
		$result = mysql_query("SELECT count(tid) as c FROM tmis_inc WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		$n = $row["c"];
		if ($n==0) $n="";
		$data["n"] = $n;
	
	}
	else{
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
	}
	
	
	$table = 'tmis_inc';
	$wc = " AND $table.sch_year='{$sch_year}' ";

	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	$query = "SELECT sum(scale) as scale, sum(grade) as grade, sum(ta) as ta, sum(ra) as ra, sum(ma) as ma, sum(mahangi) as mahangi, sum(insurance) as insurance, sum(festival) festival, sum(total) as total FROM $table $join $table.tid LIKE '$tid%' $wc $filter";

	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	
	//echo $query;
	
	/*
			
	$data["scale"]=$row["scale"];
	$data["grade"]=$row["grade"];
	$data["ta"]=$row["ta"];
	$data["ra"]=$row["ra"];
	$data["ma"]=$row["ma"];
	$total = $row["scale"]*1+$row["grade"]*1+$row["ta"]*1+$row["ra"]*1+$row["ma"]*1;
	if ($total==0) $total="";
	$data["total"] = $total;
	*/
	
	
	/*
	
		<td>Salary <br />Scale</td>
		<td>Grade</td>
		<td>Total</td>
		<td>Provident<br />Fund</td>
		<td>H.T. Allowance</td>
		<td>Mahangi</td>
		<td>Insurance</td>
		<td>Remote</td>
		<td>Monthly <br />Salary</td>
		<td>Yearly <br />Salary</td>
		<td>Festival </td>
		<td>Total</td>  
	 
	*/
	$data["scale"]=$row["scale"];
	$data["grade"]=$row["grade"];
	$data["sg_total"] = $row["scale"]*1+$row["grade"]*1;
	$data["ma"]=$row["ma"];
	$data["ta"]=$row["ta"];
	$data["mahangi"]=$row["mahangi"];
	$data["insurance"]=$row["insurance"];
	$data["ra"]=$row["ra"];
	$data["monthly"]=$row["scale"]*1+$row["grade"]*1+$row["ta"]*1+$row["ra"]*1+$row["ma"]*1;
	$data["yearly"]=$data["monthly"]*12+$row["scale"]*1;
	$data["festival"]=$row["festival"];
	$data["total"]=$row["scale"]*12+$row["ta"]*1+$row["ra"]*1+$row["ma"]*1;
	
	foreach ($data as $d){
		if ($d=="0") $d='';
		echo "<td>".$d."&nbsp;</td>";
	}
	echo "</tr>\n";	
	
}
function throwRow_info($code, $name){
	
	global $currentyear;
	global $wc, $filter, $sch_year;
	global $levels, $ranks, $apptypes, $sexes;
	
	$table = 'tmis_main';
	$wc = " AND $table.sch_year='{$sch_year}' ";
	
	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	$query = "SELECT COUNT($table.tid) as c FROM $table $join $table.tid LIKE '$code%' $wc $filter";
	$result = mysql_query($query);
	//echo $query;
	$row = mysql_fetch_assoc($result);
	
	if ($row['c']==0) return;
	if (strlen($code)>9) $row['c']='';
	
	$color = '#FFF';
	if (strlen($code)==2) $color='#BAC0C9';
	if (strlen($code)==5) $color='#D0D4DA';
	if (strlen($code)==9) $color='#EEE';
	
	
	echo "<tr style='background-color:$color;'>";
	echo "<td style='text-align: left;'>$code</td>";
	echo "<td style='text-align: left;'>$name</td>";
	echo "<td style='text-align: left;'>{$row['c']}</td>";
	
	if (strlen($code)==14) $type = 'tick';
	else $type='count';
		
	
	$tid = $code;
	$t_name = $name;
	
	if (strlen($tid)==14){
	
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year' LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		$data["sex"] = $sexes[$row['sex']];
		
		if ($row['bs_dob_year1']!=''){
			$data["DOB"] = $row['bs_dob_year1'].'/'.$row['bs_dob_month1'].'/'.$row['bs_dob_day1'];
			$ry = (int)($row['bs_dob_year1'])+60;
		}
		else {
			$data["DOB"] = "";
			$ry = "";
		}	
		

		
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		
		if ($row['current_app_year']!=''){
			$data["Appointment Date"] = $row['current_app_year'].'/'.$row['current_app_month'].'/'.$row['current_app_day'];
		}
		else $data["Appointment Date"] = '';
		
		$data["Retirement Year"]  = $ry;		
				
		$data["Level"] = $levels[$row['curr_perm_level']];
		$data["Rank"] = $ranks[$row['curr_perm_rank']];
		$data["Appointment Type"] = $apptypes[$row['curr_perm_type']];
		// $data["Teacher"]=$teachers[$row['head_teacher']];
		// $data["Contact"]=$row['perm_addr_phone'];
		// $data["Bank"]=$row['bank_name'];
		
		// tmis_inc	
		
		$result = mysql_query("SELECT * FROM tmis_educational_info WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		$data["Nepali"] = $row['nepali'];
		$data["English"] = $row['english'];
		$data["Maths"] = $row['maths'];
		$data["Science"] = $row['science'];
		$data["Social"] = $row['social'];
		$data["Accounts"] = $row['account'];
		$data["Sanskrit"] = $row['sanskrit'];
		$data["Pop_Health"] = $row['popn_health'];
		$data["Environment"] = $row['environment'];
		$data["Economics"] = $row['economics'];
		$data["Optional"] = $row['optional'];
		$data["Others"] = $row['others'];
		
		$data["ECD"] = $row['ecd'];
		$data["Class 1"] = $row['class1'];
		$data["Class 2 "] = $row['class2'];
		$data["Class 3"] = $row['class3'];
		$data["Class 4 "] = $row['class4'];
		$data["Class 5"] = $row['class5'];
		$data["Class 6 "] = $row['class6'];
		$data["Class 7"] = $row['class7'];
		$data["Class 8 "] = $row['class8'];
		$data["Class 9"] = $row['class9'];
		$data["Class 10 "] = $row['class10'];
		$data["Class 11"] = $row['class11'];
		$data["Class 12 "] = $row['class12'];

	}
	else{
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
	}
	
	foreach ($data as $d){
		if ($d=="1") $d='✓';
		echo "<td>".$d."&nbsp;</td>";
	}
	echo "</tr>\n";	
	
}

function throwRow_generic($code, $name){
	
	global $currentyear;
	global $wc, $filter, $sch_year;
	global $levels, $ranks, $apptypes, $sexes;
	global $report, $coldata, $traindata;
	
	$table = 'tmis_main';
	$wc = " AND $table.sch_year='{$sch_year}' ";
	
	$join = '';
	//if ($filter != ''){
		if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
		if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
		$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";
	//}
	//else $join = ' WHERE ';
	
	$query = "SELECT COUNT($table.tid) as c FROM $table $join $table.tid LIKE '$code%' $wc $filter";
	$result = mysql_query($query);
	//echo $query;
	$row = mysql_fetch_assoc($result);
	
	if ($row['c']==0) return;
	if (strlen($code)>9) $count=''; else $count=$row['c'];
	
	// grab number of rows
	$table = "tmis_".$report;	
	
	// prepare join statement
	$join = '';
	if ($table!='tmis_main') $join = " LEFT JOIN tmis_main USING (tid, sch_year) ";
	if ($table!='tmis_sec1') $join .= " LEFT JOIN tmis_sec1 USING (tid, sch_year) ";
	$join .= " WHERE (tmis_main.inactive IS NULL OR tmis_main.inactive='0') AND ";	
	

	$query = "SELECT COUNT($table.tid) as c FROM $table $join $table.tid LIKE '$code%' $wc $filter";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);	
	
	$rowcount = $row['c'];
	if ($rowcount>1 && strlen($code)>9) $rowspan = " rowspan='$rowcount' "; else $rowspan='';
	
	$color = '#FFF';
	if (strlen($code)==2) $color='#BAC0C9';
	if (strlen($code)==5) $color='#D0D4DA';
	if (strlen($code)==9) $color='#EEE';
	
	
	echo "<tr style='background-color:$color;'>";
	echo "<td style='text-align: left;' $rowspan>$code</td>";
	echo "<td style='text-align: left;' $rowspan>$name</td>";
	echo "<td style='text-align: left;' $rowspan>$count</td>";
	
	if (strlen($code)==14) $type = 'tick';
	else $type='count';
	
	$tid = $code;
	$t_name = $name;
	
	// throw common columns
	if (strlen($tid)==14){
	
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year' LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		$data["sex"] = $sexes[$row['sex']];
		
		if ($row['bs_dob_year1']!=''){
			$data["DOB"] = $row['bs_dob_year1'].'/'.$row['bs_dob_month1'].'/'.$row['bs_dob_day1'];
			$ry = (int)($row['bs_dob_year1'])+60;
		}
		else {
			$data["DOB"] = "";
			$ry = "";
		}	
		

		
		// tmis_sec2
		$result = mysql_query("SELECT * FROM tmis_sec2 WHERE tid='$tid' AND sch_year='$sch_year' ORDER BY dec_year DESC, dec_month DESC, dec_day DESC LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		if ($row['dec_year']!=''){
			$data["Appointment Date"] = $row['dec_year'].'/'.$row['dec_month'].'/'.$row['dec_day'];
		}
		else $data["Appointment Date"] = '';
		
		$data["Retirement Year"]  = $ry;		
				
		$data["Level"] = $levels[$row['appoint_level']];
		$data["Rank"] = $ranks[$row['appoint_rank']];
		$data["Appointment Type"] = $apptypes[$row['appoint_type']];


	}
	else{
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
		$data[]='&nbsp;';
	}
	
	foreach ($data as $d){
		if ($d=="0") $d='';
		echo "<td $rowspan>".$d."&nbsp;</td>\n";
	}
	
	// now grab the table specific columns
	$query = "SELECT * FROM $table $join $table.tid LIKE '$code%' $wc $filter ORDER BY sn";
	$result = mysql_query($query);
	//echo $query."<br />\n";
	
	if (mysql_num_rows($result)==0 || strlen($code)<=9){
		
		foreach ($coldata[$report] as $cols){
			echo "<td>&nbsp;</td>\n";
		}
		echo "</tr>\n";		
		
		
	}
	else{
	
		while ($row = mysql_fetch_assoc($result)){
			foreach ($coldata[$report] as $cols){
				
				if (strpos($cols[0],"date")!==false){
					
					$yearcol = str_replace("date","year",$cols[0]);
					$monthcol = str_replace("date","month",$cols[0]);
					$daycol = str_replace("date","day",$cols[0]);
					
					$date = $row[$yearcol].'/'.$row[$monthcol].'/'.$row[$daycol];
					$date=str_replace("//","",$date);
					
					echo "<td>".$date."&nbsp;</td>\n";
					
				}
				else{
					$d='';
					if ($cols[2]!=null) $d=$cols[2][$row[$cols[0]]];
					else {
						if ($report=="train" && $cols[0]=="type") $d=$traindata["{$row['name']}"][$row[$cols[0]]];
						else $d=$row[$cols[0]];
					}
					
					if ($d=="0") $d='';
					echo "<td>$d</td>";
				}
			}
			echo "</tr>\n";
		}
	}	
		
}

?>
