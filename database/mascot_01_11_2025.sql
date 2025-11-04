-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: Mascot
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.2

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
-- Table structure for table `batch_lead_tbl`
--

DROP TABLE IF EXISTS `batch_lead_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batch_lead_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned NOT NULL,
  `lead_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `batch_lead_tbl_batch_id_lead_id_unique` (`batch_id`,`lead_id`),
  KEY `batch_lead_tbl_lead_id_foreign` (`lead_id`),
  CONSTRAINT `batch_lead_tbl_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `batch_lead_tbl_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch_lead_tbl`
--

LOCK TABLES `batch_lead_tbl` WRITE;
/*!40000 ALTER TABLE `batch_lead_tbl` DISABLE KEYS */;
INSERT INTO `batch_lead_tbl` VALUES (1,3,1,'2025-10-28 02:36:07','2025-10-28 02:36:07'),(2,4,1,'2025-10-29 04:28:09','2025-10-29 04:28:09');
/*!40000 ALTER TABLE `batch_lead_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batch_student_tbl`
--

DROP TABLE IF EXISTS `batch_student_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batch_student_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batches_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `batch_student_tbl_batches_id_foreign` (`batches_id`),
  KEY `batch_student_tbl_student_id_foreign` (`student_id`),
  CONSTRAINT `batch_student_tbl_batches_id_foreign` FOREIGN KEY (`batches_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `batch_student_tbl_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch_student_tbl`
--

LOCK TABLES `batch_student_tbl` WRITE;
/*!40000 ALTER TABLE `batch_student_tbl` DISABLE KEYS */;
INSERT INTO `batch_student_tbl` VALUES (1,3,2,'2025-10-28 01:00:44','2025-10-28 01:00:44'),(2,4,5,'2025-10-29 01:20:29','2025-10-29 01:20:29'),(3,4,7,'2025-10-29 01:20:40','2025-10-29 01:20:40'),(4,3,4,'2025-10-29 01:20:49','2025-10-29 01:20:49');
/*!40000 ALTER TABLE `batch_student_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batch_teacher_tbl`
--

DROP TABLE IF EXISTS `batch_teacher_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batch_teacher_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batches_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `batch_teacher_tbl_batches_id_teacher_id_unique` (`batches_id`,`teacher_id`),
  KEY `batch_teacher_tbl_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `batch_teacher_tbl_batches_id_foreign` FOREIGN KEY (`batches_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `batch_teacher_tbl_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batch_teacher_tbl`
--

LOCK TABLES `batch_teacher_tbl` WRITE;
/*!40000 ALTER TABLE `batch_teacher_tbl` DISABLE KEYS */;
INSERT INTO `batch_teacher_tbl` VALUES (1,3,3,'2025-10-28 02:06:27','2025-10-28 02:06:27');
/*!40000 ALTER TABLE `batch_teacher_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `status` enum('planned','running','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'planned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `batches_batch_code_unique` (`batch_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (3,'BT-001',3,'Python Batch','2025-10-01',NULL,13,'planned','2025-10-27 08:35:14','2025-10-27 08:35:57'),(4,'BT-002',2,'Physiotherapy Batch','2025-10-15',NULL,12,'planned','2025-10-29 00:24:41','2025-10-29 00:24:41');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_sessions`
--

DROP TABLE IF EXISTS `class_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `classroom_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_sessions_classroom_id_foreign` (`classroom_id`),
  KEY `class_sessions_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `class_sessions_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `class_sessions_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_sessions`
--

LOCK TABLES `class_sessions` WRITE;
/*!40000 ALTER TABLE `class_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classrooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned NOT NULL,
  `class_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration_hours` int DEFAULT NULL,
  `max_students` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classrooms_class_code_unique` (`class_code`),
  KEY `classrooms_batch_id_foreign` (`batch_id`),
  CONSTRAINT `classrooms_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classrooms`
--

LOCK TABLES `classrooms` WRITE;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `class_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration_hours` int DEFAULT NULL,
  `max_students` int DEFAULT NULL,
  `course_fee` decimal(10,2) DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_class_code_unique` (`class_code`),
  KEY `courses_department_id_foreign` (`department_id`),
  CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (2,'CR-001',3,'Physiotherapy','massage',3,12,30000.00,'active','2025-10-27 07:51:01','2025-10-31 00:14:17'),(3,'CR-002',2,'Basic Python Course',NULL,20,12,20000.00,'inactive','2025-10-27 08:14:02','2025-10-31 00:14:05');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crm_pipeline_stages_tbl`
--

DROP TABLE IF EXISTS `crm_pipeline_stages_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crm_pipeline_stages_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `crm_pipeline_stages` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `what_it_means` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enter_when` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exit_when` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_pipeline_stages_tbl`
--

LOCK TABLES `crm_pipeline_stages_tbl` WRITE;
/*!40000 ALTER TABLE `crm_pipeline_stages_tbl` DISABLE KEYS */;
INSERT INTO `crm_pipeline_stages_tbl` VALUES (1,'New Lead','A new inquiry or contact has entered the CRM system.','When a new lead is created manually or via integration.','When initial contact is made.','Marketing Team',NULL,NULL),(2,'Connected – Initial Conversation','First successful contact has been made with the lead.','When communication (call/chat) is established.','After qualification or next step is defined.','Sales Team',NULL,NULL),(3,'Attempting Contact','Trying to reach the lead but no successful communication yet.','When first outreach attempt begins.','When the lead responds or is marked unresponsive.','Sales Team',NULL,NULL),(4,'Marketing Qualified Lead (MQL)','Lead meets the marketing team’s qualification criteria.','After lead scoring or engagement meets threshold.','When handed over to sales.','Marketing Team',NULL,NULL),(5,'Sales Accepted Lead (SAL)','Sales team acknowledges the MQL and starts engagement.','When marketing hands over and sales accepts the lead.','When qualified further as SQL or rejected.','Sales Team',NULL,NULL),(6,'Sales Qualified Lead (SQL)','Lead is verified as a potential customer with intent and fit.','After discovery call or qualification questions.','When demo or trial is scheduled.','Sales Team',NULL,NULL),(7,'Demo Scheduled','A product demo or trial session has been booked.','After the lead confirms demo time.','When the demo is completed or no-show occurs.','Sales Team',NULL,NULL),(8,'Demo Attended','Lead attended the scheduled demo session.','After demo participation is confirmed.','When moved to trial or closed.','Sales Team',NULL,NULL),(9,'Trial Month – Active (Demo Classes Ongoing)','Lead is currently participating in a trial or demo period.','After demo classes begin.','When trial completes or lead converts.','Sales Team',NULL,NULL),(10,'No-Show (Demo)','Lead missed the scheduled demo session.','When demo session attendance is not confirmed.','When rescheduled or marked as inactive.','Sales Team',NULL,NULL),(11,'Nurture – Warm','Lead showed interest but is not yet ready to purchase.','When engagement is positive but no immediate decision.','When reactivated or disqualified.','Marketing Team',NULL,NULL),(12,'Nurture – Cold','Lead is unresponsive or lost interest temporarily.','When lead becomes inactive.','When reactivated or archived.','Marketing Team',NULL,NULL),(13,'Lost – Dropped During Trial','Lead stopped participating during trial phase.','When lead leaves before trial completion.','If revived later or archived.','Sales Team',NULL,NULL),(14,'Lost – Price/Timing/Other','Lead did not convert due to external reasons (pricing, timing, etc.).','After final communication confirms disinterest.','If revived or re-qualified later.','Sales/Marketing Team',NULL,NULL),(15,'Disqualified','Lead does not meet basic qualification criteria.','After assessment by marketing or sales.','If revived or reclassified.','Marketing Team',NULL,NULL),(16,'Re-Inquiry (Revived)','Previously lost/disqualified lead re-engaged with new interest.','When an old lead contacts again.','When moved back to MQL or active funnel.','Sales/Marketing Team',NULL,NULL);
/*!40000 ALTER TABLE `crm_pipeline_stages_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (2,'Computing & Information Technologies','2025-10-27 08:11:09','2025-10-27 08:11:09'),(3,'Allied & Paramedical Sciences','2025-10-27 08:11:46','2025-10-27 08:11:46');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_category_tbl`
--

DROP TABLE IF EXISTS `expense_category_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_category_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_category_tbl`
--

LOCK TABLES `expense_category_tbl` WRITE;
/*!40000 ALTER TABLE `expense_category_tbl` DISABLE KEYS */;
INSERT INTO `expense_category_tbl` VALUES (1,'Administrative Expenses','2025-10-31 01:43:53','2025-10-31 01:43:53'),(2,'Employee-Related Expenses','2025-10-31 01:44:13','2025-10-31 01:44:13'),(3,'Academic / Operational Expenses','2025-10-31 01:44:23','2025-10-31 01:44:23');
/*!40000 ALTER TABLE `expense_category_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_subcategory_tbl`
--

DROP TABLE IF EXISTS `expense_subcategory_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expense_subcategory_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_subcategory_tbl_category_id_foreign` (`category_id`),
  CONSTRAINT `expense_subcategory_tbl_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_category_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_subcategory_tbl`
--

LOCK TABLES `expense_subcategory_tbl` WRITE;
/*!40000 ALTER TABLE `expense_subcategory_tbl` DISABLE KEYS */;
INSERT INTO `expense_subcategory_tbl` VALUES (1,1,'Office supplies (stationery, printing, etc.)','2025-10-31 01:56:43','2025-10-31 01:56:43'),(2,3,'Internet, phone, and communication bills','2025-10-31 01:57:05','2025-10-31 01:57:05'),(3,2,'Salaries and wages','2025-10-31 01:57:24','2025-10-31 01:57:24'),(4,2,'Bonuses and incentives','2025-10-31 01:57:40','2025-10-31 01:57:40'),(5,3,'Teaching materials & lab supplies','2025-10-31 01:57:59','2025-10-31 01:57:59'),(6,3,'Guest lectures & workshops','2025-10-31 01:58:21','2025-10-31 01:58:21');
/*!40000 ALTER TABLE `expense_subcategory_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `expenses_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `expense_subcategory_tbl` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,0,1,5000.00,'2025-10-15','Cash','cdcdc','2025-10-29 05:16:08','2025-10-31 04:15:52'),(2,1,1,5050.00,'2025-10-31','Cash','dwffd','2025-10-31 05:00:28','2025-11-01 00:41:11'),(3,3,2,10000.00,'2025-10-31','Cash','bdhuwbdhwbdb','2025-10-31 08:41:22','2025-10-31 08:41:22'),(4,2,3,15000.00,'2025-10-31','Cash','jdewbdibewdib','2025-10-31 08:42:06','2025-10-31 08:42:06');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_attendance_tbl`
--

DROP TABLE IF EXISTS `lead_attendance_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lead_attendance_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned NOT NULL,
  `lead_id` bigint unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lead_attendance_tbl_batch_id_lead_id_attendance_date_unique` (`batch_id`,`lead_id`,`attendance_date`),
  KEY `lead_attendance_tbl_lead_id_foreign` (`lead_id`),
  CONSTRAINT `lead_attendance_tbl_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_attendance_tbl_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_attendance_tbl`
--

LOCK TABLES `lead_attendance_tbl` WRITE;
/*!40000 ALTER TABLE `lead_attendance_tbl` DISABLE KEYS */;
INSERT INTO `lead_attendance_tbl` VALUES (1,3,1,'2025-10-28',0,'2025-10-28 07:33:06','2025-10-28 07:41:18'),(2,4,1,'2025-10-26',1,'2025-10-29 04:28:59','2025-10-29 04:28:59');
/*!40000 ALTER TABLE `lead_attendance_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_attendance_tbl`
--

DROP TABLE IF EXISTS `leads_attendance_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads_attendance_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint unsigned NOT NULL,
  `attn_date` date NOT NULL,
  `status` enum('present','absent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_lead_date` (`lead_id`,`attn_date`),
  KEY `leads_attendance_tbl_attn_date_index` (`attn_date`),
  CONSTRAINT `leads_attendance_tbl_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_attendance_tbl`
--

LOCK TABLES `leads_attendance_tbl` WRITE;
/*!40000 ALTER TABLE `leads_attendance_tbl` DISABLE KEYS */;
INSERT INTO `leads_attendance_tbl` VALUES (1,1,'2025-10-27','present','2025-10-27 05:37:01','2025-10-27 05:37:01'),(2,2,'2025-10-27','absent','2025-10-27 05:37:01','2025-10-27 05:37:01');
/*!40000 ALTER TABLE `leads_attendance_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_conversion_stat_tbl`
--

DROP TABLE IF EXISTS `leads_conversion_stat_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads_conversion_stat_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `crm_pipeline_stages_id` bigint unsigned NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_conversion_stat_tbl_leads_id_foreign` (`leads_id`),
  KEY `leads_conversion_stat_tbl_crm_pipeline_stages_id_foreign` (`crm_pipeline_stages_id`),
  CONSTRAINT `leads_conversion_stat_tbl_crm_pipeline_stages_id_foreign` FOREIGN KEY (`crm_pipeline_stages_id`) REFERENCES `crm_pipeline_stages_tbl` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_conversion_stat_tbl_leads_id_foreign` FOREIGN KEY (`leads_id`) REFERENCES `leads_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_conversion_stat_tbl`
--

LOCK TABLES `leads_conversion_stat_tbl` WRITE;
/*!40000 ALTER TABLE `leads_conversion_stat_tbl` DISABLE KEYS */;
INSERT INTO `leads_conversion_stat_tbl` VALUES (1,1,'2025-10-27',2,'Vebe dekhche','2025-10-27 05:35:00','2025-10-27 05:35:00'),(2,2,'2025-10-28',2,'ready','2025-10-27 05:35:15','2025-10-27 05:40:47');
/*!40000 ALTER TABLE `leads_conversion_stat_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_tbl`
--

DROP TABLE IF EXISTS `leads_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_contact` date NOT NULL,
  `budget_range` decimal(10,2) NOT NULL,
  `authority` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeline` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing_source_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_tbl_marketing_source_id_foreign` (`marketing_source_id`),
  CONSTRAINT `leads_tbl_marketing_source_id_foreign` FOREIGN KEY (`marketing_source_id`) REFERENCES `marketing_source_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_tbl`
--

LOCK TABLES `leads_tbl` WRITE;
/*!40000 ALTER TABLE `leads_tbl` DISABLE KEYS */;
INSERT INTO `leads_tbl` VALUES (1,'Goku','Howrah','9876543210','male','2025-10-27',1000.00,'Self','wdwqdwdwed','1',6,'2025-10-27 05:33:17','2025-10-27 05:33:40'),(2,'Picolo','Namek','12345654321','male','2025-10-27',15.00,'Parent','wfwefwe','1',1,'2025-10-27 05:34:17','2025-10-27 05:34:32');
/*!40000 ALTER TABLE `leads_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_trial_stat_tbl`
--

DROP TABLE IF EXISTS `leads_trial_stat_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads_trial_stat_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` bigint unsigned NOT NULL,
  `trl_start_dt` date NOT NULL,
  `trl_end_dt` date NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `batch_id` bigint unsigned NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_trial_stat_tbl_leads_id_foreign` (`leads_id`),
  KEY `leads_trial_stat_tbl_course_id_foreign` (`course_id`),
  KEY `leads_trial_stat_tbl_batch_id_foreign` (`batch_id`),
  CONSTRAINT `leads_trial_stat_tbl_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_trial_stat_tbl_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leads_trial_stat_tbl_leads_id_foreign` FOREIGN KEY (`leads_id`) REFERENCES `leads_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_trial_stat_tbl`
--

LOCK TABLES `leads_trial_stat_tbl` WRITE;
/*!40000 ALTER TABLE `leads_trial_stat_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_trial_stat_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_source_tbl`
--

DROP TABLE IF EXISTS `marketing_source_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marketing_source_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lead_source` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_source_tbl`
--

LOCK TABLES `marketing_source_tbl` WRITE;
/*!40000 ALTER TABLE `marketing_source_tbl` DISABLE KEYS */;
INSERT INTO `marketing_source_tbl` VALUES (1,'Meta Ads',NULL,NULL),(2,'Inbound Call',NULL,NULL),(3,'Referral',NULL,NULL),(4,'Walk-in',NULL,NULL),(5,'Website',NULL,NULL),(6,'SEO',NULL,NULL),(7,'Google Ads',NULL,NULL);
/*!40000 ALTER TABLE `marketing_source_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_results`
--

DROP TABLE IF EXISTS `meta_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT 'Report date',
  `link_clicks` decimal(10,2) DEFAULT NULL,
  `cost_per_link_clicks` decimal(10,2) DEFAULT NULL,
  `views` decimal(10,2) DEFAULT NULL,
  `viewers` decimal(10,2) DEFAULT NULL,
  `post_engagements` decimal(10,2) DEFAULT NULL,
  `three_second_video_plays` decimal(10,2) DEFAULT NULL,
  `post_reactions` decimal(10,2) DEFAULT NULL,
  `estimated_call_confirmation_clicks` decimal(10,2) DEFAULT NULL,
  `twenty_second_phone_calls` decimal(10,2) DEFAULT NULL,
  `post_comments` decimal(10,2) DEFAULT NULL,
  `post_shares` decimal(10,2) DEFAULT NULL,
  `actual_call` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_results`
--

LOCK TABLES `meta_results` WRITE;
/*!40000 ALTER TABLE `meta_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_results` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_10_11_180552_create_organisations_table',1),(5,'2025_10_11_182339_create_teachers_table',1),(6,'2025_10_11_185202_create_students_table',1),(7,'2025_10_13_070220_create_batches_table',1),(8,'2025_10_13_073126_create_classrooms_table',1),(9,'2025_10_13_103622_create_class_sessions_table',1),(10,'2025_10_13_104428_create_schedules_table',1),(11,'2025_10_13_105834_create_payments_table',1),(12,'2025_10_13_110617_create_expenses_table',1),(13,'2025_10_16_100435_create_courses_table',1),(14,'2025_10_18_184108_create_meta_results_table',1),(15,'2025_10_20_054927_create_marketing_source_tbl_table',1),(16,'2025_10_20_062508_create_crm_pipeline_stages_tbl_table',1),(17,'2025_10_20_095910_create_leads_tbl_table',1),(18,'2025_10_20_101723_create_leads_conversion_stat_tbl_table',1),(19,'2025_10_27_063405_create_leads_trial_stat_tbl',1),(20,'2025_10_27_102209_create_leads_attendance_tbl',1),(21,'2025_10_27_122458_add_lead_id_to_batches_table',2),(22,'2025_10_27_124925_create_department_table',3),(23,'2025_10_27_131014_add_department_id_to_courses_table',4),(24,'2025_10_27_141935_create_batch_student_tbl',5),(25,'2025_10_28_070640_create_batch_teacher_tbl',6),(26,'2025_10_28_075449_create_batch_lead_tbl',7),(27,'2025_10_28_125555_create_lead_attendance_tbl',8),(28,'2025_10_29_101946_update_student_foreign_in_payments_table',9),(29,'2025_10_31_053245_add_course_fee_to_courses_table',10),(30,'2025_10_31_065913_create_expense_category_tbl',11),(31,'2025_10_31_071757_create_expense_subcategory_tbl',12),(32,'2025_10_31_080322_add_subcategory_id_to_expenses_table',13),(33,'2025_10_31_144142_create_net_income_tbl',14),(34,'2025_11_01_060231_remove_batch_id_from_expenses_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `net_income_tbl`
--

DROP TABLE IF EXISTS `net_income_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `net_income_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `record_date` date NOT NULL,
  `total_payment` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_expense` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dept_date_unique` (`department_id`,`record_date`),
  CONSTRAINT `net_income_tbl_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `net_income_tbl`
--

LOCK TABLES `net_income_tbl` WRITE;
/*!40000 ALTER TABLE `net_income_tbl` DISABLE KEYS */;
INSERT INTO `net_income_tbl` VALUES (1,3,'2025-10-31',0.00,25000.00,'2025-10-31 09:26:28','2025-10-31 09:31:32'),(2,2,'2025-10-31',0.00,5050.00,'2025-10-31 09:26:28','2025-10-31 09:31:32'),(3,3,'2025-10-08',0.00,0.00,'2025-10-31 09:30:42','2025-10-31 09:30:42'),(4,2,'2025-10-08',13200.00,0.00,'2025-10-31 09:30:42','2025-10-31 09:30:42'),(5,3,'2025-10-01',0.00,0.00,'2025-10-31 09:31:26','2025-10-31 09:31:26'),(6,2,'2025-10-01',0.00,0.00,'2025-10-31 09:31:26','2025-10-31 09:31:26');
/*!40000 ALTER TABLE `net_income_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organisations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations`
--

LOCK TABLES `organisations` WRITE;
/*!40000 ALTER TABLE `organisations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `batch_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_batch_id_foreign` (`batch_id`),
  KEY `payments_student_id_foreign` (`student_id`),
  CONSTRAINT `payments_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (6,4,3,13200.00,'2025-10-08','Cash',NULL,'dd','2025-10-29 05:05:57','2025-10-31 00:15:38'),(7,5,4,12022.00,'2025-10-27','Cash',NULL,'eqeqw','2025-10-29 05:45:21','2025-10-31 00:15:24'),(8,7,4,11300.00,'2025-10-30','Cash',NULL,'fhf','2025-10-29 07:30:35','2025-10-31 00:15:08');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned DEFAULT NULL,
  `class_session_id` bigint unsigned DEFAULT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `scheduled_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_batch_id_foreign` (`batch_id`),
  KEY `schedules_class_session_id_foreign` (`class_session_id`),
  KEY `schedules_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `schedules_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `schedules_class_session_id_foreign` FOREIGN KEY (`class_session_id`) REFERENCES `class_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('jEsE0zWDessScHh7pDn8HbjYKOfeQONJI5TUJumi',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmVjcWFKR1BsSERHN3VlUGlRSjZvR2lLNGRqTkxqSkpmd3llUVZtZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8wLjAuMC4wOjgwMDAvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1761986407);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_attendance_tbl`
--

DROP TABLE IF EXISTS `student_attendance_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_attendance_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_attendance_tbl_batch_id_foreign` (`batch_id`),
  KEY `student_attendance_tbl_student_id_foreign` (`student_id`),
  CONSTRAINT `student_attendance_tbl_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_attendance_tbl_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_attendance_tbl`
--

LOCK TABLES `student_attendance_tbl` WRITE;
/*!40000 ALTER TABLE `student_attendance_tbl` DISABLE KEYS */;
INSERT INTO `student_attendance_tbl` VALUES (1,3,2,'2025-10-28',0,'2025-10-28 08:12:06','2025-10-28 08:35:52');
/*!40000 ALTER TABLE `student_attendance_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed','separated') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `voter_id_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highest_qualification` enum('matriculation','higher_secondary','graduation','masters','phd') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_on` date DEFAULT NULL,
  `status` enum('active','inactive','lead','alumni','withdrawn') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_student_code_unique` (`student_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_attendance_tbl`
--

DROP TABLE IF EXISTS `teacher_attendance_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teacher_attendance_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_attendance_tbl_batch_id_foreign` (`batch_id`),
  KEY `teacher_attendance_tbl_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `teacher_attendance_tbl_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `teacher_attendance_tbl_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_attendance_tbl`
--

LOCK TABLES `teacher_attendance_tbl` WRITE;
/*!40000 ALTER TABLE `teacher_attendance_tbl` DISABLE KEYS */;
INSERT INTO `teacher_attendance_tbl` VALUES (1,3,3,'2025-10-28',0,'2025-10-28 09:11:52','2025-10-28 09:13:59'),(2,3,3,'2025-10-26',1,'2025-10-29 04:23:43','2025-10-29 04:23:43');
/*!40000 ALTER TABLE `teacher_attendance_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed','separated') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `voter_id_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highest_qualification` enum('matriculation','higher_secondary','graduation','masters','phd') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_on` date DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_teacher_code_unique` (`teacher_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed','separated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci,
  `permanent_address` text COLLATE utf8mb4_unicode_ci,
  `voter_id_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highest_qualification` enum('matriculation','higher_secondary','graduation','masters','phd') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_at` date DEFAULT NULL,
  `profile` enum('student','teacher','admin','staff') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','lead','alumni','withdrawn') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `enc_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Banty',NULL,'Modi','admin@example.com',NULL,'$2y$12$LVqoztbV9hGB5pcyo29bGOINqRPcdRKKme1p4P9eBTJI7jUOYRxBK',NULL,NULL,'other',NULL,NULL,'single',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'active',NULL,NULL,'2025-10-27 05:24:46','2025-10-27 05:24:46'),(2,'Souvik',NULL,'Sarkar','ss@example.com',NULL,'$2y$12$nQtJEdUwb6fzwlDQK3lgF.igRpPaaPpDo.dmdMqTNpSLiySaSWP0S','9876543210','2025-10-01','male','Dilip Kumar Sarkar','Alva Sarkar','single','Nei','103/a south sinthee road','103/a south sinthee road','123456789009','123456789012','123456789876','higher_secondary','2025-10-04','student','active','VPd4PbKA2N7Xl9pffGwI9oVK5cXKl3Gg',NULL,'2025-10-27 05:27:10','2025-10-27 05:27:10'),(3,'Rabindra','Nath','Tagore','rnt@abcd.com',NULL,'$2y$12$7E.ftJt/cEep7zAo1v0kSurKDjYNjBe8PSjlur9WVr0a6qXHiGHKG','1234567890','2025-10-10','male','Goku','Chi chi','single','jani na','Jorasako','Jorasako','123456789009','123456789012','123456789876','masters','2025-10-08','teacher','active','xkhlGiwdjKdKIs23525Plr0LvEv0VFft',NULL,'2025-10-27 05:29:18','2025-10-27 05:29:18'),(4,'Gohan',NULL,'Sarkar','gohan@abcd.com',NULL,'$2y$12$kkl3KiiyGVe4zFF6i7ktSOHi5FyfmMVtS6.66FauxQScu.nXsHHjO','1234567890','2025-10-01','male','Goku','Chi chi','married','Videl','fsadfsdfsd','sfsfsdfsd','123456789009','123456789012','123456789876','phd','2025-10-03','student','active','XO4yGVshEIcPdKiY8gFfoCfxcrTyLnzJ',NULL,'2025-10-29 00:48:16','2025-10-29 00:48:16'),(5,'Krilin',NULL,'Dragon','krilin@abcd.com',NULL,'$2y$12$xrtLG6JRGEqmWa7L3UPHx.03CPL2liYuKycKJn0e4qlBf6qf1rdFi','9876543210','2025-10-03','male','Janina','Nehipata','single','jani na','fdfsdfsdf','faasasfas','123456789009','123456789012','123456789876','higher_secondary','2025-10-09','student','active','tTIWbBzzMdFfRkGctroon6hLdCaqJSOF',NULL,'2025-10-29 00:49:15','2025-10-29 00:49:15'),(6,'King',NULL,'Kai','kk@abcd.com',NULL,'$2y$12$pquZzuAZUCH3GyV2jfV8WOxOkdhdqk3sW6UrgDkPM7YPFB4gqeesa','984567839292','2025-10-07','male','Janina','Nehipata','single','jani na','sfsdfsdf','sdfsdfsdfsdf','123456789009','123456789012','123456789876','higher_secondary','2025-10-10','teacher','active','UkG9NcCw6fBXwcfEwH7wDGQOEpoahtBU',NULL,'2025-10-29 00:50:31','2025-10-29 00:50:31'),(7,'Prajapati',NULL,'Pal','pp@abcd.com',NULL,'$2y$12$ocqG.LgzDRDYX13WpKF7K.qmJIWyqPQvqpWmdjSJkznuSIOSz3LQq','9876543210','2025-10-07','male','fdfwegwg','gwegwwew','single','cwcw','dsdfsdfsdfsdf','fsdfsdfsdfsd','123456789009','123456789012','123456789876','graduation','2025-10-10','student','active','j73NnxVpg5dTyjDnqbf02vvlIwpEUejg',NULL,'2025-10-29 00:51:54','2025-10-29 00:51:54'),(8,'Hridoy',NULL,'Das','hd@abcd.com',NULL,'$2y$12$ut1bseMqbn7T8GNo4tW5Xuy.CRksKvt2sjjW1RiLDWXLIs2JKusNW','1234567890','2025-10-09','male','fsdfsdfsdfds','dsfsdfsdfsdfsd','single','fsdfsdfsdfsd','fsdfsdfsdf','dfsdfsdfsdfsd','123456789009','123456789012','123456789876','masters','2025-10-09','teacher','active','WeAd6ZLB2JBP09H8YPVVr6Ihdh2GTfGm',NULL,'2025-10-29 00:53:24','2025-10-29 00:53:24'),(9,'Hari','Das','Pal','hdp@abcd.com',NULL,'$2y$12$8ft4Zv6iFPP2m/yvHdRgMetYO6s5fKYY8zImJ9qjnxgWS4qzM6b5a','1234567890','2025-10-10','male','Janina','Nehipata','single','fgdfgfgf','sfdsafsdfsdf','gdfgdfgdfgdf','123456789009','123456789012','123456789876','phd','2025-10-16','teacher','active','ceQCZjgjQmgvZEO3VTyhFm6NETsV4MMl',NULL,'2025-10-29 00:54:29','2025-10-29 00:54:29');
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

-- Dump completed on 2025-11-01 20:31:41
