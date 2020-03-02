/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.26 : Database - aulif
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aulif` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `aulif`;

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `books` */

insert  into `books`(`id`,`title`,`created_at`,`updated_at`,`deleted`) values 
(1,'Matemática 3ro','2019-06-24 23:58:52','2019-06-24 23:58:52','0'),
(2,'Matemática 4to','2019-06-24 23:59:36','2019-06-24 23:59:36','0'),
(3,'Matemática 5to','2019-06-24 23:59:54','2019-06-24 23:59:54','0');

/*Table structure for table `books_lessons` */

DROP TABLE IF EXISTS `books_lessons`;

CREATE TABLE `books_lessons` (
  `lessons_id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  PRIMARY KEY (`lessons_id`,`books_id`),
  KEY `fk_lessons_has_books_books1_idx` (`books_id`),
  KEY `fk_lessons_has_books_lessons_idx` (`lessons_id`),
  CONSTRAINT `fk_lessons_has_books_books1` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_has_books_lessons` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `books_lessons` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` char(2) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `countries` */

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `courses` */

insert  into `courses`(`id`,`title`,`created_at`,`updated_at`,`deleted`) values 
(1,'Álgebra','2019-06-24 23:57:40','2019-06-24 23:57:40','0'),
(2,'Aritmética','2019-06-24 23:57:50','2019-06-24 23:57:50','0'),
(3,'Estadística','2019-06-24 23:57:59','2019-06-24 23:57:59','0'),
(4,'Geometría','2019-06-24 23:58:11','2019-06-24 23:58:11','0'),
(5,'Geometría Analítica','2019-06-24 23:58:23','2019-06-24 23:58:23','0'),
(6,'Trigonometría','2019-06-24 23:58:30','2019-06-24 23:58:30','0'),
(9,'Test','2019-06-25 03:18:02','2019-06-26 01:26:58','0');

/*Table structure for table `courses_lessons` */

DROP TABLE IF EXISTS `courses_lessons`;

CREATE TABLE `courses_lessons` (
  `lessons_id` int(11) NOT NULL,
  `courses_id` int(11) NOT NULL,
  PRIMARY KEY (`lessons_id`,`courses_id`),
  KEY `fk_lessons_has_courses_courses1_idx` (`courses_id`),
  KEY `fk_lessons_has_courses_lessons1_idx` (`lessons_id`),
  CONSTRAINT `fk_lessons_has_courses_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_has_courses_lessons1` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `courses_lessons` */

insert  into `courses_lessons`(`lessons_id`,`courses_id`) values 
(3,9),
(5,9),
(6,9),
(7,9),
(10,9),
(11,9);

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `departments` */

/*Table structure for table `districts` */

DROP TABLE IF EXISTS `districts`;

CREATE TABLE `districts` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `provinces_id` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_districts_provinces1_idx` (`provinces_id`),
  CONSTRAINT `fk_districts_provinces1` FOREIGN KEY (`provinces_id`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `districts` */

/*Table structure for table `lessons` */

DROP TABLE IF EXISTS `lessons`;

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `lessons` */

insert  into `lessons`(`id`,`title`,`created_at`,`updated_at`,`deleted`) values 
(2,'Teoría de exponentes y radicales','2019-06-24 13:51:40','2019-06-24 13:51:40','0'),
(3,'Logaritmos','2019-06-24 13:51:51','2019-06-24 13:51:51','0'),
(4,'Polinomios','2019-06-24 13:51:59','2019-06-24 13:51:59','0'),
(5,'División algebraica','2019-06-24 13:52:06','2019-06-24 13:52:06','0'),
(6,'Productos notables','2019-06-24 13:52:40','2019-06-24 13:52:40','0'),
(7,'Factorización','2019-06-24 13:52:48','2019-06-24 13:52:48','0'),
(8,'Fracciones algebraicas','2019-06-24 13:52:56','2019-06-24 13:52:56','0'),
(9,'Ecuaciones de primer grado','2019-06-24 13:53:04','2019-06-24 13:53:04','0'),
(10,'Ecuaciones de segundo grado','2019-06-24 13:53:12','2019-06-24 13:53:12','0'),
(11,'Ecuaciones exponenciales y logarítmicas','2019-06-24 13:53:24','2019-06-24 13:53:24','0'),
(12,'Inecuaciones de primer grado','2019-06-24 13:53:32','2019-06-24 13:53:32','0'),
(13,'Inecuaciones de segundo grado','2019-06-24 13:53:44','2019-06-24 13:53:44','0'),
(14,'Inecuaciones polinomiales','2019-06-24 13:53:51','2019-06-24 13:53:51','0'),
(15,'Inecuaciones racionales','2019-06-24 13:53:58','2019-06-24 13:53:58','0'),
(16,'Planteo de problemas','2019-06-24 13:54:06','2019-06-24 13:54:06','0'),
(17,'Relaciones y funciones','2019-06-24 13:54:15','2019-06-24 13:54:15','0'),
(18,'Funciones especiales I','2019-06-24 13:54:24','2019-06-24 13:54:24','0'),
(19,'Funciones especiales II','2019-06-24 13:54:33','2019-06-24 13:54:33','0'),
(20,'El sistema de los números complejos','2019-06-24 13:54:43','2019-06-24 13:54:43','0');

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` varchar(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `departments_id` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provinces_departments1_idx` (`departments_id`),
  CONSTRAINT `fk_provinces_departments1` FOREIGN KEY (`departments_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `provinces` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`id`,`title`) values 
(1,'Administrador'),
(2,'Profesor'),
(3,'Alumno');

/*Table structure for table `schools` */

DROP TABLE IF EXISTS `schools`;

CREATE TABLE `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `schools` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`roles_id`,`firstname`,`lastname`,`email`,`password`,`birthdate`,`gender`,`countries_id`,`districts_id`,`schools_id`,`filename`,`filetype`,`filesize`,`remember_token`,`status`,`created_at`,`updated_at`,`deleted`) values 
(1,1,'Erick','Benites','erick.benites@gmail.com','$2y$12$CBd4IgbYnDIYv4sKqOP6Q.diBu/U44ot7wXu26eB4DcNp6Z2WOQKG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-25 20:00:13',NULL,'0'),
(2,1,'Jaime','Farfán','jfarfan@gmail.com','$2y$10$szXvS8zmEygvQp1X2R/3P.MpiAwy2oCsb2du8WH61yTLHcAO8Lami',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 01:18:40','2019-06-26 03:02:54','0'),
(3,1,'Mauricio','Galvez','mgalvez@gmail.com','$2y$10$g7pAbNWBonQFpg.Y2i8RfOZYtS2jIZtfULr.CG0Mth9iyqqkyBJsa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2019-06-26 04:31:42','2019-06-26 04:32:04','1'),
(4,2,'Jaime','Benites','jfarfan@tecsup.edu.pe','$2y$10$BQ.BVhYCEi61BI.kqwYdwuumLuF/cqhgtg57sdPX3WS8XxPqnbfuO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 04:46:47','2019-06-26 04:46:47','0'),
(5,3,'Victor','Saico','victor.saico@tecsup.edu.pe','$2y$10$nkQZLVLrfl/VEc32t4G7DOyl1s1u0bPRUMmj1ukTSQV6mDB68/X8O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2019-06-26 04:48:39','2019-06-26 04:48:39','0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
