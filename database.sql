CREATE DATABASE  IF NOT EXISTS `aulif` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `aulif`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: aulif
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `correct` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_answers_questions1_idx` (`questions_id`),
  CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,2,'<p>Alternativa A</p>','0','2019-08-03 01:02:26','2019-08-03 01:02:26','0'),(2,2,'<p>Alternativa B (la correcta)</p>','1','2019-08-03 01:02:26','2019-08-03 01:02:26','0'),(3,2,'<p>Alternativa C</p>','0','2019-08-03 01:02:26','2019-08-03 01:02:26','0'),(4,2,'<p>Alternativa D</p>','0','2019-08-03 01:02:26','2019-08-03 01:02:26','0'),(5,2,'<p>Alternativa E</p>','0','2019-08-03 01:02:27','2019-08-03 01:02:27','0'),(6,3,'<p>Alternativa A</p>','0','2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(7,3,'<p>Alternativa B</p>','0','2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(8,3,'<p>Alternativa C</p>','0','2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(9,3,'<p>Alternativa D (la correcta)</p>','1','2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(10,3,'<p>Alternativa E</p>','0','2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(11,4,'<p>Alternativa A</p>','0','2019-08-03 01:06:17','2019-08-03 01:06:17','0'),(12,4,'<p>Alternativa B</p>','0','2019-08-03 01:06:17','2019-08-03 01:06:17','0'),(13,4,'<p>Alternativa C (la correcta)</p>','1','2019-08-03 01:06:17','2019-08-03 01:06:17','0'),(14,4,'<p>Alternativa D</p>','0','2019-08-03 01:06:17','2019-08-03 01:06:17','0'),(15,4,'<p>Alternativa E</p>','0','2019-08-03 01:06:17','2019-08-03 01:06:17','0');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `classrooms_id` int(11) NOT NULL,
  `lessons_id` int(11) NOT NULL,
  `startdate` timestamp NULL DEFAULT NULL,
  `enddate` timestamp NULL DEFAULT NULL,
  `level1_count` int(11) NOT NULL DEFAULT '0',
  `level2_count` int(11) NOT NULL DEFAULT '0',
  `level3_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_assignment_lessons1_idx` (`lessons_id`),
  KEY `fk_assignments_classrooms1_idx` (`classrooms_id`),
  CONSTRAINT `fk_assignment_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignments_classrooms1` FOREIGN KEY (`classrooms_id`) REFERENCES `classrooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Matemática 3ro',0.00,NULL,'2019-06-25 04:58:52','2019-06-25 04:58:52','0'),(2,'Matemática 4to',0.00,NULL,'2019-06-25 04:59:36','2019-06-25 04:59:36','0'),(3,'Matemática 5to',0.00,NULL,'2019-06-25 04:59:54','2019-06-25 04:59:54','0'),(6,'Test',200.00,'books/Qy9zX8gpdb7NYnTgkkxjis5fTrrsd2ukAglBmfeH.png','2019-08-03 04:23:16','2019-08-03 04:28:13','0');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_lessons`
--

