<?php

require_once("../includes/vars.php");
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$dist_code=$_GET['d'];
$vdc_code=$_GET['v'];
$sch_num=$_GET['s'];
$sch_year=$_GET['y'];
$sch_type=$_GET['st'];

$tag_num = $_GET['tn'];

if (strlen($sch_num)==9) {
	$dist_code = substr($sch_num, 0,2);
	$vdc_code = substr($sch_num, 2,3);
}

// school type condition
$sch_type_condition='';

switch($sch_type){
	case "1":
	case "2":
	case "3":
	case "4":
	case "5":
	case "6":
	case "7":
	case "8":
	case "9":
	case "10":
	case "11":
	case "12":
		$sch_type_condition = "	(ecd=0 OR ecd=$sch_type) AND 
								(class1=0 OR class1=$sch_type) AND 
								(class6=0 OR class6=$sch_type) AND 
								(class9=0 OR class9=$sch_type) AND 
								(class11=0 OR class11=$sch_type)";
		break;
	case "1-4":
	case "5-7":
	case "8-10":
		
		$t1 = substr($sch_type,0,1);
		$t2 = substr($sch_type,2);
		
		$sch_type_condition = "	(ecd=0 OR (ecd>=$t1 AND ecd<=$t2)) AND 
								(class1=0 OR (class1>=$t1 AND class1<=$t2)) AND 
								(class6=0 OR (class6>=$t1 AND class6<=$t2)) AND 
								(class9=0 OR (class9>=$t1 AND class9<=$t2)) AND 
								(class11=0 OR (class11>=$t1 AND class11<=$t2))";
		break;
		
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php 
if (strlen($sch_num)==9) echo "School"; 
else if ($tag_num!='') echo getValue("tags", "tag_category", "WHERE tag_id='$tag_num'");
else echo ($vdc_code==''?'District':'VDC'); 
?> 
 Profile</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
body{ font-family: Verdana; font-size: x-small;}
table{ border-collapse: collapse; }
td{ padding: 2px 5px; font-size: x-small; text-align: center;}
.theader{ font-weight: bold; background-color: #eee; text-align:left;}
.cu{ text-transform: uppercase; text-align: center; background: #ddd; }
.clear{clear:both;height:10px;}
br.page { page-break-after: always }

</style>
</head>
<body>



<?php

$districts = array();
$vdcs = array();
$schools = array();
if ($dist_code==-1){
	$result = mysql_query("SELECT * FROM mast_district");
	while ($row = mysql_fetch_assoc($result)) $districts[] = $row['dist_code'];
}
else $districts[] = $dist_code;


if ($vdc_code==-1){
	$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$dist_code'");
	while ($row = mysql_fetch_assoc($result)) $vdcs[] = $row['vdc_code'];
}
else $vdcs[] = $vdc_code;


if ($sch_num==-1){
        $result=mysql_query("SELECT DISTINCT(mast_schoollist.sch_num) as sch_num FROM mast_schoollist JOIN mast_school_type ON 
                mast_schoollist.sch_year=mast_school_type.sch_year AND mast_schoollist.sch_num=mast_school_type.sch_num 
                WHERE  mast_school_type.ecd > 0 AND mast_schoollist.dist_code='$dist_code' AND mast_schoollist.vdc_code='$vdc_code' AND mast_schoollist.sch_year='$sch_year';");
        while ($row = mysql_fetch_assoc($result)) $schools[] = $row['sch_num'];
}
else $schools[] = $sch_num;

/*
print_r($districts);
print_r($vdcs);
print_r($schools);
*/


if ($tag_num==''){
	foreach($districts as $dist_code){
		foreach($vdcs as $vdc_code){
			foreach($schools as $sch_num){
			
				$wc = " WHERE sch_num LIKE '{$dist_code}{$vdc_code}%' AND sch_year='{$sch_year}' ";
				if (strlen($sch_num)==9) {
					$wc = " WHERE sch_num='{$sch_num}' AND sch_year='{$sch_year}' ";
				}	
			
				reportSwitch();
				
			}
		}
	}
}
else{
	// tag wise report 
	
	$wc = " WHERE sch_year='{$sch_year}' ";
	
	$result=mysql_query("SELECT * FROM tags where tag_id='$tag_num'");
	
	$r=mysql_fetch_array($result);
	
	$tagcodes = explode(' ', $r['codes']);
	
	$cond = array();
	foreach ($tagcodes as $t){
		$cond[] = "sch_num LIKE '$t'";
	}
	
	if (count($cond)>0) $wc = $wc." AND (". implode(" OR ", $cond). ")";
	
	reportSwitch();
	
}

//display note in case of vdc or district report
if(empty($sch_num) OR empty($vdc_code))
    echo "<b>Note:</b> The total number of ECD/PPC listed in the page might not tally 
        with the total figures given above, because one school might have more than one ECD/PPCs.";

?>
</body>
</html>
<?php

function reportSwitch(){

	switch($_GET['r']){
		case 1:
			reportHeader("Achievements");
			schoolInfoBlock();
			reportAchievements();
			
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 2:
			reportHeader("Schools");
			schoolInfoBlock();
			reportSchools();
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 3:
			reportHeader("School, Disability, MC");
			schoolInfoBlock();
			reportDisability();
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 4:
			reportHeader("Agewise");
			schoolInfoBlock();
			reportAge();
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 5:
			reportHeader("Teachers");
			schoolInfoBlock();
			reportTeacher();
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 6:
			reportHeader("Achievements by percentage");
			schoolInfoBlock();
			reportAchievementsPercentage();
			echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 7:
			reportEcd();
			//echo "<p align='center'>If Number of ECD/PPC is more than 1, the rest of the centers are community based.<br />This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		case 8:
			reportHeader("SOP/FSP Report");
			schoolInfoBlock();
			reportSop();
			echo "<p align='center'>This data has been generated from reported schools in Flash I/II school census.</p>";
			break;
		
		default:
			die('Report Not selected.');
			
	}


}

function formatDisplay($value){
    return ($value>0?(int)$value:'');
}
function getColumndata($table,$whereClause,$column)
{
    $columnData=array();
    $result=  mysql_query("SELECT $column FROM $table $whereClause");
    //return multiple columns if there is a comma in the $column variable or single column data
    if(strpos($column,","))
        while ($row = mysql_fetch_assoc($result)) $columnData[] = $row;
    else
        while ($row = mysql_fetch_assoc($result)) $columnData[] = $row[$column];
    return $columnData;
}

function getCount($table, $whereClause){
	global $link, $sch_type_condition;
	
	switch ($table){
		case "mast_district":
		case "mast_vdc":
			$query = "SELECT count(*) as count FROM $table $whereClause";
			break;
			
		case "mast_schoollist":
			$query = "SELECT COUNT(*) as count FROM $table JOIN mast_school_type using (sch_num, sch_year) $whereClause";
			break;
		case "mast_school_type";
			$query = "SELECT COUNT(*) as count FROM $table JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
		default:
			$query = "SELECT COUNT(*) as count FROM $table JOIN mast_school_type using (sch_num, sch_year) JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
	}
	
	/*
	if ($table=='mast_district' || $table=='mast_vdc' || $table=='mast_school_type') $query = "SELECT count(*) as count FROM $table $whereClause";
	else {
		$query = "SELECT COUNT(*) as count FROM $table JOIN mast_school_type using (sch_num, sch_year) JOIN mast_schoollist using (sch_num, sch_year) $whereClause";
		if (substr($table,-2)=='f1') $query.=" AND flash1=1";
		else $query.=" AND flash2=1";
	}
	*/

	$query = str_replace("sch_num=","mast_school_type.sch_num=", $query);
	$query = str_replace("sch_year=","mast_school_type.sch_year=", $query);	
	
	if ($sch_type_condition!='' && substr($table,0,4)!='mast') $query .= " AND $sch_type_condition";
	if ($table=='mast_school_type' && $sch_type_condition!='') $query .= " AND $sch_type_condition";
	
	//echo $query;
	$result = mysql_query($query);
	$row = @mysql_fetch_assoc($result);
	//if (mysql_error()) echo $query;
	return ($row['count']>0?(int)$row['count']:'');
	
}

function getSum($table, $field, $whereClause){
	global $link, $sch_type_condition;
	
	switch ($table){
		case "mast_district":
		case "mast_vdc":
			$query = "SELECT sum($field) as sum FROM $table $whereClause";
			break;
			
		case "mast_schoollist":
			$query = "SELECT sum($field) as sum FROM $table JOIN mast_school_type using (sch_num, sch_year) $whereClause";
			break;
		case "mast_school_type";
			$query = "SELECT sum($field) as sum FROM $table JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
		default:
			$query = "SELECT sum($field) as sum FROM $table JOIN mast_school_type using (sch_num, sch_year) JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
	}

	$query = str_replace("sch_num=","mast_school_type.sch_num=", $query);
	$query = str_replace("sch_year=","mast_school_type.sch_year=", $query);	
	
	if ($sch_type_condition!='') $query .= " AND $sch_type_condition";
	if ($table=='mast_school_type' && $sch_type_condition!='') $query .= " AND $sch_type_condition";

	$result = mysql_query($query);
	$row = @mysql_fetch_assoc($result);
	//if (mysql_error()) echo $query;	
	return ($row['sum']>0?(int)$row['sum']:'');
	
}

function getValue($table, $field, $whereClause,$showquery=false){
	global $link, $sch_type_condition;
	
	switch ($table){
		case "mast_district":
		case "mast_vdc":
			$query = "SELECT $field as f FROM $table $whereClause";
			break;
			
		case "mast_schoollist":
			$query = "SELECT $field as f FROM $table JOIN mast_school_type using (sch_num, sch_year) $whereClause";
			break;
		case "mast_school_type";
			$query = "SELECT $field as f FROM $table JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
		default:
			$query = "SELECT $field as f FROM $table JOIN mast_school_type using (sch_num, sch_year) JOIN mast_schoollist using (sch_num, sch_year) $whereClause";		
			break;
	}
	
	if ($sch_type_condition!='') $query .= " AND $sch_type_condition";
	if ($table=='mast_school_type' && $sch_type_condition!='') $query .= " AND $sch_type_condition";
	
	$result = mysql_query($query);
	$row = @mysql_fetch_assoc($result);
	//if (mysql_error()) echo $query;	
	if ($showquery) echo $query;
	return $row['f'];

}


function schoolInfoBlock(){
	global $link, $wc, $dist_code, $vdc_code, $sch_num, $sch_year, $tag_num, $sch_type_condition, $currentyear;
	
	//echo "$dist_code, $vdc_code, $sch_num, $sch_year";
	
	//
	// Districts info
	//
	$distinfo['01']=array('Mountain','Eastern','Mechi');
	$distinfo['02']=array('Hill','Eastern','Mechi');
	$distinfo['03']=array('Hill','Eastern','Mechi');
	$distinfo['04']=array('Terai','Eastern','Mechi');
	$distinfo['05']=array('Terai','Eastern','Koshi');
	$distinfo['06']=array('Terai','Eastern','Koshi');
	$distinfo['07']=array('Hill','Eastern','Koshi');
	$distinfo['08']=array('Hill','Eastern','Koshi');
	$distinfo['09']=array('Mountain','Eastern','Koshi');
	$distinfo['10']=array('Hill','Eastern','Koshi');
	$distinfo['11']=array('Mountain','Eastern','Sagarmatha');
	$distinfo['12']=array('Hill','Eastern','Sagarmatha');
	$distinfo['13']=array('Hill','Eastern','Sagarmatha');
	$distinfo['14']=array('Hill','Eastern','Sagarmatha');
	$distinfo['15']=array('Terai','Eastern','Sagarmatha');
	$distinfo['16']=array('Terai','Eastern','Sagarmatha');
	$distinfo['17']=array('Terai','Central','Janakpur');
	$distinfo['18']=array('Terai','Central','Janakpur');
	$distinfo['19']=array('Terai','Central','Janakpur');
	$distinfo['20']=array('Hill','Central','Janakpur');
	$distinfo['21']=array('Hill','Central','Janakpur');
	$distinfo['22']=array('Mountain','Central','Janakpur');
	$distinfo['23']=array('Mountain','Central','Bagmati');
	$distinfo['24']=array('Hill','Central','Bagmati');
	$distinfo['25']=array('Hill','Central','Bagmati');
	$distinfo['26']=array('Hill','Central','Bagmati');
	$distinfo['27']=array('Hill','Central','Bagmati');
	$distinfo['28']=array('Hill','Central','Bagmati');
	$distinfo['29']=array('Mountain','Central','Bagmati');
	$distinfo['30']=array('Hill','Central','Bagmati');
	$distinfo['31']=array('Hill','Central','Narayani');
	$distinfo['32']=array('Terai','Central','Narayani');
	$distinfo['33']=array('Terai','Central','Narayani');
	$distinfo['34']=array('Terai','Central','Narayani');
	$distinfo['35']=array('Terai','Central','Narayani');
	$distinfo['36']=array('Hill','Western','Gandaki');
	$distinfo['37']=array('Hill','Western','Gandaki');
	$distinfo['38']=array('Hill','Western','Gandaki');
	$distinfo['39']=array('Hill','Western','Gandaki');
	$distinfo['40']=array('Hill','Western','Gandaki');
	$distinfo['41']=array('Mountain','Western','Gandaki');
	$distinfo['42']=array('Mountain','Western','Dhawalagiri');
	$distinfo['43']=array('Hill','Western','Dhawalagiri');
	$distinfo['44']=array('Hill','Western','Dhawalagiri');
	$distinfo['45']=array('Hill','Western','Dhawalagiri');
	$distinfo['46']=array('Hill','Western','Lumbini');
	$distinfo['47']=array('Hill','Western','Lumbini');
	$distinfo['48']=array('Terai','Western','Lumbini');
	$distinfo['49']=array('Terai','Western','Lumbini');
	$distinfo['50']=array('Terai','Western','Lumbini');
	$distinfo['51']=array('Hill','Western','Lumbini');
	$distinfo['52']=array('Hill','Mid-western','Rapti');
	$distinfo['53']=array('Hill','Mid-western','Rapti');
	$distinfo['54']=array('Hill','Mid-western','Rapti');
	$distinfo['55']=array('Hill','Mid-western','Rapti');
	$distinfo['56']=array('Terai','Mid-western','Rapti');
	$distinfo['57']=array('Terai','Mid-western','Bheri');
	$distinfo['58']=array('Terai','Mid-western','Bheri');
	$distinfo['59']=array('Hill','Mid-western','Bheri');
	$distinfo['60']=array('Hill','Mid-western','Bheri');
	$distinfo['61']=array('Hill','Mid-western','Bheri');
	$distinfo['62']=array('Mountain','Mid-western','Karnali');
	$distinfo['63']=array('Mountain','Mid-western','Karnali');
	$distinfo['64']=array('Mountain','Mid-western','Karnali');
	$distinfo['65']=array('Mountain','Mid-western','Karnali');
	$distinfo['66']=array('Mountain','Mid-western','Karnali');
	$distinfo['67']=array('Mountain','Far-western','Seti');
	$distinfo['68']=array('Mountain','Far-western','Seti');
	$distinfo['69']=array('Hill','Far-western','Seti');
	$distinfo['70']=array('Hill','Far-western','Seti');
	$distinfo['71']=array('Terai','Far-western','Seti');
	$distinfo['72']=array('Terai','Far-western','Mahakali');
	$distinfo['73']=array('Hill','Far-western','Mahakali');
	$distinfo['74']=array('Hill','Far-western','Mahakali');
	$distinfo['75']=array('Mountain','Far-western','Mahakali');

	
	if (strlen($sch_num)==9){
		// school information
		$generalInformation['Development Region']=$distinfo[$dist_code][1];
		$generalInformation['Eco-belt']=$distinfo[$dist_code][0];
		$generalInformation['Zone']=$distinfo[$dist_code][2];
		$generalInformation['District']=ucwords(strtolower(getValue("mast_district","dist_name","WHERE dist_code='$dist_code'")));
		$generalInformation['Vdc/NP']=getValue("mast_vdc","vdc_name_e","WHERE dist_code='$dist_code' AND vdc_code='$vdc_code'");
		$generalInformation['Address']=getValue("mast_schoollist","location","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		$generalInformation['Ward No.']=getValue("mast_schoollist","wardno","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		$generalInformation['Phone']=getValue("mast_schoollist","telno","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		$generalInformation['Email']=getValue("mast_schoollist","email","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		$generalInformation['School Established Year']=getValue("ecdppc_info","estd_year","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		$generalInformation['Account Number']=getValue("mast_schoollist","account_no","WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		
		
	}
	else if ($tag_num!=''){
		// Compute General Information
		$generalInformation['Development Region']='';
		$generalInformation['Eco-belt']='';
		$generalInformation['Zone']='';
		$generalInformation['Vdc/NP ']='';
		$generalInformation['Resource Centers']='';
		$generalInformation['Literacy Rate']='';
		$generalInformation['Adult Literacy Rate']='';
		$generalInformation['Population Growth Rate']='';
		$generalInformation["Exp. Population ($currentyear)"]='';
		$generalInformation['Male %']='';
		$generalInformation['Female %']='';
		$generalInformation['Population of 3-4 yrs']='';
	
	}
	else{
	
		// Compute General Information
		$generalInformation['Development Region']=$distinfo[$dist_code][1];
		$generalInformation['Eco-belt']=$distinfo[$dist_code][0];
		$generalInformation['Zone']=$distinfo[$dist_code][2];
		$generalInformation['Vdc/NP ']=getCount("mast_vdc","WHERE dist_code='$dist_code'");
		$generalInformation['Resource Centers']='';
		$generalInformation['Literacy Rate']='';
		$generalInformation['Adult Literacy Rate']='';
		$generalInformation['Population Growth Rate']='';
		$generalInformation["Exp. Population ($currentyear)"]='';
		$generalInformation['Male %']='';
		$generalInformation['Female %']='';
		$generalInformation['Population of 3-4 yrs']='';
	}
	
	?>
	<table width="49%" border="1" style="float:left;">
		<tr class="theader cu">
			<td colspan="2">General Information(School)</td>
		</tr>
		
		<?php
			foreach($generalInformation as $k=>$v):
		?>
		<tr>
			<td class="theader" width="50%"><?php echo $k;?>&nbsp;</td>
			<td <?php if ($tag_num!='') echo 'class="theader"'; ?>><?php echo $v;?>&nbsp;</td>
		</tr>
		
		<?php
			endforeach;
		?>
	
	</table>
	
	<?php
	
	$schoolTypeInfo=array();
	$schoolTypeInfo['=1']='Govt. Aided';
	$schoolTypeInfo['=2']='C. Managed';
	$schoolTypeInfo['=3']='Rahat Teachers';
	$schoolTypeInfo['=4']='Unaided';
	$schoolTypeInfo['=5']='Institutional';
	$schoolTypeInfo['=8']='Madrassa';
	$schoolTypeInfo['=9']='Gumba';
	$schoolTypeInfo['=10']='Ashram';
	$schoolTypeInfo['=11']='Sop/Fsp';
	$schoolTypeInfo['=12']='Community based ECD';
	if (strlen($sch_num)!=9) $schoolTypeInfo['>0']='Total';
	?>
	
	<table width="50%" border="1" style="float:right;">
		<tr class="theader cu">
			<td colspan="<?php echo strlen($sch_num)==9?'6':'7'; ?>">School Type Information</td>
		</tr>
		<tr class="theader" align="center">
			<td align="left">Type</td>
			<td>ECD</td>
			<td>Pri</td>
			<td>L.Sec.</td>
			<td>Sec.</td>
			<td>H.Sec.</td>
			<?php 
				// if (strlen($sch_num)!=9) echo "<td>Total (unit)</td>\n"; 
			?>
		</tr>
		
		<?php
			foreach($schoolTypeInfo as $k=>$v):
				if ($k=='=5'){
					$ecd = getCount("mast_school_type",$wc."AND ecd>=5 AND ecd<=7 AND flash1=1");	
					$pri = getCount("mast_school_type",$wc."AND class1>=5 AND class1<=7 AND flash1=1");	
					$lsec = getCount("mast_school_type",$wc."AND class6>=5 AND class6<=7 AND flash1=1");	
					$sec = getCount("mast_school_type",$wc."AND class9>=5 AND class9<=7 AND flash1=1");	
					$hsec = getCount("mast_school_type",$wc."AND class11>=5 AND class11<=7 AND flash1=1");	
					$total = getCount("mast_school_type",$wc."AND ((class1>=5 AND class1<=7) OR (class6>=5 AND class6<=7) OR (class9>=5 AND class9<=7) OR (class11>=5 AND class11<=7)) AND flash1=1");
					
				}
				else{
					$ecd = getCount("mast_school_type",$wc."AND ecd$k AND flash1=1");	
					$pri = getCount("mast_school_type",$wc."AND class1$k AND flash1=1");	
					$lsec = getCount("mast_school_type",$wc."AND class6$k AND flash1=1");	
					$sec = getCount("mast_school_type",$wc."AND class9$k AND flash1=1");	
					$hsec = getCount("mast_school_type",$wc."AND class11$k AND flash1=1");	
					$total = getCount("mast_school_type",$wc."AND (class1$k OR class6$k OR class9$k OR class11$k) AND flash1=1");
				}
			
				
		?>
		<tr align="center">
			<td class="theader" align="left"><?php echo $v;?>&nbsp;</td>
			<td><?php if (strlen($sch_num)==9) echo ($ecd>0?'✔':''); else echo $ecd; ?>&nbsp;</td>
			<td><?php if (strlen($sch_num)==9) echo ($pri>0?'✔':''); else echo $pri; ?>&nbsp;</td>
			<td><?php if (strlen($sch_num)==9) echo ($lsec>0?'✔':''); else echo $lsec; ?>&nbsp;</td>
			<td><?php if (strlen($sch_num)==9) echo ($sec>0?'✔':''); else echo $sec; ?>&nbsp;</td>
			<td><?php if (strlen($sch_num)==9) echo ($hsec>0?'✔':''); else echo $hsec; ?>&nbsp;</td>
			<?php //if (strlen($sch_num)!=9): ?>
			<?php if (false): ?>
			<td><?php if (strlen($sch_num)==9) echo ($total>0?'✔':''); else echo $total; ?>&nbsp;</td>
			<?php endif; ?>
		</tr>
		
		<?php
			endforeach;
		?>	
	</table>	
		
	<div class="clear"></div>
	
	
	<?php
}


function reportHeader($title){
	
	global $dist_code, $vdc_code, $sch_year, $sch_num, $tag_num, $sch_type;
	
	?>
	
	<table>
		<tr>
			<td width="10%" align="left"><img src="nepalflag.png" width="100px"></td>
			<td width="80%" align="center">
				<h1>
				
					<?php 
						if ($_GET['r']==7) echo "ECD/PPC ";
						if ($_GET['r']==8) echo "SOP/FSP ";
					?>
					
					Profile - <?php echo $sch_year; ?></h1>
				<h2>
				<?php 
				if (strlen($sch_num)==9) {
					echo getValue("mast_schoollist","nm_sch","WHERE sch_num='$sch_num' AND sch_year='$sch_year'"); 
					echo " - ". $sch_num;
					
				}
				else if ($tag_num!='') echo getValue("tags", "tag_name", "WHERE tag_id='$tag_num'");
				else echo getDistrictVdcName($dist_code, $vdc_code); ?></h2>
				<h2
				<?php
					//if (
				?>
				</h2>
				<?php
					$st['1-4'] = "Government Schools";
					$st['1'] = "Government Aided";
					$st['2'] = "Community Managed";
					$st['3'] = "Rahat Teachers";
					$st['4'] = "Unaided";
					$st['5-7'] = "Institutional Schools";
					$st['5'] = "Institutional (Private)";
					$st['6'] = "Institutional (Public)";
					$st['7'] = "Institutional (Company)";
					$st['8-10'] = "Religious Schools";
					$st['8'] = "Madrassa";
					$st['9'] = "Gumba";
					$st['10'] = "Aashram";
					$st['11'] = "SOP/FSP";
					
					if ($sch_type!='') echo "<h3>School Type: ",$st[$sch_type],"</h3>";
				?>

				
			</td>
			<td width="10%" align="right"><img src="nepalgovt.png" width="120px"></td>
		</tr>
	</table>	
	<div class="clear"></div>
	
	<?php
	
	
}

function getDistrictVdcName($d, $v){
	global $link;
	
	$result = mysql_query("SELECT * FROM mast_district WHERE dist_code='$d'");
	$row = mysql_fetch_assoc($result);
	$districtName = $row['dist_name'];
	
	if ($v!=''){
		$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$d' AND vdc_code='$v'");
		$row = mysql_fetch_assoc($result);
		$vdcName = $row['vdc_name_e'];
	}
	
	return ucwords(strtolower($districtName)).($v!=''?", $vdcName":"");
}

function reportAchievements(){
	global $link, $wc, $dist_code, $vdc_code;

	// calculate data
	
	$data = array();
	
	// enrollment: total, dalit & janjati
	$pk='enroll';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0) $tableName = "ecdppc_enroll_f1";
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				if ($c>=11) $tableName = "hsec_current_details_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				if ($c>=11 && $pk=='enroll') {
					$fieldName = "{$ek}_{$gk}";
					if ($ek=='total') $fieldName = "tot_{$gk}";
				}	
				
				if ($tableName!='' && $fieldName!='') {
					$data['enroll'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
				}
			}
		}
		
	}
	
	// enrollment: disabled
	foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
		for ($c=0;$c<=12;$c++){
			if ($c==0) $tableName="ecd_disabled_f1";
			if ($c>=1 && $c<=5) $tableName="pr_disabled_f1";
			if ($c>=6 && $c<=8) $tableName="lsec_disabled_f1";
			if ($c>=9 && $c<=10) $tableName="sec_disabled_f1";
			if ($c>=11 && $c<=12) $tableName="hsec_disabled_f1";
			
			$data[$pk]['disabled'][$gk][$c]=getSum($tableName,"disabled_$gk",$wc." AND class='$c'");
			
			
		}
	}
	
	
	
	
	// exam appeared: total, dalit & janjati
	$pk='app';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				
				if ($c==0) continue;
				
				if ($c>=1 && $c<=5) $tableName = "last_class1_5_enroll_f1";
				if ($c>=6 && $c<=8) $tableName = "last_class6_8_enroll_f1";
				if ($c>=9 && $c<=10) $tableName = "last_class9_10_enroll_f1";
				if ($c>=11) $tableName = "hsec_last_exam_details_f1";
				
				if ($c<=10) $fieldName = "tot_appeared_exam_{$ek}_{$gk}";
				if ($c>=11) {
					if ($ek=='total') $fieldName = "tot_app_{$gk}";
					else $fieldName = "{$ek}_app_{$gk}";
				}
	
				
				if ($tableName!='' && $fieldName!='') {
					$data['app'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
				}
				$tableName = ''; $fieldName = '';
			}
		}
		
	}
	
	
	
	
	// promoted
	$pk='passed_exam';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c<=1 || $c>10) continue;
				
				//$data['prom'][$ek][$gk][$c] = $data['enroll'][$ek][$gk][$c+1] - $data['rep'][$ek][$gk][$c+1];
				
				if ($c>1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				
				$fieldName = "tot_prom_{$ek}_{$gk}";
				$data['prom'][$ek][$gk][$c-1] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));	
				
				if ($c==10) $data['prom'][$ek][$gk][$c] = getSum('last_class9_10_enroll_f1',"tot_passed_exam_{$ek}_{$gk}",$wc." AND class='$c'");
				
				/*
				if ($c>=1 && $c<=5) $tableName = "last_class1_5_enroll_f1";
				if ($c>=6 && $c<=8) $tableName = "last_class6_8_enroll_f1";
				if ($c>=9 && $c<=10) $tableName = "last_class9_10_enroll_f1";
				if ($c>=11) $tableName = "hsec_last_exam_details_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				if ($c>=11) {
					$fieldName = "{$ek}_pass_{$gk}";
					if ($ek=='total') $fieldName = "tot_pass_{$gk}";
				}	
				
				if ($tableName!='' && $fieldName!='') {
					$data['prom'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
				}
				*/
			}
		}
		
	}
	
	
	
	// Repetition
	$pk='rep';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0 || $c>10) continue;
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				$data['rep'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
	
			}
		}
		
	}
	
	// migrants
	$pk='tran';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0 || $c>10) continue;
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				$data['tran'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
	
			}
		}
		
	}

	// last year's enrollment
	$pk='lastenr';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				
				if ($c==0) continue;
				
				if ($c>=1 && $c<=5) $tableName = "last_class1_5_enroll_f1";
				if ($c>=6 && $c<=8) $tableName = "last_class6_8_enroll_f1";
				if ($c>=9 && $c<=10) $tableName = "last_class9_10_enroll_f1";
				if ($c>=11) $tableName = "hsec_current_details_f1";
				
				if ($c<=10) $fieldName = "tot_enroll_{$ek}_{$gk}";
				if ($c>=11) {
					if ($ek=='total') $fieldName = "tot_{$gk}";
					else $fieldName = "{$ek}_{$gk}";
				}
	
				
				if ($tableName!='' && $fieldName!='') {
					if ($c<=10) $data['lastenr'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
					else{
					
						$wc_ = str_replace("sch_year='$sch_year'", "sch_year='".($sch_year-1)."'",$wc);
						$data['lastenr'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc_.($c>=1?" AND class='$c'":''));
					}
				}
				$tableName = ''; $fieldName = '';
			}
		}
		
	}

	
	// dropout
	$pk='drop';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=1;$c<=10;$c++){
				$data['drop'][$ek][$gk][$c] = $data['lastenr'][$ek][$gk][$c] - $data['rep'][$ek][$gk][$c] - $data['prom'][$ek][$gk][$c];
				if ($data['drop'][$ek][$gk][$c]<0) $data['drop'][$ek][$gk][$c]='';
	
			}
		}
		
	}
	
	
	// calculate others row
	foreach (array("enroll"=>"Enrollment","app"=>"Exam Appeared","prom"=>"Promoted","drop"=>"Dropout","rep"=>"Repetition","tran"=>"Migrants") as $pk=>$pv){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				for ($c=0;$c<=12;$c++){
					$data[$pk]['other'][$gk][$c] = $data[$pk]['total'][$gk][$c] - $data[$pk]['dalit'][$gk][$c] -$data[$pk]['janjati'][$gk][$c];
			}
		}
	}
	
	?>
	
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Student Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="3">Particulars (in number)</td>
			<td>ECD</td>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
		</tr>
		
		<?php
		
		foreach (array("enroll"=>"Enrollment","app"=>"Retention","prom"=>"Promotion","rep"=>"Repetition","drop"=>"Dropout","tran"=>"Migrants") as $pk=>$pv){
			echo "<tr>\n"; $po=1;
			echo "<td class='theader' rowspan='",($pk=='enroll'?10:8),"' width='5%'>$pv</td>\n";
			
			foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","other"=>"Other", "disabled"=>"Disabled") as $ek=>$ev){
				if ($ek=='disabled' && $pk!='enroll') continue;
				
				if ($po!=1) {echo "<tr>\n"; $po=1;}
				echo "<td class='theader' rowspan='2' width='5%'>$ev</td>\n";
				foreach(array("t"=>"Total","f"=>"Female") as $gk=>$gv){
					if ($po!=1) {echo "<tr>\n"; $po=1;}
					echo "<td class='theader' width='5%'>$gv</td>\n";
					for ($c=0;$c<=12;$c++){
						
						echo "<td width='5%'>" , ($data[$pk][$ek][$gk][$c]!=0?$data[$pk][$ek][$gk][$c]:'') ,"</td>\n";
	
					}
					echo "</tr>\n";
					$po=0;
				}
			}
			
		}
		
		?>
		
	</table>	
	
