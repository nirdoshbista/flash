<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Finance</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/finance.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="10" class="ewTable">
	
	<tr class="ewTableHeader">
		
		<td colspan="6">Income</td>
		<td colspan="6">Expenditure</td>
	
	</tr>
	
	<tr class="ewTableHeader">
		
		<td width='20%'>Topic</td>
		<td>Primary</td>
		<td>L.Sec.</td>
		<td>Sec.</td>
		<td>H.Sec.</td>
		<td>Total</td>
	
		<td width='20%'>Topic</td>
		<td>Primary</td>
		<td>L.Sec.</td>
		<td>Sec.</td>
		<td>H.Sec.</td>
		<td>Total</td>
	
	</tr>
	
	
	
<?php

$income = array(
	"teacher_salary_darbandi"=>"Teacher salary working in Darbandi ",
	"rahat_teacher_salary"=>"Rahat Teacher salary  ",
	"pcf_salary"=>"PCF salary ",
	"girls_scholarship"=>"Girls Scholarship",
	"dalit_scholarship"=>"Dalit Scholarship",
	"disadvantaged_scholarship"=>"Disadvantaged Scholarship",
	"text_books_fund"=>"Text books fund ",
	"school_management_fund"=>"School management fund ",
	"stationary_fund"=>"Stationary  fund ",
	"library_and_computer_fund"=>"Library and computer  fund ",
	"sip_preparation_fund"=>"SIP preparation  fund ",
	"financial_social_audit_fund"=>"Financial and Social audit  fund ",
	"incentive_fund"=>"Incentive fund",
	"capacity_development_fund"=>"Capacity development fund",
	"day_meal_implementation_fund"=>"Day meal implementation fund",
	"new_building_construction_fund"=>"New building construction  fund",
	"new_class_room_construction_fund"=>"New class room construction  fund",
	"school_building_rehabilitation_fund"=>"School building rehabilitation  fund",
	"class_room_rehabilitation_fund"=>"Class room rehabilitation fund",
	"external_environment_improvement_fund"=>"External environment improvement fund",
	"government_other_funds"=>"Government other funds",
	"monthly_fees"=>"Monthly Fees ",
	"admission_yearly_fees"=>"Admission/Yearly Fees ",
	"internal_income_service_fees"=>"Internal income/ service Fees/---- ",
	"investment_interest"=>"Investment/interest",
	"external_support"=>"Support from community/other institutions or individual",
	"debit"=>"Debit",
	"total_income"=>"Total income",
	"debit_last_year"=>"Debit up to last year",
	"debit_this_year"=>"Debit up to this year"

);


$expenditure = array(
	"teacher_salary_darbandi"=>"Teacher salary working in Darbandi ",
	"rahat_teacher_salary"=>"Rahat Teacher salary  ",
	"pcf_salary"=>"PCF salary ",
	"girls_scholarship"=>"Girls Scholarship",
	"dalit_scholarship"=>"Dalit Scholarship",
	"disadvantaged_scholarship"=>"Disadvantaged Scholarship",
	"text_books"=>"Text books ",
	"school_management"=>"School management ",
	"stationary"=>"Stationary  ",
	"library_computer"=>"Library and computer  ",
	"sip_preparation"=>"SIP preparation  ",
	"financial_and_social_audit"=>"Financial and Social audit  ",
	"incentive"=>"Incentive ",
	"capacity_development"=>"Capacity development ",
	"day_meal_implementation"=>"Day meal implementation",
	"new_building_construction"=>"New building construction  ",
	"new_class_room_construction"=>"New class room construction",
	"school_building_rehabilitation"=>"School building rehabilitation  ",
	"class_room_rehabilitation"=>"Class room rehabilitation  ",
	"toilet_construction_girls_boys"=>"Common Toilet construction for both Girls and Boys  ",
	"girls_toilet_construction"=>"Girls Toilet construction ",
	"examination_conduction"=>"Examination conduction",
	"extra_curricular_activities"=>"Extra curricular activities",
	"miscellaneous"=>"Miscellaneous",
	"other_activities1"=>"Other activities",
	"other_activities2"=>"Other activities",
	"credit"=>"Credit",
	"total"=>"Total ",
	"credit_last_year"=>"Credit up to last year",
	"credit_this_year"=>"Credit up to This year"
);

