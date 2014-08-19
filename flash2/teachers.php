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
<script src="js/teachers.js" type="text/javascript"></script>
<?php 
	$classes=schoolclasses($sch_num); 

	$levelmap = array();
	$levelmap[1] = 1;
	$levelmap[2] = 6;
	$levelmap[3] = 9;
	$levelmap[4] = 11;
?>

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
	
<p align="center" class="ewGroupName">Headmaster</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr>
    <td width="20%" class="ewTableHeader">Headmaster</td>
    <td>
    Initial Status
    <select onkeypress="return generalKeyPress(this, event);" name="headmaster_initial_status" id="headmaster_initial_status" disabled>
        <option value="0">N/A</option>
        <option value="1">Primary</option>
        <option value="2">L.Sec.</option>
        <option value="3">Sec.</option>
        <option value="4">H.Sec.</option>
      </select>
    
    Sex 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_sex" id="headmaster_sex" disabled>
        <option value="0">N/A</option>
        <option value="1">Male</option>
        <option value="2">Female</option>
      </select>
      Caste 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_caste" id="headmaster_caste" disabled>
        <option value="0">N/A</option>
        <option value="1">Dalit</option>
        <option value="2">Janjati</option>
        <option value="3">Others</option>
      </select>
      Training 
      <select onkeypress="return generalKeyPress(this, event);" name="headmaster_training" id="headmaster_training" disabled>
        <option value="0">N/A</option>
        <option value="1">Yes</option>
        <option value="2">No</option>
      </select></td>
  </tr>
</table>
<br>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class='ewTableHeader'>
		<td colspan="4">PCF</td>
	</tr>
	<tr class="ewTableHeader">
	
		<td colspan="2">Full</td>
		<td colspan="2">Partial</td>
	</tr>
	<tr class="ewTableHeader">
		<td>Pri</td>
		<td>LSec</td>
		<td>Pri</td>
		<td>LSec</td>
	</tr>
	<tr>
		<td><input name="pcf_full_pri" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_pri" size="3" maxlength="3" <?php echo (($classes[1]>=5 && $classes[1]<=8)?'disabled':''); ?>></td>
		<td><input name="pcf_full_lsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_full_lsec" size="3" maxlength="3" <?php echo (($classes[6]>=5 && $classes[6]<=8)?'disabled':''); ?>></td>
		<td><input name="pcf_par_pri" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_pri" size="3" maxlength="3" <?php echo (($classes[9]>=5 && $classes[9]<=8)?'disabled':''); ?>></td>
		<td><input name="pcf_par_lsec" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pcf_par_lsec" size="3" maxlength="3" <?php echo (($classes[11]>=5 && $classes[11]<=8)?'disabled':''); ?>></td>
	</tr>

</table>

<br>	

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class='ewTableHeader'>
		<td colspan="12">Licensed Teachers</td>
	</tr>
	<tr class="ewTableHeader">
	
		<td colspan="3">Primary</td>
		<td colspan="3">L.Sec.</td>
		<td colspan="3">Sec.</td>
		<td colspan="3">H.Sec.</td>
	</tr>
	<tr class="ewTableHeader">
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>T</td>
	</tr>
	<tr>
		<td><input name="pri_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_f" size="3" maxlength="3" <?php echo (($classes[1]>=5 && $classes[1]<=8)?'disabled':''); ?>></td>
		<td><input name="pri_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_m" size="3" maxlength="3" <?php echo (($classes[1]>=5 && $classes[1]<=8)?'disabled':''); ?>></td>
		<td><input disabled name="pri_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="pri_t" size="3" maxlength="3"></td>
		<td><input name="lsec_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_f" size="3" maxlength="3" <?php echo (($classes[6]>=5 && $classes[6]<=8)?'disabled':''); ?>></td>
		<td><input name="lsec_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_m" size="3" maxlength="3" <?php echo (($classes[6]>=5 && $classes[6]<=8)?'disabled':''); ?>></td>
		<td><input disabled name="lsec_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="lsec_t" size="3" maxlength="3"></td>
		<td><input name="sec_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_f" size="3" maxlength="3" <?php echo (($classes[9]>=5 && $classes[9]<=8)?'disabled':''); ?>></td>
		<td><input name="sec_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_m" size="3" maxlength="3" <?php echo (($classes[9]>=5 && $classes[9]<=8)?'disabled':''); ?>></td>
		<td><input disabled name="sec_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="sec_t" size="3" maxlength="3"></td>
		<td><input name="hsec_f" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_f" size="3" maxlength="3" <?php echo (($classes[11]>=5 && $classes[11]<=8)?'disabled':''); ?>></td>
		<td><input name="hsec_m" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_m" size="3" maxlength="3" <?php echo (($classes[11]>=5 && $classes[11]<=8)?'disabled':''); ?>></td>
		<td><input disabled name="hsec_t" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="hsec_t" size="3" maxlength="3"></td>
	</tr>

