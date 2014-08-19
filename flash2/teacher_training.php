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
<title>Flash II - Teacher Training</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/teacher_training.js" type="text/javascript"></script>
<script>
    function disable() {
        for(var i=0; i<document.forms[0].length;i++) 
        {
            if(document.forms[0].elements[i].name.indexOf('non_teaching')==-1)
            document.forms[0].elements[i].disabled = true;
        }
    }
</script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash2.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">
<?php
if ($classes[1]!=0){
?>
<p align="center" class="ewGroupName">Primary Teacher Training</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td width="25%" rowspan="2">Training Details</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
    <td colspan="3">TPD Training in 2069</td>
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
  </tr>
  <tr> 
    <td>Fully Trained</td>
	<td><input name="pri_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_fully_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD I</td>
	<td><input name="pri_tpd1_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd1_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd1_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_tpd1_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd1_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd1_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>TPD II</td>
	<td><input name="pri_tpd2_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd2_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd2_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_tpd2_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd2_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd2_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD III</td>
	<td><input name="pri_tpd3_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd3_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_tpd3_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_tpd3_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="pri_tpd3_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_tpd3_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>Untrained</td>
	<td><input name="pri_untrained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_untrained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_untrained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_untrained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_current_f" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_current_m" size="4" maxlength="3"></td>
	<td><input name="pri_untrained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_untrained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>Total</td>
	<td><input name="pri_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_total_f" size="4" maxlength="3" disabled></td>
	<td><input name="pri_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_total_m" size="4" maxlength="3" disabled></td>
	<td><input name="pri_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_dalit_f" size="4" maxlength="3" disabled></td>
	<td><input name="pri_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_dalit_m" size="4" maxlength="3" disabled></td>
	<td><input name="pri_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_janjati_f" size="4" maxlength="3" disabled></td>
	<td><input name="pri_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_janjati_m" size="4" maxlength="3" disabled></td>
	<td><input name="pri_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="pri_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_current_f" size="4" maxlength="3" disabled></td>
	<td><input name="pri_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_current_m" size="4" maxlength="3" disabled></td>
	<td><input name="pri_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_current_t" size="4" maxlength="3" disabled></td>
  </tr>
</table>
<?php
}
?>
<?php
if ($classes[6]!=0){
?>
<p align="center" class="ewGroupName">Lower Secondary Teacher Training</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td width="25%" rowspan="2">Training Details</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
    <td colspan="3">TPD Training in 2069</td>
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
  </tr>
  <tr> 
    <td>Fully Trained</td>
	<td><input name="lsec_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_fully_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD I</td>
	<td><input name="lsec_tpd1_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd1_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd1_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_tpd1_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd1_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd1_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD II</td>
	<td><input name="lsec_tpd2_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd2_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd2_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_tpd2_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd2_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd2_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD III</td>
	<td><input name="lsec_tpd3_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd3_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_tpd3_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_tpd3_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="lsec_tpd3_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_tpd3_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>  
  <tr>
    <td>Untrained</td>
	<td><input name="lsec_untrained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_untrained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_untrained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_untrained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_current_f" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_current_m" size="4" maxlength="3"></td>
	<td><input name="lsec_untrained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_untrained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>Total</td>
	<td><input name="lsec_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_total_f" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_total_m" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_dalit_f" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_dalit_m" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_janjati_f" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_janjati_m" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="lsec_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_current_f" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_current_m" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_current_t" size="4" maxlength="3" disabled></td>
  </tr>  
</table>
<?php
}
?>
<?php
if ($classes[9]!=0){
?>
<p align="center" class="ewGroupName">Secondary Teacher Training</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td width="25%" rowspan="2">Training Details</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
    <td colspan="3">TPD Training in 2069</td>
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
  </tr>
  <tr> 
    <td>Fully Trained</td>
	<td><input name="sec_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="sec_fully_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD I</td>
	<td><input name="sec_tpd1_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd1_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd1_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_janjati_t" size="4" maxlength="3" disabled></td>
 	<td><input name="sec_tpd1_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd1_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd1_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>TPD II</td>
	<td><input name="sec_tpd2_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd2_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd2_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="sec_tpd2_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd2_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd2_trained_current_t" size="4" maxlength="3" disabled></td>
  
  </tr>
  <tr>
    <td>TPD III</td>
	<td><input name="sec_tpd3_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd3_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_tpd3_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="sec_tpd3_trained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_current_f" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_current_m" size="4" maxlength="3"></td>
	<td><input name="sec_tpd3_trained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_tpd3_trained_current_t" size="4" maxlength="3" disabled></td>
  </tr>  
  <tr>
    <td>Untrained</td>
	<td><input name="sec_untrained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_untrained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_untrained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="sec_untrained_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_current_f" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_current_m" size="4" maxlength="3"></td>
	<td><input name="sec_untrained_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_untrained_current_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>Total</td>
	<td><input name="sec_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_total_f" size="4" maxlength="3" disabled></td>
	<td><input name="sec_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_total_m" size="4" maxlength="3" disabled></td>
	<td><input name="sec_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_dalit_f" size="4" maxlength="3" disabled></td>
	<td><input name="sec_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_dalit_m" size="4" maxlength="3" disabled></td>
	<td><input name="sec_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_janjati_f" size="4" maxlength="3" disabled></td>
	<td><input name="sec_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_janjati_m" size="4" maxlength="3" disabled></td>
	<td><input name="sec_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_janjati_t" size="4" maxlength="3" disabled></td>
        <td><input name="sec_current_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_current_f" size="4" maxlength="3" disabled></td>
	<td><input name="sec_current_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_current_m" size="4" maxlength="3" disabled></td>
	<td><input name="sec_current_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_current_t" size="4" maxlength="3" disabled></td>
  
  </tr>  
</table>
<?php
}
?>

