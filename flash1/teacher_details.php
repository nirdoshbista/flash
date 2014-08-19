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
<title>Flash I - Teacher Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/teacher_details.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select onkeypress="return generalKeyPress(this, event);"><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">

<p align="center" class="ewGroupName">Headmaster</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr>
    <td width="20%" class="ewTableHeader">Headmaster</td>
    <td>
    Initial Status
    <select onkeypress="return generalKeyPress(this, event);" name="headmaster_initial_status" id="headmaster_initial_status">
        <option value="0">N/A</option>
        <option value="1">Primary</option>
        <option value="2">L.Sec.</option>
        <option value="3">Sec.</option>
        <option value="4">H.Sec.</option>
      </select>
    
    Sex 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_sex" id="headmaster_sex">
        <option value="0">N/A</option>
        <option value="1">Male</option>
        <option value="2">Female</option>
      </select>
      Caste 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_caste" id="headmaster_caste">
        <option value="0">N/A</option>
        <option value="1">Dalit</option>
        <option value="2">Janjati</option>
        <option value="3">Others</option>
      </select>
      Training 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_training" id="headmaster_training">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select></td>
  </tr>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class='ewTableHeader'>
		<td colspan="4">Rahat</td>
		<td colspan="8">PCF</td>
	</tr>
	<tr class="ewTableHeader">
		<td rowspan="2">Pri</td>
		<td rowspan="2">LSec</td>
		<td rowspan="2">Sec</td>
		<td rowspan="2">HSec</td>
		
		<td colspan="4">Full</td>
		<td colspan="4">Partial</td>
	</tr>
	<tr class="ewTableHeader">
		<td>Pri</td>
		<td>LSec</td>
		<td>Sec</td>
		<td>HSec</td>
		<td>Pri</td>
		<td>LSec</td>
		<td>Sec</td>
		<td>HSec</td>
	</tr>
	<tr>
		<td><input name="rahat_pri" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="rahat_pri" size="3" maxlength="3"></td>
		<td><input name="rahat_lsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="rahat_lsec" size="3" maxlength="3"></td>
		<td><input name="rahat_sec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="rahat_sec" size="3" maxlength="3"></td>
		<td><input name="rahat_hsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="rahat_hsec" size="3" maxlength="3"></td>
		<td><input name="pcf_full_pri" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_pri" size="3" maxlength="3"></td>
		<td><input name="pcf_full_lsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_lsec" size="3" maxlength="3"></td>
		<td><input name="pcf_full_sec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_sec" size="3" maxlength="3"></td>
		<td><input name="pcf_full_hsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_hsec" size="3" maxlength="3"></td>
		<td><input name="pcf_par_pri" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_pri" size="3" maxlength="3"></td>
		<td><input name="pcf_par_lsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_lsec" size="3" maxlength="3"></td>
		<td><input name="pcf_par_sec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_sec" size="3" maxlength="3"></td>
		<td><input name="pcf_par_hsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_hsec" size="3" maxlength="3"></td>		
	</tr>

</table>

<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr> 
    <td width="20%" class="ewTableHeader">Mother Language</td>
    <td>
    
    <?php
    	insertlanguages('mother_lang');
    ?>
    Teacher Available
 <select onChange="handleChange(this, event); if (this.value=='1') document.getElementById('mother_lang_m').focus();" name="mother_lang_teacher_available" id="mother_lang_teacher_available">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
      <script>document.forms[0]['mother_lang'].value='Nepali'</script>
      <span id="mother_lang_expand" class="divhide">
	  Female
<input name="mother_lang_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="mother_lang_m" size="2" maxlength="3">
      Male 
      <input name="mother_lang_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="mother_lang_f" size="2" maxlength="3">
      Total
      <input disabled name="mother_lang_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="mother_lang_t" size="2" maxlength="3">
	  </span>   
	  
    </td>
  </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
      <tr align="center" class="ewTableHeader">
        <td>Level</td>

        <td><strong>App.</strong></td>

        <td colspan="3"><strong>No. of teachers</strong>
          <p><strong>working</strong></p>
        </td>

        <td colspan="3"><strong>Rahat</strong></td>

        <td colspan="3"><strong>Private</strong></td>

        <td colspan="3"><strong>Total&nbsp;</strong>
          <p><strong>Col. 2 to 4</strong></p>
        </td>

        <td colspan="3"><strong>Dalit</strong></td>
        <td colspan="3"><strong>Janjati</strong></td>
        <td colspan="3"><strong>Others</strong></td>
        <td colspan="3"><strong>Disabled</strong></td>

      </tr>

      <tr align="center" class="ewTableHeader">
        <td> </td>

        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>


      </tr>

