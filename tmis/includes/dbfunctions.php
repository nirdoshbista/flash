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
	if (!mysql_query($query)) echo2file(mysql_error()." : ".$query);
	
	
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
	global $dblink;
	
	$query="select * from $tablename where ".$whereclause;
	//echo $query;
	$result = mysql_query($query,$dblink);
	
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
	global $dblink;
    
    $result = mysql_query("describe $tablename",$dblink);
    $fields = array();
    while ($row = mysql_fetch_assoc($result)){
        $fields[] = "`".$row['Field']."`";
    
    }
    
    $fields_joined = implode(",",$fields);
    
	
	$query="select * from $tablename where ".$whereclause;
	
	echo $query."\n";
	
	$result = mysql_query($query,$dblink);

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
	include 'includes/vars.php';
	
	$fptr=fopen($filename, "a");
	
	$str="create database if not exists `$dbname`;\n";
	$str.="use `$dbname`;\n\n";
	
	fputs($fptr,$str);
	
	fclose($fptr);	
	
}

function schoolclasses($sch_num){
	global $link, $_GET, $_SERVER;
		
	$query="select * from mast_school_type where sch_num=$sch_num";
	$result = mysql_query($query,$link);
	$row=mysql_fetch_array($result);
	
	echo "<script>\n";
	echo "classes[0]=0;\n";
	
	$classes[0]=0;
	
	for ($i=1;$i<=12;$i++){
		echo "classes[$i]=".$row['class'.$i].";";
		$classes[$i]=$row['class'.$i];
	}
	
	echo "ecds[0]=0;";
	echo "ecds[1]=0".$row['ecd_1'].";";
	echo "ecds[2]=0".$row['ecd_2'].";";
	echo "ecds[3]=0".$row['ecd_nursery'].";";
	echo "ecds[4]=0".$row['ecd_lkg'].";";
	echo "ecds[5]=0".$row['ecd_ukg'].";";
	
	if (isset($_GET['schoolcode'])) echo "currentSchoolCode='".$_GET['schoolcode']."';\n";
	echo "currentPage='".basename($_SERVER['PHP_SELF'])."';\n";

	echo "\n</script>\n";
	
	return $classes;

}

function echo2file($str){
	$fptr=fopen('log.txt','a');

	fputs($fptr,$str."\n");

	fclose($fptr);
}

function getfirstclass($sch_num){
	$query = "select * from mast_school_type where sch_num='$s' and sch_year='$previousyear'";
	$result = mysql_query($query);

	$first=1;
	
	if ($rows = mysql_fetch_array($result)){
		for ($i=1;$i<=12;$i++){
			if ($rows["class$i"]>0) {
				$first=$i;
				break;
			}
		}
		
	}
	
	return $first;
}

function getSchoolName($sch_num){
	$query = "select * from mast_schoollist where sch_num='$sch_num'";
	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	
	return $rows['nm_sch'];
}

?>
