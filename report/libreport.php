<?php

function pageheader(){
	global $ro,$rtypestr, $D, $V, $T, $TN, $R, $Y;
	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
	echo '<head>';
	echo "<title>Flash - Reports</title>";
	echo '<meta http-equiv="content-type" content="text/html;charset=utf-8" />';
	echo '<link href="../css/style.css" rel="stylesheet" type="text/css">';
	echo '</head>';
	echo '<body>';
	
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
			$var_name = $ro['prereq']['prereq'.$n.'var'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET[$var_name];
			
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

}

// close page
function pagefooter(){
	global $ro;
	
	echo '</body>';
	echo '</html>';
	
}

// throw table header
function tableheader(){
	global $ro, $Y;
	
	// find row count
	$rowcount = 1;
	for ($i=1;$i<10;$i++){
		if (!isset($ro['tableheader']['row'.$i])) continue;
		$rowcount = $i;
	}
	
	// find col count
	// number of cols in last row
	$colcount = substr_count($ro['tableheader']['row'.$rowcount],"|")+1;
		
	echo '<table class="ewTable" width="100%"><thead>';
	
	// add year row if applicable
	if (count($Y)>1 && !isset($_GET['colwise'])){
		echo "<tr class='ewTableHeader'><td colspan='2'>&nbsp;</td>";

		
		foreach ($Y as $year){
			echo "<td colspan='$colcount'>$year</td>";
		}
		echo "</tr>";
	}
	

	
	$first_row = true;
	for ($i=1;$i<10;$i++){
		if (isset($ro['tableheader']['row'.$i])){
			
			$rowstr = $ro['tableheader']['row'.$i];
			$cols = explode("|",$rowstr);
			
			echo '<tr class="ewTableHeader">';
			
			if ($first_row) {
				echo "<td colspan='2' rowspan='$rowcount'>Code / Name</td>";
				$first_row = false;
			}
			
			$thstr = "";
			foreach ($cols as $c){
				
				if (isset($_GET['colwise'])){
					$m = count($Y);
				}
				else $m = 1;				
				
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
	
	echo "</thead>\n";
	echo "<tbody>\n";
	
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
			$var_name = $ro['prereq']['prereq'.$n.'var'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET[$var_name];
			
			if ($pclz != "")
				$preclause .= (' and '.$clz[(int)$pclz]);
			
			$n++;

			
		}
		
		// if there's only one year, add it to preclause by default
		if (count($Y)==1){
			$y=$Y[0];
			$preclause .= " and mast_school_type.sch_year=$y";
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
		$query = "select sch_num, nm_sch from mast_schoollist where dist_code='$D' and vdc_code='$V'";

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
			
					//echo $qry.$wc.$preclause."<br />";
					$result=mysql_query($qry.$wc.$preclause);
					$r=mysql_fetch_row($result);
					//echo mysql_error();
		
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
		}	// end of year loop
		
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
			$query = "select sch_num, nm_sch from mast_schoollist where dist_code='$D' and vdc_code='".$code[$i]."' and mast_schoollist.flash='$flash'";
			
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

				$preclause = $org_preclause_s;
			
			}
			unset($codes);
			unset($names);
		
		}	// school expansion
		
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


// close the table
function tablefooter(){
	echo "</tbody>\n";
	echo "</table>\n";
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

//
// "fixes" the report
// 
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
	
	// create var_name for all prereq's
	$n = 1;
	while (isset($r['prereq']['prereq'.$n.'title'])){
		$title = $r['prereq']['prereq'.$n.'title'];
		
		$var_name = str_replace(" ","_",$title);
		$var_name = strtolower(preg_replace("/[^a-zA-Z0-9_]/","",$var_name));
		
		$r['prereq']['prereq'.$n.'var'] = $var_name;
		
		$n++;

	}	
	
}


//
// fixes table header 
//
function reportfix_thead(&$ro){
	
	// create table out of header information string
	
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
	
	// now remove the colums
	global $CSKIP;
	foreach ($CSKIP as $c=>$value){
	
		for ($r=0;$r<count($tableheader); $r++){
			unset($tableheader[$r][$c]);
		}
	}
	
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
	
	
}

function report_merge($r_arr){
	
	// header (merge parallelly separated by comma)
	
	// prereq (find lowest common denominator)

	// tableheader (merge side by side, with first row as report header 
	// colspanned to table's total col)
	
	// row
	// stack up, and modify #<n> values
	
	
}
