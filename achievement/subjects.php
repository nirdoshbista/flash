<?php
require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

$sch_class = $_GET['c'];

if ($sch_class=='') die("Invalid Argument");

// get dist_code
$result = mysql_query("SELECT * FROM mast_district",$flashdblink);
if (@mysql_num_rows($result)==0) die("<p>No Districts in DB.</p>");
$row = mysql_fetch_array($result);
$dist_code = $row['dist_code'];
$dist_name = $row['dist_name'];

if ($_POST['save']){
	$sch_class = $_POST['c'];
	$result = mysql_query("DELETE FROM subjects WHERE class='$sch_class' AND dist_code='$dist_code'");
	for ($i=1;$i<=12;$i++){
		$subject = mysql_escape_string($_POST["s$i"]);
		$th_fm = mysql_escape_string($_POST["s{$i}_th_fm"]);
		$pr_fm = mysql_escape_string($_POST["s{$i}_pr_fm"]);
		$th_pm = mysql_escape_string($_POST["s{$i}_th_pm"]);
		$pr_pm = mysql_escape_string($_POST["s{$i}_pr_pm"]);
		
		if ($subject != ''){
			$result = mysql_query("INSERT INTO subjects (id, sch_year, dist_code, class, subject_sn, subject_name, subject_theory_full_mark, subject_practical_full_mark,  subject_theory_pass_mark, subject_practical_pass_mark) VALUES ('$i', '$currentyear', '$dist_code','$sch_class','$i','$subject','$th_fm','$pr_fm','$th_pm','$pr_pm')");
		}
	}
	header("Location: index.php?c=$sch_class");
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.facebox.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.autocomplete.css" rel="stylesheet" type="text/css">
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

#marks{
	background-color: #CDDDEA;
	float: left;		
	margin: 0 10px 10px 10px;
	padding: 10px;
	-moz-border-radius: 5px;
}

</style>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
<?php
echo "var class='$sch_class';\n";
?>

function beautify_(obj){

	var str=obj.value;

	str=str.replace('&',"and");  // replace non character to space
	str=str.replace(/[^a-zA-Z0-9<>/-]/g," ");  // replace non character to space
	str=str.replace(/^[ ]*/,"");   // trim spaces at beginning
	str=str.replace(/[ ]*$/,"");	// trim spaces at end
	str=str.replace(/[ ]+/g," ");	// trim multiple spaces


	str=str.toLowerCase();
	var parts=str.split(" ");
	
	var s="";
	var tmp="";
	for (i=0;i<parts.length;++i){
		s+= ((parts[i].substring(0,1)).toUpperCase() + parts[i].substring(1) + " ");
	}
	s=s.replace(/[ ]*$/,"");	// trim spaces at end
	s=s.replace('And','and');
	
	obj.value=s;

}

function handleChange(o,e){
	beautify_(o);
}

</script>
</head>

<body id='BodyID'>
<div class='header'>
<div style="float: left"><?php echo $app_title; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>

</div>
<div id='notify' class='notify-info'></div>

<div style="clear: both">&nbsp;</div>

<div id='studentlist'>
<h2>Class <?php echo $sch_class; ?> Subjects. <?php echo $dist_name, " - ", $currentyear;?></h2>
<p style='color: red; padding: 0 20px;'>
Note: DO NOT change subject names after entering marks.
</p>

</div>

<form method="POST" name="entryform" id="entryform" action="<?php echo $_SERVER['PHP_SELF']."?c=$sch_class"; ?>">

<input type='hidden' name='c' value='<?php echo $sch_class; ?>' />

<div id='marks'>
<?php

for ($i=1;$i<=12;$i++){
	echo "<div class='inputbox'><label style='width: 100px;'>".($i==1?'<br />':'')."Subject {$i}<label></div>";
	inserttextbox("s{$i}",($i==1?'Name':''),40,50);
	inserttextbox("s{$i}_th_fm",($i==1?'Theory F.M.':''),10,3,'int');
	inserttextbox("s{$i}_pr_fm",($i==1?'Practical F.M.':''),10,3,'int');
	inserttextbox("s{$i}_th_pm",($i==1?'Theory P.M.':''),10,3,'int');
	inserttextbox("s{$i}_pr_pm",($i==1?'Practical P.M.':''),10,3,'int');
	insertclear();
}


?>
</div>

<div style="float:left; width:700px; margin: 0 10px;">
<p>Use '&lt;optional&gt;' for optional subjects.</p>
<input type="submit" name='save' value="Save" />
</div>

</form>
<script>

<?php

$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' and dist_code='$dist_code' and sch_year='$currentyear'");
while ($r = mysql_fetch_assoc($result)){
	echo "$('#s{$r['subject_sn']}').val('{$r['subject_name']}');\n";
	echo "$('#s{$r['subject_sn']}_th_fm').val('{$r['subject_theory_full_mark']}');\n";
	echo "$('#s{$r['subject_sn']}_pr_fm').val('{$r['subject_practical_full_mark']}');\n";
	echo "$('#s{$r['subject_sn']}_th_pm').val('{$r['subject_theory_pass_mark']}');\n";
	echo "$('#s{$r['subject_sn']}_pr_pm').val('{$r['subject_practical_pass_mark']}');\n";
}

?>

</script>
</body>
</html>
