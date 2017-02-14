<?php

function dbconnect(){
    include 'includes/vars.php';
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

function iudata($table, $data, $key){
	global $link;
	
	$result=mysql_query(sprintf("select * from %s where %s=%s and sch_year='2063'",$table, $key, $data[$key]));
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
		
		mysql_query($query);
		//echo $query;
		echo mysql_error();
		
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
		$query .= ' where sch_year=2063 and ' . $key . '=' . $data[$key];
		
		mysql_query($query);
		echo mysql_error();	
		
	}
	

}

function idata($table, $data){
	global $link;
	
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
	
	mysql_query($query);
	//echo $query;
	echo mysql_error();
	
	
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

function exporttable($filename, $tablename, $whereclause){
	global $link;
	
	$query="select * from $tablename where ".$whereclause;
	
	$result = mysql_query($query,$link);
	
	//echo $query.'<br>';
	
	$fptr=fopen($filename, "a");
	
	$num_rows=mysql_num_rows($result);
	
	if ($num_rows > 0){
		
		$str="\nINSERT INTO $tablename VALUES\n";

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

/*	
	while($row=mysql_fetch_array($result)) {
	
		$str="INSERT INTO $tablename VALUES(";
		for ($i=0;$i<mysql_num_fields($result);$i++){
			if ($row[$i]==null) $str.='null';
			else $str.='"'.mysql_real_escape_string($row[$i]).'"';
			
			$str.=($i==mysql_num_fields($result)-1?");\n":",");
		}
		
		fputs($fptr,$str);
	}
*/
	
	fclose($fptr);
}

function exportsqlheader($filename){
	//include 'includes/vars.php';
	
	global $dbname;
	
	$fptr=fopen($filename, "a");
	
	//$str="create database if not exists `$dbname`;\n";
	$str="use `$dbname`;\n\n";
	
	fputs($fptr,$str);
	
	fclose($fptr);	
	
}

?>