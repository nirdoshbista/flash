<?php
function pageheader(){
	global $ro,$rtypestr, $D, $V, $T, $TN, $R, $Y;
	
        
        //this is the new line of code
	if (strstr($_SERVER["PHP_SELF"],"flash1/")!==false) $flash12 = 'I';
	if (strstr($_SERVER["PHP_SELF"],"flash2/")!==false) $flash12 = 'II';
	
	echo '<html>';
	echo '<head>';
	echo "<title>Flash $flash12 - Reports</title>";
	echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
	echo '<link href="../css/style.css" rel="stylesheet" type="text/css">';
	echo '</head>';
	echo '<body><br />';
	
	for ($i=1;$i<10;$i++){
		if (isset($ro['header']['title'.$i])){
			echo "<h$i><center>";
			echo $ro['header']['title'.$i];
			echo "</center></h$i>";
		}
	}

	echo "<h2><center>";
	echo $rtypestr;
	echo "</center></h$i>";
	

	if ($T==''){
		echo "<h2><center>";
		echo dvname($D,$V);
		echo "</center></h$i>";
	}
	else{
		if ($TN!=''){
			echo "<h2><center>";
			echo tagname($TN);
			echo "</center></h$i>";	
		}
	}
	
	
	
	// display pre-requisite information
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			if ($pclz=="") {$n++; continue;}
			
			echo "<h3 align='center'>";
			
			echo $title.': ';
			echo $options[(int)$pclz];
			
			echo '</h3>';
	
			$n++;

			
		}
		
		// display year information
		echo "<h3 align='center'>Year: ",implode(", ",$Y),"</h3>";
	}	
	
?>

<div id='graphlink' align="right">
<form method="POST" action="viewgraph.php" target="_blank">
<input type="hidden" name="reportfile" value="<?php echo $R; ?>">
<input type="hidden" name="reportsums" id="reportsums">
<input type="hidden" name="reporttitles" value="<?php echo htmlentities(pageheaderstr()); ?>">
<input type="hidden" id="reportbutton" disabled value="View Graph">

</form>
</div>
	
<?php	
	
	
}


function pageheaderstr(){
	global $ro,$rtypestr, $D, $V, $T, $TN, $R;
	
	// get whether this is from flash1 or 2
	if (strstr($_SERVER['PHP_SELF'],'flash2/')!==false) $flash = 2;
	if (strstr($_SERVER['PHP_SELF'],'flash1/')!==false) $flash = 1;	
	
	$str='';
	
	$str.= '<html>';
	$str.= '<head>';
	$str.= '<title>Flash '.($flash=1?'I':'II').' - Reports</title>';
	$str.= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
	$str.= '<link href="../css/style.css" rel="stylesheet" type="text/css">';
	$str.= '</head>';
	$str.= '<body><br />';
	
	for ($i=1;$i<10;$i++){
		if (isset($ro['header']['title'.$i])){
			$str.= "<h$i><center>";
			$str.= $ro['header']['title'.$i];
			$str.= "</center></h$i>";
		}
	}

	$str.= "<h2><center>";
	$str.= $rtypestr;
	$str.= "</center></h$i>";
	

	if ($T==''){
		$str.= "<h2><center>";
		$str.= dvname($D,$V);
		$str.= "</center></h$i>";
	}
	else{
		if ($TN!=''){
			$str.= "<h2><center>";
			$str.= tagname($TN);
			$str.= "</center></h$i>";	
		}
	}
	
	
	$str.= '<br />';
	
	// display pre-requisite information
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			if ($pclz!=""){
			
				$str.= "<h3 align='center'>";
				
				$str.= $title.': ';
				$str.= $options[(int)$pclz];
				
				$str.= '</h3>';
			}
	
			$n++;

			
		}
		
		// add year information
		$str.= "<h3 align='center'>Year: ".implode(", ",$Y)."</h3>";
	}
	
	return $str;
	
}

