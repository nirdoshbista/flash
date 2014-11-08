<?php
require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

if ($_POST['save']){
	
	foreach ($_POST as $variable => $value){
		if ($variable == 'save') continue;
                if($variable=='grace_marks') calculateGraceMarks($currentyear,(int)$_POST['grace_marks']);
                
		mysql_query("DELETE FROM settings WHERE variable='$variable'");
		mysql_query("INSERT INTO settings (variable, value) VALUES ('$variable','$value')");
	}
	
	$message = "Settings saved.";
	
	// override settings from table
	$result = mysql_query("SELECT * FROM settings");
	while ($row = mysql_fetch_assoc($result)){
		if (isset($SETTINGS[$row['variable']])){
                    $SETTINGS[$row['variable']] = $row['value'];
		}
	}	
        
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title><?php echo $app_title; ?></title>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body id='BodyID'>
<div class='header'>
<div style="float: left"><?php echo $app_title; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>
<div id='notify' class='notify-info'><?php if ($message!='') echo $message; ?></div>

<div style="clear: both">&nbsp;</div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<h2>Settings</h2>


<h3>Marksheet</h3>
<p><strong>&nbsp;&gt;&nbsp;<a href="marksheet_layout.php" target="_blank">Marksheet Layout</a></strong></p>
<table>
<tr>
	<td width="250"><strong>Paper Size</strong></td>
	<td><?php echo_select('marksheet_size', array("letter"=>"Letter","a4"=>"A4","a3"=>"A3")); ?></td>
</tr>
<tr>
	<td><strong>Paper Orientation</strong></td>
	<td><?php echo_select('marksheet_orientation', array("portrait"=>"Portrait","landscape"=>"Landscape")); ?></td>
</tr>
<tr>
	<td><strong>Page Margin</strong></td>
	<td><?php echo_select('marksheet_page_margin', array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15")); ?></td>
</tr>
<tr>
	<td><strong>Font</strong></td>
	<td><?php echo_select('marksheet_font', array("Arial"=>"Arial","Courier"=>"Courier","Helvetica"=>"Helvetica")); ?></td>
</tr>
<tr>
	<td><strong>Font Size</strong></td>
	<td><?php echo_select('marksheet_font_size', array("6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16")); ?></td>
</tr>
<tr>
	<td><strong>Subjects Line Spacing</strong></td>
	<td><?php echo_select('marksheet_line_spacing', array("1"=>"1","1.25"=>"1.25","1.5"=>"1.5","1.75"=>"1.75","2"=>"2","2.25"=>"2.25","2.5"=>"2.5")); ?></td>
</tr>
<tr>
	<td><strong>Show total if failed</strong></td>
	<td><?php echo_select('marksheet_show_total_if_failed', array("1"=>"Yes","0"=>"No")); ?></td>
</tr>
<tr>
	<td><strong>Add failed marks to total</strong></td>
	<td><?php echo_select('marksheet_add_failed_mark_to_total', array("1"=>"Yes","0"=>"No")); ?></td>
</tr>
<tr>
	<td><strong>Show failed marks</strong></td>
	<td><?php echo_select('marksheet_show_failed_marks', array("-"=>"Show dash","*"=>"Show with *", ""=>"Show nothing")); ?></td>
</tr>
<tr>
	<td><strong>Date</strong></td>
	<td><?php echo_input('marksheet_date'); ?></td>
</tr>

</table>

<h3>Ledger</h3>
<table>
<tr>
	<td width="250"><strong>Paper Size</strong></td>
	<td><?php echo_select('ledger_size', array("letter"=>"Letter","a4"=>"A4","a3"=>"A3")); ?></td>
</tr>
<tr>
	<td><strong>Page Margin</strong></td>
	<td><?php echo_select('ledger_page_margin', array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15")); ?></td>
</tr>
<tr>
	<td><strong>Paper Orientation</strong></td>
	<td><?php echo_select('ledger_orientation', array("portrait"=>"Portrait","landscape"=>"Landscape")); ?></td>
</tr>
<tr>
	<td><strong>Font</strong></td>
	<td><?php echo_select('ledger_font', array("Arial"=>"Arial","Courier"=>"Courier","Helvetica"=>"Helvetica")); ?></td>
</tr>
<tr>
	<td><strong>Font Size</strong></td>
	<td><?php echo_select('ledger_font_size', array("6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16")); ?></td>
</tr>

<tr>
	<td><strong>Show total if failed</strong></td>
	<td><?php echo_select('ledger_show_total_if_failed', array("1"=>"Yes","0"=>"No")); ?></td>
</tr>
<tr>
	<td><strong>Add failed marks to total</strong></td>
	<td><?php echo_select('ledger_add_failed_mark_to_total', array("1"=>"Yes","0"=>"No")); ?></td>
</tr>
<tr>
	<td><strong>Show failed marks</strong></td>
	<td><?php echo_select('ledger_show_failed_marks', array("-"=>"Show dash","*"=>"Show with *", ""=>"Show nothing")); ?></td>
</tr>
<tr>
	<td><strong>Show grace mark</strong></td>
	<td><?php echo_select('ledger_show_grace_mark', array("1"=>"Yes","0"=>"No")); ?></td>
</tr>


</table>

<h3>Marks</h3>
<table>
<tr>
	<td width="250"><strong>Enter Grace Mark to be provided</strong></td>
	<td><?php echo_input_marks('grace_marks'); ?></td>
</tr>
</table>

<br />
<input type="submit" name='save' value="Save" />

</form>

</body>
</html>
<?php

function echo_input($name){
	global $SETTINGS;
	
	echo "<input type='text' name='$name' value=\"{$SETTINGS[$name]}\" />";
	
}

function echo_input_marks($name){
	global $SETTINGS;
	echo "<input type='text' name='$name' size='4' onkeypress='return forceNumberInput(this, event);' value=\"{$SETTINGS[$name]}\" />";
	
}

function echo_select($name, $options){
	global $SETTINGS;
	
	echo "<select name='$name'>";
	
	foreach ($options as $value=>$display){
		if ($value==$SETTINGS[$name]) $selected = "selected"; else $selected = "";
		echo "<option value=\"$value\" $selected>$display</option>";
	}
	
	echo "</select>";
	
}

?>
