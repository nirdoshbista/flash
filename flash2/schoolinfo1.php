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
<script src="js/schoolinfo1.js" type="text/javascript"></script>
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
      <td width="689"> <table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
          <tr> 
            <td>First Quad: </td>
            <td>First Month 
              <input type="checkbox" name="i1_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_1" value="1"></td>
            <td>Second Month 
              <input type="checkbox" name="i1_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_2" value="1"></td>
            <td>Third Month 
              <input type="checkbox" name="i1_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_3" value="1"></td>
            <td>Fourth Month 
              <input type="checkbox" name="i1_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_4" value="1"> </td>
          </tr>
          <tr> 
            <td>Second Quad: </td>
            <td>First Month 
              <input type="checkbox" name="i1_5" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_5" value="1"></td>
            <td>Second Month 
              <input type="checkbox" name="i1_6" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_6" value="1"></td>
            <td>Third Month 
              <input type="checkbox" name="i1_7" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_7" value="1"></td>
            <td>Fourth Month 
              <input type="checkbox" name="i1_8" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i1_8" value="1"> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">School Improvement Plan</td>
        <td width="689"> 
          <select name="i2_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="i2_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="i2_f" class='divhide'>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First timer or not? 
          <select name="i2_2" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this);" id="i2_2">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
			</span>	  
		  </td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">3.&nbsp; Social Audit</td>
        <td width="689"><select name="i3_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i3_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i3_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month 
		  <select  name='i3_2' id='i3_2' onkeypress="return generalKeyPress(this, event);" >
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
		  

        Day 
        <input  name="i3_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i3_3" type="text" size="3" maxlength="2">
		</span>
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">4.&nbsp; Public Disclose of
        Income/Expenditure</td>
      <td width="689"><select name="i4_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i4_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i4_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month 
		  <select  name='i4_2' id='i4_2' onkeypress="return generalKeyPress(this, event);" >
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
		  
        Day 
        <input  name="i4_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i4_3" type="text" size="3" maxlength="2">
		</span>
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">5.&nbsp; Standardization of the
        School</td>
      <td width="689"><select name="i5_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i5_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="i5_f" class='divhide'>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level 
          <select  name="i5_2" onkeypress="return generalKeyPress(this, event);" onchange="d2V(this);" id="i5_2" disabled>
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
      <td width="192" class="ewTableHeader">6.&nbsp; Government Grant Status</td>
      <td width="689"><select name="i6_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i6_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i6_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount 
          <input  name="i6_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i6_2" type="text" size="10" maxlength="7">
		  </span>
		  </td>
    </tr>
     <tr> 
      <td width="192" class="ewTableHeader">7.&nbsp; Student Grant</td>
      <td width="689">Amount <input name="i7_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i7_1" type="text" size="10" maxlength="7">
		  </span>
		  </td>
    </tr>   
    
    <tr> 
      <td width="192" class="ewTableHeader">8.&nbsp; School Management and
        Community Status</td>
      <td width="689"><select name="i8_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i8_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="i8_f" class='divhide'>

		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year: 
          <input  name="i8_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i8_2" type="text" size="5" maxlength="4">
          Level 
          <select  name="i8_3" onkeypress="return generalKeyPress(this, event);" onchange="d2V(this);" id="i8_3">
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
      <td width="192" class="ewTableHeader">9.&nbsp; Construction of New Rooms</td>
      <td width="689"><select name="i9_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i9_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
		  <span id="i9_f" class='divhide'>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Through DEO 
          <input  name="i9_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i9_2" type="text" size="3" maxlength="2"> &nbsp;&nbsp; 
        &nbsp;Through community and other organizations <input  name="i9_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i9_3" type="text" size="3" maxlength="2">
		</span>
		
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">10.&nbsp; Rehabilitation of
        Classrooms</td>
      <td width="689"><select name="i10_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i10_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i10_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Through DEO 
          <input  name="i10_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i10_2" type="text" size="3" maxlength="2"> &nbsp;&nbsp; 
        &nbsp;Through community and other organizations 
        <input  name="i10_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i10_3" type="text" size="3" maxlength="2">
		</span>
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">11.&nbsp; Fencing of School
        Environment </td>
      <td width="689"><select name="i11_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i11_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i11_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Through DEO 
          <input  type="checkbox" name="i11_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i11_2" value="1"> &nbsp;&nbsp;
        Through local resources 
        <input  type="checkbox" name="i11_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i11_3" value="1">  &nbsp;&nbsp;Through
        other organizations 
        <input  type="checkbox" name="i11_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i11_4" value="1">
		</span>
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">12.&nbsp; Toilets</td>
      <td width="689"><select name="i12_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i12_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i12_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Through DEO 
          <input  type="checkbox" name="i12_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i12_2" value="1"> &nbsp;&nbsp;
        Through local resources 
        <input  type="checkbox" name="i12_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i12_3" value="1">  &nbsp;&nbsp;Through
        other organizations <input  type="checkbox" name="i12_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i12_4" value="1">
		</span>
		
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">13.&nbsp; Drinking Water Facilities</td>
      <td width="689"><select name="i13_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i13_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i13_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Through DEO 
          <input  type="checkbox" name="i13_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i13_2" value="1"> &nbsp;&nbsp;
        Through local resources 
        <input  type="checkbox" name="i13_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i13_3" value="1">  &nbsp;&nbsp;Through
        other organizations 
        <input  type="checkbox" name="i13_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i13_4" value="1">
		</span>
		</td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">14.&nbsp; School Operational
        Calendar</td>
      <td width="689"><select name="i14_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i14_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i14_f" class='divhide'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If yes, dissemination of information 
          thru: distribution 
          <input  type="checkbox" name="i14_2" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i14_2" value="1"> &nbsp;&nbsp;
        Notice 
        <input  type="checkbox" name="i14_3" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i14_3" value="1"> &nbsp;&nbsp;Others 
        <input  type="checkbox" name="i14_4" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="i14_4" value="1">
		</span>
	
		
		</td>
    </tr>
   <tr> 
      <td width="192" class="ewTableHeader">15.&nbsp; School Activities&nbsp; </td>
      <td width="689">school opening days
        <input name="i15_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_1" type="text" size="5" maxlength="3">
        Teaching 
        <input name="i15_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_2" type="text" size="5" maxlength="3">
        Exams 
        <input name="i15_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_3" type="text" size="5" maxlength="3">
        Extra Curriculum Activities 
        <input name="i15_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_4" type="text" size="5" maxlength="3"> Public Holidays 
        <input name="i15_5" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_5" type="text" size="5" maxlength="3">
        Local Festivals 
        <input name="i15_6" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_6" type="text" size="5" maxlength="3">
        Others <input name="i15_7" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i15_7" type="text" size="5" maxlength="3"> 
      </td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">16.&nbsp; School Activities (in
        details)</td>
      <td width="689">School opening days <input name="i16_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i16_1" type="text" size="5" maxlength="3">
        Teaching <input name="i16_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i16_2" type="text" size="5" maxlength="3">
        Extra Curriculum Activities 
        <input name="i16_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i16_3" type="text" size="5" maxlength="3"> </td>
    </tr>    

    <tr> 
      <td width="192" class="ewTableHeader">17. SMC Meetings</td>
      <td width="689">Total 
        <input name="i17_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i17_1" type="text" size="5" maxlength="3"></td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">18. External Monitoring</td>
      <td width="689">Total 
        <input name="i18_1" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i18_1" type="text" size="5" maxlength="3">
        Resource Person 
        <input name="i18_2" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i18_2" type="text" size="5" maxlength="3">
        School Supervisor <input name="i18_3" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i18_3" type="text" size="5" maxlength="3">
        Others <input name="i18_4" onkeypress="return forceNumberInput(this, event);" onchange="d2V(this);" id="i18_4" type="text" size="5" maxlength="3"> 
      </td>
    </tr>
    <tr> 
      <td width="192" class="ewTableHeader">19.&nbsp; Medical Facility</td>
      <td width="689"><select name="i19_1" onkeypress="return generalKeyPress(this, event);" onchange="handleChange(this)" id="i19_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
		  <span id="i19_f" class='divhide'>
			<select  name="i19_2" onkeypress="return generalKeyPress(this, event);" id="i19_2">
            <option value="0">N/A</option>
            <option value="1">Half Hour walk</option>
            <option value="2">One Hour walk</option>
            <option value="2">More than one hour walk</option>
          </select> 		  
 
		</span>
		
		</td>
    </tr>  
    
    <tr> 
      <td width="192" class="ewTableHeader">20.1.&nbsp; Curriculum</td>
      <td width="689">
      Primary Level	
      <select name="i20_1_1" onkeypress="return generalKeyPress(this, event);" id="i20_1_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Lower Secondary Level	
      <select name="i20_1_2" onkeypress="return generalKeyPress(this, event);" id="i20_1_2">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Secondary Level	
      <select name="i20_1_3" onkeypress="return generalKeyPress(this, event);" id="i20_1_3">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      H.Secondary Level	
      <select name="i20_1_4" onkeypress="return generalKeyPress(this, event);" id="i20_1_4">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 		
		</td>
    </tr>       
     <tr> 
      <td width="192" class="ewTableHeader">20.2.&nbsp; Teachers Manual</td>
      <td width="689">
      Primary Level	
      <select name="i20_2_1" onkeypress="return generalKeyPress(this, event);" id="i20_2_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Lower Secondary Level	
      <select name="i20_2_2" onkeypress="return generalKeyPress(this, event);" id="i20_2_2">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Secondary Level	
      <select name="i20_2_3" onkeypress="return generalKeyPress(this, event);" id="i20_2_3">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      H.Secondary Level	
      <select name="i20_2_4" onkeypress="return generalKeyPress(this, event);" id="i20_2_4">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 		
		</td>
    </tr>    
    <tr> 
      <td width="192" class="ewTableHeader">20.3.&nbsp; Local Curriculum</td>
      <td width="689">
      Primary Level	
      <select name="i20_3_1" onkeypress="return generalKeyPress(this, event);" id="i20_3_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Lower Secondary Level	
      <select name="i20_3_2" onkeypress="return generalKeyPress(this, event);" id="i20_3_2">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Secondary Level	
      <select name="i20_3_3" onkeypress="return generalKeyPress(this, event);" id="i20_3_3">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      H.Secondary Level	
      <select name="i20_3_4" onkeypress="return generalKeyPress(this, event);" id="i20_3_4">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 		
		</td>
    </tr> 
    <tr> 
      <td width="192" class="ewTableHeader">20.4.&nbsp; Usage of Local Curriculum</td>
      <td width="689">
      Primary Level	
      <select name="i20_4_1" onkeypress="return generalKeyPress(this, event);" id="i20_4_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Lower Secondary Level	
      <select name="i20_4_2" onkeypress="return generalKeyPress(this, event);" id="i20_4_2">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Secondary Level	
      <select name="i20_4_3" onkeypress="return generalKeyPress(this, event);" id="i20_4_3">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      H.Secondary Level	
      <select name="i20_4_4" onkeypress="return generalKeyPress(this, event);" id="i20_4_4">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 		
		</td>
    </tr> 

    <tr> 
      <td width="192" class="ewTableHeader">20.5.&nbsp; Library</td>
      <td width="689">
      <select name="i20_5_1" onkeypress="return generalKeyPress(this, event);" id="i20_5_1">
            <option value="0">N/A</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select> 
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