<?php
if ($classes[11]!=0){
?>
<p align="center" class="ewGroupName">Higher Secondary Teacher Training</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td width="25%" rowspan="2">Training Details</td>
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
  <tr> 
    <td>Fully Trained</td>
    <td><input name="hsec_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_total_f" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_total_m" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_total_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_dalit_f" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_dalit_m" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_dalit_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_janjati_f" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_janjati_m" size="3" maxlength="3"></td>
    <td><input name="hsec_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_fully_trained_janjati_t" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Untrained</td>
    <td><input name="hsec_untrained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_total_f" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_total_m" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_total_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_untrained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_dalit_f" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_dalit_m" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_dalit_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_untrained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_janjati_f" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_janjati_m" size="3" maxlength="3"></td>
    <td><input name="hsec_untrained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_untrained_janjati_t" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Total</td>
    <td><input name="hsec_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t" size="3" maxlength="3" disabled></td>
  </tr>
</table>


<?php
}
?>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="ewTable">
	<tr class="ewTableHeader"> 
	  <td colspan="4">Non Teaching Staff</td>
	</tr>
	<tr class="ewTableHeader"> 
	  <td>Staffs</td>
	  <td>F</td>
	  <td>M</td>
	  <td>T</td>
	</tr>
	<tr> 
	  <td>Accountants</td>
	  <td><input name="non_teaching_account_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_account_f" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_account_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_account_m" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_account_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_account_t" size="4" maxlength="3" disabled></td>
	</tr>
	<tr> 
	  <td>Administrators</td>
	  <td><input name="non_teaching_admin_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_admin_f" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_admin_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_admin_m" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_admin_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_admin_t" size="4" maxlength="3" disabled></td>
	</tr>
	<tr> 
	  <td>others</td>
	  <td><input name="non_teaching_other_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_other_f" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_other_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_other_m" size="4" maxlength="3"></td>
	  <td><input name="non_teaching_other_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="non_teaching_other_t" size="4" maxlength="3" disabled></td>
	</tr>
</table>


</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d = document.forms[0];

//to disble all elements except non teaching staff
disable();
<?php

