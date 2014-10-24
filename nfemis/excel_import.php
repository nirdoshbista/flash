<?php
//if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

//$sch_num=$_GET['s'];

require_once('includes/vars.php');
require_once('includes/dbfunctions.php');
require_once('excelImport_backend.php');
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
                        $excelObject->setOutputEncoding('CP1251');
                        //retrieve the general agency information
                        $agency_info[$fileno]=array();
                        $agency_info[$fileno]['agency_code']=$agency_code=trim($excelObject->val(1,'F',$excelObject->getSheetIndex('General')));
                        $agency_info[$fileno]['year']=$year=trim($excelObject->val(4,'B',$excelObject->getSheetIndex('General')));
                        
                        //check if it is a valid file,skip the file if it is not valid
                        if (checkIsValidFile($excelObject,$agency_code,$year)) {
                            //delete all the records of the agency for the year if record of the agency exists in the database
                            if (checkIfRecordExists("nfe_agency_details",array("center_id"=>$agency_code)))
                            {
                               deleteRows("`nfe_agency_details`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_cmt_members`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_clc_subcmt`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_clc_activities`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_clc_property`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_class_details`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_facilitators`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_participants`","center_id=".$agency_code." AND year=".$year);
                               deleteRows("`nfe_business_details`","center_id=".$agency_code." AND year=".$year);
                            }
                            
                            //import the agency data from the file
                            insertAgencyGeneralInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Agency Details'));
                            insertCommitteeMembersInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Committee Members'));
                            insertCLCSucommitteeInfo($excelObject,$startingRow,$excelObject->getSheetIndex('CLC Subcommittee'));
                            insertCLCActivitiesInfo($excelObject,$startingRow,$excelObject->getSheetIndex('CLC Activities'));
                            insertCLCPropertyInfo($excelObject,$startingRow,$excelObject->getSheetIndex('CLC Property'));
                            insertClassDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Class Details'));
                            insertFacilitatorDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Facilitators'),$agency_code);
                            insertParticipantDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Participants'),$agency_code);
                            insertBusinessDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Business'),$agency_code);
                            
                        }else{
                            $invalid_file[$fileno]=TRUE;
                            continue;
                        }
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
