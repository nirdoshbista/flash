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
<script src="js/schoolinfo3.js" type="text/javascript"></script>
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

  <tr> 
    <td width="25%" class="ewTableHeader">5.4 Buildings</td>
    <td>Government Aid 
      <input name="buildings_govt" id="buildings_govt" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Community
      <input name="buildings_community" id="buildings_community" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Local Aid
      <input name="buildings_localresource" id="buildings_localresource" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Others
      <input name="buildings_others" id="buildings_others" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>

  <tr> 
    <td width="25%" class="ewTableHeader">5.5 Rooms</td>
    <td>Rigid
      <input name="classroom_rigid" id="classroom_rigid" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Weak
      <input name="classroom_weak" id="classroom_weak" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>
  
  <tr> 
    <td width="25%" class="ewTableHeader">5.6 Rooms Construction</td>
    <td>Government Aid
      <input name="roomscons_govt" id="roomscons_govt" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Community
      <input name="roomscons_comm" id="roomscons_comm" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Local Aid
      <input name="roomscons_local" id="roomscons_local" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
     &nbsp;&nbsp;&nbsp;Others
      <input name="roomscons_other" id="roomscons_other" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">

	  </td>
  </tr>  
  
  <tr> 
    <td width="25%" class="ewTableHeader">5.7 Total Rooms</td>
    <td>Used
      <input name="rooms_used" id="rooms_used" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      &nbsp;&nbsp;&nbsp;Unused
      <input name="rooms_unused" id="rooms_unused" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
	  </td>
  </tr>  

  <tr> 
    <td width="25%" class="ewTableHeader">5.8 New rooms</td>
    <td>Required
	<select name="additional_rooms" id="additional_rooms" onkeypress="event.which = null; return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='i6_3' class='divhide'>
      &nbsp;&nbsp;Required rooms 
      <input name="additional_rooms_num" id="additional_rooms_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3">
      </span>
	  </td>
  </tr> 

  <tr> 
    <td width="25%" class="ewTableHeader">5.9 Enough Land</td>
    <td>
    <select name="additional_rooms_land" id="additional_rooms_land" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>      
	  </td>
  </tr> 
  
  
  
  <tr> 
    <td width="25%" class="ewTableHeader">5.10 Rooms to rehabilitate</td>
    <td><input name="recons_needed_rooms" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="recons_needed_rooms" size="4" maxlength="3"></td>
  </tr> 
  <tr> 
    <td width="25%" class="ewTableHeader">5.11 Desk Bench</td>
    <td>Number of desk-bench 
      <input name="num_desk" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_desk" size="4" maxlength="3">
      &nbsp;&nbsp;Usable 
      <input name="usable_desk_students" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_desk_students" size="4" maxlength="3">
   </tr> 
  <tr> 
    <td width="25%" class="ewTableHeader">5.12 Inadequate Desk Bench</td>
    <td>
      <input name="inadequate_desk_students" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="inadequate_desk_students" size="4" maxlength="3"></td>
  </tr> 
  <tr> 
    <td width="25%" class="ewTableHeader">5.13 Table</td>
    <td>Number of Tables 
      <input name="num_table" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_table" size="4" maxlength="3">
      &nbsp;&nbsp;Usable 
      <input name="usable_table" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_table" size="4" maxlength="3">
  </tr>
              <tr> 
    <td width="25%" class="ewTableHeader">5.14 Chairs</td>
    <td>
      Number of Chairs 
      <input name="num_chair" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_chair" size="4" maxlength="3">
      &nbsp;&nbsp;Usable chairs 
      <input name="usable_chair" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_chair" size="4" maxlength="3"></td>
  </tr>
</table>
</form>

<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

// data

<?php

// set for autofill

if (isset($_GET['af'])) $currentyear--;

$result = mysql_query("select * from school_physical where sch_num='$sch_num' and sch_year='$currentyear'");


if (mysql_num_rows($result)){
	$row = mysql_fetch_array($result);
	echo "autoFillEnabled = false;\n";
	echo "document.forms[0]['buildings_govt'].value = '${row['buildings_govt']}';\n";
	echo "document.forms[0]['buildings_community'].value = '${row['buildings_community']}';\n";
	echo "document.forms[0]['buildings_localresource'].value = '${row['buildings_localresource']}';\n";
	echo "document.forms[0]['buildings_others'].value = '${row['buildings_others']}';\n";
	echo "document.forms[0]['classroom_rigid'].value = '${row['classroom_rigid']}';\n";
	echo "document.forms[0]['classroom_weak'].value = '${row['classroom_weak']}';\n";
	echo "document.forms[0]['roomscons_govt'].value = '${row['classroom_govt']}';\n";
	echo "document.forms[0]['roomscons_comm'].value = '${row['classroom_community']}';\n";
	echo "document.forms[0]['roomscons_local'].value = '${row['classroom_localresource']}';\n";
	echo "document.forms[0]['roomscons_other'].value = '${row['classroom_others']}';\n";
	echo "document.forms[0]['rooms_used'].value = '${row['classroom_usable']}';\n";
	echo "document.forms[0]['rooms_unused'].value = '${row['classroom_unused']}';\n";
	if ($row['classroom_inadequate']>0) echo "document.forms[0]['additional_rooms'].value = '1';\n";
	echo "document.forms[0]['additional_rooms_num'].value = '${row['classroom_inadequate']}';\n";
	echo "document.forms[0]['additional_rooms_land'].value = '${row['classroom_land_available']}';\n";
	echo "document.forms[0]['recons_needed_rooms'].value = '${row['recons_needed_rooms']}';\n";
	echo "document.forms[0]['num_desk'].value = '${row['num_desk']}';\n";
	echo "document.forms[0]['usable_desk_students'].value = '${row['usable_desk_students']}';\n";
	echo "document.forms[0]['inadequate_desk_students'].value = '${row['inadequate_desk_students']}';\n";
	echo "document.forms[0]['num_table'].value = '${row['num_table']}';\n";
	echo "document.forms[0]['usable_table'].value = '${row['usable_table']}';\n";
	echo "document.forms[0]['num_chair'].value = '${row['num_chair']}';\n";
	echo "document.forms[0]['usable_chair'].value = '${row['usable_chair']}';\n";	
}


?>
handleChange(document.forms[0]['additional_rooms']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
