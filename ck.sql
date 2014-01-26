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
  CONSTRAINT `categories_datasheet_id_foreign` FOREIGN KEY (`datasheet_id`) REFERENCES `datasheets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2014-01-26 07:08:30','2014-01-26 07:08:30','Beach Uses',1),(2,'2014-01-26 07:08:30','2014-01-26 07:08:30','Ocean Uses',1),(3,'2014-01-26 07:08:30','2014-01-26 07:08:30','General Pollution Issues',1);
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
INSERT INTO `datasheets` VALUES (1,'2014-01-26 07:08:30','2014-01-26 07:08:30','Default');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,'2014-01-26 07:08:30','2014-01-26 07:08:30','Resting Leisure',1),(2,'2014-01-26 07:08:30','2014-01-26 07:08:30','Active or Sporting Leisure',1),(3,'2014-01-26 07:08:30','2014-01-26 07:08:30','Walking or Running',1),(4,'2014-01-26 07:08:30','2014-01-26 07:08:30','Picnic or Grilling',1),(5,'2014-01-26 07:08:30','2014-01-26 07:08:30','Domestic Animals',1),(6,'2014-01-26 07:08:30','2014-01-26 07:08:30','Surfing or Swimming',2),(7,'2014-01-26 07:08:30','2014-01-26 07:08:30','ACTIVE Shore Fishing',2),(8,'2014-01-26 07:08:30','2014-01-26 07:08:30','Recreational Boating',2),(9,'2014-01-26 07:08:30','2014-01-26 07:08:30','Commercial Boating',2),(10,'2014-01-26 07:08:30','2014-01-26 07:08:30','ACTIVE Commercial Boating',2),(11,'2014-01-26 07:08:30','2014-01-26 07:08:30','ACTIVE Recreational Boat Fishing',2),(12,'2014-01-26 07:08:30','2014-01-26 07:08:30','Diving',2),(13,'2014-01-26 07:08:30','2014-01-26 07:08:30','Kelp Harvesting',2),(14,'2014-01-26 07:08:30','2014-01-26 07:08:30','Runoff',3),(15,'2014-01-26 07:08:30','2014-01-26 07:08:30','Open Dumpster',3),(16,'2014-01-26 07:08:30','2014-01-26 07:08:30','Cigarette Butts',3),(17,'2014-01-26 07:08:30','2014-01-26 07:08:30','Animal Droppings',3),(18,'2014-01-26 07:08:30','2014-01-26 07:08:30','Litter',3);
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
INSERT INTO `locations` VALUES (1,'2014-01-26 07:08:29','2014-01-26 07:08:29','Matlahuayl SMR',1),(2,'2014-01-26 07:08:29','2014-01-26 07:08:29','South La Jolla SMR',1);
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
INSERT INTO `migrations` VALUES ('2014_01_23_071000_create_tallies_table',1),('2014_01_23_071001_create_segments_table',1),('2014_01_23_071002_create_sections_table',1),('2014_01_23_071003_create_patrols_table',1),('2014_01_23_071004_create_locations_table',1),('2014_01_23_071005_create_fields_table',1),('2014_01_23_071006_create_categories_table',1),('2014_01_23_071007_create_datasheets_table',1),('2014_01_23_071159_create_users_table',1),('2014_01_23_071210_create_foreign_keys',1),('2014_01_24_195440_add_confide_user',1),('2014_01_24_220656_entrust_setup_tables',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patrols`
--

LOCK TABLES `patrols` WRITE;
/*!40000 ALTER TABLE `patrols` DISABLE KEYS */;
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
INSERT INTO `permissions` VALUES (1,'can_patrol','Can patrol','2014-01-26 07:08:28','2014-01-26 07:08:28'),(2,'can_manage','Can manage','2014-01-26 07:08:29','2014-01-26 07:08:29');
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
INSERT INTO `roles` VALUES (1,'Admin','2014-01-26 07:08:28','2014-01-26 07:08:28'),(2,'Volunteer','2014-01-26 07:08:28','2014-01-26 07:08:28');
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
  CONSTRAINT `sections_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'2014-01-26 07:08:29','2014-01-26 07:08:29','Scripps Pier to Tower 31',1),(2,'2014-01-26 07:08:29','2014-01-26 07:08:29','Tower 31 to Boat Launch',1),(3,'2014-01-26 07:08:29','2014-01-26 07:08:29','Boat Launch to Coastal Access',1),(4,'2014-01-26 07:08:29','2014-01-26 07:08:29','Coast Walk Lookout',1),(5,'2014-01-26 07:08:29','2014-01-26 07:08:29','Point La Jolla / Bridge Club',1),(6,'2014-01-26 07:08:29','2014-01-26 07:08:29','Palomar Street',2),(7,'2014-01-26 07:08:29','2014-01-26 07:08:29','Costa and Chelsea Viewpoint',2),(8,'2014-01-26 07:08:29','2014-01-26 07:08:29','Hermosa Park',2),(9,'2014-01-26 07:08:29','2014-01-26 07:08:29','Forward Street Viewpoint',2),(10,'2014-01-26 07:08:29','2014-01-26 07:08:29','Calumet Park',2),(11,'2014-01-26 07:08:29','2014-01-26 07:08:29','Tourmaline Surf Park',2),(12,'2014-01-26 07:08:29','2014-01-26 07:08:29','Tourmaline to Diamond Street Beach Walk',2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segments`
--

LOCK TABLES `segments` WRITE;
/*!40000 ALTER TABLE `segments` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallies`
--

LOCK TABLES `tallies` WRITE;
/*!40000 ALTER TABLE `tallies` DISABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'2014-01-26 07:08:30','2014-01-26 07:08:30','Iam','Admin','ck','admin@ck.com','$2y$10$5bm5cIFloHMfyHRvVXbttuQAPA6vVVKpLYiNTCC9F4VKsVafv2b7C','',0),(2,'2014-01-26 07:08:30','2014-01-26 07:08:30','Jane','Doe','user','girl@ck.com','$2y$10$5bm5cIFloHMfyHRvVXbttuQAPA6vVVKpLYiNTCC9F4VKsVafv2b7C','',0);
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

-- Dump completed on 2014-01-25 23:23:02
