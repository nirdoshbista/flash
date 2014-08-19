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

<script src="js/jquery/jquery.js" type="text/javascript"></script>
<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/ecd.js" type="text/javascript"></script>
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
  <p><img src="../images/flash2.png"></p>
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

<table width="50%" border="0" cellspacing="0" cellpadding="0" class="ewTable" style="float:left;margin-bottom: 12px;">

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
    <td width="25%" class="ewTableHeader">Management Comittee</td>
    <td>
	<select name="ecd_mc" id="ecd_mc" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='ecd_mc_expand' class='divhide'>
      Formation Date 
      <input name="ecd_mc_y" id="ecd_mc_y" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      <input name="ecd_mc_m" id="ecd_mc_m" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      <input name="ecd_mc_d" id="ecd_mc_d" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
	  </span>
	  </td>
  </tr>   
  
  <tr> 
    <td width="25%" class="ewTableHeader">Own Classroom</td>
    <td>
	<select name="ecd_room" id="ecd_room" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='ecd_room_expand' class='divhide'>
	  &nbsp;&nbsp;Own Building
		<select name="ecd_building" id="ecd_building" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  </span>
	  </td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">Other Descriptions</td>
    <td>
	Enough space <select name="ecd_space" id="ecd_space" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	&nbsp;&nbsp;Enough Material <select name="ecd_material" id="ecd_material" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	&nbsp;&nbsp;Building and Classroom <select name="ecd_building_classroom" id="ecd_building_classroom" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 

      </td>
  </tr>
  
  <tr>
    <td width="20%" class="ewTableHeader">If run by NGO/INGO</td>
    <td >Name <input name="ecd_ngo_name" type="text" id="ecd_ngo_name" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" size="30" maxlength="100" disabled>
    &nbsp;&nbsp;&nbsp;&nbsp;Address <input name="ecd_ngo_add" type="text" id="ecd_ngo_add" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" size="20" maxlength="100" disabled></td>
  </tr>  
  
</table>
<table id="ecd_extra_info" width="50%" border="0" cellspacing="0" cellpadding="0" class="ewTable" style="float:right">

  <tr> 
    <td width="20%" class="ewTableHeader">Registered with VDC?</td>
    <td>
        <select name="reg_vdc" id="reg_vdc" onchange="handleChange(this);">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
             <option value="2">No</option>
        </select>
        <span id='reg_vdc_expand' class='divhide'>
            &nbsp;&nbsp;&nbsp;&nbsp;Year&nbsp;&nbsp;<input name="ecd_reg_vdc" id="ecd_reg_vdc" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
        </span>
	  </td>
  </tr>
  
  <tr> 
    <td width="25%" class="ewTableHeader">Personal Bank Account</td>
    <td>
	<select name="priv_bnk_ac" id="priv_bnk_ac" onChange="return handleChange(this);">
          <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
        </select> 
	  </td>
  </tr>   
  
  <tr> 
    <td width="25%" class="ewTableHeader">Matching Fund</td>
    <td>
	<select name="matching_fund" id="matching_fund" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
    </td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">Aaya</td>
    <td>
      <select name="ecd_aaya" id="ecd_aaya" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
      </td>
  </tr>
</table>


<br /><br /><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable" id="ecd_ppc_table">
  <tr class="ewTableHeader"> 
    <td rowspan="2">ECD/PPC</td>
    <td colspan="3" align="center">Total</td>
    <td colspan="3" align="center">Dalit</td>
    <td colspan="3" align="center">Janjati</td>
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
    
  </tr>
</table>

<br />
<table id="ecd_tchr_table" width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="14">ECD/PPC Facilitator / Teacher</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td>S.N.</td>
    <td>Name</td>
    <td>Sex</td>
	<td>Caste</td>
    <td>Educational Status</td>
    <td>Training</td>
  </tr>
  
<?php

