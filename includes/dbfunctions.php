<?php

function dbconnect(){
    include '../includes/vars.php';
    $link = mysql_connect($dbserver, $dbusername, $dbpassword);
	if (!$link) {
	   die('Could not connect to MySQL server: ' . mysql_error());
	}
    $result =mysql_select_db($dbname, $link);
    //echo "DB connect : ",$result?"Success":"Failure";
    //echo '<br>';

    return $link;
}

function dbclose($link){
	mysql_close($link);
}


function mysql_fetch_all($result) {
    $return=array();
    while($row=mysql_fetch_array($result)) {
      $return[] = $row;
  }
  return $return;
}

function checkblank($data){
	$sum=0;
	
	$ky=array_keys($data);
	$vl = array_values($data);
	
	for ($i=0;$i<count($data);$i++){
	
		if ($ky[$i]=='sch_num' || $ky[$i]=='sch_year' || $ky[$i]=='class') continue;
		
		$sum+=($vl[$i]*1);

	}
	
	//echo2file($data[i].' '.$sum);
	
	if ($sum==0) return true; 
	else return false;
}

function iudata($table, $data, $key){
	global $link;
	
	$data['entry_timestamp'] = date("Y-m-d H:i:s");
	
	if (strstr($_SERVER['PHP_SELF'],'flash2/')!==false) $currentyear = 2065;
	if (strstr($_SERVER['PHP_SELF'],'flash1/')!==false) $currentyear = 2066;
	
	$result=mysql_query(sprintf("select * from %s where %s='%s' and sch_year='$currentyear'",$table, $key, $data[$key]));
	if (mysql_num_rows($result)==0){
		// insert
		$query='insert into '.$table.' (';
		
		$ky=array_keys($data);
		$cols = implode(",",$ky);
		
		$query .= $cols;
		$query .= ') values (';
		
		$vl = array_values($data);
		$values = implode("','", $vl);
		
		$query .= ("'".$values."'");
		$query .= ")";
		
		$query=str_replace("''","null",$query);
		
		mysql_query($query);
		
		//echo $query;
		echo mysql_error();
		echo2file(mysql_error());
		
	}
	else{
		// update
		
		$query = 'update '.$table. ' set ';
		
		$ky=array_keys($data);

		$arr=array();
		foreach($ky as $k){
			$arr[] = ($k."='".$data[$k]."'");
		}
		
		$val = implode(",", $arr);
		
		$query .= $val;
		$query .= " where sch_year='$currentyear' and " . $key . "='" . $data[$key] . "'";
		
		$query=str_replace("''","null",$query);
		
		mysql_query($query);
		
		echo2file($query);
		
		echo mysql_error();	
		echo2file(mysql_error());
		
	}
	

}

function idata($table, $data){
	global $link;
	
	$data['entry_timestamp'] = date("Y-m-d H:i:s");
	
	// insert
	$query='insert into '.$table.' (';
	
	$ky=array_keys($data);
	$cols = implode(",",$ky);
	
	$query .= $cols;
	$query .= ') values (';
	
	$vl = array_values($data);
	$values = implode("','", $vl);
	
	$query .= ("'".$values."'");
	$query .= ")";
	
	$query=str_replace("''","null",$query);
	mysql_query($query);
	if (mysql_error())
	{
		echo mysql_error()."-".$query;
	}
	echo2file(mysql_error());
	echo2file($query);
	
}



// check cookie
function checkcookie(){
	global $pageuser, $pagepass;

	if (isset($_COOKIE['pageuser'])){
    	if ($_COOKIE['pageuser']==$pageuser && $_COOKIE['pagepass']==$pagepass)
        	return true;
       	else
        	return false;
    }
}


function tagcheck($tagid, $tocheck, $d='', $v=''){
	
	$query="select * from tags where tag_id=$tagid";
	
	$result = mysql_query($query);
	if (mysql_num_rows($result)==0) return false;
	
	$rows = mysql_fetch_array($result);
	
	if ($d==''){
		// district wise tag
		if (strstr($rows['codes'], $tocheck)) return true;
		else return false;
	}
	
	if ($d!='' && $v==''){
		// vdc wise tag
		if ($d==$rows['dist_code'] && strstr($rows['codes'], $tocheck)) return true;
		else return false;
	}
		
	if ($d!='' && $v!=''){
		// school wise tag
		if ($d==$rows['dist_code'] && $v==$rows['vdc_code'] && strstr($rows['codes'], $tocheck)) return true;
		else return false;		
	}

	
	
}

/*
function exporttable($filename, $tablename, $whereclause){
	global $link;
	
	$query="select * from $tablename where ".$whereclause;
	
	$result = mysql_query($query,$link);
	
	//echo $query.'<br>';
	
	$fptr=fopen($filename, "a");
	
	fputs($fptr,"\n\n");
	
	while($row=mysql_fetch_array($result)) {
	
		$str="INSERT INTO $tablename VALUES(";
		for ($i=0;$i<mysql_num_fields($result);$i++){
			$str.='"'.addcslashes($row[$i], "\\\"'").'"';
			$str.=($i==mysql_num_fields($result)-1?");\n":",");
		}
		
		fputs($fptr,$str);
	}
	
	fclose($fptr);
}
*/

