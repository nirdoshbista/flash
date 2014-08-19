<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();


$age_suffix[11]=array("_l15","_15","_15_16","_g16","_t");
$age_desc[11]=array("Less than 15","15 years","16 years","More than 16","Total");

$age_suffix[12]=array("_l16","_16","_g16","_t");
$age_desc[12]=array("Less than 16","16 years","More than 16","Total");

$age_suffix[0]=array("_l15","_15_16","_g16","_t");
$age_desc[0]=array("Less than 15","15-16 years","More than 16","Total");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - H.Sec. Enrollment by Age</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/hsec_age.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center"><img src="../images/flash1.png"></div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
	<td rowspan="2">Class</td>
	<td rowspan="2">Age</td>
	<td colspan="3">Total</td>
	<td colspan="3">Dalit</td>
	<td colspan="3">Janjati</td>
  </tr>
  <tr> 
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>

  </tr>

<?php

for ($i=11;$i<=12;$i++){
	if ($i==13) $i=0;
	for ($j=0;$j<count($age_suffix[$i]);$j++){
	

?> 
  
  <tr class="<?php echo $i%2?'ewTableRow':'ewTableAltRow'; ?>">
	<?php 
		if ($j==0){
		
	
	?>
   
	<td width="100" class="ewTableHeader" rowspan="<?php echo count($age_suffix[$i]); ?>"><div align="center"><br><br><br><?php echo $i?$i:"Total"; ?></div></td>
	<?php
		}
	?>
	<td><div align="center"><?php echo $age_desc[$i][$j]; ?></div></td>
	<td><input name="total_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" disabled></td>
	<td><input name="dalit_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" disabled></td>
	<td><input name="janjati_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="3" maxlength="3" disabled></td>

  </tr>
  
<?php
}
if ($i==0) break;
}
?>
  
  
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>

<script>
<?php

for ($i=11;$i<=12;$i++){

	$result=mysql_query("select * from hsec_total_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);
	
	$result=mysql_query("select * from hsec_dalit_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$rd=mysql_fetch_array($result);

	$result=mysql_query("select * from hsec_janjati_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$rj=mysql_fetch_array($result);	
	
	for ($j=0;$j<count($age_suffix[$i])-1;$j++){

		echo "document.forms[0]['total_enroll_age_f".$age_suffix[$i][$j]."[$i]'].value='".$r['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['total_enroll_age_m".$age_suffix[$i][$j]."[$i]'].value='".$r['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['total_enroll_age_t".$age_suffix[$i][$j]."[$i]'].value='".$r['t'.$age_suffix[$i][$j]]."';\n";
	
		echo "document.forms[0]['dalit_enroll_age_f".$age_suffix[$i][$j]."[$i]'].value='".$rd['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['dalit_enroll_age_m".$age_suffix[$i][$j]."[$i]'].value='".$rd['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['dalit_enroll_age_t".$age_suffix[$i][$j]."[$i]'].value='".$rd['t'.$age_suffix[$i][$j]]."';\n";

		echo "document.forms[0]['janjati_enroll_age_f".$age_suffix[$i][$j]."[$i]'].value='".$rj['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['janjati_enroll_age_m".$age_suffix[$i][$j]."[$i]'].value='".$rj['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['janjati_enroll_age_t".$age_suffix[$i][$j]."[$i]'].value='".$rj['t'.$age_suffix[$i][$j]]."';\n";


	}
	
}
?>
var d=document.forms[0].elements;
<?php
$j=0;
for ($i=11;$i<=12;$i++){
	echo "handleChange(d['total_enroll_age_f".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['total_enroll_age_m".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['total_enroll_age_t".$age_suffix[$i][$j]."[$i]']);\n";

	echo "handleChange(d['dalit_enroll_age_f".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['dalit_enroll_age_m".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['dalit_enroll_age_t".$age_suffix[$i][$j]."[$i]']);\n";

	echo "handleChange(d['janjati_enroll_age_f".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['janjati_enroll_age_m".$age_suffix[$i][$j]."[$i]']);\n";
	echo "handleChange(d['janjati_enroll_age_t".$age_suffix[$i][$j]."[$i]']);\n";

}

if (isset($_GET['af']))
{
   //agewise autofill
   $currentEng=$currentyear-57;
   for($class=11;$class<=12;$class++)
   {
        $agelist=array();
        $lowerAge=4;
        if($class==12) $upperAge=$lowerAge;
        else $upperAge=5;
        for($count=$lowerAge;$count<=$upperAge;$count++)
        {
            if ($lowerAge==$count)
            {
                $agelist['<'.($class+$count)]='l'.($class+$count);
                $agelist['='.($class+$count)]=($class+$count);
            }
                
            if($upperAge==$count)
            {
                if(($class+$count)==16 AND $class==11)
                    $agelist['='.($class+$count)]=($class+$count-1)."_".($class+$count);
                else
                    $agelist['='.($class+$count)]=($class+$count);
                $agelist['>'.($class+$count)]='g'.($class+$count);
            }
            else
            {
                $agelist['='.($class+$count)]=($class+$count);
            }   
        }
        foreach(array('3'=>'total','2'=>'janjati','1'=>'dalit') as $key1=>$value1):
            foreach(array('M'=>'m','F'=>'f') as $key2=>$value2):
                   foreach($agelist as $key3=>$value3):
                        $query="select count(*) as count from id_students_main 
                                left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                                where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                                and ({$currentEng}-YEAR(STR_TO_DATE(id_students_main.dob,'%d/%m/%Y'))){$key3} and id_students_track.class={$class}
                              and id_students_main.gender='$key2'";
                        if($key1!='3')
                            $query.= " and id_students_main.caste='$key1'";
                        $result = mysql_query($query);
                        if (mysql_num_rows($result)>0)
                        {   
                            $row = mysql_fetch_array($result);
                            if($row['count'])
                            {
                                echo "document.forms[0]['{$value1}_enroll_age_{$value2}_{$value3}[{$class}]'].value='${row['count']}';\n";
                                echo "handleChange(document.forms[0]['{$value1}_enroll_age_{$value2}_{$value3}[{$class}]']);\n";    
                                $row['count']=0;
                            }   
                        }
                    endforeach;
            endforeach;
        endforeach;
   }
}

?>
validate = true;

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
