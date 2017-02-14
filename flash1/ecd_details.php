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
<title>Flash I - ECD Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/ecd_details.js" type="text/javascript"></script>
<?php 
$classes=schoolclasses($sch_num); 

if (isset($_GET['n'])) $currentecd = $_GET['n']; else $currentecd='1';
echo "<script>var currentEcd = '$currentecd';</script>\n";

//to disable fields when ecd is community aided
echo "<script>var communityAided=1;</script>\n";
if($classes[0]>=5 && $classes[0]<8)
    echo "<script>communityAided=0;</script>\n";
?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

<span id='ecdjump'>
<?php

/*$result = mysql_query("select distinct ecd_num from ecdppc_enroll_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
$total_ecds = mysql_num_rows($result);
*/
$total_ecds=1;
if ($total_ecds>0){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Select ECD #</b>\n";
	echo "<select id='selectedECD' onchange=\"location = currentPage+'?s='+currentSchoolCode+'&n='+this.value\">\n";
	
	if (isset($_GET['n'])) $currentecd = $_GET['n']; else $currentecd='1';
		
	for ($i=1;$i<=$total_ecds;$i++){
		if ($i==$currentecd) echo "<option value='$i' selected>ECD #$i\n";
		else echo "<option value='$i'>ECD #$i\n";
	}
	if ($currentecd>$total_ecds) echo "<option value='$currentecd' selected>ECD #$currentecd\n";
	echo "</select>\n";
	
}
echo "<input type='button' value='Save & New ECD' onclick='newecd(".($currentecd+1).")'>\n";
echo "<input type='button' value='Delete this ECD' onclick='deleteecd()'>\n";
?>

</span>
</p>
<form action="controller.php" method="post">

<input type="hidden" name='ecd_num' id='ecd_num' value="<?php echo $currentecd; ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable" style="margin-bottom: 12px;">

  <tr> 
    <td width="20%" class="ewTableHeader">Established Year</td>
    <td>
      <input name="estd_year" id="estd_year" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
       &nbsp; &nbsp; Parent School Code <input name="parent_sch_num" id="parent_sch_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="12" maxlength="9">
	  </td>
  </tr>

  
  <tr> 
    <td width="25%" class="ewTableHeader">ECD Type</td>
    <td>
        <select name="ecd_type" id="ecd_type" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
            <option value="0"></option>
            <option value="1">School Based</option>
            <option value="2">Community Based</option>
      </select>
    </td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">If Community run, </td>
    <td>
      <span id='vdcspan'></span>
      Ward <input name="ecd_ward" id="ecd_ward" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="2" disabled>
      Tole <input name="ecd_tole" id="ecd_tole" type="text" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" size="20" maxlength="30" disabled>
	  </td>
  </tr>  
  <tr>
    <td width="20%" class="ewTableHeader">If run by NGO/INGO</td>
    <td >Name <input name="ecd_ngo_name" type="text" id="ecd_ngo_name" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" size="30" maxlength="100" disabled>
    &nbsp;&nbsp;&nbsp;&nbsp;Address <input name="ecd_ngo_add" type="text" id="ecd_ngo_add" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" size="20" maxlength="100" disabled></td>
  </tr>  
  
</table>

