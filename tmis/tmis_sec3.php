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
        
        //get the level of current teacher
        $result = mysql_query("SELECT * FROM tmis_sec1 where tid='$currenttid' AND sch_year='$currentyear'");
        $row = mysql_fetch_assoc($result);
        $level=$row['curr_perm_level'];
} else die('This page cannot be accessed individually.');

// get school info
$result = mysql_query("SELECT * FROM mast_schoollist where sch_num='$sch_num' AND sch_year='$currentyear'");
$s = mysql_fetch_assoc($result);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>TMIS - Section III</title>
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

function trainTypeMenu(selection,id,choice){
	var divId="trainType"+id;
        if(id==1)
        {
                strMenu=" <select name='trainTyp"+id+"' id='trainTyp"+id+"' onkeypress='return generalKeyPress(this, event);'>";
		strMenu+="<option value='0' >-Type-</option>";
                strMenu+="<option value='1'>Fully Trained</option>";
		strMenu+="<option value='2'>TPD I</option>";
		strMenu+="<option value='3'>TPD II</option>";
                strMenu+="<option value='4'>TPD III</option>";
                strMenu+="<option value='5'>Untrained</option>";
		strMenu+='</select>';
        }
        else
        {
            if(selection==1){
		strMenu=" <select name='trainTyp"+id+"' id='trainTyp"+id+"' onkeypress='return generalKeyPress(this, event);'>";
		strMenu+="<option value='0' >-Type-</option>";
		strMenu+="<option value='1' >150 hr</option>";
		strMenu+="<option value='2' >180 hr</option>";
		strMenu+="<option value='3' >1st pkg</option>";
		strMenu+="<option value='4' >2nd pkg</option>";
		strMenu+="<option value='5' >3rd pkg</option>";
		strMenu+="<option value='6' >4th pkg</option>";
		strMenu+="<option value='7' >1st stage</option>";
		strMenu+="<option value='8' >2nd stage</option>";
		strMenu+="<option value='9' >3rd stage</option>";
		strMenu+="<option value='10' >Special</option>";
		strMenu+="<option value='11' >1st Sem</option>";
		strMenu+="<option value='12' >2nd Sem</option>";
		strMenu+="<option value='13' >SLC (Ed)</option>";
		strMenu+="<option value='14' >DAG</option>";
		strMenu+="<option value='15' >I Ed.</option>";
		strMenu+="<option value='16' >B Ed.</option>";
		strMenu+="<option value='17' >M Ed.</option>";
		strMenu+="<option value='18' >M Phil</option>";
		strMenu+="<option value='19' >PhD</option>";
		strMenu+="<option value='20' >Others</option>";
		strMenu+='</select>';
            }
            else if(selection==2){
		strMenu=" <select name='trainTyp"+id+"' id='trainTyp"+id+"' onkeypress='return generalKeyPress(this, event);'>";
		strMenu+="<option value='0' >-Type-</option>";
		strMenu+="<option value='1'>Mod I-1 mth</option>";
		strMenu+="<option value='2'>Mod I-1.5 mth</option>";
		strMenu+="<option value='3'>Mod I-2.5 mth</option>";
		strMenu+="<option value='4'>Mod II-5 mth</option>";
		strMenu+="<option value='5'>Mod III-1 mth</option>";
		strMenu+="<option value='6'>Mod III-1.5 mth</option>";
		strMenu+="<option value='7'>Mod III-2.5 mth</option>";
		strMenu+="<option value='8'>I Ed.</option>";
		strMenu+="<option value='9' >B Ed.</option>";
		strMenu+="<option value='10' >M Ed.</option>";
		strMenu+="<option value='11' >M Phil</option>";
		strMenu+="<option value='12' >PhD</option>";
		strMenu+="<option value='13' >Others</option>";
		strMenu+='</select>';
            }
            else if(selection==3){
		strMenu=" <select name='trainTyp"+id+"' id='trainTyp"+id+"' onkeypress='return generalKeyPress(this, event);'>";
		strMenu+="<option value='0' >-Type-</option>";
		strMenu+="<option value='1'>Primary</option>";
		strMenu+="<option value='2'>L Sec/Sec</option>";
		strMenu+='</select>';
            }
            else{
		strMenu=" <select name='trainTyp"+id+"' id='trainTyp"+id+"' onkeypress='return generalKeyPress(this, event);'>";
		strMenu+="<option value=''> Choose a Level </option></select>"
            }
        }	
	document.getElementById(divId).innerHTML=strMenu;
	if (choice!=99){
		document.getElementById('trainTyp'+id).value=choice;
	}
	document.getElementById('trainTyp'+id).focus();
}

