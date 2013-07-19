-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mobmetrics
-- ------------------------------------------------------
-- Server version	5.5.31-0+wheezy1

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
-- Current Database: `mobmetrics`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mobmetrics` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mobmetrics`;

--
-- Table structure for table `mob_bwdown`
--

DROP TABLE IF EXISTS `mob_bwdown`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mob_bwdown` (
  `device` int(11) NOT NULL DEFAULT '0',
  `plan` int(11) NOT NULL DEFAULT '0',
  `datereg` datetime NOT NULL,
  `ipsrc` varchar(16) NOT NULL,
  `portsrc` varchar(10) NOT NULL,
  `ipdst` varchar(16) NOT NULL,
  `portdst` varchar(10) NOT NULL,
  `idconn` varchar(3) NOT NULL,
  `ival` varchar(5) NOT NULL,
  `transfer` varchar(20) NOT NULL,
  `bw` varchar(20) NOT NULL,
  `jitter` varchar(20) NOT NULL,
  `lostdatagrams` varchar(20) NOT NULL,
  `totaldatagrams` varchar(20) NOT NULL,
  `percentlost` varchar(10) NOT NULL,
  `outdatagrams` varchar(10) NOT NULL,
  PRIMARY KEY (`device`,`plan`,`datereg`),
  CONSTRAINT `mob_bwdown_ibfk_1` FOREIGN KEY (`device`, `plan`) REFERENCES `mob_device_plan` (`device`, `plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mob_bwup`
--

DROP TABLE IF EXISTS `mob_bwup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mob_bwup` (
  `device` int(11) NOT NULL DEFAULT '0',
  `plan` int(11) NOT NULL DEFAULT '0',
  `datereg` datetime NOT NULL,
  `ipsrc` varchar(16) NOT NULL,
  `portsrc` varchar(10) NOT NULL,
  `ipdst` varchar(16) NOT NULL,
  `portdst` varchar(10) NOT NULL,
  `idconn` varchar(3) NOT NULL,
  `ival` varchar(5) NOT NULL,
  `transfer` varchar(20) NOT NULL,
  `bw` varchar(20) NOT NULL,
  `jitter` varchar(20) NOT NULL,
  `lostdatagrams` varchar(20) NOT NULL,
  `totaldatagrams` varchar(20) NOT NULL,
  `percentlost` varchar(10) NOT NULL,
  `outdatagrams` varchar(10) NOT NULL,
  PRIMARY KEY (`device`,`plan`,`datereg`),
  CONSTRAINT `mob_bwup_ibfk_1` FOREIGN KEY (`device`, `plan`) REFERENCES `mob_device_plan` (`device`, `plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mob_device`
--

DROP TABLE IF EXISTS `mob_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mob_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(200) NOT NULL DEFAULT '0.0.0.0',
  `mac` varchar(20) NOT NULL DEFAULT '0000.0000.0000.0000',
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mob_device_plan`
--

DROP TABLE IF EXISTS `mob_device_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mob_device_plan` (
  `device` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  PRIMARY KEY (`device`,`plan`),
  KEY `fk_plan` (`plan`),
  CONSTRAINT `fk_device` FOREIGN KEY (`device`) REFERENCES `mob_device` (`id`),
  CONSTRAINT `fk_plan` FOREIGN KEY (`plan`) REFERENCES `mob_plan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mob_plan`
--

DROP TABLE IF EXISTS `mob_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mob_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bwdown` int(11) DEFAULT NULL,
  `bwup` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mob_plan`
--

LOCK TABLES `mob_plan` WRITE;
/*!40000 ALTER TABLE `mob_plan` DISABLE KEYS */;
INSERT INTO `mob_plan` VALUES (1,1024,512),(2,1400,700),(3,1600,800),(4,1800,900),(5,2000,1000),(6,2200,1100),(7,2400,1200),(8,2800,1400),(9,3400,1700),(10,4000,2000);
/*!40000 ALTER TABLE `mob_plan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

