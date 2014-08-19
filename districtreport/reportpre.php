<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>District / VDC Report Cards</title>
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
		  busybox(false,"");
      } 
    } 
	busybox(true, "Querying..");
    XMLHttpRequestObject.send(null); 
  }
}



function busybox(showhide, text){
	
	if (showhide==true){	
		document.getElementById('busybox').innerHTML = text;
		document.getElementById('busybox').className = 'busyboxshow';
	}
	else{
		document.getElementById('busybox').className = 'divhide';
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
		
		if (obj.value==0 || obj.value==-1){
			document.getElementById('selectvdc').className="divhide";
			document.getElementById('selectschool').className="divhide";		
		}
		else{
			document.getElementById('selectvdc').className="divshow";
			document.getElementById('selectschool').className="divshow";				
		}
		

	}

	
	if (obj.name=='v' || obj.name=='y'){
		ajaxDiv('reportprebe.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value+'&y='+document.getElementById('y').value,'selectschool');
		
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

	if (obj.name=='s'){
		document.getElementById('st').disabled = (obj.value.length!=''?true:false);
	}
	
	

}

function showreport(){
	
	var reportlink='report.php?';
	
	if (document.getElementById('d').value=='' && document.getElementById('t').value=='' ){
		alert("Please select district or tag.");
		return false;
	}

	if (document.getElementById('d').disabled == false) reportlink +=('d='+document.getElementById('d').value);
	if (document.getElementById('d').value!='' && document.getElementById('d').value!='-1') {
		if (document.getElementById('v').disabled == false) reportlink +=('&'+'v='+document.getElementById('v').value);
		
		
		if (document.getElementById('v').value!='' && document.getElementById('v').value!='-1'){
			if (document.getElementById('s').disabled == false) reportlink +=('&'+'s='+document.getElementById('s').value);
		}
		
	
	
	}
	
	// add year
	
	reportlink +=('&y='+document.getElementById('y').value);
	reportlink +=('&r='+document.getElementById('r').value);
	
	
	// tag
	if (document.getElementById('t').disabled == false) reportlink +=('&t='+document.getElementById('t').value);
	if (document.getElementById('t').value!=''){
		if (document.getElementById('tn').disabled == false) reportlink +=('&tn='+document.getElementById('tn').value);
	}	
	
	// school type
	reportlink +=('&st='+document.getElementById('st').value);
	
	
	//alert(reportlink);
	window.location = reportlink;
	
	
}


</script>


</head>



<body>


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="../images/iemis logo.png" style="width:470px;"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

?>

<div id='busybox' class='busyboxhide'>
</div>

<p align="center"><h2><center>District / VDC Report Cards</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142">
	<table width="100%" border="0" cellpadding="10" style="background: white;">
        <tr> 
          <td height="66" class="ewListAdd"><p>
		  
		  

<table border="0" cellspacing="0" cellpadding="10">
  <tr class="ewListAdd">
    <td><div id="selectyear">
Year: 
    <select name='y' id='y' onchange='return handlechange(this, event);'>

<?php

include "../includes/vars.php";
for ($y=$currentyear;$y>=2064;$y--){
	print "<option value='$y'>$y</option>\n";
}
?>    

</select>

</div></td>

  <td>
  <div id="selectdistrict">
<select></select>
</div>
</td>
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
  
  <tr>
  <td colspan=3 class='ewListAdd'>
  <br />
  School Type: 
	<select name='st' id='st'>
		<option value="1-10">All</option>
		<option value="1-4" style="font-weight:bold;">Govt. Schools</option>
		<option value="1"> Govt. Aided</option>
		<option value="2"> Community Managed</option>
		<option value="3"> Quota Teachers</option>
		<option value="4"> Unaided</option>
		<option value="5-7" style="font-weight:bold;">Institutional Schools</option>
		<option value="5"> Institutional (Private)</option>
		<option value="6"> Institutional (Public)</option>
		<option value="7"> Institutional (Company)</option>
		<option value="8-10" style="font-weight:bold;">Religious Schools</option>
		<option value="8"> Madrassa</option>
		<option value="9"> Gumba</option>
		<option value="10"> Aashram</option>
		<option value="11" style="font-weight:bold;">SOP/FSP</option>
		<option value="12" style="font-weight:bold;">Community ECD</option>
	</select>
  </td></tr>

  <tr>
  <td colspan=3 class='ewListAdd'>
  <br />
  Report: 
	<select name='r' id='r'>
		<option value="1">Achievements (by number)</option>
		<option value="6">Achievements (by percentage)</option>
		<option value="2">Schools</option>
		<option value="3">School, Disability, MC</option>
		<option value="4">Agewise</option>
		<option value="5">Teachers</option>
		<option value="7">ECD</option>
		<option value="8">SOP/FSP</option>
	</select>
  </td></tr>
</table>


<p>&nbsp;</p>
		   
		   
		   <input name="showreport" type="button" id="showreport" value="Show" onclick="showreport()">
	</td>
	</tr>
      </table>
	  
	  </td>
  </tr>
</table>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>

<p>&nbsp; </p>
</body>
</html>
