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
<title>Flash I - Teaching & Physical</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/teaching_physical.js" type="text/javascript"></script>
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
<p align='center'><strong>Language</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td rowspan="2">S.No.</td>
    <td rowspan="2">Language</td>
    <td colspan='3'>Class 1</td>
    <td colspan='3'>Class 2</td>
    <td colspan='3'>Class 3</td>
    <td colspan='3'>Class 4</td>
    <td colspan='3'>Class 5</td>
  </tr>
  <tr class='ewTableHeader'>
  	<td>F</td>
  	<td>M</td>
  	<td>T</td>
  	<td>F</td>
  	<td>M</td>
  	<td>T</td>
  	<td>F</td>
  	<td>M</td>
  	<td>T</td>
  	<td>F</td>
  	<td>M</td>
  	<td>T</td>
  	<td>F</td>
  	<td>M</td>
  	<td>T</td>
  </tr>
  
  <tr> 
    <td>1.</td>
    <td><?php  insertlanguages('lang_1'); ?></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_f[1]" type="text" value="" id="lang_class1_f[1]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_m[1]" type="text" value="" id="lang_class1_m[1]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_t[1]" type="text" value="" id="lang_class1_t[1]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_f[1]" type="text" value="" id="lang_class2_f[1]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_m[1]" type="text" value="" id="lang_class2_m[1]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_t[1]" type="text" value="" id="lang_class2_t[1]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_f[1]" type="text" value="" id="lang_class3_f[1]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_m[1]" type="text" value="" id="lang_class3_m[1]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_t[1]" type="text" value="" id="lang_class3_t[1]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_f[1]" type="text" value="" id="lang_class4_f[1]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_m[1]" type="text" value="" id="lang_class4_m[1]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_t[1]" type="text" value="" id="lang_class4_t[1]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_f[1]" type="text" value="" id="lang_class5_f[1]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_m[1]" type="text" value="" id="lang_class5_m[1]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_t[1]" type="text" value="" id="lang_class5_t[1]" size="2" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>2.</td>
    <td><?php  insertlanguages('lang_2'); ?></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_f[2]" type="text" value="" id="lang_class1_f[2]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_m[2]" type="text" value="" id="lang_class1_m[2]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_t[2]" type="text" value="" id="lang_class1_t[2]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_f[2]" type="text" value="" id="lang_class2_f[2]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_m[2]" type="text" value="" id="lang_class2_m[2]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_t[2]" type="text" value="" id="lang_class2_t[2]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_f[2]" type="text" value="" id="lang_class3_f[2]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_m[2]" type="text" value="" id="lang_class3_m[2]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_t[2]" type="text" value="" id="lang_class3_t[2]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_f[2]" type="text" value="" id="lang_class4_f[2]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_m[2]" type="text" value="" id="lang_class4_m[2]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_t[2]" type="text" value="" id="lang_class4_t[2]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_f[2]" type="text" value="" id="lang_class5_f[2]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_m[2]" type="text" value="" id="lang_class5_m[2]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_t[2]" type="text" value="" id="lang_class5_t[2]" size="2" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>3.</td>
    <td><?php  insertlanguages('lang_3'); ?></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_f[3]" type="text" value="" id="lang_class1_f[3]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_m[3]" type="text" value="" id="lang_class1_m[3]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_t[3]" type="text" value="" id="lang_class1_t[3]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_f[3]" type="text" value="" id="lang_class2_f[3]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_m[3]" type="text" value="" id="lang_class2_m[3]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_t[3]" type="text" value="" id="lang_class2_t[3]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_f[3]" type="text" value="" id="lang_class3_f[3]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_m[3]" type="text" value="" id="lang_class3_m[3]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_t[3]" type="text" value="" id="lang_class3_t[3]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_f[3]" type="text" value="" id="lang_class4_f[3]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_m[3]" type="text" value="" id="lang_class4_m[3]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_t[3]" type="text" value="" id="lang_class4_t[3]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_f[3]" type="text" value="" id="lang_class5_f[3]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_m[3]" type="text" value="" id="lang_class5_m[3]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_t[3]" type="text" value="" id="lang_class5_t[3]" size="2" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>4.</td>
    <td><?php  insertlanguages('lang_4'); ?></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_f[4]" type="text" value="" id="lang_class1_f[4]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_m[4]" type="text" value="" id="lang_class1_m[4]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_t[4]" type="text" value="" id="lang_class1_t[4]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_f[4]" type="text" value="" id="lang_class2_f[4]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_m[4]" type="text" value="" id="lang_class2_m[4]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_t[4]" type="text" value="" id="lang_class2_t[4]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_f[4]" type="text" value="" id="lang_class3_f[4]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_m[4]" type="text" value="" id="lang_class3_m[4]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_t[4]" type="text" value="" id="lang_class3_t[4]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_f[4]" type="text" value="" id="lang_class4_f[4]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_m[4]" type="text" value="" id="lang_class4_m[4]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_t[4]" type="text" value="" id="lang_class4_t[4]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_f[4]" type="text" value="" id="lang_class5_f[4]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_m[4]" type="text" value="" id="lang_class5_m[4]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_t[4]" type="text" value="" id="lang_class5_t[4]" size="2" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>5.</td>
    <td><?php  insertlanguages('lang_5'); ?></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_f[5]" type="text" value="" id="lang_class1_f[5]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_m[5]" type="text" value="" id="lang_class1_m[5]" size="2" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class1_t[5]" type="text" value="" id="lang_class1_t[5]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_f[5]" type="text" value="" id="lang_class2_f[5]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_m[5]" type="text" value="" id="lang_class2_m[5]" size="2" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class2_t[5]" type="text" value="" id="lang_class2_t[5]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_f[5]" type="text" value="" id="lang_class3_f[5]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_m[5]" type="text" value="" id="lang_class3_m[5]" size="2" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class3_t[5]" type="text" value="" id="lang_class3_t[5]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_f[5]" type="text" value="" id="lang_class4_f[5]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_m[5]" type="text" value="" id="lang_class4_m[5]" size="2" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class4_t[5]" type="text" value="" id="lang_class4_t[5]" size="2" maxlength="3" disabled></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_f[5]" type="text" value="" id="lang_class5_f[5]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_m[5]" type="text" value="" id="lang_class5_m[5]" size="2" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" name="lang_class5_t[5]" type="text" value="" id="lang_class5_t[5]" size="2" maxlength="3" disabled></td>
  </tr>  
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>

    <td>