<div id="disable_div">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable" id="ecdTable">
  <tr class="ewTableHeader"> 
    <td rowspan="2">ECD/PPC</td>
    <td colspan="3" align="center">Total</td>
    <td colspan="3" align="center">Dalit</td>
    <td colspan="3" align="center">Janjati</td>
    <td colspan="3" align="center">New Enroll</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td align="center">F</td>
    <td align="center">M</td>
    <td align="center">T</td>
    <td align="center">F</td>
    <td align="center">M</td>
    <td align="center">T</td>
    <td align="center">F</td>
    <td align="center">M</td>
    <td align="center">T</td>
    <td align="center">F</td>
    <td align="center">M</td>
    <td align="center">T</td>
  </tr>
  <tr> 
    <td class="ewTableHeader">ECD</td>
    <td><input name="ep_t_g[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_t_b[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_t_t[1]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[1]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_d_b[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_d_t[1]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[1]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_j_b[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_j_t[1]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[1]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_a_b[1]" class="ecd" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[1]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'disabled':''; ?>></td>
    <td><input name="ep_a_t[1]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[1]" type="text" size="5" maxlength="3" disabled></td>
    
  </tr>
  <tr> 
    <td class="ewTableHeader">PPC</td>
    <td><input name="ep_t_g[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_t_b[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_t_t[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_b[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_t[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_b[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_t[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_b[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[2]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_t[2]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[2]" type="text" size="5" maxlength="3" disabled></td>

	</tr>
  <tr> 
    <td class="ewTableHeader">Nursery</td>
    <td><input name="ep_t_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_t[3]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[3]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_t[3]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[3]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_t[3]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[3]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_b[3]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[3]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_t[3]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[3]" type="text" size="5" maxlength="3" disabled></td>
    
  </tr>
  <tr> 
    <td class="ewTableHeader">LKG</td>
    <td><input name="ep_t_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_t[4]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[4]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_t[4]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[4]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_t[4]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[4]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_b[4]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_t[4]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[4]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?> disabled></td>
    
  </tr>
  <tr> 
    <td class="ewTableHeader">UKG</td>
    <td><input name="ep_t_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_t[5]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[5]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_t[5]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[5]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_t[5]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[5]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_b[5]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[5]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_t[5]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[5]" type="text" size="5" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td class="ewTableHeader">KG</td>
    <td><input name="ep_t_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_g[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_b[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_t_t[6]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_t_t[6]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_d_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_g[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_b[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_d_t[6]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_d_t[6]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_j_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_g[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_b[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_j_t[6]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_j_t[6]" type="text" size="5" maxlength="3" disabled></td>
    <td><input name="ep_a_g[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_g[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_b[6]" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_b[6]" type="text" size="5" maxlength="3" <?php echo ($classes[0]>=5 && $classes[0]<=7)?'':'disabled'; ?>></td>
    <td><input name="ep_a_t[6]" class="total" onkeypress="return forceNumberInput(this, event);" onchange="ecdBV(this);" id="ep_a_t[6]" type="text" size="5" maxlength="3" disabled></td>
   
  </tr>
</table>

<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="10">Enrollment by Age</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td width="15%" rowspan="2">Age</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
  </tr>
  <tr class="ewTableHeader"> 
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
    <td>&lt;3 years</td>
    <td><input name="ecd_age_total_f_0" type="text" id="ecd_age_total_f_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_m_0" type="text" id="ecd_age_total_m_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_t_0" class="total" type="text" id="ecd_age_total_t_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_0" type="text" id="ecd_age_dalit_f_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_m_0" type="text" id="ecd_age_dalit_m_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_t_0" class="total" type="text" id="ecd_age_dalit_t_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_0" type="text" id="ecd_age_janjati_f_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_m_0" type="text" id="ecd_age_janjati_m_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_t_0" class="total" type="text" id="ecd_age_janjati_t_0" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>3 years</td>
    <td><input name="ecd_age_total_f_1" type="text" id="ecd_age_total_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_m_1" type="text" id="ecd_age_total_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_t_1" class="total" type="text" id="ecd_age_total_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_1" type="text" id="ecd_age_dalit_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_m_1" type="text" id="ecd_age_dalit_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_t_1" class="total" type="text" id="ecd_age_dalit_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_1" type="text" id="ecd_age_janjati_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_m_1" type="text" id="ecd_age_janjati_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_t_1" class="total" type="text" id="ecd_age_janjati_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>4 years</td>
    <td><input name="ecd_age_total_f_2" type="text" id="ecd_age_total_f_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_m_2" type="text" id="ecd_age_total_m_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_t_2" class="total" type="text" id="ecd_age_total_t_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_2" type="text" id="ecd_age_dalit_f_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_m_2" type="text" id="ecd_age_dalit_m_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_t_2" class="total" type="text" id="ecd_age_dalit_t_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_2" type="text" id="ecd_age_janjati_f_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_m_2" type="text" id="ecd_age_janjati_m_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_t_2" class="total" type="text" id="ecd_age_janjati_t_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>5 years</td>
    <td><input name="ecd_age_total_f_3" type="text" id="ecd_age_total_f_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_m_3" type="text" id="ecd_age_total_m_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_t_3" class="total" type="text" id="ecd_age_total_t_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_3" type="text" id="ecd_age_dalit_f_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_m_3" type="text" id="ecd_age_dalit_m_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_t_3" class="total" type="text" id="ecd_age_dalit_t_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_3" type="text" id="ecd_age_janjati_f_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_m_3" type="text" id="ecd_age_janjati_m_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_t_3" class="total" type="text" id="ecd_age_janjati_t_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>&gt; 5 years</td>
    <td><input name="ecd_age_total_f_4" type="text" id="ecd_age_total_f_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_m_4" type="text" id="ecd_age_total_m_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_total_t_4" class="total" type="text" id="ecd_age_total_t_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_4" type="text" id="ecd_age_dalit_f_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_m_4" type="text" id="ecd_age_dalit_m_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_dalit_t_4" class="total" type="text" id="ecd_age_dalit_t_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_4" type="text" id="ecd_age_janjati_f_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_m_4" type="text" id="ecd_age_janjati_m_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_age_janjati_t_4" class="total" type="text" id="ecd_age_janjati_t_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Total</td>
    <td><input name="ecd_age_total_f_5" type="text" id="ecd_age_total_f_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_total_m_5" type="text" id="ecd_age_total_m_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_total_t_5" class="total" type="text" id="ecd_age_total_t_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_f_5" type="text" id="ecd_age_dalit_f_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_m_5" type="text" id="ecd_age_dalit_m_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_dalit_t_5" class="total" type="text" id="ecd_age_dalit_t_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_f_5" type="text" id="ecd_age_janjati_f_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_m_5" type="text" id="ecd_age_janjati_m_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_age_janjati_t_5" class="total" type="text" id="ecd_age_janjati_t_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
