<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('includes/vars.php');
require_once('includes/dbfunctions.php');

$link = dbconnect($dbname);

$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from `'.$flashdbname.'`.mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('<select name="distlist" id="distlist" onchange="districtChange()">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], '['.$r['dist_code'].']'.$r['dist_name']);

	}
	printf('</select>');

}


if ($req=='agencylist'){
	$dist=$_GET['distcode'];
	
        $result=mysql_query("select dist_code,agency_code,agency_name from nfe_mast_agency
                             where dist_code='$dist' order by agency_code");
	$agencies = mysql_fetch_all($result);
	
	echo mysql_error();
        printf('<select id="agncylist" name="agncylist[]" onchange="changeExportButton()" size="6" multiple>');
	foreach($agencies as $a){
                $agency_code=$a['dist_code'].$a['agency_code'];
		printf("<option value='%s'>%s</option>",$agency_code,'['.$agency_code.']'.$a['agency_name']);
	}
        printf('</select>');
}

if ($req=='export'){
    $agencycode=$_GET['agencycode'];
    $directory="NFEMIS export";
    $path=getenv('ALLUSERSPROFILE')."\\Desktop\\".$directory;
    
    if (!file_exists($path)) {
        mkdir($directory,0777,true);
        rename($directory,$path);
    }

    //retrieve the individual agencyID from ':' delimited values
    //if the length of string is greater than 9 then the user has selected multiple agencies
    if (strlen($agencycode)>9 )
        $agencylist=explode(':',$agencycode);
    else
        $agencylist=array($agencycode);
    
    //now to create temporary excel files for all the agencies in the nfemis folder 
    //agencyNameList will hold the names of agencies
    $agencyNameList=array();
    foreach ($agencylist as $code)
    {
        $result =  mysql_query("select distinct(agency_name) as name from 
                            nfe_mast_agency where agency_code=SUBSTR('".$code."',3,4) and dist_code=SUBSTR('".$code."',1,2);");
        if (mysql_num_rows($result)>0)
        {
            $r=mysql_fetch_array($result);
            copy('NFEMIS v2.0.xls', $code.".xls");
            chmod($code.".xls",0777);
            $agencyNameList[]=$r['name'];
        }
    }
    //run the vb6 code in the format script.exe param1,param2,...
    //param1:server i.e localhost
    //param2:database i.e "nfec"
    //param3:flash database i.e "flash"
    //param4:username i.e "root"
    //param5:password i.e "admin"
    //param6:agency_code i.e "690001"
    //param7:currentyear i.e "2071"
    //param8:temp. file path and nomenclature i.e "C:\Program Files\Flash\htdocs\flash\nfemis\"
    
    //check the version of office installed 
    if (file_exists("C:\Program Files\Microsoft Office\Office12\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office12\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportNFEMIS2007.exe\" ".$dbserver.",".$dbname.",".$flashdbname.",".$dbusername.",".$dbpassword
                    .",".$agencycode.",".$currentyear.",".dirname(__FILE__);
    }
    else if (file_exists("C:\Program Files\Microsoft Office\Office14\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office14\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportNFEMIS2010.exe\" ".$dbserver.",".$dbname.",".$flashdbname.",".$dbusername.",".$dbpassword
                    .",".$agencycode.",".$currentyear.",".dirname(__FILE__);
    }
    echo $cmd;
	
    $output=shell_exec($cmd);
	
    //now delete all the temporary files
    $i=0;
    foreach ($agencylist as $code)
    {
		//delete if a file already exists in desktop and
        //move the temp file to the desktop
		if(file_exists($path."\\".$code." ".$agencyNameList[$i].".xls"))
			unlink($path."\\".$code." ".$agencyNameList[$i].".xls");
        rename(dirname(__FILE__)."\\".$code.".xls",$path."\\".$code." ".$agencyNameList[$i].".xls");
        $i++;
    }
}

if($req=='remove')
{
    $agencycode=$_GET['agencycode'];
    //retrieve the individual agency_code from ':' delimited values
    //if the length of string is greater than 9 then the user has selected multiple agencies
    if (strlen($agencycode)>9 )
        $agencylist=explode(':',$agencycode);
    else
        $agencylist=array($agencycode);
    
    
    foreach ($agencylist as $agency_num):
        foreach ($excelEMIS_tables as $table):
            $query="delete from `$table` where ";
            if(substr($table, 0, 2)=="id")    
                $query.="sch_num='$agency_num'";
            else if(substr($table, 0, 4)=="tmis")
                $query.="tid like '$agency_num%'";
            else
                $query.="0=1";
            mysql_query($query);
        endforeach;
    endforeach;
}
?>
