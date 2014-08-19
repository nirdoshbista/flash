<?php

$sch_num='';

function pageheader(){
	global $ro,$rtypestr, $D, $V, $T, $TN, $R;
	
	echo '<html>';
	echo '<head>';
	echo '<title>Flash II - Reports</title>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
	echo '<link href="css/style.css" rel="stylesheet" type="text/css">';
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
	
	
	echo '<br />';
	
	// display pre-requisite information
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			echo "<h3 align='center'>";
			
			echo $title.': ';
			echo $options[(int)$pclz];
			
			echo '</h3>';
	
			$n++;

			
		}
	}	
	
?>

<div id='graphlink' align="right">
<form method="POST" action="viewgraph.php" target="_blank">
<input type="hidden" name="reportfile" value="<?php echo $R; ?>">
<input type="hidden" name="reportsums" id="reportsums">
<input type="hidden" name="reporttitles" value="<?php echo htmlentities(pageheaderstr()); ?>">
<input type="submit" id="reportbutton" disabled value="View Graph">

</form>
</div>
	
<?php	
	
	
}


function pageheaderstr(){
	global $ro,$rtypestr, $D, $V, $T, $TN, $R;
	
	$str='';
	
	$str.= '<html>';
	$str.= '<head>';
	$str.= '<title>Flash II - Reports</title>';
	$str.= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
	$str.= '<link href="css/style.css" rel="stylesheet" type="text/css">';
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
			
			$str.= "<h3 align='center'>";
			
			$str.= $title.': ';
			$str.= $options[(int)$pclz];
			
			$str.= '</h3>';
	
			$n++;

			
		}
	}
	
	return $str;
	
}

// throw table header
function tableheader(){
	global $ro;
	
	echo "<style>table{border-collapse:collapse;}</style>";
	
	echo '<table class="ewTable" width="100%">';

	for ($i=1;$i<10;$i++){
		if (isset($ro['tableheader']['row'.$i])){
			$rowstr = $ro['tableheader']['row'.$i];
			$cols = explode("|",$rowstr);
			
			echo '<tr class="ewTableHeader">';
			
			foreach ($cols as $c){
				ereg(".*\[(.*)\].*",$c,$t);
				//echo $t[1];
				$spn='';
				if (isset($t[1])){
					if (ereg(".*\[([0-9]*),([0-9]*)\].*",$c,$t)){
						$spn="rowspan='".$t[1]."' colspan='".$t[2]."'";
					}
					else{
						if(ereg(".*\[([0-9]*)\].*",$c,$t)) $spn="colspan='".$t[1]."'";
					}
				}
				else $spn='';

				ereg("([^\[]*)(\[.*|$)",$c,$t);
				$colname=$t[1];
				
				echo "<td $spn>$colname</td>";
			}
			
			echo '</tr>';
			
			
		}
	}	
	
	
	
}

