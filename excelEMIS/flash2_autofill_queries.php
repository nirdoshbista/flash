<?php

$attendance="INSERT INTO attendance(sch_num,sch_year,sex,attendance_date,ecd,class1,class2,class3,class4,class5,class6,class7,class8,class9,class10,class11,class12,entry_timestamp)

            select t1.sch_num,t1.sch_year,t1.sex,t1.attendance_date,t2.attendance,t3.attendance,t4.attendance,t5.attendance,t6.attendance,t7.attendance,t8.attendance,t9.attendance,
            t10.attendance,t11.attendance,t12.attendance,t13.attendance,t14.attendance,NOW() from 

            (SELECT sch_num,sch_year,1 as attendance_date,'TOT' as sex from id_students_track where sch_num in (%1\$s) and class>0 and sch_year=".($currentyear-1)." 
            group by sch_num,sch_year) as t1

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=0 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t2
            on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=1 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t3
            on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=2 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t4
            on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=3 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t5
            on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=4 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t6
            on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=5 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t7
            on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=6 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t8
            on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=7 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t9
            on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=8 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t10
            on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=9 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t11
            on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=10 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t12
            on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=11 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t13
            on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from id_students_track 
            where (sch_num in (%1\$s) and class=12 and sch_year=".($currentyear-1).") group by sch_num,sch_year) as t14
            on t1.sch_num=t14.sch_num and t1.sch_year=t14.sch_year;
			
			create table student_details as (
						select id_students_track.* , id_students_main.gender 
						from id_students_track, id_students_main 
						where id_students_main.reg_id = id_students_track.reg_id
					);

INSERT INTO attendance(sch_num,sch_year,sex,attendance_date,ecd,class1,class2,class3,class4,class5,class6,class7,class8,class9,class10,class11,class12,entry_timestamp)

            select t1.sch_num,t1.sch_year,t1.sex,t1.attendance_date,t2.attendance,t3.attendance,t4.attendance,t5.attendance,t6.attendance,t7.attendance,t8.attendance,t9.attendance,
            t10.attendance,t11.attendance,t12.attendance,t13.attendance,t14.attendance,NOW() from 

            (SELECT sch_num,sch_year,1 as attendance_date,gender as sex from student_details where sch_num in (%1\$s) and class>0 and sch_year=".($currentyear-1)." and gender = 'M' 
            group by sch_num,sch_year) as t1

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=0 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t2
            on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=1 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t3
            on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=2 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t4
            on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=3 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t5
            on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=4 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t6
            on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details
            where (sch_num in (%1\$s) and class=5 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t7
            on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=6 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t8
            on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=7 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t9
            on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=8 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t10
            on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=9 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t11
            on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=10 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t12
            on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=11 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t13
            on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=12 and sch_year=".($currentyear-1).") and gender = 'M' group by sch_num,sch_year) as t14
            on t1.sch_num=t14.sch_num and t1.sch_year=t14.sch_year;
						
			INSERT INTO attendance(sch_num,sch_year,sex,attendance_date,ecd,class1,class2,class3,class4,class5,class6,class7,class8,class9,class10,class11,class12,entry_timestamp)

            select t1.sch_num,t1.sch_year,t1.sex,t1.attendance_date,t2.attendance,t3.attendance,t4.attendance,t5.attendance,t6.attendance,t7.attendance,t8.attendance,t9.attendance,
            t10.attendance,t11.attendance,t12.attendance,t13.attendance,t14.attendance,NOW() from 

            (SELECT sch_num,sch_year,1 as attendance_date,gender as sex from student_details where sch_num in (%1\$s) and class>0 and sch_year=".($currentyear-1)." and gender = 'F' 
            group by sch_num,sch_year) as t1

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=0 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t2
            on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=1 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t3
            on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=2 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t4
            on t1.sch_num=t4.sch_num and t1.sch_year=t4.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=3 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t5
            on t1.sch_num=t5.sch_num and t1.sch_year=t5.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=4 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t6
            on t1.sch_num=t6.sch_num and t1.sch_year=t6.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details
            where (sch_num in (%1\$s) and class=5 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t7
            on t1.sch_num=t7.sch_num and t1.sch_year=t7.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=6 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t8
            on t1.sch_num=t8.sch_num and t1.sch_year=t8.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=7 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t9
            on t1.sch_num=t9.sch_num and t1.sch_year=t9.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=8 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t10
            on t1.sch_num=t10.sch_num and t1.sch_year=t10.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=9 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t11
            on t1.sch_num=t11.sch_num and t1.sch_year=t11.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=10 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t12
            on t1.sch_num=t12.sch_num and t1.sch_year=t12.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=11 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t13
            on t1.sch_num=t13.sch_num and t1.sch_year=t13.sch_year

            left join (select  AVG(attendance) as attendance,sch_num,sch_year from student_details 
            where (sch_num in (%1\$s) and class=12 and sch_year=".($currentyear-1).") and gender = 'F' group by sch_num,sch_year) as t14
            on t1.sch_num=t14.sch_num and t1.sch_year=t14.sch_year;
			
			drop table student_details;
			";

$pr_scores="Insert into pr_scores(sch_num,sch_year,class,subject_id,sex,total,entry_timestamp)
            select * from
            (SELECT q1.sch_num,q1.sch_year,q1.class,1 as `subject_id`,q2.Gender as `sex`,ROUND(AVG(q1.`nepali`)) AS `total`,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,2 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`english`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,3 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`maths`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,4 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`social_studies`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,5 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`science`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,6 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`population_env`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>0 and q1.class<6)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender) as t1";

