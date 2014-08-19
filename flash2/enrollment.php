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
<script src="js/enrollment.js" type="text/javascript"></script>
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


<table width="100%" border="0" cellpadding="4" cellspacing="4" height="17" class="ewTable">
<tbody>
  <tr class="ewTableRow">
    <td width="238" height="5">SMC Formation Date (YY/MM/DD)<br>
    <input maxlength="4" size="4" name="smc_y" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_y"> <input maxlength="2" size="3" name="smc_m" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_m"> <input maxlength="2" size="3" name="smc_d" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_d"></td>

    <td width="204" height="5">Formation Method<br>
    <select name="smc_method" onkeypress="return generalKeyPress(this, event);" onchange="a5V(this);" id="smc_method">
      <option selected value='0'>
        N/A
      </option>

      <option value='1'>
        Selection
      </option>

      <option value='2'>
        Election
      </option>
    </select></td>

    <td width="82">Total<br>
    <input maxlength="2" size="3" name="smc_tot_t" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_tot_t"></td>

    <td width="113" height="5">Female<br>
    <input maxlength="2" size="3" name="smc_tot_f" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_tot_f"></td>

    <td width="110" height="5">Dalit<br>
    <input maxlength="2" size="3" name="smc_tot_d" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_tot_d"></td>

    <td width="150">Janjati<br>
    <input maxlength="2" size="3" name="smc_tot_j" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="smc_tot_j"></td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="4" cellspacing="4" height="17" class="ewTable">
<tbody>
  <tr class="ewTableAltRow">
    <td width="239" height="5">PTA Formation Date (YY/MM/DD)<br>
    <input maxlength="4" size="4" name="pta_y" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_y"> <input maxlength="2" size="3" name="pta_m" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_m"> <input maxlength="2" size="3" name="pta_d" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_d"></td>

    <td width="205" height="5">Formation Method<br>
    <select name="pta_method" onkeypress="return generalKeyPress(this, event);" onchange="a5V(this);" id="pta_method">
      <option selected value='0'>
        N/A
      </option>

      <option value='1'>
        Selection
      </option>

      <option value='2'>
        Election
      </option>
    </select></td>

    <td width="80">Total<br>
    <input maxlength="2" size="3" name="pta_tot_t" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_tot_t"></td>

    <td width="113" height="5">Female<br>
    <input maxlength="2" size="3" name="pta_tot_f" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_tot_f"></td>

    <td width="110" height="5">Dalit<br>
    <input maxlength="2" size="3" name="pta_tot_d" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_tot_d"></td>

    <td width="150">Janjati<br>
    <input maxlength="2" size="3" name="pta_tot_j" onkeypress="return forceNumberInput(this, event);" onchange="a5V(this);" id="pta_tot_j"></td>
  </tr>
</tbody>
</table>