function row_enable_train(value,row,start,end){
	row_enable(value,row,start,end);
        
        //toggle enable/disable of row just beneath the current row
        if(row!=7)
            row_enable(value,row+1,(9*(row-1))+100,(9*(row-1))+108);
        //disable all other rows
            for(var i=(row+2);i<8;i++)
            {
                row_enable(0,i,(9*(i-2))+100,(9*(i-2))+108);
            }
        trainTypeMenu(value,row);
}

function row_enable_qualif(value,row,start,end)
{
        row_enable(value,row,start,end);
        
        //toggle enable/disable of row just beneath the current row
        if(row!=9)
            row_enable(value,row+1,((9*(row+1))-8),9*(row+1));
        //disable all other rows
        for(var i=(row+2);i<11;i++)
            row_enable(0,i,((9*i)-8),9*i);

}

function change_qualif(value,row,start,end){
        //enable rows right below the currently filled sn only
        row_enable_qualif(value,row,start,end);
        
        var qualifications ={1:"Doctorate",2:"Masters",3:"Bachelors",4:"Intermediate",5:"SLC",6:"Under SLC"};
        //remove all options from the qualification selectbox in next line
        $("#eduQualif"+(row+1)+" option").remove();
        
        //find the limit
        var limit=0;
        for (var key in qualifications) 
         {
             if(value==key)
                 {
                      limit=key;  
                 }
         }
         
         //add keys less than the limit or disable the next sn if the highest qualification is Under-SLC
         $("#eduQualif"+(row+1)).append('<option value="0"></option>');
         for (var key in qualifications) 
         {
            if(key>limit && limit!=0)
                {
                  $("#eduQualif"+(row+1)).append('<option value='+key+'>'+qualifications[key]+'</option>');
                }
            //disable next rows if the qualification is Under-SLC     
            if(limit==6)
               {
                     row_enable(0,row+1,((9*(row+1))-8),9*(row+1));
               }
        }
        //disable ed education for slc
        //alert(value);
        if(value=="SLC" || value=="Under SLC")
        {
           document.getElementById('educationChk'+row).disabled=true;
        }
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

<p align="center" class="ewGroupName">Educational Qualification</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th valign="middle">SN</th>
    <th valign="middle">Qualification</th>
    <th valign="middle">Board / University</th>
    <th valign="middle">Year</th>
    <th valign="middle">Pass Division</th>
    <th valign="middle">Stream</th>
    <th valign="middle">Main Subjects Studied</th>
    <th valign="middle">School / College / University</th>
    <th valign="middle">Country</th>
    <th valign="middle"> Ed. Education</th>
  </tr>
  <?php
$count=0;
for($i=0;$i<9;$i++){
$count++;
$startcount=9*($count-1)+3;
$endcount=$count*9;
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='eduSN".$count."' type='text' id='eduSN".$count."' size='1' value='".$count."'></td>
  	<td align='left'>
	<select name='eduQualif".$count."' id='eduQualif".$count."' style='width:93px;' onKeyPress='return generalKeyPress(this, event);' onkeyup='return row_enable(this.value,".$count.",".$startcount.",".$endcount."); ' onChange='return change_qualif(this.value,".$count.",".$startcount.",".$endcount.");'>
	<option value='0'> </option>
	<option value='1'> Doctorate </option>
	<option value='2'> Masters </option>
	<option value='3'> Bachelors </option>
	<option value='4'> Intermediate </option>
	<option value='5'> SLC </option>
        <option value='6'> Under SLC </option>
	  </select></td>";

echo " <td align='left'> <select id='eduBoard".$count."' name='eduBoard".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";	
get("board");
echo "</select><a href='#' onclick=\"addNew('eduBoard".$count."','board');\"><img src='images/add.png' border='0'></a> </td>";


echo "  	<td align='left'><input name='eduYear".$count."' type='text' id='eduYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'></td>
  	
<td align='left'><select name='eduDiv".$count."' id='eduDiv".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'><option value=' '> </option><option value='Third'>Third</option><option value='Second'>Second</option><option value='First'>First</option><option value='Distinction'>Distinction</option></select></td>";

echo "<td><select id='eduStream".$count."' name='eduStream".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("stream");
echo "</select><a href='#' onclick=\"addNew('eduStream".$count."','stream');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td><select id='eduSubj".$count."' name='eduSubj".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("subject");
echo "</select><a href='#' onclick=\"addNew('eduSubj".$count."','subject');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td><select id='eduSchool".$count."' name='eduSchool".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("univ");
echo "</select><a href='#' onclick=\"addNew('eduSchool".$count."','univ');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td><select id='eduCountry".$count."' name='eduCountry".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("country", true);
echo "</select><a href='#' onclick=\"addNew('eduCountry".$count."','country');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td>
      <select name='educationChk".$count."' id='educationChk".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>
            <option value='0'>No</option>
            <option value='1'>Yes</option>
        </select>";

echo  "</tr>";
  }
  ?>
</table>
<!--<div id='eduRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td colspan="9" align="right"><input type="button" name="addMoreEdu" id="addMoreEdu" value="Add More" onClick="addRowEdu()" onSelect="addRowEdu()"></td>
  </tr>
</table>-->

<br>
<p align="center" class="ewGroupName">Training Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th valign="middle">SN</th>
    <th valign="middle">Training Name/Type</th>
    <th  valign="middle">Training Subject</th>
    <th valign="middle">Year</th>
    <th valign="middle">Duration</th>
    <th valign="middle">Pass Division</th>
    <th valign="middle">Organisation</th>
    <th valign="middle">Country</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<7;$i++){
$count++;
$startcount=9*($count-1)+93;
$endcount=($count+10)*9;
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='trainSN".$count."' type='text' id='trainSN".$count."' size='1' value='".$count."'></td>
  	<td align='left'>";
            /*<select name='trainName".$count."' id='trainName".$count."' onKeyPress='return generalKeyPress(this, event);' onChange='row_enable_train(this.value,".$count.",".$startcount.",".$endcount.");'>
                <option value='0'> Level </option>
                <option value='".$level_int."'>".$level."</option>
            </select>-->*/ 
echo        "<input name='trainName".$count."' type='hidden' id='trainName".$count."' value='".$level."'>";
echo "<span id='trainType".$count."'>
                <select name='trainTyp".$count."' id='trainTyp".$count."' onKeyPress='return generalKeyPress(this, event);'>";
                  if($i==0){             
                        if(in_array($level, array(1,2,3)))
                         {
                            echo "<option value='0' >-Type-</option>
                                <option value='1'>Fully Trained</option>
                                <option value='2'>TPD I</option>
                                <option value='3'>TPD II</option>
                                <option value='4'>TPD III</option>
                                <option value='5'>Untrained</option>";
                        }
                        else
                        {
                        echo "<option value='0' >-Type-</option>
                             <option value='1'>Fully Trained</option>
                             <option value='5'>Untrained</option>";
                        }
                    }
                    else
                    {
                        echo "<option value='0' >-Type-</option>
                                <option value='1' >150 hr</option>
                                <option value='2' >180 hr</option>
                                <option value='3' >1st pkg</option>
                                <option value='4' >2nd pkg</option>
                                <option value='5' >3rd pkg</option>
                                <option value='6' >4th pkg</option>
                                <option value='7' >1st stage</option>
                                <option value='8' >2nd stage</option>
                                <option value='9' >3rd stage</option>
                                <option value='10' >Special</option>
                                <option value='11' >1st Sem</option>
                                <option value='12' >2nd Sem</option>
                                <option value='13' >SLC (Ed)</option>
                                <option value='14' >DAG</option>
                                <option value='15' >I Ed.</option>
                        	<option value='16' >B Ed.</option>
                                <option value='17' >M Ed.</option>
                                <option value='18' >M Phil</option>
                                <option value='19' >PhD</option>
                                <option value='20' >Others</option>";
                   }
            echo  "</select>
            </span>";
        echo "</td>";

echo "<td><select id='trainSub".$count."' name='trainSub".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("train");
echo "</select><a href='#' onclick=\"addNew('trainSub".$count."','train');\"><img src='images/add.png' border='0'></a> </td>";  	

echo "
  	<td align='left'><input name='trainYear".$count."' type='text' id='trainYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'></td>
  	<td align='left'><input name='trainDuration".$count."' type='text' id='trainDuration".$count."' size='15' maxlength='15' onKeyPress='return generalKeyPress(this, event);' ></td>
  	
<td align='left'><select name='trainDiv".$count."' id='trainDiv".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'><option value=' '> </option><option value='Third'>Third</option><option value='Second'>Second</option><option value='First'>First</option><option value='Distinction'>Distinction</option></select></td>";


echo"  	<td  align='center'><input name='trainOrg".$count."' id='trainOrg".$count."' onKeyPress='return generalKeyPress(this, event);'></td>";
  
echo "<td><select id='trainCountry".$count."' name='trainCountry".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("country", true);
echo "</select><a href='#' onclick=\"addNew('trainCountry".$count."','country');\"><img src='images/add.png' border='0'></a> </td>  	

 </tr>";
  
  }
  ?>
