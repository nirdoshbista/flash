<?php

require_once("includes/bootstrap.php");

$caste = $_GET['caste'];
$sex = $_GET['sex'];
$sort = $_GET['sort'];
$sch_code = $_GET['s'];
$sch_year = $_GET['y'];
$class = $_GET['c'];
$dob_en_y_ = $_GET['dob_en_y'];



// prepare hashes
$sex_ = array(1=>"M",2=>"F");
$caste_ = array(1=>"Dalit", "Janjati", "Badi", "Brahmin/Chhetri", "Tharu", "Raji", "Sonaha", "Mukta", "Kamaiya", "Madheshi", "Muslim", "Others");
$disability_ = array(1=>"", "Deaf", "Blind", "Dumb", "Physically Disabled", "Mentally Disabled", "Others");


// extract district and vdc code
$dist_code = substr($sch_code, 0,2);
$vdc_code = substr($sch_code, 2,3);

// is nolimit set? if yes, only print top 100 rows
$nolimit = isset($_GET['nolimit']);

// heading string
$hstr = array();
$hstr[] = get_dist_vdc($sch_code);

$query = "SELECT stu_num, sch_num, sch_year, `student_main`.`class` as `class`, reg_id, first_name, last_name, sex, caste_ethnicity, disability, dob_np_y,
				 s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s1+s2+s3+s4+s5+s6+s7+s8+s9+s10+s11+s12 as total
			FROM `student_main`
			LEFT JOIN `student_marks`
			USING (`stu_num`, `sch_year`)
			WHERE stu_num LIKE '$sch_code%'
				AND sch_year = '$sch_year'
				AND	`student_main`.`class` = '$class' ";
				
if ($caste!='') { $query .= " AND caste_ethnicity='$caste' "; $hstr[] = "Caste: ".$caste_[$caste]; }
if ($sex!='') { $query .= " AND sex='$sex' "; $hstr[] = "Sex: ".$sex_[$sex]; }

$query .= ' ORDER BY ';

if ($sort == 'mark') $query .= ' total DESC, ';
$query .= ' first_name, last_name ';

//if ($nolimit==false) $query .= ' LIMIT 0,100';

	
// get subjects
$result = mysql_query("SELECT * FROM subjects WHERE dist_code='$dist_code' AND `class`='$class' ORDER BY subject_sn");
$subjects = array();

while ($row=mysql_fetch_assoc($result)) $subjects[$row['subject_sn']]=$row['subject_name'];

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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Flash Achievement Report</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery/jquery.tablesorter.css" />
		<script type="text/javascript" src="js/jquery/jquery.js"></script>
		<script type="text/javascript" src="js/jquery/jquery.tablesorter.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#reporttable').tablesorter({widgets: ['zebra']});
			});
		</script>
		<style type="text/css">
			h1{font-size: 1.4em;}
			h2{font-size: 1.1em;}
			h3{font-size: 1em;}
		</style>
	</head>
	<body>
	
		<h1 align='center'>Flash Achievement Report</h1>
		<h2 align='center'><?php echo implode("<br />", $hstr); ?></h2>
		
		<?php
			$result = mysql_query($query);
			
			//echo $query;
			
			if ($nolimit == false){
				echo "<p align='right'>Showing only top 100. <a href='".$_SERVER['REQUEST_URI']."&nolimit'>Show all</a></p>";
			}
			//else echo "<p align='right'>Showing ".mysql_num_rows($result)." students.</p>";
		?>
	
		<table id='reporttable' class='tablesorter'>
			<thead>
				<tr>
					<th>Student ID</th>
					<th>Reg ID</th>
					<th>Name</th>
					<th>School</th>
					<th>Sex</th>
					<th>Caste</th>
					<th>Disability</th>
					<th>Year of Birth</th>
					<?php
						foreach ($subjects as $subj) echo "<th>".substr($subj,0,3)."</th>\n";
					?>
					<th>Total</th>
				</tr>
			
			</thead>
			<tbody>
			<?php
			
				$row_count = 0;
				while ($row = mysql_fetch_assoc($result)){
					
					$st = get_school_type($row['sch_num'],$class, $sch_year);
					
					if ($sch_type == 1 && $st != 1) continue;
					if ($sch_type == 2 && $st != 2) continue;
					if ($sch_type == 3 && $st != 3) continue;
					if ($sch_type == 4 && $st != 4) continue;
					
					if ($sch_type == 5 && !($st >= 1 && $st <=4)) continue;
					if ($sch_type == 6 && !(($st >= 1 && $st <=4) || ($st >=8 && $st<=10))) continue;
					
					if ($sch_type == 7 && $st != 5) continue;
					if ($sch_type == 8 && $st != 6) continue;
					if ($sch_type == 9 && $st != 7) continue;
					if ($sch_type == 10 && !($st >= 5 && $st <=7)) continue;

					if ($sch_type == 11 && $st != 8) continue;
					if ($sch_type == 12 && $st != 9) continue;
					if ($sch_type == 13 && $st != 10) continue;
					if ($sch_type == 14 && !($st >= 8 && $st <=10)) continue;
					
/*

	<option value='1'> Government Aided </option>
	<option value='2'> Community Managed </option>
	<option value='3'> Quota Teacher </option>
	<option value='4'> Government Unaided </option>
	<option value='5'> Government Supported (Excluding Religious) </option>
	<option value='6'> Government Supported (Including Religious) </option>
	<option value='7'> Institutional but Private Trust </option>
	<option value='8'> Institutional but Public Trust </option>
	<option value='9'> Institutional but Company </option>
	<option value='10'> Institutional (All) </option>
	<option value='11'> Madrassas </option>
	<option value='12'> Gumbas </option>
	<option value='13'> Ashrams </option>
	<option value='14'> Religious (All)</option>
 * 
 */					
					
					
					echo "<tr>\n";
					
					echo "<td>{$row['stu_num']}</td>\n";
					echo "<td>{$row['reg_id']}</td>\n";
					echo "<td>{$row['first_name']} {$row['last_name']}</td>\n";
					echo "<td>".get_nm_sch($row['sch_num'])." [{$row['sch_num']}]</td>\n";
					echo "<td>".$sex_[$row['sex']]."</td>\n";
					echo "<td>".$caste_[$row['caste_ethnicity']]."</td>\n";
					echo "<td>".$disability_[$row['disability']]."</td>\n";
					echo "<td>{$row['dob_np_y']}</td>\n";

					foreach ($subjects as $n=>$v){
						echo "<td>{$row["s".$n]}</td>\n";
					}
					echo "<td>{$row['total']}</td>\n";
					echo "</tr>\n";
					
					$row_count++;
					
					if ($row_count==100 && $nolimit==false) break;
				}
			
			?>
			</tbody>
		</table>
		<?php echo $row_count; ?>
	</body>
	
</html>
