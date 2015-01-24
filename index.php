<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include 'includes/dbfunctions.php';
include 'includes/vars.php';

if (!isset($currentyear)){
	header("Location: setyear.php");
	die();
}

if (!isset($pageuser)){
	header("Location: createuser.php");
	die();
}

if (!checkcookie()) header("Location: login.php");
	

// update tables
$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

//check if column `center_id` has been added in the `nfe_mast_agency` table of nfec
$result=  mysql_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'nfec' AND TABLE_NAME = 'nfe_mast_agency' AND COLUMN_NAME = 'center_id'");
if(!mysql_num_rows($result))
{
    mysql_query("alter table `nfec`.`nfe_mast_agency` ,add column `center_id` int (6) UNSIGNED ZEROFILL   NOT NULL  after `agency_code`,drop primary key,  add primary key (`dist_code`, `agency_code`, `center_id`, `year` )");
}

// check if db upgrade is required
$result = mysql_query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'nfec';");
if (!mysql_num_rows($result))
{
    header("Location: utils/upgradedb.php");
}


?>

<?php
$db="achievement";
$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link)
die("Couldn't connect to MySQL");
mysql_select_db($db , $link)
or die("Couldn't open $db: ".mysql_error());
if (!columnExists('subjects','sch_year')){
mysql_query("ALTER TABLE subjects ADD COLUMN sch_year int AFTER id");
}
?> 


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div style="position:absolute; top:10px; right:10px;">
<a href="docs/">Documents</a> | <a href="setyear.php">Set Year</a> | <a href="createuser.php">Change password</a> | <a href="logout.php">Logout</a>
</div>
<?php

// calculate current year
@require_once("achievement/nepalicalendar.php");
$cal = new Nepali_Calendar();	

$y = date("Y");
$m = date("n");
$d = date("j");
$nepdate = $cal->eng_to_nep($y,$m,$d);

if ($currentyear != $nepdate['year']) $style = " style='color:red;' "; else $style="";

?>

<table width="900" border="0" cellpadding="10" align="center">
    <td align="left"><img src="images/nepalflag.png"></td>
    <td align="center" <?php echo $style; ?>><img src="images/iemis logo.png" style="width:470;margin-bottom:5px;"><br /><strong><?php echo ($currentyear-1),'/',$currentyear?></strong></td>
    <td align="right"><img src="images/nepalgovt.png"></td>
  </tr>
</table>

