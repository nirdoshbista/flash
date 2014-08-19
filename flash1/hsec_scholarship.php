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
<title>Flash I - H.Sec. Scholarship</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/hsec_scholarship.js" type="text/javascript"></script>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td rowspan="3">Scholarship</td>
    <td colspan="9">Class 11</td>
    <td colspan="9">Class 12</td>
  </tr>
  <tr> 
    <td colspan="3" class="ewTableHeader">Total</td>
    <td colspan="3" class="ewTableHeader">Dalit</td>
    <td colspan="3" class="ewTableHeader">Janjati</td>
    <td colspan="3" class="ewTableHeader">Total</td>
    <td colspan="3" class="ewTableHeader">Dalit</td>
    <td colspan="3" class="ewTableHeader">Janjati</td>
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
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
  </tr>
  <tr> 
    <td>Scholarship</td>
    <td><input name="hsec_total_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_12_1" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Incentive</td>
    <td><input name="hsec_total_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_12_2" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Loan</td>
    <td><input name="hsec_total_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_12_3" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Others</td>
    <td><input name="hsec_total_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_total_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_total_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_total_t_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_dalit_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_dalit_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_dalit_t_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="hsec_janjati_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="hsec_janjati_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_janjati_t_12_4" size="3" maxlength="3" disabled></td>
  </tr>
</table>
<br>
<p align='center'><strong>Total Enrollment and Graduated students</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader">
  	<td rowspan="2">Students</td>
  	<td colspan="3">Enrollment</td>
  	<td colspan="3">Graduated Students</td>
  </tr>
  <tr class="ewTableHeader">
  	<td>Female</td>
  	<td>Male</td>
  	<td>Total</td>
  	<td>Female</td>
  	<td>Male</td>
  	<td>Total</td>
  </tr>
  <tr>
	<td>Total</td>
	<td><input name="enr_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_male" size="3" maxlength="3"></td>
	<td><input name="enr_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_female" size="3" maxlength="3"></td>
	<td><input name="enr_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_total" size="3" maxlength="3" disabled></td>
	<td><input name="passed_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_male" size="3" maxlength="3"></td>
	<td><input name="passed_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_female" size="3" maxlength="3"></td>
	<td><input name="passed_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_total" size="3" maxlength="3" disabled></td>

  </tr>
  <tr>
  	<td>Dalit</td>
	<td><input name="enr_dalit_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_dalit_female" size="3" maxlength="3"></td>
	<td><input name="enr_dalit_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_dalit_male" size="3" maxlength="3"></td>
	<td><input name="enr_dalit_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_dalit_total" size="3" maxlength="3" disabled></td>
	<td><input name="passed_dalit_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_dalit_female" size="3" maxlength="3"></td>
	<td><input name="passed_dalit_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_dalit_male" size="3" maxlength="3"></td>
	<td><input name="passed_dalit_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_dalit_total" size="3" maxlength="3" disabled></td>
  </tr>
  <tr>
  	<td>Janjati</td>
	<td><input name="enr_janjati_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_janjati_female" size="3" maxlength="3"></td>
	<td><input name="enr_janjati_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_janjati_male" size="3" maxlength="3"></td>
	<td><input name="enr_janjati_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="enr_janjati_total" size="3" maxlength="3" disabled></td>
	<td><input name="passed_janjati_female" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_janjati_female" size="3" maxlength="3"></td>
	<td><input name="passed_janjati_male" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_janjati_male" size="3" maxlength="3"></td>
	<td><input name="passed_janjati_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="passed_janjati_total" size="3" maxlength="3" disabled></td>  

  </tr>
  
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d = document.forms[0].elements;
<?php

