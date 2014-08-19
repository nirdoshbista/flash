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
<script src="js/alternate.js" type="text/javascript"></script>
<?php 

$classes=schoolclasses($sch_num); 

if (isset($_GET['n'])) $currentsopfsp = $_GET['n']; else $currentsopfsp='1';
echo "<script>var currentSopfsp = '$currentsopfsp';</script>\n";
?>

</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash2.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

<span id='sopfspjump'>
<?php

$result = mysql_query("select distinct sopfsp_num from sopfsp_info where sch_num='$sch_num' and sch_year='$currentyear'");
$total_sopfsps = mysql_num_rows($result);

if ($total_sopfsps>0){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Select SOP / FSP #</b>\n";
	echo "<select onchange=\"location = currentPage+'?s='+currentSchoolCode+'&n='+this.value\">\n";
	
	if (isset($_GET['n'])) $currentsopfsp = $_GET['n']; else $currentsopfsp='1';
		
	for ($i=1;$i<=$total_sopfsps;$i++){
		if ($i==$currentsopfsp) echo "<option value='$i' selected>SOP/FSP #$i\n";
		else echo "<option value='$i'>SOP/FSP #$i\n";
	}
	if ($currentsopfsp>$total_sopfsps) echo "<option value='$currentsopfsp' selected>SOP/FSP #$currentsopfsp\n";
	echo "</select>\n";
	
}
echo "<input type='button' value='Save & New SOP/FSP' onclick='newsopfsp(".($currentsopfsp+1).")'>\n";
echo "<input type='button' value='Delete this SOP/FSP' onclick='deletesopfsp()'>\n";

?>

</span>

</p>
<form action="controller.php" method="post">
<input type="hidden" name='sopfsp_num' id='sopfsp_num' value="<?php echo $currentsopfsp; ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr> 
    <td width="25%" class="ewTableHeader">Alternate School</td>
    <td>
	<select name="alternate_school" id="alternate_school" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">SOP</option>
        <option value="2">FSP</option>
      </select> 
	  </td>
  </tr> 
</table>  
<div id='alternate_entry_form' class='divhide'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr> 
    <td width="25%" class="ewTableHeader">Parent School Code</td>
    <td> <input name="parent_sch_num" id="parent_sch_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="12" maxlength="9" value="<?php echo $sch_num; ?>" >
	  </td>
  </tr>

  <tr> 
    <td width="25%" class="ewTableHeader">Starting Class</td>
    <td>
      Formation Date 
      <input name="starts_y" id="starts_y" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      <input name="starts_m" id="starts_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      <input name="starts_d" id="starts_d" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      &nbsp;&nbsp;Level
      <input name="starts_level" id="starts_level" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;Time
      <input name="starts_time" id="starts_time" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>   

  <tr> 
    <td width="25%" class="ewTableHeader">SOP/FSP Management Comittee</td>
    <td>
      Formation Date 
      <input name="mc_y" id="mc_y" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      <input name="mc_m" id="mc_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      <input name="mc_d" id="mc_d" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
	  </td>
  </tr>  


  <tr> 
    <td width="25%" class="ewTableHeader">Re-Class</td>
    <td>
      Formation Date 
      <input name="startr_y" id="startr_y" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      <input name="startr_m" id="startr_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      <input name="startr_d" id="startr_d" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="3" maxlength="2">
      &nbsp;&nbsp;Level
      <input name="startr_level" id="startr_level" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;Time
      <input name="startr_time" id="startr_time" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">If run by NGO/INGO, </td>
    <td>
      Name <input name="ngo_name" id="ngo_name" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" size="25" maxlength="50">
      &nbsp;&nbsp;Address <input name="ngo_add" id="ngo_add" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" size="25" maxlength="50">
      
	  </td>
  </tr>      
   
</table>


<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="14">SOP/FSP Facilitator / Teacher</td>
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
    <td><input name="sopfsp_teacher_name_<?php echo $i; ?>" type="text" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" id="sopfsp_teacher_name_<?php echo $i; ?>" size="30" maxlength="50"></td>
    <td><select name="sopfsp_teacher_sex_<?php echo $i; ?>" id="sopfsp_teacher_sex_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Female</option>
        <option value="2">Male</option>
      </select>
	</td>
    <td><select name="sopfsp_teacher_caste_<?php echo $i; ?>" id="sopfsp_teacher_caste_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Dalit</option>
        <option value="2">Janjati</option>
        <option value="3">Others</option>
      </select>
	</td>
	<td>
	  <select name="sopfsp_teacher_edu_<?php echo $i; ?>" id="sopfsp_teacher_edu_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Less than SLC</option>
        <option value="2">SLC</option>
		 <option value="3">Greater than SLC</option>
      </select>
	</td>
	
	<td>
	  <select name="sopfsp_teacher_training_<?php echo $i; ?>" id="sopfsp_teacher_training_<?php echo $i; ?>" onkeypress="return generalKeyPress(this, event);" >
        <option value="0">N/A</option>
        <option value="1">Pre</option>
        <option value="2">Second</option>
        <option value="3">Third</option>
      </select>
	</td>
  </tr>