for ($i=1;$i<=10;$i++){

?>

  <tr> 
    <td><?php echo $i; ?></td>
    <td><input name="ecd_teacher_name_<?php echo $i; ?>" type="text" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" id="ecd_teacher_name_<?php echo $i; ?>" size="30" maxlength="50"></td>
    <td><select name="ecd_teacher_sex_<?php echo $i; ?>" id="ecd_teacher_sex_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Female</option>
        <option value="2">Male</option>
      </select>
	</td>
    <td><select name="ecd_teacher_caste_<?php echo $i; ?>" id="ecd_teacher_caste_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Dalit</option>
        <option value="2">Janjati</option>
        <option value="3">Brahmin/Chhetri</option>
        <option value="4">Others</option>
      </select>
	</td>
	<td>
	  <select name="ecd_teacher_edu_<?php echo $i; ?>" id="ecd_teacher_edu_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Less than SLC</option>
        <option value="2">SLC</option>
        <option value="3">Greater than SLC</option>
      </select>
	</td>
	
	<td>
	  <select name="ecd_teacher_training_<?php echo $i; ?>" id="ecd_teacher_training_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Trained</option>
        <option value="2">Untrained</option>
      </select>
	</td>
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


var vdc_code='';

// load data

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
	
}


// general info

$result = mysql_query("select * from ecdppc_info where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "document.forms[0]['estd_year'].value = '${row['smc_year']}';\n";
	echo "document.forms[0]['parent_sch_num'].value = '${row['parent_sch_num']}';\n";
	
	echo "vdc_code = '${row['ecd_vdc']}';\n";
        echo "document.forms[0]['ecd_type'].value = '${row['ecd_type']}';\n";
	echo "document.forms[0]['ecd_ward'].value = '${row['ecd_ward']}';\n";
	echo "document.forms[0]['ecd_tole'].value = '${row['ecd_tole']}';\n";
        
        echo "document.forms[0]['reg_vdc'].value = '${row['reg_vdc']}';\n";
	echo "document.forms[0]['ecd_reg_vdc'].value = '${row['reg_vdc_year']}';\n";
	echo "document.forms[0]['priv_bnk_ac'].value = '${row['priv_bnk_ac']}';\n";
        echo "document.forms[0]['matching_fund'].value = '${row['matching_fund']}';\n";
	echo "document.forms[0]['ecd_aaya'].value = '${row['ecd_aaya']}';\n";
        
	if ($row['smc_total']!='' || $row['smc_y']!='') echo "document.forms[0]['ecd_mc'].value = '1';\n";
	echo "document.forms[0]['ecd_mc_y'].value = '${row['smc_y']}';\n";
	echo "document.forms[0]['ecd_mc_m'].value = '${row['smc_m']}';\n";
	echo "document.forms[0]['ecd_mc_d'].value = '${row['smc_d']}';\n";
	
	/*
	echo "document.forms[0]['ecd_mc_t'].value = '${row['smc_total']}';\n";
	echo "document.forms[0]['ecd_mc_f'].value = '${row['smc_female']}';\n";
	echo "document.forms[0]['ecd_mc_dl'].value = '${row['smc_dalit']}';\n";
	*/
	
	echo "document.forms[0]['ecd_room'].value = '${row['separate_room']}';\n";
	echo "document.forms[0]['ecd_building'].value = '${row['separate_building']}';\n";
	
	echo "document.forms[0]['ecd_space'].value = '${row['adequate_space']}';\n";
	echo "document.forms[0]['ecd_material'].value = '${row['adequate_material']}';\n";
	echo "document.forms[0]['ecd_building_classroom'].value = '${row['adequate_classroom']}';\n";
	
	echo "document.forms[0]['ecd_ngo_name'].value = '${row['ngo_name']}';\n";
	echo "document.forms[0]['ecd_ngo_add'].value = '${row['ngo_add']}';\n";
}



// ecd facilitators
$result=mysql_query("select * from ecd_facilitator where sch_num='$sch_num' and sch_year='$currentyear' and ecd_num='$currentecd'");
if (isset($_GET['af'])) $result=mysql_query("select * from ecd_facilitator where sch_num='$sch_num' and sch_year='".($currentyear-1)."' and ecd_num='$currentecd'");
	
$i=1;
while($r=mysql_fetch_array($result)){
	echo "autoFill = false;\n";
	echo "document.forms[0].ecd_teacher_name_$i.value='".$r['name']."';\n";
	echo "document.forms[0].ecd_teacher_sex_$i.value='".$r['sex']."';\n";
	echo "document.forms[0].ecd_teacher_caste_$i.value='".$r['caste']."';\n";
	
	if ($r['less_slc_f'] || $r['less_slc_m']) echo "document.forms[0].ecd_teacher_edu_$i.value=1;\n";
	if ($r['slc_f'] || $r['slc_m']) echo "document.forms[0].ecd_teacher_edu_$i.value=2;\n";
	if ($r['greater_slc_f'] || $r['greater_slc_m']) echo "document.forms[0].ecd_teacher_edu_$i.value=3;\n";
	
	if ($r['trained_f'] || $r['trained_m']) echo "document.forms[0].ecd_teacher_training_$i.value=1;\n";
	if ($r['untrained_f'] || $r['untrained_m']) echo "document.forms[0].ecd_teacher_training_$i.value=2;\n";
	
	$i++;
	
	if ($i>10) break;
}

