<?php 
require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

// add grace_mark field to all subjects
for ($sub=1;$sub<=12;$sub++){
	mysql_query("ALTER TABLE student_marks ADD COLUMN s{$sub}_grace int AFTER s{$sub}_theory");
}
mysql_query("ALTER TABLE student_marks ADD COLUMN total_grace int AFTER total_theory");

// manage index
mysql_query("alter table student_main drop primary key");
mysql_query("alter table student_marks drop primary key");

foreach (array("student_main", "student_marks") as $t){
	foreach (array("stu_num", "sch_num", "sch_year", "class") as $col){
		mysql_query("create index `$col` on `$t` ($col)");
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Achievement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>

input, select, #b{
	font-size: 115%;
	font-weight: bold;
}

input:disabled{
	color:#999;
}

</style>
<script>

var subj =  new Array();

subj['0']=false;

<?php

// get dist_code
$result = mysql_query("SELECT * FROM mast_district",$flashdblink);
if (@mysql_num_rows($result)==0) die("</script><body><p>No Districts in DB.</p></body></html>");
$row = mysql_fetch_array($result);
$dist_code = $row['dist_code'];

for ($sch_class=1;$sch_class<=12;$sch_class++){
	$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' and dist_code='$dist_code'");
	if (mysql_num_rows($result)==0){
		echo "subj['$sch_class']=false;\n";
	}
	else echo "subj['$sch_class']=true;\n";
}

?>


function validate(){
	
	if (subj[document.getElementById('c').value]==true) 
		document.getElementById('submit').disabled = false; 
	else 
		document.getElementById('submit').disabled = true;
}
</script>

</head>

<body onload='validate();'>
<div class='header'>
<div style="float: left"><?php echo $app_title; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>

<p>&nbsp;</p>
<p align="center">
<img src="images/dle.png">
</p>
<p>&nbsp;</p>
<div style="width: 700px; padding: 20px 20px; background-color: white; border: 10px solid #999; margin: 0 auto;">
		<h2 align='center'>Flash - Achievements</h2>
		<p align='justify' style='padding: 0 30px 10px 30px;'>
			Full credit goes to District Education Office, Bardiya that initiated 
			this activity of developing achievement system as well as linking it 
			with current Flash system.  We are sure, this effort will encourage and 
			guide everyone to build a comprehensive EMIS system that will have 
			inter-linkages amongst various sections of EMIS.  
		</p>
		<p align='justify' style='padding: 0 30px 10px 30px;'>
			This system captures student by student information from each grade.  
			It also allows District Education Offices to evaluate the academic 
			performance of each student in regards to gender, caste/ethnicity, 
			students with disabilities and so on. At the same time, this system 
			enables DEOs to provide basic level education certificate to the 
			students as well.  
		</p>
		<p align='justify' style='padding: 0 30px 10px 30px;'>
			If there are any queries, suggestions and feedbacks feel free to contact 
			DEO Bardiya at deobardiya@gmail.com or 084-420113.
		</p>	

		<form action="schoolselect.php" method="get" onsubmit="if (document.getElementById('c').value=='') {alert('Select class.'); return false;}" >
		<p align='center' id='b'>
		Class 
		<select name='c' id='c' onchange='validate()'>
		<option value='0'>- Select Class -</option>
		<?php
		
			$selectedClass = $_GET['c'];
			if ($selectedClass=='') $selectedClass = $default_class;
			for ($i=1;$i<=12;$i++){
				if ($selectedClass==$i) echo "<option value='$i' selected>Class $i</option>";
				else echo "<option value='$i'>Class $i</option>";
			}
		
		
		?>
		</select>
		<input type="submit" id='submit' value="Go" />
		<input type="button" value="Edit Subjects" onclick="var cls=document.getElementById('c').value; if (cls!='') window.location='subjects.php?c='+cls; else alert('Choose class.');" />
		</p>
		</form>

</div>
<p>&nbsp;</p>
<p align="center" class="ewListAdd">&copy; Copyright 2009. All rights reserved</p>
<p>&nbsp;</p>
</body>
</html>
