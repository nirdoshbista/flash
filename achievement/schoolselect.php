<?php

$sch_num=$_GET['s'];

require_once('includes/vars.php');
require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Achievement</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style_flash.css" rel="stylesheet" type="text/css">
<script src="js/jquery/jquery.js" type="text/javascript"></script>
<script>

var dist_code = '<?php echo $_GET['d']; ?>';
var vdc_code = '<?php echo $_GET['v']; ?>';


function districtChange(o,e){
	var dist_code = $('#distlist').val();
	$.get('schoolselectbe.php',{req:'vdclist',distcode:dist_code},function(data){
		$('#divvdc').html(data);
	});

}

function vdcChange(o,e){
	fillSchool();
}

function fillSchool(){

	var dist_code = $('#distlist').val();
	var vdc_code = $('#vdclist').val();
	var order = $('#ordername').attr('checked')?'name':'code';
	var cls = $('#class_select').val();
	
	$.get('schoolselectbe.php',{req:'schoollist_e', d:dist_code, v:vdc_code, c:cls, o:order, e:'true'},function (data){
		$('#schoollist_e').html(data);
	});
	
	$.get('schoolselectbe.php',{req:'schoollist_ne', d:dist_code, v:vdc_code, c:cls, o:order, e:'false'},function (data){
		$('#schoollist_ne').html(data);
	});

	document.getElementById('c').value = document.getElementById('class_select').value;

	
}

function sortOrderChange(){
	fillSchool();

}

function schoolSelect(o){
	
	if (o.id=='slist_e') document.getElementById('slist_ne').selectedIndex = '-1';
	if (o.id=='slist_ne') document.getElementById('slist_e').selectedIndex = '-1';
	
	document.getElementById('s').value = o.value;
	
	
	document.getElementById('submitbtn').disabled = false;
	
}

// initialize
$(document).ready(function(){
	
	$.get('schoolselectbe.php',{req:'distlist'},function(data){
		$('#divdistrict').html(data);
		
		if (dist_code!='') {
			$('#distlist').val(dist_code);
			if (vdc_code!=''){
				$.get('schoolselectbe.php',{req:'vdclist',distcode:dist_code},function(data){
					$('#divvdc').html(data);
					$('#vdclist').val(vdc_code);
					fillSchool();
				});				
			
			}
			
		}
	});
	
	
	if (dist_code!=''){
		// fetch district
		
	}
	
	
});

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

</style>
</head>

<body>
<div align="center">
  <p><img src="images/dle.png"></p>
</div>
<br>

<table width="650px" align="center" cellpadding="5">
<tr>
<td height="20px">
<div id='navitabs'>
<a href='#' class="activenavitab" id='menuexistingschool'>Existing School</a>
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

<span style="float:right;">
<strong>Class</strong>
<select name='class_select' id='class_select' onchange='fillSchool();'>
<option value=''>- Class -</option>


<?php
$cls = $_GET['c'];
for ($k=1;$k<=12;$k++){
	echo "<option value='$k' ".($k==$cls?' selected ':'').">$k</option>";
}

?>

</select>
</span>
</div>

<div id='existingschool'>
<table width="100%" cellpadding="10">
<tr>
<td>
<p><b>Not-Entered</b></p>
<div id="schoollist_ne">

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
<input type="hidden" name="c" id='c'>
<input type='submit' value="Next >>" id='submitbtn' disabled>
</p>
</form>

</td>
</tr>
</table>



<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<p>&nbsp;</p>
<script>
document.getElementById("toprightmenu").innerHTML = '<a href="index.php">Main Menu</a> | <a href="reportpre.php">Reports</a> | <a href="../logout.php">Logout</a>';
	
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
