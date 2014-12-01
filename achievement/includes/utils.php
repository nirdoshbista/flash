<?php
/**
 * Inserts textbox
 *
 * @param $id Object ID
 * @param $label Label
 * @param $size Size (length, visible) of data
 * @param $maxlength Maximum length of data
 * @param $dtype Data type (int, string)
 * @param $extraargs Extra arguments for the input field
 */
function inserttextbox($id, $label, $size, $maxlength, $dtype='string', $extraargs=''){
	echo "<div class='inputbox'>\n";
	
	if ($dtype == 'int') $fns = " onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' ";
	if ($dtype == 'string') $fns = " onkeypress='return generalKeyPress(this, event);' onchange='handleChange(this)' ";
		
	if (substr($label,0,1)=='#') {
		$orglabel = $label;
		$label = substr($label,1);
		echo "<label><a href='#' onclick='addNewValueModal(document.getElementById(\"$id\"))' onfocus='document.getElementById(\"$id\").focus();' title='Click here or press [Ctrl-a] to add new $label'>$label</a></label>";
	}
	else echo "<label>$label</label>";
	
	echo "<input type='text' name='$id' id='$id' size='$size' maxlength='$maxlength' title='$label' $fns $extraargs>\n";	
	
	if ($orglabel=='#' && $dtype=='string') echo "<a href='#' onclick='addNewValueModal(document.getElementById(\"$id\"))' onfocus='document.getElementById(\"$id\").focus();' title='Click here or press [Ctrl-a] to add new.'><img src='images/add.png' border='0'></a>";
	
	echo "</div>\n";

}

/**
 * Inserts a hidden textbox
 *
 * @param $id Object ID
 * @param $label Label
 * @param $size Size (length, visible) of data
 * @param $maxlength Maximum length of data
 * @param $dtype Data type (int, string)
 * @param $extraargs Extra arguments for the input field
 */
function inserthiddentextbox($id, $label, $size, $maxlength, $dtype='string', $extraargs=''){
	echo "<div class='inputbox'>\n";
	
	if ($dtype == 'int') $fns = " onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this)' ";
	if ($dtype == 'string') $fns = " onkeypress='return generalKeyPress(this, event);' onchange='handleChange(this)' ";
		
	if (substr($label,0,1)=='#') {
		$orglabel = $label;
		$label = substr($label,1);
		echo "<label><a href='#' onclick='addNewValueModal(document.getElementById(\"$id\"))' onfocus='document.getElementById(\"$id\").focus();' title='Click here or press [Ctrl-a] to add new $label'>$label</a></label>";
	}
	else echo "<label>$label</label>";
	
	echo "<input type='hidden' name='$id' id='$id' size='$size' maxlength='$maxlength' title='$label' $fns $extraargs>\n";	
	
	if ($orglabel=='#' && $dtype=='string') echo "<a href='#' onclick='addNewValueModal(document.getElementById(\"$id\"))' onfocus='document.getElementById(\"$id\").focus();' title='Click here or press [Ctrl-a] to add new.'><img src='images/add.png' border='0'></a>";
	
	echo "</div>\n";

}

/**
 * Inserts Combobox
 *
 * @param $id Object ID
 * @param $label Label
 * @param $list List to be displayed (with key)
 * @param boolean $sort Sort bool
 * @param $extraargs Extra arguments for the input field 
 */
function insertcombobox($id, $label, $list, $sort = false, $extraargs=''){
	echo "<div class='inputbox'>\n";
	echo "<label>$label</label>";
	echo "<select id='$id' name='$id' title='$label' onkeypress='return generalKeyPress(this, event); ' onchange='handleChange(this)' $extraargs>\n";

	if ($sort==true) asort($list);

	echo "<option value=''></option>\n";
	
	$k = array_keys($list);
	$v = array_values($list);
	for ($i=0;$i<count($list);$i++){
		printf("<option value='%s'>%s</option>\n",$k[$i],trim($v[$i]));
	}

	echo "</select>\n";
	echo "</div>\n";
}

