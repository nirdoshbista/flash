<?php

/** consists of queries that will be used to autofill while importing excel EMIS
 * 
 */

$ecdppc_info_f1 = " Insert into ecdppc_info_f1(sch_num,sch_year,ecd_num,mother_school_code,ecd_type,entry_timestamp)
                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.sch_num as `mother_school_code`,t1.ecd_type,NOW() 
                    from id_students_track as t1 where ecd_num is not NULL and sch_num in (%s) and sch_year=".$currentyear." group by t1.ecd_num;";


$ecdppc_enroll_f1 =     "Insert into ecdppc_enroll_f1(sch_num,sch_year,ecd_num,ecd_class_type,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,tot_new_enroll_f,tot_new_enroll_m,tot_new_enroll_t,entry_timestamp) 

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.ecd_type  as `ecd_class_type` , t3.Female as `tot_enroll_total_f` , t2.Male as `tot_enroll_total_m`, t2.Male+t3.Female as `tot_enroll_total_t`,t5.Dalit_and_Female  as `tot_enroll_dalit_f`, t4.Dalit_and_Male as `tot_enroll_dalit_m`,t4.Dalit_and_Male+t5.Dalit_and_Female as `tot_enroll_dalit_t`,t7.Janajati_and_Female as `tot_enroll_janjati_f` , t6.Janajati_and_Male as `tot_enroll_janjati_m`,t6.Janajati_and_Male+t7.Janajati_and_Female as `tot_enroll_janjati_t`,
                    t8.F_N_E as `tot_new_enroll_f`,t9.M_N_E as `tot_new_enroll_m`, t8.F_N_E+t9.M_N_E as `tot_new_enroll`,NOW() from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num,id_students_track.ecd_type from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `Male`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num,id_students_track.ecd_type from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `Female`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year

                    left join ( select IF(count(1),count(1),0) as `Dalit_and_Male`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_main.Caste = 1 and id_students_track.sch_year=".$currentyear." ) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `Dalit_and_Female`,id_students_main.sch_num,id_students_track.sch_year,  id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_main.Caste = 1 and id_students_track.sch_year=".$currentyear." ) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year

                    left join ( select IF(count(1),count(1),0) as `Janajati_and_Male`,id_students_main.sch_num,id_students_track.sch_year,  id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_main.Caste = 2 and id_students_track.sch_year=".$currentyear." ) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `Janajati_and_Female`,id_students_main.sch_num,id_students_track.sch_year,  id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_main.Caste = 2 and id_students_track.sch_year=".$currentyear." ) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `F_N_E`,q2.sch_num,q2.sch_year, q2.ecd_num from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=0 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.ecd_num,q2.sch_year) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `M_N_E`,q2.sch_num,q2.sch_year, q2.ecd_num from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=0 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.ecd_num,q2.sch_year) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year
                    
                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.ecd_num

                    order by  t1.ecd_num;";

