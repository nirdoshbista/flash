<html>
<head>
<title>Edit Schools</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script>

function yearChange(){
	location = 'aeschool.php?year='+document.getElementById('year').value;
}

function districtChange(){
	location = 'aeschool.php?distcode='+document.getElementById('distlist').value+'&year='+document.getElementById('year').value;
}

function vdcChange(){
	location = 'aeschool.php?distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&year='+document.getElementById('year').value;
}

function schoolChange(){
	//document.getElementById('editedschool').value = document.getElementById('schoollist').value;
}

function editschool(){

	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	if (document.getElementById('vdclist').value==''){
		alert("Select vdc");
		return false;
	}
	
	if (document.getElementById('schoollist').value==''){
		alert("Select School");
		return false;
	}
	
	if (document.getElementById('editedschool').value==''){
		alert("School name cant be blank.");
		return false;
	}
	
	
	
	location = 'aeschool.php?req=edit&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&schoolcode='+document.getElementById('schoollist').value+'&editedschool='+document.getElementById('editedschool').value+'&year='+document.getElementById('year').value;
}

function addschool(){
	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	
		
	if (document.getElementById('newschool').value==''){
		alert("School name cant be blank.");
		return false;
	}
	
	location = 'aeschool.php?req=add&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&newschool='+document.getElementById('newschool').value+'&year='+document.getElementById('year').value;
}

function deleteschool(){
	if (document.getElementById('distlist').value==''){
		alert("Select district");
		return false;
	}
	
	if (document.getElementById('vdclist').value==''){
		alert("Select vdc");
		return false;
	}
	
	if (document.getElementById('schoollist').value==''){
		alert("Select School");
		return false;
	}	
	
	if (!confirm("Are you sure you want to delete?")) return false;
	
	location = 'aeschool.php?req=delete&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&schoolcode='+document.getElementById('schoollist').value+'&year='+document.getElementById('year').value;
}


function beautify(obj){

	var str=obj.value;

	str=str.replace(/[^a-zA-Z]/g," ");  // replace non character to space
	str=str.replace(/^[ ]*/,"");   // trim spaces at beginning
	str=str.replace(/[ ]*$/,"");	// trim spaces at end
	str=str.replace(/[ ]+/g," ");	// trim multiple spaces


	str=str.toLowerCase();
	var parts=str.split(" ");
	
	var s="";
	var tmp="";
	for (i=0;i<parts.length;++i){
		s+= ((parts[i].substring(0,1)).toUpperCase() + parts[i].substring(1) + " ");
	}
	s=s.replace(/[ ]*$/,"");	// trim spaces at end
	
	obj.value=s;

}

</script>
</head>
<body>

<div align="center">
  <p><img src="../images/flash.png"></p>
</div>
<br>

<h2 align="center">Edit School</h2>
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
	
	}
	if ($_GET['req']=='edit'){
		$d=$_GET['distcode'];
		$v=$_GET['vdccode'];
		$s=$_GET['schoolcode'];
		$sname=$_GET['editedschool'];
		$year=$_GET['year'];
		
		if ($_GET['year']==($currentyear-1)) $fv=2;
		if ($_GET['year']==$currentyear) $fv=1;		
		
		
		$query="update mast_schoollist set nm_sch='$sname' where dist_code='$d' and vdc_code='$v' and sch_num='$s' and sch_year='$year' and flash='$fv'";
		
		mysql_query($query);
		
		//echo $query;
		
		//echo mysql_error();
		
		echo "<center>School Name changed. <a href='".$_SERVER['PHP_SELF']."'>Go Back</a></center>";
		
	}
	


}
else{

?>

<form method="get" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return frmsubmit();">
<center>
<?php

	printf('<select name="year" id="year" onchange="yearChange();">');
	printf('<option value="2066"'.($_GET['year']=='2066'?' selected':'').'>Flash I</option>');
	printf('<option value="2065"'.($_GET['year']=='2065'?' selected':'').'>Flash II</option>');
	
	printf('</select>');
	
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


	printf('<select name="vdclist" id="vdclist" onchange="vdcChange();">');

	if (mysql_num_rows($result)==0){
		printf('<option value="%s">%s</option>', '', '-- Select District first --');
	}
	else printf('<option value="%s">%s</option>', '', '-- VDC --');
	

	foreach($rows as $r){
		printf('<option value="%s" %s>%s</option>', $r['vdc_code'],$_GET['vdccode']==$r['vdc_code']?'selected':'', $r['vdc_name_e']);

	}
	

	printf('</select>');
	
	
	if ($_GET['year']==($currentyear-1)) $fv=2;
	if ($_GET['year']==$currentyear) $fv=1;
	
	$result=mysql_query("select * from mast_schoollist where dist_code='".$_GET['distcode']."' and vdc_code='".$_GET['vdccode']."' and sch_year='".$_GET['year']."' and flash='$fv' order by sch_num");
	$rows = mysql_fetch_all($result);
	printf('<br /><select name="schoollist" id="schoollist" onchange="schoolChange()">');

	if (mysql_num_rows($result)==0){
		printf('<option value="%s">%s</option>', '', '-- Select VDC first --');
	}
	else printf('<option value="%s">%s</option>', '', '-- SCHOOL --');
	

	foreach($rows as $r){
		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['sch_code'].' - '.$r['nm_sch']);

	}
	

	printf('</select>');
	
	


?>

<br> <br>
<b> Edit </b><input size="50" type="text" value="" name="editedschool" id="editedschool" onchange="beautify(this);">
<input type="button" value="Edit" name="edit" onclick="editschool();">


</center>
</form>

<?php
}
?>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>