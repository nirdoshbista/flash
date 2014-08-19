<?php

function insertlanguages($v){

	echo "<select name='$v' id='$v' onkeypress='return generalKeyPress(this, event);'>\n";

	$filename = "languages.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);

	$lines=explode("\n",$contents);
	
	sort($lines);
	$lines = array_unique($lines);
	echo "<option value=''></option>\n";
	foreach($lines as $ln){
		$l=trim($ln);
		if ($l!='') echo "<option value='$l'>$l</option>\n";
	}

	echo "</select>\n";

}

function insertfaculties($v){

	echo "<select name='$v' id='$v' onkeypress='return generalKeyPress(this, event);'>\n";

	$filename = "faculties.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);

	$lines=explode("\n",$contents);
	sort($lines);
	echo "<option value=''></option>\n";
	foreach($lines as $ln){
		$l=trim($ln);
		if ($l!='') echo "<option value='$l'>$l</option>\n";
	}

	echo "</select>\n";

}

function insertelectives($v){

	echo "<select name='$v' id='$v' onkeypress='return generalKeyPress(this, event);'>\n";

	$filename = "slc_electives.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);

	$lines=explode("\n",$contents);
	sort($lines);
	echo "<option value=''></option>\n";
	foreach($lines as $ln){
		$l=trim($ln);
		if ($l!='') echo "<option value='$l'>$l</option>\n";
	}

	echo "</select>\n";

}

function insertjanajatis($v){
	echo "<select name='$v' id='$v' onkeypress='return generalKeyPress(this, event);'>\n";

	$filename = "janajatis.txt";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);

	$lines=explode("\n",$contents);
	sort($lines);
	echo "<option value=''></option>\n";
	foreach($lines as $ln){
		$l=trim($ln);
		if ($l!='') echo "<option value='$l'>$l</option>\n";
	}

	echo "</select>\n";
}

?>
