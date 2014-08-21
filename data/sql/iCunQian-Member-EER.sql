
-- -----------------------------------------------------
-- Table `deposit`.`deposit_members`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deposit_trunk`.`deposit_members` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `account` VARCHAR(45) NOT NULL DEFAULT '' ,
  `nickname` VARCHAR(45) NOT NULL DEFAULT '' ,
  `password` VARCHAR(45) NOT NULL DEFAULT '' ,
  `mobile` VARCHAR(12) NOT NULL DEFAULT '' ,
  `email` VARCHAR(20) NOT NULL DEFAULT '' ,
  `avatar` VARCHAR(100) NOT NULL DEFAULT '' ,
  `third_party_platform_type` ENUM('qq','tencert_weibo','weibo', 'weixin') NOT NULL DEFAULT 'weibo' ,
  `third_party_platform_account` VARCHAR(45) NOT NULL DEFAULT '' ,
  `registration_time` DATETIME NOT NULL ,
  `last_login` DATETIME NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `account` (`account`) ,
  INDEX `nickname` (`nickname`) ,
  INDEX `password` (`password`) ,
  INDEX `mobile` (`mobile`) ,
  INDEX `email` (`email`) ,
  INDEX `avatar` (`avatar`) ,
  INDEX `third_party_platform_type` (`third_party_platform_type`) ,
  INDEX `third_party_platform_account` (`third_party_platform_account`) ,
  INDEX `registration_time` (`registration_time`) ,
  INDEX `last_login` (`last_login`) ,
  INDEX `created_at` (`created_at`) ,
  INDEX `updated_at` (`updated_at`) ,
  UNIQUE INDEX `uk_account` (`account` ASC, `nickname` ASC, `mobile` ASC, `email` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'iCunQian Members ';


-- -----------------------------------------------------
-- Table `deposit`.`deposit_notification`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `deposit_trunk`.`deposit_notification` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `notification_type` ENUM('email','sms') NOT NULL DEFAULT 'sms' ,
  `notification_type_account` VARCHAR(45) NOT NULL DEFAULT '' ,
  `content` VARCHAR(255) NOT NULL DEFAULT '' ,
  `notification_status` ENUM('queued','delivered','failed') NOT NULL DEFAULT 'queued' ,
  `delivered_time` DATETIME NOT NULL ,
  `error_message` VARCHAR(255) NOT NULL DEFAULT '' ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `notification_type` (`notification_type`) ,
  INDEX `notification_type_account` (`notification_type_account`) ,
  INDEX `content` (`content`) ,
  INDEX `notification_status` (`notification_status`) ,
  INDEX `delivered_time` (`delivered_time`) ,
  INDEX `error_message` (`error_message`) ,
  INDEX `created_at` (`created_at`) ,
  INDEX `updated_at` (`updated_at`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'iCunQian Notifications';