// throw table header
function tableheader(){
	global $ro, $Y;
	
		
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
	
	echo '<table class="ewTable" width="100%">';
	
	// add year row if applicable
	if (count($Y)>1 && !isset($_GET['colwise'])){
		echo "<tr class='ewTableHeader'><td colspan='2'>&nbsp;</td>";

		
		foreach ($Y as $year){
			echo "<td colspan='$colcount'>$year</td>";
		}
		echo "</tr>";
	}
	
	$first = true;
	for ($i=1;$i<10;$i++){
		if (isset($ro['tableheader']['row'.$i])){
			
			$rowstr = $ro['tableheader']['row'.$i];
			$cols = explode("|",$rowstr);
			
			echo '<tr class="ewTableHeader">';
			
			
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
				
				echo "<td $spn>$colname</td>\n";
				if (!$first) $thstr .= "<td $spn>$colname</td>\n";
				$first = false;
			}
			
			if (count($Y)>1 && !isset($_GET['colwise'])){
				echo "\n\n";
				for ($xx=0;$xx<count($Y)-1;$xx++){
					echo $thstr;
				}
			}
			
			echo "\n\n</tr>";
			
			
		}
	}
	
	if (count($Y)>1 && isset($_GET['colwise'])){
		echo "<tr class='ewTableHeader'>";
		echo "<td colspan='2'>&nbsp</td>";
		
		$yrtxt="";
		foreach ($Y as $yr){
			$yrtxt .= "<td>$yr</td>";
		}
		
		for ($i=0;$i<$colcount;$i++){
			echo $yrtxt;
		}
		
		
		echo "</tr>";
	}
	
	
	
}

