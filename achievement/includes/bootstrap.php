<?php

require("includes/vars.php");

// connect to flash db
$flashdblink = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$flashdblink) die('Could not connect to MySQL server: ' . mysql_error());
if (!mysql_select_db($flashdbname, $flashdblink)){
	die('Flash Database not found');
}

// connect to db
$dblink = mysql_connect($dbserver, $dbusername, $dbpassword,true);
if (!$dblink) die('Could not connect to MySQL server: ' . mysql_error());
if (!mysql_select_db($dbname, $dblink)){
	header('Location: install.php');
	exit();
}

ini_set('memory_limit',"1024M");
ini_set('max_execution_time',"600");

// load printer extension
/*
if (!extension_loaded('printer')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        dl('php_printer.dll');
    }
}
*/

// default options
$SETTINGS['marksheet_size'] = 'letter';
$SETTINGS['marksheet_page_margin'] = '7';
$SETTINGS['marksheet_orientation'] = 'portrait';
$SETTINGS['marksheet_show_total_if_failed'] = "1";
$SETTINGS['marksheet_add_failed_mark_to_total'] = "0";
$SETTINGS['marksheet_show_failed_marks'] = "-";
$SETTINGS['marksheet_font'] = "Courier";
$SETTINGS['marksheet_font_size'] = "8";
$SETTINGS['marksheet_line_spacing'] = "2";
$SETTINGS['marksheet_line_spacing'] = "2";
$SETTINGS['marksheet_date'] = "";

$SETTINGS['ledger_size'] = 'letter';
$SETTINGS['ledger_page_margin'] = '7';
$SETTINGS['ledger_orientation'] = 'portrait';
$SETTINGS['ledger_table_break'] = 10;
$SETTINGS['ledger_show_total_if_failed'] = "1";
$SETTINGS['ledger_add_failed_mark_to_total'] = "0";
$SETTINGS['ledger_show_failed_marks'] = "*";
$SETTINGS['ledger_show_grace_mark'] = "1";
$SETTINGS['ledger_font'] = "Courier";
$SETTINGS['ledger_font_size'] = "8";


// if there's no settings table, create it
mysql_query("CREATE TABLE IF NOT EXISTS settings (`id` int(10) unsigned NOT NULL auto_increment, `variable` varchar(50) NOT NULL, `value` varchar(100) default '', PRIMARY KEY  (`id`))");

// override settings from table
$result = mysql_query("SELECT * FROM settings");
while ($row = mysql_fetch_assoc($result)){
	if (isset($SETTINGS[$row['variable']])){
		$SETTINGS[$row['variable']] = $row['value'];
	}
}

// paper sizes in pixel (72dpi)
$page_size["letter"] = array("w"=>612,"h"=>792);
$page_size["a4"] = array("w"=>595,"h"=>842);
$page_size["a3"] = array("w"=>842,"h"=>1190);

// load default layout values (if not exist)
$result = mysql_query("SELECT * FROM settings WHERE variable LIKE 'layout_%'");
if (mysql_num_rows($result)==0){
	
	// layout default settings
	$layout_default['layout_s_comment'] = '385,521';
	$layout_default['layout_s_grace'] = '385,498';
	$layout_default['layout_s_total'] = '385,467';
	$layout_default['layout_s_practical'] = '385,443';
	$layout_default['layout_s_theory'] = '385,411';
	$layout_default['layout_s_practical_pass_mark'] = '385,383';
	$layout_default['layout_s_practical_full_mark'] = '385,360';
	$layout_default['layout_s_theory_pass_mark'] = '385,332';
	$layout_default['layout_s_theory_full_mark'] = '385,303';
	$layout_default['layout_s_name'] = '385,80';
	$layout_default['layout_sch_year'] = '302,332';
	$layout_default['layout_nm_sch'] = '287,120';
	$layout_default['layout_stu_num'] = '266,365';
	$layout_default['layout_reg_id'] = '266,120';
	$layout_default['layout_mother_name'] = '237,364';
	$layout_default['layout_father_name'] = '237,174';
	$layout_default['layout_dob_en'] = '220,360';
	$layout_default['layout_dob_np'] = '220,184';
	$layout_default['layout_full_name'] = '197,199';
	$layout_default['layout_total'] = '546,462';
	$layout_default['layout_result'] = '566,462';
	$layout_default['layout_date_today'] = '594,456';
	
	foreach ($layout_default as $k=>$v){
		mysql_query("INSERT INTO settings (variable, value) VALUES ('$k','$v')");
	}
	
}


?>
