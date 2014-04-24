
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(45)  NOT NULL,
	`last_name` VARCHAR(45)  NOT NULL,
	`gender` TINYINT,
	`telephone` VARCHAR(32),
	`qq` VARCHAR(15),
	`email` VARCHAR(100),
	`superior_leaders` VARCHAR(255),
	`head_photo` VARCHAR(255),
	`signature_image` VARCHAR(255),
	`modifier` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_id_UNIQUE` (`sf_guard_user_id`),
	UNIQUE KEY `email_UNIQUE` (`email`),
	KEY `fk_sf_guard_user_profile_titleId1`(`title_id`),
	KEY `fk_sf_guard_user_profile_user_id1`(`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- department
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `department`;


CREATE TABLE `department`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- department_sf_guard_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `department_sf_guard_user`;


CREATE TABLE `department_sf_guard_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`department_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_department_sf_guard_user_department1`(`department_id`),
	KEY `fk_department_sf_guard_user_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `department_sf_guard_user_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `department_sf_guard_user_FK_2`
		FOREIGN KEY (`department_id`)
		REFERENCES `department` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- user_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_log`;


CREATE TABLE `user_log`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`ip_address` VARCHAR(50),
	`module` VARCHAR(45),
	`action` VARCHAR(45),
	`operation_data_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_user_log_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `user_log_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- project
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;


CREATE TABLE `project`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` TINYINT,
	`phase` TINYINT,
	`name` VARCHAR(255),
	`long_name` VARCHAR(255),
	`proprietor` VARCHAR(255),
	`start_date` DATETIME,
	`end_date` DATETIME,
	`is_buy_the_tender_document` TINYINT,
	`tender_document_price` DECIMAL(16,4),
	`tendering_status` VARCHAR(255),
	`block_number` VARCHAR(255),
	`comment` TEXT,
	`is_project_end` TINYINT,
	`project_end_comment` TEXT,
	`modifier` INTEGER default 0,
	`creator` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- project_member
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project_member`;


CREATE TABLE `project_member`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`project_role_id` INTEGER  NOT NULL,
	`other_role_name` VARCHAR(45),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_project_member_project1`(`project_id`),
	KEY `fk_project_member_sf_guard_user1`(`sf_guard_user_id`),
	KEY `fk_project_member_project_role1`(`project_role_id`),
	CONSTRAINT `project_member_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `project_member_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `project_member_FK_3`
		FOREIGN KEY (`project_role_id`)
		REFERENCES `project_role` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- project_role
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project_role`;


CREATE TABLE `project_role`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- project_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project_history`;


CREATE TABLE `project_history`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`type` TINYINT,
	`phase` TINYINT,
	`name` VARCHAR(255),
	`proprietor` VARCHAR(255),
	`start_date` DATETIME,
	`end_date` DATETIME,
	`is_buy_the_tender_document` TINYINT,
	`tender_document_price` DECIMAL(16,4),
	`tendering_status` VARCHAR(255),
	`block_number` VARCHAR(255),
	`comment` TEXT,
	`is_project_end` TINYINT,
	`project_end_comment` TEXT,
	`modifier` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_project_history_project1`(`project_id`),
	CONSTRAINT `project_history_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- document
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `document`;


CREATE TABLE `document`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`proprietor` VARCHAR(255),
	`block_number` VARCHAR(255),
	`document_number` VARCHAR(255),
	`title` VARCHAR(45),
	`contract_number` VARCHAR(50),
	`issue` VARCHAR(50),
	`modifier` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- project_document
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project_document`;


CREATE TABLE `project_document`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`document_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_project_document_project1`(`project_id`),
	KEY `fk_project_document_document1`(`document_id`),
	CONSTRAINT `project_document_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `project_document_FK_2`
		FOREIGN KEY (`document_id`)
		REFERENCES `document` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- milestone
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `milestone`;


CREATE TABLE `milestone`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`is_completed` INTEGER,
	`deadline` DATE,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_milestone_project1`(`project_id`),
	CONSTRAINT `milestone_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- daily_report
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `daily_report`;


CREATE TABLE `daily_report`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`report_date` DATE,
	`content` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_milestone_project1`(`project_id`),
	KEY `fk_daily_report_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `daily_report_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `daily_report_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sign_in
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sign_in`;