// show the table
function tablebody(){
	global $ro, $reporttype, $link,$D,$V,$S,$T, $piedata, $pielabel, $piecol, $sum, $Y;
	
	$preclause = '';
	
	// get whether this is from flash1 or 2
	if (strstr($_SERVER['PHP_SELF'],'flash2/')!==false) $flash = 2;
	if (strstr($_SERVER['PHP_SELF'],'flash1/')!==false) $flash = 1;		
	
	// pre-requistite options
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			if ($pclz != "")
				$preclause .= (' and '.$clz[(int)$pclz]);
			
			$n++;

			
		}
		
		// if there's only one year, add it to preclause by default
		if (count($Y)==1){
			$y=$Y[0];
			$preclause .= " and mast_schoollist.sch_year=$y and mast_school_type.sch_year=$y";
		}
	}
	
	// execute pre queries
	if (isset($ro['prequery'])){
		$n = 1;
		
		while (isset($ro['prequery']['query'.$n])){
			$query = $ro['prequery']['query'.$n];
			mysql_query($query);
			$n++;
		}
	}	
	
	//echo $preclause;
	
	if ($reporttype==1){
		// extract all districts
		$result=mysql_query("select dist_code, dist_name from mast_district order by dist_name");
		
		while ($r=mysql_fetch_array($result)){
			$code[]=$r['dist_code'];
			$name[]=$r['dist_name'];
		}
	}
	if ($reporttype==2 || $reporttype==3){
		// extrack all vdcs
		$result=mysql_query("select vdc_code, vdc_name_e from mast_vdc where dist_code='$D' order by vdc_name_e");
		while ($r=mysql_fetch_array($result)){

			$code[]=$r['vdc_code'];
			$name[]=$r['vdc_name_e'];
		}
	}
	
	if ($reporttype==4){
		// extract all schools
		$query = "select sch_num, nm_sch from mast_schoollist where dist_code='$D' and vdc_code='$V' and flash$flash='1'";

		if (ereg("(20[0-9]{2})",$preclause, $regs)){
			$query .= ' and mast_schoollist.sch_year='.$regs[1];
		}
		$query .= " group by sch_num order by nm_sch";
		
		$result=mysql_query($query);
		
		//echo $query;		
		while ($r=mysql_fetch_array($result)){
		
			$code[]=$r['sch_num'];
			$name[]=$r['nm_sch'];
		}

	}
	
	
	
	// extract datacheck query
	$dc = (isset($ro['row']['datacheck'])?$ro['row']['datacheck']:'');
	
	$i=1;
	while (isset($ro['row']['query'.$i])){
		$q[]=$ro['row']['query'.$i];
		$i++;
	}
	
	$rowscount = 0;
	
	if (count($code)==0){
		echo "<br><br><br><p align='center' class='ewmsg'>No data found</p>";
		return;
	}
	
	tableheader();
	
	for ($i=0;$i<count($code);$i++){

		// calculate where clause for this 
		$wc='';
		if ($reporttype==1) $wc = (" and dist_code='".$code[$i]."'");
		if ($reporttype==2 || $reporttype==3) $wc = (" and dist_code='$D' and vdc_code='".$code[$i]."'");
		if ($reporttype==4) $wc = (" and dist_code='$D' and vdc_code='$V' and mast_schoollist.sch_num='".$code[$i]."'");
	

	
		// skip if there's no data
		if ($dc!=''){
			$result=mysql_query($dc.$wc.$preclause);
			
			//echo ($dc.$wc.$preclause);
			
			if (mysql_num_rows($result)==0) continue;
		}
		
		// now compute row
		$row = array();
		$org_preclause = $preclause;
		
		// compute for each year
		foreach ($Y as $year){
			
			if (count($Y)>1){ // if there are only one year, conditions for year are already added to $preclause
				$preclause = $org_preclause . " and mast_schoollist.sch_year=$year and mast_school_type.sch_year=$year";
			}
			
			for ($j=0;$j<count($q);$j++){
			
				if (preg_match("/^@.*/",$q[$j])){
					$visibility=false;
					$qry = substr($q[$j],1);
				}
				else{
					$visibility = true;
					$qry = $q[$j];
				}
				
				if (strpos($qry,'#')===false){
					// regular query
			
					//echo $qry.$wc.$preclause."<br />";
					$result=mysql_query($qry.$wc.$preclause);
					$r=mysql_fetch_row($result);
				
					if (count($Y)>1 && !is_array($r)){
						$num_fields = mysql_num_fields($result);
						$r=array();
						for ($nf = 0; $nf < $num_fields; $nf++){
							$r[] = "";
						}
					}
					
		
				}
				else{
					// expression to be evaluated
					
					while (preg_match("/[^#]*#([0-9]+).*/",$qry, $matches)==1){
						$matchvalue = $row[$matches[1]-1];
						if ($matchvalue=='') $matchvalue='0';
						$qry = preg_replace("/([^#]*)#([0-9]+)(.*)/","$1 $matchvalue $3", $qry);
					}
					eval("\$r[]=$qry;");
				
				}
				
				// now merge the calculated values to master row array
				$row=@array_merge($row, $r);
				
				// set visibility flag
				$colcount = count($r);
				while ($colcount--) $row_visibility[]=$visibility;
				
				unset($r);
			}
		}
		
		if ($rowscount%2 && $reporttype!=3) echo '<tr>';
		else echo '<tr class="ewTableAltRow">';
		
		echo "<td>".$code[$i]."</td>";
		echo "<td>".$name[$i]."</td>";
		
		if (isset($_GET['colwise'])){
			$colcount = count($row)/count($Y);
			for ($cc=0;$cc<$colcount;$cc++){
				for ($yc=0;$yc<count($Y);$yc++){
					$j = $colcount*$yc+$cc;
					
					if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
					else echo "<td align='center'>".$row[$j]."</td>";
					
					$sum[$j]+=$row[$j];					
				}
			}
		}
		else{
		
			for ($j=0;$j<count($row);$j++){
				if ($row_visibility[$j]==false) continue;
				
				if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
				else echo "<td align='center'>".$row[$j]."</td>";
				
				$sum[$j]+=$row[$j];
			}
		}
		echo '</tr>';
		
		unset($row);
		unset($row_visibility);
		
		$org_preclause_s = $org_preclause;

		// if reporttype is 3 we need to expand the schools
		if ($reporttype==3){
			
			//$preclause = $org_preclause;
		
			
			// get school list
			$query = "select sch_num, nm_sch from mast_schoollist where dist_code='$D' and vdc_code='".$code[$i]."' and mast_schoollist.flash$flash='1'";
			
			if (ereg("(20[0-9]{2})",$preclause, $regs)){
				$query .= ' and mast_schoollist.sch_year='.$regs[1];
			}
			$query .= " group by sch_num order by nm_sch";
			
			$result=mysql_query($query);
			
			while ($r=mysql_fetch_array($result)){
			
				$codes[]=$r['sch_num'];
				$names[]=$r['nm_sch'];
			}
			
			// for every schools under $D and current vdc ie, $code[$i]
			for ($s=0;$s<count($codes);$s++){
				
				$preclause = $org_preclause_s;
				
				// master where clause
				$wc = (" and dist_code='$D' and vdc_code='".$code[$i]."' and mast_schoollist.sch_num='".$codes[$s]."'");
				
				// skip if there's no data
				if ($dc!=''){
					$result=mysql_query($dc.$wc.$preclause);
					
					//echo ($dc.$wc.$preclause);
					
					if (mysql_num_rows($result)==0) continue;
				}				

			
				// now compute row
				$row = array();
				
				// computer for each year
				foreach ($Y as $year){
					
					if (count($Y)>1){ // if there are only one year, conditions for year are already added to $preclause
						$preclause = $org_preclause_s . " and mast_schoollist.sch_year=$year and mast_school_type.sch_year=$year";
					}
							
					for ($j=0;$j<count($q);$j++){
					
						if (preg_match("/^@.*/",$q[$j])){
							$visibility=false;
							$qry = substr($q[$j],1);
						}
						else{
							$visibility = true;
							$qry = $q[$j];
						}
						
						if (strpos($qry,'#')===false){
							// regular query
							$wc = (" and dist_code='$D' and vdc_code='".$code[$i]."' and mast_schoollist.sch_num='".$codes[$s]."'");
						
							$result=mysql_query($qry.$wc.$preclause);
							$r=mysql_fetch_row($result);
							
							if (count($Y)>1 && !is_array($r)){
								$num_fields = mysql_num_fields($result);
								$r=array();
								for ($nf = 0; $nf < $num_fields; $nf++){
									$r[] = "";
								}
							}							
				
						}
						else{
							// expression to be evaluated
							
							while (preg_match("/[^#]*#([0-9]+).*/",$qry, $matches)==1){
								$matchvalue = $row[$matches[1]-1];
								if ($matchvalue == '') $matchvalue='0';
								$qry = preg_replace("/([^#]*)#([0-9]+)(.*)/","$1 $matchvalue $3", $qry);
							}
							eval("\$r[]=$qry;");
						
						}
						
						// now merge the calculated values to master row array
						$row=@array_merge($row, $r);
						//if (!is_array($r)) echo "-- ".$qry.$wc.$preclause."\n";
						
						// set visibility flag
						$colcount = count($r);
						while ($colcount--) $row_visibility[]=$visibility;
						
						unset($r);
					}
				}
				
				echo '<tr>';
				echo "<td>".$codes[$s]."</td>";
				echo "<td>".$names[$s]."</td>";
				
				if (isset($_GET['colwise'])){
					$colcount = count($row)/count($Y);
					for ($cc=0;$cc<$colcount;$cc++){
						for ($yc=0;$yc<count($Y);$yc++){
							$j = $colcount*$yc+$cc;
							
							if ($row_visibility[$j]==false) continue;
							
							if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
							else echo "<td align='center'>".$row[$j]."</td>";
							
							//$sum[$j]+=$row[$j];					
						}
					}
				}
				else{
				
					for ($j=0;$j<count($row);$j++){
						if ($row_visibility[$j]==false) continue;
						
						if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
						else echo "<td align='center'>".$row[$j]."</td>";
						
						//$sum[$j]+=$row[$j];
					}
				}
				echo '</tr>';
				
				unset($row);
				unset($row_visibility);

				$preclause = $org_preclause_s;
			
			}
			unset($codes);
			unset($names);
		}
		
		$rowscount++;
		
		$preclause = $org_preclause;
		
	
	}
	
	
	// display sum
	
	if ($reporttype==1) $wc = ("");
	if ($reporttype==2 || $reporttype==3) $wc = (" and dist_code='$D'");
	if ($reporttype==4) $wc = (" and dist_code='$D' and vdc_code='$V'");

	// now compute sum row