$lsec_scores="Insert into lsec_scores(sch_num,sch_year,class,subject_id,sex,total,entry_timestamp)
            select * from
            (SELECT q1.sch_num,q1.sch_year,q1.class,1 as `subject_id`,q2.Gender as `sex`,ROUND(AVG(q1.`nepali`)) AS `total`,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,2 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`english`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,3 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`maths`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,4 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`social_studies`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,5 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`science`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,6 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`population_env`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>5 and q1.class<9)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender) as t1";

$sec_scores="Insert into sec_scores(sch_num,sch_year,class,subject_id,sex,total,entry_timestamp)
            select * from
            (SELECT q1.sch_num,q1.sch_year,q1.class,1 as `subject_id`,q2.Gender as `sex`,ROUND(AVG(q1.`nepali`)) AS `total`,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,2 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`english`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,3 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`maths`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,4 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`social_studies`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,5 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`science`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender
            UNION ALL
            SELECT q1.sch_num,q1.sch_year,q1.class,6 as subject_id,q2.Gender as sex,ROUND(AVG(q1.`population_env`)) AS total,NOW() as `entry_timestamp` 
            FROM `id_students_marks` as q1
            join `id_students_main` as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) 
            where (q1.sch_num in (%1\$s) and q1.sch_year=".($currentyear-1)." and q1.class>8 and q1.class<11)
            group by q1.sch_num,q1.sch_year,q1.class,q2.Gender) as t1";

