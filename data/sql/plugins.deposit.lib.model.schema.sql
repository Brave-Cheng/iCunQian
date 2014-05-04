
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- deposit_request
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_request`;


CREATE TABLE `deposit_request`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`page` INTEGER default 0 NOT NULL,
	`unique_keys` TEXT,
	`encrypt` VARCHAR(32),
	`is_process` TINYINT default 0,
	`request_number` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

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
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_bank
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_bank`;


CREATE TABLE `deposit_bank`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100),
	`property` TINYINT default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_financial_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_financial_products`;


CREATE TABLE `deposit_financial_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`request_financial_id` INTEGER  NOT NULL,
	`bank_id` INTEGER  NOT NULL,
	`region_id` VARCHAR(100),
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
	`invest_start_amount` FLOAT,
	`invert_increase_amount` FLOAT,
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
	UNIQUE KEY `unique_key` (`bank_id`, `region_id`, `name`, `profit_type`, `product_type`, `currency`, `invest_cycle`, `expected_rate`, `actual_rate`, `invest_start_amount`),
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
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- deposit_request_financial
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_request_financial`;


CREATE TABLE `deposit_request_financial`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`request_id` INTEGER  NOT NULL,
	`unique_key` VARCHAR(45),
	`process_status` TINYINT,
	`status` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_request_financial_request_idx`(`request_id`),
	CONSTRAINT `deposit_request_financial_FK_1`
		FOREIGN KEY (`request_id`)
		REFERENCES `deposit_request` (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
