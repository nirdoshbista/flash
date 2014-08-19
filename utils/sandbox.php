<?php

$age_suffix[1]=array("_l5","_5","_6","_7","_8","_9","_g9","_t");
$age_desc[1]=array("Less than 5","5 years","6 years","7 years","8 years","9 years","More than 9","Total");

$age_suffix[2]=array("_l6","_6","_7","_8","_9","_g9","_t");
$age_desc[2]=array("Less than 6","6 years","7 years","8 years","9 years","More than 9","Total");

$age_suffix[3]=array("_l7","_7","_8","_9","_10","_g10","_t");
$age_desc[3]=array("Less than 7","7 years","8 years","9 years","10 years","More than 10","Total");

$age_suffix[4]=array("_l8","_8","_9","_10","_11","_g11","_t");
$age_desc[4]=array("Less than 8","8 years","9 years","10 years","11 years","More than 11","Total");

$age_suffix[5]=array("_l9","_9","_10","_11","_12","_g12","_t");
$age_desc[5]=array("Less than 9","9 years","10 years","11 years","12 years","More than 12","Total");

$age_suffix[6]=array("_l10","_10","_11","_12","_13","_14","_g14","_t");
$age_desc[6]=array("Less than 10","10 years","11 years","12 years","13 years","14 years","More than 14","Total");

$age_suffix[7]=array("_l11","_11","_12","_13","_14","_g14","_t");
$age_desc[7]=array("Less than 11","11 years","12 years","13 years","14 years","More than 14","Total");

$age_suffix[8]=array("_l12","_12","_13","_14","_15","_g15","_t");
$age_desc[8]=array("Less than 12","12 years","13 years","14 years","15 years","More than 15","Total");

$age_suffix[9]=array("_l13","_13","_14","_15","_16","_g16","_t");
$age_desc[9]=array("Less than 13","13 years","14 years","15 years","16 years","More than 16","Total");

$age_suffix[10]=array("_l14","_14","_15","_16","_17","_g17","_t");
$age_desc[10]=array("Less than 14","14 years","15 years","16 years","17 years","More than 17","Total");

$age_suffix[11]=array("_l15","_15","_15_16","_g16","_t");
$age_desc[11]=array("Less than 15","15 years","15-16 years","More than 16","Total");

$age_suffix[12]=array("_l16","_16","_g16","_t");
$age_desc[12]=array("Less than 16","16 years","More than 16","Total");


$c=1;

foreach ($age_desc[$c] as $a){
	echo "$a [3] | ";
}

echo "\n";
foreach ($age_desc[$c] as $a){
	echo "G|B|T|";
}

echo "\n";
$arr = array();
foreach ($age_suffix[$c] as $a){
	$arr[] = "sum(f{$a})";
	$arr[] = "sum(m{$a})";
	$arr[] = "sum(t{$a})";
}
echo "query1 = \"select ",implode(",",$arr)," from mast_schoollist left join mast_school_type using(sch_num, sch_year) left join pr_total_enroll_age_f1 using(sch_num, sch_year) where mast_schoollist.flash=1 and mast_school_type.flash=1 and pr_total_enroll_age_f1.class=$c\"\n";


/*

for ($c=1;$c<=5;$c++){
	$arr = array();
	foreach($age_suffix[$c] as $a){
		$arr[] = "sum(f{$a})";
		$arr[] = "sum(m{$a})";
		$arr[] = "sum(t{$a})";
	}
	echo "query$c = \"SELECT ",implode(",",$arr), "from mast_schoollist inner join mast_school_type using (sch_num, sch_year) inner join pr_total_enroll_age_f1 using (sch_num, sch_year) where mast_schoollist.flash=1 and pr_total_enroll_age_f1.class=$c\"","\n";
	unset($arr);
	
}

*/

//echo "Class $c [",count($age_suffix[$c]),"] | ";
?>