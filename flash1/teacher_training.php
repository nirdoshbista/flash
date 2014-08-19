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
<title>Flash I - Teacher Training</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/teacher_training.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
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
	<td><input name="pri_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>150 or 180 hours Training</td>
	<td><input name="pri_hour_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_hour_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_hour_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_hour_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_hour_trained_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>1st Package</td>
	<td><input name="pri_first_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_first_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_first_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_first_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_first_package_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>2nd Package</td>
	<td><input name="pri_second_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_total_f" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_total_m" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_second_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="pri_second_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="pri_second_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_second_package_janjati_t" size="4" maxlength="3" disabled></td>
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
	<td><input name="lsec_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>1st Module Completed</td>
	<td><input name="lsec_first_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_first_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_first_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_first_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_first_package_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>2nd Module Completed</td>
	<td><input name="lsec_second_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_second_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_second_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_second_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_second_package_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>3rd Module Completed</td>
	<td><input name="lsec_third_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_total_f" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_total_m" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_third_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="lsec_third_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="lsec_third_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_third_package_janjati_t" size="4" maxlength="3" disabled></td>
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
	<td><input name="sec_fully_trained_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_fully_trained_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_fully_trained_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_fully_trained_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_fully_trained_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>1st Module Completed</td>
	<td><input name="sec_first_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_first_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_first_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_first_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_first_package_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>2nd Module Completed</td>
	<td><input name="sec_second_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_second_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_second_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_second_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_second_package_janjati_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr>
    <td>3rd Module Completed</td>
	<td><input name="sec_third_package_total_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_total_f" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_total_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_total_m" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_total_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_total_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_third_package_dalit_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_dalit_f" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_dalit_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_dalit_m" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_dalit_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_dalit_t" size="4" maxlength="3" disabled></td>
	<td><input name="sec_third_package_janjati_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_janjati_f" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_janjati_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_janjati_m" size="4" maxlength="3"></td>
	<td><input name="sec_third_package_janjati_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_third_package_janjati_t" size="4" maxlength="3" disabled></td>
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
  </tr>  
</table>
<?php
}
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

</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d = document.forms[0];

<?php

if (isset($_GET['af'])) $currentyear--;

