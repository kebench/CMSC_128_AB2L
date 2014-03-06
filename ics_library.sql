-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2014 at 09:56 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ics_library`
--
CREATE DATABASE IF NOT EXISTS `ics_library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ics_library`;

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`ab2l`@`localhost` FUNCTION `levenshtein`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN 
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT; 
    DECLARE s1_char CHAR; 
    -- max strlen=255 
    DECLARE cv0, cv1 VARBINARY(256); 
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0; 
    IF s1 = s2 THEN 
      RETURN 0; 
    ELSEIF s1_len = 0 THEN 
      RETURN s2_len; 
    ELSEIF s2_len = 0 THEN 
      RETURN s1_len; 
    ELSE 
      WHILE j <= s2_len DO 
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1; 
      END WHILE; 
      WHILE i <= s1_len DO 
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1; 
        WHILE j <= s2_len DO 
          SET c = c + 1; 
          IF s1_char = SUBSTRING(s2, j, 1) THEN  
            SET cost = 0; ELSE SET cost = 1; 
          END IF; 
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost; 
          IF c > c_temp THEN SET c = c_temp; END IF; 
            SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1; 
            IF c > c_temp THEN  
              SET c = c_temp;  
            END IF; 
            SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1; 
        END WHILE; 
        SET cv1 = cv0, i = i + 1; 
      END WHILE; 
    END IF; 
    RETURN c; 
  END$$

CREATE DEFINER=`ab2l`@`localhost` FUNCTION `levenshtein_ratio`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN 
    DECLARE s1_len, s2_len, max_len INT; 
    SET s1_len = LENGTH(s1), s2_len = LENGTH(s2); 
    IF s1_len > s2_len THEN  
      SET max_len = s1_len;  
    ELSE  
      SET max_len = s2_len;  
    END IF; 
    RETURN ROUND((1 - LEVENSHTEIN(s1, s2) / max_len) * 100); 
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE IF NOT EXISTS `admin_account` (
  `admin_key` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(3) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `parent_key` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`admin_key`),
  KEY `parent_key` (`parent_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_key`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `parent_key`) VALUES
('ab2lcmsc', 'clarissa.estremos@gmail.com', 'cla.estremos_admin', '68487b8490a28923e0bc32927a8c5c5e63f66a54', 'Clarissa', 'S', 'Estremos', NULL),
('cmscab2l', 'edelweisAV@gmail.com', 'edelweisAV_admin', 'af089789e2b0f148acab9c3a34d511a6534cee83', 'Edelweis', 'A', 'Valdellon', 'ab2lcmsc');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `date` date NOT NULL,
  `log_number` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`log_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`date`, `log_number`, `message`, `type`, `time`) VALUES
