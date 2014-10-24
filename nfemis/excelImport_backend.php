<?php
/** function that checks whether the file being imported is valid
 * and the record of the agency exists in the database
 *
 * @param type $excelObject
 * @param int $agency_code
 * @param int year
 * @return boolean 
 */
function checkIsValidFile($excelObject,$agency_code,$year){
    if (trim($excelObject->val(1,'A',$excelObject->getSheetIndex('General'))) == "NFEMIS")
    {
        $query="SELECT * FROM nfe_mast_agency WHERE dist_code=".substr($agency_code,0,2)." AND agency_code=".substr($agency_code,2,4)." AND year=".$year.";";
        $result = mysql_query($query);
        if (mysql_num_rows($result)) 
            return TRUE;
    }
    return FALSE;
}

/** function that checks whether record of an agency exists in given table
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

/** function that retrieves and inserts agency details into the nfe_agency_details
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertAgencyGeneralInfo($excelObject,$startingRow,$sheet_index)
{
    $agency_info=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('AO') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($agency_info,$temp_array);
    }   
    //now insert each teacher into the database
    if(!empty($agency_info))
    {
        foreach($agency_info as $record)
        {
            //insert into nfe_agency_details
            $temp_data=array();
            $temp_data['center_id']=$record[' Center ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['agency_name']=$record['Agency Name'];   
            $temp_data['estd_date']=$record['Estd Date.'];   
            $temp_data['telephone_no']=$record['Telephone'];   
            $temp_data['fax']=$record['Fax'];   
            $temp_data['email']=$record['Email'];   
            $temp_data['contact_person']=$record['Contact Person'];   
            $temp_data['bank_ac_no']=$record['Bank Account No'];   
            $temp_data['bank_name']=$record['Name of Bank'];   
            $temp_data['mc_estd_date']=$record['SMC Estd Date'];   
            $temp_data['no_of_meetings']=$record['No of Meetings'];   
            $temp_data['social_audit']=(bool)$record['Social Audit'];   
            $temp_data['financial_audit']=(bool)$record['Audit'];   
         
            idata("nfe_agency_details",$temp_data);
        }
    }
}


/** function that retrieves and inserts information about committee members into the nfe_cmt_members
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertCommitteeMembersInfo($excelObject,$startingRow,$sheet_index)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('L') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$record['Center ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['name']=$record['Name'];   
            $temp_data['position']=$record['Position'];   
            $temp_data['gender']=$record['Sex'];   
            $temp_data['dob']=$record['Date of Birth'];   
            $temp_data['caste']=$record['Caste'];   
            $temp_data['education_qualif']=$record['Education'];   
            $temp_data['training_taken']=$record['Training'];   
            $temp_data['training_year']=$record['Training Year'];   
         
            idata("nfe_cmt_members",$temp_data);
        }
    }
}


/** function that retrieves and inserts information about CLC subcommittee into the nfe_clc_subcmt
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertCLCSucommitteeInfo($excelObject,$startingRow,$sheet_index)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('F') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$record['Center ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['name']=$record['Name'];   
            $temp_data['no_of_members']=$record['Number of Members'];   
         
            idata("nfe_clc_subcmt",$temp_data);
        }
    }
}


/** function that retrieves and inserts information about CLC Activities into the nfe_clc_activities
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertCLCActivitiesInfo($excelObject,$startingRow,$sheet_index)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('I') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$record['Center ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['name']=$record['Name of Activity'];   
            $temp_data['frequency']=$record['Number of Times'];   
            $temp_data['beneficiaries']=$record['Number'];   
            $temp_data['cost']=$record['Cost'];   
            $temp_data['helping_org']=$record['Helping Organization'];   
         
            idata("nfe_clc_activities",$temp_data);
        }
    }
}


/** function that retrieves and inserts information about CLC Property into the nfe_clc_property
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertCLCPropertyInfo($excelObject,$startingRow,$sheet_index)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('K') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$record['Center ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['land']=$record['Land'];   
            $temp_data['buildings']=$record['Building'];   
            $temp_data['computers']=$record['Computer'];   
            $temp_data['printers']=$record['Printer'];   
            $temp_data['closets']=$record['Closet'];   
            $temp_data['tables']=$record['Table'];   
            $temp_data['chairs']=$record['Chair'];   
            $temp_data['library']=$record['Library'];   
         
            idata("nfe_clc_property",$temp_data);
        }
    }
}

/** function that retrieves and inserts information about Classes in the nfe_class_details
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 */
function insertClassDetails($excelObject,$startingRow,$sheet_index)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('P') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$record['Center ID'];   
            $temp_data['working_id']=$record['Working ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['class_number']=$record['Class Number'];   
            $temp_data['class_type']=$record['Class Type'];   
            $temp_data['level']=$record['Level'];   
            $temp_data['class_name']=$record['Class Name'];   
            $temp_data['class_start_date']=$record['Classes Start Date'];   
            $temp_data['class_end_date']=$record['Classes End Date'];   
            $temp_data['total_days']=$record['Total Days'];   
            $temp_data['class_time']=$record['Class Time'];   
            $temp_data['ward']=$record['Ward'];   
            $temp_data['location']=$record['Location'];   
            $temp_data['school_id']=$record['School ID'];   
         
            idata("nfe_class_details",$temp_data);
        }
    }
}

