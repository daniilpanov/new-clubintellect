-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: clubintellect
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `constants`
--

DROP TABLE IF EXISTS `constants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constants` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  `domainname` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `footer` varchar(255) NOT NULL,
  `reviews_on_page` int(4) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `reviews_neighbor_links` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constants`
--

LOCK TABLES `constants` WRITE;
/*!40000 ALTER TABLE `constants` DISABLE KEYS */;
INSERT INTO `constants` (`id`, `language`, `domainname`, `site`, `footer`, `reviews_on_page`, `admin_email`, `reviews_neighbor_links`) VALUES (1,'ru','http://localhost/clubintellect','Название Сайта','Не является публичной офертой',3,'daniil_panov2005@mail.ru',2),(2,'en','http://localhost/clubintellect','Site name','Not a public offer',3,'daniil_panov2005@mail.ru',2);
/*!40000 ALTER TABLE `constants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `visible` enum('0','1') NOT NULL,
  `default_lng` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `language`, `title`, `visible`, `default_lng`) VALUES (1,'ru','русский','1','1'),(2,'en','english','1','0');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `position` int(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `created` int(255) NOT NULL,
  `lastmod` int(255) NOT NULL,
  `visible` enum('0','1') NOT NULL,
  `header_visible` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `menu_name`, `position`, `language`, `created`, `lastmod`, `visible`, `header_visible`) VALUES (1,'Мы предлагаем',4,'ru',1555684323,0,'1','1'),(2,'We offer',17,'en',1555684323,0,'1','1'),(3,'Test 6.0',5,'ru',1555684363,1556122126,'1','1'),(4,'Test 333',18,'en',1558713800,0,'1','1'),(5,'Test 444',6,'ru',1558713822,1558955568,'1','1'),(8,'testtttttttttttttttttttttttt',19,'en',1558714085,0,'1','1');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(3) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `icon_size` varchar(255) NOT NULL,
  `menu_number` int(4) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `language` varchar(255) NOT NULL,
  `created` int(255) NOT NULL,
  `lastmod` int(255) NOT NULL,
  `visible` enum('0','1') NOT NULL,
  `visible_in_main_menu` enum('0','1') NOT NULL,
  `visible_in_sidebar` enum('0','1') NOT NULL,
  `active_link_in_sidebar` enum('0','1') NOT NULL,
  `reviews_visible` enum('0','1') NOT NULL,
  `reviews_add` enum('0','1') NOT NULL,
  `contacts_visible` enum('0','1') NOT NULL,
  `contacts_files_attach` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `parent_id`, `description`, `keywords`, `title`, `menu_icon`, `icon_size`, `menu_number`, `menu_name`, `position`, `content`, `language`, `created`, `lastmod`, `visible`, `visible_in_main_menu`, `visible_in_sidebar`, `active_link_in_sidebar`, `reviews_visible`, `reviews_add`, `contacts_visible`, `contacts_files_attach`) VALUES (1,0,'','','адрес сайта | Ключевое слово | Главная','icon-home','icon-large',1,'Главная',4,'Главная','ru',1555684323,0,'1','1','1','1','1','0','0','0'),(2,0,'','','site address | Keyword | Main','icon-home','icon-large',2,'Main',6,'Main','en',1555684323,0,'1','1','1','1','1','0','0','0'),(5,0,'','','адрес сайта | Ключевое слово | Отзывы','icon-comments','icon-large',0,'Отзывы',11,'','ru',1555684323,0,'1','1','0','1','1','1','0','0'),(6,0,'','','адрес сайта | Ключевое слово | Контакты','icon-envelope','icon-large',0,'Контакты',12,'','ru',1555684323,0,'1','1','0','1','0','0','1','0'),(7,0,'','','site address | Keyword | Reviews','icon-comments','icon-large',0,'Reviews',12,'','en',1555684323,0,'1','1','0','1','1','1','0','0'),(8,0,'','','site address | Keyword | Contacts','icon-envelope','icon-large',0,'Contacts',20,'','en',1555684323,0,'1','1','0','1','0','0','1','0'),(3,1,'','','адрес сайта | Ключевое слово | Пример страницы','icon-briefcase','icon-large',1,'Пример страницы',5,'Пример страницы','ru',1555684323,0,'1','0','1','1','1','0','0','0'),(4,2,'','','site address | Keyword | Example page','icon-briefcase','icon-large',2,'Example page',7,'Example page','en',1555684323,0,'1','0','1','1','1','0','0','0'),(9,1,'','','','','icon-large',1,'Test 7.0',9,'','ru',1556122368,1556122478,'1','1','1','1','0','0','0','0'),(10,0,'','','','','icon-1x',0,'Router test 0.02',13,'<p>\r\n	...............</p>\r\n','ru',1557492990,1558956683,'1','0','1','1','0','0','0','0');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `page_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `language` varchar(4) NOT NULL,
  `review` text NOT NULL,
  `autor` varchar(255) NOT NULL,
  `visible` enum('0','1') NOT NULL,
  `state` varchar(255) NOT NULL,
  `created` int(255) NOT NULL,
  `lastmod` int(255) NOT NULL,
  `rating` int(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `page_id`, `name`, `language`, `review`, `autor`, `visible`, `state`, `created`, `lastmod`, `rating`, `email`) VALUES (1,5,'Первый отзыв','ru','Очень хороший отзыв','Администратор сайта','1','good',1555684323,0,5,'clubintellect@mail.ru'),(2,7,'First review','en','Very good review','Site administrator','1','good',1555684323,0,5,'clubintellect@mail.ru'),(3,5,'Второй отзыв','ru\r\n','Пример отзыва','Администратор сайта','1','good',1555684323,0,4,'clubintellect@mail.ru'),(4,5,'Тестовый отзыв 1','ru','...','Даниил','1','new',1556895037,0,5,'daniil_panov2005@mail.ru'),(5,7,'Тестовый отзыв 2','en','...','Даниил Панов','1','new',1556895787,0,5,'daniil_panov2005@mail.ru');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`) VALUES (1,'admin','1c3de58a15c54104429f1f93066daa59');
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

-- Dump completed on 2019-09-13 18:36:42
