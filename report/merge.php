<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Flash Report Browser</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="jquery.treeview.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery/jquery.js"></script>
	<script type="text/javascript" src="jquery.treeview.js"></script>
	<style>
	body{
		background-color: #eaeaea;
		margin:0;
		padding:0;
	}
	
	#container{
		width: 800px;
		margin: 0 auto;
		background-color: #ffffff;
		
		padding: 10px 30px;
	}
	
	#mergediv{
		float: right;
	}
	
	#reportlistdiv{
		float: left;
		
	}
	
	a{color: #333; text-decoration: none;}
	a:hover{color: #666; text-decoration: underline;}
	</style>
</head>

<body>
	
<div id="container">
	<p align="center"><img src="../images/flash.png"></p>
	<h2 align="center">Flash Reports Merge</h2>
	<p>&nbsp;</p>

<div id="mergediv">
<h2>Merge List</h2>
<select size="10" name="reports[]" id="mergelist" style="width:300px;">
</select>
<br />
<form action="options.php" method="GET" onsubmit="return validate();">
<input type="hidden" name="r" id="r" />
<input type="submit" value="Merge" style="font-weight: bold;" />
<input type="button" value="Remove Selected" id="remove" onclick="removeReport();" />
</form>
</div>

<div id="reportlistdiv">
<h2>Report List</h2>

<?php

report_li("reports");

function report_li($p){
	
	if ($p=="reports")
		echo "<ul id='reportlist' class='filetree'>\n";
	else 
		echo "<ul>\n";
	
	$list = scandir($p,0);

	// show folders
	foreach ($list as $dir){
		// skip folders having _ at front
		if (substr($dir,0,1)=="_") continue;
		if ($dir=='.' || $dir=='..') continue;
		
		// show folder
		$path = "$p/$dir";
		if (is_dir($path) && !($dir=='.' || $dir=='..')){
			echo "<li class='closed'><span class='folder'>".ucwords(str_replace("_"," ",$dir))."</span>\n";
			
			report_li($path);
			
			echo "</li>\n";
			
		}
		
	}
	
	
	$list = scandir($p,0);

	// show files
	foreach ($list as $dir){
		// skip folders having _ at front
		if (substr($dir,0,1)=="_") continue;
		if ($dir=='.' || $dir=='..') continue;
		
		// show folder
		$path = "$p/$dir";
	
		// show files
		if (!is_dir($path)){
			// check if the file is valid
			$report = @parse_ini_file($path, true);
			if (isset($report['header']['title1'])){
				$title = $report['header']['title1'];
			}
			else continue;		
			
			echo "<li><span class='file'><a onclick='addReport(\"$path\",\"$title\");'>$title</a></span></li>\n";
		}			
		
	}	
	

	
	
	echo "</ul>\n";
}

?>

</div>


<div style="clear:both"></div>

</div>

</body>

<script>

$('#reportlist').treeview();

function addReport(path, title){
	var elOptNew = document.createElement('option');
	elOptNew.text = title;
	elOptNew.value = path;
	
	var elSel = document.getElementById('mergelist');
	
	// check if the report exists already
	var i;
	for (i = elSel.length - 1; i>=0; i--) {
		if (elSel.options[i].value == path) {
			alert("Already added.");
			return false;
		}
	}	
	

	try {
		elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
	}
	catch(ex) {
		elSel.add(elOptNew); // IE only
	}


}

function removeReport(){
	var elSel = document.getElementById('mergelist');
	var i;
	for (i = elSel.length - 1; i>=0; i--) {
		if (elSel.options[i].selected) {
			elSel.remove(i);
		}
	}
}

function validate(){
	var elSel = document.getElementById('mergelist');
	if (elSel.length == 0){
		alert("No reports in merge list.");
		return false;
	}
	
	var values = $.map($('#mergelist option'), function(e) { return e.value; });

	$('#r').val(values.join(','));
	
	return true;
}

</script>

</html>
