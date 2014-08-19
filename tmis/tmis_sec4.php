<?php
require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
require_once('includes/essentials.php');
require_once('includes/commonfn.php');
$link = dbconnect();

if (isset($_GET['tid'])){
	$currenttid=$_GET['tid'];
	
	// get sch_num
	$result = mysql_query("SELECT * FROM tmis_main where tid='$currenttid' AND sch_year='$currentyear'");
	$row = mysql_fetch_assoc($result);
	
	$sch_num=$row['sch_num'];	
	$teacher_name=$row['t_name'];	
		
} else die('This page cannot be accessed individually.');

// get school info
$result = mysql_query("SELECT * FROM mast_schoollist where sch_num='$sch_num' AND sch_year='$currentyear'");
$s = mysql_fetch_assoc($result);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>TMIS - Section IV</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="js/jquery/jquery.facebox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/jquery/jquery.facebox.js"></script>
<script type="text/javascript" src="js/jquery/jquery.form.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script src="js/tmiscommon.js" type="text/javascript"></script>
<script src="js/tmisentry.js" type="text/javascript"></script>
<script src="js/tmisfn.js" type="text/javascript"></script>
<script src="js/teacher_training.js" type="text/javascript"></script>
<?php //$classes=schoolclasses($sch_num); ?>

<script>
<?php 
if (isset($_GET['tid'])) echo "currenttid='$currenttid';\n";
echo "currentPage='".basename($_SERVER['PHP_SELF'])."';\n";
echo "currentSchool='$sch_num';\n";
echo "teacherName='$teacher_name';\n";
?>

function incomeTotal(o){
	var n = o.id.substr(o.id.length-1,1);
	var sub_total = ($('#incScale'+n).val() * 1 + $('#incGrade'+n).val() * 1 + $('#incTA'+n).val() * 1 + $('#incRA'+n).val() * 1 + $('#incMA'+n).val() * 1 + $('#incCivil'+n).val() * 1 + $('#incMahangi'+n).val() * 1 + $('#incInsurance'+n).val() * 1 ) * 12;
	var total = sub_total + $('#incDress'+n).val() * 1 + $('#incFestival'+n).val() * 1;
	
	$('#incSubTotal'+n).val(sub_total?sub_total:'');
	$('#incTotal'+n).val(total?total:'');
	
}

</script>



</head>

<body onLoad="navigation();">
<div class='header'>
<div style="float: left">Teacher MIS - <?php echo $s['nm_sch']; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>
<div align="center">
  <p><img src="images/tmis.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select Section</select></span>
</p>
<form action="controller.php" method="post">
<INPUT TYPE='hidden' NAME='t_id' id='t_id' VALUE="<?php echo $currenttid ?>">

<p align="center" class="ewGroupName">Medical Reimbursement Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th valign="middle" rowspan="2">SN</th>
    <th valign="middle" rowspan="2">Level/Rank</th>
    <th valign="middle" colspan="2">Reimbursement/Decision Office and Date</th>
    <th  valign="middle" rowspan="2">District</th>
    <th  valign="middle" rowspan="2">Reimbursement Amount</th>
    <th  valign="middle" rowspan="2">Date</th>
  </tr>
  <tr class="ewTableHeader">
  	<th  valign="middle">Office's Name</th>
  	<th  valign="middle">Decision Date</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<5;$i++){
$count++;
$startcount=11*($count-1)+3;
$endcount=$count*11;
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='medSN".$count."' type='text' id='medSN".$count."' size='1' value='".$count."'></td>
  	
<td align='left'><select name='medLevel".$count."' id='medLevel".$count."' onKeyPress='return generalKeyPress(this, event);' onchange='return row_enable(this.value,".$count.",".$startcount.",".$endcount."); ' onkeyup='return row_enable(this.value,".$count.",".$startcount.",".$endcount."); '>
            <option value='0'>- Level & Rank </option>
            <option value='1'>Pri, 3rd</option>
            <option value='2'>Pri, 2nd</option>
            <option value='3'>Pri, 1st</option>
	    <option value='4'>L-Sec, 3rd</option>
            <option value='5'>L-Sec, 2nd</option>
            <option value='6'>L-Sec, 1st</option>
       	    <option value='7'>Sec, 3rd</option>
            <option value='8'>Sec, 2nd</option>
            <option value='9'>Sec, 1st</option>
            </select></td>";

echo "<td align='left'><select id='medOrg".$count."' name='medOrg".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("medorg");
echo "</select><a href='#' onclick=\"addNew('medOrg".$count."','medorg');\"><img src='images/add.png' border='0'></a> </td>";

  	echo "<td align='left'><input name='medYearDec".$count."' type='text' id='medYearDec".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='medMonthDec".$count."' type='text' id='medMonthDec".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='medDayDec".$count."' type='text' id='medDayDec".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>";  
echo "<td><select name='medDist".$count."' id='medDist".$count."' onKeyPress='return generalKeyPress(this, event);'> ";
get_dist_list();
echo "</select></td>
  	<td align='left'><input name='medAmt".$count."' type='text' id='medAmt".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);'></td>
	<td align='left'><input name='medYear".$count."' type='text' id='medYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='medMonth".$count."' type='text' id='medMonth".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='medDay".$count."' type='text' id='medDay".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>
  </tr>";
  }
  ?>
  
