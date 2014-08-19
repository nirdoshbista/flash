<?php
require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

$sch_num = $_GET['s'];
$sch_class = $_GET['c'];
$stu_num = $_GET['sn'];

// check if any subjects are defined for this class 
$dist_code = substr($sch_num,0,2);
$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' and dist_code='$dist_code'");
if (mysql_num_rows($result)==0){
	header("Location: subjects.php?c=$sch_class");
}

if ($_GET['req']=='delete'){
	$sn = $_GET['sn'];
	
	$result = mysql_query("DELETE FROM student_main WHERE stu_num='$sn' and sch_year='$currentyear'");
	$result = mysql_query("DELETE FROM student_marks WHERE stu_num='$sn' and sch_year='$currentyear'");
	
	header("Location: entry.php?s=$sch_num&c=$sch_class");

}


if ($sch_num=='' || $sch_class=='') die("Invalid Argument");

if ($_POST['save']){
	
	//$result = mysql_query("SELECT ");
		
	$d=array();
	
	if ($_POST['sn']!=''){
		$d['stu_num']=mysql_escape_string($_POST['sn']);
		$result = mysql_query("DELETE FROM student_main WHERE stu_num='{$d['stu_num']}'");
		$result = mysql_query("DELETE FROM student_marks WHERE stu_num='{$d['stu_num']}'");
	}
	else $d['stu_num']=newStudentID($sch_num.substr($currentyear,-2));
	
	$d['sch_num']=$sch_num;
	$d['sch_year']=$currentyear;
	$d['class']=$sch_class;
	
	$d['reg_id']=$_POST['reg_id'];
	$d['first_name']=$_POST['first_name'];
	$d['last_name']=$_POST['last_name'];
	$d['sex']=$_POST['sex'];
	$d['dob_en_y']=$_POST['dob_en_y'];
	$d['dob_en_m']=$_POST['dob_en_m'];
	$d['dob_en_d']=$_POST['dob_en_d'];
	$d['dob_np_y']=$_POST['dob_np_y'];
	$d['dob_np_m']=$_POST['dob_np_m'];
	$d['dob_np_d']=$_POST['dob_np_d'];
	$d['father_name']=$_POST['father_name'];
	$d['mother_name']=$_POST['mother_name'];
	$d['caste_ethnicity']=$_POST['caste_ethnicity'];
	$d['disability']=$_POST['disability'];
	$d['dist_school']=$_POST['dist_school'];
	$d['ecd_ppc_status']=$_POST['ecd_ppc_status'];
	$d['income']=$_POST['income'];
	$d['income_hrs']=$_POST['income_hrs'];
	$d['attendance']=$_POST['attendance'];
	$d['withheld']=$_POST['withheld'];
	
	idata('student_main',$d);
	
	$dm = array();
	
	$dm['stu_num']=$d['stu_num'];
	$dm['sch_year']=$currentyear;
	$dm['class']=$sch_class;
	
	for ($i=1;$i<=12;$i++){
		$dm["s{$i}_practical"]=$_POST["s{$i}_practical"];
		$dm["s{$i}_theory"]=$_POST["s{$i}_theory"];
		$dm["s{$i}_grace"]=$_POST["s{$i}_grace"];
		$dm["s{$i}_subject"]=$_POST["s{$i}_subject"];		
		$dm["s{$i}_comment"]=$_POST["s{$i}_comment"];		
		$dm["s{$i}"]=(int)$dm["s{$i}_practical"]+(int)$dm["s{$i}_theory"]+(int)$dm["s{$i}_grace"];
	}
	
	idata('student_marks',$dm);

}

$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num' AND sch_year='$currentyear' AND flash1='1' ORDER BY sch_year DESC LIMIT 0,1",$flashdblink);
$row = mysql_fetch_assoc($result);

$app_title .= " : ".$row['nm_sch'].", ".$row['location']; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.facebox.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.autocomplete.css" rel="stylesheet" type="text/css">
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

#studentlist{
	width: 250px;
	height: 90%;
	overflow: auto;
	float: left;
	background-color: #E7EEF4;
	padding: 10px;
	
}

#studentlist a, #studentlist a:visited{
	color: #2266AA;
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
}

</style>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/jquery/jquery.caret.js"></script>
<script type="text/javascript" src="js/jquery/jquery.facebox.js"></script>
<script type="text/javascript" src="js/jquery/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="js/entry.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
<?php
echo "var sch_num='$sch_num';\n";
echo "var class='$sch_class';\n";
echo "var currentyear='$currentyear';\n";

?>


</script>

<script>

