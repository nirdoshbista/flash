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
<title>Flash I - Alternate School</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/alternate_sch.js" type="text/javascript"></script>

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
  <tr>  
    <td width="15%" rowspan="3" class="ewTableHeader">After ECD Enrollment</td>
    <td colspan="3" class="ewTableHeader">Total</td>
    <td colspan="3" class="ewTableHeader">Dalit</td>
    <td colspan="3" class="ewTableHeader">Janjati</td>
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
  <tr> 
    <td><input name="ecd_after_total_f_1" type="text" id="ecd_after_total_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_total_m_1" type="text" id="ecd_after_total_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_total_t_1" type="text" id="ecd_after_total_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_after_dalit_f_1" type="text" id="ecd_after_dalit_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_dalit_m_1" type="text" id="ecd_after_dalit_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_dalit_t_1" type="text" id="ecd_after_dalit_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
    <td><input name="ecd_after_janjati_f_1" type="text" id="ecd_after_janjati_f_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_janjati_m_1" type="text" id="ecd_after_janjati_m_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3"></td>
    <td><input name="ecd_after_janjati_t_1" type="text" id="ecd_after_janjati_t_1" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="3" disabled></td>
  </tr>
</table>
<br />

<?php

	if (!($classes[1]==5 || $classes[1]==6 || $classes[1]==7 || $classes[6]==5 || $classes[6]==6 || $classes[6]==7)):

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td rowspan="2">Class</td>
    <td colspan="3">Total</td>
    <td colspan="3">Dalit</td>
    <td colspan="3">Janjati</td>
    <td colspan="3">Others</td>

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
    <td class="ewTableHeader">F</td>
    <td class="ewTableHeader">M</td>
    <td class="ewTableHeader">T</td>
  </tr>

<?php
for ($i=1;$i<=6;++$i){
?>

  <tr class="ewTableRow"> 
    <td><?php echo $i ?></td>
    <td><input name="alt_sch_t_f[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_t_f[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_t_m[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_t_m[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_t_t[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_t_t[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
    <td><input name="alt_sch_d_f[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_d_f[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_d_m[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_d_m[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_d_t[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_d_t[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
    <td><input name="alt_sch_j_f[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_j_f[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_j_m[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_j_m[<?php echo $i ?>]" size="4" maxlength="3" <?php if ($classes[$i]==0) echo 'disabled'; ?>></td>
    <td><input name="alt_sch_j_t[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_j_t[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
    <td><input name="alt_sch_o_f[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_o_f[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
    <td><input name="alt_sch_o_m[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_o_m[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
    <td><input name="alt_sch_o_t[<?php echo $i ?>]" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="alt_sch_o_t[<?php echo $i ?>]" size="4" maxlength="3" disabled></td>
  </tr>
<?php
}
?>  
     
</table>

<?php

endif; // if class 1 or 6 is private

?>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

<?php

for ($i=1;$i<=6;$i++){
	$result=mysql_query("select * from alternate_sch_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class=$i");
	if (mysql_num_rows($result)==0) continue;
	$r=mysql_fetch_array($result);

	echo "document.forms[0]['alt_sch_d_f[$i]'].value='".$r['tot_enroll_dalit_f']."';\n";
	echo "document.forms[0]['alt_sch_d_m[$i]'].value='".$r['tot_enroll_dalit_m']."';\n";
	echo "document.forms[0]['alt_sch_d_t[$i]'].value='".$r['tot_enroll_dalit_t']."';\n";
	echo "document.forms[0]['alt_sch_j_f[$i]'].value='".$r['tot_enroll_janjati_f']."';\n";
	echo "document.forms[0]['alt_sch_j_m[$i]'].value='".$r['tot_enroll_janjati_m']."';\n";
	echo "document.forms[0]['alt_sch_j_t[$i]'].value='".$r['tot_enroll_janjati_t']."';\n";
	echo "document.forms[0]['alt_sch_o_f[$i]'].value='".$r['tot_enroll_others_f']."';\n";
	echo "document.forms[0]['alt_sch_o_m[$i]'].value='".$r['tot_enroll_others_m']."';\n";
	echo "document.forms[0]['alt_sch_o_t[$i]'].value='".$r['tot_enroll_others_t']."';\n";
	echo "document.forms[0]['alt_sch_t_f[$i]'].value='".$r['tot_enroll_total_f']."';\n";
	echo "document.forms[0]['alt_sch_t_m[$i]'].value='".$r['tot_enroll_total_m']."';\n";
	echo "document.forms[0]['alt_sch_t_t[$i]'].value='".$r['tot_enroll_total_t']."';\n";

}

// after ecd enrollment

$result=mysql_query("select * from afterecd_f1 where sch_num='$sch_num' and sch_year='$currentyear'");
$r=mysql_fetch_array($result);

echo "document.forms[0].ecd_after_total_f_1.value='".$r['total_f']."';\n";
echo "document.forms[0].ecd_after_total_m_1.value='".$r['total_m']."';\n";
echo "document.forms[0].ecd_after_total_t_1.value='".$r['total_t']."';\n";
echo "document.forms[0].ecd_after_dalit_f_1.value='".$r['dalit_f']."';\n";
echo "document.forms[0].ecd_after_dalit_m_1.value='".$r['dalit_m']."';\n";
echo "document.forms[0].ecd_after_dalit_t_1.value='".$r['dalit_t']."';\n";
echo "document.forms[0].ecd_after_janjati_f_1.value='".$r['janjati_f']."';\n";
echo "document.forms[0].ecd_after_janjati_m_1.value='".$r['janjati_m']."';\n";
echo "document.forms[0].ecd_after_janjati_t_1.value='".$r['janjati_t']."';\n";


if (isset($_GET['af']))
{
    foreach(array('3'=>'total','2'=>'janjati','1'=>'dalit') as $key1=>$value1):
        foreach(array('M'=>'m','F'=>'f') as $key2=>$value2):
            $query="select count(*) as count from 
                    id_students_track left join id_students_main on id_students_track.reg_id=id_students_main.reg_id 
                    where id_students_track.sch_num='$sch_num' and id_students_track.sch_year='$currentyear' 
                    and id_students_track.class='1' and id_students_main.ecd='1' and id_students_main.gender='$key2'";
            if($key1!='3')
                $query.= " and id_students_main.caste='$key1'";
            $result = mysql_query($query);
            if (mysql_num_rows($result)>0)
            {   
                $row = mysql_fetch_array($result);
                if($row['count'])
                {
                    echo "document.forms[0]['ecd_after_{$value1}_{$value2}_1'].value='${row['count']}';\n";
                    echo "handleChange(document.getElementById('ecd_after_{$value1}_{$value2}_1'));\n";
                    $row['count']=0;                    
                }        
            }
        endforeach;
   endforeach;
    
}


?>
validate=true;
</script>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