<?php
}


function reportAchievementsPercentage(){
	global $link, $wc, $dist_code, $vdc_code, $sch_year;

	// calculate data
	
	$data = array();
	
	// enrollment: total, dalit & janjati
	$pk='enroll';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0) $tableName = "ecdppc_enroll_f1";
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				if ($c>=11) $tableName = "hsec_current_details_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				if ($c>=11 && $pk=='enroll') {
					$fieldName = "{$ek}_{$gk}";
					if ($ek=='total') $fieldName = "tot_{$gk}";
				}	
				
				if ($tableName!='' && $fieldName!='') {
					$data['enroll'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
				}
			}
		}
		
	}
	
	// enrollment: disabled
	foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
		for ($c=0;$c<=12;$c++){
			if ($c==0) $tableName="ecd_disabled_f1";
			if ($c>=1 && $c<=5) $tableName="pr_disabled_f1";
			if ($c>=6 && $c<=8) $tableName="lsec_disabled_f1";
			if ($c>=9 && $c<=10) $tableName="sec_disabled_f1";
			if ($c>=11 && $c<=12) $tableName="hsec_disabled_f1";
			
			$data[$pk]['disabled'][$gk][$c]=getSum($tableName,"disabled_$gk",$wc." AND class='$c'");
			
			
		}
	}
	
	
	
	
	// exam appeared: total, dalit & janjati
	$pk='app';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				
				if ($c==0) continue;
				
				if ($c>=1 && $c<=5) $tableName = "last_class1_5_enroll_f1";
				if ($c>=6 && $c<=8) $tableName = "last_class6_8_enroll_f1";
				if ($c>=9 && $c<=10) $tableName = "last_class9_10_enroll_f1";
				if ($c>=11) $tableName = "hsec_last_exam_details_f1";
				
				if ($c<=10) $fieldName = "tot_appeared_exam_{$ek}_{$gk}";
				if ($c>=11) {
					if ($ek=='total') $fieldName = "tot_app_{$gk}";
					else $fieldName = "{$ek}_app_{$gk}";
				}
	
				
				if ($tableName!='' && $fieldName!='') {
					$data['app'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
				}
				$tableName = ''; $fieldName = '';
			}
		}
		
	}
	
	
	
	
	// promoted
	$pk='passed_exam';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c<=1 || $c>10) continue;
				//$data['prom'][$ek][$gk][$c] = $data['enroll'][$ek][$gk][$c+1] - $data['rep'][$ek][$gk][$c+1];
				
				if ($c>1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				
				$fieldName = "tot_prom_{$ek}_{$gk}";
				$data['prom'][$ek][$gk][$c-1] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));	
				
				if ($c==10) $data['prom'][$ek][$gk][$c] = getSum('last_class9_10_enroll_f1',"tot_passed_exam_{$ek}_{$gk}",$wc." AND class='$c'");
				
			}
		}
		
	}
	
	
	// Repetition
	$pk='rep';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0 || $c>10) continue;
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				$data['rep'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
	
			}
		}
		
	}
	
	// migrants
	$pk='tran';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				if ($c==0 || $c>10) continue;
				if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
				if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
				if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
				
				$fieldName = "tot_{$pk}_{$ek}_{$gk}";
				$data['tran'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
	
			}
		}
		
	}

	
	

	
	// last year's enrollment
	$pk='lastenr';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=0;$c<=12;$c++){
				
				if ($c==0) continue;
				
				if ($c>=1 && $c<=5) $tableName = "last_class1_5_enroll_f1";
				if ($c>=6 && $c<=8) $tableName = "last_class6_8_enroll_f1";
				if ($c>=9 && $c<=10) $tableName = "last_class9_10_enroll_f1";
				if ($c>=11) $tableName = "hsec_current_details_f1";
				
				if ($c<=10) $fieldName = "tot_enroll_{$ek}_{$gk}";
				if ($c>=11) {
					if ($ek=='total') $fieldName = "tot_{$gk}";
					else $fieldName = "{$ek}_{$gk}";
				}
	
				
				if ($tableName!='' && $fieldName!='') {
					if ($c<=10) $data['lastenr'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
					else{
					
						$wc_ = str_replace("sch_year='$sch_year'", "sch_year='".($sch_year-1)."'",$wc);
						$data['lastenr'][$ek][$gk][$c] = getSum($tableName, $fieldName, $wc_.($c>=1?" AND class='$c'":''));
					}
				}
				$tableName = ''; $fieldName = '';
			}
		}
		
	}


	
	// dropout
	$pk='drop';
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
			for ($c=1;$c<=10;$c++){
				$data['drop'][$ek][$gk][$c] = $data['lastenr'][$ek][$gk][$c] - $data['rep'][$ek][$gk][$c] - $data['prom'][$ek][$gk][$c];
				if ($data['drop'][$ek][$gk][$c]<0) $data['drop'][$ek][$gk][$c]='';
	
			}
		}
		
	}
	
	// calculate others row
	foreach (array("enroll"=>"Enrollment","app"=>"Exam Appeared","prom"=>"Promoted","drop"=>"Dropout","rep"=>"Repetition","tran"=>"Migrants", 'lastenr'=>"Last Year Enrollment") as $pk=>$pv){
		foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				for ($c=0;$c<=12;$c++){
					$data[$pk]['other'][$gk][$c] = $data[$pk]['total'][$gk][$c] - $data[$pk]['dalit'][$gk][$c] -$data[$pk]['janjati'][$gk][$c];
			}
		}
	}	
	
	// calculate percentage
	foreach (array("app"=>"Exam Appeared","prom"=>"Promoted","drop"=>"Dropout","rep"=>"Repetition","tran"=>"Migrants", 'lastenr'=>"Last Year Enrollment") as $pk=>$pv){
		foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","other"=>"Other", "disabled"=>"Disabled") as $ek=>$ev){
			foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				for ($c=0;$c<=12;$c++){
					if ($data['lastenr'][$ek][$gk][$c]>0) {
						
						$data[$pk][$ek][$gk][$c] /= $data['lastenr'][$ek][$gk][$c];
						$data[$pk][$ek][$gk][$c] *=100;
						$data[$pk][$ek][$gk][$c] = round($data[$pk][$ek][$gk][$c],2);
						$data[$pk][$ek][$gk][$c] = sprintf("%.2f",$data[$pk][$ek][$gk][$c]);
						
						//$data[$pk][$ek][$gk][$c] .= " / ".$data['lastenr'][$ek][$gk][$c];
					}
					else{
						$data[$pk][$ek][$gk][$c]='';
					}
				}
			}
		}
	}	
	

	
	?>
	
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Student Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="3">Particulars</td>
			<td>ECD</td>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
		</tr>
		
		<?php
		$cnt=1;
		foreach (array("enroll"=>"Enrollment","app"=>"Retention % ","prom"=>"Promotion %","rep"=>"Repetition %","drop"=>"Dropout %","tran"=>"Migrants %") as $pk=>$pv){
			echo "<tr>\n"; $po=1;
			echo "<td class='theader' rowspan='",($pk=='enroll'?10:8),"' width='10%'>$pv <sup>",$cnt++,"</sup></td>\n";
			
			foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","other"=>"Other", "disabled"=>"Disabled") as $ek=>$ev){
				if ($ek=='disabled' && $pk!='enroll') continue;
				
				if ($po!=1) {echo "<tr>\n"; $po=1;}
				echo "<td class='theader' rowspan='2' width='5%'>$ev</td>\n";
				foreach(array("t"=>"Total","f"=>"Female") as $gk=>$gv){
					if ($po!=1) {echo "<tr>\n"; $po=1;}
					echo "<td class='theader' width='5%'>$gv</td>\n";
					for ($c=0;$c<=12;$c++){
						
						echo "<td width='5%'>" , ($data[$pk][$ek][$gk][$c]!=0?$data[$pk][$ek][$gk][$c]:'') ,"</td>\n";
	
					}
					echo "</tr>\n";
					$po=0;
				}
			}
			
		}
		
		?>
		
	</table>
	<br />
	<center>
		1 = Current Year.  2, 3, 4, 5, 6 = Based on last year enrollment.<br />
		Note: Promotion for Class 10 is based on Test Exam Results.
	
	</center>
	
