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
<script src="js/schoolphysical.js" type="text/javascript"></script>
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

 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
    <td colspan="13">Classrooms and Sections</td>
  </tr>
  <tr class="ewTableHeader"> 
    <td>&nbsp;</td>
    <td>ECD</td>
    <td>Class 1</td>
    <td>Class 2</td>
    <td>Class 3</td>
    <td>Class 4</td>
    <td>Class 5</td>
    <td>Class 6</td>
    <td>Class 7</td>
    <td>Class 8</td>
    <td>Class 9</td>
    <td>Class 10</td>
    <td>Total</td>
  </tr>
  <tr> 
    <td>Sections</td>
    <td><input name="sections_0" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_0" size="4" maxlength="4" <?php if ($classes[0]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_1" size="4" maxlength="4" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_2" size="4" maxlength="4" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_3" size="4" maxlength="4" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_4" size="4" maxlength="4" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_5" size="4" maxlength="4" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>		
    <td><input name="sections_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_6" size="4" maxlength="4" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_7" size="4" maxlength="4" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_8" size="4" maxlength="4" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>	
    <td><input name="sections_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_9" size="4" maxlength="4" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="sections_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_10" size="4" maxlength="4" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>		
    <td><input name="sections_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sections_t" size="4" maxlength="4" disabled></td>
  </tr>
  <tr> 
    <td>Classrooms</td>
    <td><input name="classrooms_0" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_0" size="4" maxlength="4" <?php if ($classes[0]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_1" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_1" size="4" maxlength="4" <?php if ($classes[1]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_2" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_2" size="4" maxlength="4" <?php if ($classes[2]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_3" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_3" size="4" maxlength="4" <?php if ($classes[3]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_4" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_4" size="4" maxlength="4" <?php if ($classes[4]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_5" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_5" size="4" maxlength="4" <?php if ($classes[5]==0) echo 'disabled'; ?>></td>		
    <td><input name="classrooms_6" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_6" size="4" maxlength="4" <?php if ($classes[6]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_7" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_7" size="4" maxlength="4" <?php if ($classes[7]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_8" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_8" size="4" maxlength="4" <?php if ($classes[8]==0) echo 'disabled'; ?>></td>	
    <td><input name="classrooms_9" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_9" size="4" maxlength="4" <?php if ($classes[9]==0) echo 'disabled'; ?>></td>
    <td><input name="classrooms_10" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_10" size="4" maxlength="4" <?php if ($classes[10]==0) echo 'disabled'; ?>></td>		
    <td><input name="classrooms_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="classrooms_t" size="4" maxlength="4" disabled></td>
  </tr>
