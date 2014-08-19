<?php include("includes/vars.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Achievement Report Cards</title>
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
	
	if (obj.name=='reporttype'){
		if (obj.value=='report-table' || obj.value=='report-summary'){
			document.getElementById('reportfilters').className = '';
			document.getElementById('studentcode').className = 'divhide';
			document.getElementById('showreport').value = "Show";
		}
		else{
			document.getElementById('reportfilters').className = 'divhide';
			document.getElementById('studentcode').className = '';
			document.getElementById('showreport').value = "Get PDF";
		}
	}
	
}

function showreport(){
	
	var reportlink = '';
	
	if (document.getElementById('reporttype').value=='report-table') reportlink='reporttable.php?';
	else if (document.getElementById('reporttype').value=='report-summary') reportlink='reportsummary.php?';
	else reportlink='report.php?';
	
	if (document.getElementById('d').value==''){
		alert("Please select district.");
		return false;
	}
	
	if (document.getElementById('reporttype').value!='report-table' && document.getElementById('reporttype').value!='report-summary'){
		if (document.getElementById('v').value==''){
			alert("Please select VDC.");
			return false;
		}
	}
	
	// add year
	if (document.getElementById('v').value==''){
		// only district data
		reportlink +=('&s='+document.getElementById('d').value);
	}
	else{
		if (document.getElementById('s').value!='')
			reportlink +=('&s='+document.getElementById('s').value);
		else{
			reportlink +=('&s='+document.getElementById('d').value+document.getElementById('v').value);
		}		
	}
	
	reportlink +=('&y='+document.getElementById('y').value);
	reportlink +=('&c='+document.getElementById('c').value);
	
	if (document.getElementById('reporttype').value!='report-table' && document.getElementById('reporttype').value!='report-summary'){
		reportlink +=('&op='+document.getElementById('limitop').value);
		reportlink +=('&id='+document.getElementById('code').value);
		reportlink +=('&id2='+document.getElementById('code2').value);
		reportlink +=('&r='+document.getElementById('reporttype').value);
		
		if (print==true) reportlink +=('&p=1');
	}
	else{
		reportlink +=('&caste='+document.getElementById('caste').value);
		reportlink +=('&sex='+document.getElementById('sex').value);
		reportlink +=('&sort='+document.getElementById('sort').value);
		reportlink +=('&sch_type='+document.getElementById('sch_type').value);
	}
	
	//alert(reportlink);
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
    <td><img src="images/dle.png"></td>
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
<option selected value="<?php echo $currentyear; ?>"><?php echo $currentyear; ?>
<?php

for ($yr=$currentyear-1;$yr>=2066;$yr--){
	echo "<option value='$yr'>$yr\n";
	
}

?>
</select>

</div></td>

    <td><div id="selectschool">
<select></select>

</div></td>

<td>
<select name='c' id='c'>
<?php
$selectedClass = $default_class;
for ($i=1;$i<=12;$i++){
	if ($selectedClass==$i) echo "<option value='$i' selected>Class $i</option>";
	else echo "<option value='$i'>Class $i</option>";
}
?>
</select>
</td>

</tr>

</table>
<br />
Report Type  
<select id='reporttype' name='reporttype' onchange='return handlechange(this);'>
<option value='marksheet'>Marksheet
<option value='ledger'>Ledger
<option value='report-table'>Report (Table)
<option value='report-summary'>Report (Summary)

</select>
<div id='studentcode'>
	Student Code 
	<select name='limitop' id='limitop' onchange="if (this.value=='bt') document.getElementById('code2').disabled = false; else document.getElementById('code2').disabled = true;">
	<option value='eq' selected>Only
	<option value='lt'>Upto
	<option value='gt'>After
	<option value='bt'>Between
	</select>
	<input type='text' id='code'>
	 - <input type='text' id='code2' disabled>
</div>
<div id='reportfilters' class='divhide'>
School Type
<select id='sch_type' name='sch_type'>
	<option value=''>All </option>
	<option value='1'> Government Aided </option>
	<option value='2'> Community Managed </option>
	<option value='3'> Quota Teacher </option>
	<option value='4'> Government Unaided </option>
	<option value='5'> Government Supported (Excluding Religious) </option>
	<option value='6'> Government Supported (Including Religious) </option>
	<option value='7'> Institutional but Private Trust </option>
	<option value='8'> Institutional but Public Trust </option>
	<option value='9'> Institutional but Company </option>
	<option value='10'> Institutional (All) </option>
	<option value='11'> Madrassas </option>
	<option value='12'> Gumbas </option>
	<option value='13'> Ashrams </option>
	<option value='14'> Religious (All)</option>
</select>


	
Report Filter 
<select id='caste' name='caste'>
	<option value=''>- All Castes -</option>
	<option value="1">Dalit</option>
	<option value="2">Janjati</option>
	<option value="3">Badi</option>
	<option value="4">Brahmin/Chhetri</option>
	<option value="5">Tharu</option>
	<option value="6">Raji</option>
	<option value="7">Sonaha</option>
	<option value="8">Mukta</option>
	<option value="9">Kamaiya</option>
	<option value="10">Madheshi</option>
	<option value="11">Muslim</option>
	<option value="12">Others</option>
</select> 
<select name="sex" id="sex">
<option value="">- All Sexes -</option>
<option value="1">Male</option>
<option value="2">Female</option>
</select>

Sort by
<select name="sort" id="sort">
<option value="name">Name</option>
<option value="mark">Total Mark</option>
</select>
</div>
<br />
<input name="showreport" type="button" id="showreport" value="Get PDF" onclick="showreport()"> 
	</td>
	</tr>
      </table>
	  
	  </td>
  </tr>
</table>
<div id="toprightmenu" style="position:absolute; top:10px; right:10px;"><a href="index.php">Main Menu</a> | <a href="../logout.php">Logout</a></div>

<p>&nbsp; </p>
</body>

</html>