<br />

  <table width="100%" class="ewTable">
    <tbody>
      <tr align="center" class="ewTableHeader"> 
        <td> </td>
        <td colspan="7"><strong>Total</strong></td>
        <td width="10"></td>
        <td colspan="7"><strong>Dalit</strong></td>
        <td width="10"></td>
        <td colspan="7"><strong>Janjati</strong></td>
      </tr>
      <tr align="center" class="ewTableHeader"> 
        <td> </td>
        <td colspan="3"><strong>Enrollment</strong></td>
        <td width="10"></td>
        <td colspan="3"><strong>Appeared in Exam</strong></td>
        <td width="10"></td>
        <td colspan="3"><strong>Enrollment</strong></td>
        <td width="10"></td>
        <td colspan="3"><strong>Appeared in Exam</strong></td>
        <td width="10"></td>
        <td colspan="3"><strong>Enrollment</strong></td>
        <td width="10"></td>
        <td colspan="3"><strong>Appeared in Exam</strong></td>
      </tr>
      <tr align="center" class="ewTableHeader"> 
        <td> </td>
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
        <td width="10"></td>
        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>
      </tr>
      <tr class="ewTableRow"> 
        <td width="100">Grade 1</td>
        <td><input type="text" name="t_e_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[1]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[1]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[1]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[1]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[1]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[1]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[1]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[1]" disabled size="3"></td>
      </tr>
      <tr class="ewTableAltRow"> 
        <td> <p class="c5">Grade 2</p></td>
        <td><input type="text" name="t_e_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[2]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[2]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[2]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[2]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[2]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[2]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[2]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[2]" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td> <p class="c5">Grade 3</p></td>
        <td><input type="text" name="t_e_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[3]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[3]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[3]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[3]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[3]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[3]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[3]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[3]" disabled size="3"></td>
      </tr>
      <tr class="ewTableAltRow"> 
        <td>Grade 4</td>
        <td><input type="text" name="t_e_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[4]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[4]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[4]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[4]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[4]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[4]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[4]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[4]" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td>Grade 5</td>
        <td><input type="text" name="t_e_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[5]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[5]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[5]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[5]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[5]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[5]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[5]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[5]" disabled size="3"></td>
      </tr>
      <tr class="ewTableFooter"> 
        <td>Grade 1-5 Total</td>
        <td><input type="text" name="t_e_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t_15" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t_15" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t_15" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t_15" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t_15" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b_15" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t_15" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t_15" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td> <p class="c5">Grade 6</p></td>
        <td><input type="text" name="t_e_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[6]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[6]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[6]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[6]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[6]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[6]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[6]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[6]" disabled size="3"></td>
      </tr>
      <tr class="ewTableAltRow"> 
        <td>Grade 7</td>
        <td><input type="text" name="t_e_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[7]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[7]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[7]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[7]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[7]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[7]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[7]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[7]" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td>Grade 8</td>
        <td><input type="text" name="t_e_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[8]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[8]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[8]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[8]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[8]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[8]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[8]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[8]" disabled size="3"></td>
      </tr>
      <tr class="ewTableFooter"> 
        <td>Grade 6-8 Total</td>
        <td><input type="text" name="t_e_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t_68" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t_68" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t_68" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t_68" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t_68" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b_68" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t_68" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t_68" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td>Grade 9</td>
        <td><input type="text" name="t_e_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[9]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[9]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[9]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[9]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[9]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[9]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[9]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[9]" disabled size="3"></td>
      </tr>
      <tr class="ewTableAltRow"> 
        <td>Grade 10</td>
        <td><input type="text" name="t_e_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[10]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[10]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[10]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[10]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[10]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[10]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[10]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[10]" disabled size="3"></td>
      </tr>
      <tr class="ewTableFooter"> 
        <td>Grade 9-10 Total</td>
        <td><input type="text" name="t_e_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t_910" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t_910" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t_910" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t_910" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t_910" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b_910" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t_910" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t_910" disabled size="3"></td>
      </tr>
      <tr class="ewTableRow"> 
        <td>Grade 11</td>
        <td><input type="text" name="t_e_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[11]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[11]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[11]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[11]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[11]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[11]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[11]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[11]" disabled size="3"></td>
      </tr>
      <tr class="ewTableAltRow"> 
        <td>Grade 12</td>
        <td><input type="text" name="t_e_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t[12]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t[12]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t[12]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t[12]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t[12]" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b[12]" maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t[12]" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t[12]" disabled size="3"></td>
      </tr>
      <tr class="ewTableFooter"> 
        <td>Grade 11-12 Total</td>
        <td><input type="text" name="t_e_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_e_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_e_t_1112" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="t_a_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="t_a_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="t_a_t_1112" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_e_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_e_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_e_t_1112" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="d_a_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="d_a_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="d_a_t_1112" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_e_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_e_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_e_t_1112" disabled size="3"></td>
        <td width="10"></td>
        <td><input type="text" name="j_a_g_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_g_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_b_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_b_1112" disabled maxlength="3" size="3"></td>
        <td><input type="text" name="j_a_t_1112" onkeypress="return forceNumberInput(this, event);" onchange="bV(this);" id="j_a_t_1112" disabled size="3"></td>
      </tr>
    </tbody>
  </table>
  
  <br>

    <table width="100%" class="ewTable">
      <tbody>
        <tr align="center" class="ewTableHeader">
          <td colspan="15"><strong>Attendance</strong></td>
        </tr>

        <tr class="ewTableHeader">
          <td width="83">
            <div class="c4">
              <strong>Grades</strong>
            </div>

            <div class="c4"></div>
          </td>

          <td width="63">
            <div class="c4">
              <strong>ECD</strong>
            </div>
          </td>

          <td width="52">
            <div class="c4">
              <strong>1</strong>
            </div>
          </td>

          <td width="49">
            <div class="c4">
              <strong>2</strong>
            </div>
          </td>

          <td width="48">
            <div class="c4">
              <strong>3</strong>
            </div>
          </td>

          <td width="49">
            <div class="c4">
              <strong>4</strong>
            </div>
          </td>

          <td width="49">
            <div class="c4">
              <strong>5</strong>
            </div>
          </td>

          <td width="53">
            <div class="c4">
              <strong>6</strong>
            </div>
          </td>

          <td width="51">
            <div class="c4">
              <strong>7</strong>
            </div>
          </td>

          <td width="48">
            <div class="c4">
              <strong>8</strong>
            </div>
          </td>

          <td width="50">
            <div class="c4">
              <strong>9</strong>
            </div>
          </td>

          <td width="65">
            <div class="c4">
              <strong>10</strong>
            </div>
          </td>

          <td width="65">
            <div class="c4">
              <strong>11</strong>
            </div>
          </td>

          <td width="65">
            <div class="c4">
              <strong>12</strong>
            </div>
          </td>

          <td width="65">
            <div class="c4">
              <strong>Total</strong>
            </div>
          </td>
        </tr>

        <tr class="ewTableRow">
          <td>
            <div class="c4">
              <?php echo $currentyear; ?>/2/31
            </div>

            <div class="c4"></div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_0" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_0" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_1" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_1" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_2" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_2" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_3" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_3" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_4" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_4" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_5" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_5" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_6" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_6" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_7" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_7" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_8" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_8" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_9" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_9" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_10" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_10" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_11" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_11" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_12" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_12" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_1_tot" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_1_tot" size="3" maxlength="3" disabled>
            </div>
          </td>
        </tr>

        <tr class="ewTableAltRow">
          <td>
            <div class="c4">
              <?php echo $currentyear; ?>/6/12
            </div>

            <div class="c4"></div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_0" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_0" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_1" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_1" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_2" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_2" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_3" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_3" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_4" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_4" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_5" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_5" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_6" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_6" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_7" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_7" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_8" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_8" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_9" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_9" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_10" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_10" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_11" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_11" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_12" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_12" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_2_tot" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_2_tot" size="3" maxlength="3" disabled>
            </div>
          </td>
        </tr>

        <tr class="ewTableRow">
          <td>
            <div class="c4">
              <?php echo $currentyear; ?>/11/14
            </div>

            <div class="c4"></div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_0" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_0" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_1" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_1" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_2" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_2" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_3" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_3" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_4" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_4" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_5" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_5" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_6" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_6" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_7" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_7" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_8" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_8" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_9" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_9" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_10" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_10" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_11" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_11" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_12" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_12" size="3" maxlength="3">
            </div>
          </td>

          <td>
            <div class="c4">
              <input type="text" name="enr_3_tot" onkeypress="return forceNumberInput(this, event);" onchange="b2V(this);" id="enr_3_tot" size="3" maxlength="3" disabled>
            </div>
          </td>
        </tr>
      </tbody>
    </table>  


