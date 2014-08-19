<?php

// aggregated report


$nbuffer = array();

function showreport(){
	global $sch_num, $wc, $nbuffer, $report_title, $agg_level, $districtname;
	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr align="center"> 
          <td width="100" align="left"><img src="images/npflag.png" width="74" height="90"></td>
          <td><h1>Department of Education</h1>
              <h2>Flash Report - 2007</h2>
            <hr>
          </td>
          <td width="100" align="right"><img src="images/Nepal_gov_logo.png" width="108" height="90"></td>
        </tr>
      </table>

<h2 align="center"><?php echo $report_title; ?></h2>
<br />

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
						<B>Number of Schools</B>
					</TD>
					<TD WIDTH=70%>
						 <?php dc('mast_schoollist'); ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<B>Schools in Rural area</B>
					</TD>
					<TD WIDTH=70%>
						 <?php dc('mast_schoollist','region=1') ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<B>Schools in Flash I</B>
					</TD>
					<TD WIDTH=70%>
						 <?php dc('mast_schoollist','flash_i=1') ?>&nbsp;
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=30%>
						<B>Schools in Flash II</B>
					</TD>
					<TD WIDTH=70%>
						 <?php dc('mast_schoollist','flash_ii=1') ?>&nbsp;
					</TD>
				</TR>
						

			</TABLE>
			<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">
			

		</TD>
		<TD WIDTH=1%>
			
			
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
					printf("<TR>");
					printf("<TD WIDTH=32%%>%s</TD>",$s);
					
					foreach($classtypes as $ct){
						printf("<td width=\"14%%\" align=\"center\">");

						dc('mast_school_type_f1',"$ct=$i");
						
						printf("&nbsp;</td>");
					}
					
					
					printf("</TR>");
					
				}
				  
				  
				?>

			</TABLE>
		</TD>
	</TR>
</TABLE>
<br />
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
			
			
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>ECD</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>1</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>2</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>3</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>4</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>5</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>6</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>7</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>8</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>9</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>10</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>11</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>12</B>
		</TD>
		<TD WIDTH=6% BGCOLOR="#e6e6e6">
			<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=23%>
			Total Enrollment
		</TD>
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
		<TD WIDTH=23%>
			Boys Enrollment
		</TD>
		
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
		<TD WIDTH=23%>
			Girls Enrollment
		</TD>
		
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
		<TD WIDTH=23%>
			Dalit Enrollment
		</TD>
		
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
		<TD WIDTH=23%>
			Janjati Enrollment
		</TD>
		
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
		<TD WIDTH=23%>
			Disabled Enrollment
		</TD>
		
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
		<TD WIDTH=23%>
			Exam appearance
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
			<?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=5) $t='class1_5_enroll_app';
				if ($i>=6 && $i<=8) $t='class6_8_enroll_app';
				if ($i>=9 && $i<=10) $t='class9_10_enroll_app';
				if ($i>=11 && $i<=12) $t='class11_12_enroll_app';

				ds($t,'tot_appeared_exam_total_t',$i); 
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
		<TD WIDTH=23%>
			Repeaters
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
			<?php 
				if ($i==0) $t='dummy_table'; // dummy
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
			<?php sumoflast(13); ?>
			
		</TD>
	</TR>	
	
	<TR VALIGN=TOP>
		<TD WIDTH=23%>
			New Enrollment
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
			<?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=5) $t='enr_rep_mig_class1_5_f1';
				if ($i>=6 && $i<=8) $t='enr_rep_mig_class6_8_f1';
				if ($i>=9 && $i<=10) $t='enr_rep_mig_class9_10_f1';
				if ($i>=11 && $i<=12) $t='dummy_table'; // dummy

				ds($t,'tot_new_enroll_total_t',$i); 
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
		<TD WIDTH=23%>
			New Transfer-in
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
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
		<TD WIDTH=6%>
			<?php sumoflast(13); ?>
			
		</TD>
	</TR>		
	
	<TR VALIGN=TOP>
		<TD WIDTH=23%>
			Scholarship
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
			<?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=5) $t='pr_scholarship';
				if ($i>=6 && $i<=8) $t='lss_scholarship';
				if ($i>=9 && $i<=10) $t='lss_scholarship';
				if ($i>=11 && $i<=12) $t='hsec_scholarship_f1'; // dummy

				if ($i<=10) ds($t,'total',$i); 
				else ds($t,'scholarship_total_t',$i)
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
		<TD WIDTH=23%>
			Textbooks (full set)
		</TD>
		
		<?php
			for ($i=0;$i<=12;$i++){
		?>
		<TD WIDTH=6%>
			
			<?php 
				if ($i==0) $t='dummy_table'; // dummy
				if ($i>=1 && $i<=5) $t='textbooks_f1';
				if ($i>=6 && $i<=12) $t='dummy_table'; //dummy

				ds($t,'full_students_no',$i); 
			?>
			
		</TD>
		<?php 
			}
		?>
		<TD WIDTH=6%>
			<?php sumoflast(13); ?>
			
		</TD>
	</TR>	

