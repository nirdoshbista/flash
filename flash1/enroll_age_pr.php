<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();


$age_suffix[1]=array("_l5","_5","_6","_7","_8","_9","_g9","_t");
$age_desc[1]=array("Less than 5","5 years","6 years","7 years","8 years","9 years","More than 9","Total");

$age_suffix[2]=array("_l6","_6","_7","_8","_9","_g9","_t");
$age_desc[2]=array("Less than 6","6 years","7 years","8 years","9 years","More than 9","Total");

$age_suffix[3]=array("_l7","_7","_8","_9","_10","_g10","_t");
$age_desc[3]=array("Less than 7","7 years","8 years","9 years","10 years","More than 10","Total");

$age_suffix[4]=array("_l8","_8","_9","_10","_11","_g11","_t");
$age_desc[4]=array("Less than 8","8 years","9 years","10 years","11 years","More than 11","Total");

$age_suffix[5]=array("_l9","_9","_10","_11","_12","_g12","_t");
$age_desc[5]=array("Less than 9","9 years","10 years","11 years","12 years","More than 12","Total");

$age_suffix[0]=array("_l5","_5_9","_g9","_t");
$age_desc[0]=array("Less than 5","5-9 years","More than 9","Total");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Enrollment by Age (Primary Level)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/enroll_age_pr.js" type="text/javascript"></script>
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
  <td colspan="13">New Enrollment by Age in Class 1</td>
  </tr>
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

