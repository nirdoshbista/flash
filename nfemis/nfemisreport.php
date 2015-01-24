<?php

require_once("includes/bootstrap.php");
$agency_types=array("clc"=>1,"school"=>2,"local"=>3,"cbo"=>4,"ingo"=>5,"dbgo"=>6);

$dist_code=$_GET['d'];
$year = $_GET['y'];
$sex = $_GET['sex'];
$type= $_GET['a'];
$center_id=$_GET['c'];

$query = "SELECT `nfe_agency_details`.`center_id`,`nfe_agency_details`.`year`,`nfe_agency_details`.`agency_name`,`nfe_agency_details`.`agency_type`,`nfe_agency_details`.`telephone_no`,
                 `nfe_agency_details`.`fax`,`nfe_agency_details`.`bank_ac_no`,`nfe_agency_details`.`mc_estd_date`
                FROM `nfe_agency_details`	
                LEFT JOIN `nfe_mast_agency` USING (`center_id`, `year`)
		WHERE `nfe_agency_details`.`center_id` LIKE '$dist_code%'
		AND `nfe_agency_details`.`year` = '$year'";
if($type!='all') $query.= " AND `nfe_agency_details`.`agency_type`=".$agency_types[$type];
if($type=='clc' && $center_id!='') $query.= " AND `nfe_agency_details`.`center_id`=".$center_id;

$result = mysql_query($query);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>NFEC Report</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery/jquery.tablesorter.css" />
		<style type="text/css">
			h1{font-size: 1.4em;}
			h2{font-size: 1.1em;}
			h3{font-size: 1em;}
			th,td{font-size: 1.1em;padding: 10px; font-weight: bold;text-align: center;}

		</style>
	</head>
	<body>
	
		<h1 align='center'>NFEC Report</h1>
		<p align='center'>
		<table style="width: auto;" align='center'>
                        <tr>
                            <td></td>
                            <th colspan="6">Agency Type</th>
                            <th colspan="4">Misc.</th>
                            <th colspan="2">Facilitators</th>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <th>CLC</th>
                            <th>School</th>
                            <th>Local Body</th>
                            <th>CBO</th>
                            <th>I/NGO</th>
                            <th>DBGO</th>
                            <th>Telephone</th>
                            <th>Fax</th>
                            <th>Bank Ac.</th>
                            <th>SMC</th>
                            <th>Male</th>
                            <th>Female</th>
                        </tr>
                        
                        <?php while ($row = mysql_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $row['agency_name']; ?></td>
                                <?php for($i=1;$i<7;$i++){ ?>
                                    <td>
                                        <?php if($row['agency_type']==$i){echo "<p>&#x2714</p>";} ?>
                                    </td>
                                <?php } ?>
                                <td><?php echo $row['telephone_no']; ?></td>
                                <td><?php echo $row['fax']; ?></td>
                                <td><?php echo $row['bank_ac_no']? "Yes":"No"; ?></td>
                                <td><?php echo $row['mc_estd_date']? "Yes":"No"; ?></td>
                                
                                
                                <?php 
                                    //now get the facilitator count
                                    $result1=mysql_query("SELECT IFNULL(SUM(IF(sex=1,1,0)),0) AS 'male',IFNULL(SUM(IF(sex=2,1,0)),0) AS 'female' 
                                                        from `nfe_facilitators` WHERE `center_id`=".$row['center_id']." AND `year`=".$row['year']."
                                                        AND `agency_type`=".$row['agency_type']);
                                    $facilitators=mysql_fetch_assoc($result1);
                                    echo "<td>".$facilitators['male']."</td>";
                                    echo "<td>".$facilitators['female']."</td>";
                                ?>
                                
                            </tr>
                        <?php } ?>
                        
		</table>
		</p>
	
	</body>
	
</html>
