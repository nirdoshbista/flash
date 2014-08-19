<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

require_once('../includes/vars.php');
require_once('../includes/dbfunctions.php');

$link = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$link) {
   die('Could not connect to MySQL server: ' . mysql_error());
}
$result =mysql_select_db($dbname, $link);

$req=$_GET['req'];

if ($req=='distlist'){
	$result = mysql_query('select * from mast_district order by dist_name');
	$rows = mysql_fetch_all($result);


	printf('<select name="distlist" id="distlist" onchange="districtChange()" size="10">');
	printf('<option value="%s">%s</option>', '', '-- District --');

	foreach($rows as $r){
		printf('<option value="%s">%s</option>', $r['dist_code'], $r['dist_name']);

	}
	printf('</select>');

}

if ($req=='vdclist'){
	if (isset($_GET['distcode'])){
		$result = mysql_query(sprintf('select * from mast_vdc where dist_code="%s" order by vdc_name_e',$_GET['distcode']));
		$rows = mysql_fetch_all($result);


		printf('<select name="vdclist" id="vdclist" onchange="vdcChange()" size="10" multiple>');

		/*
		if (mysql_num_rows($result)==0){
			printf('<option value="%s">%s</option>', '', '-- Select District first --');
		}
		else printf('<option value="%s">%s</option>', '', '-- VDC --');
		*/

		foreach($rows as $r){
			printf('<option value="%s">%s</option>', $r['vdc_code'], $r['vdc_name_e']);

		}
		

		printf('</select>');
	}

}

if ($req=='schoollist'){

	$result=mysql_query("select * from mast_schoollist where dist_code='".$_GET['distcode']."' and vdc_code='".$_GET['vdccode']."' group by sch_num order by sch_num");
	$rows = mysql_fetch_all($result);
	printf('<select name="schoollist" id="schoollist" size="10" multiple>');

	/*
	if (mysql_num_rows($result)==0){
		printf('<option value="%s">%s</option>', '', '-- Select VDC first --');
	}
	else printf('<option value="%s">%s</option>', '', '-- SCHOOL --');
	*/

	foreach($rows as $r){
		printf("<option value='%s'>%s</option>",$r['sch_num'],$r['sch_code'].' - '.$r['nm_sch']);

	}
	

	printf('</select>');


}

if ($req=='tagmeaning'){
	$codes=$_GET['codes'];

?>	
	<table class='ewTable' align='center' width="75%">
	<tr class='ewTableHeader'>
	<td width="10%">S.No.</td>
	<td width="70%">Tag Contents</td>
	<td width="20%"></td>
	</tr>
	
<?php

	$parts=explode(' ',$codes);
	
	$i=1;
	
foreach($parts as $p)	{

	if (trim($p)=='') continue;

	echo '<tr>';
	
	if (strlen($p)>2){
		$dcode=substr($p,0,2);
	}
	
	if (strlen($p)>5){
		$vcode=substr($p,2,3);
	}
	
	if (strlen($p)>=9){
		$result=mysql_query("select nm_sch from mast_schoollist where sch_num like '$p'");
		$r=mysql_fetch_array($result);
		$schoolname=$r['nm_sch'].', ';
	}
	
	
	
	echo '<td>'.$i++.'</td>';
	echo '<td>'.str_replace('%','',$p).' - '.$schoolname.' '.dvname($dcode,$vcode).'</td>';
	echo "<td><input type='button' value='Delete' onclick='tagdelete(\"$p\");'></td>";
	echo '</tr>';
	
	unset($dcode);
	unset($vcode);
	unset($schoolname);


}
	
		
		
		
	echo '</table>';
	
}


function dvname($dcode, $vcode){
	global $link;
	
	if ($dcode=='') return '';
	
	$result=mysql_query("select dist_name from mast_district where dist_code='$dcode'");
	$r=mysql_fetch_array($result);
	

	$dname= $r['dist_name'];
	
	echo mysql_error();

	if ($vcode!=''){
		$result=mysql_query("select vdc_name_e from mast_vdc where dist_code='$dcode' and vdc_code='$vcode'");
		$r=mysql_fetch_array($result);
		
		$vname= $r['vdc_name_e'];
	}
	
	return (($vname==''?'':$vname.", ").$dname);

	
}

	


?>
