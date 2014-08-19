<?php

require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

$sch_num = $_GET['s'];
$sch_class = $_GET['c'];
$subject_sn = $_GET['sub'];


// check if any subjects are defined for this class 
$dist_code = substr($sch_num,0,2);
$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' and dist_code='$dist_code'");
if (mysql_num_rows($result)==0){
	header("Location: subjects.php?c=$sch_class");
}

// save if post
if ($_POST['save']){

	$result = mysql_query("SELECT * FROM student_main WHERE class='$sch_class' AND sch_num='$sch_num' ORDER BY reg_id");
	while ($row = mysql_fetch_assoc($result)){

		$stu_num = mysql_escape_string($row['stu_num']);
		$th = mysql_escape_string($_POST["{$stu_num}_th"]);
		$gr = mysql_escape_string($_POST["{$stu_num}_gr"]);
		$pr = mysql_escape_string($_POST["{$stu_num}_pr"]);
		$cm = mysql_escape_string($_POST["{$stu_num}_comment"]);
		$tot = $th*1+$pr*1+$gr*1;
		
		$query = "UPDATE student_marks SET 
					s{$subject_sn}_theory='$th', 
					s{$subject_sn}_grace='$gr', 
					s{$subject_sn}_practical='$pr', 
					s{$subject_sn}_comment='$cm', 
					s{$subject_sn}='$tot'
				  WHERE stu_num='$stu_num' AND class='$sch_class' AND sch_year='$currentyear'";
				  
		mysql_query($query);

	}

}

function insertRemarks($id,$defaultValue){
	$list = file2array("remarks.txt");
	
	echo "<select id='$id' name='$id' onkeypress='return generalKeyPress(this, event);' >\n";
	echo "<option value=''></option>\n";
	foreach ($list as $k=>$v){
		printf("<option value='%s' %s>%s</option>\n",$k,($k==$defaultValue?'selected':''),trim($v));
	}
	echo "</select>\n";
}


// prepare title

$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num' AND sch_year='$currentyear' AND flash1='1' ORDER BY sch_year DESC LIMIT 0,1",$flashdblink);
$row = mysql_fetch_assoc($result);

$app_title .= " : ".$row['nm_sch'].", ".$row['location']; 
$app_title .= " : Entry by subject";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.tablesorter.css" rel="stylesheet" type="text/css">
<title><?php echo $app_title; ?></title>
<style type="text/css">
.entrydiv {
	background-color: #81BF5D;
	padding: 5px;
}

.inputbox {
	float: left;
	padding: 1px 4px 2px 4px;
}

#subjectlist{
	width: 250px;
	height: 90%;
	overflow: auto;
	float: left;
	background-color: #E7EEF4;
	padding: 10px 0;
	
}

#subjectlist h2{
	margin-bottom: 10px;
}

#subjectlist a, #subjectlist a:visited{
	color: #2266AA;
}


#subjects a{
	display:block;
	padding: 3px 15px;
	font-weight: bold;
	color: #2266AA;
	text-decoration: none;
}

#subjects a.active{
	color: white;
	background-color: #72A9D3;
}


#subjects a:hover{
	color: white;
	background-color: #3F81C3;
}


#generalinfo{
	background-color: #CDDDEA;
	float: left;	
	display: block;
	margin: 0 10px 10px 10px;
	padding: 10px;
	-moz-border-radius: 5px;
}

#marks{
	background-color: #CDDDEA;
	float: left;		
	margin: 0 10px 10px 10px;
	padding: 10px;
	-moz-border-radius: 5px;
	width: 600px;
}


#stdlist{
	width: 100%;
}

</style>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/jquery/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/entry_subject.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script>

<?php

if ($subject_sn!=''){

	$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' AND dist_code='$dist_code' AND subject_sn='$subject_sn'");
	$row = mysql_fetch_assoc($result);

	echo "var fm_th={$row['subject_theory_full_mark']};\n";
	echo "var fm_pr={$row['subject_practical_full_mark']};\n";

}

?>

</script>
</head>

<body id='BodyID'>
<div class='header'>
<div style="float: left"><?php echo $app_title; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>

</div>
<div id='notify' class='notify-info'></div>

<div style="clear: both">&nbsp;</div>

<div id='subjectlist'>
<h2>Subjects
	<span style='font-size: 80%; font-weight: normal; padding: 0 10px;'>
		[<a href='<?php echo "entry.php?s=$sch_num&c=$sch_class"; ?>'>Browse by students</a>]
	</span>
</h2>
<div id="subjects">
<?php

