<html>
<head>
<title>Database Repair</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body onload="autoRepair();">

<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<h2 align="center">Repair Database</h2>
<p>&nbsp;</p>
<p align="center">
<?php
if (isset($_POST['repairtype'])){

	
require_once('../includes/tablelist.php');
require_once('../includes/vars.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

if ($_POST['repairtype']==1) $rtype = 'QUICK';
if ($_POST['repairtype']==2) $rtype = '';
if ($_POST['repairtype']==3) $rtype = 'EXTENDED';

echo "$rtype Repairing Tables... <span id='abc' align='center'></span><br><br>";

$achievement_tables = array("student_main", "student_marks","subjects");

foreach($t as $tablename){
    if(!in_array($tablename, $achievement_tables))
    {
	$result=mysql_query("REPAIR TABLE $tablename $rtype;");
	$r=mysql_fetch_array($result);
	
	echo mysql_error();
	
	if ($r['Msg_text']!='OK'){
		//echo $tablename."..";
		echo "<font color='red'>".$r['Msg_text']."</font><br>";
	}
	//else echo $r['Msg_text'];
    }   
}

// repair Achievement Tables
$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db("achievement", $link);

foreach($achievement_tables as $tablename){
	
	$result=mysql_query("REPAIR TABLE $tablename $rtype;");
	$r=mysql_fetch_array($result);
	
	echo mysql_error();
	
	if ($r['Msg_text']!='OK'){
		//echo $tablename."..";
		echo "<font color='red'>".$r['Msg_text']."</font><br>";
	}
	//else echo $r['Msg_text'];

}


echo "<script>document.getElementById('abc').innerHTML= \"Done. <br><h3><a href='../index.php'>Return to Main Menu</a></h3>\";</script>";


}
else{
?>
&nbsp;</p>
<div id='repairform'>
<form name="form1" id='form1' method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="document.getElementById('repairform').className='divhide'; document.getElementById('working').className='divshow'; return true;">
  <p align="center"> 
    <label> </label>
    <label>
    <input name="repairtype" type="radio" value="1" unchecked>
    Quick</label>
    <label> 
    <input name="repairtype" type="radio" value="2" unchecked>
    Normal</label>
    <label> 
    <input name="repairtype" type="radio" value="3" checked>
    Extended</label>
  </p>
  <p align="center">
    <input type="submit" name="submit" id="submit" value="Repair">
  </p>  
</form>
</div>
<div id='working' class='divhide'><p align='center'>Repairing database ... <br /><img src='working.gif'></p></div>

<?php
}
?>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>
<script>
function autoRepair(){
<?php
if (isset($_GET['repair'])){

	echo "document.getElementById('submit').click();\n";
}
?>
}
</script>
</body>
</html>
