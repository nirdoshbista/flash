<?php
//if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

//$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('importEMIS_backend.php');
require_once('../includes/excel_reader2_patch_applied.php');
require_once('autofill.php');

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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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

<style>
    #progress {
      width: 500px;
      border: 1px solid #aaa;
      height: 20px;
    }
    #progress .bar {
      background-color: #ccc;
      height: 20px;
    }
</style>

	  <script>
		  $( function() {
				document.getElementById('progress').style.display = 'none';
				document.getElementById('message').style.display = 'none';
		
		  } );

		function showLoading()
		{  
			document.getElementById('progress').style.display = 'block';
			document.getElementById('message').style.display = 'block';
			document.getElementById('main_div').style.opacity = '0.2';
			$( function() {
				 // Trigger the process in web server.
			  $.ajax({url: "importEMIS.php"});
			  // Refresh the progress bar every 1 second.
			  timer = window.setInterval(refreshProgress, 1000);
			});
		}
		
	function hideLoading()
    {
		document.getElementById('progress').style.display = 'none';
			document.getElementById('message').style.display = 'none';
        document.getElementById('main_div').style.opacity = '1';
    }
</script>


<script src="js/flash2common.js" type="text/javascript"></script>
</head>
<body onLoad="navigation();">
    <?php
    
    //define the maximum file count
    $MAX_COUNT=5;
   
    if($_POST['submit'])
    {   
		//count the no of files to import
		$file_count=count($_FILES['emis_excel']['tmp_name']);
                
                //specify the row from which to start
                $startingRow=9;		//starting row
                
                //limit the no of files being uploaded
                if($_POST['autofill'] && $file_count>$MAX_COUNT)
                {
                    echo '<script>alert("You cannot upload more than '.$MAX_COUNT.' schools at a time!");</script>';
                }
                else
                {
                    //initialise the excel reading settings
                    $schoollist="";
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
                                    deleteRows("`id_students_subject`","sch_num=".$school_info[$fileno]['school_number']);
                                    deleteRows("`tmis_main`","sch_num=".$school_info[$fileno]['school_number']);
                                    deleteRows("`tmis_sec1`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_educational_info`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_sec2`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_edu`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_train`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_leave`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`tmis_inc`","tid like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`id_physical_details`","sch_num like '".$school_info[$fileno]['school_number']."%'");
                                    deleteRows("`id_students_subject`","sch_num=".$school_info[$fileno]['school_number']);
									deleteRows("`id_misc_details`","sch_num=".$school_info[$fileno]['school_number']);
									deleteRows("`id_staff_main`","sch_num=".$school_info[$fileno]['school_number']);
                                }

                            // }elseif(checkIsOldFile($excelObject)){
                                // $school_info[$fileno]['school_number']=substr($excelObject->val(2,'F',$excelObject->getSheetIndex('Main')),1,9);
                                // $school_info[$fileno]['year']=$excelObject->val(5,'B',$excelObject->getSheetIndex('Main'));
                                // //varibles for the new file
                                // //name of the sheet where all the student records are located
                                // $studentSheet='Main';


                                // //delete all the records of the school if record of the school exists in the database
                                // if (checkIfRecordExists("id_students_main",array("sch_num"=>$school_info[$fileno]['school_number'])))
                                // {
                                    // deleteRows("`id_students_main`","sch_num=".$school_info[$fileno]['school_number']);
                                    // deleteRows("`id_students_track`","sch_num=".$school_info[$fileno]['school_number']);
                                    // deleteRows("`id_students_scholarship`","sch_num=".$school_info[$fileno]['school_number']);
                                // }
                            }else{
                                $invalid_file[$fileno]=TRUE;
                                continue;
                            }

                            //retrieve and insert student information
                            $students_info[$fileno]=array();
                            $students_info[$fileno]=getStudentsInfo($excelObject,$startingRow,$excelObject->getSheetIndex($studentSheet));
                            insertStudentInfo($students_info[$fileno]);

                            // if(checkIsNewFile($excelObject))
                            // {

                                //retrieve and insert student marks
                                 $marks_info[$fileno]=array();
                                 //$marks_info[$fileno]=  getStudentMarks($excelObject,$startingRow,$excelObject->getSheetIndex('Student Marks'));
                                 //insertStudentMarks($marks_info[$fileno]);
								 insertStudentMarks($excelObject,$startingRow,$excelObject->getSheetIndex('Student Marks'));

                                // // //now the teacher portion
                                   insertTeacherPersonalInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Personal Info'));
                                   insertTeacherEduInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Educational Info'));    
                                   insertTeachingHistory($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Teaching History'));
                                   insertTeacherEduHistory($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Educational History'));
                                   insertTeacherTraining($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Training Info'));
                                   insertTeacherLeave($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Leave Info'));
                                   insertTeacherIncome($excelObject,$startingRow,$excelObject->getSheetIndex('Teacher Income'));
								
								// // // //now the staff portion
                                  insertStaffPersonalInfo($excelObject,$startingRow,$excelObject->getSheetIndex('Staff'));

                                // // // //now the physical information part
                                  insertPhysicalDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Physical Details'));
								
								// // // //now the Miscellaneous information part
                                  insertMiscDetails($excelObject,$startingRow,$excelObject->getSheetIndex('Miscellaneous'));
                                
                                // //now the class specific subjects
                                 insertSubjects($excelObject,$startingRow,$excelObject->getSheetIndex('Subjects'),$school_info[$fileno]);
                            // }

                            $import_success[$fileno]=TRUE;
                            //create an list of school ids for autofill
                            $schoollist.=$school_info[$fileno]['school_number'];
                            if($fileno!=($file_count-1))
                                $schoollist.=",";
                    }
                }
                
		    
                //now autofill the contents if the file count is less than the maximum specified
                if($file_count<=$MAX_COUNT)
                {
                    if($_POST['autofill'])
                    {
                        deleteGarbage($currentyear);
                        autofillFlash1($schoollist);
                        autofillFlash2($schoollist);
                        emptyIDtables();
                    }
                }
     
    }
?>

<div id="loading_spinner" style="position:fixed;margin-left:32%;opacity:1;z-index:9999;display:none;">
    <img src="../images/loading.gif">        
</div>    

	  <div id="progress"></div>
  <div id="message"></div>
<div id="main_div" style="opacity:1;">
    <div align="center">
    <p><img src="../images/iemis logo.png" style="width:470px;"></p>
    </div>
    <br>
    <b style="margin-left:45%;">Select School Level EMIS File(s)</b><br/>
        <span class="import_span">
        <form method="POST" enctype="multipart/form-data" onSubmit="return showLoading();"/>
            <input type="file" name="emis_excel[]" multiple="multiple"/> 
            <input type="submit" name="submit" value="submit"/><br/><br/>
            <label style="padding-left: 40%;"> <input type="checkbox" name="autofill" value="1"/>Autofill</label>
		</form>
		<?php 
			$result= mysql_query("Select * from id_students_track");
			$num_rows = mysql_num_rows($result);
		?> 
        <label style="padding-left: 10%;"> Number Of Data <input type="text" name="countrows" disabled value="<?php echo $num_rows; ?> "/></label>
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
											$arr_content['percent'] = ($import_count / $file_count) * 100;
											$arr_content['message'] = ($import_count / $file_count) * 100 . "%";
                                    }
                                    elseif($invalid_file[$fileno])
                                    {
                                            echo '<p class="import_error">Please select a valid School Level EMIS template file.</p>';
                                            continue;
                                    }
                            }

                            //display the success notice
                            if ($import_count)
                            {   
                                echo "<script>hideLoading();</script>";
                                echo '<p class="import_success">All Records of '.$import_count.' School'.($import_count>1? 's have':' have').' been successfully imported.</p>';
                            }
                    ?>
            </span>
    <div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
</div>
<br />

<script>
    var timer;
 
    // The function to refresh the progress bar.
    function refreshProgress() {
      // We use Ajax again to check the progress by calling the checker script.
      // Also pass the session id to read the file because the file which storing the progress is placed in a file per session.
      // If the call was success, display the progress bar.
      $.ajax({
        success:function(data){
          $("#progress").html('<div class="bar" style="width:' + data.percent + '%"></div>');
          $("#message").html(data.message);
          // If the process is completed, we should stop the checking process.
          if (data.percent == 100) {
            window.clearInterval(timer);
            timer = window.setInterval(completed, 1000);
          }
        }
      });
    }
 
    function completed() {
      $("#message").html("Completed");
      window.clearInterval(timer);
    }
  </script>

</body>
</html>