('2014-01-08', 1, 'Admin cla.estremos added User edel.smart', 'Add User', '10:23:11'),
('2014-02-10', 2, 'Admin cla.estremos added Admin edelsmart', 'Add Admin', '03:30:22'),
('2014-02-02', 3, 'Admin edelsmart updated an Announcement', 'Update Announcement', '02:11:12'),
('2014-01-13', 4, 'Admin edelsmart updated a Book', 'Update Book', '09:12:12'),
('2014-02-04', 5, 'Admin cla.estremos Verified User kara.lane', 'Verify User', '03:12:32'),
('2014-02-18', 6, 'Admin edelweisAV_admin added a new book: 2009-14', 'Add Book', '00:54:00'),
('2014-02-18', 7, 'edelweisAV_admin deleted book with Call Number: 32', 'Delete Book', '00:54:52'),
('2014-02-18', 8, 'Admin 1 added a new announcement', 'Add Announcement', '01:04:07'),
('2014-03-03', 9, 'Admin cla.estremos_admin logged in.', 'Admin Login', '05:34:30'),
('2014-03-03', 10, 'Admin cla.estremos_admin logged out.', 'Admin Login', '05:36:33'),
('2014-03-04', 11, 'Admin cla.estremos_admin logged in.', 'Admin Login', '17:16:54'),
('2014-03-04', 12, 'Admin cla.estremos_admin logged out.', 'Admin Login', '17:18:16'),
('2014-03-04', 13, 'Admin cla.estremos_admin logged in.', 'Admin Login', '17:19:22'),
('2014-03-04', 14, 'Admin cla.estremos_admin logged out.', 'Admin Login', '17:24:22'),
('2014-03-04', 15, 'Admin cla.estremos_admin logged in.', 'Admin Login', '21:00:18'),
('2014-03-04', 16, 'Admin cla.estremos_admin logged out.', 'Admin Login', '21:07:32'),
('2014-03-04', 17, 'Admin cla.estremos_admin logged in.', 'Admin Login', '21:57:39'),
('2014-03-04', 18, 'Admin cla.estremos_admin logged out.', 'Admin Login', '21:58:04'),
('2014-03-04', 19, 'Admin cla.estremos_admin logged in.', 'Admin Login', '23:44:12'),
('2014-03-04', 20, 'Admin cla.estremos_admin logged out.', 'Admin Login', '23:46:13'),
('2014-03-04', 21, 'Admin cla.estremos_admin logged in.', 'Admin Login', '23:56:32'),
('2014-03-04', 22, 'Admin cla.estremos_admin logged out.', 'Admin Login', '23:58:43'),
('2014-03-04', 23, 'Admin cla.estremos_admin logged in.', 'Admin Login', '23:59:08'),
('2014-03-04', 24, 'Admin cla.estremos_admin logged out.', 'Admin Login', '23:59:14'),
('2014-03-04', 25, 'Admin edelweisAV_admin logged in.', 'Admin Login', '23:59:27'),
('2014-03-04', 26, 'Admin edelweisAV_admin logged out.', 'Admin Login', '00:04:22'),
('2014-03-04', 27, 'Admin cla.estremos_admin logged in.', 'Admin Login', '00:45:44'),
('2014-03-04', 28, 'Admin cla.estremos_admin logged out.', 'Admin Login', '00:55:46'),
('2014-03-04', 29, 'Admin cla.estremos_admin logged in.', 'Admin Login', '01:13:44'),
('2014-03-04', 30, 'Admin cla.estremos_admin added a new book with Call Number: CS123', 'Add Book', '01:16:02'),
('2014-03-04', 31, 'Admin cla.estremos_admin updated book with ID Number: 42', 'Update Book', '01:16:41'),
('2014-03-04', 32, 'Admin cla.estremos_admin added a new announcement.', 'Add Announcement', '01:21:54'),
('2014-03-04', 33, 'Admin cla.estremos_admin logged out.', 'Admin Login', '01:22:24'),
('2014-03-05', 34, 'Admin cla.estremos_admin logged in.', 'Admin Login', '13:27:51'),
('2014-03-05', 35, 'Admin cla.estremos_admin logged in.', 'Admin Login', '05:49:54'),
('2014-03-05', 36, 'Admin cla.estremos_admin logged out.', 'Admin Login', '05:52:53'),
('2014-03-05', 37, 'Admin cla.estremos_admin logged in.', 'Admin Login', '06:20:50'),
('2014-03-05', 38, 'Admin cla.estremos_admin logged out.', 'Admin Login', '07:52:24'),
('2014-03-05', 39, 'Admin cla.estremos_admin logged in.', 'Admin Login', '07:53:34'),
('2014-03-06', 40, 'Admin cla.estremos_admin logged out.', 'Admin Login', '08:21:40'),
('2014-03-06', 41, 'Admin cla.estremos_admin logged in.', 'Admin Login', '08:21:49'),
('2014-03-06', 42, 'Admin cla.estremos_admin logged out.', 'Admin Login', '08:22:45'),
('2014-03-06', 43, 'Admin cla.estremos_admin logged in.', 'Admin Login', '08:25:21'),
('2014-03-06', 44, 'Admin cla.estremos_admin logged out.', 'Admin Login', '08:35:07'),
('2014-03-06', 45, 'Admin cla.estremos_admin logged in.', 'Admin Login', '09:02:31'),
('2014-03-06', 46, 'Admin cla.estremos_admin logged out.', 'Admin Login', '09:26:30'),
('2014-03-06', 47, 'Admin cla.estremos_admin logged in.', 'Admin Login', '09:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year_of_pub` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `no_of_available` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `book_stat` int(11) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `year_of_pub`, `type`, `no_of_available`, `quantity`, `book_stat`, `isbn`) VALUES
(1, 'The Latext Companion', 1994, 'BOOK', 1, 1, 5, '85-359-0277-5'),
(2, 'Internet Companion', 2002, 'BOOK', 0, 1, 7, '6-2898-9462-7'),
(3, 'Programmer’s Problem Solver', 1999, 'BOOK', 0, 2, 3, '7-1235-9462-7'),
(4, 'Turbo Pascal 5.5', 2000, 'BOOK', 0, 1, 8, '2-1234-9462-7'),
(5, 'The “C” Odyssey DOS', 1995, 'BOOK', 0, 1, 2, '6-0407-9462-7'),
(6, 'Java How to Program ( Object-Oriented Design w/ UML)', 1994, 'BOOK', 1, 2, 10, '6-1289-9462-7'),
(7, 'An Algorithm for the Reduction of Resistor', 1982, 'SP', 1, 1, 2, ''),
(8, 'Simulation of Programmable Robot Arms', 1996, 'SP', 3, 4, 5, ''),
(9, 'The Palacasan Tournament Scheduling Program', 1992, 'SP', 1, 1, 2, ''),
(10, 'Image Processing Using Artificial Intelligence', 1997, 'SP', 2, 2, 4, ''),
(11, 'Design and Implementation of Visible Program Execution Tools for Concurrent Programs', 1988, 'SP', 0, 1, 1, ''),
(12, 'Performance Analysis of Three Matrix Inversion Algorithms using NCR Machine (Pascal Language)', 1988, 'SP', 1, 1, 1, ''),
(13, 'A Database with a Natural Language Interface for a Small Medical Clinic', 1988, 'SP', 0, 1, 2, ''),
(14, 'POLYNNE: A Natural Language Interface for a Database and Modelbase Management System', 1988, 'SP', 1, 1, 1, ''),
(15, 'EXPERTS: A Prototype Expert System Shell in Prolog', 1988, 'SP', 0, 1, 1, ''),
(16, 'Programming with Data Structures', 1989, 'BOOK', 1, 1, 3, '6-4128-9462-7'),
(17, 'Algorithms', 1988, 'BOOK', 0, 1, 2, '6-1228-9462-7'),
(18, 'Algorithms and Data Structures', 1997, 'BOOK', 1, 1, 3, '99921-58-10-7'),
(19, 'Data Structures Using Pascal', 1997, 'BOOK', 1, 2, 2, '9971-5-0210-0'),
(20, 'Algorithms and Data Structures', 1985, 'BOOK', 0, 1, 5, '6-4028-1222-7'),
(21, 'Programming Languages', 1995, 'BOOK', 1, 1, 1, '6-9876-9462-7'),
(22, 'Principles of Programming Languages', 1993, 'BOOK', 1, 1, 2, '80-902734-1-6'),
(23, 'Structured Cobol Programming', 1994, 'BOOK', 1, 1, 1, '1-4028-9462-7'),
(24, 'Fortran 77 for Humans', 1980, 'BOOK', 1, 1, 2, '3-4028-9462-7'),
(25, 'Using Turbo Prolog', 1992, 'BOOK', 0, 1, 0, '6-4028-9462-7'),
(26, 'AUTOPED: An Expert System for Pediatric Diagnosis', 1989, 'SP', 1, 1, 2, ''),
(27, 'Assembly Language Implementation of Output Primitives and their Attributes', 1989, 'SP', 1, 1, 3, ''),
(28, 'A Totorial Simulation for Memory Management', 1989, 'SP', 1, 1, 1, ''),
(29, 'INTEGRATE: A Double Numerical Integrator', 1989, 'SP', 0, 1, 3, ''),
(30, 'PAM: A Toolbox for Drawing Graphs', 1989, 'SP', 1, 1, 2, ''),
(31, 'Introduction to Unix', 1990, 'BOOK', 2, 2, 4, '6-9856-9462-7'),
(33, 'FoxPro 2 made easy', 1998, 'BOOK', 1, 2, 5, '6-9028-9462-7'),
(34, 'Software Engg', 1999, 'BOOK', 0, 2, 2, '9-4028-9462-7'),
(35, 'The IBM PC and PS/2', 1996, 'BOOK', 1, 2, 1, '6-4028-9962-7'),
(36, 'Introduction to Computer Theory', 2000, 'BOOK', 1, 2, 3, '1-4929-9462-7'),
(37, 'Introduction to Automata Theory Languages and Computation\r\n', 1993, 'BOOK', 4, 4, 2, '6-9821-9462-7'),
(38, 'Data Structures and Algorithms', 1994, 'BOOK', 2, 2, 3, '6-4028-1232-7'),
(39, 'Computational Linguistics', 2001, 'BOOK', 1, 1, 4, '7-4028-9462-7'),
(40, 'Introduction to Artificial Intelligence And Expert Systems', 1998, 'BOOK', 2, 2, 6, '6-1982-9462-8'),
(41, 'Clipper dbase III plus Foxbase', 1989, 'BOOK', 1, 1, 4, '6-7812-9462-7'),
(42, 'Database Processing 3rd Ed.', 1977, 'BOOK', 1, 1, 2, '1-4028-9462-7'),
(43, 'Introduction to Data Processing 2nd ed.', 1977, 'BOOK', 1, 1, 3, '6-2128-9462-7'),
(44, 'Using SQL Windows and Centura', 1996, 'BOOK', 0, 1, 1, '6-9028-9462-7'),
(45, 'Knowledge Engineering', 1990, 'BOOK', 0, 1, 2, '960-425-059-0'),
(46, 'Design and Implementation of An Automated Tool for System Analysis', 1991, 'SP', 1, 1, 2, ''),
(47, 'CLS. Computer Literacy Software: A Computer Assisted Instruction package for Computer Science 11 Lab', 1991, 'SP', 1, 1, 4, ''),
(48, 'GEEDEE: A Software Package for Graph', 1991, 'SP', 0, 1, 3, ''),
(49, 'G-Brain: A Game of the Generals-Playing', 1991, 'SP', 1, 1, 2, ''),
(50, 'CRUNCH: Data Compression Utility Using Arithmetic Coding', 1991, 'SP', 0, 1, 4, ''),
(51, 'Balloon Fight Chrome Add on', 2009, 'SP', 1, 1, 0, ''),
(52, 'New BOok', 2014, 'BOOK', 1, 1, 0, '6-4129-9462-7');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`author`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `author`) VALUES
(9, 'Abary, A B'),
(46, 'Abuan, Ma. C M'),
(45, 'Adeli, H'),
(38, 'Aho,  AV/ et al'),
(47, 'Alviar, U G'),
(10, 'Anacleto, R S'),
(48, 'Anacleto, R S'),
(26, 'Araza, AD'),
(49, 'Arceno, M M'),
(4, 'Borland'),
(11, 'Calagday, L L'),
(50, 'Camayo, M M'),
(52, 'Christine Villaruel'),
(51, 'Clarissa Estremos'),
(36, 'Cohen, D'),
(12, 'Dayaoen, S L'),
(27, 'dela Cruz, Sp'),
(24, 'Didday'),
(6, 'Dietel'),
(52, 'Edelweis Valdellon'),
(28, 'Eloriaga, Ma. VC'),
(5, 'Gandhi, M'),
(41, 'Gardner, A/ et al'),
(13, 'Gloria, JV C'),
(1, 'Goosens'),
(29, 'Ho, LQ'),
(37, 'Hopcroft, JE/et al'),
(33, 'Jones, E'),
(18, 'Kingston, JH'),
(42, 'Kroenke, D'),
(16, 'Kruse, R L'),
(14, 'Lansigan, F L'),
(2, 'Lasquey, T'),
(30, 'Manila, AP'),
(8, 'Mishra, R'),
(1, 'Mittelback'),
(15, 'Moti, ZC B'),
(35, 'Norton, P/ et al'),
(24, 'Page'),
(40, 'Patterson, DW'),
(51, 'Paul Ivann Granada'),
(43, 'Popkin/pike'),
(44, 'Purba, S'),
(7, 'Ramos, L A'),
(25, 'Robinson, PR'),
(31, 'Schulman, M'),
(17, 'Sedgewick, R'),
(34, 'Sommerville'),
(23, 'Stein'),
(19, 'Tanenbaum, AM'),
(22, 'Tennent, RD'),
(21, 'Tucker, AB'),
(20, 'Wirth, N');