<?php
}




function reportSchools(){
	global $link, $wc, $dist_code, $vdc_code;
	
	$schoolTypeInfo=array();
	$schoolTypeInfo['=1']='Govt. Aided';
	$schoolTypeInfo['=2']='C. Managed';
	$schoolTypeInfo['=3']='Unaided';
	$schoolTypeInfo['=4']='Teacher Quota';
	$schoolTypeInfo['=5']='Institutional';
	$schoolTypeInfo['=8']='Madrassa';
	$schoolTypeInfo['=9']='Gumba';
	$schoolTypeInfo['=10']='Ashram';
	$schoolTypeInfo['=11']='Sop/Fsp';
	$schoolTypeInfo['>0']='Total';
	
?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="9">School By Grade Information</td>
		</tr>
		<tr class="theader" align="center">
			<td>Particulars</td>
			<td>Govt. Aided</td>
			<td>C. Managed</td>
			<td>Unaided</td>
			<td>Quota</td>
			<td>Institutional</td>
			<td>Madrassa</td>
			<td>Gumba</td>
			<td>Ashram</td>
		</tr>

		<?php
			reportSchoolsRow(0,0);
			reportSchoolsRow(1,1);
			reportSchoolsRow(1,2);
			reportSchoolsRow(1,3);
			reportSchoolsRow(1,4);
			reportSchoolsRow(1,5);
			reportSchoolsRow(1,6);
			reportSchoolsRow(1,7);
			reportSchoolsRow(1,8);
			reportSchoolsRow(1,9);
			reportSchoolsRow(1,10);
			reportSchoolsRow(1,11);
			reportSchoolsRow(1,12);
			reportSchoolsRow(6,7);
			reportSchoolsRow(6,8);
			reportSchoolsRow(6,9);
			reportSchoolsRow(6,10);
			reportSchoolsRow(6,11);
			reportSchoolsRow(6,12);
			reportSchoolsRow(9,10);
			reportSchoolsRow(9,11);
			reportSchoolsRow(9,12);
			reportSchoolsRow(11,12);
			
		
		?>
		
	</table>
<?php
	
}