</table>
<br />


 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
 
   <tr> 
      <td width="192" class="ewTableHeader">Total Land&nbsp; </td>
      <td width="689">For Terai: Bigaha
        <input name="land_bigaha" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_bigaha" type="text" size="5" maxlength="4">
        Kattha
        <input name="land_kattha" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_kattha" type="text" size="5" maxlength="4">
        Dhuri 
        <input name="land_dhur" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_dhur" type="text" size="5" maxlength="4">
        <br />For Hill, Mountain and Valley: Ropani
        <input name="land_ropani" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_ropani" type="text" size="5" maxlength="4"> 
        Aana
        <input name="land_aana" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_aana" type="text" size="5" maxlength="4">
        Paisa
        <input name="land_paisa" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_paisa" type="text" size="5" maxlength="4">
        Dam <input name="land_daam" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="land_daam" type="text" size="5" maxlength="4"> 
      </td>
    </tr> 

  <tr> 
    <td width="25%" class="ewTableHeader">Water</td>
    <td>
		<select name="water" id="water" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='water_f' class='divhide'>
      Tap
      <input name="water_tap" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_tap" value="1">
      Tubewell 
      <input name="water_tubewell" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_tubewell" value="2">
      Well
      <input name="water_well" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_well" value="3">
      Other 
      <input name="water_other" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="water_other" value="4">
	  </span>
	  </td>
  </tr> 


  <tr> 
    <td width="25%" class="ewTableHeader">Toilet</td>
    <td>
	<select name="toilet" id="toilet" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='toilet_f' class='divhide'>
      Total
      <input name="t_total" type="text" id="t_total" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      Separate for girls 
      <input name="t_girls" type="text" id="t_girls" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
      
      Common for girls and boys
      <input name="t_all" type="text" id="t_all" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">

      Separate for teachers 
      <input name="t_teachers" type="text" id="t_teachers" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="5" maxlength="4">
	  </span>

	  
	  </td>
  </tr>  
   
  <tr> 
    <td width="25%" class="ewTableHeader">Urinal</td>
    <td>
      	  <select name="urinal" id="urinal" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='urinal_f' class='divhide'>
      Separate for teachers
      <input name="urinal_teachers" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="urinal_teachers" value="1">
      Separate for girls <input name="urinal_girls" onkeypress="generalKeyPress(this,event)" onchange="handleChange(this)" type="checkbox" id="urinal_girls" value="1">
	  </span>

	  
	  </td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">Buildings</td>
    <td>Total 
      <input name="num_buildings" id="num_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      &nbsp;&nbsp;&nbsp;Rigid
      <input name="rigid_buildings" id="rigid_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      &nbsp;&nbsp;&nbsp;Weak
      <input name="weak_buildings" id="weak_buildings" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">

	  </td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">Rooms</td>
    <td>
	  Total
      <input name="classroom_total" id="classroom_total" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
	  Rigid
      <input name="classroom_rigid" id="classroom_rigid" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      &nbsp;&nbsp;&nbsp;Weak
      <input name="classroom_weak" id="classroom_weak" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">

	  </td>
  </tr>     

  
  <tr> 
    <td width="25%" class="ewTableHeader">Total Rooms</td>
    <td>Used
      <input name="rooms_used" id="rooms_used" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      &nbsp;&nbsp;&nbsp;Unused
      <input name="rooms_unused" id="rooms_unused" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
	  </td>
  </tr>  


  <tr> 
    <td width="25%" class="ewTableHeader">New classrooms</td>
    <td>Required
	<select name="additional_rooms" id="additional_rooms" onkeypress="event.which = null; return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='additional_rooms_f' class='divhide'>
      &nbsp;&nbsp;Required rooms 
      <input name="additional_rooms_num" id="additional_rooms_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      &nbsp;&nbsp;Enough Land
      <select name="additional_rooms_land" id="additional_rooms_land" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
      </span>
	  </td>
  </tr>
  
  
  <tr> 
    <td width="25%" class="ewTableHeader">Classrooms reconstruction</td>
    <td>Required
	<select name="reconstruction_rooms" id="reconstruction_rooms" onkeypress="event.which = null; return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='reconstruction_rooms_f' class='divhide'>
      &nbsp;&nbsp;Required rooms 
      <input name="reconstruction_rooms_num" id="reconstruction_rooms_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
      </span>
	  </td>
  </tr> 

    <tr> 
    <td width="25%" class="ewTableHeader">Retrofitting</td>
    <td>Required
	<select name="is_retrofitting" id="is_retrofitting" onkeypress="event.which = null; return generalKeyPress(this, event);" onChange="handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='retrofitting_yes' class='divhide'>
                &nbsp;&nbsp;Required number &nbsp;&nbsp;
                <input name="retrofitting_num" id="retrofitting_num" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" size="4" maxlength="4">
          </span>
	  </td>
  </tr> 

  
  <tr> 
    <td width="25%" class="ewTableHeader">Constructions</td>
    <td>
	
	  
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
				echo "<td><input name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\"> </td>\n";
		  }
		  echo "</tr>\n";
	  }
	  
	  
	  ?>
	  
	  </table>	
		
	</td>
  </tr>   

   <tr> 
    <td width="25%" class="ewTableHeader">Compound</td>
    <td>
	<select name="compound" id="compound" onkeypress="return generalKeyPress(this, event);"  onchange="handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>
	  <span id='compound_f' class='divhide'>
	  &nbsp;&nbsp;&nbsp;&nbsp;Type of Compound
      <select name="cstatus" id="cstatus" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Rigid wall</option>
        <option value="2">Weak wall</option>
        <option value="3">Local Material</option>
        <option value="4">Barbed wire</option>
        <option value="5">Pledge</option>
        <option value="6">Others</option>
      </select>
	  </span>
	  </td>
  </tr>
  
  <tr> 
    <td width="25%" class="ewTableHeader">Desk Bench</td>
    <td>Number of desk-bench 
      <input name="num_desk" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_desk" size="4" maxlength="4">
      &nbsp;&nbsp;Usable 
      <input name="usable_desk_students" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_desk_students" size="4" maxlength="4">
   </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">Inadequate Desk Bench</td>
    <td>
      <input name="inadequate_desk_students" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="inadequate_desk_students" size="4" maxlength="4"></td>
  </tr> 
  <tr> 
    <td width="25%" class="ewTableHeader">Table</td>
    <td>Number of Tables 
      <input name="num_table" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_table" size="4" maxlength="4">
      &nbsp;&nbsp;Usable 
      <input name="usable_table" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_table" size="4" maxlength="4">
  </tr>
              <tr> 
    <td width="25%" class="ewTableHeader">Chairs</td>
    <td>
      Number of Chairs 
      <input name="num_chair" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_chair" size="4" maxlength="4">
      &nbsp;&nbsp;Usable chairs 
      <input name="usable_chair" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="usable_chair" size="4" maxlength="4"></td>
  </tr>
  
  <tr> 
    <td width="25%" class="ewTableHeader">Playground</td>
    <td>
		<select name="pground" id="pground" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	<span id='pground_f' class='divhide'>
      Enough Space
      <select name="pground_enough_space" id="pground_enough_space" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select>      
      </span>
