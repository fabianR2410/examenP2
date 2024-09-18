-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema examen2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema examen2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `examen2` DEFAULT CHARACTER SET utf8 ;
USE `examen2` ;

-- -----------------------------------------------------
-- Table `examen2`.`PACIENTES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `examen2`.`PACIENTES` (
  `idpaciente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL COMMENT 'tabla pacientes',
  `telefono` VARCHAR(10) NOT NULL,
  `cedula` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idpaciente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examen2`.`DOCTORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `examen2`.`DOCTORES` (
  `iddoctor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `especialidad` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(10) NULL COMMENT 'tabla doctores',
  PRIMARY KEY (`iddoctor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examen2`.`CITAS_MEDICAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `examen2`.`CITAS_MEDICAS` (
  `idcita` INT NOT NULL AUTO_INCREMENT,
  `idpaciente` INT NOT NULL,
  `iddoctor` INT NOT NULL,
  `fecha_cita` DATE NOT NULL,
  `hora_cita` TIME NOT NULL,
  `descripcion` TEXT NULL,
  `PACIENTES_idpaciente` INT NOT NULL,
  `DOCTORES_iddoctor` INT NOT NULL,
  PRIMARY KEY (`idcita`),
  INDEX `fk_CITAS_MEDICAS_PACIENTES_idx` (`PACIENTES_idpaciente` ASC) ,
  INDEX `fk_CITAS_MEDICAS_DOCTORES1_idx` (`DOCTORES_iddoctor` ASC) ,
  CONSTRAINT `fk_CITAS_MEDICAS_PACIENTES`
    FOREIGN KEY (`PACIENTES_idpaciente`)
    REFERENCES `examen2`.`PACIENTES` (`idpaciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CITAS_MEDICAS_DOCTORES1`
    FOREIGN KEY (`DOCTORES_iddoctor`)
    REFERENCES `examen2`.`DOCTORES` (`iddoctor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