// set for autofill
if (isset($_GET['af'])) $currentyear--;

$result = mysql_query("select * from school_program where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);

	echo "autoFillEnabled = false;\n";
	echo "document.forms[0]['i1_1'].checked = ".($row['govt_funds_q1_1st']?'true':'false').";\n";
	echo "document.forms[0]['i1_2'].checked = ".($row['govt_funds_q1_2nd']?'true':'false').";\n";
	echo "document.forms[0]['i1_3'].checked = ".($row['govt_funds_q1_3rd']?'true':'false').";\n";
	echo "document.forms[0]['i1_4'].checked = ".($row['govt_funds_q1_4th']?'true':'false').";\n";
	echo "document.forms[0]['i1_5'].checked = ".($row['govt_funds_q2_1st']?'true':'false').";\n";
	echo "document.forms[0]['i1_6'].checked = ".($row['govt_funds_q2_2nd']?'true':'false').";\n";
	echo "document.forms[0]['i1_7'].checked = ".($row['govt_funds_q2_3rd']?'true':'false').";\n";
	echo "document.forms[0]['i1_8'].checked = ".($row['govt_funds_q2_4th']?'true':'false').";\n";
	echo "document.forms[0]['i2_1'].value = '${row['school_improve_plan']}';\n";
	echo "document.forms[0]['i2_2'].value = '${row['school_improve_plan_first']}';\n";
	echo "document.forms[0]['i3_1'].value = '${row['social_audit']}';\n";
	echo "document.forms[0]['i3_2'].value = '${row['social_audit_month']}';\n";
	echo "document.forms[0]['i3_3'].value = '${row['social_audit_day']}';\n";
	echo "document.forms[0]['i4_1'].value = '${row['public_disclose_acc']}';\n";
	echo "document.forms[0]['i4_2'].value = '${row['public_disclose_acc_month']}';\n";
	echo "document.forms[0]['i4_3'].value = '${row['public_disclose_acc_day']}';\n";
	echo "document.forms[0]['i5_1'].value = '${row['standardization']}';\n";
	echo "document.forms[0]['i5_2'].value = '${row['standardization_level']}';\n";
	echo "document.forms[0]['i6_1'].value = '${row['govt_grant']}';\n";
	echo "document.forms[0]['i6_2'].value = '${row['grant_amount']}';\n";
	echo "document.forms[0]['i7_1'].value = '${row['per_student_grant']}';\n";
	echo "document.forms[0]['i8_1'].value = '${row['sch_mgmt_transferred']}';\n";
	echo "document.forms[0]['i8_2'].value = '${row['mgmt_transferred_year']}';\n";
	echo "document.forms[0]['i8_3'].value = '${row['mgmt_transferred_level']}';\n";
	echo "document.forms[0]['i9_1'].value = '${row['new_classrooms']}';\n";
	echo "document.forms[0]['i9_2'].value = '${row['new_classrooms_govt']}';\n";
	echo "document.forms[0]['i9_3'].value = '${row['new_classrooms_others']}';\n";
	echo "document.forms[0]['i10_1'].value = '${row['rehab_classrooms']}';\n";
	echo "document.forms[0]['i10_2'].value = '${row['rehab_classrooms_govt']}';\n";
	echo "document.forms[0]['i10_3'].value = '${row['rehab_classrooms_others']}';\n";
	echo "document.forms[0]['i11_1'].value = '${row['school_fence']}';\n";
	echo "document.forms[0]['i11_2'].checked = ".($row['school_fence_govt']?'true':'false').";\n";
	echo "document.forms[0]['i11_3'].checked = ".($row['school_fence_local']?'true':'false').";\n";
	echo "document.forms[0]['i11_4'].checked = ".($row['school_fence_others']?'true':'false').";\n";
	echo "document.forms[0]['i12_1'].value = '${row['school_toilets']}';\n";
	echo "document.forms[0]['i12_2'].checked = ".($row['school_toilets_govt']?'true':'false').";\n";
	echo "document.forms[0]['i12_3'].checked = ".($row['school_toilets_local']?'true':'false').";\n";
	echo "document.forms[0]['i12_4'].checked = ".($row['school_toilets_others']?'true':'false').";\n";
	echo "document.forms[0]['i13_1'].value = '${row['water']}';\n";
	echo "document.forms[0]['i13_2'].checked = ".($row['water_govt']?'true':'false').";\n";
	echo "document.forms[0]['i13_3'].checked = ".($row['water_local']?'true':'false').";\n";
	echo "document.forms[0]['i13_4'].checked = ".($row['water_others']?'true':'false').";\n";
	echo "document.forms[0]['i14_1'].value = '${row['sch_oper_cal']}';\n";
	echo "document.forms[0]['i14_2'].checked = ".($row['diss_calendar']?'true':'false').";\n";
	echo "document.forms[0]['i14_3'].checked = ".($row['diss_notice']?'true':'false').";\n";
	echo "document.forms[0]['i14_4'].checked = ".($row['diss_others']?'true':'false').";\n";
	echo "document.forms[0]['i15_1'].value = '${row['school_open']}';\n";
	echo "document.forms[0]['i15_2'].value = '${row['school_open_teaching']}';\n";
	echo "document.forms[0]['i15_3'].value = '${row['school_open_exams']}';\n";
	echo "document.forms[0]['i15_4'].value = '${row['school_open_eca']}';\n";
	echo "document.forms[0]['i15_5'].value = '${row['school_open_holidays']}';\n";
	echo "document.forms[0]['i15_6'].value = '${row['school_open_festivals']}';\n";
	echo "document.forms[0]['i15_7'].value = '${row['school_open_others']}';\n";
	echo "document.forms[0]['i16_1'].value = '${row['school_act_open']}';\n";
	echo "document.forms[0]['i16_2'].value = '${row['school_act_teaching']}';\n";
	echo "document.forms[0]['i16_3'].value = '${row['school_act_eca']}';\n";
	echo "document.forms[0]['i17_1'].value = '${row['smc_meetings']}';\n";
	echo "document.forms[0]['i18_1'].value = '${row['monitor_total']}';\n";
	echo "document.forms[0]['i18_2'].value = '${row['monitor_rp']}';\n";
	echo "document.forms[0]['i18_3'].value = '${row['monitor_ss']}';\n";
	echo "document.forms[0]['i18_4'].value = '${row['monitor_others']}';\n";
	echo "document.forms[0]['i19_1'].value = '${row['health_facility']}';\n";
	echo "document.forms[0]['i19_2'].value = '${row['health_distance']}';\n";
	echo "document.forms[0]['i20_1_1'].value = '${row['textbook_pri']}';\n";
	echo "document.forms[0]['i20_1_2'].value = '${row['textbook_lsec']}';\n";
	echo "document.forms[0]['i20_1_3'].value = '${row['textbook_sec']}';\n";
	echo "document.forms[0]['i20_1_4'].value = '${row['textbook_hsec']}';\n";
	echo "document.forms[0]['i20_2_1'].value = '${row['teachingmanual_pri']}';\n";
	echo "document.forms[0]['i20_2_2'].value = '${row['teachingmanual_lsec']}';\n";
	echo "document.forms[0]['i20_2_3'].value = '${row['teachingmanual_sec']}';\n";
	echo "document.forms[0]['i20_2_4'].value = '${row['teachingmanual_hsec']}';\n";
	echo "document.forms[0]['i20_3_1'].value = '${row['localcurr_dev_pri']}';\n";
	echo "document.forms[0]['i20_3_2'].value = '${row['localcurr_dev_lsec']}';\n";
	echo "document.forms[0]['i20_3_3'].value = '${row['localcurr_dev_sec']}';\n";
	echo "document.forms[0]['i20_3_4'].value = '${row['localcurr_dev_hsec']}';\n";
	echo "document.forms[0]['i20_4_1'].value = '${row['localcurr_usage_pri']}';\n";
	echo "document.forms[0]['i20_4_2'].value = '${row['localcurr_usage_lsec']}';\n";
	echo "document.forms[0]['i20_4_3'].value = '${row['localcurr_usage_sec']}';\n";
	echo "document.forms[0]['i20_4_4'].value = '${row['localcurr_usage_hsec']}';\n";
	echo "document.forms[0]['i20_5_1'].value = '${row['library']}';\n";

	
}




?>

handleChange(document.forms[0]['i2_1']);
handleChange(document.forms[0]['i3_1']);
handleChange(document.forms[0]['i4_1']);
handleChange(document.forms[0]['i5_1']);
handleChange(document.forms[0]['i6_1']);
handleChange(document.forms[0]['i8_1']);
handleChange(document.forms[0]['i9_1']);
handleChange(document.forms[0]['i10_1']);
handleChange(document.forms[0]['i11_1']);
handleChange(document.forms[0]['i12_1']);
handleChange(document.forms[0]['i13_1']);
handleChange(document.forms[0]['i14_1']);
handleChange(document.forms[0]['i19_1']);

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
