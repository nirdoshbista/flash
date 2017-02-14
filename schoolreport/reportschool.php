<?php

$nbuffer = array();
function showreport(){
	global $sch_num, $wc, $nbuffer, $currentyear;
	
	$result=mysql_query("select * from mast_schoollist where sch_num=$sch_num;");
	$ginfo=mysql_fetch_array($result);
	
	$result=mysql_query(sprintf('select * from mast_district where dist_code=%s;',$ginfo['dist_code']));
	$temp=mysql_fetch_array($result);
	$districtname=$temp['dist_name'];
	
	$result=mysql_query(sprintf('select * from mast_vdc where dist_code=%s and vdc_code=%s;',$ginfo['dist_code'],$ginfo['vdc_code']));
	$temp=mysql_fetch_array($result);
	$vdcname=$temp['vdc_name_e'];
	
	$result=mysql_query("select * from mast_school_type where sch_num='$sch_num' and sch_year='$currentyear' ");
	$schooltype=mysql_fetch_array($result);
	
	if ($schooltype['ecd']) $ecd=1; else $ecd=0;
	if ($schooltype['class1'])  $primary=1; else $primary=0;
	if ($schooltype['class6']) $lsec=1; else $lsec=0;
	if ($schooltype['class9']) $sec=1; else $sec=0;
	if ($schooltype['class11']) $hsec=1; else $hsec=0;
	
$distinfo['01']=array('Mountain','Eastern','Mechi');
$distinfo['02']=array('Hill','Eastern','Mechi');
$distinfo['03']=array('Hill','Eastern','Mechi');
$distinfo['04']=array('Terai','Eastern','Mechi');
$distinfo['05']=array('Terai','Eastern','Koshi');
$distinfo['06']=array('Terai','Eastern','Koshi');
$distinfo['07']=array('Hill','Eastern','Koshi');
$distinfo['08']=array('Hill','Eastern','Koshi');
$distinfo['09']=array('Mountain','Eastern','Koshi');
$distinfo['10']=array('Hill','Eastern','Koshi');
$distinfo['11']=array('Mountain','Eastern','Sagarmatha');
$distinfo['12']=array('Hill','Eastern','Sagarmatha');
$distinfo['13']=array('Hill','Eastern','Sagarmatha');
$distinfo['14']=array('Hill','Eastern','Sagarmatha');
$distinfo['15']=array('Terai','Eastern','Sagarmatha');
$distinfo['16']=array('Terai','Eastern','Sagarmatha');
$distinfo['17']=array('Terai','Central','Janakpur');
$distinfo['18']=array('Terai','Central','Janakpur');
$distinfo['19']=array('Terai','Central','Janakpur');
$distinfo['20']=array('Hill','Central','Janakpur');
$distinfo['21']=array('Hill','Central','Janakpur');
$distinfo['22']=array('Mountain','Central','Janakpur');
$distinfo['23']=array('Mountain','Central','Bagmati');
$distinfo['24']=array('Hill','Central','Bagmati');
$distinfo['25']=array('Hill','Central','Bagmati');
$distinfo['26']=array('Hill','Central','Bagmati');
$distinfo['27']=array('Hill','Central','Bagmati');
$distinfo['28']=array('Hill','Central','Bagmati');
$distinfo['29']=array('Mountain','Central','Bagmati');
$distinfo['30']=array('Hill','Central','Bagmati');
$distinfo['31']=array('Hill','Central','Narayani');
$distinfo['32']=array('Terai','Central','Narayani');
$distinfo['33']=array('Terai','Central','Narayani');
$distinfo['34']=array('Terai','Central','Narayani');
$distinfo['35']=array('Terai','Central','Narayani');
$distinfo['36']=array('Hill','Western','Gandaki');
$distinfo['37']=array('Hill','Western','Gandaki');
$distinfo['38']=array('Hill','Western','Gandaki');
$distinfo['39']=array('Hill','Western','Gandaki');
$distinfo['40']=array('Hill','Western','Gandaki');
$distinfo['41']=array('Mountain','Western','Gandaki');
$distinfo['42']=array('Mountain','Western','Dhawalagiri');
$distinfo['43']=array('Hill','Western','Dhawalagiri');
$distinfo['44']=array('Hill','Western','Dhawalagiri');
$distinfo['45']=array('Hill','Western','Dhawalagiri');
$distinfo['46']=array('Hill','Western','Lumbini');
$distinfo['47']=array('Hill','Western','Lumbini');
$distinfo['48']=array('Terai','Western','Lumbini');
$distinfo['49']=array('Terai','Western','Lumbini');
$distinfo['50']=array('Terai','Western','Lumbini');
$distinfo['51']=array('Hill','Western','Lumbini');
$distinfo['52']=array('Hill','Mid-western','Rapti');
$distinfo['53']=array('Hill','Mid-western','Rapti');
$distinfo['54']=array('Hill','Mid-western','Rapti');
$distinfo['55']=array('Hill','Mid-western','Rapti');
$distinfo['56']=array('Terai','Mid-western','Rapti');
$distinfo['57']=array('Terai','Mid-western','Bheri');
$distinfo['58']=array('Terai','Mid-western','Bheri');
$distinfo['59']=array('Hill','Mid-western','Bheri');
$distinfo['60']=array('Hill','Mid-western','Bheri');
$distinfo['61']=array('Hill','Mid-western','Bheri');
$distinfo['62']=array('Mountain','Mid-western','Karnali');
$distinfo['63']=array('Mountain','Mid-western','Karnali');
$distinfo['64']=array('Mountain','Mid-western','Karnali');
$distinfo['65']=array('Mountain','Mid-western','Karnali');
$distinfo['66']=array('Mountain','Mid-western','Karnali');
$distinfo['67']=array('Mountain','Far-western','Seti');
$distinfo['68']=array('Mountain','Far-western','Seti');
$distinfo['69']=array('Hill','Far-western','Seti');
$distinfo['70']=array('Hill','Far-western','Seti');
$distinfo['71']=array('Terai','Far-western','Seti');
$distinfo['72']=array('Terai','Far-western','Mahakali');
$distinfo['73']=array('Hill','Far-western','Mahakali');
$distinfo['74']=array('Hill','Far-western','Mahakali');
$distinfo['75']=array('Mountain','Far-western','Mahakali');	
	
?>
<table align="center" border="2" style="border-collapse:none" cellpadding="10" width="100%">
<tr><td>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr align="center" valign="middle"> 
          <td width="100" align="left"><img src="images/npflag.png" width="74" height="90"></td>
          <td><h1 style="font-size:x-large">School Profile (<?php echo $currentyear; ?>)</h1>
              <h2 style="font-size:large">School: <?php echo $ginfo['nm_sch'].'<br><br> Code:  ' .$ginfo['sch_num'].''; ?></h2>
			   
          </td>
          <td width="100" align="right"><img src="images/Nepal_gov_logo.png" width="108" height="90"></td>
</table>
<p>&nbsp;</p>

<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<COL WIDTH=79*>
	<COL WIDTH=3*>
	<COL WIDTH=174*>
	<TR VALIGN=TOP>
		<TD WIDTH=31%>
			
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0>
				<COL WIDTH=78*>
				<COL WIDTH=178*>
				<tr><td colspan="2"><strong>GENERAL INFORMATION</strong></td></tr>
				<TR VALIGN=TOP>
					<TD WIDTH="50%" style="text-align:left">
						<B>Development Region</B>
					</TD>
					<TD WIDTH="50%" style="text-align:left">
						 <?php echo ucwords(strtolower($distinfo[$ginfo['dist_code']][1])); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH="50%" style="text-align:left">
						<B>Eco-belt</B>
					</TD>
					<TD WIDTH="50%" style="text-align:left">
						 <?php echo ucwords(strtolower($distinfo[$ginfo['dist_code']][0])); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Zone</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo ucwords(strtolower($distinfo[$ginfo['dist_code']][2])); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>District</B>
					</TD style="text-align:left">
					<TD style="text-align:left">
						 <?php echo ucwords(strtolower($districtname)); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>VDC</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo ucwords(strtolower($vdcname)); ?>&nbsp;
					</TD>
				</TR>

				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Address</B>
					</TD>
					<TD style="text-align:left">
						 <?php 
							echo ucwords(strtolower($ginfo['location'])); ?>&nbsp;
					</TD>
				</TR>

				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Ward No.</B>
					</TD>
					<TD style="text-align:left">
						 <?php 
							echo ucwords(strtolower($ginfo['wardno'])); ?>&nbsp;
					</TD>
				</TR>

				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Account No.</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo ucwords(strtolower($ginfo['account_no'])); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Locality</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo ($ginfo['region']?'Urban':'Rural'); ?>&nbsp;
					</TD>
				</TR>

				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Phone</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo $ginfo['phone']; ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Email</B>
					</TD>
					<TD style="text-align:left">
						 <?php echo strtolower($ginfo['email']); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD style="text-align:left">
						<B>Resource Center</B>
					</TD>
					<TD style="text-align:left">
						 &nbsp;
					</TD>
				</TR>
			</TABLE>
			<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">
			

		</TD>
		<TD WIDTH=1%>
			
			
		</TD>
		<TD WIDTH=68%>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0>
				<COL WIDTH=83*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<COL WIDTH=35*>
				<tr><td colspan="6"><b>SCHOOL TYPE INFORMATION</b></td></tr>
				<TR VALIGN=TOP>
					<TD WIDTH=32% BGCOLOR="#e6e6e6">
						
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>ECD</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>Primary</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>L.Sec.</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>Sec.</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>H.Sec.</B>
					</TD>
				</TR>
				
				<?php
				if (isset($schooltypename)) unset($schooltypename);
	
				$schooltypename[]="Community (Aided)";
				$schooltypename[]="Community Managed";
				$schooltypename[]="Community (Teacher Aid)";
				$schooltypename[]="Community (Unaided)";
				$schooltypename[]="Institutional (Private Trust)";
				$schooltypename[]="Institutional (Public Trust)";
				$schooltypename[]="Institutional (Enlisted with Company)";
				$schooltypename[]="Madrassa";
				$schooltypename[]="Gumba";
				$schooltypename[]="Ashram";
				$schooltypename[]="Community ECD";
				
				$classtypes=array("ecd","class1","class6","class9","class11");
					
				$i=0;
			  
				foreach($schooltypename as $s){
					$i++;
					printf("<TR>");
					printf("<TD WIDTH=32%% style='text-align:left'>%s</TD>",$s);
					
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
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0 BORDERCOLOR="#000000">
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
    <TD colspan="15" ><div align="center"><b>GRADEWISE STUDENT INFORMATION</b></div></TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% align="left" valign="bottom" BGCOLOR="#e0e0e0" style="text-align:left"><strong>Particulars</strong></TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>ECD</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>1</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>2</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>3</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>4</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>5</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>6</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>7</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>8</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>9</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>10</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>11</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>12</B> </TD>
    <TD WIDTH=6% BGCOLOR="#e0e0e0"> <B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B> </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Total Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecdppc_enroll_f1';
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='hsec_current_details_f1';

				if ($i<=10) ds($t,'tot_enroll_total_t',$i); 
				else ds($t,'tot_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Boys Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecdppc_enroll_f1';
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='hsec_current_details_f1';

				if ($i<=10) ds($t,'tot_enroll_total_m',$i); 
				else ds($t,'tot_m',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Girls Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecdppc_enroll_f1';
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='hsec_current_details_f1';

				if ($i<=10) ds($t,'tot_enroll_total_f',$i); 
				else ds($t,'tot_f',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Dalit Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecdppc_enroll_f1';
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='hsec_current_details_f1';

				if ($i<=10) ds($t,'tot_enroll_dalit_t',$i); 
				else ds($t,'dalit_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Janjati Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecdppc_enroll_f1';
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='hsec_current_details_f1';

				if ($i<=10) ds($t,'tot_enroll_janjati_t',$i); 
				else ds($t,'janjati_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Disabled Enrollment </TD>
    <?php
			for ($i=0;$i<=12;$i++){
		?>
    <TD WIDTH=6%>
      <?php 
				if ($i==0) $t='ecd_disabled_f1';
				if ($i>=1 && $i<=5) $t='pr_disabled_f1';
				if ($i>=6 && $i<=8) $t='lsec_disabled_f1';
				if ($i>=9 && $i<=10) $t='sec_disabled_f1';
				if ($i>=11 && $i<=12) $t='hsec_disabled_f1';

				ds($t,'disabled_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(13); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Repeaters </TD>
			<td rowspan='6' bgcolor="#e0e0e0">&nbsp;</td>

    <?php
			for ($i=1;$i<=12;$i++){
		?>
    <TD WIDTH=6% <?php echo ($i==0?'bgcolor="#e0e0e0"':''); ?>>
      <?php 
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='dummy_table'; // dummy

				ds($t,'tot_rep_total_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
    <TD WIDTH=6%>
      <?php sumoflast(12); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left">New Enrollment </TD>
    <td width=6%>
    
    <?php
		 	$t='new_total_enroll_age_f1';
		 	
		 	$netnewsum=ds($t,'t_l5','1',false)+ds($t,'t_5','1',false)+ds($t,'t_6','1',false)+ds($t,'t_7_9','1',false)+ds($t,'t_g9','1',false);
		 	echo $netnewsum;
	  			  		
		?>
		
	</td>
	<td colspan='11' bgcolor="#e0e0e0">&nbsp</td>
    <TD WIDTH=6%> <?php echo $netnewsum; ?> </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left" <?php echo ($i==0?'bgcolor="#e0e0e0"':''); ?>> Transferred - In</TD>
    <?php
			for ($i=1;$i<=10;$i++){
		?>
    <TD WIDTH=6% <?php echo ($i==0||$i>=11?'bgcolor="#e0e0e0"':''); ?>>
      <?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='dummy_table'; // dummy

				ds($t,'tot_tran_total_t',$i); 
			?>
    </TD>
    <?php 
			}
		?>
		<td colspan="2" bgcolor="#e0e0e0"></td>

    <TD WIDTH=6%>
      <?php sumoflast(10); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Textbooks (full set) </TD>
    <?php
			for ($i=1;$i<=10;$i++){
		?>
    <TD WIDTH=6% <?php echo ($i==0||$i>=11?'bgcolor="#e0e0e0"':''); ?>>
      <?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=10) $t='textbooks_f1';
				if ($i>=11 && $i<=12) $t='dummy_table'; //dummy

				ds($t,'full_students_no',$i); 
			?>
    </TD>
    
    <?php 
			}
		?>
	<td colspan="2" bgcolor="#e0e0e0"></td>		
    <TD WIDTH=6%>
      <?php sumoflast(5); ?>
    </TD>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23%  style="text-align:left"> Sections </TD>
    <?php
			for ($i=1;$i<=10;$i++){
		?>
    <TD WIDTH=6% <?php echo ($i==0||$i>=11?'bgcolor="#e0e0e0"':''); ?>>
      <?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=10) $t='sections';
				if ($i>=11 && $i<=13) $t='dummy_table'; //dummy

				ds($t,'sections',$i); 
			?>
    </TD>
    <?php 
			}
		?>
		<td colspan="3" bgcolor="#e0e0e">&nbsp;</td>
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=23% style="text-align:left"> Teaching Methods </TD>
    <td><?php ds('teaching_method_f1','c1_teaching_method'); ?></td>
    <TD WIDTH=6%><?php ds('teaching_method_f1','c2_teaching_method'); ?></TD>
    <TD WIDTH=6%><?php ds('teaching_method_f1','c3_teaching_method'); ?></TD>
    <TD WIDTH=6%><?php ds('teaching_method_f1','c4_teaching_method'); ?></TD>
    <TD WIDTH=6%><?php ds('teaching_method_f1','c5_teaching_method'); ?></TD>
    <TD colspan="9"> 1=Subject Teaching, 2=Grade Teaching, 3=Multi-Grade Teaching </TD>
  </TR>
</TABLE>
<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">


<?php

//$result=mysql_query("select * from other_physical_f1 where sch_num='$sch_num'");
//$op=mysql_fetch_array($result);

$prevyear = $currentyear - 1;

$result=mysql_query("select * from school_improvement where sch_num='$sch_num' and sch_year='$currentyear'");
$sch_imp=mysql_fetch_array($result);

$result=mysql_query("select * from school_physical where sch_num='$sch_num' and sch_year='$currentyear'");
$ph=mysql_fetch_array($result);

$result = mysql_query("select * from school_program where sch_year='$currentyear' and sch_num='$sch_num'");
$schprog = mysql_fetch_array($result);

$result = mysql_query("select * from school_calendar where sch_year='$currentyear' and sch_num='$sch_num'");
$schcal = mysql_fetch_array($result);

$result = mysql_query("select * from school_textbook where sch_year='$currentyear' and sch_num='$sch_num'");
$schtext = mysql_fetch_array($result);

$result = mysql_query("select * from non_teaching_staff where sch_year='$currentyear' and sch_num='$sch_num'");
$nonstaffs = mysql_fetch_array($result);

$result = mysql_query("select * from inf_sch_pta where sch_year='$currentyear' and sch_num='$sch_num'");
$ptainfo = mysql_fetch_array($result);

$result = mysql_query("select * from inf_sch_smc where sch_year='$currentyear' and sch_num='$sch_num'");
$smcinfo = mysql_fetch_array($result);
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
            <td width="56%">
            <table width="100%" border="1" bordercolor="#000" cellspacing="0" cellpadding="4">
            <tr>
              <td colspan="6"><b>PHYSICAL AND OTHER INFORMATIONS</b></td>
            </tr>
              <tr> 
                <td width="23%" style="text-align:left">No. of Buildings</td>
                <td width="10%"><?php echo $sch_imp['new_building_deo']+$sch_imp['new_building_local']+$sch_imp['new_building_others']; ?></td>
                <td width="19%" style="text-align:left">Water</td>
                <td width="12%"><?php 
                	$watersource = array();
                	if ($ph['water_tap']==1) $watersource[]='Tap';
                	if ($ph['water_tubewell']==1) $watersource[]='TubeWell';
                	if ($ph['water_well']==1) $watersource[]='Well';
                	if ($ph['water_other']==1) $watersource[]='Others';
                	echo implode(", ",$watersource);
                ?></td>
                <td width="22%" style="text-align:left">Urinal</td>
                <td width="14%"><?php echo ync($ph['urinal']); ?></td>
              </tr>
              <tr> 
                <td style="text-align:left">No. of Rooms</td>
                <td><?php $ph['classrooms']=$ph['classroom_rigid']+$ph['classroom_weak']; if ($ph['classrooms']>0) echo $ph['classrooms']; ?></td>
                <td style="text-align:left">Health Facilities </td>
                <td><?php 
                		if ($schprog['health_distance']==0) echo "N/A";
                		if ($schprog['health_distance']==1) echo "< 1 hr walk";
                		if ($schprog['health_distance']==2) echo "1 hr walk";
                		if ($schprog['health_distance']==3) echo "> 1 hr walk";
                		
                	?>
                </td>
                <td style="text-align:left">Urinal for Girls </td>
                <td><?php echo ync($ph['urinal_girls']); ?></td>
              </tr>

              <tr> 
                <td style="text-align:left">No. of Computers</td>

<td width="10%"><?php echo $ph['admin_computers']+$ph['teaching_computers']+$ph['other_computers']; ?></td>
                <td style="text-align:left">Compound</td>
                <td><?php 
                		if ($ph['cstatus']==0) echo "No";
                		if ($ph['cstatus']==1) echo "Rigid Wall";
                		if ($ph['cstatus']==2) echo "Weak Wall";
                		if ($ph['cstatus']==3) echo "Barbed Wire";
                		if ($ph['cstatus']==4) echo "Pledge";
                		
                	?></td>
                <td style="text-align:left">Urinal for Teachers </td>
                <td><?php echo ync($ph['urinal_teachers']); ?></td>
              </tr>
              <tr> 
                <td style="text-align:left">Inadequate Rooms</td>
                <td><?php echo $ph['additional_rooms_num']; ?></td>
  
                <td style="text-align:left">Electricity </td>
                <td><?php echo ync($ph['electricity']); ?></td>
                <td style="text-align:left">SIP - SIP Update</td>
                <td><?php echo $schprog['school_improve_plan']==1?'Yes':'No', '-',$schprog[school_improve_plan_date_updated]; ?></td>
              </tr>
              <tr> 
                <td style="text-align:left">Rooms to Rehabilitate</td>
                <td><?php echo $ph['reconstruction_rooms_num']; ?></td>
                <td style="text-align:left">Library</td>

                <td><?php echo ync($schtext['library_pri']); ?>
                </td>


                <td style="text-align:left">Social Audit </td>
                <td><?php echo $schprog[social_audit_year],"-",$schprog[social_audit_month],"-",$schprog[social_audit_day]; ?></td>
              </tr>              
              <tr> 
                <td style="text-align:left">Usable Desks/Benches</td>
                <td><?php echo $ph['usable_desk_students']; ?></td>
                <td style="text-align:left">Playground</td>
                <td><?php echo ync($ph['pground']); ?></td>
                <td style="text-align:left">Financial Audit </td>
                <td><?php echo $schprog['public_disclose_acc_year'],"-",$schprog[public_disclose_acc_month],"-",$schprog[public_disclose_acc_day]; ?></td>
              </tr>
              <tr> 
                <td style="text-align:left">Inadequate Desk/Benches</td>
                <td><?php echo $ph['inadequate_desk_students']; ?></td>
                <td style="text-align:left">Internet Facility</td>
                <td><?php echo ync($ph['internet']); ?></td>
                <td style="text-align:left">School Calendar</td>
                <td><?php echo $schprog['sch_oper_cal']==1?'Yes':'No'; ?></td>
              </tr>
			  <tr> 
                <td style="text-align:left">Non Teaching Staffs </td>
                <td><?php echo $nonstaffs['account_t']+$nonstaffs['admin_t']+$nonstaffs['other_t']; ?> </td>

                <td style="text-align:left">Toilet</td>
                <td><?php echo ync($ph['toilet']); ?></td>

                <td style="text-align:left">PTA</td>
                <td><?php echo ($ptainfo['pta_year']?'Yes':'No'); ?></td>                
              </tr>
              <tr>
                <td style="text-align:left">No. of External Monitoring</td>
                <td><?php echo $schprog['monitor_rp']+$schprog['monitor_ss']+$schprog['monitor_gco']+$schprog['monitor_deo']+$schprog['monitor_others']; ?></td>
                <td style="text-align:left">Toilet for Girls</td>
                <td><?php echo ync($ph['t_girls']); ?></td>
                <td style="text-align:left">SMC</td>
                <td><?php echo ($smcinfo['smc_year']?'Yes':'No'); ?></td>
              </tr>
              <tr> 
                <td style="text-align:left">First Aid Kit </td>
			<td><?php echo ync($schprog['first_aid']); ?></td>
                <td style="text-align:left">Toilet for Teachers</td>
                <td><?php echo ync($ph['t_teachers']); ?></td>
                <td style="text-align:left">Child Club</td>
                <td><?php echo ync($schprog['children_club']); ?></td>
              </tr>
			<tr> 
                <td style="text-align:left">Days School Opened </td>
			<td><?php echo ($schcal['open_days_actual']); ?></td>
                <td bgcolor="#e0e0e0" colspan="4"</td>
              </tr>
			  
         
            </table></td>
            <td width="1%"></td>
          <td width="43%">
          
		  

            <table width="100%" border="1" bordercolor="#000" cellspacing="0" cellpadding="4">
              <tr>
                <td colspan="4"><b>FINANCIAL INFORMATION</b></td>
              </tr>
              <tr bgcolor="#e0e0e0"> 
                <td colspan="2"><div align="center"><font color="#000000"><strong> Income</strong></font></div></td>
                <td colspan="2"><div align="center"><font color="#000000"><strong>Expenditure</strong></font></div></td>
              </tr>
              <tr> 
                <td width="35%" style="text-align:left">Salary (App. Position)</td>
                <td width="15%"><?php $si=0; $i=ds('finance_income_f1','teacher_salary_darbandi'); $si+=$i;?></td>
                <td width="35%" style="text-align:left">Salary (App. Position)</td>
                <td width="15%"><?php $se=0; $e=ds('finance_expenditure_f1','teacher_salary_darbandi'); $se+=$e; ?></td>
              </tr>              
              <tr> 
                <td width="35%" style="text-align:left">Salary (Rahat)</td>
                <td width="15%"><?php $i=ds('finance_income_f1','rahat_teacher_salary'); $si+=$i;?></td>
                <td width="35%" style="text-align:left">Salary (Rahat)</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','rahat_teacher_salary'); $se+=$e; ?></td>
              </tr>     
			<tr> 
                <td width="35%" style="text-align:left">Salary (PCF)</td>
                <td width="15%"><?php $i=ds('finance_income_f1','pcf_salary'); $si+=$i;?></td>
                <td width="35%" style="text-align:left">Salary (PCF)</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','pcf_salary'); $se+=$e; ?></td>
              </tr>			  
              <tr> 
                <td width="35%" style="text-align:left">Scholarship Grant</td>
                <td width="15%"><?php $i=ds('finance_income_f1','girls_scholarship','',false)+ds('finance_income_f1','dalit_scholarship','',false)+ds('finance_income_f1','disadvantaged_scholarship','',false); echo $i; $si+$i;?></td>
                <td width="35%" style="text-align:left">Scholarship Grant</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','girls_scholarship','',false)+ds('finance_income_f1','dalit_scholarship','',false)+ds('finance_income_f1','disadvantaged_scholarship','',false); echo $e; $se+$e;?></td>
              </tr>              
              <tr> 
                <td width="35%" style="text-align:left">Textbook Grant</td>
                <td width="15%"><?php $i=ds('finance_income_f1','text_books_fund'); $si+=$i;?></td>
                <td width="35%" style="text-align:left">Textbook Grant</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','text_books'); $se+=$e; ?></td>
              </tr>              
              <tr> 
                <td width="35%" style="text-align:left">Grants (Other Activities)</td>
                <td width="15%"><?php $i=ds('finance_income_f1','school_management_fund','',false)+ds('finance_income_f1','stationary_fund','',false)+ds('finance_income_f1','library_and_computer_fund','',false)+ds('finance_income_f1','sip_preparation_fund','',false)+ds('finance_income_f1','financial_social_audit_fund','',false)+ds('finance_income_f1','incentive_fund','',false)+ds('finance_income_f1','capacity_development_fund','',false)+ds('finance_income_f1','day_meal_development_fund','',false); echo $i; $si+=$i;?></td>
                <td width="35%" style="text-align:left">Grants (Other Activities)</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','school_management','',false)+ds('finance_expenditure_f1','stationary','',false)+ds('finance_expenditure_f1','library_computer','',false)+ds('finance_expenditure_f1','sip_preparation','',false)+ds('finance_expenditure_f1','financial_and_social_audit','',false)+ds('finance_expenditure_f1','incentive','',false)+ds('finance_expenditure_f1','capacity_development','',false)+ds('finance_expenditure_f1','day_meal_development','',false); echo $e; $se+=$e; ?></td>
              </tr>              
              <tr> 
                <td width="35%" style="text-align:left">Grants (Physical Infrastructure)</td>
                <td width="15%"><?php $i=ds('finance_income_f1','new_building_construction_fund','',false)+ds('finance_income_f1','new_class_room_construction_fund','',false)+ds('finance_income_f1','school_building_rehabilitation_fund','',false)+ds('finance_income_f1','class_room_rehabilitation_fund','',false)+ds('finance_income_f1','external_environment_improvement_fund','',false); echo $i; $si+=$i;?></td>
                <td width="35%" style="text-align:left">Grants (Physical Infrastructure)</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','new_building_construction','',false)+ds('finance_expenditure_f1','new_class_room_construction','',false)+ds('finance_expenditure_f1','school_building_rehabilitation','',false)+ds('finance_expenditure_f1','class_room_rehabilitation','',false)+ds('finance_expenditure_f1','toilet_construction_girls_boys','',false)+ds('finance_expenditure_f1','girls_toilet_construction','',false); echo $e; $se+=$e; ?></td>
              </tr>              
              <tr> 
                <td width="35%" style="text-align:left">Other Govt. Grants</td>
                <td width="15%"><?php $i=ds('finance_income_f1','government_other_funds'); $si+=$i;?></td>
                <td width="35%" style="text-align:left">Other Govt. Grants</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1',''); $se+=$e; ?></td>
              </tr>
			<tr> 
                <td width="35%" style="text-align:left">Fees/Interest/External Support</td>
                <td width="15%"><?php $i=ds('finance_income_f1','monthly_fees','',false)+ds('finance_income_f1','admission_yearly_fees','',false)+ds('finance_income_f1','internal_income_service_fees','',false)+ds('finance_income_f1','investment_interest','',false)+ds('finance_income_f1','external_support','',false); echo $i; $si+=$i;?></td>   
				<td width="35%" style="text-align:left">Exam/Extra Curricular Activities</td>
                <td width="15%"><?php $e=ds('finance_expenditure_f1','examination_conduction','',false)+ds('finance_expenditure_f1','extra_curricular_activities','',false)+ds('finance_expenditure_f1','miscellaneous','',false)+ds('finance_expenditure_f1','other_activities1','',false)+ds('finance_expenditure_f1','other_activities2','',false); echo $e; $se+=$e;?></td>  				
              <tr> 
                <td bgcolor="#e0e0e0" width="35%" style="text-align:left"><b>Total</b></td>
                <td bgcolor="#e0e0e0" width="15%"><?php echo $si; ?></td>
                <td bgcolor="#e0e0e0" width="35%" style="text-align:left"><b>Total</b></td>
                <td bgcolor="#e0e0e0" width="15%"><?php echo $se; ?></td>
              </tr>
                           
            </table></td>
  </tr>
</table>
<br>

<!-- TEACHERS -->

<style>
.ewTableHeader td{
	font-weight: bold;
	
}

td.disabled{
	background-color: #e6e6e6;
}
</style>

<?php

$total_teachers = array();

?>

<table WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0 BORDERCOLOR="#000000">
	<tr class='ewTableHeader'>
		<td colspan="25">TEACHERS</td>
	</tr>
	<tr class="ewTableHeader">
		<td rowspan="2">Type</td>
		<td colspan="6">Primary</td>
		<td colspan="6">L.Sec.</td>
		<td colspan="6">Sec.</td>
		<td colspan="6">H.Sec.</td>
	</tr>
	<tr class="ewTableHeader">
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
		
		<td>T</td>
		<td>F</td>
		<td>M</td>
		<td>Dalit</td>
		<td>Janjati</td>
		<td>Disabled</td>
	</tr>

	<?php
	

		
		foreach (array("approved","permanent","temporary","rahat","private","total") as $type){
			echo "<tr>\n";
			
			echo "<td><b>".ucwords($type)."</b></td>";
			foreach (array(1,2,3,4) as $level){
				
				$result=mysql_query("select * from teachers where sch_num='$sch_num' and sch_year='$currentyear' and type='$type' and level='$level'");
				$r=mysql_fetch_array($result);	
				foreach (array("total","female", "male","dalit","janjati","disabled") as $category){

					$id = "{$type}_{$category}[$level]";
					
					
					$disabled = "";
					
					if ($type!='approved' && ($category=='total' || $type=='total')) $disabled="disabled"; 
					else{
						if ($type=='approved' && ($category=='male' || $category=='female' || $category=='dalit' || $category=='janjati' || $category=='disabled'))
							$disabled="disabled"; 
						else $disabled="";
					}
				
					if ($type=='total' || $category=='total') $disabled='';
					
					//echo "<td><input $disabled name=\"$id\" type=\"text\" onkeypress=\"return forceNumberInput(this, event);\" onchange=\"handleChange(this);\" id=\"$id\" size=\"3\" maxlength=\"3\"></td>\n";
					
					//$disabled = "";
					echo "<td class='$disabled'>{$r[$category]}</td>\n";
					
					if ($type=='total' && $category=='total'){
						$total_teachers[$level] = $r[$category];
					}
					
					
				}
			}
			
			echo "</tr>\n";
		}
	
	
	?>

</table>


<br>
<TABLE WIDTH=100% BORDER=1 CELLPADDING=4 CELLSPACING=0 BORDERCOLOR="#000000">
  <tr>
    <td colspan="28"><strong>AGEWISE STUDENT INFORMATION </strong></td>
  </tr>
  <TR VALIGN=TOP>
    <TD WIDTH=19% rowspan="3" align="center" valign="middle" BGCOLOR="#e6e6e6"><strong>Status</strong></TD>
    <TD colspan="9" BGCOLOR="#e6e6e6"><b>Class 1</b></TD>
    <TD colspan="9" BGCOLOR="#e6e6e6"><b>Class 2 </b></TD>
    <TD colspan="9" BGCOLOR="#e6e6e6"><b>Class 1-5 </b></TD>
  </TR>
  <TR VALIGN=TOP>
    <TD colspan="3" BGCOLOR="#e6e6e6"><B>Total</B> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Dalit</b> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Janjati</b> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><B>Total</B> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Dalit</b> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Janjati</b> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><B>Total</B> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Dalit</b> </TD>
    <TD colspan="3" BGCOLOR="#e6e6e6"><b>Janjati</b> </TD>    
  </TR>
  <TR VALIGN=TOP>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD WIDTH=3% BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>F</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><b>M</b> </TD>
    <TD width="3%" BGCOLOR="#e6e6e6"><strong>T</strong></TD>
  </TR>
  <TR VALIGN=TOP>
    <TD style="text-align:left"> Total </TD>
    <TD><?php echo dac('pr_total_enroll_age_f1',1,'f_'); ?></TD>
    <TD><?php echo dac('pr_total_enroll_age_f1',1,'m_'); ?></TD>
    <td><?php echo dac('pr_total_enroll_age_f1',1,'t_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',1,'f_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',1,'m_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',1,'t_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',1,'f_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',1,'m_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',1,'t_'); ?></td>
    <td><?php echo dac('pr_total_enroll_age_f1',2,'f_'); ?></td>
    <td><?php echo dac('pr_total_enroll_age_f1',2,'m_'); ?></td>
    <td><?php echo dac('pr_total_enroll_age_f1',2,'t_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',2,'f_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',2,'m_'); ?></td>
    <td><?php echo dac('pr_dalit_enroll_age_f1',2,'t_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',2,'f_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',2,'m_'); ?></td>
    <td><?php echo dac('pr_janjati_enroll_age_f1',2,'t_'); ?></td>
    <td><?php echo dacgs('pr_total_enroll_age_f1','','f_'); ?></td>
    <td><?php echo dacgs('pr_total_enroll_age_f1','','m_'); ?></td>
    <td><?php echo dacgs('pr_total_enroll_age_f1','','t_'); ?></td>
    <td><?php echo dacgs('pr_dalit_enroll_age_f1','','f_'); ?></td>
    <td><?php echo dacgs('pr_dalit_enroll_age_f1','','m_'); ?></td>
    <td><?php echo dacgs('pr_dalit_enroll_age_f1','','t_'); ?></td>
    <td><?php echo dacgs('pr_janjati_enroll_age_f1','','f_'); ?></td>
    <td><?php echo dacgs('pr_janjati_enroll_age_f1','','m_'); ?></td>
    <td><?php echo dacgs('pr_janjati_enroll_age_f1','','t_'); ?></td>
   </TR>
  <TR VALIGN=TOP>
    <TD style="text-align:left"> Under Age </TD>
    <TD><?php echo dac('pr_total_enroll_age_f1',1,'f_l.*'); ?></TD>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'t_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'f_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'t_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'f_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'t_l.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'f_l.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'t_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'f_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'t_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'f_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'m_l.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'t_l.*'); ?></td>
    <TD><?php echo dacgs('pr_total_enroll_age_f1','','f_l.*'); ?></TD>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','m_l.*'); ?></td>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','t_l.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','f_l.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','m_l.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','t_l.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','f_l.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','m_l.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','t_l.*'); ?></td>
  </TR>
  <TR VALIGN=TOP>
    <TD style="text-align:left"> Correct Age </TD>
    <TD><?php echo dac('pr_total_enroll_age_f1',1,'f_[0-9]'); ?></TD>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'t_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'f_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'t_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'f_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'t_[0-9]'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'f_[0-9]'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'t_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'f_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'t_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'f_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'m_[0-9]'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'t_[0-9]'); ?></td>
    <TD ><?php echo dacgs('pr_total_enroll_age_f1','','f_[0-9]'); ?></TD>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','m_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','t_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','f_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','m_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','t_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','f_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','m_[0-9]'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','t_[0-9]'); ?></td>
  </TR>
  <TR VALIGN=TOP>
    <TD style="text-align:left"> Over Age </TD>
    <TD><?php echo dac('pr_total_enroll_age_f1',1,'f_g.*'); ?></TD>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',1,'t_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'f_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',1,'t_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'f_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',1,'t_g.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'f_g.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_total_enroll_age_f1',2,'t_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'f_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_dalit_enroll_age_f1',2,'t_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'f_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'m_g.*'); ?></td>
    <td ><?php echo dac('pr_janjati_enroll_age_f1',2,'t_g.*'); ?></td>
    <TD><?php echo dacgs('pr_total_enroll_age_f1','','f_g.*'); ?></TD>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','m_g.*'); ?></td>
    <td ><?php echo dacgs('pr_total_enroll_age_f1','','t_g.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','f_g.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','m_g.*'); ?></td>
    <td ><?php echo dacgs('pr_dalit_enroll_age_f1','','t_g.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','f_g.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','m_g.*'); ?></td>
    <td ><?php echo dacgs('pr_janjati_enroll_age_f1','','t_g.*'); ?></td>
  </TR>
</TABLE>
<br>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0>
	<TR>
	<TD colspan="13"><B>INDICATORS AND COMPARATIVE INFORMATION </B></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22% rowspan="2" align="center" valign="middle" BGCOLOR="#e6e6e6">
			<B> Levels </B>
			
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Student Teacher Ratio</B>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Promotion Rate (in %)</B>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Repetition Rate (in %)</B>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pri.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>L.Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>H.Sec.</B>
			
		</TD>
		
		
				<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pri.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>L.Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>H.Sec.</B>


		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pri.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>L.Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Sec.</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>H.Sec.</B>
		</TD>		

	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22% style="text-align:left">
			School
		</TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),$total_teachers[1])?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),$total_teachers[2])?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),$total_teachers[3])?></TD>
		<TD WIDTH=5%><?php dp(ds('hsec_current_details_f1','tot_t','',false),$total_teachers[4])?></TD>

		<TD WIDTH=5%><?php dp(ds('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('hsec_last_exam_details_f1','tot_pass_t','',false)*100,ds('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>
		<td bgcolor="#e0e0e0"></td>
	</TR>
	
<?php

foreach (array(1,2,3,4) as $level){
	
	$vdc_code = substr($sch_num, 0, 5);
	$result=mysql_query("select sum(total) as total from teachers where sch_num LIKE '$vdc_code%' and sch_year='$currentyear' and type='total' and level='$level'");
	$r=mysql_fetch_array($result);		
	
	$total_teachers[$level] = $r['total'];		
}

?>	
	
	
	<TR VALIGN=TOP>
		<TD WIDTH=22% style="text-align:left">
			VDC
		</TD>
		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),$total_teachers[1])?></TD>
		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),$total_teachers[2])?></TD>
		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),$total_teachers[3])?></TD>
		<TD WIDTH=5%><?php dp(dsv('hsec_current_details_f1','tot_t','',false),$total_teachers[4])?></TD>
		
		<TD WIDTH=5%><?php dp(dsv('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,dsv('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsv('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,dsv('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsv('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,dsv('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsv('hsec_last_exam_details_f1','tot_pass_t','',false)*100,dsv('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,dsv('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,dsv('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsv('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,dsv('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>
		<td bgcolor="#e0e0e0"></td>

	</TR>
<?php

foreach (array(1,2,3,4) as $level){
	
	$dist_code = substr($sch_num, 0, 2);
	$result=mysql_query("select sum(total) as total from teachers where sch_num LIKE '$dist_code%' and sch_year='$currentyear' and type='total' and level='$level'");
	$r=mysql_fetch_array($result);		
	$total_teachers[$level] = $r['total'];	
}

?>	
	
	
	
	<TR VALIGN=TOP>
		<TD WIDTH=22% style="text-align:left">
			District
		</TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),$total_teachers[1])?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),$total_teachers[2])?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),$total_teachers[3])?></TD>
		<TD WIDTH=5%><?php dp(dsd('hsec_current_details_f1','tot_t','',false),$total_teachers[4])?></TD>

		<TD WIDTH=5%><?php dp(dsd('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('hsec_last_exam_details_f1','tot_pass_t','',false)*100,dsd('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>

		<td bgcolor="#e0e0e0"></td>	
	</TR>
	
<?php
$nationaldata = "national".$_GET['yr'].".php";
include($nationaldata);
?>
	<TR VALIGN=TOP>
		<TD WIDTH=22% style="text-align:left">
			National
		</TD>
		<TD WIDTH=5%><?php print STUDENT_TEACHER_RATIO_PRI; ?></TD>
		<TD WIDTH=5%><?php print STUDENT_TEACHER_RATIO_LSEC; ?></TD>
		<TD WIDTH=5%><?php print STUDENT_TEACHER_RATIO_SEC; ?></TD>
		<TD WIDTH=5%>-</TD>

		<TD WIDTH=5%><?php print PROMOTION_RATE_PRI; ?></TD>
		<TD WIDTH=5%><?php print PROMOTION_RATE_LSEC; ?></TD>
		<TD WIDTH=5%><?php print PROMOTION_RATE_SEC; ?></TD>
		<TD WIDTH=5%><?php print PROMOTION_RATE_HSEC; ?></TD>

		<TD WIDTH=5%><?php print REPETITION_RATE_PRI; ?></TD>
		<TD WIDTH=5%><?php print REPETITION_RATE_LSEC; ?></TD>
		<TD WIDTH=5%><?php print REPETITION_RATE_SEC; ?></TD>
		<td bgcolor="#e0e0e0"></td>

	</TR>
</TABLE>

<center><br>(c) District Education Office, <?php echo $districtname; ?><br>Source: Flash <?php echo $currentyear-1; echo '-'; echo $currentyear; ?></center>

</td></tr>
</table>

<style>
.photo{float: left;}
</style>

<?php

	global $link;
	
	$result = mysql_query("SELECT id, description FROM photos_f1 WHERE sch_num='$sch_num'");
	if (@mysql_num_rows($result)>0){
		while ($row = mysql_fetch_assoc($result)){
			echo "<div class='photo'>";
			echo "<img src='../flash1/photo.php?get&id={$row['id']}' height='240' width='320' title='{$row['description']}' />";
			echo "<br>",$row['description'];
			echo "</div>";
		}
		echo "<div style='clear:both;'></div>";
	}		
	
}

function ds($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer;
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wc";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function sumoflast($n){
	global $nbuffer;
	$sum = 0;
	$c = count($nbuffer);
	
	for ($i=1;$i<=$n;$i++){
		$sum += $nbuffer[$c-$i];
	}
	$nbuffer[]=$sum;
	echo $sum;
	return $sum;
}

function ync($o){  // yes no convert
	if ($o==0) echo '&nbsp;';
	if ($o==1) echo 'Yes';
	if ($o==2) echo 'No';
	if ($o>=3) echo 'Yes';

}

function dac($table, $c, $f){
	global $link, $sch_num, $currentyear;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	$result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c' and sch_year='$currentyear'");

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

function dacgs($table, $c, $f){
	global $link, $sch_num, $currentyear;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	if ($c!='') $result=mysql_query("select * from $table where sch_num='$sch_num' and class='$c' and sch_year='$currentyear'");
	else $result=mysql_query("select * from $table where sch_num='$sch_num' and sch_year='$currentyear'");
	
	$grandtotal = 0;
	while ($row=mysql_fetch_array($result)){
		$sum=0;
		for ($i=0;$i<mysql_num_fields($result);$i++){
			if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;
	
			if (eregi($f, mysql_field_name($result, $i))) {
				$sum+=$row[mysql_field_name($result, $i)];
			}
		}
		$grandtotal += $sum;
	}

	return ($grandtotal>0?$grandtotal:'');
}

function dp($a,$b){ // divide and print
	if ($b==0) echo '-';
	else{
		printf("%.0f",$a/$b);
	}
}

function dsv($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcv = " sch_num like '".substr($sch_num,0,5)."%' and sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	$query = "select sum($field) as s from $table where $wcv";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function dsd($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcd = " sch_num like '".substr($sch_num,0,2)."%' and sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcd";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function dsn($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer, $currentyear;
	
	$wcn = " sch_year='$currentyear' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcn";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (@mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['s'];
		$nbuffer[] = $row['s'];
		return $row['s'];
	}
	else{
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}

}

function printifgz($v){
	echo ($v>0?$v:'');
}


?>
