<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Remote Duplicates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

foreach($t as $tablename){
	createIndex($tablename);
}

?>
</body>
</html>
<?php

// removes duplicates from table $t
function createIndex($t){
	
	global $link;
	
	// remove index
	
	echo "Removing Index: $t<br />";
	mysql_query("alter table $t drop primary key");
	while (1){	
		$result = mysql_query("show index from $t");
		if (mysql_num_rows($result)>1){
			$r=mysql_fetch_assoc($result);
			mysql_query("drop index {$r['Key_name']} on $t");
			echo mysql_error();
		}
		else break;
	}
	
	$key = array("sch_num","sch_year","class","dist_code","vdc_code","tid","tag_id","flash",
				"attendance_date","building_no","room_no","teacher_level_id","disability_type_id",
				"scholarship_type_id","faculty_list","ecd_num","ecd_class_type","subject_name",
				"elective_no","janjati_type","language","sopfsp_num","mother_lang","tid","sn","level","type");
	$keys = array();
	foreach ($key as $k){
		// some exceptions
		if ($t=='mast_schoollist' && $k=='dist_code') continue;
		if ($t=='mast_schoollist' && $k=='vdc_code') continue;
		if ($t=='tmis_main' && $k=='sch_num') continue;

		if (columnExists($t,$k)) $keys[]=$k;
		
	}
	
	if ($t=='ecd_facilitator' || $t=='sopfsp_facilitator') $keys[]='name';
	
	for ($i=0;$i<count($keys);$i++) $keys[$i]="`{$keys[$i]}`";
	$cols = implode(",",$keys);
	
	echo "Creating index for $t:<br />";
	
	foreach($keys as $k){
		echo "create index $k on `$t` ($k)<br />";
		mysql_query("create index $k on `$t` ($k)");
		
	}
	echo "create index `pk` on `$t` ($cols)<br />";
	mysql_query("create index `pk` on `$t` ($cols)");
	
	
}

?>
