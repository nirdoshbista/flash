<?php
if (!isset($_GET['s'])) die('This page cannot be accessed individually.');

$sch_num=$_GET['s'];

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');
$link = dbconnect();

$num_buildings = 11;
$num_rooms = 6;

$roof=array("","Tin", "Khar", "Mud","Tile","Cememted","Slate","Others");
$truss = array("","Wood","Iron", "Iron Pole Beam","Wood Pole","Iron Beam","Wooden Pole","Others");
$wall = array("","Bamboo","Raw Brick","Brick","Brick, cemented","Stone","Stone, cememted","Mud");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash II</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet" type="text/css">

<script src="js/flash2common.js" type="text/javascript"></script>
<script src="js/buildings.js" type="text/javascript"></script>
<?php $classes=schoolclasses($sch_num); ?>

</head>

<body onload="navigation();">
<div align="center">
  <p><img src="../images/flash2.png"></p>
</div>
<br>
<p style="color:  #505050; padding:6px 12px 6px 12px; margin:5px 0px; height: 20px; background:#e0e0e0;">
<b>Jump to: </b><span id="nav"><select><option>Select School & Classes</select></span>

</p>
<form action="controller.php" method="post">
 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
	<tr class="ewTableHeader">
		<td rowspan="2">Parts</td>
		<td rowspan="2">Material</td>
			<td colspan="<?php echo $num_buildings; ?>">Building Number</td>
		
	</tr>
	<tr class="ewTableHeader">
		<?php
			for ($i=1;$i<=$num_buildings;$i++){
				echo "<td>B $i</td>\n";
			}
		?>
	</tr>

	<?php
		for ($opt=1;$opt<count($roof);$opt++){
			echo "<tr onmouseover='this.className=\"ewTableAltRow\"' onmouseout='this.className=\"\"'>\n";
			if ($opt==1){
				echo "<td class='ewTableAltRow' rowspan='".(count($roof)-1)."'>Roof</td>\n";
			}
			echo "<td>".$roof[$opt]."</td>\n";
			for ($i=1;$i<=$num_buildings;$i++){
				echo "<td><input name='roof[$i][$opt]' type='checkbox' value='$opt'></td>\n";
			}
			echo "</tr>\n";
			
		}

		for ($opt=1;$opt<count($truss);$opt++){
			echo "<tr onmouseover='this.className=\"ewTableAltRow\"' onmouseout='this.className=\"\"'>\n";
			if ($opt==1){
				echo "<td class='ewTableAltRow' rowspan='".(count($truss)-1)."'>Truss</td>\n";
			}
			echo "<td>".$truss[$opt]."</td>\n";
			for ($i=1;$i<=$num_buildings;$i++){
				echo "<td><input name='truss[$i][$opt]' type='checkbox' value='$opt'></td>\n";
			}
			echo "</tr>\n";
			
		}		
		

		for ($opt=1;$opt<count($wall);$opt++){
			echo "<tr onmouseover='this.className=\"ewTableAltRow\"' onmouseout='this.className=\"\"'>\n";
			if ($opt==1){
				echo "<td class='ewTableAltRow' rowspan='".(count($wall)-1)."'>Wall</td>\n";
			}
			echo "<td>".$wall[$opt]."</td>\n";
			for ($i=1;$i<=$num_buildings;$i++){
				echo "<td><input name='wall[$i][$opt]' type='checkbox' value='$opt'></td>\n";
			}
			echo "</tr>\n";
			
		}			
	?>
		


</table>

<br />
<center><strong>Rooms</strong></center>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
<tr class="ewTableHeader">
<td rowspan="3">B.N.</td>
<td colspan="24">Room Numbers</td>

</tr>
<tr class="ewTableHeader">
<?php
for ($i=1;$i<=6;$i++)
	echo "<td colspan='4'>Room $i</td>\n";
?>
</tr>
<tr class="ewTableHeader">
<?php
for ($i=1;$i<=6;$i++){
	echo "<td>L</td>\n";
	echo "<td>B</td>\n";
	echo "<td>H</td>\n";
	echo "<td>Type</td>\n";
}
?>
</tr>

<?php

