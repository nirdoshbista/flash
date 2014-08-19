<?php

require_once("includes/bootstrap.php");

$r = $_GET['r'];

if ($r=='lastnameautocomplete'){


	$q = strtolower($_GET['q']);
	$lines = array();
	
	// collect data from file
	$lines = explode("\n",@file_get_contents("last_name.txt"));

	// collect data from DB
	$result = mysql_query("SELECT DISTINCT last_name FROM student_main");
	
	while ($row = mysql_fetch_assoc($result)) $lines[] = $row['last_name'];
	for ($i=0;$i<count($lines);$i++) $lines[$i]=trim($lines[$i]);

	sort($lines);
	$lines = array_unique($lines);
	
	foreach ($lines as $l) if ($l!='' && preg_match("/^$q/i",$l)) echo ucwords($l),"\n";	

}

if ($r=='subjects'){
	
	$q = strtolower($_GET['q']);
	$lines = array();
	
	// collect data from file
	$lines = explode("\n",@file_get_contents("subjects.txt"));

	sort($lines);
	$lines = array_unique($lines);
	
	foreach ($lines as $l) if ($l!='' && preg_match("/^$q/i",$l)) echo ucwords($l),"\n";	
}

// checks if regid is duplicate
if ($r=='regid'){
	$q = $_GET['q'];
	
	$result = mysql_query("SELECT reg_id FROM student_main WHERE reg_id='$q' AND sch_year='$currentyear'");
	if (mysql_num_rows($result)>0) echo 1;
	else echo 0;
	
	
}