</table>

<br>	

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class='ewTableHeader'>
		<td colspan="25">Teachers</td>
	</tr>
	<tr class="ewTableHeader">
		<td rowspan="2">Type</td>
		<td colspan="6">Primary</td>
		<td colspan="6">L.Sec.</td>
		<td colspan="6">Sec.</td>
		<td colspan="6">H.Sec.</td>
	</tr>
	<tr class="ewTableHeader">
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
	</tr>

	<?php
	

		
		foreach (array("approved","permanent","temporary","rahat","private","total") as $type){
			echo "<tr>\n";
			
			echo "<td>".ucwords($type)."</td>";
			foreach (array(1,2,3,4) as $level){
				foreach (array("total","female", "male","dalit","janjati","disabled") as $category){
					$id = "{$type}_{$category}[$level]";
					
					if ($type!='approved' && ($category=='total' || $type=='total')) $disabled="disabled"; 
					else{
						if (1/*$type!='private' && ($category=='male' || $category=='female' || $category=='dalit' || $category=='janjati' || $category=='disabled')*/)
							$disabled="disabled"; //else $disabled="";
					}
					
					
					if ($classes[$levelmap[$level]]>=5 && $classes[$levelmap[$level]]<=7 && $type!='private') $disabled="disabled";
					
					if ($classes[$levelmap[$level]] == 0) $disabled = "disabled";
					
					
					echo "<td><input $disabled name=\"$id\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id=\"$id\" size=\"3\" maxlength=\"3\"></td>\n";
					
				}
			}
			
			echo "</tr>\n";
		}
	
	
	?>

</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class='ewTableHeader'>
		<td colspan="25">Teachers Education</td>
	</tr>
	<tr class="ewTableHeader">
		<td rowspan="2">Type</td>
		<td colspan="3">Primary</td>
		<td colspan="3">L.Sec.</td>
		<td colspan="3">Sec.</td>
		<td colspan="3">H.Sec.</td>
	</tr>
	<tr class="ewTableHeader">
		<td>F</td>
		<td>M</td>
		<td>T</td>
		
		<td>F</td>
		<td>M</td>
		<td>T</td>
		
		<td>F</td>
		<td>M</td>
		<td>T</td>
		
		<td>F</td>
		<td>M</td>
		<td>T</td>
	</tr>

	<?php
	
		foreach (array("under_slc"=>"Under SLC","slc"=>"SLC","ia"=>"IA","ba"=>"BA","ma"=>"MA","phd"=>"PhD") as $type=>$label){
			echo "<tr>\n";
			
			echo "<td>".$label."</td>";
			foreach (array(1,2,3,4) as $level){
				foreach (array("f","m", "t") as $category){
					$id = "{$type}_{$category}[$level]";
					
					//if ($category=='t') $disabled="disabled"; else $disabled="";
					
					//if ($classes[$levelmap[$level]] == 0) $disabled = "disabled";
					$disable='disabled';
                                        
					echo "<td><input name=\"$id\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id=\"$id\" size=\"3\" maxlength=\"3\" $disabled></td>\n";
					
				}
			}
			
			echo "</tr>\n";
		}
	
	
	?>

