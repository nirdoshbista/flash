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
<script src="js/schoolinfo2.js" type="text/javascript"></script>
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
 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="13">Classrooms and Sections</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td>&nbsp;</td>
    <td>ECD</td>
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
    <td>Sections</td>
    <td><input name="sections_0" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_0" size="4" maxlength="3" <?php if ($classes[0]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>		
    <td><input name="sections_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>		
    <td><input name="sections_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_t" size="4" maxlength="3" disabled></td>
  </tr>
  <tr> 
    <td>Classrooms</td>
    <td><input name="classrooms_0" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_0" size="4" maxlength="3" <?php if ($classes[0]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_1" size="4" maxlength="3" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_2" size="4" maxlength="3" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_3" size="4" maxlength="3" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_4" size="4" maxlength="3" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_5" size="4" maxlength="3" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>		
    <td><input name="classrooms_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_6" size="4" maxlength="3" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_7" size="4" maxlength="3" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_8" size="4" maxlength="3" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_9" size="4" maxlength="3" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_10" size="4" maxlength="3" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>		
    <td><input name="classrooms_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_t" size="4" maxlength="3" disabled></td>
  </tr>
</table>
<br />

 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
 
   <tr> 
      <td width="192" class="ewTableHeader">2.1.&nbsp; Total Land&nbsp; </td>
      <td width="689">For Terai: Bigaha
        <input name="i1_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_1" type="text" size="5" maxlength="3">
        Kattha
        <input name="i1_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_2" type="text" size="5" maxlength="3">
        Dhuri 
        <input name="i1_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_3" type="text" size="5" maxlength="3">
        &nbsp;&nbsp;&nbsp;Non-terai: Ropani
        <input name="i1_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_4" type="text" size="5" maxlength="3"> 
        Aana
        <input name="i1_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_5" type="text" size="5" maxlength="3">
        Paisa
        <input name="i1_6" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_6" type="text" size="5" maxlength="3">
        Dam <input name="i1_7" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i1_7" type="text" size="5" maxlength="3"> 
      </td>
    </tr> 
   <tr> 
      <td width="192" class="ewTableHeader">2.2.&nbsp; Land inside compount&nbsp; </td>
      <td width="689">For Terai: Bigaha
        <input name="i2_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_1" type="text" size="5" maxlength="3">
        Kattha
        <input name="i2_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_2" type="text" size="5" maxlength="3">
        Dhuri 
        <input name="i2_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_3" type="text" size="5" maxlength="3">
        &nbsp;&nbsp;&nbsp;Non-terai: Ropani
        <input name="i2_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_4" type="text" size="5" maxlength="3"> 
        Aana
        <input name="i2_5" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_5" type="text" size="5" maxlength="3">
        Paisa
        <input name="i2_6" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_6" type="text" size="5" maxlength="3">
        Dam <input name="i2_7" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i2_7" type="text" size="5" maxlength="3"> 
      </td>
    </tr>  
    
    
   <tr> 
    <td width="25%" class="ewTableHeader">2.3. Compound</td>
    <td>
	<select name="compound" id="compound" onkeypress="return generalKeyPress(this, event);"  onchange="handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='i3' class='divhide'>
	  &nbsp;&nbsp;&nbsp;&nbsp;Type of Compound
      <select name="cstatus" id="cstatus" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Rigid wall</option>
        <option value="2">Weak wall</option>
        <option value="3">Local Material</option>
        <option value="4">Barbed wire</option>
        <option value="5">Pledge</option>
        <option value="6">Others</option>
      </select>
	  </span>
	  </td>
  </tr>
  
  <tr> 
    <td width="25%" class="ewTableHeader">3.1. Water</td>
    <td>
		<select name="water" id="water" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='i3_1' class='divhide'>
      Tap
      <input name="water_tap" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_tap" value="1">
      Tubewell 
      <input name="water_tubewell" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_tubewell" value="2">
      Well
      <input name="water_well" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_well" value="3">
      Other 
      <input name="water_other" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_other" value="4">
	  </span>
	  </td>
  </tr> 
  <tr> 
    <td width="25%" class="ewTableHeader">3.2. Toilet</td>
    <td>
	<select name="toilet" id="toilet" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='i3_2' class='divhide'>
      Total
      <input name="t_total" type="text" id="t_total" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="3">
      Separate for girls 
      <input name="t_girls" type="text" id="t_girls" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="3">
      
      Common for girls and boys
      <input name="t_all" type="text" id="t_all" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="3">

      Separate for teachers 
      <input name="t_teachers" type="text" id="t_teachers" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="3">
	  </span>

	  
	  </td>
  </tr>   
  <tr> 
    <td width="25%" class="ewTableHeader">3.3. Urinal</td>
    <td>
      	  <select name="urinal" id="urinal" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='i3_3' class='divhide'>
      Separate for teachers
      <input name="urinal_teachers" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="urinal_teachers" value="1">
      Separate for girls <input name="urinal_girls" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="urinal_girls" value="1">
	  </span>

	  
	  </td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">4.1. Playground</td>
    <td>
		<select name="pground" id="pground" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	<span id='i4_1' class='divhide'>
      Enough Space
      <select name="pground_enough_space" id="pground_enough_space" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>      
      </span>