</TABLE>
<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">


<?php

$result=mysql_query("select * from other_physical_f1 where sch_num='$sch_num'");
$op=mysql_fetch_array($result);

$result=mysql_query("select * from physical_f1 where sch_num='$sch_num'");
$ph=mysql_fetch_array($result);


?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
            <td><table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
              <tr bgcolor="#e0e0e0"> 
                <td colspan="6"><div align="center"> <span><strong><font color="#000000">Physical 
                    Information</font></strong> </span></div></td>
              </tr>
              <tr> 
                <td width="13%"><strong>No. of Buildings</strong></td>
                <td width="4%"><?php ds('other_physical_f1','num_buildings'); ?></td>
                <td width="11%"><strong>Water </strong></td>
                <td width="4%"><?php dc('physical_f1','water=1'); ?></td>
                <td width="12%">Health Facilities </td>
                <td width="6%"><?php dc('physical_f1','health=1'); ?></td>
              </tr>
              <tr> 
                <td><strong>No. of Rooms</strong></td>
                <td><?php ds('other_physical_f1','num_classrooms'); ?></td>
                <td>Water Source</td>
                <td><?php dc('physical_f1','wstatus>0'); ?></td>
                <td><strong>Urinal</strong></td>
                <td><?php dc('physical_f1','urinal=1'); ?></td>
              </tr>

              <tr> 
                <td><strong>Inadequate Rooms</strong></td>
                <td><?php ds('other_physical_f1','additional_rooms'); ?></td>
                <td><strong>Electricity</strong></td>
                <td><?php dc('physical_f1','electricity=1'); ?></td>
                <td>Urinal for Girls </td>
                <td><?php dc('physical_f1','urinal_girls=1'); ?></td>
              </tr>
              <tr> 
                <td><strong>Rooms to Rehabilitate</strong></td>
                <td><?php ds('other_physical_f1','recons_needed_rooms'); ?></td>
                <td><strong>Playground</strong></td>
                <td><?php dc('physical_f1','pground=1'); ?></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td><strong>Store</strong></td>
                <td><?php dc('other_physical_f1','store=1'); ?></td>
                <td><strong>Toilet</strong></td>
                <td><?php dc('physical_f1','toilet=1'); ?></td>
                <td>Staff Room </td>
                <td><?php echo ync($op['staff_room']); ?></td>
              </tr>
              <tr> 
                <td><strong>Library</strong></td>
                <td><?php dc('other_physical_f1','library=1'); ?></td>
                <td><strong>Toilet for Girls</strong></td>
                <td><?php dc('physical_f1','t_girls=1');?></td>
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
              </tr>
              <tr> 
                <td><strong>Inadequate Desks</strong></td>
                <td><?php ds('other_physical_f1','inadequate_desk_students'); ?></td>
                <td>Toilet for Teachers </td>
                <td><?php dc('physical_f1','t_teachers=1'); ?></td>
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
              </tr>
              <tr> 
                <td>No. of Computers</td>
                <td><?php ds('other_physical_f1','num_computers'); ?></td>
                <td></td>
                <td></td>
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
              </tr>
            </table></td>
          <td width="1%">&nbsp;</td>  
          <td>
          
		  

            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
              <tr bgcolor="#e0e0e0"> 
                <td colspan="2"><div align="center"><font color="#000000"><strong>Income</strong></font></div></td>
                <td colspan="2"><div align="center"><font color="#000000"><strong>Expenditure</strong></font></div></td>
              </tr>
              <tr> 
                <td width="35%">Government Support </td>
                <td width="15%"><?php $si=0; $i=ds('finance_income_f1','govt_support'); $si+=$i;?></td>
                <td width="35%">Salary</td>
                <td width="15%"><?php $se=0; $e=ds('finance_expn_f1','salary'); $se+=$e; ?></td>
              </tr>
		  
              <tr> 
                <td>Scholarship Fund </td>
                <td><?php $i=ds('finance_income_f1','scholarship');  $si+=$i;?></td>
                <td>Scholarship</td>
                <td><?php $e=ds('finance_expn_f1','scholarship'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td>Block Grant </td>
                <td><?php $i=ds('finance_income_f1','block_grant');  $si+=$i;?></td>
                <td>Materials</td>
                <td><?php $e=ds('finance_expn_f1','materials'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td>Other Government Support </td>
                <td><?php $i=ds('finance_income_f1','other_govt_support'); $si+=$i; ?></td>
                <td>School Reconstruction </td>
                <td><?php $e=ds('finance_expn_f1','school_recon'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td>Others</td>
                <td><?php $i=ds('finance_income_f1','others'); $si+=$i; ?></td>
                <td>Student Benefits </td>
                <td><?php $e=ds('finance_expn_f1','student_benefits'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td><strong>Total</strong></td>
                <td><strong><?php echo $si; ?></strong></td>
                <td>Teacher Benefits</td>
                <td><?php $e=ds('finance_expn_f1','teacher_benefits'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
                <td>School Improvement </td>
                <td><?php $e=ds('finance_expn_f1','school_improv'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
                <td>Others</td>
                <td><?php $e=ds('finance_expn_f1','others'); $se+=$e; ?></td>
              </tr>
              <tr> 
                <td bgcolor="#e0e0e0"></td>
                <td bgcolor="#e0e0e0"></td>
                <td><strong>Total</strong></td>
                <td><strong><?php echo $se; ?></strong></td>
              </tr>
            </table></td>
          </tr>
</table>

<p align="center"><B>Teachers Information</B></p>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
	<TR VALIGN=TOP>
		<TD ROWSPAN=3 WIDTH=10% BGCOLOR="#e6e6e6">
			
			
		</TD>
		<TD ROWSPAN=3 WIDTH=4% BGCOLOR="#e6e6e6">
			<B>Appr</B>
		</TD>
		<TD COLSPAN=8 WIDTH=29% BGCOLOR="#e6e6e6">
			<B>Approved Teachers</B>
		</TD>
		<TD ROWSPAN=3 WIDTH=4% BGCOLOR="#e6e6e6">
			<B>Working Total</B>
		</TD>		
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Perm</B>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Temp</B>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Rahat</B>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Private</B>
		</TD>
		
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Full Training</B>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Partial Training</B>
		</TD>
		<TD ROWSPAN=2 COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>No Training</B>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Tot</B>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Dalit</B>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Jan.</B>
		</TD>
		<TD COLSPAN=2 WIDTH=7% BGCOLOR="#e6e6e6">
			<B>Disab.</B>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>F</B>
		</TD>
		<TD WIDTH=4% BGCOLOR="#e6e6e6">
			<B>M</B>
		</TD>
	</TR>

	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			Primary
		</TD>	
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','total_a_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','total_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','total_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','dalit_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','dalit_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','janjati_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','janjati_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','disabled_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','disabled_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','work_total'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','perm_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','perm_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','temp_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','temp_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','grant_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','grant_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','private_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_details_f1','private_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','fully_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','fully_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','part_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','part_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','untrained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('pri_teacher_training_f1','untrained_total_m'); ?></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			L.Sec.
		</TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','total_a_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','total_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','total_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','dalit_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','dalit_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','janjati_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','janjati_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','disabled_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','disabled_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','work_total'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','perm_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','perm_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','temp_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','temp_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','grant_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','grant_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','private_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_details_f1','private_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','fully_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','fully_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','part_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','part_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','untrained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('lsec_teacher_training_f1','untrained_total_m'); ?></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			Sec.
		</TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','total_a_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','total_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','total_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','dalit_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','dalit_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','janjati_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','janjati_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','disabled_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','disabled_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','work_total'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','perm_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','perm_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','temp_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','temp_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','grant_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','grant_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','private_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_details_f1','private_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','fully_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','fully_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','part_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','part_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','untrained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('sec_teacher_training_f1','untrained_total_m'); ?></TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=10%>
			H.Sec.
		</TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','total_a_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','total_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','total_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','dalit_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','dalit_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','janjati_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','janjati_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','disabled_f_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','disabled_m_teachers'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','work_total'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','perm_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','perm_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','temp_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','temp_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','grant_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','grant_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','private_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_details_f1','private_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','fully_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','fully_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','part_trained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','part_trained_total_m'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','untrained_total_f'); ?></TD>
		<TD WIDTH=4%><?php ds('hsec_teacher_training_f1','untrained_total_m'); ?></TD>
	</TR>
</TABLE>

<br>

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
						
						
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<B>1</B>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<B>2</B>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<B>3</B>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<B>4</B>
					</TD>
					<TD WIDTH=12% BGCOLOR="#e6e6e6">
						<B>5</B>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<B>Subject Teaching</B>
					</TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c1_teaching_method=1'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c2_teaching_method=1'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c3_teaching_method=1'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c4_teaching_method=1'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c5_teaching_method=1'); ?></TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<B>Grade Teaching</B>
					</TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c1_teaching_method=2'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c2_teaching_method=2'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c3_teaching_method=2'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c4_teaching_method=2'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c5_teaching_method=2'); ?></TD>					
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=40%>
						<B>Multigrade Teaching</B>
					</TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c1_teaching_method=3'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c2_teaching_method=3'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c3_teaching_method=3'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c4_teaching_method=3'); ?></TD>
					<TD WIDTH=12%><?php dc('teaching_method_f1','c5_teaching_method=3'); ?></TD>				</TR>
			</TABLE>
			<BR>
			<center><B>No. of Sections</B></center>
			<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>
				<COL WIDTH=71*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<COL WIDTH=37*>
				<TR VALIGN=TOP>
					<TD WIDTH=28% BGCOLOR="#e6e6e6">
						<B>Class</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>1</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>2</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>3</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>4</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>5</B>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28%>
						<B>Sections</B>
					</TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','1'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','2'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','3'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','4'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','5'); ?></TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28% BGCOLOR="#e6e6e6"><br>
						
						
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>6</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>7</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>8</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>9</B>
					</TD>
					<TD WIDTH=14% BGCOLOR="#e6e6e6">
						<B>10</B>
					</TD>
				</TR>
				<TR VALIGN=TOP>
					<TD WIDTH=28%><br>
						
						
					</TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','6'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','7'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','8'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','9'); ?></TD>
					<TD WIDTH=14%><?php ds('sections_f1','sections','10'); ?></TD>
				</TR>
			</TABLE>
			
			
		</TD>
		<TD WIDTH=2%>
			
			
		</TD>
		<TD WIDTH=49%>
		
            <table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse: collapse;">
			<tr bgcolor="#e0e0e0">
			    <td colspan="10"><div align="center"><font color="#000000"><strong>Class 
                    1 and 2 Agewise Student Details</strong></font></div></td>
			</tr>
              <tr bgcolor="#e0e0e0"> 
                <td width="19%" rowspan="2"><div align="center"><strong>Age Status</strong></div></td>
                <td colspan="3"><div align="center"><strong>Total</strong></div></td>
                <td colspan="3"><div align="center"><strong>Dalit</strong></div></td>
                <td colspan="3"><div align="center"><strong>Janjati</strong></div></td>
              </tr>
              <tr bgcolor="#e0e0e0"> 
                <td width="7%"><div align="center"><strong>F</strong></div></td>
                <td width="7%"><div align="center"><strong>M</strong></div></td>
                <td width="7%"><div align="center"><strong>T</strong></div></td>
                <td width="7%"><div align="center"><strong>F</strong></div></td>
                <td width="7%"><div align="center"><strong>M</strong></div></td>
                <td width="7%"><div align="center"><strong>T</strong></div></td>
                <td width="7%"><div align="center"><strong>F</strong></div></td>
                <td width="7%"><div align="center"><strong>M</strong></div></td>
                <td width="7%"><div align="center"><strong>T</strong></div></td>
              </tr>
              <tr>
                <td bgcolor="#e0e0e0"><strong>Class 1 Total </strong></td> 
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',1,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',1,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',1,''); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',1,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',1,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',1,''); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',1,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',1,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',1,''); ?></td>
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Under Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'l.*_|_.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'l.*_|_.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'l.*_|_.*l'); ?></td>				
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Correct Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'_[0-9]'); ?></td>
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Over Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',1,'g.*_|_.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',1,'g.*_|_.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',1,'g.*_|_.*g'); ?></td>
              </tr>
              <tr>
                <td bgcolor="#e0e0e0"><strong>Class 2 Total </strong></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',2,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',2,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_total_enroll_age_f1',2,''); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',2,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',2,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_dalit_enroll_age_f1',2,''); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',2,'f_|_f'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',2,'m_|_m'); ?></td>
                <td width="7%" bgcolor="#e0e0e0"><?php echo dac('pr_janjati_enroll_age_f1',2,''); ?></td>
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Under Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'l.*_|_.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'l.*_|_.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'l.*f|f.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'l.*m|m.*l'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'l.*_|_.*l'); ?></td>				
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Correct Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'f_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'m_[0-9]'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'_[0-9]'); ?></td>
              </tr>
              <tr> 
                <td width="19%" class="blue"><strong>Over Age</strong></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_total_enroll_age_f1',2,'g.*_|_.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_dalit_enroll_age_f1',2,'g.*_|_.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'g.*f|f.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'g.*m|m.*g'); ?></td>
                <td width="7%"><?php echo dac('pr_janjati_enroll_age_f1',2,'g.*_|_.*g'); ?></td>
              </tr>
            </table>
		
		</TD>
	</TR>
