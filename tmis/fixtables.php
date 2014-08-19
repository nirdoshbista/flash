<?php

// add required columns

// add inactive column to tmis_main
mysql_query("ALTER TABLE tmis_main ADD COLUMN inactive int AFTER t_name");

// add current_* columns to tmis_sec1
mysql_query("ALTER TABLE tmis_sec1 ADD COLUMN current_appoint_level int AFTER entry_timestamp");	
mysql_query("ALTER TABLE tmis_sec1 ADD COLUMN current_appoint_rank int AFTER entry_timestamp");
mysql_query("ALTER TABLE tmis_sec1 ADD COLUMN current_appoint_position int AFTER entry_timestamp");
mysql_query("ALTER TABLE tmis_sec1 ADD COLUMN current_appoint_type int AFTER entry_timestamp");

// convert perm_addr_phone and temp_addr_phone into varchar(50)
mysql_query("ALTER TABLE tmis_sec1 MODIFY temp_addr_phone VARCHAR(50)");
mysql_query("ALTER TABLE tmis_sec1 MODIFY perm_addr_phone VARCHAR(50)");

// add extra columns to tmis_inc
mysql_query("ALTER TABLE tmis_inc ADD COLUMN insurance int AFTER ma");
mysql_query("ALTER TABLE tmis_inc ADD COLUMN festival int AFTER ma");
mysql_query("ALTER TABLE tmis_inc ADD COLUMN mahangi int AFTER ma");
mysql_query("ALTER TABLE tmis_inc ADD COLUMN civil_investment int AFTER ma");
mysql_query("ALTER TABLE tmis_inc ADD COLUMN dress int AFTER ma");
