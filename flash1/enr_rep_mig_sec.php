<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Enrollment, Repeatation, Migration (Secondary Level)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/enr_rep_mig_sec.js" type="text/javascript"></script>
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
    <td rowspan="3">Class</td>
    <td rowspan="3">Students</td>
    <td colspan="3" rowspan="2">Total Enrollment</td>
    <td colspan="12">Among new Enrollment,</td>
  </tr>
  <tr> 
    <td colspan="3" class="ewTableHeader">Promotion</td>
    <td colspan="3" class="ewTableHeader">Repeatation</td>
    <td colspan="3" class="ewTableHeader">New Enrollment</td>
    <td colspan="3" class="ewTableHeader">Migration</td>
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
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
  </tr>
<?php

for ($i=9;$i<=11;$i++){
	if ($i==11) $i=0;
?>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td rowspan="4"><div align="center"><?php echo $i?$i:"Total"; ?></div></td>
    <td>Dalit</td>
	<td><input name="tot_enroll_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_prom_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_rep_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_new_enroll_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_tran_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Janjati</td>
	<td><input name="tot_enroll_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_prom_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_rep_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_new_enroll_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_tran_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>

  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Others</td>
	<td><input name="tot_enroll_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_prom_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_prom_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_rep_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_rep_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_new_enroll_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_new_enroll_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_tran_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_tran_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Total</td>
	<td><input name="tot_enroll_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_f[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_enroll_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_m[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_enroll_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_prom_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_total_f[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_prom_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_total_m[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_prom_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_prom_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_rep_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_total_f[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_rep_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_total_m[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_rep_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_rep_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_new_enroll_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_total_f[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_new_enroll_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_total_m[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_new_enroll_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_new_enroll_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	
	<td><input name="tot_tran_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_total_f[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_tran_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_total_m[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_tran_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_tran_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>  
<?php
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


for ($i=9;$i<=10;$i++){

	$result=mysql_query("select * from enr_rep_mig_class9_10_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);


	echo "document.forms[0]['tot_enroll_total_f[$i]'].value='".$r['tot_enroll_total_f']."';\n";
	echo "document.forms[0]['tot_enroll_total_m[$i]'].value='".$r['tot_enroll_total_m']."';\n";
	echo "document.forms[0]['tot_enroll_total_t[$i]'].value='".$r['tot_enroll_total_t']."';\n";
	echo "document.forms[0]['tot_rep_total_f[$i]'].value='".$r['tot_rep_total_f']."';\n";
	echo "document.forms[0]['tot_rep_total_m[$i]'].value='".$r['tot_rep_total_m']."';\n";
	echo "document.forms[0]['tot_rep_total_t[$i]'].value='".$r['tot_rep_total_t']."';\n";
	echo "document.forms[0]['tot_prom_total_f[$i]'].value='".$r['tot_prom_total_f']."';\n";
	echo "document.forms[0]['tot_prom_total_m[$i]'].value='".$r['tot_prom_total_m']."';\n";
	echo "document.forms[0]['tot_prom_total_t[$i]'].value='".$r['tot_prom_total_t']."';\n";
	echo "document.forms[0]['tot_new_enroll_total_f[$i]'].value='".$r['tot_new_enroll_total_f']."';\n";
	echo "document.forms[0]['tot_new_enroll_total_m[$i]'].value='".$r['tot_new_enroll_total_m']."';\n";
	echo "document.forms[0]['tot_new_enroll_total_t[$i]'].value='".$r['tot_new_enroll_total_t']."';\n";
	echo "document.forms[0]['tot_tran_total_f[$i]'].value='".$r['tot_tran_total_f']."';\n";
	echo "document.forms[0]['tot_tran_total_m[$i]'].value='".$r['tot_tran_total_m']."';\n";
	echo "document.forms[0]['tot_tran_total_t[$i]'].value='".$r['tot_tran_total_t']."';\n";

	echo "document.forms[0]['tot_enroll_dalit_f[$i]'].value='".$r['tot_enroll_dalit_f']."';\n";
	echo "document.forms[0]['tot_enroll_dalit_m[$i]'].value='".$r['tot_enroll_dalit_m']."';\n";
	echo "document.forms[0]['tot_enroll_dalit_t[$i]'].value='".$r['tot_enroll_dalit_t']."';\n";
	echo "document.forms[0]['tot_rep_dalit_f[$i]'].value='".$r['tot_rep_dalit_f']."';\n";
	echo "document.forms[0]['tot_rep_dalit_m[$i]'].value='".$r['tot_rep_dalit_m']."';\n";
	echo "document.forms[0]['tot_rep_dalit_t[$i]'].value='".$r['tot_rep_dalit_t']."';\n";
	echo "document.forms[0]['tot_prom_dalit_f[$i]'].value='".$r['tot_prom_dalit_f']."';\n";
	echo "document.forms[0]['tot_prom_dalit_m[$i]'].value='".$r['tot_prom_dalit_m']."';\n";
	echo "document.forms[0]['tot_prom_dalit_t[$i]'].value='".$r['tot_prom_dalit_t']."';\n";
	echo "document.forms[0]['tot_new_enroll_dalit_f[$i]'].value='".$r['tot_new_enroll_dalit_f']."';\n";
	echo "document.forms[0]['tot_new_enroll_dalit_m[$i]'].value='".$r['tot_new_enroll_dalit_m']."';\n";
	echo "document.forms[0]['tot_new_enroll_dalit_t[$i]'].value='".$r['tot_new_enroll_dalit_t']."';\n";
	echo "document.forms[0]['tot_tran_dalit_f[$i]'].value='".$r['tot_tran_dalit_f']."';\n";
	echo "document.forms[0]['tot_tran_dalit_m[$i]'].value='".$r['tot_tran_dalit_m']."';\n";
	echo "document.forms[0]['tot_tran_dalit_t[$i]'].value='".$r['tot_tran_dalit_t']."';\n";

	echo "document.forms[0]['tot_enroll_janjati_f[$i]'].value='".$r['tot_enroll_janjati_f']."';\n";
	echo "document.forms[0]['tot_enroll_janjati_m[$i]'].value='".$r['tot_enroll_janjati_m']."';\n";
	echo "document.forms[0]['tot_enroll_janjati_t[$i]'].value='".$r['tot_enroll_janjati_t']."';\n";
	echo "document.forms[0]['tot_rep_janjati_f[$i]'].value='".$r['tot_rep_janjati_f']."';\n";
	echo "document.forms[0]['tot_rep_janjati_m[$i]'].value='".$r['tot_rep_janjati_m']."';\n";
	echo "document.forms[0]['tot_rep_janjati_t[$i]'].value='".$r['tot_rep_janjati_t']."';\n";
	echo "document.forms[0]['tot_prom_janjati_f[$i]'].value='".$r['tot_prom_janjati_f']."';\n";
	echo "document.forms[0]['tot_prom_janjati_m[$i]'].value='".$r['tot_prom_janjati_m']."';\n";
	echo "document.forms[0]['tot_prom_janjati_t[$i]'].value='".$r['tot_prom_janjati_t']."';\n";
	echo "document.forms[0]['tot_new_enroll_janjati_f[$i]'].value='".$r['tot_new_enroll_janjati_f']."';\n";
	echo "document.forms[0]['tot_new_enroll_janjati_m[$i]'].value='".$r['tot_new_enroll_janjati_m']."';\n";
	echo "document.forms[0]['tot_new_enroll_janjati_t[$i]'].value='".$r['tot_new_enroll_janjati_t']."';\n";
	echo "document.forms[0]['tot_tran_janjati_f[$i]'].value='".$r['tot_tran_janjati_f']."';\n";
	echo "document.forms[0]['tot_tran_janjati_m[$i]'].value='".$r['tot_tran_janjati_m']."';\n";
	echo "document.forms[0]['tot_tran_janjati_t[$i]'].value='".$r['tot_tran_janjati_t']."';\n";

	echo "document.forms[0]['tot_enroll_others_f[$i]'].value='".$r['tot_enroll_others_f']."';\n";
	echo "document.forms[0]['tot_enroll_others_m[$i]'].value='".$r['tot_enroll_others_m']."';\n";
	echo "document.forms[0]['tot_enroll_others_t[$i]'].value='".$r['tot_enroll_others_t']."';\n";
	echo "document.forms[0]['tot_rep_others_f[$i]'].value='".$r['tot_rep_others_f']."';\n";
	echo "document.forms[0]['tot_rep_others_m[$i]'].value='".$r['tot_rep_others_m']."';\n";
	echo "document.forms[0]['tot_rep_others_t[$i]'].value='".$r['tot_rep_others_t']."';\n";
	echo "document.forms[0]['tot_prom_others_f[$i]'].value='".$r['tot_prom_others_f']."';\n";
	echo "document.forms[0]['tot_prom_others_m[$i]'].value='".$r['tot_prom_others_m']."';\n";
	echo "document.forms[0]['tot_prom_others_t[$i]'].value='".$r['tot_prom_others_t']."';\n";
	echo "document.forms[0]['tot_new_enroll_others_f[$i]'].value='".$r['tot_new_enroll_others_f']."';\n";
	echo "document.forms[0]['tot_new_enroll_others_m[$i]'].value='".$r['tot_new_enroll_others_m']."';\n";
	echo "document.forms[0]['tot_new_enroll_others_t[$i]'].value='".$r['tot_new_enroll_others_t']."';\n";
	echo "document.forms[0]['tot_tran_others_f[$i]'].value='".$r['tot_tran_others_f']."';\n";
	echo "document.forms[0]['tot_tran_others_m[$i]'].value='".$r['tot_tran_others_m']."';\n";
	echo "document.forms[0]['tot_tran_others_t[$i]'].value='".$r['tot_tran_others_t']."';\n";	
	
}

//autofill
if (isset($_GET['af']))
{
         //autofill promotion,repetition,etc
        $lastyear=$currentyear-1;
        foreach(array("prom","rep","new_enroll") as $type)
        {
            for($class=9;$class<=10;$class++)
            {
                    if($classes[$class]==0) continue;
                    foreach(array(1=>"dalit",2=>"janjati",3=>"others") as $caste_no=>$caste)
                    {
                        foreach(array("F"=>"f","M"=>"m","T"=>"t") as $key=>$sex)
                        {
                                $thisyear_list=array();
                                $prom_count=$newenroll_count=$rep_count=0;
                                    
                                
                                $query="select id_students_track.reg_id as reg_id,id_students_track.class as class from id_students_track 
                                                left join id_students_main on id_students_track.reg_id=id_students_main.reg_id
                                               where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear'
                                                and (id_students_track.class='$class'";
                                //to adjust PAD
                                if($type=="prom")   $query.=" or id_students_track.class='-1')";
                                else    $query.=")";
                                
                                if($key!=="T") $query.=" and id_students_main.gender='$key'";
                                if($caste_no!==3) $query.=" and id_students_main.caste='$caste_no'";
                                else $query.=" and id_students_main.caste not in (1,2);";
                            
                                $result=mysql_query($query);
                                while ($row = mysql_fetch_assoc($result)) 
                                    array_push($thisyear_list,$row);
                   
                                 //check individually which class they were in last year
                                foreach($thisyear_list as $key=>$student)
                                {
                                    if("new_enroll"==$type) 
                                    {
                                        $query="select * from id_students_track 
                                             where reg_id='{$student['reg_id']}' and sch_num='$sch_num' and id_students_track.sch_year='$lastyear'"; 
                                        $result = mysql_query($query);
                                        //if student record is found in last year then he/she is not a new enrollment 
                                        if (!mysql_num_rows($result)) $newenroll_count++;
                                    }
                                    elseif("rep"==$type)
                                    {
                                        $lastclass=$class;
                                        $query="select * from id_students_track 
                                             where reg_id='{$student['reg_id']}' and sch_num='$sch_num' and id_students_track.sch_year='$lastyear' 
                                             and id_students_track.class='$lastclass';";
                                        $result = mysql_query($query);
                                        if (mysql_num_rows($result)) $rep_count++;
                                    }
                                    elseif("prom"==$type)
                                    {
                                        $lastclass1=$lastclass2=$class-1;
                                        $query="select * from id_students_track 
                                             where reg_id='{$student['reg_id']}' and sch_num='$sch_num' and id_students_track.sch_year='$lastyear' 
                                             and (id_students_track.class='$lastclass1' or id_students_track.class='$lastclass2')";
                                        $result = mysql_query($query);
                                        if (mysql_num_rows($result)) $prom_count++;
                                    }
                                }
                                
                                if($newenroll_count>0 AND "new_enroll"==$type)  
                                    echo "document.forms[0]['tot_${type}_${caste}_${sex}[$class]'].value = '$newenroll_count';\n";
                                if($prom_count>0 AND "prom"==$type)  
                                    echo "document.forms[0]['tot_${type}_${caste}_${sex}[$class]'].value = '$prom_count';\n";
                                if($rep_count>0 AND "rep"==$type)  
                                    echo "document.forms[0]['tot_${type}_${caste}_${sex}[$class]'].value = '$rep_count';\n";
                                    
                                  
                        }
                    }
                }
        }
        
        //now add everything up to get the total enrollment
        foreach(array(1=>"dalit",2=>"janjati",3=>"others") as $caste_no=>$caste):
            foreach(array('M'=>'m','F'=>'f') as $key=>$sex):
                   for($class=9;$class<=10;$class++):
                       echo "prom_total= parseInt(document.forms[0]['tot_prom_${caste}_${sex}[$class]'].value)>0? parseInt(document.forms[0]['tot_prom_${caste}_${sex}[$class]'].value):0;\n";
                       echo "rep_total= parseInt(document.forms[0]['tot_rep_${caste}_${sex}[$class]'].value)>0? parseInt(document.forms[0]['tot_rep_${caste}_${sex}[$class]'].value):0;\n";
                       echo "newenroll_total= parseInt(document.forms[0]['tot_new_enroll_${caste}_${sex}[$class]'].value)>0? parseInt(document.forms[0]['tot_new_enroll_${caste}_${sex}[$class]'].value):0;\n";
                       echo "total_enroll= prom_total + rep_total + newenroll_total;\n";    
                       //now display the total enrollment in the class    
                       echo "document.forms[0]['tot_enroll_${caste}_${sex}[$class]'].value =total_enroll>0? total_enroll:'';\n";  
                     
                   endfor;
            endforeach;
        endforeach;
}
for($j=0;$j<6;$j++):
    for ($i=0;$i<45;++$i){
        if ($i%3!=2) echo "handleChange(document.forms[0].elements[".($j*45+$i)."]);\n";
    }
endfor;

?>
validate=true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