</table>

</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

// load data
<?php

// headmaster
$result=mysql_query("select * from headmaster where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "document.forms[0].elements['headmaster_sex'].value='".$r['headmaster']."';\n";
	echo "document.forms[0].elements['headmaster_initial_status'].value='".$r['hmaster_initial_status']."';\n";
	echo "document.forms[0].elements['headmaster_caste'].value='".$r['hmaster_status']."';\n";
	echo "document.forms[0].elements['headmaster_training'].value='".$r['hmaster_training']."';\n";
}
//pcf
$result=mysql_query("select * from teachers_pcf where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "document.forms[0].elements['pcf_full_pri'].value='".$r['pcf_full_pri']."';\n";
	echo "document.forms[0].elements['pcf_full_lsec'].value='".$r['pcf_full_lsec']."';\n";
	echo "document.forms[0].elements['pcf_par_pri'].value='".$r['pcf_par_pri']."';\n";
	echo "document.forms[0].elements['pcf_par_lsec'].value='".$r['pcf_par_lsec']."';\n";

}


//licensed
$result=mysql_query("select * from teachers_licensed where sch_num='$sch_num' and sch_year='$currentyear'");
if (mysql_num_rows($result)>0){
	$r=mysql_fetch_array($result);

	echo "document.forms[0].elements['pri_f'].value='".$r['pri_f']."';\n";
	echo "document.forms[0].elements['pri_m'].value='".$r['pri_m']."';\n";
	echo "document.forms[0].elements['pri_t'].value='".$r['pri_t']."';\n";
	echo "document.forms[0].elements['lsec_f'].value='".$r['lsec_f']."';\n";
	echo "document.forms[0].elements['lsec_m'].value='".$r['lsec_m']."';\n";
	echo "document.forms[0].elements['lsec_t'].value='".$r['lsec_t']."';\n";
	echo "document.forms[0].elements['sec_f'].value='".$r['sec_f']."';\n";
	echo "document.forms[0].elements['sec_m'].value='".$r['sec_m']."';\n";
	echo "document.forms[0].elements['sec_t'].value='".$r['sec_t']."';\n";
	echo "document.forms[0].elements['hsec_f'].value='".$r['hsec_f']."';\n";
	echo "document.forms[0].elements['hsec_m'].value='".$r['hsec_m']."';\n";
	echo "document.forms[0].elements['hsec_t'].value='".$r['hsec_t']."';\n";

}

// teachers
foreach (array("approved","permanent","temporary","rahat","private","total") as $type){
	foreach (array(1,2,3,4) as $level){
		$result=mysql_query("select * from teachers where sch_num='$sch_num' and sch_year='$currentyear' and type='$type' and level='$level'");
		$r=mysql_fetch_array($result);
		foreach (array("total","female", "male","dalit","janjati","disabled") as $category){
			$id = "{$type}_{$category}[$level]";
			if($r[$category])
                            echo "document.forms[0].elements['$id'].value='".$r[$category]."';\n";
			
		}
	}
}

// teachers education
foreach (array(1,2,3,4) as $level){
	$result=mysql_query("select * from teachers_edu where sch_num='$sch_num' and sch_year='$currentyear' and level='$level'");
	$r=mysql_fetch_array($result);
		
	foreach (array("under_slc"=>"Under SLC","slc"=>"SLC","ia"=>"IA","ba"=>"BA","ma"=>"MA","phd"=>"PhD") as $type=>$label){
		foreach (array("f","m", "t") as $category){
			$id = "{$type}_{$category}[$level]";
			echo "document.forms[0].elements['$id'].value='".$r["{$type}_{$category}"]."';\n";
			
		}
			
	}
} 

//disable licenced teachers
 foreach(array(1=>"pri",2=>"lsec",3=>"sec",4=>"hsec") as $level=>$value)
    {
        foreach(array("f","m","t") as $category)
        {
            $id = "{$value}_{$category}";
            echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
        }
    }
    