</table>
<!--<div id='medRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td align="right"><input type="button" name="addMoremed" id="addMoremed" value="Add More" onClick="addRowMed()" onSelect="addRowMed()"></td>
  </tr>
</table>-->

<br>
<p align="center" class="ewGroupName">Punishment Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th  valign="middle" rowspan="2">SN</th>
    <th  valign="middle" rowspan="2">Level/Rank</th>
    <th  valign="middle" rowspan="2">Type of Punishment</th>
    <th  valign="middle" colspan="2">Name of the Punishing Office and Person</th>
    <th  valign="middle" rowspan="2">Decision Date</th>
  </tr>
  <tr class="ewTableHeader">
  	<th  valign="middle">Deciding Office</th>
  	<th  valign="middle">Name of the Person</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<5;$i++){
$count++;
$startcount=8*($count-1)+58;
$endcount=($count)*8+55;
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='punishSN".$count."' type='text' id='punishSN".$count."' size='1' value='".$count."'></td>
  	
<td align='left'><select name='punishLevel".$count."' id='punishLevel".$count."' onKeyPress='return generalKeyPress(this, event);' onchange='return row_enable(this.value,".$count.",".$startcount.",".$endcount."); ' onkeyup='return row_enable(this.value,".$count.",".$startcount.",".$endcount."); '>
            <option value='0'>- Level & Rank </option>
            <option value='1'>Pri, 3rd</option>
            <option value='2'>Pri, 2nd</option>
            <option value='3'>Pri, 1st</option>
	    <option value='4'>L-Sec, 3rd</option>
            <option value='5'>L-Sec, 2nd</option>
            <option value='6'>L-Sec, 1st</option>
       	    <option value='7'>Sec, 3rd</option>
            <option value='8'>Sec, 2nd</option>
            <option value='9'>Sec, 1st</option>
            </select></td>";

echo "<td align='left'><select id='punishType".$count."' name='punishType".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("punish");
echo "</select><a href='#' onclick=\"addNew('punishType".$count."','punish');\"><img src='images/add.png' border='0'></a> </td>";
  	
echo "<td align='left'><select id='punishOrg".$count."' name='punishOrg".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("org");
echo "</select><a href='#' onclick=\"addNew('punishOrg".$count."','org');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td align='left'><input name='punishPerson".$count."' type='text' id='punishPerson".$count."' size='20' maxlength='30' onKeyPress='return generalKeyPress(this, event);' onchange='beautify(this);'></td>
  	<td align='left'><input name='punishYear".$count."' type='text' id='punishYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='punishMonth".$count."' type='text' id='punishMonth".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='punishDay".$count."' type='text' id='punishDay".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>
  </tr>";
  }
  ?>
