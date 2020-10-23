-- MySQL dump 10.13  Distrib 8.0.19, for osx10.15 (x86_64)
--
-- Host: localhost    Database: ncdmberp
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `api_resources`
--

DROP TABLE IF EXISTS `api_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_resources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GET',
  `hasParams` tinyint(1) NOT NULL DEFAULT '0',
  `version` double NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_resources_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_resources`
--

LOCK TABLES `api_resources` WRITE;
/*!40000 ALTER TABLE `api_resources` DISABLE KEYS */;
INSERT INTO `api_resources` VALUES (1,'Trainings','trainings','/individual/trainings',NULL,'GET',0,1,1,'2020-05-02 21:36:33','2020-05-02 21:36:33'),(2,'DPR','dpr','/service-company/dprs',NULL,'GET',0,1,1,'2020-05-02 22:10:06','2020-05-02 22:10:06'),(3,'Certifications','certifications','/certifications',NULL,'GET',0,1,1,'2020-05-02 22:12:05','2020-05-02 22:12:05'),(4,'Contracts','contracts','/contracts',NULL,'GET',0,1,1,'2020-05-02 22:13:55','2020-05-02 22:13:55'),(5,'Service Companies','service-companies','/service-companies',NULL,'GET',0,1,1,'2020-05-02 22:15:39','2020-05-02 22:15:39');
/*!40000 ALTER TABLE `api_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_department`
--

DROP TABLE IF EXISTS `application_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application_department` (
  `application_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`application_id`,`department_id`),
  KEY `application_department_department_id_foreign` (`department_id`),
  CONSTRAINT `application_department_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `application_department_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_department`
--

LOCK TABLES `application_department` WRITE;
/*!40000 ALTER TABLE `application_department` DISABLE KEYS */;
INSERT INTO `application_department` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `application_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `applications_label_unique` (`label`),
  UNIQUE KEY `applications_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'Structure','structure','struc',NULL,'1586104595images.png',NULL,1,'2020-04-05 15:36:35','2020-04-05 15:36:35'),(2,'Human Resource Management','human-resource-management','hrm',NULL,'1586109525hrm.png',NULL,1,'2020-04-05 16:58:45','2020-04-05 16:58:45');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint unsigned NOT NULL,
  `training_detail_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certificates_staff_id_foreign` (`staff_id`),
  KEY `certificates_training_detail_id_foreign` (`training_detail_id`),
  CONSTRAINT `certificates_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `certificates_training_detail_id_foreign` FOREIGN KEY (`training_detail_id`) REFERENCES `training_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_qualification`
--

DROP TABLE IF EXISTS `course_qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_qualification` (
  `course_id` bigint unsigned NOT NULL,
  `qualification_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`course_id`,`qualification_id`),
  KEY `course_qualification_qualification_id_foreign` (`qualification_id`),
  CONSTRAINT `course_qualification_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_qualification_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_qualification`
--