function insertclear(){
	echo "<div style='clear: both;'></div>\n";
}

function insertlabel($t){
	echo "<div class='inputbox'><label>$t</label></div>\n";
}

function isValidSchool($sch_num){
	global $dblink;
	if ($sch_num=='') return false;
	
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$sch_num'");
	if (mysql_num_rows($result)>0) return true; 
	else return false;
}

function file2array($filename,$index=-1){
	
	$c = $index;
	
	$arr = array();
	foreach (explode("\n",file_get_contents($filename)) as $l){
		if (trim($l)=='') continue;
		
		if ($index==-1) $arr[$l] = $l;
		else $arr[$c] = $l;

		$c++;
	}
	
	return $arr;
}

function newStudentID($prefix){
	
	global $currentyear, $dblink;
		
	$id='';
	// get id from students_static
	$result = mysql_query("SELECT SUBSTR(stu_num,12) AS id FROM student_main WHERE stu_num LIKE '$prefix%' ORDER BY id DESC LIMIT 0,1");
	if (mysql_num_rows($result)>0){
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
	}

	if ($id==''){
		$suffix='0001';
	}
	else{
		$suffix=str_pad($id+1,4,'0',STR_PAD_LEFT);
	}
	
	return ($prefix.$suffix);
}

/** function that calculates and sets grace marks for all students in the current year specified
 *  and the grace marks allowed
 * @param int $currentyear 
 * @param int $grace_allowed
 */
function calculateGraceMarks($currentyear,$grace_allowed)
{
    $dist_code=0;
    $class=0;
    $marks = mysql_query("SELECT * FROM student_marks WHERE sch_year='$currentyear' order by stu_num");
    while ($marks_row = mysql_fetch_assoc($marks))
    {   
        $total_grace=0;
        if ($dist_code!==substr($marks_row["stu_num"], 0,2) or $class!==$marks_row["class"])
        {        
            //get the list of subjects for the current year
            $subjects=array();
            $dist_code=  substr($marks_row["stu_num"], 0,2);
            $class=$marks_row["class"];
            $result1 = mysql_query("SELECT * FROM subjects WHERE class='$class' and dist_code='$dist_code' and sch_year='$currentyear' order by subject_sn");
            while ($row1 = mysql_fetch_assoc($result1))
                $subjects[$row1['subject_sn']]=  $row1;
        }
        
        //calculate the total grace marks needed for the student
        for ($i=1;$i<=count($subjects);$i++){
            if($marks_row["s{$i}_theory"]<$subjects[$i]['subject_theory_pass_mark'])
                $total_grace+=$subjects[$i]['subject_theory_pass_mark']-$marks_row["s{$i}_theory"];
        }
        //no need to continue if the student doesnot require any grace
        if ($total_grace==0) continue;
        
        //now update the row where necessary
        $dm=array();
        for ($i=1;$i<=count($subjects);$i++){
                //to display grace check if allowed grace marks has been set,student has failed in particular subject 
                //and whether total grace for a student is less 
                //than the allowed value of the grace marks
                if(($marks_row["s{$i}_theory"]<$subjects[$i]['subject_theory_pass_mark']) AND ($total_grace<=$grace_allowed)) 
                    $dm["s{$i}_grace"]=$subjects[$i]['subject_theory_pass_mark']-$marks_row["s{$i}_theory"];
                else
                    $dm["s{$i}_grace"]=0;
		
                if(((int)$marks_row["s{$i}_theory"]+(int)$dm["s{$i}_grace"])>=$subjects[$i]['subject_theory_pass_mark'])
                    $dm["s{$i}_subject"]="Pass";
                else
                    $dm["s{$i}_subject"]="Fail";    
                 
		$dm["s{$i}"]=(int)$marks_row["s{$i}_practical"]+(int)$marks_row["s{$i}_theory"]+(int)$dm["s{$i}_grace"];
	}
	udata('student_marks',$dm,array('stu_num'=>$marks_row["stu_num"],'sch_year'=>$currentyear,'class'=>$class));
    }
}
?>