function reportSchoolsRow($st, $en){
	echo "<tr align='center'>\n";
	
	if ($st==0) echo "<td class='theader'>ECD</td>\n";
	elseif ($st==1 && $en==1) echo "<td class='theader'>1</td>\n";
	else echo "<td class='theader'>$st - $en</td>\n";
	
	echo "<td>",reportSchoolsColumn($st, $en, 1),"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 2),"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 3),"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 4),"</td>\n";
	$sum=reportSchoolsColumn($st, $en, 5)+reportSchoolsColumn($st, $en, 6)+reportSchoolsColumn($st, $en, 7);
	if ($sum==0) $sum='';
	echo "<td>",$sum,"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 8),"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 9),"</td>\n";
	echo "<td>",reportSchoolsColumn($st, $en, 10),"</td>\n";
	echo "</tr>\n";
}

function reportSchoolsColumn($st, $en, $type){
	global $link, $wc, $dist_code, $vdc_code;
	
	$extraClause = '';
	for ($c=0;$c<=12;$c++){
		
		if ($c==0 && $en>0) continue;
		
		if ($c==0) $col='ecd'; else $col="class$c";
		if ($c>=$st && $c<=$en) $extraClause .= " AND $col='$type' ";
		else $extraClause .= " AND $col='0' ";
	
	}
	$extraClause .= " AND flash1=1";
	//echo $wc.$extraClause;
	$count = getCount('mast_school_type',$wc.$extraClause);
	if ($count>0) return $count; else return '';
	
}


function reportDisability(){
	global $link, $wc, $dist_code, $vdc_code;
	
	// calculate data
	
	$data = array();
	
	// enrollment: total, dalit & janjati
	$pk='enroll';
	foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
		for ($c=0;$c<=12;$c++){
			if ($c==0) $tableName = "ecdppc_enroll_f1";
			if ($c>=1 && $c<=5) $tableName = "enr_rep_mig_class1_5_f1";
			if ($c>=6 && $c<=8) $tableName = "enr_rep_mig_class6_8_f1";
			if ($c>=9 && $c<=10) $tableName = "enr_rep_mig_class9_10_f1";
			if ($c>=11) $tableName = "hsec_current_details_f1";
			
			$fieldName = "tot_enroll_total_{$gk}";
			if ($c>=11) $fieldName = "tot_{$gk}";
			
			if ($tableName!='' && $fieldName!='') {
				$data['total'][$gk][$c] = getSum($tableName, $fieldName, $wc.($c>=1?" AND class='$c'":''));
			}
		}
		
	}
	
	// enrollment: disabled
	foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
		for ($c=0;$c<=12;$c++){
			if ($c==0) $tableName="ecd_disabled_f1";
			if ($c>=1 && $c<=5) $tableName="pr_disabled_f1";
			if ($c>=6 && $c<=8) $tableName="lsec_disabled_f1";
			if ($c>=9 && $c<=10) $tableName="sec_disabled_f1";
			if ($c>=11 && $c<=12) $tableName="hsec_disabled_f1";
			
			$data['disabled'][$gk][$c]=getSum($tableName,"disabled_$gk",$wc." AND class='$c'");
			
			
		}
	}	
	
	?>
	
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Student Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="3">Particulars</td>
			<td>ECD</td>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
		</tr>
		
		<?php
		
		foreach (array("enroll"=>"Enrollment") as $pk=>$pv){
			echo "<tr>\n"; $po=1;
			echo "<td class='theader' rowspan='6' width='15%'>$pv</td>\n";
			
			foreach(array("total"=>"Total","disabled"=>"Disabled") as $ek=>$ev){
				if ($ek=='disabled' && $pk!='enroll') continue;
				
				if ($po!=1) {echo "<tr>\n"; $po=1;}
				echo "<td class='theader' rowspan='3' width='10%'>$ev</td>\n";
				foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
					if ($po!=1) {echo "<tr>\n"; $po=1;}
					echo "<td class='theader' width='10%'>$gv</td>\n";
					for ($c=0;$c<=12;$c++){
						
						echo "<td width='5%'>" , ($data[$ek][$gk][$c]!=0?$data[$ek][$gk][$c]:'') ,"</td>\n";
	
					}
					echo "</tr>\n";
					$po=0;
				}
			}
			
		}
		
		?>
		
	</table>	
	
	<div class="clear"></div>
	
<?php
	

	unset($data);
	
	// disability 
	
	for ($c=0;$c<=12;$c++){
		for ($did=1;$did<=6;$did++){
			foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
				if ($c==0) $tableName="ecd_disabled_f1";
				if ($c>=1 && $c<=5) $tableName="pr_disabled_f1";
				if ($c>=6 && $c<=8) $tableName="lsec_disabled_f1";
				if ($c>=9 && $c<=10) $tableName="sec_disabled_f1";
				if ($c>=11 && $c<=12) $tableName="hsec_disabled_f1";
				
				$data['disability'][$gk][$c][$did]=getSum($tableName,"disabled_$gk",$wc." AND disability_type_id='$did' AND class='$c'");
			}
		}
	}
	
	// calculate totals
	for ($c=0;$c<=12;$c++){
		for ($did=1;$did<=6;$did++){
			foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
				$data['disability'][$gk][13][$did]+=$data['disability'][$gk][$c][$did];
			}
		}
	}
	
	?>
	
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">Disability Information</td>
		</tr>
		<tr class="theader cu">
			<td rowspan="2" width="10%">Particulars</td>
			<td colspan="2">Physical</td>
			<td colspan="2">Mental</td>
			<td colspan="2">Deaf</td>
			<td colspan="2">Blind</td>
			<td colspan="2">Poor Hearing</td>
			<td colspan="2">Dumb</td>
		</tr>
		<tr class="theader cu">
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
		</tr>
		
		<?php
		for ($c=0;$c<=13;$c++){
			echo "<tr>\n";
			
			if ($c==0) echo "<td class='theader'>ECD</td>\n";
			elseif ($c==13) echo "<td class='theader'>Total</td>\n";
			else echo "<td class='theader'>$c</td>\n";
			
			for ($did=1;$did<=6;$did++){
				foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
					echo "<td width='5%'>" , ($data['disability'][$gk][$c][$did]!=0?$data['disability'][$gk][$c][$did]:'') ,"</td>\n";
				}
			}
			echo "</tr>\n";
		}
		
		?>
		
	</table>	
	<div class="clear"></div>
	