<?php
if ($classes[1]!=0){

?>	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
        <tr class="ewTableHeader"> 
          <td colspan="5">Teaching Methods</td>
        </tr>
        <tr class="ewTableHeader"> 
          <td>Class 1</td>
          <td>Class 2</td>
          <td>Class 3</td>
          <td>Class 4</td>
          <td>Class 5</td>
        </tr>
        <tr> 
          <td><select onkeypress="return generalKeyPress(this, event);" name="teaching_method_1" id="teaching_method_1" <?php if ($classes[1]==0) echo 'disabled'; ?>>
              <option value="0">N/A</option>
              <option value="1">Subject Teaching</option>
              <option value="2">Grade Teaching</option>
              <option value="3">Multigrade Teaching</option>
            </select></td>
          <td><select onkeypress="return generalKeyPress(this, event);" name="teaching_method_2" id="teaching_method_2" <?php if ($classes[2]==0) echo 'disabled'; ?>>
              <option value="0">N/A</option>
              <option value="1">Subject Teaching</option>
              <option value="2">Grade Teaching</option>
              <option value="3">Multigrade Teaching</option>
            </select></td>
          <td><select onkeypress="return generalKeyPress(this, event);" name="teaching_method_3" id="teaching_method_3" <?php if ($classes[3]==0) echo 'disabled'; ?>>
              <option value="0">N/A</option>
              <option value="1">Subject Teaching</option>
              <option value="2">Grade Teaching</option>
              <option value="3">Multigrade Teaching</option>
            </select></td>
          <td><select onkeypress="return generalKeyPress(this, event);" name="teaching_method_4" id="teaching_method_4" <?php if ($classes[4]==0) echo 'disabled'; ?>>
              <option value="0">N/A</option>
              <option value="1">Subject Teaching</option>
              <option value="2">Grade Teaching</option>
              <option value="3">Multigrade Teaching</option>
            </select></td>
          <td><select onkeypress="return generalKeyPress(this, event);" name="teaching_method_5" id="teaching_method_5" <?php if ($classes[5]==0) echo 'disabled'; ?>>
              <option value="0">N/A</option>
              <option value="1">Subject Teaching</option>
              <option value="2">Grade Teaching</option>
              <option value="3">Multigrade Teaching</option>
            </select></td>
        </tr>
      </table>
	  
<?php
}
?>	  
	  
	  
	  </td>
  </tr>