</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

<?php

// smc data	
$result=mysql_query("select * from inf_sch_smc where sch_num='$sch_num' order by sch_year desc");
$row = mysql_fetch_array($result);

echo "document.forms[0]['smc_y'].value = '${row['smc_year']}';\n";
echo "document.forms[0]['smc_m'].value = '${row['smc_month']}';\n";
echo "document.forms[0]['smc_d'].value = '${row['smc_day']}';\n";
if ($row['election']==1) echo "document.forms[0]['smc_method'].value = '2';\n";
if ($row['selection']==1) echo "document.forms[0]['smc_method'].value = '1';\n";
echo "document.forms[0]['smc_tot_t'].value = '${row['tot_members']}';\n";
echo "document.forms[0]['smc_tot_f'].value = '${row['tot_f']}';\n";
echo "document.forms[0]['smc_tot_d'].value = '${row['tot_dalit']}';\n";
echo "document.forms[0]['smc_tot_j'].value = '${row['tot_janjati']}';\n";

//pta data
$result=mysql_query("select * from inf_sch_pta where sch_num='$sch_num' order by sch_year desc");
$row = mysql_fetch_array($result);

echo "document.forms[0]['pta_y'].value = '${row['pta_year']}';\n";
echo "document.forms[0]['pta_m'].value = '${row['pta_month']}';\n";
echo "document.forms[0]['pta_d'].value = '${row['pta_day']}';\n";
if ($row['election']==1) echo "document.forms[0]['pta_method'].value = '2';\n";
if ($row['selection']==1) echo "document.forms[0]['pta_method'].value = '1';\n";
echo "document.forms[0]['pta_tot_t'].value = '${row['tot_members']}';\n";
echo "document.forms[0]['pta_tot_f'].value = '${row['tot_f']}';\n";
echo "document.forms[0]['pta_tot_d'].value = '${row['tot_dalit']}';\n";
echo "document.forms[0]['pta_tot_j'].value = '${row['tot_janjati']}';\n";