</td>
  </tr>  


  <tr> 
    <td width="25%" class="ewTableHeader">Electricity</td>
    <td>
		<select name="electricity" id="electricity" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
</td>
  </tr> 


  <tr> 
    <td width="25%" class="ewTableHeader">Computer</td>
    <td>Separate Computer Room
	<select name="computer_room" id="computer_room" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='computer_room_f' class='divhide'>
      Total Computers 
      <input name="num_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="num_computers" size="4" maxlength="4">
      For Education 
      <input name="teaching_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="teaching_computers" size="4" maxlength="4">
      For Admin 
      <input name="admin_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="admin_computers" size="4" maxlength="4">
      For Other
      <input name="other_computers" type="text"  onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="other_computers" size="4" maxlength="4">
	  </span>
	  </td>
  </tr> 
  
  <tr> 
    <td width="25%" class="ewTableHeader">Internet Facility</td>
    <td>
	<select name="internet" id="internet" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 
	  <span id='internet_f' class='divhide'>
      For all 
	<select name="internet_all" id="internet_all" onkeypress="return generalKeyPress(this, event);" onChange="return handleChange(this);">
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select> 


	  </span>
	  </td>
  </tr> 

  <tr> 
    <td width="25%" class="ewTableHeader">Test Exam</td>
    <td>
	
	  <table class="ewTable">
		<tr class="ewTableHeader">
			<td rowspan="2">Particulars</td>
			<td colspan="3"><?php echo $currentyear-2; ?></td>
			<td colspan="3"><?php echo $currentyear-1; ?></td>
		</tr>
		<tr class="ewTableHeader">
			<td>F</td>
			<td>M</td>
			<td>T</td>
			<td>F</td>
			<td>M</td>
			<td>T</td>
		</tr>
	  
	  <?php
	  
	  foreach (array("enrollment","slc","slc_pass") as $type){
		  echo "<tr>\n";
		  echo "<td>".ucwords(str_replace("_"," ",$type))."</td>\n";
	      foreach (array("f","m","t") as $source){
				$var = "slc_prev_{$type}_{$source}";
				if ($source=='t') $disabled = "disabled"; else $disabled = "";
				echo "<td><input $disabled name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\"> </td>\n";
		  }
	      foreach (array("f","m","t") as $source){
				$var = "slc_pprev_{$type}_{$source}";
				if ($source=='t') $disabled = "disabled"; else $disabled = "";
				echo "<td><input $disabled name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\"> </td>\n";
		  }
		  echo "</tr>\n";
	  }
	  
	  
	  ?>
	  
	  </table>		
	
		
	</td>
  </tr>   
  
  <tr> 
    <td width="25%" class="ewTableHeader">Higher Secondary</td>
    <td>
	
	
	  <table class="ewTable">
		<tr class="ewTableHeader">
			<td rowspan="2">Particulars</td>
			<td colspan="3"><?php echo $currentyear-2; ?></td>
			<td colspan="3"><?php echo $currentyear-1; ?></td>
		</tr>
		<tr class="ewTableHeader">
			<td>F</td>
			<td>M</td>
			<td>T</td>
			<td>F</td>
			<td>M</td>
			<td>T</td>
		</tr>
	  
	  <?php
	  
	  foreach (array("enrollment","test_appeared","passed") as $type){
		  echo "<tr>\n";
		  echo "<td>".ucwords(str_replace("_"," ",$type))."</td>\n";
	      foreach (array("f","m","t") as $source){
				$var = "hsec_prev_{$type}_{$source}";
				if ($source=='t') $disabled = "disabled"; else $disabled = "";
				echo "<td><input $disabled name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\"> </td>\n";
		  }
	      foreach (array("f","m","t") as $source){
				$var = "hsec_pprev_{$type}_{$source}";
				if ($source=='t') $disabled = "disabled"; else $disabled = "";
				echo "<td><input $disabled name=\"$var\" id=\"$var\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" type=\"text\" size=\"5\" maxlength=\"4\"> </td>\n";
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

// set for autofill
if (isset($_GET['af'])) 
{
    $result = mysql_query("select * from `id_physical_details` where sch_num='$sch_num' and sch_year='$currentyear'");
    if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);


	echo "autoFillEnabled = false;\n";
	
        //autofill total no of classrooms
        echo "document.forms[0]['classrooms_0'].value = '${row['rooms_ecd_total']}';\n";
        echo "document.forms[0]['classrooms_1'].value = '${row['rooms_class1_total']}';\n";
        echo "document.forms[0]['classrooms_2'].value = '${row['rooms_class2_total']}';\n";
        echo "document.forms[0]['classrooms_3'].value = '${row['rooms_class3_total']}';\n";
        echo "document.forms[0]['classrooms_4'].value = '${row['rooms_class4_total']}';\n";
        echo "document.forms[0]['classrooms_5'].value = '${row['rooms_class5_total']}';\n";
        echo "document.forms[0]['classrooms_6'].value = '${row['rooms_class6_total']}';\n";
        echo "document.forms[0]['classrooms_7'].value = '${row['rooms_class7_total']}';\n";
        echo "document.forms[0]['classrooms_8'].value = '${row['rooms_class8_total']}';\n";
        echo "document.forms[0]['classrooms_9'].value = '${row['rooms_class9_total']}';\n";
        echo "document.forms[0]['classrooms_10'].value = '${row['rooms_class10_total']}';\n";
        
        echo "document.forms[0]['land_bigaha'].value = '${row['school_land_bigha']}';\n";
	echo "document.forms[0]['land_kattha'].value = '${row['school_land_kattha']}';\n";
	echo "document.forms[0]['land_dhur'].value = '${row['school_land_dhur']}';\n";
	echo "document.forms[0]['land_ropani'].value = '${row['school_land_ropani']}';\n";
	echo "document.forms[0]['land_aana'].value = '${row['school_land_aana']}';\n";
	echo "document.forms[0]['land_paisa'].value = '${row['school_land_paisa']}';\n";
	echo "document.forms[0]['land_daam'].value = '${row['school_land_dam']}';\n";
        echo "document.forms[0]['water'].value = ".($row['no_water_source']?'1':'2').";\n";
        echo "document.forms[0]['water_tap'].checked = ".(($row['no_water_source']==1)?'true':'false').";\n";
        echo "document.forms[0]['water_tubewell'].checked = ".(($row['no_water_source']==2)?'true':'false').";\n";
        echo "document.forms[0]['water_well'].checked = ".(($row['no_water_source']==3)?'true':'false').";\n";
        echo "document.forms[0]['water_other'].checked = ".(($row['no_water_source']==4)?'true':'false').";\n";
        echo "document.forms[0]['toilet'].value = ".($row['no_total_toilets']?'1':'2').";\n";
	echo "document.forms[0]['t_total'].value = '${row['no_total_toilets']}';\n";
	echo "document.forms[0]['t_girls'].value = '${row['no_girls_toilets']}';\n";
	//echo "document.forms[0]['t_all'].value = '${row['t_all']}';\n";
	echo "document.forms[0]['t_teachers'].value = '${row['no_teachers_toilets']}';\n";
        echo "document.forms[0]['urinal'].value = ".(($row['no_teachers_urinals']||$row['no_students_urinals'])?'1':'2').";\n";
	echo "document.forms[0]['urinal_teachers'].checked = ".($row['no_teachers_urinals']?'true':'false').";\n";
	//echo "document.forms[0]['urinal_girls'].checked = ".($row['urinal_girls']?'true':'false').";\n";
        echo "document.forms[0]['num_buildings'].value = '${row['no_total_buildings']}';\n";
	echo "document.forms[0]['rigid_buildings'].value = '${row['no_pakki_buildings']}';\n";
	echo "document.forms[0]['weak_buildings'].value = '${row['no_kacchi_buildings']}';\n";
        
        $total_rooms=$row['rooms_ecd_total']+$row['rooms_class1_total']+$row['rooms_class2_total']+$row['rooms_class3_total']+$row['rooms_class4_total']+$row['rooms_class5_total']+$row['rooms_class6_total']+$row['rooms_class7_total']+$row['rooms_class8_total']+$row['rooms_class9_total']+$row['rooms_class10_total']+$row['rooms_class11_total']+$row['rooms_class12_total'];
        $pakki_rooms=$row['rooms_ecd_pakki']+$row['rooms_class1_pakki']+$row['rooms_class2_pakki']+$row['rooms_class3_pakki']+$row['rooms_class4_pakki']+$row['rooms_class5_pakki']+$row['rooms_class6_pakki']+$row['rooms_class7_pakki']+$row['rooms_class8_pakki']+$row['rooms_class9_pakki']+$row['rooms_class10_pakki']+$row['rooms_class11_pakki']+$row['rooms_class12_pakki'];
	echo "document.forms[0]['classroom_total'].value = ".($total_rooms).";\n";
	echo "document.forms[0]['classroom_rigid'].value = ".($pakki_rooms).";\n";
	echo "document.forms[0]['classroom_weak'].value = ".($total_rooms-$pakki_rooms).";\n";
        echo "document.forms[0]['is_retrofitting'].value = ".($row['no_retrofitting']?'1':'2').";\n";
        echo "document.forms[0]['retrofitting_num'].value = '${row['no_retrofitting']}';\n";
        echo "document.forms[0]['reconstruction_rooms'].value = ".($row['no_rehabilitation']?'1':'2').";\n";
	echo "document.forms[0]['reconstruction_rooms_num'].value = '${row['no_rehabilitation']}';\n";
        
        
        echo "document.forms[0]['compound'].value = ".($row['compound_type']?'1':'2').";\n";
        if($row['compound_type']==1)    echo "document.forms[0]['cstatus'].value = '2';\n";
        elseif($row['compound_type']==2)    echo "document.forms[0]['cstatus'].value = '1';\n"; 
        elseif($row['compound_type']==3)    echo "document.forms[0]['cstatus'].value = '4';\n"; 
        elseif($row['compound_type']==4)    echo "document.forms[0]['cstatus'].value = '3';\n"; 
        elseif($row['compound_type']==5)    echo "document.forms[0]['cstatus'].value = '5';\n"; 
        elseif($row['compound_type']==6)    echo "document.forms[0]['cstatus'].value = '6';\n"; 
        
        echo "document.forms[0]['pground'].value = ".($row['playground_status']?'1':'2').";\n";
	echo "document.forms[0]['pground_enough_space'].value = ".($row['enough_space']?'1':'2').";\n";
	echo "document.forms[0]['electricity'].value = ".($row['electricity_status']?'1':'2').";\n";
	echo "document.forms[0]['computer_room'].value = ".($row['no_computers_total']?'1':'2').";\n";
	echo "document.forms[0]['num_computers'].value = '${row['no_computers_total']}';\n";
	echo "document.forms[0]['teaching_computers'].value = '${row['no_computers_teaching']}';\n";
	echo "document.forms[0]['admin_computers'].value = '${row['no_computers_learning']}';\n";
	echo "document.forms[0]['internet'].value = '${row['internet_status']}';\n";
	
        /*
	
        echo "document.forms[0]['additional_rooms'].value = '${row['additional_rooms']}';\n";
	echo "document.forms[0]['additional_rooms_num'].value = '${row['additional_rooms_num']}';\n";
	echo "document.forms[0]['additional_rooms_land'].value = '${row['additional_rooms_land']}';\n";
	echo "document.forms[0]['num_desk'].value = '${row['num_desk']}';\n";
	echo "document.forms[0]['usable_desk_students'].value = '${row['usable_desk_students']}';\n";
	echo "document.forms[0]['inadequate_desk_students'].value = '${row['inadequate_desk_students']}';\n";
	echo "document.forms[0]['num_table'].value = '${row['num_table']}';\n";
	echo "document.forms[0]['usable_table'].value = '${row['usable_table']}';\n";
	echo "document.forms[0]['num_chair'].value = '${row['num_chair']}';\n";
	echo "document.forms[0]['usable_chair'].value = '${row['usable_chair']}';\n";
        */
    }
    
    //now the school improvement until now
    $result=mysql_query("select 
                                SUM(new_building_deo) as new_building_deo, 
                                SUM(new_building_ddc) as new_building_ddc, 
                                SUM(new_building_others) as new_building_others, 
                                SUM(new_room_deo) as new_room_deo, 
                                SUM(new_room_ddc) as new_room_ddc, 
                                SUM(new_room_others) as new_room_others, 
                                SUM(rehab_building_deo) as rehab_building_deo, 
                                SUM(rehab_building_ddc) as rehab_building_ddc, 
                                SUM(rehab_building_others) as rehab_building_others, 
                                SUM(rehab_room_deo) as rehab_room_deo, 
                                SUM(rehab_room_ddc) as rehab_room_ddc, 
                                SUM(rehab_room_others) as rehab_room_others, 
                                SUM(total_toilets_deo) as total_toilets_deo, 
                                SUM(total_toilets_ddc) as total_toilets_ddc, 
                                SUM(total_toilets_others) as total_toilets_others, 
                                SUM(girls_toilets_deo) as girls_toilets_deo, 
                                SUM(girls_toilets_ddc) as girls_toilets_ddc, 
                                SUM(girls_toilets_others) as girls_toilets_others, 
                                SUM(water_deo) as water_deo, 
                                SUM(water_ddc) as water_ddc, 
                                SUM(water_others) as water_others 
                                from `id_physical_details` where sch_num='$sch_num';");
     if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);
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
     }
}


