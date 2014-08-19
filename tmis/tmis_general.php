<?php

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
require_once('includes/essentials.php');
require_once('includes/commonfn.php');

// add new teacher coming from teacherlist.php
if (isset($_POST['t_name'])){
	$tid = $sch_num = $_POST['s']; // school's id
	$tid .= substr($currentyear, -2);
	
	$result = mysql_query("SELECT MAX(tid) as tid FROM tmis_main WHERE sch_num='$sch_num' AND sch_year='$currentyear'");
	$count = 0;
	if (mysql_num_rows($result)>0){
		$row = mysql_fetch_assoc($result);
		$count = (int)substr($row['tid'],-3);

	}
	$count++;
	$tid .= str_pad($count, 3, '0', STR_PAD_LEFT);
	
	// insert tid and t_name
	$dt = array();
	$dt['tid'] = $tid;
        $dt['t_name'] = $_POST['t_name'];
	$dt['sch_num'] = $sch_num;
	$dt['sch_year'] = $currentyear;
	
	idata('tmis_main',$dt);
	
	$currenttid = $tid;

}

if (isset($_GET['old'])){
	$currenttid=$_GET['tid'];
	
	// get sch_num
	$result = mysql_query("SELECT * FROM tmis_main where tid='$currenttid' ORDER BY sch_year DESC");
	$row = mysql_fetch_assoc($result);
	
	$dt = array();
	$dt['tid'] = $currenttid;
	$dt['t_name'] = $row['t_name'];
	$dt['sch_num'] = $sch_num = $_GET['s'];
	$dt['sch_year'] = $currentyear;
	
	idata('tmis_main',$dt);	
	
}

if (isset($_GET['tid'])){
	$currenttid=$_GET['tid'];
	
	// get sch_num
	$result = mysql_query("SELECT * FROM tmis_main where tid='$currenttid' AND sch_year='$currentyear'");
	$row = mysql_fetch_assoc($result);
	
	$sch_num=$row['sch_num'];	
	$teacher_name=$row['t_name'];	
}

if ($currenttid == '') die('This page cannot be accessed individually.');

