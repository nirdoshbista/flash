<?php

$sch_num=$_GET['s'];
if ($sch_num=='') die('Invalid school code');

require_once('includes/bootstrap.php');
require_once('includes/dbfunctions.php');
$link = dbconnect();

// delete record
if ($_GET['r']=='delete'){
	// delete teacher
	$tables = array('tmis_main','tmis_med','tmis_pub','tmis_punish','tmis_sec1','tmis_sec2','tmis_train');
	
	$tid = $_GET['tid'];
	$sch_num = $_GET['s'];
	foreach($tables as $t){
		$result = mysql_query("DELETE FROM $t WHERE tid='$tid' AND sch_year='$currentyear'");
	}

	header("Location: teacherlist.php?s=$sch_num");
	
}

// get school info
$result = mysql_query("SELECT * FROM mast_schoollist where sch_num='$sch_num' AND sch_year='$currentyear'");
$s = mysql_fetch_assoc($result);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Teacher List</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style_flash.css" rel="stylesheet" type="text/css">
<script src="js/jquery/jquery.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>

<style>
.error{
	color: red;
	text-align: center;
	font-size: 10px;
}

table{
	font-size: 10px;
}

.a{
	padding:10px;
	padding-bottom:0px;
	margin-bottom:-5px;
}

#t_name{
	font-weight: bold;
	font-size: 105%;
}

select{
	font-size: x-small;
}

input:disabled{
	color: #999;
}

#sortoptions{
	padding: 20px 20px 0 0;
	float: right;
}

