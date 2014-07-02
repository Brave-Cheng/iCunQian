-- MySQL dump 10.13  Distrib 5.5.33, for linux2.6 (x86_64)
--
-- Host: localhost    Database: deposit_trunk
-- ------------------------------------------------------
-- Server version	5.5.33

--
-- Table structure for table `deposit_attributes`
--

DROP TABLE IF EXISTS `deposit_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sync_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sync_status` (`sync_status`),
  KEY `value` (`value`),
  KEY `type` (`type`),
  KEY `parent_id` (`parent_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deposit_bank`
--

DROP TABLE IF EXISTS `deposit_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `short_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `short_char` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `logo` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_valid` tinyint(4) NOT NULL DEFAULT '0',
  `sync_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_bank_name` (`name`,`short_name`,`short_char`,`phone`),
  KEY `sync_status` (`sync_status`),
  KEY `is_valid` (`is_valid`),
  KEY `short_char` (`short_char`),
  KEY `short_name` (`short_name`),
  KEY `name` (`name`),
  KEY `phone` (`phone`),
  KEY `logo` (`logo`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deposit_bank_alias`
--

DROP TABLE IF EXISTS `deposit_bank_alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_bank_alias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deposit_bank_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_bank_alias` (`deposit_bank_id`,`name`),
  KEY `fk_deposit_bank_alias_deposit_bank` (`deposit_bank_id`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deposit_financial_products`
--

DROP TABLE IF EXISTS `deposit_financial_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_financial_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_id` int(10) unsigned NOT NULL DEFAULT '0',
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `profit_type` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `invest_cycle` tinyint(4) NOT NULL DEFAULT '0',
  `target` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sale_start_date` date NOT NULL,
  `sale_end_date` date NOT NULL,
  `profit_start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `pay_period` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `expected_rate` float NOT NULL,
  `actual_rate` float NOT NULL,
  `invest_start_amount` float(16,0) DEFAULT NULL,
  `invest_increase_amount` float(16,0) DEFAULT NULL,
  `profit_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `invest_scope` text COLLATE utf8_unicode_ci NOT NULL,
  `stop_condition` text COLLATE utf8_unicode_ci NOT NULL,
  `raise_condition` text COLLATE utf8_unicode_ci NOT NULL,
  `purchase` text COLLATE utf8_unicode_ci NOT NULL,
  `cost` text COLLATE utf8_unicode_ci NOT NULL,
  `feature` text COLLATE utf8_unicode_ci NOT NULL,
  `events` text COLLATE utf8_unicode_ci NOT NULL,
  `warnings` text COLLATE utf8_unicode_ci NOT NULL,
  `announce` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sync_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_financial_products` (`name`(120),`profit_type`,`currency`,`invest_cycle`,`sale_start_date`,`sale_end_date`,`profit_start_date`,`deadline`,`pay_period`,`expected_rate`,`actual_rate`,`invest_start_amount`,`invest_increase_amount`),
  KEY `name` (`name`),
  KEY `bank_name` (`bank_name`),
  KEY `region` (`region`),
  KEY `profit_type` (`profit_type`),
  KEY `currency` (`currency`),
  KEY `target` (`target`),
  KEY `sale_start_date` (`sale_start_date`),
  KEY `sale_end_date` (`sale_end_date`),
  KEY `profit_start_date` (`profit_start_date`),
  KEY `deadline` (`deadline`),
  KEY `pay_period` (`pay_period`),
  KEY `expected_rate` (`expected_rate`),
  KEY `actual_rate` (`actual_rate`),
  KEY `invest_start_amount` (`invest_start_amount`),
  KEY `invest_increase_amount` (`invest_increase_amount`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `status` (`status`,`sync_status`),
  KEY `bank_id` (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deposit_region`
--

DROP TABLE IF EXISTS `deposit_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


-- Dump completed on 2014-07-02 14:54:50
