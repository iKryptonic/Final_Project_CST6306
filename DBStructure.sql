-- --------------------------------------------------------
-- Host:                         192.168.1.128
-- Server version:               8.0.28-0ubuntu0.20.04.3 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cst6306
CREATE DATABASE IF NOT EXISTS `cst6306` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cst6306`;

-- Dumping structure for table cst6306.Administrator
CREATE TABLE IF NOT EXISTS `Administrator` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Administrator: ~0 rows (approximately)
/*!40000 ALTER TABLE `Administrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `Administrator` ENABLE KEYS */;

-- Dumping structure for table cst6306.Course
CREATE TABLE IF NOT EXISTS `Course` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `meets_at` varchar(200) NOT NULL,
  `room` varchar(50) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Course: ~0 rows (approximately)
/*!40000 ALTER TABLE `Course` DISABLE KEYS */;
/*!40000 ALTER TABLE `Course` ENABLE KEYS */;

-- Dumping structure for table cst6306.Enrolled
CREATE TABLE IF NOT EXISTS `Enrolled` (
  `sid` int NOT NULL,
  `oid` int NOT NULL,
  KEY `FK_Enrolled_Student` (`sid`),
  KEY `FK_Enrolled_Offered` (`oid`),
  CONSTRAINT `FK_Enrolled_Offered` FOREIGN KEY (`oid`) REFERENCES `Offered` (`oid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Enrolled_Student` FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Enrolled: ~0 rows (approximately)
/*!40000 ALTER TABLE `Enrolled` DISABLE KEYS */;
/*!40000 ALTER TABLE `Enrolled` ENABLE KEYS */;

-- Dumping structure for table cst6306.Faculty
CREATE TABLE IF NOT EXISTS `Faculty` (
  `fid` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL DEFAULT '0',
  `department` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Faculty: ~0 rows (approximately)
/*!40000 ALTER TABLE `Faculty` DISABLE KEYS */;
/*!40000 ALTER TABLE `Faculty` ENABLE KEYS */;

-- Dumping structure for procedure cst6306.insert_admin
DELIMITER //
CREATE DEFINER=`ikrypto`@`%` PROCEDURE `insert_admin`(
	IN `username` varchar(100),
	IN `passwd` varchar(100)
)
BEGIN 
	INSERT INTO Administrator(`uid`, `username`, `password`)
	VALUES(NULL, username, passwd);
END//
DELIMITER ;

-- Dumping structure for procedure cst6306.insert_course
DELIMITER //
CREATE DEFINER=`ikrypto`@`%` PROCEDURE `insert_course`(
	IN `cname` varchar(100),
	IN `meets_at` varchar(200),
	IN `room` varchar(50)
)
BEGIN 
	INSERT INTO Course(`cid`, `cname`, `meets_at`, `room`)
	VALUES(NULL, cname, meets_at, room);
END//
DELIMITER ;

-- Dumping structure for procedure cst6306.insert_faculty
DELIMITER //
CREATE DEFINER=`ikrypto`@`%` PROCEDURE `insert_faculty`(
	IN `fname` varchar(100),
	IN `department` varchar(50)
)
BEGIN 
	INSERT INTO Faculty(`fid`, `fname`, `department`)
	VALUES(NULL, fname, department);
END//
DELIMITER ;

-- Dumping structure for procedure cst6306.insert_student
DELIMITER //
CREATE DEFINER=`ikrypto`@`%` PROCEDURE `insert_student`(
	IN `sname` varchar(50),
	IN `major` varchar(50),
	IN `studentLevel` varchar(50),
	IN `byear` int
	


)
BEGIN 
	INSERT INTO Student(`sid`, `sname`, `major`, `level`, `byear`)
	VALUES(NULL, sname, major, studentLevel, byear);
END//
DELIMITER ;

-- Dumping structure for table cst6306.Offered
CREATE TABLE IF NOT EXISTS `Offered` (
  `oid` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `fid` int NOT NULL,
  `semester` varchar(10) NOT NULL,
  `year` int NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Offered: ~0 rows (approximately)
/*!40000 ALTER TABLE `Offered` DISABLE KEYS */;
/*!40000 ALTER TABLE `Offered` ENABLE KEYS */;

-- Dumping structure for table cst6306.previous_courses
CREATE TABLE IF NOT EXISTS `previous_courses` (
  `cid` int NOT NULL,
  `cname` varchar(100) NOT NULL,
  `meets_at` varchar(200) NOT NULL,
  `room` varchar(50) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.previous_courses: ~0 rows (approximately)
/*!40000 ALTER TABLE `previous_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `previous_courses` ENABLE KEYS */;

-- Dumping structure for table cst6306.Student
CREATE TABLE IF NOT EXISTS `Student` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `byear` int DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cst6306.Student: ~0 rows (approximately)
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;

-- Dumping structure for trigger cst6306.course_on_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `course_on_delete` AFTER DELETE ON `Course` FOR EACH ROW BEGIN
	INSERT INTO previous_courses(cid,cname,meets_at,room) VALUES(OLD.cid,OLD.cname,OLD.meets_at,OLD.room);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