/** function that retrieves and inserts information about Facilitators in the nfe_facilitators
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 * @param long $agency_code
 */
function insertFacilitatorDetails($excelObject,$startingRow,$sheet_index,$agency_code)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('M') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$agency_code;   
            $temp_data['working_id']=$record['Working ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['class_number']=$record['Class Number'];   
            $temp_data['class_type']=$record['Class Type'];   
            $temp_data['name']=$record['Name'];   
            $temp_data['dob']=$record['Date of Birth'];   
            $temp_data['sex']=$record['Sex'];   
            $temp_data['education']=$record['Education'];   
            $temp_data['training']=$record['Training'];   
         
            idata("nfe_facilitators",$temp_data);
        }
    }
}

/** function that retrieves and inserts information about Participants in the nfe_participants
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 * @param long $agency_code
 */
function insertParticipantDetails($excelObject,$startingRow,$sheet_index,$agency_code)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('U') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$agency_code;   
            $temp_data['working_id']=$record['Working ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['class_number']=$record['Class Number'];   
            $temp_data['class_type']=$record['Class Type'];   
            $temp_data['name']=$record['Name'];   
            $temp_data['dob']=$record['Date of Birth'];   
            $temp_data['sex']=$record['Sex'];   
            $temp_data['caste']=$record['Caste'];   
            $temp_data['education']=$record['Education'];   
            $temp_data['disability']=$record['Disability'];   
            $temp_data['avg_attendance']=$record['Average Attendance'];   
            $temp_data['dropout']=$record['Dropout'];   
            $temp_data['pretest_score']=$record['Pre Test Score'];   
            $temp_data['posttest_score']=$record['Post Test Score'];   
            $temp_data['transition_school']=$record['Transition to School'];   
            $temp_data['school_id']=$record['SchoolID'];   
            $temp_data['class']=$record['Class'];   
            $temp_data['age']=$record['Age'];   
         
            idata("nfe_participants",$temp_data);
        }
    }
}

/** function that retrieves and inserts information about Businesses in the nfe_business_details
 *
 * @param type $excelObject
 * @param type $startingRow
 * @param type $sheet_index 
 * @param long $agency_code
 */
function insertBusinessDetails($excelObject,$startingRow,$sheet_index,$agency_code)
{
    $rows=array();
    for($i=$startingRow;$i<=$excelObject->rowcount($sheet_index);$i++)
    {
        $temp_array=array();
        //retrieve rows as associative array
        foreach(createColumnsArray('R') as $alphabet)
                $temp_array[$excelObject->val($startingRow-1,$alphabet,$sheet_index)]=$excelObject->val($i,$alphabet,$sheet_index);
        
        if($excelObject->val($i,'A',$sheet_index)!=="")
            array_push($rows,$temp_array);
    }   
    
    //now insert each row into the database
    if(!empty($rows))
    {
        foreach($rows as $record)
        {
            $temp_data=array();
            $temp_data['center_id']=$agency_code;   
            $temp_data['working_id']=$record['Working ID'];   
            $temp_data['year']=$record['Year'];   
            $temp_data['agency_type']=$record['Agency Type'];   
            $temp_data['sn']=$record['SN'];   
            $temp_data['class_number']=$record['Class Number'];   
            $temp_data['class_type']=$record['Class Type'];   
            $temp_data['business_type']=$record['Business Type'];   
            $temp_data['subject_training']=$record['Subject Training'];   
            $temp_data['savings_training']=$record['Savings/Loan Training'];   
            $temp_data['seed_money']=$record['Seed Money'];   
            $temp_data['saving_collected']=$record['Saving Collected'];   
            $temp_data['loan_taken']=$record['Loan Taken'];   
            $temp_data['loan_investment']=$record['Loan Investment'];   
            $temp_data['business_investment']=$record['Business Investment'];   
            $temp_data['cash_saving']=$record['Cash Saving'];   
            $temp_data['business_definition']=$record['Business Definition'];   
            $temp_data['total_profit_loss']=$record['Total Profit/Loss'];   
         
            idata("nfe_business_details",$temp_data);
        }
    }
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
?>