</table>

</div>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<!-- <div id="nextbtn" style="clear:none; float:right"></div> -->
<p>&nbsp;</p>
<script>




<?php
// default parent school code
echo "document.forms[0]['parent_sch_num'].value = '$sch_num';\n";

// students

for ($i=1;$i<=6;$i++){
	
	$result = mysql_query("select * from ecdppc_enroll_f1 where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd' and ecd_class_type='$i'");		
	
	if (mysql_num_rows($result)==0) continue;
	
	$row = mysql_fetch_array($result);
	
	echo "document.forms[0]['ep_t_g[$i]'].value = '${row['tot_enroll_total_f']}';\n";
	echo "document.forms[0]['ep_t_b[$i]'].value = '${row['tot_enroll_total_m']}';\n";
	echo "document.forms[0]['ep_t_t[$i]'].value = '${row['tot_enroll_total_t']}';\n";
	echo "document.forms[0]['ep_d_g[$i]'].value = '${row['tot_enroll_dalit_f']}';\n";
	echo "document.forms[0]['ep_d_b[$i]'].value = '${row['tot_enroll_dalit_m']}';\n";
	echo "document.forms[0]['ep_d_t[$i]'].value = '${row['tot_enroll_dalit_t']}';\n";
	echo "document.forms[0]['ep_j_g[$i]'].value = '${row['tot_enroll_janjati_f']}';\n";
	echo "document.forms[0]['ep_j_b[$i]'].value = '${row['tot_enroll_janjati_m']}';\n";
	echo "document.forms[0]['ep_j_t[$i]'].value = '${row['tot_enroll_janjati_t']}';\n";
	echo "document.forms[0]['ep_a_g[$i]'].value = '${row['tot_new_enroll_f']}';\n";
	echo "document.forms[0]['ep_a_b[$i]'].value = '${row['tot_new_enroll_m']}';\n";
	echo "document.forms[0]['ep_a_t[$i]'].value = '${row['tot_new_enroll_t']}';\n";
	
	
	
}


$result=mysql_query("select * from ecd_total_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");
$r=mysql_fetch_array($result);

echo "document.forms[0].ecd_age_total_f_0.value='".$r['f_l3']."';\n";
echo "document.forms[0].ecd_age_total_m_0.value='".$r['m_l3']."';\n";
echo "document.forms[0].ecd_age_total_f_1.value='".$r['f3']."';\n";
echo "document.forms[0].ecd_age_total_m_1.value='".$r['m3']."';\n";
echo "document.forms[0].ecd_age_total_f_2.value='".$r['f4']."';\n";
echo "document.forms[0].ecd_age_total_m_2.value='".$r['m4']."';\n";
echo "document.forms[0].ecd_age_total_f_3.value='".$r['f5']."';\n";
echo "document.forms[0].ecd_age_total_m_3.value='".$r['m5']."';\n";
echo "document.forms[0].ecd_age_total_f_4.value='".$r['f_g5']."';\n";
echo "document.forms[0].ecd_age_total_m_4.value='".$r['m_g5']."';\n";

