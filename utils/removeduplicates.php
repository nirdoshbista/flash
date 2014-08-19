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

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

echo "<p><strong>Flash Data</strong></p>";
foreach($t as $tablename){
	removeDuplicates($tablename);
}

// Achievement data
echo "<p><strong>Achievement Data</strong></p>";
$result =mysql_select_db("achievement", $link);

// remove primary key indexing
mysql_query("DROP INDEX `PRIMARY` ON student_main");
mysql_query("DROP INDEX `PRIMARY` ON student_marks");
mysql_query("DROP INDEX `PRIMARY` ON subjects");

// add 
mysql_query("CREATE INDEX stu_num ON student_main(stu_num)");
mysql_query("CREATE INDEX sch_num ON student_main(sch_num)");
mysql_query("CREATE INDEX sch_year ON student_main(sch_year)");
mysql_query("CREATE INDEX class ON student_main(class)");

mysql_query("CREATE INDEX stu_num ON student_marks(stu_num)");
mysql_query("CREATE INDEX sch_year ON student_marks(sch_year)");
mysql_query("CREATE INDEX class ON student_marks(class)");

mysql_query("CREATE INDEX id ON subjects(id)");

removeDuplicates("student_main");
removeDuplicates("student_marks");
removeDuplicates("subjects");


?>
<script>document.getElementById('done').className='divshow';</script>
</body>
</html>
<?php

// removes duplicates from table $t
function removeDuplicates($t){
	
	global $link;
	
	$key = array("sch_num","sch_year","class","dist_code","vdc_code","tid","tag_id","flash",
				"attendance_date","building_no","room_no","disability_type_id",
				"scholarship_type_id","faculty_list","ecd_num","ecd_class_type","subject_name",
				"elective_no","janjati_type","language","sopfsp_num","mother_lang","tid","sn","stu_num",
                                "opensch_level","nf_class","subject_id","level","type");
	$keys = array();
	foreach ($key as $k){
		// some exceptions
		if ($t=='mast_schoollist' && $k=='dist_code') continue;
		if ($t=='mast_schoollist' && $k=='vdc_code') continue;
		if ($t=='tmis_main' && $k=='sch_num') continue;

		if (columnExists($t,$k)) $keys[]=$k;
		
	}
	
	if ($t=='ecd_facilitator_f1' || $t=='sopfsp_facilitator_f1') $keys[]='name';
	if ($t=='pr_scores' || $t=='lsec_scores' || $t=='sec_scores') $keys[]='sex';
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
			
			if ($t=='mast_district' || $t=='mast_vdc') $query = sprintf("SELECT * FROM %s WHERE %s",$t,implode(" AND ",$whereclauses));
			else $query = sprintf("SELECT * FROM %s WHERE %s ORDER BY entry_timestamp DESC",$t,implode(" AND ",$whereclauses));
			
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