<?php

	echo "var fm_th=new Array();\n";
	echo "var fm_pr=new Array();\n";

	$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' AND dist_code='$dist_code'");
	while ($row = mysql_fetch_assoc($result)){

		echo "fm_th[{$row['subject_sn']}]={$row['subject_theory_full_mark']};\n";
		echo "fm_pr[{$row['subject_sn']}]={$row['subject_practical_full_mark']};\n";
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

<div id='studentlist'>
<h2>Students
	<span style='font-size: 80%; font-weight: normal; padding: 0 10px;'>
		[<a href='<?php echo "entry_subject.php?s=$sch_num&c=$sch_class"; ?>'>Browse by subjects</a>]<br /> 
		<a href='<?php echo "prev_year_import.php?s=$sch_num&c=$sch_class"; ?>'>Import from previous year</a>
	</span>
</h2>
<table id='stdlist' class='tablesorter'>
<thead>
<tr>
<th>Reg.ID</th>
<th>Name</th>
</tr>
</thead>
<tbody>
<?php

$prefix = $sch_num.substr($currentyear,-2);

$result = mysql_query("SELECT * FROM student_main WHERE sch_num='$sch_num' AND sch_year='$currentyear' and class='$sch_class' ORDER BY reg_id, first_name, last_name");
while ($row = mysql_fetch_assoc($result)){
	echo "<tr>";
	echo "<td><a href='entry.php?s=$sch_num&c=$sch_class&sn={$row['stu_num']}'>{$row['reg_id']}</a></td>";
	echo "<td><a href='entry.php?s=$sch_num&c=$sch_class&sn={$row['stu_num']}'>{$row['first_name']} {$row['last_name']}</a></td>";
	echo "</tr>";	
}

?>
</tbody>
</table>
</div>

<form method="POST" name="entryform" id="entryform" onsubmit="return validate();" action="<?php echo "entry.php?s=$sch_num&c=$sch_class"; ?>">

<input type='hidden' name='s' value='<?php echo $sch_num; ?>' />
<input type='hidden' name='c' value='<?php echo $sch_class; ?>' />
<input type='hidden' name='sn' value='<?php echo $stu_num; ?>' />
<input type='hidden' name='org_reg_id' id='org_reg_id' value='' />


<div id='generalinfo'>
<?php
inserttextbox('reg_id','Reg.ID',15,10,'int');
inserttextbox('first_name','First Name',30,30);
inserttextbox('last_name','#Last Name',25,30);
insertcombobox('sex','Sex',array(1=>'M','F'));

insertclear();

inserttextbox('father_name','Father\'s Name',35,50);
inserttextbox('mother_name','Mother\'s Name',35,50);

insertclear();

insertlabel('DoB<br />Nepali');

inserttextbox('dob_np_y','Year',4,4,'int');
inserttextbox('dob_np_m','Month',2,2,'int');
inserttextbox('dob_np_d','Day',2,2,'int');

insertlabel('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DoB<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;English');

inserttextbox('dob_en_y','Year',4,4,'int');
inserttextbox('dob_en_m','Month',2,2,'int');
inserttextbox('dob_en_d','Day',2,2,'int');

insertclear();

insertcombobox('caste_ethnicity','Caste',file2array('caste.txt',1));
insertcombobox('disability','Disability',file2array('disability.txt',1));
inserttextbox('dist_school','Sch. Dist.',4,3,'int');

insertcombobox('ecd_ppc_status','ECD/PPC',array(1=>'Y','N'));


insertcombobox('income','Income',array(1=>'Y','N'));
inserttextbox('income_hrs','Hours/day',4,3,'int');
inserttextbox('attendance','Attendance',4,3,'int');

// insert withheld checkbox
echo "<div class='inputbox'>\n";
echo "<label>Withheld</label>";
echo "<input type='checkbox' name='withheld' id='withheld' value='1' onchange='handleChange(this)' />\n";	
echo "</div>\n";

insertclear();

?>

</div>
<div id='marks'>
<?php

$result = mysql_query("SELECT * FROM subjects WHERE class='$sch_class' and dist_code='$dist_code'");
while ($r = mysql_fetch_assoc($result)){
	$subjects[$r['subject_sn']] = $r;
}

for ($i=1;$i<=12;$i++){
	if ($subjects[$i]=='') continue;
	if ($subjects[$i]=='<optional>'){
		inserttextbox("s{$i}_subject",($i==1?'#<br />':'#'),25,50,'string',"style='width:180px;'");
	}
	else{
		echo "<div class='inputbox'><label style='width: 200px;'>".($i==1?'<br />':'')."{$subjects[$i]['subject_name']}<label></div>";
	}
	inserttextbox("s{$i}_theory",($i==1?'Th.':''),4,3,'int',($subjects[$i]['subject_theory_full_mark']?'':'disabled'));
	inserttextbox("s{$i}_practical",($i==1?'Pr.':''),4,3,'int',($subjects[$i]['subject_practical_full_mark']?'':'disabled'));
	inserttextbox("s{$i}_grace",($i==1?'Grace':''),4,3,'int',($subjects[$i]['subject_theory_full_mark']?'':'disabled'));
	inserttextbox("s{$i}",($i==1?'Tot.':''),4,3,'int','disabled');
	insertcombobox("s{$i}_comment",($i==1?'Remark':''),file2array('remarks.txt'));
	
	insertclear();
}


?>
</div>
<div style="float:left; width:700px; margin: 0 10px;">
<input type="submit" name='submit_save' value="Save" />
<?php if ($_GET['sn']!=''): ?>
<input type="button" value="Reset" onclick="<?php echo "location='entry.php?s=$sch_num&c=$sch_class'"; ?>" />
<input type="button" name='delete' value="Delete" onclick="<?php echo "if (confirm('Are you sure?')) location='entry.php?s=$sch_num&c=$sch_class&req=delete&sn=".$_GET['sn']."'"; ?>" />
<?php endif; ?>
<input type="hidden" name='save' value="Save" />
<input type="button" value="Select School" onclick="<?php echo "location='schoolselect.php$schoolselect_prefix';"; ?>" />
</div>

</form>

<script>

<?php

if ($d['reg_id']!=''){
	$regid = $d['reg_id']+1;
	echo "$('#reg_id').val('$regid');\n";
}

if ($_GET['sn']!=''){
	$stu_num = $_GET['sn'];
	
	$result = mysql_query("SELECT * FROM student_main WHERE stu_num='$stu_num' and sch_year='$currentyear'");
	$d=mysql_fetch_assoc($result);
	
	echo "$('#reg_id').val('{$d['reg_id']}');\n";
	echo "$('#org_reg_id').val('{$d['reg_id']}');\n";
	echo "$('#first_name').val('{$d['first_name']}');\n";
	echo "$('#last_name').val('{$d['last_name']}');\n";
	echo "$('#sex').val('{$d['sex']}');\n";
	echo "$('#dob_en_y').val('{$d['dob_en_y']}');\n";
	echo "$('#dob_en_m').val('{$d['dob_en_m']}');\n";
	echo "$('#dob_en_d').val('{$d['dob_en_d']}');\n";
	echo "$('#dob_np_y').val('{$d['dob_np_y']}');\n";
	echo "$('#dob_np_m').val('{$d['dob_np_m']}');\n";
	echo "$('#dob_np_d').val('{$d['dob_np_d']}');\n";
	echo "$('#father_name').val('{$d['father_name']}');\n";
	echo "$('#mother_name').val('{$d['mother_name']}');\n";
	echo "$('#caste_ethnicity').val('{$d['caste_ethnicity']}');\n";
	echo "$('#disability').val('{$d['disability']}');\n";
	echo "$('#dist_school').val('{$d['dist_school']}');\n";
	echo "$('#ecd_ppc_status').val('{$d['ecd_ppc_status']}');\n";
	echo "$('#income').val('{$d['income']}');\n";
	echo "$('#income_hrs').val('{$d['income_hrs']}');\n";
	echo "$('#attendance').val('{$d['attendance']}');\n";
	
	if ($d['withheld']) echo "$('#withheld').attr('checked',true);\n";
	
	echo "handleChange(document.getElementById('income'));\n";
	
	$result = mysql_query("SELECT * FROM student_marks WHERE stu_num='$stu_num' and sch_year='$currentyear'");
	$d = mysql_fetch_assoc($result);
	
	for ($i=1;$i<=12;$i++){
		if ($d["s$i"]>0 || $d["s{$i}_comment"]!='') {
			if ($d["s$i"]>0) echo "$('#s{$i}').val('".$d["s$i"]."');\n";
			if ($d["s{$i}_theory"]>0) echo "$('#s{$i}_theory').val('".$d["s{$i}_theory"]."');\n";
			if ($d["s{$i}_grace"]>0) echo "$('#s{$i}_grace').val('".$d["s{$i}_grace"]."');\n";
			if ($d["s{$i}_practical"]) echo "$('#s{$i}_practical').val('".$d["s{$i}_practical"]."');\n";
			echo "$('#s{$i}_subject').val('".$d["s{$i}_subject"]."');\n";
			echo "$('#s{$i}_comment').val('".$d["s{$i}_comment"]."');\n";
			
		}
	}
}

for ($i=1;$i<=12;$i++){
	if ($subjects[$i]=='<optional>'){
		?>
		
		$('#s<?php echo $i; ?>_subject').autocomplete("entrybe.php",{		
			extraParams: {r:'subjects',s:sch_num},
			delay: 0,
			mustMatch: true,
			highlight: function(value,term){ return value.replace(new RegExp("(" + term + ")", "i"), "<strong>$1</strong>") },
		});	
		
		<?php
		
		
	}
}
?>

$('#stdlist').tablesorter({widgets: ['zebra'], sortList: [[0,0]]});

</script>
</body>
</html>
