-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
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
AUTO_INCREMENT = 25
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
  INDEX `fk_librairie_ville1_idx` (`ville_id` ASC) VISIBLE,
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
  INDEX `fk_livre_librairie_idx` (`librairie_id` ASC) VISIBLE,
  INDEX `fk_livre_categorie1_idx` (`categorie_id` ASC) VISIBLE,
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
-- Table `librairie`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`images` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `livre_id` INT(11) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `livre_id` (`livre_id` ASC) VISIBLE,
  CONSTRAINT `images_ibfk_1`
    FOREIGN KEY (`livre_id`)
    REFERENCES `librairie`.`livre` (`id`))
ENGINE = InnoDB
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
  INDEX `fk_location_client1_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_location_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `librairie`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 26
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
  INDEX `fk_location_has_livre_livre1_idx` (`livre_id` ASC) VISIBLE,
  INDEX `fk_location_has_livre_location1_idx` (`location_id` ASC) VISIBLE,
  CONSTRAINT `fk_location_has_livre_livre1`
    FOREIGN KEY (`livre_id`)
    REFERENCES `librairie`.`livre` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_location_has_livre_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `librairie`.`location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`privilege` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `privilege` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `privilege_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username` ASC) VISIBLE,
  INDEX `privilege_id` (`privilege_id` ASC) VISIBLE,
  CONSTRAINT `user_ibfk_1`
    FOREIGN KEY (`privilege_id`)
    REFERENCES `librairie`.`privilege` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `page_visitee` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC) VISIBLE,
  CONSTRAINT `logs_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `librairie`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `librairie`.`session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `librairie`.`session` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `date_creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `date_expiration` TIMESTAMP NOT NULL DEFAULT current_timestamp() + interval 1 day,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `token` (`token` ASC) VISIBLE,
  INDEX `user_id` (`user_id` ASC) VISIBLE,
  CONSTRAINT `session_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `librairie`.`user` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;

USE `librairie`;

DELIMITER $$
USE `librairie`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `librairie`.`before_insert_session`
BEFORE INSERT ON `librairie`.`session`
FOR EACH ROW
BEGIN
    SET NEW.date_expiration = NOW() + INTERVAL 1 DAY;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
