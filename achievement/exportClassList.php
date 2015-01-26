<?php
require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');

$link = dbconnect();

if(isset($_GET['s']) && isset($_GET['y']) && isset($_GET['c']))
{
    $code=$_GET['s'];
    $year=$_GET['y'];
    $class=$_GET['c'];
    $directory="Class List";
    $path=getenv('ALLUSERSPROFILE')."\\Desktop\\".$directory;
    
    if (!file_exists($path)) {
        mkdir($directory,0777,true);
        rename($directory,$path);
    }

    //now to create temporary excel files for all the schools in the utils folder 
    //schoolNames will hold the names of schools
    $result =  mysql_query("select distinct(nm_sch) as name from 
                        mast_schoollist where sch_num='".$code."'
                        order by sch_year desc",$flashdblink);
    if (mysql_num_rows($result)>0)
    {
        $r=mysql_fetch_array($result);
        copy('Class List Template.xls', $code.".xls");
        chmod($code.".xls",0777);
        $schoolName=$r['name'];
    }
    
    //run the vb6 code in the format script.exe param1,param2,...
    //param1:server i.e localhost
    //param2:achievement database i.e "achievement"
    //param3:database i.e "flash"
    //param4:username i.e "root"
    //param5:password i.e "admin"
    //param6:schoolcode i.e "560010001"
    //param7:currentyear i.e "2070"
    //param8:class i.e. "8"
    //param9:temp. file path and nomenclature i.e "C:\Program Files\Flash\htdocs\flash\achievement\"
    
    //check the version of office installed 
    if (file_exists("C:\Program Files\Microsoft Office\Office12\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office12\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportClasslist2007.exe\" ".$dbserver.",".$dbname.",".$flashdbname.",".$dbusername.",".$dbpassword
                    .",".$code.",".$year.",".$class.",".dirname(__FILE__);
    }
    else if (file_exists("C:\Program Files\Microsoft Office\Office14\EXCEL.exe") OR file_exists("C:\Program Files (x86)\Microsoft Office\Office14\EXCEL.exe"))
    {
        $cmd="\"".dirname(__FILE__)."\\exportClasslist2010.exe\" ".$dbserver.",".$dbname.",".$flashdbname.",".$dbusername.",".$dbpassword
                    .",".$code.",".$year.",".$class.",".dirname(__FILE__);
    }
    $output=shell_exec($cmd);
	
    
    
    //delete if a file already exists in desktop and
    //move the temp file to the desktop
    if(file_exists($path."\\".$code." ".$schoolName.".xls"))
            unlink($path."\\".$code." ".$schoolName.".xls");
    rename(dirname(__FILE__)."\\".$code.".xls",$path."\\".$code." ".$schoolName.".xls");
    
    echo "<script>";
    echo "alert('Successfully Exported to Dektop');\n";
    echo "window.location = 'exportClasslist.php';\n";
    echo "</script>";
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Export Class wise List</title>
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
}

function exportExcel(){
	
	var reportlink = '';
	
	if (document.getElementById('d').value==''){
		alert("Please select district.");
		return false;
	}
	if (document.getElementById('v').value==''){
		alert("Please select VDC.");
		return false;
	}
        if (document.getElementById('s').value==''){
		alert("Please select a School.");
		return false;
	}
        if (document.getElementById('y').value==''){
		alert("Please select a Year.");
		return false;
	}
	
	window.location = 'exportClasslist.php?&s='+document.getElementById('s').value+'&y='+document.getElementById('y').value+'&c='+document.getElementById('c').value;
	
	
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
    <td><img src="../images/iemis logo.png" style="width:370px;"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php

?>

<div id='busybox' class='busyboxhide'>
</div>

<p align="center"><h2><center>Select Information to Export</center></h2></p><p>&nbsp;</p>
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
<input name="showreport" type="button" id="showreport" value="Get Excel" onclick="exportExcel();"> 
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
