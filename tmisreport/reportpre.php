<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>TMIS Report Cards</title>
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
		  //if (targetdiv=='selectvdc'){
			//	ajaxDiv('reportprebe.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value,'selectschool')
		  //}
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
		
		if (obj.value==0){
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
	
	/*
	if (obj.name=='t'){
		if (obj.value!=''){
			document.getElementById('d').disabled = true;
			document.getElementById('y').disabled = true;
			if (document.getElementById('d').value!=0){
				if (document.getElementById('v')) document.getElementById('v').disabled = true;
				if (document.getElementById('s')) document.getElementById('s').disabled = true;
			}
			
			ajaxDiv('reportprebe.php?req=tagname&t='+document.getElementById('t').value,'selecttagname');
			
		}
		else{
		
			document.getElementById('d').disabled = false;
			document.getElementById('y').disabled = false;
			if (document.getElementById('d').value!=0){
			
				if (document.getElementById('v')) document.getElementById('v').disabled = false;
				if (document.getElementById('s')) document.getElementById('s').disabled = false;		
			}
			
			document.getElementById('selecttagname').innerHTML='';
			
		}
	}
	*/

}

function showreport(){
	
	var reportlink='report.php?';
	
	if (document.getElementById('d').value==''){
		alert("Please select district.");
		return false;
	}
	if (document.getElementById('v').value==''){
		alert("Please select VDC.");
		return false;
	}		
	
	// add year
	
	if (document.getElementById('s').value!='')
		reportlink +=('s='+document.getElementById('s').value);
	else{
		reportlink +=('s='+document.getElementById('d').value+document.getElementById('v').value);
	}
	
	
	reportlink +=('&y='+document.getElementById('y').value);
	
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

<p align="center"><h2><center>TMIS Report Cards</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142">
	<table width="100%" border="0" cellpadding="10" style="background: white;">
        <tr> 
          <td height="66" class="ewListAdd"><p>
		  
		  

<table border="0" cellspacing="0" cellpadding="10">
  <tr class="ewListAdd">
    <td><div id="selectdistrict">
<select id='d'></select>
</div></td>
    <td><div id="selectvdc">
<select id='v'></select>

</div></td>

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

    <td><div id="selectschool">
<select id='s'></select>

</div></td>
</table>
		   
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