// classrooms and sections
for ($i=0;$i<=10;$i++){
	
	$result = mysql_query("select * from sections where sch_num='$sch_num' and sch_year='$currentyear' and class='$i'");
	if (mysql_num_rows($result)==0) continue;
	
	$row = mysql_fetch_array($result);
	
	echo "document.forms[0]['sections_$i'].value = '${row['sections']}';\n";	
	echo "document.forms[0]['classrooms_$i'].value = '${row['classrooms']}';\n";	
}


// school construction
$result = mysql_query("select * from school_construction where sch_num='$sch_num' and sch_year='$currentyear'");
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

// school exam
$result = mysql_query("select * from school_exam where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$row = mysql_fetch_array($result);	
	
	echo "autoFillEnabled = false;\n";

	foreach (array("enrollment","slc","slc_pass") as $type){
	  foreach (array("f","m","t") as $source){
			$var = "slc_prev_{$type}_{$source}";
			echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
	  }
	  foreach (array("f","m","t") as $source){
			$var = "slc_pprev_{$type}_{$source}";
			echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
	  }
	}

	foreach (array("enrollment","test_appeared","passed") as $type){
	  foreach (array("f","m","t") as $source){
			$var = "hsec_prev_{$type}_{$source}";
			echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
	  }
	  foreach (array("f","m","t") as $source){
			$var = "hsec_pprev_{$type}_{$source}";
			echo "document.forms[0]['$var'].value = '{$row[$var]}';\n";
	  }
	}	


}


