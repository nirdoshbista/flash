<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Remote Duplicates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
  <p><img src="../images/flash.png"></p>
</div>
<div id='done' class='divhide'>
<h3 align="center">Removing duplicates ... Done</h3>
<h3 align="center"><a href='../index.php'>Return to Main Menu</a></h3>
</div>
<?php

require_once('includes/tablelist.php');
require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');

echo "<p><strong>NFEMIS Data</strong></p>";
foreach($t as $tablename){
	removeDuplicates($tablename);
}

?>
<script>document.getElementById('done').className='divshow';</script>
</body>
</html>
<?php

// removes duplicates from table $t
function removeDuplicates($t){
	
	global $link;
	
	$key = array("dist_code","center_id","year","agency_type","working_id","sn","class_number","class_type");
	$keys = array();
	foreach ($key as $k){
		if (columnExists($t,$k)) $keys[]=$k;
	}
        
	$cols = implode(",",$keys);
	$query = sprintf("SELECT %s, count(*) AS count FROM %s GROUP BY %s HAVING COUNT>1",$cols, $t, $cols);
	
	$result =  mysql_query($query);
	$num=@mysql_num_rows($result);
	if ($num>0){
		echo $t.": ".$num." duplicate entries ... ";
		
		while ($row = mysql_fetch_assoc($result)){
			$whereclauses = array();
			foreach($keys as $k){
				$whereclauses[] = "$k='".$row[$k]."'";
			}
			
			$query = sprintf("SELECT * FROM %s WHERE %s ORDER BY entry_timestamp DESC",$t,implode(" AND ",$whereclauses));
			
			$result1 = mysql_query($query);
			
			if ($result1){ 
				$uniquerow = mysql_fetch_array($result1,MYSQL_NUM);
				
				// delete all (duplicate) rows
				mysql_query(sprintf("DELETE FROM %s WHERE %s",$t,implode(" AND ",$whereclauses)));
				
				// now insert unique row
				for ($i=0;$i<count($uniquerow);$i++) $uniquerow[$i]="'".$uniquerow[$i]."'";
				mysql_query(sprintf("INSERT INTO %s VALUES (%s)",$t,implode(",",$uniquerow)));
			}
		}
		
		echo "Fixed<br />";
		
	}

	
	
}

?>
