<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Achievement</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style_flash.css" rel="stylesheet" type="text/css">

<style>
input:disabled, select:disabled{
	background-color: #fff;
	color:#000;
}
</style>
<script>

function handleChange(obj){
	return false;
}

function handleKeyDown(obj, event){
	return false
}

function schoolTypeV(obj){

	return false;
		

}

</script>


</head>

<body>
<div align="center">
  <p><img src="images/dle.png"></p>
</div>
<br>
<form action="controller.php" method="post">
<table width="100%" border="0" cellpadding="0">
  <tr> 
    <td> 
    <table width="100%" border="0" cellpadding="5" class='ewTable'>
        <tr valign="bottom" class='ewTableAltRow'> 
          <td>Estd. Date (YYYY-MM-DD)<br />
          <input disabled name='estd_y' id='estd_y'  onchange="return handleChange(this);" type="text" size="5" maxlength="4" />
          <input disabled name='estd_m' id='estd_m'  onchange="return handleChange(this);" type="text" size="3" maxlength="2" />
          <input disabled name='estd_d' id='estd_d'  onchange="return handleChange(this);" type="text" size="3" maxlength="2" />
           </td>
          <td>Address<br> <input disabled name="sch_add"  onchange="return false;" type="text" id="sch_add" size="25" maxlength="50"></td>
          <td>Ward<br> <input disabled name="sch_ward"  onchange="return false;" type="text" id="sch_ward" size="5" maxlength="2"></td>
          <td>Region<br> <select disabled name="sch_region"  onchange="return false;" id="sch_region">
              <option value="0"> </option>
              <option value="1"> Rural </option>
              <option value="2"> Urban </option>
            </select></td>
          <td>Phone<br> <input disabled name="sch_phone"  onchange="return false;" type="text" id="sch_phone" size="15" maxlength="10"></td>
          <td>Email<br> <input disabled name="sch_email"  onchange="return false;" type="text" id="sch_email" size="25" maxlength="30"></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="ewTable">
  <tr class="ewTableHeader"> 
    <td width="22%" rowspan="2"> <div class="c4"> School Type </div></td>
    <td colspan="13">Running Classes</td>
  </tr>
  <tr> 
    <td width="6%" class="ewTableHeader"> <div class="c4"> ECD </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 1 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 2 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 3 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 4 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 5 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 6 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 7 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 8 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 9 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 10 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 11 </div></td>
    <td width="6%" class="ewTableHeader"> <div class="c4"> 12 </div></td>
  </tr>
  <tr class="ewTableRow"> 
    <td width="22%"> <div class="c4"> <strong>Community (Aided)</strong> </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_0" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_1" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_2" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_3" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_4" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_5" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_6" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_7" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_8" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_9" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_10" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_11" value="1">
      </div></td>
    <td width="6%"> <div class="c4"> 
        <input type="checkbox" name="st_1_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_1_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableAltRow"> 
    <td width="22%"> <div class="c4"> <strong>Community (Managed)</strong> </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_2_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_2_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableRow"> 
    <td width="22%"> <div class="c4"> <strong>Community (Teacher Aid)</strong> </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_3_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_3_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableAltRow"> 
    <td width="22%"> <div class="c4"> <strong>Community (Unaided)</strong> 
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_4_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_4_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableRow"> 
    <td width="22%"> <div class="c4"> <strong>Institutional (Private)</strong> 
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_5_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_5_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableAltRow"> 
    <td width="22%"> <div class="c4"> <strong>Institutional (Public)</strong> 
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_6_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_6_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableRow"> 
    <td> <div class="c4"> <strong>Institutional (Company)</strong> </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_7_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_7_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableAltRow"> 
    <td> <div class="c4"> <strong>Madrasa</strong> </div></td>
   <td> <div class="c4"> 
        <input type="checkbox" name="st_8_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_0" value="1">
      </div></td>
   <td> <div class="c4"> 
        <input type="checkbox" name="st_8_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_8_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_8_12" value="1">
      </div></td>
  </tr>
  <tr class="ewTableRow"> 
    <td> <div class="c4"> <strong>Gumba</strong> </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_9_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_9_12" value="1">
      </div></td>
  </tr>

  <tr class="ewTableAltRow"> 
    <td> <div class="c4"> <strong>Aashram</strong> </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_6" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_7" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_8" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_9" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_10" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_11" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_10_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_10_12" value="1">
      </div></td>
  </tr>

  
  <tr class="ewTableRow"> 
    <td> <div class="c4"> <strong>SOP / FSP</strong> </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_0" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_1" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_2" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_3" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_4" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_5" value="1">
      </div></td>
    <td> <div class="c4"> 
        <input type="checkbox" name="st_11_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_6" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_7" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_8" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_9" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_10" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_11" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_11_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_11_12" value="1">
      </div></td>
  </tr>

  <tr class="ewTableAltRow"> 
    <td> <div class="c4"> <strong>Community ECD</strong> </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input type="checkbox" name="st_12_0" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_0" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_1" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_1" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_2" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_2" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_3" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_3" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_4" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_4" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_5" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_5" value="1">
      </div></td>
    <td class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_6" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_6" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_7" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_7" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_8" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_8" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_9" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_9" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_10" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_10" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_11" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_11" value="1">
      </div></td>
    <td  class='ewTableAltRow'> <div class="c4"> 
        <input disabled type="checkbox" name="st_12_12" onclick="return schoolTypeV(this);" onkeydown="return handleKeyDown(this,event);" id="st_12_12" value="1">
      </div></td>
  </tr>
  
  </table>

</form>

<p>&nbsp;</p>

<form action="entry.php" method="get" style='padding-right:10px; margin-top:-10px;'>
<p align='right'>
<input type="hidden" name="s" id='s' value='<?php echo $_GET['s']; ?>' />
<input type="hidden" name="c" id='c' value='<?php echo $_GET['c']; ?>' />
<input type='submit' value="Next >>" id='submitbtn'>
</p>
</form>


<script>

<?php

$result=mysql_query("select * from mast_schoollist where sch_num='$sch_num' and flash1='1' order by sch_year desc",$flashdblink);

if (mysql_num_rows($result)==0) $result=mysql_query("select * from mast_schoollist where sch_num='$sch_num' order by sch_year desc",$flashdblink);

$row = mysql_fetch_array($result);

$estddate = explode("-",$row['estd_date']);
echo "document.getElementById('estd_y').value='{$estddate[0]}';\n";
echo "document.getElementById('estd_m').value='{$estddate[1]}';\n";
echo "document.getElementById('estd_d').value='{$estddate[2]}';\n";

echo "document.getElementById('sch_add').value='${row['location']}';\n";
echo "document.getElementById('sch_ward').value='${row['wardno']}';\n";
echo "document.getElementById('sch_region').value = '${row['region']}';\n";
echo "document.getElementById('sch_phone').value='${row['telno']}';\n";
echo "document.getElementById('sch_email').value='${row['email']}';\n";


$result = mysql_query("SELECT * FROM mast_school_type WHERE sch_num='$sch_num' ORDER BY sch_year DESC", $flashdblink);
$c = mysql_fetch_assoc($result);

for ($i=0;$i<=12;$i++){
	$classname = ($i?"class$i":"ecd");
	if ($c[$classname]) echo "document.forms[0]['st_{$c[$classname]}_{$i}'].checked = true;\n";
}

?>

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
