<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0
?>
<html>
<head>
<title>Database Import</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
  <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<h2 align="center">Import Database</h2>
<p align="center">&nbsp;</p>
<?php

require_once('../includes/tablelist.php');
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) die('Could not connect to MySQL server: ' . mysql_error());
$result =mysql_select_db($dbname, $link);

include('../tmis/fixtables.php');

if (isset($_POST['sql'])){

	$uploadfile = sys_get_temp_dir()."\\".basename($_FILES['userfile']['name']);

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	   echo "File is valid, and was successfully uploaded.<br>";
	} else {
	   echo "Possible file upload attack!<br>";
	}
	
	$apachepath = "..\\..\\..\\apache\\";
	
	$mysql_path = "..\\..\\..\\mysql\\bin\\mysql.exe";
	
	
	if (file_exists($apachepath.$uploadfile)) $sqlpath=$apachepath.$uploadfile;
	else if (file_exists($uploadfile)) $sqlpath=$uploadfile;
	else die('File Upload Error.');

	require_once('../includes/vars.php');
	
	if (strtolower(substr($sqlpath,-4))=='.zip'){
		echo "ZIP file detected. Extracting..<br>";
		
		$zip = zip_open($sqlpath);
		if ($zip) {
			$tmpdir = sys_get_temp_dir();
			
			$zip_entry = zip_read($zip);
			
			if ($zip_entry){
				$sqlpath = $tmpdir."\\".zip_entry_name($zip_entry);
				
				if (strtolower(substr($sqlpath,-4))!='.sql') die('No SQL file inside ZIP.<br>');
				
				$fp = fopen($sqlpath, "w");
				$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
				fwrite($fp,$buf);
				zip_entry_close($zip_entry);
				fclose($fp);	

				zip_close($zip);
			}
			else die ("ZIP file read error.<br>");
			
		}

	}
	

	$mysql_command =sprintf("$mysql_path -f -v -h%s -u%s -p%s -D%s < %s",
        $dbserver, $dbusername, $dbpassword, $dbname, $sqlpath);

   
 	echo "<h3>Data imported, removing duplicate entries..</h3>\n";
 	echo "<p><img src='working.gif'></p>\n";
 	
	echo '<pre>';
	echo 'SQL Data ... <br>';
	echo $mysql_command.'<br>';
	
	echo shell_exec($mysql_command);
	
	echo "Done</pre>";
	
	@unlink($uploadfile);
	@unlink($apachepath.$uploadfile);
	@unlink($sqlpath);
	
	echo "<script>window.location='removeduplicates.php';</script>";
	
	
}
else{
?>

<div id='importform'>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="document.getElementById('importform').className='divhide'; document.getElementById('working').className='divshow'; return true;">
   <p align="center">SQL or ZIP file:
   <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo preg_replace('/M/', '000000', ini_get('upload_max_filesize')); ?>" />
   
   <input name="userfile" type="file" size="50" />
   <input type='hidden' name='sql' value='sql'>
   <input type="submit" name='submit' value="Import" />
   </center>
</form>
</div>
<div id='working' class='divhide'><p align='center'>Importing <br /><img src='working.gif'></p></div>
<?php
}
?>


<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>