$ecd_total_enroll_age_f1="Insert into ecd_total_enroll_age_f1(sch_num,sch_year,ecd_num,caste,f_l3,m_l3,f3,m3,f4,m4,f5,m5,f_g5,m_g5,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`, t1.caste as 'caste',
                    t2.f_l3_t as `f_l3`, t3.m_l3_t as `m_l3`, t4.f_3_t as `f3`, t5.m_3_t as `m3`, t6.f_4_t as `f4`, t7.m_4_t as `m4`, t8.f_5_t as `f5`, t9.m_5_t as `m5`, t10.f_g5_t as `f_g5`, t11.m_g5_t as `m_g5`,NOW()  from

                    (select id_students_track.sch_num,id_students_track.sch_year,id_students_track.ecd_num, '1' as caste from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_track.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l3_t`,id_students_track.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.ecd_num = t2.ecd_num and t1.sch_year = t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_l3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num = t3.sch_num and t1.ecd_num = t3.ecd_num  and t1.sch_year = t3.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num = t4.sch_num and t1.ecd_num = t4.ecd_num  and t1.sch_year = t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num = t5.sch_num and t1.ecd_num = t5.ecd_num  and t1.sch_year = t5.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_4_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num = t6.sch_num and t1.ecd_num = t6.ecd_num  and t1.sch_year = t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_4_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num = t7.sch_num and t1.ecd_num = t7.ecd_num  and t1.sch_year = t7.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t8
                    on t1.sch_num = t8.sch_num and t1.ecd_num = t8.ecd_num  and t1.sch_year = t8.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t9
                    on t1.sch_num = t9.sch_num and t1.ecd_num = t9.ecd_num  and t1.sch_year = t9.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_g5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t10
                    on t1.sch_num = t10.sch_num and t1.ecd_num = t10.ecd_num  and t1.sch_year = t10.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_g5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t11
                    on t1.sch_num = t11.sch_num and t1.ecd_num = t11.ecd_num  and t1.sch_year = t11.sch_year

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.ecd_num,t1.sch_year

                    order by  t1.ecd_num";


$ecd_dalit_enroll_age_f1="Insert into ecd_total_enroll_age_f1(sch_num,sch_year,ecd_num,caste,f_l3,m_l3,f3,m3,f4,m4,f5,m5,f_g5,m_g5,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.caste as caste,
                    t2.f_l3_t as `f_l3`, t3.m_l3_t as `m_l3`, t4.f_3_t as `f3`, t5.m_3_t as `m3`, t6.f_4_t as `f4`, t7.m_4_t as `m4`, t8.f_5_t as `f5`, t9.m_5_t as `m5`, t10.f_g5_t as `f_g5`, t11.m_g5_t as `m_g5`,NOW()  from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.ecd_num,'2' as caste from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.ecd_num = t2.ecd_num and t1.sch_year = t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_l3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num = t3.sch_num and t1.ecd_num = t3.ecd_num and t1.sch_year = t3.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num = t4.sch_num and t1.ecd_num = t4.ecd_num and t1.sch_year = t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num = t5.sch_num and t1.ecd_num = t5.ecd_num and t1.sch_year = t5.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_4_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num = t6.sch_num and t1.ecd_num = t6.ecd_num and t1.sch_year = t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_4_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num = t7.sch_num  and t1.ecd_num = t7.ecd_num and t1.sch_year = t7.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t8
                    on t1.sch_num = t8.sch_num and t1.ecd_num = t8.ecd_num and t1.sch_year = t8.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t9
                    on t1.sch_num = t9.sch_num and t1.ecd_num = t9.ecd_num and t1.sch_year = t9.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_g5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t10
                    on t1.sch_num = t10.sch_num and t1.ecd_num = t10.ecd_num and t1.sch_year = t10.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_g5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 1 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t11
                    on t1.sch_num = t11.sch_num and t1.ecd_num = t11.ecd_num and t1.sch_year = t11.sch_year

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.ecd_num,t1.sch_year

                    order by  t1.ecd_num";


$ecd_janjati_enroll_age_f1="Insert into ecd_total_enroll_age_f1(sch_num,sch_year,ecd_num,caste,f_l3,m_l3,f3,m3,f4,m4,f5,m5,f_g5,m_g5,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.caste as 'caste',
                    t2.f_l3_t as `f_l3`, t3.m_l3_t as `m_l3`, t4.f_3_t as `f3`, t5.m_3_t as `m3`, t6.f_4_t as `f4`, t7.m_4_t as `m4`, t8.f_5_t as `f5`, t9.m_5_t as `m5`, t10.f_g5_t as `f_g5`, t11.m_g5_t as `m_g5`,NOW()  from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.ecd_num, '3' as caste from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_l3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_4_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_4_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t8
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t9
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_g5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t10
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_g5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 2 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t11
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year

                    where t1.sch_num in (%s)    
                    
                    group by t1.sch_num,t1.sch_year,t1.ecd_num

                    order by  t1.ecd_num";

$ecd_bc_enroll_age_f1="Insert into ecd_total_enroll_age_f1(sch_num,sch_year,ecd_num,caste,f_l3,m_l3,f3,m3,f4,m4,f5,m5,f_g5,m_g5,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.caste as caste,
                    t2.f_l3_t as `f_l3`, t3.m_l3_t as `m_l3`, t4.f_3_t as `f3`, t5.m_3_t as `m3`, t6.f_4_t as `f4`, t7.m_4_t as `m4`, t8.f_5_t as `f5`, t9.m_5_t as `m5`, t10.f_g5_t as `f_g5`, t11.m_g5_t as `m_g5`,NOW()  from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.ecd_num,'4' as caste from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.ecd_num = t2.ecd_num and t1.sch_year = t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_l3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num = t3.sch_num and t1.ecd_num = t3.ecd_num and t1.sch_year = t3.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num = t4.sch_num and t1.ecd_num = t4.ecd_num and t1.sch_year = t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num = t5.sch_num and t1.ecd_num = t5.ecd_num and t1.sch_year = t5.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_4_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num = t6.sch_num and t1.ecd_num = t6.ecd_num and t1.sch_year = t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_4_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num = t7.sch_num  and t1.ecd_num = t7.ecd_num and t1.sch_year = t7.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t8
                    on t1.sch_num = t8.sch_num and t1.ecd_num = t8.ecd_num and t1.sch_year = t8.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t9
                    on t1.sch_num = t9.sch_num and t1.ecd_num = t9.ecd_num and t1.sch_year = t9.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_g5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t10
                    on t1.sch_num = t10.sch_num and t1.ecd_num = t10.ecd_num and t1.sch_year = t10.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_g5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 3 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t11
                    on t1.sch_num = t11.sch_num and t1.ecd_num = t11.ecd_num and t1.sch_year = t11.sch_year

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.ecd_num,t1.sch_year

                    order by  t1.ecd_num";
$ecd_others_enroll_age_f1="Insert into ecd_total_enroll_age_f1(sch_num,sch_year,ecd_num,caste,f_l3,m_l3,f3,m3,f4,m4,f5,m5,f_g5,m_g5,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.ecd_num  as `ecd_num`,t1.caste as caste,
                    t2.f_l3_t as `f_l3`, t3.m_l3_t as `m_l3`, t4.f_3_t as `f3`, t5.m_3_t as `m3`, t6.f_4_t as `f4`, t7.m_4_t as `m4`, t8.f_5_t as `f5`, t9.m_5_t as `m5`, t10.f_g5_t as `f_g5`, t11.m_g5_t as `m_g5`,NOW()  from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.ecd_num,'5' as caste from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=0 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.ecd_num = t2.ecd_num and t1.sch_year = t2.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_l3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t3
                    on t1.sch_num = t3.sch_num and t1.ecd_num = t3.ecd_num and t1.sch_year = t3.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_3_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t4
                    on t1.sch_num = t4.sch_num and t1.ecd_num = t4.ecd_num and t1.sch_year = t4.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_3_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=3) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t5
                    on t1.sch_num = t5.sch_num and t1.ecd_num = t5.ecd_num and t1.sch_year = t5.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_4_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t6
                    on t1.sch_num = t6.sch_num and t1.ecd_num = t6.ecd_num and t1.sch_year = t6.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_4_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=4) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t7
                    on t1.sch_num = t7.sch_num  and t1.ecd_num = t7.ecd_num and t1.sch_year = t7.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t8
                    on t1.sch_num = t8.sch_num and t1.ecd_num = t8.ecd_num and t1.sch_year = t8.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t9
                    on t1.sch_num = t9.sch_num and t1.ecd_num = t9.ecd_num and t1.sch_year = t9.sch_year

                    left join (select  IF(count(1),count(1),0) as `f_g5_t`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_track.ecd_num from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t10
                    on t1.sch_num = t10.sch_num and t1.ecd_num = t10.ecd_num and t1.sch_year = t10.sch_year

                    left join ( select IF(count(1),count(1),0) as `m_g5_t`,id_students_main.sch_num,id_students_track.sch_year, id_students_track.ecd_num  from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste = 4 and id_students_track.class=0 and id_students_track.sch_year=".$currentyear." and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>5) group by id_students_main.sch_num,id_students_track.ecd_num,id_students_track.sch_year) as t11
                    on t1.sch_num = t11.sch_num and t1.ecd_num = t11.ecd_num and t1.sch_year = t11.sch_year

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.ecd_num,t1.sch_year

                    order by  t1.ecd_num";


$last_class1_5_enroll_f1="INSERT into last_class1_5_enroll_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,
                    tot_enroll_others_f,tot_enroll_others_m,tot_enroll_others_t,tot_appeared_exam_total_f,tot_appeared_exam_total_m,tot_appeared_exam_total_t,
                    tot_appeared_exam_dalit_f,tot_appeared_exam_dalit_m,tot_appeared_exam_dalit_t,tot_appeared_exam_janjati_f,tot_appeared_exam_janjati_m,tot_appeared_exam_janjati_t,
                    tot_appeared_exam_others_f,tot_appeared_exam_others_m,tot_appeared_exam_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year+1 as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    t4.tot_enroll_dalit_f,t5.tot_enroll_dalit_m,(IFNULL(t4.tot_enroll_dalit_f,0)+IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t6.tot_enroll_janjati_f,t7.tot_enroll_janjati_m,(IFNULL(t6.tot_enroll_janjati_f,0)+IFNULL(t7.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_m,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_t,
                    t8.appeared as tot_appeared_exam_total_f,t9.appeared as tot_appeared_exam_total_m,(IFNULL(t8.appeared,0)+IFNULL(t9.appeared,0)) as tot_appeared_exam_total_t,
                    t10.appeared as tot_appeared_exam_dalit_f,t11.appeared as tot_appeared_exam_dalit_m,(IFNULL(t10.appeared,0)+IFNULL(t11.appeared,0)) as tot_appeared_exam_dalit_t,
                    t12.appeared as tot_appeared_exam_janjati_f,t13.appeared as tot_appeared_exam_janjati_m,(IFNULL(t12.appeared,0)+IFNULL(t13.appeared,0)) as tot_appeared_exam_janjati_t,
                    (IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0)) as tot_appeared_exam_others_f,
                    (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0)) as tot_appeared_exam_others_m,
                    ((IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0))+ (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0))) as tot_appeared_exam_others_t,
                    NOW()
					
                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>0 and id_students_track.class<6 and id_students_track.sch_year=".($currentyear-1).") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t4
                    on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year and t1.class=t4.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t5
                    on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year and t1.class=t5.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=1 and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=1 and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=2 and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=2 and id_students_marks.class>0 and id_students_marks.class<6 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    where t1.sch_num in (%s)       

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t2.class";

$last_class6_8_enroll_f1="INSERT into last_class6_8_enroll_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,
                    tot_enroll_others_f,tot_enroll_others_m,tot_enroll_others_t,tot_appeared_exam_total_f,tot_appeared_exam_total_m,tot_appeared_exam_total_t,
                    tot_appeared_exam_dalit_f,tot_appeared_exam_dalit_m,tot_appeared_exam_dalit_t,tot_appeared_exam_janjati_f,tot_appeared_exam_janjati_m,tot_appeared_exam_janjati_t,
                    tot_appeared_exam_others_f,tot_appeared_exam_others_m,tot_appeared_exam_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year+1 as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    t4.tot_enroll_dalit_f,t5.tot_enroll_dalit_m,(IFNULL(t4.tot_enroll_dalit_f,0)+IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t6.tot_enroll_janjati_f,t7.tot_enroll_janjati_m,(IFNULL(t6.tot_enroll_janjati_f,0)+IFNULL(t7.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_m,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_t,
                    t8.appeared as tot_appeared_exam_total_f,t9.appeared as tot_appeared_exam_total_m,(IFNULL(t8.appeared,0)+IFNULL(t9.appeared,0)) as tot_appeared_exam_total_t,
                    t10.appeared as tot_appeared_exam_dalit_f,t11.appeared as tot_appeared_exam_dalit_m,(IFNULL(t10.appeared,0)+IFNULL(t11.appeared,0)) as tot_appeared_exam_dalit_t,
                    t12.appeared as tot_appeared_exam_janjati_f,t13.appeared as tot_appeared_exam_janjati_m,(IFNULL(t12.appeared,0)+IFNULL(t13.appeared,0)) as tot_appeared_exam_janjati_t,
                    (IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0)) as tot_appeared_exam_others_f,
                    (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0)) as tot_appeared_exam_others_m,
                    ((IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0))+ (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0))) as tot_appeared_exam_others_t,
                    NOW()
					
                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>5 and id_students_track.class<9 and id_students_track.sch_year=".($currentyear-1).") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t4
                    on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year and t1.class=t4.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t5
                    on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year and t1.class=t5.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=1 and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=1 and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=2 and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=2 and id_students_marks.class>5 and id_students_marks.class<9 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    where t1.sch_num in (%s)       

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t2.class";

$last_class9_10_enroll_f1="INSERT into last_class9_10_enroll_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,
                    tot_enroll_others_f,tot_enroll_others_m,tot_enroll_others_t,tot_appeared_exam_total_f,tot_appeared_exam_total_m,tot_appeared_exam_total_t,
                    tot_appeared_exam_dalit_f,tot_appeared_exam_dalit_m,tot_appeared_exam_dalit_t,tot_appeared_exam_janjati_f,tot_appeared_exam_janjati_m,tot_appeared_exam_janjati_t,
                    tot_appeared_exam_others_f,tot_appeared_exam_others_m,tot_appeared_exam_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year+1 as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    t4.tot_enroll_dalit_f,t5.tot_enroll_dalit_m,(IFNULL(t4.tot_enroll_dalit_f,0)+IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t6.tot_enroll_janjati_f,t7.tot_enroll_janjati_m,(IFNULL(t6.tot_enroll_janjati_f,0)+IFNULL(t7.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_m,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_enroll_janjati_f,0)-IFNULL(t4.tot_enroll_dalit_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_enroll_janjati_m,0)-IFNULL(t5.tot_enroll_dalit_m,0)) as tot_enroll_others_t,
                    t8.appeared as tot_appeared_exam_total_f,t9.appeared as tot_appeared_exam_total_m,(IFNULL(t8.appeared,0)+IFNULL(t9.appeared,0)) as tot_appeared_exam_total_t,
                    t10.appeared as tot_appeared_exam_dalit_f,t11.appeared as tot_appeared_exam_dalit_m,(IFNULL(t10.appeared,0)+IFNULL(t11.appeared,0)) as tot_appeared_exam_dalit_t,
                    t12.appeared as tot_appeared_exam_janjati_f,t13.appeared as tot_appeared_exam_janjati_m,(IFNULL(t12.appeared,0)+IFNULL(t13.appeared,0)) as tot_appeared_exam_janjati_t,
                    (IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0)) as tot_appeared_exam_others_f,
                    (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0)) as tot_appeared_exam_others_m,
                    ((IFNULL(t8.appeared,0)-IFNULL(t10.appeared,0)-IFNULL(t12.appeared,0))+ (IFNULL(t9.appeared,0)-IFNULL(t11.appeared,0)-IFNULL(t13.appeared,0))) as tot_appeared_exam_others_t,
                    NOW()
					
                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>8 and id_students_track.class<11 and id_students_track.sch_year=".($currentyear-1).") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t4
                    on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year and t1.class=t4.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t5
                    on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year and t1.class=t5.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)."
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=1 and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=1 and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='F' and id_students_main.caste=2 and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class,count(*) as appeared
                    from id_students_marks 
                    left join id_students_main on (id_students_marks.reg_id=id_students_main.reg_id)
                    where id_students_main.Gender='M' and id_students_main.caste=2 and id_students_marks.class>8 and id_students_marks.class<11 and id_students_marks.sch_year=".($currentyear-1)."
                    group by id_students_marks.sch_num,id_students_marks.sch_year,id_students_marks.class) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    where t1.sch_num in (%s)       

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t2.class";

$enr_rep_mig_class1_5_f1="INSERT into enr_rep_mig_class1_5_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_prom_total_f,tot_prom_total_m,tot_prom_total_t,tot_rep_total_f,tot_rep_total_m,tot_rep_total_t,
                    tot_new_enroll_total_f,tot_new_enroll_total_m,tot_new_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,tot_enroll_others_f,tot_enroll_others_m,
                    tot_enroll_others_t,tot_prom_dalit_f,tot_prom_dalit_m,tot_prom_dalit_t,tot_prom_janjati_f,tot_prom_janjati_m,tot_prom_janjati_t,tot_prom_others_f,tot_prom_others_m,tot_prom_others_t,
                    tot_rep_dalit_f,tot_rep_dalit_m,tot_rep_dalit_t,tot_rep_janjati_f,tot_rep_janjati_m,tot_rep_janjati_t,tot_rep_others_f,tot_rep_others_m,tot_rep_others_t,tot_new_enroll_dalit_f,tot_new_enroll_dalit_m,
                    tot_new_enroll_dalit_t,tot_new_enroll_janjati_f,tot_new_enroll_janjati_m,tot_new_enroll_janjati_t,tot_new_enroll_others_f,tot_new_enroll_others_m,tot_new_enroll_others_t,
                    tot_dropout_total_f,tot_dropout_total_m,tot_dropout_total_t,tot_dropout_dalit_f,tot_dropout_dalit_m,tot_dropout_dalit_t,tot_dropout_janjati_f,tot_dropout_janjati_m,tot_dropout_janjati_t,
                    tot_dropout_others_f,tot_dropout_others_m,tot_dropout_others_t,tot_pat_total_f,tot_pat_total_m,tot_pat_total_t,tot_pat_dalit_f,tot_pat_dalit_m,tot_pat_dalit_t,tot_pat_janjati_f,tot_pat_janjati_m,tot_pat_janjati_t,
                    tot_pat_others_f,tot_pat_others_m,tot_pat_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0)) as tot_prom_total_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0)) as tot_prom_total_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))) as tot_prom_total_t,
                    t6.tot_rep_total_f,t7.tot_rep_total_m,(IFNULL(t6.tot_rep_total_f,0)+IFNULL(t7.tot_rep_total_m,0)) as tot_rep_total_t,
                    t8.tot_new_enroll_total_f,t9.tot_new_enroll_total_m,(IFNULL(t8.tot_new_enroll_total_f,0)+IFNULL(t9.tot_new_enroll_total_m,0)) as tot_new_enroll_total_t,
                    t10.tot_enroll_dalit_f,t11.tot_enroll_dalit_m,(IFNULL(t10.tot_enroll_dalit_f,0)+IFNULL(t11.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t12.tot_enroll_janjati_f,t13.tot_enroll_janjati_m,(IFNULL(t12.tot_enroll_janjati_f,0)+IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0))) as tot_enroll_others_t,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)) as tot_prom_dalit_f,
                    (IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_m,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))+(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_t,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_prom_janjati_f,
                    (IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_m,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_t,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))) as tot_prom_others_f,
                    ((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)))+((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_t,
                    t18.tot_rep_dalit_f,t19.tot_rep_dalit_m,(IFNULL(t18.tot_rep_dalit_f,0)+IFNULL(t19.tot_rep_dalit_m,0)) as tot_rep_dalit_t,
                    t20.tot_rep_janjati_f,t21.tot_rep_janjati_m,(IFNULL(t20.tot_rep_janjati_f,0)+IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_janjati_t,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0)) as tot_rep_others_f,
                    (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_m,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0))+ (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_t,
                    t22.tot_new_enroll_dalit_f,t23.tot_new_enroll_dalit_m,(IFNULL(t22.tot_new_enroll_dalit_f,0)+IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_new_enroll_dalit_t,
                    t24.tot_new_enroll_janjati_f,t25.tot_new_enroll_janjati_m,(IFNULL(t24.tot_new_enroll_janjati_f,0)+IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_janjati_t,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_new_enroll_others_f,
                    (IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_m,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_t,
                    t26.tot_dropout_total_f,t27.tot_dropout_total_m,(IFNULL(t26.tot_dropout_total_f,0)+IFNULL(t27.tot_dropout_total_m,0)) as tot_dropout_total_t,
                    t28.tot_dropout_dalit_f,t29.tot_dropout_dalit_m,(IFNULL(t28.tot_dropout_dalit_f,0)+IFNULL(t29.tot_dropout_dalit_m,0)) as tot_dropout_dalit_t,
                    t30.tot_dropout_janjati_f,t31.tot_dropout_janjati_m,(IFNULL(t30.tot_dropout_janjati_f,0)+IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_janjati_t,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0)) as tot_dropout_others_f,
                    (IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_m,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0))+(IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_t,
                    t32.tot_pat_total_f,t33.tot_pat_total_m,(IFNULL(t32.tot_pat_total_f,0)+IFNULL(t33.tot_pat_total_m,0)) as tot_pat_total_t,
                    t34.tot_pat_dalit_f,t35.tot_pat_dalit_m,(IFNULL(t34.tot_pat_dalit_f,0)+IFNULL(t35.tot_pat_dalit_m,0)) as tot_pat_dalit_t,
                    t36.tot_pat_janjati_f,t37.tot_pat_janjati_m,(IFNULL(t36.tot_pat_janjati_f,0)+IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_janjati_t,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0)) as tot_pat_others_f,
                    (IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_m,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0))+(IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_t,
                    NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>0 and id_students_track.class<6 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t18
                    on t1.sch_num=t18.sch_num and t1.sch_year=t18.sch_year and t1.class=t18.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t19
                    on t1.sch_num=t19.sch_num and t1.sch_year=t19.sch_year and t1.class=t19.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t20
                    on t1.sch_num=t20.sch_num and t1.sch_year=t20.sch_year and t1.class=t20.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t21
                    on t1.sch_num=t21.sch_num and t1.sch_year=t21.sch_year and t1.class=t21.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t22
                    on t1.sch_num=t22.sch_num and t1.sch_year=t22.sch_year and t1.class=t22.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t23
                    on t1.sch_num=t23.sch_num and t1.sch_year=t23.sch_year and t1.class=t23.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t24
                    on t1.sch_num=t24.sch_num and t1.sch_year=t24.sch_year and t1.class=t24.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t25
                    on t1.sch_num=t25.sch_num and t1.sch_year=t25.sch_year and t1.class=t25.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t26
                    on t1.sch_num=t26.sch_num and t1.sch_year=t26.sch_year and t1.class=t26.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t27
                    on t1.sch_num=t27.sch_num and t1.sch_year=t27.sch_year and t1.class=t27.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t28
                    on t1.sch_num=t28.sch_num and t1.sch_year=t28.sch_year and t1.class=t28.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t29
                    on t1.sch_num=t29.sch_num and t1.sch_year=t29.sch_year and t1.class=t29.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t30
                    on t1.sch_num=t30.sch_num and t1.sch_year=t30.sch_year and t1.class=t30.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t31
                    on t1.sch_num=t31.sch_num and t1.sch_year=t31.sch_year and t1.class=t31.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t32
                    on t1.sch_num=t32.sch_num and t1.sch_year=t32.sch_year and t1.class=t32.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t33
                    on t1.sch_num=t33.sch_num and t1.sch_year=t33.sch_year and t1.class=t33.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t34
                    on t1.sch_num=t34.sch_num and t1.sch_year=t34.sch_year and t1.class=t34.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=1 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t35
                    on t1.sch_num=t35.sch_num and t1.sch_year=t35.sch_year and t1.class=t35.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t36
                    on t1.sch_num=t36.sch_num and t1.sch_year=t36.sch_year and t1.class=t36.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=2 and q2.class>0 and q2.class<6 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t37
                    on t1.sch_num=t37.sch_num and t1.sch_year=t37.sch_year and t1.class=t37.class

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by t2.class";

$enr_rep_mig_class6_8_f1="INSERT into enr_rep_mig_class6_8_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_prom_total_f,tot_prom_total_m,tot_prom_total_t,tot_rep_total_f,tot_rep_total_m,tot_rep_total_t,
                    tot_new_enroll_total_f,tot_new_enroll_total_m,tot_new_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,tot_enroll_others_f,tot_enroll_others_m,
                    tot_enroll_others_t,tot_prom_dalit_f,tot_prom_dalit_m,tot_prom_dalit_t,tot_prom_janjati_f,tot_prom_janjati_m,tot_prom_janjati_t,tot_prom_others_f,tot_prom_others_m,tot_prom_others_t,
                    tot_rep_dalit_f,tot_rep_dalit_m,tot_rep_dalit_t,tot_rep_janjati_f,tot_rep_janjati_m,tot_rep_janjati_t,tot_rep_others_f,tot_rep_others_m,tot_rep_others_t,tot_new_enroll_dalit_f,tot_new_enroll_dalit_m,
                    tot_new_enroll_dalit_t,tot_new_enroll_janjati_f,tot_new_enroll_janjati_m,tot_new_enroll_janjati_t,tot_new_enroll_others_f,tot_new_enroll_others_m,tot_new_enroll_others_t,
                    tot_dropout_total_f,tot_dropout_total_m,tot_dropout_total_t,tot_dropout_dalit_f,tot_dropout_dalit_m,tot_dropout_dalit_t,tot_dropout_janjati_f,tot_dropout_janjati_m,tot_dropout_janjati_t,
                    tot_dropout_others_f,tot_dropout_others_m,tot_dropout_others_t,tot_pat_total_f,tot_pat_total_m,tot_pat_total_t,tot_pat_dalit_f,tot_pat_dalit_m,tot_pat_dalit_t,tot_pat_janjati_f,tot_pat_janjati_m,tot_pat_janjati_t,
                    tot_pat_others_f,tot_pat_others_m,tot_pat_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0)) as tot_prom_total_f,
		    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0)) as tot_prom_total_m,
		    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))) as tot_prom_total_t,
                    t6.tot_rep_total_f,t7.tot_rep_total_m,(IFNULL(t6.tot_rep_total_f,0)+IFNULL(t7.tot_rep_total_m,0)) as tot_rep_total_t,
                    t8.tot_new_enroll_total_f,t9.tot_new_enroll_total_m,(IFNULL(t8.tot_new_enroll_total_f,0)+IFNULL(t9.tot_new_enroll_total_m,0)) as tot_new_enroll_total_t,
                    t10.tot_enroll_dalit_f,t11.tot_enroll_dalit_m,(IFNULL(t10.tot_enroll_dalit_f,0)+IFNULL(t11.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t12.tot_enroll_janjati_f,t13.tot_enroll_janjati_m,(IFNULL(t12.tot_enroll_janjati_f,0)+IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0))) as tot_enroll_others_t,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)) as tot_prom_dalit_f,
                    (IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_m,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))+(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_t,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_prom_janjati_f,
                    (IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_m,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_t,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))) as tot_prom_others_f,
                    ((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)))+((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_t,
                    t18.tot_rep_dalit_f,t19.tot_rep_dalit_m,(IFNULL(t18.tot_rep_dalit_f,0)+IFNULL(t19.tot_rep_dalit_m,0)) as tot_rep_dalit_t,
                    t20.tot_rep_janjati_f,t21.tot_rep_janjati_m,(IFNULL(t20.tot_rep_janjati_f,0)+IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_janjati_t,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0)) as tot_rep_others_f,
                    (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_m,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0))+ (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_t,
                    t22.tot_new_enroll_dalit_f,t23.tot_new_enroll_dalit_m,(IFNULL(t22.tot_new_enroll_dalit_f,0)+IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_new_enroll_dalit_t,
                    t24.tot_new_enroll_janjati_f,t25.tot_new_enroll_janjati_m,(IFNULL(t24.tot_new_enroll_janjati_f,0)+IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_janjati_t,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_new_enroll_others_f,
                    (IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_m,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_t,
                    t26.tot_dropout_total_f,t27.tot_dropout_total_m,(IFNULL(t26.tot_dropout_total_f,0)+IFNULL(t27.tot_dropout_total_m,0)) as tot_dropout_total_t,
                    t28.tot_dropout_dalit_f,t29.tot_dropout_dalit_m,(IFNULL(t28.tot_dropout_dalit_f,0)+IFNULL(t29.tot_dropout_dalit_m,0)) as tot_dropout_dalit_t,
                    t30.tot_dropout_janjati_f,t31.tot_dropout_janjati_m,(IFNULL(t30.tot_dropout_janjati_f,0)+IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_janjati_t,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0)) as tot_dropout_others_f,
                    (IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_m,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0))+(IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_t,
                    t32.tot_pat_total_f,t33.tot_pat_total_m,(IFNULL(t32.tot_pat_total_f,0)+IFNULL(t33.tot_pat_total_m,0)) as tot_pat_total_t,
                    t34.tot_pat_dalit_f,t35.tot_pat_dalit_m,(IFNULL(t34.tot_pat_dalit_f,0)+IFNULL(t35.tot_pat_dalit_m,0)) as tot_pat_dalit_t,
                    t36.tot_pat_janjati_f,t37.tot_pat_janjati_m,(IFNULL(t36.tot_pat_janjati_f,0)+IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_janjati_t,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0)) as tot_pat_others_f,
                    (IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_m,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0))+(IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_t,
                    NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>5 and id_students_track.class<9 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t18
                    on t1.sch_num=t18.sch_num and t1.sch_year=t18.sch_year and t1.class=t18.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t19
                    on t1.sch_num=t19.sch_num and t1.sch_year=t19.sch_year and t1.class=t19.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t20
                    on t1.sch_num=t20.sch_num and t1.sch_year=t20.sch_year and t1.class=t20.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t21
                    on t1.sch_num=t21.sch_num and t1.sch_year=t21.sch_year and t1.class=t21.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t22
                    on t1.sch_num=t22.sch_num and t1.sch_year=t22.sch_year and t1.class=t22.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t23
                    on t1.sch_num=t23.sch_num and t1.sch_year=t23.sch_year and t1.class=t23.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t24
                    on t1.sch_num=t24.sch_num and t1.sch_year=t24.sch_year and t1.class=t24.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t25
                    on t1.sch_num=t25.sch_num and t1.sch_year=t25.sch_year and t1.class=t25.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t26
                    on t1.sch_num=t26.sch_num and t1.sch_year=t26.sch_year and t1.class=t26.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t27
                    on t1.sch_num=t27.sch_num and t1.sch_year=t27.sch_year and t1.class=t27.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t28
                    on t1.sch_num=t28.sch_num and t1.sch_year=t28.sch_year and t1.class=t28.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t29
                    on t1.sch_num=t29.sch_num and t1.sch_year=t29.sch_year and t1.class=t29.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t30
                    on t1.sch_num=t30.sch_num and t1.sch_year=t30.sch_year and t1.class=t30.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t31
                    on t1.sch_num=t31.sch_num and t1.sch_year=t31.sch_year and t1.class=t31.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t32
                    on t1.sch_num=t32.sch_num and t1.sch_year=t32.sch_year and t1.class=t32.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t33
                    on t1.sch_num=t33.sch_num and t1.sch_year=t33.sch_year and t1.class=t33.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t34
                    on t1.sch_num=t34.sch_num and t1.sch_year=t34.sch_year and t1.class=t34.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=1 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t35
                    on t1.sch_num=t35.sch_num and t1.sch_year=t35.sch_year and t1.class=t35.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t36
                    on t1.sch_num=t36.sch_num and t1.sch_year=t36.sch_year and t1.class=t36.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=2 and q2.class>5 and q2.class<9 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t37
                    on t1.sch_num=t37.sch_num and t1.sch_year=t37.sch_year and t1.class=t37.class

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by t2.class";

$enr_rep_mig_class9_10_f1="INSERT into enr_rep_mig_class9_10_f1(sch_num,sch_year,class,tot_enroll_total_f,tot_enroll_total_m,tot_enroll_total_t,tot_prom_total_f,tot_prom_total_m,tot_prom_total_t,tot_rep_total_f,tot_rep_total_m,tot_rep_total_t,
                    tot_new_enroll_total_f,tot_new_enroll_total_m,tot_new_enroll_total_t,tot_enroll_dalit_f,tot_enroll_dalit_m,tot_enroll_dalit_t,tot_enroll_janjati_f,tot_enroll_janjati_m,tot_enroll_janjati_t,tot_enroll_others_f,tot_enroll_others_m,
                    tot_enroll_others_t,tot_prom_dalit_f,tot_prom_dalit_m,tot_prom_dalit_t,tot_prom_janjati_f,tot_prom_janjati_m,tot_prom_janjati_t,tot_prom_others_f,tot_prom_others_m,tot_prom_others_t,
                    tot_rep_dalit_f,tot_rep_dalit_m,tot_rep_dalit_t,tot_rep_janjati_f,tot_rep_janjati_m,tot_rep_janjati_t,tot_rep_others_f,tot_rep_others_m,tot_rep_others_t,tot_new_enroll_dalit_f,tot_new_enroll_dalit_m,
                    tot_new_enroll_dalit_t,tot_new_enroll_janjati_f,tot_new_enroll_janjati_m,tot_new_enroll_janjati_t,tot_new_enroll_others_f,tot_new_enroll_others_m,tot_new_enroll_others_t,
                    tot_dropout_total_f,tot_dropout_total_m,tot_dropout_total_t,tot_dropout_dalit_f,tot_dropout_dalit_m,tot_dropout_dalit_t,tot_dropout_janjati_f,tot_dropout_janjati_m,tot_dropout_janjati_t,
                    tot_dropout_others_f,tot_dropout_others_m,tot_dropout_others_t,tot_pat_total_f,tot_pat_total_m,tot_pat_total_t,tot_pat_dalit_f,tot_pat_dalit_m,tot_pat_dalit_t,tot_pat_janjati_f,tot_pat_janjati_m,tot_pat_janjati_t,
                    tot_pat_others_f,tot_pat_others_m,tot_pat_others_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class,t2.tot_enroll_total_f,t3.tot_enroll_total_m,(IFNULL(t2.tot_enroll_total_f,0)+IFNULL(t3.tot_enroll_total_m,0)) as tot_enroll_total_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0)) as tot_prom_total_f,
		    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0)) as tot_prom_total_m,
		    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))) as tot_prom_total_t,
                    t6.tot_rep_total_f,t7.tot_rep_total_m,(IFNULL(t6.tot_rep_total_f,0)+IFNULL(t7.tot_rep_total_m,0)) as tot_rep_total_t,
                    t8.tot_new_enroll_total_f,t9.tot_new_enroll_total_m,(IFNULL(t8.tot_new_enroll_total_f,0)+IFNULL(t9.tot_new_enroll_total_m,0)) as tot_new_enroll_total_t,
                    t10.tot_enroll_dalit_f,t11.tot_enroll_dalit_m,(IFNULL(t10.tot_enroll_dalit_f,0)+IFNULL(t11.tot_enroll_dalit_m,0)) as tot_enroll_dalit_t,
                    t12.tot_enroll_janjati_f,t13.tot_enroll_janjati_m,(IFNULL(t12.tot_enroll_janjati_f,0)+IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_janjati_t,
                    (IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0)) as tot_enroll_others_f,
                    (IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0)) as tot_enroll_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t12.tot_enroll_janjati_f,0))+(IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t13.tot_enroll_janjati_m,0))) as tot_enroll_others_t,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)) as tot_prom_dalit_f,
                    (IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_m,
                    (IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))+(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_prom_dalit_t,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_prom_janjati_f,
                    (IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_m,
                    (IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_prom_janjati_t,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))) as tot_prom_others_f,
                    ((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_m,
                    ((IFNULL(t2.tot_enroll_total_f,0)-IFNULL(t6.tot_rep_total_f,0)-IFNULL(t8.tot_new_enroll_total_f,0))-(IFNULL(t10.tot_enroll_dalit_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0))-(IFNULL(t12.tot_enroll_janjati_f,0)-IFNULL(t20.tot_rep_janjati_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)))+((IFNULL(t3.tot_enroll_total_m,0)-IFNULL(t7.tot_rep_total_m,0)-IFNULL(t9.tot_new_enroll_total_m,0))-(IFNULL(t11.tot_enroll_dalit_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0))-(IFNULL(t13.tot_enroll_janjati_m,0)-IFNULL(t21.tot_rep_janjati_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0))) as tot_prom_others_t,
                    t18.tot_rep_dalit_f,t19.tot_rep_dalit_m,(IFNULL(t18.tot_rep_dalit_f,0)+IFNULL(t19.tot_rep_dalit_m,0)) as tot_rep_dalit_t,
                    t20.tot_rep_janjati_f,t21.tot_rep_janjati_m,(IFNULL(t20.tot_rep_janjati_f,0)+IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_janjati_t,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0)) as tot_rep_others_f,
                    (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_m,
                    (IFNULL(t6.tot_rep_total_f,0)-IFNULL(t18.tot_rep_dalit_f,0)-IFNULL(t20.tot_rep_janjati_f,0))+ (IFNULL(t7.tot_rep_total_m,0)-IFNULL(t19.tot_rep_dalit_m,0)-IFNULL(t21.tot_rep_janjati_m,0)) as tot_rep_others_t,
                    t22.tot_new_enroll_dalit_f,t23.tot_new_enroll_dalit_m,(IFNULL(t22.tot_new_enroll_dalit_f,0)+IFNULL(t23.tot_new_enroll_dalit_m,0)) as tot_new_enroll_dalit_t,
                    t24.tot_new_enroll_janjati_f,t25.tot_new_enroll_janjati_m,(IFNULL(t24.tot_new_enroll_janjati_f,0)+IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_janjati_t,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0)) as tot_new_enroll_others_f,
                    (IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_m,
                    (IFNULL(t8.tot_new_enroll_total_f,0)-IFNULL(t22.tot_new_enroll_dalit_f,0)-IFNULL(t24.tot_new_enroll_janjati_f,0))+(IFNULL(t9.tot_new_enroll_total_m,0)-IFNULL(t23.tot_new_enroll_dalit_m,0)-IFNULL(t25.tot_new_enroll_janjati_m,0)) as tot_new_enroll_others_t,
                    t26.tot_dropout_total_f,t27.tot_dropout_total_m,(IFNULL(t26.tot_dropout_total_f,0)+IFNULL(t27.tot_dropout_total_m,0)) as tot_dropout_total_t,
                    t28.tot_dropout_dalit_f,t29.tot_dropout_dalit_m,(IFNULL(t28.tot_dropout_dalit_f,0)+IFNULL(t29.tot_dropout_dalit_m,0)) as tot_dropout_dalit_t,
                    t30.tot_dropout_janjati_f,t31.tot_dropout_janjati_m,(IFNULL(t30.tot_dropout_janjati_f,0)+IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_janjati_t,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0)) as tot_dropout_others_f,
                    (IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_m,
                    (IFNULL(t26.tot_dropout_total_f,0)-IFNULL(t28.tot_dropout_dalit_f,0)-IFNULL(t30.tot_dropout_janjati_f,0))+(IFNULL(t27.tot_dropout_total_m,0)-IFNULL(t29.tot_dropout_dalit_m,0)-IFNULL(t31.tot_dropout_janjati_m,0)) as tot_dropout_others_t,
                    t32.tot_pat_total_f,t33.tot_pat_total_m,(IFNULL(t32.tot_pat_total_f,0)+IFNULL(t33.tot_pat_total_m,0)) as tot_pat_total_t,
                    t34.tot_pat_dalit_f,t35.tot_pat_dalit_m,(IFNULL(t34.tot_pat_dalit_f,0)+IFNULL(t35.tot_pat_dalit_m,0)) as tot_pat_dalit_t,
                    t36.tot_pat_janjati_f,t37.tot_pat_janjati_m,(IFNULL(t36.tot_pat_janjati_f,0)+IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_janjati_t,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0)) as tot_pat_others_f,
                    (IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_m,
                    (IFNULL(t32.tot_pat_total_f,0)-IFNULL(t34.tot_pat_dalit_f,0)-IFNULL(t36.tot_pat_janjati_f,0))+(IFNULL(t33.tot_pat_total_m,0)-IFNULL(t35.tot_pat_dalit_m,0)-IFNULL(t37.tot_pat_janjati_m,0)) as tot_pat_others_t,
                    NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class>8 and id_students_track.class<11 and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year and t1.class=t6.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year and t1.class=t7.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t8
                    on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year and t1.class=t8.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_total_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t9
                    on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year and t1.class=t9.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t10
                    on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year and t1.class=t10.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t11
                    on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year and t1.class=t11.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t12
                    on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year and t1.class=t12.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year) as t13
                    on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year and t1.class=t13.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t18
                    on t1.sch_num=t18.sch_num and t1.sch_year=t18.sch_year and t1.class=t18.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t19
                    on t1.sch_num=t19.sch_num and t1.sch_year=t19.sch_year and t1.class=t19.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t20
                    on t1.sch_num=t20.sch_num and t1.sch_year=t20.sch_year and t1.class=t20.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_rep_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 and q3.class=q2.class
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t21
                    on t1.sch_num=t21.sch_num and t1.sch_year=t21.sch_year and t1.class=t21.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t22
                    on t1.sch_num=t22.sch_num and t1.sch_year=t22.sch_year and t1.class=t22.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_dalit_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t23
                    on t1.sch_num=t23.sch_num and t1.sch_year=t23.sch_year and t1.class=t23.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_f`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t24
                    on t1.sch_num=t24.sch_num and t1.sch_year=t24.sch_year and t1.class=t24.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_new_enroll_janjati_m`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." and q3.reg_id is NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t25
                    on t1.sch_num=t25.sch_num and t1.sch_year=t25.sch_year and t1.class=t25.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t26
                    on t1.sch_num=t26.sch_num and t1.sch_year=t26.sch_year and t1.class=t26.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t27
                    on t1.sch_num=t27.sch_num and t1.sch_year=t27.sch_year and t1.class=t27.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t28
                    on t1.sch_num=t28.sch_num and t1.sch_year=t28.sch_year and t1.class=t28.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t29
                    on t1.sch_num=t29.sch_num and t1.sch_year=t29.sch_year and t1.class=t29.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t30
                    on t1.sch_num=t30.sch_num and t1.sch_year=t30.sch_year and t1.class=t30.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_dropout_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-2
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t31
                    on t1.sch_num=t31.sch_num and t1.sch_year=t31.sch_year and t1.class=t31.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t32
                    on t1.sch_num=t32.sch_num and t1.sch_year=t32.sch_year and t1.class=t32.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_total_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t33
                    on t1.sch_num=t33.sch_num and t1.sch_year=t33.sch_year and t1.class=t33.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t34
                    on t1.sch_num=t34.sch_num and t1.sch_year=t34.sch_year and t1.class=t34.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_dalit_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=1 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t35
                    on t1.sch_num=t35.sch_num and t1.sch_year=t35.sch_year and t1.class=t35.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_f`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='F' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t36
                    on t1.sch_num=t36.sch_num and t1.sch_year=t36.sch_year and t1.class=t36.class

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `tot_pat_janjati_m`,q2.sch_num,(q2.sch_year+1) as sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year+1 and q3.class=-1
                    where q1.Gender='M' and q1.caste=2 and q2.class>8 and q2.class<11 and q2.sch_year=".($currentyear-1)." and q3.reg_id is not NULL
                    group by q2.sch_num,q2.class,q2.sch_year) as t37
                    on t1.sch_num=t37.sch_num and t1.sch_year=t37.sch_year and t1.class=t37.class

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by t2.class";

