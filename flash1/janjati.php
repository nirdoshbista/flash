<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
require_once('includes/flash1fn.php');
$link = dbconnect();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Janajati Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script src="js/flash1common.js" type="text/javascript"></script>
<script src="js/janjati.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>
</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash1.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>
</p>
<form action="controller.php" method="post">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
  <tr class="ewTableHeader"> 
	<td>Class</td>
	<td>Std.</td>
	<td>Kusunda</td>
	<td>Bankaria</td>
	<td>Raute</td>
	<td>Surel</td>
	<td>Hayu</td>
	<td>Raji</td>
	<td>Kisan</td>
	<td>Lopcha</td>
	<td>Meche</td>
	<td>Mushbadiya</td>
	<td>Majhi</td>
	<td>Siyar</td>
	<td>Singsa</td>
	<td>Thunam</td>
	<td>Dhanuk</td>
	<td>Chepang</td>
	<td>Satar</td>
	<td>Jhagad</td>
	<td>Thami</td>
	<td>Bote</td>
	<td>Danuwar</td>
	<td>Baramu</td>
  </tr>
  
  <?php
	for ($c=1;$c<=12;$c++){
		echo "<tr>\n"; $po=1;
		echo "<td rowspan='3'>$c</td>\n";
		
		foreach(array("f","m","t") as $t){
			
			if ($po!=1) echo "<tr>\n"; $po=0;
			echo "<td>",strtoupper($t),"</td>\n";
			for ($j=0;$j<22;$j++){
				echo "<td>";
				?>
				<input name="<?php echo "janjati_{$c}_{$j}_{$t}"; ?>" type="text" onkeypress="return forceNumberInput(this, event);" onchange="handleChange(this);" id="<?php echo "janjati_{$c}_{$j}_{$t}"; ?>" size="2" maxlength="3" <?php if ($t=='t' OR $classes[$c]==0) echo 'disabled'; ?>>
				<?php				
				echo "</td>\n";
			}
			
		}
	}
  
  ?> 
 
</table>
<br />




</form>
<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>
var d = document.forms[0];
<?php

$janjati_type = array('Kusunda',
'Bankaria',
'Raute',
'Surel',
'Hayu',
'Raji',
'Kisan',
'Lopcha',
'Meche',
'Mushbadiya',
'Majhi',
'Siyar',
'Singsa',
'Thunam',
'Dhanuk',
'Chepang',
'Satar',
'Jhagad',
'Thami',
'Bote',
'Danuwar',
'Baramu');

for ($c=1;$c<=12;$c++){
	$result=mysql_query("select * from janjati_f1 where sch_num='$sch_num' and sch_year='$currentyear' and class='$c'");
	
	while($r=mysql_fetch_array($result)){
		$j=array_search($r['janjati_type'],$janjati_type);
		echo "d['janjati_{$c}_{$j}_f'].value='".($r['total_f'])."';\n";
		echo "d['janjati_{$c}_{$j}_m'].value='".($r['total_m'])."';\n";
		echo "d['janjati_{$c}_{$j}_t'].value='".($r['total_t'])."';\n";
		
		
	}

}

?>
validate=true;
</script>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