function exporttable($filename, $tablename, $whereclause){
	global $link;
    
    $result = mysql_query("describe $tablename");
    $fields = array();
    while ($row = mysql_fetch_assoc($result)){
        $fields[] = "`".$row['Field']."`";
    
    }
    
    $fields_joined = implode(",",$fields);
    
	
	$query="select * from $tablename where ".$whereclause;
	
	$result = mysql_query($query,$link);

	//echo $query.'<br>';
	
	$fptr=fopen($filename, "a");
	
	$num_rows=mysql_num_rows($result);
	//echo $num_rows;
	if ($num_rows > 0){
		
		$str="\nINSERT INTO $tablename ($fields_joined) VALUES\n";

		for ($n=0;$n<$num_rows;$n++){
		
			$row=mysql_fetch_array($result);
		
			$str.="(";
			for ($i=0;$i<mysql_num_fields($result);$i++){
				if ($row[$i]==null) $str.='null';
				else $str.='"'.mysql_real_escape_string($row[$i]).'"';
				$str.=($i==mysql_num_fields($result)-1?")":",");
			}
			
			if ($n<$num_rows-1) $str.=",\n"; 
			else $str.=";\n\n";
			
		}
		
		fputs($fptr,$str);
		
	
	}

	fclose($fptr);
}


function exportsqlheader($filename){
	include '../includes/vars.php';
	
	$fptr=fopen($filename, "a");
	
	$str="create database if not exists `$dbname`;\n";
	$str.="use `$dbname`;\n\n";
	
	fputs($fptr,$str);
	
	fclose($fptr);	
	
}

function schoolclasses($sch_num){
	global $link, $_GET, $_SERVER, $currentyear;
	
	// get the latest class data for the school
	$query="select * from mast_school_type where sch_num='$sch_num' and (sch_year='$currentyear' or sch_year='$currentyear'-1) order by sch_year desc limit 0,1";
	$result = mysql_query($query,$link);
	
	$row=mysql_fetch_array($result);
	
	echo "<script>\n";
	
	echo "classes[0]=".($row['ecd']>0?$row['ecd']:'0').";";
	$classes[0]=0+$row['ecd'];
	
	for ($i=1;$i<=12;$i++){
		echo "classes[$i]=".($row['class'.$i]>0?$row['class'.$i]:'0').";";
		$classes[$i]=0+$row['class'.$i];
	}
	

	if (isset($_GET['s'])) echo "currentSchoolCode='".$_GET['s']."';\n";
	echo "currentPage='".basename($_SERVER['PHP_SELF'])."';\n";
	
	// get the latest school data
	$query="select * from mast_schoollist where sch_num=$sch_num and sch_year='$currentyear' order by sch_year desc limit 0,1";
	$result = mysql_query($query,$link);
	$row = mysql_fetch_array($result);
	echo "var schoolName = '".$row['nm_sch']."';\n";
	
	echo "var autoFillRequest = ".(isset($_GET['af'])?'true':'false').";\n";
	
	echo "currentYear = $currentyear;\n";
	
	// output excluded pages list
	$str = file_get_contents("excludedpages.txt");
	
	$excluded_pages = array();
	
	foreach (explode("\n",$str) as $l){
		$excluded_pages[] = "'".trim($l)."'";
	}
	
	echo "var excludedPages = new Array(".@implode(",",$excluded_pages).");\n";

	echo "\n</script>\n";
	
	return $classes;

}

function echo2file($str){
	$fptr=fopen('log.txt','a');

	fputs($fptr,$str."\n");

	fclose($fptr);
}

function columnExists($table, $col){
	$result = mysql_query("DESCRIBE $table;");
	while ($row = @mysql_fetch_array($result)){
		if ($row['Field']==$col) return true;
	}
	return false;
}


// returns which db (flash1(=1), flash2(=2) or tmis(=3))
function whichDB($table){
	
	if (substr($table,-3)=='_f1') return 1;
        if(substr($table,0,11)=='tmis_photos') return 5;
	if (substr($table,0,5)=='tmis_') return 3;
	if (substr($table,0,5)=='mast_') return 0;
	if(substr($table,0,8)=='student_' || substr($table,0,8)=='subjects') return 4;
	return 2;
	
	/*
	
	// flash 2 tables
	$f2 = array("attendance",
				"building_material",
				"building_rooms",
				"class11_12_enroll_app",
				"class1_5_enroll_app",
				"class6_8_enroll_app",
				"class9_10_enroll_app",
				"ecdppc_enroll",
				"ecdppc_info",
				"ecdppc_teacher",
				"inf_sch_pta",
				"inf_sch_smc",
				"lss_scholarship",
				"pr_scholarship",
				"scholarship_info",
				"school_physical",
				"school_program",
				"sections",
				"sopfsp_enroll",
				"sopfsp_enroll_age",
				"sopfsp_info",
				"tags",
				"teachers",
				"photos",
				);
				
	if (array_search($table,$f2)!==FALSE) return 2;
	
	return 0;
	
	*/
}

/** function that deletes a all rows in a table that meet a given condition
 *
 * @param type $tablename
 * @param type $condition 
 */
function deleteRows($tablename,$condition)
{ 
    if (mysql_query("DELETE FROM $tablename WHERE $condition;"))    return TRUE;
    return FALSE;
}

//for upgrading the database structure
function importsql($sqlpath){
	global $dbserver, $dbusername, $dbpassword, $dbname;

	$mysql_path = "..\\..\\..\\mysql\\bin\\mysql.exe";

	$mysql_command =sprintf("$mysql_path -v -h%s -u%s -p%s < %s",
        $dbserver, $dbusername, $dbpassword, $sqlpath);
	
	echo $mysql_command."<br />";
	
        shell_exec($mysql_command);
    
}

?>