LOCK TABLES `course_qualification` WRITE;
/*!40000 ALTER TABLE `course_qualification` DISABLE KEYS */;
INSERT INTO `course_qualification` VALUES (1,1),(2,1),(3,1),(4,1),(4,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3);
/*!40000 ALTER TABLE `course_qualification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Management','management',NULL,1,'2020-04-05 18:26:32','2020-04-05 18:29:24'),(2,'Leadership','leadership',NULL,1,'2020-04-05 18:29:44','2020-04-05 18:29:44'),(3,'Executive Education','executive-education',NULL,1,'2020-04-05 18:30:06','2020-04-05 18:30:06'),(4,'Skill Acquisition','skill-acquisition',NULL,1,'2020-04-05 18:31:11','2020-04-05 18:31:11'),(5,'Workshop','workshop',NULL,1,'2020-04-05 18:34:03','2020-04-05 18:34:03'),(6,'Conference','conference',NULL,1,'2020-04-05 18:34:14','2020-04-05 18:34:14');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_page`
--

DROP TABLE IF EXISTS `department_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_page` (
  `department_id` bigint unsigned NOT NULL,
  `page_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`department_id`,`page_id`),
  KEY `department_page_page_id_foreign` (`page_id`),
  CONSTRAINT `department_page_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `department_page_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_page`
--

LOCK TABLES `department_page` WRITE;
/*!40000 ALTER TABLE `department_page` DISABLE KEYS */;
INSERT INTO `department_page` VALUES (2,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(1,10),(2,10),(2,11),(2,12),(2,13),(2,14),(2,16);
/*!40000 ALTER TABLE `department_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_trainings`
--

DROP TABLE IF EXISTS `department_trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_trainings` (
  `department_id` bigint unsigned NOT NULL,
  `training_detail_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`department_id`,`training_detail_id`),
  KEY `department_trainings_training_detail_id_foreign` (`training_detail_id`),
  CONSTRAINT `department_trainings_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `department_trainings_training_detail_id_foreign` FOREIGN KEY (`training_detail_id`) REFERENCES `training_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_trainings`
--

LOCK TABLES `department_trainings` WRITE;
/*!40000 ALTER TABLE `department_trainings` DISABLE KEYS */;
INSERT INTO `department_trainings` VALUES (2,8);
/*!40000 ALTER TABLE `department_trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_user`
--

DROP TABLE IF EXISTS `department_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_user` (
  `department_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`department_id`,`user_id`),
  KEY `department_user_user_id_foreign` (`user_id`),
  CONSTRAINT `department_user_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `department_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_user`
--

LOCK TABLES `department_user` WRITE;
/*!40000 ALTER TABLE `department_user` DISABLE KEYS */;
INSERT INTO `department_user` VALUES (1,1),(2,1),(1,2),(2,2);
/*!40000 ALTER TABLE `department_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vocabulary_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_label_unique` (`label`),
  UNIQUE KEY `departments_code_unique` (`code`),
  KEY `departments_vocabulary_id_foreign` (`vocabulary_id`),
  CONSTRAINT `departments_vocabulary_id_foreign` FOREIGN KEY (`vocabulary_id`) REFERENCES `vocabularies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,1,'Executive Secretary Office','executive-secretary-office','ESO',0,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(2,3,'Information Communication Technology','information-communication-technology','ICT',1,'2020-04-05 15:32:13','2020-04-05 15:32:13');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grades_label_unique` (`label`),
  UNIQUE KEY `grades_level_unique` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (1,'Officer III','officer-iii','SS7','2020-04-05 15:32:13','2020-04-05 15:32:13'),(2,'Officer II','officer-ii','SS6','2020-04-05 15:32:13','2020-04-05 15:32:13'),(3,'Officer I','officer-i','SS5','2020-04-05 15:32:13','2020-04-05 15:32:13'),(4,'Senior Officer','senior-officer','SS4','2020-04-05 15:32:13','2020-04-05 15:32:13'),(5,'Supervisor','supervisor','SS3','2020-04-05 15:32:13','2020-04-05 15:32:13'),(6,'Senior Supervisor','senior-supervisor','SS2','2020-04-05 15:32:13','2020-04-05 15:32:13'),(7,'Chief Officer','chief-officer','SS1','2020-04-05 15:32:13','2020-04-05 15:32:13'),(8,'Deputy Manager','deputy-manager','M6','2020-04-05 15:32:13','2020-04-05 15:32:13'),(9,'Manager','manager','M5','2020-04-05 15:32:13','2020-04-05 15:32:13'),(10,'General Manager','general-manager','M4','2020-04-05 15:32:13','2020-04-05 15:32:13'),(11,'Director','director','M3','2020-04-05 15:32:13','2020-04-05 15:32:13'),(12,'Executive Secretary','executive-secretary','M2','2020-04-05 15:32:13','2020-04-05 15:32:13');
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_module`
--

DROP TABLE IF EXISTS `group_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_module` (
  `group_id` bigint unsigned NOT NULL,
  `module_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`module_id`),
  KEY `group_module_module_id_foreign` (`module_id`),
  CONSTRAINT `group_module_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_module`
--

LOCK TABLES `group_module` WRITE;
/*!40000 ALTER TABLE `group_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_permission`
--

DROP TABLE IF EXISTS `group_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_permission` (
  `group_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `group_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `group_permission_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_permission`
--

LOCK TABLES `group_permission` WRITE;
/*!40000 ALTER TABLE `group_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group_user` (
  `group_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `group_user_user_id_foreign` (`user_id`),
  CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user`
--

LOCK TABLES `group_user` WRITE;
/*!40000 ALTER TABLE `group_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_label_unique` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inCommission` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Opolo','opolo','Bayelsa',1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(2,'Onopa','onopa','Bayelsa',1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(3,'Central Business District','central-business-district','Abuja',1,'2020-04-05 15:32:13','2020-04-05 15:32:13');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `majors`
--

DROP TABLE IF EXISTS `majors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `majors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `majors_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `majors`
--

LOCK TABLES `majors` WRITE;
/*!40000 ALTER TABLE `majors` DISABLE KEYS */;
INSERT INTO `majors` VALUES (1,'Finance','finance',1,'2020-04-05 22:30:13','2020-04-05 22:30:33'),(2,'ICT','ict',1,'2020-04-05 22:30:40','2020-04-05 22:30:40'),(3,'HR','hr',1,'2020-04-05 22:30:47','2020-04-05 22:30:47');
/*!40000 ALTER TABLE `majors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (32,'2014_10_12_000000_create_users_table',1),(33,'2014_10_12_100000_create_password_resets_table',1),(34,'2019_08_19_000000_create_failed_jobs_table',1),(35,'2020_03_17_123639_add_column_to_users_table',1),(36,'2020_03_17_123952_create_locations_table',1),(37,'2020_03_17_124056_create_grades_table',1),(38,'2020_03_17_185606_create_vocabularies_table',1),(39,'2020_03_17_202054_create_departments_table',1),(40,'2020_03_17_215124_create_roles_table',1),(41,'2020_03_17_223228_create_permissions_table',1),(42,'2020_03_17_231050_create_applications_table',1),(43,'2020_03_18_050307_create_modules_table',1),(44,'2020_03_19_044748_create_pages_table',1),(45,'2020_03_19_120418_create_groups_table',1),(46,'2020_03_19_123205_create_department_user_pivot_table',1),(47,'2020_03_19_123240_create_role_user_pivot_table',1),(48,'2020_03_19_123253_create_group_user_pivot_table',1),(49,'2020_03_19_123408_create_application_department_pivot_table',1),(50,'2020_03_19_123508_create_group_module_pivot_table',1),(51,'2020_03_19_123536_create_permission_role_pivot_table',1),(52,'2020_03_19_123550_create_group_permission_pivot_table',1),(53,'2020_03_19_123609_create_page_role_pivot_table',1),(54,'2020_03_22_003616_add_menu_column_to_pages',1),(55,'2020_03_23_151540_create_trainings_table',1),(56,'2020_03_30_140919_create_department_page_pivot_table',1),(57,'2020_04_02_123144_create_training_details_table',1),(58,'2020_04_02_123436_create_training_user_pivot_table',1),(59,'2020_04_05_154531_create_qualifications_table',1),(60,'2020_04_05_154750_create_courses_table',1),(61,'2020_04_05_154959_create_majors_table',1),(62,'2020_04_05_155519_create_course_qualification_pivot_table',1),(63,'2020_04_07_033543_create_staff_training_table',2),(64,'2020_04_09_045715_create_certificates_table',3),(66,'2020_04_09_144728_create_nominations_table',4),(67,'2020_04_14_144955_create_department_trainingdetail_pivot_table',5),(68,'2020_04_21_005453_create_notifications_table',6),(70,'2020_05_02_131005_create_api_resources_table',7),(73,'2020_05_04_005926_create_deliverables_table',8),(74,'2020_05_04_000426_create_tasks_table',9),(75,'2020_05_04_005926_create_milestones_table',9),(76,'2020_05_06_120321_create_nuggets_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `milestones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL DEFAULT '1',
  `weight` int NOT NULL DEFAULT '0',
  `progress` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `measurables` longtext COLLATE utf8mb4_unicode_ci,
  `deliverables` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `milestones_label_unique` (`label`),
  KEY `milestones_task_id_foreign` (`task_id`),
  CONSTRAINT `milestones_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `milestones`
--

LOCK TABLES `milestones` WRITE;
/*!40000 ALTER TABLE `milestones` DISABLE KEYS */;
/*!40000 ALTER TABLE `milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_label_unique` (`label`),
  UNIQUE KEY `modules_code_unique` (`code`),
  KEY `modules_application_id_foreign` (`application_id`),
  CONSTRAINT `modules_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,1,'Administration','administration','admin',NULL,'1586104635images.png',NULL,1,'2020-04-05 15:37:15','2020-04-05 15:37:15'),(2,2,'Learning & Development','learning-development','lnd',NULL,'1586109552learning.png',NULL,1,'2020-04-05 16:59:12','2020-04-05 16:59:12'),(3,1,'API Integrations','api-integrations','APIs',NULL,'1588456689just_brain_logo.png',NULL,1,'2020-05-02 20:58:09','2020-05-02 21:02:15');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nominations`
--

DROP TABLE IF EXISTS `nominations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nominations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint unsigned NOT NULL,
  `training_detail_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `flow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manager',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approval` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `instruction` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nominations_staff_id_foreign` (`staff_id`),
  KEY `nominations_training_detail_id_foreign` (`training_detail_id`),
  KEY `nominations_department_id_foreign` (`department_id`),
  CONSTRAINT `nominations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nominations_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `nominations_training_detail_id_foreign` FOREIGN KEY (`training_detail_id`) REFERENCES `training_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nominations`
--

LOCK TABLES `nominations` WRITE;
/*!40000 ALTER TABLE `nominations` DISABLE KEYS */;
INSERT INTO `nominations` VALUES (14,1,8,2,'He can go','hr','approved',1,1,0,'2020-04-15 13:02:19','2020-04-15 13:04:59');
/*!40000 ALTER TABLE `nominations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('4e7035e8-c3ec-4a6e-9e0d-2b6ae8da9d2e','App\\Notifications\\TrainingCategorised','App\\User',1,'{\"type\":\"training\",\"trainingID\":10,\"title\":\"Visual Studio MVC C Sharp\",\"status\":\"archived\",\"start_date\":\"19 Nov\",\"duration\":\"5 days\"}',NULL,'2020-04-27 04:41:59','2020-04-27 04:41:59'),('574a8d01-debb-400f-b849-3afd4d46eac0','App\\Notifications\\TrainingCategorised','App\\User',1,'{\"type\":\"training\",\"trainingID\":9,\"title\":\"Oracle Application Express v5.0\",\"status\":\"archived\",\"start_date\":\"2020-01-27T00:00:00.000000Z\",\"duration\":\"5 days\"}',NULL,'2020-04-21 10:55:35','2020-04-21 10:55:35'),('ede23475-7141-46dd-9acd-c31dabe2f7ac','App\\Notifications\\TrainingCategorised','App\\User',2,'{\"type\":\"training\",\"trainingID\":9,\"title\":\"Oracle Application Express v5.0\",\"status\":\"archived\",\"start_date\":\"2020-01-27T00:00:00.000000Z\",\"duration\":\"5 days\"}',NULL,'2020-04-21 10:56:03','2020-04-21 10:56:03');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuggets`
--

DROP TABLE IF EXISTS `nuggets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nuggets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `api_resource_id` bigint unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `deny` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nuggets_key_unique` (`key`),
  KEY `nuggets_api_resource_id_foreign` (`api_resource_id`),
  CONSTRAINT `nuggets_api_resource_id_foreign` FOREIGN KEY (`api_resource_id`) REFERENCES `api_resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuggets`
--

LOCK TABLES `nuggets` WRITE;
/*!40000 ALTER TABLE `nuggets` DISABLE KEYS */;
INSERT INTO `nuggets` VALUES (1,5,'id',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(2,5,'org_name',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(3,5,'category',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(4,5,'nse_status',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(5,5,'rc_no',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(6,5,'email',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(7,5,'dpr_no',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(8,5,'tel',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(9,5,'phone',NULL,1,1,0,0,0,0,'2020-05-06 11:53:13','2020-05-06 11:53:13'),(10,5,'staff_local',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(11,5,'total_shares',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(12,5,'facility_loc',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(13,5,'facility',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(14,5,'address',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(15,5,'photo',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(16,5,'status',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(17,5,'wf_group_id',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(18,5,'staff_foreign',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(19,5,'tin',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(20,5,'date_of_incorporation',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(21,5,'assigned_shares',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(22,5,'crm_sc_id',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(23,5,'nogic_unique_id',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(24,5,'created_at',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(25,5,'updated_at',NULL,1,1,0,0,0,0,'2020-05-06 11:53:14','2020-05-06 11:53:14'),(26,4,'title',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(27,4,'contract_number',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(28,4,'currency',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(29,4,'amount',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(30,4,'award_date',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(31,4,'commence_date',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(32,4,'completion_date',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(33,4,'contract_status',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(34,4,'description',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(35,4,'project',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(36,4,'contractor',NULL,1,1,0,0,0,0,'2020-05-06 12:13:44','2020-05-06 12:13:44'),(37,3,'individual_id',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(38,3,'name',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(39,3,'category_id',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(40,3,'type_id',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(41,3,'c_no',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(42,3,'year',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(43,3,'wf_case_id',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(44,3,'exp_year',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(45,3,'certificate',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(46,3,'category_name',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(47,3,'type',NULL,1,1,0,0,0,0,'2020-05-06 12:14:38','2020-05-06 12:14:38'),(48,2,'dpr_number',NULL,1,1,0,0,0,0,'2020-05-06 12:14:51','2020-05-06 12:14:51'),(49,2,'dpr_certificate',NULL,1,1,0,0,0,0,'2020-05-06 12:14:51','2020-05-06 12:14:51'),(50,2,'expiry_date',NULL,1,1,0,0,0,0,'2020-05-06 12:14:51','2020-05-06 12:14:51'),(51,2,'company',NULL,1,1,0,0,0,0,'2020-05-06 12:14:51','2020-05-06 12:14:51'),(52,1,'org',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00'),(53,1,'country_id',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00'),(54,1,'duration',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00'),(55,1,'training_date',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00'),(56,1,'is_ncdmb_sponsored',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00'),(57,1,'country',NULL,1,1,0,0,0,0,'2020-05-06 12:15:00','2020-05-06 12:15:00');
/*!40000 ALTER TABLE `nuggets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_role`
--

DROP TABLE IF EXISTS `page_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_role` (
  `page_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`role_id`),
  KEY `page_role_role_id_foreign` (`role_id`),
  CONSTRAINT `page_role_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_role`
--

LOCK TABLES `page_role` WRITE;
/*!40000 ALTER TABLE `page_role` DISABLE KEYS */;
INSERT INTO `page_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(16,1),(10,2);
/*!40000 ALTER TABLE `page_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` tinyint(1) NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_label_unique` (`label`),
  KEY `pages_module_id_foreign` (`module_id`),
  CONSTRAINT `pages_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,1,'Staff Management','staff-management','icon-users','staffs.index','/staffs','_self',NULL,1,1,'2020-04-05 15:37:55','2020-04-05 15:37:55'),(2,1,'Role Management','role-management','icon-settings','roles.index','/roles','_self',NULL,1,1,'2020-04-05 15:39:11','2020-04-05 15:39:11'),(3,1,'Grade Levels','grade-levels','icon-layout','grades.index','/grades','_self',NULL,1,1,'2020-04-05 15:40:22','2020-04-05 15:40:22'),(4,1,'Locations','locations','icon-maps','locations.index','/locations','_self',NULL,1,1,'2020-04-05 15:40:51','2020-04-05 15:40:51'),(5,1,'Departments','departments','icon-company','departments.index','/departments','_self',NULL,1,1,'2020-04-05 15:41:43','2020-04-05 15:41:43'),(6,1,'Vocabularies','vocabularies','icon-metrics','vocabularies.index','/vocabularies','_self',NULL,1,1,'2020-04-05 15:42:22','2020-04-05 15:42:22'),(7,2,'Qualifications','qualifications','icon-listall','qualifications.index','/qualifications','_self',NULL,1,1,'2020-04-05 17:17:28','2020-04-05 17:17:28'),(8,2,'Courses','courses','icon-crypto','courses.index','/courses','_self',NULL,1,1,'2020-04-05 18:25:26','2020-04-05 18:25:26'),(9,2,'Course Majors','course-majors','icon-modal','majors.index','/majors','_self',NULL,1,1,'2020-04-05 22:29:27','2020-04-05 22:29:27'),(10,2,'Trainings','trainings','icon-metrics','trainings.index','/trainings','_self',NULL,1,1,'2020-04-05 23:18:43','2020-04-05 23:18:43'),(11,2,'Categorise','categorise','icon-navs-and-tabs','uncategorise.trainings','/uncategorised/trainings','_self',NULL,1,1,'2020-04-09 07:33:07','2020-04-09 07:33:07'),(12,2,'Nominate Staff','nominate-staff','icon-contacts-app','nominations.create','/nominations/create','_self',NULL,1,1,'2020-04-09 14:41:45','2020-04-11 08:26:59'),(13,2,'HR Nominations','hr-nominations','icon-wall','hr.nominations','/hr/nominations','_self',NULL,1,1,'2020-04-12 23:09:44','2020-04-12 23:09:44'),(14,2,'Manage Nominations','manage-nominations','icon-scrollspy','manage.nominations','/manage/nominations','_self',NULL,1,1,'2020-04-13 13:31:57','2020-04-13 18:55:38'),(16,3,'Nogic Consumables','nogic-consumables','icon-listall','apiResources.index','/apiResources','_self',NULL,1,1,'2020-05-02 21:01:34','2020-05-02 21:01:34');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(113,1),(114,1),(115,1),(116,1),(117,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(130,1),(131,1),(132,1),(133,1),(134,1),(135,1),(136,1),(137,1),(138,1),(139,1),(140,1),(141,1),(142,1),(143,1),(144,1),(145,1),(146,1),(147,1),(148,1),(149,1),(150,1),(151,1),(152,1),(153,1),(154,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'application',
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse struc','browse-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(2,'read struc','read-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(3,'edit struc','edit-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(4,'add struc','add-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(5,'delete struc','delete-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(6,'manage struc','manage-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(7,'approve struc','approve-struc','application','struc','applications','2020-04-05 15:36:35','2020-04-05 15:36:35'),(8,'browse admin','browse-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(9,'read admin','read-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(10,'edit admin','edit-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(11,'add admin','add-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(12,'delete admin','delete-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(13,'manage admin','manage-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(14,'approve admin','approve-admin','module','admin','modules','2020-04-05 15:37:15','2020-04-05 15:37:15'),(15,'browse staff-management','browse-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(16,'read staff-management','read-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(17,'edit staff-management','edit-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(18,'add staff-management','add-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(19,'delete staff-management','delete-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(20,'manage staff-management','manage-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(21,'approve staff-management','approve-staff-management','page','staff-management','pages','2020-04-05 15:37:55','2020-04-05 15:37:55'),(22,'browse role-management','browse-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(23,'read role-management','read-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(24,'edit role-management','edit-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(25,'add role-management','add-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(26,'delete role-management','delete-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(27,'manage role-management','manage-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(28,'approve role-management','approve-role-management','page','role-management','pages','2020-04-05 15:39:11','2020-04-05 15:39:11'),(29,'browse grade-levels','browse-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(30,'read grade-levels','read-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(31,'edit grade-levels','edit-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(32,'add grade-levels','add-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(33,'delete grade-levels','delete-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(34,'manage grade-levels','manage-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(35,'approve grade-levels','approve-grade-levels','page','grade-levels','pages','2020-04-05 15:40:22','2020-04-05 15:40:22'),(36,'browse locations','browse-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(37,'read locations','read-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(38,'edit locations','edit-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(39,'add locations','add-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(40,'delete locations','delete-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(41,'manage locations','manage-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(42,'approve locations','approve-locations','page','locations','pages','2020-04-05 15:40:51','2020-04-05 15:40:51'),(43,'browse departments','browse-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(44,'read departments','read-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(45,'edit departments','edit-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(46,'add departments','add-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(47,'delete departments','delete-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(48,'manage departments','manage-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(49,'approve departments','approve-departments','page','departments','pages','2020-04-05 15:41:43','2020-04-05 15:41:43'),(50,'browse vocabularies','browse-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(51,'read vocabularies','read-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(52,'edit vocabularies','edit-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(53,'add vocabularies','add-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(54,'delete vocabularies','delete-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(55,'manage vocabularies','manage-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(56,'approve vocabularies','approve-vocabularies','page','vocabularies','pages','2020-04-05 15:42:22','2020-04-05 15:42:22'),(57,'browse hrm','browse-hrm','application','hrm','applications','2020-04-05 16:58:45','2020-04-05 16:58:45'),(58,'read hrm','read-hrm','application','hrm','applications','2020-04-05 16:58:45','2020-04-05 16:58:45'),(59,'edit hrm','edit-hrm','application','hrm','applications','2020-04-05 16:58:45','2020-04-05 16:58:45'),(60,'add hrm','add-hrm','application','hrm','applications','2020-04-05 16:58:45','2020-04-05 16:58:45'),(61,'delete hrm','delete-hrm','application','hrm','applications','2020-04-05 16:58:45','2020-04-05 16:58:45'),(62,'manage hrm','manage-hrm','application','hrm','applications','2020-04-05 16:58:46','2020-04-05 16:58:46'),(63,'approve hrm','approve-hrm','application','hrm','applications','2020-04-05 16:58:46','2020-04-05 16:58:46'),(64,'browse lnd','browse-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(65,'read lnd','read-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(66,'edit lnd','edit-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(67,'add lnd','add-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(68,'delete lnd','delete-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(69,'manage lnd','manage-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(70,'approve lnd','approve-lnd','module','lnd','modules','2020-04-05 16:59:12','2020-04-05 16:59:12'),(71,'browse qualifications','browse-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(72,'read qualifications','read-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(73,'edit qualifications','edit-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(74,'add qualifications','add-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(75,'delete qualifications','delete-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(76,'manage qualifications','manage-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(77,'approve qualifications','approve-qualifications','page','qualifications','pages','2020-04-05 17:17:28','2020-04-05 17:17:28'),(78,'browse courses','browse-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(79,'read courses','read-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(80,'edit courses','edit-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(81,'add courses','add-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(82,'delete courses','delete-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(83,'manage courses','manage-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(84,'approve courses','approve-courses','page','courses','pages','2020-04-05 18:25:26','2020-04-05 18:25:26'),(85,'browse course-majors','browse-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(86,'read course-majors','read-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(87,'edit course-majors','edit-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(88,'add course-majors','add-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(89,'delete course-majors','delete-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(90,'manage course-majors','manage-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(91,'approve course-majors','approve-course-majors','page','course-majors','pages','2020-04-05 22:29:27','2020-04-05 22:29:27'),(92,'browse trainings','browse-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(93,'read trainings','read-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(94,'edit trainings','edit-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(95,'add trainings','add-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(96,'delete trainings','delete-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(97,'manage trainings','manage-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(98,'approve trainings','approve-trainings','page','trainings','pages','2020-04-05 23:18:43','2020-04-05 23:18:43'),(99,'browse categorise','browse-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(100,'read categorise','read-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(101,'edit categorise','edit-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(102,'add categorise','add-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(103,'delete categorise','delete-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(104,'manage categorise','manage-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(105,'approve categorise','approve-categorise','page','categorise','pages','2020-04-09 07:33:07','2020-04-09 07:33:07'),(113,'browse nominate-staff','browse-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(114,'read nominate-staff','read-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(115,'edit nominate-staff','edit-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(116,'add nominate-staff','add-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(117,'delete nominate-staff','delete-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(118,'manage nominate-staff','manage-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(119,'approve nominate-staff','approve-nominate-staff','page','nominate-staff','pages','2020-04-11 08:26:59','2020-04-11 08:26:59'),(120,'browse hr-nominations','browse-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(121,'read hr-nominations','read-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(122,'edit hr-nominations','edit-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(123,'add hr-nominations','add-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(124,'delete hr-nominations','delete-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(125,'manage hr-nominations','manage-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(126,'approve hr-nominations','approve-hr-nominations','page','hr-nominations','pages','2020-04-12 23:09:44','2020-04-12 23:09:44'),(127,'browse manage-nominations','browse-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(128,'read manage-nominations','read-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(129,'edit manage-nominations','edit-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(130,'add manage-nominations','add-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(131,'delete manage-nominations','delete-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(132,'manage manage-nominations','manage-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(133,'approve manage-nominations','approve-manage-nominations','page','manage-nominations','pages','2020-04-13 13:31:57','2020-04-13 13:31:57'),(134,'browse nominations','browse-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(135,'read nominations','read-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(136,'edit nominations','edit-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(137,'add nominations','add-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(138,'delete nominations','delete-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(139,'manage nominations','manage-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(140,'approve nominations','approve-nominations','page','nominations','pages','2020-04-15 14:45:01','2020-04-15 14:45:01'),(141,'browse APIs','browse-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(142,'read APIs','read-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(143,'edit APIs','edit-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(144,'add APIs','add-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(145,'delete APIs','delete-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(146,'manage APIs','manage-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(147,'approve APIs','approve-apis','module','APIs','modules','2020-05-02 20:58:09','2020-05-02 20:58:09'),(148,'browse nogic-consumables','browse-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:34','2020-05-02 21:01:34'),(149,'read nogic-consumables','read-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35'),(150,'edit nogic-consumables','edit-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35'),(151,'add nogic-consumables','add-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35'),(152,'delete nogic-consumables','delete-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35'),(153,'manage nogic-consumables','manage-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35'),(154,'approve nogic-consumables','approve-nogic-consumables','page','nogic-consumables','pages','2020-05-02 21:01:35','2020-05-02 21:01:35');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualifications`
--

DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qualifications_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualifications`
--

LOCK TABLES `qualifications` WRITE;
/*!40000 ALTER TABLE `qualifications` DISABLE KEYS */;
INSERT INTO `qualifications` VALUES (1,'Diploma','diploma',185,NULL,1,'2020-04-05 17:17:48','2020-04-05 17:27:11'),(2,'Degree','degree',365,NULL,1,'2020-04-05 17:18:11','2020-04-05 17:26:42'),(3,'Certificate','certificate',3,NULL,1,'2020-04-05 17:18:22','2020-04-05 17:26:20');
/*!40000 ALTER TABLE `qualifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(2,1),(2,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','administrator',1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(2,'Staff','staff',1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(3,'User','user',1,'2020-04-05 15:32:13','2020-04-05 15:32:13');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_trainings`
--

DROP TABLE IF EXISTS `staff_trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_trainings` (
  `user_id` bigint unsigned NOT NULL,
  `training_detail_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`training_detail_id`),
  KEY `staff_trainings_training_detail_id_foreign` (`training_detail_id`),
  CONSTRAINT `staff_trainings_training_detail_id_foreign` FOREIGN KEY (`training_detail_id`) REFERENCES `training_details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `staff_trainings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_trainings`
--

LOCK TABLES `staff_trainings` WRITE;
/*!40000 ALTER TABLE `staff_trainings` DISABLE KEYS */;
INSERT INTO `staff_trainings` VALUES (1,8),(1,9),(2,9),(1,10),(1,11),(1,12);
/*!40000 ALTER TABLE `staff_trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period_year` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL DEFAULT '0',
  `weight` int NOT NULL DEFAULT '0',
  `target` int NOT NULL DEFAULT '0',
  `progress` int NOT NULL DEFAULT '0',
  `activation_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tasks_label_unique` (`label`),
  UNIQUE KEY `tasks_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_details`
--

DROP TABLE IF EXISTS `training_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `training_id` bigint unsigned NOT NULL,
  `qualification_id` bigint NOT NULL DEFAULT '0',
  `course_id` bigint NOT NULL DEFAULT '0',
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ncdmb',
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'archived',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorised` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_details_training_id_foreign` (`training_id`),
  CONSTRAINT `training_details_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_details`
--

LOCK TABLES `training_details` WRITE;
/*!40000 ALTER TABLE `training_details` DISABLE KEYS */;
INSERT INTO `training_details` VALUES (8,14,3,4,'Jetlinks','local','Oniru, Lekki Phase 1','2020-08-03','2020-08-07','ncdmb',NULL,'scheduled','approved',NULL,0,0,'2020-04-15 13:02:19','2020-04-15 13:04:59'),(9,15,3,4,'Protech International','international','Dubai, UAE','2020-01-27','2020-01-31','ncdmb',NULL,'archived','completed',NULL,1,1,'2020-04-21 10:25:15','2020-04-21 10:55:29'),(10,16,3,4,'Jetlinks','local','Oniru, Lekki Phase 1','2018-11-19','2018-11-23','ncdmb',NULL,'archived','completed',NULL,1,1,'2020-04-26 19:16:30','2020-04-27 04:41:56'),(11,17,3,4,'Fedlinks','local','Lagos','2020-07-27','2020-07-31','ncdmb',NULL,'archived','completed',NULL,0,1,'2020-07-10 10:11:54','2020-07-10 10:11:54'),(12,18,3,4,'Jetlinks','local','Lagos','2020-04-06','2020-04-10','ncdmb',NULL,'archived','completed',NULL,0,1,'2020-07-11 17:48:19','2020-07-11 17:48:19');
/*!40000 ALTER TABLE `training_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training_user`
--

DROP TABLE IF EXISTS `training_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `training_user` (
  `training_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`training_id`,`user_id`),
  KEY `training_user_user_id_foreign` (`user_id`),
  CONSTRAINT `training_user_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `training_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training_user`
--

LOCK TABLES `training_user` WRITE;
/*!40000 ALTER TABLE `training_user` DISABLE KEYS */;
INSERT INTO `training_user` VALUES (14,1),(15,1),(16,1),(17,1),(18,1),(15,2);
/*!40000 ALTER TABLE `training_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trainings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `major_id` bigint NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trainings_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings`
--

LOCK TABLES `trainings` WRITE;
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
INSERT INTO `trainings` VALUES (14,2,'Java 8 Programming','java-8-programming','2020-04-15 13:02:19','2020-04-15 13:02:19'),(15,2,'Oracle Application Express v5.0','oracle-application-express-v50','2020-04-21 10:24:38','2020-04-21 10:24:38'),(16,2,'Visual Studio MVC C Sharp','visual-studio-mvc-c-sharp','2020-04-26 19:15:05','2020-04-26 19:15:05'),(17,1,'Test Training','test-training','2020-07-10 10:08:40','2020-07-10 10:08:40'),(18,2,'Testing Another','testing-another','2020-07-11 17:46:19','2020-07-11 17:46:19');
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'opolo',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'permanent',
  `office_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `date_joined` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_staff_no_unique` (`staff_no`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'18290','SS5','Ekaro, Bobby Tamunotonye','bobby.ekaro@ncdmb.gov.ng','08094836184','onopa','permanent','305','1586228992me.jpg','available','2018-08-06',1,NULL,'$2y$10$aqBSckSlMHOon0SNGL6bnead/s8SC.ZirUX6YHrT1/tZL62FNri8a',NULL,'2020-04-05 15:32:13','2020-04-07 02:09:52'),(2,'11234','SS2','Jerry Atabong','jerry.atabong@ncdmb.gov.ng','08159275432','opolo','permanent','104',NULL,'available','2013-02-12',1,NULL,'$2y$10$/wB3RA54.e/a0eqCPyCpNu7zMzg.zopkLwTMjQ03dCuCCFjwVITom',NULL,'2020-04-09 01:43:51','2020-04-09 01:43:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vocabularies`
--

DROP TABLE IF EXISTS `vocabularies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vocabularies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executive` bigint NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vocabularies_label_unique` (`label`),
  UNIQUE KEY `vocabularies_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vocabularies`
--

LOCK TABLES `vocabularies` WRITE;
/*!40000 ALTER TABLE `vocabularies` DISABLE KEYS */;
INSERT INTO `vocabularies` VALUES (1,'Directorate','directorate','dir',11,1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(2,'Division','division','div',10,1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(3,'Department','department','dept',9,1,'2020-04-05 15:32:13','2020-04-05 15:32:13'),(4,'Unit','unit','unit',5,1,'2020-04-05 15:32:13','2020-04-05 15:32:13');
/*!40000 ALTER TABLE `vocabularies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-11 20:06:02
