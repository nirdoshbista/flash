<?php	
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('includes/flash1fn.php');

$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - H.Sec. Exam Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/hsec_exam.js" type="text/javascript"></script>
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
		<td rowspan="2">Sex</td>
		<td colspan="2">Humanities</td>
		<td colspan="2">Education</td>
		<td colspan="2">Science</td>
		<td colspan="2">Management</td>
		<td colspan="2"><?php  insertfaculties('faculty_5'); ?></td>	
		<td colspan="2"><?php  insertfaculties('faculty_6'); ?></td>	
	</tr>
	<tr class="ewTableHeader">
		<td>Appeared</td>
		<td>Passed</td>
		<td>Appeared</td>
		<td>Passed</td>
		<td>Appeared</td>
		<td>Passed</td>
		<td>Appeared</td>
		<td>Passed</td>
		<td>Appeared</td>
		<td>Passed</td>
		<td>Appeared</td>
		<td>Passed</td>
	</tr>
	
<?php
	
	$po=0;
	foreach (array(11,12) as $class){
		if ($po!=1) { echo "<tr>"; $po=1; }
		echo "<td rowspan='9'>$class</td>";
		foreach (array("tot","dalit","janjati") as $cat){
			if ($po!=1) { echo "<tr>"; $po=1; }
			echo "<td rowspan='3'>".ucwords($cat)."</td>";
			foreach (array("f","m","t") as $sex){
				if ($po!=1) { echo "<tr>"; $po=1; }
				echo "<td>".ucwords($sex)."</td>";
				
				foreach (array(1,2,3,4,5,6) as $sn){
					foreach (array("app","pass") as $status){
						
						$id = "{$cat}_{$status}_{$sex}_{$class}_{$sn}";
						if ($sex=='t' || $classes[$class]==0) $disabled="disabled"; else $disabled="";
						echo "<td><input name='$id' type='text' onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id='$id' size='3' maxlength='3' $disabled></td>";
						$po=0;
					}
				}
				echo "</tr>";
			}
		}
		
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
	
$faculties = array('','Humanities','Education','Science','Management');
$result=mysql_query("select * from hsec_last_exam_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list!='Humanities' and faculty_list!='Education' and faculty_list!='Science' and faculty_list!='Management' and class=11 order by faculty_list");
while ($r=mysql_fetch_array($result)){
	$faculties[]=$r['faculty_list'];
}

	
for ($i=1;$i<count($faculties);$i++){
	$result=mysql_query("select * from hsec_last_exam_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list='".$faculties[$i]."' and class=11");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	if ($i>4) echo "d['faculty_$i'].value='".$r['faculty_list']."';\n";
	
	echo "d['tot_app_f_11_$i'].value='".$r['tot_app_f']."';";
	echo "d['tot_app_m_11_$i'].value='".$r['tot_app_m']."';";
	echo "d['tot_app_t_11_$i'].value='".$r['tot_app_t']."';";
	echo "d['dalit_app_f_11_$i'].value='".$r['dalit_app_f']."';";
	echo "d['dalit_app_m_11_$i'].value='".$r['dalit_app_m']."';";
	echo "d['dalit_app_t_11_$i'].value='".$r['dalit_app_t']."';";
	echo "d['janjati_app_f_11_$i'].value='".$r['janjati_app_f']."';";
	echo "d['janjati_app_m_11_$i'].value='".$r['janjati_app_m']."';";
	echo "d['janjati_app_t_11_$i'].value='".$r['janjati_app_t']."';";
	echo "d['tot_pass_f_11_$i'].value='".$r['tot_pass_f']."';";
	echo "d['tot_pass_m_11_$i'].value='".$r['tot_pass_m']."';";
	echo "d['tot_pass_t_11_$i'].value='".$r['tot_pass_t']."';";
	echo "d['dalit_pass_f_11_$i'].value='".$r['dalit_pass_f']."';";
	echo "d['dalit_pass_m_11_$i'].value='".$r['dalit_pass_m']."';";
	echo "d['dalit_pass_t_11_$i'].value='".$r['dalit_pass_t']."';";
	echo "d['janjati_pass_f_11_$i'].value='".$r['janjati_pass_f']."';";
	echo "d['janjati_pass_m_11_$i'].value='".$r['janjati_pass_m']."';";
	echo "d['janjati_pass_t_11_$i'].value='".$r['janjati_pass_t']."';";

}
	

	// class 12
	
	unset($faculties);
	
$faculties = array('','Humanities','Education','Science','Management');
$result=mysql_query("select * from hsec_last_exam_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list!='Humanities' and faculty_list!='Education' and faculty_list!='Science' and faculty_list!='Management' and class=12 order by faculty_list");
while ($r=mysql_fetch_array($result)){
	$faculties[]=$r['faculty_list'];
}

	
for ($i=1;$i<count($faculties);$i++){
	$result=mysql_query("select * from hsec_last_exam_details_f1 where sch_num='$sch_num' and sch_year='$currentyear' and faculty_list='".$faculties[$i]."' and class=12");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	if ($i>4) echo "d['faculty_$i'].value='".$r['faculty_list']."';\n";
	
	echo "d['tot_app_f_12_$i'].value='".$r['tot_app_f']."';";
	echo "d['tot_app_m_12_$i'].value='".$r['tot_app_m']."';";
	echo "d['tot_app_t_12_$i'].value='".$r['tot_app_t']."';";
	echo "d['dalit_app_f_12_$i'].value='".$r['dalit_app_f']."';";
	echo "d['dalit_app_m_12_$i'].value='".$r['dalit_app_m']."';";
	echo "d['dalit_app_t_12_$i'].value='".$r['dalit_app_t']."';";
	echo "d['janjati_app_f_12_$i'].value='".$r['janjati_app_f']."';";
	echo "d['janjati_app_m_12_$i'].value='".$r['janjati_app_m']."';";
	echo "d['janjati_app_t_12_$i'].value='".$r['janjati_app_t']."';";
	echo "d['tot_pass_f_12_$i'].value='".$r['tot_pass_f']."';";
	echo "d['tot_pass_m_12_$i'].value='".$r['tot_pass_m']."';";
	echo "d['tot_pass_t_12_$i'].value='".$r['tot_pass_t']."';";
	echo "d['dalit_pass_f_12_$i'].value='".$r['dalit_pass_f']."';";
	echo "d['dalit_pass_m_12_$i'].value='".$r['dalit_pass_m']."';";
	echo "d['dalit_pass_t_12_$i'].value='".$r['dalit_pass_t']."';";
	echo "d['janjati_pass_f_12_$i'].value='".$r['janjati_pass_f']."';";
	echo "d['janjati_pass_m_12_$i'].value='".$r['janjati_pass_m']."';";
	echo "d['janjati_pass_t_12_$i'].value='".$r['janjati_pass_t']."';";


}

// autofill
if (isset($_GET['af']))
{
        $lastyear=$currentyear-1;
        foreach(array('tot'=>'0','dalit'=>'1','janjati'=>'2') as $caste=>$caste_key):
            foreach(array('m'=>'M','f'=>'F','t'=>'T') as $sex=>$sex_key):
                foreach(array('1'=>'1','2'=>'3','3'=>'4','4'=>'2') as $stream=>$stream_key):
                    $thisyear_list=array();
                    $count=0;
                    $query="select id_students_main.reg_id as reg_id from id_students_main 
                                    left join id_students_track on id_students_main.reg_id=id_students_track.reg_id
                                    where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                                    and id_students_track.class='12' 
                                    and id_students_track.stream={$stream_key}";
                    if($caste != 'tot')     $query.=" and id_students_main.caste='$caste_key'";
                    if($sex != 't')         $query.=" and id_students_main.gender='$sex_key'";
                   
                
                    $result = mysql_query($query);
                    if (mysql_num_rows($result)>0)
                    {   
                        while($row = mysql_fetch_assoc($result))
                            array_push($thisyear_list,$row);
                        
                         //check that each student was in class 11 the last year
                        if(!empty($thisyear_list))
                        {    
                            foreach($thisyear_list as $key=>$student)
                            {
                                $query="select * from id_students_track 
                                                where id_students_track.reg_id='{$student['reg_id']}' and id_students_track.sch_year='$lastyear' 
                                            and id_students_track.class='11'";
                                $result = mysql_query($query);

                                //if student record is found in last year then he/she is not a new enrollment 
                                if (mysql_num_rows($result)) $count++;

                            }
                        }
                        if($count>0)    echo "d['{$caste}_pass_{$sex}_11_{$stream}'].value='{$count}';";
                        
                    }   
                endforeach;
            endforeach;
        endforeach;
}
	
?>
}
fillValues();

validate=true;
</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
