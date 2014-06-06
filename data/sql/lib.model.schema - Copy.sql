
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
	`property` TINYINT default 0,
	`short_name` VARCHAR(64),
	`phone` VARCHAR(32),
	`logo` VARCHAR(64),
	`is_valid` TINYINT default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_financial_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_financial_products`;


CREATE TABLE `deposit_financial_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`request_financial_id` INTEGER  NOT NULL,
	`bank_id` INTEGER  NOT NULL,
	`region_id` VARCHAR(48)  NOT NULL,
	`name` VARCHAR(255),
	`profit_type` TINYINT,
	`product_type` TINYINT,
	`currency` TINYINT,
	`invest_cycle` TINYINT,
	`target` TINYINT,
	`sale_start_date` DATE,
	`sale_end_date` DATE,
	`profit_start_date` DATE,
	`deadline` DATE,
	`pay_period` VARCHAR(45),
	`expected_rate` FLOAT,
	`actual_rate` FLOAT,
	`invest_start_amount` VARCHAR(32),
	`invert_increase_amount` VARCHAR(32),
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
	UNIQUE KEY `uk_financial_products` (`bank_id`, `region_id`, `name`(110), `product_type`, `currency`, `invest_cycle`, `target`, `sale_start_date`, `sale_end_date`, `deadline`, `pay_period`, `expected_rate`, `invest_start_amount`, `invert_increase_amount`),
	KEY `fk_financial_products_request_financial1_idx`(`request_financial_id`),
	KEY `fk_financial_products_bank1_idx`(`bank_id`),
	KEY `fk_financial_products_region1_idx`(`region_id`),
	CONSTRAINT `deposit_financial_products_FK_1`
		FOREIGN KEY (`request_financial_id`)
		REFERENCES `deposit_request_financial` (`id`),
	CONSTRAINT `deposit_financial_products_FK_2`
		FOREIGN KEY (`bank_id`)
		REFERENCES `deposit_bank` (`id`),
	CONSTRAINT `deposit_financial_products_FK_3`
		FOREIGN KEY (`region_id`)
		REFERENCES `deposit_region` (`id`)
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
	`status` TINYINT,
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
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)engine=MyISAM;

#-----------------------------------------------------------------------------
#-- api_login_information
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `api_login_information`;


CREATE TABLE `api_login_information`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(255),
	`api_key` CHAR(40),
	`token` CHAR(40),
	`request_ip` CHAR(15),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `code`(`code`),
	KEY `token`(`token`)
)engine=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