// get school info
$result = mysql_query("SELECT * FROM mast_schoollist where sch_num='$sch_num' AND sch_year='$currentyear'");
$s = mysql_fetch_assoc($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>TMIS - Data Entry</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/autosuggest.css" rel="stylesheet" type="text/css">
<style type="text/css">
	p.c5 {text-align: left}
	div.c4 {text-align: center}
	table.c3 {background: #bcd;}
	input.c1 {font-weight:bold;width:300px}
	table{ width: none;	}
	.sectionlabel{background-color: #A5BCD6;width: 175px; padding-left: 10px;margin-right:10px;}
	td{padding: 8px;}
	#basicinfo{background-color: #A5BCD6; padding: 10px;}
	#extendedinfo{background-color: #f9f9f9; margin-top: 10px;}
	tr:hover{background:none}
	table.c2{border-bottom: 1px solid #8F97A0;}

</style>
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
echo "currentPage='".basename($_SERVER['PHP_SELF'])."';\n";
echo "currenttid='$currenttid';\n";
echo "currentSchool='$sch_num';\n";
echo "currentyear=$currentyear;\n";
echo "teacherName='$teacher_name';\n";
?>
<?php
    $result = mysql_query("SELECT photo FROM tmis_photos WHERE tid='$currenttid'");
    $picture =  mysql_fetch_assoc($result);
?>
</script>
<script>

$(document).ready(function() {
  <?php if($teacher_name=="Vacant" || $dt['t_name']=="Vacant") {?>
        $('#teacherDetail_form :input').attr('disabled', true);
        $('#teacherDetail_form #currPermLevel').attr('disabled', false);
        $('#teacherDetail_form #currPermType').attr('disabled', false);
  <?php } ?>
});

function addNewCheck(){
	if (document.getElementById('t_name_editcheck').checked==false){
		initialize();
	}
	else{
		document.getElementById('divteacher').innerHTML="<input name=\"teacherName\" type=\"text\" id=\"teacherName\" size=\"30\" maxlength=\"50\" onkeypress=\"return generalKeyPress(this, event);\" onchange=\"beautify(this);\">"
	}
}

function firstApp(level)	{
	if ((level=="2") || (level=="3") || (level=="4")){
		document.forms[0].firstAppSecSubject.disabled=false
	}
	else
		document.forms[0].firstAppSecSubject.disabled=true
		
	return
}
function maritalStat(stat)	{
	if (stat=="1"){
		document.forms[0].nofDaughter.disabled=false
		document.forms[0].nofSon.disabled=false
		document.forms[0].nofTotal.disabled=false
	}
	else {
		document.forms[0].nofDaughter.disabled=true
		document.forms[0].nofSon.disabled=true
		document.forms[0].nofTotal.disabled=true
	}
	return
}

function bs2ad(o){
	
	var n = o.id.substr(o.id.length-1,1);


	var dob_np_y='bsDobYear'+n;
	var dob_np_m='bsDobMonth'+n;
	var dob_np_d='bsDobDay'+n;
	
	var dob_en_y='adDobYear'+n;
	var dob_en_m='adDobMonth'+n;
	var dob_en_d='adDobDay'+n;	

	
	var year = $('#'+dob_np_y).val();
	var month = $('#'+dob_np_m).val();
	var day = $('#'+dob_np_d).val();
	
	$.get('nepcal.php',{r:'n2e',y:year,m:month,d:day},function(data){
		var d = data.split(':');
		$('#'+dob_en_y).val(d[0]);
		$('#'+dob_en_m).val(d[1]);
		$('#'+dob_en_d).val(d[2]);
		
		if ($("#bsDobYear1").val()!='' && $("#bsDobMonth1").val()!='' && $("#bsDobDay1").val()!='' 
			&& $("#bsDobYear2").val()=='' && $("#bsDobMonth2").val()=='' && $("#bsDobDay2").val()==''){
			$("#bsDobYear2").val($("#bsDobYear1").val());
			$("#bsDobMonth2").val($("#bsDobMonth1").val());
			$("#bsDobDay2").val($("#bsDobDay1").val());
		} 
		
		if ($("#adDobYear1").val()!='' && $("#adDobMonth1").val()!='' && $("#adDobDay1").val()!='' 
			&& $("#adDobYear2").val()=='' && $("#adDobMonth2").val()=='' && $("#adDobDay2").val()==''){
			$("#adDobYear2").val($("#adDobYear1").val());
			$("#adDobMonth2").val($("#adDobMonth1").val());
			$("#adDobDay2").val($("#adDobDay1").val());
		} 		
	});	
	
	blinkConst(dob_np_y, currentyear, "Invalid Year");
	blinkConst(dob_np_m, 12, "Invalid Month");
	blinkConst(dob_np_d, 32, "Invalid Day");
	
	blinkConst(dob_en_y, (currentyear-57), "Invalid Year");
	blinkConst(dob_en_m, 12, "Invalid Month");
	blinkConst(dob_en_d, 31, "Invalid Day");
	
	
	

}

function ad2bs(o){
	
	var n = o.id.substr(o.id.length-1,1);


	var dob_np_y='bsDobYear'+n;
	var dob_np_m='bsDobMonth'+n;
	var dob_np_d='bsDobDay'+n;
	
	var dob_en_y='adDobYear'+n;
	var dob_en_m='adDobMonth'+n;
	var dob_en_d='adDobDay'+n;	

	
	var year = $('#'+dob_en_y).val();
	var month = $('#'+dob_en_m).val();
	var day = $('#'+dob_en_d).val();
	
	$.get('nepcal.php',{r:'e2n',y:year,m:month,d:day},function(data){
		var d = data.split(':');
		$('#'+dob_np_y).val(d[0]);
		$('#'+dob_np_m).val(d[1]);
		$('#'+dob_np_d).val(d[2]);
	});	
	
	blinkConst(dob_np_y, currentyear, "Invalid Year");
	blinkConst(dob_np_m, 12, "Invalid Month");
	blinkConst(dob_np_d, 32, "Invalid Day");
	
	blinkConst(dob_en_y, currentyear-57, "Invalid Year");
	blinkConst(dob_en_m, 12, "Invalid Month");
	blinkConst(dob_en_d, 31, "Invalid Day");	

}
function showTraining(obj)
{
    var selected=$(obj).val();
    if(selected=='2')
        $('#trainingDiv').show();
    else
        $('#trainingDiv').hide();
}
</script>
</head>

<body onLoad="navigation();">
<div class='header'>
<div style="float: left">Teacher MIS - <?php echo $s['nm_sch']; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>
<p>&nbsp;</p>
<div align="center">
  <p><img src="images/tmis.png"></p>
</div>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select Section</select></span>
</p>

<form id="teacherDetail_form" action="controller.php" method="post">

<div id='basicinfo'>

	<div class='inputbox'><label>Teacher ID</label><input disabled name="t_id" type="text" id="t_id" size="15" maxlength="15" ></div>
	<div class='inputbox'><label>School Code</label><input disabled name="sch_code" type="text" id="sch_code" size="12" maxlength="20" ></div>
	<div class='inputbox'><label>Name</label><input name="teacherName" type="text" id="teacherName" size="30" maxlength="50" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></div>

	<div class='inputbox'>
		<label>Nationality</label>
		<select id='teacherNationality' name='teacherNationality' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
			<?php get("nationality", true); ?>
		</select> 
		<a href="#" onclick="addNew('teacherNationality','nationality');"><img src="images/add.png" border="0"></a>
	</div>

	<div class='inputbox'>
		<label>Sex</label>
		<select name="t_sex" id="t_sex" onKeyPress="return generalKeyPress(this, event);">
		<option value="0"> </option>
		<option value="1">Female</option>
		<option value="2">Male</option>
		</select>	
	</div>

	<div class='inputbox'>
		<label>Caste</label>
		<select id='teacherCaste' name='teacherCaste' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
		<?php get("caste"); ?>
		</select> 
		<a href="#" onclick="addNew('teacherCaste','caste');"><img src="images/add.png" border="0"></a>	
	</div>

	<div class='inputbox'>
		<label>Ethnicity</label>
		<select name="t_caste" id="t_caste" onKeyPress="return generalKeyPress(this, event);">
			<option value="0"> </option>
			<option value="1">Dalit</option>
			<option value="2">Janajati</option>
                        <option value="3">Brahmin/Chhetri</option>
			<option value="4">Others</option>
		</select>	
	</div>
	<div style="clear:both;"></div>
	<div class='inputbox'><label>Insurance No.</label><input name="teacherInsurNo" type="text" id="teacherInsurNo" size="15" maxlength="15" onKeyPress="return forceNumberInput(this, event);"> </div>
	<div class='inputbox'><label>PF Account No.</label><input name="teacherPfNo" type="text" id="teacherPfNo" size="15" maxlength="15" onKeyPress="return forceNumberInput(this, event);"></div>
	<div class='inputbox'><label>Account Number</label><input name="teacherAcNo" type="text" id="teacherAcNo" size="23" maxlength="23" onKeyPress="return forceNumberInput(this, event);"></div>
        <div class='inputbox'><label>Trk Number</label><input name="teacherTrkNo" type="text" id="teacherTrkNo" size="23" maxlength="23" onKeyPress="return forceNumberInput(this, event);"></div>
        <div class='inputbox'><label>License Number</label><input name="teacherLicense" type="text" id="teacherLicense" size="23" maxlength="23" onKeyPress="return forceNumberInput(this, event);"></div>
        
  
        <div class="tcher_photo">
            <?php if($picture){ ?>
                <img src="photo.php?get=1&tid=<?php echo $currenttid; ?>" />
            <?php } ?>
        </div>
        <div style="clear:both;"></div>
</div>
<input class="btn_upload" type="button" name="btn_upload" value="Upload Picture" onclick="$('#userfile').click();"/>         
    
<div id='extendedinfo'>

<table class='c2'>
	<tr>
		<td class="sectionlabel">Languages</td>
		<td align="left" class="ewTableAltRow">
			<label>Mother Tongue</label>
			<select id='motherTongue' name='motherTongue' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
				<?php get("language"); ?>
			</select> 
			<a href="#" onclick="addNew('motherTongue','language');"><img src="images/add.png" border="0"></a>
		</td>
		
		<td align="left" class="ewTableAltRow">
			<label>Language you can teach in</label>
			<select id='teachingLang' name='teachingLang' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
				<?php get("language"); ?>
			</select> 
			<a href="#" onclick="addNew('teachingLang','language');"><img src="images/add.png" border="0"></a>
		</td>

	</tr>
</table>
    
<table class="c2">
    <tr>
        <td class="sectionlabel">Disability Status</td>
        <td>
            <select id="disabilityStatus" name="disabilityStatus" onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
                <option value="0">N/A</option>
                <option value="1">Physically Disabled</option>
                <option value="2">Mentally Disabled</option>
                <option value="3">Deaf</option>
                <option value="4">Complete Blind</option>
                <option value="5">Partial Blind</option>
                <option value="6">Deaf and Blind</option>
                <option value="7">Speech Impairment</option>
                <option value="8">Multiple Disability</option>
            </select>
        </td>
    </tr>
</table>

<table class="c2">
	<tr>
		<td class="sectionlabel" >First Appointment</td>
		<td align="left" class="ewTableAltRow">
			<label>Type</label>
			<select name="t_firstAppType" id="t_firstAppType" onKeyPress="return generalKeyPress(this, event);">
				<option value="0"> </option>
				<option value="1"> ECD Facilitator </option>
				<option value="2"> Permanent </option>
                                <option value="3"> Temporary </option>
                                <option value="4"> Rahat </option>
                                <option value="5"> PCF </option>
                                <option value="6"> Private Sources </option>
                                <option value="7"> Permanent Leon </option>
                                <option value="8"> Temporary Leon </option>
			</select> 
		</td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="t_firstAppYear" type="text" id="t_firstAppYear" size="4" maxlength="4" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="t_firstAppMonth" type="text" id="t_firstAppMonth" size="2" maxlength="2" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="t_firstAppDay" type="text" id="t_firstAppDay" size="2" maxlength="2" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Level/Subject</label><select name="t_firstAppLevel" id="t_firstAppLevel" onKeyPress="return generalKeyPress(this, event);" onkeyup="return firstApp(this.value);" onclick="return firstApp(this.value);">
        <?php
            echo "<option value='0'> </option>";
            $sch_lvl=0;
            $link = dbconnect();
            $result = mysql_query("select sch_num from tmis_main where tid=".$currenttid);
            if (mysql_num_rows($result)>0){
				$row = mysql_fetch_array($result);
				$sch = $row['sch_num'];
				$result = mysql_query("select * from mast_school_type where sch_num='".$sch."' order by sch_year desc");
				if (mysql_num_rows($result)>0){
					$row = mysql_fetch_array($result);
                                        if ($row['ecd']>0)
                                                echo "<option value='1'>ECD</option>";
					if ($row['class1']>0)
						echo "<option value='2'>Primary</option>";
					if ($row['class6']>0)
						echo "<option value='3'>L-Sec</option>";
					if ($row['class9']>0)
						echo "<option value='4'>Sec</option>";
					if ($row['class11']>0)
						echo "<option value='5'>H-Sec</option>";
				}
			}
            
			?>
        <!--<option value="0"> </option>
        <option value="1">Pri</option>
        <option value="2">LSec</option>
        <option value="3">Sec</option>
        <option value="4">HSec</option>-->
        </select>

        <select disabled id='firstAppSecSubject' name='firstAppSecSubject' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
		<?php
		get("subject");
		?>
		</select> <a href="#" onclick="addNew('firstAppSecSubject','subject');"><img src="images/add.png" border="0"></a></td>

                <td align="left"  class="ewTableAltRow">
                    <label>Rank</label>
                    <select name="t_firstAppRank" id="t_firstAppRank" onKeyPress="return generalKeyPress(this, event);">
                        <option value="0"> </option>
                        <option value="1">First</option>
                        <option value="2">Second</option>
                        <option value="3">Third</option>
                    </select>
                </td>
        
        
		<td align="left" class="ewTableAltRow"><label>Subjects you teach</label><select id='teachingSub1' name='teachingSub1' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
		<?php
		get("subject");
		?>
		</select> <a href="#" onclick="addNew('teachingSub1','subject');"><img src="images/add.png" border="0"></a> &nbsp; <select id='teachingSub2' name='teachingSub2' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
		<?php
		get("subject");
		?>
		</select> <a href="#" onclick="addNew('teachingSub2','subject');"><img src="images/add.png" border="0"></a></td>

	</tr>
</table>
<table class="c2">
	<tr>
		<td class="sectionlabel">Current Position</td>
        <td align="left"  class="ewTableAltRow">
            <label>Type</label>
			<select name="currPermType" id="currPermType" onKeyPress="return generalKeyPress(this, event);">
				<option value="0"> </option>
				<option value="1"> ECD Facilitator </option>
				<option value="2"> Permanent </option>
                                <option value="3"> Temporary </option>
                                <option value="4"> Rahat </option>
                                <option value="5"> PCF </option>
                                <option value="6"> Private Sources </option>
                                <option value="7"> Permanent Leon </option>
                                <option value="8"> Temporary Leon </option>
			</select> 
            
        </td>    
        <td align="left" class="ewTableAltRow"><label>Level</label><select name="currPermLevel" id="currPermLevel" onKeyPress="return generalKeyPress(this, event);">
            <?php
            echo "<option value='0'> </option>";
            $sch_lvl=0;
            $link = dbconnect();
            $result = mysql_query("select sch_num from tmis_main where tid=".$currenttid);
            if (mysql_num_rows($result)>0){
				$row = mysql_fetch_array($result);
				$sch = $row['sch_num'];
				$result = mysql_query("select * from mast_school_type where sch_num='".$sch."' order by sch_year desc");
				if (mysql_num_rows($result)>0){
					$row = mysql_fetch_array($result);
					if ($row['ecd']>0)
                                                echo "<option value='1'>ECD</option>";
					if ($row['class1']>0)
						echo "<option value='2'>Primary</option>";
					if ($row['class6']>0)
						echo "<option value='3'>L-Sec</option>";
					if ($row['class9']>0)
						echo "<option value='4'>Sec</option>";
					if ($row['class11']>0)
						echo "<option value='5'>H-Sec</option>";
								
					
				}
			}
            
			?>
            
            </select></td>
        <td align="left"  class="ewTableAltRow"><label>Rank</label><select name="currPermRank" id="currPermRank" onKeyPress="return generalKeyPress(this, event);">
            <option value="0"> </option>
            <option value="1">First</option>
            <option value="2">Second</option>
            <option value="3">Third</option>
            </select></td>
            
            <td align="left"  class="ewTableAltRow">
                <label>Head Teacher?</label>
                <select name="t_head_teacher" id="t_head_teacher" onchange="return showTraining(this);">
                    <option value="0"></option>
                    <option value="2">Yes</option>
                    <option value="1">No</option>
                </select>
            </td>
            <td align="left" id="trainingDiv" class="ewTableAltRow">
                <label>Head Teacher Training</label>
                <select name="headTeachertraining" id="headTeachertraining">
                    <option value="0"></option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
            </td>
			<td align="left" class="ewTableAltRow">
                <label>Special Promotion</label>
                <select name="special_promotion" id="special_promotion">
                    <option value="0"></option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
            </td>
			<td align="left" class="ewTableAltRow"><label>Curr. Appointment Year</label><input name="current_app_year" type="text" id="current_app_year" size="4" maxlength="4" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Curr. App. Month</label><input name="current_app_month" type="text" id="current_app_month" size="2" maxlength="2" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Curr. App. Day</label><input name="current_app_day" type="text" id="current_app_day" size="2" maxlength="2" onchange="handlechange(this,event); " onKeyPress="return forceNumberInput(this, event);"></td>
        	
			
			
			
            <!--<td width="35%" class="ewTableAltRow">&nbsp;</td>-->
    </tr>
	
	

</table>
<table border="0" cellpadding="3" class="c2">
	<tr>
        <td class="sectionlabel">DOB (Citizenship)</td>
        <td align="left" class="ewTableAltRow">BS</td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="bsDobYear1" type="text" id="bsDobYear1" size="4" maxlength="4" onchange="fixYear(this); bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="bsDobMonth1" type="text" id="bsDobMonth1" size="2" maxlength="2" onchange="bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="bsDobDay1" type="text" id="bsDobDay1" size="2" maxlength="2" onchange="bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow">AD</td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="adDobYear1" type="text" id="adDobYear1" size="4" maxlength="4" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="adDobMonth1" type="text" id="adDobMonth1" size="2" maxlength="2" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="adDobDay1" type="text" id="adDobDay1" size="2" maxlength="2" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
    </tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td class="sectionlabel">DOB (Education)</td>
        <td align="left" class="ewTableAltRow">BS</td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="bsDobYear2" type="text" id="bsDobYear2" size="4" maxlength="4" onchange="fixYear(this); bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="bsDobMonth2" type="text" id="bsDobMonth2" size="2" maxlength="2" onchange="bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="bsDobDay2" type="text" id="bsDobDay2" size="2" maxlength="2" onchange="bs2ad(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow">AD</td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="adDobYear2" type="text" id="adDobYear2" size="4" maxlength="4" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="adDobMonth2" type="text" id="adDobMonth2" size="2" maxlength="2" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="adDobDay2" type="text" id="adDobDay2" size="2" maxlength="2" onchange="ad2bs(this);" onKeyPress="return forceNumberInput(this, event);"></td>
	</tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td class="sectionlabel">Marital Details</td>
        <td align="left" class="ewTableAltRow"><label>Marital Status</label><select name="maritalStatus" onKeyPress="return generalKeyPress(this, event);" onkeyup="return maritalStat(this.value);" onclick="return maritalStat(this.value);" id="maritalStatus">
			<option value="0"> </option>
              <option value="1"> Married </option>
              <option value="2"> Single </option>
            </select></td>
        <td align="left" class="ewTableAltRow"><label>Daughters</label><input disabled name="nofDaughter" type="text" id="nofDaughter" size="2" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Sons</label><input disabled name="nofSon" type="text" id="nofSon" size="2" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Family Size</label><input disabled name="nofTotal" type="text" id="nofTotal" size="2" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
	</tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td class="sectionlabel">Citizenship</td>
        <td align="left" class="ewTableAltRow"><label>Number:</label><input name="citizenshipNo" type="text" id="citizenshipNo" size="10" maxlength="15" onKeyPress="return generalKeyPress(this, event);" ></td>
        <td align="left" class="ewTableAltRow"><label>Year</label><input name="citizenshipYear" type="text" id="citizenshipYear" size="4" maxlength="4"  onchange="handlechange(this,event);" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Month</label><input name="citizenshipMonth" type="text" id="citizenshipMonth" size="2" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
        <td align="left" class="ewTableAltRow"><label>Day</label><input name="citizenshipDay" type="text" id="citizenshipDay" size="2" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
        
		<td align="left" class="ewTableAltRow"><label>District:</label><select name='citizenshipDistrict' id='citizenshipDistrict' onKeyPress="return generalKeyPress(this, event);">");
		<?php get_dist_list(); ?>
		</select></td>
	</tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td class="sectionlabel">Family</td>
        <td align="left" class="ewTableAltRow"><label>Father's Name</label><input name="nameFather" type="text" id="nameFather" size="15" maxlength="50" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
		<td align="left" class="ewTableAltRow"><label>Mother's Name</label><input name="nameMother" type="text" id="nameMother" size="15" maxlength="50" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
		<td align="left" class="ewTableAltRow"><label>Spouse's Name</label><input name="nameSpouse" type="text" id="nameSpouse" size="15" maxlength="50" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
		<td align="left" class="ewTableAltRow"><label>Will Person</label><input name="nameWillper" type="text" id="nameWillper" size="15" maxlength="50" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
        
	</tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td rowspan="2" class="sectionlabel">Permanent Address</td>
        
<td align="left" class="ewTableAltRow"><label>District:</label><select name='permAddrDist' id='permAddrDist' onKeyPress="return generalKeyPress(this, event);">");
<?php get_dist_list(); ?>
</select></td>

<td align="left" class="ewTableAltRow"><label>VDC/NP:</label><select id='permAddrVdc' name='permAddrVdc' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
<?php
get("vdc");
?>
</select> <a href="#" onclick="addNew('permAddrVdc','vdc');"><img src="images/add.png" border="0"></a></td>

		
		<td align="left" class="ewTableAltRow"><label>Ward No</label><input name="permAddrWard" type="text" id="permAddrWard" size="5" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
		<td align="left" class="ewTableAltRow"><label>Locality</label><input name="permAddrLocality" type="text" id="permAddrLocality" size="20" maxlength="15" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
		<td align="left" class="ewTableAltRow"><label>House No.</label><input name="permAddrHouse" type="text" id="permAddrHouse" size="5" maxlength="7"  onKeyPress="return generalKeyPress(this, event);"></td>
    </tr>
    <tr>
    	<td align="left" class="ewTableAltRow">
    	<label>Region</label><select name="permAddrRegion" id="permAddrRegion" onKeyPress="return generalKeyPress(this, event);">
			<option value="0"> </option>
              <option value="1"> Rural </option>
              <option value="2"> Urban </option>
            </select></td>
		<td align="left" colspan="2" class="ewTableAltRow"><label>Phone</label><input name="permAddrPhone" type="text" id="permAddrPhone" size="15" maxlength="10" onKeyPress="return forceNumberInput(this, event);"></td>
		<td align="left" colspan="2" class="ewTableAltRow"><label>Email</label><input name="permAddrEmail" type="text" id="permAddrEmail" onKeyPress="return generalKeyPress(this, event);" size="25" maxlength="30" ></td>
		
    </tr>
</table>
<table border="0" cellpadding="0" class="c2">
	<tr>
        <td rowspan="2" class="sectionlabel">Temporary Address</td>
        
<td align="left" class="ewTableAltRow"><label>District:</label><select name='tempAddrDist' id='tempAddrDist' onKeyPress="return generalKeyPress(this, event);">");
<?php get_dist_list(); ?>
</select></td>

<td align="left" class="ewTableAltRow"><label>VDC/NP:</label><select id='tempAddrVdc' name='tempAddrVdc' onkeypress="return generalKeyPress(this, event);" onchange="return handlechange(this, event);">
<?php
get("vdc");
?>
</select> <a href="#" onclick="addNew('tempAddrVdc','vdc');"><img src="images/add.png" border="0"></a></td>

		<td align="left" class="ewTableAltRow"><label>Ward No</label><input name="tempAddrWard" type="text" id="tempAddrWard" size="5" maxlength="2" onKeyPress="return forceNumberInput(this, event);"></td>
		<td align="left" class="ewTableAltRow"><label>Locality</label><input name="tempAddrLocality" type="text" id="tempAddrLocality" size="20" maxlength="15" onKeyPress="return generalKeyPress(this, event);" onChange="beautify(this);"></td>
		<td align="left" class="ewTableAltRow"><label>House No.</label><input name="tempAddrHouse" type="text" id="tempAddrHouse" size="5" maxlength="7"  onKeyPress="return generalKeyPress(this, event);"></td>
    </tr>
    <tr>
    	<td align="left" class="ewTableAltRow">
    	<label>Region</label><select name="tempAddrRegion" id="tempAddrRegion" onKeyPress="return generalKeyPress(this, event);">
			<option value="0"> </option>
              <option value="1"> Rural </option>
              <option value="2"> Urban </option>
            </select></td>
		<td align="left" colspan="2" class="ewTableAltRow"><label>Phone</label><input name="tempAddrPhone" type="text" id="tempAddrPhone" size="15" maxlength="10" onKeyPress="return forceNumberInput(this, event);"></td>
		<td align="left" colspan="2" class="ewTableAltRow"><label>Email</label><input name="tempAddrEmail" type="text" id="tempAddrEmail" onKeyPress="return generalKeyPress(this, event);"  size="25" maxlength="30" ></td>
		
    </tr>
</table>

</div>

</form>
<!-- photo upload for teacher  -->
<form method="post" action="photo.php?add=1" id="uploadform" enctype="multipart/form-data">
<input style="display:none;" type="file" name="userfile" id="userfile" allowed="image/*" onchange="$('#uploadform').submit();"/> 
<input type="hidden" name="tid" value="<?php echo $currenttid; ?>"/>
<input type="hidden" name="s" value="<?php echo $sch_num; ?>"/>
<input type="submit" id="submit_photo" style="display:none;"/>
</form>
<!-- end of photo upload for teacher -->


<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<br />
</body>
<script>

// marital status default as Married
document.getElementById('maritalStatus').value='Married';


<?php

if (isset($_GET['prevcode'])){
	
	$schcode=$_GET['prevcode'];
	
	echo "var prevdcode='".substr($schcode,0,2)."';\n";
	echo "var prevvcode='".substr($schcode,2,3)."';\n";
	
	
}

?>

<?php

$tid = $currenttid;

// retrieve data
$result = mysql_query("SELECT * FROM tmis_main WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sch_year DESC");
$row = mysql_fetch_assoc($result);

echo "document.getElementById('t_id').value='{$row['tid']}';\n";
echo "document.getElementById('sch_code').value='{$row['sch_num']}';\n";
echo "document.getElementById('teacherName').value='{$row['t_name']}';\n";

$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$currentyear' ORDER BY sch_year DESC");
$row = mysql_fetch_assoc($result);

echo "document.getElementById('teacherNationality').value='Nepalese';\n";
echo "if ('{$row['nationality']}'!='') document.getElementById('teacherNationality').value='{$row['nationality']}';\n";
echo "document.getElementById('t_sex').value='{$row['sex']}';\n";
echo "document.getElementById('teacherCaste').value='{$row['caste']}';\n";
echo "document.getElementById('t_caste').value='{$row['t_caste']}';\n";
echo "document.getElementById('teacherInsurNo').value='{$row['insurance_no']}';\n";
echo "document.getElementById('teacherPfNo').value='{$row['pf_no']}';\n";
echo "document.getElementById('teacherAcNo').value='{$row['account_no']}';\n";
echo "document.getElementById('teacherTrkNo').value='{$row['trk_no']}';\n";
echo "document.getElementById('teacherLicense').value='{$row['license_no']}';\n";
echo "document.getElementById('disabilityStatus').value='{$row['disability_status']}';\n";
echo "document.getElementById('motherTongue').value='{$row['mother_tongue']}';\n";
echo "document.getElementById('teachingLang').value='{$row['teaching_lang']}';\n";
echo "document.getElementById('t_firstAppType').value='{$row['first_app_type']}';\n";
echo "document.getElementById('t_firstAppYear').value='{$row['first_app_year']}';\n";
echo "document.getElementById('t_firstAppMonth').value='{$row['first_app_month']}';\n";
echo "document.getElementById('t_firstAppDay').value='{$row['first_app_day']}';\n";
echo "document.getElementById('t_firstAppLevel').value='{$row['first_app_level']}';\n";
echo "document.getElementById('firstAppSecSubject').value='{$row['first_app_sec_subject']}';\n";
echo "document.getElementById('t_firstAppRank').value='{$row['first_app_rank']}';\n";
echo "document.getElementById('teachingSub1').value='{$row['teachingSub1']}';\n";
echo "document.getElementById('teachingSub2').value='{$row['teachingSub2']}';\n";
echo "document.getElementById('currPermType').value='{$row['curr_perm_type']}';\n";
echo "document.getElementById('currPermLevel').value='{$row['curr_perm_level']}';\n";
echo "document.getElementById('currPermRank').value='{$row['curr_perm_rank']}';\n";
echo "document.getElementById('t_head_teacher').value='{$row['head_teacher']}';\n";
echo "document.getElementById('headTeachertraining').value='{$row['head_teacher_training']}';\n";
echo "document.getElementById('special_promotion').value='{$row['special_promotion']}';\n";
echo "document.getElementById('current_app_year').value='{$row['current_app_year']}';\n";
echo "document.getElementById('current_app_month').value='{$row['current_app_month']}';\n";
echo "document.getElementById('current_app_day').value='{$row['current_app_day']}';\n";
echo "document.getElementById('bsDobYear1').value='{$row['bs_dob_year1']}';\n";
echo "document.getElementById('bsDobMonth1').value='{$row['bs_dob_month1']}';\n";
echo "document.getElementById('bsDobDay1').value='{$row['bs_dob_day1']}';\n";
echo "document.getElementById('adDobYear1').value='{$row['ad_dob_year1']}';\n";
echo "document.getElementById('adDobMonth1').value='{$row['ad_dob_month1']}';\n";
echo "document.getElementById('adDobDay1').value='{$row['ad_dob_day1']}';\n";
echo "document.getElementById('bsDobYear2').value='{$row['bs_dob_year2']}';\n";
echo "document.getElementById('bsDobMonth2').value='{$row['bs_dob_month2']}';\n";
echo "document.getElementById('bsDobDay2').value='{$row['bs_dob_day2']}';\n";
echo "document.getElementById('adDobYear2').value='{$row['ad_dob_year2']}';\n";
echo "document.getElementById('adDobMonth2').value='{$row['ad_dob_month2']}';\n";
echo "document.getElementById('adDobDay2').value='{$row['ad_dob_day2']}';\n";
echo "document.getElementById('maritalStatus').value='{$row['marital_status']}';\n";
echo "document.getElementById('nofDaughter').value='{$row['nof_daughter']}';\n";
echo "document.getElementById('nofSon').value='{$row['nof_son']}';\n";
echo "document.getElementById('nofTotal').value='{$row['nof_total']}';\n";
echo "document.getElementById('citizenshipNo').value='{$row['citizenship_no']}';\n";
echo "document.getElementById('citizenshipYear').value='{$row['citizenship_year']}';\n";
echo "document.getElementById('citizenshipMonth').value='{$row['citizenship_month']}';\n";
echo "document.getElementById('citizenshipDay').value='{$row['citizenship_day']}';\n";
echo "document.getElementById('citizenshipDistrict').value='{$row['citizenship_dist']}';\n";
echo "document.getElementById('nameFather').value='{$row['name_father']}';\n";
echo "document.getElementById('nameMother').value='{$row['name_mother']}';\n";
echo "document.getElementById('nameSpouse').value='{$row['name_spouse']}';\n";
echo "document.getElementById('nameWillper').value='{$row['name_willper']}';\n";
echo "document.getElementById('permAddrDist').value='{$row['perm_addr_dist']}';\n";
echo "document.getElementById('permAddrVdc').value='{$row['perm_addr_vdc']}';\n";
echo "document.getElementById('permAddrWard').value='{$row['perm_addr_ward']}';\n";
echo "document.getElementById('permAddrLocality').value='{$row['perm_addr_locality']}';\n";
echo "document.getElementById('permAddrHouse').value='{$row['perm_addr_house']}';\n";
echo "document.getElementById('permAddrRegion').value='{$row['perm_addr_region']}';\n";
echo "document.getElementById('permAddrPhone').value='{$row['perm_addr_phone']}';\n";
echo "document.getElementById('permAddrEmail').value='{$row['perm_addr_email']}';\n";
echo "document.getElementById('tempAddrDist').value='{$row['temp_addr_dist']}';\n";
echo "document.getElementById('tempAddrVdc').value='{$row['temp_addr_vdc']}';\n";
echo "document.getElementById('tempAddrWard').value='{$row['temp_addr_ward']}';\n";
echo "document.getElementById('tempAddrLocality').value='{$row['temp_addr_locality']}';\n";
echo "document.getElementById('tempAddrHouse').value='{$row['temp_addr_house']}';\n";
echo "document.getElementById('tempAddrRegion').value='{$row['temp_addr_region']}';\n";
echo "document.getElementById('tempAddrPhone').value='{$row['temp_addr_phone']}';\n";
echo "document.getElementById('tempAddrEmail').value='{$row['temp_addr_email']}';\n";

echo "showTraining(document.getElementById('t_head_teacher'));\n";


//check if head teacher is already set
$result = mysql_query("SELECT distinct(`tmis_sec1`.`tid`) FROM `flash`.`tmis_sec1` join `tmis_main` on (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                       where `tmis_main`.`sch_num`='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and `tmis_sec1`.`head_teacher`='1'"); 

if(mysql_num_rows($result)>0)
{
    $rowData = mysql_fetch_assoc($result);
    if($tid!=$rowData['tid'])
        echo "document.getElementById('t_head_teacher').disabled=true;\n";
    else
        echo "document.getElementById('t_head_teacher').disabled=false;\n";
}
?>

firstApp(document.getElementById('t_firstAppLevel').value);
maritalStat(document.getElementById('maritalStatus').value);

document.getElementById('teacherName').focus();

</script>
</html>
