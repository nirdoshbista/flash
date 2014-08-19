<?php

require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

if (isset($_POST['submit'])){
	
	
	$districts = $_POST['d'];
	
	foreach($districts as $d){
		
		mysql_query("delete from subjects where dist_code='$d'",$dblink);
		mysql_query("delete from student_main where stu_num LIKE '$d%'",$dblink);
		mysql_query("delete from student_marks where stu_num LIKE '$d%'",$dblink);
		
	}
	
}
?>

<html>
<head>
<title>Flash Achievements - Remove District</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
  <p><img src="../images/flash.png"></p>
</div>
<br>

<h2 align="center">Remove District</h2>

<p style='color:red;' align="center">WARNING: This will remove all year data for selected district!</p>
<p align="center">&nbsp;

<?php
	if ($_POST['submit']){
		echo "<div class='ewmsg' style='text-align:center;'>";
		echo count($districts), " district(s) removed from database.";
		echo "</div>";
	}

?>
</p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">


  <p align="center"> 
  
  
  
<?php  

	$result = mysql_query('select * from mast_district order by dist_name', $flashdblink);
	printf('District: <br /><select name="d[]" id="d" onchange="return handlechange(this, event);" size="10" multiple>');
	while ($r = mysql_fetch_assoc($result)){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');
	
?>	
  </p>
  <p align="center">
    <input type="submit" name="submit" value="Remove">
  </p>  
</form>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>