CREATE TABLE `sign_in`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`address` TEXT,
	`sign_in_time` DATETIME,
	`longitude` VARCHAR(45),
	`lattitude` VARCHAR(45),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_sign_in_project1`(`project_id`),
	KEY `fk_sign_in_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `sign_in_FK_1`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `sign_in_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- news
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;


CREATE TABLE `news`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`title` VARCHAR(255),
	`content` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_news_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `news_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- notification_reciver
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notification_reciver`;


CREATE TABLE `notification_reciver`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`notification_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `notification_id_sf_guard_user_id_UNIQUE` (`notification_id`, `sf_guard_user_id`),
	KEY `fk_notification_reciver_notification1`(`notification_id`),
	KEY `fk_notification_reciver_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `notification_reciver_FK_1`
		FOREIGN KEY (`notification_id`)
		REFERENCES `notification` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `notification_reciver_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- notification
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notification`;


CREATE TABLE `notification`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`title` VARCHAR(255),
	`content` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_notification_sf_guard_user1`(`sf_guard_user_id`),
	CONSTRAINT `notification_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sms_queue
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sms_queue`;


CREATE TABLE `sms_queue`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`notification_id` INTEGER  NOT NULL,
	`receiver` VARCHAR(15)  NOT NULL,
	`unique_key` VARCHAR(45)  NOT NULL,
	`message_content` VARCHAR(200)  NOT NULL,
	`additional_information` VARCHAR(100)  NOT NULL,
	`send_times` INTEGER default 0,
	`last_send_at` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_sms_queue_notification1`(`notification_id`),
	CONSTRAINT `sms_queue_FK_1`
		FOREIGN KEY (`notification_id`)
		REFERENCES `notification` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- monitoring_address
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `monitoring_address`;


CREATE TABLE `monitoring_address`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`county_id` INTEGER,
	`office_of_the_company_name` VARCHAR(255)  NOT NULL,
	`address` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_monitoring_address_county_id1`(`county_id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- monitor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `monitor`;


CREATE TABLE `monitor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`monitoring_address_id` INTEGER,
	`ip` VARCHAR(45)  NOT NULL,
	`description` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_monitor_monitoring_address_id1`(`monitoring_address_id`),
	CONSTRAINT `monitor_FK_1`
		FOREIGN KEY (`monitoring_address_id`)
		REFERENCES `monitoring_address` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- reading_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reading_history`;


CREATE TABLE `reading_history`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`news_id` INTEGER,
	`notification_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_reading_history_sf_guard_user1`(`sf_guard_user_id`),
	KEY `fk_reading_history_news1`(`news_id`),
	KEY `fk_reading_history_notification1`(`notification_id`),
	CONSTRAINT `reading_history_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reading_history_FK_2`
		FOREIGN KEY (`news_id`)
		REFERENCES `news` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `reading_history_FK_3`
		FOREIGN KEY (`notification_id`)
		REFERENCES `notification` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- approval
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `approval`;


CREATE TABLE `approval`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- application
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `application`;


CREATE TABLE `application`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`approval_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`project_id` INTEGER  NOT NULL,
	`name` VARCHAR(255),
	`description` TEXT,
	`attachment` VARCHAR(255),
	`current_status` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_application_sf_guard_user1`(`sf_guard_user_id`),
	KEY `fk_application_approval_id`(`approval_id`),
	KEY `fk_application_project_id`(`project_id`),
	CONSTRAINT `application_FK_1`
		FOREIGN KEY (`approval_id`)
		REFERENCES `approval` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `application_FK_2`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `application_FK_3`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- workflow
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workflow`;


CREATE TABLE `workflow`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`approval_id` INTEGER  NOT NULL,
	`description` VARCHAR(255),
	`is_project_role` TINYINT,
	`project_role_id` INTEGER,
	`department_id` INTEGER,
	`title_id` INTEGER,
	`sort_order` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_workflow_approval_id`(`approval_id`),
	KEY `fk_workflow_project_role_id`(`project_role_id`),
	KEY `fk_workflow_department_id`(`department_id`),
	KEY `fk_workflow_title_id1`(`title_id`),
	CONSTRAINT `workflow_FK_1`
		FOREIGN KEY (`approval_id`)
		REFERENCES `approval` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `workflow_FK_2`
		FOREIGN KEY (`project_role_id`)
		REFERENCES `project_role` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `workflow_FK_3`
		FOREIGN KEY (`department_id`)
		REFERENCES `department` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `workflow_FK_4`
		FOREIGN KEY (`title_id`)
		REFERENCES `title` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- application_work_flow
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `application_work_flow`;


CREATE TABLE `application_work_flow`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`application_id` INTEGER  NOT NULL,
	`workflow_id` INTEGER  NOT NULL,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`approval_result` TINYINT,
	`approval_comment` TEXT,
	`approval_time` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_application_work_flow_sf_guard_user1`(`sf_guard_user_id`),
	KEY `fk_application_work_flow_application_id`(`application_id`),
	KEY `fk_application_work_flow_workflow_id`(`workflow_id`),
	CONSTRAINT `application_work_flow_FK_1`
		FOREIGN KEY (`application_id`)
		REFERENCES `application` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `application_work_flow_FK_2`
		FOREIGN KEY (`workflow_id`)
		REFERENCES `workflow` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `application_work_flow_FK_3`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- engineering_summary_items
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `engineering_summary_items`;


CREATE TABLE `engineering_summary_items`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`engineering_summary_id` INTEGER  NOT NULL,
	`project_content` TEXT,
	`contract_quantity` VARCHAR(255),
	`float_quantity` VARCHAR(255),
	`current_finish_amount` DECIMAL(16,4),
	`last_finish_amount` DECIMAL(16,4),
	`finish_amount` DECIMAL(16,4),
	`finish_percent` DECIMAL(16,4),
	`comment` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_engineering_summary_items_engineering_summary1_idx`(`engineering_summary_id`),
	CONSTRAINT `engineering_summary_items_FK_1`
		FOREIGN KEY (`engineering_summary_id`)
		REFERENCES `engineering_summary` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- engineering_materials_items
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `engineering_materials_items`;


CREATE TABLE `engineering_materials_items`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`engineering_materials_id` INTEGER  NOT NULL,
	`material_name` VARCHAR(255),
	`brand` VARCHAR(255),
	`technical_requirement` TEXT,
	`unit` VARCHAR(20),
	`quantity` INTEGER,
	`arrival_date` DATE,
	`arrival_place` VARCHAR(255),
	`comment` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_engineering_materials_items_engineering_materials1_idx`(`engineering_materials_id`),
	CONSTRAINT `engineering_materials_items_FK_1`
		FOREIGN KEY (`engineering_materials_id`)
		REFERENCES `engineering_materials` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- engineering_settlement
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `engineering_settlement`;


CREATE TABLE `engineering_settlement`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`application_id` INTEGER  NOT NULL,
	`contract_number` VARCHAR(120),
	`construction_unit` VARCHAR(255),
	`expiration_date` DATE,
	`issue` VARCHAR(120),
	`contract_amount` DECIMAL(16,4),
	`change_amount` DECIMAL(16,4),
	`changed_amount` DECIMAL(16,4),
	`current_complete_engineering` DECIMAL(16,4),
	`current_fastener_retention` VARCHAR(255),
	`current_payable` DECIMAL(16,4),
	`total_complete_engineering` VARCHAR(255),
	`total_fastener_retention` DECIMAL(16,4),
	`total_payable` DECIMAL(16,4),
	`prepayment` DECIMAL(16,4),
	`apply_payment` DECIMAL(16,4),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `id_idx`(`application_id`),
	CONSTRAINT `engineering_settlement_FK_1`
		FOREIGN KEY (`application_id`)
		REFERENCES `application` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- engineering_materials
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `engineering_materials`;


CREATE TABLE `engineering_materials`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`application_id` INTEGER  NOT NULL,
	`contract_section` VARCHAR(255),
	`number` VARCHAR(120),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `id_idx`(`application_id`),
	CONSTRAINT `engineering_materials_FK_1`
		FOREIGN KEY (`application_id`)
		REFERENCES `application` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- engineering_summary
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `engineering_summary`;


CREATE TABLE `engineering_summary`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`application_id` INTEGER  NOT NULL,
	`total_current_finish_amount` DECIMAL(16,4),
	`total_last_finish_amount` DECIMAL(16,4),
	`total_finish_amount` DECIMAL(16,4),
	`construction_unit` VARCHAR(255),
	`contract_number` VARCHAR(120),
	`issue` VARCHAR(120),
	`expiration_date` DATE,
	`amount` DECIMAL(16,4),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `id_idx`(`application_id`),
	CONSTRAINT `engineering_summary_FK_1`
		FOREIGN KEY (`application_id`)
		REFERENCES `application` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- title
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `title`;


CREATE TABLE `title`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- title_sf_guard_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `title_sf_guard_user`;


CREATE TABLE `title_sf_guard_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`title_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `fk_title_sf_guard_user_title_id1`(`title_id`),
	KEY `fk_sf_guard_user_sf_guard_user_id1`(`sf_guard_user_id`),
	CONSTRAINT `title_sf_guard_user_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `title_sf_guard_user_FK_2`
		FOREIGN KEY (`title_id`)
		REFERENCES `title` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Engine=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
