<?php

require_once("../includes/vars.php");
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$dist_code=$_GET['d'];
$vdc_code=$_GET['v'];
$sch_num=$_GET['s'];
$sch_year=$_GET['y'];

$wc = " WHERE sch_year='{$sch_year}' ";


?>

<html>
<head>
<title>TMIS Report Card</title>
<style>
body{ font-family: Verdana; font-size: x-small;}
table{ border-collapse: collapse; }
td{ padding: 2px 5px; font-size: x-small;}
.cu{ text-transform: uppercase; text-align: left; background: #ddd; }
.theader{ font-weight: bold; background-color: #eee; text-align:left;}
.clear{clear:both;height:10px; text-align: center;}
br.page { page-break-after: always }

</style>
</head>
<body>

<?php 

$result = mysql_query("SELECT * FROM tmis_main WHERE sch_num LIKE '$sch_num%' AND sch_year='$sch_year' AND (tmis_main.inactive IS NULL OR tmis_main.inactive='0') ORDER BY sch_num, t_name");
if (mysql_num_rows($result)>0){
	
	while ($row = mysql_fetch_assoc($result)){
		$tid = $row['tid'];
		reportHeader($tid); 
		reportTmis($tid);
		echo "<br class='page' />\n";
	}
}
else{
	echo "No teachers in database for this school";
}


?>

</body>
</html>
<?php

function reportHeader($tid){
	
	global $link, $wc;
	
	?>
	
	<table>
		<tr>
			<td width="10%" align="left"><img src="nepalgovt.png" width="100px"></td>
			<td width="80%" align="center">
				<h1>Teacher Profile</h1>
				<h2 align="center">Name: <?php echo getColumnValue('tmis_main','t_name',$wc." AND tid='$tid'"); ?></h3>
				<?php
					$sch_num = getColumnValue('tmis_main','sch_num',$wc." AND tid='$tid'");
					$dist_code = substr($sch_num,0,2);
					$vdc_code = substr($sch_num, 2,3);
					
				?>
				<h2 align="center">School: <?php echo getColumnValue('mast_schoollist','nm_sch',$wc." AND sch_num='$sch_num'")," [$sch_num]<br /> ", getColumnValue('mast_vdc','vdc_name_e'," WHERE dist_code='$dist_code' AND vdc_code='$vdc_code'"),", ",ucwords(strtolower(getColumnValue('mast_district','dist_name'," WHERE dist_code='$dist_code'"))); ?></h3>
			</td>
			<td width="10%" align="center"><div style="width:100px; height: 100px; border: 1px solid black;"> <br /> <br /> <br /> <br />Photograph </div></td>
		</tr>
	</table>	
	<div class="clear"></div>
	
	<?php
	
	
}

function reportTmis($tid){
	
	global $link, $wc;
	
	$sch_num = getColumnValue('tmis_main','sch_num',$wc." AND tid='$tid'");
	
	?>
	
	<table width="100%" border="1">
	<tr class='theader cu'><td>General Information</td></tr>
	</table>
	
	<table width="33%" border="1" style="float:left; margin-right: 3px;">
		<?php 
			$sextype=array('','Male','Female','Others'); 
			$castetype=array('','Male','Female','Others'); 
			$yn = array('','Yes','No');
			$marital = array('', 'Married', 'Unmarried');
		
		?>
		
		<tr><td class='theader' width="50%">Sex</td><td><?php echo $sextype[getColumnValue('tmis_sec1','sex',$wc." AND tid='$tid'")]; ?></td></tr>
		<tr><td class='theader'>Caste/Ethnicity</td><td><?php echo $castetype[getColumnValue('tmis_sec1','t_caste',$wc." AND tid='$tid'")]; ?></td></tr>
		<tr><td class='theader' colspan="2">Date of Birth</td></tr>
		<tr><td class='theader'>As per Citizenship</td><td><?php echo getColumnValue('tmis_sec1','bs_dob_year1',$wc." AND tid='$tid'"),'/',getColumnValue('tmis_sec1','bs_dob_month1',$wc." AND tid='$tid'"),'/',getColumnValue('tmis_sec1','bs_dob_day1',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>As per Certificate</td><td><?php echo getColumnValue('tmis_sec1','bs_dob_year2',$wc." AND tid='$tid'"),'/',getColumnValue('tmis_sec1','bs_dob_month2',$wc." AND tid='$tid'"),'/',getColumnValue('tmis_sec1','bs_dob_day2',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Nationality</td><td><?php $nationality = getColumnValue('tmis_sec1','nationality',$wc." AND tid='$tid'"); if (substr($nationality,0,3)=="Nep") echo "Nepali"; else echo $nationality; ?></td></tr>
		<tr><td class='theader'>Permanent Address</td><td><?php echo getColumnValue('tmis_sec1','perm_addr_dist',$wc." AND tid='$tid'"),' - ',getColumnValue('tmis_sec1','perm_addr_vdc',$wc." AND tid='$tid'"),' - ',getColumnValue('tmis_sec1','perm_addr_ward',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Temporary Address</td><td><?php echo getColumnValue('tmis_sec1','temp_addr_dist',$wc." AND tid='$tid'"),' - ',getColumnValue('tmis_sec1','temp_addr_vdc',$wc." AND tid='$tid'"),' - ',getColumnValue('tmis_sec1','temp_addr_ward',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Telephone</td><td><?php echo getColumnValue('tmis_sec1','perm_addr_phone',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Email</td><td><?php echo getColumnValue('tmis_sec1','perm_addr_email',$wc." AND tid='$tid'"); ?></td></tr>
	</table>

	<table width="33%" border="1" style="float:left; margin-right: 3px;">	
		<tr><td class='theader' width="50%">Mother Tongue</td><td><?php echo getColumnValue('tmis_sec1','mother_tongue',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Teaching Language</td><td><?php $teaching_lang = getColumnValue('tmis_sec1','teaching_lang',$wc." AND tid='$tid'"); if ($teaching_lang!='0') echo $teaching_lang; ?></td></tr>
		<tr><td class='theader'>Family Size</td><td><?php echo getColumnValue('tmis_sec1','nof_total',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Father's Name</td><td><?php echo getColumnValue('tmis_sec1','name_father',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Mother's Name</td><td><?php echo getColumnValue('tmis_sec1','name_mother',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Marital Status</td><td><?php echo $marital[getColumnValue('tmis_sec1','marital_status',$wc." AND tid='$tid'")]; ?></td></tr>
		<tr><td class='theader'>Son(s)</td><td><?php echo getColumnValue('tmis_sec1','nof_son',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Daughter(s)</td><td><?php echo getColumnValue('tmis_sec1','nof_daughter',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Spouse's Name</td><td><?php echo getColumnValue('tmis_sec1','name_spouse',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Nominee's Name</td><td><?php echo getColumnValue('tmis_sec1','name_willper',$wc." AND tid='$tid'"); ?></td></tr>
	</table>
	
	<table width="33%" border="1" style="float:right">
		<tr><td class='theader' width="50%">Teacher License No.</td><td></td></tr>
		<tr><td class='theader'>Insurance No.</td><td><?php echo getColumnValue('tmis_sec1','insurance_no',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>Citizenship No.</td><td><?php echo getColumnValue('tmis_sec1','citizenship_no',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader'>TRK Office No.</td><td></td></tr>
		<tr><td class='theader'>Provident Fund No.</td><td><?php echo getColumnValue('tmis_sec1','pf_no',$wc." AND tid='$tid'"); ?></td></tr>
	
		<tr>
		<td class='theader'>Current School Level</td>
		<td>
		<?php 
			$school_type = "";
		
			if (getColumnValue('mast_school_type','class1',$wc." AND sch_num='$sch_num'")) $school_type = "Primary";
			if (getColumnValue('mast_school_type','class6',$wc." AND sch_num='$sch_num'")) $school_type = "Lower Secondary";
			if (getColumnValue('mast_school_type','class9',$wc." AND sch_num='$sch_num'")) $school_type = "Secondary";
			if (getColumnValue('mast_school_type','class11',$wc." AND sch_num='$sch_num'")) $school_type = "Higher Secondary";
			
			echo $school_type;
		?>
		</td>
		</tr>
		
		<tr><td class='theader'>Subject Appointed</td><td><?php echo getColumnValue('tmis_sec1','first_app_sec_subject',$wc." AND tid='$tid'"); ?></td></tr>
		<tr><td class='theader' colspan="2">Major Teaching Subjects</td></tr>
		<tr><td class='theader'>Subject 1</td><td><?php $sub1= getColumnValue('tmis_sec1','teachingSub1',$wc." AND tid='$tid'"); if ($sub1!='0') echo $sub1; ?></td></tr>
		<tr><td class='theader'>Subject 2</td><td><?php $sub2= getColumnValue('tmis_sec1','teachingSub2',$wc." AND tid='$tid'"); if ($sub2!='0') echo $sub2; ?></td></tr>
		
	</table>
	
	<div class="clear"></div>
	
	<!-- Appointment Information -->
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="7">Appointment Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Dates</td>
			<td>Level</td>
			<td>Rank</td>
			<td>Types</td>
			<td>Types in Detail</td>
			<td>School</td>
			<td>District</td>
		</tr>
		
		<?php
		
		$leveltype=array('','Primary','L.Sec.','Sec.','H.Sec.');
		$ranktype=array('','1st','2nd','3rd','4th');
		$positiontype=array('','Temporary','Permanent','Transfer','Promotion');
		$apptype = array('','Approved Post','Temporary','Permanent','Leon','Private');
		
		
		$result = mysql_query("SELECT * FROM tmis_sec1 $wc AND tid='$tid'");
		//$lines = 6;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$row['current_app_year']}/{$row['current_app_month']}/{$row['current_app_day']}</td>\n";
			//	echo "<td>{$row['']}</td>\n";
				echo "<td>{$leveltype[$row['curr_perm_level']]}</td>\n";
				echo "<td>{$ranktype[$row['curr_perm_rank']]}</td>\n";
				echo "<td>{$positiontype[$row['curr_perm_type']]}</td>\n";
				//echo "<td>{$apptype[$row['appoint_type']]}</td>\n";
				//echo "<td>{$row['app_school']}</td>\n";
				//echo "<td>{$row['app_district']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}		
		$result = mysql_query("SELECT * FROM tmis_sec2 $wc AND tid='$tid' and sn>1 ORDER BY app_year, app_month, app_day");
		$lines = 6;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$row['app_year']}/{$row['app_month']}/{$row['app_day']}</td>\n";
				echo "<td>{$leveltype[$row['appoint_level']]}</td>\n";
				echo "<td>{$ranktype[$row['appoint_rank']]}</td>\n";
				echo "<td>{$positiontype[$row['appoint_position']]}</td>\n";
				echo "<td>{$apptype[$row['appoint_type']]}</td>\n";
				echo "<td>{$row['app_school']}</td>\n";
				echo "<td>{$row['app_district']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		
		throwBlankRow($lines, 7);
		
		/*
		else{
			echo "<tr><td colspan='7'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>
	</table>
	
	<div class="clear"></div>
	
	<!-- Qualification information -->
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="7">Qualification Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Degree</td>
			<td>College/University</td>
			<td>Passed Division</td>
			<td>Passed Year</td>
			<td>Faculty</td>
			<td>Major Subjects</td>
			<td>Country</td>
		</tr>
	
	
		<?php
		
		$result = mysql_query("SELECT * FROM tmis_edu $wc AND tid='$tid'");
		$lines = 6;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				if ($row['qualif']=='Intermed') $row['qualif']="Intermediate";
				if ($row['qualif']=='Bacehlors') $row['qualif']="Bachelors";
				
				if ($row['board']=='Tu') $row['board']='Tribhuwan University';
				
				echo "<tr>\n";
				echo "<td>{$row['qualif']}</td>\n";
				echo "<td>{$row['board']}</td>\n";
				echo "<td>{$row['division']}</td>\n";
				echo "<td>{$row['year']}</td>\n";
				echo "<td>{$row['stream']}</td>\n";
				echo "<td>{$row['subj']}</td>\n";
				echo "<td>{$row['country']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		throwBlankRow($lines, 7);
		
		
		/*
		else{
			echo "<tr><td colspan='7'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>
	
	<div class="clear"></div>

	<!-- Training information -->
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="7">Training Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Type</td>
			<td>Subject</td>
			<td>Year</td>
			<td>Duration</td>
			<td>Division</td>
			<td>Teaching Institute</td>
			<td>Country</td>
		</tr>
	
	
		<?php
		
		$trainingtype = array('','Pri.','L.Sec and Sec.','Headmaster Mgmt.');
		$traininsttype = array('','NCED','Tribhuwan University','Others');
		
		$result = mysql_query("SELECT * FROM tmis_train $wc AND tid='$tid'");
		$lines = 6;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$trainingtype[$row['type']]}</td>\n";
				echo "<td>{$row['subj']}</td>\n";
				echo "<td>{$row['year']}</td>\n";
				echo "<td>{$row['duration']}</td>\n";
				echo "<td>{$row['division']}</td>\n";
				echo "<td>{$traininsttype[$row['org']]}</td>\n";
				echo "<td>{$row['country']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		
		throwBlankRow($lines,7);
		/*
		else{
			echo "<tr><td colspan='7'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>
	
	<div class="clear"></div>
	
	<!-- Reward information -->
	
	<table border="1" width="50%" style="float:left">
		<tr class="theader cu">
			<td colspan="4">Reward Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Level</td>
			<td>Reward</td>
			<td>Institution</td>
			<td>Date</td>
		</tr>
	
	
		<?php
		
		$awardranktype=array('','Pri-3rd','Pri-2nd','Pri-1st','L.Sec-3rd','L.Sec-2nd','L.Sec-1st','Sec-3rd','Sec-2nd','Sec-1st');
		
		$result = mysql_query("SELECT * FROM tmis_award $wc AND tid='$tid'");
		$lines = 3;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$awardranktype[$row['rank']]}</td>\n";
				echo "<td>{$row['type']}</td>\n";
				echo "<td>{$row['org']}</td>\n";
				echo "<td>{$row['year']}/{$row['month']}/{$row['day']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		throwBlankRow($lines, 4);
		/*
		else{
			echo "<tr><td colspan='4'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>

	<!-- Leave information -->
	
	<table border="1" width="49%" style="float:right;">
		<tr class="theader cu">
			<td colspan="3">Leave Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Type</td>
			<td>Date</td>
			<td>Duration</td>
		</tr>
	
	
		<?php
		
		$result = mysql_query("SELECT * FROM tmis_leave $wc AND tid='$tid'");
		$lines = 3;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$row['type']}</td>\n";
				echo "<td>{$row['year_from']}/{$row['month_from']}/{$row['day_from']} - {$row['year_to']}/{$row['month_to']}/{$row['day_to']}</td>\n";
				echo "<td>{$row['dur_year']}/{$row['dur_month']}/{$row['dur_day']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		throwBlankRow($lines, 3);
		/*
		else{
			echo "<tr><td colspan='3'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>	
	
	<div class="clear"></div>
	
	<!-- Medical Allowances information -->
	
	<table border="1" width="50%" style="float:left">
		<tr class="theader cu">
			<td colspan="4">Medical Allowances Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Date</td>
			<td>Amount</td>
			<td>Institution</td>
			<td>Date</td>
		</tr>
	
	
		<?php
		
		$result = mysql_query("SELECT * FROM tmis_med $wc AND tid='$tid'");
		$lines = 3;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$row['year']}/{$row['month']}/{$row['day']}</td>\n";
				echo "<td>{$row['amt']}</td>\n";
				echo "<td>{$row['org']}</td>\n";
				echo "<td>{$row['year_dec']}/{$row['month_dec']}/{$row['day_dec']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		throwBlankRow($lines, 4);
		/*
		else{
			echo "<tr><td colspan='4'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>

	<!-- Research and Publication information -->
	
	<table border="1" width="49%" style="float:right;">
		<tr class="theader cu">
			<td colspan="3">Research and Publication Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Name of Publication</td>
			<td>Year</td>
			<td>Language</td>
		</tr>
	
	
		<?php
		
		$result = mysql_query("SELECT * FROM tmis_pub $wc AND tid='$tid'");
		$lines = 3;
		if (mysql_num_rows($result)>0){
			while ($row=mysql_fetch_assoc($result)){
				zeroToBlank($row);
				echo "<tr>\n";
				echo "<td>{$row['name']}</td>\n";
				echo "<td>{$row['year']}/{$row['month']}/{$row['day']}</td>\n";
				echo "<td>{$row['lang']}</td>\n";
				echo "</tr>\n";
				$lines--;
			}
		}
		throwBlankRow($lines, 3);
		/*
		else{
			echo "<tr><td colspan='3'><div style='height: 120px;'><br /><br /><br />No data found</div></td></tr>\n";
		}
		*/
		
		
		?>	
	
	</table>	
	
	<div class="clear"></div>

	<br />
	<br />
	<br />
	<table border="0" width="80%">
	<tr>
	<td width="50%" align="left"><strong>Checked by:</strong></td>
	<td width="50%" align="right"><strong>Approved by:</strong></td>
	</tr>
	</table>
	<br />
	<br />
	
	<div class="clear">This report has been generated based on teachers' data as of year <?php global $sch_year; echo $sch_year; ?></div>		
	
	<?php
	
}

function getDistrictVdcName($d, $v){
	global $link;
	
	$result = mysql_query("SELECT * FROM mast_district WHERE dist_code='$d'");
	$row = mysql_fetch_assoc($result);
	$districtName = $row['dist_name'];
	
	if ($v!=''){
		$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$d' AND vdc_code='$v'");
		$row = @mysql_fetch_assoc($result);
		$vdcName = $row['vdc_name_e'];
	}
	
	return $districtName.($v!=''?", $vdcName":"");
}


function getColumnValue($table, $column, $where){
	global $link;
	
	$result = mysql_query("SELECT $column FROM $table $where");
	//echo "SELECT $column FROM $table $where";
	$row = @mysql_fetch_assoc($result);
	
	return $row[$column];
	
}

function zeroToBlank(&$row){
	foreach($row as $k=>$v){
		if ($v=='0') $row[$k]='';
	}
}

function throwBlankRow($lines, $colspan){
	if ($lines<=0) return;
	$height = $lines * 17;
	echo "<tr><td colspan='$colspan'><div style='height: {$height}px;'>&nbsp;</div></td></tr>\n";
}
?>