$disabled_keys=array('library_and_computer_fund','sip_preparation_fund','financial_social_audit_fund',
                    'incentive_fund','capacity_development_fund','new_building_construction_fund',
                    'new_class_room_construction_fund','school_building_rehabilitation_fund',
                    'class_room_rehabilitation_fund','external_environment_improvement_fund',
                    'internal_income_service_fees','investment_interest','external_support','sip_preparation',
                    'financial_and_social_audit','library_computer','incentive','capacity_development',
                    'new_building_construction','new_class_room_construction','school_building_rehabilitation',
                    'class_room_rehabilitation','toilet_construction_girls_boys',
                    'miscellaneous','other_activities1','other_activities2');

$count = count($income);

$income_key = array_keys($income);
$expenditure_key = array_keys($expenditure);

$income_value = array_values($income);
$expenditure_value = array_values($expenditure);

for ($i=0;$i<$count;$i++){

	echo "<tr>\n";
	
	echo "<td class='ewTableHeader'>".$income_value[$i]."</td>\n";
	
	$disabled = '';
        $disable_total='';
	
	$id = "i_".$income_key[$i];
        
	if ($id == "i_total_income") $disabled = "disabled";
	if(in_array($income_key[$i],$disabled_keys)) $disabled = "disabled";
        else    $disable_total="disabled";
	
	if (($classes[1]>=5 && $classes[1]<=7 && $i<21) OR $classes[1]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[1]\" id=\"{$id}_1\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[6]>=5 && $classes[6]<=7 && $i<21) OR $classes[6]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[2]\" id=\"{$id}_2\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[9]>=5 && $classes[9]<=7 && $i<21) OR $classes[9]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[3]\" id=\"{$id}_3\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[11]>=5 && $classes[11]<=7 && $i<21) OR $classes[11]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[4]\" id=\"{$id}_4\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	echo "<td><input $disable_total name=\"{$id}[5]\" id=\"{$id}_5\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	echo "<td class='ewTableHeader'>".$expenditure_value[$i]."</td>\n";

	$disabled = '';
        $disable_total='';
        
	$id = "e_".$expenditure_key[$i];
	if ($id == "e_total") $disabled = "disabled";
        
        if(in_array($expenditure_key[$i],$disabled_keys)) $disabled = "disabled";
        else    $disable_total="disabled";

	if (($classes[1]>=5 && $classes[1]<=7 && $i<21) OR $classes[1]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[1]\" id=\"{$id}_1\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[6]>=5 && $classes[6]<=7 && $i<21) OR $classes[6]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[2]\" id=\"{$id}_2\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[9]>=5 && $classes[9]<=7 && $i<21) OR $classes[9]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[3]\" id=\"{$id}_3\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	if (($classes[11]>=5 && $classes[11]<=7 && $i<21) OR $classes[11]==0) $disabled = "disabled";
	echo "<td><input $disabled name=\"{$id}[4]\" id=\"{$id}_4\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	
	
	echo "<td><input $disable_total name=\"{$id}[5]\" id=\"{$id}_5\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" size=\"10\" maxlength=\"10\"></td>\n";	

	echo "</tr>\n";

}



?>
	
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d = document.forms[0].elements;
<?php


for ($i=1;$i<=4;$i++){
	$result=mysql_query("select * from finance_income_f1 where sch_num='$sch_num' and sch_year='$currentyear' and level='$i'");
	$r=mysql_fetch_array($result);	
	
	foreach ($income as $k=>$v){
		if ($r[$k]!='') 
                {
                    if(in_array($k,$disabled_keys)) echo "document.forms[0]['i_{$k}_5'].value = '${r[$k]}';\n";
                    else echo "document.forms[0]['i_{$k}_$i'].value = '${r[$k]}';\n";
                }
	}
	
	$result=mysql_query("select * from finance_expenditure_f1 where sch_num='$sch_num' and sch_year='$currentyear' and level='$i'");
	$r=mysql_fetch_array($result);	
	
	foreach ($expenditure as $k=>$v){
		if ($r[$k]!='') 
                {
                    if(in_array($k,$disabled_keys)) echo "document.forms[0]['e_{$k}_5'].value = '${r[$k]}';\n";
                    else echo "document.forms[0]['e_{$k}_$i'].value = '${r[$k]}';\n";
                }
	}	

}

foreach ($income as $k=>$v){
	echo "handleChange(d['i_{$k}_1']);\n";
}
foreach ($expenditure as $k=>$v){
	echo "handleChange(d['e_{$k}_1']);\n";
}



?>

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
