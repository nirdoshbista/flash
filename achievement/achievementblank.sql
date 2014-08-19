/* 
SQLyog Enterprise v4.01
Host - localhost : Database - achievement
**************************************************************
Server version 5.0.67
*/

create database if not exists `achievement`;

use `achievement`;

/*
Table structure for student_main
*/

drop table if exists `student_main`;
CREATE TABLE `student_main` (
  `stu_num` varchar(20) collate latin1_general_ci NOT NULL,
  `sch_num` varchar(20) collate latin1_general_ci default NULL,
  `sch_year` int(11) default NULL,
  `class` int(11) default NULL,
  `reg_id` varchar(15) collate latin1_general_ci NOT NULL,
  `first_name` varchar(50) collate latin1_general_ci default NULL,
  `last_name` varchar(50) collate latin1_general_ci default NULL,
  `sex` tinyint(4) default NULL,
  `dob_en_y` int(11) default NULL,
  `dob_en_m` int(11) default NULL,
  `dob_en_d` int(11) default NULL,
  `dob_np_y` int(11) default NULL,
  `dob_np_m` int(11) default NULL,
  `dob_np_d` int(11) default NULL,
  `father_name` varchar(100) collate latin1_general_ci default NULL,
  `mother_name` varchar(100) collate latin1_general_ci default NULL,
  `caste_ethnicity` varchar(50) collate latin1_general_ci default NULL,
  `disability` varchar(50) collate latin1_general_ci default NULL,
  `dist_school` int(11) default NULL,
  `ecd_ppc_status` tinyint(4) default NULL,
  `income` tinyint(4) default NULL,
  `income_hrs` int(11) default NULL,
  `attendance` int(11) default NULL,
  `withheld` tinyint(4) default NULL,
  `entry_timestamp` datetime default NULL,
  PRIMARY KEY  (`stu_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*
Table structure for student_marks
*/

drop table if exists `student_marks`;
CREATE TABLE `student_marks` (
  `stu_num` varchar(20) collate latin1_general_ci NOT NULL,
  `sch_year` int(11) default NULL,
  `class` int(11) default NULL,
  `s1` int(11) default NULL,
  `s1_practical` int(11) default NULL,
  `s1_theory` int(11) default NULL,
  `s1_grace` int(11) default NULL,
  `s1_subject` varchar(100) collate latin1_general_ci default NULL,
  `s1_comment` varchar(100) collate latin1_general_ci default NULL,
  `s2` int(11) default NULL,
  `s2_practical` int(11) default NULL,
  `s2_theory` int(11) default NULL,
  `s2_grace` int(11) default NULL,
  `s2_subject` varchar(100) collate latin1_general_ci default NULL,
  `s2_comment` varchar(100) collate latin1_general_ci default NULL,
  `s3` int(11) default NULL,
  `s3_practical` int(11) default NULL,
  `s3_theory` int(11) default NULL,
  `s3_grace` int(11) default NULL,
  `s3_subject` varchar(100) collate latin1_general_ci default NULL,
  `s3_comment` varchar(100) collate latin1_general_ci default NULL,
  `s4` int(11) default NULL,
  `s4_practical` int(11) default NULL,
  `s4_theory` int(11) default NULL,
  `s4_grace` int(11) default NULL,
  `s4_subject` varchar(100) collate latin1_general_ci default NULL,
  `s4_comment` varchar(100) collate latin1_general_ci default NULL,
  `s5` int(11) default NULL,
  `s5_practical` int(11) default NULL,
  `s5_theory` int(11) default NULL,
  `s5_grace` int(11) default NULL,
  `s5_subject` varchar(100) collate latin1_general_ci default NULL,
  `s5_comment` varchar(100) collate latin1_general_ci default NULL,
  `s6` int(11) default NULL,
  `s6_practical` int(11) default NULL,
  `s6_theory` int(11) default NULL,
  `s6_grace` int(11) default NULL,
  `s6_subject` varchar(100) collate latin1_general_ci default NULL,
  `s6_comment` varchar(100) collate latin1_general_ci default NULL,
  `s7` int(11) default NULL,
  `s7_practical` int(11) default NULL,
  `s7_theory` int(11) default NULL,
  `s7_grace` int(11) default NULL,
  `s7_subject` varchar(100) collate latin1_general_ci default NULL,
  `s7_comment` varchar(100) collate latin1_general_ci default NULL,
  `s8` int(11) default NULL,
  `s8_practical` int(11) default NULL,
  `s8_theory` int(11) default NULL,
  `s8_grace` int(11) default NULL,
  `s8_subject` varchar(100) collate latin1_general_ci default NULL,
  `s8_comment` varchar(100) collate latin1_general_ci default NULL,
  `s9` int(11) default NULL,
  `s9_practical` int(11) default NULL,
  `s9_theory` int(11) default NULL,
  `s9_grace` int(11) default NULL,
  `s9_subject` varchar(100) collate latin1_general_ci default NULL,
  `s9_comment` varchar(100) collate latin1_general_ci default NULL,
  `s10` int(11) default NULL,
  `s10_practical` int(11) default NULL,
  `s10_theory` int(11) default NULL,
  `s10_grace` int(11) default NULL,
  `s10_subject` varchar(100) collate latin1_general_ci default NULL,
  `s10_comment` varchar(100) collate latin1_general_ci default NULL,
  `s11` int(11) default NULL,
  `s11_practical` int(11) default NULL,
  `s11_theory` int(11) default NULL,
  `s11_grace` int(11) default NULL,
  `s11_subject` varchar(100) collate latin1_general_ci default NULL,
  `s11_comment` varchar(100) collate latin1_general_ci default NULL,
  `s12` int(11) default NULL,
  `s12_practical` int(11) default NULL,
  `s12_theory` int(11) default NULL,
  `s12_grace` int(11) default NULL,
  `s12_subject` varchar(100) collate latin1_general_ci default NULL,
  `s12_comment` varchar(100) collate latin1_general_ci default NULL,
  `total` int(11) default NULL,
  `total_practical` int(11) default NULL,
  `total_theory` int(11) default NULL,
  `total_grace` int(11) default NULL,
  `total_comment` int(11) default NULL,
  `entry_timestamp` datetime default NULL,
  PRIMARY KEY  (`stu_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*
Table structure for subjects
*/

drop table if exists `subjects`;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL auto_increment,
  `dist_code` varchar(5) collate latin1_general_ci NOT NULL,
  `class` int(11) NOT NULL,
  `subject_sn` int(11) default NULL,
  `subject_name` varchar(100) collate latin1_general_ci default NULL,
  `subject_theory_full_mark` int(11) default NULL,
  `subject_theory_pass_mark` int(11) default NULL,
  `subject_practical_full_mark` int(11) default NULL,
  `subject_practical_pass_mark` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

