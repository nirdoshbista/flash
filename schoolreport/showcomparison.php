<?php

$nbuffer = array();

function getFemaleMaleRatio($female, $male){
	for($x=$male;$x>1;$x--) {
		if(($female%$x)==0 && ($male% $x)==0) {
			$female= $female/$x;
			$male = $male/$x;
		}
	}
	 $sch_fem_mal=" " . $female . ':' . $male;
	 return $sch_fem_mal;
}

function showcomparison	 (){
	global $sch_num, $wc, $nbuffer, $currentyear;
	
	$result=mysql_query("select * from mast_schoollist where sch_num=$sch_num;");
	$ginfo=mysql_fetch_array($result);
	
	$result=mysql_query(sprintf('select * from mast_district where dist_code=%s;',$ginfo['dist_code']));
	$temp=mysql_fetch_array($result);
	$districtname=$temp['dist_name'];
	
	$result=mysql_query(sprintf('select * from mast_vdc where dist_code=%s and vdc_code=%s;',$ginfo['dist_code'],$ginfo['vdc_code']));
	$temp=mysql_fetch_array($result);
	$vdcname=$temp['vdc_name_e'];
	
	$result=mysql_query("select * from mast_school_type where sch_num='$sch_num' and sch_year='$currentyear' ");
	$schooltype=mysql_fetch_array($result);
	
	$result=mysql_query("select reg_id from id_students_main where sch_num='$sch_num' and gender= 'F' ");
	$female_sch= mysql_num_rows($result);
	
	$result=mysql_query("select reg_id from id_students_main where sch_num='$sch_num' and gender= 'M' ");
	$male_sch= mysql_num_rows($result);
	$vdc_num = substr($sch_num, 0, 5);
	$vdc_num_sql = $vdc_num . "%";
	
	$result=mysql_query("select reg_id from id_students_main where sch_num like '$vdc_num_sql' and gender= 'M' ");
	$male_vdc= mysql_num_rows($result);
	
	$result=mysql_query("select reg_id from id_students_main where sch_num like '$vdc_num_sql' and gender= 'F' ");
	$female_vdc= mysql_num_rows($result);
	//echo "sch-num: " . $sch_num;
	//echo " male: " . $male_sch;
	//echo " female: " . $female_sch;
	//to calculate the ratio of boys and girls in a school
	// $male_sch = 35;
	// $female_sch = 0;
	// for($x=$male_sch;$x>1;$x--) {
		// if(($female_sch%$x)==0 && ($male_sch % $x)==0) {
			// $female_sch = $female_sch/$x;
			// $male_sch = $male_sch/$x;
		// }
	// }
	 // $sch_fem_mal=" " . $female_sch . ':' . $male_sch;
	 $fe_male_ratio_school= getFemaleMaleRatio($female_sch,$male_sch);
	 $fe_male_ratio_vdc= getFemaleMaleRatio($female_vdc,$male_vdc);
	 
	if ($schooltype['ecd']) $ecd=1; else $ecd=0;
	if ($schooltype['class1'])  $primary=1; else $primary=0;
	if ($schooltype['class6']) $lsec=1; else $lsec=0;
	if ($schooltype['class9']) $sec=1; else $sec=0;
	if ($schooltype['class11']) $hsec=1; else $hsec=0;
	
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
	
?>
<table align="center" border="2" style="border-collapse:none" cellpadding="10" width="100%">
<tr><td>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="center" valign="middle"> 
<td width="100" align="left"><img src="images/npflag.png" width="74" height="90"></td>
<td><h1 style="font-size:x-large">School Profile (<?php echo $currentyear; ?>)</h1>
<h2 style="font-size:large">School: <?php echo $ginfo['nm_sch'].'<br><br> Code:  ' .$ginfo['sch_num'].''; ?></h2>
</td>
<td width="100" align="right"><img src="images/Nepal_gov_logo.png" width="108" height="90"></td>
</table>
<p>&nbsp;</p>

<TABLE  width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0 ALIGN="CENTER">
	<COL WIDTH=79*>
	<COL WIDTH=3*>
	<COL WIDTH=174*>
	<TR VALIGN=TOP>
	<TD WIDTH=32% align="center">
	<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0 >
		<COL WIDTH=78*>
		<COL WIDTH=178*>
		<tr><td colspan="4"><strong>School To VDC Comparison</strong></td></tr>
		<TR VALIGN=TOP>
			<TD WIDTH=35% BGCOLOR="#e6e6e6">
			</TD>
			<TD WIDTH=20% BGCOLOR="#e6e6e6">
			<B>School </B>
			</TD>
			<TD WIDTH=20% BGCOLOR="#e6e6e6">
			<B>VDC</B>
			</TD>
			<TD WIDTH=20% BGCOLOR="#e6e6e6">
			<B>Remarks</B>
			</TD>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH="35%" style="text-align:left">
			<B>Boys To Girls</B>
			</TD>
			<TD  style="text-align:center">
			<B><?php  echo  $fe_male_ratio_school; ?> </B>
			</TD>
			<TD  style="text-align:center">
			<B><?php  echo  $fe_male_ratio_vdc; ?></B>
			</TD>
			<TD  style="text-align:center">
			<B><?php if ($female_sch >= $female_vdc) echo "<img src=\"images/tick.gif\">" ?></B>
			</TD>
		</TR>
	</TABLE>
		<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">


		</TD>
		<TD WIDTH=1%>


		</TD>
		</table>
</table>

<?php

	global $link;
	
	$result = mysql_query("SELECT id, description FROM photos_f1 WHERE sch_num='$sch_num'");
	if (@mysql_num_rows($result)>0){
		while ($row = mysql_fetch_assoc($result)){
			echo "<div class='photo'>";
			echo "<img src='../flash1/photo.php?get&id={$row['id']}' height='240' width='320' title='{$row['description']}' />";
			echo "<br>",$row['description'];
			echo "</div>";
		}
		echo "<div style='clear:both;'></div>";
	}		
	
}

