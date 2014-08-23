<?php
//if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

//$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('importEMIS_backend.php');
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
<title>Import EMIS</title>
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
<script src="js/flash2common.js" type="text/javascript"></script>
</head>
<body onLoad="navigation();">
    <?php 
    if($_POST['submit'])
	{
		//count the no of files to import
		$file_count=count($_FILES['emis_excel']['tmp_name']);
                
                //specify the row from which to start
                $startingRow=9;		//starting row
                
		//initialise the excel reading settings
		for($fileno=0; $fileno<$file_count; $fileno++) 
		{	
                        $filename=$_FILES['emis_excel']['tmp_name'][$fileno];
                        $excelObject = new Spreadsheet_Excel_Reader($filename,false);
                        $excelObject->setOutputEncoding('CP1251');
                        //retrieve the general school information
                        $school_info[$fileno]=array();
                    
                        //check if it is a valid file,skip the file if it is not valid
                        if (checkIsNewFile($excelObject)) {
                            $school_info[$fileno]['school_number']=substr($excelObject->val(1,'F',$excelObject->getSheetIndex('General')),1,9);
                            $school_info[$fileno]['year']=trim($excelObject->val(5,'B',$excelObject->getSheetIndex('General')));
                            //varibles for the new file
                            //name of the sheet where all the student records are located
                            $studentSheet='Student Tracking';
                            
                            //delete all the records of the school if record of the school exists in the database
                            if (checkIfRecordExists("id_students_main",array("sch_num"=>$school_info[$fileno]['school_number'])))
                            {
                                deleteRows("`id_students_main`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`id_students_scholarship`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`id_students_track`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`id_students_marks`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`tmis_main`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`tmis_sec1`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_educational_info`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_sec2`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_edu`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_train`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_leave`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`tmis_inc`","tid like '".$school_info[$fileno]['school_number']."%'");
                                deleteRows("`id_physical_details`","sch_num like '".$school_info[$fileno]['school_number']."%'");
                            }
                            
                        }elseif(checkIsOldFile($excelObject)){
                            $school_info[$fileno]['school_number']=substr($excelObject->val(2,'F',$excelObject->getSheetIndex('Main')),1,9);
                            $school_info[$fileno]['year']=$excelObject->val(5,'B',$excelObject->getSheetIndex('Main'));
                            //varibles for the new file
                            //name of the sheet where all the student records are located
                            $studentSheet='Main';
                            
                            
                            //delete all the records of the school if record of the school exists in the database
                            if (checkIfRecordExists("id_students_main",array("sch_num"=>$school_info[$fileno]['school_number'])))
                            {
                                deleteRows("`id_students_main`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`id_students_track`","sch_num=".$school_info[$fileno]['school_number']);
                                deleteRows("`id_students_scholarship`","sch_num=".$school_info[$fileno]['school_number']);
                            }
                        }else{
                            $invalid_file[$fileno]=TRUE;
                            continue;
                        }
                        
                        //retrieve and insert student information
                        $students_info[$fileno]=array();
                        $students_info[$fileno]=getStudentsInfo($excelObject,$startingRow,$excelObject->getSheetIndex($studentSheet));
                        insertStudentInfo($students_info[$fileno]);
                        
                        if(checkIsNewFile($excelObject))
                        {
                            
                            //retrieve and insert student marks
                            $marks_info[$fileno]=array();
                            $marks_info[$fileno]=  getStudentMarks($excelObject,$startingRow,$excelObject->getSheetIndex('Student Marks'));
                            insertStudentMarks($marks_info[$fileno]);

                            //now the teacher portion
                            insertTeacherPersonalInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Personal Info'));
                            insertTeacherEduInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Educational Info'));    
                            insertTeachingHistory($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Teaching History'));
                            insertTeacherEduHistory($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Educational History'));
                            insertTeacherTraining($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Training Info'));
                            insertTeacherLeave($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Leave Info'));
                            insertTeacherIncome($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Income'));

                            //now the physical information part
                            insertPhysicalDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Physical Details'));
                        }
                        
                        $import_success[$fileno]=TRUE;
                }              
    }
?>
<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>
<b style="margin-left:45%;">Select School Level EMIS File(s)</b><br/>
    <span class="import_span">
    <form method="POST" enctype="multipart/form-data"/>
	<input type="file" name="emis_excel[]" accept="application/vnd.ms-excel" multiple="multiple"/>  
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
					echo '<p class="import_error">Please select a valid School Level EMIS template file.</p>';
                                        continue;
				}
			}
			
			//display the success notice
			if ($import_count)
				echo '<p class="import_success">All Records of '.$import_count.' School'.($import_count>1? 's have':' have').' been successfully imported.</p>';
		?>
	</span>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>
</html>
