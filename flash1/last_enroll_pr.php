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
<title>Flash I - Last Year Enrollment (Primary Level)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/last_enroll_pr.js" type="text/javascript"></script>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td rowspan="2">Class</td>
    <td rowspan="2">Student</td>
    <td colspan="3">Enrollment</td>
    <td colspan="3">Exam Appeared</td>
    <td colspan="3">Passed</td>
  </tr>
  <tr> 
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
  </tr>

<?php

for ($i=1;$i<=6;$i++){
	if ($i==6) $i=0;
?>



  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
	<td rowspan="4"><div align="center"><?php echo $i?$i:"Total"; ?></div></td>
    <td>Dalit</td>
	<td><input name="tot_enroll_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_appeared_exam_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_passed_exam_dalit_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_dalit_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_dalit_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_dalit_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_dalit_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_dalit_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Janjati</td>
	<td><input name="tot_enroll_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_appeared_exam_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_passed_exam_janjati_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_janjati_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_janjati_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_janjati_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_janjati_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_janjati_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Others</td>
	<td><input name="tot_enroll_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_enroll_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_appeared_exam_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_appeared_exam_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_passed_exam_others_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_others_f[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_others_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_others_m[<?php echo $i; ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0  || $i==0) echo 'disabled'; ?>></td>
	<td><input name="tot_passed_exam_others_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_others_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>
  <tr class="<?php if ($i==0)echo 'ewTableFooter'; else echo $i%2?'ewTableRow':'ewTableAltRow'; ?>"> 
    <td>Total</td>
	<td><input name="tot_enroll_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_f[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_enroll_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_m[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_enroll_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_enroll_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_appeared_exam_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_total_f[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_appeared_exam_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_total_m[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_appeared_exam_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_appeared_exam_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
	<td><input name="tot_passed_exam_total_f[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_total_f[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_passed_exam_total_m[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_total_m[<?php echo $i; ?>]" size="4" maxlength="3" disabled></td>
	<td><input name="tot_passed_exam_total_t[<?php echo $i; ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="tot_passed_exam_total_t[<?php echo $i; ?>]" size="4" maxlength="4" disabled></td>
  </tr>  
  
<?php
if ($i==0) break;
}

?>  

  
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

<?php


