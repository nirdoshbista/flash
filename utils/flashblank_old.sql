/* 
SQLyog Enterprise v4.01
Host - localhost : Database - flash
**************************************************************
Server version 5.0.67
*/

create database if not exists `flash`;

use `flash`;

/*
Table structure for afterecd_f1
*/

drop table if exists `afterecd_f1`;
CREATE TABLE `afterecd_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `total_f` int(10) default NULL,
  `total_m` int(10) default NULL,
  `total_t` int(10) default NULL,
  `dalit_f` int(10) default NULL,
  `dalit_m` int(10) default NULL,
  `dalit_t` int(10) default NULL,
  `janjati_f` int(10) default NULL,
  `janjati_m` int(10) default NULL,
  `janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for alternate_sch_f1
*/

drop table if exists `alternate_sch_f1`;
CREATE TABLE `alternate_sch_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for attendance
*/

drop table if exists `attendance`;
CREATE TABLE `attendance` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(10) NOT NULL,
  `attendance_date` varchar(20) NOT NULL,
  `ecd` int(11) default NULL,
  `class1` int(11) default NULL,
  `class2` int(11) default NULL,
  `class3` int(11) default NULL,
  `class4` int(11) default NULL,
  `class5` int(11) default NULL,
  `class6` int(11) default NULL,
  `class7` int(11) default NULL,
  `class8` int(11) default NULL,
  `class9` int(11) default NULL,
  `class10` int(11) default NULL,
  `class11` int(11) default NULL,
  `class12` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `attendance_date` (`attendance_date`),
  KEY `pk` (`sch_num`,`sch_year`,`attendance_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section B2';

/*
Table structure for building_material
*/