for ($i=1;$i<=$num_buildings;$i++){
	echo "<tr>\n";
	echo "<td>B $i</td>\n";
	for ($j=1;$j<=6;$j++){
		echo "<td><input type='text' name='l[$i][$j]' id='l[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td><input type='text' name='b[$i][$j]' id='b[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td><input type='text' name='h[$i][$j]' id='h[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td>\n";
		echo "<select name='roomtype[$i][$j]'>\n";
		echo "<option value=''>N/A</option>\n";
		for ($k=1;$k<=12;$k++){
			echo "<option value='$k'>$k</option>\n";
		}
		echo "<option value='Store'>Store</option>\n";
		echo "<option value='Staff'>Staff</option>\n";
		echo "<option value='HM'>HM</option>\n";
		echo "<option value='Cmp'>Cmp</option>\n";
		echo "<option value='Other'>Other</option>\n";
		echo "</select>\n";	
		echo "</td>\n";		
	}

	echo "</tr>\n";
}

?>

</table>

<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ewTable">
<tr class="ewTableHeader">
<td rowspan="3">B.N.</td>
<td colspan="24">Room Numbers</td>

</tr>
<tr class="ewTableHeader">
<?php
for ($i=7;$i<=12;$i++)
	echo "<td colspan='4'>Room $i</td>\n";
?>
</tr>
<tr class="ewTableHeader">
<?php
for ($i=1;$i<=6;$i++){
	echo "<td>L</td>\n";
	echo "<td>B</td>\n";
	echo "<td>H</td>\n";
	echo "<td>Type</td>\n";
}
?>
</tr>

<?php

for ($i=1;$i<=$num_buildings;$i++){
	echo "<tr>\n";
	echo "<td>B $i</td>\n";
	for ($j=7;$j<=12;$j++){
		echo "<td><input type='text' name='l[$i][$j]' id='l[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td><input type='text' name='b[$i][$j]' id='b[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td><input type='text' name='h[$i][$j]' id='h[$i][$j]' onkeypress='return forceNumberInput(this, event);' onchange='handleChange(this);' size='1' maxlength='3'></td>\n";
		echo "<td>\n";
		echo "<select name='roomtype[$i][$j]'>\n";
		echo "<option value=''>N/A</option>\n";
		for ($k=1;$k<=12;$k++){
			echo "<option value='$k'>$k</option>\n";
		}
		echo "<option value='Store'>Store</option>\n";
		echo "<option value='Staff'>Staff</option>\n";
		echo "<option value='HM'>HM</option>\n";
		echo "<option value='Cmp'>Cmp</option>\n";
		echo "<option value='Other'>Other</option>\n";
		echo "</select>\n";	
		echo "</td>\n";		
	}

	echo "</tr>\n";
}

?>

</table>

</form>



<div id="backbtn" style="clear:none; float:left"></div>
<div id="nextbtn" style="clear:none; float:right"></div>
<p>&nbsp;</p>
<script>

<?php

// set for autofill
if (isset($_GET['af'])) $currentyear--;

$result = mysql_query("select * from building_material where sch_num='$sch_num' and sch_year='$currentyear'");

if (mysql_num_rows($result)>0) echo "autoFillEnabled = false;\n";

while ($row = mysql_fetch_array($result)){
	$b = $row['building_no'];
	for ($i=0;$i<strlen($row['roof']);$i++){
		$opt = substr($row['roof'],$i,1);
		echo "document.forms[0]['roof[$b][$opt]'].checked = true; \n";
	}
	for ($i=0;$i<strlen($row['truss']);$i++){
		$opt = substr($row['truss'],$i,1);
		echo "document.forms[0]['truss[$b][$opt]'].checked = true; \n";
	}
	for ($i=0;$i<strlen($row['wall']);$i++){
		$opt = substr($row['wall'],$i,1);
		echo "document.forms[0]['wall[$b][$opt]'].checked = true; \n";
	}
}

$result = mysql_query("select * from building_rooms where sch_num='$sch_num' and sch_year='$currentyear'");

if (mysql_num_rows($result)>0) echo "autoFillEnabled = false;\n";

while ($row = mysql_fetch_array($result)){
	$b = $row['building_no'];
	$r = $row['room_no'];
	
	echo "document.forms[0]['l[$b][$r]'].value = '${row['length']}';\n";
	echo "document.forms[0]['b[$b][$r]'].value = '${row['width']}';\n";
	echo "document.forms[0]['h[$b][$r]'].value = '${row['height']}';\n";
	echo "document.forms[0]['roomtype[$b][$r]'].value = '${row['usage']}';\n";
	
}

?>


</script>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"></div>
<br />
</body>

</html>