<?php	
	
}

?>

<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
  	<td colspan="5">Total Students</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td>Female</td>
    <td>Male</td>
    <td>Total</td>
  </tr>
  <tr> 
    <td><input name="alternate_total_f" type="text" id="alternate_total_f" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="alternate_total_m" type="text" id="alternate_total_m" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input disabled name="alternate_total_t" type="text" id="alternate_total_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  </tr>
</table>


 
</table>

</div> 
</form>

<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

var vdc_code='';

<?php

$result = mysql_query("select * from sopfsp_info where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "document.forms[0]['alternate_school'].value = '${row['sopfsp_type']}';\n";
	if ($row['parent_sch_num']=='') echo "document.forms[0]['parent_sch_num'].value = '$sch_num';\n";
	else echo "document.forms[0]['parent_sch_num'].value = '${row['parent_sch_num']}';\n";
	echo "document.forms[0]['starts_y'].value = '${row['start_y']}';\n";
	echo "document.forms[0]['starts_m'].value = '${row['start_m']}';\n";
	echo "document.forms[0]['starts_d'].value = '${row['start_d']}';\n";
	echo "document.forms[0]['starts_level'].value = '${row['start_level']}';\n";
	echo "document.forms[0]['starts_time'].value = '${row['start_time']}';\n";
	echo "document.forms[0]['startr_y'].value = '${row['repeat_y']}';\n";
	echo "document.forms[0]['startr_m'].value = '${row['repeat_m']}';\n";
	echo "document.forms[0]['startr_d'].value = '${row['repeat_d']}';\n";
	echo "document.forms[0]['startr_level'].value = '${row['repeat_level']}';\n";
	echo "document.forms[0]['startr_time'].value = '${row['repeat_time']}';\n";
	
	echo "vdc_code = '${row['vdc']}';\n";
	
	echo "document.forms[0]['ngo_name'].value = '${row['ngo_name']}';\n";
	echo "document.forms[0]['ngo_add'].value = '${row['ngo_add']}';\n";
}


$result = mysql_query("select * from sopfsp_enroll where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);

	echo "document.forms[0]['alternate_total_f'].value = '${row['tot_enroll_total_f']}';\n";
	echo "document.forms[0]['alternate_total_m'].value = '${row['tot_enroll_total_m']}';\n";
	echo "document.forms[0]['alternate_total_t'].value = '${row['tot_enroll_total_t']}';\n";
}

// sop fsp facilitators
$result=mysql_query("select * from sopfsp_facilitator where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");
if (isset($_GET['af'])) $result=mysql_query("select * from sopfsp_facilitator where sch_num='$sch_num' and sch_year='".($currentyear-1)."' and sopfsp_num='$currentecd'");
	
$i=1;
while($r=mysql_fetch_array($result)){
	echo "autoFill = false;\n";
	echo "document.forms[0].sopfsp_teacher_name_$i.value='".$r['name']."';\n";
	echo "document.forms[0].sopfsp_teacher_sex_$i.value='".$r['sex']."';\n";
	echo "document.forms[0].sopfsp_teacher_caste_$i.value='".$r['caste']."';\n";
	
	if ($r['less_slc_f'] || $r['less_slc_m']) echo "document.forms[0].sopfsp_teacher_edu_$i.value=1;\n";
	if ($r['slc_f'] || $r['slc_m']) echo "document.forms[0].sopfsp_teacher_edu_$i.value=2;\n";
	if ($r['greater_slc_f'] || $r['greater_slc_m']) echo "document.forms[0].sopfsp_teacher_edu_$i.value=3;\n";
	
	if ($r['sex']==1){ // female
		echo "document.forms[0].sopfsp_teacher_training_$i.value='{$r['trained_f']}';\n";
	}
	
	if ($r['sex']==2){ // male
		echo "document.forms[0].sopfsp_teacher_training_$i.value='{$r['trained_m']}';\n";
	}
	
	/*
	if ($r['trained_f'] || $r['trained_m']) echo "document.forms[0].sopfsp_teacher_training_$i.value=1;\n";
	if ($r['untrained_f'] || $r['untrained_m']) echo "document.forms[0].sopfsp_teacher_training_$i.value=2;\n";
	*/
	
	$i++;
	
	if ($i>10) break;
}

?>

// fill up vdc list

/*
ajaxRequest('flash2backend.php?req=vdclist&distcode='+currentSchoolCode.substr(0,2), function(t){
	
	document.getElementById('vdcspan').innerHTML = t.responseText;
	
	if (vdc_code=='')
		document.getElementById('vdclist').value = currentSchoolCode.substr(2,3);
	else
		document.getElementById('vdclist').value = vdc_code;
});
*/

handleChange(document.forms[0]['alternate_school']);
handleChange(document.forms[0]['helper_sex']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