<?php	

	unset($data);
	
	$janjatis = array();
	$janjatis[]="Bankaria";
	$janjatis[]="Baramu";
	$janjatis[]="Bote";
	$janjatis[]="Chepang";
	$janjatis[]="Danuwar";
	$janjatis[]="Dhanuk";
	$janjatis[]="Hayu";
	$janjatis[]="Jhagad";
	$janjatis[]="Kisan";
	$janjatis[]="Kusunda";
	$janjatis[]="Lopcha";
	$janjatis[]="Majhi";
	$janjatis[]="Meche";
	$janjatis[]="Mushbadiya";
	$janjatis[]="Raji";
	$janjatis[]="Raute";
	$janjatis[]="Satar";
	$janjatis[]="Singsa";
	$janjatis[]="Siyar";
	$janjatis[]="Surel";
	$janjatis[]="Thami";
	$janjatis[]="Thunam";

	$data = array();
	foreach($janjatis as $j){
		foreach(array("f"=>"G","t"=>"T") as $gk=>$gv){
			for($c=1;$c<=12;$c++){
				$data['janjati'][$j][$gk][$c]=getSum("janjati_f1","total_$gk",$wc." AND janjati_type='$j' AND class='$c'");
			}
		}

	}
	
	?>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">Marginalized Students Information - I</td>
		</tr>
		<tr class="theader cu">
			<td rowspan="2" width="10%">Particulars</td>
			<td colspan="2">Class 1</td>
			<td colspan="2">Class 2</td>
			<td colspan="2">Class 3</td>
			<td colspan="2">Class 4</td>
			<td colspan="2">Class 5</td>
			<td colspan="2">Total</td>
		</tr>
		<tr class="theader cu">
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
		</tr>
		
		<?php
		
		foreach($janjatis as $j){
			echo "<tr>\n";
			echo "<td class='theader'>$j</td>\n";
			$sf=$st=0;
			for ($c=1;$c<=5;$c++){
				
				
				foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
					echo "<td width='5%'>" , ($data['janjati'][$j][$gk][$c]!=0?$data['janjati'][$j][$gk][$c]:'') ,"</td>\n";
					
				}
				$sf += $data['janjati'][$j]['f'][$c];
				$st += $data['janjati'][$j]['t'][$c];
				
				if ($c==5){
					echo "<td width='5%'>" , ($sf!=0?$sf:'') ,"</td>\n";
					echo "<td width='5%'>" , ($st!=0?$st:'') ,"</td>\n";
				}
				
			}
			echo "</tr>\n";
		}
		
		?>
		
	</table>	
	<div class="clear"></div>
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="19">Marginalized Students Information - II</td>
		</tr>
		<tr class="theader cu">
			<td rowspan="2" width="10%">Particulars</td>
			<td colspan="2">Class 6</td>
			<td colspan="2">Class 7</td>
			<td colspan="2">Class 8</td>
			<td colspan="2">Class 9</td>
			<td colspan="2">Class 10</td>
			<td colspan="2">Total</td>
			<td colspan="2">Class 11</td>
			<td colspan="2">Class 12</td>
			<td colspan="2">Total</td>
		</tr>
		<tr class="theader cu">
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
			<td>G</td><td>T</td>
		</tr>
		
		<?php
		
		foreach($janjatis as $j){
			echo "<tr>\n";
			echo "<td class='theader'>$j</td>\n";
			$sf=$st=0;
			for ($c=6;$c<=10;$c++){
				
				
				foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
					echo "<td width='5%'>" , ($data['janjati'][$j][$gk][$c]!=0?$data['janjati'][$j][$gk][$c]:'') ,"</td>\n";
					
				}
				$sf += $data['janjati'][$j]['f'][$c];
				$st += $data['janjati'][$j]['t'][$c];
				
				if ($c==10){
					echo "<td width='5%'>" , ($sf!=0?$sf:'') ,"</td>\n";
					echo "<td width='5%'>" , ($st!=0?$st:'') ,"</td>\n";
				}
				
			}
			
			$sf=$st=0;
			for ($c=11;$c<=12;$c++){
				
				
				foreach (array("f"=>"G","t"=>"T") as $gk=>$gv){
					echo "<td width='5%'>" , ($data['janjati'][$j][$gk][$c]!=0?$data['janjati'][$j][$gk][$c]:'') ,"</td>\n";
					
				}
				$sf += $data['janjati'][$j]['f'][$c];
				$st += $data['janjati'][$j]['t'][$c];
				
				if ($c==12){
					echo "<td width='5%'>" , ($sf!=0?$sf:'') ,"</td>\n";
					echo "<td width='5%'>" , ($st!=0?$st:'') ,"</td>\n";
				}
				
			}			
			echo "</tr>\n";
		}
		
		?>
		
	</table>	
	<div class="clear"></div>
	
	
<?php		

	
	
}

function reportAge(){
	global $link, $wc, $dist_code, $vdc_code, $sch_year;
	
	$age = array();
	
	if ($sch_year>=2066){
		$age[1]['l5']='Less than 5';
		$age[1]['5']='Five';
		$age[1]['6']='Six';
		$age[1]['7']='Seven';
		$age[1]['8']='Eight';
		$age[1]['9']='Nine ';
		$age[1]['g9']='Greater than 9';
		$age[1]['t']='Total';
		$age[2]['l6']='Less than 6';
		$age[2]['6']='Six';
		$age[2]['7']='Seven';
		$age[2]['8']='Eight';
		$age[2]['9']='Nine ';
		$age[2]['g9']='Greater than 9';
		$age[2]['t']='Total';
		$age[3]['l7']='Less than 7';
		$age[3]['7']='Seven';
		$age[3]['8']='Eight';
		$age[3]['9']='Nine ';
		$age[3]['10']='Ten';
		$age[3]['g10']='Greater than 10';
		$age[3]['t']='Total';
		$age[4]['l8']='Less than 8';
		$age[4]['8']='Eight';
		$age[4]['9']='Nine ';
		$age[4]['10']='Ten';
		$age[4]['11']='Eleven';
		$age[4]['g11']='Greater than 11';
		$age[4]['t']='Total';
		$age[5]['l9']='Less than 9';
		$age[5]['9']='Nine ';
		$age[5]['10']='Ten';
		$age[5]['11']='Eleven';
		$age[5]['12']='Twelve';
		$age[5]['g12']='Greater than 12';
		$age[5]['t']='Total';
		$age[6]['l10']='Less than 10';
		$age[6]['10']='Ten';
		$age[6]['11']='Eleven';
		$age[6]['12']='Twelve';
		$age[6]['13']='Thirteen';
		$age[6]['14']='Fourteen';
		$age[6]['g14']='Greater than 14';
		$age[6]['t']='Total';
		$age[7]['l11']='Less than 11';
		$age[7]['11']='Eleven';
		$age[7]['12']='Twelve';
		$age[7]['13']='Thirteen';
		$age[7]['14']='Fourteen';
		$age[7]['g14']='Greater than 14';
		$age[7]['t']='Total';
		$age[8]['l12']='Less than 12';
		$age[8]['12']='Twelve';
		$age[8]['13']='Thirteen';
		$age[8]['14']='Fourteen';
		$age[8]['15']='Fifteen';
		$age[8]['g15']='Greater than 15';
		$age[8]['t']='Total';
		$age[9]['l13']='Less than 13';
		$age[9]['13']='Thirteen';
		$age[9]['14']='Fourteen';
		$age[9]['15']='Fifteen';
		$age[9]['16']='Sixteen';
		$age[9]['g16']='Greater than 16';
		$age[9]['t']='Total';
		$age[10]['l14']='Less than 14';
		$age[10]['14']='Fourteen';
		$age[10]['15']='Fifteen';
		$age[10]['16']='Sixteen';
		$age[10]['17']='Seventeen';
		$age[10]['g17']='Greater than 17';
		$age[10]['t']='Total';
		$age[11]['l15']='Less than 15';
		$age[11]['15']='Fifteen';
		$age[11]['15_16']='Fifteen-Sixteen';
		$age[11]['g16']='Greater than 16';
		$age[11]['t']='Total';
		$age[12]['l16']='Less than 16';
		$age[12]['16']='Sixteen';
		$age[12]['g16']='Greater than 16';
		$age[12]['t']='Total';
	}
	else{
		$age[1]['l5']='Less than 5';
		$age[1]['5']='5 years';
		$age[1]['6']='6 years';
		$age[1]['7_9']='7-9 years';
		$age[1]['g9']='More than 9';
		$age[1]['t']='Total';
		$age[2]['l6']='Less than 6';
		$age[2]['6']='6 years';
		$age[2]['7_9']='7-9 years';
		$age[2]['g9']='More than 9';
		$age[2]['t']='Total';
		$age[3]['l7']='Less than 6';
		$age[3]['7']='7 years';
		$age[3]['8_9']='8-9 years';
		$age[3]['g9']='More than 9';
		$age[3]['t']='Total';
		$age[4]['l8']='Less than 8';
		$age[4]['8']='8 years';
		$age[4]['9']='9 years';
		$age[4]['g9']='More than 9';
		$age[4]['t']='Total';
		$age[5]['l9']='Less than 9';
		$age[5]['9']='9 years';
		$age[5]['g9']='More than 9';
		$age[5]['t']='Total';
		$age[6]['l10']='Less than 10';
		$age[6]['10']='10 years';
		$age[6]['11_12']='11-12 years';
		$age[6]['g12']='More than 12';
		$age[6]['t']='Total';
		$age[7]['l11']='Less than 11';
		$age[7]['11']='11 years';
		$age[7]['12']='12 years';
		$age[7]['g12']='More than 12';
		$age[7]['t']='Total';
		$age[8]['l12']='Less than 12';
		$age[8]['12']='12 years';
		$age[8]['g12']='More than 12';
		$age[8]['t']='Total';
		$age[9]['l13']='Less than 13';
		$age[9]['13']='13 years';
		$age[9]['13_14']='13-14 years';
		$age[9]['g14']='More than 14';
		$age[9]['t']='Total';
		$age[10]['l14']='Less than 14';
		$age[10]['14']='14 years';
		$age[10]['g14']='More than 14';
		$age[10]['t']='Total';
		$age[11]['l15']='Less than 15';
		$age[11]['15']='15 years';
		$age[11]['15_16']='15-16 years';
		$age[11]['g16']='More than 16';
		$age[11]['t']='Total';
		$age[12]['l16']='Less than 16';
		$age[12]['16']='16 years';
		$age[12]['g16']='More than 16';
		$age[12]['t']='Total';
	}
	
	
	for ($c=1;$c<=12;$c++){
		foreach($age[$c] as $ak=>$av){
			if ($ak=='t') continue;
			foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
				foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
					if ($c>=1 && $c<=5) $tableName = "pr_{$ek}_enroll_age_f1";
					if ($c>=6 && $c<=10) $tableName = "sec_{$ek}_enroll_age_f1";
					if ($c>=11 && $c<=12) $tableName = "hsec_{$ek}_enroll_age_f1";
					
					$fieldName = "{$gk}_{$ak}";
					
					$data['age'][$c][$ak][$ek][$gk]=getSum($tableName,$fieldName,$wc." AND class='$c'");
					$data['age'][$c]['t'][$ek][$gk] += $data['age'][$c][$ak][$ek][$gk];
				
				}
			
			}
			
				
				
		}
	}
	
	// calculate others row
	for ($c=1;$c<=12;$c++){
		foreach($age[$c] as $ak=>$av){
			foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				$data['age'][$c][$ak]['other'][$gk]=$data['age'][$c][$ak]['total'][$gk]-$data['age'][$c][$ak]['dalit'][$gk]-$data['age'][$c][$ak]['janjati'][$gk];
			}
		}
	}	
	
	?>
	
	
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Agewise Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="2" rowspan="2">Particulars</td>
			<td colspan="=3">Total</td>
			<td colspan="=3">Dalit</td>
			<td colspan="=3">Janjati</td>
			<td colspan="=3">Others</td>
		</tr>
		<tr class="theader">
			<td>Total</td><td>Girls</td><td>Boys</td>
			<td>Total</td><td>Girls</td><td>Boys</td>
			<td>Total</td><td>Girls</td><td>Boys</td>
			<td>Total</td><td>Girls</td><td>Boys</td>
		</tr>
		<?php
		
		for ($c=1;$c<=12;$c++){
			echo "<tr>\n"; $po=1;
			echo "<td class='theader' rowspan='",count($age[$c]),"' width='5%'>Class $c</td>\n";
			
			foreach($age[$c] as $ak=>$av){
				if ($po!=1) echo "<tr>\n"; $po=0;
				echo "<td class='theader' width='10%'>$av</td>\n";
				foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","other"=>"Others") as $ek=>$ev){
					foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
						echo "<td width='5%'>" , ($data['age'][$c][$ak][$ek][$gk]!=0?$data['age'][$c][$ak][$ek][$gk]:'') ,"</td>\n";
						
					}
				}
			}
			
		}
		
		?>
		
	</table>	
	
	
<?php
	
}

function reportTeacher(){
	global $link, $wc, $dist_code, $vdc_code;
	
	$data = array();
	
	$teacher_info_type = array("Approved Position"=>"total_a_teachers",
								"Working Under App."=>"total_%g_teachers",
								"Rahat + PCF"=>"grant_%g",
								"Private Sources"=>"private_%g",
								"Total Teachers"=>"total_teachers",
								"Dalit Teachers"=>"dalit_%g_teachers",
								"Janjati Teachers"=>"janjati_%g_teachers",
								"Other Teachers"=>"other_teachers",
								"Disabled Teachers"=>"disabled_%g_teachers",
								"Temp. Teachers"=>"temp_%g");
	
	foreach($teacher_info_type as $ck=>$cv){
		foreach(array("pri_teacher_details_f1","lsec_teacher_details_f1","sec_teacher_details_f1","hsec_teacher_details_f1") as $t){
			if ($cv=='total_a_teachers'){
				$data[$cv][$t]['t'] = getSum($t, $cv, $wc);
				continue;
			}
			foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				if ($cv=='total_teachers' || $cv=='other_teachers'){
					if ($cv=='total_teachers') $data[$cv][$t][$gk]=$data['total_%g_teachers'][$t][$gk]+$data['grant_%g'][$t][$gk]+$data['private_%g'][$t][$gk];
					if ($cv=='other_teachers') $data[$cv][$t][$gk]=$data['total_teachers'][$t][$gk]+$data['dalit_%g_teachers'][$t][$gk]+$data['janjati_%g_teachers'][$t][$gk];
					continue;
				}
				
				$col = str_replace('%g',$gk,$cv);
				$data[$cv][$t][$gk] = getSum($t, $col, $wc);
			}
		}
	}
	
