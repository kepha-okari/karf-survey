-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: questionnaires
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

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
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (2,'admin','1234');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `state` varchar(256) NOT NULL,
  `choice` varchar(256) NOT NULL,
  `label` varchar(256) NOT NULL,
  `pointer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,1,'transitional','Listened to the radio','A',2,'2020-06-15 08:49:15'),(2,1,'transitional','Watched the TV','B',3,'2020-06-15 08:50:13'),(3,1,'transitional','Read a Newspaper','C',4,'2020-06-15 08:50:35'),(4,1,'transitional','visited an online site','D',5,'2020-06-15 08:51:04'),(5,3,'end','Kiss FM','A',2,'2020-06-15 08:53:30'),(6,3,'end','Hot96 FM','B',2,'2020-06-15 08:53:58'),(7,3,'end','Capital FM','C',2,'2020-06-15 08:54:13'),(8,3,'end','Homeboys Radio','D',2,'2020-06-15 08:54:32'),(9,3,'end','Ghetto Radio','E',2,'2020-06-15 08:54:50'),(10,3,'end','Classic 105 FM','F',2,'2020-06-15 08:55:10'),(11,4,'transitional','The Standard','A',2,'2020-06-15 08:56:07'),(12,4,'transitional','Daily Nation','B',2,'2020-06-15 08:56:20'),(13,4,'transitional','People Daily','C',2,'2020-06-15 08:56:42'),(14,4,'transitional','Taifa Leo','D',2,'2020-06-15 08:56:54'),(15,5,'end','Politics','A',4,'2020-06-15 09:00:31'),(16,5,'end','Business/Economics','B',4,'2020-06-15 09:00:50'),(17,5,'end','Sports','C',4,'2020-06-15 09:01:00'),(18,5,'end','Columns','D',4,'2020-06-15 09:01:14'),(19,5,'end','Opinions','E',4,'2020-06-15 09:01:32'),(20,5,'end','Obituaries','F',4,'2020-06-15 09:02:05'),(21,6,'transitional','WhatsApp','A',6,'2020-06-15 09:03:49'),(22,6,'transitional','Facebook','B',6,'2020-06-15 09:04:03'),(23,6,'transitional','Twitter','C',6,'2020-06-15 09:04:25'),(24,6,'transitional','Instagram','D',6,'2020-06-15 09:04:43'),(25,6,'transitional','TikTok','E',6,'2020-06-15 09:04:56');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `state` varchar(256) NOT NULL,
  `question_type` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `pointer` int(11) NOT NULL DEFAULT '1',
  `question_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'start','closed','which of these activities did you do today?',2,1,'2020-06-13 11:03:49'),(3,1,'transitional','closed','Which Radio station did you listed to?',3,2,'2020-06-15 07:09:37'),(4,1,'transitional','closed','Which Newspaper did you read?',4,3,'2020-06-15 07:11:19'),(5,1,'transitional','closed','Which section of the paper did you read?',4,4,'2020-06-15 07:13:24'),(6,1,'transitional','closed','Which online site did you visit?',6,5,'2020-06-15 07:14:34'),(7,1,'end','open','How long did you spend on the site?',6,6,'2020-06-15 07:20:55');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `question` varchar(256) NOT NULL,
  `response` varchar(256) NOT NULL,
  `respondent` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`),
  CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
INSERT INTO `responses` VALUES (1,1,'what is your favourite radio station','Kiss fm','254707630747','2020-06-13 15:56:05'),(2,1,'what is your favourite radio station?','Capital','254719318686','2020-06-14 14:45:05'),(3,1,'what is your favourite radio station?','hot96','254719318686','2020-06-14 14:45:35');
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_name` varchar(256) NOT NULL,
  `company_name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Radio Audience','Royal Media','2020-06-12 09:37:11'),(2,'Newspaper columns','Standard Media','2020-06-12 10:50:32'),(4,'social media usage','tiktok','2020-06-12 15:06:04'),(5,'social media usage','tiktok','2020-06-12 15:06:33');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-15 12:27:45
