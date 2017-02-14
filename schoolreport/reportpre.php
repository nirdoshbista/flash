<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash Report Cards</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
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


}

function showreport(){

	var reportlink='reportshow.php?';

	if (document.getElementById('d').value=='' && document.getElementById('t').value==''){
		alert("Please select district or tag.");
		return false;

	}

	reportlink +=('d='+document.getElementById('d').value);
	if (document.getElementById('d').value!='') {
		reportlink +=('&'+'v='+document.getElementById('v').value);

		if (document.getElementById('v').value!=''){
			reportlink +=('&'+'s='+document.getElementById('s').value);
		}


	}

	reportlink +=('&t='+document.getElementById('t').value);

	if (document.getElementById('t').value!=''){
		reportlink +=('&tn='+document.getElementById('tn').value);
	}

	// add year

	reportlink +=('&yr='+document.getElementById('y').value);

	//alert(reportlink);
	window.location = reportlink;


}

function getStudentDetails(){
  var reportlink = 'studentDetails.php?';

  if (document.getElementById('d').value=='' && document.getElementById('t').value==''){
		alert("Please select district or tag.");
		return false;
	}
  // alert(document.getElementById('d').value);
	reportlink += ('d='+document.getElementById('d').value);
	if (document.getElementById('d').value!='') {
		reportlink +=('&'+'v='+document.getElementById('v').value);

		if (document.getElementById('v').value!=''){
			reportlink +=('&'+'s='+document.getElementById('s').value);
		}
	}

	reportlink +=('&t='+document.getElementById('t').value);

	if (document.getElementById('t').value!=''){
		reportlink +=('&tn='+document.getElementById('tn').value);
	}

	// add year

	reportlink +=('&yr='+document.getElementById('y').value);
	
	//alert(reportlink);
	window.location = reportlink;

}

function compareschool(){

	var reportlink='compareschool.php?';

	if (document.getElementById('d').value=='' && document.getElementById('t').value==''){
		alert("Please select district or tag.");
		return false;
	}

	reportlink +=('d='+document.getElementById('d').value);
	if (document.getElementById('d').value!='') {
		reportlink +=('&'+'v='+document.getElementById('v').value);

		if (document.getElementById('v').value!=''){
			reportlink +=('&'+'s='+document.getElementById('s').value);
		}


	}

	reportlink +=('&t='+document.getElementById('t').value);

	if (document.getElementById('t').value!=''){
		reportlink +=('&tn='+document.getElementById('tn').value);
	}

	// add year

	reportlink +=('&yr='+document.getElementById('y').value);

	//alert(reportlink);
	window.location = reportlink;


}
</script>


</head>



<body>


<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="images/flash.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

?>

<div id='busybox' class='busyboxhide'>
</div>

<p align="center"><h2><center>School Report Cards</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142">
	<table width="100%" border="0" cellpadding="10" style="background: white;">
        <tr>
          <td height="66" class="ewListAdd"><p>



<table border="0" cellspacing="0" cellpadding="10">
  <tr class="ewListAdd">
    <td><div id="selectdistrict">
<select></select>
</div></td>
    <td><div id="selectvdc">
<select></select>

</div></td>

    <td><div id="selectyear">
Year:
    <select name='y' id='y' onchange='return handlechange(this, event);'>
<?php

include "../includes/vars.php";
for ($y=$currentyear-1;$y>=2064;$y--){
	print "<option value='$y'>$y</option>\n";
}
?>

</select>

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


		   <input name="showreport" type="button" id="showreport" value="Show" onclick="showreport()">
		   <input name="compareschool" type="button" id="compareschool" value="Compare School" onclick="compareschool()">
       <input name="schoolId" type="button" id="schoolId" value="School ID" onclick="getStudentDetails()">

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
