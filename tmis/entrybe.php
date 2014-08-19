<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('includes/dbfunctions.php');
require_once('includes/commonfn.php');

// get request variables
import_request_variables("gp");


if ($r=='addnewhtml'){
	echo '<h3>Add new</h3>';
	echo "<input type='text' id='newval' onchange='beautify(this)' onkeypress=''> ";
	echo "<input type='button' id='addbtn' value='Add' onclick=\"addToSelect('$d',$('#newval').attr('value'),'$w',true); jQuery(document).trigger('close.facebox');\">";
}

?>
