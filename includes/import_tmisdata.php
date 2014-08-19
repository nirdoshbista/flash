<?php

function import_from_tmis()
{

    //autofill headmaster
    $result = mysql_query("SELECT `tmis_sec1`.`sch_year` as sch_year,`tmis_main`.`sch_num` as sch_num,`tmis_sec1`.`sex` as sex,`tmis_sec1`.`curr_perm_level` as initial_status,`tmis_sec1`.`t_caste` as caste,`tmis_sec1`.`head_teacher_training` as training
                        FROM `flash`.`tmis_sec1` join `tmis_main` on (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                        where `tmis_sec1`.`head_teacher`='1'");
    while ($row = mysql_fetch_assoc($result))
    {
        $dt=array();
        $dt['sch_num']=$school_num=$row['sch_num'];
        $dt['sch_year']=$school_year=$row['sch_year'];
        $dt['headmaster']=$row['sex'];
        $dt['hmaster_status']=$row['initial_status'];
        $dt['hmaster_initial_status']=$row['caste'];
        $dt['hmaster_training']=$row['training'];
        mysql_query("delete from headmaster where sch_num='$school_num' and sch_year='$school_year'");
        iudata('headmaster',$dt,'sch_num');
    }
    
    //autofill licensed teachers
    $select = mysql_query("SELECT `sch_num`,`sch_year` FROM `tmis_main`");
    while($row = mysql_fetch_assoc($select))
    {
            $dt=array();
            $dt['sch_num']=$school_num=$row['sch_num'];
            $dt['sch_year']=$school_year=$row['sch_year'];
            foreach(array(1=>"pri",2=>"lsec",3=>"sec",4=>"hsec") as $level=>$value)
            {
                foreach(array("f","m","t") as $category)
                {
                    if("f"==$category)
                    {
                        $result=mysql_query("select count(*) as count 
                                                from `flash`.`tmis_sec1` join `tmis_main` on 
                                                (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                `tmis_sec1`.`curr_perm_level`='$level' and
                                                `tmis_sec1`.`license_no` is not null
                                                and `tmis_sec1`.`sex`='2'");  
                    }
                    if("m"==$category)
                    {
                        $result=mysql_query("select count(*) as count 
                                                from `flash`.`tmis_sec1` join `tmis_main` on 
                                                (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                `tmis_sec1`.`curr_perm_level`='$level' and
                                                `tmis_sec1`.`license_no` is not null
                                                and `tmis_sec1`.`sex`='1'");  
                    }
                    if("t"==$category)
                    {
                        $result=mysql_query("select count(*) as count 
                                                from `flash`.`tmis_sec1` join `tmis_main` on 
                                                (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                `tmis_sec1`.`curr_perm_level`='$level' and
                                                `tmis_sec1`.`license_no` is not null"); 
                    }
                    $r=mysql_fetch_array($result);
                    $id = "{$value}_{$category}";
                    if($r["count"])
                        $dt[$id]=$r["count"];
                }
            }
            mysql_query("delete from teachers_licensed where sch_num='$school_num' and sch_year='$school_year'");
            idata('teachers_licensed',$dt,'sch_num');
    }


    // autofill from tmis_sec1 
    $select = mysql_query("SELECT `sch_num`,`sch_year` FROM `tmis_main`");
    while($row = mysql_fetch_assoc($select))
    {
            //for category and level wise sum totals
            $sum_array=array("total"=>array_fill(1,4,0),
                        "female"=>array_fill(1,4,0), 
                        "male"=>array_fill(1,4,0),
                        "dalit"=>array_fill(1,4,0),
                        "janjati"=>array_fill(1,4,0),
                        "disabled"=>array_fill(1,4,0));
            
            $school_num=$row['sch_num'];
            $school_year=$row['sch_year'];
            mysql_query("delete from teachers where sch_num='$school_num' and sch_year='$school_year'");
            foreach (array(1=>"temporary",2=>"permanent",3=>"rahat",5=>"private",6=>"approved",7=>"total") as $key=>$type)
            {
                $dt=array();
                $dt['sch_num']=$school_num;
                $dt['sch_year']=$school_year;
                foreach (array(1,2,3,4) as $level)
                {
                    $flag=0;
                    $dt['type']	= $type;
		    $dt['level']	= $level;
                    
                    //get approved total count and pass it on
                    if($type=="approved")
                    {
                         $result=mysql_query("select count(*) as count 
                                     from `flash`.`tmis_sec1` join `tmis_main` on 
                                     (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                     where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and `tmis_sec1`.`curr_perm_level`='$level'
                                     AND (`tmis_main`.`t_name`='Vacant' OR `tmis_sec1`.`curr_perm_type`='1' OR `tmis_sec1`.`curr_perm_type`='2')");    
                         $r=mysql_fetch_array($result);
                         //no point in saving if count is zero
                         if($r["count"])
                         {
                             $flag=1;
                             $dt['total']=$r["count"];
                         }
                         
                    }
                    else if($type=="total")
                    {
                        foreach($sum_array as $cat=>$lvl)
                        {
                            if($sum_array[$cat][$level]>0)
                            {
                                $flag=1;
                                $dt[$cat]=$sum_array[$cat][$level];
                            }
                        }
                    }
                    //get count of other types
                    else
                    {
                        foreach (array("total","female", "male","dalit","janjati","disabled") as $category)
                        {
                            if($category=="total")
                            {
                                $result=mysql_query("select count(*) as count 
                                                    from `flash`.`tmis_sec1` join `tmis_main` on 
                                                    (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                    where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                    `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'");    
                            }
                            if($category=="female")
                            {
                                $result=mysql_query("select count(*) as count 
                                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                        where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level' 
                                                        and `tmis_sec1`.`sex`='2'");       
                            }
                            if($category=="male")
                            {
                                $result=mysql_query("select count(*) as count 
                                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                        where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                                        and `tmis_sec1`.`sex`='1'");   
                            }
                            if($category=="dalit")
                            {
                                $result=mysql_query("select count(*) as count 
                                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                        where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                                        and `tmis_sec1`.`t_caste`='1'");
                            }
                            if($category=="janjati")
                            {
                                $result=mysql_query("select count(*) as count 
                                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                        where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                                        and `tmis_sec1`.`t_caste`='2'");
                            }
                            if($category=="disabled")
                            {
                                $result=mysql_query("select count(*) as count 
                                                        from `flash`.`tmis_sec1` join `tmis_main` on 
                                                        (`tmis_sec1`.`tid`=`tmis_main`.`tid` and `tmis_sec1`.`sch_year`=`tmis_main`.`sch_year`) 
                                                        where sch_num='$school_num' and `tmis_main`.`sch_year`='$school_year' and 
                                                        `tmis_sec1`.`curr_perm_type`='$key' and `tmis_sec1`.`curr_perm_level`='$level'
                                                        and `tmis_sec1`.`disability_status`!='0'");    
                            }                    
                            $r=mysql_fetch_array($result);
                            //no point in saving if count is zero
                            if($r["count"])
                            {
                                $dt['type']=$type;
                                $flag=1;
                                $dt[$category]=$r["count"];
                            }
                            $sum_array[$category][$level]+=$r['count'];
                        }
                    }      
                    if($flag)
                    {
                        idata('teachers',$dt,'sch_num');
                    }
                }
            }
    }

    

    //autofill teachers education from tmis_edu
    $select = mysql_query("SELECT `sch_num`,`sch_year` FROM `tmis_main`");
    while($row = mysql_fetch_assoc($select))
    {
            $school_num=$row['sch_num'];
            $school_year=$row['sch_year'];
            mysql_query("delete from teachers_edu where sch_num='$school_num' and sch_year='$school_year'");
            
            foreach (array(1,2,3,4) as $level)
            {
                    $dt=array();
                    $dt['sch_num']=$school_num=$row['sch_num'];
                    $dt['sch_year']=$school_year=$row['sch_year'];
                    $dt['level']=$level;
                    
                    foreach (array("under_slc"=>"Under-SLC","slc"=>"SLC","ia"=>"Intermed","ba"=>"Bacehlors","ma"=>"Masters","phd"=>"PhD") as $key=>$type)
                    {
                            foreach (array("f","m", "t") as $category)
                            {
                                if("f"==$category)
                                {
                                    $result=mysql_query("select count(*) as count from `flash`.`tmis_edu` 
                                                        join `tmis_main` on (`tmis_edu`.`tid`=`tmis_main`.`tid` and `tmis_edu`.`sch_year`=`tmis_main`.`sch_year`)
                                                        right join `tmis_sec1` on (`tmis_edu`.`tid`=`tmis_sec1`.`tid` and `tmis_edu`.`sch_year`=`tmis_sec1`.`sch_year`)
                                                        where `tmis_main`.sch_num='$school_num' and `tmis_main`.sch_year='$school_year' and curr_perm_level='$level'
                                                        and `tmis_edu`.`qualif`='$type'
                                                        and `tmis_edu`.`sn`='1'
                                                        and `tmis_sec1`.`sex`='2'");
                                }
                                if("m"==$category)
                                {
                                    $result=mysql_query("select count(*) as count from `flash`.`tmis_edu` 
                                                        join `tmis_main` on (`tmis_edu`.`tid`=`tmis_main`.`tid` and `tmis_edu`.`sch_year`=`tmis_main`.`sch_year`)
                                                        right join `tmis_sec1` on (`tmis_edu`.`tid`=`tmis_sec1`.`tid` and `tmis_edu`.`sch_year`=`tmis_sec1`.`sch_year`)
                                                        where `tmis_main`.sch_num='$school_num' and `tmis_main`.sch_year='$school_year' and curr_perm_level='$level'
                                                        and `tmis_edu`.`qualif`='$type'
                                                        and `tmis_edu`.`sn`='1'
                                                        and `tmis_sec1`.`sex`='1'");
                                }
                                if("t"==$category)
                                {
                                    $result=mysql_query("select count(*) as count from `flash`.`tmis_edu` 
                                                        join `tmis_main` on (`tmis_edu`.`tid`=`tmis_main`.`tid` and `tmis_edu`.`sch_year`=`tmis_main`.`sch_year`)
                                                        right join `tmis_sec1` on (`tmis_edu`.`tid`=`tmis_sec1`.`tid` and `tmis_edu`.`sch_year`=`tmis_sec1`.`sch_year`)
                                                        where `tmis_main`.sch_num='$school_num' and `tmis_main`.sch_year='$school_year' and curr_perm_level='$level'
                                                        and `tmis_edu`.`sn`='1'
                                                        and `tmis_edu`.`qualif`='$type'");
                                }
                                $r=mysql_fetch_array($result);
                                if($r["count"]>0)    
                                    $dt["{$key}_{$category}"]=$r["count"];

                            }
                    }
                    idata('teachers_edu',$dt,'sch_num');    
            }
    }
    
    //autofill teachers training
    $select = mysql_query("SELECT `sch_num`,`sch_year` FROM `tmis_main`");
    while($row = mysql_fetch_assoc($select))
    {
            foreach(array(1=>'pri',2=>'lsec',3=>'sec',4=>'hsec') as $key=>$level)
            {
                $dt=array();
                $dt['sch_num']=$school_num=$row['sch_num'];
                $dt['sch_year']=$school_year=$row['sch_year'];
                
                mysql_query("delete from {$level}_teacher_training where sch_num='$school_num' and sch_year='$school_year'");
                
                if($level=='hsec')
                {
                    foreach(array('total','dalit','janjati') as $cat)
                    {
                        foreach(array(1=>'fully_',5=>'un') as $tr_key=>$tr_string)
                        {
                            foreach(array(1=>'m',2=>'f') as $sex_key=>$sex_str)
                            {
                                if($cat=='total')
                                {
                                $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                AND `tmis_sec1`.`sex`='$sex_key'");
                                }
                                elseif($cat=='dalit')
                                {
                                    $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='1'");
                                }
                                elseif($cat=='janjati')
                                {
                                    $result1 = mysql_query("SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                AND `tmis_sec1`.`sex`='$sex_key' AND `tmis_sec1`.`t_caste`='2'");
                                }
                                while($row1=mysql_fetch_assoc($result1))
                                {
                                    $id = "{$tr_string}trained_{$cat}_$sex_str";
                                    if($row1['count'])
                                        $dt[$id]=$row1['count'];
                                }
                            }
                        }
                    }
                }
                else
                {
                    foreach(array('total','dalit','janjati','currentyear') as $cat)
                    {
                        foreach(array(1=>'fully_',2=>'tpd1_',3=>'tpd2_',4=>'tpd3_',5=>'un') as $tr_key=>$tr_string)
                        {
                            foreach(array(1=>'m',2=>'f',3=>'t') as $sex_key=>$sex_str)
                            {
                                if($cat=='total')
                                {
                                $query = "SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'";
                                }
                                elseif($cat=='dalit')
                                {
                                    $query = "SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                 AND `tmis_sec1`.`t_caste`='1'";
                                }
                                elseif($cat=='janjati')
                                {
                                    $query = "SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                 AND `tmis_sec1`.`t_caste`='2'";
                                }
                                elseif($cat=='currentyear')
                                {
                                    $query = "SELECT count(*) as count FROM `flash`.`tmis_main`
                                                join `flash`.`tmis_train` on (`tmis_main`.`tid`=`tmis_train`.`tid` and `tmis_main`.`sch_year`=`tmis_train`.`sch_year`) 
                                                join `flash`.`tmis_sec1` on (`tmis_main`.`tid`=`tmis_sec1`.`tid` and `tmis_main`.`sch_year`=`tmis_sec1`.`sch_year`) 
                                                WHERE `tmis_main`.`sch_num`='$school_num' AND `tmis_train`.`sn`='1' AND
                                                `tmis_train`.`name`='$key' AND `tmis_train`.`type`='$tr_key'
                                                 AND `tmis_train`.`year`='2069'";
                                }
                                
                                
                                if($sex_str!=='t')
                                    $query.=" AND `tmis_sec1`.`sex`='$sex_key'";
                                $result1=mysql_query($query);
                                while($row1=mysql_fetch_assoc($result1))
                                {
                                    $id = "{$tr_string}trained_{$cat}_$sex_str";
                                    if($row1['count'])
                                        $dt[$id]=$row1['count'];
                                }
                            }
                        }

                    } 
                }
                idata($level.'_teacher_training',$dt,'sch_num');
            }
    }
}
