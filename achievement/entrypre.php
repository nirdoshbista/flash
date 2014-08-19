<?php

include "includes/bootstrap.php";

$d=$_GET['d'];
$v=$_GET['v'];
$s=$_GET['s'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>District Level Examination - School Selection</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
.lb{
	color:  #505050;
	margin: 2px;
	text-decoration:none;
	background:#e0e0e0;
	padding:6px 12px 6px 12px;
	clear: none;
	float:left;
}

.lb:hover{
	background:#d0d0d0;
}

.sectionbox{
	margin: 5px; 
	float: left;
}

.sectionbox h2{
	color: #003366;
	font-size: 1.6em;
	padding:15px 5px;
}

.sectionbox a{
	padding:5px 10px;
	background-color: #ddd;
	color: #333;
	text-decoration: none;
	display: block;
	margin: 5px;
}

.sectionbox a:hover{
	background-color: #ccc;
}

.sectionbox p{
	padding-left:75px;
}



</style>

<script>

function handleChange(obj){
	if (obj.id=='d'){
		var l = "entrypre.php?d="+document.getElementById('d').value;
		location = l;
	}
	if (obj.id=='v'){
		var l = "entrypre.php?d="  + document.getElementById('d').value + '&v=' + document.getElementById('v').value;
		location = l;
	}
	if (obj.id == 's'){
		var l = "entrypre.php?d="  + document.getElementById('d').value + '&v=' + document.getElementById('v').value + '&s=' + document.getElementById('s').value;
		location = l;
	}
}

function showPage(){
	
	if (document.getElementById('d').value==''){
		alert('Enter District');
		document.getElementById('d').focus();
		return;
	}
	
	if (document.getElementById('v').value==''){
		alert('Enter VDC');
		document.getElementById('v').focus();
		return;
	}
	
	if (document.getElementById('s').value==''){
		alert('Enter School');
		document.getElementById('s').focus();
		return;
	}
	
	location = "entry.php?s="+document.getElementById('s').value+'&c='+document.getElementById('c').value;
}

</script>
</head>

<body>
<div style="position:absolute; top:10px; right:10px;"><?php include "nav.php"; ?></div>
<p>&nbsp;</p>
<p align="center">
<img src="images/dle.png">
</p>
<div style="width: 700px; padding: 5px 5px 0 5px; background-color: white; border: 10px solid #999; margin: 0 auto;">
	<div class='sectionbox'>
	<label>Select District</label>
	<select id='d' onchange='handleChange(this)'>
	<option value=''></option>
	
<?php
$result = mysql_query("SELECT * FROM mast_district",$flashdblink);
while ($row = mysql_fetch_assoc($result)){
	printf("<option value='%s' %s>%s</option>",$row['dist_code'], ($d==$row['dist_code']?'selected':''),$row['dist_name']);
}

?>
	</select>
	
	</div>
	<div class='sectionbox'>
	<label>Select VDC</label>
	<select id='v' onchange='handleChange(this)'>
	<option value=''></option>
<?php
$result = mysql_query("SELECT * FROM mast_vdc WHERE dist_code='$d'",$flashdblink);
while ($row = mysql_fetch_assoc($result)){
	printf("<option value='%s' %s>%s</option>",$row['vdc_code'], ($v==$row['vdc_code']?'selected':''),$row['vdc_name_e']);
}

?>	
	
	</select>

	</div>
	<div class='sectionbox'>
	<label>Select School</label>
	<select id='s' onchange='handleChange(this)'>
	<option value=''></option>
<?php
$result = mysql_query("SELECT DISTINCT sch_num, nm_sch FROM mast_schoollist LEFT JOIN mast_school_type using (sch_num, sch_year) WHERE dist_code='$d' AND vdc_code='$v' AND class8>0 ORDER BY nm_sch",$flashdblink);
while ($row = mysql_fetch_assoc($result)){
	printf("<option value='%s' %s>%s</option>",$row['sch_num'],($s==$row['sch_num']?'selected':''),$row['nm_sch']." [{$row['sch_num']}]");
}

?>	
	
	
	</select>

	</div>
	<div style="clear:both"></div>
	<div class='sectionbox'>
	
	Class <select name='c' id='c'><option value='8'>8</option></select>
	<input type='button' value='Go' onclick='showPage()'>
	</div>
	
	<div style="clear:both"></div>
	
	
</div>
&nbsp;
<?php if ($s!=''): ?>

	<?php
	
	$result = mysql_query("SELECT * FROM mast_schoollist WHERE sch_num='$s' and sch_year='$currentyear' and flash1='1'",$flashdblink);
	$ginfo = mysql_fetch_assoc($result);
	
	?>

	<TABLE BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0 style="width:700px; margin: 0 auto;">
		<tr><td colspan="6" BGCOLOR="#e6e6e6"><strong>GENERAL INFORMATION</strong></td></tr>
		<TR VALIGN=TOP>
			<TD style="text-align:left" BGCOLOR="#e6e6e6">
				<B>Address</B>
			</TD>
			<TD style="text-align:left">
				 <?php echo ucwords(strtolower($ginfo['location'])); ?>&nbsp;
			</TD>
			<TD style="text-align:left" BGCOLOR="#e6e6e6">
				<B>Ward No.</B>
			</TD>
			<TD style="text-align:left">
				 <?php echo ucwords(strtolower($ginfo['wardno'])); ?>&nbsp;
			</TD>


			<TD style="text-align:left" BGCOLOR="#e6e6e6">
				<B>Estd. Date</B>
			</TD>
			
			
			<TD style="text-align:left">
				 <?php echo ($ginfo['estd_date']); ?>&nbsp;
			</TD>

		</TR>
		
		<TR VALIGN=TOP>
		
			<TD style="text-align:left" BGCOLOR="#e6e6e6">
				<B>Phone</B>
			</TD>
			<TD style="text-align:left">
				 <?php echo $ginfo['phone']; ?>&nbsp;
			</TD>

			<TD style="text-align:left" BGCOLOR="#e6e6e6">
				<B>Email</B>
			</TD>
			<TD style="text-align:left" colspan="3">
				 <?php echo strtolower($ginfo['email']); ?>&nbsp;
			</TD>
		</TR>
	</TABLE>


	<TABLE BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0 style="width:700px; margin: 0 auto;">
		<tr><td colspan="14" BGCOLOR="#e6e6e6"><b>SCHOOL TYPE INFORMATION</b></td></tr>
		<TR VALIGN=TOP>
			<TD style='width:310px;' BGCOLOR="#e6e6e6"></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>ECD</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>1</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>2</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>3</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>4</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>5</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>6</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>7</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>8</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>9</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>10</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>11</B></TD>
			<TD style='width:30px' BGCOLOR="#e6e6e6"><B>12</B></TD>
		</TR>
		
		<?php

		$result = mysql_query("SELECT * FROM mast_school_type WHERE sch_num='$s' and sch_year='$currentyear' and flash1='1'",$flashdblink);
		$schooltype = mysql_fetch_assoc($result);
		

		$schooltypename[]="Community (Aided)";
		$schooltypename[]="Community Managed";
		$schooltypename[]="Community (Teacher Aid)";
		$schooltypename[]="Community (Unaided)";
		$schooltypename[]="Institutional (Private)";
		$schooltypename[]="Institutional (Public)";
		$schooltypename[]="Institutional (Company)";
		$schooltypename[]="Madrassa";
		$schooltypename[]="Gumba";
		$schooltypename[]="Ashram";
		
		$i=0;
	  
		foreach($schooltypename as $s){
			$i++;
			printf("<TR>");
			printf("<TD style='text-align:left'>%s</TD>",$s);
			
			for ($c=0;$c<=12;$c++){
				if ($c==0) $ct='ecd'; else $ct = "class$c";
				printf("<td align=\"center\">%s</td>",$schooltype[$ct]==$i?"✔":"&nbsp");
			}
			
			printf("</TR>");
			
		}
		  
		  
		?>

	</TABLE>


<?php endif; ?>



</body>
</html>
