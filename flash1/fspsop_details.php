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
<title>Flash I</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/fspsop_details.js" type="text/javascript"></script>
<?php 

$classes=schoolclasses($sch_num); 

if (isset($_GET['n'])) $currentsopfsp = $_GET['n']; else $currentsopfsp='1';
echo "<script>var currentSopfsp = '$currentsopfsp';</script>\n";
?>

</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

<span id='sopfspjump'>
<?php

$result = mysql_query("select distinct sopfsp_num from sopfsp_enroll_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
$total_sopfsps = mysql_num_rows($result);

if ($total_sopfsps>0){
	echo "&nbsp;&nbsp;&nbsp <b>Select </b>\n";
	echo "<select onchange=\"location = currentPage+'?s='+currentSchoolCode+'&n='+this.value\">\n";
	
	if (isset($_GET['n'])) $currentsopfsp = $_GET['n']; else $currentsopfsp='1';
		
	for ($i=1;$i<=$total_sopfsps;$i++){
		if ($i==$currentsopfsp) echo "<option value='$i' selected>SOP/FSP #$i\n";
		else echo "<option value='$i'>SOP/FSP #$i\n";
	}
	if ($currentsopfsp>$total_sopfsps) echo "<option value='$currentsopfsp' selected>SOP/FSP #$currentsopfsp\n";
	echo "</select>\n";
	
}
echo "<input type='button' value='Save & New' onclick='newsopfsp(".($currentsopfsp+1).")'>\n";
echo "<input type='button' value='Delete this' onclick='deletesopfsp()'>\n";

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
  	<td width="25%" class="ewTableHeader">Mother School</td>
  	<td>
    Code <input name="mother_school_code" id="mother_school_code" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="12" maxlength="9">
  	</td>
  </tr>
   
</table>

<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	
  <tr class="ewTableHeader">
	  <td colspan="9">FSP / SOP Student Details</td>
  </tr>
  <tr class="ewTableHeader">
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
    <td><input name="alternate_total_f" type="text" id="alternate_total_f" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input name="alternate_total_m" type="text" id="alternate_total_m" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input disabled name="alternate_total_t" type="text" id="alternate_total_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
  
    <td><input name="alternate_dalit_f" type="text" id="alternate_dalit_f" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input name="alternate_dalit_m" type="text" id="alternate_dalit_m" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input disabled name="alternate_dalit_t" type="text" id="alternate_dalit_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	

    <td><input name="alternate_janjati_f" type="text" id="alternate_janjati_f" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input name="alternate_janjati_m" type="text" id="alternate_janjati_m" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	
    <td><input disabled name="alternate_janjati_t" type="text" id="alternate_janjati_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>  	

  </tr>
   
</table>

<br />




<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
 	<td rowspan="2" width="15%">Students</td>
  	<td colspan="16">Agewise</td>
  </tr>
  <tr class="ewTableHeader"> 
    
    
    <td>&lt; 5</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
    <td>14</td>
    <td>&gt;14</td>
    <td>Total</td>
  </tr>
  <tr>
  	<td>Female</td>
  	<td><input name="alt_age_t_l5" type="text" id="alt_age_t_l5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_5" type="text" id="alt_age_t_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_6" type="text" id="alt_age_t_6" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_7" type="text" id="alt_age_t_7" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_8" type="text" id="alt_age_t_8" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_9" type="text" id="alt_age_t_9" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_10" type="text" id="alt_age_t_10" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_11" type="text" id="alt_age_t_11" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_12" type="text" id="alt_age_t_12" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_13" type="text" id="alt_age_t_13" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_14" type="text" id="alt_age_t_14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_t_g14" type="text" id="alt_age_t_g14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input disabled name="alt_age_t_t" type="text" id="alt_age_t_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  </tr>
  <tr>
  	<td>Dalit</td>
  	<td><input name="alt_age_d_l5" type="text" id="alt_age_d_l5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_5" type="text" id="alt_age_d_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_6" type="text" id="alt_age_d_6" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_7" type="text" id="alt_age_d_7" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_8" type="text" id="alt_age_d_8" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_9" type="text" id="alt_age_d_9" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_10" type="text" id="alt_age_d_10" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_11" type="text" id="alt_age_d_11" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_12" type="text" id="alt_age_d_12" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_13" type="text" id="alt_age_d_13" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_14" type="text" id="alt_age_d_14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_d_g14" type="text" id="alt_age_d_g14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input disabled name="alt_age_d_t" type="text" id="alt_age_d_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  </tr>
  <tr>
  	<td>Janjati</td>
  	<td><input name="alt_age_j_l5" type="text" id="alt_age_j_l5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_5" type="text" id="alt_age_j_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_6" type="text" id="alt_age_j_6" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_7" type="text" id="alt_age_j_7" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_8" type="text" id="alt_age_j_8" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_9" type="text" id="alt_age_j_9" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_10" type="text" id="alt_age_j_10" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_11" type="text" id="alt_age_j_11" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_12" type="text" id="alt_age_j_12" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_13" type="text" id="alt_age_j_13" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_14" type="text" id="alt_age_j_14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input name="alt_age_j_g14" type="text" id="alt_age_j_g14" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  	<td><input disabled name="alt_age_j_t" type="text" id="alt_age_j_t" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
  </tr> 
 </table> 

 
</div> 
</form>

<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

var vdc_code='';


<?php

echo "document.forms[0]['mother_school_code'].value = '$sch_num';\n";

$result = mysql_query("select * from sopfsp_info_f1 where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "document.forms[0]['alternate_school'].value = '${row['sopfsp_type']}';\n";
	echo "document.forms[0]['mother_school_code'].value = '${row['mother_school_code']}';\n";

}


$result = mysql_query("select * from sopfsp_enroll_f1 where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);

	echo "document.forms[0]['alternate_total_f'].value = '${row['tot_enroll_total_f']}';\n";
	echo "document.forms[0]['alternate_total_m'].value = '${row['tot_enroll_total_m']}';\n";
	echo "document.forms[0]['alternate_total_t'].value = '${row['tot_enroll_total_t']}';\n";
	echo "document.forms[0]['alternate_dalit_f'].value = '${row['tot_enroll_dalit_f']}';\n";
	echo "document.forms[0]['alternate_dalit_m'].value = '${row['tot_enroll_dalit_m']}';\n";
	echo "document.forms[0]['alternate_dalit_t'].value = '${row['tot_enroll_dalit_t']}';\n";
	echo "document.forms[0]['alternate_janjati_f'].value = '${row['tot_enroll_janjati_f']}';\n";
	echo "document.forms[0]['alternate_janjati_m'].value = '${row['tot_enroll_janjati_m']}';\n";
	echo "document.forms[0]['alternate_janjati_t'].value = '${row['tot_enroll_janjati_t']}';\n";

}


$result = mysql_query("select * from sopfsp_enroll_age_f1 where sch_num='$sch_num' and sch_year='$currentyear' and sopfsp_num='$currentsopfsp'");

if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);

	echo "document.forms[0]['alt_age_d_l5'].value = '${row['d_l5']}';\n";
	echo "document.forms[0]['alt_age_j_l5'].value = '${row['j_l5']}';\n";
	echo "document.forms[0]['alt_age_t_l5'].value = '${row['t_l5']}';\n";
	echo "document.forms[0]['alt_age_d_5'].value = '${row['d_5']}';\n";
	echo "document.forms[0]['alt_age_j_5'].value = '${row['j_5']}';\n";
	echo "document.forms[0]['alt_age_t_5'].value = '${row['t_5']}';\n";
	echo "document.forms[0]['alt_age_d_6'].value = '${row['d_6']}';\n";
	echo "document.forms[0]['alt_age_j_6'].value = '${row['j_6']}';\n";
	echo "document.forms[0]['alt_age_t_6'].value = '${row['t_6']}';\n";
	echo "document.forms[0]['alt_age_d_7'].value = '${row['d_7']}';\n";
	echo "document.forms[0]['alt_age_j_7'].value = '${row['j_7']}';\n";
	echo "document.forms[0]['alt_age_t_7'].value = '${row['t_7']}';\n";
	echo "document.forms[0]['alt_age_d_8'].value = '${row['d_8']}';\n";
	echo "document.forms[0]['alt_age_j_8'].value = '${row['j_8']}';\n";
	echo "document.forms[0]['alt_age_t_8'].value = '${row['t_8']}';\n";
	echo "document.forms[0]['alt_age_d_9'].value = '${row['d_9']}';\n";
	echo "document.forms[0]['alt_age_j_9'].value = '${row['j_9']}';\n";
	echo "document.forms[0]['alt_age_t_9'].value = '${row['t_9']}';\n";
	echo "document.forms[0]['alt_age_d_10'].value = '${row['d_10']}';\n";
	echo "document.forms[0]['alt_age_j_10'].value = '${row['j_10']}';\n";
	echo "document.forms[0]['alt_age_t_10'].value = '${row['t_10']}';\n";
	echo "document.forms[0]['alt_age_d_11'].value = '${row['d_11']}';\n";
	echo "document.forms[0]['alt_age_j_11'].value = '${row['j_11']}';\n";
	echo "document.forms[0]['alt_age_t_11'].value = '${row['t_11']}';\n";
	echo "document.forms[0]['alt_age_d_12'].value = '${row['d_12']}';\n";
	echo "document.forms[0]['alt_age_j_12'].value = '${row['j_12']}';\n";
	echo "document.forms[0]['alt_age_t_12'].value = '${row['t_12']}';\n";
	echo "document.forms[0]['alt_age_d_13'].value = '${row['d_13']}';\n";
	echo "document.forms[0]['alt_age_j_13'].value = '${row['j_13']}';\n";
	echo "document.forms[0]['alt_age_t_13'].value = '${row['t_13']}';\n";
	echo "document.forms[0]['alt_age_d_14'].value = '${row['d_14']}';\n";
	echo "document.forms[0]['alt_age_j_14'].value = '${row['j_14']}';\n";
	echo "document.forms[0]['alt_age_t_14'].value = '${row['t_14']}';\n";
	echo "document.forms[0]['alt_age_d_g14'].value = '${row['d_g14']}';\n";
	echo "document.forms[0]['alt_age_j_g14'].value = '${row['j_g14']}';\n";
	echo "document.forms[0]['alt_age_t_g14'].value = '${row['t_g14']}';\n";	
}


?>

handleChange(document.forms[0]['alternate_school']);
handleChange(document.forms[0]['alt_age_d_l5']);
handleChange(document.forms[0]['alt_age_j_l5']);
handleChange(document.forms[0]['alt_age_t_l5']);
	

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
