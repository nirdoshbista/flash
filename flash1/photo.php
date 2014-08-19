<?php 

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once("../lib/photo.lib.php");

$link = dbconnect();

if (isset($_GET['add'])){
	
	$file_content = file_get_contents($_FILES['userfile']['tmp_name']);
	$file_content = image_resize($file_content, null, "640x");
	
	$sch_num = $_POST['sch_num'];
	
	mysql_query("INSERT INTO photos_f1 (sch_num, sch_year, photo, description) VALUES ('$sch_num', '$currentyear', '".mysql_escape_string($file_content)."', '{$_POST['description']}')");
	
	header("Location: basicinfo.php?s=$sch_num");


}

if (isset($_GET['delete'])){
	
	$id = $_GET['id'];
	$sch_num = $_GET['s'];
	
	mysql_query("DELETE FROM photos_f1 WHERE id='$id'");
	
	header("Location: basicinfo.php?s=$sch_num");


}

if (isset($_GET['get'])){
	
	$id = $_GET['id'];
	
	$result = mysql_query("SELECT photo FROM photos_f1 WHERE id='$id'");
	$row =  mysql_fetch_assoc($result);
	
	
	header('Content-Type: image/png');
	echo $row['photo'];


}