$result=mysql_query("select * from hsec_total_passed_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
$r=mysql_fetch_array($result);	

echo "d['enr_male'].value='".$r['enr_male']."';\n";
echo "d['enr_female'].value='".$r['enr_female']."';\n";
echo "d['enr_total'].value='".$r['enr_total']."';\n";
echo "d['passed_male'].value='".$r['passed_male']."';\n";
echo "d['passed_female'].value='".$r['passed_female']."';\n";
echo "d['passed_total'].value='".$r['passed_total']."';\n";
echo "d['enr_dalit_female'].value='".$r['enr_dalit_female']."';\n";
echo "d['enr_dalit_male'].value='".$r['enr_dalit_male']."';\n";
echo "d['enr_dalit_total'].value='".$r['enr_dalit_total']."';\n";
echo "d['passed_dalit_female'].value='".$r['passed_dalit_female']."';\n";
echo "d['passed_dalit_male'].value='".$r['passed_dalit_male']."';\n";
echo "d['passed_dalit_total'].value='".$r['passed_dalit_total']."';\n";
echo "d['enr_janjati_female'].value='".$r['enr_janjati_female']."';\n";
echo "d['enr_janjati_male'].value='".$r['enr_janjati_male']."';\n";
echo "d['enr_janjati_total'].value='".$r['enr_janjati_total']."';\n";
echo "d['passed_janjati_female'].value='".$r['passed_janjati_female']."';\n";
echo "d['passed_janjati_male'].value='".$r['passed_janjati_male']."';\n";
echo "d['passed_janjati_total'].value='".$r['passed_janjati_total']."';\n";

$result=mysql_query("select * from hsec_scholarship_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=11");
$r=mysql_fetch_array($result);	

echo "d['hsec_total_f_11_1'].value='".$r['scholarship_total_f']."';\n";
echo "d['hsec_total_m_11_1'].value='".$r['scholarship_total_m']."';\n";
echo "d['hsec_total_t_11_1'].value='".$r['scholarship_total_t']."';\n";
echo "d['hsec_dalit_f_11_1'].value='".$r['scholarship_dalit_f']."';\n";
echo "d['hsec_dalit_m_11_1'].value='".$r['scholarship_dalit_m']."';\n";
echo "d['hsec_dalit_t_11_1'].value='".$r['scholarship_dalit_t']."';\n";
echo "d['hsec_janjati_f_11_1'].value='".$r['scholarship_janjati_f']."';\n";
echo "d['hsec_janjati_m_11_1'].value='".$r['scholarship_janjati_m']."';\n";
echo "d['hsec_janjati_t_11_1'].value='".$r['scholarship_janjati_t']."';\n";
echo "d['hsec_total_f_11_2'].value='".$r['encourage_total_f']."';\n";
echo "d['hsec_total_m_11_2'].value='".$r['encourage_total_m']."';\n";
echo "d['hsec_total_t_11_2'].value='".$r['encourage_total_t']."';\n";
echo "d['hsec_dalit_f_11_2'].value='".$r['encourage_dalit_f']."';\n";
echo "d['hsec_dalit_m_11_2'].value='".$r['encourage_dalit_m']."';\n";
echo "d['hsec_dalit_t_11_2'].value='".$r['encourage_dalit_t']."';\n";
echo "d['hsec_janjati_f_11_2'].value='".$r['encourage_janjati_f']."';\n";
echo "d['hsec_janjati_m_11_2'].value='".$r['encourage_janjati_m']."';\n";
echo "d['hsec_janjati_t_11_2'].value='".$r['encourage_janjati_t']."';\n";
echo "d['hsec_total_f_11_3'].value='".$r['loan_total_f']."';\n";
echo "d['hsec_total_m_11_3'].value='".$r['loan_total_m']."';\n";
echo "d['hsec_total_t_11_3'].value='".$r['loan_total_t']."';\n";
echo "d['hsec_dalit_f_11_3'].value='".$r['loan_dalit_f']."';\n";
echo "d['hsec_dalit_m_11_3'].value='".$r['loan_dalit_m']."';\n";
echo "d['hsec_dalit_t_11_3'].value='".$r['loan_dalit_t']."';\n";
echo "d['hsec_janjati_f_11_3'].value='".$r['loan_janjati_f']."';\n";
echo "d['hsec_janjati_m_11_3'].value='".$r['loan_janjati_m']."';\n";
echo "d['hsec_janjati_t_11_3'].value='".$r['loan_janjati_t']."';\n";
echo "d['hsec_total_f_11_4'].value='".$r['others_total_f']."';\n";
echo "d['hsec_total_m_11_4'].value='".$r['others_total_m']."';\n";
echo "d['hsec_total_t_11_4'].value='".$r['others_total_t']."';\n";
echo "d['hsec_dalit_f_11_4'].value='".$r['others_dalit_f']."';\n";
echo "d['hsec_dalit_m_11_4'].value='".$r['others_dalit_m']."';\n";
echo "d['hsec_dalit_t_11_4'].value='".$r['others_dalit_t']."';\n";
echo "d['hsec_janjati_f_11_4'].value='".$r['others_janjati_f']."';\n";
echo "d['hsec_janjati_m_11_4'].value='".$r['others_janjati_m']."';\n";
echo "d['hsec_janjati_t_11_4'].value='".$r['others_janjati_t']."';\n";

$result=mysql_query("select * from hsec_scholarship_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=12");
$r=mysql_fetch_array($result);	


echo "d['hsec_total_f_12_1'].value='".$r['scholarship_total_f']."';\n";
echo "d['hsec_total_m_12_1'].value='".$r['scholarship_total_m']."';\n";
echo "d['hsec_total_t_12_1'].value='".$r['scholarship_total_t']."';\n";
echo "d['hsec_dalit_f_12_1'].value='".$r['scholarship_dalit_f']."';\n";
echo "d['hsec_dalit_m_12_1'].value='".$r['scholarship_dalit_m']."';\n";
echo "d['hsec_dalit_t_12_1'].value='".$r['scholarship_dalit_t']."';\n";
echo "d['hsec_janjati_f_12_1'].value='".$r['scholarship_janjati_f']."';\n";
echo "d['hsec_janjati_m_12_1'].value='".$r['scholarship_janjati_m']."';\n";
echo "d['hsec_janjati_t_12_1'].value='".$r['scholarship_janjati_t']."';\n";
echo "d['hsec_total_f_12_2'].value='".$r['encourage_total_f']."';\n";
echo "d['hsec_total_m_12_2'].value='".$r['encourage_total_m']."';\n";
echo "d['hsec_total_t_12_2'].value='".$r['encourage_total_t']."';\n";
echo "d['hsec_dalit_f_12_2'].value='".$r['encourage_dalit_f']."';\n";
echo "d['hsec_dalit_m_12_2'].value='".$r['encourage_dalit_m']."';\n";
echo "d['hsec_dalit_t_12_2'].value='".$r['encourage_dalit_t']."';\n";
echo "d['hsec_janjati_f_12_2'].value='".$r['encourage_janjati_f']."';\n";
echo "d['hsec_janjati_m_12_2'].value='".$r['encourage_janjati_m']."';\n";
echo "d['hsec_janjati_t_12_2'].value='".$r['encourage_janjati_t']."';\n";
echo "d['hsec_total_f_12_3'].value='".$r['loan_total_f']."';\n";
echo "d['hsec_total_m_12_3'].value='".$r['loan_total_m']."';\n";
echo "d['hsec_total_t_12_3'].value='".$r['loan_total_t']."';\n";
echo "d['hsec_dalit_f_12_3'].value='".$r['loan_dalit_f']."';\n";
echo "d['hsec_dalit_m_12_3'].value='".$r['loan_dalit_m']."';\n";
echo "d['hsec_dalit_t_12_3'].value='".$r['loan_dalit_t']."';\n";
echo "d['hsec_janjati_f_12_3'].value='".$r['loan_janjati_f']."';\n";
echo "d['hsec_janjati_m_12_3'].value='".$r['loan_janjati_m']."';\n";
echo "d['hsec_janjati_t_12_3'].value='".$r['loan_janjati_t']."';\n";
echo "d['hsec_total_f_12_4'].value='".$r['others_total_f']."';\n";
echo "d['hsec_total_m_12_4'].value='".$r['others_total_m']."';\n";
echo "d['hsec_total_t_12_4'].value='".$r['others_total_t']."';\n";
echo "d['hsec_dalit_f_12_4'].value='".$r['others_dalit_f']."';\n";
echo "d['hsec_dalit_m_12_4'].value='".$r['others_dalit_m']."';\n";
echo "d['hsec_dalit_t_12_4'].value='".$r['others_dalit_t']."';\n";
echo "d['hsec_janjati_f_12_4'].value='".$r['others_janjati_f']."';\n";
echo "d['hsec_janjati_m_12_4'].value='".$r['others_janjati_m']."';\n";
echo "d['hsec_janjati_t_12_4'].value='".$r['others_janjati_t']."';\n";

?>

validate = true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