if (isset($_GET['af'])) {
    
         //autofill from student id
         foreach(array('3'=>'t','2'=>'j','1'=>'d') as $key1=>$value1):
            foreach(array('M'=>'b','F'=>'g') as $key2=>$value2):
                   for($class=1;$class<=12;$class++):
                       if($classes[$class]==0) continue;
                       
                       $query1="select count(*) as count from id_students_main 
                                left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                                where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                                and id_students_track.class={$class}
                                and id_students_main.gender='$key2'";
                        if($key1!='3')
                            $query1.= " and id_students_main.caste='$key1'";
                        
                        $result1 = mysql_query($query1);
                        $row1 = mysql_fetch_array($result1);
                        if($row1['count'])
                        {
                            echo "document.forms[0]['{$value1}_e_{$value2}[{$class}]'].value='${row1['count']}';\n";
                            echo "bV(document.getElementById('{$value1}_e_{$value2}[{$class}]'));\n";
                        }
                        
                        //now autofill exam appeared and exam passed
                        $query2="select count(*) as appeared,
                                count(case when (id_students_marks.nepali > '31' and id_students_marks.english > '31' 
                                and id_students_marks.maths > '31' and id_students_marks.social_studies > '31' 
                                and id_students_marks.science > '31' and id_students_marks.population_env > '31') THEN 1 END) as passed
                                from id_students_marks 
                                left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                                where id_students_marks.sch_num='$sch_num' 
                                and id_students_marks.sch_year='$currentyear' 
                                and id_students_marks.class={$class}
                                and id_students_main.gender='$key2'";
                        if($key1!='3')
                            $query2.= " and id_students_main.caste='$key1'";
                       
                        $result2 = mysql_query($query2);
                        $row2 = mysql_fetch_array($result2);
                        //display total students appeared in exam and passed count
                        foreach(array("appeared") as $type):
                            if($row2[$type])
                            {
                                echo "document.forms[0]['{$value1}_a_{$value2}[{$class}]'].value='${row2[$type]}';\n";
                                echo "bV(document.getElementById('{$value1}_a_{$value2}[{$class}]'));\n";
                            }
                        endforeach;
                    endfor;
            endforeach;
        endforeach;
}

