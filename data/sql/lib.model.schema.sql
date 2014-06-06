
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- deposit_region
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_region`;


CREATE TABLE `deposit_region`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER default 0,
	`name` VARCHAR(45),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_bank
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_bank`;


CREATE TABLE `deposit_bank`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100),
	`short_name` VARCHAR(64),
	`short_char` VARCHAR(16),
	`phone` VARCHAR(32),
	`logo` VARCHAR(64),
	`is_valid` TINYINT default 0,
	`sync_status` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `sync_status`(),
	KEY `is_valid`(),
	KEY `phone`(),
	KEY `short_char`(),
	KEY `short_name`(),
	KEY `name`()
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_financial_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_financial_products`;


CREATE TABLE `deposit_financial_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deposit_request_financial_id` INTEGER default 0 NOT NULL,
	`name` VARCHAR(255) default '' NOT NULL,
	`bank_name` VARCHAR(255) default '' NOT NULL,
	`region` VARCHAR(255) default '' NOT NULL,
	`profit_type` VARCHAR(48) default '' NOT NULL,
	`product_type` VARCHAR(64) default '' NOT NULL,
	`currency` VARCHAR(32) default '' NOT NULL,
	`invest_cycle` TINYINT default 0 NOT NULL,
	`target` VARCHAR(128) default '' NOT NULL,
	`sale_start_date` DATE  NOT NULL,
	`sale_end_date` DATE  NOT NULL,
	`profit_start_date` DATE  NOT NULL,
	`deadline` DATE  NOT NULL,
	`pay_period` VARCHAR(45) default '' NOT NULL,
	`expected_rate` FLOAT  NOT NULL,
	`actual_rate` FLOAT  NOT NULL,
	`invest_start_amount` VARCHAR(32) default '' NOT NULL,
	`invert_increase_amount` VARCHAR(32) default '' NOT NULL,
	`profit_desc` TEXT,
	`invest_scope` TEXT,
	`stop_condition` TEXT,
	`raise_condition` TEXT,
	`purchase` TEXT,
	`cost` TEXT,
	`feature` TEXT,
	`events` TEXT,
	`warnings` TEXT,
	`announce` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uk_financial_products` (`name`(120), `profit_type`, `currency`, `invest_cycle`, `sale_start_date`, `sale_end_date`, `profit_start_date`, `deadline`, `pay_period`, `expected_rate`, `actual_rate`, `invest_start_amount`, `invert_increase_amount`),
	KEY `fk_deposit_financial_products_deposit_request_financial`(`deposit_request_financial_id`),
	CONSTRAINT `deposit_financial_products_FK_1`
		FOREIGN KEY (`deposit_request_financial_id`)
		REFERENCES `deposit_request_financial` (`id`)
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_request_financial
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_request_financial`;


CREATE TABLE `deposit_request_financial`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`unique_key` VARCHAR(45),
	`process_status` TINYINT,
	`sync_status` TINYINT default 0 NOT NULL,
	`status` VARCHAR(32),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_attributes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_attributes`;


CREATE TABLE `deposit_attributes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`parent_id` INTEGER,
	`type` VARCHAR(32),
	`value` VARCHAR(128),
	`sync_status` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `sync_status`(),
	KEY `value`(),
	KEY `type`()
)engine=MyISAM;



# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