/*	$sum = array();
	for ($j=0;$j<count($q);$j++){
				
		$result=mysql_query($q[$j].$wc.$preclause);
		//echo $q[$j].$wc.'<br />';
		$r=mysql_fetch_row($result);
		
		$sum=array_merge($sum, $r);
		
	}	*/
	
	
	
	if (count($sum)>0){

		echo '<tr class="ewTableHeader">';
		echo "<td colspan='2'>Total</td>";
		
		if (isset($_GET['colwise'])){
			$colcount = count($sum)/count($Y);
			for ($cc=0;$cc<$colcount;$cc++){
				for ($yc=0;$yc<count($Y);$yc++){
					$j = $colcount*$yc+$cc;
					
					if (gettype($sum[$j])=="double") echo "<td></td>";
					else echo "<td align='center'>".$sum[$j]."</td>";
					
					$sum[$j]+=$sum[$j];					
				}
			}
		}
		else{
		
			for ($j=0;$j<count($sum);$j++){
				if (gettype($sum[$j])=="double") echo "<td></td>";
				else echo "<td align='center'>".$sum[$j]."</td>";
				
				$sum[$j]+=$sum[$j];
			}
		}
		echo '</tr>';
		
	}
	
	// output table footer
	tablefooter();
	
	if (count($sum)==0) echo "<br><br><br><p align='center' class='ewmsg'>No data found</p>";
	
	// draw chart
	//if (count($sum)>0) drawchart();
	
	if (count($sum)>0){
		echo "\n<script>";
		echo "\ndocument.getElementById('reportsums').value='".join(",",$sum)."';";
		echo "\ndocument.getElementById('reportbutton').disabled='';";
		echo "\n</script>";
	}
	
	// execute post queries
	if (isset($ro['postquery'])){
		$n = 1;
		
		while (isset($ro['postquery']['query'.$n])){
			$query = $ro['postquery']['query'.$n];
			mysql_query($query);
			$n++;
		}
	}	
	
	
	
}



