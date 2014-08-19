<?php 

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('../lib/photo.lib.php');

$link = dbconnect();

if (isset($_GET['add'])){
	
	$tid = $_POST['tid'];
	$sch_num = $_POST['s'];	
        
	$file_content = file_get_contents($_FILES['userfile']['tmp_name']);
	if (strlen($file_content)==0){
		die("<html><head></head><body>Invalid Image. <a href='tmis_general.php?tid=$tid&s=$sch_num'>Go Back</a></body></html>");
		exit();
	}
	
	$file_content = image_resize($file_content, null, "640x");
        
	mysql_query("DELETE FROM tmis_photos WHERE tid='$tid'");
	mysql_query("INSERT INTO tmis_photos (tid, photo) VALUES ('$tid', '".mysql_escape_string($file_content)."')");
	
	header("Location: crop.php?tid=$tid&s=$sch_num");


}

if (isset($_GET['get'])){
	
	$tid = $_GET['tid'];
	
	$result = mysql_query("SELECT photo FROM tmis_photos WHERE tid='$tid'");
	$row =  mysql_fetch_assoc($result);
	
	//print_r($row);
	header('Content-Type: image/jpeg');
	echo $row['photo'];


}

if (isset($_GET['delete'])){
	
	$tid = $_GET['tid'];
	$sch_num = $_GET['s'];
	
	mysql_query("DELETE FROM tmis_photos WHERE tid='$tid'");
	
		header("Location: tmis_general.php?tid=$tid&s=$sch_num");

}