function ds($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer;
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wc";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function sumoflast($n){
	global $nbuffer;
	$sum = 0;
	$c = count($nbuffer);
	
	for ($i=1;$i<=$n;$i++){
		$sum += $nbuffer[$c-$i];
	}
	$nbuffer[]=$sum;
	echo $sum;
	return $sum;
}

function ync($o){  // yes no convert
	if ($o==0) echo '&nbsp;';
	if ($o==1) echo 'Yes';
	if ($o==2) echo 'No';
	if ($o>=3) echo 'Yes';

}

function dac($table, $c, $f){
	global $link, $sch_num, $currentyear;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	$result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c' and sch_year='$currentyear'");

	$row=mysql_fetch_array($result);
	
	$sum=0;
	for ($i=0;$i<mysql_num_fields($result);$i++){
		if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;

		if (eregi($f, mysql_field_name($result, $i))) {
			$sum+=$row[mysql_field_name($result, $i)];
		}
	}
	
	return ($sum>0?$sum:'');
}

function dacgs($table, $c, $f){
	global $link, $sch_num, $currentyear;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	if ($c!='') $result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c' and sch_year='$currentyear'");
	else $result=mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear'");
	
	$grandtotal = 0;
	while ($row=mysql_fetch_array($result)){
		$sum=0;
		for ($i=0;$i<mysql_num_fields($result);$i++){
			if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;
	
			if (eregi($f, mysql_field_name($result, $i))) {
				$sum+=$row[mysql_field_name($result, $i)];
			}
		}
		$grandtotal += $sum;
	}

	return ($grandtotal>0?$grandtotal:'');
}

function dp($a,$b){ // divide and print
	if ($b==0) echo '-';
	else{
		printf("%.0f",$a/$b);
	}
}

function dsv($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcv = " sch_num like '".substr($sch_num,0,5)."%' and sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	$query = "select sum($field) as s from $table where $wcv";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function dsd($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcd = " sch_num like '".substr($sch_num,0,2)."%' and sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcd";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function dsn($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcn = " sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcn";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function printifgz($v){
	echo ($v>0?$v:'');
}

?>

