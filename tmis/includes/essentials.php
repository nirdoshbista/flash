<?php

function get_dist_list(){
	if(!($file=fopen("data/districts.csv","read"))){
		//error
		die('error reading file');
	}

	echo "<option value='0'> </option> ";
	while(!feof($file)){
		$line=fgets($file,255);
		$line=chop($line);
		$field=split("\t",$line,2);
		echo "<option value='".ucwords(strtolower($field[1]))."'>".ucwords(strtolower($field[1]))."</option>";
	}
}

function get($type, $nepali=false){
	$filename="data/".$type;
	if(!($file=fopen($filename,"read"))){
		die('error reading file');
	}
	echo "<option value='0'> </option> ";

	$file_content = file_get_contents($filename);
	$lines = explode("\n",$file_content);
	
	$otheroptions = array();
	
	switch($type){
		case "award":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_award","type"));
			break;
		case "board":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_edu","board"));
			break;
		case "caste":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","caste"));
			break;
		case "country":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_edu","country"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_train","country"));
			break;
		case "income":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_inc","src"));
			break;
		case "language":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_pub","lang"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","mother_tongue"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","teaching_lang"));
			break;
		case "leave":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_leave","type"));
			break;
		case "medorg":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_med","org"));
			break;
		case "nationality":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","nationality"));
			break;
		case "org":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_award","org"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_punish","org"));
			break;
		case "stream":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_edu","stream"));
			break;
		case "subject":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_edu","subj"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_pub","sub"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","first_app_sec_subject"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","teachingSub1"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","teachingSub2"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec2","subj_sec"));
			break;
		case "train":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_train","subj"));
			break;
		case "type":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_punish","punish"));
			break;
		case "univ":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_edu","school"));
			break;
		case "vdc":
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","perm_addr_vdc"));
			$otheroptions=array_merge($otheroptions, get_extra_options("tmis_sec1","temp_addr_vdc"));
			break;
	}
	
	$lines = array_merge($lines, $otheroptions);
	
	sort($lines);
	$lines = array_unique($lines);

	foreach($lines as $line){
		if(trim(strlen($line))==0) continue;
		if ($nepali && stripos($line,'nepal')!==FALSE) $selected = " selected "; else $selected='';
		echo "<option value='".$line."' $selected>".$line."</option>";
	}

}

function get_extra_options($table,$column){
	$result = mysql_query("SELECT DISTINCT($column) as c FROM $table");
	if (mysql_error()) echo mysql_error()."SELECT DISTINCT($column) as c FROM $table\n";
	$data = array();
	//if (@mysql_num_rows($result)==0) return array();
	while ($row = mysql_fetch_assoc($result)){
		if ($row['c']=='0') continue;
		$data[] = $row["c"];
	}
	return $data;
	
}


function get_subj(){
if(!($file=fopen("data/subject","read"))){
	//error
	//echo "<script>alert ('file error')</script>";
	die('error reading file');
	}
echo "<option value='0'> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_board(){
if(!($file=fopen("data/board","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_univ(){
if(!($file=fopen("data/univ","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_stream(){
if(!($file=fopen("data/stream","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_country(){
if(!($file=fopen("data/country","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_trainsubj(){
if(!($file=fopen("data/trainsubject","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_award(){
if(!($file=fopen("data/award","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_org(){
if(!($file=fopen("data/org","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_leave(){
if(!($file=fopen("data/leave","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_office(){
if(!($file=fopen("data/office","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}

function get_punish(){
if(!($file=fopen("data/punish","read"))){
	die('error reading file');
	}
echo "<option value=' '> </option> ";

$file_content = file_get_contents($filename);
$lines = explode("\n",$file_content);
sort($lines);
$lines = array_unique($lines);

foreach($lines as $line){
	if(strlen($line)>=1)
	echo "<option value='".$line."'>".$line."</option>";
}
}
?>