$result=mysql_query("select * from ecd_dalit_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");
$r=mysql_fetch_array($result);

echo "document.forms[0].ecd_age_dalit_f_0.value='".$r['f_l3']."';\n";
echo "document.forms[0].ecd_age_dalit_m_0.value='".$r['m_l3']."';\n";
echo "document.forms[0].ecd_age_dalit_f_1.value='".$r['f3']."';\n";
echo "document.forms[0].ecd_age_dalit_m_1.value='".$r['m3']."';\n";
echo "document.forms[0].ecd_age_dalit_f_2.value='".$r['f4']."';\n";
echo "document.forms[0].ecd_age_dalit_m_2.value='".$r['m4']."';\n";
echo "document.forms[0].ecd_age_dalit_f_3.value='".$r['f5']."';\n";
echo "document.forms[0].ecd_age_dalit_m_3.value='".$r['m5']."';\n";
echo "document.forms[0].ecd_age_dalit_f_4.value='".$r['f_g5']."';\n";
echo "document.forms[0].ecd_age_dalit_m_4.value='".$r['m_g5']."';\n";

$result=mysql_query("select * from ecd_janjati_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");
$r=mysql_fetch_array($result);

echo "document.forms[0].ecd_age_janjati_f_0.value='".$r['f_l3']."';\n";
echo "document.forms[0].ecd_age_janjati_m_0.value='".$r['m_l3']."';\n";
echo "document.forms[0].ecd_age_janjati_f_1.value='".$r['f3']."';\n";
echo "document.forms[0].ecd_age_janjati_m_1.value='".$r['m3']."';\n";
echo "document.forms[0].ecd_age_janjati_f_2.value='".$r['f4']."';\n";
echo "document.forms[0].ecd_age_janjati_m_2.value='".$r['m4']."';\n";
echo "document.forms[0].ecd_age_janjati_f_3.value='".$r['f5']."';\n";
echo "document.forms[0].ecd_age_janjati_m_3.value='".$r['m5']."';\n";
echo "document.forms[0].ecd_age_janjati_f_4.value='".$r['f_g5']."';\n";
echo "document.forms[0].ecd_age_janjati_m_4.value='".$r['m_g5']."';\n";


$result = mysql_query("select * from ecdppc_info_f1 where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "document.forms[0]['estd_year'].value = '${row['estd_year']}';\n";
	echo "document.forms[0]['parent_sch_num'].value = '${row['mother_school_code']}';\n";
	
	echo "vdc_code = '${row['ecd_vdc']}';\n";
        echo "document.forms[0]['ecd_type'].value = '${row['ecd_type']}';\n";
	echo "document.forms[0]['ecd_ward'].value = '${row['ecd_ward']}';\n";
	echo "document.forms[0]['ecd_tole'].value = '${row['ecd_tole']}';\n";
	
	echo "document.forms[0]['ecd_ngo_name'].value = '${row['ngo_name']}';\n";
	echo "document.forms[0]['ecd_ngo_add'].value = '${row['ngo_tole']}';\n";
}

