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
-- Table structure for table `assigned_roles`
--

DROP TABLE IF EXISTS `assigned_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_roles`
--

LOCK TABLES `assigned_roles` WRITE;
/*!40000 ALTER TABLE `assigned_roles` DISABLE KEYS */;
INSERT INTO `assigned_roles` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `assigned_roles` ENABLE KEYS */;
UNLOCK TABLES;

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
  CONSTRAINT `categories_datasheet_id_foreign` FOREIGN KEY (`datasheet_id`) REFERENCES `datasheets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2014-01-29 11:09:57','2014-01-29 11:09:57','General',1),(2,'2014-01-29 11:09:57','2014-01-29 11:09:57','On-Shore Activities',1),(3,'2014-01-29 11:09:57','2014-01-29 11:09:57','Off-Shore Activities',1),(4,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boating',1),(5,'2014-01-29 11:09:57','2014-01-29 11:09:57','Other',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datasheets`
--

LOCK TABLES `datasheets` WRITE;
/*!40000 ALTER TABLE `datasheets` DISABLE KEYS */;
INSERT INTO `datasheets` VALUES (1,'2014-01-29 11:09:57','2014-01-29 11:09:57','Default');
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
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_category_id_index` (`category_id`),
  CONSTRAINT `fields_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,'2014-01-29 11:09:57','2014-01-29 11:09:57','Clouds',1,'radio'),(2,'2014-01-29 11:09:57','2014-01-29 11:09:57','Precipitation',1,'radio'),(3,'2014-01-29 11:09:57','2014-01-29 11:09:57','Air Temperature',1,'radio'),(4,'2014-01-29 11:09:57','2014-01-29 11:09:57','Wind',1,'radio'),(5,'2014-01-29 11:09:57','2014-01-29 11:09:57','Tide Level',1,'radio'),(6,'2014-01-29 11:09:57','2014-01-29 11:09:57','Visibility',1,'radio'),(7,'2014-01-29 11:09:57','2014-01-29 11:09:57','Beach Status',1,'radio'),(8,'2014-01-29 11:09:57','2014-01-29 11:09:57','Recreation',2,'number'),(9,'2014-01-29 11:09:57','2014-01-29 11:09:57','Wildlife Watching',2,'number'),(10,'2014-01-29 11:09:57','2014-01-29 11:09:57','Domestic animals on-leash',2,'number'),(11,'2014-01-29 11:09:57','2014-01-29 11:09:57','Domestic animals off-leash',2,'number'),(12,'2014-01-29 11:09:57','2014-01-29 11:09:57','Driving on the Beach',2,'number'),(13,'2014-01-29 11:09:57','2014-01-29 11:09:57','Tide-pooling (not collecting)',2,'number'),(14,'2014-01-29 11:09:57','2014-01-29 11:09:57','Hand collection of biota',2,'number'),(15,'2014-01-29 11:09:57','2014-01-29 11:09:57','Shore-based hook and line fishing',2,'number'),(16,'2014-01-29 11:09:57','2014-01-29 11:09:57','Shore-based trap fishing',2,'number'),(17,'2014-01-29 11:09:57','2014-01-29 11:09:57','Shore-based net fishing',2,'number'),(18,'2014-01-29 11:09:57','2014-01-29 11:09:57','Shore-based spear fishing',2,'number'),(19,'2014-01-29 11:09:57','2014-01-29 11:09:57','Board Sports',3,'number'),(20,'2014-01-29 11:09:57','2014-01-29 11:09:57','Offshore Recreation',3,'number'),(21,'2014-01-29 11:09:57','2014-01-29 11:09:57','Non-Consumptive SCUBA and snorkeling',3,'number'),(22,'2014-01-29 11:09:57','2014-01-29 11:09:57','Spear Fishing',3,'number'),(23,'2014-01-29 11:09:57','2014-01-29 11:09:57','Other Consumptive Diving ',3,'number'),(24,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Fishing - Traps',4,'number'),(25,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Fishing - Line',4,'number'),(26,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Fishing - Nets',4,'number'),(27,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Fishing - Dive',4,'number'),(28,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Fishing - Spear',4,'number'),(29,'2014-01-29 11:09:57','2014-01-29 11:09:57','Boat Kelp Harvesting',4,'number'),(30,'2014-01-29 11:09:57','2014-01-29 11:09:57','Unknown Fishing Boat',4,'number'),(31,'2014-01-29 11:09:57','2014-01-29 11:09:57','Paddle Operated Boa',4,'number'),(32,'2014-01-29 11:09:57','2014-01-29 11:09:57','Dive Boat (stationary – flag up)',4,'number'),(33,'2014-01-29 11:09:57','2014-01-29 11:09:57','Whale Watching Boat',4,'number'),(34,'2014-01-29 11:09:57','2014-01-29 11:09:57','Work Boat (e.g., life-guard, DFW)',4,'number'),(35,'2014-01-29 11:09:57','2014-01-29 11:09:57','Commercial Passenger Fishing Vessel (5+ people)',4,'number'),(36,'2014-01-29 11:09:57','2014-01-29 11:09:57','Other Boating',4,'number'),(37,'2014-01-29 11:09:57','2014-01-29 11:09:57','Scientific Research',5,'checkbox'),(38,'2014-01-29 11:09:57','2014-01-29 11:09:57','Education',5,'checkbox'),(39,'2014-01-29 11:09:57','2014-01-29 11:09:57','Beach Closure',5,'checkbox'),(40,'2014-01-29 11:09:57','2014-01-29 11:09:57','Large Gatherings (e.g., volleyball tournament)',5,'checkbox'),(41,'2014-01-29 11:09:57','2014-01-29 11:09:57','Enforcement Activity',5,'checkbox');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'2014-01-29 11:09:56','2014-01-29 11:09:56','Matlahuayl SMR',1),(2,'2014-01-29 11:09:56','2014-01-29 11:09:56','South La Jolla SMR',1);
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
INSERT INTO `migrations` VALUES ('2014_01_23_071000_create_tallies_table',1),('2014_01_23_071001_create_segments_table',1),('2014_01_23_071002_create_sections_table',1),('2014_01_23_071003_create_patrols_table',1),('2014_01_23_071004_create_locations_table',1),('2014_01_23_071005_create_fields_table',1),('2014_01_23_071006_create_categories_table',1),('2014_01_23_071007_create_datasheets_table',1),('2014_01_23_071159_create_users_table',1),('2014_01_23_071210_create_foreign_keys',1),('2014_01_24_195440_add_confide_user',1),('2014_01_24_220656_entrust_setup_tables',1),('2014_01_28_210500_add_fields',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `options_field_id_foreign` (`field_id`),
  CONSTRAINT `options_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'Clear',1,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(2,'Partly Cloudy (1-50%)',1,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(3,'Cloudy (>50%cover)',1,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(4,'Yes',2,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(5,'No',2,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(6,'Cold',3,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(7,'Cool',3,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(8,'Mild',3,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(9,'Warm',3,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(10,'Hot',3,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(11,'Calm',4,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(12,'Breezy',4,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(13,'Windy',4,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(14,'Low',5,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(15,'Medium',5,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(16,'High',5,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(17,'Perfect',6,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(18,'Limited',6,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(19,'Shore Only',6,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(20,'Open',7,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(21,'Posted',7,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(22,'Closed',7,'2014-01-29 11:09:57','2014-01-29 11:09:57'),(23,'Unknown',7,'2014-01-29 11:09:57','2014-01-29 11:09:57');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patrols`
--

LOCK TABLES `patrols` WRITE;
/*!40000 ALTER TABLE `patrols` DISABLE KEYS */;
INSERT INTO `patrols` VALUES (1,'2014-01-29 11:09:59','2014-01-29 11:09:59','2014-03-01',1,2,2),(2,'2014-01-29 11:10:17','2014-01-29 11:10:17','2014-04-01',1,1,2),(3,'2014-01-29 11:10:37','2014-01-29 11:10:37','2014-05-02',1,2,1),(4,'2014-01-29 11:10:57','2014-01-29 11:10:57','2014-06-02',1,2,1),(5,'2014-01-29 11:11:19','2014-01-29 11:11:19','2014-07-02',1,2,2);
/*!40000 ALTER TABLE `patrols` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1),(2,2,1),(3,1,2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'can_patrol','Can patrol','2014-01-29 11:09:54','2014-01-29 11:09:54'),(2,'can_manage','Can manage','2014-01-29 11:09:54','2014-01-29 11:09:54');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2014-01-29 11:09:54','2014-01-29 11:09:54'),(2,'Volunteer','2014-01-29 11:09:54','2014-01-29 11:09:54');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
  CONSTRAINT `sections_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'2014-01-29 11:09:56','2014-01-29 11:09:56','Scripps Pier to Tower 31',1),(2,'2014-01-29 11:09:56','2014-01-29 11:09:56','Tower 31 to Boat Launch',1),(3,'2014-01-29 11:09:56','2014-01-29 11:09:56','Boat Launch to Coastal Access',1),(4,'2014-01-29 11:09:56','2014-01-29 11:09:56','Coast Walk Lookout',1),(5,'2014-01-29 11:09:56','2014-01-29 11:09:56','Point La Jolla / Bridge Club',1),(6,'2014-01-29 11:09:56','2014-01-29 11:09:56','Palomar Street',2),(7,'2014-01-29 11:09:56','2014-01-29 11:09:56','Costa and Chelsea Viewpoint',2),(8,'2014-01-29 11:09:56','2014-01-29 11:09:56','Hermosa Park',2),(9,'2014-01-29 11:09:56','2014-01-29 11:09:56','Forward Street Viewpoint',2),(10,'2014-01-29 11:09:56','2014-01-29 11:09:56','Calumet Park',2),(11,'2014-01-29 11:09:56','2014-01-29 11:09:56','Tourmaline Surf Park',2),(12,'2014-01-29 11:09:56','2014-01-29 11:09:56','Tourmaline to Diamond Street Beach Walk',2);
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
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `segments_patrol_id_index` (`patrol_id`),
  KEY `segments_section_id_index` (`section_id`),
  CONSTRAINT `segments_patrol_id_foreign` FOREIGN KEY (`patrol_id`) REFERENCES `patrols` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `segments_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segments`
--

LOCK TABLES `segments` WRITE;
/*!40000 ALTER TABLE `segments` DISABLE KEYS */;
INSERT INTO `segments` VALUES (1,'2014-01-29 11:09:59','2014-01-29 11:09:59','07:09:58','07:09:58',1,6,''),(2,'2014-01-29 11:10:03','2014-01-29 11:10:03','08:09:58','08:09:58',1,6,''),(3,'2014-01-29 11:10:07','2014-01-29 11:10:07','10:09:58','10:09:58',1,9,''),(4,'2014-01-29 11:10:13','2014-01-29 11:10:13','11:09:58','11:09:58',1,9,''),(5,'2014-01-29 11:10:17','2014-01-29 11:10:17','15:09:58','15:09:58',2,10,''),(6,'2014-01-29 11:10:21','2014-01-29 11:10:21','18:09:58','18:09:58',2,10,''),(7,'2014-01-29 11:10:28','2014-01-29 11:10:28','21:09:58','21:09:58',2,12,''),(8,'2014-01-29 11:10:32','2014-01-29 11:10:32','01:09:58','01:09:58',2,10,''),(9,'2014-01-29 11:10:37','2014-01-29 11:10:37','04:09:58','04:09:58',3,5,''),(10,'2014-01-29 11:10:42','2014-01-29 11:10:42','05:09:58','05:09:58',3,4,''),(11,'2014-01-29 11:10:47','2014-01-29 11:10:47','08:09:58','08:09:58',3,4,''),(12,'2014-01-29 11:10:52','2014-01-29 11:10:52','10:09:58','10:09:58',3,4,''),(13,'2014-01-29 11:10:57','2014-01-29 11:10:57','13:09:58','13:09:58',4,4,''),(14,'2014-01-29 11:11:04','2014-01-29 11:11:04','17:09:58','17:09:58',4,3,''),(15,'2014-01-29 11:11:08','2014-01-29 11:11:08','19:09:58','19:09:58',4,1,''),(16,'2014-01-29 11:11:15','2014-01-29 11:11:15','20:09:58','20:09:58',4,4,''),(17,'2014-01-29 11:11:19','2014-01-29 11:11:19','00:09:58','00:09:58',5,7,''),(18,'2014-01-29 11:11:23','2014-01-29 11:11:23','04:09:58','04:09:58',5,7,''),(19,'2014-01-29 11:11:30','2014-01-29 11:11:30','05:09:58','05:09:58',5,6,''),(20,'2014-01-29 11:11:34','2014-01-29 11:11:34','07:09:58','07:09:58',5,11,'');
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
  CONSTRAINT `tallies_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tallies_segment_id_foreign` FOREIGN KEY (`segment_id`) REFERENCES `segments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=821 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallies`
--

LOCK TABLES `tallies` WRITE;
/*!40000 ALTER TABLE `tallies` DISABLE KEYS */;
INSERT INTO `tallies` VALUES (1,'2014-01-29 11:09:59','2014-01-29 11:09:59',3,1,1),(2,'2014-01-29 11:09:59','2014-01-29 11:09:59',7,1,2),(3,'2014-01-29 11:09:59','2014-01-29 11:09:59',15,1,3),(4,'2014-01-29 11:09:59','2014-01-29 11:09:59',14,1,4),(5,'2014-01-29 11:09:59','2014-01-29 11:09:59',9,1,5),(6,'2014-01-29 11:09:59','2014-01-29 11:09:59',15,1,6),(7,'2014-01-29 11:09:59','2014-01-29 11:09:59',14,1,7),(8,'2014-01-29 11:09:59','2014-01-29 11:09:59',10,1,8),(9,'2014-01-29 11:10:00','2014-01-29 11:10:00',14,1,9),(10,'2014-01-29 11:10:00','2014-01-29 11:10:00',8,1,10),(11,'2014-01-29 11:10:00','2014-01-29 11:10:00',19,1,11),(12,'2014-01-29 11:10:00','2014-01-29 11:10:00',9,1,12),(13,'2014-01-29 11:10:00','2014-01-29 11:10:00',13,1,13),(14,'2014-01-29 11:10:00','2014-01-29 11:10:00',12,1,14),(15,'2014-01-29 11:10:00','2014-01-29 11:10:00',15,1,15),(16,'2014-01-29 11:10:00','2014-01-29 11:10:00',1,1,16),(17,'2014-01-29 11:10:00','2014-01-29 11:10:00',10,1,17),(18,'2014-01-29 11:10:00','2014-01-29 11:10:00',5,1,18),(19,'2014-01-29 11:10:01','2014-01-29 11:10:01',15,1,19),(20,'2014-01-29 11:10:01','2014-01-29 11:10:01',3,1,20),(21,'2014-01-29 11:10:01','2014-01-29 11:10:01',3,1,21),(22,'2014-01-29 11:10:01','2014-01-29 11:10:01',19,1,22),(23,'2014-01-29 11:10:01','2014-01-29 11:10:01',5,1,23),(24,'2014-01-29 11:10:01','2014-01-29 11:10:01',20,1,24),(25,'2014-01-29 11:10:01','2014-01-29 11:10:01',3,1,25),(26,'2014-01-29 11:10:01','2014-01-29 11:10:01',7,1,26),(27,'2014-01-29 11:10:01','2014-01-29 11:10:01',16,1,27),(28,'2014-01-29 11:10:01','2014-01-29 11:10:01',16,1,28),(29,'2014-01-29 11:10:01','2014-01-29 11:10:01',1,1,29),(30,'2014-01-29 11:10:01','2014-01-29 11:10:01',18,1,30),(31,'2014-01-29 11:10:02','2014-01-29 11:10:02',13,1,31),(32,'2014-01-29 11:10:02','2014-01-29 11:10:02',3,1,32),(33,'2014-01-29 11:10:02','2014-01-29 11:10:02',5,1,33),(34,'2014-01-29 11:10:02','2014-01-29 11:10:02',7,1,34),(35,'2014-01-29 11:10:02','2014-01-29 11:10:02',17,1,35),(36,'2014-01-29 11:10:02','2014-01-29 11:10:02',14,1,36),(37,'2014-01-29 11:10:02','2014-01-29 11:10:02',2,1,37),(38,'2014-01-29 11:10:03','2014-01-29 11:10:03',10,1,38),(39,'2014-01-29 11:10:03','2014-01-29 11:10:03',3,1,39),(40,'2014-01-29 11:10:03','2014-01-29 11:10:03',15,1,40),(41,'2014-01-29 11:10:03','2014-01-29 11:10:03',17,1,41),(42,'2014-01-29 11:10:03','2014-01-29 11:10:03',9,2,1),(43,'2014-01-29 11:10:03','2014-01-29 11:10:03',13,2,2),(44,'2014-01-29 11:10:03','2014-01-29 11:10:03',18,2,3),(45,'2014-01-29 11:10:03','2014-01-29 11:10:03',10,2,4),(46,'2014-01-29 11:10:03','2014-01-29 11:10:03',3,2,5),(47,'2014-01-29 11:10:04','2014-01-29 11:10:04',3,2,6),(48,'2014-01-29 11:10:04','2014-01-29 11:10:04',4,2,7),(49,'2014-01-29 11:10:04','2014-01-29 11:10:04',6,2,8),(50,'2014-01-29 11:10:04','2014-01-29 11:10:04',6,2,9),(51,'2014-01-29 11:10:04','2014-01-29 11:10:04',3,2,10),(52,'2014-01-29 11:10:04','2014-01-29 11:10:04',10,2,11),(53,'2014-01-29 11:10:04','2014-01-29 11:10:04',6,2,12),(54,'2014-01-29 11:10:04','2014-01-29 11:10:04',6,2,13),(55,'2014-01-29 11:10:04','2014-01-29 11:10:04',16,2,14),(56,'2014-01-29 11:10:04','2014-01-29 11:10:04',1,2,15),(57,'2014-01-29 11:10:05','2014-01-29 11:10:05',1,2,16),(58,'2014-01-29 11:10:05','2014-01-29 11:10:05',17,2,17),(59,'2014-01-29 11:10:05','2014-01-29 11:10:05',18,2,18),(60,'2014-01-29 11:10:05','2014-01-29 11:10:05',13,2,19),(61,'2014-01-29 11:10:05','2014-01-29 11:10:05',20,2,20),(62,'2014-01-29 11:10:05','2014-01-29 11:10:05',3,2,21),(63,'2014-01-29 11:10:05','2014-01-29 11:10:05',20,2,22),(64,'2014-01-29 11:10:05','2014-01-29 11:10:05',16,2,23),(65,'2014-01-29 11:10:05','2014-01-29 11:10:05',17,2,24),(66,'2014-01-29 11:10:05','2014-01-29 11:10:05',1,2,25),(67,'2014-01-29 11:10:05','2014-01-29 11:10:05',5,2,26),(68,'2014-01-29 11:10:06','2014-01-29 11:10:06',20,2,27),(69,'2014-01-29 11:10:06','2014-01-29 11:10:06',16,2,28),(70,'2014-01-29 11:10:06','2014-01-29 11:10:06',1,2,29),(71,'2014-01-29 11:10:06','2014-01-29 11:10:06',1,2,30),(72,'2014-01-29 11:10:06','2014-01-29 11:10:06',19,2,31),(73,'2014-01-29 11:10:06','2014-01-29 11:10:06',10,2,32),(74,'2014-01-29 11:10:06','2014-01-29 11:10:06',14,2,33),(75,'2014-01-29 11:10:06','2014-01-29 11:10:06',17,2,34),(76,'2014-01-29 11:10:06','2014-01-29 11:10:06',19,2,35),(77,'2014-01-29 11:10:06','2014-01-29 11:10:06',16,2,36),(78,'2014-01-29 11:10:07','2014-01-29 11:10:07',20,2,37),(79,'2014-01-29 11:10:07','2014-01-29 11:10:07',3,2,38),(80,'2014-01-29 11:10:07','2014-01-29 11:10:07',1,2,39),(81,'2014-01-29 11:10:07','2014-01-29 11:10:07',5,2,40),(82,'2014-01-29 11:10:07','2014-01-29 11:10:07',5,2,41),(83,'2014-01-29 11:10:07','2014-01-29 11:10:07',11,3,1),(84,'2014-01-29 11:10:07','2014-01-29 11:10:07',6,3,2),(85,'2014-01-29 11:10:07','2014-01-29 11:10:07',10,3,3),(86,'2014-01-29 11:10:07','2014-01-29 11:10:07',11,3,4),(87,'2014-01-29 11:10:08','2014-01-29 11:10:08',3,3,5),(88,'2014-01-29 11:10:08','2014-01-29 11:10:08',8,3,6),(89,'2014-01-29 11:10:08','2014-01-29 11:10:08',4,3,7),(90,'2014-01-29 11:10:08','2014-01-29 11:10:08',2,3,8),(91,'2014-01-29 11:10:08','2014-01-29 11:10:08',11,3,9),(92,'2014-01-29 11:10:08','2014-01-29 11:10:08',3,3,10),(93,'2014-01-29 11:10:08','2014-01-29 11:10:08',17,3,11),(94,'2014-01-29 11:10:08','2014-01-29 11:10:08',7,3,12),(95,'2014-01-29 11:10:08','2014-01-29 11:10:08',4,3,13),(96,'2014-01-29 11:10:08','2014-01-29 11:10:08',1,3,14),(97,'2014-01-29 11:10:09','2014-01-29 11:10:09',6,3,15),(98,'2014-01-29 11:10:09','2014-01-29 11:10:09',19,3,16),(99,'2014-01-29 11:10:09','2014-01-29 11:10:09',2,3,17),(100,'2014-01-29 11:10:09','2014-01-29 11:10:09',6,3,18),(101,'2014-01-29 11:10:09','2014-01-29 11:10:09',18,3,19),(102,'2014-01-29 11:10:09','2014-01-29 11:10:09',12,3,20),(103,'2014-01-29 11:10:09','2014-01-29 11:10:09',19,3,21),(104,'2014-01-29 11:10:10','2014-01-29 11:10:10',14,3,22),(105,'2014-01-29 11:10:10','2014-01-29 11:10:10',10,3,23),(106,'2014-01-29 11:10:10','2014-01-29 11:10:10',15,3,24),(107,'2014-01-29 11:10:10','2014-01-29 11:10:10',14,3,25),(108,'2014-01-29 11:10:10','2014-01-29 11:10:10',13,3,26),(109,'2014-01-29 11:10:11','2014-01-29 11:10:11',15,3,27),(110,'2014-01-29 11:10:11','2014-01-29 11:10:11',18,3,28),(111,'2014-01-29 11:10:11','2014-01-29 11:10:11',18,3,29),(112,'2014-01-29 11:10:11','2014-01-29 11:10:11',5,3,30),(113,'2014-01-29 11:10:11','2014-01-29 11:10:11',8,3,31),(114,'2014-01-29 11:10:11','2014-01-29 11:10:11',8,3,32),(115,'2014-01-29 11:10:11','2014-01-29 11:10:11',11,3,33),(116,'2014-01-29 11:10:12','2014-01-29 11:10:12',17,3,34),(117,'2014-01-29 11:10:12','2014-01-29 11:10:12',18,3,35),(118,'2014-01-29 11:10:12','2014-01-29 11:10:12',13,3,36),(119,'2014-01-29 11:10:12','2014-01-29 11:10:12',5,3,37),(120,'2014-01-29 11:10:12','2014-01-29 11:10:12',2,3,38),(121,'2014-01-29 11:10:12','2014-01-29 11:10:12',14,3,39),(122,'2014-01-29 11:10:12','2014-01-29 11:10:12',15,3,40),(123,'2014-01-29 11:10:13','2014-01-29 11:10:13',4,3,41),(124,'2014-01-29 11:10:13','2014-01-29 11:10:13',7,4,1),(125,'2014-01-29 11:10:13','2014-01-29 11:10:13',12,4,2),(126,'2014-01-29 11:10:13','2014-01-29 11:10:13',6,4,3),(127,'2014-01-29 11:10:13','2014-01-29 11:10:13',6,4,4),(128,'2014-01-29 11:10:13','2014-01-29 11:10:13',13,4,5),(129,'2014-01-29 11:10:13','2014-01-29 11:10:13',12,4,6),(130,'2014-01-29 11:10:13','2014-01-29 11:10:13',3,4,7),(131,'2014-01-29 11:10:13','2014-01-29 11:10:13',4,4,8),(132,'2014-01-29 11:10:14','2014-01-29 11:10:14',11,4,9),(133,'2014-01-29 11:10:14','2014-01-29 11:10:14',17,4,10),(134,'2014-01-29 11:10:14','2014-01-29 11:10:14',14,4,11),(135,'2014-01-29 11:10:14','2014-01-29 11:10:14',5,4,12),(136,'2014-01-29 11:10:14','2014-01-29 11:10:14',10,4,13),(137,'2014-01-29 11:10:14','2014-01-29 11:10:14',6,4,14),(138,'2014-01-29 11:10:14','2014-01-29 11:10:14',20,4,15),(139,'2014-01-29 11:10:14','2014-01-29 11:10:14',8,4,16),(140,'2014-01-29 11:10:14','2014-01-29 11:10:14',4,4,17),(141,'2014-01-29 11:10:14','2014-01-29 11:10:14',5,4,18),(142,'2014-01-29 11:10:14','2014-01-29 11:10:14',15,4,19),(143,'2014-01-29 11:10:15','2014-01-29 11:10:15',11,4,20),(144,'2014-01-29 11:10:15','2014-01-29 11:10:15',15,4,21),(145,'2014-01-29 11:10:15','2014-01-29 11:10:15',11,4,22),(146,'2014-01-29 11:10:15','2014-01-29 11:10:15',9,4,23),(147,'2014-01-29 11:10:15','2014-01-29 11:10:15',8,4,24),(148,'2014-01-29 11:10:15','2014-01-29 11:10:15',16,4,25),(149,'2014-01-29 11:10:15','2014-01-29 11:10:15',10,4,26),(150,'2014-01-29 11:10:15','2014-01-29 11:10:15',2,4,27),(151,'2014-01-29 11:10:15','2014-01-29 11:10:15',10,4,28),(152,'2014-01-29 11:10:15','2014-01-29 11:10:15',13,4,29),(153,'2014-01-29 11:10:16','2014-01-29 11:10:16',12,4,30),(154,'2014-01-29 11:10:16','2014-01-29 11:10:16',11,4,31),(155,'2014-01-29 11:10:16','2014-01-29 11:10:16',20,4,32),(156,'2014-01-29 11:10:16','2014-01-29 11:10:16',3,4,33),(157,'2014-01-29 11:10:16','2014-01-29 11:10:16',17,4,34),(158,'2014-01-29 11:10:16','2014-01-29 11:10:16',5,4,35),(159,'2014-01-29 11:10:16','2014-01-29 11:10:16',16,4,36),(160,'2014-01-29 11:10:16','2014-01-29 11:10:16',8,4,37),(161,'2014-01-29 11:10:16','2014-01-29 11:10:16',8,4,38),(162,'2014-01-29 11:10:17','2014-01-29 11:10:17',19,4,39),(163,'2014-01-29 11:10:17','2014-01-29 11:10:17',18,4,40),(164,'2014-01-29 11:10:17','2014-01-29 11:10:17',4,4,41),(165,'2014-01-29 11:10:17','2014-01-29 11:10:17',2,5,1),(166,'2014-01-29 11:10:17','2014-01-29 11:10:17',1,5,2),(167,'2014-01-29 11:10:17','2014-01-29 11:10:17',2,5,3),(168,'2014-01-29 11:10:17','2014-01-29 11:10:17',6,5,4),(169,'2014-01-29 11:10:17','2014-01-29 11:10:17',15,5,5),(170,'2014-01-29 11:10:18','2014-01-29 11:10:18',12,5,6),(171,'2014-01-29 11:10:18','2014-01-29 11:10:18',1,5,7),(172,'2014-01-29 11:10:18','2014-01-29 11:10:18',6,5,8),(173,'2014-01-29 11:10:18','2014-01-29 11:10:18',1,5,9),(174,'2014-01-29 11:10:18','2014-01-29 11:10:18',8,5,10),(175,'2014-01-29 11:10:18','2014-01-29 11:10:18',1,5,11),(176,'2014-01-29 11:10:18','2014-01-29 11:10:18',10,5,12),(177,'2014-01-29 11:10:18','2014-01-29 11:10:18',9,5,13),(178,'2014-01-29 11:10:18','2014-01-29 11:10:18',11,5,14),(179,'2014-01-29 11:10:18','2014-01-29 11:10:18',3,5,15),(180,'2014-01-29 11:10:18','2014-01-29 11:10:18',1,5,16),(181,'2014-01-29 11:10:19','2014-01-29 11:10:19',1,5,17),(182,'2014-01-29 11:10:19','2014-01-29 11:10:19',3,5,18),(183,'2014-01-29 11:10:19','2014-01-29 11:10:19',3,5,19),(184,'2014-01-29 11:10:19','2014-01-29 11:10:19',17,5,20),(185,'2014-01-29 11:10:19','2014-01-29 11:10:19',7,5,21),(186,'2014-01-29 11:10:19','2014-01-29 11:10:19',19,5,22),(187,'2014-01-29 11:10:19','2014-01-29 11:10:19',5,5,23),(188,'2014-01-29 11:10:19','2014-01-29 11:10:19',15,5,24),(189,'2014-01-29 11:10:20','2014-01-29 11:10:20',18,5,25),(190,'2014-01-29 11:10:20','2014-01-29 11:10:20',3,5,26),(191,'2014-01-29 11:10:20','2014-01-29 11:10:20',18,5,27),(192,'2014-01-29 11:10:20','2014-01-29 11:10:20',10,5,28),(193,'2014-01-29 11:10:20','2014-01-29 11:10:20',5,5,29),(194,'2014-01-29 11:10:20','2014-01-29 11:10:20',11,5,30),(195,'2014-01-29 11:10:20','2014-01-29 11:10:20',8,5,31),(196,'2014-01-29 11:10:20','2014-01-29 11:10:20',6,5,32),(197,'2014-01-29 11:10:20','2014-01-29 11:10:20',12,5,33),(198,'2014-01-29 11:10:20','2014-01-29 11:10:20',10,5,34),(199,'2014-01-29 11:10:20','2014-01-29 11:10:20',12,5,35),(200,'2014-01-29 11:10:21','2014-01-29 11:10:21',7,5,36),(201,'2014-01-29 11:10:21','2014-01-29 11:10:21',2,5,37),(202,'2014-01-29 11:10:21','2014-01-29 11:10:21',12,5,38),(203,'2014-01-29 11:10:21','2014-01-29 11:10:21',12,5,39),(204,'2014-01-29 11:10:21','2014-01-29 11:10:21',2,5,40),(205,'2014-01-29 11:10:21','2014-01-29 11:10:21',19,5,41),(206,'2014-01-29 11:10:21','2014-01-29 11:10:21',8,6,1),(207,'2014-01-29 11:10:21','2014-01-29 11:10:21',3,6,2),(208,'2014-01-29 11:10:21','2014-01-29 11:10:21',14,6,3),(209,'2014-01-29 11:10:21','2014-01-29 11:10:21',8,6,4),(210,'2014-01-29 11:10:22','2014-01-29 11:10:22',4,6,5),(211,'2014-01-29 11:10:22','2014-01-29 11:10:22',16,6,6),(212,'2014-01-29 11:10:22','2014-01-29 11:10:22',11,6,7),(213,'2014-01-29 11:10:22','2014-01-29 11:10:22',20,6,8),(214,'2014-01-29 11:10:22','2014-01-29 11:10:22',3,6,9),(215,'2014-01-29 11:10:22','2014-01-29 11:10:22',10,6,10),(216,'2014-01-29 11:10:22','2014-01-29 11:10:22',5,6,11),(217,'2014-01-29 11:10:22','2014-01-29 11:10:22',17,6,12),(218,'2014-01-29 11:10:22','2014-01-29 11:10:22',7,6,13),(219,'2014-01-29 11:10:22','2014-01-29 11:10:22',7,6,14),(220,'2014-01-29 11:10:23','2014-01-29 11:10:23',14,6,15),(221,'2014-01-29 11:10:23','2014-01-29 11:10:23',16,6,16),(222,'2014-01-29 11:10:23','2014-01-29 11:10:23',11,6,17),(223,'2014-01-29 11:10:23','2014-01-29 11:10:23',5,6,18),(224,'2014-01-29 11:10:23','2014-01-29 11:10:23',4,6,19),(225,'2014-01-29 11:10:23','2014-01-29 11:10:23',17,6,20),(226,'2014-01-29 11:10:24','2014-01-29 11:10:24',17,6,21),(227,'2014-01-29 11:10:24','2014-01-29 11:10:24',14,6,22),(228,'2014-01-29 11:10:24','2014-01-29 11:10:24',8,6,23),(229,'2014-01-29 11:10:24','2014-01-29 11:10:24',3,6,24),(230,'2014-01-29 11:10:24','2014-01-29 11:10:24',15,6,25),(231,'2014-01-29 11:10:25','2014-01-29 11:10:25',20,6,26),(232,'2014-01-29 11:10:25','2014-01-29 11:10:25',15,6,27),(233,'2014-01-29 11:10:25','2014-01-29 11:10:25',16,6,28),(234,'2014-01-29 11:10:25','2014-01-29 11:10:25',19,6,29),(235,'2014-01-29 11:10:25','2014-01-29 11:10:25',7,6,30),(236,'2014-01-29 11:10:25','2014-01-29 11:10:25',7,6,31),(237,'2014-01-29 11:10:25','2014-01-29 11:10:25',7,6,32),(238,'2014-01-29 11:10:25','2014-01-29 11:10:25',10,6,33),(239,'2014-01-29 11:10:26','2014-01-29 11:10:26',20,6,34),(240,'2014-01-29 11:10:26','2014-01-29 11:10:26',15,6,35),(241,'2014-01-29 11:10:27','2014-01-29 11:10:27',14,6,36),(242,'2014-01-29 11:10:27','2014-01-29 11:10:27',16,6,37),(243,'2014-01-29 11:10:27','2014-01-29 11:10:27',5,6,38),(244,'2014-01-29 11:10:27','2014-01-29 11:10:27',14,6,39),(245,'2014-01-29 11:10:27','2014-01-29 11:10:27',18,6,40),(246,'2014-01-29 11:10:27','2014-01-29 11:10:27',15,6,41),(247,'2014-01-29 11:10:28','2014-01-29 11:10:28',1,7,1),(248,'2014-01-29 11:10:28','2014-01-29 11:10:28',4,7,2),(249,'2014-01-29 11:10:28','2014-01-29 11:10:28',8,7,3),(250,'2014-01-29 11:10:28','2014-01-29 11:10:28',17,7,4),(251,'2014-01-29 11:10:28','2014-01-29 11:10:28',15,7,5),(252,'2014-01-29 11:10:28','2014-01-29 11:10:28',13,7,6),(253,'2014-01-29 11:10:28','2014-01-29 11:10:28',1,7,7),(254,'2014-01-29 11:10:28','2014-01-29 11:10:28',11,7,8),(255,'2014-01-29 11:10:28','2014-01-29 11:10:28',9,7,9),(256,'2014-01-29 11:10:29','2014-01-29 11:10:29',14,7,10),(257,'2014-01-29 11:10:29','2014-01-29 11:10:29',19,7,11),(258,'2014-01-29 11:10:29','2014-01-29 11:10:29',11,7,12),(259,'2014-01-29 11:10:29','2014-01-29 11:10:29',8,7,13),(260,'2014-01-29 11:10:29','2014-01-29 11:10:29',19,7,14),(261,'2014-01-29 11:10:29','2014-01-29 11:10:29',6,7,15),(262,'2014-01-29 11:10:29','2014-01-29 11:10:29',4,7,16),(263,'2014-01-29 11:10:29','2014-01-29 11:10:29',17,7,17),(264,'2014-01-29 11:10:29','2014-01-29 11:10:29',12,7,18),(265,'2014-01-29 11:10:30','2014-01-29 11:10:30',11,7,19),(266,'2014-01-29 11:10:30','2014-01-29 11:10:30',3,7,20),(267,'2014-01-29 11:10:30','2014-01-29 11:10:30',2,7,21),(268,'2014-01-29 11:10:30','2014-01-29 11:10:30',11,7,22),(269,'2014-01-29 11:10:30','2014-01-29 11:10:30',17,7,23),(270,'2014-01-29 11:10:30','2014-01-29 11:10:30',15,7,24),(271,'2014-01-29 11:10:30','2014-01-29 11:10:30',6,7,25),(272,'2014-01-29 11:10:30','2014-01-29 11:10:30',2,7,26),(273,'2014-01-29 11:10:30','2014-01-29 11:10:30',8,7,27),(274,'2014-01-29 11:10:30','2014-01-29 11:10:30',3,7,28),(275,'2014-01-29 11:10:31','2014-01-29 11:10:31',16,7,29),(276,'2014-01-29 11:10:31','2014-01-29 11:10:31',5,7,30),(277,'2014-01-29 11:10:31','2014-01-29 11:10:31',16,7,31),(278,'2014-01-29 11:10:31','2014-01-29 11:10:31',17,7,32),(279,'2014-01-29 11:10:31','2014-01-29 11:10:31',9,7,33),(280,'2014-01-29 11:10:31','2014-01-29 11:10:31',4,7,34),(281,'2014-01-29 11:10:31','2014-01-29 11:10:31',13,7,35),(282,'2014-01-29 11:10:31','2014-01-29 11:10:31',3,7,36),(283,'2014-01-29 11:10:31','2014-01-29 11:10:31',16,7,37),(284,'2014-01-29 11:10:31','2014-01-29 11:10:31',14,7,38),(285,'2014-01-29 11:10:31','2014-01-29 11:10:31',14,7,39),(286,'2014-01-29 11:10:31','2014-01-29 11:10:31',5,7,40),(287,'2014-01-29 11:10:32','2014-01-29 11:10:32',7,7,41),(288,'2014-01-29 11:10:32','2014-01-29 11:10:32',15,8,1),(289,'2014-01-29 11:10:32','2014-01-29 11:10:32',10,8,2),(290,'2014-01-29 11:10:32','2014-01-29 11:10:32',1,8,3),(291,'2014-01-29 11:10:32','2014-01-29 11:10:32',19,8,4),(292,'2014-01-29 11:10:32','2014-01-29 11:10:32',7,8,5),(293,'2014-01-29 11:10:32','2014-01-29 11:10:32',13,8,6),(294,'2014-01-29 11:10:32','2014-01-29 11:10:32',9,8,7),(295,'2014-01-29 11:10:32','2014-01-29 11:10:32',9,8,8),(296,'2014-01-29 11:10:33','2014-01-29 11:10:33',14,8,9),(297,'2014-01-29 11:10:33','2014-01-29 11:10:33',20,8,10),(298,'2014-01-29 11:10:33','2014-01-29 11:10:33',6,8,11),(299,'2014-01-29 11:10:33','2014-01-29 11:10:33',9,8,12),(300,'2014-01-29 11:10:33','2014-01-29 11:10:33',5,8,13),(301,'2014-01-29 11:10:33','2014-01-29 11:10:33',7,8,14),(302,'2014-01-29 11:10:33','2014-01-29 11:10:33',17,8,15),(303,'2014-01-29 11:10:33','2014-01-29 11:10:33',7,8,16),(304,'2014-01-29 11:10:33','2014-01-29 11:10:33',3,8,17),(305,'2014-01-29 11:10:34','2014-01-29 11:10:34',2,8,18),(306,'2014-01-29 11:10:34','2014-01-29 11:10:34',3,8,19),(307,'2014-01-29 11:10:34','2014-01-29 11:10:34',19,8,20),(308,'2014-01-29 11:10:34','2014-01-29 11:10:34',10,8,21),(309,'2014-01-29 11:10:34','2014-01-29 11:10:34',6,8,22),(310,'2014-01-29 11:10:34','2014-01-29 11:10:34',12,8,23),(311,'2014-01-29 11:10:34','2014-01-29 11:10:34',12,8,24),(312,'2014-01-29 11:10:34','2014-01-29 11:10:34',2,8,25),(313,'2014-01-29 11:10:34','2014-01-29 11:10:34',5,8,26),(314,'2014-01-29 11:10:34','2014-01-29 11:10:34',6,8,27),(315,'2014-01-29 11:10:35','2014-01-29 11:10:35',6,8,28),(316,'2014-01-29 11:10:35','2014-01-29 11:10:35',12,8,29),(317,'2014-01-29 11:10:35','2014-01-29 11:10:35',17,8,30),(318,'2014-01-29 11:10:35','2014-01-29 11:10:35',1,8,31),(319,'2014-01-29 11:10:35','2014-01-29 11:10:35',7,8,32),(320,'2014-01-29 11:10:35','2014-01-29 11:10:35',7,8,33),(321,'2014-01-29 11:10:35','2014-01-29 11:10:35',1,8,34),(322,'2014-01-29 11:10:36','2014-01-29 11:10:36',5,8,35),(323,'2014-01-29 11:10:36','2014-01-29 11:10:36',13,8,36),(324,'2014-01-29 11:10:36','2014-01-29 11:10:36',14,8,37),(325,'2014-01-29 11:10:36','2014-01-29 11:10:36',14,8,38),(326,'2014-01-29 11:10:36','2014-01-29 11:10:36',2,8,39),(327,'2014-01-29 11:10:36','2014-01-29 11:10:36',7,8,40),(328,'2014-01-29 11:10:37','2014-01-29 11:10:37',13,8,41),(329,'2014-01-29 11:10:37','2014-01-29 11:10:37',12,9,1),(330,'2014-01-29 11:10:38','2014-01-29 11:10:38',4,9,2),(331,'2014-01-29 11:10:38','2014-01-29 11:10:38',16,9,3),(332,'2014-01-29 11:10:38','2014-01-29 11:10:38',13,9,4),(333,'2014-01-29 11:10:38','2014-01-29 11:10:38',7,9,5),(334,'2014-01-29 11:10:38','2014-01-29 11:10:38',15,9,6),(335,'2014-01-29 11:10:38','2014-01-29 11:10:38',2,9,7),(336,'2014-01-29 11:10:38','2014-01-29 11:10:38',13,9,8),(337,'2014-01-29 11:10:38','2014-01-29 11:10:38',6,9,9),(338,'2014-01-29 11:10:39','2014-01-29 11:10:39',14,9,10),(339,'2014-01-29 11:10:39','2014-01-29 11:10:39',14,9,11),(340,'2014-01-29 11:10:39','2014-01-29 11:10:39',11,9,12),(341,'2014-01-29 11:10:39','2014-01-29 11:10:39',19,9,13),(342,'2014-01-29 11:10:39','2014-01-29 11:10:39',20,9,14),(343,'2014-01-29 11:10:39','2014-01-29 11:10:39',2,9,15),(344,'2014-01-29 11:10:39','2014-01-29 11:10:39',16,9,16),(345,'2014-01-29 11:10:39','2014-01-29 11:10:39',20,9,17),(346,'2014-01-29 11:10:40','2014-01-29 11:10:40',9,9,18),(347,'2014-01-29 11:10:40','2014-01-29 11:10:40',2,9,19),(348,'2014-01-29 11:10:40','2014-01-29 11:10:40',1,9,20),(349,'2014-01-29 11:10:40','2014-01-29 11:10:40',14,9,21),(350,'2014-01-29 11:10:40','2014-01-29 11:10:40',15,9,22),(351,'2014-01-29 11:10:40','2014-01-29 11:10:40',14,9,23),(352,'2014-01-29 11:10:40','2014-01-29 11:10:40',8,9,24),(353,'2014-01-29 11:10:40','2014-01-29 11:10:40',16,9,25),(354,'2014-01-29 11:10:40','2014-01-29 11:10:40',1,9,26),(355,'2014-01-29 11:10:40','2014-01-29 11:10:40',20,9,27),(356,'2014-01-29 11:10:41','2014-01-29 11:10:41',3,9,28),(357,'2014-01-29 11:10:41','2014-01-29 11:10:41',16,9,29),(358,'2014-01-29 11:10:41','2014-01-29 11:10:41',18,9,30),(359,'2014-01-29 11:10:41','2014-01-29 11:10:41',16,9,31),(360,'2014-01-29 11:10:41','2014-01-29 11:10:41',7,9,32),(361,'2014-01-29 11:10:41','2014-01-29 11:10:41',1,9,33),(362,'2014-01-29 11:10:41','2014-01-29 11:10:41',12,9,34),(363,'2014-01-29 11:10:41','2014-01-29 11:10:41',19,9,35),(364,'2014-01-29 11:10:41','2014-01-29 11:10:41',8,9,36),(365,'2014-01-29 11:10:42','2014-01-29 11:10:42',6,9,37),(366,'2014-01-29 11:10:42','2014-01-29 11:10:42',1,9,38),(367,'2014-01-29 11:10:42','2014-01-29 11:10:42',20,9,39),(368,'2014-01-29 11:10:42','2014-01-29 11:10:42',11,9,40),(369,'2014-01-29 11:10:42','2014-01-29 11:10:42',14,9,41),(370,'2014-01-29 11:10:42','2014-01-29 11:10:42',13,10,1),(371,'2014-01-29 11:10:42','2014-01-29 11:10:42',13,10,2),(372,'2014-01-29 11:10:42','2014-01-29 11:10:42',3,10,3),(373,'2014-01-29 11:10:43','2014-01-29 11:10:43',8,10,4),(374,'2014-01-29 11:10:43','2014-01-29 11:10:43',13,10,5),(375,'2014-01-29 11:10:43','2014-01-29 11:10:43',11,10,6),(376,'2014-01-29 11:10:43','2014-01-29 11:10:43',10,10,7),(377,'2014-01-29 11:10:43','2014-01-29 11:10:43',14,10,8),(378,'2014-01-29 11:10:43','2014-01-29 11:10:43',4,10,9),(379,'2014-01-29 11:10:43','2014-01-29 11:10:43',5,10,10),(380,'2014-01-29 11:10:43','2014-01-29 11:10:43',7,10,11),(381,'2014-01-29 11:10:44','2014-01-29 11:10:44',11,10,12),(382,'2014-01-29 11:10:44','2014-01-29 11:10:44',20,10,13),(383,'2014-01-29 11:10:44','2014-01-29 11:10:44',8,10,14),(384,'2014-01-29 11:10:44','2014-01-29 11:10:44',11,10,15),(385,'2014-01-29 11:10:44','2014-01-29 11:10:44',3,10,16),(386,'2014-01-29 11:10:44','2014-01-29 11:10:44',4,10,17),(387,'2014-01-29 11:10:44','2014-01-29 11:10:44',8,10,18),(388,'2014-01-29 11:10:44','2014-01-29 11:10:44',18,10,19),(389,'2014-01-29 11:10:44','2014-01-29 11:10:44',10,10,20),(390,'2014-01-29 11:10:44','2014-01-29 11:10:44',9,10,21),(391,'2014-01-29 11:10:45','2014-01-29 11:10:45',9,10,22),(392,'2014-01-29 11:10:45','2014-01-29 11:10:45',9,10,23),(393,'2014-01-29 11:10:45','2014-01-29 11:10:45',17,10,24),(394,'2014-01-29 11:10:45','2014-01-29 11:10:45',14,10,25),(395,'2014-01-29 11:10:45','2014-01-29 11:10:45',10,10,26),(396,'2014-01-29 11:10:45','2014-01-29 11:10:45',16,10,27),(397,'2014-01-29 11:10:45','2014-01-29 11:10:45',5,10,28),(398,'2014-01-29 11:10:45','2014-01-29 11:10:45',4,10,29),(399,'2014-01-29 11:10:45','2014-01-29 11:10:45',9,10,30),(400,'2014-01-29 11:10:46','2014-01-29 11:10:46',6,10,31),(401,'2014-01-29 11:10:46','2014-01-29 11:10:46',16,10,32),(402,'2014-01-29 11:10:46','2014-01-29 11:10:46',1,10,33),(403,'2014-01-29 11:10:46','2014-01-29 11:10:46',9,10,34),(404,'2014-01-29 11:10:46','2014-01-29 11:10:46',4,10,35),(405,'2014-01-29 11:10:46','2014-01-29 11:10:46',13,10,36),(406,'2014-01-29 11:10:46','2014-01-29 11:10:46',19,10,37),(407,'2014-01-29 11:10:46','2014-01-29 11:10:46',14,10,38),(408,'2014-01-29 11:10:46','2014-01-29 11:10:46',6,10,39),(409,'2014-01-29 11:10:46','2014-01-29 11:10:46',3,10,40),(410,'2014-01-29 11:10:46','2014-01-29 11:10:46',18,10,41),(411,'2014-01-29 11:10:47','2014-01-29 11:10:47',18,11,1),(412,'2014-01-29 11:10:47','2014-01-29 11:10:47',1,11,2),(413,'2014-01-29 11:10:47','2014-01-29 11:10:47',5,11,3),(414,'2014-01-29 11:10:47','2014-01-29 11:10:47',20,11,4),(415,'2014-01-29 11:10:47','2014-01-29 11:10:47',4,11,5),(416,'2014-01-29 11:10:47','2014-01-29 11:10:47',13,11,6),(417,'2014-01-29 11:10:48','2014-01-29 11:10:48',18,11,7),(418,'2014-01-29 11:10:48','2014-01-29 11:10:48',14,11,8),(419,'2014-01-29 11:10:48','2014-01-29 11:10:48',2,11,9),(420,'2014-01-29 11:10:48','2014-01-29 11:10:48',6,11,10),(421,'2014-01-29 11:10:48','2014-01-29 11:10:48',3,11,11),(422,'2014-01-29 11:10:49','2014-01-29 11:10:49',18,11,12),(423,'2014-01-29 11:10:49','2014-01-29 11:10:49',20,11,13),(424,'2014-01-29 11:10:49','2014-01-29 11:10:49',12,11,14),(425,'2014-01-29 11:10:49','2014-01-29 11:10:49',13,11,15),(426,'2014-01-29 11:10:49','2014-01-29 11:10:49',5,11,16),(427,'2014-01-29 11:10:50','2014-01-29 11:10:50',15,11,17),(428,'2014-01-29 11:10:50','2014-01-29 11:10:50',2,11,18),(429,'2014-01-29 11:10:50','2014-01-29 11:10:50',10,11,19),(430,'2014-01-29 11:10:50','2014-01-29 11:10:50',11,11,20),(431,'2014-01-29 11:10:50','2014-01-29 11:10:50',2,11,21),(432,'2014-01-29 11:10:50','2014-01-29 11:10:50',18,11,22),(433,'2014-01-29 11:10:50','2014-01-29 11:10:50',15,11,23),(434,'2014-01-29 11:10:50','2014-01-29 11:10:50',15,11,24),(435,'2014-01-29 11:10:50','2014-01-29 11:10:50',17,11,25),(436,'2014-01-29 11:10:51','2014-01-29 11:10:51',8,11,26),(437,'2014-01-29 11:10:51','2014-01-29 11:10:51',1,11,27),(438,'2014-01-29 11:10:51','2014-01-29 11:10:51',20,11,28),(439,'2014-01-29 11:10:51','2014-01-29 11:10:51',5,11,29),(440,'2014-01-29 11:10:51','2014-01-29 11:10:51',13,11,30),(441,'2014-01-29 11:10:51','2014-01-29 11:10:51',14,11,31),(442,'2014-01-29 11:10:51','2014-01-29 11:10:51',2,11,32),(443,'2014-01-29 11:10:51','2014-01-29 11:10:51',14,11,33),(444,'2014-01-29 11:10:51','2014-01-29 11:10:51',18,11,34),(445,'2014-01-29 11:10:51','2014-01-29 11:10:51',1,11,35),(446,'2014-01-29 11:10:51','2014-01-29 11:10:51',17,11,36),(447,'2014-01-29 11:10:52','2014-01-29 11:10:52',10,11,37),(448,'2014-01-29 11:10:52','2014-01-29 11:10:52',18,11,38),(449,'2014-01-29 11:10:52','2014-01-29 11:10:52',11,11,39),(450,'2014-01-29 11:10:52','2014-01-29 11:10:52',12,11,40),(451,'2014-01-29 11:10:52','2014-01-29 11:10:52',4,11,41),(452,'2014-01-29 11:10:52','2014-01-29 11:10:52',4,12,1),(453,'2014-01-29 11:10:53','2014-01-29 11:10:53',5,12,2),(454,'2014-01-29 11:10:53','2014-01-29 11:10:53',1,12,3),(455,'2014-01-29 11:10:53','2014-01-29 11:10:53',8,12,4),(456,'2014-01-29 11:10:53','2014-01-29 11:10:53',20,12,5),(457,'2014-01-29 11:10:53','2014-01-29 11:10:53',2,12,6),(458,'2014-01-29 11:10:53','2014-01-29 11:10:53',18,12,7),(459,'2014-01-29 11:10:53','2014-01-29 11:10:53',11,12,8),(460,'2014-01-29 11:10:53','2014-01-29 11:10:53',4,12,9),(461,'2014-01-29 11:10:53','2014-01-29 11:10:53',15,12,10),(462,'2014-01-29 11:10:54','2014-01-29 11:10:54',5,12,11),(463,'2014-01-29 11:10:54','2014-01-29 11:10:54',18,12,12),(464,'2014-01-29 11:10:54','2014-01-29 11:10:54',12,12,13),(465,'2014-01-29 11:10:54','2014-01-29 11:10:54',12,12,14),(466,'2014-01-29 11:10:54','2014-01-29 11:10:54',19,12,15),(467,'2014-01-29 11:10:54','2014-01-29 11:10:54',11,12,16),(468,'2014-01-29 11:10:54','2014-01-29 11:10:54',16,12,17),(469,'2014-01-29 11:10:54','2014-01-29 11:10:54',12,12,18),(470,'2014-01-29 11:10:54','2014-01-29 11:10:54',4,12,19),(471,'2014-01-29 11:10:55','2014-01-29 11:10:55',18,12,20),(472,'2014-01-29 11:10:55','2014-01-29 11:10:55',5,12,21),(473,'2014-01-29 11:10:55','2014-01-29 11:10:55',2,12,22),(474,'2014-01-29 11:10:55','2014-01-29 11:10:55',18,12,23),(475,'2014-01-29 11:10:55','2014-01-29 11:10:55',2,12,24),(476,'2014-01-29 11:10:55','2014-01-29 11:10:55',12,12,25),(477,'2014-01-29 11:10:55','2014-01-29 11:10:55',16,12,26),(478,'2014-01-29 11:10:55','2014-01-29 11:10:55',12,12,27),(479,'2014-01-29 11:10:55','2014-01-29 11:10:55',3,12,28),(480,'2014-01-29 11:10:56','2014-01-29 11:10:56',20,12,29),(481,'2014-01-29 11:10:56','2014-01-29 11:10:56',5,12,30),(482,'2014-01-29 11:10:56','2014-01-29 11:10:56',11,12,31),(483,'2014-01-29 11:10:56','2014-01-29 11:10:56',3,12,32),(484,'2014-01-29 11:10:56','2014-01-29 11:10:56',9,12,33),(485,'2014-01-29 11:10:56','2014-01-29 11:10:56',12,12,34),(486,'2014-01-29 11:10:56','2014-01-29 11:10:56',10,12,35),(487,'2014-01-29 11:10:56','2014-01-29 11:10:56',9,12,36),(488,'2014-01-29 11:10:56','2014-01-29 11:10:56',13,12,37),(489,'2014-01-29 11:10:56','2014-01-29 11:10:56',7,12,38),(490,'2014-01-29 11:10:57','2014-01-29 11:10:57',19,12,39),(491,'2014-01-29 11:10:57','2014-01-29 11:10:57',17,12,40),(492,'2014-01-29 11:10:57','2014-01-29 11:10:57',2,12,41),(493,'2014-01-29 11:10:57','2014-01-29 11:10:57',13,13,1),(494,'2014-01-29 11:10:58','2014-01-29 11:10:58',4,13,2),(495,'2014-01-29 11:10:59','2014-01-29 11:10:59',10,13,3),(496,'2014-01-29 11:10:59','2014-01-29 11:10:59',4,13,4),(497,'2014-01-29 11:10:59','2014-01-29 11:10:59',8,13,5),(498,'2014-01-29 11:10:59','2014-01-29 11:10:59',7,13,6),(499,'2014-01-29 11:10:59','2014-01-29 11:10:59',8,13,7),(500,'2014-01-29 11:10:59','2014-01-29 11:10:59',9,13,8),(501,'2014-01-29 11:11:00','2014-01-29 11:11:00',5,13,9),(502,'2014-01-29 11:11:00','2014-01-29 11:11:00',10,13,10),(503,'2014-01-29 11:11:00','2014-01-29 11:11:00',20,13,11),(504,'2014-01-29 11:11:00','2014-01-29 11:11:00',20,13,12),(505,'2014-01-29 11:11:00','2014-01-29 11:11:00',1,13,13),(506,'2014-01-29 11:11:01','2014-01-29 11:11:01',2,13,14),(507,'2014-01-29 11:11:01','2014-01-29 11:11:01',20,13,15),(508,'2014-01-29 11:11:01','2014-01-29 11:11:01',6,13,16),(509,'2014-01-29 11:11:01','2014-01-29 11:11:01',12,13,17),(510,'2014-01-29 11:11:01','2014-01-29 11:11:01',2,13,18),(511,'2014-01-29 11:11:01','2014-01-29 11:11:01',15,13,19),(512,'2014-01-29 11:11:01','2014-01-29 11:11:01',3,13,20),(513,'2014-01-29 11:11:02','2014-01-29 11:11:02',11,13,21),(514,'2014-01-29 11:11:02','2014-01-29 11:11:02',3,13,22),(515,'2014-01-29 11:11:02','2014-01-29 11:11:02',16,13,23),(516,'2014-01-29 11:11:02','2014-01-29 11:11:02',18,13,24),(517,'2014-01-29 11:11:02','2014-01-29 11:11:02',1,13,25),(518,'2014-01-29 11:11:02','2014-01-29 11:11:02',13,13,26),(519,'2014-01-29 11:11:02','2014-01-29 11:11:02',20,13,27),(520,'2014-01-29 11:11:02','2014-01-29 11:11:02',4,13,28),(521,'2014-01-29 11:11:03','2014-01-29 11:11:03',7,13,29),(522,'2014-01-29 11:11:03','2014-01-29 11:11:03',12,13,30),(523,'2014-01-29 11:11:03','2014-01-29 11:11:03',18,13,31),(524,'2014-01-29 11:11:03','2014-01-29 11:11:03',19,13,32),(525,'2014-01-29 11:11:03','2014-01-29 11:11:03',16,13,33),(526,'2014-01-29 11:11:03','2014-01-29 11:11:03',7,13,34),(527,'2014-01-29 11:11:03','2014-01-29 11:11:03',2,13,35),(528,'2014-01-29 11:11:03','2014-01-29 11:11:03',3,13,36),(529,'2014-01-29 11:11:03','2014-01-29 11:11:03',14,13,37),(530,'2014-01-29 11:11:03','2014-01-29 11:11:03',10,13,38),(531,'2014-01-29 11:11:04','2014-01-29 11:11:04',11,13,39),(532,'2014-01-29 11:11:04','2014-01-29 11:11:04',18,13,40),(533,'2014-01-29 11:11:04','2014-01-29 11:11:04',19,13,41),(534,'2014-01-29 11:11:04','2014-01-29 11:11:04',20,14,1),(535,'2014-01-29 11:11:04','2014-01-29 11:11:04',12,14,2),(536,'2014-01-29 11:11:04','2014-01-29 11:11:04',17,14,3),(537,'2014-01-29 11:11:04','2014-01-29 11:11:04',5,14,4),(538,'2014-01-29 11:11:04','2014-01-29 11:11:04',4,14,5),(539,'2014-01-29 11:11:04','2014-01-29 11:11:04',18,14,6),(540,'2014-01-29 11:11:05','2014-01-29 11:11:05',19,14,7),(541,'2014-01-29 11:11:05','2014-01-29 11:11:05',7,14,8),(542,'2014-01-29 11:11:05','2014-01-29 11:11:05',9,14,9),(543,'2014-01-29 11:11:05','2014-01-29 11:11:05',2,14,10),(544,'2014-01-29 11:11:05','2014-01-29 11:11:05',3,14,11),(545,'2014-01-29 11:11:05','2014-01-29 11:11:05',7,14,12),(546,'2014-01-29 11:11:05','2014-01-29 11:11:05',2,14,13),(547,'2014-01-29 11:11:05','2014-01-29 11:11:05',15,14,14),(548,'2014-01-29 11:11:05','2014-01-29 11:11:05',6,14,15),(549,'2014-01-29 11:11:05','2014-01-29 11:11:05',6,14,16),(550,'2014-01-29 11:11:05','2014-01-29 11:11:05',1,14,17),(551,'2014-01-29 11:11:06','2014-01-29 11:11:06',18,14,18),(552,'2014-01-29 11:11:06','2014-01-29 11:11:06',3,14,19),(553,'2014-01-29 11:11:06','2014-01-29 11:11:06',19,14,20),(554,'2014-01-29 11:11:06','2014-01-29 11:11:06',13,14,21),(555,'2014-01-29 11:11:06','2014-01-29 11:11:06',10,14,22),(556,'2014-01-29 11:11:06','2014-01-29 11:11:06',1,14,23),(557,'2014-01-29 11:11:06','2014-01-29 11:11:06',16,14,24),(558,'2014-01-29 11:11:06','2014-01-29 11:11:06',3,14,25),(559,'2014-01-29 11:11:06','2014-01-29 11:11:06',11,14,26),(560,'2014-01-29 11:11:06','2014-01-29 11:11:06',7,14,27),(561,'2014-01-29 11:11:06','2014-01-29 11:11:06',20,14,28),(562,'2014-01-29 11:11:06','2014-01-29 11:11:06',10,14,29),(563,'2014-01-29 11:11:07','2014-01-29 11:11:07',17,14,30),(564,'2014-01-29 11:11:07','2014-01-29 11:11:07',18,14,31),(565,'2014-01-29 11:11:07','2014-01-29 11:11:07',9,14,32),(566,'2014-01-29 11:11:07','2014-01-29 11:11:07',9,14,33),(567,'2014-01-29 11:11:07','2014-01-29 11:11:07',14,14,34),(568,'2014-01-29 11:11:07','2014-01-29 11:11:07',14,14,35),(569,'2014-01-29 11:11:07','2014-01-29 11:11:07',12,14,36),(570,'2014-01-29 11:11:07','2014-01-29 11:11:07',12,14,37),(571,'2014-01-29 11:11:07','2014-01-29 11:11:07',13,14,38),(572,'2014-01-29 11:11:08','2014-01-29 11:11:08',19,14,39),(573,'2014-01-29 11:11:08','2014-01-29 11:11:08',20,14,40),(574,'2014-01-29 11:11:08','2014-01-29 11:11:08',14,14,41),(575,'2014-01-29 11:11:08','2014-01-29 11:11:08',16,15,1),(576,'2014-01-29 11:11:08','2014-01-29 11:11:08',15,15,2),(577,'2014-01-29 11:11:08','2014-01-29 11:11:08',12,15,3),(578,'2014-01-29 11:11:08','2014-01-29 11:11:08',1,15,4),(579,'2014-01-29 11:11:08','2014-01-29 11:11:08',15,15,5),(580,'2014-01-29 11:11:08','2014-01-29 11:11:08',9,15,6),(581,'2014-01-29 11:11:08','2014-01-29 11:11:08',3,15,7),(582,'2014-01-29 11:11:08','2014-01-29 11:11:08',14,15,8),(583,'2014-01-29 11:11:09','2014-01-29 11:11:09',2,15,9),(584,'2014-01-29 11:11:09','2014-01-29 11:11:09',12,15,10),(585,'2014-01-29 11:11:09','2014-01-29 11:11:09',15,15,11),(586,'2014-01-29 11:11:09','2014-01-29 11:11:09',17,15,12),(587,'2014-01-29 11:11:10','2014-01-29 11:11:10',15,15,13),(588,'2014-01-29 11:11:10','2014-01-29 11:11:10',6,15,14),(589,'2014-01-29 11:11:10','2014-01-29 11:11:10',3,15,15),(590,'2014-01-29 11:11:10','2014-01-29 11:11:10',14,15,16),(591,'2014-01-29 11:11:10','2014-01-29 11:11:10',15,15,17),(592,'2014-01-29 11:11:10','2014-01-29 11:11:10',20,15,18),(593,'2014-01-29 11:11:11','2014-01-29 11:11:11',12,15,19),(594,'2014-01-29 11:11:11','2014-01-29 11:11:11',4,15,20),(595,'2014-01-29 11:11:11','2014-01-29 11:11:11',8,15,21),(596,'2014-01-29 11:11:11','2014-01-29 11:11:11',5,15,22),(597,'2014-01-29 11:11:11','2014-01-29 11:11:11',17,15,23),(598,'2014-01-29 11:11:11','2014-01-29 11:11:11',19,15,24),(599,'2014-01-29 11:11:11','2014-01-29 11:11:11',16,15,25),(600,'2014-01-29 11:11:12','2014-01-29 11:11:12',10,15,26),(601,'2014-01-29 11:11:12','2014-01-29 11:11:12',17,15,27),(602,'2014-01-29 11:11:12','2014-01-29 11:11:12',16,15,28),(603,'2014-01-29 11:11:12','2014-01-29 11:11:12',3,15,29),(604,'2014-01-29 11:11:13','2014-01-29 11:11:13',18,15,30),(605,'2014-01-29 11:11:13','2014-01-29 11:11:13',2,15,31),(606,'2014-01-29 11:11:13','2014-01-29 11:11:13',18,15,32),(607,'2014-01-29 11:11:13','2014-01-29 11:11:13',12,15,33),(608,'2014-01-29 11:11:13','2014-01-29 11:11:13',14,15,34),(609,'2014-01-29 11:11:13','2014-01-29 11:11:13',18,15,35),(610,'2014-01-29 11:11:14','2014-01-29 11:11:14',6,15,36),(611,'2014-01-29 11:11:14','2014-01-29 11:11:14',3,15,37),(612,'2014-01-29 11:11:14','2014-01-29 11:11:14',1,15,38),(613,'2014-01-29 11:11:14','2014-01-29 11:11:14',20,15,39),(614,'2014-01-29 11:11:14','2014-01-29 11:11:14',4,15,40),(615,'2014-01-29 11:11:14','2014-01-29 11:11:14',13,15,41),(616,'2014-01-29 11:11:15','2014-01-29 11:11:15',7,16,1),(617,'2014-01-29 11:11:15','2014-01-29 11:11:15',20,16,2),(618,'2014-01-29 11:11:15','2014-01-29 11:11:15',4,16,3),(619,'2014-01-29 11:11:15','2014-01-29 11:11:15',1,16,4),(620,'2014-01-29 11:11:15','2014-01-29 11:11:15',14,16,5),(621,'2014-01-29 11:11:16','2014-01-29 11:11:16',3,16,6),(622,'2014-01-29 11:11:16','2014-01-29 11:11:16',12,16,7),(623,'2014-01-29 11:11:16','2014-01-29 11:11:16',18,16,8),(624,'2014-01-29 11:11:16','2014-01-29 11:11:16',10,16,9),(625,'2014-01-29 11:11:16','2014-01-29 11:11:16',17,16,10),(626,'2014-01-29 11:11:16','2014-01-29 11:11:16',15,16,11),(627,'2014-01-29 11:11:16','2014-01-29 11:11:16',9,16,12),(628,'2014-01-29 11:11:16','2014-01-29 11:11:16',13,16,13),(629,'2014-01-29 11:11:16','2014-01-29 11:11:16',4,16,14),(630,'2014-01-29 11:11:16','2014-01-29 11:11:16',6,16,15),(631,'2014-01-29 11:11:16','2014-01-29 11:11:16',8,16,16),(632,'2014-01-29 11:11:17','2014-01-29 11:11:17',6,16,17),(633,'2014-01-29 11:11:17','2014-01-29 11:11:17',3,16,18),(634,'2014-01-29 11:11:17','2014-01-29 11:11:17',10,16,19),(635,'2014-01-29 11:11:17','2014-01-29 11:11:17',3,16,20),(636,'2014-01-29 11:11:17','2014-01-29 11:11:17',14,16,21),(637,'2014-01-29 11:11:17','2014-01-29 11:11:17',4,16,22),(638,'2014-01-29 11:11:17','2014-01-29 11:11:17',1,16,23),(639,'2014-01-29 11:11:17','2014-01-29 11:11:17',20,16,24),(640,'2014-01-29 11:11:17','2014-01-29 11:11:17',6,16,25),(641,'2014-01-29 11:11:18','2014-01-29 11:11:18',2,16,26),(642,'2014-01-29 11:11:18','2014-01-29 11:11:18',19,16,27),(643,'2014-01-29 11:11:18','2014-01-29 11:11:18',10,16,28),(644,'2014-01-29 11:11:18','2014-01-29 11:11:18',15,16,29),(645,'2014-01-29 11:11:18','2014-01-29 11:11:18',13,16,30),(646,'2014-01-29 11:11:18','2014-01-29 11:11:18',11,16,31),(647,'2014-01-29 11:11:18','2014-01-29 11:11:18',2,16,32),(648,'2014-01-29 11:11:18','2014-01-29 11:11:18',12,16,33),(649,'2014-01-29 11:11:18','2014-01-29 11:11:18',14,16,34),(650,'2014-01-29 11:11:18','2014-01-29 11:11:18',3,16,35),(651,'2014-01-29 11:11:19','2014-01-29 11:11:19',6,16,36),(652,'2014-01-29 11:11:19','2014-01-29 11:11:19',16,16,37),(653,'2014-01-29 11:11:19','2014-01-29 11:11:19',15,16,38),(654,'2014-01-29 11:11:19','2014-01-29 11:11:19',3,16,39),(655,'2014-01-29 11:11:19','2014-01-29 11:11:19',6,16,40),(656,'2014-01-29 11:11:19','2014-01-29 11:11:19',11,16,41),(657,'2014-01-29 11:11:20','2014-01-29 11:11:20',19,17,1),(658,'2014-01-29 11:11:20','2014-01-29 11:11:20',11,17,2),(659,'2014-01-29 11:11:20','2014-01-29 11:11:20',6,17,3),(660,'2014-01-29 11:11:20','2014-01-29 11:11:20',1,17,4),(661,'2014-01-29 11:11:20','2014-01-29 11:11:20',1,17,5),(662,'2014-01-29 11:11:20','2014-01-29 11:11:20',9,17,6),(663,'2014-01-29 11:11:20','2014-01-29 11:11:20',15,17,7),(664,'2014-01-29 11:11:20','2014-01-29 11:11:20',5,17,8),(665,'2014-01-29 11:11:20','2014-01-29 11:11:20',10,17,9),(666,'2014-01-29 11:11:20','2014-01-29 11:11:20',15,17,10),(667,'2014-01-29 11:11:20','2014-01-29 11:11:20',11,17,11),(668,'2014-01-29 11:11:21','2014-01-29 11:11:21',11,17,12),(669,'2014-01-29 11:11:21','2014-01-29 11:11:21',13,17,13),(670,'2014-01-29 11:11:21','2014-01-29 11:11:21',1,17,14),(671,'2014-01-29 11:11:21','2014-01-29 11:11:21',6,17,15),(672,'2014-01-29 11:11:21','2014-01-29 11:11:21',6,17,16),(673,'2014-01-29 11:11:21','2014-01-29 11:11:21',11,17,17),(674,'2014-01-29 11:11:21','2014-01-29 11:11:21',8,17,18),(675,'2014-01-29 11:11:21','2014-01-29 11:11:21',18,17,19),(676,'2014-01-29 11:11:21','2014-01-29 11:11:21',5,17,20),(677,'2014-01-29 11:11:21','2014-01-29 11:11:21',10,17,21),(678,'2014-01-29 11:11:21','2014-01-29 11:11:21',4,17,22),(679,'2014-01-29 11:11:21','2014-01-29 11:11:21',20,17,23),(680,'2014-01-29 11:11:22','2014-01-29 11:11:22',4,17,24),(681,'2014-01-29 11:11:22','2014-01-29 11:11:22',6,17,25),(682,'2014-01-29 11:11:22','2014-01-29 11:11:22',6,17,26),(683,'2014-01-29 11:11:22','2014-01-29 11:11:22',15,17,27),(684,'2014-01-29 11:11:22','2014-01-29 11:11:22',3,17,28),(685,'2014-01-29 11:11:22','2014-01-29 11:11:22',19,17,29),(686,'2014-01-29 11:11:22','2014-01-29 11:11:22',18,17,30),(687,'2014-01-29 11:11:22','2014-01-29 11:11:22',3,17,31),(688,'2014-01-29 11:11:22','2014-01-29 11:11:22',17,17,32),(689,'2014-01-29 11:11:22','2014-01-29 11:11:22',9,17,33),(690,'2014-01-29 11:11:23','2014-01-29 11:11:23',8,17,34),(691,'2014-01-29 11:11:23','2014-01-29 11:11:23',18,17,35),(692,'2014-01-29 11:11:23','2014-01-29 11:11:23',9,17,36),(693,'2014-01-29 11:11:23','2014-01-29 11:11:23',16,17,37),(694,'2014-01-29 11:11:23','2014-01-29 11:11:23',13,17,38),(695,'2014-01-29 11:11:23','2014-01-29 11:11:23',14,17,39),(696,'2014-01-29 11:11:23','2014-01-29 11:11:23',5,17,40),(697,'2014-01-29 11:11:23','2014-01-29 11:11:23',7,17,41),(698,'2014-01-29 11:11:24','2014-01-29 11:11:24',20,18,1),(699,'2014-01-29 11:11:24','2014-01-29 11:11:24',4,18,2),(700,'2014-01-29 11:11:24','2014-01-29 11:11:24',1,18,3),(701,'2014-01-29 11:11:24','2014-01-29 11:11:24',6,18,4),(702,'2014-01-29 11:11:24','2014-01-29 11:11:24',15,18,5),(703,'2014-01-29 11:11:24','2014-01-29 11:11:24',8,18,6),(704,'2014-01-29 11:11:24','2014-01-29 11:11:24',3,18,7),(705,'2014-01-29 11:11:24','2014-01-29 11:11:24',19,18,8),(706,'2014-01-29 11:11:24','2014-01-29 11:11:24',18,18,9),(707,'2014-01-29 11:11:24','2014-01-29 11:11:24',7,18,10),(708,'2014-01-29 11:11:25','2014-01-29 11:11:25',19,18,11),(709,'2014-01-29 11:11:25','2014-01-29 11:11:25',1,18,12),(710,'2014-01-29 11:11:25','2014-01-29 11:11:25',12,18,13),(711,'2014-01-29 11:11:25','2014-01-29 11:11:25',4,18,14),(712,'2014-01-29 11:11:25','2014-01-29 11:11:25',16,18,15),(713,'2014-01-29 11:11:25','2014-01-29 11:11:25',15,18,16),(714,'2014-01-29 11:11:25','2014-01-29 11:11:25',2,18,17),(715,'2014-01-29 11:11:25','2014-01-29 11:11:25',13,18,18),(716,'2014-01-29 11:11:25','2014-01-29 11:11:25',17,18,19),(717,'2014-01-29 11:11:26','2014-01-29 11:11:26',19,18,20),(718,'2014-01-29 11:11:26','2014-01-29 11:11:26',1,18,21),(719,'2014-01-29 11:11:26','2014-01-29 11:11:26',4,18,22),(720,'2014-01-29 11:11:26','2014-01-29 11:11:26',17,18,23),(721,'2014-01-29 11:11:26','2014-01-29 11:11:26',10,18,24),(722,'2014-01-29 11:11:26','2014-01-29 11:11:26',19,18,25),(723,'2014-01-29 11:11:27','2014-01-29 11:11:27',9,18,26),(724,'2014-01-29 11:11:27','2014-01-29 11:11:27',3,18,27),(725,'2014-01-29 11:11:27','2014-01-29 11:11:27',3,18,28),(726,'2014-01-29 11:11:27','2014-01-29 11:11:27',15,18,29),(727,'2014-01-29 11:11:27','2014-01-29 11:11:27',7,18,30),(728,'2014-01-29 11:11:27','2014-01-29 11:11:27',18,18,31),(729,'2014-01-29 11:11:28','2014-01-29 11:11:28',14,18,32),(730,'2014-01-29 11:11:28','2014-01-29 11:11:28',10,18,33),(731,'2014-01-29 11:11:28','2014-01-29 11:11:28',19,18,34),(732,'2014-01-29 11:11:28','2014-01-29 11:11:28',19,18,35),(733,'2014-01-29 11:11:28','2014-01-29 11:11:28',4,18,36),(734,'2014-01-29 11:11:28','2014-01-29 11:11:28',7,18,37),(735,'2014-01-29 11:11:28','2014-01-29 11:11:28',2,18,38),(736,'2014-01-29 11:11:28','2014-01-29 11:11:28',2,18,39),(737,'2014-01-29 11:11:28','2014-01-29 11:11:28',4,18,40),(738,'2014-01-29 11:11:28','2014-01-29 11:11:28',8,18,41),(739,'2014-01-29 11:11:30','2014-01-29 11:11:30',20,19,1),(740,'2014-01-29 11:11:30','2014-01-29 11:11:30',4,19,2),(741,'2014-01-29 11:11:30','2014-01-29 11:11:30',19,19,3),(742,'2014-01-29 11:11:30','2014-01-29 11:11:30',14,19,4),(743,'2014-01-29 11:11:30','2014-01-29 11:11:30',5,19,5),(744,'2014-01-29 11:11:30','2014-01-29 11:11:30',12,19,6),(745,'2014-01-29 11:11:30','2014-01-29 11:11:30',10,19,7),(746,'2014-01-29 11:11:30','2014-01-29 11:11:30',4,19,8),(747,'2014-01-29 11:11:30','2014-01-29 11:11:30',12,19,9),(748,'2014-01-29 11:11:31','2014-01-29 11:11:31',13,19,10),(749,'2014-01-29 11:11:31','2014-01-29 11:11:31',20,19,11),(750,'2014-01-29 11:11:31','2014-01-29 11:11:31',1,19,12),(751,'2014-01-29 11:11:31','2014-01-29 11:11:31',12,19,13),(752,'2014-01-29 11:11:31','2014-01-29 11:11:31',8,19,14),(753,'2014-01-29 11:11:31','2014-01-29 11:11:31',4,19,15),(754,'2014-01-29 11:11:31','2014-01-29 11:11:31',15,19,16),(755,'2014-01-29 11:11:31','2014-01-29 11:11:31',3,19,17),(756,'2014-01-29 11:11:31','2014-01-29 11:11:31',10,19,18),(757,'2014-01-29 11:11:31','2014-01-29 11:11:31',12,19,19),(758,'2014-01-29 11:11:31','2014-01-29 11:11:31',16,19,20),(759,'2014-01-29 11:11:32','2014-01-29 11:11:32',20,19,21),(760,'2014-01-29 11:11:32','2014-01-29 11:11:32',11,19,22),(761,'2014-01-29 11:11:32','2014-01-29 11:11:32',15,19,23),(762,'2014-01-29 11:11:32','2014-01-29 11:11:32',3,19,24),(763,'2014-01-29 11:11:32','2014-01-29 11:11:32',17,19,25),(764,'2014-01-29 11:11:32','2014-01-29 11:11:32',17,19,26),(765,'2014-01-29 11:11:32','2014-01-29 11:11:32',5,19,27),(766,'2014-01-29 11:11:32','2014-01-29 11:11:32',20,19,28),(767,'2014-01-29 11:11:32','2014-01-29 11:11:32',4,19,29),(768,'2014-01-29 11:11:32','2014-01-29 11:11:32',5,19,30),(769,'2014-01-29 11:11:32','2014-01-29 11:11:32',4,19,31),(770,'2014-01-29 11:11:32','2014-01-29 11:11:32',3,19,32),(771,'2014-01-29 11:11:33','2014-01-29 11:11:33',9,19,33),(772,'2014-01-29 11:11:33','2014-01-29 11:11:33',3,19,34),(773,'2014-01-29 11:11:33','2014-01-29 11:11:33',17,19,35),(774,'2014-01-29 11:11:33','2014-01-29 11:11:33',14,19,36),(775,'2014-01-29 11:11:33','2014-01-29 11:11:33',14,19,37),(776,'2014-01-29 11:11:33','2014-01-29 11:11:33',6,19,38),(777,'2014-01-29 11:11:33','2014-01-29 11:11:33',17,19,39),(778,'2014-01-29 11:11:33','2014-01-29 11:11:33',6,19,40),(779,'2014-01-29 11:11:33','2014-01-29 11:11:33',19,19,41),(780,'2014-01-29 11:11:34','2014-01-29 11:11:34',11,20,1),(781,'2014-01-29 11:11:34','2014-01-29 11:11:34',4,20,2),(782,'2014-01-29 11:11:34','2014-01-29 11:11:34',10,20,3),(783,'2014-01-29 11:11:34','2014-01-29 11:11:34',5,20,4),(784,'2014-01-29 11:11:34','2014-01-29 11:11:34',6,20,5),(785,'2014-01-29 11:11:34','2014-01-29 11:11:34',20,20,6),(786,'2014-01-29 11:11:34','2014-01-29 11:11:34',16,20,7),(787,'2014-01-29 11:11:34','2014-01-29 11:11:34',2,20,8),(788,'2014-01-29 11:11:35','2014-01-29 11:11:35',19,20,9),(789,'2014-01-29 11:11:35','2014-01-29 11:11:35',7,20,10),(790,'2014-01-29 11:11:35','2014-01-29 11:11:35',16,20,11),(791,'2014-01-29 11:11:35','2014-01-29 11:11:35',2,20,12),(792,'2014-01-29 11:11:35','2014-01-29 11:11:35',3,20,13),(793,'2014-01-29 11:11:35','2014-01-29 11:11:35',12,20,14),(794,'2014-01-29 11:11:35','2014-01-29 11:11:35',6,20,15),(795,'2014-01-29 11:11:35','2014-01-29 11:11:35',2,20,16),(796,'2014-01-29 11:11:35','2014-01-29 11:11:35',16,20,17),(797,'2014-01-29 11:11:35','2014-01-29 11:11:35',11,20,18),(798,'2014-01-29 11:11:35','2014-01-29 11:11:35',6,20,19),(799,'2014-01-29 11:11:35','2014-01-29 11:11:35',19,20,20),(800,'2014-01-29 11:11:36','2014-01-29 11:11:36',20,20,21),(801,'2014-01-29 11:11:36','2014-01-29 11:11:36',8,20,22),(802,'2014-01-29 11:11:36','2014-01-29 11:11:36',15,20,23),(803,'2014-01-29 11:11:36','2014-01-29 11:11:36',13,20,24),(804,'2014-01-29 11:11:36','2014-01-29 11:11:36',1,20,25),(805,'2014-01-29 11:11:36','2014-01-29 11:11:36',1,20,26),(806,'2014-01-29 11:11:36','2014-01-29 11:11:36',9,20,27),(807,'2014-01-29 11:11:36','2014-01-29 11:11:36',6,20,28),(808,'2014-01-29 11:11:36','2014-01-29 11:11:36',20,20,29),(809,'2014-01-29 11:11:36','2014-01-29 11:11:36',4,20,30),(810,'2014-01-29 11:11:37','2014-01-29 11:11:37',12,20,31),(811,'2014-01-29 11:11:37','2014-01-29 11:11:37',10,20,32),(812,'2014-01-29 11:11:37','2014-01-29 11:11:37',8,20,33),(813,'2014-01-29 11:11:37','2014-01-29 11:11:37',2,20,34),(814,'2014-01-29 11:11:37','2014-01-29 11:11:37',14,20,35),(815,'2014-01-29 11:11:37','2014-01-29 11:11:37',13,20,36),(816,'2014-01-29 11:11:37','2014-01-29 11:11:37',1,20,37),(817,'2014-01-29 11:11:37','2014-01-29 11:11:37',10,20,38),(818,'2014-01-29 11:11:37','2014-01-29 11:11:37',14,20,39),(819,'2014-01-29 11:11:37','2014-01-29 11:11:37',19,20,40),(820,'2014-01-29 11:11:37','2014-01-29 11:11:37',16,20,41);
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
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2014-01-29 11:09:58','2014-01-29 11:09:58','Iam','Admin','ck','admin@ck.com','$2y$10$USEOnOSuriqiFQSyKL0tteD/BOWwdQtjaq8w9lPypm9TLpyMbXrau','',0),(2,'2014-01-29 11:09:58','2014-01-29 11:09:58','Jane','Doe','user','girl@ck.com','$2y$10$USEOnOSuriqiFQSyKL0tteD/BOWwdQtjaq8w9lPypm9TLpyMbXrau','',0);
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

-- Dump completed on 2014-01-29  3:12:15
