<html>
<head>
<title>Add Edit VDCs</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script>

function districtChange(){
	location = 'aevdc.php?distcode='+document.getElementById('distlist').value;
}

function editvdc(){

	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	if (document.getElementById('vdclist').value==''){
		alert("Select vdc");
		return false;
	}
	
	if (document.getElementById('editedvdc').value==''){
		alert("VDC name cant be blank.");
		return false;
	}
	
	location = 'aevdc.php?req=edit&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&editedvdc='+document.getElementById('editedvdc').value;
}

function addvdc(){
	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	
	if (document.getElementById('newvdc').value==''){
		alert("VDC name cant be blank.");
		return false;
	}
	
	location = 'aevdc.php?req=add&distcode='+document.getElementById('distlist').value+'&newvdc='+document.getElementById('newvdc').value;
}

function deletevdc(){
	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	
	if (document.getElementById('vdclist').value==''){
		alert("Select vdc");
		return false;
	}
	
	if (!confirm("Are you sure you want to delete?")) return false;
	
	location = 'aevdc.php?req=delete&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value;
}




</script>
</head>
<body>

<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<h2 align="center">Add Edit VDC</h2>
<p align="center">&nbsp;</p>
<?php
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);


if (isset($_GET['req'])){

	if ($_GET['req']=='add'){
		$d=$_GET['distcode'];
		$vname=$_GET['newvdc'];
		
		$vname=ucwords(strtolower($vname)); 
		
		$result=mysql_query("select max(vdc_code) as v from mast_vdc where dist_code='$d';");
		$row=mysql_fetch_array($result);
		
		$newvcode = $row['v']+1;
		$newvcode = str_pad($input, 3, "0", STR_PAD_LEFT);  
		
		mysql_query("insert into mast_vdc (dist_code, vdc_code, vdc_name_e) values('$d','$newvcode','$vname')");
		
		echo "<center>VDC $vname added. <a href='".$_SERVER['PHP_SELF']."'>Go Back</a></center>";
	
	}
	if ($_GET['req']=='edit'){
		$d=$_GET['distcode'];
		$v=$_GET['vdccode'];
		$vname=$_GET['editedvdc'];
		
		$vname=ucwords(strtolower($vname)); 
		
		mysql_query("update mast_vdc set vdc_name_e='$vname' where dist_code='$d' and vdc_code='$v'");
		
		echo "<center>VDC Name changed. <a href='".$_SERVER['PHP_SELF']."'>Go Back</a></center>";
		
	}
	
	if ($_GET['req']=='delete'){
		$d=$_GET['distcode'];
		$v=$_GET['vdccode'];
	
		mysql_query("delete from mast_vdc where dist_code='$d' and vdc_code='$v'");
		
		echo "<center>VDC deleted. <a href='".$_SERVER['PHP_SELF']."'>Go Back</a></center>";
		
	}


}
else{

?>

<form method="get" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return frmsubmit();">
<center>
<?php


	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);

	printf('<select name="distlist" id="distlist" onchange="districtChange()">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s" %s>%s</option>', $r['dist_code'], $_GET['distcode']==$r['dist_code']?'selected':'',$r['dist_name']);

	}
	printf('</select>');
	
	$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']));
	$rows = mysql_fetch_all($result);


	printf('<select name="vdclist" id="vdclist">');

	if (mysql_num_rows($result)==0){
		printf('<option value="%s">%s</option>', '', '-- Select District first --');
	}
	else printf('<option value="%s">%s</option>', '', '-- VDC --');
	

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

	}
	

	printf('</select>');
	
	


?>

<br> <br>
<b> Edit </b><input type="text" value="" name="editedvdc" id="editedvdc">
<input type="button" value="Edit" name="edit" onclick="editvdc();">

<br> <br>


</center>
</form>

<?php
}
?>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>