if ($classes[1]!=0){
	$result=mysql_query("select * from pri_teacher_training where sch_num='$sch_num' and sch_year='$currentyear'");
	
	if (mysql_num_rows($result)>0){
		
		$r=mysql_fetch_array($result);	
		
		echo "document.forms[0].elements['pri_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_current_f'].value='".$r['fully_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_current_m'].value='".$r['fully_trained_currentyear_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_current_t'].value='".$r['fully_trained_currentyear_t']."';\n";
		
                echo "document.forms[0].elements['pri_tpd1_trained_total_f'].value='".$r['tpd1_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_total_m'].value='".$r['tpd1_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_total_t'].value='".$r['tpd1_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_dalit_f'].value='".$r['tpd1_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_dalit_m'].value='".$r['tpd1_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_dalit_t'].value='".$r['tpd1_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_janjati_f'].value='".$r['tpd1_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_janjati_m'].value='".$r['tpd1_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_janjati_t'].value='".$r['tpd1_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_current_f'].value='".$r['tpd1_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_current_m'].value='".$r['tpd1_trained_currentyear_m']."';\n";
		echo "document.forms[0].elements['pri_tpd1_trained_current_t'].value='".$r['tpd1_trained_currentyear_t']."';\n";
		
                echo "document.forms[0].elements['pri_tpd2_trained_total_f'].value='".$r['tpd2_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_total_m'].value='".$r['tpd2_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_total_t'].value='".$r['tpd2_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_dalit_f'].value='".$r['tpd2_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_dalit_m'].value='".$r['tpd2_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_dalit_t'].value='".$r['tpd2_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_janjati_f'].value='".$r['tpd2_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_janjati_m'].value='".$r['tpd2_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_janjati_t'].value='".$r['tpd2_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_current_f'].value='".$r['tpd2_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_current_m'].value='".$r['tpd2_trained_currentyear_m']."';\n";
		echo "document.forms[0].elements['pri_tpd2_trained_current_t'].value='".$r['tpd2_trained_currentyear_t']."';\n";
		 
                
                echo "document.forms[0].elements['pri_tpd3_trained_total_f'].value='".$r['tpd3_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_total_m'].value='".$r['tpd3_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_total_t'].value='".$r['tpd3_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_dalit_f'].value='".$r['tpd3_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_dalit_m'].value='".$r['tpd3_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_dalit_t'].value='".$r['tpd3_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_janjati_f'].value='".$r['tpd3_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_janjati_m'].value='".$r['tpd3_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_janjati_t'].value='".$r['tpd3_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_current_f'].value='".$r['tpd3_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_current_m'].value='".$r['tpd3_trained_currentyear_m']."';\n";
		echo "document.forms[0].elements['pri_tpd3_trained_current_t'].value='".$r['tpd3_trained_currentyear_t']."';\n";
              
		echo "document.forms[0].elements['pri_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";
                echo "document.forms[0].elements['pri_untrained_current_f'].value='".$r['untrained_currentyear_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_current_m'].value='".$r['untrained_currentyear_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_current_t'].value='".$r['untrained_currentyear_t']."';\n";
		
	}
}   

