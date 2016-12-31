-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
  `userName` VARCHAR(10) CHARACTER SET 'big5' NOT NULL,
  `name` VARCHAR(45) NULL,
  `password` VARCHAR(20) NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(10) NULL,
  `UserType` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`userName`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `userName_UNIQUE` (`userName` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hotels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Hotels` (
  `Registration Code` VARCHAR(20) NOT NULL,
  `Hotel Name` VARCHAR(45) NOT NULL,
  `District` VARCHAR(20) NOT NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `Stars` VARCHAR(1) NOT NULL,
  `Daily Price` INT NULL,
  `Availabilty` VARCHAR(45) GENERATED ALWAYS AS () VIRTUAL,
  `Rooms` INT NULL,
  PRIMARY KEY (`Registration Code`),
  UNIQUE INDEX `Registration Code_UNIQUE` (`Registration Code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Hotel Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Hotel Users` (
  `Hotel Name` VARCHAR(45) NULL,
  `Hotels_Registration Code` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`Hotels_Registration Code`),
  INDEX `fk_Hotel Users_Hotels1_idx` (`Hotels_Registration Code` ASC),
  CONSTRAINT `fk_Hotel Users_Hotels1`
    FOREIGN KEY (`Hotels_Registration Code`)
    REFERENCES `mydb`.`Hotels` (`Registration Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Reservations` (
  `Reservation ID` INT NOT NULL AUTO_INCREMENT,
  `Users_userName` VARCHAR(10) NOT NULL,
  `Hotels_Registration Code` VARCHAR(20) NOT NULL,
  `People` INT NOT NULL,
  `Room` INT NOT NULL,
  `Start Date` DATE NOT NULL,
  `End Date` DATE NOT NULL,
  `Price` INT GENERATED ALWAYS AS () VIRTUAL,
  PRIMARY KEY (`Reservation ID`, `Users_userName`, `Hotels_Registration Code`),
  INDEX `fk_Reservations_Users1_idx` (`Users_userName` ASC),
  INDEX `fk_Reservations_Hotels1_idx` (`Hotels_Registration Code` ASC),
  UNIQUE INDEX `Reservation ID_UNIQUE` (`Reservation ID` ASC),
  CONSTRAINT `fk_Reservations_Users1`
    FOREIGN KEY (`Users_userName`)
    REFERENCES `mydb`.`Users` (`userName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reservations_Hotels1`
    FOREIGN KEY (`Hotels_Registration Code`)
    REFERENCES `mydb`.`Hotels` (`Registration Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`Users`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`Users` (`userName`, `name`, `password`, `email`, `phone`, `UserType`) VALUES ('admin', 'serdar', '123456789', 's@s.com', '123456789798798', 'admin');

COMMIT;