?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Teacher Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Particulars</td>
			<td colspan="=3">Primary</td>
			<td colspan="=3">Lower Secondary</td>
			<td colspan="=3">Secondary</td>
			<td colspan="=3">Higher Secondary</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>

<?php	

	foreach($teacher_info_type as $ck=>$cv){
		echo "<tr><td>$ck</td>";
		foreach(array("pri_teacher_details_f1","lsec_teacher_details_f1","sec_teacher_details_f1","hsec_teacher_details_f1") as $t){
			foreach(array("f"=>"Female","m"=>"Male","t"=>"Total") as $gk=>$gv){
				echo "<td>" , ($data[$cv][$t][$gk]?$data[$cv][$t][$gk]:'') ,"</td>\n";
			
			}
		}
		echo "</tr>";
	}
	
?>
	
	</table>
	

	<div class="clear"></div>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="16">Rahat + PCF Grant Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="4">Rahat</td>
			<td colspan="8">PCF</td>
		</tr>
		
		<tr class="theader cu">
			<td rowspan='2'>Pri.</td>
			<td rowspan='2'>L.Sec.</td>
			<td rowspan='2'>Sec.</td>
			<td rowspan='2'>H.Sec.</td>
			<td colspan='4'>Full Time Teachers</td>
			<td colspan='4'>Part Time Teachers</td>
		</tr>
		
		<tr class="theader cu">
			<td>Pri.</td>
			<td>L.Sec.</td>
			<td>Sec.</td>
			<td>H.Sec.</td>
			<td>Pri.</td>
			<td>L.Sec.</td>
			<td>Sec.</td>
			<td>H.Sec.</td>
		</tr>
		
		<tr>
		
			<td><?php $data = getSum('teacher_rahat_f1','rahat_pri',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_rahat_f1','rahat_lsec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_rahat_f1','rahat_sec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_rahat_f1','rahat_hsec',$wc); echo ($data?$data:''); ?></td>
			
			<td><?php $data = getSum('teacher_pcf_f1','pcf_full_pri',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_full_lsec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_full_sec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_full_hsec',$wc); echo ($data?$data:''); ?></td>
			
			<td><?php $data = getSum('teacher_pcf_f1','pcf_par_pri',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_par_lsec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_par_sec',$wc); echo ($data?$data:''); ?></td>
			<td><?php $data = getSum('teacher_pcf_f1','pcf_par_hsec',$wc); echo ($data?$data:''); ?></td>
			
		</tr>
		
		
	</table>
	
	
	<div class="clear"></div>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="17">Teacher Qualification Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Particulars</td>
			<td colspan="1" rowspan="2">ECD</td>
			<td colspan="=3">Primary</td>
			<td colspan="=3">Lower Secondary</td>
			<td colspan="=3">Secondary</td>
			<td colspan="=3">Higher Secondary</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>
		
<?php
	
	unset($data);
	
	$data = array();
	
	$qual_type = array("&lt; SLC"=>"under_slc_%g",
						"SLC"=>"slc_%g",
						"&gt; SLC"=>"greater_slc_%g",
						"IA"=>"ia_%g",
						"BA"=>"ba_%g",
						"MA"=>"ma_%g",
						"PHD"=>"phd_%g");
	


	foreach($qual_type as $qk=>$qv){
		foreach(array("ecd_facilitator_f1","pri_teacher_details_f1","lsec_teacher_details_f1","sec_teacher_details_f1","hsec_teacher_details_f1") as $t){
			foreach(array("t"=>"Total","f"=>"Female","m"=>"Male") as $gk=>$gv){
				$col = str_replace('%g',$gk,$qv);
				$data[$qv][$t][$gk]=getSum($t, $col, $wc);
			
			}
		}
	}
	

	foreach($qual_type as $qk=>$qv){
		echo "<tr>";
		echo "<td>$qk</td>";
		foreach(array("ecd_facilitator_f1","pri_teacher_details_f1","lsec_teacher_details_f1","sec_teacher_details_f1","hsec_teacher_details_f1") as $t){
			foreach(array("f"=>"Female","m"=>"Male","t"=>"Total") as $gk=>$gv){
				if ($t=='ecd_facilitator_f1' && $gk!='t') continue;
				echo "<td>",($data[$qv][$t][$gk]?$data[$qv][$t][$gk]:''),"</td>";
			}
		}
		echo "</tr>";
	}
	

?>
	</table>
	
	<div class="clear"></div>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="17">Teacher Training Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="2" rowspan="2">Particulars</td>
			<td colspan="1" rowspan="2">ECD</td>
			<td colspan="=3">Primary</td>
			<td colspan="=3">Lower Secondary</td>
			<td colspan="=3">Secondary</td>
			<td colspan="=3">Higher Secondary</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>	

<?php
	unset($data);
	
	$data = array();
	foreach(array("fully_trained"=>"Fully Trained","part_trained"=>"Partially Trained","untrained"=>"Untrained") as $tk=>$tv){
		foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","others"=>"Others") as $ek=>$ev){
			foreach(array("pri_teacher_training_f1","lsec_teacher_training_f1","sec_teacher_training_f1","hsec_teacher_training_f1") as $t){
				foreach(array("f"=>"Female","m"=>"Male","t"=>"Total") as $gk=>$gv){
					if ($ek=="others"){
						$data[$tk][$ek][$t][$gk] = $data[$tk]['total'][$t][$gk] - $data[$tk]['dalit'][$t][$gk] - $data[$tk]['janjati'][$t][$gk];
						continue;
					}
					
				
					$col = "{$tk}_{$ek}_{$gk}";
					$data[$tk][$ek][$t][$gk] = getSum($t,$col, $wc);
					
					
				}
			}
		}
	}
	
	$data['fully_trained']['total']['ecdppc_teacher_f1']['t'] = getSum('ecdppc_teacher_f1','training_received',$wc);
	$data['untrained']['total']['ecdppc_teacher_f1']['t'] = getSum('ecdppc_teacher_f1','training_not_received',$wc);
	
	
	foreach(array("fully_trained"=>"Fully Trained","part_trained"=>"Partially Trained","untrained"=>"Untrained") as $tk=>$tv){
		echo "<tr>";
		echo "<td rowspan='4' width='10%'>$tv</td>";
		$tr=1;
		foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","others"=>"Others") as $ek=>$ev){
			if ($tr==0) { echo "<tr>"; $tr=1; }
			echo "<td>$ev</td>";
			foreach(array("ecdppc_teacher_f1","pri_teacher_training_f1","lsec_teacher_training_f1","sec_teacher_training_f1","hsec_teacher_training_f1") as $t){
				foreach(array("f"=>"Female","m"=>"Male","t"=>"Total") as $gk=>$gv){
					if ($t=='ecdppc_teacher_f1' && $gk!='t') continue;
					echo "<td>",($data[$tk][$ek][$t][$gk]?$data[$tk][$ek][$t][$gk]:''),"</td>";
				}
			}
			echo "</tr>";
			$tr=0;
		}
	}	
	
	echo "</table>";
	
	
?>

	<div class="clear"></div>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="17">Head Teacher Information</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Particulars</td>
			<td colspan="1" rowspan="2">ECD</td>
			<td colspan="=3">Primary</td>
			<td colspan="=3">Lower Secondary</td>
			<td colspan="=3">Secondary</td>
			<td colspan="=3">Higher Secondary</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>	

<?php

	foreach (array("Dalit"=>"(hmaster_status='1' OR hmaster_status='Dalit')","Janjati"=>"(hmaster_status='2' OR hmaster_status='Janjati')","Others"=>"(hmaster_status='3' OR hmaster_status='Others')","1 Month Training"=>"(hmaster_training='1')") as $label=>$c){
		echo "<tr>";
		echo "<td>$label</td>";
		foreach(array("ecd & !class1","class1 & !class6","class6 & !class9","class9 & !class11","class11") as $l){
			foreach(array("f"=>"(headmaster='Female' OR headmaster='2')","m"=>"(headmaster='Male' OR headmaster='1')","t"=>"headmaster IS NOT NULL") as $gl=>$g){
				if ($l=='ecd & !class1' && $gl!='t') continue;
				
				echo "<td>";
				$data = getCount('headmaster_f1',$wc." AND $c AND $l AND $g");
				if ($data) echo $data;
				echo "</td>";
				
			}
		}
	}
	
	echo "</table>";
	
?>

	<div class="clear"></div>
	<table border="1" width="49%" style="float:left;">
		<tr class="theader cu">
			<td colspan="6">Teaching Method Information</td>
		</tr>
		<tr class="theader cu">
			<td>Particulars</td>
			<td>Class 1</td>
			<td>Class 2</td>
			<td>Class 3</td>
			<td>Class 4</td>
			<td>Class 5</td>
		</tr>

<?php

	foreach (array("1"=>"Subject","2"=>"Grade","3"=>"Multigrade") as $k=>$v){
		echo "<tr>";
		echo "<td>$v</td>";
		for ($c=1;$c<=5;$c++){
			echo "<td>";
			$data = getCount('teaching_method_f1',$wc." AND c{$c}_teaching_method='$k'");
			if ($data) echo $data;
			echo "</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
	
?>

	<table border="1" width="49%" style="float:left; margin-left: 10px;">
		<tr class="theader cu">
			<td colspan="6">Non-teaching staff Information</td>
		</tr>
		<tr class="theader cu">
			<td>Particulars</td>
			<td>ECD</td>
			<td>Pri</td>
			<td>L.Sec.</td>
			<td>Sec.</td>
			<td>H.Sec.</td>
		</tr>

<?php

	foreach (array("account_t"=>"Accountant","admin_t"=>"Administrators","other_t"=>"Others") as $c=>$label){
		echo "<tr>";
		echo "<td>$label</td>";
		foreach(array("ecd & !class1","class1 & !class6","class6 & !class9","class9 & !class11","class11") as $l){
			echo "<td>";
			$data = getSum('non_teaching_staff_f1',$c,$wc." AND $l");
			if ($data) echo $data;
			echo "</td>";
		}
		echo "</tr>";
	}

	echo "</table>";

	echo '<div class="clear"></div>';
	
	
}



function reportEcd(){
	global $link, $wc, $dist_code, $vdc_code, $s,$sch_num;
	
        /*if (strlen($s)==9) reportEcd_basicinfo();
            else reportEcd_basicinfo_general();
        */
        $ecd_centers=  getColumndata("ecdppc_info", $wc, "ecd_num");
        if(count($ecd_centers)>0)
        {
            foreach ($ecd_centers as $ecd_num)
            {
                //display information about each ecd
                reportHeader("ECD Report");
                schoolInfoBlock();

                //store the when condition for next loops otherwise the conditions all get concatenated in $wc
                $temp=$wc;
                
                //specific ecd_num is not required in case of vdc/district reports
                //but is required for school reports
                if(!empty($sch_num) AND !empty($vdc_code))
                    $wc.=" AND ecd_num=$ecd_num";

                if (strlen($s)==9) reportEcd_basicinfo();
                else reportEcd_basicinfo_general();

                ?>

                    <table border="1" width="100%">
                            <tr class="theader cu">
                                    <td colspan="13">ECD/PPC Enrollment</td>
                            </tr>
                            <tr class="theader cu">
                                    <td colspan="1" rowspan="2">Level</td>
                                    <td colspan="3">Total</td>
                                    <td colspan="3">Dalit</td>
                                    <td colspan="3">Janjati</td>
                                    <td colspan="3">New Enroll</td>
                            </tr>
                            <tr class="theader">
                                    <td>F</td><td>M</td><td>T</td>
                                    <td>F</td><td>M</td><td>T</td>
                                    <td>F</td><td>M</td><td>T</td>
                                    <td>F</td><td>M</td><td>T</td>
                            </tr>

            <?php

                    foreach (array("1"=>"ECD","2"=>"PPC","3"=>"Nursery","4"=>"LKG","5"=>"UKG","6"=>"KG") as $lk=>$lv){
                            echo "<tr>";
                            echo "<td class='theader'>$lv</td>";
                            foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","new_enroll"=>"New Enroll") as $ek=>$ev){
                                    if ($ek=='new_enroll'){
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_f",$wc." AND ecd_class_type='$lk'") . "</td>";
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_m",$wc." AND ecd_class_type='$lk'") . "</td>";
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_t",$wc." AND ecd_class_type='$lk'") . "</td>";
                                    }
                                    else{
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_f",$wc." AND ecd_class_type='$lk'") . "</td>";
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_m",$wc." AND ecd_class_type='$lk'") . "</td>";
                                            echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_t",$wc." AND ecd_class_type='$lk'") . "</td>";
                                    }
                            }
                            echo "</tr>";
                    }


                    echo "</table>";
                    echo '<div class="clear"></div>';


            ?>

                    <table border="1" width="100%">
                            <tr class="theader cu">
                                    <td colspan="13">ECD/PPC Enrollment by age</td>
                            </tr>
                            <tr class="theader cu">
                                    <td colspan="1" rowspan="2">Level</td>
                                    <td colspan="3">Total</td>
                                    <td colspan="3">Dalit</td>
                                    <td colspan="3">Janjati</td>
                            </tr>
                            <tr class="theader">
                                    <td>F</td><td>M</td><td>T</td>
                                    <td>F</td><td>M</td><td>T</td>
                                    <td>F</td><td>M</td><td>T</td>
                            </tr>

            <?php

                    foreach (array("3"=>"3 years","4"=>"4 years","5"=>"5 years","_g5"=>">5 years") as $lk=>$lv){
                            echo "<tr>";
                            echo "<td class='theader'>$lv</td>";
                            foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
                                    $f = getSum("ecd_".$ek."_enroll_age_f1","f".$lk,$wc);
                                    $m = getSum("ecd_".$ek."_enroll_age_f1","m".$lk,$wc);
                                    $t = $f+$m;
                                    if ($t==0) $t='';

                                    echo "<td>$f</td>";
                                    echo "<td>$m</td>";
                                    echo "<td>$t</td>";

                            }
                            echo "</tr>";
                    }


                    echo "</table>";
                    echo '<div class="clear"></div>';



                    if (strlen($s)==9) reportEcd_facilitator();
                    else reportEcd_facilitator_general();

                //only one loop is required for vdc and district reports
                if(empty($sch_num) OR empty($vdc_code))
                    break;
                //restore $wc for next loop
                $wc=$temp;
            }
        }
       
	
/*
?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">ECD/PPC Enrollment</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Level</td>
			<td colspan="3">Total</td>
			<td colspan="3">Dalit</td>
			<td colspan="3">Janjati</td>
			<td colspan="3">New Enroll</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>

<?php

	foreach (array("1"=>"ECD","2"=>"PPC","3"=>"Nursery","4"=>"LKG","5"=>"UKG","6"=>"KG") as $lk=>$lv){
		echo "<tr>";
		echo "<td class='theader'>$lv</td>";
		foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","new_enroll"=>"New Enroll") as $ek=>$ev){
			if ($ek=='new_enroll'){
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_f",$wc." AND ecd_class_type='$lk'") . "</td>";
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_m",$wc." AND ecd_class_type='$lk'") . "</td>";
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_".$ek."_t",$wc." AND ecd_class_type='$lk'") . "</td>";
			}
			else{
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_f",$wc." AND ecd_class_type='$lk'") . "</td>";
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_m",$wc." AND ecd_class_type='$lk'") . "</td>";
				echo "<td>" . getSum("ecdppc_enroll_f1","tot_enroll_".$ek."_t",$wc." AND ecd_class_type='$lk'") . "</td>";
			}
		}
		echo "</tr>";
	}


	echo "</table>";
	echo '<div class="clear"></div>';


?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">ECD/PPC Enrollment by age</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Level</td>
			<td colspan="3">Total</td>
			<td colspan="3">Dalit</td>
			<td colspan="3">Janjati</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>

<?php

	foreach (array("3"=>"3 years","4"=>"4 years","5"=>"5 years","_g5"=>">5 years") as $lk=>$lv){
		echo "<tr>";
		echo "<td class='theader'>$lv</td>";
		foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati") as $ek=>$ev){
			$f = getSum("ecd_".$ek."_enroll_age_f1","f".$lk,$wc);
			$m = getSum("ecd_".$ek."_enroll_age_f1","m".$lk,$wc);
			$t = $f+$m;
			if ($t==0) $t='';
			
			echo "<td>$f</td>";
			echo "<td>$m</td>";
			echo "<td>$t</td>";

		}
		echo "</tr>";
	}


	echo "</table>";
	echo '<div class="clear"></div>';
	

	
	if (strlen($s)==9) reportEcd_facilitator();
	else reportEcd_facilitator_general();
*/	
}

