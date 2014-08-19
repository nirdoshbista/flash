<html>
<head>
<title>Edit Tags</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style>
select{
	min-width: 100px;
}
td{
	font-size: x-small;
	font-weight: bold;
}

</style>

<script>
function tagmean(){
	var str = document.getElementById('codes').value;
	
	str=str.replace(/^[ ]*/,"");   // trim spaces at beginning
	str=str.replace(/[ ]*$/,"");	// trim spaces at end
	str=str.replace(/[ ]+/g," ");	// trim multiple spaces
	
	document.getElementById('codes').value = str;

	ajaxDiv('tagbackend.php?req=tagmeaning&codes='+document.getElementById('codes').value, 'tagmeaning');
}

function ajaxDiv(url, targetdiv)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
	//alert(url);
    XMLHttpRequestObject.open("GET", url); 
    

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
    if (XMLHttpRequestObject.readyState == 4 && 
		XMLHttpRequestObject.status == 200) { 
          write2div(XMLHttpRequestObject.responseText, targetdiv); 
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
      } 
    } 
    XMLHttpRequestObject.send(null); 
  }
}

function districtChange(){
	ajaxDiv('tagbackend.php?req=vdclist&distcode='+document.getElementById('distlist').value, 'divvdc');

}

function vdcChange(){
	ajaxDiv('tagbackend.php?req=schoollist&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value, 'divschool');

}


function write2div(text, divid){
	
	document.getElementById(divid).innerHTML = text;
	
	
}

function addtag(t){
	if (t!=''){
		var c = ' '+document.getElementById('codes').value;
		if (c.indexOf(' '+t+'%')<0){
			document.getElementById('codes').value=document.getElementById('codes').value+' '+t+'%';
			tagmean();
		}
	}
}

function addtag_multiple(id){
	var selObj = document.getElementById(id);
	for (i=0; i<selObj.options.length; i++) {
		if (selObj.options[i].selected) {
			if (id=='vdclist') 
				addtag(document.getElementById('distlist').value+selObj.options[i].value);
			else
				addtag(selObj.options[i].value);
		}
	}

}

function tagdelete(t){
	
	var codes = ' '+document.getElementById('codes').value + ' ';
	codes = codes.replace(' '+t+' ',' ');
	
	document.getElementById('codes').value = codes;
	
	tagmean();
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

<p align="center">&nbsp;</p>
<?php
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);




if (!isset($_GET['tag_id'])) die();

$tid=$_GET['tag_id'];

if (isset($_GET['deletetag'])){
	
	mysql_query("delete from tags where tag_id=$tid");
	echo "<center>Tag Deleted. <a href='aetag.php'>Go Back</a></center>";
	die();
}

$result=mysql_query("select * from tags where tag_id=$tid");

$currtag=mysql_fetch_array($result);


?>

<form method="get" action="newtag.php">
<center>
<input type="hidden" name="tag_id" value="<?php echo $_GET['tag_id']; ?>">
<h2>Add New Tag</h3>
<br>
<b>Category: </b>

<?php

	$result = mysql_query('select distinct tag_category from tags order by tag_category');
	$rows = mysql_fetch_all($result);

	printf('<select name="tag_category" id="tag_category">');
	printf('<option value="%s">%s</option>', '', '-- Tag Category --');

	foreach($rows as $r){
		printf('<option value="%s" %s>%s</option>', $r['tag_category'], ($r['tag_category']==$currtag['tag_category']?'selected':''), $r['tag_category']);

	}
	printf('</select>');
?>	
	
<b>or add new: </b> <input type="text" size="30" name="new_tag_category" id="new_tag_category" onchange="beautify(this);">

<br><br>
<b>Tag Name: </b> <input type="text" size="30" name="tag_name" id="tag_name" value="<?php echo $currtag['tag_name']; ?>" onchange="beautify(this);">

<input type="submit" value="Save Tag">

<p>&nbsp;</p>
<input size="100" type="hidden" name="codes" id="codes" value="<?php echo $currtag['codes']; ?>"
</center>

</form>

<table align="center">
<tr>
<td>
District<br />
<span id='divdistrict'>
<?php
	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);

	printf('<select name="distlist" id="distlist" onchange="districtChange()" size="10" multiple>');
	//printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s" %s>%s</option>', $r['dist_code'], $_GET['distcode']==$r['dist_code']?'selected':'',$r['dist_name']);

	}
	printf('</select>');
?>
</span>
<br>
<input type="button" value="Add" onclick="addtag_multiple('distlist');">
</td>
<td>
VDC<br />
<span id='divvdc'>
<select name="vdclist" id="vdclist" size="10">
</select>

</span>
			  
<br>
<input type="button" value="Add" onclick="addtag_multiple('vdclist');">
			  
</td>
<td>
School <br />
<span id='divschool'>
<select name="schoollist" id="schoollist" size="10">
</select>
</span>

<br>
<input type="button" value="Add" onclick="addtag_multiple('schoollist');">

</td>

</tr>
</table>

<p align='center'>(Ctrl+Click for multi-select)</p>
<div id="tagmeaning">

</div>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>


<script>
tagmean();
</script>
</body>
</html>
