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
<title>Flash II</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/scholarship.js" type="text/javascript"></script>
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
    <table width="100%" class="ewTable">
      <tr align="center" class="ewTableHeader">
        <td colspan="21"><strong>Primary Level Scholarship</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> </td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 1</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 2</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 3</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 4</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 5</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> Scholarship for</td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">100% Primary Girls&nbsp;</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_1[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_2[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_3[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_4[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_5[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[1]" size="3" disabled></td>
      </tr>

      <tr class="ewTableAltRow">
        <td width="120">Girls from Karnali</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_1[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_2[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_3[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_4[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_5[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[2]" size="3" disabled></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">Dalit Students</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[3]" size="3" disabled></td>
      </tr>

      <tr class="ewTableAltRow">
        <td width="120">Janjati and Marginalized</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[4]" size="3" disabled></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">Disabled Students</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[5]" size="3" disabled></td>
      </tr>
      

      <tr class="ewTableRow">
        <td width="120">Conflict Victims</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[7]" size="3" disabled></td>
      </tr>
      

      <tr class="ewTableRow">
        <td width="120">Martyrs' Children</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[8]" size="3" disabled></td>
      </tr>
      

      <tr class="ewTableRow">
        <td width="120">Freed Kamalari</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_1[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_2[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_3[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_4[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_5[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[9]" size="3" disabled></td>
      </tr>
      
      <tr class="ewTableRow">
        <td width="120">Others</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_1[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_1[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_1[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_1[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_1[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_1[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_2[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_2[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_2[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_2[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_2[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_2[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_3[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_3[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_3[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_3[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_3[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_3[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_4[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_4[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_4[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_4[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_4[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_4[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_5[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_5[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_5[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_5[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_5[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_5[6]" size="3" disabled></td>
      </tr>      
    </table><br>

    <table width="100%" class="ewTable">
      <tr align="center" class="ewTableHeader">
        <td colspan="21"><strong>Lower Secondary and Secondary Level Scholarship</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> </td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 6</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 7</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 8</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 9</strong></td>

        <td width="10"></td>

        <td colspan="3"><strong>Class 10</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> Scholarship for</td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>

        <td width="10"></td>

        <td><strong>F</strong></td>

        <td><strong>M</strong></td>

        <td><strong>T</strong></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">Secondary level scholarship</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_6[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_7[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_8[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_9[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[1]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[1]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[1]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_10[1]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[1]" size="3" disabled></td>
      </tr>

      <tr class="ewTableAltRow">
        <td width="120">Girls from Karnali</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_6[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_7[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_8[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_9[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[2]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[2]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[2]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_10[2]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[2]" size="3" disabled></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">Dalit Students</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_6[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_7[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_8[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_9[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[3]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[3]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_10[3]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[3]" size="3" disabled></td>
      </tr>

      <tr class="ewTableAltRow">
        <td width="120">Janjati and Marginaized</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[4]" size="3" maxlength="3" ></td>

        <td><input type="text" name="sch_t_6[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[4]" size="3" maxlength="3" ></td>

        <td><input type="text" name="sch_t_7[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[4]" size="3" maxlength="3" ></td>

        <td><input type="text" name="sch_t_8[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[4]" size="3" maxlength="3" ></td>

        <td><input type="text" name="sch_t_9[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[4]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[4]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[4]" size="3" maxlength="3" ></td>

        <td><input type="text" name="sch_t_10[4]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[4]" size="3" disabled></td>
      </tr>

      <tr class="ewTableRow">
        <td>Disabled</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_6[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_7[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_8[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_9[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[5]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[5]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_10[5]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[5]" size="3" disabled></td>
      </tr>

      <tr class="ewTableAltRow">
        <td>War Victims</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_6[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_7[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_8[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_9[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[6]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[6]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_10[6]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[6]" size="3" disabled></td>
      </tr>

      <tr class="ewTableRow">
        <td width="120">Martyrs' Children</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_6[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_7[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_8[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_9[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[7]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[7]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_10[7]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[7]" size="3" disabled></td>
      </tr>      
      
      <tr class="ewTableRow">
        <td width="120">Freed Kamalari</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[8]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_6[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[8]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_7[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[8]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_8[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[8]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_9[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[8]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[8]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[8]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_10[8]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[8]" size="3" disabled></td>
      </tr>
      
      <tr class="ewTableRow">
        <td width="120">Feeder</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_6[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_7[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_8[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_9[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[9]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[9]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[9]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_10[9]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[9]" size="3" disabled></td>
      </tr>
      
      <tr class="ewTableRow">
        <td width="120">Remote Himali</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[10]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[10]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_6[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[10]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[10]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[10]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_7[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[10]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[10]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[10]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_8[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[10]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[10]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[10]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_9[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[10]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[10]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[10]" size="3" maxlength="3" disabled></td>

        <td><input type="text" name="sch_t_10[10]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[10]" size="3" disabled></td>
      </tr>
      
      <tr class="ewTableRow">
        <td width="120">Others</td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_6[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_6[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_6[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_6[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_6[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_6[11]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_7[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_7[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_7[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_7[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_7[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_7[11]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_8[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_8[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_8[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_8[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_8[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_8[11]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_9[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_9[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_9[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_9[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_9[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_9[11]" size="3" disabled></td>

        <td width="10"></td>

        <td><input type="text" name="sch_g_10[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_g_10[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_b_10[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_b_10[11]" size="3" maxlength="3"></td>

        <td><input type="text" name="sch_t_10[11]" onkeypress="return forceNumberInput(this, event);" onchange="cV(this);" id="sch_t_10[11]" size="3" disabled></td>
      </tr>
    </table><br>


</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

// load data

<?php


// get the number of enrolled students

        echo "var sn = new Array();\n";

        for ($i=1;$i<=12;$i++){
	
            if ($i>=1 && $i<=5) $table = 'class1_5_enroll_app';
            if ($i>=6 && $i<=8) $table = 'class6_8_enroll_app';
            if ($i>=9 && $i<=10) $table = 'class9_10_enroll_app';
            if ($i>=11 && $i<=12) $table = 'class11_12_enroll_app';
	
            $result = mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
	
            if (mysql_num_rows($result)==0) continue; // no data for that class
	
            $row = mysql_fetch_array($result);
	
            echo "sn['t_e_g_$i'] = '${row['tot_enroll_total_f']}';\n";
            echo "sn['t_e_b_$i'] = '${row['tot_enroll_total_m']}';\n";
            echo "sn['t_e_t_$i'] = '${row['tot_enroll_total_t']}';\n";
        }

        
for ($schid=1;$schid<=9;$schid++){
	for ($cl=1;$cl<=5;$cl++){
		
		$result = mysql_query("select * from pr_scholarship where sch_num='$sch_num' and sch_year='$currentyear' and class='$cl' and scholarship_type_id='$schid'");
		if (mysql_num_rows($result)==0) continue;
		$row = mysql_fetch_array($result);
		
		echo "document.forms[0]['sch_g_${cl}[$schid]'].value = '${row["female"]}';\n";
		echo "document.forms[0]['sch_b_${cl}[$schid]'].value = '${row["male"]}';\n";
		echo "document.forms[0]['sch_t_${cl}[$schid]'].value = '${row["total"]}';\n";
	
	}
}

for ($schid=1;$schid<=11;$schid++){
	for ($cl=6;$cl<=10;$cl++){
		
		$result = mysql_query("select * from lss_scholarship where sch_num='$sch_num' and sch_year='$currentyear' and class='$cl' and scholarship_type_id='$schid'");
		if (mysql_num_rows($result)==0) continue;
		$row = mysql_fetch_array($result);
		
		echo "document.forms[0]['sch_g_${cl}[$schid]'].value = '${row["female"]}';\n";
		echo "document.forms[0]['sch_b_${cl}[$schid]'].value = '${row["male"]}';\n";
		echo "document.forms[0]['sch_t_${cl}[$schid]'].value = '${row["total"]}';\n";
	
	}
}






//autofill from excel file
if (isset($_GET['af']))
{
   
     /*
      * this is the list of scholarship and the corresponding numeric value of each scholarship
    $sch_list=array("100% Primary Girls"=>1,
                    "Girls from Karnali"=>2,
                    "Dalit"=>3,
                    "Janajati and Marginalized"=>4,
                    "Disabled"=>5,
                    "Conflict Victims"=>6,
                    "Martyr's Children"=>7,
                    "Freed Kamalari"=>8,
                    "Secondary Level"=>9,
                    "War Victims"=>10,
                    "Feeder"=>11,
                    "Remote Himali"=>12,
                    "Others"=>13,
                );
     */
    
    $pri_sch_list=array(1,2,3,4,5,6,7,8,13);
    $i=0;
    foreach($pri_sch_list as $schid):
        $i++;
	for ($cl=1;$cl<=5;$cl++){
		foreach(array("F"=>"g","M"=>"b","T"=>"t") as $key2=>$sex):
                    $query="select count(*) as count from id_students_scholarship 
                                        left join id_students_main on id_students_scholarship.reg_id=id_students_main.reg_id 
                                        where id_students_scholarship.sch_num='$sch_num' and id_students_scholarship.sch_year='$currentyear' 
                                        and id_students_scholarship.scholarship='$schid' and id_students_scholarship.class='$cl'";
            
                    if($key2!=="T") 
                        $query.= " and id_students_main.gender='$key2'";  
                    $result = mysql_query($query);
                    if (mysql_num_rows($result)>0)
                    {
                        $row = mysql_fetch_array($result);
                        if($row['count'])
                        {
                            echo "document.forms[0]['sch_{$sex}_${cl}[$i]'].value = '${row['count']}';\n";
                             $row['count']=0;
                        }
                    }
                endforeach;
	}
    endforeach;
    
    
    $sec_sch_list=array(9,2,3,4,5,10,7,8,11,12,13);
    $i=0;
    foreach($sec_sch_list as $schid):
        $i++;
	for ($cl=6;$cl<=10;$cl++){
		foreach(array("F"=>"g","M"=>"b","T"=>"t") as $key2=>$sex):
                    $query="select count(*) as count from id_students_scholarship 
                                        left join id_students_main on id_students_scholarship.reg_id=id_students_main.reg_id 
                                        where id_students_scholarship.sch_num='$sch_num' and id_students_scholarship.sch_year='$currentyear' 
                                        and id_students_scholarship.scholarship='$schid' and id_students_scholarship.class='$cl'";
            
                    if($key2!=="T") 
                        $query.= " and id_students_main.gender='$key2'";  
                    $result = mysql_query($query);
                    if (mysql_num_rows($result)>0)
                    {
                        $row = mysql_fetch_array($result);
                        if($row['count'])
                        {
                            echo "document.forms[0]['sch_{$sex}_${cl}[$i]'].value = '${row['count']}';\n";
                             $row['count']=0;
                        }
                    }
                endforeach;
	}
    endforeach;
}







// get the number of enrolled students

echo "var sn = new Array();\n";

for ($i=1;$i<=12;$i++){
	
	if ($i>=1 && $i<=5) $table = 'class1_5_enroll_app';
	if ($i>=6 && $i<=8) $table = 'class6_8_enroll_app';
	if ($i>=9 && $i<=10) $table = 'class9_10_enroll_app';
	if ($i>=11 && $i<=12) $table = 'class11_12_enroll_app';
	
	$result = mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
	
	if (mysql_num_rows($result)==0) continue; // no data for that class
	
	$row = mysql_fetch_array($result);
	
	echo "sn['t_e_g_$i'] = '${row['tot_enroll_total_f']}';\n";
	echo "sn['t_e_b_$i'] = '${row['tot_enroll_total_m']}';\n";
	echo "sn['t_e_t_$i'] = '${row['tot_enroll_total_t']}';\n";
	
	echo "sn['d_e_g_$i'] = '${row['tot_enroll_dalit_f']}';\n";
	echo "sn['d_e_b_$i'] = '${row['tot_enroll_dalit_m']}';\n";
	echo "sn['d_e_t_$i'] = '${row['tot_enroll_dalit_t']}';\n";
	
	echo "sn['j_e_g_$i'] = '${row['tot_enroll_janjati_f']}';\n";
	echo "sn['j_e_b_$i'] = '${row['tot_enroll_janjati_m']}';\n";
	echo "sn['j_e_t_$i'] = '${row['tot_enroll_janjati_t']}';\n";
	
}


?>

// items to disable
// karnali region

var d = currentSchoolCode.substr(0,2);
for (cl=1;cl<=5;++cl){
	document.getElementById('sch_g_'+cl+'[2]').disabled=(d>=62&&d<=66)?false:true;
	document.getElementById('sch_g_'+cl+'[9]').disabled=(d==56 || d==57 || d==58 || d==71 || d==72)?false:true;
}

for (cl=6;cl<=10;++cl){
	document.getElementById('sch_g_'+cl+'[2]').disabled=(d>=62&&d<=66)?false:true;
	document.getElementById('sch_g_'+cl+'[8]').disabled=(d==56 || d==57 || d==58 || d==71 || d==72)?false:true;
}

// disable classes
for (cl=1;cl<=5;++cl){
	for (l=1;l<=9;++l){
		if (classes[cl]==0 || (classes[cl]>4 && classes[cl]<8 && l!=6)) {
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=true;
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=true;
		}
	}

}

for (cl=6;cl<=10;++cl){
	for (l=1;l<=11;++l){
		if (classes[cl]==0 || (classes[cl]>4 && classes[cl]<8 && l!=11)) {
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=true;
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=true;
		}
	}

}
  //disable marks field if there are no students enrolled in that class
        var types=new Array("g","b","t");
        for(var grade=1;grade<=10;grade++)
        {
                if(!sn['t_e_'+types[index]+'_'+grade])
                {
                    for(var subj=1;subj<=15;subj++)
                    {
                     if(document.getElementById('sch_'+types+'_'+grade+'['+subj+']'))
                        document.getElementById('sch_'+types+'_'+grade+'['+subj+']').disabled = true;
                    }
                }
        }



/*
// items to disable

// karnali region
var d = currentSchoolCode.substr(0,2);

// disable primary sch # 1
for (cl=1;cl<=5;++cl){
	document.getElementById('sch_g_'+cl+'[1]').disabled=(d>=62&&d<=66)?true:false;
	document.getElementById('sch_g_'+cl+'[2]').disabled=(d>=62&&d<=66)?false:true;
	document.getElementById('sch_g_'+(cl+5)+'[2]').disabled= (d>=62&&d<=66)?false:true;
	
	
	document.getElementById('sch_g_'+(cl+5)+'[6]').disabled = 
		document.getElementById('sch_b_'+(cl+5)+'[6]').disabled = (d==15 || d==16 || d==35 || d==59)?false:true;
	
	
}

// disable classes
for (cl=1;cl<=5;++cl){
	for (l=1;l<=9;++l){
	
		if (classes[cl]==0) {
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=true;
			//if (l>2) 
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=true;
		}
		else{
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=false;
			//if (l>2) 
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=false;
		}
	}

}

for (cl=6;cl<=10;++cl){
	for (l=1;l<=11;++l){
	
		if (classes[cl]==0) {
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=true;
			//if (l!=2 && l!=4) 
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=true;
		}
		else{
			document.getElementById('sch_g_'+cl+'['+l+']').disabled=false;
			//if (l!=2 && l!=4) 
			document.getElementById('sch_b_'+cl+'['+l+']').disabled=false;
		}
	}

}	

// karnali region
var d = currentSchoolCode.substr(0,2);

// disable primary sch # 1
for (cl=1;cl<=5;++cl){
	if (classes[cl]>0){
		document.getElementById('sch_g_'+cl+'[1]').disabled=(d>=62&&d<=66)?true:false;
		document.getElementById('sch_g_'+cl+'[2]').disabled=(d>=62&&d<=66)?false:true;
	
	}
	if (classes[cl+5]>0){
		document.getElementById('sch_g_'+(cl+5)+'[2]').disabled= (d>=62&&d<=66)?false:true;
		document.getElementById('sch_g_'+(cl+5)+'[6]').disabled = 
			document.getElementById('sch_b_'+(cl+5)+'[6]').disabled = (d==15 || d==16 || d==35 || d==59)?false:true;
	
	}
	

}

*/


</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