// show the table
function tablebody_bytag(){
	global $ro, $link, $T, $TN, $TE, $sum, $Y;
	
	
	// get whether this is from flash1 or 2
	if (strstr($_SERVER['PHP_SELF'],'flash2/')!==false) $flash = 2;
	if (strstr($_SERVER['PHP_SELF'],'flash1/')!==false) $flash = 1;	
	
	$preclause = '';

	// pre-requistite options
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			if ($pclz != "")
				$preclause .= (' and '.$clz[(int)$pclz]);
			
			$n++;

			
		}
		
		// if there's only one year, add it to preclause by default
		if (count($Y)==1){
			$y=$Y[0];
			$preclause .= " and mast_schoollist.sch_year=$y and mast_school_type.sch_year=$y";
		}
	}	
	
	// execute pre queries
	if (isset($ro['prequery'])){
		$n = 1;
		
		while (isset($ro['prequery']['query'.$n])){
			$query = $ro['prequery']['query'.$n];
			mysql_query($query);
			$n++;
		}
	}		
	
	
	if ($TN==''){
		//tag category wise
		
		$result=mysql_query("select * from tags where tag_category='$T' order by tag_name");
		
		while ($r=mysql_fetch_array($result)){
			$tags = explode(' ', $r['codes']);

						
			for ($i=0;$i<count($tags);$i++){
				$tags[$i]="mast_schoollist.sch_num like '".$tags[$i]."'";
			}
			
			$code[]=' and ('.implode(' or ', $tags).')';
			$name[]=$r['tag_name'];
		}
		
	}
	
	else{
		
		$result=mysql_query("select * from tags where tag_id='$TN'");
		
		$r=mysql_fetch_array($result);
		
		$tagcodes = explode(' ', $r['codes']);
		
		foreach ($tagcodes as $t){
			$code[] = " and mast_schoollist.sch_num like '$t'";
			$name[] = dvsname($t);
		}
		

	}
	
	
	
	if (count($code)==0){
		echo "<br><br><br><p align='center' class='ewmsg'>No data found</p>";
		return;
	}
	
	tableheader();
	
	
	// extract queries
	$dc = (isset($ro['row']['datacheck'])?$ro['row']['datacheck']:'');
	
	$i=1;
	while (isset($ro['row']['query'.$i])){
		$q[]=$ro['row']['query'.$i];
		$i++;
	}
	
	$rowscount = 0;	
	
	
	
	for ($i=0;$i<count($code);$i++){
		
		// skip if there's no data
		if ($dc!=''){
			$result=mysql_query($dc.$code[$i].$preclause);
			
			//echo $dc.$code[$i].$preclause.'<br>';
			
			if (mysql_num_rows($result)==0) continue;
		}
		
		
		// now compute row
		$row = array();
		$org_preclause = $preclause;
		
		// computer for each year
		foreach ($Y as $year){
			
			if (count($Y)>1){ // if there are only one year, conditions for year are already added to $preclause
				$preclause = $org_preclause . " and mast_schoollist.sch_year=$year and mast_school_type.sch_year=$year";
			}
					
		
			for ($j=0;$j<count($q);$j++){
			
				if (preg_match("/^@.*/",$q[$j])){
					$visibility=false;
					$qry = substr($q[$j],1);
				}
				else{
					$visibility = true;
					$qry = $q[$j];
				}
				
				if (strpos($qry,'#')===false){
					// regular query
			
					$result=mysql_query($qry.$code[$i].$preclause);
					$r=mysql_fetch_row($result);
					
					if (count($Y)>1 && !is_array($r)){
						$num_fields = mysql_num_fields($result);
						$r=array();
						for ($nf = 0; $nf < $num_fields; $nf++){
							$r[] = "";
						}
					}					
		
				}
				else{
					// expression to be evaluated
					
					while (preg_match("/[^#]*#([0-9]+).*/",$qry, $matches)==1){
						$matchvalue = $row[$matches[1]-1];
						if ($matchvalue=='') $matchvalue='0';
						$qry = preg_replace("/([^#]*)#([0-9]+)(.*)/","$1 $matchvalue $3", $qry);
					}
					eval("\$r[]=$qry;");
				
				}
				
				// now merge the calculated values to master row array
				$row=@array_merge($row, $r);
				
				// set visibility flag
				$colcount = count($r);
				while ($colcount--) $row_visibility[]=$visibility;
				
				unset($r);
			}		
		}
	
		
		if ($rowscount%2 && $TE!=1) echo '<tr>';
		else echo '<tr class="ewTableAltRow">';
		
		echo "<td>";
		
		$codestr=substr($code[$i],strpos($code[$i],"'")+1, strlen($code[$i])-strpos($code[$i],"'")-3);
		if (strlen($codestr)<10){
			if (!strstr($codestr,'%')) echo $codestr;
		}
		
		echo "</td>";
		echo "<td>".$name[$i]."</td>";
		
		if (isset($_GET['colwise'])){
			$colcount = count($row)/count($Y);
			for ($cc=0;$cc<$colcount;$cc++){
				for ($yc=0;$yc<count($Y);$yc++){
					$j = $colcount*$yc+$cc;
					
					if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
					else echo "<td align='center'>".$row[$j]."</td>";
					
					$sum[$j]+=$row[$j];					
				}
			}
		}
		else{
		
			for ($j=0;$j<count($row);$j++){
				if ($row_visibility[$j]==false) continue;
				
				if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
				else echo "<td align='center'>".$row[$j]."</td>";
				
				$sum[$j]+=$row[$j];
			}
		}
		
		echo '</tr>';
		
		unset($row);
		unset($row_visibility);
		
		
		if ($TN=='') $cd='';
		else $cd=substr($code[$i],strpos($code[$i],"'")+1, strlen($code[$i])-strpos($code[$i],"'")-3);
		
		$org_preclause_s = $org_preclause;
	
		// if reporttype is 3 we need to expand the schools
		if ($TE==1){ // && (strlen($cd)==2 || strlen($cd)==5)){
		
			$preclause = $org_preclause_s;
			
			// get school list
			$query = "select sch_num, nm_sch from mast_schoollist where mast_schoollist.flash$flash='1' ".$code[$i];
			
			if (ereg("(20[0-9]{2})",$preclause, $regs)){
				$query .= ' and mast_schoollist.sch_year='.$regs[1];
			}
			$query .= " group by sch_num order by nm_sch";
			
			$result=mysql_query($query);
			
			//echo $query.'<br>';
			
			while ($r=mysql_fetch_array($result)){
			
				$codes[]=$r['sch_num'];
				$names[]=$r['nm_sch'];
			}
			
			// for every schools under $D and current vdc ie, $code[$i]
			for ($s=0;$s<count($codes);$s++){
				// master where clause
				$wc = (" and mast_schoollist.sch_num='".$codes[$s]."'");
				
				// skip if there's no data
				if ($dc!=''){
					$result=mysql_query($dc.$wc.$preclause);
					
					//echo ($dc.$wc.$preclause);
					
					if (mysql_num_rows($result)==0) continue;
				}				

			
				// now compute row
				$row = array();
				$org_preclause = $preclause;
				
				foreach ($Y as $year){
					
					if (count($Y)>1){ // if there are only one year, conditions for year are already added to $preclause
						$preclause = $org_preclause . " and mast_schoollist.sch_year=$year and mast_school_type.sch_year=$year";
					}				
				
				
					for ($j=0;$j<count($q);$j++){
					
						if (preg_match("/^@.*/",$q[$j])){
							$visibility=false;
							$qry = substr($q[$j],1);
						}
						else{
							$visibility = true;
							$qry = $q[$j];
						}
						
						if (strpos($qry,'#')===false){
							// regular query
							
							$wc = (" and mast_schoollist.sch_num='".$codes[$s]."'");
							$result=mysql_query($qry.$wc.$preclause);
							$r=mysql_fetch_row($result);
							
							//if (mysql_error()) echo " -- ".$qry.$wc.$preclause."\n\n";
							
							if (count($Y)>1 && !is_array($r)){
								$num_fields = mysql_num_fields($result);
								$r=array();
								for ($nf = 0; $nf < $num_fields; $nf++){
									$r[] = "";
								}
							}							
				
						}
						else{
							// expression to be evaluated
							
							//echo $qry;
							while (preg_match("/[^#]*#([0-9]+).*/",$qry, $matches)==1){
								$matchvalue = $row[$matches[1]-1];
								if ($matchvalue=='') $matchvalue = 0;
								$qry = preg_replace("/([^#]*)#([0-9]+)(.*)/","$1 $matchvalue $3", $qry);
							}
							
							//echo "~".$qry;
							eval("\$r[]=$qry;");
						
						}
						
						// now merge the calculated values to master row array
						$row=@array_merge($row, $r);
						
						// set visibility flag
						$colcount = count($r);
						while ($colcount--) $row_visibility[]=$visibility;
						
						unset($r);
					}
				}					
				
				
				
				echo '<tr>';
				echo "<td>".$codes[$s]."</td>";
				echo "<td>".$names[$s]."</td>";
				
				if (isset($_GET['colwise'])){
					$colcount = count($row)/count($Y);
					for ($cc=0;$cc<$colcount;$cc++){
						for ($yc=0;$yc<count($Y);$yc++){
							$j = $colcount*$yc+$cc;
							
							if ($row_visibility[$j]==false) continue;
							
							if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
							else echo "<td align='center'>".$row[$j]."</td>";
							
							$sum[$j]+=$row[$j];					
						}
					}
				}
				else{
				
					for ($j=0;$j<count($row);$j++){
						if ($row_visibility[$j]==false) continue;
						
						if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
						else echo "<td align='center'>".$row[$j]."</td>";
						
						$sum[$j]+=$row[$j];
					}
				}				echo '</tr>';
				
				unset($row);
				unset($row_visibility);

				$preclause = $org_preclause_s;
			
			}
			unset($codes);
			unset($names);
		}
		
		$rowscount++;
		
		$preclause = $org_preclause;
	
	
	}
	
	
	if (count($sum)>0){

		echo '<tr class="ewTableHeader">';
		echo "<td colspan='2'>Total</td>";
			
			
		if (isset($_GET['colwise'])){
			$colcount = count($sum)/count($Y);
			for ($cc=0;$cc<$colcount;$cc++){
				for ($yc=0;$yc<count($Y);$yc++){
					$j = $colcount*$yc+$cc;
					
					if (gettype($sum[$j])=="double") echo "<td></td>";
					else echo "<td align='center'>".$sum[$j]."</td>";
					
					$sum[$j]+=$sum[$j];					
				}
			}
		}
		else{
		
			for ($j=0;$j<count($sum);$j++){
				if (gettype($sum[$j])=="double") echo "<td></td>";
				else echo "<td align='center'>".$sum[$j]."</td>";
				
				$sum[$j]+=$sum[$j];
			}
		}
		
		echo '</tr>';
	
	
	}
	
	// output table footer
	tablefooter();
	
	if (count($sum)==0) echo "<br><br><br><p align='center' class='ewmsg'>No data found</p>";
	
	// draw chart
	//if (count($sum)>0) drawchart();
	
	if (count($sum)>0){
		echo "\n<script>";
		echo "\ndocument.getElementById('reportsums').value='".join(",",$sum)."';";
		echo "\ndocument.getElementById('reportbutton').disabled='';";
		echo "\n</script>";
	}
	
	// execute post queries
	if (isset($ro['postquery'])){
		$n = 1;
		
		while (isset($ro['postquery']['query'.$n])){
			$query = $ro['postquery']['query'.$n];
			mysql_query($query);
			$n++;
		}
	}	
	
	
}