$pr_scholarship="Insert into pr_scholarship(sch_num,sch_year,class,scholarship_type_id,total,female,male,entry_timestamp)

            select t1.sch_num,t1.sch_year,t1.class,
            CASE WHEN t1.scholarship=13 THEN 9
            ELSE t1.scholarship 
            END AS scholarship_type_id,t1.total,t2.female,t3.male,NOW() from

            (select q1.sch_num,q1.sch_year,q1.class,q1.scholarship,IF(count(q1.reg_id),count(q1.reg_id),0) as `total` from id_students_scholarship
            as q1 left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>0 and q1.class<6 and q1.sch_year=".($currentyear-1)." and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t1

            LEFT JOIN (select IF(count(q1.reg_id),count(q1.reg_id),0) as `female`,q1.sch_num,q1.sch_year,q1.class,q1.scholarship from id_students_scholarship as q1
            left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>0 and q1.class<6 and q1.sch_year=".($currentyear-1)." and q2.Gender='F' and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t2
            on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.scholarship=t2.scholarship

            LEFT JOIN (select IF(count(q1.reg_id),count(q1.reg_id),0) as `male`,q1.sch_num,q1.sch_year,q1.class,q1.scholarship from id_students_scholarship as q1
            left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>0 and q1.class<6 and q1.sch_year=".($currentyear-1)." and q2.Gender='M' and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t3
            on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.scholarship=t3.scholarship

            group by t1.sch_num,t1.sch_year,t1.class,t1.scholarship";

$lss_scholarship="Insert into lss_scholarship(sch_num,sch_year,class,scholarship_type_id,total,female,male,entry_timestamp)

            select t1.sch_num,t1.sch_year,t1.class,
            CASE WHEN t1.scholarship=9 THEN 1
            WHEN t1.scholarship=6 THEN 10
            WHEN t1.scholarship=9 THEN 11
            WHEN t1.scholarship=10 THEN 12
            WHEN t1.scholarship=11 THEN 13
            ELSE t1.scholarship 
            END AS scholarship_type_id,t1.total,t2.female,t3.male,NOW() from

            (select q1.sch_num,q1.sch_year,q1.class,q1.scholarship,IF(count(q1.reg_id),count(q1.reg_id),0) as `total` from id_students_scholarship
            as q1 left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>5 and q1.class<11 and q1.sch_year=".($currentyear-1)." and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t1

            LEFT JOIN (select IF(count(q1.reg_id),count(q1.reg_id),0) as `female`,q1.sch_num,q1.sch_year,q1.class,q1.scholarship from id_students_scholarship as q1
            left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>5 and q1.class<11 and q1.sch_year=".($currentyear-1)." and q2.Gender='F' and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t2
            on t1.sch_num=t2.sch_num and t1.sch_year=t2.sch_year and t1.class=t2.class and t1.scholarship=t2.scholarship

            LEFT JOIN (select IF(count(q1.reg_id),count(q1.reg_id),0) as `male`,q1.sch_num,q1.sch_year,q1.class,q1.scholarship from id_students_scholarship as q1
            left join id_students_main as q2 on (q2.`reg_id`=q1.`reg_id` and q2.`sch_year`=q1.`sch_year`) where (q1.sch_num in (%1\$s) and 
            q1.class>5 and q1.class<11 and q1.sch_year=".($currentyear-1)." and q2.Gender='M' and not (q1.scholarship=0)) group by q1.sch_num,q1.sch_year,q1.class,q1.scholarship) as t3
            on t1.sch_num=t3.sch_num and t1.sch_year=t3.sch_year and t1.class=t3.class and t1.scholarship=t3.scholarship

            group by t1.sch_num,t1.sch_year,t1.class,t1.scholarship";

$school_physical="INSERT INTO school_physical(sch_num,sch_year,compound,cstatus,water,water_tap,water_tubewell,water_well,water_other,toilet,t_total,t_girls,t_teachers,t_water,
            urinal,urinal_teachers,urinal_girls,pground,pground_enough_space,computer_room,num_computers,other_computers,teaching_computers,electricity,land_bigaha,land_kattha,
            land_dhur,land_ropani,land_aana,land_paisa,land_daam,num_buildings,rigid_buildings,weak_buildings,is_retrofitting,retrofitting_num,internet,rooms_unused)

            SELECT sch_num,sch_year,CASE WHEN compound_type IS NOT NULL THEN 1 ELSE 2 END,CASE WHEN compound_type=1 THEN 2 WHEN compound_type=2 THEN 1 WHEN compound_type=3 THEN 4 
            WHEN compound_type=4 THEN 3 ELSE compound_type END,CASE WHEN  no_water_source IS NOT NULL  THEN 1 ELSE 2 END,IF(no_water_source=1,1,0),IF(no_water_source=2,1,0),
            IF(no_water_source=3,1,0),IF(no_water_source=4,1,0),CASE WHEN no_total_toilets IS NOT NULL  THEN 1 ELSE 2 END,no_total_toilets,no_girls_toilets,no_teachers_toilets,
            no_water_toilets,IF(no_teachers_urinals IS NOT NULL OR no_students_urinals IS NOT NULL,1,2),no_teachers_urinals IS NOT NULL,no_students_urinals IS NOT NULL,
            CASE WHEN playground_status IS NOT NULL THEN 1 ELSE 2 END,CASE WHEN enough_space IS NOT NULL THEN 1 ELSE 2 END,CASE WHEN no_computers_total IS NOT NULL THEN 1 ELSE 2 END,
            no_computers_total,no_computers_learning,no_computers_teaching,CASE WHEN electricity_status IS NOT NULL THEN 1 ELSE 2 END,school_land_bigha,school_land_kattha,
            school_land_dhur,school_land_ropani,school_land_aana,school_land_paisa,school_land_dam,no_total_buildings,no_pakki_buildings,no_kacchi_buildings,
            CASE WHEN no_retrofitting IS NOT NULL THEN 1 ELSE 2 END,no_retrofitting,internet_status,unused_room

            from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);

$school_program="INSERT INTO school_program(sch_num,sch_year,govt_funds_q1_1st,govt_funds_q1_2nd,govt_funds_q1_3rd,govt_funds_q1_4th,govt_funds_q2_1st,govt_funds_q2_2nd,govt_funds_q2_3rd,
        govt_funds_q2_4th,school_improve_plan,school_improve_plan_date_updated,social_audit,social_audit_year,social_audit_month,social_audit_day,public_disclose_acc,public_disclose_acc_year,
        public_disclose_acc_month,public_disclose_acc_day,smc_meetings,monitor_total,monitor_rp,monitor_ss,monitor_gco,monitor_deo,monitor_others,health_facility,first_aid,
        children_club,rehab_classrooms,library,entry_timestamp)

        SELECT sch_num,sch_year,govt_funds_q1_1st,govt_funds_q1_2nd,govt_funds_q1_3rd,govt_funds_q1_4th,govt_funds_q2_1st,govt_funds_q2_2nd,govt_funds_q2_3rd,govt_funds_q2_4th,
        CASE WHEN sip_updated_date IS NOT NULL THEN 1 ELSE 2 END,YEAR(STR_TO_DATE(sip_updated_date, '%%d/%%m/%%Y')),CASE WHEN social_audit_date IS NOT NULL THEN 1 ELSE 2 END,YEAR(STR_TO_DATE(social_audit_date, '%%d/%%m/%%Y')),
        MONTH(STR_TO_DATE(social_audit_date, '%%d/%%m/%%Y')),DAY(STR_TO_DATE(social_audit_date, '%%d/%%m/%%Y')),financial_audit_date IS NOT NULL,YEAR(STR_TO_DATE(financial_audit_date, '%%d/%%m/%%Y')),
        MONTH(STR_TO_DATE(financial_audit_date, '%%d/%%m/%%Y')),DAY(STR_TO_DATE(financial_audit_date, '%%d/%%m/%%Y')),no_smc_meeting,(IFNULL(ext_monitor_rp,0)+IFNULL(ext_monitor_ss,0)+
IFNULL(ext_monitor_deo,0)+IFNULL(ext_monitor_doe,0)+IFNULL(ext_monitor_others,0)),ext_monitor_rp,ext_monitor_ss,ext_monitor_deo,
        ext_monitor_doe,ext_monitor_others,CASE WHEN medical_distance IS NOT NULL THEN 2 ELSE 3 END,CASE WHEN (first_aid IS NOT NULL AND first_aid = 1) THEN 1 ELSE 2 END,CASE WHEN (child_club IS NOT NULL and child_club =1) THEN 1 ELSE 2 END,no_rehabilitation,library_room IS NOT NULL,NOW()

        from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);

$sections="INSERT INTO sections(sch_num,sch_year,class,sections,classrooms,entry_timestamp)

        SELECT sch_num,sch_year,0 as class,rooms_ecd_pakki as sections,rooms_ecd_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,1 as class,rooms_class1_pakki as sections,rooms_class1_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,2 as class,rooms_class2_pakki as sections,rooms_class2_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,3 as class,rooms_class3_pakki as sections,rooms_class3_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,4 as class,rooms_class4_pakki as sections,rooms_class4_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,5 as class,rooms_class5_pakki as sections,rooms_class5_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,6 as class,rooms_class6_pakki as sections,rooms_class6_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,7 as class,rooms_class7_pakki as sections,rooms_class7_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,8 as class,rooms_class8_pakki as sections,rooms_class8_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,9 as class,rooms_class9_pakki as sections,rooms_class9_total as classrooms,NOW() 
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,10 as class,rooms_class10_pakki as sections,rooms_class10_total as classrooms,NOW()
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,11 as class,rooms_class11_pakki as sections,rooms_class11_total as classrooms,NOW()
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1)."
        UNION ALL
        SELECT sch_num,sch_year,12 as class,rooms_class12_pakki as sections,rooms_class12_total as classrooms,NOW()
        from id_physical_details where sch_num in (%1\$s) and sch_year=".($currentyear-1);

