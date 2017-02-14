<?php
//if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

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
<script src="js/schoolselect.js" type="text/javascript"></script>
<script>
<?php 

	if (isset($_GET['prevcode'])){
		echo "prevdcode='".substr($_GET['prevcode'],0,2)."';\n";
		echo "prevvcode='".substr($_GET['prevcode'],2,3)."';\n";
	}
	else {
		echo "prevdcode='';\n";
		echo "prevvcode='';\n";
		
	}

?>
</script>
<style>

.schoolinput{
font-size:12px;
font-weight:bold;
}

table{
	font-size: 9px;
}

.a{
	padding:10px;
	padding-bottom:0px;
}

input:disabled{
	background-color: #bbb;
}

</style>
</head>

<body onload="initialize();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>

<table width="650px" align="center" cellpadding="5">
<tr>
<td height="20px">
<div id='navitabs'>
<a href='#' class="activenavitab" id='menuexistingschool' onclick="showExisting()">Existing School</a>
<a href='#' class="navitab" id='menunewschool'  onclick="showAddNewSchool()">New School</a>

</div>
</td>
</tr>
<tr>
<td bgcolor="#BBCCDD" valign="top">
<div class='a'>
District
<span id='divdistrict'><select name="distlist" id="distlist"></select></span>
VDC
<span id='divvdc'><select name="vdclist" id="vdclist"><option value=" ">- VDC -</option></select></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id='sorttype'>
Sort by 
<label><input type="radio" name='order' id='ordername' value='name' checked onchange="sortOrderChange();">Name</label>
<label><input type="radio" name='order' id='ordercode' value='code' onchange="sortOrderChange();">Code</label>
</span>
</div>


<div id='existingschool'>



<table width="100%" cellpadding="10">
<tr>
<td>
<p><b>Not-Entered</b></p>
<div "id="schoollist_ne">

<select size="20" style="width:300px;">
</select>
</div>
</td>
<td>
<p><b>Entered</b></p>
<div id="schoollist_e">
<select size="20" style="width:300px;">
</select>
</div>
</td>
</table>


<form action="basicinfo.php" method="get" style='padding-right:10px; margin-top:-10px;'>
<p align='right'>
<input type="hidden" name="s" id='s'>
<div style="float:right"><input type='submit' value="Next >>" id='submitbtn' disabled></div>

<div style="float:left; margin-left: 10px; display:none;">
	<input type='button' value='Close' id='sch_close' onclick="schoolClose()" disabled />
	<input type='button' value='Merge with..' id='sch_merge' onclick="schoolMerge()" disabled title='Select school under Not-entered, press Merge With... and select school under Entered' />
	<input type='hidden' value='' id='merge_with'>
</div>

<div style="clear:both;"></div>
</p>
</form>


</div>



<div id='newschool' class="divhide">
<div class='a'>
<input name="sch_name" type="hidden" id="sch_name" size="50" maxlength="50" class='schoolinput' disabled>

<form action="newschool.php" method="post" onsubmit="return newSchoolValid();">
<input  name="sch_dcode" type="hidden" id="sch_dcode" size="5" maxlength="2">
<input  name="sch_vcode" type="hidden" id="sch_vcode" size="6" maxlength="3">
<input  name="sch_code" type="hidden" id="sch_code" size="8" maxlength="4">

Name <input type='text' size='50' class="schoolinput" name="sn" id='sn' onchange="beautify(this);">
<table border="0" style="padding-top:5px;padding-bottom:5px;">
    <tr valign="bottom"> 
      <td>Address<br> <input name="sch_add" onkeypress="return generalKeyPress(this, event);" onchange="beautify(this);" type="text" id="sch_add" size="20" maxlength="50"></td>
      <td>Ward<br> <input name="sch_ward" onkeypress="return forceNumberInput(this, event);" type="text" id="sch_ward" size="5" maxlength="2"></td>
      <td>Region<br> <select name="sch_region" onkeypress="return generalKeyPress(this, event);" id="sch_region">
          <option value="0"> </option>
          <option value="1"> Rural </option>
          <option value="2"> Urban </option>
        </select></td>
      <td>Phone<br> <input name="sch_phone" onkeypress="return forceNumberInput(this, event);" type="text" id="sch_phone" size="10" maxlength="10"></td>
      <td>Email<br> <input name="sch_email" onkeypress="return generalKeyPress(this, event);" type="text" id="sch_email" size="20" maxlength="30"></td>
    </tr>
  </table>

<input type='submit' value="Create" id='submitbtn'>

</form>
</div>
</div>

</td>
</tr>
</table>



<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<p>&nbsp;</p>
<script>
document.getElementById("toprightmenu").innerHTML = '<a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a>';
	
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