$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' AND dist_code='$dist_code' ORDER BY subject_sn");
while ($row = mysql_fetch_assoc($result)){
		echo "<a href='entry_subject.php?s=$sch_num&c=$sch_class&sub={$row['subject_sn']}'".($subject_sn==$row['subject_sn']?" class='active' ":"").">{$row['subject_name']}</a>";
}

?>
</div>

</div>

<?php 
if ($subject_sn!=''):
?>

<form method="POST" name="entryform" id="entryform" onsubmit="return validate();" action="<?php echo "entry_subject.php?s=$sch_num&c=$sch_class&sub=$subject_sn"; ?>">

<input type='hidden' name='s' value='<?php echo $sch_num; ?>' />
<input type='hidden' name='c' value='<?php echo $sch_class; ?>' />
<input type='hidden' name='sub' value='<?php echo $subject_sn; ?>' />

<div id='marks'>

<table id='stdlist' class='tablesorter'>
<thead>
<tr>
<th>Reg.No.</th>
<th>Name</th>
<th>Theory</th>
<th>Practical</th>
<th>Grace</th>
<th>Total</th>
<th>Remarks</th>
</tr>
</thead>
<tbody>
<?php

// find out if practical marks is needed
$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' AND dist_code='$dist_code' AND subject_sn='$subject_sn'");
$row = mysql_fetch_assoc($result);

$subject_theory_full_mark=$row['subject_theory_full_mark'];
$subject_practical_full_mark=$row['subject_practical_full_mark'];
$subject_theory_pass_mark=$row['subject_theory_pass_mark'];
$subject_practical_pass_mark=$row['subject_practical_pass_mark'];

if ($subject_practical_full_mark==0) $practical = ' disabled ';

// grab all students
$result = mysql_query("SELECT * FROM student_main WHERE class='$sch_class' AND sch_num='$sch_num' AND sch_year='$currentyear' ORDER BY reg_id");
if (@mysql_num_rows($result)==0) echo "<tr><td colspan='5'>No Students entered</td></tr>";
while ($row = @mysql_fetch_assoc($result)){

	// get marks
	$res = mysql_query("SELECT * FROM student_marks WHERE stu_num='{$row['stu_num']}' AND class='$sch_class' AND sch_year='$currentyear'");
	$marks = mysql_fetch_assoc($res);
	
	$th = $marks["s{$subject_sn}_theory"];
	$pr = $marks["s{$subject_sn}_practical"];
	$gr = $marks["s{$subject_sn}_grace"];
	$tot = $marks["s{$subject_sn}"];
	
	if ($th==0) $th='';
	if ($pr==0) $pr='';
	if ($tot==0) $tot='';
	
	echo "<tr>";
	echo "<td>{$row['reg_id']}</td>";
	echo "<td>{$row['first_name']} {$row['last_name']}</td>";
	echo "<td><input value='$th' type='text' size='5' maxlength='3' name='{$row['stu_num']}_th' id='{$row['stu_num']}_th' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' ></td>";
	echo "<td><input value='$pr' type='text' size='5' maxlength='3' name='{$row['stu_num']}_pr' id='{$row['stu_num']}_pr' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' $practical ></td>";
	echo "<td><input value='$gr' type='text' size='5' maxlength='3' name='{$row['stu_num']}_gr' id='{$row['stu_num']}_gr' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' ></td>";
	echo "<td><input value='$tot' type='text' size='5' maxlength='3' name='{$row['stu_num']}_tot' id='{$row['stu_num']}_tot' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' disabled></td>";
	echo "<td>";
	insertRemarks($row['stu_num']."_rem",$marks["s{$subject_sn}_comment"]);
	echo "</td>\n";
	echo "</tr>";	
}

?>
</tbody>
</table>

</div>

<div style="float:left; width:500px; margin: 0 10px;">
<input type="hidden" name='save' value="Save" />
<input type="submit" name='submit_save' value="Save" />
<?php if ($_GET['sn']!=''): ?>
<input type="button" value="Reset" onclick="<?php echo "location='entry.php?s=$sch_num&c=$sch_class'"; ?>" />
<input type="button" name='delete' value="Delete" onclick="<?php echo "if (confirm('Are you sure?')) location='entry.php?s=$sch_num&c=$sch_class&req=delete&sn=".$_GET['sn']."'"; ?>" />
<?php endif; ?>

<input type="button" value="Select School" onclick="<?php echo "location='schoolselect.php$schoolselect_prefix';"; ?>" />
</div>

</form>

<?php
endif;

if ($subject_sn==''){
	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><center><h2>Select Subject</h2><center>";
}

?>


</body>
</html>