?>

handleChange(document.forms[0]['land_bigaha']);
handleChange(document.forms[0]['land_kattha']);
handleChange(document.forms[0]['land_dhur']);
handleChange(document.forms[0]['land_ropani']);
handleChange(document.forms[0]['land_aana']);
handleChange(document.forms[0]['land_paisa']);
handleChange(document.forms[0]['land_daam']);
handleChange(document.forms[0]['water']);
handleChange(document.forms[0]['water_tap']);
handleChange(document.forms[0]['water_tubewell']);
handleChange(document.forms[0]['water_well']);
handleChange(document.forms[0]['water_other']);
handleChange(document.forms[0]['toilet']);
handleChange(document.forms[0]['t_total']);
handleChange(document.forms[0]['t_girls']);
handleChange(document.forms[0]['t_all']);
handleChange(document.forms[0]['t_teachers']);
handleChange(document.forms[0]['urinal']);
handleChange(document.forms[0]['urinal_teachers']);
handleChange(document.forms[0]['urinal_girls']);
handleChange(document.forms[0]['num_buildings']);
handleChange(document.forms[0]['rigid_buildings']);
handleChange(document.forms[0]['weak_buildings']);
handleChange(document.forms[0]['classroom_total']);
handleChange(document.forms[0]['classroom_rigid']);
handleChange(document.forms[0]['classroom_weak']);
handleChange(document.forms[0]['rooms_used']);
handleChange(document.forms[0]['rooms_unused']);
handleChange(document.forms[0]['additional_rooms']);
handleChange(document.forms[0]['additional_rooms_num']);
handleChange(document.forms[0]['additional_rooms_land']);
handleChange(document.forms[0]['reconstruction_rooms']);
handleChange(document.forms[0]['is_retrofitting']);
handleChange(document.forms[0]['reconstruction_rooms_num']);
handleChange(document.forms[0]['compound']);
handleChange(document.forms[0]['cstatus']);
handleChange(document.forms[0]['num_desk']);
handleChange(document.forms[0]['usable_desk_students']);
handleChange(document.forms[0]['inadequate_desk_students']);
handleChange(document.forms[0]['num_table']);
handleChange(document.forms[0]['usable_table']);
handleChange(document.forms[0]['num_chair']);
handleChange(document.forms[0]['usable_chair']);
handleChange(document.forms[0]['pground']);
handleChange(document.forms[0]['pground_enough_space']);
handleChange(document.forms[0]['electricity']);
handleChange(document.forms[0]['computer_room']);
handleChange(document.forms[0]['num_computers']);
handleChange(document.forms[0]['teaching_computers']);
handleChange(document.forms[0]['admin_computers']);
handleChange(document.forms[0]['other_computers']);
handleChange(document.forms[0]['internet']);
handleChange(document.forms[0]['internet_all']);

handleChange(document.forms[0]['sections_0']);
handleChange(document.forms[0]['classrooms_0']);



</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
