<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0
?>
<html>
<head>
<title>Merge Database</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
  <p><img src="../images/flash.png"></p>
</div>
<br>

<?php

if (isset($_POST['sql'])){
	
	
	$uploadfile = basename($_FILES['userfile']['name']);
	if (strtolower(substr($uploadfile,-4))!='.sql') die("Only SQL Files are allowed.");
		
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	   echo "File is valid, and was successfully uploaded.\n";
	} else {
	   echo "Possible file upload attack!\n";
	}
	
	$apachepath = "..\\..\\..\\apache\\";
	
	$mysql_path = "..\\..\\..\\mysql\\bin\\mysql.exe";
	
	
	if (file_exists($apachepath.$uploadfile)) $sqlpath=$apachepath.$uploadfile;
	else if (file_exists($uploadfile)) $sqlpath=$uploadfile;
	else die('File Upload Error.');
	
	require_once('../includes/vars.php');
	
	$mysql_command =sprintf("$mysql_path -v -h%s -u%s -p%s -D%s < %s",
        $dbserver, $dbusername, $dbpassword, $dbname, $sqlpath);
		
	echo '<pre>';
	echo 'Executing SQL file ... <br>';
	echo $mysql_command.'<br>';
	
	echo shell_exec($mysql_command);
	
	echo "Done</pre>";
	
	@unlink($uploadfile);
	@unlink($apachepath.$uploadfile);		
	
	
}
else{

?>

<h2 align="center">Merge Database</h2>
<p align="center">&nbsp;</p>


<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
   <p align="center">SQL files: <br /><br />
   <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo preg_replace('/M/', '000000', ini_get('upload_max_filesize')); ?>" />
   
	<input name="userfile" type="file" size="75" /><br />
   <input type='hidden' name='sql' value='sql'><br />
   <input type="submit" name='submit' value="Merge" />
   </center>
</form>

<?php
}
?>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>