// set for autofill
if (isset($_GET['af'])) 
{      
//autofill headmaster
$result = mysql_query("SELECT `tmis_sec1`.`sex` as sex,`tmis_sec1`.`curr_perm_level` as initial_status,`tmis_sec1`.`t_caste` as caste,`tmis_sec1`.`head_teacher_training` as training
                       FROM `flash`.`tmis_sec1` join `tmis_main` on (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                       where `tmis_main`.`sch_num`='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and `tmis_sec1`.`head_teacher`='2'"); 
if (mysql_num_rows($result)>0)
{
	$r=mysql_fetch_array($result);
	echo "document.forms[0].elements['headmaster_sex'].value='".$r['sex']."';\n";
	echo "document.forms[0].elements['headmaster_initial_status'].value='".$r['initial_status']."';\n";
	echo "document.forms[0].elements['headmaster_caste'].value='".$r['caste']."';\n";
	echo "document.forms[0].elements['headmaster_training'].value='".$r['training']."';\n";
}


// autofill from tmis_sec1 
foreach (array(2,3,4,5) as $level)
{
    foreach (array("total","female", "male","dalit","janjati","disabled") as $category)
    {
        $sum=0;
        foreach (array(2=>"permanent",3=>"temporary",4=>"rahat",6=>"private") as $key=>$type)
        {
            if($category=="total")
            {
                $result=mysql_query("select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                     `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'");    
             }
             if($category=="female")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level' 
                                         and `tmis_sec1`.`sex`='2'");       
             }
             if($category=="male")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                        and `tmis_sec1`.`sex`='1'");   
             }
             if($category=="dalit")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                        and `tmis_sec1`.`t_caste`='1'");
             }
             if($category=="janjati")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                        and `tmis_sec1`.`t_caste`='2'");
             }
             if($category=="disabled")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                        and `tmis_sec1`.`disability_status`!='0'");    
             }
             $r=mysql_fetch_array($result);
             $id = "{$type}_{$category}[".($level-1)."]";
             //no point in displaying if count is zero
             if($r["count"])
                echo "document.forms[0].elements['$id'].value='".$r["count"]."';\n";
             //disable all fields except the private teachers field
             if($key!=6)
               echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
             $sum+=$r["count"];
        }
        $id = "total_{$category}[".($level-1)."]";
        //no point in displaying if count is zero
        if($sum)
           echo "document.forms[0].elements['$id'].value='".$sum."';\n";
    }
}


//autofill approved position=permanent+temporary+vacant positions
$approved=array(2,3);
$vacant_name="Vacant";
foreach (array(2,3,4,5) as $level)
{
    foreach (array("total") as $category)
    {
          /*  echo "select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and `tmis_sec1`.`curr_perm_level`='$level'
                                     AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')";
            */if($category=="total")
            {
                $result=mysql_query("select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and `tmis_sec1`.`curr_perm_level`='$level'
                                     AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='2' OR `tmis_sec1`.`curr_perm_type`='3')");    
             }
             /*
             if($category=="female")
             {
                 $result=mysql_query("select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                     `tmis_sec1`.`curr_perm_level`='$level'
                                     AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')
                                      and `tmis_sec1`.`sex`='2'");    
             }
             if($category=="male")
             {
                  $result=mysql_query("select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                     `tmis_sec1`.`curr_perm_level`='$level'
                                     AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')
                                      and `tmis_sec1`.`sex`='1'");    
             }
             if($category=="dalit")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level'
                                        AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')
                                        and `tmis_sec1`.`t_caste`='1'");
             }
             if($category=="janjati")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level'
                                        AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')
                                        and `tmis_sec1`.`t_caste`='2'");
             }
             if($category=="disabled")
             {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level'
                                        AND (`tmis_main`.`t_name`='$vacant_name' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')
                                        and `tmis_sec1`.`disability_status`!='0'");    
             }*/
             $r=mysql_fetch_array($result);
             $id = "approved_{$category}[".($level-1)."]";
             //no point in displaying if count is zero
             if($r["count"])
                echo "document.forms[0].elements['$id'].value='".$r["count"]."';\n";
               echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
        }
}

