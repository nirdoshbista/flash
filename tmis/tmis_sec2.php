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
<title>TMIS - Section II</title>
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
<script>
<?php 
if (isset($_GET['tid'])) echo "currenttid='$currenttid';\n";
echo "currentPage='".basename($_SERVER['PHP_SELF'])."';\n";
echo "currentSchool='$sch_num';\n";
echo "teacherName='$teacher_name';\n";
?>

</script>

<script>

function subjLevel(value,row){
var temp="subjSec"+row;
	if(value>1)
		document.getElementById(temp).disabled=false;
	else{
		document.getElementById(temp).value='';
		document.getElementById(temp).disabled=true;
	}
}

function appType(type,no){
	var temp="appointTypeOther"+no;
	if(type==5){
		document.getElementById(temp).disabled=false
		
	}
	else{
		document.getElementById(temp).value=0;
		document.getElementById(temp).disabled=true
		
	}
return
}

function row_enable_this(value,row,start,end){
	row_enable(value,row,start,end);
        
        //toggle enable/disable of row just beneath the current row
        row_enable(value,row+1,((15*(row+1))-13),15*(row+1));
        //disable all other rows
        for(var i=(row+2);i<15;i++)
        {
            row_enable(0,i,((15*i)-13),15*i);
        }
	subjLevel(value,row);
	appType(document.getElementById('appointType'+row),row);
}

</script>

</head>

<body onLoad="navigation(); ">
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



<p align="center" class="ewGroupName">Teaching Details</p>
<table width="1325px" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th valign="middle">SN</th>
    <th valign="middle">Level</th>
    <th valign="middle">Rank</th>
    <th valign="middle">Position</th>
    <th valign="middle" >Date of Decision</th>
    <th valign="middle" >Appointment Date</th>
    <th valign="middle">District</th>
    <th valign="middle">School Name and Address</th>
    <th width="7%" valign="middle">Subject ( if Lower-Sec or Sec )</th>
    <!--<th valign="middle" >Choose appointment type</th>-->
  </tr>
  
