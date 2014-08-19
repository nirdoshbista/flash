<?php 

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
$link = dbconnect();

$map = array();

// db column name to excel column number

$map["sch_num"]=1;
$map["t_name"]=3;
$map["sex"]=4;
$map["t_caste"]=5;

$map["disability_status"]=6;
$map["citizenship_no"]=7;
$map["citizenship_dist"]=8;
$map["bs_dob_year1"]=9;
$map["bs_dob_month1"]=10;
$map["bs_dob_day1"]=11;
$map["bs_dob_year2"]=12;
$map["bs_dob_month2"]=13;
$map["bs_dob_day2"]=14;
$map["mother_tongue"]=15;
$map["nationality"]=16;
$map["marital_status"]=17;
$map["name_father"]=18;
$map["name_mother"]=19;
$map["name_spouse"]=20;
$map["name_willper"]=21;
$map["license_no"]=22;
$map["insurance_no"]=23;
$map["pf_no"]=24;
$map["trk_no"]=25;
$map["account_no"]=26;
$map["head_teacher"]=27;
$map["head_teacher_training"]=28;
$map["perm_addr_dist"]=29;
$map["perm_addr_vdc"]=30;
$map["perm_addr_ward"]=31;
$map["perm_addr_phone"]=32;
$map["perm_addr_email"]=33;
$map["temp_addr_dist"]=34;
$map["temp_addr_vdc"]=35;
$map["temp_addr_ward"]=36;
$map["temp_addr_phone"]=37;
$map["first_app_year"]=38;
$map["first_app_month"]=39;
$map["first_app_day"]=40;
$map["first_app_level"]=41;
$map["first_app_rank"]=42;
$map["first_app_type"]=43;
$map["current_app_year"]=44;
$map["current_app_month"]=45;
$map["current_app_day"]=46;
$map["curr_perm_level"]=47;
$map["curr_perm_rank"]=48;
$map["curr_perm_type"]=49;

$map["qualif"]=50;
$map["is_education"]=51;

$map["type"]=52;

$map["teaching_lang"]=53;
$map["first_app_sec_subject"]=54;
$map["teachingSub1"]=55;
$map["teachingSub2"]=56;



$map["scale"]=57;
$map["grade"]=58;
$map["ma"]=59;
$map["insurance"]=60;
$map["ta"]=61;
$map["mahangi"]=62;
$map["civil_investment"]=63;
$map["ra"]=64;
$map["dress"]=65;
$map["festival"]=66;

$map["bank_name"]=67;

// resolve map



