<?php

$s = $_GET['s'];
$c = $_GET['c'];

if ($s!='' || $c!=''){
	$dist = substr($s,0,2);
	$vdc = substr($s,2,3);
	
	
	$schoolselect_prefix = "?d=$dist&v=$vdc&c=$c";
}

?>
<a href='http://localhost/flash/index.php<?php if ($_GET['c']!='') echo "?c=".$_GET['c']; ?>'>Flash Menu</a> | 
<a href='schoolselect.php<?php echo $schoolselect_prefix; ?>'>Select School</a> | 
<a href='reportpre.php'>Reports</a> | 
<a href='transfer.php'>Student Transfer</a> | 
<a href='excel_import.php'>Excel Import</a> | 
<a href='settings.php'>Settings</a> | 
<a href='logout.php'>Logoff</a>
