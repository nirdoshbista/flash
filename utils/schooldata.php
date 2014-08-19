<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0
?>
<html>
<head>
<title>School Remove/Transfer</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="../flash2/js/flash2common.js" type="text/javascript"></script>

<script>
function getSchoolName(o){
	
}

function check1(){
	if (document.getElementById('schremove1').value=='' || document.getElementById('schremove1').value.length!=9){
		alert("Invalid School Code");
		document.getElementById('schremove1').value='';
		document.getElementById('schremove1').focus();
		return false;
	}
	else{
		return confirm("Are you sure you want to remove?");
	}
}

function check2(){
	if (document.getElementById('schtransfer1').value=='' || document.getElementById('schtransfer1').value.length!=9){
		alert("Invalid School Code");
		document.getElementById('schtransfer1').value='';
		document.getElementById('schtransfer1').focus();
		return false;
	}
	if (document.getElementById('schtransfer2').value=='' || document.getElementById('schtransfer2').value.length!=9){
		alert("Invalid School Code");
		document.getElementById('schtransfer2').value='';
		document.getElementById('schtransfer2').focus();
		return false;
	}
	return confirm("Are you sure you want to transfer?");
	
}

</script>
</head>
<body>

<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<p align='center'>


<?php

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

if (isset($_POST['btn1'])){
	$sch_num = $_POST['school1'];
	$flash = $_POST['f'];
	
	if ($flash==2) $sch_year=$currentyear-1;
	if ($flash==1) $sch_year=$currentyear;
	
	foreach($t as $tablename){
		if (whichDB($tablename)==$flash){
			mysql_query("DELETE FROM $tablename WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
		}
	}
	
	// update flash1 or flash2 column
	mysql_query("UPDATE mast_schoollist SET flash$flash=0, closed=0, merged_with='' WHERE sch_num='$sch_num' AND sch_year='$sch_year'");

	// delete row if both flash1 and flash2 are empty	
	mysql_query("DELETE FROM mast_schoollist WHERE sch_num='$sch_num' AND sch_year='$sch_year' AND (flash1!='1' or flash1 is null) AND (flash2!='1' or flash2 is null)");
	
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num' AND sch_year='$sch_year'");
	if (mysql_num_rows($result)==0){
		mysql_query("DELETE FROM mast_school_type WHERE sch_num='$sch_num' AND sch_year='$sch_year'");		
	}
	
	mysql_query("DELETE FROM mast_school_type WHERE sch_num='$sch_num' AND sch_year='$sch_year' AND (flash1!='1' or flash1 is null) AND (flash2!='1' or flash2 is null)");
	
	echo "School Code $sch_num deleted.";
}

if (isset($_POST['btn2'])){
	$sch_num1 = $_POST['school1'];
	$sch_num2 = $_POST['school2'];
	$flash = $_POST['f'];
	
	if ($flash==2) $sch_year=$currentyear-1;
	if ($flash==1) $sch_year=$currentyear;
	
	// check if the school can be transferred
	
	// check if source school has been entered
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num1' AND sch_year='$sch_year' AND flash$flash=1");
	if (mysql_num_rows($result)==0) die("Invalid Source School ($sch_num1)");
	
	// destination school must be empty
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num2' AND sch_year='$sch_year' AND flash$flash=1");
	if (mysql_num_rows($result)!=0) die("Invalid Destination School ($sch_num2)");
	
	foreach($t as $tablename){
		if (whichDB($tablename)==$flash){
			mysql_query("UPDATE $tablename SET sch_num='$sch_num2' WHERE sch_num='$sch_num1' AND sch_year='$sch_year'");
		}
	}
	
	if ($flash==1){

		// remove flash1 entry for school 1
		mysql_query("UPDATE mast_schoollist SET flash1=0 WHERE sch_num='$sch_num1' and sch_year='$sch_year'");

		// create a new row for school 2
		$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num2' ORDER BY sch_year DESC");
		$row = mysql_fetch_assoc($result);
		
		$row['sch_year']=$sch_year;
		$row['flash1']=1;
		$row['flash2']=0;
		
		idata('mast_schoollist',$row);		
		
		// update mast_school_type for school 2 to school 1
		mysql_query("UPDATE mast_school_type SET sch_num='$sch_num2' WHERE sch_num='$sch_num1' AND sch_year='$sch_year'");		
		
		
	}
	
	if ($flash==2){
		
		// remove flash2 entry for school 1
		mysql_query("UPDATE mast_schoollist SET flash2=0 WHERE sch_num='$sch_num1' and sch_year='$sch_year'");
		
		
		// mark flash2 entry as set for school 2
		mysql_query("UPDATE mast_schoollist SET flash2=1 WHERE sch_num='$sch_num2' AND sch_year='$sch_year'");
	}

	
	echo "School Code $sch_num1 transferred to $sch_num2";
}


?>
</p>
<?php
if (isset($_GET['remove'])):
?>
<h2 align="center">School Remove</h2>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return check1();">
<p align="center">
School Code: <input type="text" name="school1" id="schremove1" size="15" maxlength="9" onkeypress="return forceNumberInput(this, event);" onchange="getSchoolName(this)" /> 
<select name='f'><option value='1'>Flash 1</option><option value='2' selected>Flash 2</option></select>
<br />
<br />
<input type="submit" name="btn1" value="Remove School Data">
</p>
</form>
<br />
<br />
<?php
endif;
?>
<?php
if (isset($_GET['transfer'])):
?>
<h2 align="center">School Transfer</h2>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return check2();">
<p align="center">
School 1: <input type="text" name="school1" id="schtransfer1" size="15" maxlength="9" onkeypress="return forceNumberInput(this, event);" onchange="getSchoolName(this)" /> 
School 2: <input type="text" name="school2" id="schtransfer2" size="15" maxlength="9" onkeypress="return forceNumberInput(this, event);" onchange="getSchoolName(this)" />
<select name='f'><option value='1'>Flash 1</option><option value='2' selected>Flash 2</option></select>
	
<br />
<br />
<input type="submit" name="btn2" value="School 1 -> School 2">
</p>
</form>
<?php
endif;
?>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>
