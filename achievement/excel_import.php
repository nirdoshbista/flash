<?php 

@require_once("includes/bootstrap.php");

function file2hasharray($filename,$index=-1){
	
	$c = $index;
	
	$arr = array();
	foreach (explode("\n",file_get_contents($filename)) as $l){
		if (trim($l)=='') continue;
		
		if ($index==-1) $arr[$l] = $l;
		else $arr[$l] = $c;

		$c++;
	}
	
	return $arr;
}

if (isset($_POST['import'])){
	
	$filename = basename($_FILES['userfile']['name']);
	$fileext = substr($filename, strrpos($filename, ".")+1);
	
	if ($fileext == "xls"){
		$uploaddir = sys_get_temp_dir()."/";
		$uploadfile = $uploaddir . $filename;
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			
			include("../lib/excel.lib.php");
			$data = new Spreadsheet_Excel_Reader($uploadfile, false);
			
			$year = $data->val(4,'D');
			$school = $data->val(4,'H');
			$sch_num = substr($school,1,9);
			
			// check if the file has been imported earlier
			$reg_id=$data->val(8,3);
			$first_name=$data->val(8,4);
			
			$result = mysql_query("SELECT stu_num FROM student_main WHERE sch_num='$sch_num' AND sch_year='$year' AND reg_id='$reg_id' AND first_name='$first_name'");
			if (mysql_num_rows($result)>0){
				$error="File already imported. No records imported.";
			}
			else{
				
				@require_once("includes/utils.php");
				@require_once("includes/dbfunctions.php");
				@require_once("nepalicalendar.php");
					
				$cal = new Nepali_Calendar();					
				
				$hash_sex = array('Male'=>'1', 'Female'=>'2');
				$hash_yn = array('Yes'=>'1', 'No'=>'2');
				$hash_caste = file2hasharray("caste.txt",1);
				$hash_disability = file2hasharray("disability.txt",1);
				
				$row = 8;
				//$outstr = "";
				while ($data->val($row,1)!=''){
					
					

					$d['sch_num']=$data->val($row,'A');
					$d['sch_year']=$data->val($row,'B');
					$d['class']=8;
					
					$d['stu_num']=newStudentID($d['sch_num'].substr($d['sch_year'],-2));

					$d['reg_id']=$data->val($row,'C');
					$d['first_name']=$data->val($row,'D');
					$d['last_name']=$data->val($row,'E');
					$d['sex']=$hash_sex[$data->val($row,'F')];
					$d['father_name']=$data->val($row,'G');
					$d['mother_name']=$data->val($row,'H');

					$d['dob_np_y']=$data->val($row,'I');
					$d['dob_np_m']=$data->val($row,'J');
					$d['dob_np_d']=$data->val($row,'K');
					
					// calculate date in en
					$ed = $cal->nep_to_eng($d['dob_np_y'],$d['dob_np_m'],$d['dob_np_d']);
					$d['dob_en_y']=$ed['year'];
					$d['dob_en_m']=$ed['month'];
					$d['dob_en_d']=$ed['date'];

					$d['caste_ethnicity']=$hash_caste[$data->val($row,'L')];
					$d['disability']=$hash_disability[$data->val($row,'M')];
					$d['dist_school']=$data->val($row,'N');
					$d['ecd_ppc_status']=$hash_yn[$data->val($row,'O')];
					$d['income']=$hash_yn[$data->val($row,'P')];
					$d['income_hrs']=$data->val($row,'Q');
					$d['attendance']=$data->val($row,'R');

					idata('student_main',$d);
					
				
					// insert for student_marks
					$dm = array();
					$dm['stu_num']=$d['stu_num'];
					$dm['sch_year']=$d['sch_year'];
					$dm['class']=$d['class'];
					
					idata('student_marks',$dm);
											

					$row++;
				}
				
				$message = ($row-8)." rows imported.";
				
			}
			
		} else {
			$error = "File upload error!";
		}		
		
		
		
	}
	else{
		$error = "Invalid file type. Only .xls files are allowed.";
	}
	
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Achievement - Excel Import</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/dle.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

if ($error!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid red; width: 200px;'>$error</div>";
if ($message!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid green; width: 200px;'>$message</div>";

//echo "<pre>$outstr</pre>";

?>

<form enctype="multipart/form-data" action="" method="POST">
<p align="center"><strong>Import Students from Excel file</strong></p>
<p align="center">
Excel (.xls) file
<input type="file" name="userfile" id="userfile" size="40" />
<input type="submit" name="import" value="Import" />
</p>
</form>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>

</body>

</html>