<?php
	$level=array('','Pri',"LSec",'Sec','HSec');
	for ($i=1;$i<=4;$i++):
?>
      <tr>
      	<td><?php echo $level[$i]; ?></td>
		<td><input name="total_a_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_a_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="total_f_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_f_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="total_m_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_m_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="total_t_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_t_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="grant_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="grant_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="grant_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="grant_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="grant_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="grant_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="private_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="private_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="private_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="private_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="private_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="private_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_f[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_m[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="total_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="dalit_f_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_f_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="dalit_m_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_m_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="dalit_t_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="dalit_t_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="janjati_f_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_f_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="janjati_m_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_m_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="janjati_t_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="janjati_t_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="other_f_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_f_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="other_m_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_m_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="other_t_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_t_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="disabled_f_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="disabled_f_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="disabled_m_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="disabled_m_teachers[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="disabled_t_teachers[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="disabled_t_teachers[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>

	 </tr>
     <?php
     	endfor;
     ?>
 </table>

 <br />

<table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
      <tr align="center" class="ewTableHeader">
        <td>Level</td>

        <td colspan="3"><strong>Permanent</strong></td>
        <td colspan="3"><strong>Temporary</strong></td>
        <td colspan="3"><strong>&lt;SLC</strong></td>
        <td colspan="3"><strong>SLC</strong></td>
        <td colspan="3"><strong>IA</strong></td>
        <td colspan="3"><strong>BA</strong></td>
        <td colspan="3"><strong>MA</strong></td>
        <td colspan="3"><strong>PhD</strong></td>
      </tr>

      <tr align="center" class="ewTableHeader">
        <td> </td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>

        <td><strong>F</strong></td>
        <td><strong>M</strong></td>
        <td><strong>T</strong></td>
      </tr>
      
<?php
	$level=array('','Pri',"LSec",'Sec','HSec');
	for ($i=1;$i<=4;$i++):
?>
      <tr>
      	<td><?php echo $level[$i]; ?></td>      
		<td><input name="perm_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="perm_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="perm_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="perm_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="perm_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="perm_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="temp_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="temp_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="temp_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="temp_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="temp_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="temp_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="under_slc_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="under_slc_f[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>1) echo 'disabled'; ?>></td>
		<td><input name="under_slc_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="under_slc_m[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>1) echo 'disabled'; ?>></td>
		<td><input name="under_slc_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="under_slc_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="slc_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="slc_f[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>2) echo 'disabled'; ?>></td>
		<td><input name="slc_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="slc_m[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>2) echo 'disabled'; ?>></td>
		<td><input name="slc_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="slc_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="ia_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ia_f[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>3) echo 'disabled'; ?>></td>
		<td><input name="ia_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ia_m[<?php echo $i; ?>]" size="2" maxlength="3" <?php if ($i>3) echo 'disabled'; ?>></td>
		<td><input name="ia_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ia_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="ba_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ba_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="ba_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ba_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="ba_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ba_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="ma_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ma_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="ma_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ma_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="ma_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="ma_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>
		<td><input name="phd_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="phd_f[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="phd_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="phd_m[<?php echo $i; ?>]" size="2" maxlength="3"></td>
		<td><input name="phd_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="phd_t[<?php echo $i; ?>]" size="2" maxlength="3" disabled></td>

	</tr>
     <?php
     	endfor;
     ?>
 </table>
 
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
<?php

if (isset($_GET['af'])) $currentyear--;

// headmaster

$result=mysql_query("select * from headmaster_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "autoFill = false;\n";
	echo "document.forms[0].elements['headmaster_sex'].value='".$r['headmaster']."';\n";
	echo "document.forms[0].elements['headmaster_initial_status'].value='".$r['hmaster_initial_status']."';\n";
	echo "document.forms[0].elements['headmaster_caste'].value='".$r['hmaster_status']."';\n";
	echo "document.forms[0].elements['headmaster_training'].value='".$r['hmaster_training']."';\n";
}

//rahat
$result=mysql_query("select * from teacher_rahat_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "autoFill = false;\n";
	echo "document.forms[0].elements['rahat_pri'].value='".$r['rahat_pri']."';\n";
	echo "document.forms[0].elements['rahat_lsec'].value='".$r['rahat_lsec']."';\n";
	echo "document.forms[0].elements['rahat_sec'].value='".$r['rahat_sec']."';\n";
	echo "document.forms[0].elements['rahat_hsec'].value='".$r['rahat_hsec']."';\n";

}

//pcf
$result=mysql_query("select * from teacher_pcf_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "autoFill = false;\n";
	echo "document.forms[0].elements['pcf_full_pri'].value='".$r['pcf_full_pri']."';\n";
	echo "document.forms[0].elements['pcf_full_lsec'].value='".$r['pcf_full_lsec']."';\n";
	echo "document.forms[0].elements['pcf_full_sec'].value='".$r['pcf_full_sec']."';\n";
	echo "document.forms[0].elements['pcf_full_hsec'].value='".$r['pcf_full_hsec']."';\n";
	echo "document.forms[0].elements['pcf_par_pri'].value='".$r['pcf_par_pri']."';\n";
	echo "document.forms[0].elements['pcf_par_lsec'].value='".$r['pcf_par_lsec']."';\n";
	echo "document.forms[0].elements['pcf_par_sec'].value='".$r['pcf_par_sec']."';\n";
	echo "document.forms[0].elements['pcf_par_hsec'].value='".$r['pcf_par_hsec']."';\n";

}
	
// mother_language

$result=mysql_query("select * from teacher_language_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);
	
	echo "autoFill = false;\n";
	echo "document.forms[0]['mother_lang'].value = '${r['mother_lang']}';\n";
	echo "document.forms[0]['mother_lang_teacher_available'].value = '${r['teacher_available']}';\n";
	echo "document.forms[0]['mother_lang_f'].value = '${r['teacher_f']}';\n";
	echo "document.forms[0]['mother_lang_m'].value = '${r['teacher_m']}';\n";
	echo "document.forms[0]['mother_lang_t'].value = '${r['teacher_t']}';\n";
}

// teacher data
for ($i=1;$i<=4;$i++){
	if ($i==1) $table = "pri_teacher_details_f1";
	if ($i==2) $table = "lsec_teacher_details_f1";
	if ($i==3) $table = "sec_teacher_details_f1";
	if ($i==4) $table = "hsec_teacher_details_f1";
	
	$result=mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear'");
	if (mysql_num_rows($result)>0){
		$r=mysql_fetch_array($result);	

		echo "autoFill = false;\n";
		echo "document.forms[0]['total_a_teachers[$i]'].value = '${r['total_a_teachers']}';\n";
		echo "document.forms[0]['total_f_teachers[$i]'].value = '${r['total_f_teachers']}';\n";
		echo "document.forms[0]['total_m_teachers[$i]'].value = '${r['total_m_teachers']}';\n";
		echo "document.forms[0]['total_t_teachers[$i]'].value = '${r['total_t_teachers']}';\n";
		echo "document.forms[0]['grant_f[$i]'].value = '${r['grant_f']}';\n";
		echo "document.forms[0]['grant_m[$i]'].value = '${r['grant_m']}';\n";
		echo "document.forms[0]['grant_t[$i]'].value = '${r['grant_t']}';\n";
		echo "document.forms[0]['private_f[$i]'].value = '${r['private_f']}';\n";
		echo "document.forms[0]['private_m[$i]'].value = '${r['private_m']}';\n";
		echo "document.forms[0]['private_t[$i]'].value = '${r['private_t']}';\n";

		echo "handleChange(document.forms[0]['grant_f[$i]']);\n";
		echo "handleChange(document.forms[0]['grant_m[$i]']);\n";
		echo "handleChange(document.forms[0]['grant_t[$i]']);\n";

		echo "document.forms[0]['dalit_f_teachers[$i]'].value = '${r['dalit_f_teachers']}';\n";
		echo "document.forms[0]['dalit_m_teachers[$i]'].value = '${r['dalit_m_teachers']}';\n";
		echo "document.forms[0]['dalit_t_teachers[$i]'].value = '${r['dalit_t_teachers']}';\n";
		echo "document.forms[0]['janjati_f_teachers[$i]'].value = '${r['janjati_f_teachers']}';\n";
		echo "document.forms[0]['janjati_m_teachers[$i]'].value = '${r['janjati_m_teachers']}';\n";
		echo "document.forms[0]['janjati_t_teachers[$i]'].value = '${r['janjati_t_teachers']}';\n";

		echo "handleChange(document.forms[0]['dalit_f_teachers[$i]']);\n";
		echo "handleChange(document.forms[0]['dalit_m_teachers[$i]']);\n";
		echo "handleChange(document.forms[0]['dalit_t_teachers[$i]']);\n";
	
		echo "document.forms[0]['disabled_f_teachers[$i]'].value = '${r['disabled_f_teachers']}';\n";
		echo "document.forms[0]['disabled_m_teachers[$i]'].value = '${r['disabled_m_teachers']}';\n";
		echo "document.forms[0]['disabled_t_teachers[$i]'].value = '${r['disabled_t_teachers']}';\n";
		echo "document.forms[0]['perm_f[$i]'].value = '${r['perm_f']}';\n";
		echo "document.forms[0]['perm_m[$i]'].value = '${r['perm_m']}';\n";
		echo "document.forms[0]['perm_t[$i]'].value = '${r['perm_t']}';\n";
		echo "document.forms[0]['temp_f[$i]'].value = '${r['temp_f']}';\n";
		echo "document.forms[0]['temp_m[$i]'].value = '${r['temp_m']}';\n";
		echo "document.forms[0]['temp_t[$i]'].value = '${r['temp_t']}';\n";
		echo "document.forms[0]['under_slc_f[$i]'].value = '${r['under_slc_f']}';\n";
		echo "document.forms[0]['under_slc_m[$i]'].value = '${r['under_slc_m']}';\n";
		echo "document.forms[0]['under_slc_t[$i]'].value = '${r['under_slc_t']}';\n";
		echo "document.forms[0]['slc_f[$i]'].value = '${r['slc_f']}';\n";
		echo "document.forms[0]['slc_m[$i]'].value = '${r['slc_m']}';\n";
		echo "document.forms[0]['slc_t[$i]'].value = '${r['slc_t']}';\n";
		echo "document.forms[0]['ia_f[$i]'].value = '${r['ia_f']}';\n";
		echo "document.forms[0]['ia_m[$i]'].value = '${r['ia_m']}';\n";
		echo "document.forms[0]['ia_t[$i]'].value = '${r['ia_t']}';\n";
		echo "document.forms[0]['ba_f[$i]'].value = '${r['ba_f']}';\n";
		echo "document.forms[0]['ba_m[$i]'].value = '${r['ba_m']}';\n";
		echo "document.forms[0]['ba_t[$i]'].value = '${r['ba_t']}';\n";
		echo "document.forms[0]['ma_f[$i]'].value = '${r['ma_f']}';\n";
		echo "document.forms[0]['ma_m[$i]'].value = '${r['ma_m']}';\n";
		echo "document.forms[0]['ma_t[$i]'].value = '${r['ma_t']}';\n";
		echo "document.forms[0]['phd_f[$i]'].value = '${r['phd_f']}';\n";
		echo "document.forms[0]['phd_m[$i]'].value = '${r['phd_m']}';\n";
		echo "document.forms[0]['phd_t[$i]'].value = '${r['phd_t']}';\n";		
	}
	
}

?>

handleChange(document.forms[0]['mother_lang_teacher_available']);
validate = true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>