function reportEcd_basicinfo(){
	global $link, $wc, $dist_code, $vdc_code;
	//$result = mysql_query("SELECT DISTINCT(ecd_num) FROM ecdppc_info $wc");
	//$d['Number of ECD/PPC']=mysql_num_rows($result);
	if($sch_num)
	$result = mysql_query("SELECT * FROM ecdppc_info $wc");
	$row = mysql_fetch_assoc($result);
	
        $d['ECD/PPC Estd. Year']=$row['smc_year'];
	$d['sections']=$row['sections'];
	$d['ECD/PPC Ward']=$row['ecd_ward'];
	$d['ECD/PPC Tole']=$row['ecd_tole'];
	$d['If Supported by I/NGO, I/NGO Name']=$row['ngo_name'];
	//$d['I/NGO Ward']=$row['ngo_ward'];
	//$d['I/NGO Tole']=$row['ngo_tole'];;
	
	
	$result = mysql_query("SELECT * FROM ecdppc_info $wc");
	$row = mysql_fetch_assoc($result);

	$yn = array("1"=>"Yes","2"=>"No");
	$d['separate_room']=$yn[$row['separate_room']];
	$d['separate_building']=$yn[$row['separate_building']];
	$d['adequate_space']=$yn[$row['adequate_space']];
	$d['adequate_material']=$yn[$row['adequate_material']];
	$d['adequate_classroom']=$yn[$row['adequate_classroom']];
	
?>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="4"><b>GENERAL INFORMATION (ECD/PPC)</b></td>
		</tr>
<?php		

	$count = 0;
	
	foreach ($d as $k=>$v){
		if ($count%2==0) echo "<tr>";
		
		if ($v==0) $v='';
		
		$title = ucwords(str_replace("_"," ",$k));
		$title = str_replace("Ecd","ECD",$title);
		$title = str_replace("Ngo","NGO",$title);
		
		
		echo "<td class='theader' width='25%'>$title</td>";
		echo "<td>$v</td>";
		
		if ($count%2==1) echo "</tr>";
		$count++;
	}
	
	echo "</table>";
	echo '<div class="clear"></div>';
	
}

function reportEcd_basicinfo_general(){
	global $link, $wc, $dist_code, $vdc_code,$sch_num,$sch_year;
	
        $community_based_ecd=array(1=>'<b>X</b>',2=>'✔');
        $sch_based_ecd=array(1=>'✔',2=>'<b>X</b>');
        $yn = array("1"=>"✔","2"=>"<b>X</b>");
        
        //display number in case of vdc or district reports
        if(empty($sch_num) OR empty($vdc_code))
        {
            $result = mysql_query("SELECT * FROM ecdppc_info $wc");
            $row = mysql_fetch_assoc($result);

            $d['VDC Registration']=getCount("ecdppc_info","$wc AND reg_vdc_year IS NOT NULL");
            $d['Personal Bank Account']=getCount("ecdppc_info","$wc AND priv_bnk_ac='1'");
            $d['Matching Fund']=getCount("ecdppc_info","$wc AND matching_fund='1'");
            $d['Aaya Facility']=getCount("ecdppc_info","$wc AND ecd_aaya='1'");
            $d['Run By NGO/INGO']=getCount("ecdppc_info","$wc AND ngo_name IS NOT NULL");
           
            $d['separate_room']=getCount("ecdppc_info","$wc AND separate_room='1'");
            $d['separate_building']=getCount("ecdppc_info","$wc AND separate_building='1'");
            $d['adequate_space']=getCount("ecdppc_info","$wc AND adequate_space='1'");
            $d['adequate_material']=getCount("ecdppc_info","$wc AND adequate_material='1'");
            $d['adequate_classroom']=getCount("ecdppc_info","$wc AND adequate_classroom='1'");
        }
        else
        {
            $result = mysql_query("SELECT * FROM ecdppc_info $wc");
            $row = mysql_fetch_assoc($result);
            
            $d['ECD/PPC Estd. Year']=$row['smc_year'];  
            
            //$d['ecd type']=$e[$row['ecd_type']];
            $d['ECD/PPC: Community Based']=$community_based_ecd[$row['ecd_type']];
            $d['Management Commitee formation']=$row['smc_d']."/".$row['smc_m']."/".$row['smc_y'];
            $d['ECD/PPC: School Based']=$sch_based_ecd[$row['ecd_type']];    
            $d['VDC Registration']=$row['reg_vdc_year'];
            $d['Personal Bank Account']=$yn[$row['priv_bnk_ac']];
            $d['Matching Fund']=$yn[$row['matching_fund']];
            $d['Aaya Facility']=$yn[$row['ecd_aaya']];

            if(isset($row['ngo_name']))
                $d['Run By NGO/INGO']=$row['ngo_name'];
            else
                $d['Run By NGO/INGO']=$yn['2'];
            $d['separate_room']= (int)getCount("ecdppc_info","$wc AND separate_room='1'")>0 ? '✔':'<b>X</b>';
            $d['separate_building']=(int)getCount("ecdppc_info","$wc AND separate_building='1'")>0 ? '✔':'<b>X</b>';
            $d['adequate_space']=(int)getCount("ecdppc_info","$wc AND adequate_space='1'")>0 ? '✔':'<b>X</b>';
            $d['adequate_material']=(int)getCount("ecdppc_info","$wc AND adequate_material='1'")>0 ? '✔':'<b>X</b>';
            $d['adequate_classroom']=(int)getCount("ecdppc_info","$wc AND adequate_classroom='1'")>0 ? '✔':'<b>X</b>';
        }
	

	
	
	
	
?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="4"><b>GENERAL INFORMATION (ECD/PPC)</b></td>
		</tr>
<?php		

	$count = 0;
	foreach ($d as $k=>$v){
		if ($count%2==0) echo "<tr>";
		
		if ($v=='0' OR $v=="0/0/0") $v='';
		
		$title = ucwords(str_replace("_"," ",$k));
		$title = str_replace("Ecd","ECD",$title);
		$title = str_replace("Ngo","NGO",$title);
		
		
		echo "<td class='theader' width='25%'>$title</td>";
		echo "<td>$v</td>";
		
		if ($count%2==1) echo "</tr>";
		$count++;
	}
	
	echo "</table>";
	echo '<div class="clear"></div>';
	
}

function reportEcd_facilitator(){
	global $link, $wc, $dist_code, $vdc_code;

?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="6">ECD Facilitators</td>
		</tr>
		<tr class="theader cu">
			<td>S.No.</td>
			<td>Name</td>
			<td>Sex</td>
			<td>Caste</td>
			<td>Education</td>
			<td>Training</td>
		</tr>
<?php	

	$result = mysql_query("SELECT * FROM ecd_facilitator $wc");
	$count = 1;
	
	$sex = array("1"=>"F","2"=>"M");
	$caste = array("1"=>"Dalit","2"=>"Janjati");
	
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr>";
		
		echo "<td>$count</td>";
		$count++;
		
		echo "<td>".$row['name']."</td>";
		echo "<td>".$sex[$row['sex']]."</td>";
		echo "<td>".$caste[$row['caste']]."</td>";
		
		if ($row['sex']=='1') $sx='f';
		if ($row['sex']=='2') $sx='m';
		
		if ($row['less_slc_'.$sx]) $edu = "Less than SLC";
		if ($row['slc_'.$sx]) $edu = "SLC";
		if ($row['greater_slc_'.$sx]) $edu = "Greater than SLC";
		
		if ($row['trained'.$sx]) $training = "Trained";
		if ($row['untrained'.$sx]) $training = "Untrained";
		
		echo "<td>$edu</td>";
		echo "<td>$training</td>";
		
		
		
		echo "</tr>";
	}


	echo "</table>";
	echo '<div class="clear"></div>';
}