</table>

<br />
<?php
if ($classes[1]!=0 || $classes[6]!=0 || $classes[9]!=0){

?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="13">Textbooks</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td>&nbsp;</td>
    <td>Class 1</td>
    <td>Class 2</td>
    <td>Class 3</td>
    <td>Class 4</td>
    <td>Class 5</td>
    <td>Class 6</td>
    <td>Class 7</td>
    <td>Class 8</td>
    <td>Class 9</td>
    <td>Class 10</td>
    <td>Total</td>
  </tr>
  <tr> 
    <td>Full Set</td>
    <td><input name="full_students_no_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="full_students_no_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>
    
    <td><input name="full_students_no_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="full_students_no_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Partial Set</td>
    <td><input name="partial_students_no_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>
    <td><input name="partial_students_no_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="partial_students_no_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>None</td>
    <td><input name="none_students_no_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>
    <td><input name="none_students_no_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="none_students_no_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Reuse</td>
    <td><input name="reuse_students_no_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>
    <td><input name="reuse_students_no_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="reuse_students_no_t" size="4" maxlength="3" disabled></td>
  </tr>
</table>
<?php
}
?>

</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d=document.forms[0].elements;
<?php

// teaching method
$result=mysql_query("select * from teaching_method_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
if (isset($_GET['af'])) $result=mysql_query("select * from teaching_method_f1 where sch_num='$sch_num' and sch_year='".($currentyear-1)."'");

if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);
	
	echo "autoFill = false;\n";
	echo "document.forms[0].elements['teaching_method_1'].value='".$r['c1_teaching_method']."';\n";
	echo "document.forms[0].elements['teaching_method_2'].value='".$r['c2_teaching_method']."';\n";
	echo "document.forms[0].elements['teaching_method_3'].value='".$r['c3_teaching_method']."';\n";
	echo "document.forms[0].elements['teaching_method_4'].value='".$r['c4_teaching_method']."';\n";
	echo "document.forms[0].elements['teaching_method_5'].value='".$r['c5_teaching_method']."';\n";

}

// textbooks
for ($i=1;$i<=10;$i++){
	$result=mysql_query("select * from textbooks_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	$r=mysql_fetch_array($result);

	echo "document.forms[0].elements['full_students_no_$i'].value='".$r['full_students_no']."';\n";
	echo "document.forms[0].elements['partial_students_no_$i'].value='".$r['partial_students_no']."';\n";
	echo "document.forms[0].elements['none_students_no_$i'].value='".$r['none_students_no']."';\n";
	echo "document.forms[0].elements['reuse_students_no_$i'].value='".$r['reuse_students_no']."';\n";

}

// languages

for ($c=1;$c<=5;$c++){
	$result=mysql_query("select * from language_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class='$c'");
	
	$i=1;
	while($r=mysql_fetch_array($result)){
		echo "if (d['lang_$i'].value=='') d['lang_$i'].value='".$r['language']."';\n";
		//$lang[$i] = $r['language'];
		
		echo "d['lang_class${c}_f[$i]'].value=".($r['female']).";\n";
		echo "d['lang_class${c}_m[$i]'].value=".($r['male']).";\n";
		echo "d['lang_class${c}_t[$i]'].value=".($r['total']).";\n";		
		$i++;
		
	}
	
}





?>

handleChange(document.getElementById('full_students_no_1'));
handleChange(document.getElementById('partial_students_no_1'));
handleChange(document.getElementById('none_students_no_1'));
handleChange(document.getElementById('reuse_students_no_1'));

validate = true;

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
