<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flash I - Reports</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style>

.reportfolder{
	vertical-align: middle;
	background-image: url(../images/folder.png);
	background-repeat: no-repeat;
	background-position: left center;
	padding: 12px 5px 12px 35px;
}

.reportlink{
	vertical-align: middle;
	background-image: url(../images/report.png);
	background-repeat: no-repeat;
	background-position: left center;
	padding: 12px 5px 12px 35px;
}





</style>

<script>
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
      } 
    } 
	
    XMLHttpRequestObject.send(null); 
  }
}

function openFolder(p){
	ajaxDiv('reportnav.php?p='+p,'reports')
}

function openReport(r){
	window.open('reportpre.php?r='+r);
}

</script>


</head>



<body onload="ajaxDiv('reportnav.php?p=reports/','reports');">
<table width="100%" border="0" cellpadding="10">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td><img src="../images/flash1.png"></td>
    <td>&nbsp;</td>
  </tr>
</table>
<div style="position:absolute; top:10px; right:10px;"><a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>
<div id='busybox' class='busyboxhide'>
</div>

<p align="center"><h2><center>Reports</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
  <tr>
    <td height="142">
	<table width="100%" border="0" cellpadding="10" style="background: white;">
        <tr> 
          <td height="66" class="ewListAdd"><p>
		  
		  
<h3>Reports</h3>


            <div id='reports'> 
           </div>
		   <p>

	</td>
	</tr>
      </table>
	  
	  </td>
  </tr>
</table>
<p>&nbsp; </p>
</body>

</html>
