-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema librairie
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema librairie
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `librairie` DEFAULT CHARACTER SET utf8 ;
USE `librairie` ;

-- -----------------------------------------------------
-- Table `librairie`.`categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`categorie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`ville`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`ville` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`client` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `adresse` VARCHAR(85) NOT NULL,
  `code_postal` VARCHAR(10) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `ville_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_client_ville1_idx` (`ville_id` ASC) VISIBLE,
  CONSTRAINT `fk_client_ville1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `librairie`.`ville` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`librairie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`librairie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `adresse` VARCHAR(85) NOT NULL,
  `code_postal` VARCHAR(10) NOT NULL,
  `ville_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_librairie_ville1_idx` (`ville_id` ASC),
  CONSTRAINT `fk_librairie_ville1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `librairie`.`ville` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`livre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`livre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(100) NOT NULL,
  `auteur` VARCHAR(85) NOT NULL,
  `nombre_pages` DOUBLE NULL DEFAULT NULL,
  `librairie_id` INT(11) NOT NULL,
  `categorie_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livre_librairie_idx` (`librairie_id` ASC),
  INDEX `fk_livre_categorie1_idx` (`categorie_id` ASC),
  CONSTRAINT `fk_livre_categorie1`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `librairie`.`categorie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livre_librairie`
    FOREIGN KEY (`librairie_id`)
    REFERENCES `librairie`.`librairie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`location` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date_debut` VARCHAR(10) NOT NULL,
  `date_fin` VARCHAR(10) NOT NULL,
  `client_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_location_client1_idx` (`client_id` ASC),
  CONSTRAINT `fk_location_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `librairie`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`location_has_livre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`location_has_livre` (
  `location_id` INT(11) NOT NULL,
  `livre_id` INT(11) NOT NULL,
  `date_debut` VARCHAR(10) NOT NULL,
  `date_fin` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`location_id`, `livre_id`),
  INDEX `fk_location_has_livre_livre1_idx` (`livre_id` ASC),
  INDEX `fk_location_has_livre_location1_idx` (`location_id` ASC),
  CONSTRAINT `fk_location_has_livre_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `librairie`.`location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_location_has_livre_livre1`
    FOREIGN KEY (`livre_id`)
    REFERENCES `librairie`.`livre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
