<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="center" valign="middle">
<td width="100" align="left"><img src="images/npflag.png" width="74" height="90"></td>
<td><h1 style="font-size:x-large">School Id Reporting (<?php echo $currentyear; ?>)</h1>
</td>
<td width="100" align="right"><img src="images/Nepal_gov_logo.png" width="108" height="90"></td>
</table>
<p>&nbsp;</p>

<TABLE  width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0 ALIGN="CENTER">
	<!--<COL WIDTH=100*>-->
	<COL WIDTH=3*>
	<!--<COL WIDTH=174*>-->
	<TR VALIGN=TOP>
	<TD WIDTH=32% align="center">
	<TABLE BORDER=1 BORDERCOLOR="#000000" CELLPADDING=4 CELLSPACING=0 >
		<COL WIDTH=78*>
		<COL WIDTH=178*>
		<tr><td colspan="54"><strong>Statistics</strong></td></tr>
		<tr>
			<td BGCOLOR="#e6e6e6" rowspan="2"><!-- vdc--><b>VDC</b></td>
			<td BGCOLOR="#e6e6e6" rowspan="2"><!-- school number--><b>School Number</b></td>
				<td BGCOLOR="#e6e6e6" rowspan="2"><!-- school name--><b>School Name</b></td>
					<td BGCOLOR="#e6e6e6" rowspan="2"><!-- ward num.--><b>Ward Number</b></td>
						<td BGCOLOR="#e6e6e6" rowspan="2"><!-- location--><b>Location</b></td>

		<?php for($x=0; $x<=12;$x++) { ?>
			<td colspan="3"> <?php
				if($x==0){
						echo 'ECD/PPC';
				}else{
					echo "Class " . $x;
				}
				?>
					</td>
		<?php } ?>
		</tr>
		<TR VALIGN=TOP>
      <?php for($x = 0; $x<=12; $x++){ ?>
			<TD BGCOLOR="#e6e6e6">
			<B>Girls </B>
			</TD>
			<TD BGCOLOR="#e6e6e6">
			<B>Boys</B>
			</TD>
			<TD BGCOLOR="#e6e6e6">
				<B>Total</B>
			</TD>
			<?php } ?>
		</TR>
    <?php


      //$sql = mysql_query("select * from mast_schoollist where dist_code = $D and sch_year=$currentyear;");
			$id = '%';
    if($V==''){
      $sql = mysql_query("select * from mast_schoollist where dist_code = $D and sch_year=$currentyear;");
			$id = $id . $D;
    }else if($S == ''){
      $sql = mysql_query("select * from mast_schoollist where dist_code = $D and vdc_code = $V and sch_year=$currentyear;");
			$id = $id . $D . $V;
    } else {
      $sql = mysql_query("select * from mast_schoollist where dist_code = $D and vdc_code = $V and sch_code = $S and sch_year=$currentyear;");
			$id = $S;
    }
		$id = $id . '%';
		// print_r($id);

		// $student_info_join_table_sql = mysql_query("select id_students_track.reg_id, id_students_track.sch_year, id_students_track.class, id_students_main.gender from id_students_main inner join id_students_track on id_students_track.reg_id = id_students_main.reg_id where id_students_main.sch_num like '%26012%'and id_students_main.gender = 'M' and class <= 0;");
		// $student_info_join_table_result = mysql_num_rows($student_info_join_table_sql);
		// echo $student_info_join_table_result;
		// die();

// $result = mysql_fetch_array($sql);
//     print_r($result);
    while($row = mysql_fetch_array($sql, MYSQL_NUM)) {
    ?>
		<TR VALIGN=TOP>
			<!--<TD WIDTH="35%" style="text-align:left">
			<B><?php //echo $row[4]?></B>
		</TD>-->
			<td>
					<!-- vdc-->
				<?php
							$vdc_query = mysql_query("select * from mast_vdc where dist_code = '$D' and vdc_code = '$row[1]';");
							$vdc_result = mysql_fetch_array($vdc_query);
							echo $vdc_result[2];
			?></td>
			<td><!-- school number--><?php echo $row[12] ?></td>
				<td><!-- school name--><?php echo $row[4] ?></td>
					<td><!-- ward num.--><?php echo $row[5] ?></td>
						<td><!-- location--><?php echo $row[6] ?></td>
      <!--loop starts here -->
      <?php
				for($x = 0; $x<=12; $x++){
					$whereclause = '';
						if ($x <= 0 ){
							$whereclause = $whereclause . 'and class <= 0;';
						}else {
							$whereclause = $whereclause . 'and class = ' . $x . ';';
						}
					?>
			<TD  style="text-align:center">
			<B> <!--girls-->
				<?php
				 // echo "select id_students_track.reg_id, id_students_track.sch_year, id_students_track.class, id_students_main.gender from id_students_main inner join id_students_track on id_students_track.reg_id = id_students_main.reg_id where id_students_main.sch_num = '".$row[12]."' and id_students_main.gender = 'F' and id_students_track.sch_year = $currentyear " . $whereclause;
					$girl_info_join_table_sql = mysql_query("select id_students_track.reg_id, id_students_track.sch_year, id_students_track.class, id_students_main.gender from id_students_main inner join id_students_track on id_students_track.reg_id = id_students_main.reg_id where id_students_main.sch_num = '".$row[12]."' and id_students_main.gender = 'F' and id_students_track.sch_year = $currentyear " . $whereclause);
					//$girl_info_join_table_sql = mysql_query("select count(reg_id) from mast_schoollist left join mast_school_type using (sch_num, sch_year) left join id_students_track using (sch_num, sch_year) left join id_students_main using (reg_id) where id_students_track.class=0 and id_students_main.gender='F' and mast_schoollist.flash1=1 and mast_school_type.ecd>0");
					$girl_info_join_table_result = mysql_num_rows($girl_info_join_table_sql);
					echo $girl_info_join_table_result;
				?>
			</B>
			</TD>
			<TD style="text-align:center">
			<B> <!--boys-->
				<?php
						$boy_info_join_table_sql = mysql_query("select id_students_track.reg_id, id_students_track.sch_year, id_students_track.class, id_students_main.gender from id_students_main inner join id_students_track on id_students_track.reg_id = id_students_main.reg_id where id_students_main.sch_num = '".$row[12]."' and id_students_main.gender = 'M' and id_students_track.sch_year = $currentyear " . $whereclause);
						$boy_info_join_table_result = mysql_num_rows($boy_info_join_table_sql);
						echo $boy_info_join_table_result;
					?>
			</B>
			</TD>
			<TD style="text-align:center">
			<B> <!--total -->
					<?php echo $boy_info_join_table_result + $girl_info_join_table_result; ?>
			</B>
			</TD>

			<?php } ?>
      <!-- loop stops here -->
		</TR>
    <?php } ?>
	</TABLE>
		<P CLASS="western" ALIGN=LEFT STYLE="margin-bottom: 0in">
		</TD>
		<TD WIDTH=1%>
		</TD>
		</table>
</table>