function reportEcd_facilitator_general(){
	global $link, $wc, $dist_code, $vdc_code,$sch_num;

?>
	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="10">ECD/PPC Facilitators</td>
		</tr>
		<tr class="theader cu">
			<td rowspan='2'>
                            <?php 
                                //display number in case of vdc or district reports else the names
                                if(empty($sch_num) OR empty($vdc_code))
                                    echo "Total";
                                else
                                    echo "Facilitator Name";    
                            ?>
                        </td>
			<td colspan='2'>Sex</td>
			<td colspan='2'>Caste</td>
			<td colspan='3'>Education</td>
			<td colspan='2'>Training</td>
		</tr>
		
		<tr>
			<td>Female</td>
			<td>Male</td>
			<td>Dalit</td>
			<td>Janjati</td>
			<td>Less than SLC</td>
			<td>SLC</td>
			<td>Greater than SLC</td>
			<td>Trained</td>
			<td>Untrained</td>
		</tr>
<?php //	


        //display numbers in case of vdc or district reports
        if(empty($sch_num) OR empty($vdc_code))
        {
            echo "<tr>";
            echo "\n<td>".getCount("ecd_facilitator","$wc")."</td>"; 
            echo "\n<td>".getCount("ecd_facilitator","$wc AND sex='1'")."</td>"; // female
            echo "\n<td>".getCount("ecd_facilitator","$wc AND sex='2'")."</td>"; // male
            echo "\n<td>".getCount("ecd_facilitator","$wc AND caste='1'")."</td>"; // dalit
            echo "\n<td>".getCount("ecd_facilitator","$wc AND caste='2'")."</td>"; // janjati
            echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND less_slc_f='1'")+getCount("ecd_facilitator","$wc AND less_slc_m='1'"))."</td>"; // less than slc
            echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND slc_f='1'")+getCount("ecd_facilitator","$wc AND slc_m='1'"))."</td>"; // slc
            echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND greater_slc_f='1'")+getCount("ecd_facilitator","$wc AND greater_slc_m='1'"))."</td>"; // greater than slc
            echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND trained_f='1'")+getCount("ecd_facilitator","$wc AND trained_m='1'"))."</td>"; // trained
            echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND untrained_f='1'")+getCount("ecd_facilitator","$wc AND untrained_m='1'"))."</td>"; // untrained
            echo "</tr>";
        }
        else
        {
            $facilitators=getColumndata("ecd_facilitator", "$wc", "name,sex,caste,less_slc_f,less_slc_m,slc_f,slc_m,greater_slc_f,greater_slc_m,trained_f,trained_m,untrained_f,untrained_m");
            if($facilitators)
            {
                foreach($facilitators as $facilitator)
                {
                    echo "<tr>";
                    echo "\n<td>"; 
                    echo "<table>";
                    echo "<tr><td>".$facilitator['name']."</tr></td>";
                    echo "</table>";
                    echo "</td>"; // total
                    
                    echo "\n<td>".($facilitator['sex']==1? '✔' : '<b>X</b>')."</td>"; // female
                    echo "\n<td>".($facilitator['sex']==2? '✔' : '<b>X</b>')."</td>"; // male
                    echo "\n<td>".($facilitator['caste']==1? '✔' : '<b>X</b>')."</td>"; // dalit
                    echo "\n<td>".($facilitator['caste']==2? '✔' : '<b>X</b>')."</td>"; // janjati
                    echo "\n<td>".($facilitator['less_slc_f']==1 || $facilitator['less_slc_m']==1? '✔' : '<b>X</b>')."</td>"; // less than slc
                    echo "\n<td>".($facilitator['slc_f']==1 || $facilitator['slc_m']==1? '✔' : '<b>X</b>')."</td>"; // slc
                    echo "\n<td>".($facilitator['greater_slc_f']==1 || $facilitator['greater_slc_m']==1? '✔' : '<b>X</b>')."</td>"; // greater than slc
                    echo "\n<td>".($facilitator['trained_f']==1 || $facilitator['trained_m']==1? '✔' : '<b>X</b>')."</td>"; // trained
                    echo "\n<td>".($facilitator['untrained_f']==1 || $facilitator['untrained_m']==1? '✔' : '<b>X</b>')."</td>"; // untrained


                    echo "</tr>";
                }
            }
        }
//	echo "<tr>";
//        //display number in case of vdc or district reports
//        if(empty($sch_num) OR empty($vdc_code))
//            echo "\n<td>".getCount("ecd_facilitator","$wc")."</td>"; // male
//	else 
//        {
//            echo "\n<td>"; 
//            $facilitator_names=getColumndata("ecd_facilitator", "$wc", "name");
//            if($facilitator_names)
//            {
//                echo "<table>";
//                    foreach($facilitator_names as $facilitator)
//                        echo "<tr><td>".$facilitator."</tr></td>";
//                echo "</table>";
//            }
//            echo "</td>"; // total
//        }
//	echo "\n<td>".getCount("ecd_facilitator","$wc AND sex='1'")."</td>"; // female
//	echo "\n<td>".getCount("ecd_facilitator","$wc AND sex='2'")."</td>"; // male
//	echo "\n<td>".getCount("ecd_facilitator","$wc AND caste='1'")."</td>"; // dalit
//	echo "\n<td>".getCount("ecd_facilitator","$wc AND caste='2'")."</td>"; // janjati
//	echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND less_slc_f='1'")+getCount("ecd_facilitator","$wc AND less_slc_m='1'"))."</td>"; // less than slc
//	echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND slc_f='1'")+getCount("ecd_facilitator","$wc AND slc_m='1'"))."</td>"; // slc
//	echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND greater_slc_f='1'")+getCount("ecd_facilitator","$wc AND greater_slc_m='1'"))."</td>"; // greater than slc
//	echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND trained_f='1'")+getCount("ecd_facilitator","$wc AND trained_m='1'"))."</td>"; // trained
//	echo "\n<td>".formatDisplay(getCount("ecd_facilitator","$wc AND untrained_f='1'")+getCount("ecd_facilitator","$wc AND untrained_m='1'"))."</td>"; // untrained
//
//	
//	echo "</tr>";

	echo "</table>";
	echo '<div class="clear"></div>';
}



function reportSop(){
	global $link, $wc, $dist_code, $vdc_code, $s;
	
	if (strlen($s)==9) reportSop_basicinfo();
	

?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">SOP/FSP Enrollment</td>
		</tr>
		<tr class="theader cu">
			<td colspan="1" rowspan="2">Level</td>
			<td colspan="3">Total</td>
			<td colspan="3">Dalit</td>
			<td colspan="3">Janjati</td>
			<td colspan="3">Dropouts</td>
		</tr>
		<tr class="theader">
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
			<td>F</td><td>M</td><td>T</td>
		</tr>

<?php

	echo "<tr>";
	echo "<td class='theader'>$lv</td>";
	foreach(array("total"=>"Total","dalit"=>"Dalit","janjati"=>"Janjati","dropouts"=>"Dropouts") as $ek=>$ev){
		echo "<td>" . getSum("sopfsp_enroll_f1","tot_enroll_".$ek."_f",$wc) . "</td>";
		echo "<td>" . getSum("sopfsp_enroll_f1","tot_enroll_".$ek."_m",$wc) . "</td>";
		echo "<td>" . getSum("sopfsp_enroll_f1","tot_enroll_".$ek."_t",$wc) . "</td>";
	}
	echo "</tr>";


	echo "</table>";
	echo '<div class="clear"></div>';


?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="13">SOP/FSP Enrollment by age</td>
		</tr>
		<tr class="theader cu">
			<td>< 6</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
			<td>13</td>
			<td>14</td>
			<td>> 14</td>
		</tr>

<?php

	foreach (array("t"=>"Total","d"=>"Dalit","j"=>"Janjati") as $ek=>$ev){
		echo "<tr>";
		foreach (array("l6",6,7,8,9,10,11,12,13,14,"g14") as $ak){
			echo "<td>".getSum('sopfsp_enroll_age_f1',$ek."_".$ak,$wc)."</td>";

		}
		echo "</tr>";
	}


	echo "</table>";
	echo '<div class="clear"></div>';
	

	
	if (strlen($s)==9) reportSop_facilitator();
	else reportSop_facilitator_general();


}

function reportSop_basicinfo(){
	global $link, $wc, $dist_code, $vdc_code;
	
	$result = mysql_query("SELECT * FROM sopfsp_info_f1 $wc");
	$row = mysql_fetch_assoc($result);
	
	if ($row['start_y']!='' && $row['start_m']!='' && $row['start_d']!=''){
		$d['start_date']=$row['start_y']."-".$row['start_m']."-".$row['start_d'];
	} else 	$d['start_date']='';

	$d['start_level']=$row['start_level'];
	$d['start_time']=$row['start_time'];

	if ($row['repeat_y']!='' && $row['repeat_m']!='' && $row['repeat_d']!=''){
		$d['repeat_date']=$row['repeat_y']."-".$row['repeat_m']."-".$row['repeat_d'];
	} else 	$d['repeat_date']='';

	$d['repeat_level']=$row['repeat_level'];
	$d['repeat_time']=$row['repeat_time'];

	$d['ward']=$row['ward'];
	$d['tole']=$row['tole'];
	
	
	$sex = array("1"=>"F","2"=>"M");
	$caste = array("1"=>"Dalit","2"=>"Janjati");
	$edu = array("1"=>"Less than SLC", "2"=>"SLC","3"=>"Greater than SLC");
	$training = array("1"=>"Pre","2"=>"Second","3"=>"Third");
		
	$d['helper_name']=$row['helper_name'];
	$d['helper_add']=$row['helper_add'];
	$d['helper_sex']=$sex[$row['helper_sex']];
	$d['helper_caste']=$caste[$row['helper_caste']];
	$d['helper_edu_status']=$edu[$row['helper_edu_status']];
	$d['helper_training']=$training[$row['helper_training']];

	$d['ngo_name']=$row['ngo_name'];
	$d['ngo_add']=$row['ngo_add'];

	
?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="4">SOP/FSP Information</td>
		</tr>
<?php		

	$count = 0;
	
	foreach ($d as $k=>$v){
		if ($count%2==0) echo "<tr>";
		
		if ($v==0) $v='';
		
		$title = ucwords(str_replace("_"," ",$k));
		$title = str_replace("Ecd","ECD",$title);
		$title = str_replace("Ngo","NGO",$title);
		
		
		echo "<td class='theader'>$title</td>";
		echo "<td>$v</td>";
		
		if ($count%2==1) echo "</tr>";
		$count++;
	}
	
	echo "</table>";
	echo '<div class="clear"></div>';	
	
}

function reportSop_facilitator(){
	
	global $link, $wc, $dist_code, $vdc_code;

?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="6">SOP/FSP Facilitators</td>
		</tr>
		<tr class="theader cu">
			<td>S.No.</td>
			<td>Name</td>
			<td>Sex</td>
			<td>Caste</td>
			<td>Education</td>
			<td>Training</td>
		</tr>
<?php	

	$result = mysql_query("SELECT * FROM sopfsp_facilitator_f1 $wc");
	$count = 1;
	
	$sex = array("1"=>"F","2"=>"M");
	$caste = array("1"=>"Dalit","2"=>"Janjati");
	$edu = array("1"=>"Less than SLC", "2"=>"SLC","3"=>"Greater than SLC");
	$training = array("1"=>"Pre","2"=>"Second","3"=>"Third");
	
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr>";
		
		echo "<td>$count</td>";
		$count++;
		
		echo "<td>".$row['name']."</td>";
		echo "<td>".$sex[$row['sex']]."</td>";
		echo "<td>".$caste[$row['caste']]."</td>";
		echo "<td>".$edu[$row['education']]."</td>";
		echo "<td>".$training[$row['training']]."</td>";
		
		echo "</tr>";
	}


	echo "</table>";
	echo '<div class="clear"></div>';

}

function reportSop_facilitator_general(){
	
	global $link, $wc, $dist_code, $vdc_code;

?>

	<table border="1" width="100%">
		<tr class="theader cu">
			<td colspan="10">ECD/PPC Facilitators</td>
		</tr>
		<tr class="theader cu">
			<td rowspan='2'>Total</td>
			<td colspan='2'>Sex</td>
			<td colspan='2'>Caste</td>
			<td colspan='3'>Education</td>
			<td colspan='3'>Training</td>
		</tr>
		
		<tr>
			<td>Female</td>
			<td>Male</td>
			<td>Dalit</td>
			<td>Janjati</td>
			<td>Less than SLC</td>
			<td>SLC</td>
			<td>Greater than SLC</td>
			<td>Pre</td>
			<td>Second</td>
			<td>Third</td>
		</tr>
<?php	

	echo "<tr>";
	
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc")."</td>"; // total
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND sex='1'")."</td>"; // female
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND sex='2'")."</td>"; // male
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND caste='1'")."</td>"; // dalit
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND caste='2'")."</td>"; // janjati
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND education='1'")."</td>"; // less than slc
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND education='2'")."</td>"; // slc
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND education='3'")."</td>"; // greater than slc
	
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND training='1'")."</td>"; // pre
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND training='2'")."</td>"; // second
	echo "\n<td>".getCount("sopfsp_facilitator_f1","$wc AND training='3'")."</td>"; // third
	
	echo "</tr>";

	echo "</table>";
	echo '<div class="clear"></div>';


}

?>