// autofill teachers education from tmis_edu
foreach (array(2,3,4,5) as $level)
{	
	foreach (array("under_slc"=>'6',"slc"=>'5',"ia"=>'4',"ba"=>'3',"ma"=>'2',"phd"=>'1') as $key=>$type)
        {
		foreach (array("f","m", "t") as $category)
                {
                    if("f"==$category)
                    {
                         $result=mysql_query("select count(*) as count from `flash`.`tmis_educational_info` 
                                              join `tmis_main` on (`tmis_educational_info`.`tid`=`tmis_main`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_main`.`sch_year`)
                                              right join `tmis_sec1` on (`tmis_educational_info`.`tid`=`tmis_sec1`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_sec1`.`sch_year`)
                                              where `tmis_main`.sch_num='$sch_num' and `tmis_main`.sch_year='$currentyear' and curr_perm_level='$level'
                                              and `tmis_educational_info`.`qualification`='$type'
                                              and `tmis_sec1`.`sex`='2'");
                    }
                    if("m"==$category)
                    {
                         $result=mysql_query("select count(*) as count from `flash`.`tmis_educational_info` 
                                              join `tmis_main` on (`tmis_educational_info`.`tid`=`tmis_main`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_main`.`sch_year`)
                                              right join `tmis_sec1` on (`tmis_educational_info`.`tid`=`tmis_sec1`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_sec1`.`sch_year`)
                                              where `tmis_main`.sch_num='$sch_num' and `tmis_main`.sch_year='$currentyear' and curr_perm_level='$level'
                                              and `tmis_educational_info`.`qualification`='$type'
                                              and `tmis_sec1`.`sex`='1'");
                    }
                    if("t"==$category)
                    {
                         $result=mysql_query("select count(*) as count from `flash`.`tmis_educational_info` 
                                              join `tmis_main` on (`tmis_educational_info`.`tid`=`tmis_main`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_main`.`sch_year`)
                                              right join `tmis_sec1` on (`tmis_educational_info`.`tid`=`tmis_sec1`.`tid` and `tmis_educational_info`.`sch_year`=`tmis_sec1`.`sch_year`)
                                              where `tmis_main`.sch_num='$sch_num' and `tmis_main`.sch_year='$currentyear' and curr_perm_level='$level'
                                              and `tmis_educational_info`.`qualification`='$type'");
                    }
                    $r=mysql_fetch_array($result);
                    $id = "{$key}_{$category}[".($level-1)."]";
                    //no point in displaying if count is zero
                    if($r["count"])
                        echo "document.forms[0].elements['$id'].value='".$r["count"]."';\n";
                      echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
                          
		}
			
	}
    }
    
    
    //autofill licensed teachers
    foreach(array(2=>"pri",3=>"lsec",4=>"sec",5=>"hsec") as $level=>$value)
    {
        foreach(array("f","m","t") as $category)
        {
            if("f"==$category)
            {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level' and
                                        `tmis_sec1`.`license_no` is not null
                                         and `tmis_sec1`.`sex`='2'");  
            }
            if("m"==$category)
            {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level' and
                                        `tmis_sec1`.`license_no` is not null
                                         and `tmis_sec1`.`sex`='1'");  
            }
            if("t"==$category)
            {
                $result=mysql_query("select count(*) as count 
                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                        where sch_num='$sch_num' and `tmis_main`.`sch_year`='$currentyear' and 
                                        `tmis_sec1`.`curr_perm_level`='$level' and
                                        `tmis_sec1`.`license_no` is not null"); 
            }
            $r=mysql_fetch_array($result);
            $id = "{$value}_{$category}";
            if($r["count"])
            echo "document.forms[0].elements['$id'].value='".$r["count"]."';\n";
              echo "document.forms[0].elements['$id'].setAttribute('disabled',true);\n";
        }
    }
    //disable all fields after auto fill
    //echo "disableForm();\n";
}

?>

</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
