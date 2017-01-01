-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`hotels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`hotels` ;

CREATE TABLE IF NOT EXISTS `mydb`.`hotels` (
  `RegistrationId` INT NOT NULL,
  `HotelName` VARCHAR(45) NOT NULL,
  `District` VARCHAR(20) NOT NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `Stars` VARCHAR(1) NOT NULL,
  `DailyPrice` SMALLINT NOT NULL,
  `RoomCount` SMALLINT NOT NULL,
  `InfoPage` VARCHAR(45) GENERATED ALWAYS AS (CONCAT(RegistrationId,'.html')) VIRTUAL,
  `Pictures` BLOB NOT NULL,
  PRIMARY KEY (`RegistrationId`),
  UNIQUE INDEX `Registration Code_UNIQUE` (`RegistrationId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(20) NULL DEFAULT NULL,
   PRIMARY KEY (`userId`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`hotel users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`hotel users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`hotel users` (
  `HotelName` VARCHAR(45) NULL DEFAULT NULL,
  `Hotels_RegistrationId` INT NOT NULL,
  `users_userId` INT NOT NULL,
  PRIMARY KEY (`Hotels_RegistrationId`, `users_userId`),
  INDEX `fk_Hotel Users_Hotels1_idx` (`Hotels_RegistrationId` ASC),
  INDEX `fk_hotel users_users1_idx` (`users_userId` ASC),
  CONSTRAINT `fk_Hotel Users_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationId`)
    REFERENCES `mydb`.`hotels` (`RegistrationId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_hotel users_users1`
    FOREIGN KEY (`users_userId`)
    REFERENCES `mydb`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`reservations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`reservations` ;

CREATE TABLE IF NOT EXISTS `mydb`.`reservations` (
  `People` TINYINT NOT NULL,
  `RoomAmount` TINYINT NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  `Price` SMALLINT NOT NULL,
  `Hotels_RegistrationId` INT NOT NULL,
  `users_userId` INT NOT NULL,
  PRIMARY KEY (`Hotels_RegistrationId`, `users_userId`),
  INDEX `fk_Reservations_Hotels1_idx` (`Hotels_RegistrationId` ASC),
  INDEX `fk_reservations_users1_idx` (`users_userId` ASC),
  CONSTRAINT `fk_Reservations_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationId`)
    REFERENCES `mydb`.`hotels` (`RegistrationId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reservations_users1`
    FOREIGN KEY (`users_userId`)
    REFERENCES `mydb`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
