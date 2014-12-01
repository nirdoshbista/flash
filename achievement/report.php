<?php

require_once("includes/bootstrap.php");
require_once("nepalicalendar.php");

$s = $_GET['s'];
$y = $_GET['y'];
$c = $_GET['c'];
$p = $_GET['p'];
$op = $_GET['op'];
$id = $_GET['id'];
$r = $_GET['r'];
//password to protect the worksheet
$password="apple";


if (!($r=='marksheet' || $r=='ledger')){
	die();
}

$cal = new Nepali_Calendar();
if($r=='ledger' and $_GET['format']=='excel')
{
    //create directory in desktop for the exported excel file
    $directory="Reports";
    $path=getenv('ALLUSERSPROFILE')."\\Desktop\\".$directory;
    if (!file_exists($path)) {
        mkdir($directory,0777,true);
        rename($directory,$path);
    }
    
    //param1->server i.e localhost
    //param2->database name i.e "achievement"
    //param3->flash database name i.e "flash"
    //param4->username i.e "root"
    //param5->password i.e "admin"
    //param6->location code i.e "690010001" or "69001"
    //param7->current year selected in IEMIS
    //param8->class selected
    //param9->filter ie students upto,below,between and so on
    //param10->ID1 i.e lower limit
    //param11->ID2 i.e upper limit
    //param12->temp. file path i.e "C:\Program Files\Flash\htdocs\achievement\"
    //param12->password to lock the sheet
    //check the version of office installed 
    $parameters=$dbserver.",".$dbname.",".$flashdbname.",".$dbusername.",".$dbpassword.",".$s.",".$y.",".$c.",".$op.",".$id.",".$_GET['id2'].",".dirname(__FILE__)."\\report".",".$password;
    if (file_exists("C:\Program Files\Microsoft Office\Office12\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office12\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportLedger2007.exe\" ".$parameters;
    }
    else if (file_exists("C:\Program Files\Microsoft Office\Office14\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office14\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportLedger2010.exe\" ".$parameters;
    }
    
    $output=shell_exec($cmd);
    
    //delete if a file already exists in desktop and
    //move the temp file to the desktop
    if(file_exists($path."\\Ledger-".$s.".xls"))
        unlink($path."\\Ledger-".$s.".xls");
    rename(dirname(__FILE__)."\\report\\Ledger.xls",$path."\\Ledger-".$s.".xls");
        
    
    //report has been generated so navigate to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
}

// get mark related settings
if ($r=="marksheet" || $r=="ledger"){
	$show_total_if_failed = $SETTINGS[$r.'_show_total_if_failed'];
	$add_failed_mark_to_total = $SETTINGS[$r.'_add_failed_mark_to_total'];
	$show_failed_marks = $SETTINGS[$r.'_show_failed_marks'];
}

$limitclause = '';
if ($id!=''){
	
	//check if $id is valid
	
	$result = mysql_query("SELECT stu_num FROM student_main WHERE stu_num='$id' AND sch_year='$y'");
	if (mysql_num_rows($result)>0){
		
		if ($op=='eq') $op='=';
		if ($op=='lt') $op='<=';
		if ($op=='gt') $op='>';
		
		$limitclause = " AND stu_num $op '$id' ";
		
		if ($op=='bt') {
			$limitclause = " AND stu_num>='$id' AND stu_num<='{$_GET['id2']}' ";
		}
	}
}

// get subjects data
$dist_code = substr($s,0,2);
$result = mysql_query("SELECT * FROM subjects WHERE dist_code='$dist_code' AND class='$c' AND sch_year='$y' ORDER BY subject_sn");

$subjects = array();
$total_subjects = 0;
$total_mark = 0;
while ($row = mysql_fetch_assoc($result)){
	$subjects[$row['subject_sn']]['name']=$row['subject_name'];
	$subjects[$row['subject_sn']]['thfm']=$row['subject_theory_full_mark'];
	$subjects[$row['subject_sn']]['thpm']=$row['subject_theory_pass_mark'];
	$subjects[$row['subject_sn']]['prfm']=$row['subject_practical_full_mark'];
	$subjects[$row['subject_sn']]['prpm']=$row['subject_practical_pass_mark'];
	$total_subjects++;
	$total_mark += ($row['subject_theory_full_mark']+$row['subject_practical_full_mark']);
	$pass_mark += ($row['subject_theory_full_mark']+$row['subject_practical_full_mark']);
	
	$subject_data["s{$total_subjects}_name"] = $row['subject_name'];
	$subject_data["s{$total_subjects}_theory_full_mark"] = $row['subject_theory_full_mark'];
	$subject_data["s{$total_subjects}_theory_pass_mark"] = $row['subject_theory_pass_mark'];
	$subject_data["s{$total_subjects}_practical_full_mark"] = $row['subject_practical_full_mark'];
	$subject_data["s{$total_subjects}_practical_pass_mark"] = $row['subject_practical_pass_mark'];
	
	$subject_data["s{$total_subjects}_full_mark"] = $row['subject_theory_full_mark'] * 1 + $row['subject_practical_full_mark'] * 1;
	$subject_data["s{$total_subjects}_pass_mark"] = $row['subject_theory_pass_mark'] * 1 + $row['subject_practical_pass_mark'] * 1;
	
}

// fetch all students
$query = "SELECT * FROM student_main 
			LEFT JOIN student_marks USING (stu_num, sch_year, class) 
			WHERE sch_num LIKE '$s%' AND sch_year='$y' AND class='$c' $limitclause ORDER BY stu_num";

$result = mysql_query($query);

// start the pdf document
if ($r=='marksheet'){
	include("fpdf/fpdf.php");

	$pdf = new FPDF(strtoupper(substr($SETTINGS['marksheet_orientation'],0,1)),'pt',$SETTINGS['marksheet_size']);
	$pdf->SetFont($SETTINGS['marksheet_font'],'',$SETTINGS['marksheet_font_size']);
	
	
	$marksheet_result = mysql_query("SELECT * FROM settings WHERE variable LIKE 'layout_%'");
	$marksheet_var = array();
	while ($row = mysql_fetch_assoc($marksheet_result)){
		$marksheet_var[str_replace("layout_","",$row['variable'])] = $row['value'];
	}
	
}

if ($r=='ledger'){
	$ledger_html = "";
	
	// get list of subjects
	$dist_code = substr($s,0,2);
	$subject_result = mysql_query("SELECT * FROM subjects WHERE dist_code='$dist_code' AND class='$c' AND sch_year='$y' ORDER BY subject_sn");
	$subjects_abbr = array();
	while ($sr = mysql_fetch_assoc($subject_result)){
		$subjects_abbr["s".$sr['subject_sn']] = substr($sr['subject_name'],0,3);
	}	
	
}

$student_count = 0;
$po=true;
$first_time = true;
while ($row = mysql_fetch_assoc($result)){
	
	$student_count++;
	
	// data modification
	$sex = $row['sex'];
	switch ($sex){
		case '1':
			$row['sex']='M';
			break;
		case '2':
			$row['sex']='F';
			break;
		default:
			$row['sex']='';
	}
	
	$row['full_name'] = $row['first_name']." ".$row['last_name'];
	
	// fix date
	$d = $cal->nep_to_eng($row['dob_np_y'],$row['dob_np_m'],$row['dob_np_d']);
	$row['dob_en_y']=$d['year'];
	$row['dob_en_m']=$d['month'];
	$row['dob_en_d']=$d['date'];
	
	$row['dob_np']=$row['dob_np_y'].'-'.$row['dob_np_m'].'-'.$row['dob_np_d'];
	$row['dob_en']=$row['dob_en_y'].'-'.$row['dob_en_m'].'-'.$row['dob_en_d'];
	
	$row['date_en_now'] = date('Y-m-d');
	$dn = explode("-",$row['date_en_now']);
	$d = $cal->eng_to_nep($dn[0],$dn[1],$dn[2]);
	$row['date_np_now'] = $d['year'].'-'.$d['month'].'-'.$d['date'];
	$row['date_today'] = $row['date_np_now'];

	// calculate totals, result, and *signs
	$row['total']=0;
	$row['total_theory']=0;
	$row['total_practical']=0;
	$row['total_grace']=0;
	
	// New mark calculation method

	for ($i=1;$i<=$total_subjects;$i++){
		
		$fail = false;
		
		// check if the mark is below pass mark
		if ($row["s{$i}_comment"]!='') {
			$row['result']='Fail';
			$row["s{$i}_comment"] = substr($row["s{$i}_comment"],0,2);
		}
		
		if (($row["s{$i}_theory"] * 1 + $row["s{$i}_grace"] * 1 )<$subjects[$i]['thpm'] && $row["s{$i}_theory"]!=0) {
			
			switch ($show_failed_marks){
				case '*':
					$row["s{$i}"] .='*';
					$row["s{$i}_theory"] .='*';
					//$row["s{$i}_practical"] .='*';
					//$row["s{$i}_grace"] .='*';				
					break;
				case '-':
					$row["s{$i}"] ='-';
					$row["s{$i}_theory"] ='-';
					$row["s{$i}_practical"] ='-';
					$row["s{$i}_grace"] ='-';				
					break;
				default:
					$row["s{$i}"] ='';
					$row["s{$i}_theory"] ='';
					$row["s{$i}_practical"] ='';
					$row["s{$i}_grace"] ='';					
					break;
			}
			
			$row['result']='Fail';
			$fail = true;
		}
		if ( ($subjects[$i]['prpm'] * 1) > 0 && ($row["s{$i}_practical"] * 1)<$subjects[$i]['prpm']) {
			//  ^^ subject has practical marks     ^^ practical mark is failing
			switch ($show_failed_marks){
				case '*':
					$row["s{$i}"] .='*';
					//$row["s{$i}_theory"] .='*';
					$row["s{$i}_practical"] .='*';
					//$row["s{$i}_grace"] .='*';				
					break;
				case '-':
					$row["s{$i}"] ='-';
					$row["s{$i}_theory"] ='-';
					$row["s{$i}_practical"] ='-';
					$row["s{$i}_grace"] ='-';				
					break;
				default:
					$row["s{$i}"] ='';
					$row["s{$i}_theory"] ='';
					$row["s{$i}_practical"] ='';
					$row["s{$i}_grace"] ='';					
					break;
			}
			$row['result']='Fail';
			$fail = true;
		}
		
		if ( ($subjects[$i]['prpm'] * 1) > 0 && $row["s{$i}_practical"]==''){
			$row['result']='Fail';
			$fail = true;			
		}
		
		// add to total only if the mark is over pass mark
		if ($fail == false || $add_failed_mark_to_total){
			//$row["s{$i}"] = $row["s{$i}_theory"] * 1 + $row["s{$i}_practical"] * 1 + $row["s{$i}_grace"] * 1;
			$row['total'] += $row["s{$i}"] * 1;
			$row['total_theory'] += $row["s{$i}_theory"] * 1 + $row["s{$i}_grace"] * 1;
			$row['total_practical'] += $row["s{$i}_practical"] * 1;
			$row['total_grace'] += $row["s{$i}_grace"] * 1;
		}
		
	}
	
	// Old method of mark calculation 
	// (even failed marks were added to total and were shown with *)
	/*
	for ($i=1;$i<=$total_subjects;$i++){
		$row["s{$i}"] = $row["s{$i}_theory"] * 1 + $row["s{$i}_practical"] * 1 + $row["s{$i}_grace"] * 1;
		$row['total'] += $row["s{$i}"] * 1;
		$row['total_theory'] += $row["s{$i}_theory"] * 1 + $row["s{$i}_grace"] * 1;
		$row['total_practical'] += $row["s{$i}_practical"] * 1;
		$row['total_grace'] += $row["s{$i}_grace"] * 1;
		
		if ($row["s{$i}_comment"]!='') $row['result']='Fail';
		
		if (($row["s{$i}_theory"] * 1 + $row["s{$i}_grace"] * 1 )<$subjects[$i]['thpm'] && $row["s{$i}_theory"]!=0) {
			$row["s{$i}"] .='*';
			$row["s{$i}_theory"] .='*';
			$row['result']='Fail';
		}
		if (($row["s{$i}_practical"] * 1)<$subjects[$i]['prpm'] && $row["s{$i}_practical"]!=0) {
			$row["s{$i}"] .='*';
			$row["s{$i}_practical"] .='*';
			$row['result']='Fail';
		}
		$row["s{$i}"] = str_replace('**','*',$row["s{$i}"]);
		
	}
	*/
	
		
	if ($row['withheld']) $row['result']='Withheld';
	
	if ($row['result']==''){
		// calculate division
		if ($row['total']>=$total_mark*.32) $row['result']='Third';
		if ($row['total']>=$total_mark*.45) $row['result']='Second';
		if ($row['total']>=$total_mark*.60) $row['result']='First';
		if ($row['total']>=$total_mark*.80) $row['result']='Distinction';
	}
	
	// if result is "Fail" dont show it
	if ($row['result']=='Fail') {
		$row['result']='';
		if (!$show_total_if_failed){
			$row['total'] = '';
			$row['total_theory'] = '';
			$row['total_practical'] = '';
			$row['total_grace'] = '';		
		}
	}

	
	foreach ($row as $k=>$v) if ($v=='0') $row[$k]='';
	foreach ($subject_data as $k=>$v) if ($v=='0') $subject_data[$k]='';
	
	if ($r=='ledger'){
		
		if ($sch_row['sch_num'] != $row['sch_num']){
			// new school, update school data
			$sch_result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='{$row['sch_num']}' AND sch_year='{$row['sch_year']}'",$flashdblink);
			$sch_row = mysql_fetch_assoc($sch_result);
			
			$data = array_merge($row,$sch_row);
			
			// close table if there's data already
			if ($ledger_html!=''){
				$ledger_html .= "</tbody></table></page>";
			}
			
			// school header
			if (!$first_time) $ledger_html .= "<p style='page-break-after:always'></p>";
			$first_time=false;
			$ledger_html .= "<page>";
			
			/*
			$ledger_html .= "<p align='center'><strong>District Education Office - </strong></p>";
			$ledger_html .= "<p align='center'><strong>District Level Examination, Class - {$data['class']}</strong></p>";
			$ledger_html .= "<p align='center'><strong>{$data['nm_sch']} [{$data['sch_num']}]</strong></p>";
			*/
			$district_result = mysql_query("SELECT * FROM mast_district WHERE dist_code='{$data['dist_code']}'",$flashdblink);
			$district_row = mysql_fetch_assoc($district_result);
			$data['dist_name'] .= ($district_row['dist_name']);
			
			$ledger_html .= "<p align='center'>District Education Office - {$data['dist_name']}<br />";
			$ledger_html .= "District Level Examination, Class - {$data['class']}, {$y}<br />";
			$ledger_html .= "{$data['nm_sch']} [{$data['sch_num']}]</p>";
			
			
			// start table
			$ledger_html .= "<table style=\"width:100%;\">";
			
			$ledger_html .= "<thead>";
			
			$ledger_html .= "<tr>";
			
			$ledger_html .= "<th>Regd</th>";
			$ledger_html .= "<th>Name</th>";
			$ledger_html .= "<th>DOB (Nepali)</th>";
			$ledger_html .= "<th>Sex</th>";	
			$ledger_html .= "<th></th>";	
			
			foreach ($subjects_abbr as $k=>$v){
				if ($v=='') break;
				$ledger_html .= "<th>".substr($v,0,3)."&nbsp;</th>";
			}			
			
			$ledger_html .= "<th>Total</th>";
			$ledger_html .= "<th>Result</th>";
			
			$ledger_html .= "</tr>";
			
			$ledger_html .= "</thead><tbody>";

		}
			
		$data = array_merge($row,$sch_row);
		$data = array_merge($data,$subject_data);
		
		// get vdc name
		$vdc_result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='{$data['dist_code']}' AND vdc_code='{$data['vdc_code']}'",$flashdblink);
		$vdc_row = mysql_fetch_assoc($vdc_result);
		
		$data['nm_sch'] .= (", ".$vdc_row['vdc_name_e']);
		
		$ledger_html .= "<tr>";
		
		$ledger_html .= "<td>{$data['stu_num']}<br />{$data['reg_id']}</td>";
		$ledger_html .= "<td>{$data['first_name']}<br />{$data['last_name']}</td>";
		$ledger_html .= "<td>{$data['dob_np']}</td>";
		$ledger_html .= "<td>{$data['sex']}</td>";
		
		if ($SETTINGS['ledger_show_grace_mark']){
			$ledger_html .= "<td>Th.<br />Pr.<br />Gr.<br />Tot &nbsp;</td>";
		}
		else $ledger_html .= "<td>Th.<br />Pr.<br />Tot &nbsp;</td>";
		
		foreach ($subjects_abbr as $k=>$v){
			if ($v=='') break;
			if ($SETTINGS['ledger_show_grace_mark']) $ledger_html .= "<td>{$data[$k.'_theory']}<br />{$data[$k.'_practical']}<br />{$data[$k.'_grace']}<br />{$data[$k]}</td>";
			else $ledger_html .= "<td>{$data[$k.'_theory']}<br />{$data[$k.'_practical']}<br />{$data[$k]}</td>";
		}
		
		$k="total";
		if ($SETTINGS['ledger_show_grace_mark']) $ledger_html .= "<td>{$data[$k.'_theory']}<br />{$data[$k.'_practical']}<br />{$data[$k.'_grace']}<br />{$data[$k]}</td>";
		else $ledger_html .= "<td>{$data[$k.'_theory']}<br />{$data[$k.'_practical']}<br />{$data[$k]}</td>";
		$ledger_html .= "<td>{$data['result']}</td>";		
		
		$ledger_html .= "</tr>";
		 
	}
	
	if ($r=='marksheet'){
		
		// update school data
		$sch_result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='{$row['sch_num']}' AND sch_year='{$row['sch_year']}'",$flashdblink);
		$sch_row = mysql_fetch_assoc($sch_result);	
		
		$data = array_merge($row,$sch_row);
		$data = array_merge($data,$subject_data);

		// get vdc name
		$vdc_result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='{$data['dist_code']}' AND vdc_code='{$data['vdc_code']}'",$flashdblink);
		$vdc_row = mysql_fetch_assoc($vdc_result);

		$data['nm_sch'] .= (", ".$vdc_row['vdc_name_e']);
		
		// inject few extra variables
		$data['date_settings'] = $SETTINGS['marksheet_date'];

		
		// create a new page and load the data
		$pdf->AddPage();
		
		foreach ($marksheet_var as $k=>$v){
			if (substr($k,0,2)=="s_") continue;
			$p = explode(",",$v);
			$pdf->Text($p[1],$p[0],$data[$k]);
		}
		
		for ($i=1;$i<=12;$i++){
			foreach ($marksheet_var as $k=>$v){
				if (substr($k,0,2)!="s_") continue;
				
				$p = explode(",",$v);
				if ($k=='s_total')
					$pdf->Text($p[1],$p[0]+($i-1)*$SETTINGS['marksheet_font_size']*$SETTINGS['marksheet_line_spacing'],$data["s{$i}"]);
				else
					$replacement = "s{$i}_";
					$pdf->Text($p[1],$p[0]+($i-1)*$SETTINGS['marksheet_font_size']*$SETTINGS['marksheet_line_spacing'],$data[preg_replace("/^s_/",$replacement,$k)]);
					
				
			}
		}
		
	}
}

if ($r=='marksheet') $pdf->Output("marksheets.pdf","D");

if ($r=='ledger'){

$html_header = <<<EOD
<style>
@page { margin: 0.25in;} 
body{
	font-family: {$SETTINGS['ledger_font']};
	font-size: {$SETTINGS['ledger_font_size']}pt;
	padding: 0;
}
table{
	border-collapse: collapse;
	border-spacing: 0;
}
th{ 
	text-align: left;
	border-bottom: 2pt solid black;
	padding: 3pt;
	font-family: {$SETTINGS['ledger_font']};
	font-size: {$SETTINGS['ledger_font_size']}pt;		
}
td{
	border-bottom: 1pt solid black;
	padding: 3pt;
	font-family: {$SETTINGS['ledger_font']};
	font-size: {$SETTINGS['ledger_font_size']}pt;	
}
p{
	border-bottom: 1pt solid black;
	padding: 3pt;
	font-family: {$SETTINGS['ledger_font']};
	font-size: {$SETTINGS['ledger_font_size']}pt;
	font-weight: bold;
}
</style>
EOD;

	if ($ledger_html!='')
		$html = $html_header . $ledger_html . "  </tbody></table></page>";
	else 
		$html = $html_header . $ledger_html;
	

	require_once('html2pdf/html2pdf.class.php');
	
	$html2pdf = new HTML2PDF(strtoupper(substr($SETTINGS['ledger_orientation'],0,1)), $SETTINGS['ledger_size'], 'en', true, 'UTF-8', $SETTINGS['ledger_orientation']);
	$html2pdf->writeHTML($html);
	$html2pdf->Output('ledger.pdf');

/*
	require("html2fpdf.php");

	$pdf = new HTML2FPDF(strtoupper(substr($SETTINGS['ledger_orientation'],0,1)),'pt',$SETTINGS['ledger_size']);
	$pdf->SetFont($SETTINGS['ledger_font'],'',$SETTINGS['ledger_font_size']);	

	$pdf->AddPage();
	$pdf->WriteHTML($html);
	$pdf->Output("ledger.pdf","D");
*/
}

?>