$new_total_enroll_age_f1="Insert into new_total_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_g9,m_g9,t_g9,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_g9, t15.m_g9, IFNULL(t14.f_g9,0)+IFNULL(t15.m_g9,0) as `t_g9`,NOW()

                    from

                    (select id_students_main.sch_num,q1.sch_year,q1.class from id_students_track as q1 left join 
                    id_students_main on q1.reg_id = id_students_main.reg_id 
                    where (q1.class=1 and q1.sch_year=".$currentyear.") group by id_students_main.sch_num,q1.class,q1.sch_year) as t1

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class
                    
                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$new_dalit_enroll_age_f1="Insert into new_dalit_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_g9,m_g9,t_g9,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_g9, t15.m_g9, IFNULL(t14.f_g9,0)+IFNULL(t15.m_g9,0) as `t_g9`,NOW()

                    from

                    (select id_students_main.sch_num,q1.sch_year,q1.class from id_students_track as q1 left join 
                    id_students_main on q1.reg_id = id_students_main.reg_id 
                    where (q1.class=1 and q1.sch_year=".$currentyear.") group by id_students_main.sch_num,q1.class,q1.sch_year) as t1

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=1 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class
                    
                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";


$new_janjati_enroll_age_f1="Insert into new_janjati_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_g9,m_g9,t_g9,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_g9, t15.m_g9, IFNULL(t14.f_g9,0)+IFNULL(t15.m_g9,0) as `t_g9`,NOW()

                    from

                    (select id_students_main.sch_num,q1.sch_year,q1.class from id_students_track as q1 left join 
                    id_students_main on q1.reg_id = id_students_main.reg_id 
                    where (q1.class=1 and q1.sch_year=".$currentyear.") group by id_students_main.sch_num,q1.class,q1.sch_year) as t1

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_l5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))<5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_5`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=5) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_6`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=6) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_7`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=7) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_8`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=8) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))=9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `f_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='F' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select IF(count(q2.reg_id),count(q2.reg_id),0) as `m_g9`,q2.sch_num,q2.sch_year,q2.class from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    left join (select * from id_students_track) as q3 on q3.reg_id=q1.reg_id and q3.sch_year=q2.sch_year-1 
                    where q1.Gender='M' and q1.caste=2 and q2.class=1 and (".$currentyear."-57-YEAR(STR_TO_DATE(q1.dob,'%%d/%%m/%%Y'))>9) and q2.sch_year=".$currentyear." 
                    and q3.reg_id is NULL group by q2.sch_num,q2.class,q2.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class
                    
                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";


$pr_total_enroll_age_f1="Insert into pr_total_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_10,m_10,t_10,f_11,m_11,t_11,
                    f_12,m_12,t_12,f_l6,m_l6,t_l6,f_l7,m_l7,t_l7,f_l8,m_l8,t_l8,f_l9,m_l9,t_l9,f_g9,m_g9,t_g9,f_g10,m_g10,t_g10,f_g11,m_g11,t_g11,f_g12,m_g12,t_g12,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_10, t15.m_10, IFNULL(t14.f_10,0)+IFNULL(t15.m_10,0) as `t_10`,t16.f_11, t17.m_11, IFNULL(t16.f_11,0)+IFNULL(t17.m_11,0) as `t_11`,t18.f_12, t19.m_12, IFNULL(t18.f_12,0)+IFNULL(t19.m_12,0) as `t_12`,
                    t20.f_l6, t21.m_l6, IFNULL(t20.f_l6,0)+IFNULL(t21.m_l6,0) as `t_l6`,t22.f_l7, t23.m_l7, IFNULL(t22.f_l7,0)+IFNULL(t23.m_l7,0) as `t_l7`,t24.f_l8, t25.m_l8, IFNULL(t24.f_l8,0)+IFNULL(t25.m_l8,0) as `t_l8`,
                    t26.f_l9, t27.m_l9, IFNULL(t26.f_l9,0)+IFNULL(t27.m_l9,0) as `t_l9`,t28.f_g9, t29.m_g9, IFNULL(t28.f_g9,0)+IFNULL(t29.m_g9,0) as `t_g9`,t30.f_g10, t31.m_g10, IFNULL(t30.f_g10,0)+IFNULL(t31.m_g10,0) as `t_g10`,
                    t32.f_g11, t33.m_g11, IFNULL(t32.f_g11,0)+IFNULL(t33.m_g11,0) as `t_g11`,t34.f_g12, t35.m_g12, IFNULL(t34.f_g12,0)+IFNULL(t35.m_g12,0) as `t_g12`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>0 and t1.class<6

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";


$pr_dalit_enroll_age_f1="Insert into pr_dalit_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_10,m_10,t_10,f_11,m_11,t_11,
                    f_12,m_12,t_12,f_l6,m_l6,t_l6,f_l7,m_l7,t_l7,f_l8,m_l8,t_l8,f_l9,m_l9,t_l9,f_g9,m_g9,t_g9,f_g10,m_g10,t_g10,f_g11,m_g11,t_g11,f_g12,m_g12,t_g12,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_10, t15.m_10, IFNULL(t14.f_10,0)+IFNULL(t15.m_10,0) as `t_10`,t16.f_11, t17.m_11, IFNULL(t16.f_11,0)+IFNULL(t17.m_11,0) as `t_11`,t18.f_12, t19.m_12, IFNULL(t18.f_12,0)+IFNULL(t19.m_12,0) as `t_12`,
                    t20.f_l6, t21.m_l6, IFNULL(t20.f_l6,0)+IFNULL(t21.m_l6,0) as `t_l6`,t22.f_l7, t23.m_l7, IFNULL(t22.f_l7,0)+IFNULL(t23.m_l7,0) as `t_l7`,t24.f_l8, t25.m_l8, IFNULL(t24.f_l8,0)+IFNULL(t25.m_l8,0) as `t_l8`,
                    t26.f_l9, t27.m_l9, IFNULL(t26.f_l9,0)+IFNULL(t27.m_l9,0) as `t_l9`,t28.f_g9, t29.m_g9, IFNULL(t28.f_g9,0)+IFNULL(t29.m_g9,0) as `t_g9`,t30.f_g10, t31.m_g10, IFNULL(t30.f_g10,0)+IFNULL(t31.m_g10,0) as `t_g10`,
                    t32.f_g11, t33.m_g11, IFNULL(t32.f_g11,0)+IFNULL(t33.m_g11,0) as `t_g11`,t34.f_g12, t35.m_g12, IFNULL(t34.f_g12,0)+IFNULL(t35.m_g12,0) as `t_g12`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>0 and t1.class<6

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$pr_janjati_enroll_age_f1="Insert into pr_janjati_enroll_age_f1(sch_num,sch_year,class,f_l5,m_l5,t_l5,f_5,m_5,t_5,f_6,m_6,t_6,f_7,m_7,t_7,f_8,m_8,t_8,f_9,m_9,t_9,f_10,m_10,t_10,f_11,m_11,t_11,
                    f_12,m_12,t_12,f_l6,m_l6,t_l6,f_l7,m_l7,t_l7,f_l8,m_l8,t_l8,f_l9,m_l9,t_l9,f_g9,m_g9,t_g9,f_g10,m_g10,t_g10,f_g11,m_g11,t_g11,f_g12,m_g12,t_g12,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l5,t3.m_l5, IFNULL(t2.f_l5,0)+IFNULL(t3.m_l5,0) as `t_l5`,t4.f_5, t5.m_5, IFNULL(t4.f_5,0)+IFNULL(t5.m_5,0) as `t_5`,t6.f_6, t7.m_6, IFNULL(t6.f_6,0)+IFNULL(t7.m_6,0) as `t_6`,
                    t8.f_7, t9.m_7, IFNULL(t8.f_7,0)+IFNULL(t9.m_7,0) as `t_7`,t10.f_8, t11.m_8, IFNULL(t10.f_8,0)+IFNULL(t11.m_8,0) as `t_8`,t12.f_9, t13.m_9, IFNULL(t12.f_9,0)+IFNULL(t13.m_9,0) as `t_9`,
                    t14.f_10, t15.m_10, IFNULL(t14.f_10,0)+IFNULL(t15.m_10,0) as `t_10`,t16.f_11, t17.m_11, IFNULL(t16.f_11,0)+IFNULL(t17.m_11,0) as `t_11`,t18.f_12, t19.m_12, IFNULL(t18.f_12,0)+IFNULL(t19.m_12,0) as `t_12`,
                    t20.f_l6, t21.m_l6, IFNULL(t20.f_l6,0)+IFNULL(t21.m_l6,0) as `t_l6`,t22.f_l7, t23.m_l7, IFNULL(t22.f_l7,0)+IFNULL(t23.m_l7,0) as `t_l7`,t24.f_l8, t25.m_l8, IFNULL(t24.f_l8,0)+IFNULL(t25.m_l8,0) as `t_l8`,
                    t26.f_l9, t27.m_l9, IFNULL(t26.f_l9,0)+IFNULL(t27.m_l9,0) as `t_l9`,t28.f_g9, t29.m_g9, IFNULL(t28.f_g9,0)+IFNULL(t29.m_g9,0) as `t_g9`,t30.f_g10, t31.m_g10, IFNULL(t30.f_g10,0)+IFNULL(t31.m_g10,0) as `t_g10`,
                    t32.f_g11, t33.m_g11, IFNULL(t32.f_g11,0)+IFNULL(t33.m_g11,0) as `t_g11`,t34.f_g12, t35.m_g12, IFNULL(t34.f_g12,0)+IFNULL(t35.m_g12,0) as `t_g12`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_5`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=5) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_l6`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<6) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_l7`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<7) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_l8`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<8) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_l9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_g9`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>9) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_g11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>0 and t1.class<6

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$sec_total_enroll_age_f1="Insert into sec_total_enroll_age_f1(sch_num,sch_year,class,f_l10,m_l10,t_l10,f_10,m_10,t_10,f_l11,m_l11,t_l11,f_11,m_11,t_11,f_l12,m_l12,t_l12,f_12,m_12,t_12,f_l13,m_l13,t_l13,
                    f_13,m_13,t_13,f_l14,m_l14,t_l14,f_14,m_14,t_14,f_g14,m_g14,t_g14,f_15,m_15,t_15,f_g15,m_g15,t_g15,f_16,m_16,t_16,f_g16,m_g16,t_g16,f_17,m_17,t_17,f_g17,m_g17,t_g17,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l10,t3.m_l10, IFNULL(t2.f_l10,0)+IFNULL(t3.m_l10,0) as `t_l10`,t4.f_10, t5.m_10, IFNULL(t4.f_10,0)+IFNULL(t5.m_10,0) as `t_10`,t6.f_l11, t7.m_l11, IFNULL(t6.f_l11,0)+IFNULL(t7.m_l11,0) as `t_l11`,
                    t8.f_11, t9.m_11, IFNULL(t8.f_11,0)+IFNULL(t9.m_11,0) as `t_11`,t10.f_l12, t11.m_l12, IFNULL(t10.f_l12,0)+IFNULL(t11.m_l12,0) as `t_l12`,t12.f_12, t13.m_12, IFNULL(t12.f_12,0)+IFNULL(t13.m_12,0) as `t_12`,
                    t14.f_l13, t15.m_l13, IFNULL(t14.f_l13,0)+IFNULL(t15.m_l13,0) as `t_l13`,t16.f_13, t17.m_13, IFNULL(t16.f_13,0)+IFNULL(t17.m_13,0) as `t_13`,t18.f_l14, t19.m_l14, IFNULL(t18.f_l14,0)+IFNULL(t19.m_l14,0) as `t_l14`,
                    t20.f_14, t21.m_14, IFNULL(t20.f_14,0)+IFNULL(t21.m_14,0) as `t_l4`,t22.f_g14, t23.m_g14, IFNULL(t22.f_g14,0)+IFNULL(t23.m_g14,0) as `t_g14`,t24.f_15, t25.m_15, IFNULL(t24.f_15,0)+IFNULL(t25.m_15,0) as `t_15`,
                    t26.f_g15, t27.m_g15, IFNULL(t26.f_g15,0)+IFNULL(t27.m_g15,0) as `t_g15`,t28.f_16, t29.m_16, IFNULL(t28.f_16,0)+IFNULL(t29.m_16,0) as `t_16`,t30.f_g16, t31.m_g16, IFNULL(t30.f_g16,0)+IFNULL(t31.m_g16,0) as `t_g16`,
					t32.f_17, t33.m_17, IFNULL(t32.f_17,0)+IFNULL(t33.m_17,0) as `t_17`,t34.f_g17, t35.m_g17, IFNULL(t34.f_g17,0)+IFNULL(t35.m_g17,0) as `t_g17`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>5 and t1.class<11

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";