$school_grant="INSERT INTO school_grant(sch_num,sch_year,pri_books,pri_scholarship,pri_pcf,pri_student_evaluation,pri_misc,lsec_books,lsec_scholarship,lsec_pcf,
        lsec_student_evaluation,lsec_misc,sec_books,sec_scholarship,sec_pcf,sec_student_evaluation,sec_misc,entry_timestamp)

        SELECT sch_num,sch_year,grant_books_pri,grant_sch_pri,grant_pcf_pri,grant_cas_pri,grant_operation_pri,grant_books_lsec,grant_sch_lsec,grant_pcf_lsec,grant_cas_lsec,
        grant_operation_lsec,grant_books_sec,grant_sch_sec,grant_pcf_sec,grant_cas_sec,grant_operation_sec,NOW()

        from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);

$school_textbook="INSERT INTO school_textbook(sch_num,sch_year,textbook_pri,textbook_lsec,textbook_sec,textbook_hsec,teaching_manual_pri,teaching_manual_lsec,teaching_manual_sec,
        teaching_manual_hsec,child_material_pri,child_material_lsec,child_material_sec,child_material_hsec,book_corner_pri,book_corner_lsec,book_corner_sec,book_corner_hsec,
        local_curriculum_pri,local_curriculum_lsec,local_curriculum_sec,local_curriculum_hsec,entry_timestamp)

        SELECT sch_num,sch_year,textbook_pri,textbook_lsec,textbook_sec,textbook_hsec,teachingmanual_pri,teachingmanual_lsec,teachingmanual_sec,teachingmanual_hsec,
        childmaterial_pri,childmaterial_lsec,childmaterial_sec,childmaterial_hsec,bookcorner_pri,bookcorner_lsec,bookcorner_sec,bookcorner_hsec,localcurr_pri,localcurr_lsec,
        localcurr_sec,localcurr_hsec,NOW()

        from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);