</TABLE>

<P ALIGN=CENTER><B>Indicators and Comparative Statistics</B>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=1 CELLSPACING=0>

	<TR VALIGN=TOP>
		<TD WIDTH=22% BGCOLOR="#e6e6e6">
			
			
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Student / Teacher</B>
		</TD>
		<TD COLSPAN=4 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Pass Rate</B>
		</TD>
		<TD COLSPAN=3 WIDTH=19% BGCOLOR="#e6e6e6">
			<B>Repetition Rate</B>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22% BGCOLOR="#e6e6e6">
			
			
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pr</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>LS</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>S</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>HS</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pr</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>LS</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>S</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>HS</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>Pr</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>LS</B>
		</TD>
		<TD WIDTH=5% BGCOLOR="#e6e6e6">
			<B>S</B>
		</TD>

	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			<?php echo $report_title; ?>
		</TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),ds('pri_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),ds('lsec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),ds('sec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('hsec_current_details_f1','tot_t','',false),ds('hsec_teacher_details_f1','work_total','',false))?></TD>

		<TD WIDTH=5%><?php dp(ds('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,ds('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('hsec_last_exam_details_f1','tot_pass_t','',false)*100,ds('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(ds('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,ds('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>

	</TR>
<?php

if ($agg_level=='vdc'){

?>
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			District (<?php echo $districtname; ?>)
		</TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),dsd('pri_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),dsd('lsec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),dsd('sec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('hsec_current_details_f1','tot_t','',false),dsd('hsec_teacher_details_f1','work_total','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsd('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,dsd('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('hsec_last_exam_details_f1','tot_pass_t','',false)*100,dsd('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsd('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,dsd('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>

	
	</TR>
	
<?php
}
?>
	
	
	<TR VALIGN=TOP>
		<TD WIDTH=22%>
			National
		</TD>
		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false),dsn('pri_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false),dsn('lsec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false),dsn('sec_teacher_details_f1','work_total','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('hsec_current_details_f1','tot_t','',false),dsn('hsec_teacher_details_f1','work_total','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsn('last_class1_5_enroll_f1','tot_passed_exam_total_t','',false)*100,dsn('last_class1_5_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('last_class6_8_enroll_f1','tot_passed_exam_total_t','',false)*100,dsn('last_class6_8_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('last_class9_10_enroll_f1','tot_passed_exam_total_t','',false)*100,dsn('last_class9_10_enroll_f1','tot_appeared_exam_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('hsec_last_exam_details_f1','tot_pass_t','',false)*100,dsn('hsec_last_exam_details_f1','tot_app_t','',false))?></TD>

		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class1_5_f1','tot_rep_total_t','',false)*100,dsn('enr_rep_mig_class1_5_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class6_8_f1','tot_rep_total_t','',false)*100,dsn('enr_rep_mig_class6_8_f1','tot_enroll_total_t','',false))?></TD>
		<TD WIDTH=5%><?php dp(dsn('enr_rep_mig_class9_10_f1','tot_rep_total_t','',false)*100,dsn('enr_rep_mig_class9_10_f1','tot_enroll_total_t','',false))?></TD>


	</TR>
</TABLE>

<?php
	
}

// data sum
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

	if (mysql_num_rows($result)>0){
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

// data count
function dc($table, $condition='', $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer;
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	if ($condition!='') $query = "select count(sch_num) as c from $table where $wc and $condition";
	else $query = "select count(sch_num) as c from $table where $wc";
	
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);
	
	//echo $query;

	if (mysql_num_rows($result)>0){
		$row=mysql_fetch_array($result);
		if ($print) echo $row['c'];
		$nbuffer[] = $row['c'];
		return $row['c'];
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
}

function dac($table, $c, $f){
	global $link, $sch_num, $wc;
	
	if ($f=='') $f="_f|_m|m_|f_";
	$f="$f";
	
	$result=mysql_query("select * from $table where 1=0");  // get nothing, jus the fields

	// now compute sum(field) for all fields, except sch_num, year and class
	$sumfield=array();
	for ($i=0;$i<mysql_num_fields($result);$i++){
		if (eregi('sch_num|sch_year|class',mysql_field_name($result, $i))) continue;
		else $sumfield[]=sprintf("sum(%s) as %s",mysql_field_name($result, $i),mysql_field_name($result, $i));

	}
	
	$flds = implode(',',$sumfield);
	$result=mysql_query("select $flds from $table where $wc and class='$c'");
	//echo "select $flds from $table where $wc and class='$c'";
	
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

function dp($a,$b){ // divide and print
	if ($b==0) echo '-';
	else{
		printf("%.2f",$a/$b);
	}
}


function dsd($table, $field, $class='',$print=true){
	global $link, $sch_num, $wc, $nbuffer,$dist_code;
	
	$wcd = " sch_num like '$dist_code%' and sch_year='2063' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcd";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (mysql_num_rows($result)>0){
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
	global $link, $sch_num, $wc, $nbuffer;
	
	$wcn = " sch_year='2063' ";
	
	if ($table=='dummy_table'){
		if ($print) echo '&nbsp;';
		$nbuffer[] = 0;
		return '';
	}
	
	
	$query = "select sum($field) as s from $table where $wcn";
	if ($class!='') $query .=" and class='$class'";
	
	$result=mysql_query($query);

	if (mysql_num_rows($result)>0){
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


?>