$sec_dalit_enroll_age_f1="Insert into sec_dalit_enroll_age_f1(sch_num,sch_year,class,f_l10,m_l10,t_l10,f_10,m_10,t_10,f_l11,m_l11,t_l11,f_11,m_11,t_11,f_l12,m_l12,t_l12,f_12,m_12,t_12,f_l13,m_l13,t_l13,
                    f_13,m_13,t_13,f_l14,m_l14,t_l14,f_14,m_14,t_14,f_g14,m_g14,t_g14,f_15,m_15,t_15,f_g15,m_g15,t_g15,f_16,m_16,t_16,f_g16,m_g16,t_g16,f_17,m_17,t_17,f_g17,m_g17,t_g17,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l10,t3.m_l10, IFNULL(t2.f_l10,0)+IFNULL(t3.m_l10,0) as `t_l10`,t4.f_10, t5.m_10, IFNULL(t4.f_10,0)+IFNULL(t5.m_10,0) as `t_10`,t6.f_l11, t7.m_l11, IFNULL(t6.f_l11,0)+IFNULL(t7.m_l11,0) as `t_l11`,
                    t8.f_11, t9.m_11, IFNULL(t8.f_11,0)+IFNULL(t9.m_11,0) as `t_11`,t10.f_l12, t11.m_l12, IFNULL(t10.f_l12,0)+IFNULL(t11.m_l12,0) as `t_l12`,t12.f_12, t13.m_12, IFNULL(t12.f_12,0)+IFNULL(t13.m_12,0) as `t_12`,
                    t14.f_l13, t15.m_l13, IFNULL(t14.f_l13,0)+IFNULL(t15.m_l13,0) as `t_l13`,t16.f_13, t17.m_13, IFNULL(t16.f_13,0)+IFNULL(t17.m_13,0) as `t_13`,t18.f_l14, t19.m_l14, IFNULL(t18.f_l14,0)+IFNULL(t19.m_l14,0) as `t_l14`,
                    t20.f_14, t21.m_14, IFNULL(t20.f_14,0)+IFNULL(t21.m_14,0) as `t_l4`,t22.f_g14, t23.m_g14, IFNULL(t22.f_g14,0)+IFNULL(t23.m_g14,0) as `t_g14`,t24.f_15, t25.m_15, IFNULL(t24.f_15,0)+IFNULL(t25.m_15,0) as `t_15`,
                    t26.f_g15, t27.m_g15, IFNULL(t26.f_g15,0)+IFNULL(t27.m_g15,0) as `t_g15`,t28.f_16, t29.m_16, IFNULL(t28.f_16,0)+IFNULL(t29.m_16,0) as `t_16`,t30.f_g16, t31.m_g16, IFNULL(t30.f_g16,0)+IFNULL(t31.m_g16,0) as `t_g16`,
					t32.f_17, t33.m_17, IFNULL(t32.f_17,0)+IFNULL(t33.m_17,0) as `t_17`,t34.f_g17, t35.m_g17, IFNULL(t34.f_g17,0)+IFNULL(t35.m_g17,0) as `t_g17`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>5 and t1.class<11

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$sec_janjati_enroll_age_f1="Insert into sec_janjati_enroll_age_f1(sch_num,sch_year,class,f_l10,m_l10,t_l10,f_10,m_10,t_10,f_l11,m_l11,t_l11,f_11,m_11,t_11,f_l12,m_l12,t_l12,f_12,m_12,t_12,f_l13,m_l13,t_l13,
                    f_13,m_13,t_13,f_l14,m_l14,t_l14,f_14,m_14,t_14,f_g14,m_g14,t_g14,f_15,m_15,t_15,f_g15,m_g15,t_g15,f_16,m_16,t_16,f_g16,m_g16,t_g16,f_17,m_17,t_17,f_g17,m_g17,t_g17,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l10,t3.m_l10, IFNULL(t2.f_l10,0)+IFNULL(t3.m_l10,0) as `t_l10`,t4.f_10, t5.m_10, IFNULL(t4.f_10,0)+IFNULL(t5.m_10,0) as `t_10`,t6.f_l11, t7.m_l11, IFNULL(t6.f_l11,0)+IFNULL(t7.m_l11,0) as `t_l11`,
                    t8.f_11, t9.m_11, IFNULL(t8.f_11,0)+IFNULL(t9.m_11,0) as `t_11`,t10.f_l12, t11.m_l12, IFNULL(t10.f_l12,0)+IFNULL(t11.m_l12,0) as `t_l12`,t12.f_12, t13.m_12, IFNULL(t12.f_12,0)+IFNULL(t13.m_12,0) as `t_12`,
                    t14.f_l13, t15.m_l13, IFNULL(t14.f_l13,0)+IFNULL(t15.m_l13,0) as `t_l13`,t16.f_13, t17.m_13, IFNULL(t16.f_13,0)+IFNULL(t17.m_13,0) as `t_13`,t18.f_l14, t19.m_l14, IFNULL(t18.f_l14,0)+IFNULL(t19.m_l14,0) as `t_l14`,
                    t20.f_14, t21.m_14, IFNULL(t20.f_14,0)+IFNULL(t21.m_14,0) as `t_l4`,t22.f_g14, t23.m_g14, IFNULL(t22.f_g14,0)+IFNULL(t23.m_g14,0) as `t_g14`,t24.f_15, t25.m_15, IFNULL(t24.f_15,0)+IFNULL(t25.m_15,0) as `t_15`,
                    t26.f_g15, t27.m_g15, IFNULL(t26.f_g15,0)+IFNULL(t27.m_g15,0) as `t_g15`,t28.f_16, t29.m_16, IFNULL(t28.f_16,0)+IFNULL(t29.m_16,0) as `t_16`,t30.f_g16, t31.m_g16, IFNULL(t30.f_g16,0)+IFNULL(t31.m_g16,0) as `t_g16`,
					t32.f_17, t33.m_17, IFNULL(t32.f_17,0)+IFNULL(t33.m_17,0) as `t_17`,t34.f_g17, t35.m_g17, IFNULL(t34.f_g17,0)+IFNULL(t35.m_g17,0) as `t_g17`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_10`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=10) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_11`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=11) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_l12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    left join (select  IF(count(1),count(1),0) as `f_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t12 
                    on t1.sch_num = t12.sch_num and t1.sch_year = t12.sch_year and t1.class = t12.class

                    left join (select  IF(count(1),count(1),0) as `m_12`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=12) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t13 
                    on t1.sch_num = t13.sch_num and t1.sch_year = t13.sch_year and t1.class = t13.class

                    left join (select  IF(count(1),count(1),0) as `f_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t14 
                    on t1.sch_num = t14.sch_num and t1.sch_year = t14.sch_year and t1.class = t14.class

                    left join (select  IF(count(1),count(1),0) as `m_l13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t15 
                    on t1.sch_num = t15.sch_num and t1.sch_year = t15.sch_year and t1.class = t15.class

                    left join (select  IF(count(1),count(1),0) as `f_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t16 
                    on t1.sch_num = t16.sch_num and t1.sch_year = t16.sch_year and t1.class = t16.class

                    left join (select  IF(count(1),count(1),0) as `m_13`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=13) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t17 
                    on t1.sch_num = t17.sch_num and t1.sch_year = t17.sch_year and t1.class = t17.class

                    left join (select  IF(count(1),count(1),0) as `f_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t18 
                    on t1.sch_num = t18.sch_num and t1.sch_year = t18.sch_year and t1.class = t18.class

                    left join (select  IF(count(1),count(1),0) as `m_l14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t19 
                    on t1.sch_num = t19.sch_num and t1.sch_year = t19.sch_year and t1.class = t19.class

                    left join (select  IF(count(1),count(1),0) as `f_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t20 
                    on t1.sch_num = t20.sch_num and t1.sch_year = t20.sch_year and t1.class = t20.class

                    left join (select  IF(count(1),count(1),0) as `m_14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t21 
                    on t1.sch_num = t21.sch_num and t1.sch_year = t21.sch_year and t1.class = t21.class

                    left join (select  IF(count(1),count(1),0) as `f_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t22 
                    on t1.sch_num = t22.sch_num and t1.sch_year = t22.sch_year and t1.class = t22.class

                    left join (select  IF(count(1),count(1),0) as `m_g14`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>14) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t23 
                    on t1.sch_num = t23.sch_num and t1.sch_year = t23.sch_year and t1.class = t23.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t24 
                    on t1.sch_num = t24.sch_num and t1.sch_year = t24.sch_year and t1.class = t24.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t25 
                    on t1.sch_num = t25.sch_num and t1.sch_year = t25.sch_year and t1.class = t25.class

                    left join (select  IF(count(1),count(1),0) as `f_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t26 
                    on t1.sch_num = t26.sch_num and t1.sch_year = t26.sch_year and t1.class = t26.class

                    left join (select  IF(count(1),count(1),0) as `m_g15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t27 
                    on t1.sch_num = t27.sch_num and t1.sch_year = t27.sch_year and t1.class = t27.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t28 
                    on t1.sch_num = t28.sch_num and t1.sch_year = t28.sch_year and t1.class = t28.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t29 
                    on t1.sch_num = t29.sch_num and t1.sch_year = t29.sch_year and t1.class = t29.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t30 
                    on t1.sch_num = t30.sch_num and t1.sch_year = t30.sch_year and t1.class = t30.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t31 
                    on t1.sch_num = t31.sch_num and t1.sch_year = t31.sch_year and t1.class = t31.class

                    left join (select  IF(count(1),count(1),0) as `f_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t32 
                    on t1.sch_num = t32.sch_num and t1.sch_year = t32.sch_year and t1.class = t32.class

                    left join (select  IF(count(1),count(1),0) as `m_17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t33 
                    on t1.sch_num = t33.sch_num and t1.sch_year = t33.sch_year and t1.class = t33.class

                    left join (select  IF(count(1),count(1),0) as `f_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t34 
                    on t1.sch_num = t34.sch_num and t1.sch_year = t34.sch_year and t1.class = t34.class

                    left join (select  IF(count(1),count(1),0) as `m_g17`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>17) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t35 
                    on t1.sch_num = t35.sch_num and t1.sch_year = t35.sch_year and t1.class = t35.class

                    where t1.sch_num in (%s) and t1.class>5 and t1.class<11

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$hsec_total_enroll_age_f1="Insert into hsec_total_enroll_age_f1(sch_num,sch_year,class,f_l15,m_l15,t_l15,f_15,m_15,t_15,f_l16,m_l16,t_l16,f_16,m_16,t_16,f_g16,m_g16,t_g16,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l15,t3.m_l15, IFNULL(t2.f_l15,0)+IFNULL(t3.m_l15,0) as `t_l15`,t4.f_15, t5.m_15, IFNULL(t4.f_15,0)+IFNULL(t5.m_15,0) as `t_15`,t6.f_l16, t7.m_l16, IFNULL(t6.f_l16,0)+IFNULL(t7.m_l16,0) as `t_l16`,
                    t8.f_16, t9.m_16, IFNULL(t8.f_16,0)+IFNULL(t9.m_16,0) as `t_16`,t10.f_g16, t11.m_g16, IFNULL(t10.f_g16,0)+IFNULL(t11.m_g16,0) as `t_g16`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    where t1.sch_num in (%s) and t1.class>9 and t1.class<13

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$hsec_dalit_enroll_age_f1="Insert into hsec_dalit_enroll_age_f1(sch_num,sch_year,class,f_l15,m_l15,t_l15,f_15,m_15,t_15,f_l16,m_l16,t_l16,f_16,m_16,t_16,f_g16,m_g16,t_g16,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l15,t3.m_l15, IFNULL(t2.f_l15,0)+IFNULL(t3.m_l15,0) as `t_l15`,t4.f_15, t5.m_15, IFNULL(t4.f_15,0)+IFNULL(t5.m_15,0) as `t_15`,t6.f_l16, t7.m_l16, IFNULL(t6.f_l16,0)+IFNULL(t7.m_l16,0) as `t_l16`,
                    t8.f_16, t9.m_16, IFNULL(t8.f_16,0)+IFNULL(t9.m_16,0) as `t_16`,t10.f_g16, t11.m_g16, IFNULL(t10.f_g16,0)+IFNULL(t11.m_g16,0) as `t_g16`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=1 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    where t1.sch_num in (%s) and t1.class>9 and t1.class<13

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";


$hsec_janjati_enroll_age_f1="Insert into hsec_janjati_enroll_age_f1(sch_num,sch_year,class,f_l15,m_l15,t_l15,f_15,m_15,t_15,f_l16,m_l16,t_l16,f_16,m_16,t_16,f_g16,m_g16,t_g16,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class  as `class`,
                    t2.f_l15,t3.m_l15, IFNULL(t2.f_l15,0)+IFNULL(t3.m_l15,0) as `t_l15`,t4.f_15, t5.m_15, IFNULL(t4.f_15,0)+IFNULL(t5.m_15,0) as `t_15`,t6.f_l16, t7.m_l16, IFNULL(t6.f_l16,0)+IFNULL(t7.m_l16,0) as `t_l16`,
                    t8.f_16, t9.m_16, IFNULL(t8.f_16,0)+IFNULL(t9.m_16,0) as `t_16`,t10.f_g16, t11.m_g16, IFNULL(t10.f_g16,0)+IFNULL(t11.m_g16,0) as `t_g16`,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t1

                    left join (select  IF(count(1),count(1),0) as `f_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t2 
                    on t1.sch_num = t2.sch_num and t1.sch_year = t2.sch_year and t1.class = t2.class

                    left join (select  IF(count(1),count(1),0) as `m_l15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t3 
                    on t1.sch_num = t3.sch_num and t1.sch_year = t3.sch_year and t1.class = t3.class

                    left join (select  IF(count(1),count(1),0) as `f_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t4 
                    on t1.sch_num = t4.sch_num and t1.sch_year = t4.sch_year and t1.class = t4.class

                    left join (select  IF(count(1),count(1),0) as `m_15`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=15) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t5 
                    on t1.sch_num = t5.sch_num and t1.sch_year = t5.sch_year and t1.class = t5.class

                    left join (select  IF(count(1),count(1),0) as `f_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t6 
                    on t1.sch_num = t6.sch_num and t1.sch_year = t6.sch_year and t1.class = t6.class

                    left join (select  IF(count(1),count(1),0) as `m_l16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))<16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t7 
                    on t1.sch_num = t7.sch_num and t1.sch_year = t7.sch_year and t1.class = t7.class

                    left join (select  IF(count(1),count(1),0) as `f_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t8 
                    on t1.sch_num = t8.sch_num and t1.sch_year = t8.sch_year and t1.class = t8.class

                    left join (select  IF(count(1),count(1),0) as `m_16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))=16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t9 
                    on t1.sch_num = t9.sch_num and t1.sch_year = t9.sch_year and t1.class = t9.class

                    left join (select  IF(count(1),count(1),0) as `f_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'F' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t10 
                    on t1.sch_num = t10.sch_num and t1.sch_year = t10.sch_year and t1.class = t10.class

                    left join (select  IF(count(1),count(1),0) as `m_g16`,id_students_main.sch_num,id_students_track.sch_year,id_students_track.class from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_main.Gender = 'M' and id_students_main.caste=2 and id_students_track.sch_year=".$currentyear." 
                    and (".$currentyear."-57-YEAR(STR_TO_DATE(id_students_main.dob,'%%d/%%m/%%Y')))>16) group by id_students_main.sch_num,id_students_track.class,id_students_track.sch_year) as t11 
                    on t1.sch_num = t11.sch_num and t1.sch_year = t11.sch_year and t1.class = t11.class

                    where t1.sch_num in (%s) and t1.class>9 and t1.class<13

                    group by t1.sch_num,t1.sch_year,t1.class

                    order by  t1.class";

$ecd_disabled_f1="  INSERT into ecd_disabled_f1(sch_num,sch_year,class,disability_type_id,disabled_f,disabled_m,disabled_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class, t1.disability,t2.disabled_f,t3.disabled_m,IFNULL(t2.disabled_f,0)+IFNULL(t3.disabled_m,0) as `disabled_t`,NOW()
                    from
                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.class=0 and id_students_track.year=".$currentyear."
                    and not IFNULL(id_students_main.disability, 0) = 0
                    group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_f`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class=0 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.disability=t2.disability

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_m`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class=0 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.disability=t3.disability

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class,t1.disability

                    order by  t1.class";

$pr_disabled_f1="  INSERT into pr_disabled_f1(sch_num,sch_year,class,disability_type_id,disabled_f,disabled_m,disabled_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class, t1.disability,t2.disabled_f,t3.disabled_m,IFNULL(t2.disabled_f,0)+IFNULL(t3.disabled_m,0) as `disabled_t`,NOW()
                    from
                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.class>0 and id_students_track.class<6 
                    and id_students_track.sch_year=".$currentyear." and not IFNULL(id_students_main.disability, 0) = 0
                    group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_f`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.disability=t2.disability

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_m`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>0 and q2.class<6 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.disability=t3.disability

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class,t1.disability

                    order by  t1.class";

$lsec_disabled_f1="  INSERT into lsec_disabled_f1(sch_num,sch_year,class,disability_type_id,disabled_f,disabled_m,disabled_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class, t1.disability,t2.disabled_f,t3.disabled_m,IFNULL(t2.disabled_f,0)+IFNULL(t3.disabled_m,0) as `disabled_t`,NOW()
                    from
                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.class>5 and id_students_track.class<9 
                    and id_students_track.sch_year=".$currentyear." and not IFNULL(id_students_main.disability, 0) = 0
                    group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_f`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.disability=t2.disability

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_m`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>5 and q2.class<9 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.disability=t3.disability

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class,t1.disability

                    order by  t1.class";

$sec_disabled_f1="  INSERT into sec_disabled_f1(sch_num,sch_year,class,disability_type_id,disabled_f,disabled_m,disabled_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class, t1.disability,t2.disabled_f,t3.disabled_m,IFNULL(t2.disabled_f,0)+IFNULL(t3.disabled_m,0) as `disabled_t`,NOW()
                    from
                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.class>8 and id_students_track.class<11 
                    and id_students_track.sch_year=".$currentyear." and not IFNULL(id_students_main.disability, 0) = 0
                    group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_f`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear." 
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.disability=t2.disability

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_m`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>8 and q2.class<11 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.disability=t3.disability

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class,t1.disability

                    order by  t1.class";

$hsec_disabled_f1="  INSERT into hsec_disabled_f1(sch_num,sch_year,class,disability_type_id,disabled_f,disabled_m,disabled_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`, t1.class, t1.disability,t2.disabled_f,t3.disabled_m,IFNULL(t2.disabled_f,0)+IFNULL(t3.disabled_m,0) as `disabled_t`,NOW()
                    from
                    (select id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id where id_students_track.class>10 and id_students_track.class<13 
                    and id_students_track.sch_year=".$currentyear." and not IFNULL(id_students_main.disability, 0) = 0
                    group by id_students_main.sch_num,id_students_track.sch_year,id_students_track.class,id_students_main.disability) as t1

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_f`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='F' and q2.class>10 and q2.class<13 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.disability=t2.disability

                    left join( select IF(count(q2.reg_id),count(q2.reg_id),0) as `disabled_m`,q2.sch_num,q2.sch_year,q2.class,q1.disability from id_students_main as q1 
                    left join id_students_track as q2 on q2.reg_id=q1.reg_id
                    where q1.Gender='M' and q2.class>10 and q2.class<13 and q2.sch_year=".$currentyear."
                    group by q2.sch_num,q2.class,q2.sch_year,q1.disability) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.disability=t3.disability

                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year,t1.class,t1.disability

                    order by  t1.class";


$afterecd_f1="  Insert into afterecd_f1(sch_num,sch_year,total_f,total_m,total_t,dalit_f,dalit_m,dalit_t,janjati_f,janjati_m,janjati_t,entry_timestamp)

                    select t1.sch_num as `sch_num`, t1.sch_year as `sch_year`,t2.total_f,t3.total_m,IFNULL(t2.total_f,0)+IFNULL(t3.total_m,0) as `total_t`,
                    t4.dalit_f,t5.dalit_m,IFNULL(t4.dalit_f,0)+IFNULL(t5.dalit_m,0) as `dalit_t`,t6.janjati_f,t7.janjati_m,IFNULL(t6.janjati_f,0)+IFNULL(t7.janjati_m,0) as `janjati_t`
                    ,NOW()

                    from

                    (select id_students_main.sch_num,id_students_track.sch_year from id_students_track left join 
                    id_students_main on id_students_track.reg_id = id_students_main.reg_id 
                    where (id_students_track.class=1 and id_students_main.ecd='1' and id_students_track.sch_year=".$currentyear.") group by id_students_main.sch_num,id_students_track.sch_year) as t1

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `total_f`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='F' and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t2
                    on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `total_m`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='M' and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t3
                    on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `dalit_f`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='F' and m2.caste=1 and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t4
                    on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `dalit_m`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='M' and m2.caste=1 and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t5
                    on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `janjati_f`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='F' and m2.caste=2 and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t6
                    on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year

                    left join(select IF(count(m2.reg_id),count(m2.reg_id),0) as `janjati_m`,m1.sch_num,m1.sch_year from id_students_track as m1 left join 
                    id_students_main  as m2 on m1.reg_id = m2.reg_id 
                    where (m1.class=1 and m2.ecd='1' and m2.Gender='M' and m2.caste=2 and m1.sch_year=".$currentyear.") group by m1.sch_num,m1.sch_year) as t7
                    on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year
                    
                    where t1.sch_num in (%s)

                    group by t1.sch_num,t1.sch_year";
					
?>