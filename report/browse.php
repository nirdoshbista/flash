<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Flash Report Browser</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<style>
		
	body{
		font-size: x-small;
	}

	.reportfolder{
		vertical-align: middle;
		background-image: url(../images/folder.png);
		background-repeat: no-repeat;
		background-position: left center;
		padding: 12px 5px 5px 35px;
	}

	.reportlink{
		vertical-align: middle;
		background-image: url(../images/report.png);
		background-repeat: no-repeat;
		background-position: left center;
		padding: 12px 5px 5px 35px;
	}
	
	a{ color: #000; text-decoration:none;}
	a:hover{ color: #333; text-decoration: underline;}

	</style>
</head>

<body>
	<p align="center"><img src="../images/flash.png"></p>
	<h2 align="center">Flash Reports</h2>
	<p>&nbsp;</p>

	<table border="0" width="50%" align="center"><tr><td>

<?php

// get path 
$p = $_GET['p'];

if (!is_dir($p)) $p = "reports";	// default path

// show navigation icons
$up = dirname($p);
if ($up=='.') $up='';
echo "<div>";
echo "<a href='browse.php?p=$up' title='Up'><img src='../images/go-up.png' border='0'></a>";
echo "<a href='browse.php' title='Home'><img src='../images/go-home.png' border='0'></a>";
echo "</div>";

//
// show breadcrumb
//
echo "<p>";
$path_components = explode("/",$p);
$breadcrumbs = array();
$bc_path = "";
foreach ($path_components as $dir){
	$bc_path .= $dir."/";
	if ($dir=="reports") {
		
		$breadcrumbs[] = "<a href='browse.php'>Home</a>";
	}
	else{
		$breadcrumbs[]  = "<a href='browse.php?p=$bc_path'>".ucwords(str_replace("_"," ",$dir))."</a>";
	}
}

// remove link from last one
$l = count($breadcrumbs)-1;
$breadcrumbs[$l] = strip_tags($breadcrumbs[$l]);
if ($l>=1) echo implode(" &gt; ",$breadcrumbs);
echo "</p>";

//
// get files and dir
//
$list = scandir($p);

// show folders
foreach ($list as $dir){
	// skip folders having _ at front
	if (substr($dir,0,1)=="_") continue;
	
	// show folder
	$path = "$p/$dir";
	if (is_dir($path) && !($dir=='.' || $dir=='..')){
		echo "<div class='reportfolder'><a href='browse.php?p=$path'>".ucwords(str_replace("_"," ",$dir))."</a></div>\n";
	}
}

// show files
foreach ($list as $file){
	// skip files having _ at front
	if (substr($file,0,1)=="_") continue;
	
	$path = "$p/$file";
	
	if (!is_dir($path)){
		// check if the file is valid
		$report = @parse_ini_file($path, true);
		if (isset($report['header']['title1'])){
			$title = $report['header']['title1'];
		}
		else continue;		
		
		echo "<div class='reportlink'><a href='options.php?r=$path'>$title</a></div>\n";
	}
}

?>
	</td></tr></table>	
</body>

</html>