if (isset($_POST['import'])){
	
	$filename = basename($_FILES['userfile']['name']);
	$fileext = substr($filename, strrpos($filename, ".")+1);
	
	if ($fileext == "xls"){
		$uploaddir = sys_get_temp_dir()."/";
		$uploadfile = $uploaddir . $filename;
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			
			@require_once("../lib/excel.lib.php");
			@require_once("includes/utils.php");
			@require_once("includes/dbfunctions.php");
			@require_once("nepalicalendar.php");
				
			$cal = new Nepali_Calendar();					
			
			$tmis = new Spreadsheet_Excel_Reader($uploadfile, false);
			
			$identifier = $tmis->val(1,"AA");
			
			if (1/*substr($identifier ,0,4)=="TMIS"*/){

				$row_count = $tmis->rowcount($sheet_index=0);
				
				// skip to first line
				$first_row = 1;
				while (strlen($tmis->val($first_row, $map["sch_num"]))!=9 && $first_row<$row_count) $first_row++;
				$insert_count=0;
				
                           
				$output = "";
				
				for ($row = $first_row; $row <= $row_count; $row++){
					
					if (trim($tmis->val($row, $map["t_name"]))=="" || trim($tmis->val($row, $map["sch_num"]))=="") continue;
					
					$insert_count++;
				
					// add to tmis_main and get tid
					// also determine if to be updated or added
					
					// tmis_main
					$d = array();
					$d["sch_num"]=$tmis->val($row, $map["sch_num"]);
					$d["t_name"]=ucwords($tmis->val($row, $map["t_name"]));
					
					// get new tid
					$tid = $sch_num = $d["sch_num"]; // school's id
					$tid .= substr($currentyear, -2);
					
					$result = mysql_query("SELECT MAX(tid) as tid FROM tmis_main WHERE sch_num='$sch_num' AND sch_year='$currentyear'");
					$count = 0;
					if (mysql_num_rows($result)>0){
						$tmis_row = mysql_fetch_assoc($result);
						$count = (int)substr($tmis_row['tid'],-3);
					}
					$count++;
					$tid .= str_pad($count, 3, '0', STR_PAD_LEFT);
					
					// insert tid and t_name
					$d['tid'] = $tid;
					$d['sch_year'] = $currentyear;
					
					idata('tmis_main',$d);
					//$output .= print_r($d, true);

					
					// tmis_sec1
					$d = array();
					$d['tid']=$tid;
					$d['sch_year'] = $currentyear;
					
					$sex = $tmis->val($row, $map["sex"]);
					$sex = trim(strtolower($sex)," .\t\'");
					if ($sex == "2" || substr($sex,0,1)=="f" || substr($sex,0,1)=="F")
						$d["sex"]="1";
					else if ($sex == "1" || substr($sex,0,1)=="m" || substr($sex,0,1)=="M")
						$d["sex"]="2";
					
                                        
                                        $caste=$tmis->val($row, $map["t_caste"]);
                                        $d["t_caste"]=$caste;
                                        if (strtolower($caste)=="dalit")
                                            $d["t_caste"]=1;
                                        else if (strtolower($caste)=="janajati" or strtolower($caste)=="janjati")
                                            $d["t_caste"]=2;
                                        else if (strtolower($caste)=="brahmin/chhetri" or strtolower($caste)=="brahman" or strtolower($caste)=="chhetri")
                                            $d["t_caste"]=3;
                        
                                            
                                        
                                        $d["disability_status"]=$tmis->val($row,$map["disability_status"]);

					$citizenship_no = $tmis->val($row, $map["citizenship_no"]);
					$citizenship_no = strtolower($citizenship_no);
					$citizenship_no = preg_replace("/[^a-z0-9]+/","-",$citizenship_no);
					$d["citizenship_no"]=$citizenship_no;
					
					$d["citizenship_dist"]=ucwords($tmis->val($row, $map["citizenship_dist"]));
					$d["bs_dob_year1"]=$tmis->val($row, $map["bs_dob_year1"]);
					$d["bs_dob_year2"]=$tmis->val($row, $map["bs_dob_year1"]);
					$d["bs_dob_month1"]=$tmis->val($row, $map["bs_dob_month1"]);
					$d["bs_dob_month2"]=$tmis->val($row, $map["bs_dob_month1"]);
					$d["bs_dob_day1"]=$tmis->val($row, $map["bs_dob_day1"]);
					$d["bs_dob_day2"]=$tmis->val($row, $map["bs_dob_day1"]);
					
					// calculate date in en
					$ed = $cal->nep_to_eng($d['bs_dob_year1'],$d['bs_dob_month1'],$d['bs_dob_day1']);
					$d['ad_dob_year1']=$ed['year'];
					$d['ad_dob_year2']=$ed['year'];
					$d['ad_dob_month1']=$ed['month'];
					$d['ad_dob_month2']=$ed['month'];
					$d['ad_dob_day1']=$ed['date'];					
					$d['ad_dob_day2']=$ed['date'];
					
					$d["mother_tongue"]=ucwords($tmis->val($row, $map["mother_tongue"]));
					$d["nationality"]=ucwords($tmis->val($row, $map["nationality"]));
					$d["marital_status"]=$tmis->val($row, $map["marital_status"]);
					
				//	$marital_status = trim(strtolower($marital_status)," .\t\'");
//					if ($sex == "1" || substr($marital_status,0,1)=="m")
	//					$d["marital_status"]="1";
		//			else if ($marital_status == "2" || substr($sex,0,1)=="u")
			//			$d["marital_status"]="2";
				//	else 
					//	$d["marital_status"]="N/A";
					$d["name_father"]=ucwords($tmis->val($row, $map["name_father"]));
					$d["name_mother"]=ucwords($tmis->val($row, $map["name_mother"]));
					$d["name_spouse"]=ucwords($tmis->val($row, $map["name_spouse"]));
					$d["name_willper"]=ucwords($tmis->val($row, $map["name_willper"]));
					$d["license_no"]=$tmis->val($row, $map["license_no"]);
					$d["insurance_no"]=$tmis->val($row, $map["insurance_no"]);
					$d["pf_no"]=$tmis->val($row, $map["pf_no"]);
                                        $d["trk_no"]=$tmis->val($row, $map["trk_no"]);
                                        $d["account_no"]=$tmis->val($row, $map["account_no"]);
                                        $d["head_teacher"]=$tmis->val($row, $map["head_teacher"]);
                                        $d["head_teacher_training"]=$tmis->val($row, $map["head_teacher_training"]);
           
					$d["perm_addr_dist"]=ucwords($tmis->val($row, $map["perm_addr_dist"]));
					$d["perm_addr_vdc"]=ucwords($tmis->val($row, $map["perm_addr_vdc"]));
					$d["perm_addr_ward"]=$tmis->val($row, $map["perm_addr_ward"]);
					$d["perm_addr_phone"]=$tmis->val($row, $map["perm_addr_phone"]);
					$d["perm_addr_email"]=$tmis->val($row, $map["perm_addr_email"]);
					$d["temp_addr_dist"]=ucwords($tmis->val($row, $map["temp_addr_dist"]));
					$d["temp_addr_vdc"]=ucwords($tmis->val($row, $map["temp_addr_vdc"]));
					$d["temp_addr_ward"]=$tmis->val($row, $map["temp_addr_ward"]);
					$d["temp_addr_phone"]=$tmis->val($row, $map["temp_addr_phone"]);
					
					$d["first_app_year"]=$tmis->val($row, $map["first_app_year"]);
					$d["first_app_month"]=$tmis->val($row, $map["first_app_month"]);
					$d["first_app_day"]=$tmis->val($row, $map["first_app_day"]);
                                        $d["first_app_level"]=$tmis->val($row, $map["first_app_level"]);
                                        $d["first_app_rank"]=$tmis->val($row, $map["first_app_rank"]);
                                        $d["first_app_type"]=$tmis->val($row, $map["first_app_type"]);

					$d["current_app_year"]=$tmis->val($row, $map["current_app_year"]);
					$d["current_app_month"]=$tmis->val($row, $map["current_app_month"]);
					$d["current_app_day"]=$tmis->val($row, $map["current_app_day"]);
                                        
					$d["teachingSub1"]=$tmis->val($row, $map["teachingSub1"]);
                                        $d["teachingSub2"]=$tmis->val($row, $map["teachingSub2"]);
					
					$d["curr_perm_level"]=$tmis->val($row, $map["curr_perm_level"]);
                                        $rank=$tmis->val($row, $map["curr_perm_rank"]);
                                        if ($rank>=1 and $rank<4) 
                                            $d["curr_perm_rank"]=$tmis->val($row, $map["curr_perm_rank"]);
                                        else
                                            $d["curr_perm_rank"]=3;
					//$d["curr_perm_type"]=$tmis->val($row, $map["curr_perm_type"]);
					$curr_perm_type = $tmis->val($row, $map["curr_perm_type"]);
					$curr_per_type = trim(strtolower($curr_perm_type)," .\t\'");
					if ($curr_perm_type == "1")
						$d["curr_perm_type"]="2";
					else if ($curr_perm_type == "2")
						$d["curr_perm_type"]="1";
					else if ($curr_perm_type == "3")
						$d["curr_perm_type"]="1";
					else if ($curr_perm_type == "4")
						$d["curr_perm_type"]="3";
					else if ($curr_perm_type == "5")
						$d["curr_perm_type"]="1";
					else if ($curr_perm_type == "6")
						$d["curr_perm_type"]="1";
					else if ($curr_perm_type == "7")
						$d["curr_perm_type"]="5";
                                               
					
                                        //now the bank name
					$d["bank_name"]=$tmis->val($row, $map["bank_name"]);

					idata('tmis_sec1',$d);
					
					//$output .= print_r($d, true);

					// tmis_inc
					$d = array();
					$d['tid']=$tid;
					$d['sch_year'] = $currentyear;
					
					$d["sn"]=1;
					$d["src"]="Nepal Government";
					$d["scale"]=$tmis->val($row, $map["scale"]);
					$d["grade"]=$tmis->val($row, $map["grade"]);
					$d["ma"]=$tmis->val($row, $map["ma"]);
					$d["ta"]=$tmis->val($row, $map["ta"]);
					$d["insurance"]=$tmis->val($row, $map["insurance"]);
					$d["mahangi"]=$tmis->val($row, $map["mahangi"]);
					$d["civil_investment"]=$tmis->val($row, $map["civil_investment"]);
					$d["ra"]=$tmis->val($row, $map["ra"]);
					$d["dress"]=$tmis->val($row, $map["dress"]);
					$d["festival"]=$tmis->val($row, $map["festival"]);
					
					idata('tmis_inc',$d);
					
                                        // tmis_train
					$d = array();
					$d['tid']=$tid;
					$d['sch_year'] = $currentyear;
					
					$d["sn"]=1;
					$d["type"]=$tmis->val($row, $map["type"]);
                                        $d["year"]=$currentyear;
					
					idata('tmis_train',$d);
                                        
                                        // tmis_edu
					$d = array();
					$d['tid']=$tid;
					$d['sch_year'] = $currentyear;
					
					$d["sn"]=1;
                                        $qualif=array(1=>"Under-SLC",2=>"SLC",3=>"Intermed",4=>"Bacehlors",5=>"Masters",6=>"PhD");
					$key=$tmis->val($row, $map["qualif"]);
                                        $d["qualif"]=$qualif[$key];
                                        $d["is_education"]=$tmis->val($row, $map["is_education"]);
					
					idata('tmis_edu',$d);
				}
			
				$message = "$insert_count teachers imported.";
				
			}
			
			else{
				$error = "Invalid TMIS Template file. Use the provided template <a href='Flash_TMIS_Import_Template.xls'>here</a>.";
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
<title>TMIS - Excel Import</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/tmis.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

if ($error!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid red; width: 200px;'>$error</div>";
if ($message!='') echo "<div style='margin: 0 auto; padding: 5px; text-align: center; border: 1px solid green; width: 200px;'>$message</div>";

//echo "<pre>$output</pre>";

?>

<form enctype="multipart/form-data" action="" method="POST">
<p align="center"><strong>Import Teachers from Excel file</strong></p>
<p align="center">
Excel (.xls) file
<input type="file" name="userfile" id="userfile" size="40" />
<input type="submit" name="import" id="userimport" value="Import" />
</p>
</form>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="index.php">Main Menu</a> | <a href='Flash_TMIS_Import_Template.xls'>TMIS Import Template</a> | <a href="../logout.php">Logout</a></div>

</body>
<script>
<?php
    //disable import of xl file if tmis_main already contains data
    $result = mysql_query("SELECT * FROM tmis_main");
    /* WHERE sch_num='$sch_num' AND sch_year='$currentyear' */
    if (mysql_num_rows($result)>0)
    {
          echo "document.getElementById('userfile').disabled=true;\n";
          echo "document.getElementById('userimport').disabled=true;\n";
    }

?>
</script>

</html>
