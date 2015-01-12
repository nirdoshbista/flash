<?php 

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');


?>
<html>
<head>
<title>Database Export</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
    <p><img src="../images/iemis logo.png" style="width:470px;"></p>
</div>
<br>

<h2 align="center">Export Database</h2>
<p align="center">&nbsp;</p>

<div id='exportform'>
<form name="form1" method="post" action="dbexport.php" onsubmit="document.getElementById('exportform').className='divhide'; document.getElementById('working').className='divshow'; return true;">
  <p align='center'>
  	Year:
  	<select name="y">
  		<option value="<?php echo $currentyear; ?>">This year</option>
  		<option value="">All years</option>
 	</select>
  </p>
  
<?php

$result = mysql_query("SELECT * FROM mast_district",$flashdblink);
if ( mysql_num_rows($result)>1 ){
	echo "<p align='center'>\n";
	echo "District: <select name='d'>";
	
	$darr = array();
	$options_html = "";
	while ($row = mysql_fetch_assoc($result)){
		$options_html .= "<option value='{$row['dist_code']}'>{$row['dist_name']}</option>";
		$darr[] = $row['dist_code'];
	}
	
	echo "<option value='".implode(",",$darr)."'>- All Districts -</option>";
	echo $options_html;
	
	echo "</select>";
	
	echo "</p>\n";
}


?>  
  <p align="center">
    <input type="submit" name="Submit" value="Export">
  </p>  
</form>
</div>
<div id='working' class='divhide'><p align='center'>Exporting data ... <br /><img src='../utils/working.gif'></p></div>

<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<p align="center">&nbsp;</p>

</body>
</html>