// close the table
function tablefooter(){
	global $ro;
	
	echo '</table>';
}

// draw chart
function drawchart(){
	global $ro, $piedata, $pielabel,$sum;
	
	return;
	
	require_once ("../lib/jpgraphlib/jpgraph.php");
	require_once ("../lib/jpgraphlib/jpgraph_pie.php");
	require_once ("../lib/jpgraphlib/jpgraph_pie3d.php");	
	require_once ("../lib/jpgraphlib/jpgraph_bar.php");	

	$i=1;
	while (isset($ro['chart'.$i])){
		$chart=$ro['chart'.$i];
		$title = $chart['title'];
		
		if ($chart['type']=='pie'){


			$graph = new PieGraph(640,480,"auto");
			$graph->SetShadow();

			$graph->img->SetMargin(40,100,20,40);
			
			$graph->title->Set($title);
			$graph->title->SetFont(FF_FONT1,FS_BOLD);

			$tmpl = explode("|",$chart['label']);
			$tmpd = explode('|',$chart['column']);
			
			$d = array();
			foreach($tmpd as $t){
				$d[] = $sum[(int)($t)];
			}
			
			$p1 = new PiePlot3D($d);
			$p1->SetSize(0.5);
			$p1->SetCenter(0.45);
			$p1->SetLegends($tmpl);

			$graph->Add($p1);
			
			$fname = 'tmp//'.rand(100,999).'.png';
			$graph->Stroke($fname);
			
			
			echo "<p align='center'><img src='$fname'></p>";
					
		
		}
		

		
		
		if ($chart['type']=='bar'){
					

			
			$data = array();
			$labels=array();
			
			$j=1;
			while (isset($chart['group'.$j])){
				$tmp = explode("|",$chart['group'.$j]);
				
				foreach($tmp as $t){
					$tmp1[] = $sum[(int)($t)];
				}
				
				$data[] = $tmp1;
				$labels[]=$chart['group'.$j.'label'];
				//$datalabel[] = explode(",",$chart['group'.$j.'label']);
				unset($tmp1);
				unset($tmp);
				$j++;
			}
			
			$label = str_replace(',',', ',$chart['label']);
			
			
			

			//$data1y=array(12,8,19,3,10,5);
			//$data2y=array(8,2,11,7,14,4);

			// Create the graph. These two calls are always required
			$graph = new Graph(640,480,"auto");    
			$graph->SetScale("textlin");

			$graph->SetShadow();
			$graph->img->SetMargin(40,100,20,50);

			$colorarray = array("orange","blue","red","green","yellow","brown","grey","chocolate","darkcyan","darkorange","darkblue","darkred","darkgreen","darkyellow","darkbrown","darkgrey" );
			// Create the bar plots
			$bplot = array();
			$colornum = 0;
			foreach($data as $d){
				//print_r($d);
				//echo '<br>';
				$bplot[$colornum] = new BarPlot($d);
				
				//$bplot[$colornum]->SetLegends('abc');
				
				//SetLabels($datalabel[$colornum]);
				$bplot[$colornum]->SetFillColor($colorarray[$colornum%count($colorarray)]);
				$bplot[$colornum]->value->Show();
				$bplot[$colornum]->value->SetFormat('%d');
				$bplot[$colornum]->SetLegend($labels[$colornum]);

				// Center the values in the bar
				$bplot[$colornum]->SetValuePos('center');

				$colornum++;
			}
			
			
			
			//$b1plot = new BarPlot($data1y);
			//$b1plot->SetFillColor("orange");
			//$b2plot = new BarPlot($data2y);
			//$b2plot->SetFillColor("blue");

			// Create the grouped bar plot
			$gbplot = new GroupBarPlot($bplot);

			// ...and add it to the graPH
			$graph->Add($gbplot);
			
			$graph->title->Set($title);
			$label=explode('|',$chart['xlabel']);
			
			$graph->xaxis->SetTickLabels($label);
			
			//$graph->xaxis->title->Set($label);
			//$graph->yaxis->title->Set($chart['ytitle']);

			//$graph->title->SetFont(FF_FONT1,FS_BOLD);
			//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
			//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

			$fname = 'tmp//'.rand(100,999).'.png';
			$graph->Stroke($fname);
			
			echo "<p align='center'><img src='$fname'></p>";
			
		
		}
		
		
		
		$i++;
	}
	
	
}

