<?php

require_once("includes/bootstrap.php");
require_once("includes/utils.php");
require_once("includes/dbfunctions.php");

$width = $page_size[$SETTINGS['marksheet_size']]["w"];
$height = $page_size[$SETTINGS['marksheet_size']]["h"];

if ($SETTINGS['marksheet_orientation']=="landscape"){
	$tmp=$width;
	$width=$height;
	$height=$tmp;
}

if (isset($_POST['save'])){
	
	$positions = $_POST['positions'];
	
	mysql_query("DELETE FROM settings WHERE variable LIKE 'layout_%'");
	
	foreach (explode(";",$positions) as $pos){
		if ($pos=="") continue;
		$p = explode(":",$pos);
		
		mysql_query("INSERT INTO settings (variable, value) VALUES ('layout_{$p[0]}','{$p[1]}')");
		
	}
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta charset="utf-8">
	<title>Flash Achievement Marksheet Layout Builder</title>
	<link rel="stylesheet" href="../../themes/base/jquery.ui.all.css">
	<script src="js/jquery/jquery.js"></script>
	<script src="js/jquery/jquery-ui.js"></script>
	<link rel="stylesheet" href="../demos.css">
	<style>
	.draggable { padding: 2px; margin: 2px; font-size: .6em; border: 1px solid #999; background-color: #eaeaea; cursor: move;}
	#paper {width:<?php echo $width; ?>px; height: <?php echo $height; ?>px; margin: 0 auto; border: 1px solid #aaa; background-color: #ffffff; border-right: 3px solid #666; border-bottom: 3px solid #666;}
	#unused {float: left;} 
	#fieldinfo {float: right; width: 150px; font-size: .8em;} 
	body{padding:10px;margin: 0; background-color: #eaeaea;}
	</style>
	<script>
		
	<?php
	echo "var width=$width;\n";
	echo "var height=$height;\n";
	?>	
	
	function getValues(){
		
		var positions = "";
		$(".draggable").each(function(){
			var paper_offset = $('#paper').offset();
			var this_offset = $(this).offset();
			
			var inside_top = parseInt(this_offset.top-paper_offset.top);
			var inside_left = parseInt(this_offset.left-paper_offset.left);
			
			if (inside_top>=0 && inside_top<height && inside_left>=0 && inside_left<width)
				positions += $(this).attr('id')+":"+inside_top+","+inside_left+";";
		
		});
		
		$('#positions').val(positions);
		
		return true;
		
	}
		
	$(function() {
		<?php
			$ids = array(
					"full_name"=>"Full Name",
					"dob_np"=>"DOB Nepali",
					"dob_en"=>"DOB English",
					"father_name"=>"Father's Name",
					"mother_name"=>"Mother's Name",
					"reg_id"=>"Registration ID",
					"stu_num"=>"Student Number",
					"nm_sch"=>"School's Name",
					"sch_year"=>"Year",
					"s_name"=>"Subject Name",
					"s_theory_full_mark"=>"TFM",
					"s_theory_pass_mark"=>"TPM",
					"s_practical_full_mark"=>"PFM",
					"s_practical_pass_mark"=>"PPM",
					"s_theory"=>"Th",
					"s_practical"=>"Pr",
					"s_total"=>"Tot",
					"s_grace"=>"Gr",
					"s_comment"=>"Com",
					"total"=>"Grand Total",
					"result"=>"Result",
					"date_today"=>"Date (Today)",
					"date_settings"=>"Date (from settings)");
					
			//foreach ($ids as $id=>$desc)
			//	echo "$(\"#$id\").draggable({ grid: [ 10,10 ] });\n";
		
		?>
		
		$('.draggable').draggable({ grid: [ 10,10 ]});
		//$('.draggable').draggable();
		
		$('.draggable').bind('drag', function(event, ui){
			var paper_offset = $('#paper').offset();
			var this_offset = $(this).offset();
			
			var inside_top = parseInt(this_offset.top-paper_offset.top);
			var inside_left = parseInt(this_offset.left-paper_offset.left);
			
			if (inside_top>=0 && inside_top<height && inside_left>=0 && inside_left<width)
				$('#fieldinfo').html("<p><strong>Position: </strong> <br />Top: "+inside_top+", Left: "+inside_left+"</p>");
			else
				$('#fieldinfo').html("<p><strong>Position: </strong> <br />Outside paper</p>");
				
			// set subject related fields on the same line
			if ($(this).attr('id').indexOf("s_")==0){
				var ot = $(this).offset().top;
				$(".draggable").each(function(){
					
					if ($(this).attr('id').indexOf("s_")==0){
						$(this).offset({top:ot,left:$(this).offset().left})
					}
				
				});				
				
			}				
		});
				
		$('.draggable').bind('dragstop', function(event, ui){
			$('#fieldinfo').html("");
			
		});
		
		$('.draggable').bind('mouseleave', function(event, ui){
			$('#fieldinfo').html("");
		});		

		$('.draggable').bind('mouseenter', function(event, ui){
			var paper_offset = $('#paper').offset();
			var this_offset = $(this).offset();
			
			var inside_top = parseInt(this_offset.top-paper_offset.top);
			var inside_left = parseInt(this_offset.left-paper_offset.left);
			
			if (inside_top>=0 && inside_top<height && inside_left>=0 && inside_left<width)
				$('#fieldinfo').html("<p><strong>Position: </strong> <br />Top: "+inside_top+", Left: "+inside_left+"</p>");
			else
				$('#fieldinfo').html("<p><strong>Position: </strong> <br />Outside paper</p>");
		});


	});
	
	

	</script>
</head>
<body>

<div id="unused">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return getValues();">
	<input type="hidden" value="" name="positions" id="positions" />
	<input type="submit" value="Save Layout" name="save" style="font-size: 1em;" />
	<br /><input type="button" value="Get Calibration PDF for this Document" onclick="window.location='calibration.php?<?php echo "size={$SETTINGS['marksheet_size']}&orientation={$SETTINGS['marksheet_orientation']}"; ?>'" />
	<br /><input type="button" onclick="window.location='settings.php'" value="Back" />
</form>
<?php 

foreach ($ids as $id=>$desc)
	echo "<span id='$id' class='draggable'>$desc</span><br />\n";
	/*
	$result = mysql_query("SELECT * FROM settings WHERE variable='layout_{$id}'");
	if (mysql_num_rows($result)==0){
		echo "<br />\n";
	}
	*/

?>
</div>

<div id="fieldinfo">


</div>

<div id="paper">
	
</div>

	



</body>

<script>


var offset = $('#paper').offset();

var left, top;
for (w=0;w<width;w+=50){
	left = w+offset.left;
	top = offset.top;

	$('#paper').append("<span style='position:absolute; top:"+top.toString()+"px; left:"+left.toString()+"px; font-size:.6em;'>"+w.toString()+"</span>");
}

for (h=0;h<height;h+=50){
	left = offset.left;
	top = h+offset.top;

	$('#paper').append("<span style='position:absolute; top:"+top.toString()+"px; left:"+left.toString()+"px; font-size:.6em;'>"+h.toString()+"</span>");
}


// arrange 
<?php

$result = mysql_query("SELECT * FROM settings WHERE variable LIKE 'layout_%'");
while ($row = mysql_fetch_assoc($result)){
	$v = str_replace("layout_","",$row['variable']);
	$p = explode(",",$row['value']);
	
	echo "$('#{$v}').offset({top: offset.top+{$p[0]},left: offset.left+{$p[1]}});\n";
}

?>

</script>

</html>
