CREATE DATABASE Gestion_Plan_Desarrollo;
USE Gestion_Plan_Desarrollo;

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE usuarios (
  idUsuario INT NOT NULL AUTO_INCREMENT,
  correoElectronico VARCHAR(45) NOT NULL,
  contrasena VARCHAR(200) NOT NULL,
  Nombre VARCHAR(45) NOT NULL,
  apellidoPaterno VARCHAR(45) NOT NULL,
  apellidoMaterno VARCHAR(45) NOT NULL,
  idDependencia INT NOT NULL,
  idRol INT NOT NULL,
  PRIMARY KEY ( idUsuario, correoElectronico)
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

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`tokenSesion`
-- -----------------------------------------------------
CREATE TABLE tokenSesion(
  token varchar(45) NOT NULL PRIMARY KEY,
  idUsuario INT NOT NULL,
  expira DATE NOT NULL
);


-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`Historial_Actividad`
-- -----------------------------------------------------
CREATE TABLE Historial_Actividad(
  idUsuario INT NOT NULL, 
  idActividad INT NOT NULL ,
  fechaDia INT NOT NULL,
  fechaMes INT NOT NULL,
  fechaAno INT NOT NULL,
  Descripción varchar(500) not null
);

#Procedimiento almacenado para modificar Roles
DELIMITER //
create procedure sp_modificarRoles(var_idRol INT,var_tipoRol VARCHAR(45))
begin
UPDATE rol SET tipoRol=var_tipoRol WHERE idRol = var_idRol;
end
;
//
DELIMITER ;

#Procedimiento almacenado para modificar Dependencias
DELIMITER //
create procedure sp_modificarDependencias(
	 var_idDependencia INT,
	 var_nombreDeependencia VARCHAR(45),
	 var_calle VARCHAR(45),
	 var_colonia VARCHAR(45),
	 var_numero VARCHAR(45),
	 var_codigoPostal VARCHAR(45),
	 var_entreCalles VARCHAR(45)
)
BEGIN
    UPDATE dependencia SET 
    nombreDeependencia=var_nombreDeependencia,
    calle=var_calle,
    colonia=var_colonia,
    numero=var_numero,
    codigoPostal=var_codigoPostal,
    entreCalles=var_entreCalles
    WHERE idDependencia=var_idDependencia;
END;
//
DELIMITER ;

#Procedimiento para insertar Rol
DELIMITER //
create procedure sp_insertarRoles(nombreRol varchar(45))
begin
set @id= (select   idRol from rol ORDER BY idRol DESC limit 1) ;
set @id=@id+1;
insert into rol values(@id,nombreRol);
end
;
//
DELIMITER ;

#Procedimiento para insertar Dependencia
DELIMITER //
create procedure sp_insertarDependencias(nombreDeependencia VARCHAR(45), calle VARCHAR(45),colonia VARCHAR(45),numero VARCHAR(45),
codigoPostal VARCHAR(45),entreCalles VARCHAR(45))
begin
set @id= (select   idDependencia from dependencia ORDER BY idDependencia DESC limit 1) ;
set @id=@id+1;
insert into dependencia values (default, nombreDeependencia, calle, colonia, numero, codigoPostal,
    entreCalles);
end
;
//
DELIMITER ;

#Procedimiento almacenado para insertar Actividades 
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insertar_Actividades`(
	in nombre_Actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechaDia INT,
	in fechaMes INT,
	in fechaAno INT,
	in Bimestre INT,
	in idDependencia INT,
	in idfotosEvidencia INT,
	in idplanDesarrollo INT
)
BEGIN
	insert into actividad values (default, nombre_Actividad, descripcion, fechaDia, fechaMes, fechaAno,
    Bimestre, idDependencia, idfotosEvidencia, idplanDesarrollo);
END
//
DELIMITER ;

DELIMITER //
#Procedimiento almacenado para insertar Usuarios
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insertar_Usuarios`(
  in correoElectronico VARCHAR(45),
  in contrasena VARCHAR(200),
  in Nombre VARCHAR(45),
  in apellidoPaterno VARCHAR(45),
  in apellidoMaterno VARCHAR(45),
  in idDependencia INT,
  in idRol INT
)
BEGIN
	insert into usuarios values (default, correoElectronico, contrasena, Nombre,
    apellidoPaterno, apellidoMaterno, idDependencia, idRol);
END
//
DELIMITER ;

DELIMITER //
#Procedimiento almacenado para modificar actividades 
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modificar_Actividades`(
	in idActividad INT,
	in nombre_Actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechaDia INT,
	in fechaMes INT,
	in fechaAno INT,
	in Bimestre INT,
	in idDependencia INT,
	in idfotosEvidencia INT,
	in idplanDesarrollo INT
)
BEGIN
	 UPDATE actividad SET 
    nombre_Actividad=nombre_Actividad,
    descripcion=descripcion,
    fechaDia=fechaDia,
    fechaMes=fechaMes,
    fechaAno=fechaAno,
    Bimestre=Bimestre,
    idDependencia=idDependencia,
    idfotosEvidencia=idfotosEvidencia,
    idplanDesarrollo=idplanDesarrollo
    WHERE idActividad = idActividad;
END
//
DELIMITER ;