DROP TABLE IF EXISTS `books_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_lessons` (
  `lessons_id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  PRIMARY KEY (`lessons_id`,`books_id`),
  KEY `fk_lessons_has_books_books1_idx` (`books_id`),
  KEY `fk_lessons_has_books_lessons_idx` (`lessons_id`),
  CONSTRAINT `fk_lessons_has_books_books1` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_has_books_lessons` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_lessons`
--

LOCK TABLES `books_lessons` WRITE;
/*!40000 ALTER TABLE `books_lessons` DISABLE KEYS */;
INSERT INTO `books_lessons` VALUES (2,6),(3,6),(4,6),(5,6);
/*!40000 ALTER TABLE `books_lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_classroom_users1_idx` (`users_id`),
  CONSTRAINT `fk_classroom_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classrooms`
--

LOCK TABLES `classrooms` WRITE;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT INTO `classrooms` VALUES (2,'Aula 51',4,'2019-07-31 14:07:42','2019-07-31 14:08:33','0');
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` char(2) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Álgebra',0.00,NULL,'2019-06-25 04:57:40','2019-06-25 04:57:40','0'),(2,'Aritmética',0.00,NULL,'2019-06-25 04:57:50','2019-06-25 04:57:50','0'),(3,'Estadística',0.00,NULL,'2019-06-25 04:57:59','2019-06-25 04:57:59','0'),(4,'Geometría',0.00,NULL,'2019-06-25 04:58:11','2019-06-25 04:58:11','0'),(5,'Geometría Analítica',0.00,NULL,'2019-06-25 04:58:23','2019-06-25 04:58:23','0'),(6,'Trigonometría',0.00,NULL,'2019-06-25 04:58:30','2019-06-25 04:58:30','0'),(9,'Test',200.00,'courses/HNbjyxxypmOt8XLaK5OZUpNHLbePno7mrJygVI06.png','2019-06-25 08:18:02','2019-08-03 04:14:06','0');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses_lessons`
--

DROP TABLE IF EXISTS `courses_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_lessons` (
  `lessons_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  PRIMARY KEY (`lessons_id`,`courses_id`),
  KEY `fk_lessons_has_courses_courses1_idx` (`courses_id`),
  KEY `fk_lessons_has_courses_lessons1_idx` (`lessons_id`),
  CONSTRAINT `fk_lessons_has_courses_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_has_courses_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses_lessons`
--

LOCK TABLES `courses_lessons` WRITE;
/*!40000 ALTER TABLE `courses_lessons` DISABLE KEYS */;
INSERT INTO `courses_lessons` VALUES (3,9),(5,9),(6,9),(7,9),(10,9),(11,9);
/*!40000 ALTER TABLE `courses_lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `provinces_id` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_districts_provinces1_idx` (`provinces_id`),
  CONSTRAINT `fk_districts_provinces1` FOREIGN KEY (`provinces_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classrooms_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_enrollments_users1_idx` (`users_id`),
  KEY `fk_enrollments_classrooms1_idx` (`classrooms_id`),
  CONSTRAINT `fk_enrollments_classrooms1` FOREIGN KEY (`classrooms_id`) REFERENCES `classrooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrollments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (1,2,5,'2019-07-31 14:07:42','2019-07-31 15:46:04','0'),(2,2,6,'2019-07-31 15:43:12','2019-07-31 15:46:04','1');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (2,'Teoría de exponentes y radicales',100.00,'2019-06-24 18:51:40','2019-08-02 10:21:16','0'),(3,'Logaritmos',0.00,'2019-06-24 18:51:51','2019-06-24 18:51:51','0'),(4,'Polinomios',0.00,'2019-06-24 18:51:59','2019-06-24 18:51:59','0'),(5,'División algebraica',0.00,'2019-06-24 18:52:06','2019-06-24 18:52:06','0'),(6,'Productos notables',0.00,'2019-06-24 18:52:40','2019-06-24 18:52:40','0'),(7,'Factorización',0.00,'2019-06-24 18:52:48','2019-06-24 18:52:48','0'),(8,'Fracciones algebraicas',0.00,'2019-06-24 18:52:56','2019-06-24 18:52:56','0'),(9,'Ecuaciones de primer grado',0.00,'2019-06-24 18:53:04','2019-06-24 18:53:04','0'),(10,'Ecuaciones de segundo grado',0.00,'2019-06-24 18:53:12','2019-06-24 18:53:12','0'),(11,'Ecuaciones exponenciales y logarítmicas',0.00,'2019-06-24 18:53:24','2019-06-24 18:53:24','0'),(12,'Inecuaciones de primer grado',0.00,'2019-06-24 18:53:32','2019-06-24 18:53:32','0'),(13,'Inecuaciones de segundo grado',0.00,'2019-06-24 18:53:44','2019-06-24 18:53:44','0'),(14,'Inecuaciones polinomiales',0.00,'2019-06-24 18:53:51','2019-06-24 18:53:51','0'),(15,'Inecuaciones racionales',0.00,'2019-06-24 18:53:58','2019-06-24 18:53:58','0'),(16,'Planteo de problemas',0.00,'2019-06-24 18:54:06','2019-06-24 18:54:06','0'),(17,'Relaciones y funciones',0.00,'2019-06-24 18:54:15','2019-06-24 18:54:15','0'),(18,'Funciones especiales I',0.00,'2019-06-24 18:54:24','2019-06-24 18:54:24','0'),(19,'Funciones especiales II',0.00,'2019-06-24 18:54:33','2019-06-24 18:54:33','0'),(20,'El sistema de los números complejos',0.00,'2019-06-24 18:54:43','2019-06-24 18:54:43','0');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_contents_lessons1_idx` (`lessons_id`),
  CONSTRAINT `fk_contents_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,2,'T','<h3 itemprop=\"name\">Placeholder text in CKEditor</h3>\r\n\r\n<p>This weekend I worked on a little bunch of code to support the&nbsp;<a href=\"http://dev.w3.org/html5/spec/common-input-element-attributes.html#the-placeholder-attribute\">HTML5 &quot;placeholder&quot;</a>&nbsp;attribute in CKEditor.<br />\r\nThe idea is simple: show a little text instead of empty content when the editor loads for the first time, and make it disappear automatically when the content gets focus.<br />\r\nThere are two main problems to do this correctly: find out when the editor is focused or blurred and avoid the placeholder text when the content is read by other scripts.<br />\r\nIn theory to get the focus status it should be enough to handle the &#39;focus&#39; and &#39;blur&#39; events of the editor instance, but one problem is that when a dialog opens the content fires a blur, but in in this situation we don&#39;t want to insert again the placeholder text, so the event listener checks if a dialog has been opened before inserting the text.<br />\r\nPassing that check we must verify if the content is &quot;empty&quot; so we get the raw data of the editor and test it again &quot;empty&quot; strings like &quot;<br />\r\n&quot; &quot;</p>\r\n\r\n<div class=\"youtube-embed-wrapper\" style=\"position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden\"><iframe allow=\";\" allowfullscreen=\"\" frameborder=\"0\" height=\"360\" src=\"https://www.youtube.com/embed/OC7a4NKp2hQ\" style=\"position:absolute;top:0;left:0;width:100%;height:100%\" width=\"640\"></iframe></div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&quot; and the like that can be generated by different browsers.<br />\r\nAs I didn&#39;t want to handle yet another plugin I&#39;ve included it in the&nbsp;<a href=\"http://alfonsoml.blogspot.com/2012/02/configuration-helper-for-ckeditor.html\">configuration Helper plugin</a>&nbsp;and released as version 1.1. Also, the correct name for this plugin is already being used by a plugin that ships with the default CKEditor install but that it&#39;s totally unrelated to this feature that plugin resembles more the mail merge fields from MS Word, but at the time that plugin was created I don&#39;t think that HTML5 existed.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Demo:</h3>\r\n\r\n<p>You can set the focus in and out of the editor, type and delete, etc... when the editor isn&#39;t focused and it&#39;s empty it will show the text that I&#39;ve specified for the textarea placeholder: &quot;Type here...&quot; While in Source mode it tries to leave that task to the browser if it already supports this feature.</p>','2019-08-02 11:13:39','2019-08-02 17:05:16','0'),(2,2,'T','123','2019-08-02 11:20:47',NULL,'0'),(3,2,'P','<p>If you&#39;re using the plugin, it takes the placeholder from the HTML attribute. And you&#39;re not configuring the plugin when you call the&nbsp;<code>.replace</code>&nbsp;function. So...</p>\r\n\r\n<p><strong>HTML</strong>:</p>\r\n\r\n<pre>\r\nLenguaje de marcas\r\n</pre>\r\n\r\n<pre>\r\n<code>var config = { extraPlugins: &#39;confighelper&#39; };\r\nCKEDITOR.replace(&#39;myeditor&#39;,config);</code></pre>','2019-08-02 16:54:10','2019-08-02 16:56:38','0'),(4,2,'R','','2019-08-02 16:55:00','2019-08-02 16:55:00','0');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` varchar(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `departments_id` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provinces_departments1_idx` (`departments_id`),
  CONSTRAINT `fk_provinces_departments1` FOREIGN KEY (`departments_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `level` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_questions_lessons1_idx` (`lessons_id`),
  CONSTRAINT `fk_questions_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (2,2,'<p><strong>Enunciado </strong>1...</p>',0,'2019-08-03 01:02:26','2019-08-03 01:02:26','0'),(3,2,'<p><strong>Enunciado </strong>2...</p>',1,'2019-08-03 01:05:38','2019-08-03 01:05:38','0'),(4,2,'<p><strong>Enunciado </strong>3...</p>',2,'2019-08-03 01:06:17','2019-08-03 01:33:34','0');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizphases`
--

DROP TABLE IF EXISTS `quizphases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizphases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quizsubmissions_id` int(11) NOT NULL,
  `phase` int(1) NOT NULL,
  `score` decimal(8,2) DEFAULT NULL,
  `finished` char(1) NOT NULL DEFAULT '0',
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_quizphases_quizsubmissions1_idx` (`quizsubmissions_id`),
  CONSTRAINT `fk_quizphases_quizsubmissions1` FOREIGN KEY (`quizsubmissions_id`) REFERENCES `quizsubmissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizphases`
--

LOCK TABLES `quizphases` WRITE;
/*!40000 ALTER TABLE `quizphases` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizphases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizphases_questions`
--

DROP TABLE IF EXISTS `quizphases_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizphases_questions` (
  `quizphases_id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `answers_id` int(11) DEFAULT NULL,
  `myanswers_id` int(11) DEFAULT NULL,
  `correct` char(1) DEFAULT NULL,
  `score` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quizphases_id`,`questions_id`),
  KEY `fk_quizphases_has_questions_questions1_idx` (`questions_id`),
  KEY `fk_quizphases_has_questions_quizphases1_idx` (`quizphases_id`),
  KEY `fk_quizphases_questions_answers1_idx` (`myanswers_id`),
  KEY `fk_quizphases_questions_answers2_idx` (`answers_id`),
  CONSTRAINT `fk_quizphases_has_questions_questions1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_has_questions_quizphases1` FOREIGN KEY (`quizphases_id`) REFERENCES `quizphases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_questions_answers1` FOREIGN KEY (`myanswers_id`) REFERENCES `answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizphases_questions_answers2` FOREIGN KEY (`answers_id`) REFERENCES `answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizphases_questions`
--

LOCK TABLES `quizphases_questions` WRITE;
/*!40000 ALTER TABLE `quizphases_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizphases_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizsubmissions`
--

DROP TABLE IF EXISTS `quizsubmissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizsubmissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `score` decimal(8,2) DEFAULT NULL,
  `finished` char(1) NOT NULL DEFAULT '0',
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_lessonexams_lessons1_idx` (`lessons_id`),
  KEY `fk_lessonexams_users1_idx` (`users_id`),
  CONSTRAINT `fk_lessonexams_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessonexams_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizsubmissions`
--

LOCK TABLES `quizsubmissions` WRITE;
/*!40000 ALTER TABLE `quizsubmissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizsubmissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Profesor'),(3,'Alumno');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignments_id` int(11) NOT NULL,
  `enrollments_id` int(11) NOT NULL,
  `score` decimal(8,2) DEFAULT NULL,
  `finished` char(1) NOT NULL DEFAULT '0',
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_assignmentexams_assignments1_idx` (`assignments_id`),
  KEY `fk_assignmentexams_enrollments1_idx` (`enrollments_id`),
  CONSTRAINT `fk_assignmentexams_assignments1` FOREIGN KEY (`assignments_id`) REFERENCES `assignments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignmentexams_enrollments1` FOREIGN KEY (`enrollments_id`) REFERENCES `enrollments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions_questions`
--

DROP TABLE IF EXISTS `submissions_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions_questions` (
  `submissions_id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `answers_id` int(11) DEFAULT NULL,
  `myanswers_id` int(11) DEFAULT NULL,
  `correct` char(1) DEFAULT NULL,
  `score` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`submissions_id`,`questions_id`),
  KEY `fk_submissions_has_questions_questions1_idx` (`questions_id`),
  KEY `fk_submissions_has_questions_submissionss1_idx` (`submissions_id`),
  KEY `fk_submissions_questions_answers1_idx` (`myanswers_id`),
  KEY `fk_submissions_questions_answers2_idx` (`answers_id`),
  CONSTRAINT `fk_submissions_has_questions_assignmentexams1` FOREIGN KEY (`submissions_id`) REFERENCES `submissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_has_questions_questions1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_questions_answers1` FOREIGN KEY (`myanswers_id`) REFERENCES `answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_submissions_questions_answers2` FOREIGN KEY (`answers_id`) REFERENCES `answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions_questions`
--

LOCK TABLES `submissions_questions` WRITE;
/*!40000 ALTER TABLE `submissions_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `submissions_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `countries_id` char(2) DEFAULT NULL,
  `districts_id` varchar(6) DEFAULT NULL,
  `schools_id` int(11) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `filetype` varchar(100) DEFAULT NULL,
  `filesize` int(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`roles_id`),
  KEY `fk_users_schools1_idx` (`schools_id`),
  KEY `fk_users_countries1_idx` (`countries_id`),
  KEY `fk_users_districts1_idx` (`districts_id`),
  CONSTRAINT `fk_users_countries1` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_districts1` FOREIGN KEY (`districts_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_schools1` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Erick','Benites','erick.benites@gmail.com','$2y$12$CBd4IgbYnDIYv4sKqOP6Q.diBu/U44ot7wXu26eB4DcNp6Z2WOQKG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 01:00:13',NULL,'0'),(2,1,'Jaime','Farfán','jfarfan@gmail.com','$2y$10$szXvS8zmEygvQp1X2R/3P.MpiAwy2oCsb2du8WH61yTLHcAO8Lami',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 06:18:40','2019-06-26 08:02:54','0'),(3,1,'Mauricio','Galvez','mgalvez@gmail.com','$2y$10$g7pAbNWBonQFpg.Y2i8RfOZYtS2jIZtfULr.CG0Mth9iyqqkyBJsa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2019-06-26 09:31:42','2019-06-26 09:32:04','1'),(4,2,'Jaime','Farfán','jfarfan@tecsup.edu.pe','$2y$12$CBd4IgbYnDIYv4sKqOP6Q.diBu/U44ot7wXu26eB4DcNp6Z2WOQKG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 09:46:47','2019-06-26 09:46:47','0'),(5,3,'Victor','Saico','victor.saico@tecsup.edu.pe','$2y$10$nkQZLVLrfl/VEc32t4G7DOyl1s1u0bPRUMmj1ukTSQV6mDB68/X8O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 09:48:39','2019-06-26 09:48:39','0'),(6,3,'Linder','Hassinger','linder.hassinger@tecsup.edu.pe','$2y$12$CBd4IgbYnDIYv4sKqOP6Q.diBu/U44ot7wXu26eB4DcNp6Z2WOQKG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-07-31 15:42:44',NULL,'0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_books`
--

DROP TABLE IF EXISTS `users_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_books` (
  `users_id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`,`books_id`),
  KEY `fk_users_has_books_books1_idx` (`books_id`),
  KEY `fk_users_has_books_users1_idx` (`users_id`),
  CONSTRAINT `fk_users_has_books_books1` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_books_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_books`
--

LOCK TABLES `users_books` WRITE;
/*!40000 ALTER TABLE `users_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_courses`
--

DROP TABLE IF EXISTS `users_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_courses` (
  `users_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`,`courses_id`),
  KEY `fk_users_has_courses_courses1_idx` (`courses_id`),
  KEY `fk_users_has_courses_users1_idx` (`users_id`),
  CONSTRAINT `fk_users_has_courses_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_courses`
--

LOCK TABLES `users_courses` WRITE;
/*!40000 ALTER TABLE `users_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_lessons`
--

DROP TABLE IF EXISTS `users_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_lessons` (
  `users_id` int(11) NOT NULL,
  `lessons_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`,`lessons_id`),
  KEY `fk_users_has_lessons_lessons1_idx` (`lessons_id`),
  KEY `fk_users_has_lessons_users1_idx` (`users_id`),
  CONSTRAINT `fk_users_has_lessons_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_lessons_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_lessons`
--

LOCK TABLES `users_lessons` WRITE;
/*!40000 ALTER TABLE `users_lessons` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_lessons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-20 22:42:38
