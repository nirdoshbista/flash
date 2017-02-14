<?php
require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = dbconnect();


?>
<html>
<head>
  <title>Flash School Report Card</title>
<style>
  TABLE{
  	border-collapse:collapse;
  }
  TD {
  	font: 10px Verdana, Arial, Helvetica, sans-serif; color: #000000; text-align:center;
  }
  P {
  	font: 10px Verdana, Arial, Helvetica, sans-serif; color: #000000
  }
  BODY {
  	padding:5px; font-size: 10px; margin: 0px; font-family: Verdana, Arial, Helvetica, sans-serif;
  }
  .tiny{
  	font-size: 10px;
  }
  BR.page { page-break-after: always }

  h1{font-size: large;}
</style>
</head>
<body>
  <?php
  $D = $_GET['d'];	// district
  $V = $_GET['v'];	// vdc
  $S = $_GET['s'];	// school expand or not
  $TN = $_GET['tn'];  // tag name
  $currentyear = $_GET['yr'];

 // $sql_for_male = mysql_query("SELECT reg_id FROM id_students_main;");
 // $sql_for_male_result=mysql_fetch_array($sql_for_male);
  // print_r($sql_for_male_result);

 $result=mysql_query("select * from id_students_track where class=1 and sch_year = $currentyear");
 $schooltype=mysql_num_rows($result);
 include "showstudentid.php"

  ?>
</body>
</html>