if (isset($_GET['af']))
{
    if(!isset($_GET['n'])){$currentecd=1;}else{$currentecd=$_GET['n'];}
    
    $lastyear=$currentyear-1;
    
    //retrieve the ecd type
    $query="select DISTINCT(ecd_type) as ecd_type from id_students_track where ecd_num='$currentecd';";
    $result = mysql_query($query);
    if (mysql_num_rows($result)>0)
    {
        $row = mysql_fetch_array($result);
        if($row['ecd_type'])
        {
            echo "document.forms[0]['ecd_type'].value='${row['ecd_type']}';\n";
        }
    }
    foreach(array('3'=>'t','2'=>'j','1'=>'d','0'=>'a') as $key1=>$value1):
        foreach(array('M'=>'b','F'=>'g') as $key2=>$value2):
            $query="select id_students_track.reg_id as reg_id from 
                                    id_students_track left join id_students_main on id_students_track.reg_id=id_students_main.reg_id 
                                    where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                                    and id_students_track.ecd_num='$currentecd'
                                    and id_students_track.class=0 and id_students_main.gender='$key2'";
            if($key1 == '1' OR $key1 == '2')
                $query.= " and id_students_main.caste='$key1'";
            $result = mysql_query($query);
            $studentCount=mysql_num_rows($result);
            
            if ($studentCount>0)
            {   
                //autofill on all the fields except the new enroll fields
                if($key1 != '0')
                {
                    if($classes[0]>=4 AND $classes[0]<=7)
                        echo "document.forms[0]['ep_{$value1}_{$value2}[3]'].value='$studentCount';\n";
                    else
                        echo "document.forms[0]['ep_{$value1}_{$value2}[1]'].value='$studentCount';\n";
                }
                else
                {
                    //retrive students of current year and check if they were in ECD in previous year as well
                    while ($ecd_student = mysql_fetch_assoc($result)) 
                    {
                        $query2="select * from id_students_track 
                                        where reg_id='{$ecd_student['reg_id']}' and id_students_track.sch_year='$lastyear' 
                                    and id_students_track.class='0';";
                        $result2 = mysql_query($query2);
                        //if student is found to be ECD in last year then he/she is not a new enrollment 
                        if (mysql_num_rows($result2)) $studentCount--;
                    }
                    //continue if the no of new students is not zero 
                    if($studentCount>0)
                    {
                        //now autofill the no of newly enrolled ecd students after deducting students that have repeated
                        if($classes[0]>=4 AND $classes[0]<=7)
                            echo "document.forms[0]['ep_{$value1}_{$value2}[3]'].value='$studentCount';\n";
                        else
                            echo "document.forms[0]['ep_{$value1}_{$value2}[1]'].value='$studentCount';\n";
                    }
                    
                }
            }
        endforeach;
        if($classes[0]>=4 AND $classes[0]<=7)   echo "ecdBV(document.forms[0]['ep_{$value1}_g[3]']);\n";
        else    echo "ecdBV(document.forms[0]['ep_{$value1}_g[1]']);\n";
   endforeach; 
   
   //agewise autofill
   $currentEng=$currentyear-57;
   foreach(array('3'=>'total','2'=>'janjati','1'=>'dalit') as $key1=>$value1):
       foreach(array('M'=>'m','F'=>'f') as $key2=>$value2):
            foreach(array('<3'=>0,'=3'=>1,'=4'=>2,'=5'=>3,'>5'=>4) as $key3=>$value3):
       
                 $query="select count(*) as count from id_students_main 
                        left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                        where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                        and ({$currentEng}-YEAR(STR_TO_DATE(id_students_main.dob,'%d/%m/%Y'))){$key3} and id_students_track.class=0
                        and id_students_track.ecd_num='$currentecd'
                        and id_students_main.gender='$key2'";
                 if($key1!='3')
                    $query.= " and id_students_main.caste='$key1'";
                $result = mysql_query($query);
                if (mysql_num_rows($result)>0)
                {   
                    $row = mysql_fetch_array($result);
                    if($row['count'])
                    {
                        echo "document.forms[0]['ecd_age_{$value1}_{$value2}_{$value3}'].value='${row['count']}';\n";
                        $row['count']=0;
                    }   
                }
            endforeach;
       endforeach;
   endforeach;
}

?>


var d=document.forms[0];

for (ii=0;ii<=4;ii++){
	handleChange(d['ecd_age_total_f_'+ii]);
	handleChange(d['ecd_age_total_m_'+ii]);
	handleChange(d['ecd_age_total_t_'+ii]);
	handleChange(d['ecd_age_dalit_f_'+ii]);
	handleChange(d['ecd_age_dalit_m_'+ii]);
	handleChange(d['ecd_age_dalit_t_'+ii]);
	handleChange(d['ecd_age_janjati_f_'+ii]);
	handleChange(d['ecd_age_janjati_m_'+ii]);
	handleChange(d['ecd_age_janjati_t_'+ii]);	
}

// fill up vdc list
ajaxRequest('flash1backend.php?req=vdclist&distcode='+currentSchoolCode.substr(0,2), function(t){
	
	document.getElementById('vdcspan').innerHTML = t.responseText;
	
        //to disable vdc select box at first
        handleChange(d['ecd_type']);
        
	if (vdc_code=='')
		document.getElementById('vdclist').value = currentSchoolCode.substr(2,3);
	else
		document.getElementById('vdclist').value = vdc_code;

});

//handleChange(d['ecd_type']);

validate=true;

</script>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
