<?php

function insertselect($filename, $v, $sort = true){

	echo "<select name='$v' id='$v' onkeypress='return generalKeyPress(this, event);'>\n";

	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);

	$lines=explode("\n",$contents);
	
	if ($sort==true) sort($lines);
	
	echo "<option value=''></option>\n";
	foreach($lines as $ln){
		$l=trim($ln);
		if ($l!='') echo "<option value='$l'>$l</option>\n";
	}

	echo "</select>\n";

}


function adddropdown($v,$list){
	
	$tmplst = array();
	
	foreach ($list as $l) $tmplst[]='"'.$l.'"';
	
	$listjoin = join(",",$tmplst);
	
	echo "var ".$v."_pieces = new Array($listjoin);\n";
	echo "new AutoSuggest(document.getElementById('$v'),".$v."_pieces);";
	
}

function selectyn($v, $default='3'){
	$str = "<select id='$v' name='$v'>";
	$str .=($default=='1'?"<option value='1' selected>Y</option>":"<option value=''>Y</option>");
	$str .=($default=='2'?"<option value='2' selected>N</option>":"<option value=''>N</option>");
	$str .=($default=='3'?"<option value='3' selected>N/A</option>":"<option value='N/A'></option>");
	$str .= "</select>";
	return $str;
}


function selectstr($v, $arr, $default){
	$str = "<select id='$v' name='$v'>";
	
	$count=0;
	foreach($arr as $a){
		$str .= "<option value='$count'>$a</option>";
		$count++;
	}
	
	$str .= "</select>";
	$str .= "<script>document.getElementById('$v').value = '$default';</script>";

	return $str;	
}

function mlangarray(){
	$query = "select distinct mother_language_details from mother_language order by mother_language_details";
	$result = mysql_query($query);
	
	$rows = array();
	while ($r = mysql_fetch_array($result)){
		$rows[]="'".$r['mother_language_details']."'";
	}
	return "[".implode(",",$rows)."]";
}

function castearray(){
	$query = "select distinct caste_ethnicity_details from caste_ethnicity order by caste_ethnicity_details";
	$result = mysql_query($query);
	
	$rows = array();
	while ($r = mysql_fetch_array($result)){
		$rows[]="'".$r['caste_ethnicity_details']."'";
	}
	return "[".implode(",",$rows)."]";
}

?>