</table>
<!--<div id='punishRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td align="right"><input type="button" name="addMorePunish" id="addMorePunish" value="Add More" onClick="addRowPunish()" onSelect="addRowPunish()"></td>
  </tr>
</table>-->

<br>
<p align="center" class="ewGroupName">Publication Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th  valign="middle">SN</th>
    <th  valign="middle">Name of Publication</th>
    <th  valign="middle">Date of Publication</th>
    <th  valign="middle">Language of Publication</th>
    <th  valign="middle">Subject of Publication</th>
    <th  valign="middle">Remarks</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<5;$i++){
$count++;

if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='pubSN".$count."' type='text' id='pubSN".$count."' size='1' value='".$count."'></td>
  	<td align='left'><input name='pubName".$count."' type='text' id='pubName".$count."' size='50' maxlength='50' onKeyPress='return generalKeyPress(this, event);'  onchange='beautify(this);'></td>
  	<td align='left'><input name='pubYear".$count."' type='text' id='pubYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='pubMonth".$count."' type='text' id='pubMonth".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='pubDay".$count."' type='text' id='pubDay".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>";

echo "<td align='left'><select id='pubLang".$count."' name='pubLang".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("language");
echo "</select><a href='#' onclick=\"addNew('pubLang".$count."','language');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td align='left'><select id='pubSub".$count."' name='pubSub".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("subject");
echo "</select><a href='#' onclick=\"addNew('pubSub".$count."','subject');\"><img src='images/add.png' border='0'></a> </td>";

  	echo "<td align='left'><input name='pubRemarks".$count."' type='text' id='pubRemarks".$count."' size='15' maxlength='20' onKeyPress='return generalKeyPress(this, event);'  onchange='beautify(this);'></td>
  </tr>";
  }
  ?>
  
</table>
<!--<div id='pubRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td align="right"><input type="button" name="addMorePub" id="addMorePub" value="Add More" onClick="addRowPub()" onSelect="addRowPub()"></td>
  </tr>
</table>-->

<br>
<p align="center" class="ewGroupName">Income Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th  valign="middle">SN</th>
    <th  valign="middle">Income Source</th>
    <th  valign="middle">Salary Scale (Rs)</th>
    <th  valign="middle">Total Grade Amount (Rs)</th>
    <th  valign="middle">HT Allowance (Rs)</th>
    <th  valign="middle">Remote Allowance (Rs)</th>
    <th  valign="middle">Providend Fund (Rs)</th>
    <th  valign="middle">Civil Investment Fund (Rs)</th>
    <th  valign="middle">Mahangi Bhatta (Rs)</th>
    <th  valign="middle">Insurance (Rs)</th>
    <th  valign="middle">Total (12 Months in Rs)</th>
    <th  valign="middle">Dress Allowance (Rs)</th>
    <th  valign="middle">Festival Allowance (Rs)</th>
    <th  valign="middle">Grand Total (Rs)</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<5;$i++){
$count++;

if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='incSN".$count."' type='text' id='incSN".$count."' size='1' value='".$count."'></td>";

echo "<td align='left'><select id='incSrc".$count."' name='incSrc".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("income");
echo "</select><a href='#' onclick=\"addNew('incSrc".$count."','income');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td align='left'><input name='incScale".$count."' type='text' id='incScale".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incGrade".$count."' type='text' id='incGrade".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incTA".$count."' type='text' id='incTA".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incRA".$count."' type='text' id='incRA".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incMA".$count."' type='text' id='incMA".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incCivil".$count."' type='text' id='incCivil".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incMahangi".$count."' type='text' id='incMahangi".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incInsurance".$count."' type='text' id='incInsurance".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input disabled name='incSubTotal".$count."' type='text' id='incSubTotal".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incDress".$count."' type='text' id='incDress".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input name='incFestival".$count."' type='text' id='incFestival".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);' onchange='return incomeTotal(this);'></td>
  	<td align='left'><input disabled name='incTotal".$count."' type='text' id='incTotal".$count."' size='6' maxlength='6' onkeypress='return forceNumberInput(this, event);'></td>
  </tr>";
  }
  ?>
  