.selectoption{float: right;}
.selectoption a{color: #333;}
.selectoption a:hover{color: #000;}

.header{
	margin:-10px;
	padding: 5px;
	height: 18px;
	color: white;
	font-weight: bold;
	clear:both;
	background-color: #232C1D; /* #0e140a;*/
	font-size: x-small;
}

.header a{
	color: white;
	font-size:0.8em;
	text-decoration: none;
}

.inactive{
	text-decoration: line-through;
}



</style>

<script>

var s = '<?php echo $sch_num; ?>';

function selectAll(id,all){
	var selectBox = document.getElementById(id);
	for (var i = 0; i < selectBox.options.length; i++) {
		selectBox.options[i].selected = all;
	}
	
	itemSelected(selectBox);
	
}

function loadTeachers(){
	// find current sort order
	var order = '';
	if ($('#ordername').attr('checked') == true) order='name';
	else order='code';
	
	$('#ajaxbusy').show();
	$.get("teacherlistbe.php?r=tp&s="+s+"&o="+order,function(d){
		$('#div_tp').html(d);
		$('#ajaxbusy').hide();
	});
	$.get("teacherlistbe.php?r=tc&s="+s+"&o="+order,function(d){
		$('#div_tc').html(d);
		$('#ajaxbusy').hide();
	});
	
	

}

function itemSelected(o){
	if (o.id=='tp'){
		if (o.selectedIndex==-1){
			$('#opt_copy').attr('disabled',true)
		}
		else{
			$('#opt_copy').attr('disabled',false)
		}
		
	}
	if (o.id=='tc'){
		if (o.selectedIndex==-1){
			$('#opt_markas').attr('disabled',true)
			$('#opt_unmark').attr('disabled',true)
			$('#opt_delete').attr('disabled',true)
			$('#opt_edit').attr('disabled',true)
		}
		else{
			$('#opt_markas').attr('disabled',false)
			$('#opt_unmark').attr('disabled',false)
			$('#opt_delete').attr('disabled',false)
			if (o.options[o.selectedIndex].className=='inactive') $('#opt_edit').attr('disabled',true);
			else $('#opt_edit').attr('disabled',false);
		}		
		
	}
}


function markTeacher(){
	var t=$('#tc').val();
	var m = $('#opt_markas').val();
	
	$('#ajaxbusy').show();
	$.get("teacherlistbe.php?r=mark&m="+m+"&t="+t,function(){
		loadTeachers()
	});
	
	document.getElementById('opt_markas').value = '';
}

function unmarkTeacher(){
	var t=$('#tc').val();

	$('#ajaxbusy').show();
	$.get("teacherlistbe.php?r=unmark&t="+t,function(){
		loadTeachers()
	});
	
}

function deleteTeacher(){
	
	if (!confirm('Delete selected teachers?')) return;
	
	var t=$('#tc').val();
	
	$('#ajaxbusy').show();
	$.get("teacherlistbe.php?r=delete&t="+t,function(){
		loadTeachers()
	});		
}

function editTeacher(){
	
	var o = document.getElementById('tc');
	var url="tmis_general.php?tid="+o.options[o.selectedIndex].value+"&s="+s;
	window.location=url;
}

function copyTeacher(){
	var t=$('#tp').val();
	
	$('#ajaxbusy').show();
	$.get("teacherlistbe.php?r=copy&t="+t,function(){
		loadTeachers()
	});		
}

</script>

</head>

<body onload="loadTeachers();">
<div class='header'>
<div style="float: left">Teacher MIS - <?php echo $s['nm_sch']; ?></div>
<div style="float: right"><?php include("nav.php"); ?></div>
</div>
<br />
<div id='ajaxbusy' style='float:right;'><img src='images/loading.gif'></div>
<div align="center">
  <p><img src="images/tmis.png"></p>
</div>

<table width="650px" align="center" cellpadding="5">
	<tr>
		<td height="20px">
			<div id='navitabs'>
				<strong><a href='schoolselect.php<?php echo $schoolselect_prefix; ?>' class="activenavitab" id='menuexistingschool'><?php echo $s['nm_sch']," [",$s['sch_num'],"]"; ?></a></strong>
			</div>
		</td>
	</tr>
	<tr>
		<td bgcolor="#BBCCDD" valign="top" align="left">
			<div id="sortoptions">
				Sort by 
				<label><input type="radio" name='order' id='ordername' value='name' checked onchange="loadTeachers();">Name</label>
				<label><input type="radio" name='order' id='ordercode' value='code' onchange="loadTeachers();">Code</label>
			</div>
			<div class='a'>
				<strong>New Teacher</strong>
				<form id="t_name_form" action="tmis_general.php" method="post" onsubmit="if (document.getElementById('t_name').value=='') {alert('Please fill name.'); return false} else return true;" >
				<input type='hidden' name='s' value='<?php echo $sch_num; ?>' />
				<input type='text' id='t_name' name='t_name' size='39' maxlength='50' onchange='beautify(this);' />
				<input type='submit' value='Add' />
                                <input type='button' value='Add Vacant' onclick="document.getElementById('t_name').value='Vacant';document.getElementById('t_name_form').submit();"/>
				</form>
			</div>
			
			<div id='existingschool'>
				<table width="100%" cellpadding="10">
					<tr valign="top">
						<td>
							<p>
								<b>Previous year (<?php echo (int)($currentyear)-1; ?>)</b>
								<span class='selectoption'>
									Select: 
									<a href="#" onclick="selectAll('tp',true);">All</a>
									<a href="#" onclick="selectAll('tp',false);">None</a>
								</span>
								
							</p>
							<div id="div_tp">
								<select size="20" style="width:300px;">
								</select>
							</div>
							<p>
								<input type="button" value="Copy to Current Year" id='opt_copy' disabled  onclick="copyTeacher();" />
							</p>
						</td>
						<td>
							<p>
								<b>Current Year (<?php echo $currentyear; ?>)</b>
								<span class='selectoption'>
									Select: 
									<a href="#" onclick="selectAll('tc',true);">All</a>
									<a href="#" onclick="selectAll('tc',false);">None</a>
								</span>								
							</p>
							<div id="div_tc">
								<select size="20" style="width:300px;">
								</select>
							</div>
							<p align='right'>
								<select disabled id='opt_markas' onchange="markTeacher();" >
									<option value=''>- Mark as -</option>
									<option value='1'>Dead</option>
									<option value='2'>Retired</option>
									<option value='3'>Transferred</option>
								</select>
								<input type="button" value="Unmark" disabled id='opt_unmark' onclick="unmarkTeacher();" />
								<input type="button" value="Delete" disabled id='opt_delete' onclick="deleteTeacher();" />
								<input type="button" value="Edit >" disabled id='opt_edit' onclick="editTeacher();" />
							</p>
						</td>
				</table>
			</div>
			
		</td>
	</tr>
	<tr>
		<td>
		<p align="right"><em>Press Ctrl to select multiple</em></p>
		</td>
	</tr>
</table>

</body>
</html>
