<?php
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);


$tc=($_GET['new_tag_category']!=''?$_GET['new_tag_category']:$_GET['tag_category']);
$tn=$_GET['tag_name'];
$code=$_GET['codes'];

if (isset($_GET['tag_id'])){
	$query="update tags set codes='$code', tag_category='$tc', tag_name='$tn' where tag_id='".$_GET['tag_id']."'";
}
else $query="insert into tags (tag_category, tag_name, codes) values('$tc','$tn','')";

mysql_query($query);


if (isset($_GET['tag_id'])){
	header("location: aetag.php");

}
else{
	$tag_id=mysql_insert_id();

	header("location: edittag.php?tag_id=$tag_id");


}


?>