</table>
<!--<div id='incRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td align="right"><input type="button" name="addMoreInc" id="addMoreInc" value="Add More" onClick="addRowInc()" onSelect="addRowInc()"></td>
  </tr>
</table>-->


</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<br />

</body>

<script>
<?php

$tid = $currenttid;

$result = mysql_query("SELECT * FROM tmis_med WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('medLevel$k').value='{$row['level']}';\n";
	echo "document.getElementById('medOrg$k').value='{$row['org']}';\n";
	echo "document.getElementById('medYearDec$k').value='{$row['year_dec']}';\n";
	echo "document.getElementById('medMonthDec$k').value='{$row['month_dec']}';\n";
	echo "document.getElementById('medDayDec$k').value='{$row['day_dec']}';\n";
	echo "document.getElementById('medDist$k').value='{$row['dist']}';\n";
	echo "document.getElementById('medAmt$k').value='{$row['amt']}';\n";
	echo "document.getElementById('medYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('medMonth$k').value='{$row['month']}';\n";
	echo "document.getElementById('medDay$k').value='{$row['day']}';\n";
}

$result = mysql_query("SELECT * FROM tmis_punish WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('punishLevel$k').value='{$row['level']}';\n";
	echo "document.getElementById('punishType$k').value='{$row['type']}';\n";
	echo "document.getElementById('punishOrg$k').value='{$row['org']}';\n";
	echo "document.getElementById('punishPerson$k').value='{$row['person']}';\n";
	echo "document.getElementById('punishYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('punishMonth$k').value='{$row['month']}';\n";
	echo "document.getElementById('punishDay$k').value='{$row['day']}';\n";
}

$result = mysql_query("SELECT * FROM tmis_pub WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('pubName$k').value='{$row['name']}';\n";
	echo "document.getElementById('pubYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('pubMonth$k').value='{$row['month']}';\n";
	echo "document.getElementById('pubDay$k').value='{$row['day']}';\n";
	echo "document.getElementById('pubLang$k').value='{$row['lang']}';\n";
	echo "document.getElementById('pubSub$k').value='{$row['sub']}';\n";
	echo "document.getElementById('pubRemarks$k').value='{$row['remarks']}';\n";
}

$result = mysql_query("SELECT * FROM tmis_inc WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('incSrc$k').value='{$row['src']}';\n";
	echo "document.getElementById('incScale$k').value='{$row['scale']}';\n";
	echo "document.getElementById('incGrade$k').value='{$row['grade']}';\n";
	echo "document.getElementById('incTA$k').value='{$row['ta']}';\n";
	echo "document.getElementById('incRA$k').value='{$row['ra']}';\n";
	echo "document.getElementById('incMA$k').value='{$row['ma']}';\n";
	echo "document.getElementById('incMahangi$k').value='{$row['mahangi']}';\n";
	echo "document.getElementById('incInsurance$k').value='{$row['insurance']}';\n";
	echo "document.getElementById('incFestival$k').value='{$row['festival']}';\n";
	echo "document.getElementById('incCivil$k').value='{$row['civil_investment']}';\n";
	echo "document.getElementById('incDress$k').value='{$row['dress']}';\n";
	echo "document.getElementById('incTotal$k').value='{$row['total']}';\n";
	
	echo "incomeTotal(document.getElementById('incSrc$k'));\n";
}

//check if head teacher is already set to enable HT allowance 
$result = mysql_query("SELECT distinct(`tmis_sec1`.`tid`) FROM `flash`.`tmis_sec1` join `tmis_main` on (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                       where `tmis_main`.`sch_num`='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and `tmis_sec1`.`head_teacher`='1'"); 

if(mysql_num_rows($result)>0)
{
    $rowData = mysql_fetch_assoc($result);
    if($currenttid!=$rowData['tid'])
    {
        for($i=1;$i<6;$i++)
            echo "document.getElementById('incTA$i').disabled=true;\n";
    }
    else
    {
        for($i=1;$i<6;$i++)
            echo "document.getElementById('incTA$i').disabled=false;\n";
    }
}
?>
</script>

</html>