<table width="900" border="0" align="center" cellpadding="20" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142" class='ewListAdd'> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr align="center" valign="top">
          <td width="50%"><table width="100%" border="0" cellpadding="10" cellspacing="0" class="ewTable" style="background: white;">
              <tr align="center" valign="bottom"> 
                <td colspan="2"><font color="#003366" size="4"><strong><br>
                  Data Entry</strong></font></td>
              </tr>
              <tr align="center" valign="middle"> 
                <td width="90"><img src="images/entry.png" border="0"></td>
                <td align="left">	
                        <nav class="main_nav data-entry">
                                            <ul>
                                                <li class="item-0">
                                                    <a href="javascript:void(0);">Flash</a>
                                                    <ul>
                                                        <li>
                                                            <a href="flash1/">Flash I</a>
                                                        </li>
                                                        <li>
                                                            <a href="flash2/">Flash II</a>
                                                        </li>
                                                    </ul>
                                                </li>    
                                                <li  class="item-0">
                                                   <a href="tmis/">TMIS</a>
                                                </li>
                                                <li  class="item-0">
                                                   <a href="achievement/">Achievement</a> 
                                                </li>
                                                
                                            </ul>
                                        </nav>                                               
                </td>
              </tr>
              <tr align="center" valign="bottom"> 
                <td colspan="2"><font color="#003366" size="4"><strong><br>
                  Database</strong></font></td>
              </tr>
              <tr align="center" valign="middle"> 
                <td><img src="images/savedb.png" border="0"></td>
                <td align="left">
                                        <nav class="main_nav database">
                                            <ul>
                                                <li class="item-0">
                                                    <a href="javascript:void(0);">Import</a>
                                                    <ul>
                                                        <li>
                                                           <a href="utils/dbimport.php">Flash Data</a>
                                                        </li>
                                                        <li>
                                                            <a href="tmis/excel_import.php">TMIS Excel</a>
                                                        </li>
                                                        <li>
                                                            <a href="achievement/excel_import.php">Exam Result</a>
                                                        </li>
                                                        <li>
                                                            <a href="excelEMIS">EMIS Excel</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">NFEMIS</a>
                                                            <ul>
                                                                <li>
                                                                    <a href="nfemis/dbimport.php">NFEMIS Data</a>
                                                                </li>
                                                                <li>
                                                                    <a href="nfemis/excel_import.php">NFEMIS Excel</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>    
                                                <li class="item-0">
                                                   <a href="javascript:void(0);">Export</a>
                                                   <ul>
                                                        <li>
                                                            <a href="utils/dbexportchoice.php">Flash &amp; TMIS</a>
                                                        </li>
                                                        <li>
                                                            <a href="utils/tagexport.php">Tag</a>
                                                        </li>
                                                        <li>
                                                            <a href="achievement/dbexportchoice.php">Achievement</a>
                                                        </li>
                                                        <li>
                                                            <a href="utils/exportEMIS.php">EMIS Excel</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">NFEMIS</a>
                                                            <ul>
                                                                <li>
                                                                    <a href="nfemis/dbexportchoice.php">NFEMIS Data</a>
                                                                </li>
                                                                <li>
                                                                    <a href="nfemis/exportNFEMIS.php">NFEMIS Excel</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                   </ul>
                                                </li>
                                                <li class="item-0">
                                                   <a href="javascript:void(0);">Maintenance</a> 
                                                   <ul>
                                                        <li><a href="utils/dbrepair.php">Repair</a></li>
                                                        <li><a href="utils/removeduplicates_splash.php">Duplicates</a></li>	
                                                        <li><a href="utils/removedistrict.php">Remove Districts</a></li>
                                                        <li><a href="utils/removeSchoolInfo.php">Remove EMIS Excel data</a></li>
                                                   </ul>  
                                                </li>
                                            </ul>
                                        </nav>    
                  </td>
              </tr>
            </table></td>
          <td width="50%"><table width="100%" border="0" cellpadding="10" cellspacing="0" class="ewTable" style="background: white;">
              <tr align="center" valign="bottom"> 
                <td colspan="2"><font color="#003366" size="4"><strong><br>
                  Reports</strong></font></td>
              </tr>
              <tr align="center" valign="middle"> 
                <td width="90"><img src="images/reports.png" border="0"></td>
                <td align="left">
                        <nav class="main_nav report">
                            <ul>
                                <li class="item-0">
                                    <a href="javascript:void(0);">Flash</a>
                                    <ul>
                                        <li><a href="flash1/reports.php">Flash I</a></li>
					<li><a href="flash2/reports.php">Flash II</a></li>
                                    </ul>
                                </li>
                                <li class="item-0">
                                    <a href="tmisreport/reportpre_agg.php">TMIS</a>
                                </li>
                                <li class="item-0">
                                    <a href="javascript:void(0);">Report Cards</a>
                                    <ul>
                                        <li><a href="districtreport/">District</a></li>
					<li><a href="schoolreport/">School</a></li>
					<li><a href="ecdreport/">ECD / SOP</a></li>
					<li><a href="tmisreport/reportpre.php">TMIS</a></li>
                                    </ul>
                                </li> 
                                <li class="item-0">
                                    <a href="javascript:void(0);">NFEC</a>
                                    <ul>
                                        <li>
                                            <a href="nfemis/reportchoice.php">Report</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </td>
              </tr>
              <tr align="center" valign="bottom"> 
                <td colspan="2"><font color="#003366" size="4"><strong><br>
                  Utilities</strong></font></td>
              </tr>
              <tr align="center" valign="middle"> 
                <td><img src="images/configure.png" width="72" height="72" border="0"></td>
                <td align="left">
                        <nav class="main_nav utils">
                            <ul>
                                <li class="item-0">
                                    <a href="javascript:void(0);">Rename</a>
                                    <ul>
                                        <li>
                                            <a href="utils/aevdc.php">VDC</a>
                                        </li>
					<li>
                                            <a href="utils/aeschool.php">School</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="item-0">
                                    <a href="utils/aetag.php">Tags</a>
                                </li>
                                <li class="item-0">
                                    <a href="javascript:void(0);">School</a>
                                    <ul>
                                        <li><a href="utils/schooldata.php?remove">Remove</a></li>
					<li><a href="utils/schooldata.php?transfer">Transfer</a></li>
                                    </ul>
                                </li>
                                <li class="item-0">
                                    <a href="javascript:void(0);">Agency(NFEC)</a>
                                    <ul>
                                        <li>
                                            <a href="nfemis/addagency.php">Add</a>
                                        </li>		
                                    </ul>
                                </li>
                            </ul>
                        </nav>
              </tr>
            </table></td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" class="ewListAdd">&copy; Copyright <?php echo $currentyear; ?>BS. All rights reserved to Department of Education.</p>
<p>&nbsp;</p>
</body>
</html>
