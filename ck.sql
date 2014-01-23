-- MySQL dump 10.14  Distrib 5.5.34-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: coastkeeper
-- ------------------------------------------------------
-- Server version	5.5.34-MariaDB-log

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datasheet_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_datasheet_id_index` (`datasheet_id`),
  CONSTRAINT `categories_datasheet_id_foreign` FOREIGN KEY (`datasheet_id`) REFERENCES `datasheets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2014-01-23 07:49:24','2014-01-23 08:13:56','Beach Uses',1),(2,'2014-01-23 07:51:58','2014-01-23 07:51:58','Ocean Uses',1),(3,'2014-01-23 07:52:03','2014-01-23 07:52:03','General Pollution Issues',1),(8,'2014-01-23 08:45:32','2014-01-23 08:45:32','asdf',2);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datasheets`
--

DROP TABLE IF EXISTS `datasheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datasheets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datasheets`
--

LOCK TABLES `datasheets` WRITE;
/*!40000 ALTER TABLE `datasheets` DISABLE KEYS */;
INSERT INTO `datasheets` VALUES (1,'2014-01-23 07:49:17','2014-01-23 07:53:39','Default Datasheet'),(2,'2014-01-23 08:45:28','2014-01-23 08:45:28','test');
/*!40000 ALTER TABLE `datasheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_category_id_index` (`category_id`),
  CONSTRAINT `fields_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,'2014-01-23 07:49:30','2014-01-23 08:27:25','Resting Leisure',1),(2,'2014-01-23 07:50:17','2014-01-23 07:50:17','Active or Sporting Leisure',1),(3,'2014-01-23 07:50:22','2014-01-23 07:50:22','Walking or Running',1),(6,'2014-01-23 07:52:10','2014-01-23 07:52:10','Surfing or Swimming',2),(7,'2014-01-23 07:52:16','2014-01-23 07:52:16','ACTIVE Shore Fishing',2),(8,'2014-01-23 07:52:21','2014-01-23 07:52:21','Recreational Boating',2),(9,'2014-01-23 07:52:27','2014-01-23 07:52:27','Commercial Boating',2),(10,'2014-01-23 07:52:32','2014-01-23 07:52:32','ACTIVE Commercial Boating',2),(11,'2014-01-23 07:52:37','2014-01-23 07:52:37','ACTIVE Recreational Boat Fishing',2),(12,'2014-01-23 07:52:42','2014-01-23 07:52:42','Diving',2),(13,'2014-01-23 07:52:48','2014-01-23 07:52:48','Kelp Harvesting',2),(14,'2014-01-23 07:53:00','2014-01-23 07:53:00','Runoff',3),(15,'2014-01-23 07:53:05','2014-01-23 07:53:05','Open Dumpster',3),(16,'2014-01-23 07:53:09','2014-01-23 07:53:09','Cigarette Butts',3),(17,'2014-01-23 07:53:13','2014-01-23 07:53:13','Animal Droppings',3),(18,'2014-01-23 07:53:18','2014-01-23 07:53:18','Litter',3),(19,'2014-01-23 08:27:30','2014-01-23 08:27:30','Picnic or Grilling',1),(20,'2014-01-23 08:27:36','2014-01-23 08:27:36','Domestic Animals',1);
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datasheet_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_datasheet_id_index` (`datasheet_id`),
  CONSTRAINT `locations_datasheet_id_foreign` FOREIGN KEY (`datasheet_id`) REFERENCES `datasheets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'2014-01-23 08:36:50','2014-01-23 08:36:50','Matlahuayl SMR',1),(2,'2014-01-23 08:37:20','2014-01-23 08:37:20','South La Jolla SMR',1);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_01_23_071159_create_users_table',1),('2014_01_23_071200_create_categories_table',1),('2014_01_23_071200_create_datasheets_table',1),('2014_01_23_071200_create_fields_table',2),('2014_01_23_071200_create_locations_table',2),('2014_01_23_071200_create_patrols_table',2),('2014_01_23_071200_create_sections_table',2),('2014_01_23_071200_create_segments_table',2),('2014_01_23_071200_create_tallies_table',2),('2014_01_23_071210_create_foreign_keys',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patrols`
--

DROP TABLE IF EXISTS `patrols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patrols` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` date NOT NULL,
  `is_finished` tinyint(1) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patrols_user_id_index` (`user_id`),
  KEY `patrols_location_id_index` (`location_id`),
  CONSTRAINT `patrols_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `patrols_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patrols`
--

LOCK TABLES `patrols` WRITE;
/*!40000 ALTER TABLE `patrols` DISABLE KEYS */;
INSERT INTO `patrols` VALUES (1,'2014-01-23 10:00:46','2014-01-23 10:00:46','2014-01-23',1,1,1),(2,'2014-01-23 10:01:14','2014-01-23 10:01:14','2014-01-23',1,1,1),(3,'2014-01-23 10:05:48','2014-01-23 10:05:48','2014-01-23',1,1,1),(4,'2014-01-23 10:06:05','2014-01-23 10:06:05','2014-01-23',1,1,1),(5,'2014-01-23 10:08:10','2014-01-23 10:08:10','2014-01-23',1,1,1),(6,'2014-01-23 10:08:26','2014-01-23 10:08:26','2014-01-23',1,1,1),(7,'2014-01-23 10:09:34','2014-01-23 10:09:34','2014-01-23',1,1,1),(8,'2014-01-23 10:24:53','2014-01-23 10:24:53','2014-01-23',1,1,1);
/*!40000 ALTER TABLE `patrols` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_location_id_index` (`location_id`),
  CONSTRAINT `sections_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (3,'2014-01-23 08:48:28','2014-01-23 08:48:28','Scripps Pier to Tower 31',1),(4,'2014-01-23 08:48:34','2014-01-23 08:48:34','Tower 31 to Boat Launch',1),(5,'2014-01-23 08:48:40','2014-01-23 08:48:40','Boat Launch to Coastal Access',1),(6,'2014-01-23 08:48:48','2014-01-23 08:48:48','Coast Walk Lookout',1),(7,'2014-01-23 08:48:54','2014-01-23 08:48:54','Point La Jolla / Bridge Club',1),(8,'2014-01-23 10:42:59','2014-01-23 10:42:59','Palomar Street',2),(9,'2014-01-23 10:43:04','2014-01-23 10:43:04','Costa and Chelsea Viewpoint',2),(10,'2014-01-23 10:43:11','2014-01-23 10:43:11','Hermosa Park',2),(11,'2014-01-23 10:43:17','2014-01-23 10:43:17','Forward Street Viewpoint',2),(12,'2014-01-23 10:43:23','2014-01-23 10:43:23','Calumet Park',2),(13,'2014-01-23 10:43:28','2014-01-23 10:43:28','Tourmaline Surf Park',2),(14,'2014-01-23 10:43:33','2014-01-23 10:43:33','Tourmaline to Diamond Street Beach Walk',2);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `segments`
--

DROP TABLE IF EXISTS `segments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `segments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `patrol_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `segments_patrol_id_index` (`patrol_id`),
  KEY `segments_section_id_index` (`section_id`),
  CONSTRAINT `segments_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `segments_patrol_id_foreign` FOREIGN KEY (`patrol_id`) REFERENCES `patrols` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segments`
--

LOCK TABLES `segments` WRITE;
/*!40000 ALTER TABLE `segments` DISABLE KEYS */;
INSERT INTO `segments` VALUES (1,'2014-01-23 10:00:47','2014-01-23 10:00:47','01:56:58','02:00:47',1,6),(2,'2014-01-23 10:01:15','2014-01-23 10:01:15','01:56:58','02:01:15',2,6),(3,'2014-01-23 10:05:48','2014-01-23 10:05:48','02:03:48','02:05:48',3,5),(4,'2014-01-23 10:06:05','2014-01-23 10:06:05','02:03:48','02:06:05',4,3),(5,'2014-01-23 10:08:11','2014-01-23 10:08:11','02:07:58','02:08:11',5,3),(6,'2014-01-23 10:08:26','2014-01-23 10:08:26','02:07:58','02:08:26',6,3),(7,'2014-01-23 10:09:34','2014-01-23 10:09:34','02:09:18','02:09:34',7,6),(8,'2014-01-23 10:09:48','2014-01-23 10:09:48','02:09:18','02:09:48',7,3),(9,'2014-01-23 10:24:53','2014-01-23 10:24:53','02:24:46','02:24:53',8,3);
/*!40000 ALTER TABLE `segments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tallies`
--

DROP TABLE IF EXISTS `tallies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tallies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tally` int(11) NOT NULL,
  `segment_id` int(10) unsigned NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tallies_segment_id_index` (`segment_id`),
  KEY `tallies_field_id_index` (`field_id`),
  CONSTRAINT `tallies_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`),
  CONSTRAINT `tallies_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallies`
--

LOCK TABLES `tallies` WRITE;
/*!40000 ALTER TABLE `tallies` DISABLE KEYS */;
INSERT INTO `tallies` VALUES (1,'2014-01-23 10:01:15','2014-01-23 10:01:15',0,2,1),(2,'2014-01-23 10:01:15','2014-01-23 10:01:15',0,2,2),(3,'2014-01-23 10:01:15','2014-01-23 10:01:15',0,2,3),(4,'2014-01-23 10:01:15','2014-01-23 10:01:15',0,2,19),(5,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,20),(6,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,6),(7,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,7),(8,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,8),(9,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,9),(10,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,10),(11,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,11),(12,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,12),(13,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,13),(14,'2014-01-23 10:01:16','2014-01-23 10:01:16',0,2,14),(15,'2014-01-23 10:01:17','2014-01-23 10:01:17',0,2,15),(16,'2014-01-23 10:01:17','2014-01-23 10:01:17',0,2,16),(17,'2014-01-23 10:01:17','2014-01-23 10:01:17',0,2,17),(18,'2014-01-23 10:01:17','2014-01-23 10:01:17',0,2,18),(19,'2014-01-23 10:05:48','2014-01-23 10:05:48',0,3,1),(20,'2014-01-23 10:05:48','2014-01-23 10:05:48',0,3,2),(21,'2014-01-23 10:05:48','2014-01-23 10:05:48',0,3,3),(22,'2014-01-23 10:05:48','2014-01-23 10:05:48',0,3,19),(23,'2014-01-23 10:05:48','2014-01-23 10:05:48',0,3,20),(24,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,6),(25,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,7),(26,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,8),(27,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,9),(28,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,10),(29,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,11),(30,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,12),(31,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,13),(32,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,14),(33,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,15),(34,'2014-01-23 10:05:49','2014-01-23 10:05:49',0,3,16),(35,'2014-01-23 10:05:50','2014-01-23 10:05:50',0,3,17),(36,'2014-01-23 10:05:50','2014-01-23 10:05:50',0,3,18),(37,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,1),(38,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,2),(39,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,3),(40,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,19),(41,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,20),(42,'2014-01-23 10:06:05','2014-01-23 10:06:05',0,4,6),(43,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,7),(44,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,8),(45,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,9),(46,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,10),(47,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,11),(48,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,12),(49,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,13),(50,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,14),(51,'2014-01-23 10:06:06','2014-01-23 10:06:06',0,4,15),(52,'2014-01-23 10:06:07','2014-01-23 10:06:07',0,4,16),(53,'2014-01-23 10:06:07','2014-01-23 10:06:07',0,4,17),(54,'2014-01-23 10:06:07','2014-01-23 10:06:07',0,4,18),(55,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,1),(56,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,2),(57,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,3),(58,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,19),(59,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,20),(60,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,6),(61,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,7),(62,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,8),(63,'2014-01-23 10:08:11','2014-01-23 10:08:11',0,5,9),(64,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,10),(65,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,11),(66,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,12),(67,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,13),(68,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,14),(69,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,15),(70,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,16),(71,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,17),(72,'2014-01-23 10:08:12','2014-01-23 10:08:12',0,5,18),(73,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,1),(74,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,2),(75,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,3),(76,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,19),(77,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,20),(78,'2014-01-23 10:08:26','2014-01-23 10:08:26',0,6,6),(79,'2014-01-23 10:08:27','2014-01-23 10:08:27',0,6,7),(80,'2014-01-23 10:08:27','2014-01-23 10:08:27',0,6,8),(81,'2014-01-23 10:08:27','2014-01-23 10:08:27',0,6,9),(82,'2014-01-23 10:08:27','2014-01-23 10:08:27',0,6,10),(83,'2014-01-23 10:08:27','2014-01-23 10:08:27',0,6,11),(84,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,12),(85,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,13),(86,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,14),(87,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,15),(88,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,16),(89,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,17),(90,'2014-01-23 10:08:28','2014-01-23 10:08:28',0,6,18),(91,'2014-01-23 10:09:34','2014-01-23 10:09:34',0,7,1),(92,'2014-01-23 10:09:34','2014-01-23 10:09:34',0,7,2),(93,'2014-01-23 10:09:34','2014-01-23 10:09:34',0,7,3),(94,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,19),(95,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,20),(96,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,6),(97,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,7),(98,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,8),(99,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,9),(100,'2014-01-23 10:09:35','2014-01-23 10:09:35',0,7,10),(101,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,11),(102,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,12),(103,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,13),(104,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,14),(105,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,15),(106,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,16),(107,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,17),(108,'2014-01-23 10:09:36','2014-01-23 10:09:36',0,7,18),(109,'2014-01-23 10:09:48','2014-01-23 10:09:48',0,8,1),(110,'2014-01-23 10:09:48','2014-01-23 10:09:48',0,8,2),(111,'2014-01-23 10:09:48','2014-01-23 10:09:48',0,8,3),(112,'2014-01-23 10:09:48','2014-01-23 10:09:48',0,8,19),(113,'2014-01-23 10:09:48','2014-01-23 10:09:48',0,8,20),(114,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,6),(115,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,7),(116,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,8),(117,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,9),(118,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,10),(119,'2014-01-23 10:09:49','2014-01-23 10:09:49',0,8,11),(120,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,12),(121,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,13),(122,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,14),(123,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,15),(124,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,16),(125,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,17),(126,'2014-01-23 10:09:50','2014-01-23 10:09:50',0,8,18),(127,'2014-01-23 10:24:53','2014-01-23 10:24:53',0,9,1),(128,'2014-01-23 10:24:53','2014-01-23 10:24:53',0,9,2),(129,'2014-01-23 10:24:53','2014-01-23 10:24:53',0,9,3),(130,'2014-01-23 10:24:53','2014-01-23 10:24:53',0,9,19),(131,'2014-01-23 10:24:53','2014-01-23 10:24:53',0,9,20),(132,'2014-01-23 10:24:53','2014-01-23 10:24:53',5,9,6),(133,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,7),(134,'2014-01-23 10:24:54','2014-01-23 10:24:54',5,9,8),(135,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,9),(136,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,10),(137,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,11),(138,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,12),(139,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,13),(140,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,14),(141,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,15),(142,'2014-01-23 10:24:54','2014-01-23 10:24:54',0,9,16),(143,'2014-01-23 10:24:55','2014-01-23 10:24:55',0,9,17),(144,'2014-01-23 10:24:55','2014-01-23 10:24:55',0,9,18);
/*!40000 ALTER TABLE `tallies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2014-01-23 07:49:04','2014-01-23 09:25:05','Iam','Admin','ck','admin@ck.com','$2y$10$zKhodIPfVDYxX9kG8Nt1L.wKmOjpxSz.k322bQvl7p0s3GKGKPSsC',1),(7,'2014-01-23 09:32:48','2014-01-23 09:32:48','Jane','Doe','user','jane@gmail.com','$2y$10$vkbDET8y7OY6nvyWFxk4MOIsabBAb46zJE6ld.cHwonjB3iaObqdu',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-23  2:47:18
