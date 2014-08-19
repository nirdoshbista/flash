<?php
//if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

//$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('../includes/excel_reader2_patch_applied.php');

$link = dbconnect();
$school_info=array();
$students_info=array();
$marks_info=array();
$import_success=array();
$invalid_file=array();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Import NFEMIS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style>
    .import_error
    {
        color:#FF0000;
    }
    span.notice
    {
        font-size:11px;
        font-weight:bold;
        text-align: center;
    }
    .import_span
    {
        float:left;
        margin-left:40%;
        margin-top:25px;
        margin-bottom:1%;
    }
    .import_success{
        color:#000000;
    }
	.clr{
		clear:both;
	}
</style>
<script src="js/nfemis_common.js" type="text/javascript"></script>
</head>
<body onLoad="navigation();">
    <?php 
    if($_POST['submit'])
	{
		//count the no of files to import
		$file_count=count($_FILES['nfemis_excel']['tmp_name']);
                
                //specify the row from which to start
                $startingRow=9;		//starting row
                
		//initialise the excel reading settings
		for($fileno=0; $fileno<$file_count; $fileno++) 
		{	
                        $filename=$_FILES['nfemis_excel']['tmp_name'][$fileno];
                        $excelObject = new Spreadsheet_Excel_Reader($filename,false);               
                        
                        $import_success[$fileno]=TRUE;
                }              
    }
?>
<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>
<b style="margin-left:45%;">Select Non Formal EMIS File(s)</b><br/>
    <span class="import_span">
    <form method="POST" enctype="multipart/form-data"/>
	<input type="file" name="nfemis_excel[]" accept="application/vnd.ms-excel" multiple="multiple"/>  
	<input type="submit" name="submit" value="submit"/>
    </form>
    </span>
	<div class="clr"></div>
	<span class="notice">
		<?php
			$import_count=0;
			for($fileno=0; $fileno<$file_count; $fileno++) 
			{
				if($import_success[$fileno])
				{
					$import_count++;
				}
				elseif($invalid_file[$fileno])
				{
					echo '<p class="import_error">Please select a valid NFEMIS template file.</p>';
                                        continue;
				}
			}
			
			//display the success notice
			if ($import_count)
				echo '<p class="import_success">All Records of '.$import_count.' file'.($import_count>1? 's have':' have').' been successfully imported.</p>';
		?>
	</span>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>
</html>
