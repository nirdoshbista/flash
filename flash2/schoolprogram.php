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
<title>Flash II</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/schoolprogram.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>

</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash2.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

</p>
<form action="controller.php" method="post">
	
  <table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
    <tr> 
      <td width="192" class="ewTableHeader">Government Fund&nbsp;</td>
      <td width="689"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
          <tr> 
            <td>First Quad: </td>
            <td>First Month 
              <input type="checkbox" name="govt_funds_q1_1st" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q1_1st" value="1"></td>
            <td>Second Month 
              <input type="checkbox" name="govt_funds_q1_2nd" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q1_2nd" value="1"></td>
            <td>Third Month 
              <input type="checkbox" name="govt_funds_q1_3rd" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q1_3rd" value="1"></td>
            <td>Fourth Month 
              <input type="checkbox" name="govt_funds_q1_4th" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q1_4th" value="1"> </td>
          </tr>
          <tr> 
            <td>Second Quad: </td>
            <td>First Month 
              <input type="checkbox" name="govt_funds_q2_1st" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q2_1st" value="1"></td>
            <td>Second Month 
              <input type="checkbox" name="govt_funds_q2_2nd" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q2_2nd" value="1"></td>
            <td>Third Month 
              <input type="checkbox" name="govt_funds_q2_3rd" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q2_3rd" value="1"></td>
            <td>Fourth Month 
              <input type="checkbox" name="govt_funds_q2_4th" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="govt_funds_q2_4th" value="1"> </td>
          </tr>
        </table>
       </td>
    </tr>
  
    <tr> 
      <td width="192" class="ewTableHeader">School Improvement Plan</td>
        <td width="689"> 
          <select name="school_improve_plan" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="school_improve_plan">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
          <span id="school_improve_plan_f" class='divhide'>
			&nbsp;&nbsp;&nbsp;&nbsp;First time (year) <input type="text" size="4" maxlength="4" name="school_improve_plan_date" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="school_improve_plan_date">
			&nbsp;&nbsp;&nbsp;&nbsp;Updated (year) <input type="text" size="4" maxlength="4" name="school_improve_plan_date_updated" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="school_improve_plan_date_updated">
		  </span>
		  </td>
    </tr> 
    
    <tr> 
      <td width="192" class="ewTableHeader">Social Audit</td>
        <td width="689"><select name="social_audit" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="social_audit">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="social_audit_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;Year <input type="text" size="4" maxlength="4" name="social_audit_year" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="social_audit_year">
		  &nbsp;&nbsp;&nbsp;Month 
		  <select  name='social_audit_month' id='social_audit_month' onkeypress="return generalKeyPress(this, event);" >
		  <option value=''></option>
		  <option value='1'>Baisakh</option>
		  <option value='2'>Jyestha</option>
		  <option value='3'>Ashad</option>
		  <option value='4'>Shrawan</option>
		  <option value='5'>Bhadra</option>
		  <option value='6'>Ashoj</option>
		  <option value='7'>Kartik</option>
		  <option value='8'>Mangsir</option>
		  <option value='9'>Poush</option>
		  <option value='10'>Magh</option>
		  <option value='11'>Falgun</option>
		  <option value='12'>Chaitra</option>
		  
		  </select>
		  &nbsp;&nbsp;&nbsp;Day <input type="text" size="4" maxlength="4" name="social_audit_day" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="social_audit_day">
		</span>
		</td>
    </tr>  
    
     <tr> 
      <td width="192" class="ewTableHeader">Audit</td>
        <td width="689"><select name="public_disclose_acc" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="public_disclose_acc">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="public_disclose_acc_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;Year <input type="text" size="4" maxlength="4" name="public_disclose_acc_year" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="public_disclose_acc_year">
		  &nbsp;&nbsp;&nbsp;Month 
		  <select  name='public_disclose_acc_month' id='public_disclose_acc_month' onkeypress="return generalKeyPress(this, event);" >
		  <option value=''></option>
		  <option value='1'>Baisakh</option>
		  <option value='2'>Jyestha</option>
		  <option value='3'>Ashad</option>
		  <option value='4'>Shrawan</option>
		  <option value='5'>Bhadra</option>
		  <option value='6'>Ashoj</option>
		  <option value='7'>Kartik</option>
		  <option value='8'>Mangsir</option>
		  <option value='9'>Poush</option>
		  <option value='10'>Magh</option>
		  <option value='11'>Falgun</option>
		  <option value='12'>Chaitra</option>
		  
		  </select>
		  &nbsp;&nbsp;&nbsp;Day <input type="text" size="4" maxlength="4" name="public_disclose_acc_day" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="public_disclose_acc_day">
		</span>
		</td>
    </tr>  
         
    <tr> 
      <td width="192" class="ewTableHeader">Standardization of the
        School</td>
      <td width="689"><select name="standardization" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="standardization">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="standardization_f" class='divhide'>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level 
          <select  name="standardization_level" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="standardization_level">
            <option value="0">N/A</option>
            <option value="1">Ka</option>
            <option value="2">Kha</option>
            <option value="3">Ga</option>
            <option value="4">Gha</option>
          </select>
		  </span>
		  </td>
    </tr>    
    
    <tr> 
      <td width="192" class="ewTableHeader">Grant Amount</td>
      <td width="689">
		  
		  <table class="ewTable">
			<tr class="ewTableHeader">
				<td>Type</td>
				<td>Primary</td>
				<td>L.Sec.</td>
				<td>Sec.</td>
			</tr>
			<tr>
				<td class="ewTableHeader">Books</td>
				<td><input name="pri_books" id="pri_books" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="lsec_books" id="lsec_books" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="sec_books" id="sec_books" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>

			</tr>
			<tr>
				<td class="ewTableHeader">Scholarship</td>
				<td><input name="pri_scholarship" id="pri_scholarship" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="lsec_scholarship" id="lsec_scholarship" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="sec_scholarship" id="sec_scholarship" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				
			</tr>
			<tr>
				<td class="ewTableHeader">PCF</td>
				<td><input name="pri_pcf" id="pri_pcf" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="lsec_pcf" id="lsec_pcf" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="sec_pcf" id="sec_pcf" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>

			</tr>
			<tr>
				<td class="ewTableHeader">Student Evaluation</td>
				<td><input name="pri_student_evaluation" id="pri_student_evaluation" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="lsec_student_evaluation" id="lsec_student_evaluation" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="sec_student_evaluation" id="sec_student_evaluation" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>


			</tr>
			<tr>
				<td class="ewTableHeader">Misc.</td>
				<td><input name="pri_misc" id="pri_misc" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="lsec_misc" id="lsec_misc" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>
				<td><input name="sec_misc" id="sec_misc" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" type="text" size="10" maxlength="10"> </td>

			</tr>
		  </table>
	  
	  
	  </td>
    </tr>     
    
    <tr> 
      <td width="192" class="ewTableHeader">School Management and
        Community Status</td>
      <td width="689"><select name="sch_mgmt_transferred" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="sch_mgmt_transferred">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="sch_mgmt_transferred_f" class='divhide'>

		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: 
          <input  name="mgmt_transferred_year" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="mgmt_transferred_year" type="text" size="5" maxlength="4">
          Level 
          <select  name="mgmt_transferred_level" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="mgmt_transferred_level">
            <option value="0">N/A</option>
            <option value="1">Primary</option>
            <option value="2">Lower Secondary</option>
            <option value="3">Secondary</option>
            <option value="4">Higher Secondary</option>
          </select>
		  </span>
		  </td>
    </tr>
    
    <tr> 
      <td width="192" class="ewTableHeader">School Improvement</td>
      <td width="689">
	  
	  <table class="ewTable">
		<tr class="ewTableHeader">
			<td>Type</td>
			<td>DEO</td>
			<td>Local</td>
			<td>Others</td>
		</tr>
	  
	  <?php
	  
	  foreach (array("new_building","new_classrooms","recon_building","recon_classrooms","toilet","toilet_girls","water") as $type){
		  echo "<tr>\n";
		  echo "<td>".ucwords(str_replace("_"," ",$type))."</td>\n";
	      foreach (array("deo","local","others") as $source){
				$var = "{$type}_{$source}";
				echo "<td><input name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"6\" maxlength=\"10\"> </td>\n";
		  }
		  echo "</tr>\n";
	  }
	  
	  
	  ?>
	  
	  </table>
	  
	  
	  </td>
    </tr> 
    
    <tr> 
      <td width="192" class="ewTableHeader">School Operational
        Calendar</td>
      <td width="689"><select name="sch_oper_cal" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="sch_oper_cal">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="sch_oper_cal_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If yes, dissemination of information 
          thru: distribution 
          <input  type="checkbox" name="diss_calendar" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="diss_calendar" value="1"> &nbsp;&nbsp;
        Notice 
        <input  type="checkbox" name="diss_notice" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="diss_notice" value="1"> &nbsp;&nbsp;Others 
        <input  type="checkbox" name="diss_others" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="diss_others" value="1">
		</span>
	
		
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">Calendar Details</td>
      <td width="689">
	  
	  <table class="ewTable">
		<tr class="ewTableHeader">
			<td>Type</td>
			<td>Planned</td>
			<td>Actual</td>
		</tr>
	  
	  <?php
	  
	  foreach (array("open_days","teaching","exams","eca","holidays","festivals","others") as $type){
		  echo "<tr>\n";
		  echo "<td>".ucwords(str_replace("_"," ",$type))."</td>\n";
	      foreach (array("planned","actual") as $source){
				$var = "{$type}_{$source}";
				echo "<td><input name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"3\"> </td>\n";
		  }
		  echo "</tr>\n";
	  }
	  
	  
	  ?>
	  
	  </table>	  
	  
	  </td>
    </tr> 

    <tr> 
      <td width="192" class="ewTableHeader">SMC Meetings</td>
      <td width="689">Total 
        <input name="smc_meetings" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="smc_meetings" type="text" size="5" maxlength="3"></td>
    </tr>
    
    <tr> 
      <td width="192" class="ewTableHeader">External Monitoring</td>
      <td width="689">Total 
        <input name="monitor_total" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_total" type="text" size="5" maxlength="3">
        Resource Person 
        <input name="monitor_rp" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_rp" type="text" size="5" maxlength="3">
        School Supervisor <input name="monitor_ss" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_ss" type="text" size="5" maxlength="3">
        District Education Officer <input name="monitor_gco" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_gco" type="text" size="5" maxlength="3">
        DoE / DEO <input name="monitor_deo" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_deo" type="text" size="5" maxlength="3">
        Others <input name="monitor_others" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="monitor_others" type="text" size="5" maxlength="3"> 
      </td>
    </tr>
    
    <tr> 
      <td width="192" class="ewTableHeader">Medical Facility</td>
      <td width="689"><select name="health_facility" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="health_facility">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="health_facility_f" class='divhide'>
			<select  name="health_distance" onkeypress="return generalKeyPress(this, event);" id="health_distance">
            <option value="0">N/A</option>
            <option value="1">Half Hour walk</option>
            <option value="2">One Hour walk</option>
            <option value="2">More than one hour walk</option>
          </select> 		  
 
		</span>
		
		</td>
    </tr>     
      
    
    <tr> 
      <td width="192" class="ewTableHeader">Children Club</td>
      <td width="689"><select name="children_club" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="children_club">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		</td>
    </tr>      
    <tr> 
      <td width="192" class="ewTableHeader">Worm Medicine</td>
      <td width="689"><select name="worm_medicine" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="worm_medicine">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		</td>
    </tr>      
    <tr> 
      <td width="192" class="ewTableHeader">First Aid</td>
      <td width="689"><select name="first_aid" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="first_aid">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		</td>
    </tr>      

    <tr> 
      <td width="192" class="ewTableHeader">Text Books</td>
      <td width="689">
	  
	  <table class="ewTable">
		<tr class="ewTableHeader">
			<td>Type</td>
			<td>Primary</td>
			<td>L.Sec.</td>
			<td>Sec.</td>
			<td>H.Sec.</td>
		</tr>
	  
	  <?php
	  
	  foreach (array("textbook","teaching_manual","child_material","book_corner","library","library_books","local_curriculum","local_curriculum_usage") as $type){
		  echo "<tr>\n";
		  echo "<td>".ucwords(str_replace("_"," ",$type))."</td>\n";
	      foreach (array("pri","lsec","sec","hsec") as $source){
				$var = "{$type}_{$source}";
				
				$disabled = "";
				if (($type=='child_material' || $type=='book_corner') && $source!='pri') $disabled = "disabled";
				if (($type=='local_curriculum' || $type=='local_curriculum_usage') && $source=='hsec') $disabled = "disabled";
				
				if ($type=='library'){
					echo "<td><input name=\"$var\" id=\"$var\" value='1' type=\"checkbox\" $disabled> </td>\n";
				}
				else{
					echo "<td><input name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\" $disabled> </td>\n";
				}
		  }
		  echo "</tr>\n";
	  }
	  
	  
	  ?>
	  
	  </table>	  
	  
	  </td>
    </tr> 
      
  </table>
	
	