if ($classes[6]!=0){	
	$result=mysql_query("select * from lsec_teacher_training where sch_num='$sch_num' and sch_year='$currentyear'");

	if (mysql_num_rows($result)>0){
	
		$r=mysql_fetch_array($result);	
	
		echo "document.forms[0].elements['lsec_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['lsec_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_current_f'].value='".$r['fully_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_current_m'].value='".$r['fully_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['lsec_fully_trained_current_t'].value='".$r['fully_trained_currentyear_t']."';\n";
		
                
		echo "document.forms[0].elements['lsec_tpd1_trained_total_f'].value='".$r['tpd1_trained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_total_m'].value='".$r['tpd1_trained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_total_t'].value='".$r['tpd1_trained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_dalit_f'].value='".$r['tpd1_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_dalit_m'].value='".$r['tpd1_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_dalit_t'].value='".$r['tpd1_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_janjati_f'].value='".$r['tpd1_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_janjati_m'].value='".$r['tpd1_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd1_trained_janjati_t'].value='".$r['tpd1_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_current_f'].value='".$r['tpd1_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd1_trained_current_m'].value='".$r['tpd1_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd1_trained_current_t'].value='".$r['tpd1_trained_currentyear_t']."';\n";
		
                
                echo "document.forms[0].elements['lsec_tpd2_trained_total_f'].value='".$r['tpd2_trained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_total_m'].value='".$r['tpd2_trained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_total_t'].value='".$r['tpd2_trained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_dalit_f'].value='".$r['tpd2_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_dalit_m'].value='".$r['tpd2_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_dalit_t'].value='".$r['tpd2_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_janjati_f'].value='".$r['tpd2_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_janjati_m'].value='".$r['tpd2_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd2_trained_janjati_t'].value='".$r['tpd2_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_current_f'].value='".$r['tpd2_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd2_trained_current_m'].value='".$r['tpd2_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd2_trained_current_t'].value='".$r['tpd2_trained_currentyear_t']."';\n";
		
                
                echo "document.forms[0].elements['lsec_tpd3_trained_total_f'].value='".$r['tpd3_trained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_total_m'].value='".$r['tpd3_trained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_total_t'].value='".$r['tpd3_trained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_dalit_f'].value='".$r['tpd3_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_dalit_m'].value='".$r['tpd3_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_dalit_t'].value='".$r['tpd3_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_janjati_f'].value='".$r['tpd3_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_janjati_m'].value='".$r['tpd3_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd3_trained_janjati_t'].value='".$r['tpd3_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_current_f'].value='".$r['tpd3_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['lsec_tpd3_trained_current_m'].value='".$r['tpd3_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['lsec_tpd3_trained_current_t'].value='".$r['tpd3_trained_currentyear_t']."';\n";
		  
                echo "document.forms[0].elements['lsec_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";
                echo "document.forms[0].elements['lsec_untrained_current_f'].value='".$r['untrained_currentyear_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_current_m'].value='".$r['untrained_currentyear_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_current_t'].value='".$r['untrained_currentyear_t']."';\n";
	}
}

if ($classes[9]!=0){

	$result=mysql_query("select * from sec_teacher_training where sch_num='$sch_num' and sch_year='$currentyear'");

	if (mysql_num_rows($result)>0){

		$r=mysql_fetch_array($result);	
	
		echo "document.forms[0].elements['sec_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['sec_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_current_f'].value='".$r['fully_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_current_m'].value='".$r['fully_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['sec_fully_trained_current_t'].value='".$r['fully_trained_currentyear_t']."';\n";
		
                
		echo "document.forms[0].elements['sec_tpd1_trained_total_f'].value='".$r['tpd1_trained_total_f']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_total_m'].value='".$r['tpd1_trained_total_m']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_total_t'].value='".$r['tpd1_trained_total_t']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_dalit_f'].value='".$r['tpd1_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_dalit_m'].value='".$r['tpd1_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_dalit_t'].value='".$r['tpd1_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_janjati_f'].value='".$r['tpd1_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_janjati_m'].value='".$r['tpd1_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['sec_tpd1_trained_janjati_t'].value='".$r['tpd1_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_current_f'].value='".$r['tpd1_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['sec_tpd1_trained_current_m'].value='".$r['tpd1_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['sec_tpd1_trained_current_t'].value='".$r['tpd1_trained_currentyear_t']."';\n";
		
                
                echo "document.forms[0].elements['sec_tpd2_trained_total_f'].value='".$r['tpd2_trained_total_f']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_total_m'].value='".$r['tpd2_trained_total_m']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_total_t'].value='".$r['tpd2_trained_total_t']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_dalit_f'].value='".$r['tpd2_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_dalit_m'].value='".$r['tpd2_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_dalit_t'].value='".$r['tpd2_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_janjati_f'].value='".$r['tpd2_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_janjati_m'].value='".$r['tpd2_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['sec_tpd2_trained_janjati_t'].value='".$r['tpd2_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_current_f'].value='".$r['tpd2_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['sec_tpd2_trained_current_m'].value='".$r['tpd2_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['sec_tpd2_trained_current_t'].value='".$r['tpd2_trained_currentyear_t']."';\n";
		
                
                echo "document.forms[0].elements['sec_tpd3_trained_total_f'].value='".$r['tpd3_trained_total_f']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_total_m'].value='".$r['tpd3_trained_total_m']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_total_t'].value='".$r['tpd3_trained_total_t']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_dalit_f'].value='".$r['tpd3_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_dalit_m'].value='".$r['tpd3_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_dalit_t'].value='".$r['tpd3_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_janjati_f'].value='".$r['tpd3_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_janjati_m'].value='".$r['tpd3_trained_janjati_m']."';\n";
                echo "document.forms[0].elements['sec_tpd3_trained_janjati_t'].value='".$r['tpd3_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_current_f'].value='".$r['tpd3_trained_currentyear_f']."';\n";
		echo "document.forms[0].elements['sec_tpd3_trained_current_m'].value='".$r['tpd3_trained_currentyear_m']."';\n";
                echo "document.forms[0].elements['sec_tpd3_trained_current_t'].value='".$r['tpd3_trained_currentyear_t']."';\n";
		
                echo "document.forms[0].elements['sec_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
                echo "document.forms[0].elements['sec_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";
                echo "document.forms[0].elements['sec_untrained_current_f'].value='".$r['untrained_currentyear_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_current_m'].value='".$r['untrained_currentyear_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_current_t'].value='".$r['untrained_currentyear_t']."';\n";
	}
}


$result=mysql_query("select * from hsec_teacher_training where sch_num='$sch_num' and sch_year='$currentyear'");

if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "d['hsec_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
	echo "d['hsec_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
	echo "d['hsec_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
	echo "d['hsec_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
	echo "d['hsec_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
	echo "d['hsec_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
	echo "d['hsec_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
	echo "d['hsec_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
	echo "d['hsec_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
	echo "d['hsec_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
	echo "d['hsec_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
	echo "d['hsec_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
	echo "d['hsec_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
	echo "d['hsec_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
	echo "d['hsec_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
	echo "d['hsec_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
	echo "d['hsec_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
	echo "d['hsec_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";
}

// non teaching
$result=mysql_query("select * from non_teaching_staff where sch_num='$sch_num' and sch_year='$currentyear'");
if (isset($_GET['af'])) $result=mysql_query("select * from non_teaching_staff where sch_num='$sch_num' and sch_year='".($currentyear-1)."'");

if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);
	if($r['account_f']!=0)
            echo "document.forms[0].elements['non_teaching_account_f'].value='".$r['account_f']."';\n";
	if($r['account_m']!=0)
            echo "document.forms[0].elements['non_teaching_account_m'].value='".$r['account_m']."';\n";
	if($r['account_t']!=0)
            echo "document.forms[0].elements['non_teaching_account_t'].value='".$r['account_t']."';\n";
	
        if($r['admin_f']!=0)
            echo "document.forms[0].elements['non_teaching_admin_f'].value='".$r['admin_f']."';\n";
	if($r['admin_m']!=0)
            echo "document.forms[0].elements['non_teaching_admin_m'].value='".$r['admin_m']."';\n";
	if($r['admin_t']!==0)
            echo "document.forms[0].elements['non_teaching_admin_t'].value='".$r['admin_t']."';\n";
	
        if($r['other_f']!=0)
            echo "document.forms[0].elements['non_teaching_other_f'].value='".$r['other_f']."';\n";
	if($r['other_m']!=0)
            echo "document.forms[0].elements['non_teaching_other_m'].value='".$r['other_m']."';\n";
	if($r['other_t']!=0)
            echo "document.forms[0].elements['non_teaching_other_t'].value='".$r['other_t']."';\n";
}
//autofill from tmis
if (isset($_GET['af']))
{
    foreach(array(2=>'pri',3=>'lsec',4=>'sec') as $level_key=>$level)
    {
        /*
        if($level=='hsec')
        {
            foreach(array('total','dalit','janjati') as $cat)
            {
                foreach(array(1=>'_fully_',5=>'_un') as $tr_key=>$tr_string)
                {
                    foreach(array(1=>'m',2=>'f') as $sex_key=>$sex_str)
                    {
                        if($cat=='total')
                        {
                          $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1' AND
                                        `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`sex`='$sex_key'");
                        }
                        elseif($cat=='dalit')
                        {
                            $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1' AND
                                        `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='1'");
                        }
                        elseif($cat=='janjati')
                        {
                            $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1' AND
                                        `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='2'");
                        }
                        while($row1=mysql_fetch_assoc($result1))
                        {
                            $id = "{$level}{$tr_string}trained_{$cat}_$sex_str";
                            if($row1['count'])
                            {
                                echo "document.forms[0].elements['$id'].value='".$row1['count']."';\n";
                            }
                            else{
                                echo "document.forms[0].elements['$id'].value='';\n";
                            }
                            echo "handleChange(document.forms[0].elements['$id']);\n";
                        }
                    }
                }
            }
        }
        else   
         * 
         */
        {
            foreach(array('total','dalit','janjati','current') as $cat)
            {
                foreach(array(6=>'_tpd1_',7=>'_tpd2_',8=>'_tpd3_') as $tr_key=>$tr_string)
                {
                    foreach(array(2=>'m',1=>'f') as $sex_key=>$sex_str)
                    {
                        if($cat=='total')
                        {
                          $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1' 
                                        AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`curr_perm_level`='$level_key'
                                        AND `tmis_sec1`.`sex`='$sex_key'");
                        }
                        elseif($cat=='dalit')
                        {
                            $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1' 
                                        AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`curr_perm_level`='$level_key'
                                        AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='1'");
                        }
                        elseif($cat=='janjati')
                        {
                            $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1'
                                        AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`curr_perm_level`='$level_key'
                                        AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='2'");
                        }
                        elseif($cat=='current')
                        {
                            $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                        join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                        join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                        WHERE `tmis_main`.`sch_num`='$sch_num' AND `tmis_train`.`sn`='1'
                                        AND `tmis_train`.`type`='$tr_key'
                                        AND `tmis_sec1`.`curr_perm_level`='$level_key'
                                        AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_train`.`year`='$currentyear'");
                        }
                        while($row1=mysql_fetch_assoc($result1))
                        {
                            $id = "{$level}{$tr_string}trained_{$cat}_{$sex_str}";
                            if($row1['count'])
                            {
                                echo "document.forms[0].elements['$id'].value='".$row1['count']."';\n";
                            }
                            else{
                                echo "document.forms[0].elements['$id'].value='';\n";
                            }
                            echo "handleChange(document.forms[0].elements['$id']);\n";
                        }
                    }
                }
                
            } 
        }
    }
       
}


?>
    


handleChange(d[0]);
handleChange(d[1]);
handleChange(d[3]);
handleChange(d[4]);
handleChange(d[6]);
handleChange(d[7]);
handleChange(d[9]);
handleChange(d[10]);


handleChange(d[72]);
handleChange(d[73]);
handleChange(d[75]);
handleChange(d[76]);
handleChange(d[78]);
handleChange(d[79]);
handleChange(d[81]);
handleChange(d[82]);



handleChange(d[144]);
handleChange(d[145]);
handleChange(d[147]);
handleChange(d[148]);
handleChange(d[150]);
handleChange(d[151]);
handleChange(d[153]);
handleChange(d[154])

handleChange(d['hsec_fully_trained_total_f']);
handleChange(d['hsec_fully_trained_total_m']);
handleChange(d['hsec_fully_trained_dalit_f']);
handleChange(d['hsec_fully_trained_dalit_m']);
handleChange(d['hsec_fully_trained_janjati_f']);
handleChange(d['hsec_fully_trained_janjati_m']);

validate = true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