if ($classes[1]!=0){
	$result=mysql_query("select * from pri_teacher_training_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
	
	if (mysql_num_rows($result)>0){
		
		$r=mysql_fetch_array($result);	
		
		echo "autoFill = false;\n";
		echo "document.forms[0].elements['pri_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_total_f'].value='".$r['hour_trained_total_f']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_total_m'].value='".$r['hour_trained_total_m']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_total_t'].value='".$r['hour_trained_total_t']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_dalit_f'].value='".$r['hour_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_dalit_m'].value='".$r['hour_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_dalit_t'].value='".$r['hour_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_janjati_f'].value='".$r['hour_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_janjati_m'].value='".$r['hour_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_hour_trained_janjati_t'].value='".$r['hour_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_first_package_total_f'].value='".$r['first_package_total_f']."';\n";
		echo "document.forms[0].elements['pri_first_package_total_m'].value='".$r['first_package_total_m']."';\n";
		echo "document.forms[0].elements['pri_first_package_total_t'].value='".$r['first_package_total_t']."';\n";
		echo "document.forms[0].elements['pri_first_package_dalit_f'].value='".$r['first_package_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_first_package_dalit_m'].value='".$r['first_package_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_first_package_dalit_t'].value='".$r['first_package_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_first_package_janjati_f'].value='".$r['first_package_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_first_package_janjati_m'].value='".$r['first_package_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_first_package_janjati_t'].value='".$r['first_package_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_second_package_total_f'].value='".$r['second_package_total_f']."';\n";
		echo "document.forms[0].elements['pri_second_package_total_m'].value='".$r['second_package_total_m']."';\n";
		echo "document.forms[0].elements['pri_second_package_total_t'].value='".$r['second_package_total_t']."';\n";
		echo "document.forms[0].elements['pri_second_package_dalit_f'].value='".$r['second_package_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_second_package_dalit_m'].value='".$r['second_package_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_second_package_dalit_t'].value='".$r['second_package_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_second_package_janjati_f'].value='".$r['second_package_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_second_package_janjati_m'].value='".$r['second_package_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_second_package_janjati_t'].value='".$r['second_package_janjati_t']."';\n";
		echo "document.forms[0].elements['pri_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['pri_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";

	}
		
	$result=mysql_query("select * from pri_teacher_details_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
	$r=mysql_fetch_array($result);	
	
	echo "var pri_total_f=";
	echo $r['perm_f']*1+$r['temp_f']*1+$r['grant_f']*1+$r['private_f']*1;
	echo ";\n";
	
	echo "var pri_total_m=";
	echo $r['perm_m']*1+$r['temp_m']*1+$r['grant_m']*1+$r['private_m']*1;
	echo ";\n";	

}   

if ($classes[6]!=0){	
	$result=mysql_query("select * from lsec_teacher_training_f1 where sch_num='$sch_num' and sch_year='$currentyear'");

	if (mysql_num_rows($result)>0){
	
		$r=mysql_fetch_array($result);	
	
		echo "autoFill = false;\n";
		echo "document.forms[0].elements['lsec_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_first_package_total_f'].value='".$r['first_package_total_f']."';\n";
		echo "document.forms[0].elements['lsec_first_package_total_m'].value='".$r['first_package_total_m']."';\n";
		echo "document.forms[0].elements['lsec_first_package_total_t'].value='".$r['first_package_total_t']."';\n";
		echo "document.forms[0].elements['lsec_first_package_dalit_f'].value='".$r['first_package_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_first_package_dalit_m'].value='".$r['first_package_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_first_package_dalit_t'].value='".$r['first_package_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_first_package_janjati_f'].value='".$r['first_package_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_first_package_janjati_m'].value='".$r['first_package_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_first_package_janjati_t'].value='".$r['first_package_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_second_package_total_f'].value='".$r['second_package_total_f']."';\n";
		echo "document.forms[0].elements['lsec_second_package_total_m'].value='".$r['second_package_total_m']."';\n";
		echo "document.forms[0].elements['lsec_second_package_total_t'].value='".$r['second_package_total_t']."';\n";
		echo "document.forms[0].elements['lsec_second_package_dalit_f'].value='".$r['second_package_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_second_package_dalit_m'].value='".$r['second_package_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_second_package_dalit_t'].value='".$r['second_package_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_second_package_janjati_f'].value='".$r['second_package_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_second_package_janjati_m'].value='".$r['second_package_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_second_package_janjati_t'].value='".$r['second_package_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_third_package_total_f'].value='".$r['third_package_total_f']."';\n";
		echo "document.forms[0].elements['lsec_third_package_total_m'].value='".$r['third_package_total_m']."';\n";
		echo "document.forms[0].elements['lsec_third_package_total_t'].value='".$r['third_package_total_t']."';\n";
		echo "document.forms[0].elements['lsec_third_package_dalit_f'].value='".$r['third_package_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_third_package_dalit_m'].value='".$r['third_package_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_third_package_dalit_t'].value='".$r['third_package_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_third_package_janjati_f'].value='".$r['third_package_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_third_package_janjati_m'].value='".$r['third_package_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_third_package_janjati_t'].value='".$r['third_package_janjati_t']."';\n";
		echo "document.forms[0].elements['lsec_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['lsec_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";
	
	}
	
	$result=mysql_query("select * from lsec_teacher_details_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
	$r=mysql_fetch_array($result);	
	
	echo "var lsec_total_f=";
	echo $r['perm_f']*1+$r['temp_f']*1+$r['grant_f']*1+$r['private_f']*1;
	echo ";\n";
	
	echo "var lsec_total_m=";
	echo $r['perm_m']*1+$r['temp_m']*1+$r['grant_m']*1+$r['private_m']*1;
	echo ";\n";		
}

if ($classes[9]!=0){

	$result=mysql_query("select * from sec_teacher_training_f1 where sch_num='$sch_num' and sch_year='$currentyear'");

	if (mysql_num_rows($result)>0){

		$r=mysql_fetch_array($result);	
	
		echo "autoFill = false;\n";
		echo "document.forms[0].elements['sec_fully_trained_total_f'].value='".$r['fully_trained_total_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_total_m'].value='".$r['fully_trained_total_m']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_total_t'].value='".$r['fully_trained_total_t']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_f'].value='".$r['fully_trained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_m'].value='".$r['fully_trained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_dalit_t'].value='".$r['fully_trained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_janjati_f'].value='".$r['fully_trained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_janjati_m'].value='".$r['fully_trained_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_fully_trained_janjati_t'].value='".$r['fully_trained_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_first_package_total_f'].value='".$r['first_package_total_f']."';\n";
		echo "document.forms[0].elements['sec_first_package_total_m'].value='".$r['first_package_total_m']."';\n";
		echo "document.forms[0].elements['sec_first_package_total_t'].value='".$r['first_package_total_t']."';\n";
		echo "document.forms[0].elements['sec_first_package_dalit_f'].value='".$r['first_package_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_first_package_dalit_m'].value='".$r['first_package_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_first_package_dalit_t'].value='".$r['first_package_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_first_package_janjati_f'].value='".$r['first_package_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_first_package_janjati_m'].value='".$r['first_package_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_first_package_janjati_t'].value='".$r['first_package_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_second_package_total_f'].value='".$r['second_package_total_f']."';\n";
		echo "document.forms[0].elements['sec_second_package_total_m'].value='".$r['second_package_total_m']."';\n";
		echo "document.forms[0].elements['sec_second_package_total_t'].value='".$r['second_package_total_t']."';\n";
		echo "document.forms[0].elements['sec_second_package_dalit_f'].value='".$r['second_package_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_second_package_dalit_m'].value='".$r['second_package_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_second_package_dalit_t'].value='".$r['second_package_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_second_package_janjati_f'].value='".$r['second_package_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_second_package_janjati_m'].value='".$r['second_package_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_second_package_janjati_t'].value='".$r['second_package_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_third_package_total_f'].value='".$r['third_package_total_f']."';\n";
		echo "document.forms[0].elements['sec_third_package_total_m'].value='".$r['third_package_total_m']."';\n";
		echo "document.forms[0].elements['sec_third_package_total_t'].value='".$r['third_package_total_t']."';\n";
		echo "document.forms[0].elements['sec_third_package_dalit_f'].value='".$r['third_package_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_third_package_dalit_m'].value='".$r['third_package_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_third_package_dalit_t'].value='".$r['third_package_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_third_package_janjati_f'].value='".$r['third_package_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_third_package_janjati_m'].value='".$r['third_package_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_third_package_janjati_t'].value='".$r['third_package_janjati_t']."';\n";
		echo "document.forms[0].elements['sec_untrained_total_f'].value='".$r['untrained_total_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_total_m'].value='".$r['untrained_total_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_total_t'].value='".$r['untrained_total_t']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_f'].value='".$r['untrained_dalit_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_m'].value='".$r['untrained_dalit_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_dalit_t'].value='".$r['untrained_dalit_t']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_f'].value='".$r['untrained_janjati_f']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_m'].value='".$r['untrained_janjati_m']."';\n";
		echo "document.forms[0].elements['sec_untrained_janjati_t'].value='".$r['untrained_janjati_t']."';\n";

	}
	
	$result=mysql_query("select * from sec_teacher_details_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
	$r=mysql_fetch_array($result);	
	
	echo "var sec_total_f=";
	echo $r['perm_f']*1+$r['temp_f']*1+$r['grant_f']*1+$r['private_f']*1;
	echo ";\n";
	
	echo "var sec_total_m=";
	echo $r['perm_m']*1+$r['temp_m']*1+$r['grant_m']*1+$r['private_m']*1;
	echo ";\n";	
}



$result=mysql_query("select * from hsec_teacher_training_f1 where sch_num='$sch_num' and sch_year='$currentyear'");

if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "autoFill = false;\n";
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


?>


handleChange(d[0]);
handleChange(d[1]);
handleChange(d[3]);
handleChange(d[4]);
handleChange(d[6]);
handleChange(d[7]);


handleChange(d[54]);
handleChange(d[55]);
handleChange(d[57]);
handleChange(d[58]);
handleChange(d[60]);
handleChange(d[61]);


handleChange(d[108]);
handleChange(d[109]);
handleChange(d[111]);
handleChange(d[112]);
handleChange(d[114]);
handleChange(d[115]);

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