for ($i=1;$i<=1;$i++){
	if ($i==6) $i=0;
	for ($j=0;$j<count($age_suffix[$i]);$j++){
	

?> 
  
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>">
	<?php 
		if ($j==0){
		
	
	?>
   
	<td width="100" class="ewTableHeader" rowspan="<?php echo count($age_suffix[$i])+1; ?>"><div align="center"><br><br><br><?php echo $i?$i:"Total"; ?></div></td>
	<?php
		}
	?>
	<td><div align="center"><?php echo $age_desc[$i][$j]; ?></div></td>
	<td><input name="total_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
	<td><input name="dalit_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
	<td><input name="janjati_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_newenr_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_newenr_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_newenr_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>

  </tr>
  
<?php
}
if ($i==0) break;

if ($i>=1 && $i<=5) $result = mysql_query(sprintf('select * from enr_rep_mig_class1_5_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));
if ($i>=6 && $i<=8) $result = mysql_query(sprintf('select * from enr_rep_mig_class6_8_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));
if ($i>=9 && $i<=10) $result = mysql_query(sprintf('select * from enr_rep_mig_class9_10_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));

$r = mysql_fetch_array($result);

?>

<tr class="ewTableFooter">
<td><div align="center">Total New Enrollment</div></td>
<td><input value="<?php echo $r["tot_new_enroll_total_f"]?>" name="total_newenr_f<?php echo '['.$i.']'; ?>" type="text" id="total_newenr_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_total_m"]?>" name="total_newenr_m<?php echo '['.$i.']'; ?>" type="text" id="total_newenr_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_total_t"]?>" name="total_newenr_t<?php echo '['.$i.']'; ?>" type="text" id="total_newenr_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_dalit_f"]?>" name="dalit_newenr_f<?php echo '['.$i.']'; ?>" type="text" id="dalit_newenr_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_dalit_m"]?>" name="dalit_newenr_m<?php echo '['.$i.']'; ?>" type="text" id="dalit_newenr_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_dalit_t"]?>" name="dalit_newenr_t<?php echo '['.$i.']'; ?>" type="text" id="dalit_newenr_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_janjati_f"]?>" name="janjati_newenr_f<?php echo '['.$i.']'; ?>" type="text" id="janjati_newenr_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_janjati_m"]?>" name="janjati_newenr_m<?php echo '['.$i.']'; ?>" type="text" id="janjati_newenr_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_new_enroll_janjati_t"]?>" name="janjati_newenr_t<?php echo '['.$i.']'; ?>" type="text" id="janjati_newenr_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
</tr>

<?php

}
?>
  
  
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
  <td colspan="13">Enrollment by Age</td>
  </tr>
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

for ($i=1;$i<=5;$i++){
	if ($i==6) $i=0;
	for ($j=0;$j<count($age_suffix[$i]);$j++){
	

?> 
  
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>">
	<?php 
		if ($j==0){
		
	
	?>
   
	<td width="100" class="ewTableHeader" rowspan="<?php echo count($age_suffix[$i])+1; ?>"><div align="center"><br><br><br><?php echo $i?$i:"Total"; ?></div></td>
	<?php
		}
	?>
	<td><div align="center"><?php echo $age_desc[$i][$j]; ?></div></td>
	<td><input name="total_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="total_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
	<td><input name="dalit_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="dalit_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
	<td><input name="janjati_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_f<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_m<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" <?php if ($classes[$i]==0 || $j==count($age_suffix[$i])-1) echo 'disabled'; ?>></td>
	<td><input name="janjati_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_enroll_age_t<?php echo $age_suffix[$i][$j].'['.$i.']'; ?>" size="4" maxlength="3" disabled></td>

  </tr>
  
<?php
}
if ($i==0) break;

if ($i>=1 && $i<=5) $result = mysql_query(sprintf('select * from enr_rep_mig_class1_5_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));
if ($i>=6 && $i<=8) $result = mysql_query(sprintf('select * from enr_rep_mig_class6_8_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));
if ($i>=9 && $i<=10) $result = mysql_query(sprintf('select * from enr_rep_mig_class9_10_f1 where sch_year="%s" and sch_num="%s" and class="%s"',$currentyear,$sch_num,$i));

$r = mysql_fetch_array($result);

?>

<tr class="ewTableFooter">
<td><div align="center">Total Enrollment</div></td>
<td><input value="<?php echo $r["tot_enroll_total_f"]?>" name="total_enroll_f<?php echo '['.$i.']'; ?>" type="text" id="total_enroll_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_total_m"]?>" name="total_enroll_m<?php echo '['.$i.']'; ?>" type="text" id="total_enroll_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_total_t"]?>" name="total_enroll_t<?php echo '['.$i.']'; ?>" type="text" id="total_enroll_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_dalit_f"]?>" name="dalit_enroll_f<?php echo '['.$i.']'; ?>" type="text" id="dalit_enroll_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_dalit_m"]?>" name="dalit_enroll_m<?php echo '['.$i.']'; ?>" type="text" id="dalit_enroll_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_dalit_t"]?>" name="dalit_enroll_t<?php echo '['.$i.']'; ?>" type="text" id="dalit_enroll_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_janjati_f"]?>" name="janjati_enroll_f<?php echo '['.$i.']'; ?>" type="text" id="janjati_enroll_f<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_janjati_m"]?>" name="janjati_enroll_m<?php echo '['.$i.']'; ?>" type="text" id="janjati_enroll_m<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
<td><input value="<?php echo $r["tot_enroll_janjati_t"]?>" name="janjati_enroll_t<?php echo '['.$i.']'; ?>" type="text" id="janjati_enroll_t<?php echo '['.$i.']'; ?>" size="4" maxlength="3" disabled></td>
</tr>

<?php

}
?>
  
  
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
<?php

// new enrollment
for ($i=1;$i<=1;$i++){

	$result=mysql_query("select * from new_total_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);
	
	$result=mysql_query("select * from new_dalit_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$rd=mysql_fetch_array($result);

	$result=mysql_query("select * from new_janjati_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$rj=mysql_fetch_array($result);	
	
	for ($j=0;$j<count($age_suffix[$i])-1;$j++){

		echo "document.forms[0]['total_newenr_age_f".$age_suffix[$i][$j]."[$i]'].value='".$r['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['total_newenr_age_m".$age_suffix[$i][$j]."[$i]'].value='".$r['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['total_newenr_age_t".$age_suffix[$i][$j]."[$i]'].value='".$r['t'.$age_suffix[$i][$j]]."';\n";
	
		echo "document.forms[0]['dalit_newenr_age_f".$age_suffix[$i][$j]."[$i]'].value='".$rd['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['dalit_newenr_age_m".$age_suffix[$i][$j]."[$i]'].value='".$rd['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['dalit_newenr_age_t".$age_suffix[$i][$j]."[$i]'].value='".$rd['t'.$age_suffix[$i][$j]]."';\n";

		echo "document.forms[0]['janjati_newenr_age_f".$age_suffix[$i][$j]."[$i]'].value='".$rj['f'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['janjati_newenr_age_m".$age_suffix[$i][$j]."[$i]'].value='".$rj['m'.$age_suffix[$i][$j]]."';\n";
		echo "document.forms[0]['janjati_newenr_age_t".$age_suffix[$i][$j]."[$i]'].value='".$rj['t'.$age_suffix[$i][$j]]."';\n";


	}
	
}


for ($i=1;$i<=5;$i++){

	$result=mysql_query("select * from pr_total_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);
	
	$result=mysql_query("select * from pr_dalit_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$rd=mysql_fetch_array($result);

	$result=mysql_query("select * from pr_janjati_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
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
for ($i=1;$i<=5;$i++){
	if ($i==1){
	
		echo "handleChange(d['total_newenr_age_f".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['total_newenr_age_m".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['total_newenr_age_t".$age_suffix[$i][$j]."[$i]']);\n";

		echo "handleChange(d['dalit_newenr_age_f".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['dalit_newenr_age_m".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['dalit_newenr_age_t".$age_suffix[$i][$j]."[$i]']);\n";

		echo "handleChange(d['janjati_newenr_age_f".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['janjati_newenr_age_m".$age_suffix[$i][$j]."[$i]']);\n";
		echo "handleChange(d['janjati_newenr_age_t".$age_suffix[$i][$j]."[$i]']);\n";
	}

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
   for($class=1;$class<=5;$class++)
   {
        $agelist=array();
        if($class==1) $upperAge=8;
        else $upperAge=7;
        $lowerAge=4;
        for($count=$lowerAge;$count<=$upperAge;$count++)
        {
            if ($lowerAge==$count)
            {
                $agelist['<'.($class+$count)]='l'.($class+$count);
                $agelist['='.($class+$count)]=($class+$count);
            }
                
            else if($upperAge==$count)
            {
                $agelist['='.($class+$count)]=($class+$count);
                $agelist['>'.($class+$count)]='g'.($class+$count);
            }
            else
                $agelist['='.($class+$count)]=($class+$count);
        }
        foreach(array('3'=>'total','2'=>'janjati','1'=>'dalit') as $key1=>$value1):
            foreach(array('M'=>'m','F'=>'f') as $key2=>$value2):
                   foreach($agelist as $key3=>$value3):
                        //for new enrollment in class 1
                        if(1==$class)
                        {
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
                                    echo "document.forms[0]['{$value1}_newenr_age_{$value2}_{$value3}[{$class}]'].value='${row['count']}';\n";
                                    echo "handleChange(d['{$value1}_newenr_age_{$value2}_{$value3}[{$class}]']);\n";
                                    $row['count']=0;
                                }   
                            }
                        }
                        //for other classes
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
                                echo "handleChange(d['{$value1}_enroll_age_{$value2}_{$value3}[{$class}]']);\n";
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