-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,1,'Category 1','category-1','2018-04-07 18:51:00','2018-04-07 18:51:00'),(2,NULL,1,'Category 2','category-2','2018-04-07 18:51:00','2018-04-07 18:51:00');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,'',1),(2,1,'author_id','text','Author',1,0,1,1,0,1,'',2),(3,1,'category_id','text','Category',1,0,1,1,1,0,'',3),(4,1,'title','text','Title',1,1,1,1,1,1,'',4),(5,1,'excerpt','text_area','Excerpt',1,0,1,1,1,1,'',5),(6,1,'body','rich_text_box','Body',1,0,1,1,1,1,'',6),(7,1,'image','image','Post Image',0,1,1,1,1,1,'{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}',7),(8,1,'slug','text','Slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true}}',8),(9,1,'meta_description','text_area','Meta Description',1,0,1,1,1,1,'',9),(10,1,'meta_keywords','text_area','Meta Keywords',1,0,1,1,1,1,'',10),(11,1,'status','select_dropdown','Status',1,1,1,1,1,1,'{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}',11),(12,1,'created_at','timestamp','Created At',0,1,1,0,0,0,'',12),(13,1,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',13),(14,2,'id','number','ID',1,0,0,0,0,0,'',1),(15,2,'author_id','text','Author',1,0,0,0,0,0,'',2),(16,2,'title','text','Title',1,1,1,1,1,1,'',3),(17,2,'excerpt','text_area','Excerpt',1,0,1,1,1,1,'',4),(18,2,'body','rich_text_box','Body',1,0,1,1,1,1,'',5),(19,2,'slug','text','Slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\"}}',6),(20,2,'meta_description','text','Meta Description',1,0,1,1,1,1,'',7),(21,2,'meta_keywords','text','Meta Keywords',1,0,1,1,1,1,'',8),(22,2,'status','select_dropdown','Status',1,1,1,1,1,1,'{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}',9),(23,2,'created_at','timestamp','Created At',1,1,1,0,0,0,'',10),(24,2,'updated_at','timestamp','Updated At',1,0,0,0,0,0,'',11),(25,2,'image','image','Page Image',0,1,1,1,1,1,'',12),(26,3,'id','number','ID',1,0,1,1,0,0,NULL,1),(27,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(28,3,'email','text','Email',1,1,1,1,1,1,NULL,3),(29,3,'password','password','Password',1,0,0,1,1,0,NULL,4),(30,3,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"roles\",\"pivot\":\"0\"}',11),(31,3,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,5),(32,3,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(33,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(34,3,'avatar','image','Avatar',0,1,1,1,1,1,NULL,8),(35,5,'id','number','ID',1,0,0,0,0,0,'',1),(36,5,'name','text','Name',1,1,1,1,1,1,'',2),(37,5,'created_at','timestamp','Created At',0,0,0,0,0,0,'',3),(38,5,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',4),(39,4,'id','number','ID',1,0,0,0,0,0,'',1),(40,4,'parent_id','select_dropdown','Parent',0,0,1,1,1,1,'{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),(41,4,'order','text','Order',1,1,1,1,1,1,'{\"default\":1}',3),(42,4,'name','text','Name',1,1,1,1,1,1,'',4),(43,4,'slug','text','Slug',1,1,1,1,1,1,'{\"slugify\":{\"origin\":\"name\"}}',5),(44,4,'created_at','timestamp','Created At',0,0,1,0,0,0,'',6),(45,4,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',7),(46,6,'id','number','ID',1,0,0,0,0,0,'',1),(47,6,'name','text','Name',1,1,1,1,1,1,'',2),(48,6,'created_at','timestamp','Created At',0,0,0,0,0,0,'',3),(49,6,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'',4),(50,6,'display_name','text','Display Name',1,1,1,1,1,1,'',5),(51,1,'seo_title','text','SEO Title',0,1,1,1,1,1,'',14),(52,1,'featured','checkbox','Featured',1,1,1,1,1,1,'',15),(53,3,'role_id','text','Role',0,1,1,1,1,1,NULL,10),(54,9,'id','text','Šifra',1,1,1,1,1,1,NULL,1),(55,9,'naziv','text','Naziv',1,1,1,1,1,1,NULL,2),(58,9,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,5),(59,9,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(60,10,'id','text','Šifra',1,1,1,1,0,1,NULL,1),(61,10,'znamka','text','Znamka',1,1,1,1,1,1,NULL,2),(62,10,'model','text','Model',1,1,1,1,1,1,NULL,3),(63,10,'registrska_st','text','Registrska št.',1,1,1,1,1,1,NULL,4),(64,10,'st_sasije','text','VIN',1,1,1,1,1,1,NULL,5),(65,10,'moc_motorja','text','Moč Motorja [KW]',1,1,1,1,1,1,NULL,6),(66,10,'tip_motorja','text','Tip Motorja',1,1,1,1,1,1,NULL,7),(67,10,'prva_registracija','date','Prva Registracija',1,1,1,1,1,1,NULL,8),(68,10,'km','text','Km',1,1,1,1,1,1,NULL,9),(69,10,'ccm','text','Ccm',1,1,1,1,1,1,NULL,10),(70,10,'gorivo','text','Gorivo',1,1,1,1,1,1,NULL,11),(71,10,'pogon','text','Pogon',1,1,1,1,1,1,NULL,12),(72,10,'menjalnik','text','Menjalnik',1,1,1,1,1,1,NULL,13),(73,10,'komercialno_vozilo','checkbox','Komercialno Vozilo',1,1,1,1,1,1,NULL,14),(74,10,'datum_prodaje','date','Datum Prodaje',1,1,1,1,1,1,NULL,15),(75,10,'veljavnost_od','date','Veljavnost Od',1,1,1,1,1,1,NULL,16),(76,10,'status','text','Status',1,1,1,1,1,1,NULL,17),(77,10,'status_datum','date','Status Datum',1,1,1,1,1,1,NULL,18),(78,10,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,19),(79,10,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,20),(80,11,'id','text','Id',1,0,0,0,0,0,NULL,1),(81,11,'ime','text','Ime',1,1,1,1,1,1,NULL,2),(82,11,'priimek','text','Priimek',1,1,1,1,1,1,NULL,3),(83,11,'kontaktna_st','text','Kontaktna št',1,1,1,1,1,1,NULL,4),(84,11,'naslov','text','Naslov',1,1,1,1,1,1,NULL,5),(85,11,'postna_st','text','Poštna St',1,1,1,1,1,1,NULL,6),(86,11,'posta_kraj','text','Kraj',1,1,1,1,1,1,NULL,7),(87,11,'kraj_rojstva','text','Kraj Rojstva',1,1,1,1,1,1,NULL,8),(88,11,'datum_rojstva','date','Datum Rojstva',1,1,1,1,1,1,NULL,9),(89,11,'email','text','Email',1,1,1,1,1,1,NULL,10),(90,11,'id_avtohise','text','Id Avtohise',1,1,1,1,1,1,NULL,11),(91,11,'soglasje_1','checkbox','Soglasje 1',1,1,1,1,1,1,NULL,12),(92,11,'soglasje_2','checkbox','Soglasje 2',1,1,1,1,1,1,NULL,13),(93,11,'soglasje_3','checkbox','Soglasje 3',1,1,1,1,1,1,NULL,14),(94,11,'datum_pogodbe','date','Datum Pogodbe',1,1,1,1,1,1,NULL,15),(95,11,'status','text','Status',1,1,1,1,1,1,NULL,16),(96,11,'status_datum','date','Status Datum',1,1,1,1,1,1,NULL,17),(97,11,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,18),(98,11,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,19),(99,13,'id','text','Status',1,1,1,1,1,1,NULL,1),(100,13,'naziv','text','Naziv',1,1,1,1,1,1,NULL,2),(101,13,'created_at','timestamp','Datum vnosa',0,1,0,1,0,1,NULL,3),(102,13,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(103,14,'id','text','Id',1,0,0,0,0,0,NULL,1),(104,14,'naziv','text','Naziv',1,1,1,1,1,1,NULL,2),(107,14,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,5),(108,14,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(109,15,'id','text','Id',1,1,1,1,1,1,NULL,1),(110,15,'vozilo_id','text','Vozilo',1,1,1,1,1,1,NULL,2),(111,15,'uporabnik_id','text','Uporabnik',1,1,1,1,1,1,NULL,3),(112,15,'status','checkbox','Status',1,1,1,1,1,1,NULL,4),(113,15,'status_datum','checkbox','Status Datum',1,1,1,1,1,1,NULL,5),(114,15,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,6),(115,15,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(116,17,'id','number','ID',1,1,0,1,1,0,NULL,1),(117,17,'tip_jamstva','text','Tip Jamstva',1,1,1,1,1,1,'{\"default\":\"0\",\"options\":{\"1\":\"PRIMA\",\"2\":\"INTENSA\",\"3\":\"SUPREMA\"}}',2),(118,17,'veljavnost_mesecev','number','Veljavnost Mesecev',1,0,1,1,1,1,NULL,3),(119,17,'dodatek_avt_menj','select_dropdown','Dodatek avt. menjalnik',0,1,1,1,1,1,'{\"default\":\"0\",\"options\":{\"0\":\"NE\",\"1\":\"DA\"}}',4),(120,17,'dodatek_km','select_dropdown','Dodatek Km',0,1,1,1,1,1,'{\"default\":\"0\",\"options\":{\"0\":\"NE\",\"1\":\"DA\"}}',5),(122,17,'soglasje_1','checkbox','Soglasje 1',0,0,1,1,1,1,NULL,7),(123,17,'soglasje_2','checkbox','Soglasje 2',0,0,1,1,1,1,NULL,8),(124,17,'soglasje_3','checkbox','Soglasje 3',0,0,1,1,1,1,NULL,9),(125,17,'datum_pogodbe','date','Datum Pogodbe',0,0,1,1,1,1,NULL,10),(126,17,'ime_priimek','text','Ime Priimek',1,1,1,1,1,1,NULL,11),(127,17,'kontaktna_st','text','Kontaktna St',0,1,1,1,1,1,NULL,12),(128,17,'naslov','text','Naslov',1,1,1,1,1,1,NULL,13),(129,17,'postna_st','text','Postna St',1,1,1,1,1,1,NULL,14),(130,17,'kraj','text','Kraj',0,1,1,1,1,1,NULL,15),(131,17,'kraj_rojstva','text','Kraj Rojstva',0,0,1,1,1,1,NULL,16),(132,17,'datum_rojstva','date','Datum Rojstva',0,0,1,1,1,1,NULL,17),(133,17,'email','text','Email',0,0,1,1,1,1,NULL,18),(134,17,'znamka','text','Znamka',0,1,1,1,1,1,NULL,19),(135,17,'model','text','Model',1,1,1,1,1,1,NULL,20),(136,17,'registrska_st','text','Registrska St',1,1,1,1,1,1,NULL,21),(137,17,'st_sasije','text','St Sasije',1,0,1,1,1,1,NULL,22),(138,17,'moc_motorja','text','Moc Motorja',0,0,1,1,1,1,NULL,23),(139,17,'tip_motorja','text','Tip Motorja',0,0,1,1,1,1,NULL,24),(140,17,'datum_prve_reg','date','Datum Prve Reg',1,0,1,1,1,1,NULL,25),(141,17,'km','number','Km',1,0,1,1,1,1,NULL,26),(142,17,'ccm','number','Ccm',1,0,1,1,1,1,NULL,27),(143,17,'gorivo','select_dropdown','Gorivo',0,0,1,1,1,1,'{\"default\":\"B\",\"options\":{\"B\":\"BENCIN\",\"D\":\"DIESEL\",\"X\":\"DRUGO\"}}',28),(144,17,'pogon','select_dropdown','Pogon',0,0,1,1,1,1,'{\"default\":\"2WD\",\"options\":{\"2WD\":\"Dvokolesni\",\"4WD\":\"Štirikolesni\"}}',29),(145,17,'menjalnik','select_dropdown','Menjalnik',1,0,1,1,1,1,'{\"default\":\"R\",\"options\":{\"R\":\"Ročni\",\"A\":\"Avtomatski\"}}',30),(146,17,'komercialno_vozilo','select_dropdown','Komercialno Vozilo',0,0,1,1,1,1,'{\"default\":\"0\",\"options\":{\"0\":\"NE\",\"1\":\"DA\"}}',31),(147,17,'datum_predaje','date','Datum Predaje',0,0,1,1,1,1,NULL,32),(148,17,'datum_jamstvo_od','date','Datum Jamstva Od',0,0,1,1,1,1,NULL,33),(149,17,'created_at','timestamp','Datum vnosa',0,1,1,1,0,1,NULL,34),(150,17,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,35),(152,17,'sifra','text','Šifra SLP',0,1,1,1,1,1,NULL,2),(153,17,'datum_podpisa','date','Datum Podpisa',0,1,1,1,1,1,NULL,12),(154,17,'datum_soglasja','date','Datum Soglasja',0,1,1,1,1,1,NULL,13),(155,17,'userId','text','UserId',1,1,1,1,1,1,NULL,37),(156,17,'status','number','Status',1,1,1,1,1,1,NULL,38),(157,14,'koda','text','Koda',1,1,1,1,1,1,NULL,2),(158,14,'prevozeni_km','text','Prevozeni Km',1,1,1,1,1,1,NULL,4),(159,14,'starost_vozila','text','Starost Vozila',1,1,1,1,1,1,NULL,5),(160,14,'prostornina_motorja_od','text','Prostornina Motorja Od',1,1,1,1,1,1,NULL,6),(161,14,'prostornina_motorja_do','text','Prostornina Motorja Do',1,1,1,1,1,1,NULL,7),(162,18,'id','text','Šifra',1,1,1,1,1,1,NULL,1),(163,18,'opis','text','Naziv',1,1,1,1,1,1,NULL,2),(164,18,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,3),(165,18,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(166,3,'sifra_avtohise','text','Sifra Avtohise',0,1,1,1,1,1,NULL,9),(167,17,'sifra_avtohise','text','Sifra Avtohise',1,1,1,1,1,1,NULL,7),(168,17,'id_znamke','checkbox','Id Znamke',1,1,1,1,1,1,NULL,22);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'posts','posts','Post','Posts','voyager-news','TCG\\Voyager\\Models\\Post','TCG\\Voyager\\Policies\\PostPolicy','','',1,0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(2,'pages','pages','Page','Pages','voyager-file-text','TCG\\Voyager\\Models\\Page',NULL,'','',1,0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy',NULL,NULL,1,0,'2018-04-07 18:51:00','2018-05-21 20:07:54'),(4,'categories','categories','Category','Categories','voyager-categories','TCG\\Voyager\\Models\\Category',NULL,'','',1,0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'','',1,0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(9,'sv_prodajalci','prodajalci','Prodajalec','Prodajalci',NULL,'App\\Prodajalec',NULL,NULL,'Seznam prodajalcev',1,1,'2018-04-07 19:12:29','2018-04-07 19:12:29'),(10,'sv_vozila','vozila','Vozilo','Vozila',NULL,'App\\Vozilo',NULL,NULL,NULL,1,1,'2018-04-17 14:17:45','2018-04-17 14:17:45'),(11,'sv_uporabniki','uporabniki','Uporabnik','Uporabniki',NULL,'App\\Uporabnik',NULL,NULL,NULL,1,1,'2018-04-17 14:29:38','2018-04-17 14:29:38'),(13,'si_statusi','statusi','Status','Statusi',NULL,'App\\Status',NULL,NULL,NULL,1,0,'2018-04-17 14:56:08','2018-04-17 14:56:08'),(14,'sv_jamstva_tipi','jamstva-tipi','Tip jamstva','Tipi jamstev',NULL,'App\\JamstvoTip',NULL,NULL,NULL,1,0,'2018-04-17 15:34:14','2018-04-17 15:34:14'),(15,'sv_jamstva','jamstva','Jamstvo','Jamstva',NULL,'App\\Jamstvo',NULL,NULL,NULL,1,1,'2018-04-19 09:22:51','2018-04-19 09:22:51'),(17,'sv_kartice_vozil','aktivacija-jamstva','Aktivacija jamstva','Aktivacija jamstev',NULL,'App\\KarticaVozila',NULL,NULL,NULL,1,1,'2018-05-15 19:50:07','2018-05-15 19:50:07'),(18,'rv_znamke','znamke-vozil','Znamka Vozila','Znamke Vozil',NULL,'App\\ZnamkaVozila',NULL,NULL,NULL,1,0,'2018-05-28 19:38:54','2018-05-28 19:38:54');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2018-04-07 18:51:00','2018-04-07 18:51:00','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,9,'2018-04-07 18:51:00','2018-05-28 19:42:55','voyager.media.index',NULL),(4,1,'Users','','_self','voyager-person',NULL,NULL,8,'2018-04-07 18:51:00','2018-05-28 19:42:55','voyager.users.index',NULL),(7,1,'Roles','','_self','voyager-lock',NULL,NULL,7,'2018-04-07 18:51:00','2018-05-28 19:42:55','voyager.roles.index',NULL),(8,1,'Tools','','_self','voyager-tools',NULL,NULL,10,'2018-04-07 18:51:00','2018-05-28 19:42:55',NULL,NULL),(9,1,'Menu Builder','','_self','voyager-list',NULL,8,1,'2018-04-07 18:51:00','2018-04-07 19:28:09','voyager.menus.index',NULL),(10,1,'Database','','_self','voyager-data',NULL,8,2,'2018-04-07 18:51:00','2018-04-07 19:28:09','voyager.database.index',NULL),(11,1,'Compass','','_self','voyager-compass',NULL,8,3,'2018-04-07 18:51:00','2018-04-07 19:28:09','voyager.compass.index',NULL),(12,1,'Settings','','_self','voyager-settings',NULL,NULL,11,'2018-04-07 18:51:00','2018-05-28 19:42:55','voyager.settings.index',NULL),(13,1,'Hooks','','_self','voyager-hook',NULL,8,4,'2018-04-07 18:51:00','2018-04-07 19:28:09','voyager.hooks',NULL),(16,2,'Prodajalci','admin/prodajalci','_self',NULL,'#000000',20,2,'2018-04-07 19:30:07','2018-04-17 15:37:46',NULL,''),(20,2,'Šifranti','','_self',NULL,'#000000',NULL,2,'2018-04-07 19:38:43','2018-05-31 19:27:48',NULL,''),(23,2,'Administrator','admin','_self',NULL,'#000000',44,1,'2018-04-16 19:47:47','2018-05-31 19:30:00',NULL,''),(26,1,'Statusi','admin/statusi','_self',NULL,'#000000',NULL,6,'2018-04-17 14:54:29','2018-05-28 19:42:55',NULL,''),(28,2,'Statusi','admin/statusi','_self',NULL,'#000000',20,3,'2018-04-17 15:10:44','2018-05-31 19:29:15',NULL,''),(29,1,'Tipi jamstev','/admin/jamstva-tipi','_self',NULL,NULL,NULL,3,'2018-04-17 15:34:14','2018-05-15 19:51:12',NULL,NULL),(31,2,'Tipi jamstev','admin/jamstva-tipi','_self',NULL,'#000000',20,1,'2018-04-17 15:37:35','2018-04-17 15:37:46',NULL,''),(33,1,'Aktivacija jamstev','/admin/aktivacija-jamstva','_self',NULL,NULL,NULL,2,'2018-05-15 19:50:07','2018-05-15 19:51:12',NULL,NULL),(35,2,'Seznam Aktivacij','aktivacija-jamstva','_self',NULL,'#000000',41,2,'2018-05-15 19:51:38','2018-05-31 19:28:24',NULL,''),(36,1,'Znamke Vozil','/admin/znamke-vozil','_self',NULL,NULL,NULL,4,'2018-05-28 19:38:55','2018-05-28 19:42:55',NULL,NULL),(37,1,'Prodajalci','admin/prodajalci','_self',NULL,'#000000',NULL,5,'2018-05-28 19:42:49','2018-05-28 19:42:55',NULL,''),(38,3,'Aktivacija Jamstva','','_self',NULL,'#000000',NULL,1,'2018-05-31 19:24:52','2018-05-31 19:26:20',NULL,''),(39,3,'Nova Aktivacija','aktivacija-nova','_self',NULL,'#000000',38,1,'2018-05-31 19:26:17','2018-05-31 19:26:20',NULL,''),(40,3,'Seznam Aktivacij','aktivacija-jamstva','_self',NULL,'#000000',38,2,'2018-05-31 19:26:40','2018-05-31 19:26:44',NULL,''),(41,2,'Aktivacija jamstva','','_self',NULL,'#000000',NULL,1,'2018-05-31 19:27:44','2018-05-31 19:27:47',NULL,''),(42,2,'Nova Aktivacija','aktivacija-nova','_self',NULL,'#000000',41,1,'2018-05-31 19:28:19','2018-05-31 19:28:24',NULL,''),(43,2,'Znamke vozil','admin/znamke-vozil','_self',NULL,'#000000',20,4,'2018-05-31 19:29:11','2018-05-31 19:29:15',NULL,''),(44,2,'Upravljanje','','_self',NULL,'#000000',NULL,3,'2018-05-31 19:29:51','2018-05-31 19:30:00',NULL,''),(45,2,'Registracija uporabnika','/register','_self',NULL,'#000000',44,2,'2018-05-31 19:30:17','2018-05-31 19:30:20',NULL,'');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2018-04-07 18:51:00','2018-04-07 18:51:00'),(2,'main_menu','2018-04-07 19:29:29','2018-04-07 19:29:29'),(3,'main_menu_user','2018-05-31 19:01:02','2018-05-31 19:23:28');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (6,'2014_10_12_000000_create_users_table',1),(7,'2014_10_12_100000_create_password_resets_table',1),(29,'2016_01_01_000000_add_voyager_user_fields',2),(30,'2016_01_01_000000_create_data_types_table',2),(31,'2016_01_01_000000_create_pages_table',2),(32,'2016_01_01_000000_create_posts_table',2),(33,'2016_02_15_204651_create_categories_table',2),(34,'2016_05_19_173453_create_menu_table',2),(35,'2016_10_21_190000_create_roles_table',2),(36,'2016_10_21_190000_create_settings_table',2),(37,'2016_11_30_135954_create_permission_table',2),(38,'2016_11_30_141208_create_permission_role_table',2),(39,'2016_12_26_201236_data_types__add__server_side',2),(40,'2017_01_13_000000_add_route_to_menu_items_table',2),(41,'2017_01_14_005015_create_translations_table',2),(42,'2017_01_15_000000_add_permission_group_id_to_permissions_table',2),(43,'2017_01_15_000000_create_permission_groups_table',2),(44,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',2),(45,'2017_03_06_000000_add_controller_to_data_types_table',2),(46,'2017_04_11_000000_alter_post_nullable_fields_table',2),(47,'2017_04_21_000000_add_order_to_data_rows_table',2),(48,'2017_07_05_210000_add_policyname_to_data_types_table',2),(49,'2017_08_05_000000_add_group_to_settings_table',2),(136,'2018_04_05_200624_create_prodajalci_table',3),(137,'2018_04_05_200755_create_uporabniki_table',3),(138,'2018_04_05_200813_create_vozila_table',3),(139,'2018_04_05_200832_create_jamstva_table',3),(140,'2018_04_05_200848_create_predmeti_table',3),(141,'2018_04_05_200905_create_storitve_table',3),(142,'2018_04_17_144622_create_statusi_table',3),(143,'2018_04_17_152457_create_jamstva_tipi_table',3),(144,'2018_05_15_182958_create_kartice_table',3),(145,'2018_05_27_194735_create_znamka_vozila_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_jamstva`
--

DROP TABLE IF EXISTS `ms_jamstva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_jamstva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vozilo_id` int(11) NOT NULL,
  `uporabnik_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_jamstva`
--

LOCK TABLES `ms_jamstva` WRITE;
/*!40000 ALTER TABLE `ms_jamstva` DISABLE KEYS */;
/*!40000 ALTER TABLE `ms_jamstva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,0,'Hello World','Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.','<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','pages/page1.jpg','hello-world','Yar Meta Description','Keyword1, Keyword2','ACTIVE','2018-04-07 18:51:00','2018-04-07 18:51:00');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1);
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(2,'browse_database',NULL,'2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(3,'browse_media',NULL,'2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(4,'browse_compass',NULL,'2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(5,'browse_menus','menus','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(6,'read_menus','menus','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(7,'edit_menus','menus','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(8,'add_menus','menus','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(9,'delete_menus','menus','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(10,'browse_pages','pages','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(11,'read_pages','pages','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(12,'edit_pages','pages','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(13,'add_pages','pages','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(14,'delete_pages','pages','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(15,'browse_roles','roles','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(16,'read_roles','roles','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(17,'edit_roles','roles','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(18,'add_roles','roles','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(19,'delete_roles','roles','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(20,'browse_users','users','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(21,'read_users','users','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(22,'edit_users','users','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(23,'add_users','users','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(24,'delete_users','users','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(25,'browse_posts','posts','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(26,'read_posts','posts','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(27,'edit_posts','posts','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(28,'add_posts','posts','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(29,'delete_posts','posts','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(30,'browse_categories','categories','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(31,'read_categories','categories','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(32,'edit_categories','categories','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(33,'add_categories','categories','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(34,'delete_categories','categories','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(35,'browse_settings','settings','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(36,'read_settings','settings','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(37,'edit_settings','settings','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(38,'add_settings','settings','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(39,'delete_settings','settings','2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(40,'browse_hooks',NULL,'2018-04-07 18:51:00','2018-04-07 18:51:00',NULL),(41,'browse_sv_prodajalci','sv_prodajalci','2018-04-07 19:12:29','2018-04-07 19:12:29',NULL),(42,'read_sv_prodajalci','sv_prodajalci','2018-04-07 19:12:29','2018-04-07 19:12:29',NULL),(43,'edit_sv_prodajalci','sv_prodajalci','2018-04-07 19:12:29','2018-04-07 19:12:29',NULL),(44,'add_sv_prodajalci','sv_prodajalci','2018-04-07 19:12:29','2018-04-07 19:12:29',NULL),(45,'delete_sv_prodajalci','sv_prodajalci','2018-04-07 19:12:29','2018-04-07 19:12:29',NULL),(46,'browse_sv_vozila','sv_vozila','2018-04-17 14:17:45','2018-04-17 14:17:45',NULL),(47,'read_sv_vozila','sv_vozila','2018-04-17 14:17:45','2018-04-17 14:17:45',NULL),(48,'edit_sv_vozila','sv_vozila','2018-04-17 14:17:45','2018-04-17 14:17:45',NULL),(49,'add_sv_vozila','sv_vozila','2018-04-17 14:17:45','2018-04-17 14:17:45',NULL),(50,'delete_sv_vozila','sv_vozila','2018-04-17 14:17:45','2018-04-17 14:17:45',NULL),(51,'browse_sv_uporabniki','sv_uporabniki','2018-04-17 14:29:38','2018-04-17 14:29:38',NULL),(52,'read_sv_uporabniki','sv_uporabniki','2018-04-17 14:29:38','2018-04-17 14:29:38',NULL),(53,'edit_sv_uporabniki','sv_uporabniki','2018-04-17 14:29:38','2018-04-17 14:29:38',NULL),(54,'add_sv_uporabniki','sv_uporabniki','2018-04-17 14:29:38','2018-04-17 14:29:38',NULL),(55,'delete_sv_uporabniki','sv_uporabniki','2018-04-17 14:29:38','2018-04-17 14:29:38',NULL),(56,'browse_si_statusi','si_statusi','2018-04-17 14:56:08','2018-04-17 14:56:08',NULL),(57,'read_si_statusi','si_statusi','2018-04-17 14:56:08','2018-04-17 14:56:08',NULL),(58,'edit_si_statusi','si_statusi','2018-04-17 14:56:08','2018-04-17 14:56:08',NULL),(59,'add_si_statusi','si_statusi','2018-04-17 14:56:08','2018-04-17 14:56:08',NULL),(60,'delete_si_statusi','si_statusi','2018-04-17 14:56:08','2018-04-17 14:56:08',NULL),(61,'browse_sv_jamstva_tipi','sv_jamstva_tipi','2018-04-17 15:34:14','2018-04-17 15:34:14',NULL),(62,'read_sv_jamstva_tipi','sv_jamstva_tipi','2018-04-17 15:34:14','2018-04-17 15:34:14',NULL),(63,'edit_sv_jamstva_tipi','sv_jamstva_tipi','2018-04-17 15:34:14','2018-04-17 15:34:14',NULL),(64,'add_sv_jamstva_tipi','sv_jamstva_tipi','2018-04-17 15:34:14','2018-04-17 15:34:14',NULL),(65,'delete_sv_jamstva_tipi','sv_jamstva_tipi','2018-04-17 15:34:14','2018-04-17 15:34:14',NULL),(66,'browse_sv_jamstva','sv_jamstva','2018-04-19 09:22:51','2018-04-19 09:22:51',NULL),(67,'read_sv_jamstva','sv_jamstva','2018-04-19 09:22:51','2018-04-19 09:22:51',NULL),(68,'edit_sv_jamstva','sv_jamstva','2018-04-19 09:22:51','2018-04-19 09:22:51',NULL),(69,'add_sv_jamstva','sv_jamstva','2018-04-19 09:22:51','2018-04-19 09:22:51',NULL),(70,'delete_sv_jamstva','sv_jamstva','2018-04-19 09:22:51','2018-04-19 09:22:51',NULL),(71,'browse_sv_kartice_vozil','sv_kartice_vozil','2018-05-15 19:50:07','2018-05-15 19:50:07',NULL),(72,'read_sv_kartice_vozil','sv_kartice_vozil','2018-05-15 19:50:07','2018-05-15 19:50:07',NULL),(73,'edit_sv_kartice_vozil','sv_kartice_vozil','2018-05-15 19:50:07','2018-05-15 19:50:07',NULL),(74,'add_sv_kartice_vozil','sv_kartice_vozil','2018-05-15 19:50:07','2018-05-15 19:50:07',NULL),(75,'delete_sv_kartice_vozil','sv_kartice_vozil','2018-05-15 19:50:07','2018-05-15 19:50:07',NULL),(76,'browse_rv_znamke','rv_znamke','2018-05-28 19:38:55','2018-05-28 19:38:55',NULL),(77,'read_rv_znamke','rv_znamke','2018-05-28 19:38:55','2018-05-28 19:38:55',NULL),(78,'edit_rv_znamke','rv_znamke','2018-05-28 19:38:55','2018-05-28 19:38:55',NULL),(79,'add_rv_znamke','rv_znamke','2018-05-28 19:38:55','2018-05-28 19:38:55',NULL),(80,'delete_rv_znamke','rv_znamke','2018-05-28 19:38:55','2018-05-28 19:38:55',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,0,NULL,'Lorem Ipsum Post',NULL,'This is the excerpt for the Lorem Ipsum Post','<p>This is the body of the lorem ipsum post</p>','posts/post1.jpg','lorem-ipsum-post','This is the meta description','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(2,0,NULL,'My Sample Post',NULL,'This is the excerpt for the sample Post','<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>','posts/post2.jpg','my-sample-post','Meta Description for sample post','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(3,0,NULL,'Latest Post',NULL,'This is the excerpt for the latest post','<p>This is the body for the latest post</p>','posts/post3.jpg','latest-post','This is the meta description','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-04-07 18:51:00','2018-04-07 18:51:00'),(4,0,NULL,'Yarr Post',NULL,'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.','<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>','posts/post4.jpg','yarr-post','this be a meta descript','keyword1, keyword2, keyword3','PUBLISHED',0,'2018-04-07 18:51:00','2018-04-07 18:51:00');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2018-04-07 18:44:57','2018-04-07 18:44:57'),(2,'user','Normal User','2018-04-07 18:51:00','2018-04-07 18:51:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rv_znamke`
--

DROP TABLE IF EXISTS `rv_znamke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rv_znamke` (
  `id` int(11) NOT NULL,
  `opis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rv_znamke`
--

LOCK TABLES `rv_znamke` WRITE;
/*!40000 ALTER TABLE `rv_znamke` DISABLE KEYS */;
INSERT INTO `rv_znamke` VALUES (0,'','2018-05-31 18:22:49','2018-05-31 18:22:49'),(1,'CHEVROLET','2018-05-31 18:22:49','2018-05-31 18:22:49'),(2,'FIAT','2018-05-31 18:22:49','2018-05-31 18:22:49'),(3,'PEUGEOT','2018-05-31 18:22:49','2018-05-31 18:22:49'),(4,'CITROEN','2018-05-31 18:22:49','2018-05-31 18:22:49'),(5,'RENAULT','2018-05-31 18:22:49','2018-05-31 18:22:49'),(6,'AUDI','2018-05-31 18:22:49','2018-05-31 18:22:49'),(7,'SUZUKI','2018-05-31 18:22:49','2018-05-31 18:22:49'),(9,'DAEWOO','2018-05-31 18:22:49','2018-05-31 18:22:49'),(11,'VOLKSWAGEN','2018-05-31 18:22:49','2018-05-31 18:22:49'),(12,'FORD','2018-05-31 18:22:49','2018-05-31 18:22:49'),(13,'MERCEDES BENZ','2018-05-31 18:22:49','2018-05-31 18:22:49'),(15,'MITSUBISHI','2018-05-31 18:22:49','2018-05-31 18:22:49'),(16,'HYUNDAI','2018-05-31 18:22:49','2018-05-31 18:22:49'),(18,'NISSAN','2018-05-31 18:22:49','2018-05-31 18:22:49'),(19,'TOYOTA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(21,'SEAT','2018-05-31 18:22:49','2018-05-31 18:22:49'),(22,'DODGE','2018-05-31 18:22:49','2018-05-31 18:22:49'),(23,'VOLVO','2018-05-31 18:22:49','2018-05-31 18:22:49'),(24,'HONDA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(26,'BMW','2018-05-31 18:22:49','2018-05-31 18:22:49'),(27,'ŠKODA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(29,'MAZDA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(30,'ALFA ROMEO','2018-05-31 18:22:49','2018-05-31 18:22:49'),(32,'CHRYSLER','2018-05-31 18:22:49','2018-05-31 18:22:49'),(33,'KIA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(35,'MINI','2018-05-31 18:22:49','2018-05-31 18:22:49'),(42,'LANCIA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(46,'ZALHOO','2018-05-31 18:22:49','2018-05-31 18:22:49'),(47,'SUBARU','2018-05-31 18:22:49','2018-05-31 18:22:49'),(48,'JAGUAR','2018-05-31 18:22:49','2018-05-31 18:22:49'),(49,'OPEL','2018-05-31 18:22:49','2018-05-31 18:22:49'),(50,'MCC SMART','2018-05-31 18:22:49','2018-05-31 18:22:49'),(51,'LAND ROVER','2018-05-31 18:22:49','2018-05-31 18:22:49'),(52,'DACIA','2018-05-31 18:22:49','2018-05-31 18:22:49'),(53,'SAAB','2018-05-31 18:22:49','2018-05-31 18:22:49'),(54,'LEXUS','2018-05-31 18:22:49','2018-05-31 18:22:49'),(55,'SMART','2018-05-31 18:22:49','2018-05-31 18:22:49'),(56,'JEEP','2018-05-31 18:22:49','2018-05-31 18:22:49'),(57,'IVECO','2018-05-31 18:22:49','2018-05-31 18:22:49'),(58,'SSANGYONG','2018-05-31 18:22:49','2018-05-31 18:22:49'),(59,'INFINITI','2018-05-31 18:22:49','2018-05-31 18:22:49');
/*!40000 ALTER TABLE `rv_znamke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Site Tit','','text',1,'Site'),(2,'site.description','Site Description','Site Description','','text',2,'Site'),(3,'site.logo','Site Logo','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','','','image',5,'Admin'),(6,'admin.title','Admin Title','Admin','','text',1,'Admin'),(7,'admin.description','Admin Description','Sistemske nastavitve','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','settings/April2018/U4eDqCYdqemwPGJDMEQg.png','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `si_statusi`
--

DROP TABLE IF EXISTS `si_statusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `si_statusi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `si_statusi`
--

LOCK TABLES `si_statusi` WRITE;
/*!40000 ALTER TABLE `si_statusi` DISABLE KEYS */;
/*!40000 ALTER TABLE `si_statusi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss_predmeti`
--

DROP TABLE IF EXISTS `ss_predmeti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss_predmeti` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss_predmeti`
--

LOCK TABLES `ss_predmeti` WRITE;
/*!40000 ALTER TABLE `ss_predmeti` DISABLE KEYS */;
/*!40000 ALTER TABLE `ss_predmeti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss_storitve`
--

DROP TABLE IF EXISTS `ss_storitve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss_storitve` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss_storitve`
--

LOCK TABLES `ss_storitve` WRITE;
/*!40000 ALTER TABLE `ss_storitve` DISABLE KEYS */;
/*!40000 ALTER TABLE `ss_storitve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_jamstva`
--

DROP TABLE IF EXISTS `sv_jamstva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_jamstva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vozilo_id` int(11) NOT NULL,
  `uporabnik_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_jamstva`
--

LOCK TABLES `sv_jamstva` WRITE;
/*!40000 ALTER TABLE `sv_jamstva` DISABLE KEYS */;
/*!40000 ALTER TABLE `sv_jamstva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_jamstva_tipi`
--

DROP TABLE IF EXISTS `sv_jamstva_tipi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_jamstva_tipi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `koda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prevozeni_km` int(11) NOT NULL,
  `starost_vozila` int(11) NOT NULL,
  `prostornina_motorja_od` int(11) NOT NULL,
  `prostornina_motorja_do` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_jamstva_tipi`
--

LOCK TABLES `sv_jamstva_tipi` WRITE;
/*!40000 ALTER TABLE `sv_jamstva_tipi` DISABLE KEYS */;
INSERT INTO `sv_jamstva_tipi` VALUES (1,'','',0,0,0,0,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(2,'BASE 01','BASE od 0 do 1300 ccm',230000,13,0,1300,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(3,'BASE 02','BASE od 1301 do 2500 ccm',230000,13,1301,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(4,'BASE 03','BASE od 2501 do 4000 ccm',230000,13,2501,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(5,'BASE PKT1','BASE paket od 0 do 4000',230000,13,0,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(6,'BASE PKT2','BASE paket od 0 do 2500',230000,13,0,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(7,'INTENSA01','INTENSA od 0 do 1300 ccm',180000,10,0,1300,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(8,'INTENSA02','INTENSA od 1301 do 2500 ccm',180000,10,1301,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(9,'INTENSA03','INTENSA od 2501 do 4000 ccm',180000,10,2501,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(10,'INTENSAPK1','INTENSA PK1od 0 do 4000 ccm',180000,10,0,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(11,'INTENSAPK2','INTENSA PK2 od 0 do 2500 ccm',180000,10,0,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(12,'PRIMA01','PRIMA od 0 do 1300 ccm',200000,12,0,1300,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(13,'PRIMA02','PRIMA od 1301 do 2500 ccm',200000,12,1301,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(14,'PRIMA03','PRIMA od 2501 do 4000 ccm',200000,12,2501,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(15,'PRIMAPK1','PRIMA PK1 od 0 do 4000 ccm',200000,12,0,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(16,'PRIMAPK2','PRIMA PK2 od 0 do 2500 ccm',200000,12,0,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(17,'SUPREMA01','SUPREMA od 0 do 1300 ccm',150000,7,0,1300,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(18,'SUPREMA02','SUPREMA od 1301 do 2500 ccm',150000,7,1301,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(19,'SUPREMA03','SUPREMA od 2501 do 4000 ccm',150000,7,2501,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(20,'SUPREMAPK1','SUPREMA PK1 od 0 do 4000 ccm',150000,7,0,4000,'2018-05-31 18:22:45','2018-05-31 18:22:45'),(21,'SUPREMAPK2','SUPREMA PK2 od 0 do 2500 ccm',150000,7,0,2500,'2018-05-31 18:22:45','2018-05-31 18:22:45');
/*!40000 ALTER TABLE `sv_jamstva_tipi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_kartice_vozil`
--

DROP TABLE IF EXISTS `sv_kartice_vozil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_kartice_vozil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sifra` int(11) DEFAULT NULL,
  `tip_jamstva` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `veljavnost_mesecev` int(11) NOT NULL,
  `dodatek_avt_menj` int(11) DEFAULT '0',
  `dodatek_km` int(11) DEFAULT '0',
  `sifra_avtohise` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soglasje_1` int(11) DEFAULT '0',
  `soglasje_2` int(11) DEFAULT '0',
  `soglasje_3` int(11) DEFAULT '0',
  `datum_pogodbe` datetime DEFAULT NULL,
  `datum_podpisa` datetime DEFAULT NULL,
  `datum_soglasja` datetime DEFAULT NULL,
  `ime_priimek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontaktna_st` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naslov` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postna_st` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kraj` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kraj_rojstva` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum_rojstva` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_znamke` int(11) NOT NULL,
  `znamka` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrska_st` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_sasije` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moc_motorja` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tip_motorja` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum_prve_reg` datetime NOT NULL,
  `km` int(11) NOT NULL,
  `ccm` int(11) NOT NULL,
  `gorivo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pogon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menjalnik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komercialno_vozilo` int(11) DEFAULT '0',
  `datum_predaje` datetime DEFAULT NULL,
  `datum_jamstvo_od` datetime DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_kartice_vozil`
--

LOCK TABLES `sv_kartice_vozil` WRITE;
/*!40000 ALTER TABLE `sv_kartice_vozil` DISABLE KEYS */;
INSERT INTO `sv_kartice_vozil` VALUES (1,4324,'BASE 01',6,0,0,'200',1,0,0,NULL,NULL,NULL,'Simon Rusjan','03140259','Obala 121','6320','Portorož','Koper','2017-12-01 00:00:00','simon.rusjan@gmail.com',30,NULL,'Astra','KP-PB764','VCF543646443','74','16HDI','2018-12-01 00:00:00',105000,1600,'D','2WD','R',0,'2018-01-01 00:00:00','2018-01-01 00:00:00',1,0,'2018-05-31 18:23:36','2018-05-31 18:23:36'),(2,4324,'INTENSA01',35,0,0,'100',1,0,0,NULL,NULL,NULL,'Maja Cergol','03140259','Garibaldijeva 1','6330','Izola','Koper','2019-12-01 00:00:00','cergol.maja@gmail.com',32,NULL,'VOYAGER','KP-M7-99\'','GH3434325','84','43','2017-12-02 00:00:00',60000,1200,'B','2WD','R',0,'2016-01-01 00:00:00','2015-04-04 00:00:00',1,0,'2018-05-31 18:37:29','2018-05-31 18:37:29'),(4,999,'BASE 02',24,0,0,'100',1,0,0,NULL,NULL,NULL,'DAVID ŠKET','03140259','PRISOJE 2','6320','koper','Koper','2018-12-01 00:00:00',NULL,6,NULL,'A8','LJ9848932','VFG49320390','74','16HDI','2019-12-01 00:00:00',60000,1600,'B','2WD','R',0,'2018-01-01 00:00:00','2018-01-01 00:00:00',1,0,'2018-05-31 19:43:53','2018-05-31 19:43:53'),(5,999,'SUPREMA01',12,0,0,'342',1,0,0,NULL,NULL,NULL,'DAVID ŠKET','03140259','PRISOJE 2','6000','koper','Koper','2003-12-01 00:00:00','gfsad@ds.com',6,NULL,'A1','LJ9848932','GH3434325','12','16HDI','2018-12-01 00:00:00',60000,1200,'D','2WD','R',0,'2018-01-01 00:00:00','2018-01-02 00:00:00',1,0,'2018-05-31 19:47:00','2018-05-31 19:47:00'),(6,111,'BASE 02',12,0,0,'100',1,0,0,NULL,NULL,NULL,'ERVIN ČURLIČ','03140259','PRISTANIŠKA 1','6000','KOPER','Koper','2019-12-02 00:00:00','gfsad@ds.com',26,NULL,'M5','KP-PB764','VCF543646443','12','12','2001-12-01 00:00:00',60000,1600,'D','2WD','R',0,'2015-01-02 00:00:00','2007-01-02 00:00:00',1,0,'2018-05-31 19:48:40','2018-05-31 19:48:40'),(7,543543,'BASE 02',24,0,0,'300',1,0,0,NULL,NULL,NULL,'DAVID ŠKET','03140259','PRISOJE 2','6320','Portorož',NULL,NULL,NULL,32,NULL,'VOYAGER','LJ9848932','VCF543646443','74','16HDI','2018-12-01 00:00:00',60000,1600,'D','2WD','R',0,'2018-01-01 00:00:00','2018-01-01 00:00:00',4,0,'2018-05-31 20:12:22','2018-05-31 20:12:22');
/*!40000 ALTER TABLE `sv_kartice_vozil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_prodajalci`
--

DROP TABLE IF EXISTS `sv_prodajalci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_prodajalci` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `koda` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_prodajalci`
--

LOCK TABLES `sv_prodajalci` WRITE;
/*!40000 ALTER TABLE `sv_prodajalci` DISABLE KEYS */;
INSERT INTO `sv_prodajalci` VALUES (1,'','',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(2,'021','BP AVTO, Janko Pevec s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(3,'329','AVTOBOOK d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(4,'005','PR Studio Ribica d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(5,'100','1A AVTO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(6,'274','5ER avbili, Peter Antolič s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(7,'378','A-M Avtoprodaja, Damir Porčič s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(8,'250','A-MOBILE Leon Arifi s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(9,'276','A MOBIL d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(10,'342','A.B.C. Avto center d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(11,'345','A.D. AVTO, Denis Antlej s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(12,'321','A.F.S. d.o.o., Ljubljana',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(13,'216','A2 AVBILI, Tadej Kocijan s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(14,'261','AA Andrej Kovačič s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(15,'163','ABC AVTO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(16,'268','ABT d.o.o., PE AVTO ANABELA',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(17,'327','AC-PROFECT d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(18,'114','AC BAJC d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(19,'138','AC FRI-MOBIL d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(20,'265','AC NAKLO, Denis Vukelić s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(21,'395','AC VOVK d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(22,'214','ACL TRNOVO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(23,'039','ADI & FAČKO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(24,'260','AG AVTO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(25,'10025','AGEN GRADBENIŠTVO D.O.O.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(26,'118','AGT TRADE d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(27,'010','AHV d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(28,'347','Ai Avto d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(29,'251','ALD-1 d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(30,'267','ALFA ENA d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(31,'094','ALS AVTO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(32,'379','ALTARYA d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(33,'089','AMINO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(34,'198','AMITUR d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(35,'065','AP DRAGO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(36,'107','AP MS d.d.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(37,'314','AR-CENTER d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(38,'136','ARVI d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(39,'386','ASPEKT PLUS d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(40,'353','ASS AVTOSERVIS SMUK, Primož Smuk s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(41,'228','ATC-AVTO d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(42,'088','ATED d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(43,'207','AUTIVE, Peter Brecelj s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(44,'389','AUTOCLASS d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(45,'318','AUTODELTA d.o.o., Ljubljana',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(46,'205','AUTOMARKET d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(47,'300','AVBILI P.R. d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(48,'030','AVBILI RANC d.o.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(49,'056','AVTO-DOM, Matej Stare s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(50,'219','AVTO-KRAS d.n.o.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(51,'035','AVTO-STIL, Boštjan Potokar s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(52,'131','AVTO-STORITVE Saša Jakopin s.p.',0,'2018-05-31 18:22:41','2018-05-31 18:22:41'),(53,'273','AVTO-ULTRA, Bogdan Pertinač s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(54,'157','AVTO - SLIVNICA, d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(55,'034','AVTO A-D, Darko Arsič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(56,'098','AVTO ADUT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(57,'222','AVTO AKTIV INTERMERCATUS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(58,'280','AVTO ALAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(59,'037','AVTO ALEX, Aleksander Arsovski s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(60,'311','AVTO ARS, Benjamin Arslanović s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(61,'096','AVTO AS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(62,'289','AVTO AT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(63,'197','AVTO BELTRAM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(64,'224','AVTO CASANOVA, Asmir Tahirović s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(65,'012','AVTO CELJE d.d.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(66,'393','AVTO CENTER ANDREJEK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(67,'334','AVTO CENTER OBALA D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(68,'162','AVTO CENTER VOVK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(69,'027','AVTO CESAR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(70,'199','AVTO CITY d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(71,'017','AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(72,'283','AVTO DARKO, Bohinc Darko s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(73,'140','AVTO DEBEVC d.o.o., Mengeš',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(74,'194','AVTO DIL d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(75,'220','AVTO DOM IN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(76,'052','AVTO DUŠAN - DUŠAN KOVAČIČ S.P.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(77,'272','AVTO FER, Andrej Grobin s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(78,'151','AVTO FERI, Tomaž Knez s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(79,'271','AVTO FIT-PRODAJA VOZIL, Dejan Grobin s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(80,'374','AVTO FRAM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(81,'303','AVTO GALERIJA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(82,'146','AVTO GLIHA, Andraž Gliha s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(83,'072','AVTO GROSUPLJE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(84,'275','AVTO GUTMAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(85,'338','AVTO HIŠA RANDELJ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(86,'176','AVTO IGOR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(87,'373','AVTO JAN, Janez Gonza s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(88,'127','AVTO JEREB d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(89,'067','AVTO JOLLY, Osmen Duraković s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(90,'090','AVTO KADIVEC, Janez Kadivec s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(91,'322','AVTO KOMPAS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(92,'269','AVTO KUNSTEK, Damjan Kunstek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(93,'042','AVTO L in V d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(94,'365','AVTO LEON, Devad Arifi s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(95,'382','AVTO LESK, Jasmin Čoralič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(96,'058','AVTO LJUBLJANA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(97,'312','AVTO LUŠINA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(98,'349','AVTO M, Matej Gaber s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(99,'292','AVTO MALI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(100,'169','AVTO MERLAK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(101,'196','AVTO MIHA, Anel Omić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(102,'045','AVTO MIK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(103,'101','AVTO MIKLAVŽ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(104,'282','AVTO MOBIL, Predrag Nikolić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(105,'155','AVTO MOČNIK d.o.o. Kranj',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(106,'330','AVTO MOSTE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(107,'014','AVTO MOTO SHOP d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(108,'302','AVTO NOTA, Boštjan Trampuž s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(109,'028','AVTO OGRAJER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(110,'372','AVTO PARTNER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(111,'087','AVTO POSAVJE, Damjan Jazbinšek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(112,'195','AVTO PREBOLD, Nermin Jahić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(113,'133','AVTO RAJH d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(114,'079','AVTO SCENA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(115,'055','AVTO SELECT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(116,'130','AVTO SISTEM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(117,'170','AVTO SLAK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(118,'255','AVTO SONČEK Vovk Matej s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(119,'230','AVTO SVETINA, Iztok Svetina s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(120,'259','AVTO ŠEMROV, Rok Šemrov s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(121,'186','AVTO ŠERBINEK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(122,'071','AVTO ŠKAFAR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(123,'097','AVTO ŠUKI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(124,'043','AVTO TAVČAR d.o.o. PE Sežana',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(125,'211','AVTO TIM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(126,'368','AVTO TIM, Tadej Lukač s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(127,'006','Avto Triglav d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(128,'343','AVTO VELKAVRH d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(129,'229','AVTO VIDIC, Bogdan Vidic s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(130,'381','AVTO VIDMAR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(131,'10022','AVTO VISION D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(132,'179','AVTO ZOKI, Zoran Ogrinc s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(133,'394','AVTOCENTER ANDREJEK, Miran Andrejek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(134,'031','AVTOCENTER DODIČ, Valter Dodič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(135,'069','AVTOCENTER GOLOB d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(136,'106','AVTOCENTER PANDA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(137,'238','AVTOCENTER S&R, Siniša Boškan s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(138,'011','AVTOCENTER TROBEC d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(139,'192','AVTOCENTER, Duško Bekić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(140,'316','AVTOGRAM AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(141,'159','AVTOHIŠA BIZILJ, Katja Bizilj s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(142,'190','AVTOHIŠA DREV d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(143,'109','AVTOHIŠA JORDAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(144,'346','AVTOHIŠA KLEMENČIČ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(145,'200','AVTOHIŠA KOLMANIČ & CO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(146,'340','AVTOHIŠA KRIŽMAN D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(147,'279','AVTOHIŠA LAVRENČIČ, Bojan Lavrenčič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(148,'385','AVTOHIŠA MEŠKO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(149,'147','AVTOHIŠA MTP d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(150,'156','AVTOHIŠA RANDELJ, DAMIJAN s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(151,'173','AVTOHIŠA VRTIN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(152,'253','Avtokozmetika, Mateja Zidar s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(153,'331','AVTOLIK, Enes Korać s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(154,'237','AVTOMANIJA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(155,'278','AVTOMAR, Zoran Majkić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(156,'185','AVTOODPAD Miroslav Šerbinek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(157,'141','AVTOPLANET d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(158,'093','AVTOPLUS d.o.o. KOPER',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(159,'080','AVTOPORTOROŽ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(160,'165','AVTOPRIM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(161,'210','AVTOPRODAJA 5+, Zdravko Milešević s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(162,'116','AVTOPRODAJA d.o.o. ŠMARCA',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(163,'113','AVTOROSI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(164,'1001','Avtoservis Boštjan Torč s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(165,'074','AVTOSERVIS RONA, Robert Vasle s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(166,'161','AVTOSERVIS ŠPAJZER, d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(167,'103','AVTOSTAN d.o.o., Ljubljana',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(168,'284','AVTOSTEKLA ELVIS, Elvis Kolaković s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(169,'202','AVTOTEHNA VIS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(170,'242','AVTOTEHNA VIS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(171,'203','AVTOTEHNA VIS d.o.o., PE Kranj',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(172,'248','AVTOTEHNA VIS d.o.o., PE Škofja Loka',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(173,'009','B CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(174,'154','B ENA F d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(175,'362','B.A. AVBILI, Baki Arifi s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(176,'119','B.A.T.T., d.o.o., Ljubljana',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(177,'029','BIMOBIL d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(178,'369','Bojan Petek s.p. PMC AVBILI',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(179,'188','BP AVTO, Simon Pevec s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(180,'240','BS AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(181,'351','CAR LINE, Robert Klančar s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(182,'129','CAR TRADE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(183,'153','CARAVAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(184,'206','CARMOBIL, Johann Anžel Lara s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(185,'128','CENTER JEREB d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(186,'223','CETENA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(187,'099','CITROEN SLOVENIJA d.o.o. Maloprodaja Koper',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(188,'013','CRONO d.o.o. Ajdovščina',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(189,'213','ČEPIN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(190,'293','D AVBILI, Damjan Šušteršič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(191,'304','D&J AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(192,'384','D2, Denis Frece s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(193,'377','DAAL AVTO, Tomislav Remenar',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(194,'178','DACA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(195,'183','Dalibor Vujanovič s.p. AVTO MIKI',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(196,'367','DALL J d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(197,'339','Damjan Rotovnik s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(198,'032','DANI AVTO, Daniel Vidaković s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(199,'108','DARJA VODOVNIK ZAVŠEK S.P.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(200,'171','DARVIN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(201,'111','DBS LEASING d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(202,'175','DE-MOBIL d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(203,'226','DIAS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(204,'294','DO AVTA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(205,'344','DOKRA, Dorjan Krapše s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(206,'307','DS AVTO, Robert Stopar s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(207,'277','DS EKO TRADE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(208,'149','DTF AVTO, Tomaž Fajdiga s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(209,'313','DUO AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(210,'019','EKO-AVTO, Ermin Čehajić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(211,'124','EKO VOZILA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(212,'281','EKOMOBIL CAR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(213,'285','EKOMOBIL PLUS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(214,'256','EL-SA Sabina Saloski s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(215,'022','ELLIN MOTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(216,'249','ESTATE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(217,'046','EURO-CARS LJUBLJANA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(218,'139','EURO AVTO NOVA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(219,'077','EURO SERVIS BAB d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(220,'051','EUROCOM, Jurij Vide s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(221,'018','EUROCOMPANY d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(222,'262','EVROAVTO PTUJ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(223,'264','F1 AVBILI, Matej Polutnik s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(224,'193','F1 AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(225,'025','FINE CARS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(226,'204','FINISA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(227,'008','FINNOVA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(228,'231','FINSVET PLUS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(229,'115','FINSVET, Sebastijan Grm s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(230,'1000','Fizična stranka',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(231,'023','FP AVTO, Franci Potočar s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(232,'305','FTN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(233,'371','GERI COMPUTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(234,'234','GO-DOTI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(235,'112','GO-RENT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(236,'168','GOGI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(237,'041','GORAN LUIČ s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(238,'026','GP AVTO, Gregor Pajek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(239,'121','GRAND PRIX d.o.o. Koper',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(240,'315','GS MOBIL d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(241,'290','GT-F d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(242,'057','HAND-ESKO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(243,'357','HB AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(244,'288','HELOS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(245,'164','HITER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(246,'295','HSM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(247,'158','IMŠIROVIĆ ARMIN s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(248,'217','INAUT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(249,'172','INTERLAND d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(250,'328','IQ AVTO, Dejan Berič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(251,'148','JANPLAST d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(252,'054','JAP CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(253,'050','JBA TRADE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(254,'401','JE AVTO, Jasmin Adžikić s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(255,'105','JOMA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(256,'233','JURE REBSELJ s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(257,'073','KAR MINEKS d.o.o., Kranj',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(258,'092','KBR AVTOPRODAJA, Križman Branislav s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(259,'184','KDM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(260,'221','KEBOR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(261,'143','KMH, Klemen Terbovc, s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(262,'126','KON-TAKT, Jernej Marušič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(263,'144','KOVI TRADING d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(264,'135','KREATIVNI NAJEMI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(265,'095','KRIK, Sabina Kalauz s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(266,'1002','KURO ITALIA Srl',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(267,'333','L.L.I. Invest d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(268,'167','LANGUEST d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(269,'258','LAVRA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(270,'257','LFI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(271,'227','LiAVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(272,'137','LINT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(273,'191','LKV-PELEJ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(274,'110','M30 d.o.o. (SPC AVTO)',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(275,'142','MAPOS, Matjaž Posega s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(276,'225','MARGOS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(277,'306','MAS AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(278,'134','MEPAX d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(279,'117','MIBAvto d.o.o. Ljubljana',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(280,'075','MILDES d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(281,'298','MOAM, Matej Rankovec s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(282,'10026','MOBIL TRADE TRGOVINA D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(283,'187','MODRI CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(284,'007','MOJZER BOJAN s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(285,'10021','MOTIVE SERVICE D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(286,'332','MPO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(287,'063','MR-AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(288,'291','MS2 d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(289,'297','N.G.P. d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(290,'166','NAMIS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(291,'016','NBV d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(292,'390','NBV d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(293,'363','NINIMAS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(294,'301','NOVA ALFA ENA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(295,'208','NOVA AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(296,'180','NOVA OLIMPIJA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(297,'082','NOX d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(298,'036','OLIMOBILE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(299,'355','OMEGA PLUS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(300,'049','ORSEY d.o.o., Škofja Loka',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(301,'10024','P-GRUPA D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(302,'391','P 4 d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(303,'360','P GROUP d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(304,'358','P&D AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(305,'061','PAN-JAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(306,'047','PINGVIN & SCHWORZ d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(307,'160','PLINEKS, Avtoplinski sistemi, d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(308,'024','POLE POSITION d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(309,'309','Posredništvo Simon Okroglič s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(310,'053','POVERA AVBILI, Jernej Bradan s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(311,'299','POVERON d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(312,'254','PREMIJA AVTOMOBILI D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(313,'132','PREMIJA SVET d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(314,'123','PRIMA AUTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(315,'215','PRIMA AVTO, Robert Wochl s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(316,'350','PRIMMULA, Manfred Gider s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(317,'122','PRIS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(318,'177','PRO-GL d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(319,'020','PRO-VIZA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(320,'104','PRO ART d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(321,'120','PSC LOGATEC d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(322,'296','PSC OMAHEN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(323,'189','PSC PRAPROTNIK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(324,'038','PSC STEPAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(325,'392','PSC TIM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(326,'270','R CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(327,'015','RAMASTRA Ljubljana d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(328,'059','RBA CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(329,'078','RBM CENTER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(330,'317','RD AVTO, Rudman Dejan s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(331,'152','REAL DISKONT d.o.o. PE LM AVTO',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(332,'174','RECAR d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(333,'218','RIZLA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(334,'150','RO + SO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(335,'308','ROJKO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(336,'239','Rok Lončar s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(337,'040','RONDO TRADE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(338,'064','SBA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(339,'383','SCA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(340,'387','SECAR, Severin Peršolja s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(341,'068','SETR KURENT d.o.o., Ljubljana',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(342,'341','SINT NOVO MESTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(343,'235','SKUPINA DOM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(344,'232','SMG KONTAKT d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(345,'145','SPC d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(346,'102','SPORT CARS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(347,'048','ST MOTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(348,'125','STAVANJA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(349,'364','STUDIO MEGA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(350,'403','ŠIK Vulkanizerstvo, Dario Šikonja s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(351,'044','ŠPAN d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(352,'066','ŠPANIK d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(353,'060','ŠU-KO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(354,'356','T&J INVEST d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(355,'091','TEMS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(356,'337','TIFON d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(357,'398','TIM AVTOMOBILI D.O.O.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(358,'263','TODO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(359,'352','TOJA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(360,'062','TOMAŽ GOLE s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(361,'396','Tomaž Kralj s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(362,'252','TOP AVBILI d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(363,'325','TOP AVBILI PLUS, Bernarda Sedlašek s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(364,'326','TOP AVBILI, Mitja Plemeniti s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(365,'033','TOP CARS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(366,'399','TOPSELLER d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(367,'335','TREND MOBILE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(368,'076','TREND MOBILE, Franc Erjavec s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(369,'081','TRGO ABC d.o.o. KOPER',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(370,'083','TRGO ABC d.o.o. PE AJDOVŠČINA',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(371,'085','TRGO ABC d.o.o. PE NOVA GORICA',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(372,'084','TRGO ABC d.o.o. PE POSTOJNA',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(373,'086','TRGO ABC d.o.o. PE TOLMIN',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(374,'348','TRINSE d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(375,'070','TT AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(376,'319','VAR, Aleš Raduha s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(377,'310','VEIT TEAM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(378,'380','VILBOSS d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(379,'336','Vulkanizerstvo Boštjan Vovk s.p.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(380,'324','WEMICOM d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(381,'209','Z-D AVTO d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42'),(382,'287','ZEGA d.o.o.',0,'2018-05-31 18:22:42','2018-05-31 18:22:42');
/*!40000 ALTER TABLE `sv_prodajalci` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_uporabniki`
--

DROP TABLE IF EXISTS `sv_uporabniki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_uporabniki` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priimek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontaktna_st` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naslov` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postna_st` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posta_kraj` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kraj_rojstva` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum_rojstva` datetime NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_avtohise` int(11) NOT NULL,
  `soglasje_1` tinyint(1) NOT NULL,
  `soglasje_2` tinyint(1) NOT NULL,
  `soglasje_3` tinyint(1) NOT NULL,
  `datum_pogodbe` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_uporabniki`
--

LOCK TABLES `sv_uporabniki` WRITE;
/*!40000 ALTER TABLE `sv_uporabniki` DISABLE KEYS */;
/*!40000 ALTER TABLE `sv_uporabniki` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sv_vozila`
--

DROP TABLE IF EXISTS `sv_vozila`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sv_vozila` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `znamka` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrska_st` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_sasije` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moc_motorja` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_motorja` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prva_registracija` date NOT NULL,
  `km` int(11) NOT NULL,
  `ccm` int(11) NOT NULL,
  `gorivo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pogon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menjalnik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komercialno_vozilo` tinyint(1) NOT NULL,
  `datum_prodaje` datetime NOT NULL,
  `veljavnost_od` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `status_datum` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sv_vozila`
--

LOCK TABLES `sv_vozila` WRITE;
/*!40000 ALTER TABLE `sv_vozila` DISABLE KEYS */;
/*!40000 ALTER TABLE `sv_vozila` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'data_types','display_name_singular',1,'pt','Post','2018-04-07 18:51:00','2018-04-07 18:51:00'),(2,'data_types','display_name_singular',2,'pt','Página','2018-04-07 18:51:00','2018-04-07 18:51:00'),(3,'data_types','display_name_singular',3,'pt','Utilizador','2018-04-07 18:51:00','2018-04-07 18:51:00'),(4,'data_types','display_name_singular',4,'pt','Categoria','2018-04-07 18:51:00','2018-04-07 18:51:00'),(5,'data_types','display_name_singular',5,'pt','Menu','2018-04-07 18:51:00','2018-04-07 18:51:00'),(6,'data_types','display_name_singular',6,'pt','Função','2018-04-07 18:51:00','2018-04-07 18:51:00'),(7,'data_types','display_name_plural',1,'pt','Posts','2018-04-07 18:51:00','2018-04-07 18:51:00'),(8,'data_types','display_name_plural',2,'pt','Páginas','2018-04-07 18:51:00','2018-04-07 18:51:00'),(9,'data_types','display_name_plural',3,'pt','Utilizadores','2018-04-07 18:51:00','2018-04-07 18:51:00'),(10,'data_types','display_name_plural',4,'pt','Categorias','2018-04-07 18:51:00','2018-04-07 18:51:00'),(11,'data_types','display_name_plural',5,'pt','Menus','2018-04-07 18:51:00','2018-04-07 18:51:00'),(12,'data_types','display_name_plural',6,'pt','Funções','2018-04-07 18:51:00','2018-04-07 18:51:00'),(13,'categories','slug',1,'pt','categoria-1','2018-04-07 18:51:00','2018-04-07 18:51:00'),(14,'categories','name',1,'pt','Categoria 1','2018-04-07 18:51:00','2018-04-07 18:51:00'),(15,'categories','slug',2,'pt','categoria-2','2018-04-07 18:51:00','2018-04-07 18:51:00'),(16,'categories','name',2,'pt','Categoria 2','2018-04-07 18:51:00','2018-04-07 18:51:00'),(17,'pages','title',1,'pt','Olá Mundo','2018-04-07 18:51:00','2018-04-07 18:51:00'),(18,'pages','slug',1,'pt','ola-mundo','2018-04-07 18:51:00','2018-04-07 18:51:00'),(19,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2018-04-07 18:51:00','2018-04-07 18:51:00'),(20,'menu_items','title',1,'pt','Painel de Controle','2018-04-07 18:51:00','2018-04-07 18:51:00'),(21,'menu_items','title',2,'pt','Media','2018-04-07 18:51:00','2018-04-07 18:51:00'),(22,'menu_items','title',3,'pt','Publicações','2018-04-07 18:51:00','2018-04-07 18:51:00'),(23,'menu_items','title',4,'pt','Utilizadores','2018-04-07 18:51:00','2018-04-07 18:51:00'),(24,'menu_items','title',5,'pt','Categorias','2018-04-07 18:51:00','2018-04-07 18:51:00'),(25,'menu_items','title',6,'pt','Páginas','2018-04-07 18:51:00','2018-04-07 18:51:00'),(26,'menu_items','title',7,'pt','Funções','2018-04-07 18:51:00','2018-04-07 18:51:00'),(27,'menu_items','title',8,'pt','Ferramentas','2018-04-07 18:51:00','2018-04-07 18:51:00'),(28,'menu_items','title',9,'pt','Menus','2018-04-07 18:51:00','2018-04-07 18:51:00'),(29,'menu_items','title',10,'pt','Base de dados','2018-04-07 18:51:00','2018-04-07 18:51:00'),(30,'menu_items','title',12,'pt','Configurações','2018-04-07 18:51:00','2018-04-07 18:51:00');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sifra_avtohise` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Simon','simon.rusjan@gmail.com','users/default.png','$2y$10$wDmt/AhDRXoUgGFIO/aZKO99pWi4k4K3d56duuh6B2UZ8hFMLuAeK','MGiVkhh6YtA6kyvdqN4VonKAz0jdbo9uGIrkDMJoKUbMqRmFsoZ9wz5ogKmP','2018-04-07 18:37:53','2018-05-31 18:35:59','100'),(2,2,'Anton Novak','a.novak@gmail.com','users/May2018/RtR69RBCePPDKdvRbEkQ.jpg','$2y$10$BQJMPOxhyAr6t2vtfn4Q6OUTz6pviKUJi28klN9UItvDfmMdBNGLS','Q6HGRZdrncJmYXuRJvI6R8cF7fSDqDEdXw8hDSnAVsZPA66C5EHD88KCeN9i','2018-05-31 19:59:12','2018-05-31 20:02:02','200'),(4,2,'testni','test@test.com','users/default.png','$2y$10$mTTm7csKO/4cG5JfyLDUgO1wlhkj4xlBu.LTTaDvU02UFws/7vTpy','O76t3LbW06F8LIsZfOwdiTu09WOZ2W8eygfpoQcGJx4xaliQPWbUsQrwApsf','2018-05-31 20:10:11','2018-05-31 20:10:11','300');
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

-- Dump completed on 2018-07-24 19:29:14