</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

// load data

<?php

$result = mysql_query("select * from school_program where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);


	echo "autoFillEnabled = false;\n";
	
	echo "document.forms[0]['govt_funds_q1_1st'].checked = ".($row['govt_funds_q1_1st']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_2nd'].checked = ".($row['govt_funds_q1_2nd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_3rd'].checked = ".($row['govt_funds_q1_3rd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_4th'].checked = ".($row['govt_funds_q1_4th']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_1st'].checked = ".($row['govt_funds_q2_1st']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_2nd'].checked = ".($row['govt_funds_q2_2nd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_3rd'].checked = ".($row['govt_funds_q2_3rd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_4th'].checked = ".($row['govt_funds_q2_4th']?'true':'false').";\n";
	echo "document.forms[0]['school_improve_plan'].value = '${row['school_improve_plan']}';\n";
	echo "document.forms[0]['school_improve_plan_date'].value = '${row['school_improve_plan_date']}';\n";
	echo "document.forms[0]['school_improve_plan_date_updated'].value = '${row['school_improve_plan_date_updated']}';\n";
	echo "document.forms[0]['social_audit'].value = '${row['social_audit']}';\n";
	echo "document.forms[0]['social_audit_year'].value = '${row['social_audit_year']}';\n";
	echo "document.forms[0]['social_audit_month'].value = '${row['social_audit_month']}';\n";
	echo "document.forms[0]['social_audit_day'].value = '${row['social_audit_day']}';\n";
	echo "document.forms[0]['public_disclose_acc'].value = '${row['public_disclose_acc']}';\n";
	echo "document.forms[0]['public_disclose_acc_year'].value = '${row['public_disclose_acc_year']}';\n";
	echo "document.forms[0]['public_disclose_acc_month'].value = '${row['public_disclose_acc_month']}';\n";
	echo "document.forms[0]['public_disclose_acc_day'].value = '${row['public_disclose_acc_day']}';\n";
	echo "document.forms[0]['standardization'].value = '${row['standardization']}';\n";
	echo "document.forms[0]['standardization_level'].value = '${row['standardization_level']}';\n";
	echo "document.forms[0]['sch_mgmt_transferred'].value = '${row['sch_mgmt_transferred']}';\n";
	echo "document.forms[0]['mgmt_transferred_year'].value = '${row['mgmt_transferred_year']}';\n";
	echo "document.forms[0]['mgmt_transferred_level'].value = '${row['mgmt_transferred_level']}';\n";
	echo "document.forms[0]['sch_oper_cal'].value = '${row['sch_oper_cal']}';\n";
	echo "document.forms[0]['diss_calendar'].checked = ".($row['diss_calendar']?'true':'false').";\n";
	echo "document.forms[0]['diss_notice'].checked = ".($row['diss_notice']?'true':'false').";\n";
	echo "document.forms[0]['diss_others'].checked = ".($row['diss_others']?'true':'false').";\n";
	echo "document.forms[0]['smc_meetings'].value = '${row['smc_meetings']}';\n";
	echo "document.forms[0]['monitor_total'].value = '${row['monitor_total']}';\n";
	echo "document.forms[0]['monitor_rp'].value = '${row['monitor_rp']}';\n";
	echo "document.forms[0]['monitor_ss'].value = '${row['monitor_ss']}';\n";
	echo "document.forms[0]['monitor_gco'].value = '${row['monitor_gco']}';\n";
	echo "document.forms[0]['monitor_deo'].value = '${row['monitor_deo']}';\n";
	echo "document.forms[0]['monitor_others'].value = '${row['monitor_others']}';\n";
	echo "document.forms[0]['health_facility'].value = '${row['health_facility']}';\n";
	echo "document.forms[0]['health_distance'].value = '${row['health_distance']}';\n";
	echo "document.forms[0]['children_club'].value = '${row['children_club']}';\n";
	echo "document.forms[0]['worm_medicine'].value = '${row['worm_medicine']}';\n";
	echo "document.forms[0]['first_aid'].value = '${row['first_aid']}';\n";	

	
}

// grant amount
$result = mysql_query("select * from school_grant where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);


	echo "autoFillEnabled = false;\n";
	echo "document.forms[0]['pri_books'].value = '${row['pri_books']}';\n";
	echo "document.forms[0]['pri_scholarship'].value = '${row['pri_scholarship']}';\n";
	echo "document.forms[0]['pri_pcf'].value = '${row['pri_pcf']}';\n";
	echo "document.forms[0]['pri_student_evaluation'].value = '${row['pri_student_evaluation']}';\n";
	echo "document.forms[0]['pri_misc'].value = '${row['pri_misc']}';\n";
	echo "document.forms[0]['lsec_books'].value = '${row['lsec_books']}';\n";
	echo "document.forms[0]['lsec_scholarship'].value = '${row['lsec_scholarship']}';\n";
	echo "document.forms[0]['lsec_pcf'].value = '${row['lsec_pcf']}';\n";
	echo "document.forms[0]['lsec_student_evaluation'].value = '${row['lsec_student_evaluation']}';\n";
	echo "document.forms[0]['lsec_misc'].value = '${row['lsec_misc']}';\n";
	echo "document.forms[0]['sec_books'].value = '${row['sec_books']}';\n";
	echo "document.forms[0]['sec_scholarship'].value = '${row['sec_scholarship']}';\n";
	echo "document.forms[0]['sec_pcf'].value = '${row['sec_pcf']}';\n";
	echo "document.forms[0]['sec_student_evaluation'].value = '${row['sec_student_evaluation']}';\n";
	echo "document.forms[0]['sec_misc'].value = '${row['sec_misc']}';\n";
}


// school improvement
$result = mysql_query("select * from school_improvement where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "autoFillEnabled = false;\n";
	foreach (array("new_building","new_classrooms","recon_building","recon_classrooms","toilet","toilet_girls","water") as $type){
	  foreach (array("deo","local","others") as $source){
			$var = "{$type}_{$source}";
			echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
	  }
	}
}

// school calendar
$result = mysql_query("select * from school_calendar where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "autoFillEnabled = false;\n";
	
	  foreach (array("open_days","teaching","exams","eca","holidays","festivals","others") as $type){
	      foreach (array("planned","actual") as $source){
				$var = "{$type}_{$source}";
				echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
		  }
	  }
}

// school textbooks
$result = mysql_query("select * from school_textbook where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "autoFillEnabled = false;\n";
	
	foreach (array("textbook","teaching_manual","child_material","book_corner","library","library_books","local_curriculum","local_curriculum_usage") as $type){
	  foreach (array("pri","lsec","sec","hsec") as $source){
			$var = "{$type}_{$source}";
			
			if ($type=='library'){
				if ($row[$var]==1) echo "document.forms[0]['$var'].checked = true;\n";		
			}
			else{
				echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";		
			}
	  }
	}
}


// set for autofill
if (isset($_GET['af']))
{
    $result = mysql_query("select * from `id_physical_details` where sch_num='$sch_num' and sch_year='$currentyear'");
    if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);


	echo "autoFillEnabled = false;\n";
	
	echo "document.forms[0]['govt_funds_q1_1st'].checked = ".($row['govt_funds_q1_1st']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_2nd'].checked = ".($row['govt_funds_q1_2nd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_3rd'].checked = ".($row['govt_funds_q1_3rd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q1_4th'].checked = ".($row['govt_funds_q1_4th']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_1st'].checked = ".($row['govt_funds_q2_1st']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_2nd'].checked = ".($row['govt_funds_q2_2nd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_3rd'].checked = ".($row['govt_funds_q2_3rd']?'true':'false').";\n";
	echo "document.forms[0]['govt_funds_q2_4th'].checked = ".($row['govt_funds_q2_4th']?'true':'false').";\n";
        
        echo "document.forms[0]['school_improve_plan'].value = ".($row['sip_updated_date']?'1':'2').";\n";
        if ($row['sip_updated_date'])  
        {
            $sip_updated=explode("/",$row['sip_updated_date']);
            echo "document.forms[0]['school_improve_plan_date_updated'].value = '$sip_updated[2]';\n";
           
        }
        
	echo "document.forms[0]['social_audit'].value = ".($row['social_audit_date']?'1':'2').";\n";
        if ($row['social_audit_date'])  
        {
            $social_audit_date=explode("/",$row['social_audit_date']);
            echo "document.forms[0]['social_audit_year'].value = '$social_audit_date[2]';\n";
            echo "document.forms[0]['social_audit_month'].value = '".(int)$social_audit_date[1]."';\n";
            echo "document.forms[0]['social_audit_day'].value = '".(int)$social_audit_date[0]."';\n";
        }
        
        echo "document.forms[0]['public_disclose_acc'].value = ".($row['financial_audit_date']?'1':'2').";\n";
        if ($row['financial_audit_date'])  
        {
            $financial_audit_date=explode("/",$row['financial_audit_date']);
            echo "document.forms[0]['public_disclose_acc_year'].value = '$financial_audit_date[2]';\n";
            echo "document.forms[0]['public_disclose_acc_month'].value = '".(int)$financial_audit_date[1]."';\n";
            echo "document.forms[0]['public_disclose_acc_day'].value = '".(int)$financial_audit_date[0]."';\n";
        }
        
        //now the grant status
        echo "document.forms[0]['pri_books'].value = '${row['grant_books_pri']}';\n";
        echo "document.forms[0]['lsec_books'].value = '${row['grant_books_lsec']}';\n";
        echo "document.forms[0]['sec_books'].value = '${row['grant_books_sec']}';\n";
        echo "document.forms[0]['pri_scholarship'].value = '${row['grant_sch_pri']}';\n";
        echo "document.forms[0]['lsec_scholarship'].value = '${row['grant_sch_lsec']}';\n";
        echo "document.forms[0]['sec_scholarship'].value = '${row['grant_sch_sec']}';\n";
        echo "document.forms[0]['pri_pcf'].value = '${row['grant_pcf_pri']}';\n";
        echo "document.forms[0]['lsec_pcf'].value = '${row['grant_pcf_lsec']}';\n";
        echo "document.forms[0]['sec_pcf'].value = '${row['grant_pcf_sec']}';\n";
	echo "document.forms[0]['pri_student_evaluation'].value = '${row['grant_cas_pri']}';\n";
        echo "document.forms[0]['lsec_student_evaluation'].value = '${row['grant_cas_lsec']}';\n";
        echo "document.forms[0]['sec_student_evaluation'].value = '${row['grant_cas_sec']}';\n";
        echo "document.forms[0]['pri_misc'].value = '${row['grant_operation_pri']}';\n";
        echo "document.forms[0]['lsec_misc'].value = '${row['grant_operation_lsec']}';\n";
        echo "document.forms[0]['sec_misc'].value = '${row['grant_operation_sec']}';\n";
        
        //now the school improvement
        echo "document.forms[0]['new_building_deo'].value = '${row['new_building_deo']}';\n";
        echo "document.forms[0]['new_building_local'].value = '${row['new_building_ddc']}';\n";
        echo "document.forms[0]['new_building_others'].value = '${row['new_building_others']}';\n";
        echo "document.forms[0]['new_classrooms_deo'].value = '${row['new_room_deo']}';\n";
        echo "document.forms[0]['new_classrooms_local'].value = '${row['new_room_ddc']}';\n";
        echo "document.forms[0]['new_classrooms_others'].value = '${row['new_room_others']}';\n";
        echo "document.forms[0]['recon_building_deo'].value = '${row['rehab_building_deo']}';\n";
        echo "document.forms[0]['recon_building_local'].value = '${row['rehab_building_ddc']}';\n";
        echo "document.forms[0]['recon_building_others'].value = '${row['rehab_building_others']}';\n";
        echo "document.forms[0]['recon_classrooms_deo'].value = '${row['rehab_room_deo']}';\n";
        echo "document.forms[0]['recon_classrooms_local'].value = '${row['rehab_room_ddc']}';\n";
        echo "document.forms[0]['recon_classrooms_others'].value = '${row['rehab_room_others']}';\n";
        echo "document.forms[0]['toilet_deo'].value = '${row['total_toilets_deo']}';\n";
        echo "document.forms[0]['toilet_local'].value = '${row['total_toilets_ddc']}';\n";
        echo "document.forms[0]['toilet_others'].value = '${row['total_toilets_others']}';\n";
        echo "document.forms[0]['toilet_girls_deo'].value = '${row['girls_toilets_deo']}';\n";
        echo "document.forms[0]['toilet_girls_local'].value = '${row['girls_toilets_ddc']}';\n";
        echo "document.forms[0]['toilet_girls_others'].value = '${row['girls_toilets_others']}';\n";
        echo "document.forms[0]['water_deo'].value = '${row['water_deo']}';\n";
        echo "document.forms[0]['water_local'].value = '${row['water_ddc']}';\n";
        echo "document.forms[0]['water_others'].value = '${row['water_others']}';\n";
        
        //now the school calender
        echo "document.forms[0]['sch_oper_cal'].value = ".($row['schoolopen_planneddays']?'1':'2').";\n";
        echo "document.forms[0]['open_days_planned'].value = '${row['schoolopen_planneddays']}';\n";
        echo "document.forms[0]['open_days_actual'].value = '${row['schoolopen_actualdays']}';\n";
        echo "document.forms[0]['teaching_planned'].value = '${row['teaching_planneddays']}';\n";
        echo "document.forms[0]['teaching_actual'].value = '${row['teaching_actualdays']}';\n";
        echo "document.forms[0]['exams_planned'].value = '${row['exam_planneddays']}';\n";
        echo "document.forms[0]['exams_actual'].value = '${row['exam_actualdays']}';\n";
        echo "document.forms[0]['eca_planned'].value = '${row['curricular_planneddays']}';\n";
        echo "document.forms[0]['eca_actual'].value = '${row['curricular_actualdays']}';\n";
        echo "document.forms[0]['holidays_planned'].value = '${row['public_holidays_planned']}';\n";
        echo "document.forms[0]['holidays_actual'].value = '${row['public_holidays_actual']}';\n";
        echo "document.forms[0]['festivals_planned'].value = '${row['festivals_planneddays']}';\n";
        echo "document.forms[0]['festivals_actual'].value = '${row['festivals_actualdays']}';\n";
        echo "document.forms[0]['others_planned'].value = '${row['others_planneddays']}';\n";
        echo "document.forms[0]['others_actual'].value = '${row['others_actualdays']}';\n";
        
        //now the meetings,monitoring and health stuff
        echo "document.forms[0]['smc_meetings'].value = '${row['no_smc_meeting']}';\n";
        echo "document.forms[0]['monitor_total'].value = ".($row['ext_monitor_rp']+$row['ext_monitor_ss']+$row['ext_monitor_deo']+
                                                                    $row['ext_monitor_doe']+$row['ext_monitor_others']).";\n";
        echo "document.forms[0]['monitor_rp'].value = '${row['ext_monitor_rp']}';\n";
        echo "document.forms[0]['monitor_ss'].value = '${row['ext_monitor_ss']}';\n";
        echo "document.forms[0]['monitor_gco'].value = '${row['ext_monitor_deo']}';\n";
        echo "document.forms[0]['monitor_deo'].value = '${row['ext_monitor_doe']}';\n";
        echo "document.forms[0]['monitor_others'].value = '${row['ext_monitor_others']}';\n";
        echo "document.forms[0]['health_facility'].value = ".($row['medical_distance']?'2':'3').";\n";
	//echo "document.forms[0]['health_distance'].value = '${row['health_distance']}';\n";
	echo "document.forms[0]['children_club'].value = ".($row['child_club']?'2':'3').";\n";
	echo "document.forms[0]['first_aid'].value = ".($row['first_aid']?'2':'3').";\n";
       
        //finally the textbooks and teaching materials
        echo "document.forms[0]['textbook_pri'].value = '${row['textbook_pri']}';\n";
        echo "document.forms[0]['textbook_lsec'].value = '${row['textbook_lsec']}';\n";
        echo "document.forms[0]['textbook_sec'].value = '${row['textbook_sec']}';\n";
        echo "document.forms[0]['textbook_hsec'].value = '${row['textbook_hsec']}';\n";
        echo "document.forms[0]['teaching_manual_pri'].value = '${row['teachingmanual_pri']}';\n";
        echo "document.forms[0]['teaching_manual_lsec'].value = '${row['teachingmanual_lsec']}';\n";
        echo "document.forms[0]['teaching_manual_sec'].value = '${row['teachingmanual_sec']}';\n";
        echo "document.forms[0]['teaching_manual_hsec'].value = '${row['teachingmanual_hsec']}';\n";
        echo "document.forms[0]['child_material_pri'].value = '${row['childmaterial_pri']}';\n";
        echo "document.forms[0]['child_material_lsec'].value = '${row['childmaterial_lsec']}';\n";
        echo "document.forms[0]['child_material_sec'].value = '${row['childmaterial_sec']}';\n";
        echo "document.forms[0]['child_material_hsec'].value = '${row['childmaterial_hsec']}';\n";
        echo "document.forms[0]['book_corner_pri'].value = '${row['bookcorner_pri']}';\n";
        echo "document.forms[0]['book_corner_lsec'].value = '${row['bookcorner_lsec']}';\n";
        echo "document.forms[0]['book_corner_sec'].value = '${row['bookcorner_sec']}';\n";
        echo "document.forms[0]['book_corner_hsec'].value = '${row['bookcorner_hsec']}';\n";
        
        //no of books is autofilled in primary only
        echo "document.forms[0]['library_pri'].checked = ".($row['no_books_library']?'true':'false').";\n";
        echo "document.forms[0]['library_books_pri'].value = ".($row['no_books_library']?$row['no_books_library']:'').";\n";

        echo "document.forms[0]['local_curriculum_pri'].value = '${row['localcurr_pri']}';\n";
        echo "document.forms[0]['local_curriculum_lsec'].value = '${row['localcurr_lsec']}';\n";
        echo "document.forms[0]['local_curriculum_sec'].value = '${row['localcurr_sec']}';\n";
        echo "document.forms[0]['local_curriculum_hsec'].value = '${row['localcurr_hsec']}';\n";
        
        
	echo "document.forms[0]['standardization'].value = '${row['standardization']}';\n";
	echo "document.forms[0]['standardization_level'].value = '${row['standardization_level']}';\n";
	echo "document.forms[0]['sch_mgmt_transferred'].value = '${row['sch_mgmt_transferred']}';\n";
	echo "document.forms[0]['mgmt_transferred_year'].value = '${row['mgmt_transferred_year']}';\n";
	echo "document.forms[0]['mgmt_transferred_level'].value = '${row['mgmt_transferred_level']}';\n";
	echo "document.forms[0]['diss_calendar'].checked = ".($row['diss_calendar']?'true':'false').";\n";
	echo "document.forms[0]['diss_notice'].checked = ".($row['diss_notice']?'true':'false').";\n";
	echo "document.forms[0]['diss_others'].checked = ".($row['diss_others']?'true':'false').";\n";
}
}

