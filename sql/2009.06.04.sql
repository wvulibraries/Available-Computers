-- MySQL dump 10.11
--
-- Host: localhost    Database: availableComputers
-- ------------------------------------------------------
-- Server version	5.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `buildings`
--

DROP TABLE IF EXISTS `buildings`;
CREATE TABLE `buildings` (
  `building_id` tinyint(2) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buildings`
--

LOCK TABLES `buildings` WRITE;
/*!40000 ALTER TABLE `buildings` DISABLE KEYS */;
INSERT INTO `buildings` VALUES (1,'Downtown Campus Library');
/*!40000 ALTER TABLE `buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computers`
--

DROP TABLE IF EXISTS `computers`;
CREATE TABLE `computers` (
  `id` int(11) NOT NULL auto_increment,
  `table_type` varchar(20) default NULL,
  `table_location` varchar(2) default NULL,
  `table_name` varchar(20) default NULL,
  `building` tinyint(2) default NULL,
  `floor` varchar(3) default NULL,
  `number` int(3) default NULL,
  `computer_name` varchar(30) default NULL,
  `availability` varchar(12) default NULL,
  `os` varchar(15) NOT NULL default 'windows',
  `function` varchar(15) default 'normal',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `computers`
--

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES (1,'leftHalfRound','s','halfRound1',1,'1',1,'DLCP-1-01','unavailable','windows','normal'),(2,'leftHalfRound','sw','halfRound1',1,'1',2,'DLCP-1-02','unavailable','windows','normal'),(3,'leftHalfRound','w','halfRound1',1,'1',3,'DLCP-1-03','unavailable','windows','normal'),(4,'leftHalfRound','nw','halfRound1',1,'1',4,'DLCP-1-04','unavailable','windows','normal'),(5,'leftHalfRound','n','halfRound1',1,'1',5,'DLCP-1-05','unavailable','windows','normal'),(6,'leftHalfRound','i','halfRound1',1,'1',6,'DLCP-1-06','unavailable','windows','normal'),(7,'rightHalfRound','i','halfRound2',1,'1',7,'DLCP-1-07','unavailable','windows','normal'),(8,'rightHalfRound','s','halfRound2',1,'1',8,'DLCP-1-08','unavailable','windows','normal'),(9,'rightHalfRound','se','halfRound2',1,'1',9,'DLCP-1-09','unavailable','windows','normal'),(10,'rightHalfRound','e','halfRound2',1,'1',10,'DLCP-1-10','available','windows','normal'),(11,'rightHalfRound','ne','halfRound2',1,'1',11,'DLCP-1-11','available','windows','normal'),(12,'rightHalfRound','n','halfRound2',1,'1',12,'DLCP-1-12','unavailable','windows','normal'),(13,'leftHalfRound','s','halfRound3',1,'1',14,'DLCP-1-14','available','windows','normal'),(14,'leftHalfRound','sw','halfRound3',1,'1',15,'DLCP-1-15','unavailable','windows','normal'),(15,'leftHalfRound','w','halfRound3',1,'1',16,'DLCP-1-16','available','windows','normal'),(16,'leftHalfRound','nw','halfRound3',1,'1',17,'DLCP-1-17','available','windows','normal'),(17,'leftHalfRound','n','halfRound3',1,'1',18,'DLCP-1-18','available','windows','normal'),(18,'rightHalfRound','s','halfRound4',1,'1',19,'DLCP-1-19','available','windows','normal'),(19,'rightHalfRound','se','halfRound4',1,'1',20,'DLCP-1-20','unavailable','windows','normal'),(20,'rightHalfRound','e','halfRound4',1,'1',21,'DLCP-1-21','available','windows','normal'),(21,'rightHalfRound','ne','halfRound4',1,'1',22,'DLCP-1-22','available','windows','normal'),(22,'rightHalfRound','n','halfRound4',1,'1',23,'DLCP-1-23','available','windows','normal'),(23,'leftHalfRound','n','halfRound5',1,'1',25,'DLCP-1-25','available','windows','normal'),(24,'leftHalfRound','nw','halfRound5',1,'1',26,'DLCP-1-26','available','windows','normal'),(25,'leftHalfRound','w','halfRound5',1,'1',27,'DLCP-1-27','available','windows','normal'),(26,'leftHalfRound','sw','halfRound5',1,'1',28,'DLCP-1-28','available','windows','normal'),(27,'leftHalfRound','s','halfRound5',1,'1',29,'DLCP-1-29','available','windows','normal'),(28,'leftHalfRound','i','halfRound5',1,'1',30,'DLCP-1-30','available','windows','normal'),(29,'rightHalfRound','i','halfRound6',1,'1',31,'DLCP-1-31','available','windows','normal'),(30,'rightHalfRound','s','halfRound6',1,'1',32,'DLCP-1-32','available','windows','normal'),(31,'rightHalfRound','se','halfRound6',1,'1',33,'DLCP-1-33','available','windows','normal'),(32,'rightHalfRound','e','halfRound6',1,'1',34,'DLCP-1-34','available','windows','normal'),(33,'rightHalfRound','ne','halfRound6',1,'1',35,'DLCP-1-35','available','windows','normal'),(34,'rightHalfRound','n','halfRound6',1,'1',36,'DLCP-1-36','unavailable','windows','normal'),(35,'lowerHalfRound','w','halfRound7',1,'1',37,'DLCP-1-37','available','windows','normal'),(36,'lowerHalfRound','sw','halfRound7',1,'1',38,'DLCP-1-38','available','windows','normal'),(37,'lowerHalfRound','s','halfRound7',1,'1',39,'DLCP-1-39','available','windows','normal'),(38,'lowerHalfRound','se','halfRound7',1,'1',40,'DLCP-1-40','available','windows','normal'),(39,'lowerHalfRound','e','halfRound7',1,'1',42,'DLCP-1-42','available','windows','normal'),(40,'upperHalfRound','i','halfRound8',1,'1',43,'DLCP-1-43','available','windows','normal'),(41,'upperHalfRound','e','halfRound8',1,'1',44,'DLCP-1-44','available','windows','normal'),(42,'upperHalfRound','ne','halfRound8',1,'1',45,'DLCP-1-45','available','windows','normal'),(43,'upperHalfRound','n','halfRound8',1,'1',46,'DLCP-1-46','available','windows','normal'),(44,'upperHalfRound','nw','halfRound8',1,'1',47,'DLCP-1-47','available','windows','normal'),(45,'upperHalfRound','w','halfRound8',1,'1',48,'DLCP-1-48','available','windows','normal'),(46,'rightHalfRound','n','halfRound9',1,'1',49,'DLCP-1-49','unavailable','windows','normal'),(47,'rightHalfRound','ne','halfRound9',1,'1',50,'DLCP-1-50','available','windows','normal'),(48,'rightHalfRound','e','halfRound9',1,'1',51,'DLCP-1-51','available','windows','normal'),(49,'rightHalfRound','se','halfRound9',1,'1',52,'DLCP-1-52','available','windows','normal'),(50,'rightHalfRound','s','halfRound9',1,'1',53,'DLCP-1-53','offline','windows','normal'),(51,'rightHalfRound','i','halfRound9',1,'1',54,'DLCP-1-54','available','windows','normal'),(52,'leftHalfRound','i','halfRound10',1,'1',55,'DLCP-1-55','available','windows','normal'),(53,'leftHalfRound','n','halfRound10',1,'1',56,'DLCP-1-56','available','windows','normal'),(54,'leftHalfRound','nw','halfRound10',1,'1',57,'DLCP-1-57','available','windows','normal'),(55,'leftHalfRound','w','halfRound10',1,'1',58,'DLCP-1-58','available','windows','normal'),(56,'leftHalfRound','sw','halfRound10',1,'1',59,'DLCP-1-59','available','windows','normal'),(57,'leftHalfRound','s','halfRound10',1,'1',60,'DLCP-1-60','available','windows','normal'),(58,'rightHalfRound','s','halfRound11',1,'1',61,'DLCP-1-61','available','windows','normal'),(59,'rightHalfRound','se','halfRound11',1,'1',62,'DLCP-1-62','available','windows','normal'),(60,'rightHalfRound','e','halfRound11',1,'1',63,'DLCP-1-63','available','windows','normal'),(61,'rightHalfRound','ne','halfRound11',1,'1',64,'DLCP-1-64','offline','windows','normal'),(62,'rightHalfRound','n','halfRound11',1,'1',65,'DLCP-1-65','available','windows','normal'),(63,'rightHalfRound','i','halfRound11',1,'1',66,'DLCP-1-66','unavailable','windows','normal'),(64,'leftHalfRound','i','halfRound12',1,'1',67,'DLCP-1-67','available','windows','normal'),(65,'leftHalfRound','n','halfRound12',1,'1',68,'DLCP-1-68','available','windows','normal'),(66,'leftHalfRound','nw','halfRound12',1,'1',69,'DLCP-1-69','available','windows','normal'),(67,'leftHalfRound','w','halfRound12',1,'1',70,'DLCP-1-70','available','windows','normal'),(68,'leftHalfRound','sw','halfRound12',1,'1',71,'DLCP-1-71','available','windows','normal'),(69,'leftHalfRound','s','halfRound12',1,'1',72,'DLCP-1-72','available','windows','normal'),(70,'leftHalfRound','s','halfRound13',1,'1',73,'DLCP-1-73','available','windows','normal'),(71,'leftHalfRound','sw','halfRound13',1,'1',74,'DLCP-1-74','available','windows','normal'),(72,'leftHalfRound','w','halfRound13',1,'1',75,'DLCP-1-75','available','windows','normal'),(73,'leftHalfRound','nw','halfRound13',1,'1',76,'DLCP-1-76','available','windows','normal'),(74,'leftHalfRound','n','halfRound13',1,'1',77,'DLCP-1-77','available','windows','normal'),(75,'leftHalfRound','i','halfRound13',1,'1',78,'DLCP-1-78','available','windows','normal'),(76,'rightHalfRound','n','halfRound14',1,'1',79,'DLCP-1-79','available','windows','normal'),(77,'rightHalfRound','ne','halfRound14',1,'1',80,'DLCP-1-80','available','windows','normal'),(78,'rightHalfRound','e','halfRound14',1,'1',81,'DLCP-1-81','available','windows','normal'),(79,'rightHalfRound','se','halfRound14',1,'1',82,'DLCP-1-82','available','windows','normal'),(80,'rightHalfRound','s','halfRound14',1,'1',83,'DLCP-1-83','available','windows','normal'),(81,'rightHalfRound','i','halfRound14',1,'1',84,'DLCP-1-84','available','windows','normal'),(82,'lowerHalfRound','w','halfRound1',1,'2',1,'DLCP-2-01','available','windows','normal'),(83,'lowerHalfRound','sw','halfRound1',1,'2',2,'DLCP-2-02','available','windows','normal'),(84,'lowerHalfRound','s','halfRound1',1,'2',3,'DLCP-2-03','available','windows','normal'),(85,'lowerHalfRound','se','halfRound1',1,'2',4,'DLCP-2-04','available','windows','normal'),(86,'lowerHalfRound','e','halfRound1',1,'2',5,'DLCP-2-05','available','windows','normal'),(87,'lowerHalfRound','i','halfRound1',1,'2',6,'DLCP-2-06','unavailable','windows','normal'),(88,'upperHalfRound','e','halfRound2',1,'2',7,'DLCP-2-07','available','windows','normal'),(89,'upperHalfRound','ne','halfRound2',1,'2',8,'DLCP-2-08','unavailable','windows','normal'),(90,'upperHalfRound','n','halfRound2',1,'2',9,'DLCP-2-09','available','windows','normal'),(91,'upperHalfRound','nw','halfRound2',1,'2',10,'DLCP-2-10','available','windows','normal'),(92,'upperHalfRound','w','halfRound2',1,'2',11,'DLCP-2-11','available','windows','normal'),(93,'leftHalfRound','n','halfRound1',1,'4',1,'DLCP-4-01','available','windows','normal'),(94,'leftHalfRound','nw','halfRound1',1,'4',2,'DLCP-4-02','available','windows','normal'),(95,'leftHalfRound','w','halfRound1',1,'4',3,'DLCP-4-03','available','windows','normal'),(96,'leftHalfRound','sw','halfRound1',1,'4',4,'DLCP-4-04','available','windows','normal'),(97,'leftHalfRound','s','halfRound1',1,'4',5,'DLCP-4-05','unavailable','windows','normal'),(98,'leftHalfRound','i','halfRound1',1,'4',6,'DLCP-4-06','available','windows','normal'),(99,'rightHalfRound','i','halfRound2',1,'4',7,'DLCP-4-07','available','windows','normal'),(100,'rightHalfRound','s','halfRound2',1,'4',8,'DLCP-4-08','available','windows','normal'),(101,'rightHalfRound','se','halfRound2',1,'4',9,'DLCP-4-09','available','windows','normal'),(102,'rightHalfRound','e','halfRound2',1,'4',10,'DLCP-4-10','available','windows','normal'),(103,'rightHalfRound','ne','halfRound2',1,'4',11,'DLCP-4-11','available','windows','normal'),(104,'rightHalfRound','n','halfRound2',1,'4',12,'DLCP-4-12','available','windows','normal'),(105,'lowerHalfRound','w','halfRound3',1,'4',13,'DLCP-4-13','available','windows','normal'),(106,'lowerHalfRound','sw','halfRound3',1,'4',14,'DLCP-4-14','available','windows','normal'),(107,'lowerHalfRound','s','halfRound3',1,'4',15,'DLCP-4-15','available','windows','normal'),(108,'lowerHalfRound','se','halfRound3',1,'4',16,'DLCP-4-16','available','windows','normal'),(109,'lowerHalfRound','e','halfRound3',1,'4',17,'DLCP-4-17','available','windows','normal'),(110,'upperHalfRound','i','halfRound4',1,'4',18,'DLCP-4-18','available','windows','normal'),(111,'upperHalfRound','e','halfRound4',1,'4',19,'DLCP-4-19','available','windows','normal'),(112,'upperHalfRound','ne','halfRound4',1,'4',20,'DLCP-4-20','available','windows','normal'),(113,'upperHalfRound','n','halfRound4',1,'4',21,'DLCP-4-21','available','windows','normal'),(114,'upperHalfRound','nw','halfRound4',1,'4',22,'DLCP-4-22','available','windows','normal'),(115,'upperHalfRound','w','halfRound4',1,'4',23,'DLCP-4-23','available','windows','normal'),(116,'lowerHalfRound','w','halfRound5',1,'4',25,'DLCP-4-25','available','windows','normal'),(117,'lowerHalfRound','sw','halfRound5',1,'4',26,'DLCP-4-26','available','windows','normal'),(118,'lowerHalfRound','s','halfRound5',1,'4',27,'DLCP-4-27','available','windows','normal'),(119,'lowerHalfRound','se','halfRound5',1,'4',28,'DLCP-4-28','available','windows','normal'),(120,'lowerHalfRound','e','halfRound5',1,'4',29,'DLCP-4-29','available','windows','normal'),(121,'upperHalfRound','i','halfRound6',1,'4',31,'DLCP-4-31','available','windows','normal'),(122,'upperHalfRound','e','halfRound6',1,'4',32,'DLCP-4-32','available','windows','normal'),(123,'upperHalfRound','ne','halfRound6',1,'4',33,'DLCP-4-33','available','windows','normal'),(124,'upperHalfRound','n','halfRound6',1,'4',34,'DLCP-4-34','available','windows','normal'),(125,'upperHalfRound','nw','halfRound6',1,'4',35,'DLCP-4-35','available','windows','normal'),(126,'upperHalfRound','w','halfRound6',1,'4',36,'DLCP-4-36','available','windows','normal'),(127,'leftHalfRound','n','halfRound1',1,'6',1,'DLCP-6-01','available','windows','normal'),(128,'leftHalfRound','nw','halfRound1',1,'6',2,'DLCP-6-02','available','windows','normal'),(129,'leftHalfRound','w','halfRound1',1,'6',3,'DLCP-6-03','available','windows','normal'),(130,'leftHalfRound','sw','halfRound1',1,'6',4,'DLCP-6-04','available','windows','normal'),(131,'leftHalfRound','s','halfRound1',1,'6',5,'DLCP-6-05','available','windows','normal'),(132,'leftHalfRound','i','halfRound1',1,'6',6,'DLCP-6-06','available','windows','normal'),(133,'rightHalfRound','i','halfRound2',1,'6',7,'DLCP-6-07','unavailable','windows','normal'),(134,'rightHalfRound','s','halfRound2',1,'6',8,'DLCP-6-08','available','windows','normal'),(135,'rightHalfRound','se','halfRound2',1,'6',9,'DLCP-6-09','available','windows','normal'),(136,'rightHalfRound','e','halfRound2',1,'6',10,'DLCP-6-10','available','windows','normal'),(137,'rightHalfRound','ne','halfRound2',1,'6',11,'DLCP-6-11','available','windows','normal'),(138,'rightHalfRound','n','halfRound2',1,'6',12,'DLCP-6-12','available','windows','normal'),(139,'lowerHalfRound','w','halfRound3',1,'6',13,'DLCP-6-13','available','windows','normal'),(140,'lowerHalfRound','sw','halfRound3',1,'6',14,'DLCP-6-14','available','windows','normal'),(141,'lowerHalfRound','s','halfRound3',1,'6',15,'DLCP-6-15','available','windows','normal'),(142,'lowerHalfRound','se','halfRound3',1,'6',16,'DLCP-6-16','available','windows','normal'),(143,'lowerHalfRound','e','halfRound3',1,'6',17,'DLCP-6-17','available','windows','normal'),(144,'upperHalfRound','i','halfRound4',1,'6',19,'DLCP-6-19','available','windows','normal'),(145,'upperHalfRound','e','halfRound4',1,'6',20,'DLCP-6-20','available','windows','normal'),(146,'upperHalfRound','ne','halfRound4',1,'6',21,'DLCP-6-21','available','windows','normal'),(147,'upperHalfRound','n','halfRound4',1,'6',22,'DLCP-6-22','available','windows','normal'),(148,'upperHalfRound','nw','halfRound4',1,'6',23,'DLCP-6-23','available','windows','normal'),(149,'upperHalfRound','w','halfRound4',1,'6',24,'DLCP-6-24','unavailable','windows','normal'),(150,'lowerHalfRound','w','halfRound5',1,'6',25,'DLCP-6-25','available','windows','normal'),(151,'lowerHalfRound','sw','halfRound5',1,'6',26,'DLCP-6-26','available','windows','normal'),(152,'lowerHalfRound','s','halfRound5',1,'6',27,'DLCP-6-27','available','windows','normal'),(153,'lowerHalfRound','se','halfRound5',1,'6',28,'DLCP-6-28','available','windows','normal'),(154,'lowerHalfRound','e','halfRound5',1,'6',29,'DLCP-6-29','available','windows','normal'),(155,'upperHalfRound','i','halfRound6',1,'6',31,'DLCP-6-31','available','windows','normal'),(156,'upperHalfRound','e','halfRound6',1,'6',32,'DLCP-6-32','available','windows','normal'),(157,'upperHalfRound','ne','halfRound6',1,'6',33,'DLCP-6-33','available','windows','normal'),(158,'upperHalfRound','n','halfRound6',1,'6',34,'DLCP-6-34','available','windows','normal'),(159,'upperHalfRound','nw','halfRound6',1,'6',35,'DLCP-6-35','available','windows','normal'),(160,'upperHalfRound','w','halfRound6',1,'6',36,'DLCP-6-36','available','windows','normal'),(161,'leftTriple','ll','triple3',1,'ll',1,'DLCP-IMAC-01','available','mac','normal'),(162,'leftTriple','ul','triple3',1,'ll',2,'DLCP-IMAC-02','available','mac','normal'),(163,'leftTriple','r','triple3',1,'ll',3,'DLCP-IMAC-03','available','mac','normal'),(164,'rightTriple','l','triple4',1,'ll',4,'DLCP-IMAC-04','available','mac','normal'),(165,'rightTriple','ur','triple4',1,'ll',5,'DLCP-IMAC-05','available','mac','normal'),(166,'rightTriple','lr','triple4',1,'ll',6,'DLCP-IMAC-06','available','mac','normal'),(167,'leftTriple','ll','triple1',1,'ll',7,'DLCP-IMAC-07','available','mac','multimedia'),(168,'rightTriple','lr','triple2',1,'ll',8,'DLCP-IMAC-08','available','mac','multimedia'),(169,'rightTriple','l','triple2',1,'ll',9,'DLCP-IMAC-09','available','mac','multimedia'),(170,'leftTriple','r','triple1',1,'ll',10,'DLCP-IMAC-10','available','mac','multimedia'),(171,'rightTriple','ur','triple2',1,'ll',1,'DLCP-MEDIA1','available','windows','multimedia'),(172,'leftTriple','ul','triple1',1,'ll',2,'DLCP-MEDIA2','available','windows','multimedia'),(173,'lowerClassroomTable','l','classroom1',1,'ll',1,'DLCL-01','available','windows','normal'),(174,'lowerClassroomTable','r','classroom1',1,'ll',2,'DLCL-02','available','windows','normal'),(175,'lowerClassroomTable','l','classroom2',1,'ll',3,'DLCL-03','available','windows','normal'),(176,'lowerClassroomTable','r','classroom2',1,'ll',4,'DLCL-04','available','windows','normal'),(177,'lowerClassroomTable','l','classroom3',1,'ll',5,'DLCL-05','available','windows','normal'),(178,'lowerClassroomTable','r','classroom3',1,'ll',6,'DLCL-06','available','windows','normal'),(179,'lowerClassroomTable','l','classroom4',1,'ll',7,'DLCL-07','available','windows','normal'),(180,'lowerClassroomTable','r','classroom4',1,'ll',8,'DLCL-08','available','windows','normal'),(181,'lowerClassroomTable','l','classroom5',1,'ll',9,'DLCL-09','available','windows','normal'),(182,'lowerClassroomTable','r','classroom5',1,'ll',10,'DLCL-10','available','windows','normal'),(183,'lowerClassroomTable','l','classroom6',1,'ll',11,'DLCL-11','available','windows','normal'),(184,'lowerClassroomTable','r','classroom6',1,'ll',12,'DLCL-12','available','windows','normal'),(185,'lowerClassroomTable','l','classroom7',1,'ll',13,'DLCL-13','available','windows','normal'),(186,'lowerClassroomTable','r','classroom7',1,'ll',14,'DLCL-14','available','windows','normal'),(187,'lowerClassroomTable','l','classroom8',1,'ll',15,'DLCL-15','available','windows','normal'),(188,'lowerClassroomTable','r','classroom8',1,'ll',16,'DLCL-16','available','windows','normal'),(189,'lowerClassroomTable','l','classroom9',1,'ll',17,'DLCL-17','available','windows','normal'),(190,'lowerClassroomTable','r','classroom9',1,'ll',18,'DLCL-18','available','windows','normal'),(191,'lowerClassroomTable','l','classroom10',1,'ll',19,'DLCL-19','available','windows','normal'),(192,'lowerClassroomTable','r','classroom10',1,'ll',20,'DLCL-20','available','windows','normal'),(193,'lowerClassroomTable','l','classroom11',1,'ll',21,'DLCL-21','available','windows','normal'),(194,'lowerClassroomTable','r','classroom11',1,'ll',22,'DLCL-22','available','windows','normal'),(195,'lowerClassroomTable','l','classroom12',1,'ll',23,'DLCL-23','available','windows','normal'),(196,'lowerClassroomTable','r','classroom12',1,'ll',24,'DLCL-24','available','windows','normal'),(197,'lowerClassroomTable','l','classroom13',1,'ll',25,'DLCL-25','available','windows','normal'),(198,'lowerClassroomTable','r','classroom13',1,'ll',26,'DLCL-26','available','windows','normal'),(199,'lowerClassroomTable','l','classroom14',1,'ll',27,'DLCL-27','available','windows','normal'),(200,'lowerClassroomTable','r','classroom14',1,'ll',28,'DLCL-28','available','windows','normal'),(201,'lowerClassroomTable','l','classroom15',1,'ll',29,'DLCL-29','available','windows','normal'),(202,'lowerClassroomTable','l','classroom16',1,'ll',30,'DLCL-30','available','windows','normal'),(203,'upperClassroomTable','r','map1',1,'ll',1,'DLCP-G-MAP1','available','windows','normal'),(204,'upperClassroomTable','l','map1',1,'ll',2,'DLCP-G-MAP2','available','windows','normal');
/*!40000 ALTER TABLE `computers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors` (
  `id` int(3) NOT NULL auto_increment,
  `building_id` tinyint(2) NOT NULL,
  `floor_name` varchar(15) NOT NULL,
  `floor` varchar(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
INSERT INTO `floors` VALUES (1,1,'Lower Level','ll'),(2,1,'1st Floor','1'),(3,1,'2nd Floor','2'),(4,1,'4th Floor','4'),(5,1,'6th Floor','6'),(13,12,'1st Floor','1'),(14,13,'2nd Floor','2'),(16,15,'2nd Floor','2'),(17,16,'4th Floor','4');
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `action` varchar(6) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-06-04 13:55:55
