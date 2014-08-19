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
<title>Flash I - Electives</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/electives.js" type="text/javascript"></script>
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
	<td rowspan="2">Students</td>
	<td rowspan="2">Class</td>
	<td colspan="3">Elective I</td>
	<td colspan="3">Elective II</td>
  </tr>
  <tr> 
	<td><?php  insertelectives('elective_1_1_title'); ?></td>
	<td><?php  insertelectives('elective_1_2_title'); ?></td>
	<td><?php  insertelectives('elective_1_3_title'); ?></td>

	<td><?php  insertelectives('elective_2_1_title'); ?></td>
	<td><?php  insertelectives('elective_2_2_title'); ?></td>
	<td><?php  insertelectives('elective_2_3_title'); ?></td>
	
  </tr>
  
  <tr> 
  	<td rowspan="2">Girls</td>
  	<td>9</td>
    <td><input name="elective_1_1_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_f_9" size="4" maxlength="3"></td>
    <td><input name="elective_1_2_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_f_9" size="4" maxlength="3"></td>
    <td><input name="elective_1_3_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_f_9" size="4" maxlength="3"></td>
       
    <td><input name="elective_2_1_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_f_9" size="4" maxlength="3"></td>
    <td><input name="elective_2_2_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_f_9" size="4" maxlength="3"></td>
    <td><input name="elective_2_3_f_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_f_9" size="4" maxlength="3"></td>

  </tr> 
  
  <tr> 
  	<td>10</td>
    <td><input name="elective_1_1_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_f_10" size="4" maxlength="3"></td>
    <td><input name="elective_1_2_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_f_10" size="4" maxlength="3"></td>
    <td><input name="elective_1_3_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_f_10" size="4" maxlength="3"></td>
       
    <td><input name="elective_2_1_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_f_10" size="4" maxlength="3"></td>
    <td><input name="elective_2_2_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_f_10" size="4" maxlength="3"></td>
    <td><input name="elective_2_3_f_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_f_10" size="4" maxlength="3"></td>

  </tr> 
  
  <tr> 
  	<td rowspan="2">Boys</td>
  	<td>9</td>
    <td><input name="elective_1_1_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_m_9" size="4" maxlength="3"></td>
    <td><input name="elective_1_2_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_m_9" size="4" maxlength="3"></td>
    <td><input name="elective_1_3_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_m_9" size="4" maxlength="3"></td>
      
    <td><input name="elective_2_1_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_m_9" size="4" maxlength="3"></td>
    <td><input name="elective_2_2_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_m_9" size="4" maxlength="3"></td>
    <td><input name="elective_2_3_m_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_m_9" size="4" maxlength="3"></td>

  </tr> 

  <tr> 
  	<td>10</td>
    <td><input name="elective_1_1_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_m_10" size="4" maxlength="3"></td>
    <td><input name="elective_1_2_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_m_10" size="4" maxlength="3"></td>
    <td><input name="elective_1_3_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_m_10" size="4" maxlength="3"></td>
       
    <td><input name="elective_2_1_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_m_10" size="4" maxlength="3"></td>
    <td><input name="elective_2_2_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_m_10" size="4" maxlength="3"></td>
    <td><input name="elective_2_3_m_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_m_10" size="4" maxlength="3"></td>

  </tr> 

  <tr> 
  	<td rowspan="2">Total</td>
  	<td>9</td>
    <td><input disabled name="elective_1_1_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_t_9" size="4" maxlength="3"></td>
    <td><input disabled name="elective_1_2_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_t_9" size="4" maxlength="3"></td>
    <td><input disabled name="elective_1_3_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_t_9" size="4" maxlength="3"></td>
       
    <td><input disabled name="elective_2_1_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_t_9" size="4" maxlength="3"></td>
    <td><input disabled name="elective_2_2_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_t_9" size="4" maxlength="3"></td>
    <td><input disabled name="elective_2_3_t_9" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_t_9" size="4" maxlength="3"></td>

  </tr> 

  <tr> 
  	<td>10</td>
    <td><input disabled name="elective_1_1_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_1_t_10" size="4" maxlength="3"></td>
    <td><input disabled name="elective_1_2_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_2_t_10" size="4" maxlength="3"></td>
    <td><input disabled name="elective_1_3_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_1_3_t_10" size="4" maxlength="3"></td>
       
    <td><input disabled name="elective_2_1_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_1_t_10" size="4" maxlength="3"></td>
    <td><input disabled name="elective_2_2_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_2_t_10" size="4" maxlength="3"></td>
    <td><input disabled name="elective_2_3_t_10" type="text" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="elective_2_3_t_10" size="4" maxlength="3"></td>

  </tr> 
  
  
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>

<script>


<?php

for ($e=1;$e<=2;$e++){
	
	$result = mysql_query("select * from electives_f1 where sch_num='$sch_num' and sch_year='$currentyear' and elective_no='$e'");
	
	if (mysql_num_rows($result)>0){
		
		while ($row = mysql_fetch_array($result)){
			$e = $row['elective_no'];
			$c = $row['class'];
			$s = $row['subject_no'];
			echo "document.getElementById('elective_${e}_${s}_title').value='${row['subject_name']}';\n";
			echo "document.getElementById('elective_${e}_${s}_t_{$c}').value='${row['total_t']}';\n";
			echo "document.getElementById('elective_${e}_${s}_f_{$c}').value='${row['total_f']}';\n";
			echo "document.getElementById('elective_${e}_${s}_m_{$c}').value='${row['total_m']}';\n";
			
		}
		
	}
}

?>

/*
for (e=1;e<=2;e++){
	for (s=1;s<=5;s++){
		document.getElementById('elective_'+e+'_'+s+'_f').disabled = true;
		document.getElementById('elective_'+e+'_'+s+'_m').disabled = true;
		document.getElementById('elective_'+e+'_'+s+'_t').disabled = true;
		
		disen(document.forms[0]['elective_'+e+'_'+s+'_title']);
	}
	
}
*/


validate = true;

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
