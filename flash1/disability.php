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
<title>Flash I - Disability</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/disability.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center"><img src="../images/flash1.png"></div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">

	
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	
	<tr class="ewTableHeader">
		<td rowspan="2">Class</td>
		<td colspan="3">Physical</td>
		<td colspan="3">Mental</td>
		<td colspan="3">Deaf</td>
		<td colspan="3">Blind</td>
		<td colspan="3">Low Vision</td>
		<td colspan="3">Deaf and Blind</td>
		<td colspan="3">Speech Impairment</td>
                <td colspan="3">Multiple Disability</td>
		<td colspan="3">Total</td>
	
	</tr>
	<tr class="ewTableHeader">
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
                <td>F</td>
		<td>M</td>
		<td>T</td>
	</tr>
	
<?php

foreach (array(0=>"ECD",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5") as $class=>$class_label){

	echo "<tr>";
	echo "<td>$class_label</td>";	

	foreach (array(1,2,3,4,5,6,7,8,"t") as $type){
	

		foreach (array("f","m","t") as $sex){
			$id = "disabled_{$type}_{$sex}[{$class}]";
			if ($sex=="t" || $classes[$class]==0 || $type=="t") $disabled="disabled"; else $disabled="";
			echo "<td><input name='$id' type='text' onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id='$id' size='3' maxlength='3' $disabled></td>\n";
		}
		
	}
	echo "</tr>";

}

?>

</table>
	
<br />

	
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	
	<tr class="ewTableHeader">
		<td rowspan="2">Class</td>
		<td colspan="3">Physical</td>
		<td colspan="3">Mental</td>
		<td colspan="3">Deaf</td>
		<td colspan="3">Blind</td>
		<td colspan="3">Low Vision</td>
		<td colspan="3">Deaf and Blind</td>
		<td colspan="3">Speech Impairment</td>
                <td colspan="3">Multiple Disability</td>
		<td colspan="3">Total</td>
	
	</tr>
	<tr class="ewTableHeader">
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
                <td>F</td>
		<td>M</td>
		<td>T</td>
	</tr>
	
<?php

foreach (array(6,7,8,9,10,11,12) as $class){

	echo "<tr>";
	echo "<td>$class</td>";	

	foreach (array(1,2,3,4,5,6,7,8,"t") as $type){
	

		foreach (array("f","m","t") as $sex){
			$id = "disabled_{$type}_{$sex}[{$class}]";
			if ($sex=="t" || $classes[$class]==0 || $type=="t") $disabled="disabled"; else $disabled="";
			echo "<td><input name='$id' type='text' onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id='$id' size='3' maxlength='3' $disabled></td>\n";
		}
		
	}
	echo "</tr>";

}

?>

</table>	


</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d=document.forms[0].elements;
function fillValues(){
<?php
for ($i=0;$i<=12;$i++){
	for ($j=1;$j<=8;$j++){

		if ($i==0) $result=mysql_query("select * from ecd_disabled_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i and disability_type_id=$j");
		if ($i>=1 && $i<=5) $result=mysql_query("select * from pr_disabled_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i and disability_type_id=$j");
		if ($i>=6 && $i<=8) $result=mysql_query("select * from lsec_disabled_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i and disability_type_id=$j");
		if ($i>=9 && $i<=10) $result=mysql_query("select * from sec_disabled_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i and disability_type_id=$j");
		if ($i>=11 && $i<=12) $result=mysql_query("select * from hsec_disabled_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i and disability_type_id=$j");

		if (mysql_num_rows($result)){
			$r=mysql_fetch_array($result);
			
			echo "d['disabled_".$j."_f[$i]'].value='".$r['disabled_f']."';\n";		
			echo "d['disabled_".$j."_m[$i]'].value='".$r['disabled_m']."';\n";		
			echo "d['disabled_".$j."_t[$i]'].value='".$r['disabled_t']."';\n";				
		}
	
		
	}

}
?>
}
fillValues();

<?php


//autofill
if (isset($_GET['af']))
{
    for($class=0;$class<=12;$class++)
    {
        if($classes[$class]==0) continue;
        
        for($disability=1;$disability<9;$disability++)
        {
            foreach(array("m","f") as $sex):
            $query="select count(*) as count from id_students_main 
                left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                and id_students_track.class={$class} and id_students_main.disability={$disability}
                and id_students_main.gender='".strtoupper($sex)."'";
                
            $result = mysql_query($query);
            if (mysql_num_rows($result)>0)
            {   
                 $row = mysql_fetch_array($result);
                 if($row['count'])
                 {
                     echo "document.forms[0]['disabled_{$disability}_{$sex}[{$class}]'].value='${row['count']}';\n";
                     $row['count']=0;
                 }   
                 else
                     echo "document.forms[0]['disabled_{$disability}_{$sex}[{$class}]'].value='';\n";
            }
            endforeach;
        }
    }
}


?>





var d = document.forms[0];
var l = document.forms[0].length

for (i=0;i<l;i++){
	if (d[i].disabled == true) continue;
	handleChange(d[i]);
}

validate=true;

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
