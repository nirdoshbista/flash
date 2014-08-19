<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash - Data Export</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
Exporting Database... <br /><br />

<?php

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result = mysql_select_db($dbname, $link);

$d = $_POST['d'];
$f1 = $_POST['f1'];
$f2 = $_POST['f2'];
$tmis = $_POST['tmis'];


if ($_POST['photos']==1){
	$t[] = "photos_f1";
	$t[] = "tmis_photos";
}

$dist_codes = explode(",",$_POST['d']);

$total_files = count($dist_codes);
if ($total_files==0) $total_files++; // even if dist_codes is empty, there's one file to export

$file_count = 1;

if ($total_files>1){
	mkdir(getenv('ALLUSERSPROFILE')."\\Desktop\\flash_exports_".date("YmdHis"));
	$export_dir = "flash_exports_".date("YmdHis")."\\";
}
else $export_dir='';

foreach ($dist_codes as $d){

	// filename for db export
	$query = "select * from mast_district";
	if ($d!='') $query .= " WHERE dist_code='$d'";

	$result = mysql_query($query);
	if (mysql_num_rows($result)==1){
		// use filename as district name
		
		$row = mysql_fetch_array($result);
		$filename = $row['dist_name'];
		
	}
	else $filename = "dbexport";

	$filename.="_";
	$filename.=date("YmdHis");


	$sch_year = $_POST['y'];

	// generate filename
	if ($f1!='') {
		$filename.="_f1_";
		if ($sch_year!='') $filename.=$sch_year;
	}
	if ($f2!=''){
		$filename.="_f2_";
		if ($sch_year!='') $filename.=($sch_year-1);
	}
	if ($tmis!=''){
		$filename.="_tmis_";
		if ($sch_year!='') $filename.=($sch_year-1);
	}


	exportsqlheader($filename.'.sql');

	foreach($t as $tablename){
		if(whichDB($tablename)==0 && $f1=='' && $f2=='') continue;
		if (whichDB($tablename)==1 && $f1=='') continue;
		if (whichDB($tablename)==2 && $f2=='') continue;
		if (whichDB($tablename)==3 && $tmis=='') continue;
		if (whichDB($tablename)==4) continue;
          
		if ($d!='') {
			if ($tablename=='mast_district' || $tablename=='mast_vdc') $wc = " AND dist_code='$d'";
			else {
				
				// tmis table are to be checked against tid
				// rest of the tables have sch_num
				
				$db = whichDB($tablename);
				if ($db!=3) $wc = " AND sch_num LIKE '$d%'";
				else $wc = " AND tid LIKE '$d%'";
			}
		}
		else $wc = '';

		if ($sch_year=='') exporttable($filename.'.sql',$tablename, "1=1 $wc");
		else{
			$db = whichDB($tablename);
			
			switch($db){
				case 1:
					exporttable($filename.'.sql',$tablename, "sch_year='$sch_year' $wc");
					break;
				case 2:
					exporttable($filename.'.sql',$tablename, "sch_year='".($sch_year-1)."' $wc");
					break;
				case 3:
					exporttable($filename.'.sql',$tablename, "sch_year='".($sch_year-1)."' $wc");
					break;
                                case 5:
					exporttable($filename.'.sql',$tablename, "1=1");
					break;
				default:
					if ($tablename=='mast_schoollist' || $tablename=='mast_school_type') {
						//exporttable($filename.'.sql',$tablename, "sch_year='$sch_year' $wc");
						exporttable($filename.'.sql',$tablename, "sch_year='$sch_year' $wc");
						exporttable($filename.'.sql',$tablename, "sch_year='".($sch_year-1)."' $wc");
					}
					else exporttable($filename.'.sql',$tablename, "1=1 $wc");
					break;
				
			}
			
		}

	}

	require_once('../lib/zip.lib.php');

	$zipfile = new zipfile();

	$handle = fopen($filename.'.sql', "r");
	$contents = fread($handle, filesize($filename.'.sql'));
	fclose($handle);

	$zipfile -> addFile($contents, $filename.'.sql');
	$dump_buffer = $zipfile -> file();


	$path = getenv('ALLUSERSPROFILE')."\\Desktop\\{$export_dir}$filename.zip";

	$handle = fopen($path, "w");
	fwrite($handle, $dump_buffer);
	fclose($handle);

	echo "[$file_count/$total_files] $filename.zip <br />";
	$file_count++;

	unlink($filename.'.sql');

}

?>

<p>All files exported to Desktop<?php if ($export_dir!='') echo " inside <strong>".str_replace("\\","",$export_dir)."</strong> folder"; ?>.</p>
<p><a href='../index.php'>Go back</a></p>

</body>
</html>
