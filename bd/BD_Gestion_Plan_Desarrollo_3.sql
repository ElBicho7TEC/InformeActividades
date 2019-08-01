CREATE DATABASE gestion_plan_desarrollo;
USE gestion_plan_desarrollo;

-- ------------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE usuarios (
  idusuario INT NOT NULL AUTO_INCREMENT,
  correoelectronico VARCHAR(45) NOT NULL,
  contrasena VARCHAR(200) NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  apellidopaterno VARCHAR(45) NOT NULL,
  apellidomaterno VARCHAR(45) NOT NULL,
  iddependencia INT NOT NULL,
  idrol INT NOT NULL,
  PRIMARY KEY ( idusuario, correoelectronico)
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`rol`
-- -----------------------------------------------------
CREATE TABLE rol(
  idrol INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tiporol VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`dependencia`
-- -----------------------------------------------------
CREATE TABLE dependencia(
  iddependencia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombredependencia VARCHAR(45) NOT NULL,
  calle VARCHAR(45) NOT NULL,
  colonia VARCHAR(45) NOT NULL,
  numero VARCHAR(45) NOT NULL,
  codigopostal VARCHAR(45) NOT NULL,
  entrecalles VARCHAR(45) NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`planDesarrollo`
-- -----------------------------------------------------
CREATE TABLE plandesarrollo (
  idplandesarrollo INT NOT NULL PRIMARY KEY,
  nombreplandesarrollo VARCHAR(45) NOT NULL,
  descripcion VARCHAR(45) NOT NULL,
  estatus VARCHAR(45) NOT NULL,
  fechaprogramada DATETIME NOT NULL,
  iddependencia INT NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`informe`
-- -----------------------------------------------------
CREATE TABLE informe(
  idinforme INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  notaevidencia VARCHAR(45) NOT NULL,
  fecha DATETIME NOT NULL,
  idplandesarrollo INT NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`fotosEvidencia`
-- -----------------------------------------------------
CREATE TABLE fotosevidencia(
  idfotosevidencia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ruta VARCHAR(200) NOT NULL
);
-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`actividad`
-- -----------------------------------------------------
CREATE TABLE actividad(
  idactividad INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombreactividad VARCHAR(500) NOT NULL,
  descripcion VARCHAR(500) NOT NULL,
  fechadia INT NOT NULL,
  fechames INT NOT NULL,
  fechaano INT NOT NULL,
  bimestre INT NOT NULL,
  iddependencia INT NOT NULL,
  idfotosevidencia INT NOT NULL,
  idplandesarrollo INT NOT NULL
);

-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`tokenSesion`
-- -----------------------------------------------------
CREATE TABLE tokensesion(
  token varchar(45) NOT NULL PRIMARY KEY,
  idusuario INT NOT NULL,
  expira DATE NOT NULL
);


-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`Historial_Actividad`
-- -----------------------------------------------------
CREATE TABLE historial_actividad(
  idusuario INT NOT NULL, 
  idactividad INT NOT NULL ,
  fechadia INT NOT NULL,
  fechames INT NOT NULL,
  fechaano INT NOT NULL
);

#Procedimiento almacenado para modificar Roles
DELIMITER //
create procedure sp_modificarroles(var_idrol INT,var_tiporol VARCHAR(45))
begin
UPDATE rol SET tiporol=var_tiporol WHERE idrol = var_idrol;
end
;
//
DELIMITER ;

#Procedimiento almacenado para modificar Dependencias
DELIMITER //
create procedure sp_modificardependencias(
	 var_iddependencia INT,
	 var_nombredependencia VARCHAR(45),
	 var_calle VARCHAR(45),
	 var_colonia VARCHAR(45),
	 var_numero VARCHAR(45),
	 var_codigopostal VARCHAR(45),
	 var_entrecalles VARCHAR(45)
)
BEGIN
    UPDATE dependencia SET 
    nombredeependencia=var_nombredeependencia,
    calle=var_calle,
    colonia=var_colonia,
    numero=var_numero,
    codigopostal=var_codigopostal,
    entrecalles=var_entrecalles
    WHERE iddependencia=var_iddependencia;
END;
//
DELIMITER ;

#Procedimiento para insertar Rol
DELIMITER //
create procedure sp_insertarroles(nombrerol varchar(45))
begin
set @id= (select   idrol from rol ORDER BY idrol DESC limit 1) ;
set @id=@id+1;
insert into rol values(@id,nombrerol);
end
;
//
DELIMITER ;

#Procedimiento para insertar Dependencia
DELIMITER //
create procedure sp_insertardependencias(nombredependencia VARCHAR(45), calle VARCHAR(45),colonia VARCHAR(45),numero VARCHAR(45),
codigopostal VARCHAR(45),entrecalles VARCHAR(45))
begin
set @id= (select   iddependencia from dependencia ORDER BY iddependencia DESC limit 1) ;
set @id=@id+1;
insert into dependencia values (default, nombredependencia, calle, colonia, numero, codigopostal,
    entrecalles);
end
;
//
DELIMITER ;

#Procedimiento almacenado para insertar Actividades 
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_actividades`(
	in idfotos int,
    in ruta varchar(200),
	in nombre_actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechadia INT,
	in fechames INT,
	in fechaano INT,
	in bimestre INT,
	in iddependencia INT,
    in idplandesarrollo int,
    in idusuario int,
    in idact int,
    in diacaptura int,
    in mescaptura int, 
    in aniocaptura int
)
BEGIN
	insert into actividad values (default, idfotos, ruta, nombre_actividad, descripcion, fechadia, fechames, fechaano,
    bimestre, iddependencia, idplandesarrollo,idusuario,idact,diacaptura,mescaptura,aniocaptura);
END
//
DELIMITER ;

DELIMITER //
#Procedimiento almacenado para insertar Usuarios
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_usuarios`(
  in correoelectronico VARCHAR(45),
  in contrasena VARCHAR(200),
  in nombre VARCHAR(45),
  in apellidopaterno VARCHAR(45),
  in apellidomaterno VARCHAR(45),
  in iddependencia INT,
  in idRol INT
)
BEGIN
	insert into usuarios values (null, correoelectronico, contrasena, nombre,
    apellidopaterno, apellidomaterno, iddependencia, idRol);
END
//
DELIMITER ;

DELIMITER //
#Procedimiento almacenado para modificar actividades 
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_actividades`(
	in idactividad INT,
	in nombre_actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechadia INT,
	in fechames INT,
	in fechaano INT,
	in bimestre INT,
	in iddependencia INT,
	in idfotosevidencia INT,
	in idplandesarrollo INT
)
BEGIN
	 UPDATE actividad SET 
    nombre_actividad=nombre_actividad,
    descripcion=descripcion,
    fechadia=fechadia,
    fechames=fechames,
    fechaano=fechaano,
    bimestre=bimestre,
    iddependencia=iddependencia,
    idfotosevidencia=idfotosevidencia,
    idplandesarrollo=idplandesarrollo
    WHERE idactividad = idactividad;
END
//
DELIMITER ;