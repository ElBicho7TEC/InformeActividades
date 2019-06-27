-- -----------------------------------------------------
-- Schema Gestion_Plan_Desarrollo
-- -----------------------------------------------------
CREATE DATABASE Gestion_Plan_Desarrollo;
USE Gestion_Plan_Desarrollo;

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE usuarios (
  idUsuarios INT NOT NULL AUTO_INCREMENT,
  correoElectronico VARCHAR(45) NOT NULL,
  contraseña VARCHAR(45) NOT NULL,
  Nombre VARCHAR(45) NOT NULL,
  apellidoPaterno VARCHAR(45) NOT NULL,
  apellidoMaterno VARCHAR(45) NOT NULL,
  idDependencia INT NOT NULL,
  idRol INT NOT NULL,
  PRIMARY KEY ( idUsuarios, correoElectronico)
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`rol`
-- -----------------------------------------------------
CREATE TABLE rol(
  idRol INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipoRol VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`dependencia`
-- -----------------------------------------------------
CREATE TABLE dependencia(
  idDependencia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombreDeependencia VARCHAR(45) NOT NULL,
  calle VARCHAR(45) NOT NULL,
  colonia VARCHAR(45) NOT NULL,
  numero VARCHAR(45) NOT NULL,
  codigoPostal VARCHAR(45) NOT NULL,
  entreCalles VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`planDesarrollo`
-- -----------------------------------------------------
CREATE TABLE planDesarrollo (
  idplanDesarrollo INT NOT NULL PRIMARY KEY,
  nombrePlanDesarrollo VARCHAR(45) NOT NULL,
  descripcion VARCHAR(45) NOT NULL,
  Estatus VARCHAR(45) NOT NULL,
  fechaProgramada DATETIME NOT NULL,
  idDependencia INT NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`informe`
-- -----------------------------------------------------
CREATE TABLE informe(
  idInforme INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  notaEvidencia VARCHAR(45) NOT NULL,
  fecha DATETIME NOT NULL,
  idplanDesarrollo INT NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`fotosEvidencia`
-- -----------------------------------------------------
CREATE TABLE fotosEvidencia(
  idfotosEvidencia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ruta VARCHAR(200) NOT NULL,
  idInforme INT NOT NULL
);
-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`actividad`
-- -----------------------------------------------------
CREATE TABLE actividad(
  idActividad INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_Actividad VARCHAR(500) NOT NULL,
  descripcion VARCHAR(500) NOT NULL,
  fechaDia INT NOT NULL,
  fechaMes INT NOT NULL,
  fechaAno INT NOT NULL,
  Bimestre INT NOT NULL,
  idDependencia INT NOT NULL,
  idfotosEvidencia INT NOT NULL,
  idplanDesarrollo INT NOT NULL
);