for ($i=1;$i<=5;$i++){

	$result=mysql_query("select * from last_class1_5_enroll_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
		
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	echo "autoFill = false;\n";
	echo "document.forms[0]['tot_enroll_total_f[$i]'].value='".$r['tot_enroll_total_f']."';\n";
	echo "document.forms[0]['tot_enroll_total_m[$i]'].value='".$r['tot_enroll_total_m']."';\n";
	echo "document.forms[0]['tot_enroll_total_t[$i]'].value='".$r['tot_enroll_total_t']."';\n";
	echo "document.forms[0]['tot_appeared_exam_total_f[$i]'].value='".$r['tot_appeared_exam_total_f']."';\n";
	echo "document.forms[0]['tot_appeared_exam_total_m[$i]'].value='".$r['tot_appeared_exam_total_m']."';\n";
	echo "document.forms[0]['tot_appeared_exam_total_t[$i]'].value='".$r['tot_appeared_exam_total_t']."';\n";
	echo "document.forms[0]['tot_passed_exam_total_f[$i]'].value='".$r['tot_passed_exam_total_f']."';\n";
	echo "document.forms[0]['tot_passed_exam_total_m[$i]'].value='".$r['tot_passed_exam_total_m']."';\n";
	echo "document.forms[0]['tot_passed_exam_total_t[$i]'].value='".$r['tot_passed_exam_total_t']."';\n";
	echo "document.forms[0]['tot_enroll_dalit_f[$i]'].value='".$r['tot_enroll_dalit_f']."';\n";
	echo "document.forms[0]['tot_enroll_dalit_m[$i]'].value='".$r['tot_enroll_dalit_m']."';\n";
	echo "document.forms[0]['tot_enroll_dalit_t[$i]'].value='".$r['tot_enroll_dalit_t']."';\n";
	echo "document.forms[0]['tot_appeared_exam_dalit_f[$i]'].value='".$r['tot_appeared_exam_dalit_f']."';\n";
	echo "document.forms[0]['tot_appeared_exam_dalit_m[$i]'].value='".$r['tot_appeared_exam_dalit_m']."';\n";
	echo "document.forms[0]['tot_appeared_exam_dalit_t[$i]'].value='".$r['tot_appeared_exam_dalit_t']."';\n";
	echo "document.forms[0]['tot_passed_exam_dalit_f[$i]'].value='".$r['tot_passed_exam_dalit_f']."';\n";
	echo "document.forms[0]['tot_passed_exam_dalit_m[$i]'].value='".$r['tot_passed_exam_dalit_m']."';\n";
	echo "document.forms[0]['tot_passed_exam_dalit_t[$i]'].value='".$r['tot_passed_exam_dalit_t']."';\n";
	echo "document.forms[0]['tot_enroll_janjati_f[$i]'].value='".$r['tot_enroll_janjati_f']."';\n";
	echo "document.forms[0]['tot_enroll_janjati_m[$i]'].value='".$r['tot_enroll_janjati_m']."';\n";
	echo "document.forms[0]['tot_enroll_janjati_t[$i]'].value='".$r['tot_enroll_janjati_t']."';\n";
	echo "document.forms[0]['tot_appeared_exam_janjati_f[$i]'].value='".$r['tot_appeared_exam_janjati_f']."';\n";
	echo "document.forms[0]['tot_appeared_exam_janjati_m[$i]'].value='".$r['tot_appeared_exam_janjati_m']."';\n";
	echo "document.forms[0]['tot_appeared_exam_janjati_t[$i]'].value='".$r['tot_appeared_exam_janjati_t']."';\n";
	echo "document.forms[0]['tot_passed_exam_janjati_f[$i]'].value='".$r['tot_passed_exam_janjati_f']."';\n";
	echo "document.forms[0]['tot_passed_exam_janjati_m[$i]'].value='".$r['tot_passed_exam_janjati_m']."';\n";
	echo "document.forms[0]['tot_passed_exam_janjati_t[$i]'].value='".$r['tot_passed_exam_janjati_t']."';\n";
	
	echo "document.forms[0]['tot_enroll_others_f[$i]'].value='".$r['tot_enroll_others_f']."';\n";
	echo "document.forms[0]['tot_enroll_others_m[$i]'].value='".$r['tot_enroll_others_m']."';\n";
	echo "document.forms[0]['tot_enroll_others_t[$i]'].value='".$r['tot_enroll_others_t']."';\n";
	echo "document.forms[0]['tot_appeared_exam_others_f[$i]'].value='".$r['tot_appeared_exam_others_f']."';\n";
	echo "document.forms[0]['tot_appeared_exam_others_m[$i]'].value='".$r['tot_appeared_exam_others_m']."';\n";
	echo "document.forms[0]['tot_appeared_exam_others_t[$i]'].value='".$r['tot_appeared_exam_others_t']."';\n";
	echo "document.forms[0]['tot_passed_exam_others_f[$i]'].value='".$r['tot_passed_exam_others_f']."';\n";
	echo "document.forms[0]['tot_passed_exam_others_m[$i]'].value='".$r['tot_passed_exam_others_m']."';\n";
	echo "document.forms[0]['tot_passed_exam_others_t[$i]'].value='".$r['tot_passed_exam_others_t']."';\n";

}
for ($i=0;$i<27;++$i){
	if ($i%3!=2) echo "handleChange(document.forms[0].elements[$i]);\n";
}

if (isset($_GET['af'])) 
{
    foreach(array('3'=>'others','2'=>'janjati','1'=>'dalit') as $key1=>$value1):
            foreach(array('M'=>'m','F'=>'f') as $key2=>$value2):
                   for($class=1;$class<=5;$class++):
                       if($classes[$class]==0) continue;
                       
                       $query1="select count(*) as count from id_students_main 
                                left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                                where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='".($currentyear-1)."' 
                                and id_students_track.class={$class}
                                and id_students_main.gender='$key2'";
                        if($key1!='3')
                            $query1.= " and id_students_main.caste='$key1'";
                        else    //for others case add up branmin/chhetri=>3 and others=>4
                            $query1.= " and (id_students_main.caste='$key1' or id_students_main.caste=".($key1+1).");";    
                        
                        $result1 = mysql_query($query1);
                        $row1 = mysql_fetch_array($result1);
                        if($row1['count'])
                        {
                            echo "document.forms[0]['tot_enroll_{$value1}_{$value2}[{$class}]'].value='${row1['count']}';\n";
                            echo "handleChange(document.getElementById('tot_enroll_{$value1}_{$value2}[{$class}]'));\n";
                        }
                        
                        //now autofill exam appeared and exam passed
                        $query2="select count(*) as appeared,
                                count(case when (id_students_marks.nepali > '31' and id_students_marks.english > '31' 
                                and id_students_marks.maths > '31' and id_students_marks.social_studies > '31' 
                                and id_students_marks.science > '31' and id_students_marks.population_env > '31') THEN 1 END) as passed
                                from id_students_marks 
                                left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                                where id_students_marks.sch_num='$sch_num' 
                                and id_students_marks.sch_year='".($currentyear-1)."' 
                                and id_students_marks.class={$class}
                                and id_students_main.gender='$key2'";
                        if($key1!='3')
                            $query2.= " and id_students_main.caste='$key1'";
                        else    //for others case add up branmin/chhetri=>3 and others=>4
                            $query2.= " and (id_students_main.caste='$key1' or id_students_main.caste=".($key1+1).");";            
                                
                        $result2 = mysql_query($query2);
                        $row2 = mysql_fetch_array($result2);
                        //display total students appeared in exam and passed count
                        foreach(array("appeared","passed") as $type):
                            if($row2[$type])
                            {
                                echo "document.forms[0]['tot_{$type}_exam_{$value1}_{$value2}[{$class}]'].value='${row2[$type]}';\n";
                                echo "handleChange(document.getElementById('tot_{$type}_exam_{$value1}_{$value2}[{$class}]'));\n";
                            }
                        endforeach;
                    endfor;
            endforeach;
        endforeach;
}
?>
validate = true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