</table>  	
<!--<div id='trainRowSpace1'></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td colspan="10" align="right"><input type="button" name="addMoreTrain" id="addMoreTrain" value="Add More" onClick="addRowTrain()" onSelect="addRowTrain()"></td>
  </tr>
</table>-->
<br>
<p align="center" class="ewGroupName">Award Details</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th  valign="middle">SN</th>
    <th  valign="middle">Level Rank</th>
    <th  valign="middle">Award/Medal Type</th>
    <th valign="middle">Name and Address of Award Granting Organisation </th>
    <th  valign="middle">Date</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<9;$i++){
$count++;
$startcount=(7*($count-1)+3)+144;
$endcount=(($count)*7)+144;  
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='awardSN".$count."' type='text' id='awardSN".$count."' size='1' value='".$count."'></td>

<td align='left'><select name='awardRank".$count."' id='awardRank".$count."' onChange='row_enable(this.value,".$count.",".$startcount.",".$endcount.");' onKeyPress='return generalKeyPress(this, event);'  onkeyup='row_enable(this.value,".$count.",".$startcount.",".$endcount.");'>
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

echo "<td><select id='awardType".$count."' name='awardType".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("award");
echo "</select><a href='#' onclick=\"addNew('awardType".$count."','award');\"><img src='images/add.png' border='0'></a> </td>";

echo "<td><select id='awardOrg".$count."' name='awardOrg".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("org");
echo "</select><a href='#' onclick=\"addNew('awardOrg".$count."','org');\"><img src='images/add.png' border='0'></a> </td>";
  	
echo "
  	<td align='left'><input name='awardYear".$count."' type='text' id='awardYear".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='awardMonth".$count."' type='text' id='awardMonth".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='awardDay".$count."' type='text' id='awardDay".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>
  </tr>";
  }
  ?>
