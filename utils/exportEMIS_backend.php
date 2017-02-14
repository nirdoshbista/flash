<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('../includes/vars.php');
require_once('../includes/excelEMIS_tables.php');
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$req=$_GET['req'];
if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('<select name="distlist" id="distlist" onchange="districtChange()">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], '['.$r['dist_code'].']'.$r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']));
		$rows = mysql_fetch_all($result);


		printf('<select name="vdclist" id="vdclist" onchange="vdcChange()">');

		if (mysql_num_rows($result)==0){
			printf('<option value="%s">%s</option>', '', '-- Select District first --');
		}
		else printf('<option value="%s">%s</option>', '', '-- VDC --');
		

		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'],'['.$r['vdc_code'].']'.$r['vdc_name_e']);

		}
		

		printf('</select>');
	}

}

if ($req=='schoollist'){
	$dist=$_GET['distcode'];
	$vdc=$_GET['vdccode'];
	
	//schools by code(display only schools whosw excel have been imported
        //$result=mysql_query("select distinct(sch_num) from id_students_main where sch_num 
        //                    in(select distinct(sch_num) from mast_schoollist where dist_code='$dist' and vdc_code='$vdc')
        //                   order by sch_num");
        
        //schools by code(display all schools in the database
        $result=mysql_query("select distinct(sch_num) from mast_schoollist where dist_code='$dist' and vdc_code='$vdc'
                               order by sch_num");
	$schools = mysql_fetch_all($result);
	
	echo mysql_error();
        printf('<select id="schlist" name="schlist[]" onchange="changeExportButton()" size="6" multiple>');
	foreach($schools as $s){
		$result=mysql_query("select *, TRIM(nm_sch) as schoolname from mast_schoollist where sch_num='".$s['sch_num']."'  
                                     order by sch_year desc");
		$r=mysql_fetch_array($result);

		printf("<option value='%s'>%s</option>",$r['sch_num'],'['.$r['sch_num'].']'.$r['schoolname']);
	}
        printf('</select>');
}
if ($req=='export'){
    $schoolcode=$_GET['schoolcode'];
    $directory="EMIS export";
    $path=getenv('ALLUSERSPROFILE')."\\Desktop\\".$directory;
    
    if (!file_exists($path)) {
        mkdir($directory,0777,true);
        rename($directory,$path);
    }

    //retrieve the individual schoolID from ':' delimited values
    //if the length of string is greater than 9 then the user has selected multiple schools
    if (strlen($schoolcode)>9 )
        $schoollist=explode(':',$schoolcode);
    else
        $schoollist=array($schoolcode);
    
    //now to create temporary excel files for all the schools in the utils folder 
    //schoolNames will hold the names of schools
    $schoolNameList=array();
    foreach ($schoollist as $code)
    {
        $result =  mysql_query("select distinct(nm_sch) as name from 
                            mast_schoollist where sch_num='".$code."'
                            order by sch_year desc");
        if (mysql_num_rows($result)>0)
        {
            $r=mysql_fetch_array($result);
            copy('EMIS_v2.0.xls', $code.".xls");
            chmod($code.".xls",0777);
            $schoolNameList[]=$r['name'];
        }
    }

    //run the vb6 code in the format script.exe param1,param2,...
    //param1:server i.e localhost
    //param2:database i.e "flash"
    //param3:username i.e "root"
    //param4:password i.e "admin"
    //param5:schoolcode i.e "560010001"
    //param6:currentyear i.e "2070"
    //param6:temp. file path and nomenclature i.e "C:\Program Files\Flash\htdocs\flash\utils\"
    
    //check the version of office installed 
    if (file_exists("C:\Program Files\Microsoft Office\Office12\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office12\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportEMIS2007.exe\" ".$dbserver.",".$dbname.",".$dbusername.",".$dbpassword
                    .",".$schoolcode.",".$currentyear.",".dirname(__FILE__);
    }
    else if (file_exists("C:\Program Files\Microsoft Office\Office14\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office14\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportEMIS2010.exe\" ".$dbserver.",".$dbname.",".$dbusername.",".$dbpassword
                    .",".$schoolcode.",".$currentyear.",".dirname(__FILE__);
    }
    echo $cmd;
	
    $output=shell_exec($cmd);
	
    //now delete all the temporary files
    $i=0;
    foreach ($schoollist as $code)
    {
		//delete if a file already exists in desktop and
        //move the temp file to the desktop
		if(file_exists($path."\\".$code." ".$schoolNameList[$i].".xls"))
			unlink($path."\\".$code." ".$schoolNameList[$i].".xls");
        rename(dirname(__FILE__)."\\".$code.".xls",$path."\\".$code." ".$schoolNameList[$i].".xls");
        $i++;
    }
}

if($req=='remove')
{
    $schoolcode=$_GET['schoolcode'];
    //retrieve the individual schoolID from ':' delimited values
    //if the length of string is greater than 9 then the user has selected multiple schools
    if (strlen($schoolcode)>9 )
        $schoollist=explode(':',$schoolcode);
    else
        $schoollist=array($schoolcode);
    
    
    foreach ($schoollist as $school_num):
        foreach ($excelEMIS_tables as $table):
            /** check whether it is a tmis table or student_id table
             *  and set the required conditions respectively 
             */
            $query="delete from `$table` where ";
            if(substr($table, 0, 2)=="id")    
                $query.="sch_num='$school_num'";
            else if(substr($table, 0, 4)=="tmis")
                $query.="tid like '$school_num%'";
            else
                $query.="0=1";
            mysql_query($query);
        endforeach;
    endforeach;
}
?>
