<?php

$r=$_GET['r'];

// check if the report file is valid
$ro = parse_ini_file($r,true);
if (!isset($ro['header']['title1'])) die('Invalid report file');

// necessary shit
include_once("../includes/vars.php");
include_once("libreport.php");

// fix report (year and other incomplete options)
reportfix($ro);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Flash Report Options - <?php echo $ro['header']['title1']; ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery/jquery.js"></script>
	<style>
		body{ background-color: #eaeaea; margin: 0; padding: 0; }
		#container{ width:960px;margin: 0 auto;background-color: #fff; padding: 10px 30px; padding-bottom: 100px; }
		table{ background-color: #fff; }
		a{ color: #000; }
		a:hover{ color: #333; }
		input[type=submit]{font-weight: bold; font-size: x-small; }
	</style>
</head>

<body>
	
<div id='container'>
	
	<p align="center"><img src="../images/flash.png"></p>
	<p>&nbsp;</p>
	
	<?php
	
	for ($i=1;$i<5;$i++){
		if (isset($ro['header']["title$i"])) echo "<h2 align='center'>{$ro['header']["title$i"]}</h2>";
	}
	
	?>
	
	<p>&nbsp;</p>
	
	<form action="view.php" method="GET" onsubmit="return validate();">
		
	<input type="hidden" name="r" value="<?php echo $r; ?>" />
	
    <div id="selectdistrict" style="float:left"><select></select></div> 
	<div id="selectvdc" style="float:left; margin-left:10px;"><select></select></div>
	<div id="selectschool" style="float:left; margin-left:10px;">
		<input type='checkbox' id='s' name='s' value='0'> School Expanded
	</div>
  
	<div style="clear:both"></div>
	<br />
	
	<div id="selecttagcat"></div>
	<div id="selecttagname"></div>
		   
	<?php
	
	// print options
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$var_name = $ro['prereq']['prereq'.$n.'var'];
			
			echo "<p><b>$title</b><br />";
			
			if (strtolower($title)=='year'){
				// special case for year
				
				echo "<input id='year' name='year' hidden value='' />";
				echo "<select id='year_select' multiple size='7' style='width: 75px;'>";
				$po = "selected";
				foreach($options as $op){
					echo "<option value='$op' $po>$op</option>";
					$po="";
				}
				echo "</select>";	
				
				echo "<label><input type='checkbox' checked id='colwise' /> Column Wise Trend</label>";
				echo "<br /><em>Press Ctrl or Shift to select multiple or unselect</em>";
			}
			else{
				// other options than year
				
				//echo "<select id='opt$n' name='opt$n'>";
				echo "<select id='$var_name' name='$var_name'>";
				
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

	//
	// print table headers (for column selection)
	//

	// count total table column count
	$i=1;
	if (isset($ro['tableheader']['row'.$i])){
		$rowstr = $ro['tableheader']['row'.$i];
		$cols = explode("|",$rowstr);
		
		$colcount = 0;
		foreach ($cols as $c){
			ereg(".*\[(.*)\].*",$c,$t);

			if (isset($t[1])){
				if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
					$colcount += (int)$t[2];
				}
				else{
					$colcount += (int)$t[1];
				}
			}
			else $colcount++;

		}
	}
	$colcount -= 2; // subtracting first code/name col	
	
	echo "<p><a href='#' onclick='$(\"#cols_show_hide\").show(\"fast\"); $(this).remove();'>Select Columns to show/hide</a></p>";

	echo "<div id='cols_show_hide' style='display:none;'>";
	
	echo "<input type='hidden' name='colskip' id='colskip' />";
	
	echo "<strong>Columns to show / hide</strong>";

	echo "<table class='ewTable'>";

	$first = true;
	for ($i=1;$i<10;$i++){
		if (isset($ro['tableheader']['row'.$i])){
			
			$rowstr = $ro['tableheader']['row'.$i];
			$cols = explode("|",$rowstr);
			
			echo '<tr style="text-align:center; font-weight: bold;">';
			
			
			$thstr = "";
			foreach ($cols as $c){
				
				if (isset($_GET['colwise'])){
					$m = count($Y);
				}
				else $m = 1;				
				
				if ($first) $m=1; // dont apply colspan expansion for first cell (code/name)
				
				ereg(".*\[(.*)\].*",$c,$t);
				//echo $t[1];
				$spn='';
				if (isset($t[1])){
					if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
						$spn="rowspan='".$t[1]."' colspan='".(int)$t[2]*$m."'";
					}
					else{
						if(ereg(".*\[([0-9]*)\].*",$c,$t)) $spn="colspan='".(int)$t[1]*$m."'";
						else $spn="colspan='".$m."'";
					}
				}
				else $spn="";

				ereg("([^\[]*)(\[.*|$)",$c,$t);
				$colname=$t[1];
				
				if (substr($colname,0,4)=="Code") continue;
				
				echo "<td $spn>$colname</td>\n";
				if (!$first) $thstr .= "<td $spn>$colname</td>\n";
				$first = false;
			}
			
			
			echo "\n\n</tr>";
			
			
		}
	}
	echo "<tr>";
	for ($i=0;$i<$colcount; $i++){
		echo "<td><input type='checkbox' class='colcheck' checked value='$i' /></td>";
	}
	echo "</tr>";

	echo "</table>";

	?>		
	
	<a href='#' onclick="$('.colcheck').attr('checked','checked');">Check All</a> | 
	<a href='#' onclick="$('.colcheck').attr('checked','');">Uncheck All</a>
	<p></p>
	

	</div>
	
	<input type="submit" value="Show Report" />

	</form>
	
</div> <!-- end container -->
	
</body>

<script>
	
	$('#selectdistrict').show();
	$('#selectvdc').hide();
	$('#selectschool').hide();
	
	$.get('ajax.php?req=distlist',function(d){
		$('#selectdistrict').html(d);
	});
	
	$.get('ajax.php?req=taglist',function(d){
		$('#selecttagcat').html(d);
	});
	
	function handlechange(obj, event){

		if (obj.name=='d'){
			
			$.get('ajax.php?req=vdclist&distcode='+$('#d').val(),function(d){
				$('#selectvdc').html(d);
			});
			
			if (obj.value==0){
				$('#selectvdc').hide();
				$('#selectschool').hide();		
			}
			else{
				$('#selectvdc').show();
				$('#selectschool').show();				
			}
			
		}

		if (obj.name=='v'){
			$.get('ajax.php?req=schoollist&distcode='+$('#d').val()+'&vdccode='+$('#v').val(),function(d){
				$('#selectschool').html(d);
			});
		}
		
		
		if (obj.name=='t'){
			if (obj.value!=''){
				$('#d').attr('disabled', true);
				if ($('#d').val()!=0){
					$('#v').attr('disabled', true);
					$('#s').attr('disabled', true);
				}
				
				ajaxDiv('ajax.php?req=tagname&t='+$('#t').val(),function(d){ 
					$('#selecttagname').html(d)
				});
				
			}
			else{
			
				$('#d').attr('disabled', false);
				if ($('#d').value!=0){
				
					$('#v').attr('disabled', false);
					$('#s').attr('disabled', false);		
				}
				
				$('#selecttagname').html('');
				
			}
		}

	}
	
	function validate(){
		
		// compute years
		$('#year').val($('#year_select').val());
		
		// compute colskip
		var colskip = "";
		$('.colcheck').each(function(){
			if ($(this).attr('checked')==false)
				colskip += $(this).val()+",";
		})
		$('#colskip').val(colskip);
		
		// TODO: check if atleast one col is checked
		
		return true;
		
		
	}	
	
</script>

</html>
