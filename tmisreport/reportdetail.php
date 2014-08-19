<?php

require_once("../includes/vars.php");
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$expandteacher = TRUE;
$sch_num=$_GET['s'];
$sch_year=$_GET['y'];

if (strlen($sch_num)>=2) $dist_code=substr($sch_num, 0,2);
if (strlen($sch_num)>=5) $vdc_code=substr($sch_num, 2,3);
//if ($sch_num!=9) $sch_num='';

$wc = " WHERE sch_year='{$sch_year}' ";

?>

<html>
<head>
<title>TMIS Report Card (Teacher Detail)</title>
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

<h2 align='center'>TMIS Report (Teacher Detail)</h2>
<table border='1' width='100%'>
	<tr class='theader'>
		<td>Code</td>
		<td>Name</td>
		<td>DOB</td>
		<td>Retirement Age</td>
		<td>Permanent</td> <!-- tmis_sec1, appoint_type -->
		<td>Temporary</td>
		<td>Level</td>
		<td>Appointment <br />Date</td>
		<td>Salary <br />Scale</td>
		<td>Grade</td>
		<td>Total</td>
		<td>MA</td>
		<td>TA</td>
		<td>RA</td>
		<td>Monthly <br />Salary</td>
		<td>Yearly <br />Salary</td>
		<td>Festival </td>
		<td>Total</td>
	</tr>


<?php 

$distarr = array();
$result = mysql_query("SELECT * FROM mast_district WHERE dist_code LIKE '$dist_code%'");
while ($row = mysql_fetch_assoc($result)){
	$distarr[$row['dist_code']] = $row['dist_name'];
}

// expand districts
foreach ($distarr as $dist_code=>$dist_name){
	
	if (strlen($sch_num)!=9) throwRow($dist_code, $dist_name);

	$vdcarr = array();
	$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$dist_code' AND vdc_code LIKE '{$vdc_code}%'");
	while ($row = mysql_fetch_assoc($result)){
		$vdcarr[$row['vdc_code']]=$row['vdc_name_e'];
	}
	
	// expand vdcs
	foreach ($vdcarr as $vdc_code=>$vdc_name){
		
		if (strlen($sch_num)!=9 && $sch_num!='') throwRow($dist_code.$vdc_code, $vdc_name);
		
		$scharr = array();
		if (strlen($sch_num)==9)
			$result = mysql_query("SELECT DISTINCT sch_num, nm_sch FROM mast_schoollist WHERE sch_num='$sch_num'");
		else		
			$result = mysql_query("SELECT DISTINCT sch_num, nm_sch FROM mast_schoollist WHERE dist_code='$dist_code' AND vdc_code='$vdc_code' AND sch_num LIKE '$sch_num%'");
			
		while ($row = mysql_fetch_assoc($result)){
			$scharr[$row['sch_num']]=$row['nm_sch'];
		}
		
		// expand schools
		foreach ($scharr as $sch_num_=>$nm_sch){
			
			if (strlen($sch_num)>2) throwRow($sch_num_, $nm_sch);
			
			$tidarr = array();
			$result = mysql_query("SELECT * FROM tmis_main WHERE sch_num='$sch_num_'");
			while ($row = mysql_fetch_assoc($result)){
				$tidarr[$row['tid']]=$row['t_name'];
			}
			
			// expand teachers
			foreach ($tidarr as $tid=>$t_name){
				
				if ($expandteacher) throwRow($tid, $t_name);
			
			
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
	
	global $currentyear;
	
	$result = mysql_query("SELECT COUNT(tid) AS c FROM tmis_main WHERE tid LIKE '$code%'");
	$row = mysql_fetch_assoc($result);
	
	if ($row['c']==0) return;
	
	$color = '#FFF';
	if (strlen($code)==2) $color='#BAC0C9';
	if (strlen($code)==5) $color='#D0D4DA';
	if (strlen($code)==9) $color='#EEE';
	
	
	echo "<tr style='background-color:$color;'>";
	echo "<td style='text-align: left;'>$code</td>";
	echo "<td style='text-align: left;'>$name</td>";
	
	$dob_y = getValue('tmis_sec1','bs_dob_year1');
	$dob_m = getValue('tmis_sec1','bs_dob_month1');
	$dob_d = getValue('tmis_sec1','bs_dob_day1');
	
	if ($dob_y!='') $dob="$dob_y/$dob_m/$dob_d";
	echo "<td>$dob</td>";
	
	echo "<td>",getCountOrTick('tmis_sec1','',"</td>";
	
	
	echo "</tr>";
	
}

function getCountValue($table, $column, $code, $condition, $type){
	if ($type=='count') $query = "SELECT COUNT(tid) as c FROM $table WHERE tid LIKE '$code%'";
	else $query = "SELECT $column as c FROM $table WHERE tid LIKE '$code%'";
	
	if ($condition!='') $query .= " AND $condition";
	$result = mysql_query($query);
	
	echo "<td>";
	if ($row = mysql_fetch_assoc($result)){
		if ($type=='count') echo $row['c'];
		else{
			//if ($column=='tid') echo "✓"; else echo $row['c'];
			echo "✓"; 
		}
	}
	echo "</td>";
	
}

?>