</td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">4.2. Computer</td>
    <td>Separate Computer Room
	<select name="computer_room" id="computer_room" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='i4_2' class='divhide'>
      Total Computers 
      <input name="num_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_computers" size="4" maxlength="3">
      For Education 
      <input name="teaching_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="teaching_computers" size="4" maxlength="3">
      For Admin 
      <input name="admin_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="admin_computers" size="4" maxlength="3">
	  </span>
	  </td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">4.3. Electricity</td>
    <td>
		<select name="electricity" id="electricity" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
</td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">5.1 Buildings</td>
    <td>Total 
      <input name="num_buildings" id="num_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Pakki
      <input name="rigid_buildings" id="rigid_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Kachhi
      <input disabled name="weak_buildings" id="weak_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>    
  
   
 </table>

</form>



<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

// disable items

var d = document.forms[0];
for (i=0;i<=10;i++){
	if (classes[i]==0){
		d['sections_'+i].disabled = true;
		d['classrooms_'+i].disabled = true;
	}
}


// load data

<?php

// set for autofill
if (isset($_GET['af'])) $currentyear--;

$result = mysql_query("select * from school_physical where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)){
	$row = mysql_fetch_array($result);

	echo "autoFillEnabled = false;\n";
	echo "document.forms[0]['i1_1'].value = '${row['land_bigaha']}';\n";
	echo "document.forms[0]['i1_2'].value = '${row['land_kattha']}';\n";
	echo "document.forms[0]['i1_3'].value = '${row['land_dhur']}';\n";
	echo "document.forms[0]['i1_4'].value = '${row['land_ropani']}';\n";
	echo "document.forms[0]['i1_5'].value = '${row['land_aana']}';\n";
	echo "document.forms[0]['i1_6'].value = '${row['land_paisa']}';\n";
	echo "document.forms[0]['i1_7'].value = '${row['land_daam']}';\n";
	echo "document.forms[0]['i2_1'].value = '${row['compound_bigaha']}';\n";
	echo "document.forms[0]['i2_2'].value = '${row['compound_kattha']}';\n";
	echo "document.forms[0]['i2_3'].value = '${row['compound_dhur']}';\n";
	echo "document.forms[0]['i2_4'].value = '${row['compound_ropani']}';\n";
	echo "document.forms[0]['i2_5'].value = '${row['compound_aana']}';\n";
	echo "document.forms[0]['i2_6'].value = '${row['compound_paisa']}';\n";
	echo "document.forms[0]['i2_7'].value = '${row['compound_daam']}';\n";
	
	
	echo "document.forms[0]['compound'].value = '${row['compound']}';\n";
	echo "document.forms[0]['cstatus'].value = '${row['cstatus']}';\n";
	
	echo "document.forms[0]['water'].value = '${row['water']}';\n";
	echo "document.forms[0]['water_tap'].checked = ${row['water_tap']};\n";
	echo "document.forms[0]['water_tubewell'].checked = ${row['water_tubewell']};\n";
	echo "document.forms[0]['water_well'].checked = ${row['water_well']};\n";
	echo "document.forms[0]['water_other'].checked = ${row['water_other']};\n";
	
	echo "document.forms[0]['toilet'].value = '${row['toilet']}';\n";
	echo "document.forms[0]['t_total'].value = '${row['t_total']}';\n";
	echo "document.forms[0]['t_all'].value = '${row['t_all']}';\n";
	echo "document.forms[0]['t_girls'].value = '${row['t_girls']}';\n";
	echo "document.forms[0]['t_teachers'].value = '${row['t_teachers']}';\n";
	
	echo "document.forms[0]['urinal'].value = '${row['urinal']}';\n";
	echo "document.forms[0]['urinal_girls'].checked = ${row['urinal_girls']};\n";
	echo "document.forms[0]['urinal_teachers'].checked = ${row['urinal_teachers']};\n";
	
	echo "document.forms[0]['pground'].value = '${row['pground']}';\n";
	echo "document.forms[0]['pground_enough_space'].value = '${row['pground_enough_space']}';\n";
	
	echo "document.forms[0]['computer_room'].value = '${row['computer_room']}';\n";
	echo "document.forms[0]['num_computers'].value = '${row['num_computers']}';\n";
	echo "document.forms[0]['admin_computers'].value = '${row['admin_computers']}';\n";
	echo "document.forms[0]['teaching_computers'].value = '${row['teaching_computers']}';\n";
	
	echo "document.forms[0]['electricity'].value = '${row['electricity']}';\n";
	
	echo "document.forms[0]['num_buildings'].value = '${row['num_buildings']}';\n";
	echo "document.forms[0]['rigid_buildings'].value = '${row['rigid_buildings']}';\n";
	echo "document.forms[0]['weak_buildings'].value = '${row['weak_buildings']}';\n";	
	
}

// classrooms and sections
for ($i=0;$i<=10;$i++){
	
	$result = mysql_query("select * from sections where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
	if (mysql_num_rows($result)==0) continue;
	
	$row = mysql_fetch_array($result);
	
	echo "document.forms[0]['sections_$i'].value = '${row['sections']}';\n";	
	echo "document.forms[0]['classrooms_$i'].value = '${row['classrooms']}';\n";	
}


?>

// calculations

handleChange(document.forms[0]['sections_0']);
handleChange(document.forms[0]['classrooms_0']);

handleChange(document.forms[0]['compound']);
handleChange(document.forms[0]['water']);
handleChange(document.forms[0]['toilet']);
handleChange(document.forms[0]['urinal']);
handleChange(document.forms[0]['pground']);
handleChange(document.forms[0]['computer_room']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
