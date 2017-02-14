<?php

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

// register school

$dt=array();
$dt['sch_year']=$currentyear;

$dt['dist_code']=$_POST['sch_dcode'];
$dt['vdc_code']=$_POST['sch_vcode'];
$dt['sch_code']=$_POST['sch_code'];

$dt['nm_sch']=$_POST['sn'];
$dt['location']=$_POST['sch_add'];
$dt['wardno']=$_POST['sch_ward'];
$dt['region']=$_POST['sch_region'];
$dt['telno']=$_POST['sch_phone'];
$dt['email']=$_POST['sch_email'];

$dt['sch_num']=$dt['dist_code'].$dt['vdc_code'].$dt['sch_code'];

//$dt['flash']=2;

mysql_query("delete from mast_schoollist where sch_num='".$dt['sch_num']."' and sch_year='$currentyear' and flash='2'");
idata('mast_schoollist',$dt);
	
header("Location: basicinfo.php?s=".$dt['sch_num']);
	
?>