else {

	// enrollment data
	for ($i=1;$i<=12;$i++){
		
		if ($i>=1 && $i<=5) $table = 'class1_5_enroll_app';
		if ($i>=6 && $i<=8) $table = 'class6_8_enroll_app';
		if ($i>=9 && $i<=10) $table = 'class9_10_enroll_app';
		if ($i>=11 && $i<=12) $table = 'class11_12_enroll_app';
		
		$result = mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
		
		if (mysql_num_rows($result)==0) continue; // no data for that class
		
		echo "autoFillEnabled = false;\n";
		
		$row = mysql_fetch_array($result);
		
		echo "document.forms[0]['t_e_g[$i]'].value = '${row['tot_enroll_total_f']}';\n";
		echo "document.forms[0]['t_e_b[$i]'].value = '${row['tot_enroll_total_m']}';\n";
		echo "document.forms[0]['t_e_t[$i]'].value = '${row['tot_enroll_total_t']}';\n";
		echo "document.forms[0]['t_a_g[$i]'].value = '${row['tot_appeared_exam_total_f']}';\n";
		echo "document.forms[0]['t_a_b[$i]'].value = '${row['tot_appeared_exam_total_m']}';\n";
		echo "document.forms[0]['t_a_t[$i]'].value = '${row['tot_appeared_exam_total_t']}';\n";
		echo "document.forms[0]['d_e_g[$i]'].value = '${row['tot_enroll_dalit_f']}';\n";
		echo "document.forms[0]['d_e_b[$i]'].value = '${row['tot_enroll_dalit_m']}';\n";
		echo "document.forms[0]['d_e_t[$i]'].value = '${row['tot_enroll_dalit_t']}';\n";
		echo "document.forms[0]['d_a_g[$i]'].value = '${row['tot_appeared_exam_dalit_f']}';\n";
		echo "document.forms[0]['d_a_b[$i]'].value = '${row['tot_appeared_exam_dalit_m']}';\n";
		echo "document.forms[0]['d_a_t[$i]'].value = '${row['tot_appeared_exam_dalit_t']}';\n";
		echo "document.forms[0]['j_e_g[$i]'].value = '${row['tot_enroll_janjati_f']}';\n";
		echo "document.forms[0]['j_e_b[$i]'].value = '${row['tot_enroll_janjati_m']}';\n";
		echo "document.forms[0]['j_e_t[$i]'].value = '${row['tot_enroll_janjati_t']}';\n";
		echo "document.forms[0]['j_a_g[$i]'].value = '${row['tot_appeared_exam_janjati_f']}';\n";
		echo "document.forms[0]['j_a_b[$i]'].value = '${row['tot_appeared_exam_janjati_m']}';\n";
		echo "document.forms[0]['j_a_t[$i]'].value = '${row['tot_appeared_exam_janjati_t']}';\n";
		
		echo "bV(document.forms[0]['t_e_g[$i]']);\n";
		echo "bV(document.forms[0]['t_a_g[$i]']);\n";
		echo "bV(document.forms[0]['d_e_g[$i]']);\n";
		echo "bV(document.forms[0]['d_a_g[$i]']);\n";
		echo "bV(document.forms[0]['j_e_g[$i]']);\n";
		echo "bV(document.forms[0]['j_a_g[$i]']);\n";
		echo "bV(document.forms[0]['t_e_b[$i]']);\n";
		echo "bV(document.forms[0]['t_a_b[$i]']);\n";
		echo "bV(document.forms[0]['d_e_b[$i]']);\n";
		echo "bV(document.forms[0]['d_a_b[$i]']);\n";
		echo "bV(document.forms[0]['j_e_b[$i]']);\n";
		echo "bV(document.forms[0]['j_a_b[$i]']);\n";	
		
	}

} // end of if-autofill-else

// attendance
for ($i=1;$i<=3;$i++){
	if ($i==1) $dte="1";
	if ($i==2) $dte="2";
	if ($i==3) $dte="3";
	
	$result = mysql_query("select * from attendance where sch_num='$sch_num' and sch_year='$currentyear' and attendance_date='$dte'");
	if (mysql_num_rows($result)==0) continue;
	$row = mysql_fetch_array($result);

	echo "document.forms[0]['enr_".$i."_0'].value = '${row['ecd']}';\n";
	$adt['ecd']=$_POST["enr_${i}_0"];
	for ($cl=1;$cl<=12;$cl++){
		echo "document.forms[0]['enr_".$i."_$cl'].value = '${row["class$cl"]}';\n";
	}
	
	echo "b2V(document.forms[0]['enr_".$i."_0']);\n";
	
}



?>


// items to disable

var types="t_e_g t_a_g d_e_g d_a_g j_e_g j_a_g t_e_b t_a_b d_e_b d_a_b j_e_b j_a_b";
var arr = types.split(" ");
var item='';
for (n=0;n<arr.length;++n){
	item=arr[n];
	for (i=1;i<=12;++i){
		document.getElementById(item+'['+i+']').disabled = (classes[i]==0?true:false);
		
	}		
}

for (i=1;i<=3;++i){
	for (j=0;j<=12;++j){
		document.getElementById('enr_'+i+'_'+j).disabled = (classes[j]==0?true:false);
	}
}

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