?>

handleChange(document.forms[0]['govt_funds_q1_1st']);
handleChange(document.forms[0]['govt_funds_q1_2nd']);
handleChange(document.forms[0]['govt_funds_q1_3rd']);
handleChange(document.forms[0]['govt_funds_q1_4th']);
handleChange(document.forms[0]['govt_funds_q2_1st']);
handleChange(document.forms[0]['govt_funds_q2_2nd']);
handleChange(document.forms[0]['govt_funds_q2_3rd']);
handleChange(document.forms[0]['govt_funds_q2_4th']);
handleChange(document.forms[0]['school_improve_plan']);
handleChange(document.forms[0]['school_improve_plan_date']);
handleChange(document.forms[0]['school_improve_plan_date_updated']);
handleChange(document.forms[0]['social_audit']);
handleChange(document.forms[0]['social_audit_year']);
handleChange(document.forms[0]['social_audit_month']);
handleChange(document.forms[0]['social_audit_day']);
handleChange(document.forms[0]['public_disclose_acc']);
handleChange(document.forms[0]['public_disclose_acc_year']);
handleChange(document.forms[0]['public_disclose_acc_month']);
handleChange(document.forms[0]['public_disclose_acc_day']);
handleChange(document.forms[0]['standardization']);
handleChange(document.forms[0]['standardization_level']);
handleChange(document.forms[0]['sch_mgmt_transferred']);
handleChange(document.forms[0]['mgmt_transferred_year']);
handleChange(document.forms[0]['mgmt_transferred_level']);
handleChange(document.forms[0]['sch_oper_cal']);
handleChange(document.forms[0]['diss_calendar']);
handleChange(document.forms[0]['diss_notice']);
handleChange(document.forms[0]['diss_others']);
handleChange(document.forms[0]['smc_meetings']);
handleChange(document.forms[0]['monitor_total']);
handleChange(document.forms[0]['monitor_rp']);
handleChange(document.forms[0]['monitor_ss']);
handleChange(document.forms[0]['monitor_gco']);
handleChange(document.forms[0]['monitor_deo']);
handleChange(document.forms[0]['monitor_others']);
handleChange(document.forms[0]['health_facility']);
handleChange(document.forms[0]['health_distance']);
handleChange(document.forms[0]['children_club']);
handleChange(document.forms[0]['worm_medicine']);
handleChange(document.forms[0]['first_aid']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
