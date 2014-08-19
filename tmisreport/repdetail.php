<?php

require_once("../includes/vars.php");
require_once('../includes/dbfunctions.php');

$link = dbconnect();

$sch_num=$_GET['s'];
$sch_year=$_GET['y'];

$query = "select tmis_main.tid as tid, tmis_main.t_name as t_name from 
			tmis_main left join 
				(select tid, sch_year, appoint_level, appoint_rank, 
				appoint_position, max(dec_year), dec_month, dec_day, 
				appoint_type from tmis_sec2 group by tid) as t2 
			on (tmis_main.tid=t2.tid and tmis_main.sch_year=t2.sch_year)"; 
			
$where_clause = " WHERE tmis_main.tid LIKE '$sch_num%' ORDER BY tid";

$result = mysql_query($query.$where_clause);

$tids = array();

while ($row = mysql_fetch_assoc($result)){
	$tids[$row['tid']] = $row['t_name'];
}

?>
<html>
<body>
<table border=1>
	<tr>
		<td>S.No.</td>
		<td>Name</td>
		<td>DOB</td>
		<td>Appointment Date</td>
		<td>Retirement Year</td>
		<td>Level</td>
		<td>Rank</td>
		<td>Num of Income Sources</td>
		<td>Salary Scale</td>
		<td>Grade Amount</td>
		<td>Allowance</td>
		<td>Remote Allowance</td>
		<td>Providend Fund</td>
		<td>Grand Total</td>
	</tr>
	
	<?php 
	
	$levels = array("", "Pri", "LSec", "Sec");
	$ranks = array("", "1st", "2nd", "3rd");
	
	foreach ($tids as $tid=>$t_name){
		$data = array();
		
		$data["Teacher ID"] = $tid;
		$data["Name"] = $t_name;
		
		// tmis_sec1
		$result = mysql_query("SELECT * FROM tmis_sec1 WHERE tid='$tid' AND sch_year='$sch_year' LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		if ($row['bs_dob_year1']!=''){
			$data["DOB"] = $row['bs_dob_year1'].'/'.$row['bs_dob_month1'].'/'.$row['bs_dob_day1'];
			$ry = (int)($row['bs_dob_year1'])+60;
		}
		else {
			$data["DOB"] = "";
			$ry = "";
		}		
		
		// tmis_sec2
		$result = mysql_query("SELECT * FROM tmis_sec2 WHERE tid='$tid' AND sch_year='$sch_year' ORDER BY dec_year DESC, dec_month DESC, dec_day DESC LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		
		if ($row['dec_year']!=''){
			$data["Appointment Date"] = $row['dec_year'].'/'.$row['dec_month'].'/'.$row['dec_day'];
		}
		else $data["Appointment Date"] = '';
		
		$data["Retirement Year"]  = $ry;		
				
		$data["Level"] = $levels[$row['appoint_level']];
		$data["Rank"] = $ranks[$row['appoint_rank']];
		

		
		// tmis_inc	
		
		$result = mysql_query("SELECT count(tid) as c FROM tmis_inc WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		$n = $row["c"];
		if ($n==0) $n="";
		$data["n"] = $n;
		
		
		$result = mysql_query("SELECT sum(scale) as scale, sum(grade) as grade, sum(ta) as ta, sum(ra) as ra, sum(ma) as ma, sum(total) as total FROM tmis_inc WHERE tid='$tid' AND sch_year='$sch_year'");
		$row = mysql_fetch_assoc($result);
		
		
				
		$data["scale"]=$row["scale"];
		$data["grade"]=$row["grade"];
		$data["ta"]=$row["ta"];
		$data["ra"]=$row["ra"];
		$data["ma"]=$row["ma"];
		$total = $row["scale"]*1+$row["grade"]*1+$row["ta"]*1+$row["ra"]*1+$row["ma"]*1;
		if ($total==0) $total="";
		$data["total"] = $total;
		
		echo "<tr>";
		foreach ($data as $d){
			echo "<td>".$d."&nbsp;</td>";
		}
		echo "</tr>";

		
	}
	
	?>
	
	
	
</table>

</body>
</html>




