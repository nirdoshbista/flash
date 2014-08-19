<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('includes/flash1fn.php');

$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - H.Sec. Current Enrollment</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/hsec_current.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
  <p>&nbsp;</p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="14"> Current Higher Secondary Level Details</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td rowspan="2">Class</td>
    <td rowspan="2">Faculty</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
    <td colspan="3">Others</td>
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
    <td rowspan="6">11</td>
    <td>Humanities</td>
    <td><input name="tot_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_1" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_1" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Education</td>
    <td><input name="tot_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_2" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_2" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Science</td>
    <td><input name="tot_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_3" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_3" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Management</td>
    <td><input name="tot_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_4" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_4" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td><?php  insertfaculties('faculty_11_5'); ?></td>
    <td><input name="tot_f_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_5" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_5" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_5" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_5" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td><?php  insertfaculties('faculty_11_6'); ?></td>
    <td><input name="tot_f_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_11_6" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_11_6" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_11_6" size="3" maxlength="3" <?php if ($classes[11]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_11_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_11_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_11_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_11_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_11_6" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td rowspan="6">12</td>
    <td>Humanities</td>
    <td><input name="tot_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_1" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_1" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_1" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Education</td>
    <td><input name="tot_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_2" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_2" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_2" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Science</td>
    <td><input name="tot_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_3" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_3" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_3" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Management</td>
    <td><input name="tot_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_4" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_4" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_4" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td><?php  insertfaculties('faculty_12_5'); ?></td>
    <td><input name="tot_f_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_5" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_5" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_5" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_5" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_5" size="3" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td><?php  insertfaculties('faculty_12_6'); ?></td>
    <td><input name="tot_f_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_f_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_m_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_m_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="tot_t_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_t_12_6" size="3" maxlength="3" disabled></td>
    <td><input name="dalit_f_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_m_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="dalit_t_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_12_6" size="3" maxlength="3" disabled></td>
    <td><input name="janjati_f_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_m_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_12_6" size="3" maxlength="3" <?php if ($classes[12]==0) echo 'disabled'; ?>></td>
    <td><input name="janjati_t_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_12_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_f_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_12_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_m_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_12_6" size="3" maxlength="3" disabled></td>
    <td><input name="other_t_12_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_12_6" size="3" maxlength="3" disabled></td>
  </tr>
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d=document.forms[0].elements;
function fillValues(){

<?php
	
$faculties = array('','Humanities','Education','Science','Management');
$result=mysql_query("select * from hsec_current_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list!='Humanities' and faculty_list!='Education' and faculty_list!='Science' and faculty_list!='Management' and class=11");
while ($r=mysql_fetch_array($result)){
	$faculties[]=$r['faculty_list'];
}

	
for ($i=1;$i<count($faculties);$i++){
	$result=mysql_query("select * from hsec_current_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list='".$faculties[$i]."' and class=11");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	if ($i>4) echo "d['faculty_11_$i'].value='".$r['faculty_list']."';\n";
	
	echo "d['tot_f_11_$i'].value='".$r['tot_f']."';\n";
	echo "d['tot_m_11_$i'].value='".$r['tot_m']."';\n";
	echo "d['tot_t_11_$i'].value='".$r['tot_t']."';\n";
	echo "d['dalit_f_11_$i'].value='".$r['dalit_f']."';\n";
	echo "d['dalit_m_11_$i'].value='".$r['dalit_m']."';\n";
	echo "d['dalit_t_11_$i'].value='".$r['dalit_t']."';\n";
	echo "d['janjati_f_11_$i'].value='".$r['janjati_f']."';\n";
	echo "d['janjati_m_11_$i'].value='".$r['janjati_m']."';\n";
	echo "d['janjati_t_11_$i'].value='".$r['janjati_t']."';\n";
	echo "d['other_f_11_$i'].value='".$r['others_f']."';\n";
	echo "d['other_m_11_$i'].value='".$r['others_m']."';\n";
	echo "d['other_t_11_$i'].value='".$r['others_t']."';\n";

}
	

	// class 12
	
	unset($faculties);
	
$faculties = array('','Humanities','Education','Science','Management');
$result=mysql_query("select * from hsec_current_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list!='Humanities' and faculty_list!='Education' and faculty_list!='Science' and faculty_list!='Management' and class=12");
while ($r=mysql_fetch_array($result)){
	$faculties[]=$r['faculty_list'];
}

	
for ($i=1;$i<count($faculties);$i++){
	$result=mysql_query("select * from hsec_current_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list='".$faculties[$i]."' and class=12");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	if ($i>4) echo "d['faculty_12_$i'].value='".$r['faculty_list']."';\n";
	
	echo "d['tot_f_12_$i'].value='".$r['tot_f']."';\n";
	echo "d['tot_m_12_$i'].value='".$r['tot_m']."';\n";
	echo "d['tot_t_12_$i'].value='".$r['tot_t']."';\n";
	echo "d['dalit_f_12_$i'].value='".$r['dalit_f']."';\n";
	echo "d['dalit_m_12_$i'].value='".$r['dalit_m']."';\n";
	echo "d['dalit_t_12_$i'].value='".$r['dalit_t']."';\n";
	echo "d['janjati_f_12_$i'].value='".$r['janjati_f']."';\n";
	echo "d['janjati_m_12_$i'].value='".$r['janjati_m']."';\n";
	echo "d['janjati_t_12_$i'].value='".$r['janjati_t']."';\n";
	echo "d['other_f_12_$i'].value='".$r['others_f']."';\n";
	echo "d['other_m_12_$i'].value='".$r['others_m']."';\n";
	echo "d['other_t_12_$i'].value='".$r['others_t']."';\n";

}

// autofill
if (isset($_GET['af']))
{
    foreach(array('0'=>'tot','1'=>'dalit','2'=>'janjati','3'=>'other') as $key1=>$value1):
            foreach(array('M'=>'m','F'=>'f','T'=>'t') as $key2=>$value2):
                for($class=11;$class<=12;$class++)
                {
                    //map stream id in the database(emis excel) i.e. 
                    //Humanities('1'=>'1'),Management('2'=>'4'),Education('3'=>'2'),Science('4'=>'3')
                    foreach(array('1'=>'1','2'=>'4','3'=>'2','4'=>'3') as $key3=>$value3):
                        
                        $query="select count(*) as count from id_students_main 
                            left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                            where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                            and id_students_track.class={$class}
                            and id_students_track.stream={$key3}";

                            //filter by caste
                            //others group of caste will include Brahmin/Chhetri(3) and Others(4)
                            if($key1!='0' and $key1!='3')  $query.=" and id_students_main.caste='$key1'";
                            elseif($key1=='3')  $query.=" and (id_students_main.caste='3' or id_students_main.caste='4')";
                            
                            //filter by gender,no need to apply filter for Total
                            if($key2!='T')  $query.=" and id_students_main.gender='$key2'";

                                $result = mysql_query($query);
                                if (mysql_num_rows($result)>0)
                                {   
                                    $row = mysql_fetch_array($result);
                                    if($row['count'])
                                    {
                                        echo "d['{$value1}_{$value2}_{$class}_{$value3}'].value='${row['count']}';\n";
                                    }
                                }    
                   endforeach;
                }
            endforeach;
    endforeach;
}

?>
}
fillValues();

validate = true;
</script>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
