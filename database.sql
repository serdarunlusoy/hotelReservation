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
  `RegistrationCode` VARCHAR(20) NOT NULL,
  `HotelName` VARCHAR(45) NOT NULL,
  `District` VARCHAR(20) NOT NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `Stars` VARCHAR(1) NOT NULL,
  `DailyPrice` INT(11) NOT NULL,
  `Availabilty` VARCHAR(45) NOT NULL,
  `Rooms` INT(11) NOT NULL,
  `InfoPage` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`RegistrationCode`),
  UNIQUE INDEX `Registration Code_UNIQUE` (`RegistrationCode` ASC),
  UNIQUE INDEX `Info Page Address_UNIQUE` (`InfoPage` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`hotel users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`hotel users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`hotel users` (
  `HotelName` VARCHAR(45) NULL DEFAULT NULL,
  `Hotels_RegistrationCode` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`Hotels_RegistrationCode`),
  INDEX `fk_Hotel Users_Hotels1_idx` (`Hotels_RegistrationCode` ASC),
  CONSTRAINT `fk_Hotel Users_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationCode`)
    REFERENCES `mydb`.`hotels` (`RegistrationCode`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `userName` VARCHAR(10) CHARACTER SET 'big5' NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(20) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(10) NULL DEFAULT NULL,
  `UserType` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`userName`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `userName_UNIQUE` (`userName` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`reservations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`reservations` ;

CREATE TABLE IF NOT EXISTS `mydb`.`reservations` (
  `People` INT(11) NOT NULL,
  `Room` INT(11) NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  `Price` INT(11) NULL DEFAULT NULL,
  `Users_userName` VARCHAR(10) CHARACTER SET 'big5' NOT NULL,
  `Hotels_RegistrationCode` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`Users_userName`, `Hotels_RegistrationCode`),
  INDEX `fk_Reservations_Hotels1_idx` (`Hotels_RegistrationCode` ASC),
  CONSTRAINT `fk_Reservations_Hotels1`
    FOREIGN KEY (`Hotels_RegistrationCode`)
    REFERENCES `mydb`.`hotels` (`RegistrationCode`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Reservations_Users1`
    FOREIGN KEY (`Users_userName`)
    REFERENCES `mydb`.`users` (`userName`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
