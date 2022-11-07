-- Adminer 4.8.1 MySQL 10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `student_management_system`;
CREATE DATABASE `student_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `student_management_system`;

DROP TABLE IF EXISTS `table_parents`;
CREATE TABLE `table_parents` (
  `parents_guardian_id` int(10) NOT NULL AUTO_INCREMENT,
  `parents_father_name` varchar(50) NOT NULL,
  `parents_mother_name` varchar(50) NOT NULL,
  `parents_address` varchar(255) NOT NULL,
  `parents_students_id` varchar(50) NOT NULL COMMENT 'Comma-separated values',
  `parents_students_name` varchar(255) NOT NULL COMMENT 'Comma-separated values',
  PRIMARY KEY (`parents_guardian_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `table_students`;
CREATE TABLE `table_students` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) NOT NULL,
  `student_class` int(5) NOT NULL,
  `student_section` char(5) NOT NULL,
  `student_date_of_birth` date NOT NULL,
  `student_father_name` varchar(50) NOT NULL,
  `student_mother_name` varchar(50) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_guardian_id` int(5) NOT NULL,
  `student_fees_status` tinyint(2) NOT NULL COMMENT '0 - Not Paid, 1 - Paid',
  `student_document` varchar(255) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `table_users`;
CREATE TABLE `table_users` (
  `users_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_name` varchar(50) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_role` tinyint(2) NOT NULL COMMENT '1 - Admin, 2 - Parent',
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2022-10-26 15:25:43
