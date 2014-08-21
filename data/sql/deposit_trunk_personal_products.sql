#-----------------------------------------------------------------------------
#-- deposit_personal_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `deposit_personal_products`;


CREATE TABLE `deposit_personal_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`deposit_financial_products_id` INTEGER  NOT NULL,
	`deposit_members_id` INTEGER  NOT NULL,
	`expected_rate` FLOAT  NOT NULL,
	`amount` FLOAT  NOT NULL,
	`buy_date` DATETIME  NOT NULL,
	`expiry_date` DATETIME  NOT NULL,
	`is_valid` ENUM('yes','no') default 'no' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`,`deposit_financial_products_id`,`deposit_members_id`),
	KEY `fk_deposit_personal_products_deposit_financial_products1`(`deposit_financial_products_id`),
	KEY `fk_deposit_personal_products_deposit_members`(`deposit_members_id`),
	KEY `expected_rate`(`expected_rate`),
	KEY `amount`(`amount`),
	KEY `buy_date`(`buy_date`),
	KEY `expiry_date`(`expiry_date`),
	KEY `is_valid`(`is_valid`),
	KEY `created_at`(`created_at`),
	KEY `updated_at`(`updated_at`),
	CONSTRAINT `deposit_personal_products_FK_1`
		FOREIGN KEY (`deposit_financial_products_id`)
		REFERENCES `deposit_financial_products` (`id`),
	CONSTRAINT `deposit_personal_products_FK_2`
		FOREIGN KEY (`deposit_members_id`)
		REFERENCES `deposit_members` (`id`)
)ENGINE=MyISAM;