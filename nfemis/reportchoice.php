<?php include("includes/vars.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>NFE Report</title>
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
	document.getElementById('specificfilter').className="divhide";
	ajaxDiv('reportchoice_backend.php?req=distlist','selectdistrict');
	
	
	
}



function handleclick(obj, event){
}

function handlechange(obj, event){

	if (obj.name=='d'){
	
		ajaxDiv('reportchoice_backend.php?req=vdclist&distcode='+document.getElementById('d').value,'selectvdc');
		
		if (obj.value==0){
			document.getElementById('selectvdc').className="divhide";
		}
		else{
			document.getElementById('selectvdc').className="divshow";
		}
		

	}	
	if (obj.name=='reportfilters'){
		if (obj.value=='clc'){
			ajaxDiv('reportchoice_backend.php?req=clclist&distcode='+document.getElementById('d').value+'&y='+document.getElementById('y').value,'specificfilter');
                        document.getElementById('specificfilter').className="divshow";	
		}
                else if (obj.value=='school'){
			ajaxDiv('reportchoice_backend.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value+'&y='+document.getElementById('y').value,'specificfilter');
                        document.getElementById('specificfilter').className="divshow";	
		}
                else{
                        document.getElementById('specificfilter').className="divhide";	
                }
	}
        
        if (obj.name=='y'){
		if (document.getElementById('reportfilters').value=='clc'){
			ajaxDiv('reportchoice_backend.php?req=clclist&distcode='+document.getElementById('d').value+'&y='+document.getElementById('y').value,'specificfilter');
                        document.getElementById('specificfilter').className="divshow";	
		}
                if (document.getElementById('reportfilters').value=='school'){
			ajaxDiv('reportchoice_backend.php?req=schoollist&distcode='+document.getElementById('d').value+'&vdccode='+document.getElementById('v').value+'&y='+document.getElementById('y').value,'specificfilter');
                        document.getElementById('specificfilter').className="divshow";	
		}
	}
	
}

function showreport(){
	
	var reportlink = 'nfemisreport.php?';
        
	if (document.getElementById('d').value==''){
		alert("Please select district.");
		return false;
	}
	
        reportlink +=('&d='+document.getElementById('d').value);
        reportlink +=('&y='+document.getElementById('y').value);
        
	// add year
	if (document.getElementById('c') && document.getElementById('reportfilters').value=='clc'){
		reportlink +=('&c='+document.getElementById('c').value);
	}
        else if(document.getElementById('s') && document.getElementById('reportfilters').value=='school'){
		reportlink +=('&sch='+document.getElementById('s').value);
        }
        
	reportlink +=('&a='+document.getElementById('reportfilters').value);
        
	window.location = reportlink;
	
	
}

var print = false;
function printreport(){
	print = true;
	showreport();
	print = false;
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

<p align="center"><h2><center>NFE Report</center></h2></p><p>&nbsp;</p>
<table width="70%" border="0" align="center" cellpadding="50" bgcolor="#FFFFFF" style="border: 1px black solid; background: #eeeeee;">
     <tr>
        <td height="142">
            <table width="100%" border="0" cellpadding="10" style="background: white;">
                <tr> 
                    <td height="66" class="ewListAdd">
                        <p>
                            <table border="0" cellspacing="0" cellpadding="10" style="font-size:10;">
                                <tr class="ewListAdd">
                                    <td>
                                        <div id="selectdistrict">
                                            <select></select>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="selectvdc">
                                            <select></select>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="selectyear">
                                            Year: 
                                            <select name='y' id='y' onchange='return handlechange(this, event);'>
                                                <option selected value="<?php echo $currentyear; ?>"><?php echo $currentyear; ?>
                                                <?php
                                                for ($yr=$currentyear-1;$yr>=2066;$yr--){
                                                        echo "<option value='$yr'>$yr\n";	
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Display :
                                        <select id='reportfilters' name='reportfilters' onchange='return handlechange(this);'>
                                            <option value='all'>All</option>
                                            <option value='clc'>CLCs</option>
                                            <option value='school'>Schools</option>
                                            <option value='local'>Local Bodies</option>  
                                            <option value='cbo'>CBOs</option>
                                            <option value='ingo'>I/NGOs</option>
                                            <option value='dbgo'>DBGOs</option>
                                        </select>
                                    </td>
                                    <td colspan="2">
                                        <div id="specificfilter">
                                            <select></select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="showreport" type="button" id="showreport" value="Get PDF" onclick="showreport()"> 
                                    </td>
                                </tr>
                            </table>
                        </p>
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
