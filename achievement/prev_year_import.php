<?php
require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

$sch_num = $_GET['s'];
$sch_class = $_GET['c'];

if ($_POST['import']){
	
	if (is_array($_POST['stu_nums'])){
		foreach ($_POST['stu_nums'] as $stu_num){
			$result = mysql_query("SELECT * FROM student_main WHERE stu_num='$stu_num'");
			$d = mysql_fetch_assoc($result);
			$d['sch_year'] = $currentyear;
			
			idata('student_main',$d);
			
			$result = mysql_query("SELECT * FROM student_marks WHERE stu_num='$stu_num'");
			$d = mysql_fetch_assoc($result);
			$d['sch_year'] = $currentyear;
			idata('student_marks',$d);			
			
		}
	}
	
	header("Location: entry.php?s=$sch_num&c=$sch_class");
	
	
}

$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num' AND sch_year='$currentyear' AND flash1='1' ORDER BY sch_year DESC LIMIT 0,1",$flashdblink);
$row = mysql_fetch_assoc($result);

$app_title .= " : ".$row['nm_sch'].", ".$row['location']; 

?><?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title><?php echo $app_title; ?></title>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body id='BodyID'>
<div class='header'>
<div style="float: left"><?php echo $app_title; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>
<div id='notify' class='notify-info'><?php if ($message!='') echo $message; ?></div>

<div style="clear: both">&nbsp;</div>

<h2>Import students from previous year</h2>

<form action='<?php echo $_SERVER['PHP_SELF']."?s=$sch_num&c=$sch_class"; ?>' method="POST">

<br />
<select size="30" name="stu_nums[]" multiple>

<?php 

$result = mysql_query("SELECT * FROM student_main WHERE sch_num='$sch_num' AND sch_year<'$currentyear' ORDER BY stu_num");
while ($row = mysql_fetch_assoc($result)){
	echo "<option value='{$row['stu_num']}'>[{$row['stu_num']}] {$row['first_name']} {$row['last_name']}</option>\n";
}

?>

</select>
<br />
<p><em>Press and hold Ctrl to select multiple</em></p>
<input type="submit" name='import' value="Import" /> &nbsp;<a href="entry.php<?php echo "?s=$sch_num&c=$sch_class"; ?>">Back</a>

</form>

</body>
</html>
