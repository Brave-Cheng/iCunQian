-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2014 at 04:08 PM
-- Server version: 5.1.73-community
-- PHP Version: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `deposit_trunk`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit_attributes`
--

DROP TABLE IF EXISTS `deposit_attributes`;
CREATE TABLE IF NOT EXISTS `deposit_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sync_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sync_status` (`sync_status`),
  KEY `value` (`value`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_bank`
--

DROP TABLE IF EXISTS `deposit_bank`;
CREATE TABLE IF NOT EXISTS `deposit_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_char` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_valid` tinyint(4) DEFAULT '0',
  `sync_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sync_status` (`sync_status`),
  KEY `is_valid` (`is_valid`),
  KEY `short_char` (`short_char`),
  KEY `short_name` (`short_name`),
  KEY `name` (`name`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90 ;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_financial_products`
--

DROP TABLE IF EXISTS `deposit_financial_products`;
CREATE TABLE IF NOT EXISTS `deposit_financial_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deposit_request_financial_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `profit_type` varchar(48) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `product_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
  `invest_start_amount` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `invert_increase_amount` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `profit_desc` text COLLATE utf8_unicode_ci,
  `invest_scope` text COLLATE utf8_unicode_ci,
  `stop_condition` text COLLATE utf8_unicode_ci,
  `raise_condition` text COLLATE utf8_unicode_ci,
  `purchase` text COLLATE utf8_unicode_ci,
  `cost` text COLLATE utf8_unicode_ci,
  `feature` text COLLATE utf8_unicode_ci,
  `events` text COLLATE utf8_unicode_ci,
  `warnings` text COLLATE utf8_unicode_ci,
  `announce` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_financial_products` (`name`(120),`profit_type`,`currency`,`invest_cycle`,`sale_start_date`,`sale_end_date`,`profit_start_date`,`deadline`,`pay_period`,`expected_rate`,`actual_rate`,`invest_start_amount`,`invert_increase_amount`),
  KEY `fk_financial_products_request_financial1_idx` (`deposit_request_financial_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5488 ;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_region`
--

DROP TABLE IF EXISTS `deposit_region`;
CREATE TABLE IF NOT EXISTS `deposit_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_request_financial`
--

DROP TABLE IF EXISTS `deposit_request_financial`;
CREATE TABLE IF NOT EXISTS `deposit_request_financial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `process_status` tinyint(4) DEFAULT NULL,
  `sync_status` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5488 ;
