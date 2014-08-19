<?php

/** function that retrieves a students records from the excel file
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index
 * @return array 
 */
function getStudentsInfo($excelObject,$startingRow,$sheet_index){
    $students_info=array();
    //get student information from the sheet
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //import students personal information
        foreach(range('A', 'M') as $alphabet)
            $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        //import class information
	foreach(range('O', 'Z') as $alphabet)
	{
            if($excelObject->val($i,$alphabet,$sheet_index)!=="")
                $temp_array['cls_'.$excelObject->val($startingRow-2,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
	}
        //import attendance information
	foreach(range('M', 'X') as $alphabet)
	{
            if($excelObject->val($i,"A".$alphabet,$sheet_index)!=="")
                $temp_array['attendance_'.$excelObject->val($startingRow-2,"A".$alphabet,$sheet_index)]=$excelObject->val($i,"A".$alphabet,$sheet_index);
	}
        //import scholarship
        //scholarship cannot be mapped with final scholarship list as we donot know tha class/level here
	foreach(range('A','L') as $alphabet)
	{
            if($excelObject->val($i,"A".$alphabet,$sheet_index)!=="")                                                                            
                $temp_array['sch_'.$excelObject->val($startingRow-2,"A".$alphabet,$sheet_index)]=$excelObject->val($i,"A".$alphabet,$sheet_index);			
	}
        //import bank details,stream,ecd number,ecd type and previous school if this is the new excel file
        if(checkIsNewFile($excelObject))
        {
            foreach(array("AY","AZ","BM","BN","BO","BP") as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        }
        			
	if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($students_info,$temp_array);
    }	
    return $students_info;
}

/** function that retrieves students marks for insertion 
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function getStudentMarks($excelObject,$startingRow,$sheet_index)
{
    $students_marks=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve students marks from excel file
        foreach(range('A', 'J') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($students_marks,$temp_array);
    }   
    return $students_marks;
}

/** function that inserts marks of each student
 *
 * @param type $studentsMarksInfo 
 */
function insertStudentMarks($studentsMarksInfo)
{
    foreach($studentsMarksInfo as $record)
    {
        $temp_data=array();
        $temp_data['sch_num']=$record['School ID'];
        $temp_data['sch_year']=$record['Year'];
        $temp_data['reg_id']=$record['RegID'];
        $temp_data['class']=$record['Class'];
        $temp_data['nepali']=$record['Nepali'];
        $temp_data['english']=$record['English'];
        $temp_data['maths']=$record['Math'];
        $temp_data['social_studies']=$record['Social Studies'];
        $temp_data['science']=$record['Science'];
        $temp_data['population_env']=$record['Population and Environment'];
        
        while(strlen($temp_data['reg_id'])<5)
        {
                $temp_data['reg_id']="0".$temp_data['reg_id'];
        }
        $temp_data['reg_id']=$temp_data['sch_num'].$temp_data['reg_id'];
        idata("id_students_marks",$temp_data);
    }
}

/** function that checks whether the file being imported is the newer one
 *
 * @param type $excelObject
 * @return boolean 
 */
function checkIsNewFile($excelObject){
    if (trim($excelObject->val(3,'G',$excelObject->getSheetIndex('Buttons'))) == "School Level EMIS" && trim($excelObject->val(1,'A',$excelObject->getSheetIndex('General')))=="School Record Keeping")
            return TRUE;
    return FALSE;
}
/** function that checks whether the file being imported is the older one
 *
 * @param type $excelObject
 * @return boolean 
 */
function checkIsOldFile($excelObject){
    if (trim($excelObject->val(3,'F',$excelObject->getSheetIndex('Buttons'))) == "Student Tracking System" && trim($excelObject->val(2,'A',$excelObject->getSheetIndex('Main')))=="STUDENT TRACKING")
            return TRUE;
    return FALSE;
}

/** function that inserts all the information of the students into relevant tables
 *
 * @param type $students_info 
 */
function insertStudentInfo($students_info){
    //initialise the mappings 
    $caste_map=array(""=>0,"Dalit"=>1,"Janajati"=>2,"Brahmin/Chhetri"=>3,"Others"=>4);
    $disability_map=array(""=> 0 ,"Others"=> 0," "=>0 ,"Physical"=> 1 ,"Physically Disabled"=> 1,"Mental"=> 2 ,"Mentally Disabled"=> 2 ,"Deaf"=> 3 ,"Blind"=> 4 ,"Low Vision"=> 5 
                    ,"Deaf and Blind"=>6,"Speech Impairment"=> 7, "Dumb"=> 7 ,"Multiple Disability"=>8);
    $ecd_map=array("No"=>0,"Yes"=>1);
    //insert every student
    foreach($students_info as $record)
    {
        $temp_data=array();
        $temp_data['sch_num']=$record['School ID'];
        $temp_data['sch_year']=$record['Year'];
        $temp_data['reg_id']=$record['Reg ID'];
        $temp_data['first_name']=$record['First Name'];
        $temp_data['last_name']=$record['Last Name'];
        $temp_data['gender']=$record['Gender'];
        $temp_data['father_name']=$record["Father's Name"];
        $temp_data['mother_name']=$record["Mother's Name"];

        //date needs to be validated before being imported
        if (strpos($record['Date Of Birth(AD)'],"/")!==FALSE) $dob=explode("/",convertDate($record['Date Of Birth(AD)']));
        elseif(strpos($record['Date Of Birth(AD)'],"-")!==FALSE) $dob=explode("-",convertDate($record['Date Of Birth(AD)']));

        $temp_data['dob']= $dob[0]."/".$dob[1]."/".$dob[2];
        $temp_data['caste']=$caste_map[$record['Caste']];
        $temp_data['disability']=$disability_map[$record['Disability']];
        $temp_data['ecd']=$ecd_map[$record['ECD']];
        if(isset($record["Account Number"]))    $temp_data['bank_ac_no']=$record["Account Number"];
        if(isset($record["Bank Name"]))         $temp_data['bank_name']=$record["Bank Name"];
        if(isset($record["Previous School"]))   $temp_data['previous_school']=$record["Previous School"];

        while(strlen($temp_data['reg_id'])<5)
        {
                $temp_data['reg_id']="0".$temp_data['reg_id'];
        }

        $reg_id=$temp_data['reg_id']=$temp_data['sch_num'].$temp_data['reg_id'];
        
        //now insert new data
        idata("id_students_main",$temp_data);

        //insert class and attendance tracking data
        $temp_data=array();
        for($i=2070;$i<=2081;$i++)
        {
                if(array_key_exists('cls_'.$i, $record))
                {
                        $temp_data['sch_num']=$record['School ID'];
                        $temp_data['reg_id']=$reg_id;
                        $temp_data["sch_year"]=$i;
                        
                        //to adjust PAD and FAD 
                        if(trim($record['cls_'.$i]) == "PAD") $temp_data["class"]= -1;
                        elseif(trim($record['cls_'.$i]) == "FAD") $temp_data["class"]= -2; 
                        else $temp_data["class"]=  $record['cls_'.$i];
                        
                        $temp_data["attendance"]=$record['attendance_'.$i];
                        if(isset($record['ECD Type']))      $temp_data["ecd_type"]=$record['ECD Type'];
                        if(isset($record['ECD Number']))    $temp_data["ecd_num"]=$record['ECD Number'];
                        if(isset($record['Stream']))        $temp_data["stream"]=$record['Stream'];
                        idata("id_students_track",$temp_data);
                }
        }

        //insert scholarship tracking data
        $temp_data=array();
        for($i=2070;$i<=2081;$i++)
        {
                if(array_key_exists('sch_'.$i, $record))
                {
                        $temp_data['sch_num']=$record['School ID'];
                        $temp_data['reg_id']=$reg_id;
                        $temp_data["sch_year"]=$i;
                        $temp_data["class"]=$record['cls_'.$i];
                        $temp_data["scholarship"]=$record['sch_'.$i];
                        idata("id_students_scholarship",$temp_data);
                }
        }
    }
    
}

/** function that retrieves and inserts teacher personal information into the tmis_main and tmis_sec1 tables
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherPersonalInfo($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve students marks from excel file
        foreach(createColumnsArray('AE') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            //relevant mappings
            $nationality_map=array(0=>"",1=>"Nepalese",2=>"Indian",3=>"Others");
            $language_map=array(
                                    1=>"Bhojpuri",
                                    2=>"English",
                                    3=>"Gurung",
                                    4=>"Maithali",
                                    5=>"Nepali",
                                    6=>"Newari",
                                    7=>"Sanskrit",
                                    8=>"Sherpa",
                                    9=>"Tamang",
                                    10=>"Rai",
                                    11=>"Awadhi",
                                    12=>"Hindi",
                                    13=>"Kirati",
                                    14=>"Others"
                                    );
            //insert into tmis_main
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sch_num']=$record['School ID'];   
            $temp_data['t_name']=$record['Teacher Name'];
            idata("tmis_main",$temp_data);
            
            //now import into tmis_sec1 if position is not vacant
            if (strtolower($record['Teacher Name'])!="vacant")
            {
                $temp_data=array();
                $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
                $temp_data['sch_year']=$record['Year'];   
                $temp_data['sex']=$record['Sex'];
                $temp_data['t_caste']=$record['Caste/Ethnicity']; 
                $temp_data['nationality']=$nationality_map[$record['Nationality']]; 
                //now the dob's
                if(strlen($record['Citizenship'])>7) 
                {
                    $citizenship_dob=explode("/",convertDate($record['Citizenship']));
                    $temp_data['bs_dob_day1']=$citizenship_dob[0];
                    $temp_data['bs_dob_month1']=$citizenship_dob[1];
                    $temp_data['bs_dob_year1']=$citizenship_dob[2];
                }
                if(strlen($record['Certificate'])>7) 
                {
                    $certificate_dob=explode("/",convertDate($record['Certificate']));
                    $temp_data['bs_dob_day2']=$certificate_dob[0];
                    $temp_data['bs_dob_month2']=$certificate_dob[1];
                    $temp_data['bs_dob_year2']=$certificate_dob[2];
                }
                $temp_data['citizenship_no']=$record['Citizenship No']; 
                $temp_data['citizenship_dist']=$record['Issue District']; 
                $temp_data['name_father']=$record['Father\'s Name']; 
                $temp_data['name_mother']=$record['Mother\'s Name']; 
                $temp_data['name_spouse']=$record['Spouse\'s Name']; 
                $temp_data['name_willper']=$record['Will Person']; 
                $temp_data['mother_tongue']=$language_map[$record['Mother Tongue']]; 
                $temp_data['disability_status']=$record['Disability']; 
                $temp_data['perm_addr_email']=$record['Email']; 
                $temp_data['perm_addr_phone']=$record['Telephone/Mobile No']; 
                $temp_data['curr_perm_level']=$record['Current Level']; 
                $temp_data['curr_perm_rank']=$record['Rank']; 
                $temp_data['curr_perm_type']=$record['Position']; 
                $temp_data['head_teacher']=$record['Teacher Type']; 
                $temp_data['teaching_lang']=$language_map[$record['Teaching Language']]; 
                $temp_data['license_no']=$record['License No']; 
                $temp_data['insurance_no']=$record['Insurance No']; 
                $temp_data['pf_no']=$record['PF Account No']; 
                $temp_data['trk_no']=$record['Trk No']; 
                $temp_data['account_no']=$record['Bank Account No']; 
                $temp_data['bank_name']=$record['Bank Name']; 
                
                idata("tmis_sec1",$temp_data);
            }
        }
    }
}

/** function that retrieves and inserts teacher educational information into the tmis_educational_info
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherEduInfo($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('AH') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            //insert into tmis_educational_info
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['qualification']=$record['Qualification'];   
            $temp_data['board_university']=$record['Board/University'];   
            $temp_data['passed_year']=$record['Year Passed'];   
            $temp_data['stream']=$record['Stream'];   
            $temp_data['division']=$record['Division'];   
            $temp_data['is_edu']=(bool)$record['Education Course'];   
            $temp_data['ecd']=(bool)$record['ECD'];   
            $temp_data['class1']=(bool)$record['Class 1'];   
            $temp_data['class2']=(bool)$record['Class 2'];   
            $temp_data['class3']=(bool)$record['Class 3'];   
            $temp_data['class4']=(bool)$record['Class 4'];   
            $temp_data['class5']=(bool)$record['Class 5'];   
            $temp_data['class6']=(bool)$record['Class 6'];   
            $temp_data['class7']=(bool)$record['Class 7'];   
            $temp_data['class8']=(bool)$record['Class 8'];   
            $temp_data['class9']=(bool)$record['Class 9'];   
            $temp_data['class10']=(bool)$record['Class 10'];   
            $temp_data['class11']=(bool)$record['Class 11'];   
            $temp_data['class12']=(bool)$record['Class 12'];   
            $temp_data['english']=(bool)$record['English'];   
            $temp_data['nepali']=(bool)$record['Nepali'];   
            $temp_data['maths']=(bool)$record['Math'];   
            $temp_data['science']=(bool)$record['Science'];   
            $temp_data['social']=(bool)$record['Social'];   
            $temp_data['accounts']=(bool)$record['Accounts'];   
            $temp_data['sanskrit']=(bool)$record['Sanskrit'];   
            $temp_data['popn_health']=(bool)$record['Population & Health'];   
            $temp_data['environment']=(bool)$record['Environment'];   
            $temp_data['economics']=(bool)$record['Economics'];   
            $temp_data['optional']=(bool)$record['Optional'];   
            $temp_data['others']=(bool)$record['Others'];   
            
            idata("tmis_educational_info",$temp_data);
        }
    }
}

/** function that retrieves and inserts teacher teaching information into the tmis_sec2
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeachingHistory($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('J') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sn']=$record['SN'];
            $temp_data['appoint_level']=$record['Level'];
            $temp_data['appoint_rank']=$record['Rank'];
            $temp_data['appoint_position']=$record['Position'];
            if (strlen($record['Decision Made'])>7)
            {
                $decision_date=explode("/",convertDate($record['Decision Made']));
                $temp_data['dec_year']=$decision_date[2];
                $temp_data['dec_month']=$decision_date[1];
                $temp_data['dec_day']=$decision_date[0];
            }
            if (strlen($record['Appointment Made'])>7)
            {
                $appointment_date=explode("/",convertDate($record['Appointment Made']));
                $temp_data['app_year']=$appointment_date[2];
                $temp_data['app_month']=$appointment_date[1];
                $temp_data['app_day']=$appointment_date[0];
            }
            $temp_data['app_district']=$record['District'];
            
            idata("tmis_sec2",$temp_data);
        }
    }
}


/** function that retrieves and inserts teacher education history into the tmis_edu
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherEduHistory($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('I') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sn']=$record['SN'];
            $temp_data['qualif']=$record['Qualification'];
            $temp_data['board']=$record['Board/University'];
            $temp_data['year']=$record['Passed Year'];
            $temp_data['division']=$record['Pass Division'];
            $temp_data['stream']=$record['Stream'];
            
            idata("tmis_edu",$temp_data);
        }
    }
}

/** function that retrieves and inserts teacher training info into the tmis_train
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherTraining($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('I') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sn']=$record['S.N.'];
            $temp_data['type']=$record['Type'];
            $temp_data['subj']=$record['Subject'];
            $temp_data['year']=$record['Training Year'];
            $temp_data['duration']=$record['Duration'];
            $temp_data['org']=$record['Organizer'];
            
            idata("tmis_train",$temp_data);
        }
    }
}

/** function that retrieves and inserts teacher leave info into the tmis_leave
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherLeave($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('G') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        $leave_map=array(1=>"Sick Leave",2=>"Annual Leave");
        foreach($teachers_info as $record)
        {
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sn']=$record['SN'];
            $temp_data['type']=$leave_map[$record['Type']];
            if (strlen($record['From'])>7)
            {
                $leave_start=explode("/",convertDate($record['From']));
                $temp_data['year_from']=$leave_start[2];
                $temp_data['month_from']=$leave_start[1];
                $temp_data['day_from']=$leave_start[0];
            }
            if (strlen($record['To'])>7)
            {
                $leave_end=explode("/",convertDate($record['To']));
                $temp_data['year_to']=$leave_end[2];
                $temp_data['month_to']=$leave_end[1];
                $temp_data['day_to']=$leave_end[0];
            }
            
            idata("tmis_leave",$temp_data);
        }
    }
}

/** function that retrieves and inserts teacher income details into the tmis_inc
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertTeacherIncome($excelObject,$startingRow,$sheet_index)
{
    $teachers_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('O') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($teachers_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($teachers_info))
    {
        foreach($teachers_info as $record)
        {
            $temp_data=array();
            $temp_data['tid']=$record['School ID'].$record['Teacher ID'];   
            $temp_data['sch_year']=$record['Year'];   
            $temp_data['sn']=1;
            $temp_data['src']='Nepal Government';
            
            $temp_data['scale']=$record['Monthly Salary']; 
            $temp_data['grade']=$record['Amount']; 
            $temp_data['ta']=$record['Head Teacher ']; 
            $temp_data['ra']=$record['Remote']; 
            $temp_data['insurance']=$record['Insurance']; 
            $temp_data['mahangi']=$record['Mahangi']; 
            $temp_data['dress']=$record['Dress']; 
            $temp_data['festival']=$record['Festival']; 
            $temp_data['medical']=$record['Medical']; 
            $temp_data['ma']=$record['Provident Fund']; 
            $temp_data['civil_investment']=$record['Citizen Investment Fund']; 
            $temp_data['total']=$record['Total']; 
            
            idata("tmis_inc",$temp_data);
        }
    }
}

/** function that retrieves and inserts physical details into the school_program table
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertPhysicalDetails($excelObject,$startingRow,$sheet_index)
{
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index)-1;$i++)
    {
        $temp_data=array();
        $temp_data['sch_num']=$excelObject->val($i,"A",$sheet_index);
        $temp_data['sch_year']=$excelObject->val($i,"B",$sheet_index);
        $temp_data['govt_funds_q1']=$excelObject->val($i,"C",$sheet_index);
        $temp_data['govt_funds_q1_1st']=$excelObject->val($i,"D",$sheet_index);
        $temp_data['govt_funds_q1_2nd']=$excelObject->val($i,"E",$sheet_index);
        $temp_data['govt_funds_q1_3rd']=$excelObject->val($i,"F",$sheet_index);
        $temp_data['govt_funds_q1_4th']=$excelObject->val($i,"G",$sheet_index);
        $temp_data['govt_funds_q2']=$excelObject->val($i,"H",$sheet_index);
        $temp_data['govt_funds_q2_1st']=$excelObject->val($i,"I",$sheet_index);
        $temp_data['govt_funds_q2_2nd']=$excelObject->val($i,"J",$sheet_index);
        $temp_data['govt_funds_q2_3rd']=$excelObject->val($i,"K",$sheet_index);
        $temp_data['govt_funds_q2_4th']=$excelObject->val($i,"L",$sheet_index);
        $temp_data['sip_updated_date']=convertDate($excelObject->val($i,"M",$sheet_index));
        $temp_data['social_audit_date']=convertDate($excelObject->val($i,"N",$sheet_index));
        $temp_data['financial_audit_date']=convertDate($excelObject->val($i,"O",$sheet_index));
        $temp_data['no_smc_meeting']=$excelObject->val($i,"P",$sheet_index);
        $temp_data['ext_monitor_rp']=$excelObject->val($i,"Q",$sheet_index);
        $temp_data['ext_monitor_ss']=$excelObject->val($i,"R",$sheet_index);
        $temp_data['ext_monitor_deo']=$excelObject->val($i,"S",$sheet_index);
        $temp_data['ext_monitor_doe']=$excelObject->val($i,"T",$sheet_index);
        $temp_data['ext_monitor_others']=$excelObject->val($i,"U",$sheet_index);
        $temp_data['medical_distance']=$excelObject->val($i,"V",$sheet_index);
        $temp_data['first_aid']=$excelObject->val($i,"W",$sheet_index);
        $temp_data['child_club']=$excelObject->val($i,"X",$sheet_index);
        $temp_data['no_water_source']=$excelObject->val($i,"Y",$sheet_index);
        $temp_data['no_total_toilets']=$excelObject->val($i,"Z",$sheet_index);
        $temp_data['no_girls_toilets']=$excelObject->val($i,"AA",$sheet_index);
        $temp_data['no_teachers_toilets']=$excelObject->val($i,"AB",$sheet_index);
        $temp_data['no_water_toilets']=$excelObject->val($i,"AC",$sheet_index);
        $temp_data['no_teachers_urinals']=$excelObject->val($i,"AD",$sheet_index);
        $temp_data['no_students_urinals']=$excelObject->val($i,"AE",$sheet_index);
        $temp_data['no_total_buildings']=$excelObject->val($i,"AF",$sheet_index);
        $temp_data['no_pakki_buildings']=$excelObject->val($i,"AG",$sheet_index);
        $temp_data['no_kacchi_buildings']=$excelObject->val($i,"AH",$sheet_index);
        $temp_data['compound_type']=$excelObject->val($i,"AI",$sheet_index);
        $temp_data['no_retrofitting']=$excelObject->val($i,"AJ",$sheet_index);
        $temp_data['no_rehabilitation']=$excelObject->val($i,"AK",$sheet_index);
        $temp_data['playground_status']=$excelObject->val($i,"AL",$sheet_index);
        $temp_data['enough_space']=$excelObject->val($i,"AM",$sheet_index);
        $temp_data['electricity_status']=$excelObject->val($i,"AN",$sheet_index);
        $temp_data['no_computers_total']=$excelObject->val($i,"AO",$sheet_index);
        $temp_data['no_computers_teaching']=$excelObject->val($i,"AP",$sheet_index);
        $temp_data['no_computers_learning']=$excelObject->val($i,"AQ",$sheet_index);
        $temp_data['internet_status']=$excelObject->val($i,"AR",$sheet_index);
        $temp_data['no_books_library']=$excelObject->val($i,"AS",$sheet_index);
        $temp_data['school_land_bigha']=$excelObject->val($i,"AT",$sheet_index);
        $temp_data['school_land_kattha']=$excelObject->val($i,"AU",$sheet_index);
        $temp_data['school_land_dhur']=$excelObject->val($i,"AV",$sheet_index);
        $temp_data['school_land_ropani']=$excelObject->val($i,"AW",$sheet_index);
        $temp_data['school_land_aana']=$excelObject->val($i,"AX",$sheet_index);
        $temp_data['school_land_paisa']=$excelObject->val($i,"AY",$sheet_index);
        $temp_data['school_land_dam']=$excelObject->val($i,"AZ",$sheet_index);
        
        $temp_data['rooms_ecd_total']=$excelObject->val($i,"BA",$sheet_index);
        $temp_data['rooms_ecd_pakki']=$excelObject->val($i,"BB",$sheet_index);
        $temp_data['rooms_class1_total']=$excelObject->val($i,"BC",$sheet_index);
        $temp_data['rooms_class1_pakki']=$excelObject->val($i,"BD",$sheet_index);
        $temp_data['rooms_class2_total']=$excelObject->val($i,"BE",$sheet_index);
        $temp_data['rooms_class2_pakki']=$excelObject->val($i,"BF",$sheet_index);
        $temp_data['rooms_class3_total']=$excelObject->val($i,"BG",$sheet_index);
        $temp_data['rooms_class3_pakki']=$excelObject->val($i,"BH",$sheet_index);
        $temp_data['rooms_class4_total']=$excelObject->val($i,"BI",$sheet_index);
        $temp_data['rooms_class4_pakki']=$excelObject->val($i,"BJ",$sheet_index);
        $temp_data['rooms_class5_total']=$excelObject->val($i,"BK",$sheet_index);
        $temp_data['rooms_class5_pakki']=$excelObject->val($i,"BL",$sheet_index);
        $temp_data['rooms_class6_total']=$excelObject->val($i,"BM",$sheet_index);
        $temp_data['rooms_class6_pakki']=$excelObject->val($i,"BN",$sheet_index);
        $temp_data['rooms_class7_total']=$excelObject->val($i,"BO",$sheet_index);
        $temp_data['rooms_class7_pakki']=$excelObject->val($i,"BP",$sheet_index);
        $temp_data['rooms_class8_total']=$excelObject->val($i,"BQ",$sheet_index);
        $temp_data['rooms_class8_pakki']=$excelObject->val($i,"BR",$sheet_index);
        $temp_data['rooms_class9_total']=$excelObject->val($i,"BS",$sheet_index);
        $temp_data['rooms_class9_pakki']=$excelObject->val($i,"BT",$sheet_index);
        $temp_data['rooms_class10_total']=$excelObject->val($i,"BU",$sheet_index);
        $temp_data['rooms_class10_pakki']=$excelObject->val($i,"BV",$sheet_index);
        $temp_data['rooms_class11_total']=$excelObject->val($i,"BW",$sheet_index);
        $temp_data['rooms_class11_pakki']=$excelObject->val($i,"BX",$sheet_index);
        $temp_data['rooms_class12_total']=$excelObject->val($i,"BY",$sheet_index);
        $temp_data['rooms_class12_pakki']=$excelObject->val($i,"BZ",$sheet_index);
        
        $temp_data['grant_books_ecd']=$excelObject->val($i,"CA",$sheet_index);
        $temp_data['grant_books_pri']=$excelObject->val($i,"CB",$sheet_index);
        $temp_data['grant_books_lsec']=$excelObject->val($i,"CC",$sheet_index);
        $temp_data['grant_books_sec']=$excelObject->val($i,"CD",$sheet_index);
        $temp_data['grant_books_hsec']=$excelObject->val($i,"CE",$sheet_index);
        $temp_data['grant_sch_ecd']=$excelObject->val($i,"CF",$sheet_index);
        $temp_data['grant_sch_pri']=$excelObject->val($i,"CG",$sheet_index);
        $temp_data['grant_sch_lsec']=$excelObject->val($i,"CH",$sheet_index);
        $temp_data['grant_sch_sec']=$excelObject->val($i,"CI",$sheet_index);
        $temp_data['grant_sch_hsec']=$excelObject->val($i,"CJ",$sheet_index);
        $temp_data['grant_pcf_ecd']=$excelObject->val($i,"CK",$sheet_index);
        $temp_data['grant_pcf_pri']=$excelObject->val($i,"CL",$sheet_index);
        $temp_data['grant_pcf_lsec']=$excelObject->val($i,"CM",$sheet_index);
        $temp_data['grant_pcf_sec']=$excelObject->val($i,"CN",$sheet_index);
        $temp_data['grant_pcf_hsec']=$excelObject->val($i,"CO",$sheet_index);
        $temp_data['grant_cas_ecd']=$excelObject->val($i,"CP",$sheet_index);
        $temp_data['grant_cas_pri']=$excelObject->val($i,"CQ",$sheet_index);
        $temp_data['grant_cas_lsec']=$excelObject->val($i,"CR",$sheet_index);
        $temp_data['grant_cas_sec']=$excelObject->val($i,"CS",$sheet_index);
        $temp_data['grant_cas_hsec']=$excelObject->val($i,"CT",$sheet_index);
        $temp_data['grant_operation_ecd']=$excelObject->val($i,"CU",$sheet_index);
        $temp_data['grant_operation_pri']=$excelObject->val($i,"CV",$sheet_index);
        $temp_data['grant_operation_lsec']=$excelObject->val($i,"CW",$sheet_index);
        $temp_data['grant_operation_sec']=$excelObject->val($i,"CX",$sheet_index);
        $temp_data['grant_operation_hsec']=$excelObject->val($i,"CY",$sheet_index);
        
        $temp_data['textbook_ecd']=$excelObject->val($i,"CZ",$sheet_index);
        $temp_data['textbook_pri']=$excelObject->val($i,"DA",$sheet_index);
        $temp_data['textbook_lsec']=$excelObject->val($i,"DB",$sheet_index);
        $temp_data['textbook_sec']=$excelObject->val($i,"DC",$sheet_index);
        $temp_data['textbook_hsec']=$excelObject->val($i,"DD",$sheet_index);
        $temp_data['teachingmanual_ecd']=$excelObject->val($i,"DE",$sheet_index);
        $temp_data['teachingmanual_pri']=$excelObject->val($i,"DF",$sheet_index);
        $temp_data['teachingmanual_lsec']=$excelObject->val($i,"DG",$sheet_index);
        $temp_data['teachingmanual_sec']=$excelObject->val($i,"DH",$sheet_index);
        $temp_data['teachingmanual_hsec']=$excelObject->val($i,"DI",$sheet_index);
        $temp_data['childmaterial_ecd']=$excelObject->val($i,"DJ",$sheet_index);
        $temp_data['childmaterial_pri']=$excelObject->val($i,"DK",$sheet_index);
        $temp_data['childmaterial_lsec']=$excelObject->val($i,"DL",$sheet_index);
        $temp_data['childmaterial_sec']=$excelObject->val($i,"DM",$sheet_index);
        $temp_data['childmaterial_hsec']=$excelObject->val($i,"DN",$sheet_index);
        $temp_data['bookcorner_ecd']=$excelObject->val($i,"DO",$sheet_index);
        $temp_data['bookcorner_pri']=$excelObject->val($i,"DP",$sheet_index);
        $temp_data['bookcorner_lsec']=$excelObject->val($i,"DQ",$sheet_index);
        $temp_data['bookcorner_sec']=$excelObject->val($i,"DR",$sheet_index);
        $temp_data['bookcorner_hsec']=$excelObject->val($i,"DS",$sheet_index);
        $temp_data['curriculum_available_ecd']=$excelObject->val($i,"DT",$sheet_index);
        $temp_data['curriculum_available_pri']=$excelObject->val($i,"DU",$sheet_index);
        $temp_data['curriculum_available_lsec']=$excelObject->val($i,"DV",$sheet_index);
        $temp_data['curriculum_available_sec']=$excelObject->val($i,"DW",$sheet_index);
        $temp_data['curriculum_available_hsec']=$excelObject->val($i,"DX",$sheet_index);
        $temp_data['localcurr_ecd']=$excelObject->val($i,"DY",$sheet_index);
        $temp_data['localcurr_pri']=$excelObject->val($i,"DZ",$sheet_index);
        $temp_data['localcurr_lsec']=$excelObject->val($i,"EA",$sheet_index);
        $temp_data['localcurr_sec']=$excelObject->val($i,"EB",$sheet_index);
        $temp_data['localcurr_hsec']=$excelObject->val($i,"EC",$sheet_index);
        $temp_data['ref_material_ecd']=$excelObject->val($i,"ED",$sheet_index);
        $temp_data['ref_material_pri']=$excelObject->val($i,"EE",$sheet_index);
        $temp_data['ref_material_lsec']=$excelObject->val($i,"EF",$sheet_index);
        $temp_data['ref_material_sec']=$excelObject->val($i,"EG",$sheet_index);
        $temp_data['ref_material_hsec']=$excelObject->val($i,"EH",$sheet_index);
       
        $temp_data['new_building_deo']=$excelObject->val($i,"EI",$sheet_index);
        $temp_data['new_building_ddc']=$excelObject->val($i,"EJ",$sheet_index);
        $temp_data['new_building_others']=$excelObject->val($i,"EK",$sheet_index);
        $temp_data['rehab_building_deo']=$excelObject->val($i,"EL",$sheet_index);
        $temp_data['rehab_building_ddc']=$excelObject->val($i,"EM",$sheet_index);
        $temp_data['rehab_building_others']=$excelObject->val($i,"EN",$sheet_index);
        $temp_data['new_room_deo']=$excelObject->val($i,"EO",$sheet_index);
        $temp_data['new_room_ddc']=$excelObject->val($i,"EP",$sheet_index);
        $temp_data['new_room_others']=$excelObject->val($i,"EQ",$sheet_index);
        $temp_data['rehab_room_deo']=$excelObject->val($i,"ER",$sheet_index);
        $temp_data['rehab_room_ddc']=$excelObject->val($i,"ES",$sheet_index);
        $temp_data['rehab_room_others']=$excelObject->val($i,"ET",$sheet_index);
        $temp_data['total_toilets_deo']=$excelObject->val($i,"EU",$sheet_index);
        $temp_data['total_toilets_ddc']=$excelObject->val($i,"EV",$sheet_index);
        $temp_data['total_toilets_others']=$excelObject->val($i,"EW",$sheet_index);
        $temp_data['girls_toilets_deo']=$excelObject->val($i,"EX",$sheet_index);
        $temp_data['girls_toilets_ddc']=$excelObject->val($i,"EY",$sheet_index);
        $temp_data['girls_toilets_others']=$excelObject->val($i,"EZ",$sheet_index);
        $temp_data['water_deo']=$excelObject->val($i,"FA",$sheet_index);
        $temp_data['water_ddc']=$excelObject->val($i,"FB",$sheet_index);
        $temp_data['water_others']=$excelObject->val($i,"FC",$sheet_index);
        $temp_data['book_corner_deo']=$excelObject->val($i,"FD",$sheet_index);
        $temp_data['book_corner_ddc']=$excelObject->val($i,"FE",$sheet_index);
        $temp_data['book_corner_others']=$excelObject->val($i,"FF",$sheet_index);
        
        $temp_data['schoolopen_planneddays']=$excelObject->val($i,"FG",$sheet_index);
        $temp_data['schoolopen_actualdays']=$excelObject->val($i,"FH",$sheet_index);
        $temp_data['teaching_planneddays']=$excelObject->val($i,"FI",$sheet_index);
        $temp_data['teaching_actualdays']=$excelObject->val($i,"FJ",$sheet_index);
        $temp_data['exam_planneddays']=$excelObject->val($i,"FK",$sheet_index);
        $temp_data['exam_actualdays']=$excelObject->val($i,"FL",$sheet_index);
        $temp_data['curricular_planneddays']=$excelObject->val($i,"FM",$sheet_index);
        $temp_data['curricular_actualdays']=$excelObject->val($i,"FN",$sheet_index);
        $temp_data['public_holidays_planned']=$excelObject->val($i,"FO",$sheet_index);
        $temp_data['public_holidays_actual']=$excelObject->val($i,"FP",$sheet_index);
        $temp_data['festivals_planneddays']=$excelObject->val($i,"FQ",$sheet_index);
        $temp_data['festivals_actualdays']=$excelObject->val($i,"FR",$sheet_index);
        $temp_data['others_planneddays']=$excelObject->val($i,"FS",$sheet_index);
        $temp_data['others_actualdays']=$excelObject->val($i,"FT",$sheet_index);
        
        $temp_data['headmaster_room']=$excelObject->val($i,"FU",$sheet_index);
        $temp_data['computer_room']=$excelObject->val($i,"FV",$sheet_index);
        $temp_data['staff_room']=$excelObject->val($i,"FW",$sheet_index);
        $temp_data['store_room']=$excelObject->val($i,"FX",$sheet_index);
        $temp_data['sports_room']=$excelObject->val($i,"FY",$sheet_index);
        $temp_data['library_room']=$excelObject->val($i,"FZ",$sheet_index);
        $temp_data['science_lab_room']=$excelObject->val($i,"GA",$sheet_index);
        $temp_data['unused_room']=$excelObject->val($i,"GB",$sheet_index);
        
        idata("id_physical_details",$temp_data);
    }   
}

/** function that checks whether record of a school exists in given table
 *
 * @param type $tableName
 * @param type $conditions
 * @return boolean 
 */
function checkIfRecordExists($tableName,$conditions){
    $where="";
    foreach ($conditions as $column=>$value){
        if (strlen($where)>0)
            $where.=" AND ";
        $where.="$column='$value'";
    }
    $result = mysql_query("SELECT count(*) as count FROM ".$tableName." WHERE $where;");
    $row = mysql_fetch_array($result);
    if($row['count']>0)
        return TRUE;
    return FALSE;
}

/** function that generates list of column names upto a given column in excel
 *
 * @param type $end_column
 * @param type $first_letters
 * @return string 
 */
function createColumnsArray($end_column, $first_letters = '')
{
  $columns = array();
  $length = strlen($end_column);
  $letters = range('A', 'Z');

  // Iterate over 26 letters.
  foreach ($letters as $letter) {
      // Paste the $first_letters before the next.
      $column = $first_letters . $letter;

      // Add the column to the final array.
      $columns[] = $column;

      // If it was the end column that was added, return the columns.
      if ($column == $end_column)
          return $columns;
  }

  // Add the column children.
  foreach ($columns as $column) {
      // Don't itterate if the $end_column was already set in a previous itteration.
      // Stop iterating if you've reached the maximum character length.
      if (!in_array($end_column, $columns) && strlen($column) < $length) {
          $new_columns = createColumnsArray($end_column, $column);
          // Merge the new columns which were created with the final columns array.
          $columns = array_merge($columns, $new_columns);
      }
  }

  return $columns;
}

function convertDate($excel_date)
{
     if($excel_date !="")
     {
        list($day, $month, $year) = explode('/', $excel_date);
        
        //date needs to be adjusted if the year is prior to 1980
        if($year<1980)
        {
            //adjust the date if it is out of range
            if ($day==0 or $day>31) $day[0]=1;       
            if ($month==0 or $month>12) $month=1;
            
            $dateObject=new DateTime("$year-$month-$day");
            $dateObject->modify('+49682 day');
            $date=$dateObject->format('j/n/Y');
        }
        else
            $date=$excel_date;
        return $date;
     }
}

?>
