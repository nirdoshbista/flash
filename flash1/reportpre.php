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


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="../images/flash1.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

?>

<div id='busybox' class='busyboxhide'>
</div>

<p align="center"><h2><center>Reports</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142">
	<table width="100%" border="0" cellpadding="10" style="background: white;">
        <tr> 
          <td height="66" class="ewListAdd"><p>
		  
		  

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


<table border="0" cellspacing="0" cellpadding="10">
  <tr class="ewListAdd">
    <td><div id="selectdistrict">
<select></select>
</div></td>
    <td><div id="selectvdc">
<select></select>

</div></td>
    <td><div id="selectschool">
<select></select>

</div></td>
  </tr>
  
  <tr><td colspan=3 class='ewListAdd'>
  <br>
  <div id="selecttagcat"></div><div id="selecttagname"></div>
  </td></tr>
</table>


<p>&nbsp;</p>
		   
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

?>		   

<p>&nbsp;</p>		  
		   
		   <input name="showreport" type="button" id="showreport" value="Show" onclick="showreport()">
	</td>
	</tr>
      </table>
	  
	  </td>
  </tr>
</table>
<p>&nbsp; </p>
</body>

</html>
