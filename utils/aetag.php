<html>
<head>
<title>Add Edit Tags</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script>
function newtagsubmit(){
	if (document.getElementById('tag_category').value=='' && document.getElementById('new_tag_category').value=='' ){
		alert('Enter tag category');
		return false;
	}
	if (document.getElementById('tag_name').value==''){
		alert('Enter tag name');
		document.getElementById('tag_name').focus();
		return false;
	}
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
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

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
		
		$query="update mast_schoollist set nm_sch='$sname' where dist_code='$d' and vdc_code='$v' and sch_num='$s' and sch_year='2063'";
		
		mysql_query($query);
		
		//echo $query;
		
		//echo mysql_error();
		
		echo "<center>School Name changed. <a href='".$_SERVER['PHP_SELF']."'>Go Back</a></center>";
		
	}
	


}
else{

?>

<form method="get" action="newtag.php"  onsubmit="return newtagsubmit();">
<center>

<h2>Add New Tag</h3>
<br>
<b>Category: </b>

<?php

	$result = mysql_query('select distinct tag_category from tags order by tag_category');
	$rows = mysql_fetch_all($result);

	printf('<select name="tag_category" id="tag_category">');
	printf('<option value="%s">%s</option>', '', '-- Tag Category --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['tag_category'], $r['tag_category']);

	}
	printf('</select>');
?>	
	
<b>or add new: </b> <input type="text" size="30" name="new_tag_category" id="new_tag_category"  onchange="beautify(this);">

<br><br>
<b>Tag Name: </b> <input type="text" size="30" name="tag_name" id="tag_name" onchange="beautify(this);">

<input type="submit" value="Add Tag">
</center>

</form>

<p>&nbsp;</p>
<p>&nbsp;</p>

<form method="get" action="edittag.php" onsubmit="if (document.getElementById('tag_id').value=='') return false;">

<center>

<h2>Edit/Delete Existing Tag</h3>
<br>
<b>Tags: </b>

<?php

	$result = mysql_query('select * from tags order by tag_category, tag_name');
	$rows = mysql_fetch_all($result);

	printf('<select name="tag_id" id="tag_id">');
	printf('<option value="%s">%s</option>', '', '-- Tags --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['tag_id'],$r['tag_category'].' - '. $r['tag_name']);

	}
	printf('</select>');
?>	
	
<input type="submit" name="edittag" value="Edit Tag">
&nbsp;
<input type="submit" name="deletetag" value="Delete Tag">
</center>

</form>

<?php
}
?>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>