-- --------------------------------------------------------

--
-- Table structure for table `book_call_number`
--

CREATE TABLE IF NOT EXISTS `book_call_number` (
  `id` int(11) NOT NULL,
  `call_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`,`call_number`),
  KEY `call_number` (`call_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_call_number`
--

INSERT INTO `book_call_number` (`id`, `call_number`) VALUES
(7, '1982-1'),
(11, '1988-1'),
(15, '1988-11'),
(12, '1988-2'),
(13, '1988-3'),
(14, '1988-6'),
(26, '1989-1'),
(27, '1989-2'),
(28, '1989-3'),
(29, '1989-4'),
(30, '1989-5'),
(46, '1991-1'),
(47, '1991-2'),
(48, '1991-3'),
(49, '1991-4'),
(50, '1991-9'),
(9, '1992-1'),
(8, '1996-10'),
(8, '1996-11'),
(8, '1996-12'),
(8, '1996-13'),
(10, '1997-1'),
(10, '1997-2'),
(51, '2009-14'),
(1, 'A2'),
(2, 'B1'),
(3, 'C13'),
(3, 'C14'),
(4, 'C29'),
(52, 'CS123'),
(5, 'D10'),
(6, 'E4'),
(6, 'E5'),
(20, 'H12'),
(16, 'H2'),
(17, 'H5'),
(18, 'H6'),
(19, 'H7'),
(19, 'H8'),
(24, 'I16'),
(23, 'I4'),
(25, 'I5'),
(22, 'I7'),
(21, 'I8'),
(31, 'J18'),
(31, 'J19'),
(41, 'K1'),
(42, 'K2'),
(33, 'K22'),
(33, 'K23'),
(43, 'K3'),
(44, 'K6'),
(45, 'K9'),
(34, 'L8'),
(34, 'L9'),
(35, 'O7'),
(35, 'O8'),
(36, 'R4'),
(36, 'R5'),
(37, 'R6'),
(37, 'R7'),
(37, 'R8'),
(37, 'R9'),
(38, 'S3'),
(38, 'S4'),
(39, 'V2'),
(40, 'V4'),
(40, 'V5');

-- --------------------------------------------------------

--
-- Table structure for table `book_reservation`
--

CREATE TABLE IF NOT EXISTS `book_reservation` (
  `res_number` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `due_date` date DEFAULT NULL,
  `date_borrowed` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `account_number` varchar(20) NOT NULL,
  `call_number` varchar(20) NOT NULL,
  PRIMARY KEY (`res_number`),
  KEY `id` (`call_number`),
  KEY `account_number` (`account_number`),
  KEY `call_number` (`call_number`),
  KEY `account_number_2` (`account_number`),
  KEY `id_2` (`call_number`),
  KEY `call_number_2` (`call_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `book_reservation`
--

INSERT INTO `book_reservation` (`res_number`, `rank`, `status`, `due_date`, `date_borrowed`, `date_returned`, `account_number`, `call_number`) VALUES
(1, NULL, 'overdue', '2014-02-14', '2014-02-10', NULL, '2011-21376', 'B1'),
(2, NULL, 'overdue', '2014-02-03', '2014-02-07', NULL, '2011-21376', 'C13'),
(3, NULL, 'overdue', '2014-01-22', '2014-01-15', NULL, '2011-12345', 'D10'),
(4, NULL, 'overdue', '2014-02-28', '2014-02-24', NULL, '2011-21376', 'E4'),
(5, NULL, 'overdue', '2014-02-19', '2014-02-26', NULL, '1298918', '1996-10'),
(6, NULL, 'borrowed', '2014-03-07', '2014-03-03', NULL, '1298918', '1988-11'),
(7, NULL, 'borrowed', '2014-03-18', '2014-03-11', NULL, '2011-12345', 'H12'),
(8, NULL, 'overdue', '2014-02-11', '2014-03-04', NULL, '2011-12345', 'I5'),
(9, NULL, 'overdue', '2013-12-25', '2013-11-11', NULL, '1298918', 'C14'),
(10, NULL, 'overdue', '2014-02-21', '2014-02-28', NULL, '12345345', '1989-4'),
(11, NULL, 'returned', '2014-01-07', '2013-12-31', '2014-03-05', '2010-90877', '1997-2'),
(12, NULL, 'returned', '2014-01-07', '2013-12-31', '2014-03-05', '2010-90877', '1997-1'),
(13, NULL, 'returned', '2014-02-12', '2014-02-05', '2014-02-10', '2010-90877', '1996-10'),
(14, NULL, 'returned', '2013-11-08', '2013-11-04', '2013-11-06', '12345345', 'C29'),
(15, NULL, 'returned', '2014-01-10', '2014-01-06', '2014-01-15', '1298918', '1982-1'),
(16, NULL, 'returned', '2014-01-24', '2014-01-20', '2014-01-23', '2011-21376', '1992-1'),
(17, NULL, 'overdue', '2014-02-18', '2014-02-25', NULL, '12345345', 'K22'),
(18, NULL, 'borrowed', '2014-03-17', '2014-03-10', NULL, '12345345', 'R5'),
(19, NULL, 'overdue', '2014-02-28', '2014-02-21', NULL, '10110101', '1991-3'),
(20, NULL, 'returned', '2014-02-14', '2014-02-10', '2014-03-05', '2010-90877', '1988-2'),
(22, NULL, 'returned', '2013-12-20', '2013-12-16', '2013-12-18', '2011-12345', '1989-4'),
(23, NULL, 'returned', '2014-01-30', '2014-01-23', '2014-01-28', '2011-12345', '1996-10'),
(24, NULL, 'returned', '2014-01-21', '2014-01-14', '2014-01-16', '2011-21376', 'K3'),
(25, NULL, 'returned', '2014-02-12', '2014-02-05', '2014-02-12', '2011-12345', 'O7'),
(26, NULL, 'returned', '2014-01-24', '2014-01-20', '2014-01-24', '10110101', 'H12'),
(27, NULL, 'returned', '2013-12-17', '2013-12-10', '2014-02-04', '2012-12312', '1989-2'),
(28, NULL, 'returned', '2014-02-14', '2014-02-10', '2014-02-13', '2010-90877', 'R5'),
(29, NULL, 'returned', '2013-12-27', '2013-12-23', '2013-12-27', '2011-21376', 'V5'),
(30, NULL, 'returned', '2014-02-07', '2014-02-03', '2014-02-05', '12345345', '1989-4'),
(31, NULL, 'overdue', '2014-01-07', '2013-12-31', NULL, '2011-21400', '1988-1'),
(32, NULL, 'overdue', '2014-01-15', '2014-01-07', NULL, '2011-21400', 'L8'),
(33, NULL, 'overdue', '2014-01-08', '2014-01-01', NULL, '2011-21400', 'K6'),
(35, NULL, 'overdue', '2014-02-11', '2014-02-04', NULL, '2011-26806', 'H7'),
(36, NULL, 'overdue', '2013-12-11', '2013-12-04', NULL, '2011-26806', 'K9'),
(37, NULL, 'returned', '2013-12-17', '2013-12-10', '2014-03-05', '2011-21569', 'R6'),
(38, NULL, 'overdue', '2014-02-04', '2014-01-28', NULL, '2011-21569', 'O7'),
(39, NULL, 'overdue', '2013-12-17', '2013-12-10', NULL, '2011-21569', 'H5'),
(46, NULL, 'overdue', '2014-03-05', '2014-02-19', NULL, '2011-12345', '1991-9'),
(47, NULL, 'borrowed', '2014-03-20', '2014-03-06', NULL, '2011-21376', '1988-3'),
(49, NULL, 'reserved', '2014-03-11', NULL, NULL, '2011-21376', '1989-2');

-- --------------------------------------------------------

--
-- Table structure for table `book_subject`
--

CREATE TABLE IF NOT EXISTS `book_subject` (
  `id` int(11) NOT NULL,
  `subject` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_subject`
--

INSERT INTO `book_subject` (`id`, `subject`) VALUES
(1, 'CMSC 1'),
(2, 'CMSC 100'),
(2, 'CMSC 2'),
(3, 'CMSC 11'),
(4, 'CMSC 11'),
(4, 'CMSC 124'),
(5, 'CMSC 11'),
(6, 'CMSC 170'),
(6, 'CMSC 22'),
(7, 'CMSC 190'),
(8, 'CMSC 190'),
(9, 'CMSC 190'),
(10, 'CMSC 190'),
(11, 'CMSC 190'),
(12, 'CMSC 190'),
(13, 'CMSC 190'),
(14, 'CMSC 190'),
(15, 'CMSC 190'),
(16, 'CMSC 123'),
(17, 'CMSC 123'),
(18, 'CMSC 123'),
(19, 'CMSC 123'),
(20, 'CMSC 123'),
(21, 'CMSC 124'),
(22, 'CMSC 124'),
(23, 'CMSC 124'),
(24, 'CMSC 124'),
(25, 'CMSC 124'),
(26, 'CMSC 190'),
(27, 'CMSC 190'),
(28, 'CMSC 190'),
(29, 'CMSC 190'),
(30, 'CMSC 190'),
(31, 'CMSC 125'),
(33, 'CMSC 127'),
(34, 'CMSC 128'),
(35, 'CMSC 131'),
(36, 'CMSC 141'),
(37, 'CMSC 141'),
(38, 'CMSC 142'),
(39, 'CMSC 170 '),
(40, 'CMSC 170'),
(41, 'CMSC 127'),
(42, 'CMSC 127'),
(43, 'CMSC 127'),
(44, 'CMSC 127'),
(45, 'CMSC 127'),
(46, 'CMSC 190'),
(47, 'CMSC 190'),
(48, 'CMSC 190'),
(49, 'CMSC 190'),
(50, 'CMSC 190'),
(51, 'CMSC 137'),
(52, 'CMSC 123'),
(52, 'CMSC 21');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(2, 'Internet'),
(2, 'Web'),
(3, 'Problem Solving'),
(3, 'Programmer'),
(4, 'Pascal'),
(4, 'Programming Language'),
(5, 'C'),
(5, 'Programming Language'),
(6, 'Artificial Intelligence'),
(6, 'Java'),
(6, 'Object Oriented '),
(7, 'Algorithm'),
(7, 'Resistor'),
(8, 'Robotics'),
(8, 'Simulation'),
(9, 'Scheduling'),
(10, 'Artificial Intelligence'),
(10, 'Image Processing'),
(11, 'Concurrency'),
(12, 'Matrices'),
(13, 'Database'),
(14, 'Database'),
(15, 'Shell'),
(16, 'Data Structures'),
(16, 'Programming'),
(17, 'Algorithms'),
(18, 'Algorithms'),
(18, 'Data Structures'),
(19, 'Data Structures'),
(19, 'Pascal'),
(20, 'Algorithms'),
(20, 'Data Structures'),
(21, 'Programming Languages'),
(22, 'Programming Languages'),
(23, 'Cobol, Programming'),
(24, 'Fortran, Programming Languages'),
(25, 'Turbo Prolog Programming Languages'),
(26, 'Assembly Output Primitives'),
(27, 'Assembly'),
(28, 'Memory Management Simulation'),
(28, 'Simulation'),
(29, 'Numerical Integrator'),
(30, 'Graphics'),
(30, 'Graphs'),
(31, 'Operating Systems'),
(31, 'Unix'),
(33, 'Assembly Language'),
(34, 'Engineering'),
(34, 'Software Engineering'),
(35, 'IBM'),
(36, 'Computer Theory'),
(37, 'Automata Theory Languages'),
(37, 'Computation'),
(38, 'Data Structures'),
(39, 'Linguistics'),
(40, 'Artificial Intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `account_number` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `classification` varchar(7) NOT NULL,
  `college` varchar(5) NOT NULL,
  `course` varchar(8) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(7) NOT NULL,
  `date_notif` date DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_initial` varchar(3) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `account_number` (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`account_number`, `password`, `username`, `classification`, `college`, `course`, `email`, `status`, `date_notif`, `first_name`, `middle_initial`, `last_name`) VALUES
('2011-12345', '68487b8490a28923e0bc32927a8c5c5e63f66a54', 'cla.estremos', 'student', 'CAS', 'BSCS', 'cla.estremos@gmail.com', 'approve', '2014-01-21', 'Clarissa', 'S', 'Estremos'),
('2012-12312', 'a096dabb9fcfb43763a40c771abfa713de7d2b97', 'dummy.account', 'student', 'CAS', 'BSCS', 'dummy@gmail.com', 'approve', NULL, 'Dummy', 'A', 'Account'),
('2011-21376', '7bc17e9283a3638bbda504f3089fb7fedd976f11', 'edelweisAV', 'student', 'CAS', 'BSCS', 'edelweisAV@gmail.com', 'approve', '2014-02-03', 'Edelweis', 'A', 'Valdellon'),
('2011-27573', '05fe7461c607c33229772d402505601016a7d0ea', 'edlexpogi', 'student', 'CAS', 'BSCS', 'edlex.pogi@gmail.com', 'pending', NULL, 'Edlex', 'J.', 'Purificacion'),
('10110101', '7e57cfe843145135aee1f4d0d63ceb7842093712', 'ivann', 'faculty', 'CAS', NULL, 'faculty_ivann@gmail.com', 'approve', '2014-02-04', 'Paul Ivann', 'E', 'Granada'),
('2011-26806', 'e598c132c8fc497ee05802af14ba7ec60da13760', 'julius.iglesia', 'student', 'CAS', 'BSCS', 'jmiglesia@gmail.com', 'approve', NULL, 'Julius', 'M ', 'Iglesia'),
('2010-90877', '53fc06bd596f54cf3c3092f3f480b18455ab2d32', 'kara.lane', 'student', 'CAS', 'BSCS', 'kara.lane@gmail.com', 'approve', '2014-01-13', 'Kara Lane', 'V', 'Zurbano'),
('2011-21569', 'c6b34fc287a49e37cf50da174e0639e63b3e472e', 'kara.love.gabby', 'student', 'CAS', 'BSCS', 'karalane_z@gmail.com', 'approve', NULL, 'Kara Lane', 'V', 'Zurbano'),
('2011-11111', 'dec7dd342a499dfd4d283d872ccf598d8a7b6039', 'karaccc', 'student', 'CAS', 'BA Socio', 'karazurbano@gmail.com', 'pending', NULL, 'Kim', 'A', 'Cute'),
('12345345', 'a6312121e15caec74845b7ba5af23330d52d4ac0', 'kimsamaniego', 'faculty', 'CAS', NULL, 'kim.samaniego@yahoo.com', 'approve', NULL, 'Kim', 'P', 'Samaniego'),
('2011-21400', '075b136d4540e876093c90ad512c290caa5c0958', 'madam.muriel', 'student', 'CAS', 'BSCS', 'muriel_g@gmail.com', 'approve', NULL, 'Anne Muriel', 'V', 'Gonzales'),
('101111100', '7e57cfe843145135aee1f4d0d63ceb7842093712', 'pending.user', 'faculty', 'CEAT', NULL, 'pending.user@uplb.edu.ph', 'pending', NULL, 'From', 'C', 'Ceat'),
('1298918', '829c3804401b0727f70f73d4415e162400cbe57b', 'trial', 'faculty', 'CEM', NULL, 'cem.plangan@gmail.com', 'approve', '2014-01-28', 'Lou Erika', 'U', 'Muega'),
('2011-31907', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Yanyan', 'student', 'CHE', 'BSHE', 'yanyantarong@gmail.com', 'pending', NULL, 'YANYAN', 'T', 'ARRIESGADO');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD CONSTRAINT `admin_account_ibfk_1` FOREIGN KEY (`parent_key`) REFERENCES `admin_account` (`admin_key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_call_number`
--
ALTER TABLE `book_call_number`
  ADD CONSTRAINT `book_call_number_ibfk_1` FOREIGN KEY (`id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_reservation`
--
ALTER TABLE `book_reservation`
  ADD CONSTRAINT `book_reservation_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `user_account` (`account_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_reservation_ibfk_2` FOREIGN KEY (`call_number`) REFERENCES `book_call_number` (`call_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_subject`
--
ALTER TABLE `book_subject`
  ADD CONSTRAINT `book_subject_ibfk_1` FOREIGN KEY (`id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
