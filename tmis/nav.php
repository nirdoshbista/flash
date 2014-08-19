<?php

$sch_num = $_GET['s'];

if ($sch_num!=''){
	$dist = substr($sch_num,0,2);
	$vdc = substr($sch_num,2,3);
	
	
	$schoolselect_prefix = "?d=$dist&v=$vdc";
}

?>
<a href='../index.php'>Flash Menu</a> | 
<a href='schoolselect.php<?php echo $schoolselect_prefix; ?>'>Select School</a> | 
<a href='../logout.php'>Logoff</a>