//autofill
if (isset($_GET['af']))
{
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
  
    foreach(array('3'=>'t','2'=>'j','1'=>'d') as $key1=>$value1):
        foreach(array('M'=>'b','F'=>'g') as $key2=>$value2):
            $query="select count(*) as count from 
                                    id_students_track left join id_students_main on id_students_track.reg_id=id_students_main.reg_id 
                                    where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear-1' 
                                    and id_students_track.ecd_num='$currentecd'
                                    and id_students_track.class=0 and id_students_main.gender='$key2'";
            if($key1!='3')
                $query.= " and id_students_main.caste='$key1'";
            $result = mysql_query($query);
            if (mysql_num_rows($result)>0)
            {   
                $row = mysql_fetch_array($result);
                if($row['count'])
                {
                    //autofill into nursery or ecd depending on type of school
                    if($classes[0]>=4 AND $classes[0]<=7)
                        echo "document.forms[0]['ep_{$value1}_{$value2}[3]'].value='${row['count']}';\n";
                    else
                        echo "document.forms[0]['ep_{$value1}_{$value2}[1]'].value='${row['count']}';\n";
                }   
        
            }
        endforeach;
        if($classes[0]>=4 AND $classes[0]<=7)  echo "ecdBV(document.forms[0]['ep_{$value1}_g[3]']);\n";
        else   echo "ecdBV(document.forms[0]['ep_{$value1}_g[1]']);\n";
   endforeach;
   
   //now autofill ecd facilitators only if the ecd no is 1
   if ( $currentecd == 1) 
   {
        $query="select tmis_main.t_name as name,ifnull(tmis_sec1.sex,0) as sex,ifnull(tmis_sec1.t_caste,0) as caste,
                    ifnull(tmis_educational_info.qualification,0) as qualif,count(tmis_train.sn) as training
                    from tmis_main 
                    left join tmis_sec1 on (tmis_main.tid=tmis_sec1.tid)
                    left join tmis_educational_info on (tmis_main.tid=tmis_educational_info.tid)
                    left join tmis_train on (tmis_main.tid=tmis_train.tid)
                    where tmis_main.sch_num='$sch_num' and tmis_main.sch_year='$currentyear' 
                    and tmis_sec1.curr_perm_level='1' group by tmis_main.tid;";

        $result = mysql_query($query);
        $count=1;
        while ($row = mysql_fetch_array($result)) 
        {
            echo "document.forms[0]['ecd_teacher_name_{$count}'].value='${row['name']}';\n";
            echo "document.forms[0]['ecd_teacher_sex_{$count}'].value='${row['sex']}';\n";
            echo "document.forms[0]['ecd_teacher_caste_{$count}'].value='${row['caste']}';\n";

            if ($row['qualif']==6) echo "document.forms[0]['ecd_teacher_edu_{$count}'].value='1';\n";
            elseif ($row['qualif']==5) echo "document.forms[0]['ecd_teacher_edu_{$count}'].value='2';\n";
            elseif ($row['qualif']>0) echo "document.forms[0]['ecd_teacher_edu_{$count}'].value='3';\n";

            if($row['training']>0) echo "document.forms[0]['ecd_teacher_training_{$count}'].value='1';\n";
            elseif($row['training']==0) echo "document.forms[0]['ecd_teacher_training_{$count}'].value='2';\n";

            $count++;
        }
   }

}

?>

// fill up vdc list

ajaxRequest('flash2backend.php?req=vdclist&distcode='+currentSchoolCode.substr(0,2), function(t){
	
	document.getElementById('vdcspan').innerHTML = t.responseText;
	
	if (vdc_code=='')
		document.getElementById('vdclist').value = currentSchoolCode.substr(2,3);
	else
		document.getElementById('vdclist').value = vdc_code;
        //to disable vdc select box at first
        handleChange(document.forms[0]['ecd_type']);

});

handleChange(document.forms[0]['ecd_mc']);
handleChange(document.forms[0]['ecd_room']);
handleChange(document.forms[0]['reg_vdc']);
handleChange(document.forms[0]['ecd_type']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
