<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Reports</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>

var totaloptions = 0;

function ajaxDiv(url, targetdiv)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
	//alert(url);
    XMLHttpRequestObject.open("GET", url); 
    

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
    if (XMLHttpRequestObject.readyState == 4 && 
		XMLHttpRequestObject.status == 200) { 
		
		document.getElementById(targetdiv).innerHTML=XMLHttpRequestObject.responseText;
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
		  if (targetdiv=='selectvdc'){
				ajaxDiv('reportprebe.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value,'selectschool')
		  }
      } 
    } 
	
    XMLHttpRequestObject.send(null); 
  }
}

var reporttype = 1;
window.onload = function(){
	document.getElementById('selectdistrict').className="divshow";
	document.getElementById('selectvdc').className="divhide";
	document.getElementById('selectschool').className="divhide";
	ajaxDiv('reportprebe.php?req=distlist','selectdistrict');
	ajaxDiv('reportprebe.php?req=taglist','selecttagcat');
	
	
	
}



function handleclick(obj, event){
}

function handlechange(obj, event){

	if (obj.name=='d'){
	
		ajaxDiv('reportprebe.php?req=vdclist&distcode='+document.getElementById('d').value,'selectvdc');
		
		if (obj.value==0){
			document.getElementById('selectvdc').className="divhide";
			document.getElementById('selectschool').className="divhide";		
		}
		else{
			document.getElementById('selectvdc').className="divshow";
			document.getElementById('selectschool').className="divshow";				
		}
		
		
		
		

	


	}

	if (obj.name=='v'){
		ajaxDiv('reportprebe.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value,'selectschool');
		
	}
	
	
	if (obj.name=='t'){
		if (obj.value!=''){
			document.getElementById('d').disabled = true;
			if (document.getElementById('d').value!=0){
				document.getElementById('v').disabled = true;
				document.getElementById('s').disabled = true;
			
			}
			
			ajaxDiv('reportprebe.php?req=tagname&t='+document.getElementById('t').value,'selecttagname');
			
		}
		else{
		
			document.getElementById('d').disabled = false;
			if (document.getElementById('d').value!=0){
			
				document.getElementById('v').disabled = false;
				document.getElementById('s').disabled = false;		
			}
			
			document.getElementById('selecttagname').innerHTML='';
			
		}
	}
	
	/*
	if (obj.name=='tn'){
		if (document.getElementById('tn').value!=''){
			document.getElementById('expandschool').disabled = false;
		}
		else{
			document.getElementById('expandschool').disabled = true;
		}
	}
	*/
	

}

function showreport(){
	if (document.getElementById('reportpath').value==""){
		return;
	}
	
	if (document.getElementById('year').value==''){
		alert('Select at least one year');
		return;
	}
	
	var reportlink='reportparser.php?r=';
	reportlink +=document.getElementById('reportpath').value;

	reportlink +=('&'+'d='+document.getElementById('d').value);
	if (document.getElementById('d').value!='0') {
		reportlink +=('&'+'v='+document.getElementById('v').value);
		if (document.getElementById('v').value=='0'){
			if (document.getElementById('s').checked==true) reportlink +=('&s=1');
			else reportlink +=('&s=0');
		}
	
	
	}
	
	reportlink +=('&t='+document.getElementById('t').value);
	
	if (document.getElementById('t').value!=''){
		reportlink +=('&tn='+document.getElementById('tn').value);

		if (document.getElementById('expandschool').disabled == false && document.getElementById('expandschool').checked==true){
			reportlink += ('&te=1');
		}
	}
	
	


	
	/*
	if (document.getElementById('t')!='0'){
		reportlink +=('&t='+document.getElementById('t').value);
	}
	
	*/	
	for (i=1;i<totaloptions;i++){
		reportlink += ('&opt'+i+'='+document.getElementById('opt'+i).value);
	}
	
	// year information
	reportlink += "&year="
	var yearobj = document.getElementById('year');
	var i;
	for (i=0;i<yearobj.options.length;i++){
		if (yearobj.options[i].selected)
			reportlink += yearobj.options[i].value + ",";
	}
	
	if (document.getElementById('colwise').checked) reportlink += "&colwise";
	
	//alert(reportlink);
	window.location = reportlink;
	
	
}


</script>


</head>



<body>



<?php

?>

<div id='busybox' class='busyboxhide'>
</div>

<p>
		  
		  

<?php

$r=$_GET['r'];
echo "<input type='hidden' name='reportpath' id='reportpath' value='$r'>";

$v = parse_ini_file($r, true);

include_once("../includes/reportfunctions.php");
include_once("../includes/vars.php");
reportfix($v);

echo "<h3><center>";
echo $v['header']['title1'];
echo "</center></h3>";


?>


    <div id="selectdistrict">
<select></select>
</div>
    <div id="selectvdc">
<select></select>

</div>
<div id="selectschool">
<select></select>

</div>
  <br>
  <div id="selecttagcat"></div><div id="selecttagname"></div>

		   
<?php
if (isset($v['prereq'])){
	$n = 1;
	
	while (isset($v['prereq']['prereq'.$n.'title'])){
		$title = $v['prereq']['prereq'.$n.'title'];
		$options = explode("|",$v['prereq']['prereq'.$n.'options']);
		
		echo "<p><b>$title</b><br />";
		
		if (strtolower($title)=='year'){
			// special case for year
			
			echo "<input id='opt$n' hidden value='' />";
			echo "<select id='year' multiple>";
			$po = "selected";
			foreach($options as $op){
				echo "<option value='$op' $po>$op</option>";
				$po="";
			}
			echo "</select>";	
			
			echo "<label><input type='checkbox' checked id='colwise' /> Column Wise Trend</label>";
		}
		else{
			// other options than year
			
			echo "<select id='opt$n'>";
			
			$value=0;
			foreach($options as $op){
				echo "<option value='$value'>$op</option>";
				$value++;
			}
			
			echo "</select>";			
			
			
		}
		

		
		$n++;
		
	}
	
	echo "<script>";
	echo "totaloptions = $n;";
	echo "</script>";

}


//
// print table headers
//

$ro = $v;

	// count total table column count
	$i=1;
	if (isset($ro['tableheader']['row'.$i])){
		$rowstr = $ro['tableheader']['row'.$i];
		$cols = explode("|",$rowstr);
		
		$colcount = 0;
		foreach ($cols as $c){
			ereg(".*\[(.*)\].*",$c,$t);

			if (isset($t[1])){
				if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
					$colcount += (int)$t[2];
				}
				else{
					$colcount += (int)$t[1];
				}
			}
			else $colcount++;

		}
	}
	$colcount -= 2; // subtracting first code/name col	
	
	echo '<table class="ewTable" width="100%">';
	
	
	$first = true;
	for ($i=1;$i<10;$i++){
		if (isset($ro['tableheader']['row'.$i])){
			
			$rowstr = $ro['tableheader']['row'.$i];
			$cols = explode("|",$rowstr);
			
			echo '<tr style="text-align:center; font-weight: bold;">';
			
			
			$thstr = "";
			foreach ($cols as $c){
				
				if (isset($_GET['colwise'])){
					$m = count($Y);
				}
				else $m = 1;				
				
				if ($first) $m=1; // dont apply colspan expansion for first cell (code/name)
				
				ereg(".*\[(.*)\].*",$c,$t);
				//echo $t[1];
				$spn='';
				if (isset($t[1])){
					if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
						$spn="rowspan='".$t[1]."' colspan='".(int)$t[2]*$m."'";
					}
					else{
						if(ereg(".*\[([0-9]*)\].*",$c,$t)) $spn="colspan='".(int)$t[1]*$m."'";
						else $spn="colspan='".$m."'";
					}
				}
				else $spn="";

				ereg("([^\[]*)(\[.*|$)",$c,$t);
				$colname=$t[1];
				
				if (substr($colname,0,4)=="Code") continue;
				
				echo "<td $spn>$colname</td>\n";
				if (!$first) $thstr .= "<td $spn>$colname</td>\n";
				$first = false;
			}
			
			
			echo "\n\n</tr>";
			
			
		}
	}
	echo "<tr>";
	for ($i=0;$i<$colcount; $i++){
		echo "<td><input type='checkbox' checked /></td>";
	}
	echo "</tr>";
	
	echo "</table>";

?>		   

		   
		   <input name="showreport" type="button" id="showreport" value="Show" onclick="showreport()">

</body>

</html>