$school_construction="INSERT INTO school_construction(sch_num,sch_year,new_building_deo,new_building_local,new_building_others,new_classrooms_deo,new_classrooms_local,new_classrooms_others,
        recon_building_deo,recon_building_local,recon_building_others,recon_classrooms_deo,recon_classrooms_local,recon_classrooms_others,toilet_deo,toilet_local,toilet_others,
        toilet_girls_deo,toilet_girls_local,toilet_girls_others,water_deo,water_local,water_others,book_corner_deo,book_corner_local,book_corner_others,entry_timestamp)

        SELECT sch_num,sch_year,new_building_deo,new_building_ddc,new_building_others,new_room_deo,new_room_ddc,new_room_others,rehab_building_deo,rehab_building_ddc,
        rehab_building_others,rehab_room_deo,rehab_room_ddc,rehab_room_others,total_toilets_deo,total_toilets_ddc,total_toilets_others,girls_toilets_deo,girls_toilets_ddc,
        girls_toilets_others,water_deo,water_ddc,water_others,book_corner_deo,book_corner_ddc,book_corner_others,NOW()

        from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);

$school_calendar="INSERT INTO school_calendar(sch_num,sch_year,open_days_planned,open_days_actual,teaching_planned,teaching_actual,exams_planned,exams_actual,eca_planned,eca_actual,
        holidays_planned,holidays_actual,festivals_planned,festivals_actual,others_planned,others_actual,entry_timestamp)

        SELECT sch_num,sch_year,schoolopen_planneddays,schoolopen_actualdays,teaching_planneddays,teaching_actualdays,exam_planneddays,exam_actualdays,
        curricular_planneddays,curricular_actualdays,public_holidays_planned,public_holidays_actual,festivals_planneddays,festivals_actualdays,
        others_planneddays,others_actualdays,NOW()

        from id_physical_details where sch_num in (%s) and sch_year=".($currentyear-1);


?>
