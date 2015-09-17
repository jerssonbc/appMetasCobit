SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';



CREATE SCHEMA IF NOT EXISTS `PROCESOS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `PROCESOS` ;



-- -----------------------------------------------------

-- Table `PROCESOS`.`Usuario`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`Usuario` (

  `idUsuario` INT NOT NULL AUTO_INCREMENT ,

  `usu_nick` VARCHAR(45) NULL ,

  `usu_clave` VARCHAR(45) NULL ,

  `usu_estado` INT NULL ,

  PRIMARY KEY (`idUsuario`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`rol`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`rol` (

  `idrol` INT NOT NULL AUTO_INCREMENT ,

  `rol_descripcion` VARCHAR(45) NULL ,

  `rol_estado` VARCHAR(45) NULL ,

  PRIMARY KEY (`idrol`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`detalleRol`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`detalleRol` (

  `der_idUsuario` INT NOT NULL ,

  `der_idrol` INT NOT NULL ,

  `der_estado` VARCHAR(45) NULL ,

  PRIMARY KEY (`der_idUsuario`, `der_idrol`) ,

  INDEX `fk_Usuario_has_rol_rol1_idx` (`der_idrol` ASC) ,

  INDEX `fk_Usuario_has_rol_Usuario_idx` (`der_idUsuario` ASC) ,

  CONSTRAINT `fk_Usuario_has_rol_Usuario`

    FOREIGN KEY (`der_idUsuario` )

    REFERENCES `PROCESOS`.`Usuario` (`idUsuario` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_Usuario_has_rol_rol1`

    FOREIGN KEY (`der_idrol` )

    REFERENCES `PROCESOS`.`rol` (`idrol` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`empresa`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`empresa` (

  `idempresa` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(45) NULL ,

  `ruc` VARCHAR(45) NULL ,

  `direccion` VARCHAR(55) NULL ,

  `idUsuario` INT NOT NULL ,

  PRIMARY KEY (`idempresa`) ,

  INDEX `fk_empresa_Usuario1_idx` (`idUsuario` ASC) ,

  CONSTRAINT `fk_empresa_Usuario1`

    FOREIGN KEY (`idUsuario` )

    REFERENCES `PROCESOS`.`Usuario` (`idUsuario` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`apoyo`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`apoyo` (

  `idapoyo` INT NOT NULL AUTO_INCREMENT ,

  `key` VARCHAR(45) NULL ,

  `category` VARCHAR(45) NULL ,

  `loc` VARCHAR(45) NULL ,

  `text` VARCHAR(45) NULL ,

  `idempresa` INT NOT NULL ,

  PRIMARY KEY (`idapoyo`) ,

  INDEX `fk_apoyo_empresa1_idx` (`idempresa` ASC) ,

  CONSTRAINT `fk_apoyo_empresa1`

    FOREIGN KEY (`idempresa` )

    REFERENCES `PROCESOS`.`empresa` (`idempresa` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`primarios`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`primarios` (

  `idprimarios` INT NOT NULL AUTO_INCREMENT ,

  `key` VARCHAR(45) NULL ,

  `category` VARCHAR(45) NULL ,

  `text` VARCHAR(45) NULL ,

  `loc` VARCHAR(45) NULL ,

  `idempresa` INT NOT NULL ,

  PRIMARY KEY (`idprimarios`) ,

  INDEX `fk_primarios_empresa1_idx` (`idempresa` ASC) ,

  CONSTRAINT `fk_primarios_empresa1`

    FOREIGN KEY (`idempresa` )

    REFERENCES `PROCESOS`.`empresa` (`idempresa` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`estrategico`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`estrategico` (

  `idestrategico` INT NOT NULL AUTO_INCREMENT ,

  `key` VARCHAR(45) NULL ,

  `text` VARCHAR(45) NULL ,

  `category` VARCHAR(45) NULL ,

  `loc` VARCHAR(45) NULL ,

  `idempresa` INT NOT NULL ,

  PRIMARY KEY (`idestrategico`) ,

  INDEX `fk_estrategico_empresa1_idx` (`idempresa` ASC) ,

  CONSTRAINT `fk_estrategico_empresa1`

    FOREIGN KEY (`idempresa` )

    REFERENCES `PROCESOS`.`empresa` (`idempresa` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PROCESOS`.`relacion`

-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `PROCESOS`.`relacion` (

  `idrelacion` INT NOT NULL AUTO_INCREMENT ,

  `from` VARCHAR(45) NULL ,

  `to` VARCHAR(45) NULL ,

  `fromPort` VARCHAR(45) NULL ,

  `fromPort` VARCHAR(45) NULL ,

  `points` VARCHAR(45) NULL ,

  `idempresa` INT NOT NULL ,

  PRIMARY KEY (`idrelacion`) ,

  INDEX `fk_relacion_empresa1_idx` (`idempresa` ASC) ,

  CONSTRAINT `fk_relacion_empresa1`

    FOREIGN KEY (`idempresa` )

    REFERENCES `PROCESOS`.`empresa` (`idempresa` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;



USE `PROCESOS` ;





SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

