<?php

// transfer latest info 

// list of teachers whose current_info columns are null

$result = mysql_query("SELECT * FROM tmis_sec1 WHERE current_appoint_level IS NULL");

while ($r = mysql_fetch_assoc($result)){
	
	// get current latest position information
	$tmis_sec2_result = mysql_query("SELECT * FROM tmis_sec2 WHERE tid='{$r['tid']}' ORDER BY dec_year DESC, dec_month DESC, dec_day DESC, app_year DESC, app_month DESC, app_day DESC LIMIT 0,1");
	
	if (mysql_num_rows($tmis_sec2_result)>0){
		$tmis_sec2 = mysql_fetch_assoc($tmis_sec2_result);
		mysql_query("UPDATE tmis_sec1 SET 
							current_appoint_level='{$tmis_sec2['appoint_level']}', 
							current_appoint_rank='{$tmis_sec2['appoint_rank']}', 
							current_appoint_position='{$tmis_sec2['appoint_position']}', 
							current_appoint_type='{$tmis_sec2['appoint_type']}' 
					 WHERE tid='{$r['tid']}'");
					 
	}
	else{
		mysql_query("UPDATE tmis_sec1 SET 
							current_appoint_level='', 
							current_appoint_rank='', 
							current_appoint_position='', 
							current_appoint_type='' 
					 WHERE tid='{$r['tid']}'");	
	}
}