</table>
<!--<div id='awardRowSpace1'></div>
<table width='100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">  
  <tr>
  	<td align="right"><input type="button" name="addMoreAward" id="addMoreAward" value="Add More" onClick="addRowAward()" onSelect="addRowAward()"></td>
  </tr>
</table>-->

<br>
<p align="center" class="ewGroupName">Leave Details</p>
<table width="1250px" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <th  valign="middle" rowspan="2">SN</th>
    <th  valign="middle" rowspan="2">Leave Type</th>
    <th  valign="middle" colspan="2">Where was the leave taken</th>
    <th  valign="middle" rowspan="2">Leave Period</th>
    <th  valign="middle" rowspan="2">Total Leave Duration <br />(Year, month, day)</th>
    <th  valign="middle" rowspan="2">Remarks</th>
  </tr>
  
  
  <tr class="ewTableHeader">
  	<th  valign="middle">District</th>
  	<th  valign="middle">School's Name and Address</th>
  </tr>
  
  <?php
$count=0;
for($i=0;$i<5;$i++){
$count++;
$startcount=(14*($count-1)+3)+153;
$endcount=(($count)*14)+153;  
if($count % 2 == 0)
	echo "<tr class='ewTableRow'>";
else 
	echo "<tr class='ewTableAltRow'>";
	
echo  	"
  	<td align='left'><input disabled name='leaveSN".$count."' type='text' id='leaveSN".$count."' size='1' value='".$count."'></td>";
  	
echo "<td><select id='leaveType".$count."' name='leaveType".$count."' onkeypress='return generalKeyPress(this, event);' onchange='return handlechange(this, event);'>";
get("leave");
echo "</select><a href='#' onclick=\"addNew('leaveType".$count."','leave');\"><img src='images/add.png' border='0'></a> </td>";

echo ("<td align='left'><select name='leaveDist".$count."' id='leaveDist".$count."'   onKeyPress='return generalKeyPress(this, event);'>");
get_dist_list();
echo ("</select></td>");

echo "<td align='left'><input name='leaveSchool".$count."' type='text' id='leaveSchool".$count."' size='30' maxlength='50' onKeyPress='return generalKeyPress(this, event);' onchange='beautify(this);'></td>
  	<td align='left'><input name='leaveYearFrom".$count."' type='text' id='leaveYearFrom".$count."' size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='leaveMonthFrom".$count."' type='text' id='leaveMonthFrom".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='leaveDayFrom".$count."' type='text' id='leaveDayFrom".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'> to <input name='leaveYearTo".$count."' type='text' id='leaveYearTo".$count."'  size='4' maxlength='4' onchange='return fixYear(this);' onKeyPress='return generalKeyPress(this, event);'>-<input name='leaveMonthTo".$count."' type='text' id='leaveMonthTo".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='leaveDayTo".$count."' type='text' id='leaveDayTo".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'></td>
  	<td align='left'><input name='leaveDurYear".$count."' type='text' id='leaveDurYear".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='leaveDurMonth".$count."' type='text' id='leaveDurMonth".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'>-<input name='leaveDurDay".$count."' type='text' id='leaveDurDay".$count."' size='2' maxlength='2' onkeypress='return forceNumberInput(this, event);'> </td>
  	<td align='left'><input name='leaveRemarks".$count."' type='text' id='leaveRemarks".$count."' size='20' maxlength='20' onKeyPress='return generalKeyPress(this, event);' onchange='beautify(this);'></td>
  </tr>";
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

$result = mysql_query("SELECT * FROM tmis_edu WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;

	echo "document.getElementById('eduQualif$k').value='{$row['qualif']}';\n";
	echo "document.getElementById('eduBoard$k').value='{$row['board']}';\n";
	echo "document.getElementById('eduYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('eduDiv$k').value='{$row['division']}';\n";
	echo "document.getElementById('eduStream$k').value='{$row['stream']}';\n";
	echo "document.getElementById('eduSubj$k').value='{$row['subj']}';\n";
	echo "document.getElementById('eduSchool$k').value='{$row['school']}';\n";
	echo "document.getElementById('eduCountry$k').value='{$row['country']}';\n";
        echo "document.getElementById('educationChk$k').value='{$row['is_education']}';\n";
        
        //disable all other fields other than the ones right below the currently filled fields and filter dropdown
        $startcount=9*($k-1)+3;
        $endcount=$k*9;
        echo "change_qualif('{$row['qualif']}',".$k.",".$startcount.",".$endcount.");\n";
}

$result = mysql_query("SELECT * FROM tmis_train WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	$startcount=9*($k-1)+93;
	$endcount=($k+10)*9;	
        
	//echo "document.getElementById('trainName$k').value='{$row['name']}';\n";
	//echo "row_enable_train({$row['name']},".$k.",".$startcount.",".$endcount.");\n";
	
	echo "document.getElementById('trainTyp$k').value='{$row['type']}';\n";
	echo "document.getElementById('trainSub$k').value='{$row['subj']}';\n";
	echo "document.getElementById('trainYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('trainDuration$k').value='{$row['duration']}';\n";
	echo "document.getElementById('trainDiv$k').value='{$row['division']}';\n";
	echo "document.getElementById('trainOrg$k').value='{$row['org']}';\n";
	echo "document.getElementById('trainCountry$k').value='{$row['country']}';\n";
}

$result = mysql_query("SELECT * FROM tmis_award WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('awardRank$k').value='{$row['rank']}';\n";
	echo "document.getElementById('awardType$k').value='{$row['type']}';\n";
	echo "document.getElementById('awardOrg$k').value='{$row['org']}';\n";
	echo "document.getElementById('awardYear$k').value='{$row['year']}';\n";
	echo "document.getElementById('awardMonth$k').value='{$row['month']}';\n";
	echo "document.getElementById('awardDay$k').value='{$row['day']}';\n";
}

$result = mysql_query("SELECT * FROM tmis_leave WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sn");
$k=0;
while ($row = mysql_fetch_assoc($result)){
	$k++;
	echo "document.getElementById('leaveType$k').value='{$row['type']}';\n";
	echo "document.getElementById('leaveDist$k').value='{$row['dist']}';\n";
	echo "document.getElementById('leaveSchool$k').value='{$row['school']}';\n";
	echo "document.getElementById('leaveYearFrom$k').value='{$row['year_from']}';\n";
	echo "document.getElementById('leaveMonthFrom$k').value='{$row['month_from']}';\n";
	echo "document.getElementById('leaveDayFrom$k').value='{$row['day_from']}';\n";
	echo "document.getElementById('leaveYearTo$k').value='{$row['year_to']}';\n";
	echo "document.getElementById('leaveMonthTo$k').value='{$row['month_to']}';\n";
	echo "document.getElementById('leaveDayTo$k').value='{$row['day_to']}';\n";
	echo "document.getElementById('leaveDurYear$k').value='{$row['dur_year']}';\n";
	echo "document.getElementById('leaveDurMonth$k').value='{$row['dur_month']}';\n";
	echo "document.getElementById('leaveDurDay$k').value='{$row['dur_day']}';\n";
	echo "document.getElementById('leaveRemarks$k').value='{$row['remarks']}';\n";
}
?>
</script>

</html>
