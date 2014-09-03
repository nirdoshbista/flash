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

function echo2file($str){
	$fptr=fopen('log.txt','a');

	fputs($fptr,$str."\n");

	fclose($fptr);
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

?>
