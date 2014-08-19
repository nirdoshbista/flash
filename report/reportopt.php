<html>
	<head>
	<style>
	table{font-family:Arial; font-size: 11px;border-collapse:collapse;}
	td{padding: 5px;}
	</style>
	</head>
<body>
<table  border=1>

<?php


$ro = parse_ini_file('reports/pr_tot_enr_rep_tra.rpt', true);

include_once("../includes/reportfunctions.php");
include_once("../includes/vars.php");

reportfix($ro);


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


$tableheader = array();

$trow = 0;
$tcol = 0;

$unique = 1;

for ($i=1;$i<10;$i++){
	if (isset($ro['tableheader']['row'.$i])){
		
		$rowstr = $ro['tableheader']['row'.$i];
		$cols = explode("|",$rowstr);
		
		$thstr = "";
		$tcol = 0;
		foreach ($cols as $c){
			
			if (isset($_GET['colwise'])){
				$m = count($Y);
			}
			else $m = 1;				
			
			if ($first) $m=1; // dont apply colspan expansion for first cell (code/name)
			
			ereg(".*\[(.*)\].*",$c,$t);
			
			$spn='';
			if (isset($t[1])){
				if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
					$rowspan = (int)($t[1]);
					$colspan = (int)($t[2])*$m;
					
				}
				else{
					if(ereg(".*\[([0-9]*)\].*",$c,$t)) {
						$rowspan = 1;
						$colspan = (int)($t[1])*$m;
					}
					else {
						$rowspan = 1;
						$colspan = $m;
					}
					
				}
			}
			else {
				$rowspan=1;
				$colspan=1;
			}

			ereg("([^\[]*)(\[.*|$)",$c,$t);
			$colname=$t[1];
			
			// $colname with a unique number
			//
			// the number is appended so that the adjacent columns wont 
			// merge later even though they are different column with 
			// different parent, but have the same 
			// 
			$colname = "$unique~$colname";
			$unique++;
			
			if (substr($colname,0,4)=="Code") continue;
			
			for ($tr = $trow; $tr<$trow+$rowspan; $tr++){
				for ($tc = $tcol; $tc < $tcol+$colspan; $tc++){
					$tableheader[$tr][$tc] = $colname;
				}
			}
			
			
			$tcol += $colspan;
		}
		$trow++;
		
	}
}

$removelist = array(0,1,3,4,6,7,9,10);

foreach ($removelist as $c){
	
	for ($r=0;$r<count($tableheader); $r++){
		unset($tableheader[$r][$c]);
	}
}

	
?>

</table>

<p></p>

<table border=1>

<?php


// remake tableheader text
$r = 1;
foreach ($tableheader as $row){
	$ro['tableheader']["row$r"] = "";
	
	$prev = "";
	$first = true;
	foreach ($row as $col){
		if ($prev != $col) {
			if (!$first) {
				$prev = substr($prev,strpos($prev,"~")+1);
				if ($count>1) $ro['tableheader']["row$r"] .= "$prev [$count] | ";
				else $ro['tableheader']["row$r"] .= "$prev | ";
			}
			$prev = $col;
			$first = false;
			$count = 1;
		}
		else $count++;
	}
	
	// print the last one
	$prev = substr($prev,strpos($prev,"~")+1);
	if ($count>1) $ro['tableheader']["row$r"] .= "$prev [$count]";
	else $ro['tableheader']["row$r"] .= "$prev";
	
	$r++;
}


// print again
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



?>

</table>

</body>
</html>