<?php
$count=0;
for($i=0;$i<14;$i++){
$count++;
$startcount=15*($count-1)+3;
$endcount=$count*15;
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"<td><input disabled name='SN".$count."' type='text' id='SN".$count."' size='1' value='".$count."'></td>
  	<td><select name='appointLevel".$count."' id='appointLevel".$count."' onKeyPress='return generalKeyPress(this, event);' onchange='return row_enable_this(this.value,".$count.",".$startcount.",".$endcount."); ' onkeyup='return row_enable_this(this.value,".$count.",".$startcount.",".$endcount."); '>";
echo "<option value='0'> </option>
            <option value='1'>ECD</option>
            <option value='2'>Pri</option>
            <option value='3'>LSec</option>
            <option value='4'>Sec</option>
            <option value='5'>HSec</option>
            </select></td>
  	<td><select name='appointRank".$count."' id='appointRank".$count."' onKeyPress='return generalKeyPress(this, event);'>
            <option value='0'> </option>
            <option value='1'>1st</option>
            <option value='2'>2nd</option>
            <option value='3'>3rd</option>
            </select></td>
  	<td><select name='appointPosition".$count."' id='appointPosition".$count."' onKeyPress='return generalKeyPress(this, event);'>
            <option value='0'> </option>
            <option value='1'> ECD Facilitator </option>
            <option value='2'> Permanent </option>
            <option value='3'> Temporary </option>
            <option value='4'> Rahat </option>
            <option value='5'> PCF </option>
            <option value='6'> Private Sources </option>
            <option value='7'> Permanent Leon </option>
            <option value='8'> Temporary Leon </option>";

echo ("</select></td>   	<td><input name='decYear".$count."' type='text' id='decYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);'  onKeyPress='return forceNumberInput(this, event);'>-<input name='decMonth".$count."' type='text' id='decMonth".$count."' size='2' maxlength='2' onKeyPress='return forceNumberInput(this, event);'>-<input name='decDay".$count."' type='text' id='decDay".$count."' size='2' maxlength='2' onKeyPress='return forceNumberInput(this, event);'></td>
  	<td ><input name='appYear".$count."' type='text' id='appYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);'  onKeyPress='return forceNumberInput(this, event);'>-<input name='appMonth".$count."' type='text' id='appMonth".$count."' size='2' maxlength='2' onKeyPress='return forceNumberInput(this, event);'>-<input name='appDay".$count."' type='text' id='appDay".$count."' size='2' maxlength='2' onKeyPress='return forceNumberInput(this, event);'></td>
  	<!--<td><input name='appDistrict".$count."' type='text' id='appDistrict".$count."' size='20' maxlength='15' onChange='beautify(this);'></td>-->
	<td><select name='appDistrict".$count."' id='appDistrict".$count."' onKeyPress='return generalKeyPress(this, event);'>");
get_dist_list();
echo ("</select></td>
  	<td><input name='appSchool".$count."' type='text' id='appSchool".$count."' size='18' maxlength='50' onKeyPress='return generalKeyPress(this, event);' onChange='beautify(this);'></td>");
  	
//<td><input name='subjSec".$count."' type='text' id='subjSec".$count."' size='10' maxlength='15' onKeyPress='return generalKeyPress(this, event);'onchange='beautify(this);'></td>

echo "<td><select id='subjSec".$count."' name='subjSec".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("subject");
echo "</select><a href='#' onclick=\"addNew('subjSec".$count."','subject');\"><img src='images/add.png' border='0'></a> </td>";


 echo (" 	<td style='display:none;'><select name='appointType".$count."' id='appointType".$count."' onKeyPress='return generalKeyPress(this, event);' onchange='return appType(this.value,".$count.");' onkeyup='return appType(this.value,".$count.");'>
            <option value='0'> </option>
            <option value='1'>Accepted</option>
            <option value='2'>Temporary on pure vacant post</option>
            <option value='3'>Permanent on upper, lower leon</option>
            <option value='4'>Leon temporary on a permanent person</option>
            <option value='5'>Private/Other</option>
            <option value='6'>Rahat</option>
            </select>
  	&nbsp;
  		<select name='appointTypeOther".$count."' id='appointTypeOther".$count."' onKeyPress='return generalKeyPress(this, event);' >
            <option value='0'> </option>
            <option value='1'>A</option>
            <option value='2'>B</option>
            <option value='3'>C</option>
            </select></td>
  </tr> \n\n");
}

?>
  
 
 
</table>
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<br />

</body>

<script>

<?php

$tid = $currenttid;

$result = mysql_query("SELECT * FROM tmis_sec2 WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");

// if there's no previously entered data, retrieve data for first row from page 1
if (mysql_num_rows($result)==0){
	$res_sec1 = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$currentyear'");
	$row_sec1 = mysql_fetch_assoc($res_sec1);
	
	$k=1;
	echo "document.getElementById('appointLevel$k').value='{$row_sec1['first_app_level']}';\n";
	echo "document.getElementById('appointRank$k').value='{$row_sec1['first_app_rank']}';\n";
        echo "document.getElementById('appointPosition$k').value='{$row_sec1['first_app_type']}';\n";
	echo "document.getElementById('appYear$k').value='{$row_sec1['first_app_year']}';\n";
	echo "document.getElementById('appMonth$k').value='{$row_sec1['first_app_month']}';\n";
	echo "document.getElementById('appDay$k').value='{$row_sec1['first_app_day']}';\n";
	echo "document.getElementById('subjSec$k').value='{$row_sec1['first_app_sec_subject']}';\n";
}
else
{
    $k=0;
    while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('appointLevel$k').value='{$row['appoint_level']}';\n";
	echo "document.getElementById('appointRank$k').value='{$row['appoint_rank']}';\n";
	echo "document.getElementById('appointPosition$k').value='{$row['appoint_position']}';\n";
	echo "document.getElementById('decYear$k').value='{$row['dec_year']}';\n";
	echo "document.getElementById('decMonth$k').value='{$row['dec_month']}';\n";
	echo "document.getElementById('decDay$k').value='{$row['dec_day']}';\n";
	echo "document.getElementById('appYear$k').value='{$row['app_year']}';\n";
	echo "document.getElementById('appMonth$k').value='{$row['app_month']}';\n";
	echo "document.getElementById('appDay$k').value='{$row['app_day']}';\n";
	echo "document.getElementById('appDistrict$k').value='{$row['app_district']}';\n";
	echo "document.getElementById('appSchool$k').value='{$row['app_school']}';\n";
	echo "document.getElementById('subjSec$k').value='{$row['subj_sec']}';\n";
	echo "document.getElementById('appointType$k').value='{$row['appoint_type']}';\n";
	echo "document.getElementById('appointTypeOther$k').value='{$row['appoint_type_other']}';\n";        
    }
}
    //to disable all empty fields
    if($k!=0)
    {
        $startcount=15*($k-1)+3;
        $endcount=$k*15;
        echo "row_enable_this(document.getElementById('appointLevel$k').value,".$k.",".$startcount.",".$endcount.");\n";
    }
?>

</script>

</html>