function reportbody($sn){
	
	global $sch_num;
	
	$sch_num=$sn;
	
	$result=mysql_query("select * from mast_schoollist where sch_num=$sch_num;");
	$ginfo=mysql_fetch_array($result);
	
	$result=mysql_query(sprintf('select * from mast_district where dist_code=%s;',$ginfo['dist_code']));
	$temp=mysql_fetch_array($result);
	$districtname=$temp['dist_name'];
	
	$result=mysql_query(sprintf('select * from mast_vdc where dist_code=%s and vdc_code=%s;',$ginfo['dist_code'],$ginfo['vdc_code']));
	$temp=mysql_fetch_array($result);
	$vdcname=$temp['vdc_name_e'];
	
	$result=mysql_query("select * from mast_school_type_f1 where sch_num='$sch_num'");
	$schooltype=mysql_fetch_array($result);
	
	if ($schooltype['ecd']) $ecd=1; else $ecd=0;
	if ($schooltype['class1'])  $primary=1; else $primary=0;
	if ($schooltype['class6']) $lsec=1; else $lsec=0;
	if ($schooltype['class9']) $sec=1; else $sec=0;
	if ($schooltype['class11']) $hsec=1; else $hsec=0;
	
?>

<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<COL WIDTH=79*>
	<COL WIDTH=3*>
	<COL WIDTH=174*>
	<TR VALIGN=TOP>
		<TD WIDTH=31%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=78*>
				<COL WIDTH=178*>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>District</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $districtname; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>VDC</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $vdcname; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>Ward No.</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $ginfo['wardno']; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><BR>
						</P>
					</TD>
					<TD WIDTH=70%>
						<P CLASS="western" ALIGN=LEFT><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>Region</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo ($ginfo['region']?'Urban':'Rural'); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>Address</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $ginfo['location']; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>Phone</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $ginfo['phone']; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<P CLASS="western" ALIGN=LEFT><B>Email</B></P>
					</TD>
					<TD WIDTH=70%>
						 <?php echo $ginfo['email']; ?>&nbsp;
					</TD>
				</TR>
			</TABLE>
			<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in"><BR>
			</P>

		</TD>
		<TD WIDTH=1%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=68%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=83*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<TR VALIGN=TOP>
					<TD WIDTH=32% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>ECD</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Primary</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>L.Sec.</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Sec.</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>H.Sec.</B></P>
					</TD>
				</TR>
				
				<?php
				if (isset($schooltypename)) unset($schooltypename);
	
					
				$schooltypename[]="Community (Aided)";
				$schooltypename[]="Community Managed";
				$schooltypename[]="Community (Unaided)";
				$schooltypename[]="Institutional (Private Fund)";
				$schooltypename[]="Institutional (Public Fund)";
				$schooltypename[]="Institutional (Enlisted with Company)";
				$schooltypename[]="Madrasa";
				$schooltypename[]="Gumba";
				$schooltypename[]="Aashram";
				
				$classtypes=array("ecd","class1","class6","class9","class11");
					
				$i=0;
			  
				foreach($schooltypename as $s){
					$i++;
					printf("<TR VALIGN=TOP>");
					printf("<TD WIDTH=32%%><P CLASS=\"western\" ALIGN=CENTER>%s</P></TD>",$s);
					
					foreach($classtypes as $ct){
						printf("<td width=\"14%%\" align=\"center\">%s</td>",$schooltype[$ct]==$i?"<img src=\"images/tick.gif\">":"&nbsp");
					}
					
					
					printf("</TR>");
					
				}
				  
				  
				?>

			</TABLE>
		</TD>
	</TR>
</TABLE>
<br>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
	<COL WIDTH=58*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<COL WIDTH=14*>
	<TR VALIGN=TOP>
		<TD WIDTH=23% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>ECD</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>1</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>2</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>3</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>4</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>5</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>6</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>7</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>8</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>9</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>10</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>11</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>12</B></P>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Total</B></P>
		</TD>
	</TR>
          <tr> 
            <td  align="center" class="blue"><strong>total enrollment</strong></td>
            <td align="center"><?php $t0=d('ecdppc_enroll_f1'); $sum=0+$t0['tot_enroll_total_f']+$t0['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum; ?></td>
            <td align="center"><?php $t1=dc('enr_rep_mig_class1_5_f1',1); $sum=0+$t1['tot_enroll_total_f']+$t1['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t2=dc('enr_rep_mig_class1_5_f1',2); $sum=0+$t2['tot_enroll_total_f']+$t2['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t3=dc('enr_rep_mig_class1_5_f1',3); $sum=0+$t3['tot_enroll_total_f']+$t3['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t4=dc('enr_rep_mig_class1_5_f1',4); $sum=0+$t4['tot_enroll_total_f']+$t4['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t5=dc('enr_rep_mig_class1_5_f1',5); $sum=0+$t5['tot_enroll_total_f']+$t5['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t6=dc('enr_rep_mig_class6_8_f1',6); $sum=0+$t6['tot_enroll_total_f']+$t6['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t7=dc('enr_rep_mig_class6_8_f1',7); $sum=0+$t7['tot_enroll_total_f']+$t7['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t8=dc('enr_rep_mig_class6_8_f1',8); $sum=0+$t8['tot_enroll_total_f']+$t8['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t9=dc('enr_rep_mig_class9_10_f1',9); $sum=0+$t9['tot_enroll_total_f']+$t9['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t10=dc('enr_rep_mig_class9_10_f1',10); $sum=0+$t10['tot_enroll_total_f']+$t10['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t11=dc('enr_rep_mig_class11_12_f1',11); $sum=0+$t11['tot_enroll_total_f']+$t11['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $t12=dc('enr_rep_mig_class11_12_f1',12); $sum=0+$t12['tot_enroll_total_f']+$t12['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>boys enrollment</strong></td>
            <td align="center"><?php $sum = 0+$t0['others_m']+$t0['dalit_m']+$t0['janjati_m']; $s=0; if ($sum>0) echo $sum; $s+=$sum; ?></td>
            <td align="center"><?php $sum=0+$t1['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t2['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t3['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t4['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t5['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t6['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t7['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t8['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t9['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t10['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t11['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t12['tot_enroll_total_m']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>girls enrollment</strong></td>
            <td align="center"><?php $sum = 0+$t0['others_f']+$t0['dalit_f']+$t0['janjati_f']; $s=0; if ($sum>0) echo $sum; $s+=$sum; ?></td>
            <td align="center"><?php $sum=0+$t1['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t2['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t3['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t4['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t5['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t6['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t7['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t8['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t9['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t10['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t11['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php $sum=0+$t12['tot_enroll_total_f']; if ($sum>0) echo $sum; $s+=$sum;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>dalit enrollment</strong></td>
            <td align="center"><?php $s=0; echo $t=dac('ecd_dalit_enroll_age_f1','ecd','_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_dalit_enroll_age_f1',1,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_dalit_enroll_age_f1',2,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_dalit_enroll_age_f1',3,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_dalit_enroll_age_f1',4,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_dalit_enroll_age_f1',5,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_dalit_enroll_age_f1',6,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_dalit_enroll_age_f1',7,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_dalit_enroll_age_f1',8,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_dalit_enroll_age_f1',9,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_dalit_enroll_age_f1',10,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('hsec_dalit_enroll_age_f1',11,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('hsec_dalit_enroll_age_f1',12,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>janjati enrollment</strong></td>
            <td align="center"><?php $s=0; echo $t=dac('ecd_janjati_enroll_age_f1','ecd','_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_janjati_enroll_age_f1',1,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_janjati_enroll_age_f1',2,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_janjati_enroll_age_f1',3,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_janjati_enroll_age_f1',4,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pr_janjati_enroll_age_f1',5,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_janjati_enroll_age_f1',6,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_janjati_enroll_age_f1',7,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_janjati_enroll_age_f1',8,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_janjati_enroll_age_f1',9,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_janjati_enroll_age_f1',10,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('hsec_janjati_enroll_age_f1',11,'_f|_m|m_|f_'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('hsec_janjati_enroll_age_f1',12,'_f|_m|m_|f_'); $s+=$t;?></td>
			<td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>disability enrollment</strong></td>
            <td align="center"><?php $s=0; echo $t=dac('pri_disabled_f1',0,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pri_disabled_f1',1,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pri_disabled_f1',2,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pri_disabled_f1',3,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pri_disabled_f1',4,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('pri_disabled_f1',5,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('lsec_disabled_f1',6,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('lsec_disabled_f1',7,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('lsec_disabled_f1',8,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_hsec_disabled_f1',9,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_hsec_disabled_f1',10,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_hsec_disabled_f1',11,''); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('sec_hsec_disabled_f1',12,''); $s+=$t;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>appeared in exam</strong></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php echo dac('class5_8_slc_12_status_f1',5,'app_total'); ?></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php echo dac('class5_8_slc_12_status_f1',8,'app_total'); ?></td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php echo dac('class5_8_slc_12_status_f1',10,'app_total'); ?></td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php echo dac('class5_8_slc_12_status_f1',12,'app_total'); ?></td>
            <td align="center">&nbsp;</td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>repeaters</strong></td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php $s=0; echo $t=dac('enr_rep_mig_class1_5_f1',1,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',2,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',3,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',4,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',5,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',6,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',7,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',8,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class9_10_f1',9,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class9_10_f1',10,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class11_12_f1',11,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class11_12_f1',12,'rep'); $s+=$t;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr> 
          <tr>  
            <td  align="center" class="blue"><strong>new transfers in </strong></td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php $s=0; echo $t=dac('enr_rep_mig_class1_5_f1',1,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',2,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',3,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',4,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class1_5_f1',5,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',6,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',7,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class6_8_f1',8,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class9_10_f1',9,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class9_10_f1',10,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class11_12_f1',11,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('enr_rep_mig_class11_12_f1',12,'tran'); $s+=$t;?></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr>
          <tr> 
            <td align="center" class="blue"><strong>textbooks (full set)</strong></td>
            <td align="center">&nbsp;</td>
            <td align="center"><?php $s=0; echo $t=dac('textbooks_f1',1,'full'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('textbooks_f1',2,'full'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('textbooks_f1',3,'full'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('textbooks_f1',4,'full'); $s+=$t;?></td>
            <td align="center"><?php echo $t=dac('textbooks_f1',5,'full'); $s+=$t;?></td>
            <td colspan="7" bgcolor="#e0e0e0"></td>
            <td align="center"><?php echo ($s>0?$s:''); ?></td>
          </tr>

</TABLE>
<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in"><BR>
</P>
<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<COL WIDTH=116*>
	<COL WIDTH=4*>
	<COL WIDTH=136*>
	<TR VALIGN=TOP>
		<TD WIDTH=45%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=98*>
				<COL WIDTH=30*>
				<COL WIDTH=94*>
				<COL WIDTH=35*>
				<TR>
					<TD COLSPAN=4 WIDTH=100% VALIGN=TOP>
						<P CLASS="western" ALIGN=CENTER STYLE="background: #e6e6e6"><B>Physical
						Information</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Buildings</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Electricity</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Rooms</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Playground</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Inadequate Rooms</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Toilet</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Store</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Toilet for Girls</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Library</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Toilet for Teachers</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Inadequate Desks</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Compound</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Inadequate Benches</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Health Facility</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Computers</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Urinal</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Water</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Urinal for Girls</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=38%>
						<P CLASS="western" ALIGN=CENTER>Water Source</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=37%>
						<P CLASS="western" ALIGN=CENTER>Staff Room</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
			</TABLE>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=1%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=53%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=69*>
				<COL WIDTH=56*>
				<COL WIDTH=78*>
				<COL WIDTH=52*>
				<TR VALIGN=TOP>
					<TD COLSPAN=2 WIDTH=49% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Income</B></P>
					</TD>
					<TD COLSPAN=2 WIDTH=51% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Expenditure</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Govt. Support</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Salary</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Rahat</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Rahat</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Scholarship</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Scholarship</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Block grant</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Materials</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Others</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Furniture</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Fees</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Stationary</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER>Others</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Student welfare</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER><B>Total</B></P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Teacher welfare</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>School Improve</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Others</P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=27%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=22%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER><B>Total</B></P>
					</TD>
					<TD WIDTH=20%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>
</TABLE>
<P CLASS="western" ALIGN=CENTER><B>Teachers Information</B></P>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
	<COL WIDTH=25*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<COL WIDTH=9*>
	<TR VALIGN=TOP>
		<TD WIDTH=10% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD ROWSPAN=3 WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Appr</B></P>
		</TD>
		<TD COLSPAN=8 WIDTH=29% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Approved Teachers</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Perm</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Temp</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Rahat</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Private</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Total</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Full Training</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Partial Training</B></P>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>No Training</B></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Tot</B></P>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Dalit</B></P>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Jan.</B></P>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Disab.</B></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>F</B></P>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>M</B></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			<P CLASS="western" ALIGN=CENTER>HT</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			<P CLASS="western" ALIGN=CENTER>Primary</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			<P CLASS="western" ALIGN=CENTER>L.Sec.</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			<P CLASS="western" ALIGN=CENTER>Sec.</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			<P CLASS="western" ALIGN=CENTER>H.Sec.</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=4%>
		</TD>
	</TR>
</TABLE>
<P CLASS="western" ALIGN=CENTER><BR>
</P>
<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<COL WIDTH=127*>
	<COL WIDTH=4*>
	<COL WIDTH=125*>
	<TR VALIGN=TOP>
		<TD WIDTH=50%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=3 CELLSPACING=0>
				<COL WIDTH=102*>
				<COL WIDTH=31*>
				<COL WIDTH=31*>
				<COL WIDTH=31*>
				<COL WIDTH=31*>
				<COL WIDTH=31*>
				<TR VALIGN=TOP>
					<TD WIDTH=40% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>1</B></P>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>2</B></P>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>3</B></P>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>4</B></P>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>5</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<P CLASS="western" ALIGN=CENTER><B>Subject Teaching</B></P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<P CLASS="western" ALIGN=CENTER><B>Grade Teaching</B></P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<P CLASS="western" ALIGN=CENTER><B>Multigrade Teaching</B></P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=12%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
			</TABLE>
			<P CLASS="western" ALIGN=CENTER><B>No. of Sections</B></P>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=71*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<TR VALIGN=TOP>
					<TD WIDTH=28% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Class</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>1</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>2</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>3</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>4</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>5</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28%>
						<P CLASS="western" ALIGN=CENTER><B>Sections</B></P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>6</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>7</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>8</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>9</B></P>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>10</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=14%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
			</TABLE>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=2%>
			<P CLASS="western" ALIGN=LEFT><BR>
			</P>
		</TD>
		<TD WIDTH=49%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=80*>
				<COL WIDTH=19*>
				<COL WIDTH=20*>
				<COL WIDTH=19*>
				<COL WIDTH=20*>
				<COL WIDTH=19*>
				<COL WIDTH=19*>
				<COL WIDTH=20*>
				<COL WIDTH=19*>
				<COL WIDTH=20*>
				<TR>
					<TD COLSPAN=10 WIDTH=100% VALIGN=TOP BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><B>Class 1 and 2 Agewise</B></P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>F</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>M</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>T</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>F</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>M</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>T</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>F</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>M</P>
					</TD>
					<TD WIDTH=8% BGCOLOR="#e6e6e6">
						<P CLASS="western" ALIGN=CENTER>T</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER><B>Class1 Total</B></P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Under Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Correct Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Over Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER><B>Class2 Total</B></P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Under Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Correct Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=31%>
						<P CLASS="western" ALIGN=CENTER>Over Age</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
					<TD WIDTH=8%>
						<P CLASS="western" ALIGN=CENTER><BR>
						</P>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><B>Indicators
and Comparative Statistics</B></P>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
	<COL WIDTH=57*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<COL WIDTH=12*>
	<TR VALIGN=TOP>
		<TD WIDTH=22% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Student / Teacher</B></P>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Student/Class</B></P>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Pass Rate</B></P>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Repetition Rate</B></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Pr</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>LS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>S</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>HS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Pr</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>LS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>S</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>HS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Pr</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>LS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>S</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>HS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>Pr</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>LS</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>S</B></P>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<P CLASS="western" ALIGN=CENTER><B>HS</B></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			<P CLASS="western" ALIGN=CENTER>&lt;school&gt;</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			<P CLASS="western" ALIGN=CENTER>&lt;vdc&gt;</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			<P CLASS="western" ALIGN=CENTER>&lt;district&gt;</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			<P CLASS="western" ALIGN=CENTER>&lt;national&gt;</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
		<TD WIDTH=5%>
			<P CLASS="western" ALIGN=CENTER><BR>
			</P>
		</TD>
	</TR>
</TABLE>

<?php
	
	
}


// show the table
function tablebody(){
	global $ro, $reporttype, $link,$D,$V,$S,$T, $piedata, $pielabel, $piecol, $sum;
	
	$preclause = '';
	
	// pre-requistite options
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			$preclause .= (' and '.$clz[(int)$pclz]);
			
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
		$query .= " order by nm_sch";
		
		$result=mysql_query($query);
		
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
		
				$result=mysql_query($qry.$wc.$preclause);
				$r=mysql_fetch_row($result);
	
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
			$row=array_merge($row, $r);
			
			// set visibility flag
			$colcount = count($r);
			while ($colcount--) $row_visibility[]=$visibility;
			
			unset($r);
		}
		
		if ($rowscount%2 && $reporttype!=3) echo '<tr>';
		else echo '<tr class="ewTableAltRow">';
		
		echo "<td>".$code[$i]."</td>";
		echo "<td>".$name[$i]."</td>";
		
		for ($j=0;$j<count($row);$j++){
			if ($row_visibility[$j]==false) continue;
			
			if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
			else echo "<td align='center'>".$row[$j]."</td>";
			
			$sum[$j]+=$row[$j];
			//if ($j==$piecol) {
			//	$pielabel[]=$name[$i];
			//	$piedata[]=$row[$j];
			//}
			
		}
		echo '</tr>';
		
		unset($row);
		unset($row_visibility);

		// if reporttype is 3 we need to expand the schools
		if ($reporttype==3){
		
			
			// get school list
			$query = "select sch_num, nm_sch from mast_schoollist where dist_code='$D' and vdc_code='".$code[$i]."'";
			
			if (ereg("(20[0-9]{2})",$preclause, $regs)){
				$query .= ' and mast_schoollist.sch_year='.$regs[1];
			}
			$query .= " order by nm_sch";
			
			$result=mysql_query($query);
			
			while ($r=mysql_fetch_array($result)){
			
				$codes[]=$r['sch_num'];
				$names[]=$r['nm_sch'];
			}
			
			// for every schools under $D and current vdc ie, $code[$i]
			for ($s=0;$s<count($codes);$s++){
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
					$row=array_merge($row, $r);
					
					// set visibility flag
					$colcount = count($r);
					while ($colcount--) $row_visibility[]=$visibility;
					
					unset($r);
				}
				
				echo '<tr>';
				echo "<td>".$codes[$s]."</td>";
				echo "<td>".$names[$s]."</td>";
				
				
				
				
				for ($j=0;$j<count($row);$j++){
					if ($row_visibility[$j]==false) continue;
					
					if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
					else echo "<td align='center'>".$row[$j]."</td>";
				}
				echo '</tr>';
				
				unset($row);
				unset($row_visibility);

				
			
			}
			unset($codes);
			unset($names);
		}
		
		$rowscount++;
		
	
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
			
		for ($j=0;$j<count($sum);$j++){
			if (gettype($sum[$j])=="double") echo "<td></td>";
			else echo "<td>".$sum[$j]."</td>";
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
	
	
	
}



// show the table
function tablebody_bytag(){
	global $ro, $link, $T, $TN, $TE, $sum;
	
	$preclause = '';
	

	// pre-requistite options
	if (isset($ro['prereq'])){
		$n = 1;
		
		while (isset($ro['prereq']['prereq'.$n.'title'])){
			$title = $ro['prereq']['prereq'.$n.'title'];
			$options = explode("|",$ro['prereq']['prereq'.$n.'options']);
			$clz = explode("|",$ro['prereq']['prereq'.$n.'clauses']);
			
			$pclz=$_GET["opt$n"];
			
			$preclause .= (' and '.$clz[(int)$pclz]);
			
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
			$row=array_merge($row, $r);
			
			// set visibility flag
			$colcount = count($r);
			while ($colcount--) $row_visibility[]=$visibility;
			
			unset($r);
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
		
		for ($j=0;$j<count($row);$j++){
			if ($row_visibility[$j]==false) continue;
			
			if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
			else echo "<td align='center'>".$row[$j]."</td>";

			$sum[$j]+=$row[$j];
			
		}
		echo '</tr>';
		
		unset($row);
		unset($row_visibility);
		
		
		if ($TN=='') $cd='';
		else $cd=substr($code[$i],strpos($code[$i],"'")+1, strlen($code[$i])-strpos($code[$i],"'")-3);
		
	
		// if reporttype is 3 we need to expand the schools
		if ($TE==1 && (strlen($cd)==2 || strlen($cd)==5)){
		
			
			// get school list
			$query = "select sch_num, nm_sch from mast_schoollist where true=true".$code[$i];
			
			if (ereg("(20[0-9]{2})",$preclause, $regs)){
				$query .= ' and mast_schoollist.sch_year='.$regs[1];
			}
			$query .= " order by nm_sch";
			
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
			
					}
					else{
						// expression to be evaluated
						
						while (preg_match("/[^#]*#([0-9]+).*/",$qry, $matches)==1){
							$matchvalue = $row[$matches[1]-1];
							$qry = preg_replace("/([^#]*)#([0-9]+)(.*)/","$1 $matchvalue $3", $qry);
						}
						eval("\$r[]=$qry;");
					
					}
					
					// now merge the calculated values to master row array
					$row=array_merge($row, $r);
					
					// set visibility flag
					$colcount = count($r);
					while ($colcount--) $row_visibility[]=$visibility;
					
					unset($r);
				}					
				
				
				
				echo '<tr>';
				echo "<td>".$codes[$s]."</td>";
				echo "<td>".$names[$s]."</td>";
				
				for ($j=0;$j<count($row);$j++){
					if ($row_visibility[$j]==false) continue;
					
					if (gettype($row[$j])=="double") echo "<td align='center'>".sprintf("%.4f",$row[$j])."</td>";
					else echo "<td align='center'>".$row[$j]."</td>";
				}
				echo '</tr>';
				
				unset($row);
				unset($row_visibility);

				
			
			}
			unset($codes);
			unset($names);
		}
		
		$rowscount++;
		

	
	
	}
	
	
	if (count($sum)>0){

		echo '<tr class="ewTableHeader">';
		echo "<td colspan='2'>Total</td>";
			
			
		for ($j=0;$j<count($sum);$j++){
			if (gettype($sum[$j])=="double") echo "<td></td>";
			else echo "<td>".$sum[$j]."</td>";
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
	
	
}





// close the table
function tablefooter(){
	global $ro;
	
	echo '</table>';
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


function dc($table, $c){
	global $link, $sch_num;
	
	$result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c'");
	return mysql_fetch_array($result);
}

function d($table){
	global $link, $sch_num;
	
	$result=mysql_query("select * from $table where sch_num='$sch_num'");
	return mysql_fetch_array($result);
}

function dac($table, $c, $f){
	global $link, $sch_num;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	$result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c'");

	$row=mysql_fetch_array($result);
	
	$sum=0;
	for ($i=0;$i<mysql_num_fields($result);$i++){
		if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;

		if (eregi($f, mysql_field_name($result, $i))) {
			$sum+=$row[mysql_field_name($result, $i)];
		}
	}
	
	return ($sum>0?$sum:'');
}


function da($table, $f){
	global $link, $sch_num;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	$result=mysql_query("select * from $table where sch_num='$sch_num'");

	$row=mysql_fetch_array($result);
	
	$sum=0;
	for ($i=0;$i<mysql_num_fields($result);$i++){
		if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;
		
		if (eregi($f, mysql_field_name($result, $i))) $sum+=$row[mysql_field_name($result, $i)];
		
	}
	
	return ($sum>0?$sum:'');
	
}

function ds($table, $field){
	global $link, $sch_num;
	
	$result=mysql_query("select sum($field) as s from $table where sch_num='$sch_num'");

	$row=mysql_fetch_array($result);
	
	return $row['s'];
}




?>