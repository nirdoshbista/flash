<?php

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
$link = dbconnect();

$r = $_GET['r'];
$s = $_GET['s'];

if ($r=='tp' || $r=='tc'){
	
	$o = $_GET['o'];
	
	$sch_year = (int)($currentyear);
	if ($r=='tp') $sch_year--;
	
	$query = "SELECT * FROM tmis_main WHERE sch_num='$s' AND sch_year='$sch_year'";
	if ($r=='tp') $query .= " AND (inactive=0 OR inactive IS NULL) ";
	if ($o=='name') $query .= " ORDER BY t_name"; else $query .= " ORDER BY tid"; 
	
	//echo $query;
	$result = mysql_query($query);
	
	echo "<select id='$r' onchange='itemSelected(this);' size='20' style='width:300px;' multiple>";
	while ($row = mysql_fetch_assoc($result)){
		
		if ($r=='tp'){
			// check if the same tid exists in current year too
			$checkres = mysql_query("SELECT tid FROM tmis_main WHERE tid='{$row['tid']}' AND sch_year='$currentyear'");
			if (mysql_num_rows($checkres)>0) $cn = " class='inactive' "; else $cn='';
		}
		if ($r=='tc'){
			if ($row['inactive']>0) $cn = " class='inactive' "; else $cn='';
		}
		
		if ($o=='name') echo "<option value='{$row['tid']}' $cn>{$row['t_name']} [{$row['tid']}]</option>";
		else echo "<option value='{$row['tid']}' $cn>[{$row['tid']}] {$row['t_name']}</option>";
	}
	echo "</select>";
	
}

if ($r=='mark'){
	$t=$_GET['t'];
	$m=$_GET['m'];
	
	$tids = explode(",",$t);
	
	foreach ($tids as $tid){
		mysql_query("UPDATE tmis_main SET inactive='$m' WHERE tid='$tid' AND sch_year='$currentyear'");
	}
	
}

if ($r=='unmark'){
	$t=$_GET['t'];
	$m=0;
	
	$tids = explode(",",$t);
	foreach ($tids as $tid){
		mysql_query("UPDATE tmis_main SET inactive='$m' WHERE tid='$tid' AND sch_year='$currentyear'");
	}	
}

if ($r=='delete'){
	$t=$_GET['t'];
	$tables = array("tmis_award","tmis_edu","tmis_inc","tmis_leave","tmis_main","tmis_med","tmis_pub","tmis_punish","tmis_sec1","tmis_sec2","tmis_train");
	
	$tids = explode(",",$t);
	foreach ($tids as $tid){
		foreach($tables as $table){
			$result = mysql_query("DELETE FROM $table WHERE tid='$tid' AND sch_year='$currentyear'");
		}		
	}
	
}

if ($r=='copy'){
	$t=$_GET['t'];
	$tids = explode(",",$t);	
	
	$previousyear = (int)($currentyear)-1;
	$tables = array("tmis_award","tmis_edu","tmis_inc","tmis_leave","tmis_main","tmis_med","tmis_pub","tmis_punish","tmis_sec1","tmis_sec2","tmis_train");
	
	foreach ($tids as $tid){
		$res = mysql_query("SELECT tid FROM tmis_main WHERE tid='$tid' AND sch_year='$currentyear'");
		if (mysql_num_rows($res)>0) continue; // tid already present for currentyear
		
		foreach ($tables as $tb){
			$cols = get_column_names($tb);
			mysql_query("INSERT INTO $tb ($cols, sch_year, entry_timestamp) SELECT $cols,$currentyear,NOW() FROM $tb WHERE tid='$tid' AND sch_year='$previousyear'\n");
		}
	}
	
}

function get_column_names($t){
	
	$exclude = array("sch_year","entry_timestamp","current_appoint_type","current_appoint_position","current_appoint_rank","current_appoint_level");
	
	$result = mysql_query("SHOW COLUMNS FROM $t");
	$c = array();
	while ($row =  mysql_fetch_assoc($result)){
		if (in_array($row['Field'],$exclude)) continue;
		$c[] = $row['Field'];
	}
	return implode(",",$c);
}
