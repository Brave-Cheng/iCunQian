SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



-- -----------------------------------------------------
-- Table `deposit_trunk`.`push_devices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `deposit_trunk`.`push_devices` ;

CREATE  TABLE IF NOT EXISTS `deposit_trunk`.`push_devices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `client_id` VARCHAR(128) NOT NULL DEFAULT '' ,
  `app_name` VARCHAR(255) NOT NULL DEFAULT '' ,
  `app_version` VARCHAR(45) NOT NULL DEFAULT '' ,
  `device_uid` VARCHAR(255) NOT NULL DEFAULT '' ,
  `device_name` VARCHAR(255) NOT NULL DEFAULT '' ,
  `device_model` VARCHAR(100) NOT NULL DEFAULT '' ,
  `device_version` VARCHAR(45) NOT NULL DEFAULT '' ,
  `device_token` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'APNs token & GCM registration id' ,
  `development` ENUM('production', 'sandbox') NOT NULL DEFAULT 'sandbox' ,
  `status` ENUM('active', 'unregistered') NOT NULL DEFAULT 'active' ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  KEY `client_id` (`client_id`) ,
  KEY `app_name` (`app_name`) ,
  KEY `app_version` (`app_version`) ,
  KEY `device_uid` (`device_uid`) ,
  KEY `device_name` (`device_name`) ,
  KEY `device_model` (`device_model`) ,
  KEY `device_version` (`device_version`) ,
  KEY `device_token` (`device_token`) ,
  KEY `development` (`development`) ,
  KEY `status` (`status`) ,
  KEY `created_at` (`created_at`) ,
  KEY `updated_at` (`updated_at`) ,
  UNIQUE KEY `unique_appname_uid` (`app_name`(128) ASC, `device_uid`(128) ASC) ,
  UNIQUE KEY `unique_appname_token` (`app_name`(128) ASC, `device_token`(128) ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Store unique devices';


-- -----------------------------------------------------
-- Table `deposit_trunk`.`push_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `deposit_trunk`.`push_messages` ;

CREATE  TABLE IF NOT EXISTS `deposit_trunk`.`push_messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `push_devices_id` INT UNSIGNED NOT NULL ,
  `message` VARCHAR(255) NOT NULL DEFAULT '' ,
  `delivery` DATETIME NOT NULL ,
  `status` ENUM('queued','delivered','failed') NOT NULL DEFAULT 'queued' ,
  `error_message` VARCHAR(255) NOT NULL DEFAULT '' ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  KEY `fk_push_messages_push_devices` (`push_devices_id` ASC) ,
  KEY `message` (`message`) ,
  KEY `delivery` (`delivery`) ,
  KEY `status` (`status`) ,
  KEY `error_message` (`error_message`) ,
  KEY `created_at` (`created_at`) ,
  KEY `updated_at` (`updated_at`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Messages to push to Push Server(GCM & APNs)';



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
