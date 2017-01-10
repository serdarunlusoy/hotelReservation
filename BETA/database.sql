-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema hrsdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hrsdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hrsdb` DEFAULT CHARACTER SET utf8 ;
USE `hrsdb` ;

-- -----------------------------------------------------
-- Table `hrsdb`.`hotels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hrsdb`.`hotels` (
  `RegistrationId` INT(11) NOT NULL,
  `HotelName` VARCHAR(45) NOT NULL,
  `District` VARCHAR(20) NOT NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `Stars` VARCHAR(1) NOT NULL,
  `DailyPrice` SMALLINT(6) NOT NULL,
  `RoomCount` SMALLINT(6) NOT NULL,
  `Pictures` MEDIUMBLOB NULL DEFAULT NULL,
  `HotelInfo` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`RegistrationId`),
  UNIQUE INDEX `Registration Code_UNIQUE` (`RegistrationId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hrsdb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hrsdb`.`users` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hrsdb`.`hotel users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hrsdb`.`hotel users` (
  `HotelName` VARCHAR(45) NULL DEFAULT NULL,
  `Hotels_RegistrationId` INT(11) NOT NULL,
  `users_userId` INT(11) NOT NULL,
  PRIMARY KEY (`Hotels_RegistrationId`, `users_userId`),
  INDEX `fk_Hotel Users_Hotels1_idx` (`Hotels_RegistrationId` ASC),
  INDEX `fk_hotel users_users1_idx` (`users_userId` ASC),
  CONSTRAINT `fk_Hotel Users_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationId`)
    REFERENCES `hrsdb`.`hotels` (`RegistrationId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_hotel users_users1`
    FOREIGN KEY (`users_userId`)
    REFERENCES `hrsdb`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hrsdb`.`reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hrsdb`.`reservations` (
  `People` TINYINT(4) NOT NULL,
  `RoomAmount` TINYINT(4) NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  `Price` SMALLINT(6) NOT NULL,
  `Hotels_RegistrationId` INT(11) NOT NULL,
  `users_userId` INT(11) NOT NULL,
  PRIMARY KEY (`Hotels_RegistrationId`, `users_userId`),
  INDEX `fk_Reservations_Hotels1_idx` (`Hotels_RegistrationId` ASC),
  INDEX `fk_reservations_users1_idx` (`users_userId` ASC),
  CONSTRAINT `fk_Reservations_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationId`)
    REFERENCES `hrsdb`.`hotels` (`RegistrationId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reservations_users1`
    FOREIGN KEY (`users_userId`)
    REFERENCES `hrsdb`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