drop table if exists `building_material`;
CREATE TABLE `building_material` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(10) NOT NULL,
  `building_no` int(11) NOT NULL,
  `roof` varchar(100) NOT NULL default '',
  `truss` varchar(100) default NULL,
  `wall` varchar(100) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `building_no` (`building_no`),
  KEY `pk` (`sch_num`,`sch_year`,`building_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for building_rooms
*/

drop table if exists `building_rooms`;
CREATE TABLE `building_rooms` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(10) NOT NULL,
  `building_no` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `length` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `usage` varchar(100) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `building_no` (`building_no`),
  KEY `room_no` (`room_no`),
  KEY `pk` (`sch_num`,`sch_year`,`building_no`,`room_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for class1_5_enroll_app
*/

drop table if exists `class1_5_enroll_app`;
CREATE TABLE `class1_5_enroll_app` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(10) NOT NULL,
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_appeared_exam_total_f` int(11) default NULL,
  `tot_appeared_exam_total_m` int(11) default NULL,
  `tot_appeared_exam_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_appeared_exam_dalit_f` int(11) default NULL,
  `tot_appeared_exam_dalit_m` int(11) default NULL,
  `tot_appeared_exam_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_appeared_exam_janjati_f` int(11) default NULL,
  `tot_appeared_exam_janjati_m` int(11) default NULL,
  `tot_appeared_exam_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section B1 - Primary';

/*
Table structure for class11_12_enroll_app
*/

drop table if exists `class11_12_enroll_app`;
CREATE TABLE `class11_12_enroll_app` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(10) NOT NULL,
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_appeared_exam_total_f` int(11) default NULL,
  `tot_appeared_exam_total_m` int(11) default NULL,
  `tot_appeared_exam_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_appeared_exam_dalit_f` int(11) default NULL,
  `tot_appeared_exam_dalit_m` int(11) default NULL,
  `tot_appeared_exam_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_appeared_exam_janjati_f` int(11) default NULL,
  `tot_appeared_exam_janjati_m` int(11) default NULL,
  `tot_appeared_exam_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section B1 - Higher Secondary';

/*
Table structure for class6_8_enroll_app
*/

drop table if exists `class6_8_enroll_app`;
CREATE TABLE `class6_8_enroll_app` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(10) NOT NULL default '',
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_appeared_exam_total_f` int(11) default NULL,
  `tot_appeared_exam_total_m` int(11) default NULL,
  `tot_appeared_exam_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_appeared_exam_dalit_f` int(11) default NULL,
  `tot_appeared_exam_dalit_m` int(11) default NULL,
  `tot_appeared_exam_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_appeared_exam_janjati_f` int(11) default NULL,
  `tot_appeared_exam_janjati_m` int(11) default NULL,
  `tot_appeared_exam_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section B1 - Lower Secondary';

/*
Table structure for class9_10_enroll_app
*/

drop table if exists `class9_10_enroll_app`;
CREATE TABLE `class9_10_enroll_app` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(10) NOT NULL default '',
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_appeared_exam_total_f` int(11) default NULL,
  `tot_appeared_exam_total_m` int(11) default NULL,
  `tot_appeared_exam_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_appeared_exam_dalit_f` int(11) default NULL,
  `tot_appeared_exam_dalit_m` int(11) default NULL,
  `tot_appeared_exam_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_appeared_exam_janjati_f` int(11) default NULL,
  `tot_appeared_exam_janjati_m` int(11) default NULL,
  `tot_appeared_exam_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section B1 - Secondary';

/*
Table structure for ecd_dalit_enroll_age_f1
*/

drop table if exists `ecd_dalit_enroll_age_f1`;
CREATE TABLE `ecd_dalit_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd_num` int(11) NOT NULL default '1',
  `f3` int(10) default NULL,
  `m3` int(10) default NULL,
  `f4` int(10) default NULL,
  `m4` int(10) default NULL,
  `f5` int(10) default NULL,
  `m5` int(10) default NULL,
  `f_g5` int(10) default NULL,
  `m_g5` int(10) default NULL,
  `f_l3` int(10) default NULL,
  `m_l3` int(10) default NULL,
  `t_l3` int(10) default NULL,
  `f_3_4` int(10) default NULL,
  `m_3_4` int(10) default NULL,
  `t_3_4` int(10) default NULL,
  `f_g4` int(10) default NULL,
  `m_g4` int(10) default NULL,
  `t_g4` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecd_disabled_f1
*/

drop table if exists `ecd_disabled_f1`;
CREATE TABLE `ecd_disabled_f1` (
  `sch_num` varchar(10) default NULL,
  `sch_year` varchar(4) default NULL,
  `class` varchar(5) default NULL,
  `disability_type_id` int(10) default NULL,
  `disabled_f` int(10) default NULL,
  `disabled_m` int(10) default NULL,
  `disabled_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `disability_type_id` (`disability_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`disability_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecd_facilitator_f1
*/

drop table if exists `ecd_facilitator_f1`;
CREATE TABLE `ecd_facilitator_f1` (
  `sch_num` varchar(10) default NULL,
  `sch_year` varchar(4) default NULL,
  `ecd_num` int(11) default '1',
  `name` varchar(50) default NULL,
  `sex` int(10) default NULL,
  `caste` int(10) default NULL,
  `less_slc_f` int(10) default NULL,
  `less_slc_m` int(10) default NULL,
  `less_slc_t` int(10) default NULL,
  `slc_f` int(10) default NULL,
  `slc_m` int(10) default NULL,
  `slc_t` int(10) default NULL,
  `greater_slc_f` int(10) default NULL,
  `greater_slc_m` int(10) default NULL,
  `greater_slc_t` int(10) default NULL,
  `trained_f` int(10) default NULL,
  `trained_m` int(10) default NULL,
  `trained_t` int(10) default NULL,
  `untrained_f` int(10) default NULL,
  `untrained_m` int(10) default NULL,
  `untrained_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `name` (`name`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecd_janjati_enroll_age_f1
*/

drop table if exists `ecd_janjati_enroll_age_f1`;
CREATE TABLE `ecd_janjati_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `ecd_num` int(11) NOT NULL default '1',
  `f3` int(10) default NULL,
  `m3` int(10) default NULL,
  `f4` int(10) default NULL,
  `m4` int(10) default NULL,
  `f5` int(10) default NULL,
  `m5` int(10) default NULL,
  `f_g5` int(10) default NULL,
  `m_g5` int(10) default NULL,
  `f_l3` int(10) default NULL,
  `m_l3` int(10) default NULL,
  `t_l3` int(10) default NULL,
  `f_3_4` int(10) default NULL,
  `m_3_4` int(10) default NULL,
  `t_3_4` int(10) default NULL,
  `f_g4` int(10) default NULL,
  `m_g4` int(10) default NULL,
  `t_g4` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecd_total_enroll_age_f1
*/

drop table if exists `ecd_total_enroll_age_f1`;
CREATE TABLE `ecd_total_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `ecd_num` int(11) NOT NULL default '1',
  `f3` int(10) default NULL,
  `m3` int(10) default NULL,
  `f4` int(10) default NULL,
  `m4` int(10) default NULL,
  `f5` int(10) default NULL,
  `m5` int(10) default NULL,
  `f_g5` int(10) default NULL,
  `m_g5` int(10) default NULL,
  `f_l3` int(10) default NULL,
  `m_l3` int(10) default NULL,
  `t_l3` int(10) default NULL,
  `f_3_4` int(10) default NULL,
  `m_3_4` int(10) default NULL,
  `t_3_4` int(10) default NULL,
  `f_g4` int(10) default NULL,
  `m_g4` int(10) default NULL,
  `t_g4` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_enroll
*/

drop table if exists `ecdppc_enroll`;
CREATE TABLE `ecdppc_enroll` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd_num` int(11) NOT NULL default '1',
  `ecd_class_type` varchar(10) NOT NULL,
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `ecd_class_type` (`ecd_class_type`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`,`ecd_class_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_enroll_f1
*/

drop table if exists `ecdppc_enroll_f1`;
CREATE TABLE `ecdppc_enroll_f1` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `ecd_num` int(11) NOT NULL default '1',
  `ecd_class_type` varchar(10) NOT NULL default '',
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `ecd_class_type` (`ecd_class_type`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`,`ecd_class_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_info
*/

drop table if exists `ecdppc_info`;
CREATE TABLE `ecdppc_info` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd_num` int(11) NOT NULL default '1',
  `parent_sch_num` varchar(20) default NULL,
  `smc_year` int(11) default NULL,
  `sections` int(11) default NULL,
  `ecd_vdc` varchar(5) default NULL,
  `ecd_ward` int(11) default NULL,
  `ecd_tole` varchar(100) default NULL,
  `smc_y` int(11) default NULL,
  `smc_m` int(11) default NULL,
  `smc_d` int(11) default NULL,
  `smc_total` int(11) default NULL,
  `smc_female` int(11) default NULL,
  `smc_male` int(11) default NULL,
  `smc_dalit` int(11) default NULL,
  `ngo_name` varchar(100) default NULL,
  `ngo_add` varchar(50) default NULL,
  `separate_room` int(11) default NULL,
  `separate_building` int(11) default NULL,
  `adequate_space` int(11) default NULL,
  `adequate_material` int(11) default NULL,
  `adequate_classroom` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_info_f1
*/

drop table if exists `ecdppc_info_f1`;
CREATE TABLE `ecdppc_info_f1` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd_num` int(11) NOT NULL default '1',
  `estd_year` int(11) default NULL,
  `mother_school_code` varchar(30) default NULL,
  `sections` int(11) default NULL,
  `ecd_vdc` varchar(5) default NULL,
  `ecd_ward` int(11) default NULL,
  `ecd_tole` varchar(100) default NULL,
  `ngo_name` varchar(100) default NULL,
  `ngo_vdc` varchar(5) default NULL,
  `ngo_ward` int(11) default NULL,
  `ngo_tole` varchar(100) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_teacher
*/

drop table if exists `ecdppc_teacher`;
CREATE TABLE `ecdppc_teacher` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd_num` int(11) NOT NULL default '1',
  `ecd_class_type` varchar(10) NOT NULL,
  `total_f` int(11) default NULL,
  `total_m` int(11) default NULL,
  `total_t` int(11) default NULL,
  `training_received` int(11) default NULL,
  `training_not_received` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `ecd_class_type` (`ecd_class_type`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`,`ecd_class_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for ecdppc_teacher_f1
*/

drop table if exists `ecdppc_teacher_f1`;
CREATE TABLE `ecdppc_teacher_f1` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `ecd_num` int(11) NOT NULL default '1',
  `ecd_class_type` varchar(10) NOT NULL default '',
  `total_f` int(11) default NULL,
  `total_m` int(11) default NULL,
  `total_t` int(11) default NULL,
  `training_received` int(11) default NULL,
  `training_not_received` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `ecd_num` (`ecd_num`),
  KEY `ecd_class_type` (`ecd_class_type`),
  KEY `pk` (`sch_num`,`sch_year`,`ecd_num`,`ecd_class_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for electives_f1
*/

drop table if exists `electives_f1`;
CREATE TABLE `electives_f1` (
  `sch_num` varchar(10) default NULL,
  `sch_year` varchar(4) default NULL,
  `elective_no` int(11) default NULL,
  `subject_name` varchar(50) default NULL,
  `total_f` int(10) default NULL,
  `total_m` int(10) default NULL,
  `total_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `subject_name` (`subject_name`),
  KEY `elective_no` (`elective_no`),
  KEY `pk` (`sch_num`,`sch_year`,`subject_name`,`elective_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for enr_rep_mig_class1_5_f1
*/

drop table if exists `enr_rep_mig_class1_5_f1`;
CREATE TABLE `enr_rep_mig_class1_5_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_prom_total_f` int(10) default NULL,
  `tot_prom_total_m` int(10) default NULL,
  `tot_prom_total_t` int(10) default NULL,
  `tot_rep_total_f` int(10) default NULL,
  `tot_rep_total_m` int(10) default NULL,
  `tot_rep_total_t` int(10) default NULL,
  `tot_new_enroll_total_f` int(10) default NULL,
  `tot_new_enroll_total_m` int(10) default NULL,
  `tot_new_enroll_total_t` int(10) default NULL,
  `tot_tran_total_f` int(10) default NULL,
  `tot_tran_total_m` int(10) default NULL,
  `tot_tran_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_prom_dalit_f` int(10) default NULL,
  `tot_prom_dalit_m` int(10) default NULL,
  `tot_prom_dalit_t` int(10) default NULL,
  `tot_rep_dalit_f` int(10) default NULL,
  `tot_rep_dalit_m` int(10) default NULL,
  `tot_rep_dalit_t` int(10) default NULL,
  `tot_new_enroll_dalit_f` int(10) default NULL,
  `tot_new_enroll_dalit_m` int(10) default NULL,
  `tot_new_enroll_dalit_t` int(10) default NULL,
  `tot_tran_dalit_f` int(10) default NULL,
  `tot_tran_dalit_m` int(10) default NULL,
  `tot_tran_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_prom_janjati_f` int(10) default NULL,
  `tot_prom_janjati_m` int(10) default NULL,
  `tot_prom_janjati_t` int(10) default NULL,
  `tot_rep_janjati_f` int(10) default NULL,
  `tot_rep_janjati_m` int(10) default NULL,
  `tot_rep_janjati_t` int(10) default NULL,
  `tot_new_enroll_janjati_f` int(10) default NULL,
  `tot_new_enroll_janjati_m` int(10) default NULL,
  `tot_new_enroll_janjati_t` int(10) default NULL,
  `tot_tran_janjati_f` int(10) default NULL,
  `tot_tran_janjati_m` int(10) default NULL,
  `tot_tran_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_prom_others_f` int(10) default NULL,
  `tot_prom_others_m` int(10) default NULL,
  `tot_prom_others_t` int(10) default NULL,
  `tot_rep_others_f` int(10) default NULL,
  `tot_rep_others_m` int(10) default NULL,
  `tot_rep_others_t` int(10) default NULL,
  `tot_new_enroll_others_f` int(10) default NULL,
  `tot_new_enroll_others_m` int(10) default NULL,
  `tot_new_enroll_others_t` int(10) default NULL,
  `tot_tran_others_f` int(10) default NULL,
  `tot_tran_others_m` int(10) default NULL,
  `tot_tran_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for enr_rep_mig_class6_8_f1
*/

drop table if exists `enr_rep_mig_class6_8_f1`;
CREATE TABLE `enr_rep_mig_class6_8_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_prom_total_f` int(10) default NULL,
  `tot_prom_total_m` int(10) default NULL,
  `tot_prom_total_t` int(10) default NULL,
  `tot_rep_total_f` int(10) default NULL,
  `tot_rep_total_m` int(10) default NULL,
  `tot_rep_total_t` int(10) default NULL,
  `tot_new_enroll_total_f` int(10) default NULL,
  `tot_new_enroll_total_m` int(10) default NULL,
  `tot_new_enroll_total_t` int(10) default NULL,
  `tot_tran_total_f` int(10) default NULL,
  `tot_tran_total_m` int(10) default NULL,
  `tot_tran_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_prom_dalit_f` int(10) default NULL,
  `tot_prom_dalit_m` int(10) default NULL,
  `tot_prom_dalit_t` int(10) default NULL,
  `tot_rep_dalit_f` int(10) default NULL,
  `tot_rep_dalit_m` int(10) default NULL,
  `tot_rep_dalit_t` int(10) default NULL,
  `tot_new_enroll_dalit_f` int(10) default NULL,
  `tot_new_enroll_dalit_m` int(10) default NULL,
  `tot_new_enroll_dalit_t` int(10) default NULL,
  `tot_tran_dalit_f` int(10) default NULL,
  `tot_tran_dalit_m` int(10) default NULL,
  `tot_tran_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_prom_janjati_f` int(10) default NULL,
  `tot_prom_janjati_m` int(10) default NULL,
  `tot_prom_janjati_t` int(10) default NULL,
  `tot_rep_janjati_f` int(10) default NULL,
  `tot_rep_janjati_m` int(10) default NULL,
  `tot_rep_janjati_t` int(10) default NULL,
  `tot_new_enroll_janjati_f` int(10) default NULL,
  `tot_new_enroll_janjati_m` int(10) default NULL,
  `tot_new_enroll_janjati_t` int(10) default NULL,
  `tot_tran_janjati_f` int(10) default NULL,
  `tot_tran_janjati_m` int(10) default NULL,
  `tot_tran_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_prom_others_f` int(10) default NULL,
  `tot_prom_others_m` int(10) default NULL,
  `tot_prom_others_t` int(10) default NULL,
  `tot_rep_others_f` int(10) default NULL,
  `tot_rep_others_m` int(10) default NULL,
  `tot_rep_others_t` int(10) default NULL,
  `tot_new_enroll_others_f` int(10) default NULL,
  `tot_new_enroll_others_m` int(10) default NULL,
  `tot_new_enroll_others_t` int(10) default NULL,
  `tot_tran_others_f` int(10) default NULL,
  `tot_tran_others_m` int(10) default NULL,
  `tot_tran_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for enr_rep_mig_class9_10_f1
*/

drop table if exists `enr_rep_mig_class9_10_f1`;
CREATE TABLE `enr_rep_mig_class9_10_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_prom_total_f` int(10) default NULL,
  `tot_prom_total_m` int(10) default NULL,
  `tot_prom_total_t` int(10) default NULL,
  `tot_rep_total_f` int(10) default NULL,
  `tot_rep_total_m` int(10) default NULL,
  `tot_rep_total_t` int(10) default NULL,
  `tot_new_enroll_total_f` int(10) default NULL,
  `tot_new_enroll_total_m` int(10) default NULL,
  `tot_new_enroll_total_t` int(10) default NULL,
  `tot_tran_total_f` int(10) default NULL,
  `tot_tran_total_m` int(10) default NULL,
  `tot_tran_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_prom_dalit_f` int(10) default NULL,
  `tot_prom_dalit_m` int(10) default NULL,
  `tot_prom_dalit_t` int(10) default NULL,
  `tot_rep_dalit_f` int(10) default NULL,
  `tot_rep_dalit_m` int(10) default NULL,
  `tot_rep_dalit_t` int(10) default NULL,
  `tot_new_enroll_dalit_f` int(10) default NULL,
  `tot_new_enroll_dalit_m` int(10) default NULL,
  `tot_new_enroll_dalit_t` int(10) default NULL,
  `tot_tran_dalit_f` int(10) default NULL,
  `tot_tran_dalit_m` int(10) default NULL,
  `tot_tran_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_prom_janjati_f` int(10) default NULL,
  `tot_prom_janjati_m` int(10) default NULL,
  `tot_prom_janjati_t` int(10) default NULL,
  `tot_rep_janjati_f` int(10) default NULL,
  `tot_rep_janjati_m` int(10) default NULL,
  `tot_rep_janjati_t` int(10) default NULL,
  `tot_new_enroll_janjati_f` int(10) default NULL,
  `tot_new_enroll_janjati_m` int(10) default NULL,
  `tot_new_enroll_janjati_t` int(10) default NULL,
  `tot_tran_janjati_f` int(10) default NULL,
  `tot_tran_janjati_m` int(10) default NULL,
  `tot_tran_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_prom_others_f` int(10) default NULL,
  `tot_prom_others_m` int(10) default NULL,
  `tot_prom_others_t` int(10) default NULL,
  `tot_rep_others_f` int(10) default NULL,
  `tot_rep_others_m` int(10) default NULL,
  `tot_rep_others_t` int(10) default NULL,
  `tot_new_enroll_others_f` int(10) default NULL,
  `tot_new_enroll_others_m` int(10) default NULL,
  `tot_new_enroll_others_t` int(10) default NULL,
  `tot_tran_others_f` int(10) default NULL,
  `tot_tran_others_m` int(10) default NULL,
  `tot_tran_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for finance_expn_f1
*/

drop table if exists `finance_expn_f1`;
CREATE TABLE `finance_expn_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `salary` int(10) default NULL,
  `rahat` int(11) default NULL,
  `scholarship` int(10) default NULL,
  `materials` int(10) default NULL,
  `school_recon` int(10) default NULL,
  `stationery` int(11) default NULL,
  `textbook` int(11) default NULL,
  `student_teacher_benefits` int(10) default NULL,
  `school_improv` int(10) default NULL,
  `others` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for finance_income_f1
*/

drop table if exists `finance_income_f1`;
CREATE TABLE `finance_income_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `govt_support` int(10) default NULL,
  `rahat` int(11) default NULL,
  `scholarship` int(10) default NULL,
  `block_grant` int(10) default NULL,
  `other_govt_support` int(10) default NULL,
  `student_fee` int(11) default NULL,
  `others` int(10) default NULL,
  `pcf` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for headmaster_f1
*/

drop table if exists `headmaster_f1`;
CREATE TABLE `headmaster_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `headmaster` varchar(50) default NULL,
  `hmaster_status` varchar(50) default NULL,
  `hmaster_educ_status` varchar(50) default NULL,
  `hmaster_job_status` varchar(50) default NULL,
  `hmaster_job_level` varchar(50) default NULL,
  `hmaster_training` varchar(50) default NULL,
  `hmaster_initial_status` varchar(50) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_current_details_f1
*/

drop table if exists `hsec_current_details_f1`;
CREATE TABLE `hsec_current_details_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `faculty_list` varchar(30) NOT NULL,
  `class` varchar(5) NOT NULL,
  `tot_f` int(10) default NULL,
  `tot_m` int(10) default NULL,
  `tot_t` int(10) default NULL,
  `dalit_f` int(10) default NULL,
  `dalit_m` int(10) default NULL,
  `dalit_t` int(10) default NULL,
  `janjati_f` int(10) default NULL,
  `janjati_m` int(10) default NULL,
  `janjati_t` int(10) default NULL,
  `others_f` int(10) default NULL,
  `others_m` int(10) default NULL,
  `others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `faculty_list` (`faculty_list`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`faculty_list`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_dalit_enroll_age_f1
*/

drop table if exists `hsec_dalit_enroll_age_f1`;
CREATE TABLE `hsec_dalit_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `f_l15` int(10) default NULL,
  `m_l15` int(10) default NULL,
  `t_l15` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_15_16` int(10) default NULL,
  `m_15_16` int(10) default NULL,
  `t_15_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_l16` int(10) default NULL,
  `m_l16` int(10) default NULL,
  `t_l16` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_disabled_f1
*/

drop table if exists `hsec_disabled_f1`;
CREATE TABLE `hsec_disabled_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `disability_type_id` int(10) NOT NULL,
  `disabled_f` int(10) default NULL,
  `disabled_m` int(10) default NULL,
  `disabled_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `disability_type_id` (`disability_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`disability_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_janjati_enroll_age_f1
*/

drop table if exists `hsec_janjati_enroll_age_f1`;
CREATE TABLE `hsec_janjati_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l15` int(10) default NULL,
  `m_l15` int(10) default NULL,
  `t_l15` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_15_16` int(10) default NULL,
  `m_15_16` int(10) default NULL,
  `t_15_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_l16` int(10) default NULL,
  `m_l16` int(10) default NULL,
  `t_l16` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_last_exam_details_f1
*/

drop table if exists `hsec_last_exam_details_f1`;
CREATE TABLE `hsec_last_exam_details_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `faculty_list` varchar(30) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_app_f` int(10) default NULL,
  `tot_app_m` int(10) default NULL,
  `tot_app_t` int(10) default NULL,
  `dalit_app_f` int(10) default NULL,
  `dalit_app_m` int(10) default NULL,
  `dalit_app_t` int(10) default NULL,
  `janjati_app_f` int(10) default NULL,
  `janjati_app_m` int(10) default NULL,
  `janjati_app_t` int(10) default NULL,
  `tot_pass_f` int(10) default NULL,
  `tot_pass_m` int(10) default NULL,
  `tot_pass_t` int(10) default NULL,
  `dalit_pass_f` int(10) default NULL,
  `dalit_pass_m` int(10) default NULL,
  `dalit_pass_t` int(10) default NULL,
  `janjati_pass_f` int(10) default NULL,
  `janjati_pass_m` int(10) default NULL,
  `janjati_pass_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `faculty_list` (`faculty_list`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`faculty_list`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_new_faculty_f1
*/

drop table if exists `hsec_new_faculty_f1`;
CREATE TABLE `hsec_new_faculty_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(5) NOT NULL,
  `new_faculty` varchar(50) default NULL,
  `faculty_start_year` varchar(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_scholarship_f1
*/

drop table if exists `hsec_scholarship_f1`;
CREATE TABLE `hsec_scholarship_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `scholarship_total_f` int(10) default NULL,
  `scholarship_total_m` int(10) default NULL,
  `scholarship_total_t` int(10) default NULL,
  `scholarship_dalit_f` int(10) default NULL,
  `scholarship_dalit_m` int(10) default NULL,
  `scholarship_dalit_t` int(10) default NULL,
  `scholarship_janjati_f` int(10) default NULL,
  `scholarship_janjati_m` int(10) default NULL,
  `scholarship_janjati_t` int(10) default NULL,
  `encourage_total_f` int(10) default NULL,
  `encourage_total_m` int(10) default NULL,
  `encourage_total_t` int(10) default NULL,
  `encourage_dalit_f` int(10) default NULL,
  `encourage_dalit_m` int(10) default NULL,
  `encourage_dalit_t` int(10) default NULL,
  `encourage_janjati_f` int(10) default NULL,
  `encourage_janjati_m` int(10) default NULL,
  `encourage_janjati_t` int(10) default NULL,
  `loan_total_f` int(10) default NULL,
  `loan_total_m` int(10) default NULL,
  `loan_total_t` int(10) default NULL,
  `loan_dalit_f` int(10) default NULL,
  `loan_dalit_m` int(10) default NULL,
  `loan_dalit_t` int(10) default NULL,
  `loan_janjati_f` int(10) default NULL,
  `loan_janjati_m` int(10) default NULL,
  `loan_janjati_t` int(10) default NULL,
  `others_total_f` int(10) default NULL,
  `others_total_m` int(10) default NULL,
  `others_total_t` int(10) default NULL,
  `others_dalit_f` int(10) default NULL,
  `others_dalit_m` int(10) default NULL,
  `others_dalit_t` int(10) default NULL,
  `others_janjati_f` int(10) default NULL,
  `others_janjati_m` int(10) default NULL,
  `others_janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_teacher_details_f1
*/

drop table if exists `hsec_teacher_details_f1`;
CREATE TABLE `hsec_teacher_details_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_slc_f` int(11) default NULL,
  `under_slc_m` int(11) default NULL,
  `under_slc_t` int(11) default NULL,
  `slc_f` int(11) default NULL,
  `slc_m` int(11) default NULL,
  `slc_t` int(11) default NULL,
  `ia_f` int(11) default NULL,
  `ia_m` int(11) default NULL,
  `ia_t` int(11) default NULL,
  `ba_f` int(11) default NULL,
  `ba_m` int(11) default NULL,
  `ba_t` int(11) default NULL,
  `under_ma_f` int(10) default NULL,
  `under_ma_m` int(10) default NULL,
  `under_ma_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `phd_f` int(11) default NULL,
  `phd_m` int(11) default NULL,
  `phd_t` int(11) default NULL,
  `educ_faculty_f` int(10) default NULL,
  `educ_faculty_m` int(10) default NULL,
  `educ_faculty_t` int(10) default NULL,
  `other_faculty_f` int(10) default NULL,
  `other_faculty_m` int(10) default NULL,
  `other_faculty_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_fulltimer` int(11) default NULL,
  `teacher_parttimer` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_teacher_training_f1
*/

drop table if exists `hsec_teacher_training_f1`;
CREATE TABLE `hsec_teacher_training_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `fully_trained_total_f` int(10) default NULL,
  `fully_trained_total_m` int(10) default NULL,
  `fully_trained_total_t` int(10) default NULL,
  `fully_trained_dalit_f` int(10) default NULL,
  `fully_trained_dalit_m` int(10) default NULL,
  `fully_trained_dalit_t` int(10) default NULL,
  `fully_trained_janjati_f` int(10) default NULL,
  `fully_trained_janjati_m` int(10) default NULL,
  `fully_trained_janjati_t` int(10) default NULL,
  `part_trained_total_f` int(10) default NULL,
  `part_trained_total_m` int(10) default NULL,
  `part_trained_dalit_f` int(10) default NULL,
  `part_trained_dalit_m` int(10) default NULL,
  `part_trained_janjati_f` int(10) default NULL,
  `part_trained_janjati_m` int(10) default NULL,
  `untrained_total_f` int(10) default NULL,
  `untrained_total_m` int(10) default NULL,
  `untrained_total_t` int(10) default NULL,
  `untrained_dalit_f` int(10) default NULL,
  `untrained_dalit_m` int(10) default NULL,
  `untrained_dalit_t` int(10) default NULL,
  `untrained_janjati_f` int(10) default NULL,
  `untrained_janjati_m` int(10) default NULL,
  `untrained_janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_total_enroll_age_f1
*/

drop table if exists `hsec_total_enroll_age_f1`;
CREATE TABLE `hsec_total_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l15` int(10) default NULL,
  `m_l15` int(10) default NULL,
  `t_l15` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_15_16` int(10) default NULL,
  `m_15_16` int(10) default NULL,
  `t_15_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_l16` int(10) default NULL,
  `m_l16` int(10) default NULL,
  `t_l16` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for hsec_total_passed_f1
*/

drop table if exists `hsec_total_passed_f1`;
CREATE TABLE `hsec_total_passed_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `passed_male` int(10) default NULL,
  `passed_female` int(10) default NULL,
  `passed_total` int(10) default NULL,
  `passed_dalit_female` int(10) default NULL,
  `passed_dalit_male` int(10) default NULL,
  `passed_dalit_total` int(10) default NULL,
  `passed_janjati_female` int(10) default NULL,
  `passed_janjati_male` int(10) default NULL,
  `passed_janjati_total` int(10) default NULL,
  `enr_male` int(10) default NULL,
  `enr_female` int(10) default NULL,
  `enr_total` int(10) default NULL,
  `enr_dalit_female` int(10) default NULL,
  `enr_dalit_male` int(10) default NULL,
  `enr_dalit_total` int(10) default NULL,
  `enr_janjati_female` int(10) default NULL,
  `enr_janjati_male` int(10) default NULL,
  `enr_janjati_total` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for inf_sch_pta
*/

drop table if exists `inf_sch_pta`;
CREATE TABLE `inf_sch_pta` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `pta_year` varchar(10) default NULL,
  `pta_month` varchar(10) default NULL,
  `pta_day` varchar(10) default NULL,
  `election` tinyint(4) default NULL,
  `selection` tinyint(4) default NULL,
  `tot_members` int(11) default NULL,
  `tot_f` int(11) default NULL,
  `tot_m` int(11) default NULL,
  `tot_dalit` int(11) default NULL,
  `tot_janjati` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section A6 - Parent Teacher Association';

/*
Table structure for inf_sch_smc
*/

drop table if exists `inf_sch_smc`;
CREATE TABLE `inf_sch_smc` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `smc_year` varchar(10) default NULL,
  `smc_month` varchar(10) default NULL,
  `smc_day` varchar(10) default NULL,
  `election` tinyint(4) default NULL,
  `selection` tinyint(4) default NULL,
  `tot_members` int(11) default NULL,
  `tot_f` int(11) default NULL,
  `tot_m` int(11) default NULL,
  `tot_dalit` int(11) default NULL,
  `tot_janjati` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section A5 - School Management Comittee';

/*
Table structure for janjati_f1
*/

drop table if exists `janjati_f1`;
CREATE TABLE `janjati_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `janjati_type` varchar(50) NOT NULL,
  `class` int(11) NOT NULL,
  `total_f` int(10) default NULL,
  `total_m` int(10) default NULL,
  `total_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `janjati_type` (`janjati_type`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`janjati_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for language_f1
*/

drop table if exists `language_f1`;
CREATE TABLE `language_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `language` varchar(50) NOT NULL,
  `class` int(11) NOT NULL,
  `female` int(11) default NULL,
  `male` int(11) default NULL,
  `total` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `language` (`language`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for last_class1_5_enroll_f1
*/

drop table if exists `last_class1_5_enroll_f1`;
CREATE TABLE `last_class1_5_enroll_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_appeared_exam_total_f` int(10) default NULL,
  `tot_appeared_exam_total_m` int(10) default NULL,
  `tot_appeared_exam_total_t` int(10) default NULL,
  `tot_passed_exam_total_f` int(10) default NULL,
  `tot_passed_exam_total_m` int(10) default NULL,
  `tot_passed_exam_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_appeared_exam_dalit_f` int(10) default NULL,
  `tot_appeared_exam_dalit_m` int(10) default NULL,
  `tot_appeared_exam_dalit_t` int(10) default NULL,
  `tot_passed_exam_dalit_f` int(10) default NULL,
  `tot_passed_exam_dalit_m` int(10) default NULL,
  `tot_passed_exam_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_appeared_exam_janjati_f` int(10) default NULL,
  `tot_appeared_exam_janjati_m` int(10) default NULL,
  `tot_appeared_exam_janjati_t` int(10) default NULL,
  `tot_passed_exam_janjati_f` int(10) default NULL,
  `tot_passed_exam_janjati_m` int(10) default NULL,
  `tot_passed_exam_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_appeared_exam_others_f` int(10) default NULL,
  `tot_appeared_exam_others_m` int(10) default NULL,
  `tot_appeared_exam_others_t` int(10) default NULL,
  `tot_passed_exam_others_f` int(10) default NULL,
  `tot_passed_exam_others_m` int(10) default NULL,
  `tot_passed_exam_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for last_class6_8_enroll_f1
*/

drop table if exists `last_class6_8_enroll_f1`;
CREATE TABLE `last_class6_8_enroll_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_appeared_exam_total_f` int(10) default NULL,
  `tot_appeared_exam_total_m` int(10) default NULL,
  `tot_appeared_exam_total_t` int(10) default NULL,
  `tot_passed_exam_total_f` int(10) default NULL,
  `tot_passed_exam_total_m` int(10) default NULL,
  `tot_passed_exam_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_appeared_exam_dalit_f` int(10) default NULL,
  `tot_appeared_exam_dalit_m` int(10) default NULL,
  `tot_appeared_exam_dalit_t` int(10) default NULL,
  `tot_passed_exam_dalit_f` int(10) default NULL,
  `tot_passed_exam_dalit_m` int(10) default NULL,
  `tot_passed_exam_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_appeared_exam_janjati_f` int(10) default NULL,
  `tot_appeared_exam_janjati_m` int(10) default NULL,
  `tot_appeared_exam_janjati_t` int(10) default NULL,
  `tot_passed_exam_janjati_f` int(10) default NULL,
  `tot_passed_exam_janjati_m` int(10) default NULL,
  `tot_passed_exam_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_appeared_exam_others_f` int(10) default NULL,
  `tot_appeared_exam_others_m` int(10) default NULL,
  `tot_appeared_exam_others_t` int(10) default NULL,
  `tot_passed_exam_others_f` int(10) default NULL,
  `tot_passed_exam_others_m` int(10) default NULL,
  `tot_passed_exam_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for last_class9_10_enroll_f1
*/

drop table if exists `last_class9_10_enroll_f1`;
CREATE TABLE `last_class9_10_enroll_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `tot_enroll_total_f` int(10) default NULL,
  `tot_enroll_total_m` int(10) default NULL,
  `tot_enroll_total_t` int(10) default NULL,
  `tot_appeared_exam_total_f` int(10) default NULL,
  `tot_appeared_exam_total_m` int(10) default NULL,
  `tot_appeared_exam_total_t` int(10) default NULL,
  `tot_passed_exam_total_f` int(10) default NULL,
  `tot_passed_exam_total_m` int(10) default NULL,
  `tot_passed_exam_total_t` int(10) default NULL,
  `tot_enroll_dalit_f` int(10) default NULL,
  `tot_enroll_dalit_m` int(10) default NULL,
  `tot_enroll_dalit_t` int(10) default NULL,
  `tot_appeared_exam_dalit_f` int(10) default NULL,
  `tot_appeared_exam_dalit_m` int(10) default NULL,
  `tot_appeared_exam_dalit_t` int(10) default NULL,
  `tot_passed_exam_dalit_f` int(10) default NULL,
  `tot_passed_exam_dalit_m` int(10) default NULL,
  `tot_passed_exam_dalit_t` int(10) default NULL,
  `tot_enroll_janjati_f` int(10) default NULL,
  `tot_enroll_janjati_m` int(10) default NULL,
  `tot_enroll_janjati_t` int(10) default NULL,
  `tot_appeared_exam_janjati_f` int(10) default NULL,
  `tot_appeared_exam_janjati_m` int(10) default NULL,
  `tot_appeared_exam_janjati_t` int(10) default NULL,
  `tot_passed_exam_janjati_f` int(10) default NULL,
  `tot_passed_exam_janjati_m` int(10) default NULL,
  `tot_passed_exam_janjati_t` int(10) default NULL,
  `tot_enroll_others_f` int(10) default NULL,
  `tot_enroll_others_m` int(10) default NULL,
  `tot_enroll_others_t` int(10) default NULL,
  `tot_appeared_exam_others_f` int(10) default NULL,
  `tot_appeared_exam_others_m` int(10) default NULL,
  `tot_appeared_exam_others_t` int(10) default NULL,
  `tot_passed_exam_others_f` int(10) default NULL,
  `tot_passed_exam_others_m` int(10) default NULL,
  `tot_passed_exam_others_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lsec_disabled_f1
*/

drop table if exists `lsec_disabled_f1`;
CREATE TABLE `lsec_disabled_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(5) NOT NULL,
  `disability_type_id` int(10) NOT NULL,
  `disabled_f` int(10) default NULL,
  `disabled_m` int(10) default NULL,
  `disabled_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `disability_type_id` (`disability_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`disability_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lsec_teacher_details_dalit_f1
*/

drop table if exists `lsec_teacher_details_dalit_f1`;
CREATE TABLE `lsec_teacher_details_dalit_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_ia_f` int(10) default NULL,
  `under_ia_m` int(10) default NULL,
  `under_ia_t` int(10) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lsec_teacher_details_f1
*/

drop table if exists `lsec_teacher_details_f1`;
CREATE TABLE `lsec_teacher_details_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_ia_f` int(10) default NULL,
  `under_ia_m` int(10) default NULL,
  `under_ia_t` int(10) default NULL,
  `under_slc_f` int(11) default NULL,
  `under_slc_m` int(11) default NULL,
  `under_slc_t` int(11) default NULL,
  `slc_f` int(11) default NULL,
  `slc_m` int(11) default NULL,
  `slc_t` int(11) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `phd_f` int(11) default NULL,
  `phd_m` int(11) default NULL,
  `phd_t` int(11) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lsec_teacher_details_janjati_f1
*/

drop table if exists `lsec_teacher_details_janjati_f1`;
CREATE TABLE `lsec_teacher_details_janjati_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_ia_f` int(10) default NULL,
  `under_ia_m` int(10) default NULL,
  `under_ia_t` int(10) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lsec_teacher_training_f1
*/

drop table if exists `lsec_teacher_training_f1`;
CREATE TABLE `lsec_teacher_training_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `fully_trained_total_f` int(10) default NULL,
  `fully_trained_total_m` int(10) default NULL,
  `fully_trained_total_t` int(10) default NULL,
  `fully_trained_dalit_f` int(10) default NULL,
  `fully_trained_dalit_m` int(10) default NULL,
  `fully_trained_dalit_t` int(10) default NULL,
  `fully_trained_janjati_f` int(10) default NULL,
  `fully_trained_janjati_m` int(10) default NULL,
  `fully_trained_janjati_t` int(10) default NULL,
  `part_trained_total_f` int(10) default NULL,
  `part_trained_total_m` int(10) default NULL,
  `part_trained_total_t` int(11) default NULL,
  `part_trained_dalit_f` int(10) default NULL,
  `part_trained_dalit_m` int(10) default NULL,
  `part_trained_dalit_t` int(11) default NULL,
  `part_trained_janjati_f` int(10) default NULL,
  `part_trained_janjati_m` int(10) default NULL,
  `part_trained_janjati_t` int(11) default NULL,
  `first_package_total_f` int(10) default NULL,
  `first_package_total_m` int(10) default NULL,
  `first_package_total_t` int(10) default NULL,
  `first_package_dalit_f` int(10) default NULL,
  `first_package_dalit_m` int(10) default NULL,
  `first_package_dalit_t` int(10) default NULL,
  `first_package_janjati_f` int(10) default NULL,
  `first_package_janjati_m` int(10) default NULL,
  `first_package_janjati_t` int(10) default NULL,
  `second_package_total_f` int(10) default NULL,
  `second_package_total_m` int(10) default NULL,
  `second_package_total_t` int(10) default NULL,
  `second_package_dalit_f` int(10) default NULL,
  `second_package_dalit_m` int(10) default NULL,
  `second_package_dalit_t` int(10) default NULL,
  `second_package_janjati_f` int(10) default NULL,
  `second_package_janjati_m` int(10) default NULL,
  `second_package_janjati_t` int(10) default NULL,
  `third_package_total_f` int(10) default NULL,
  `third_package_total_m` int(10) default NULL,
  `third_package_total_t` int(10) default NULL,
  `third_package_dalit_f` int(10) default NULL,
  `third_package_dalit_m` int(10) default NULL,
  `third_package_dalit_t` int(10) default NULL,
  `third_package_janjati_f` int(10) default NULL,
  `third_package_janjati_m` int(10) default NULL,
  `third_package_janjati_t` int(10) default NULL,
  `untrained_total_f` int(10) default NULL,
  `untrained_total_m` int(10) default NULL,
  `untrained_total_t` int(10) default NULL,
  `untrained_dalit_f` int(10) default NULL,
  `untrained_dalit_m` int(10) default NULL,
  `untrained_dalit_t` int(10) default NULL,
  `untrained_janjati_f` int(10) default NULL,
  `untrained_janjati_m` int(10) default NULL,
  `untrained_janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for lss_scholarship
*/

drop table if exists `lss_scholarship`;
CREATE TABLE `lss_scholarship` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `class` varchar(10) NOT NULL,
  `scholarship_type_id` int(11) NOT NULL,
  `female` int(11) default NULL,
  `male` int(11) default NULL,
  `total` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `scholarship_type_id` (`scholarship_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`scholarship_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for mast_district
*/

drop table if exists `mast_district`;
CREATE TABLE `mast_district` (
  `dist_code` varchar(30) NOT NULL default '',
  `dist_name` varchar(20) default NULL,
  KEY `dist_code` (`dist_code`),
  KEY `pk` (`dist_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for mast_school_type
*/

drop table if exists `mast_school_type`;
CREATE TABLE `mast_school_type` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `ecd` int(11) default NULL,
  `class1` int(11) default NULL,
  `class2` int(11) default NULL,
  `class3` int(11) default NULL,
  `class4` int(11) default NULL,
  `class5` int(11) default NULL,
  `class6` int(11) default NULL,
  `class7` int(11) default NULL,
  `class8` int(11) default NULL,
  `class9` int(11) default NULL,
  `class10` int(11) default NULL,
  `class11` int(11) default NULL,
  `class12` int(11) default NULL,
  `flash` int(11) NOT NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `flash` (`flash`),
  KEY `pk` (`sch_num`,`sch_year`,`flash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Section A4 - Type of School and grades offered';

/*
Table structure for mast_schoollist
*/

drop table if exists `mast_schoollist`;
CREATE TABLE `mast_schoollist` (
  `dist_code` varchar(50) default NULL,
  `vdc_code` varchar(100) default NULL,
  `sch_code` varchar(100) default NULL,
  `sch_year` varchar(4) NOT NULL,
  `nm_sch` varchar(100) default NULL,
  `wardno` varchar(100) default NULL,
  `location` varchar(100) default NULL,
  `post_office` varchar(50) default NULL,
  `estd_date` varchar(20) default NULL,
  `telno` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `region` varchar(50) default NULL,
  `sch_num` varchar(100) NOT NULL,
  `flash` int(11) NOT NULL,
  `tmis` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `flash` (`flash`),
  KEY `pk` (`sch_num`,`sch_year`,`flash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='MyISAM free: 10240 kB';

/*
Table structure for mast_vdc
*/

drop table if exists `mast_vdc`;
CREATE TABLE `mast_vdc` (
  `dist_code` varchar(5) NOT NULL,
  `vdc_code` varchar(5) NOT NULL,
  `vdc_name_e` varchar(250) default NULL,
  `uniquevdc` varchar(5) default NULL,
  KEY `dist_code` (`dist_code`),
  KEY `vdc_code` (`vdc_code`),
  KEY `pk` (`dist_code`,`vdc_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Master VDC list';

/*
Table structure for new_dalit_enroll_age_f1
*/

drop table if exists `new_dalit_enroll_age_f1`;
CREATE TABLE `new_dalit_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for new_janjati_enroll_age_f1
*/

drop table if exists `new_janjati_enroll_age_f1`;
CREATE TABLE `new_janjati_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for new_total_enroll_age_f1
*/

drop table if exists `new_total_enroll_age_f1`;
CREATE TABLE `new_total_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for non_teaching_staff_f1
*/

drop table if exists `non_teaching_staff_f1`;
CREATE TABLE `non_teaching_staff_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `account_f` int(10) default NULL,
  `account_m` int(10) default NULL,
  `account_t` int(11) default NULL,
  `admin_f` int(11) default NULL,
  `admin_m` int(11) default NULL,
  `admin_t` int(11) default NULL,
  `other_f` int(11) default NULL,
  `other_m` int(11) default NULL,
  `other_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pr_dalit_enroll_age_f1
*/

drop table if exists `pr_dalit_enroll_age_f1`;
CREATE TABLE `pr_dalit_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `f_l6` int(10) default NULL,
  `m_l6` int(10) default NULL,
  `t_l6` int(10) default NULL,
  `f_l7` int(10) default NULL,
  `m_l7` int(10) default NULL,
  `t_l7` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8_9` int(10) default NULL,
  `m_8_9` int(10) default NULL,
  `t_8_9` int(10) default NULL,
  `f_l8` int(10) default NULL,
  `m_l8` int(10) default NULL,
  `t_l8` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_l9` int(10) default NULL,
  `m_l9` int(10) default NULL,
  `t_l9` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_g10` int(10) default NULL,
  `m_g10` int(10) default NULL,
  `t_g10` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_g11` int(10) default NULL,
  `m_g11` int(10) default NULL,
  `t_g11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pr_disabled_f1
*/

drop table if exists `pr_disabled_f1`;
CREATE TABLE `pr_disabled_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `disability_type_id` int(10) NOT NULL default '0',
  `disabled_f` int(10) default NULL,
  `disabled_m` int(10) default NULL,
  `disabled_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `disability_type_id` (`disability_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`disability_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pr_janjati_enroll_age_f1
*/

drop table if exists `pr_janjati_enroll_age_f1`;
CREATE TABLE `pr_janjati_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `f_l6` int(10) default NULL,
  `m_l6` int(10) default NULL,
  `t_l6` int(10) default NULL,
  `f_l7` int(10) default NULL,
  `m_l7` int(10) default NULL,
  `t_l7` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8_9` int(10) default NULL,
  `m_8_9` int(10) default NULL,
  `t_8_9` int(10) default NULL,
  `f_l8` int(10) default NULL,
  `m_l8` int(10) default NULL,
  `t_l8` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_l9` int(10) default NULL,
  `m_l9` int(10) default NULL,
  `t_l9` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_g10` int(10) default NULL,
  `m_g10` int(10) default NULL,
  `t_g10` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_g11` int(10) default NULL,
  `m_g11` int(10) default NULL,
  `t_g11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pr_scholarship
*/

drop table if exists `pr_scholarship`;
CREATE TABLE `pr_scholarship` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(10) NOT NULL default '',
  `scholarship_type_id` int(11) NOT NULL default '0',
  `female` int(11) default NULL,
  `male` int(11) default NULL,
  `total` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `scholarship_type_id` (`scholarship_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`scholarship_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pr_total_enroll_age_f1
*/

drop table if exists `pr_total_enroll_age_f1`;
CREATE TABLE `pr_total_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l5` int(10) default NULL,
  `m_l5` int(10) default NULL,
  `t_l5` int(10) default NULL,
  `f_5` int(10) default NULL,
  `m_5` int(10) default NULL,
  `t_5` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7_9` int(10) default NULL,
  `m_7_9` int(10) default NULL,
  `t_7_9` int(10) default NULL,
  `f_g9` int(10) default NULL,
  `m_g9` int(10) default NULL,
  `t_g9` int(10) default NULL,
  `f_l6` int(10) default NULL,
  `m_l6` int(10) default NULL,
  `t_l6` int(10) default NULL,
  `f_l7` int(10) default NULL,
  `m_l7` int(10) default NULL,
  `t_l7` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8_9` int(10) default NULL,
  `m_8_9` int(10) default NULL,
  `t_8_9` int(10) default NULL,
  `f_l8` int(10) default NULL,
  `m_l8` int(10) default NULL,
  `t_l8` int(10) default NULL,
  `f_8` int(10) default NULL,
  `m_8` int(10) default NULL,
  `t_8` int(10) default NULL,
  `f_9` int(10) default NULL,
  `m_9` int(10) default NULL,
  `t_9` int(10) default NULL,
  `f_l9` int(10) default NULL,
  `m_l9` int(10) default NULL,
  `t_l9` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_g10` int(10) default NULL,
  `m_g10` int(10) default NULL,
  `t_g10` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_g11` int(10) default NULL,
  `m_g11` int(10) default NULL,
  `t_g11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pri_teacher_details_dalit_f1
*/

drop table if exists `pri_teacher_details_dalit_f1`;
CREATE TABLE `pri_teacher_details_dalit_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_slc_f` int(10) default NULL,
  `under_slc_m` int(10) default NULL,
  `under_slc_t` int(10) default NULL,
  `slc_f` int(10) default NULL,
  `slc_m` int(10) default NULL,
  `slc_t` int(10) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pri_teacher_details_f1
*/

drop table if exists `pri_teacher_details_f1`;
CREATE TABLE `pri_teacher_details_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_slc_f` int(10) default NULL,
  `under_slc_m` int(10) default NULL,
  `under_slc_t` int(10) default NULL,
  `slc_f` int(10) default NULL,
  `slc_m` int(10) default NULL,
  `slc_t` int(10) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `phd_f` int(11) default NULL,
  `phd_m` int(11) default NULL,
  `phd_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pri_teacher_details_janjati_f1
*/

drop table if exists `pri_teacher_details_janjati_f1`;
CREATE TABLE `pri_teacher_details_janjati_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_slc_f` int(10) default NULL,
  `under_slc_m` int(10) default NULL,
  `under_slc_t` int(10) default NULL,
  `slc_f` int(10) default NULL,
  `slc_m` int(10) default NULL,
  `slc_t` int(10) default NULL,
  `ia_f` int(10) default NULL,
  `ia_m` int(10) default NULL,
  `ia_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for pri_teacher_training_f1
*/

drop table if exists `pri_teacher_training_f1`;
CREATE TABLE `pri_teacher_training_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `fully_trained_total_f` int(10) default NULL,
  `fully_trained_total_m` int(10) default NULL,
  `fully_trained_total_t` int(10) default NULL,
  `fully_trained_dalit_f` int(10) default NULL,
  `fully_trained_dalit_m` int(10) default NULL,
  `fully_trained_dalit_t` int(10) default NULL,
  `fully_trained_janjati_f` int(10) default NULL,
  `fully_trained_janjati_m` int(10) default NULL,
  `fully_trained_janjati_t` int(10) default NULL,
  `part_trained_total_f` int(10) default NULL,
  `part_trained_total_m` int(10) default NULL,
  `part_trained_total_t` int(11) default NULL,
  `part_trained_dalit_f` int(10) default NULL,
  `part_trained_dalit_m` int(10) default NULL,
  `part_trained_dalit_t` int(11) default NULL,
  `part_trained_janjati_f` int(10) default NULL,
  `part_trained_janjati_m` int(10) default NULL,
  `part_trained_janjati_t` int(11) default NULL,
  `first_package_total_f` int(10) default NULL,
  `first_package_total_m` int(10) default NULL,
  `first_package_total_t` int(10) default NULL,
  `first_package_dalit_f` int(10) default NULL,
  `first_package_dalit_m` int(10) default NULL,
  `first_package_dalit_t` int(10) default NULL,
  `first_package_janjati_f` int(10) default NULL,
  `first_package_janjati_m` int(10) default NULL,
  `first_package_janjati_t` int(10) default NULL,
  `second_package_total_f` int(10) default NULL,
  `second_package_total_m` int(10) default NULL,
  `second_package_total_t` int(10) default NULL,
  `second_package_dalit_f` int(10) default NULL,
  `second_package_dalit_m` int(10) default NULL,
  `second_package_dalit_t` int(10) default NULL,
  `second_package_janjati_f` int(10) default NULL,
  `second_package_janjati_m` int(10) default NULL,
  `second_package_janjati_t` int(10) default NULL,
  `untrained_total_f` int(10) default NULL,
  `untrained_total_m` int(10) default NULL,
  `untrained_total_t` int(10) default NULL,
  `untrained_dalit_f` int(10) default NULL,
  `untrained_dalit_m` int(10) default NULL,
  `untrained_dalit_t` int(10) default NULL,
  `untrained_janjati_f` int(10) default NULL,
  `untrained_janjati_m` int(10) default NULL,
  `untrained_janjati_t` int(10) default NULL,
  `hour_trained_total_f` int(10) default NULL,
  `hour_trained_total_m` int(10) default NULL,
  `hour_trained_total_t` int(10) default NULL,
  `hour_trained_dalit_f` int(10) default NULL,
  `hour_trained_dalit_m` int(10) default NULL,
  `hour_trained_dalit_t` int(10) default NULL,
  `hour_trained_janjati_f` int(10) default NULL,
  `hour_trained_janjati_m` int(10) default NULL,
  `hour_trained_janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for scholarship_info
*/

drop table if exists `scholarship_info`;
CREATE TABLE `scholarship_info` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `dalit_num` int(11) default NULL,
  `dalit_amount` int(11) default NULL,
  `karnali_num` int(11) default NULL,
  `karnali_amount` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for school_physical
*/

drop table if exists `school_physical`;
CREATE TABLE `school_physical` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(10) NOT NULL default '',
  `compound` int(11) default NULL,
  `cstatus` varchar(10) default NULL,
  `water` int(11) default NULL,
  `water_tap` int(11) default NULL,
  `water_tubewell` int(11) default NULL,
  `water_well` int(11) default NULL,
  `water_other` int(10) default NULL,
  `toilet` int(11) default NULL,
  `t_total` int(11) default NULL,
  `t_all` int(11) default NULL,
  `t_girls` int(11) default NULL,
  `t_teachers` int(11) default NULL,
  `urinal` int(11) default NULL,
  `urinal_girls` int(11) default NULL,
  `urinal_teachers` int(11) default NULL,
  `pground` int(11) default NULL,
  `pground_enough_space` int(11) default NULL,
  `computer_room` int(11) default NULL,
  `num_computers` int(11) default NULL,
  `admin_computers` int(11) default NULL,
  `teaching_computers` int(11) default NULL,
  `electricity` int(11) default NULL,
  `land_bigaha` int(11) default NULL,
  `land_kattha` int(11) default NULL,
  `land_dhur` int(11) default NULL,
  `land_ropani` int(11) default NULL,
  `land_aana` int(11) default NULL,
  `land_paisa` int(11) default NULL,
  `land_daam` int(11) default NULL,
  `compound_bigaha` int(11) default NULL,
  `compound_kattha` int(11) default NULL,
  `compound_dhur` int(11) default NULL,
  `compound_ropani` int(11) default NULL,
  `compound_aana` int(11) default NULL,
  `compound_paisa` int(11) default NULL,
  `compound_daam` int(11) default NULL,
  `num_buildings` int(11) default NULL,
  `rigid_buildings` int(11) default NULL,
  `weak_buildings` int(11) default NULL,
  `buildings_govt` int(11) default NULL,
  `buildings_community` int(11) default NULL,
  `buildings_localresource` int(11) default NULL,
  `buildings_others` int(11) default NULL,
  `classroom_rigid` int(11) default NULL,
  `classroom_weak` int(11) default NULL,
  `classroom_govt` int(11) default NULL,
  `classroom_community` int(11) default NULL,
  `classroom_localresource` int(11) default NULL,
  `classroom_others` int(11) default NULL,
  `classroom_usable` int(11) default NULL,
  `classroom_unused` int(11) default NULL,
  `classroom_inadequate` int(11) default NULL,
  `classroom_land_available` int(11) default NULL,
  `recons_needed_rooms` int(11) default NULL,
  `num_desk` int(11) default NULL,
  `usable_desk_students` int(11) default NULL,
  `inadequate_desk_students` int(11) default NULL,
  `num_table` int(11) default NULL,
  `usable_table` int(11) default NULL,
  `num_chair` int(11) default NULL,
  `usable_chair` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for school_program
*/

drop table if exists `school_program`;
CREATE TABLE `school_program` (
  `sch_num` varchar(30) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `govt_funds_q1_1st` int(11) default NULL,
  `govt_funds_q1_2nd` int(11) default NULL,
  `govt_funds_q1_3rd` int(11) default NULL,
  `govt_funds_q1_4th` int(11) default NULL,
  `govt_funds_q2_1st` int(11) default NULL,
  `govt_funds_q2_2nd` int(11) default NULL,
  `govt_funds_q2_3rd` int(11) default NULL,
  `govt_funds_q2_4th` int(11) default NULL,
  `school_improve_plan` int(11) default NULL,
  `school_improve_plan_first` int(11) default NULL,
  `school_improve_plan_date` int(11) default NULL,
  `social_audit` int(11) default NULL,
  `social_audit_month` int(11) default NULL,
  `social_audit_day` int(11) default NULL,
  `public_disclose_acc` int(11) default NULL,
  `public_disclose_acc_month` int(11) default NULL,
  `public_disclose_acc_day` int(11) default NULL,
  `standardization` int(11) default NULL,
  `standardization_level` int(11) default NULL,
  `govt_grant` int(11) default NULL,
  `grant_amount` int(11) default NULL,
  `per_student_grant` int(11) default NULL,
  `sch_mgmt_transferred` int(11) default NULL,
  `mgmt_transferred_year` int(11) default NULL,
  `mgmt_transferred_level` int(11) default NULL,
  `new_classrooms` int(11) default NULL,
  `new_classrooms_govt` int(11) default NULL,
  `new_classrooms_others` int(11) default NULL,
  `rehab_classrooms` int(11) default NULL,
  `rehab_classrooms_govt` int(11) default NULL,
  `rehab_classrooms_others` int(11) default NULL,
  `school_fence` int(11) default NULL,
  `school_fence_govt` int(11) default NULL,
  `school_fence_local` int(11) default NULL,
  `school_fence_others` int(11) default NULL,
  `school_toilets` int(11) default NULL,
  `school_toilets_govt` int(11) default NULL,
  `school_toilets_local` int(11) default NULL,
  `school_toilets_others` int(11) default NULL,
  `water` int(11) default NULL,
  `water_govt` int(11) default NULL,
  `water_local` int(11) default NULL,
  `water_others` int(11) default NULL,
  `sch_oper_cal` int(11) default NULL,
  `diss_calendar` int(11) default NULL,
  `diss_notice` int(11) default NULL,
  `diss_others` int(11) default NULL,
  `school_open` int(11) default NULL,
  `school_open_teaching` int(11) default NULL,
  `school_open_exams` int(11) default NULL,
  `school_open_eca` int(11) default NULL,
  `school_open_holidays` int(11) default NULL,
  `school_open_festivals` int(11) default NULL,
  `school_open_others` int(11) default NULL,
  `school_act_open` int(11) default NULL,
  `school_act_teaching` int(11) default NULL,
  `school_act_eca` int(11) default NULL,
  `smc_meetings` int(11) default NULL,
  `monitor_total` int(11) default NULL,
  `monitor_rp` int(11) default NULL,
  `monitor_ss` int(11) default NULL,
  `monitor_others` int(11) default NULL,
  `health_facility` int(11) default NULL,
  `health_distance` int(11) default NULL,
  `textbook_pri` int(11) default NULL,
  `textbook_lsec` int(11) default NULL,
  `textbook_sec` int(11) default NULL,
  `textbook_hsec` int(11) default NULL,
  `teachingmanual_pri` int(11) default NULL,
  `teachingmanual_lsec` int(11) default NULL,
  `teachingmanual_sec` int(11) default NULL,
  `teachingmanual_hsec` int(11) default NULL,
  `localcurr_dev_pri` int(11) default NULL,
  `localcurr_dev_lsec` int(11) default NULL,
  `localcurr_dev_sec` int(11) default NULL,
  `localcurr_dev_hsec` int(11) default NULL,
  `localcurr_usage_pri` int(11) default NULL,
  `localcurr_usage_lsec` int(11) default NULL,
  `localcurr_usage_sec` int(11) default NULL,
  `localcurr_usage_hsec` int(11) default NULL,
  `library` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_dalit_enroll_age_f1
*/

drop table if exists `sec_dalit_enroll_age_f1`;
CREATE TABLE `sec_dalit_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l10` int(10) default NULL,
  `m_l10` int(10) default NULL,
  `t_l10` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_11_12` int(10) default NULL,
  `m_11_12` int(10) default NULL,
  `t_11_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `f_l11` int(10) default NULL,
  `m_l11` int(10) default NULL,
  `t_l11` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_l12` int(10) default NULL,
  `m_l12` int(10) default NULL,
  `t_l12` int(10) default NULL,
  `f_l13` int(10) default NULL,
  `m_l13` int(10) default NULL,
  `t_l13` int(10) default NULL,
  `f_13` int(10) default NULL,
  `m_13` int(10) default NULL,
  `t_13` int(10) default NULL,
  `f_13_14` int(10) default NULL,
  `m_13_14` int(10) default NULL,
  `t_13_14` int(10) default NULL,
  `f_g14` int(10) default NULL,
  `m_g14` int(10) default NULL,
  `t_g14` int(10) default NULL,
  `f_l14` int(10) default NULL,
  `m_l14` int(10) default NULL,
  `t_l14` int(10) default NULL,
  `f_14` int(10) default NULL,
  `m_14` int(10) default NULL,
  `t_14` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_g15` int(10) default NULL,
  `m_g15` int(10) default NULL,
  `t_g15` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_17` int(10) default NULL,
  `m_17` int(10) default NULL,
  `t_17` int(10) default NULL,
  `f_g17` int(10) default NULL,
  `m_g17` int(10) default NULL,
  `t_g17` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_disabled_f1
*/

drop table if exists `sec_disabled_f1`;
CREATE TABLE `sec_disabled_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `disability_type_id` int(10) NOT NULL default '0',
  `disabled_f` int(10) default NULL,
  `disabled_m` int(10) default NULL,
  `disabled_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `disability_type_id` (`disability_type_id`),
  KEY `pk` (`sch_num`,`sch_year`,`class`,`disability_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_janjati_enroll_age_f1
*/

drop table if exists `sec_janjati_enroll_age_f1`;
CREATE TABLE `sec_janjati_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l10` int(10) default NULL,
  `m_l10` int(10) default NULL,
  `t_l10` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_11_12` int(10) default NULL,
  `m_11_12` int(10) default NULL,
  `t_11_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `f_l11` int(10) default NULL,
  `m_l11` int(10) default NULL,
  `t_l11` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_l12` int(10) default NULL,
  `m_l12` int(10) default NULL,
  `t_l12` int(10) default NULL,
  `f_l13` int(10) default NULL,
  `m_l13` int(10) default NULL,
  `t_l13` int(10) default NULL,
  `f_13` int(10) default NULL,
  `m_13` int(10) default NULL,
  `t_13` int(10) default NULL,
  `f_13_14` int(10) default NULL,
  `m_13_14` int(10) default NULL,
  `t_13_14` int(10) default NULL,
  `f_g14` int(10) default NULL,
  `m_g14` int(10) default NULL,
  `t_g14` int(10) default NULL,
  `f_l14` int(10) default NULL,
  `m_l14` int(10) default NULL,
  `t_l14` int(10) default NULL,
  `f_14` int(10) default NULL,
  `m_14` int(10) default NULL,
  `t_14` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_g15` int(10) default NULL,
  `m_g15` int(10) default NULL,
  `t_g15` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_17` int(10) default NULL,
  `m_17` int(10) default NULL,
  `t_17` int(10) default NULL,
  `f_g17` int(10) default NULL,
  `m_g17` int(10) default NULL,
  `t_g17` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_teacher_details_dalit_f1
*/

drop table if exists `sec_teacher_details_dalit_f1`;
CREATE TABLE `sec_teacher_details_dalit_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_ba_f` int(10) default NULL,
  `under_ba_m` int(10) default NULL,
  `under_ba_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `educ_faculty_f` int(10) default NULL,
  `educ_faculty_m` int(10) default NULL,
  `educ_faculty_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_teacher_details_f1
*/

drop table if exists `sec_teacher_details_f1`;
CREATE TABLE `sec_teacher_details_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_slc_f` int(11) default NULL,
  `under_slc_m` int(11) default NULL,
  `under_slc_t` int(11) default NULL,
  `slc_f` int(11) default NULL,
  `slc_m` int(11) default NULL,
  `slc_t` int(11) default NULL,
  `ia_f` int(11) default NULL,
  `ia_m` int(11) default NULL,
  `ia_t` int(11) default NULL,
  `under_ba_f` int(10) default NULL,
  `under_ba_m` int(10) default NULL,
  `under_ba_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `phd_f` int(11) default NULL,
  `phd_m` int(11) default NULL,
  `phd_t` int(11) default NULL,
  `educ_faculty_f` int(10) default NULL,
  `educ_faculty_m` int(10) default NULL,
  `educ_faculty_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_teacher_details_janjati_f1
*/

drop table if exists `sec_teacher_details_janjati_f1`;
CREATE TABLE `sec_teacher_details_janjati_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `total_a_teachers` int(10) default NULL,
  `total_f_teachers` int(10) default NULL,
  `total_m_teachers` int(10) default NULL,
  `total_t_teachers` int(10) default NULL,
  `dalit_f_teachers` int(10) default NULL,
  `dalit_m_teachers` int(10) default NULL,
  `dalit_t_teachers` int(10) default NULL,
  `janjati_f_teachers` int(10) default NULL,
  `janjati_m_teachers` int(10) default NULL,
  `janjati_t_teachers` int(10) default NULL,
  `disabled_f_teachers` int(10) default NULL,
  `disabled_m_teachers` int(10) default NULL,
  `disabled_t_teachers` int(10) default NULL,
  `work_total` int(10) default NULL,
  `perm_f` int(10) default NULL,
  `perm_m` int(10) default NULL,
  `perm_t` int(10) default NULL,
  `temp_f` int(10) default NULL,
  `temp_m` int(10) default NULL,
  `temp_t` int(10) default NULL,
  `grant_f` int(10) default NULL,
  `grant_m` int(10) default NULL,
  `grant_t` int(10) default NULL,
  `private_f` int(10) default NULL,
  `private_m` int(10) default NULL,
  `private_t` int(10) default NULL,
  `under_ba_f` int(10) default NULL,
  `under_ba_m` int(10) default NULL,
  `under_ba_t` int(10) default NULL,
  `ba_f` int(10) default NULL,
  `ba_m` int(10) default NULL,
  `ba_t` int(10) default NULL,
  `ma_f` int(10) default NULL,
  `ma_m` int(10) default NULL,
  `ma_t` int(10) default NULL,
  `educ_faculty_f` int(10) default NULL,
  `educ_faculty_m` int(10) default NULL,
  `educ_faculty_t` int(10) default NULL,
  `teacher_by_subject_f` int(10) default NULL,
  `teacher_by_subject_m` int(10) default NULL,
  `teacher_by_subject_t` int(10) default NULL,
  `first_level` int(10) default NULL,
  `second_level` int(10) default NULL,
  `third_level` int(10) default NULL,
  `teacher_deo` int(11) default NULL,
  `teacher_community` int(11) default NULL,
  `teacher_others` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_teacher_training_f1
*/

drop table if exists `sec_teacher_training_f1`;
CREATE TABLE `sec_teacher_training_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `fully_trained_total_f` int(10) default NULL,
  `fully_trained_total_m` int(10) default NULL,
  `fully_trained_total_t` int(10) default NULL,
  `fully_trained_dalit_f` int(10) default NULL,
  `fully_trained_dalit_m` int(10) default NULL,
  `fully_trained_dalit_t` int(10) default NULL,
  `fully_trained_janjati_f` int(10) default NULL,
  `fully_trained_janjati_m` int(10) default NULL,
  `fully_trained_janjati_t` int(10) default NULL,
  `part_trained_total_f` int(10) default NULL,
  `part_trained_total_m` int(10) default NULL,
  `part_trained_total_t` int(11) default NULL,
  `part_trained_dalit_f` int(10) default NULL,
  `part_trained_dalit_m` int(10) default NULL,
  `part_trained_dalit_t` int(11) default NULL,
  `part_trained_janjati_f` int(10) default NULL,
  `part_trained_janjati_m` int(10) default NULL,
  `part_trained_janjati_t` int(11) default NULL,
  `first_package_total_f` int(10) default NULL,
  `first_package_total_m` int(10) default NULL,
  `first_package_total_t` int(10) default NULL,
  `first_package_dalit_f` int(10) default NULL,
  `first_package_dalit_m` int(10) default NULL,
  `first_package_dalit_t` int(10) default NULL,
  `first_package_janjati_f` int(10) default NULL,
  `first_package_janjati_m` int(10) default NULL,
  `first_package_janjati_t` int(10) default NULL,
  `second_package_total_f` int(10) default NULL,
  `second_package_total_m` int(10) default NULL,
  `second_package_total_t` int(10) default NULL,
  `second_package_dalit_f` int(10) default NULL,
  `second_package_dalit_m` int(10) default NULL,
  `second_package_dalit_t` int(10) default NULL,
  `second_package_janjati_f` int(10) default NULL,
  `second_package_janjati_m` int(10) default NULL,
  `second_package_janjati_t` int(10) default NULL,
  `third_package_total_f` int(10) default NULL,
  `third_package_total_m` int(10) default NULL,
  `third_package_total_t` int(10) default NULL,
  `third_package_dalit_f` int(10) default NULL,
  `third_package_dalit_m` int(10) default NULL,
  `third_package_dalit_t` int(10) default NULL,
  `third_package_janjati_f` int(10) default NULL,
  `third_package_janjati_m` int(10) default NULL,
  `third_package_janjati_t` int(10) default NULL,
  `untrained_total_f` int(10) default NULL,
  `untrained_total_m` int(10) default NULL,
  `untrained_total_t` int(10) default NULL,
  `untrained_dalit_f` int(10) default NULL,
  `untrained_dalit_m` int(10) default NULL,
  `untrained_dalit_t` int(10) default NULL,
  `untrained_janjati_f` int(10) default NULL,
  `untrained_janjati_m` int(10) default NULL,
  `untrained_janjati_t` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sec_total_enroll_age_f1
*/

drop table if exists `sec_total_enroll_age_f1`;
CREATE TABLE `sec_total_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `f_l10` int(10) default NULL,
  `m_l10` int(10) default NULL,
  `t_l10` int(10) default NULL,
  `f_10` int(10) default NULL,
  `m_10` int(10) default NULL,
  `t_10` int(10) default NULL,
  `f_11_12` int(10) default NULL,
  `m_11_12` int(10) default NULL,
  `t_11_12` int(10) default NULL,
  `f_g12` int(10) default NULL,
  `m_g12` int(10) default NULL,
  `t_g12` int(10) default NULL,
  `f_l11` int(10) default NULL,
  `m_l11` int(10) default NULL,
  `t_l11` int(10) default NULL,
  `f_11` int(10) default NULL,
  `m_11` int(10) default NULL,
  `t_11` int(10) default NULL,
  `f_12` int(10) default NULL,
  `m_12` int(10) default NULL,
  `t_12` int(10) default NULL,
  `f_l12` int(10) default NULL,
  `m_l12` int(10) default NULL,
  `t_l12` int(10) default NULL,
  `f_l13` int(10) default NULL,
  `m_l13` int(10) default NULL,
  `t_l13` int(10) default NULL,
  `f_13` int(10) default NULL,
  `m_13` int(10) default NULL,
  `t_13` int(10) default NULL,
  `f_13_14` int(10) default NULL,
  `m_13_14` int(10) default NULL,
  `t_13_14` int(10) default NULL,
  `f_g14` int(10) default NULL,
  `m_g14` int(10) default NULL,
  `t_g14` int(10) default NULL,
  `f_l14` int(10) default NULL,
  `m_l14` int(10) default NULL,
  `t_l14` int(10) default NULL,
  `f_14` int(10) default NULL,
  `m_14` int(10) default NULL,
  `t_14` int(10) default NULL,
  `f_15` int(10) default NULL,
  `m_15` int(10) default NULL,
  `t_15` int(10) default NULL,
  `f_g15` int(10) default NULL,
  `m_g15` int(10) default NULL,
  `t_g15` int(10) default NULL,
  `f_16` int(10) default NULL,
  `m_16` int(10) default NULL,
  `t_16` int(10) default NULL,
  `f_g16` int(10) default NULL,
  `m_g16` int(10) default NULL,
  `t_g16` int(10) default NULL,
  `f_17` int(10) default NULL,
  `m_17` int(10) default NULL,
  `t_17` int(10) default NULL,
  `f_g17` int(10) default NULL,
  `m_g17` int(10) default NULL,
  `t_g17` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sections
*/

drop table if exists `sections`;
CREATE TABLE `sections` (
  `sch_num` varchar(10) default NULL,
  `sch_year` varchar(4) default NULL,
  `class` varchar(5) default NULL,
  `sections` int(11) default NULL,
  `classrooms` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_enroll
*/

drop table if exists `sopfsp_enroll`;
CREATE TABLE `sopfsp_enroll` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `sopfsp_num` int(11) NOT NULL,
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_enroll_dropout_f` int(11) default NULL,
  `tot_enroll_dropout_m` int(11) default NULL,
  `tot_enroll_dropout_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_enroll_age
*/

drop table if exists `sopfsp_enroll_age`;
CREATE TABLE `sopfsp_enroll_age` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `sopfsp_num` int(11) NOT NULL,
  `f_l6` int(10) default NULL,
  `m_l6` int(10) default NULL,
  `t_l6` int(10) default NULL,
  `f_6` int(10) default NULL,
  `m_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `f_7` int(10) default NULL,
  `m_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `f_8` int(11) default NULL,
  `m_8` int(11) default NULL,
  `t_8` int(11) default NULL,
  `f_9` int(11) default NULL,
  `m_9` int(11) default NULL,
  `t_9` int(11) default NULL,
  `f_10` int(11) default NULL,
  `m_10` int(11) default NULL,
  `t_10` int(11) default NULL,
  `f_11` int(11) default NULL,
  `m_11` int(11) default NULL,
  `t_11` int(11) default NULL,
  `f_12` int(11) default NULL,
  `m_12` int(11) default NULL,
  `t_12` int(11) default NULL,
  `f_13` int(11) default NULL,
  `m_13` int(11) default NULL,
  `t_13` int(11) default NULL,
  `f_14` int(11) default NULL,
  `m_14` int(11) default NULL,
  `t_14` int(11) default NULL,
  `f_g14` int(11) default NULL,
  `m_g14` int(11) default NULL,
  `t_g14` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_enroll_age_f1
*/

drop table if exists `sopfsp_enroll_age_f1`;
CREATE TABLE `sopfsp_enroll_age_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `sopfsp_num` int(11) NOT NULL,
  `d_l6` int(10) default NULL,
  `j_l6` int(10) default NULL,
  `t_l6` int(10) default NULL,
  `d_6` int(10) default NULL,
  `j_6` int(10) default NULL,
  `t_6` int(10) default NULL,
  `d_7` int(10) default NULL,
  `j_7` int(10) default NULL,
  `t_7` int(10) default NULL,
  `d_8` int(11) default NULL,
  `j_8` int(11) default NULL,
  `t_8` int(11) default NULL,
  `d_9` int(11) default NULL,
  `j_9` int(11) default NULL,
  `t_9` int(11) default NULL,
  `d_10` int(11) default NULL,
  `j_10` int(11) default NULL,
  `t_10` int(11) default NULL,
  `d_11` int(11) default NULL,
  `j_11` int(11) default NULL,
  `t_11` int(11) default NULL,
  `d_12` int(11) default NULL,
  `j_12` int(11) default NULL,
  `t_12` int(11) default NULL,
  `d_13` int(11) default NULL,
  `j_13` int(11) default NULL,
  `t_13` int(11) default NULL,
  `d_14` int(11) default NULL,
  `j_14` int(11) default NULL,
  `t_14` int(11) default NULL,
  `d_g14` int(11) default NULL,
  `j_g14` int(11) default NULL,
  `t_g14` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_enroll_f1
*/

drop table if exists `sopfsp_enroll_f1`;
CREATE TABLE `sopfsp_enroll_f1` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `sopfsp_num` int(11) NOT NULL,
  `tot_enroll_total_f` int(11) default NULL,
  `tot_enroll_total_m` int(11) default NULL,
  `tot_enroll_total_t` int(11) default NULL,
  `tot_enroll_dalit_f` int(11) default NULL,
  `tot_enroll_dalit_m` int(11) default NULL,
  `tot_enroll_dalit_t` int(11) default NULL,
  `tot_enroll_janjati_f` int(11) default NULL,
  `tot_enroll_janjati_m` int(11) default NULL,
  `tot_enroll_janjati_t` int(11) default NULL,
  `tot_enroll_dropout_f` int(11) default NULL,
  `tot_enroll_dropout_m` int(11) default NULL,
  `tot_enroll_dropout_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_facilitator_f1
*/

drop table if exists `sopfsp_facilitator_f1`;
CREATE TABLE `sopfsp_facilitator_f1` (
  `sch_num` varchar(50) collate latin1_general_ci default NULL,
  `sch_year` varchar(50) collate latin1_general_ci default NULL,
  `sopfsp_num` int(11) default NULL,
  `name` varchar(100) collate latin1_general_ci default NULL,
  `sex` int(10) default NULL,
  `caste` int(10) default NULL,
  `education` int(10) default NULL,
  `training` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `name` (`name`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*
Table structure for sopfsp_info
*/

drop table if exists `sopfsp_info`;
CREATE TABLE `sopfsp_info` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `parent_sch_num` varchar(20) default NULL,
  `sopfsp_num` int(11) NOT NULL,
  `sopfsp_type` int(11) NOT NULL,
  `start_y` int(11) default NULL,
  `start_m` int(11) default NULL,
  `start_d` int(11) default NULL,
  `start_level` int(11) default NULL,
  `start_time` int(11) default NULL,
  `repeat_y` int(11) default NULL,
  `repeat_m` int(11) default NULL,
  `repeat_d` int(11) default NULL,
  `repeat_level` int(11) default NULL,
  `repeat_time` int(11) default NULL,
  `vdc` varchar(5) default NULL,
  `ward` int(11) default NULL,
  `tole` varchar(100) default NULL,
  `helper_name` varchar(100) default NULL,
  `helper_add` varchar(100) default NULL,
  `helper_sex` int(11) default NULL,
  `helper_caste` int(11) default NULL,
  `helper_edu_status` int(11) default NULL,
  `helper_training` int(11) default NULL,
  `ngo_name` varchar(100) default NULL,
  `ngo_add` varchar(50) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for sopfsp_info_f1
*/

drop table if exists `sopfsp_info_f1`;
CREATE TABLE `sopfsp_info_f1` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `sopfsp_num` int(11) NOT NULL,
  `sopfsp_type` int(11) NOT NULL,
  `mother_school` varchar(50) default NULL,
  `mother_school_code` varchar(30) default NULL,
  `start_y` int(11) default NULL,
  `start_m` int(11) default NULL,
  `start_d` int(11) default NULL,
  `start_level` int(11) default NULL,
  `start_time` int(11) default NULL,
  `repeat_y` int(11) default NULL,
  `repeat_m` int(11) default NULL,
  `repeat_d` int(11) default NULL,
  `repeat_level` int(11) default NULL,
  `repeat_time` int(11) default NULL,
  `vdc` varchar(5) default NULL,
  `ward` int(11) default NULL,
  `tole` varchar(100) default NULL,
  `helper_name` varchar(100) default NULL,
  `helper_add` varchar(100) default NULL,
  `helper_sex` int(11) default NULL,
  `helper_caste` int(11) default NULL,
  `helper_edu_status` int(11) default NULL,
  `helper_training` int(11) default NULL,
  `ngo_name` varchar(100) default NULL,
  `ngo_add` varchar(50) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `sopfsp_num` (`sopfsp_num`),
  KEY `pk` (`sch_num`,`sch_year`,`sopfsp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for support_f1
*/

drop table if exists `support_f1`;
CREATE TABLE `support_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `scholarship` int(11) default NULL,
  `scholarship_amount` int(11) default NULL,
  `block_grant` int(11) default NULL,
  `block_grant_amount` int(11) default NULL,
  `salary_support` int(11) default NULL,
  `salary_support_amount` int(11) default NULL,
  `other_support` int(11) default NULL,
  `other_support_amount` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tags
*/

drop table if exists `tags`;
CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_category` varchar(50) default NULL,
  `tag_name` varchar(50) default NULL,
  `codes` text,
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

/*
Table structure for teacher_language_f1
*/

drop table if exists `teacher_language_f1`;
CREATE TABLE `teacher_language_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `mother_lang` varchar(50) default NULL,
  `teacher_available` int(11) default NULL,
  `teacher_f` int(11) default NULL,
  `teacher_m` int(11) default NULL,
  `teacher_t` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `mother_lang` (`mother_lang`),
  KEY `pk` (`sch_num`,`sch_year`,`mother_lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for teacher_pcf_f1
*/

drop table if exists `teacher_pcf_f1`;
CREATE TABLE `teacher_pcf_f1` (
  `sch_num` varchar(50) collate latin1_general_ci default NULL,
  `sch_year` varchar(50) collate latin1_general_ci default NULL,
  `pcf_full_pri` int(10) default NULL,
  `pcf_full_lsec` int(10) default NULL,
  `pcf_full_sec` int(10) default NULL,
  `pcf_full_hsec` int(10) default NULL,
  `pcf_par_pri` int(10) default NULL,
  `pcf_par_lsec` int(10) default NULL,
  `pcf_par_sec` int(10) default NULL,
  `pcf_par_hsec` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*
Table structure for teacher_rahat_f1
*/

drop table if exists `teacher_rahat_f1`;
CREATE TABLE `teacher_rahat_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `rahat_received` int(11) default NULL,
  `rahat_pri` int(11) default NULL,
  `rahat_lsec` int(11) default NULL,
  `rahat_sec` int(11) default NULL,
  `rahat_hsec` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for teachers
*/

drop table if exists `teachers`;
CREATE TABLE `teachers` (
  `sch_num` varchar(30) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `teacher_level_id` int(11) NOT NULL,
  `app_total` int(11) default NULL,
  `work_total` int(11) default NULL,
  `work_female` int(11) default NULL,
  `rahat_total` int(11) default NULL,
  `rahat_female` int(11) default NULL,
  `private_total` int(11) default NULL,
  `private_female` int(11) default NULL,
  `dalit_teachers` int(11) default NULL,
  `janjati_teachers` int(11) default NULL,
  `disable_teachers` int(11) default NULL,
  `madhesi_teachers` int(11) default NULL,
  `tot_teacher_full_train` int(11) default NULL,
  `fem_teacher_full_train` int(11) default NULL,
  `tot_teacher_par_train` int(11) default NULL,
  `fem_teacher_par_train` int(11) default NULL,
  `tot_teacher_cur_full_train` int(11) default NULL,
  `fem_teacher_cur_full_train` int(11) default NULL,
  `tot_teacher_cur_par_train` int(11) default NULL,
  `fem_teacher_cur_par_train` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `teacher_level_id` (`teacher_level_id`),
  KEY `pk` (`sch_num`,`sch_year`,`teacher_level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for teaching_method_f1
*/

drop table if exists `teaching_method_f1`;
CREATE TABLE `teaching_method_f1` (
  `sch_num` varchar(10) NOT NULL,
  `sch_year` varchar(4) NOT NULL,
  `c1_teaching_method` int(11) default NULL,
  `c2_teaching_method` int(11) default NULL,
  `c3_teaching_method` int(11) default NULL,
  `c4_teaching_method` int(11) default NULL,
  `c5_teaching_method` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_num`,`sch_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for textbooks_f1
*/

drop table if exists `textbooks_f1`;
CREATE TABLE `textbooks_f1` (
  `sch_num` varchar(10) NOT NULL default '',
  `sch_year` varchar(4) NOT NULL default '',
  `class` varchar(5) NOT NULL default '',
  `full_students_no` int(10) default NULL,
  `partial_students_no` int(10) default NULL,
  `none_students_no` int(10) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_num` (`sch_num`),
  KEY `sch_year` (`sch_year`),
  KEY `class` (`class`),
  KEY `pk` (`sch_num`,`sch_year`,`class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_award
*/

drop table if exists `tmis_award`;
CREATE TABLE `tmis_award` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `rank` varchar(10) default NULL,
  `type` varchar(20) default NULL,
  `org` varchar(30) default NULL,
  `year` int(4) default NULL,
  `month` int(2) default NULL,
  `day` int(2) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `sn` (`sn`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_edu
*/

drop table if exists `tmis_edu`;
CREATE TABLE `tmis_edu` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `qualif` varchar(20) default NULL,
  `board` varchar(20) default NULL,
  `year` int(4) default NULL,
  `division` varchar(10) default NULL,
  `stream` varchar(20) default NULL,
  `subj` varchar(20) default NULL,
  `school` varchar(30) default NULL,
  `country` varchar(15) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `sn` (`sn`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_inc
*/

drop table if exists `tmis_inc`;
CREATE TABLE `tmis_inc` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `src` varchar(15) default NULL,
  `scale` int(6) default NULL,
  `grade` int(6) default NULL,
  `ta` int(6) default NULL,
  `ra` int(6) default NULL,
  `ma` int(6) default NULL,
  `total` int(6) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `sn` (`sn`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_leave
*/

drop table if exists `tmis_leave`;
CREATE TABLE `tmis_leave` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `type` varchar(20) default NULL,
  `dist` varchar(15) default NULL,
  `school` varchar(50) default NULL,
  `year_from` int(4) default NULL,
  `month_from` int(2) default NULL,
  `day_from` int(2) default NULL,
  `year_to` int(4) default NULL,
  `month_to` int(2) default NULL,
  `day_to` int(2) default NULL,
  `dur_year` int(4) default NULL,
  `dur_month` int(2) default NULL,
  `dur_day` int(2) default NULL,
  `remarks` varchar(20) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `sn` (`sn`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_main
*/

drop table if exists `tmis_main`;
CREATE TABLE `tmis_main` (
  `tid` int(11) NOT NULL auto_increment,
  `sch_year` int(11) default NULL,
  `sch_num` varchar(9) NOT NULL,
  `t_name` varchar(50) NOT NULL,
  `entry_timestamp` datetime default NULL,
  KEY `pk` (`sch_year`,`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_med
*/

drop table if exists `tmis_med`;
CREATE TABLE `tmis_med` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `level` varchar(10) default NULL,
  `org` varchar(20) default NULL,
  `year_dec` int(4) default NULL,
  `month_dec` int(2) default NULL,
  `day_dec` int(2) default NULL,
  `dist` varchar(25) default NULL,
  `amt` int(6) default NULL,
  `year` int(4) default NULL,
  `month` int(2) default NULL,
  `day` int(2) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sn` (`sn`),
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_pub
*/

drop table if exists `tmis_pub`;
CREATE TABLE `tmis_pub` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `name` varchar(50) default NULL,
  `year` int(4) default NULL,
  `month` int(2) default NULL,
  `day` int(2) default NULL,
  `lang` varchar(15) default NULL,
  `sub` varchar(15) default NULL,
  `remarks` varchar(20) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sn` (`sn`),
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_punish
*/

drop table if exists `tmis_punish`;
CREATE TABLE `tmis_punish` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `level` varchar(10) default NULL,
  `type` varchar(15) default NULL,
  `org` varchar(30) default NULL,
  `person` varchar(30) default NULL,
  `year` int(4) default NULL,
  `month` int(2) default NULL,
  `day` int(2) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sn` (`sn`),
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_sec1
*/

drop table if exists `tmis_sec1`;
CREATE TABLE `tmis_sec1` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `pf_no` varchar(9) default NULL,
  `nationality` varchar(20) default NULL,
  `sex` int(1) default NULL,
  `caste` varchar(15) default NULL,
  `t_caste` int(1) default NULL,
  `insurance_no` varchar(9) default NULL,
  `license_no` varchar(23) default NULL,
  `mother_tongue` varchar(15) default NULL,
  `teaching_lang` varchar(15) default NULL,
  `first_app_type` int(1) default NULL,
  `first_app_year` int(4) default NULL,
  `first_app_month` int(2) default NULL,
  `first_app_day` int(2) default NULL,
  `first_app_level` int(1) default NULL,
  `first_app_sec_subject` varchar(15) default NULL,
  `teachingSub1` varchar(15) default NULL,
  `teachingSub2` varchar(15) default NULL,
  `curr_perm_level` int(1) default NULL,
  `curr_perm_rank` int(1) default NULL,
  `bs_dob_year1` int(4) default NULL,
  `bs_dob_month1` int(2) default NULL,
  `bs_dob_day1` int(2) default NULL,
  `ad_dob_year1` int(4) default NULL,
  `ad_dob_month1` int(2) default NULL,
  `ad_dob_day1` int(2) default NULL,
  `bs_dob_year2` int(4) default NULL,
  `bs_dob_month2` int(2) default NULL,
  `bs_dob_day2` int(2) default NULL,
  `ad_dob_year2` int(4) default NULL,
  `ad_dob_month2` int(2) default NULL,
  `ad_dob_day2` int(2) default NULL,
  `marital_status` int(1) default NULL,
  `nof_daughter` int(2) default NULL,
  `nof_son` int(2) default NULL,
  `nof_total` int(2) default NULL,
  `citizenship_no` varchar(7) default NULL,
  `citizenship_year` int(4) default NULL,
  `citizenship_month` int(2) default NULL,
  `citizenship_day` int(2) default NULL,
  `citizenship_dist` varchar(15) default NULL,
  `name_father` varchar(50) default NULL,
  `name_mother` varchar(50) default NULL,
  `name_spouse` varchar(50) default NULL,
  `name_willper` varchar(50) default NULL,
  `perm_addr_dist` varchar(15) default NULL,
  `perm_addr_vdc` varchar(15) default NULL,
  `perm_addr_ward` int(2) default NULL,
  `perm_addr_locality` varchar(20) default NULL,
  `perm_addr_house` varchar(7) default NULL,
  `perm_addr_region` int(2) default NULL,
  `perm_addr_phone` int(10) default NULL,
  `perm_addr_email` varchar(30) default NULL,
  `temp_addr_dist` varchar(15) default NULL,
  `temp_addr_vdc` varchar(15) default NULL,
  `temp_addr_ward` int(2) default NULL,
  `temp_addr_locality` varchar(20) default NULL,
  `temp_addr_house` varchar(7) default NULL,
  `temp_addr_region` int(2) default NULL,
  `temp_addr_phone` int(10) default NULL,
  `temp_addr_email` varchar(30) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `tid` (`tid`),
  KEY `sch_year` (`sch_year`),
  KEY `pk` (`sch_year`,`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_sec2
*/

drop table if exists `tmis_sec2`;
CREATE TABLE `tmis_sec2` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `appoint_level` int(1) default NULL,
  `appoint_rank` int(1) default NULL,
  `appoint_position` int(1) default NULL,
  `dec_year` int(4) default NULL,
  `dec_month` int(2) default NULL,
  `dec_day` int(2) default NULL,
  `app_year` int(4) default NULL,
  `app_month` int(2) default NULL,
  `app_day` int(2) default NULL,
  `app_district` varchar(15) default NULL,
  `app_school` varchar(50) default NULL,
  `subj_sec` varchar(15) default NULL,
  `appoint_type` int(1) default NULL,
  `appoint_type_other` int(1) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sn` (`sn`),
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*
Table structure for tmis_train
*/

drop table if exists `tmis_train`;
CREATE TABLE `tmis_train` (
  `tid` int(11) NOT NULL,
  `sch_year` int(11) default NULL,
  `sn` int(2) default NULL,
  `name` int(1) default NULL,
  `type` int(2) default NULL,
  `subj` varchar(30) default NULL,
  `year` int(4) default NULL,
  `duration` varchar(15) default NULL,
  `division` varchar(10) default NULL,
  `org` int(1) default NULL,
  `country` varchar(15) default NULL,
  `entry_timestamp` datetime default NULL,
  KEY `sn` (`sn`),
  KEY `sch_year` (`sch_year`),
  KEY `tid` (`tid`),
  KEY `pk` (`sch_year`,`tid`,`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