// close page
function pagefooter(){
	global $ro;
	
	echo '</body>';
	echo '</html>';
	
}

function dvname($dcode, $vcode){
	global $link;
	
	if ($dcode=='') return '';
	
	$result=mysql_query("select dist_name from mast_district where dist_code='$dcode'");
	$r=mysql_fetch_array($result);
	
	$dname= $r['dist_name'];

	if ($vcode!=''){
		$result=mysql_query("select vdc_name_e from mast_vdc where dist_code='$dcode' and vdc_code='$vcode'");
		$r=mysql_fetch_array($result);
		
		$vname= $r['vdc_name_e'];
	}
	
	return (($vname==''?'':$vname.", ").$dname);

	
}

function tagname($tagid){

	$query="select * from tags where tag_id=$tagid";
	

	$result = mysql_query($query);
	$rows = mysql_fetch_array($result);
	
	return $rows['tag_name'];
}

function dvsname($tagcode){
	if (strlen($tagcode)==3){
		// district 
		
		$result = mysql_query("select * from mast_district where dist_code like '$tagcode'");
		$rows = mysql_fetch_array($result);
		
		return $rows['dist_name'];
	}
	if (strlen($tagcode)==6){
		// vdc
		
		$result = mysql_query("select *, concat(dist_code,vdc_code) as dv from mast_vdc having dv like '$tagcode';");
		$rows = mysql_fetch_array($result);
		
		return $rows['vdc_name_e'];
		
	}
	if (strlen($tagcode)==10){
		//school

		$result = mysql_query("select * from mast_schoollist where sch_num like '$tagcode';");
		$rows = mysql_fetch_array($result);
		
		return $rows['nm_sch'];


	}
	
	
}


function reportfix(&$r){
	global $currentyear;
	
	// replace year data
	$n = 1;
	while (isset($r['prereq']['prereq'.$n.'title'])){
		$title = $r['prereq']['prereq'.$n.'title'];
		
		if (strtolower($title)=='year'){
			
			$options = array();
			$clauses = array();
			
			for ($y=$currentyear; $y>=2062; $y--){
				$options[] = $y;
				$clauses[] = "mast_schoollist.sch_year=$y and mast_school_type.sch_year=$y";
			}
			
			$r['prereq']['prereq'.$n.'options'] = implode('|',$options);
			$r['prereq']['prereq'.$n.'clauses'] = implode('|',$clauses);
		}
		
		$n++;

	}
	
	$r['prereq']["prereq{$n}title"] = "Region";
	$r['prereq']["prereq{$n}options"] = "All|Rural|Urban";
	$r['prereq']["prereq{$n}clauses"] = "mast_schoollist.region IS NOT NULL|mast_schoollist.region='1'|mast_schoollist.region='2'";
	
}

?>
