-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-10-2019 a las 07:28:33
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servi301_gestion_plan_desarrollo`
--
CREATE DATABASE IF NOT EXISTS `servi301_gestion_plan_desarrollo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `servi301_gestion_plan_desarrollo`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_insertardependencias`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertardependencias` (`nombreDependencia` VARCHAR(45), `calle` VARCHAR(45), `colonia` VARCHAR(45), `numero` VARCHAR(45), `codigoPostal` VARCHAR(45), `entreCalles` VARCHAR(45))  begin
set @id= (select   idDependencia from dependencia ORDER BY idDependencia DESC limit 1);
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into dependencia values (@id, nombreDependencia, calle, colonia, numero, codigoPostal,
    entreCalles);
end$$

DROP PROCEDURE IF EXISTS `sp_insertarroles`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarroles` (`nombreRol` VARCHAR(45))  begin
set @id= (select   idRol from rol ORDER BY idRol DESC limit 1) ;
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into rol values(@id,nombreRol);
end$$

DROP PROCEDURE IF EXISTS `sp_insertar_actividades`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_actividades` (IN `nombre_actividad` VARCHAR(500), IN `descripcion` VARCHAR(500), IN `fechadia` INT, IN `fechames` INT, IN `fechaano` INT, IN `bimestre` INT, IN `iddependencia` INT, IN `idplandesarrollo` INT)  BEGIN
set @id= (select   idactividad from actividad ORDER BY idactividad DESC limit 1);
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
set @idFoto= (select max(idfotosevidencia) as idfotosevidencia from fotosevidencia);
insert into actividad values (@id, nombre_actividad, descripcion, fechadia, fechames, fechaano, bimestre,
    iddependencia, @idFoto, idplandesarrollo);
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_foto_evidencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_foto_evidencia` (`ruta` VARCHAR(200))  begin
set @id= (select   idfotosevidencia from fotosevidencia ORDER BY idfotosevidencia DESC limit 1) ;
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into fotosevidencia values (@id, ruta);
end$$

DROP PROCEDURE IF EXISTS `sp_insertar_historial_actividad`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_historial_actividad` (IN `idusuario` INT, IN `diacaptura` INT, IN `mescaptura` INT, IN `aniocaptura` INT)  begin
set @idact=(select max(idactividad) as idactividad from actividad);
insert into historial_actividad values (idusuario, @idact, diacaptura,mescaptura,aniocaptura);
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_plan_desarrollo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_plan_desarrollo` (`nombreplandesarrollo` VARCHAR(45), `descripcion` VARCHAR(45), `estatus` VARCHAR(45), `fechaprogramada` VARCHAR(45), `iddependencia` INT)  begin
set @id= (select idplandesarrollo from plandesarrollo ORDER BY idplandesarrollo DESC limit 1);
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into plandesarrollo values (@id, nombreplandesarrollo, descripcion, estatus, fechaprogramada, iddependencia);
end$$

DROP PROCEDURE IF EXISTS `sp_insertar_usuarios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_usuarios` (IN `correoElectronico` VARCHAR(45), IN `contraseña` VARCHAR(45), IN `Nombre` VARCHAR(45), IN `apellidoPaterno` VARCHAR(45), IN `apellidoMaterno` VARCHAR(45), IN `idDependencia` INT, IN `idRol` INT)  BEGIN
	insert into usuarios values (null, correoElectronico, contraseña, Nombre,
    apellidoPaterno, apellidoMaterno, idDependencia, idRol);
END$$

DROP PROCEDURE IF EXISTS `sp_modificardependencias`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificardependencias` (`var_idDependencia` INT, `var_nombreDependencia` VARCHAR(45), `var_calle` VARCHAR(45), `var_colonia` VARCHAR(45), `var_numero` VARCHAR(45), `var_codigoPostal` VARCHAR(45), `var_entreCalles` VARCHAR(45))  BEGIN
    UPDATE dependencia SET 
    nombredependencia=var_nombreDependencia,
    calle=var_calle,
    colonia=var_colonia,
    numero=var_numero,
    codigopostal=var_codigoPostal,
    entrecalles=var_entreCalles
    WHERE iddependencia=var_idDependencia;
END$$

DROP PROCEDURE IF EXISTS `sp_modificarrol`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificarrol` (`var_idrol` INT, `var_tiporol` VARCHAR(45))  BEGIN 
UPDATE rol SET tiporol=var_tiporol WHERE idrol = var_idrol;
END$$

DROP PROCEDURE IF EXISTS `sp_modificarroles`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificarroles` (`var_idrol` INT, `var_tiporol` VARCHAR(45))  begin
UPDATE rol SET tiporol=var_tiporol WHERE idrol = var_idrol;
end$$

DROP PROCEDURE IF EXISTS `sp_modificarusuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificarusuario` (`var_idusuario` INT, `var_nombre` VARCHAR(45), `var_apellidopat` VARCHAR(45), `var_apellidomat` VARCHAR(45), `var_contrasena` VARCHAR(45))  BEGIN 
update usuarios set contrasena=var_contrasena, nombre=var_nombre, apellidopaterno=var_apellidopat, apellidomaterno=var_apellidomat WHERE idusuario=var_idusuario;
END$$

DROP PROCEDURE IF EXISTS `sp_modificar_actividades`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_actividades` (IN `idActividad` INT, IN `nombre_Actividad` VARCHAR(500), IN `descripcion` VARCHAR(500), IN `fechaDia` INT, IN `fechaMes` INT, IN `fechaAno` INT, IN `Bimestre` INT, IN `idDependencia` INT, IN `idfotosEvidencia` INT, IN `idplanDesarrollo` INT)  BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `idactividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombreactividad` varchar(500) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fechadia` int(11) NOT NULL,
  `fechames` int(11) NOT NULL,
  `fechaano` int(11) NOT NULL,
  `bimestre` int(11) NOT NULL,
  `iddependencia` int(11) NOT NULL,
  `idfotosevidencia` int(11) NOT NULL,
  `idplandesarrollo` int(11) NOT NULL,
  PRIMARY KEY (`idactividad`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idactividad`, `nombreactividad`, `descripcion`, `fechadia`, `fechames`, `fechaano`, `bimestre`, `iddependencia`, `idfotosevidencia`, `idplandesarrollo`) VALUES
(1, 'jose', 'hola', 31, 12, 2019, 1, 1, 1, 1),
(2, 'venderChicles', 'Vender Chicles', 20, 11, 2020, 4, 1, 2, 1),
(3, 'venderChicles', 'Vender Chicles', 20, 11, 2020, 4, 1, 3, 1),
(4, 'venderChicles', 'Vender Chicles', 20, 11, 2020, 4, 1, 4, 1),
(5, 'venderChicles', 'Vender Chicles', 25, 11, 2020, 4, 1, 5, 1),
(6, 'venderChicles', 'Vender chicles', 1, 1, 2020, 1, 1, 6, 1),
(7, 'venderChicles', 'Vender chicles', 1, 1, 2020, 1, 1, 7, 1),
(8, 'venderChicles', 'Vender Chicles para generar fondos', 2, 2, 2020, 3, 1, 8, 1),
(9, 'cuidarPerros', 'Cuidar Perros desamparados', 10, 2, 2020, 1, 1, 9, 1),
(10, 'Actividad', 'Actividad para generar recursos', 15, 8, 2019, 1, 1, 10, 2),
(11, 'cisco', 'gfhdfh', 31, 12, 2019, 1, 1, 11, 1),
(12, 'CuidarMasPerros', 'Cuidar perrors', 12, 2, 2020, 2, 1, 12, 2),
(13, 'VenderGatos', 'Se explica solo', 20, 12, 2019, 1, 1, 13, 1),
(14, 'Exterminar', 'Exterminar Ratones del pueblo', 20, 9, 2019, 3, 1, 14, 1),
(15, 'Vender', 'Vender gatos gordoes', 20, 8, 2019, 4, 1, 15, 1),
(16, 'jose', 'hfuugyf', 31, 12, 2019, 1, 1, 16, 1),
(17, 'revisarVehiculos', 'Revisar los vehiculos gratis', 20, 10, 2020, 1, 1, 17, 1),
(18, 'cuidar', 'Cuidar Perros', 20, 11, 2019, 3, 1, 18, 2),
(19, 'Venderchicles', 'Cuidar chicles de la gente', 23, 10, 2019, 3, 3, 19, 1),
(20, 'repararLuz', 'Reparar luz de la colonia del mercado', 30, 10, 2019, 3, 2, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

DROP TABLE IF EXISTS `dependencia`;
CREATE TABLE IF NOT EXISTS `dependencia` (
  `iddependencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombredependencia` varchar(45) NOT NULL,
  `calle` varchar(45) NOT NULL,
  `colonia` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `codigopostal` varchar(45) NOT NULL,
  `entrecalles` varchar(45) NOT NULL,
  PRIMARY KEY (`iddependencia`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`iddependencia`, `nombredependencia`, `calle`, `colonia`, `numero`, `codigopostal`, `entrecalles`) VALUES
(1, 'Transito', 'Mercado', 'Centro', '11', '63999', 'Mercado'),
(2, 'Luz', 'Morelos', 'El Pinar', '300', '63941', 'Ceboruco y Neptuno'),
(3, 'Agua', 'Moctezuma', 'Villita', '315', '63941', 'Neptuno y Urano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotosevidencia`
--

DROP TABLE IF EXISTS `fotosevidencia`;
CREATE TABLE IF NOT EXISTS `fotosevidencia` (
  `idfotosevidencia` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(200) NOT NULL,
  PRIMARY KEY (`idfotosevidencia`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotosevidencia`
--

INSERT INTO `fotosevidencia` (`idfotosevidencia`, `ruta`) VALUES
(1, 'C:/xampp/htdocs/informeActividades/html/imagenes/img_e7d599eb13bcd3c459f1e167f49d23fc.jpg'),
(2, 'imagenes/img_28be26df8b7b51aae340caa02db6a9e8.jpg'),
(3, 'imagenes/img_2fddd42ed1e8ba14318fab015562efac.jpg'),
(4, 'imagenes/img_209ebd18cf9bb1b21547964bf6ba235d.jpg'),
(5, 'imagenes/img_7aac89ecd536404e8f38c93f20ab50fd.jpg'),
(6, 'imagenes/img_5489ec8bddeea2fc091b4347d46c259b.jpg'),
(7, 'imagenes/img_76a902722afc8e190611646ae7d360d9.jpg'),
(8, 'imagenes/img_28be26df8b7b51aae340caa02db6a9e8.jpg'),
(9, 'imagenes/img_fd0de84e8c59b096c986ceb3047c766f.jpg'),
(10, 'imagenes/img_4a2494885535394b09f5a2907c89b906.png'),
(11, 'imagenes/img_e356f60f55447d47d8187ee9ed6173b9.jpg'),
(12, 'imagenes/img_6345f4d6ac0224a74f91f1f03add04c5.jpg'),
(13, 'imagenes/img_0db2ebd54c7b43ffb060a6cf6a68a771.jpg'),
(14, 'imagenes/img_6aae3b2d5f276003fc2841ba4d90ef57.jpg'),
(15, 'imagenes/img_008ee19a950c4f7abf4f8dd1b936a1eb.png'),
(16, 'imagenes/img_163db187c5ea55d07210d33f156e33c0.jpg'),
(17, 'imagenes/img_164a7607392c11372e2638e3b4caa97f.jpg'),
(18, 'imagenes/img_b1b912988fbce7b9c4508189e9b2163d.jpg'),
(19, 'imagenes/img_f14c5a52186e1b0e148a41668d75f24f.png'),
(20, 'imagenes/img_525a703f1eedb9d72b2717bcb94833cd.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_actividad`
--

DROP TABLE IF EXISTS `historial_actividad`;
CREATE TABLE IF NOT EXISTS `historial_actividad` (
  `idusuario` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `fechadia` int(11) NOT NULL,
  `fechames` int(11) NOT NULL,
  `fechaano` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_actividad`
--

INSERT INTO `historial_actividad` (`idusuario`, `idactividad`, `fechadia`, `fechames`, `fechaano`) VALUES
(2, 1, 3, 8, 2019),
(1, 2, 8, 8, 2019),
(1, 3, 8, 8, 2019),
(1, 4, 8, 8, 2019),
(1, 5, 8, 8, 2019),
(1, 6, 8, 8, 2019),
(1, 7, 8, 8, 2019),
(1, 8, 8, 8, 2019),
(6, 9, 8, 8, 2019),
(6, 10, 8, 8, 2019),
(6, 11, 8, 8, 2019),
(6, 12, 8, 8, 2019),
(6, 13, 9, 8, 2019),
(7, 14, 9, 8, 2019),
(7, 15, 9, 8, 2019),
(8, 16, 9, 8, 2019),
(8, 17, 9, 8, 2019),
(8, 18, 10, 8, 2019),
(9, 19, 13, 10, 2019),
(10, 20, 13, 10, 2019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_informe`
--

DROP TABLE IF EXISTS `historial_informe`;
CREATE TABLE IF NOT EXISTS `historial_informe` (
  `idinforme` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_informe`
--

INSERT INTO `historial_informe` (`idinforme`, `idactividad`) VALUES
(1, 1),
(2, 8),
(3, 8),
(4, 8),
(5, 6),
(6, 2),
(7, 2),
(8, 3),
(9, 4),
(10, 5),
(11, 6),
(12, 6),
(12, 2),
(13, 8),
(14, 7),
(15, 6),
(16, 9),
(17, 9),
(18, 10),
(19, 10),
(20, 10),
(21, 9),
(22, 10),
(23, 10),
(23, 9),
(24, 10),
(25, 9),
(26, 11),
(26, 9),
(27, 10),
(27, 9),
(28, 10),
(29, 11),
(30, 9),
(31, 10),
(32, 11),
(33, 12),
(34, 12),
(35, 11),
(36, 10),
(37, 11),
(37, 10),
(38, 10),
(39, 10),
(40, 10),
(41, 12),
(42, 12),
(42, 9),
(43, 10),
(44, 10),
(45, 10),
(46, 10),
(47, 10),
(48, 15),
(48, 14),
(49, 13),
(49, 12),
(49, 11),
(49, 10),
(49, 9),
(50, 13),
(50, 12),
(50, 10),
(50, 9),
(51, 13),
(51, 10),
(51, 9),
(52, 13),
(53, 12),
(54, 12),
(54, 9),
(55, 11),
(56, 13),
(56, 11),
(57, 12),
(57, 11),
(58, 16),
(59, 16),
(60, 17),
(61, 18),
(61, 17),
(62, 19),
(63, 19),
(64, 19),
(65, 19),
(66, 19),
(67, 19),
(68, 19),
(68, 17),
(69, 19),
(70, 19),
(70, 18),
(71, 19),
(71, 17),
(72, 19),
(72, 18),
(73, 19),
(73, 18),
(74, 19),
(75, 19),
(76, 19),
(77, 19),
(78, 19),
(79, 19),
(80, 19),
(81, 19),
(82, 19),
(83, 19),
(84, 19),
(85, 20),
(85, 19),
(86, 20),
(86, 19),
(87, 20),
(87, 19),
(88, 20),
(88, 19),
(89, 19),
(90, 19),
(91, 19),
(92, 20),
(92, 19),
(93, 20),
(93, 19),
(94, 20),
(94, 19),
(95, 20),
(95, 19),
(96, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

DROP TABLE IF EXISTS `informe`;
CREATE TABLE IF NOT EXISTS `informe` (
  `idinforme` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `idplandesarrollo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idinforme`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `informe`
--

INSERT INTO `informe` (`idinforme`, `fecha`, `idplandesarrollo`, `idusuario`) VALUES
(1, '2019-08-07 00:00:00', 1, 2),
(2, '2019-08-08 00:00:00', 1, 1),
(3, '2019-08-08 00:00:00', 1, 1),
(4, '2019-08-08 00:00:00', 1, 1),
(5, '2019-08-08 00:00:00', 1, 1),
(6, '2019-08-08 00:00:00', 1, 1),
(7, '2019-08-08 00:00:00', 1, 1),
(8, '2019-08-08 00:00:00', 1, 1),
(9, '2019-08-08 00:00:00', 1, 1),
(10, '2019-08-08 00:00:00', 1, 1),
(11, '2019-08-08 00:00:00', 1, 1),
(12, '2019-08-08 00:00:00', 1, 1),
(13, '2019-08-08 00:00:00', 1, 1),
(14, '2019-08-08 00:00:00', 1, 1),
(15, '2019-08-08 00:00:00', 1, 1),
(16, '2019-08-08 00:00:00', 1, 6),
(17, '2019-08-08 00:00:00', 1, 6),
(18, '2019-08-08 00:00:00', 1, 6),
(19, '2019-08-08 00:00:00', 1, 6),
(20, '2019-08-08 00:00:00', 1, 6),
(21, '2019-08-08 00:00:00', 1, 6),
(22, '2019-08-08 00:00:00', 1, 6),
(23, '2019-08-08 00:00:00', 1, 6),
(24, '2019-08-08 00:00:00', 1, 6),
(25, '2019-08-08 00:00:00', 1, 6),
(26, '2019-08-08 00:00:00', 1, 6),
(27, '2019-08-08 00:00:00', 1, 6),
(28, '2019-08-08 00:00:00', 1, 6),
(29, '2019-08-08 00:00:00', 1, 6),
(30, '2019-08-08 00:00:00', 1, 6),
(31, '2019-08-08 00:00:00', 1, 6),
(32, '2019-08-08 00:00:00', 1, 6),
(33, '2019-08-08 00:00:00', 1, 6),
(34, '2019-08-08 00:00:00', 1, 6),
(35, '2019-08-08 00:00:00', 1, 6),
(36, '2019-08-08 00:00:00', 1, 6),
(37, '2019-08-08 00:00:00', 1, 6),
(38, '2019-08-08 00:00:00', 1, 6),
(39, '2019-08-08 00:00:00', 1, 6),
(40, '2019-08-08 00:00:00', 1, 6),
(41, '2019-08-08 00:00:00', 1, 6),
(42, '2019-08-08 00:00:00', 1, 6),
(43, '2019-08-08 00:00:00', 1, 6),
(44, '2019-08-08 00:00:00', 1, 6),
(45, '2019-08-08 00:00:00', 1, 6),
(46, '2019-08-08 00:00:00', 1, 6),
(47, '2019-08-08 00:00:00', 1, 6),
(48, '2019-08-09 00:00:00', 1, 7),
(49, '2019-08-09 00:00:00', 1, 6),
(50, '2019-08-09 00:00:00', 1, 6),
(51, '2019-08-09 00:00:00', 1, 6),
(52, '2019-08-09 00:00:00', 1, 6),
(53, '2019-08-09 00:00:00', 1, 6),
(54, '2019-08-09 00:00:00', 1, 6),
(55, '2019-08-09 00:00:00', 1, 6),
(56, '2019-08-09 00:00:00', 1, 6),
(57, '2019-08-09 00:00:00', 1, 6),
(58, '2019-08-09 00:00:00', 1, 8),
(59, '2019-08-09 00:00:00', 1, 8),
(60, '2019-08-09 00:00:00', 1, 8),
(61, '2019-08-10 00:00:00', 1, 8),
(62, '2019-10-13 00:00:00', 1, 9),
(63, '2019-10-13 00:00:00', 1, 9),
(64, '2019-10-13 00:00:00', 1, 1),
(65, '2019-10-13 00:00:00', 1, 1),
(66, '2019-10-13 00:00:00', 1, 1),
(67, '2019-10-13 00:00:00', 1, 1),
(68, '2019-10-13 00:00:00', 1, 1),
(69, '2019-10-13 00:00:00', 1, 1),
(70, '2019-10-13 00:00:00', 1, 1),
(71, '2019-10-13 00:00:00', 1, 1),
(72, '2019-10-13 00:00:00', 1, 1),
(73, '2019-10-13 00:00:00', 1, 1),
(74, '2019-10-13 00:00:00', 1, 1),
(75, '2019-10-13 00:00:00', 1, 1),
(76, '2019-10-13 00:00:00', 1, 1),
(77, '2019-10-13 00:00:00', 1, 1),
(78, '2019-10-13 00:00:00', 1, 1),
(79, '2019-10-13 00:00:00', 1, 1),
(80, '2019-10-13 00:00:00', 1, 1),
(81, '2019-10-13 00:00:00', 1, 1),
(82, '2019-10-13 00:00:00', 1, 1),
(83, '2019-10-13 00:00:00', 1, 1),
(84, '2019-10-13 00:00:00', 1, 1),
(85, '2019-10-13 00:00:00', 1, 1),
(86, '2019-10-13 00:00:00', 1, 1),
(87, '2019-10-13 00:00:00', 1, 1),
(88, '2019-10-13 00:00:00', 1, 1),
(89, '2019-10-13 00:00:00', 1, 1),
(90, '2019-10-13 00:00:00', 1, 1),
(91, '2019-10-13 00:00:00', 1, 1),
(92, '2019-10-13 00:00:00', 1, 1),
(93, '2019-10-13 00:00:00', 1, 1),
(94, '2019-10-13 00:00:00', 1, 1),
(95, '2019-10-13 00:00:00', 1, 1),
(96, '2019-10-13 00:00:00', 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plandesarrollo`
--

DROP TABLE IF EXISTS `plandesarrollo`;
CREATE TABLE IF NOT EXISTS `plandesarrollo` (
  `idplandesarrollo` int(11) NOT NULL,
  `nombreplandesarrollo` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estatus` varchar(45) NOT NULL,
  `fechaprogramada` datetime NOT NULL,
  `iddependencia` int(11) NOT NULL,
  PRIMARY KEY (`idplandesarrollo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plandesarrollo`
--

INSERT INTO `plandesarrollo` (`idplandesarrollo`, `nombreplandesarrollo`, `descripcion`, `estatus`, `fechaprogramada`, `iddependencia`) VALUES
(1, 'Vender Chicles', 'Vender chicles', 'En progreso', '2019-12-11 00:00:00', 1),
(2, 'cuidarPerros', 'Cuidar los perros', 'En progreso', '2020-10-20 00:00:00', 1),
(3, 'cuidarPerros', 'Cuidar los perros', 'En progreso', '2019-12-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `tiporol` varchar(45) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `tiporol`) VALUES
(1, 'Administrador'),
(2, 'Contraloria'),
(3, 'Direcciones'),
(4, 'Regidores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokensesion`
--

DROP TABLE IF EXISTS `tokensesion`;
CREATE TABLE IF NOT EXISTS `tokensesion` (
  `token` varchar(45) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `expira` date NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tokensesion`
--

INSERT INTO `tokensesion` (`token`, `idusuario`, `expira`) VALUES
('1db8e13ffb5b68609083264bd7fcd93219dc978c', 1, '2019-11-12'),
('8cda440abeaaf30454cd80e15982835991b28b75', 2, '2019-09-08'),
('4a70e9f4a7b61ad8e2d6e379079a104c83fa479b', 4, '2019-09-06'),
('3991a13133176a8c73245d4788f596645cc9dc88', 6, '2019-09-28'),
('e66629e0d450bb7bf214142a7e0085cf6df932d1', 7, '2019-09-08'),
('f2537e02cce4272a6416762be782147862eff8a9', 8, '2019-11-12'),
('09a15bc2ba6d90eadbfa91765f0c13c08edf99ab', 9, '2019-11-12'),
('2d09a57ec7fc4392a848a9c06d729def5dbdae4b', 10, '2019-11-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `correoelectronico` varchar(45) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidopaterno` varchar(45) NOT NULL,
  `apellidomaterno` varchar(45) NOT NULL,
  `iddependencia` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`,`correoelectronico`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `correoelectronico`, `contrasena`, `nombre`, `apellidopaterno`, `apellidomaterno`, `iddependencia`, `idrol`) VALUES
(1, 'alejandro@yahoo.com', 'VVZkNGJHRnRSblZhU0VwMitS', 'Alejandro', 'Contreras', 'Benitez', 1, 1),
(2, 'josee@gmail.com', 'VmxaU1NrNVhVa2hVYTJ4WFlXdEtZVlpxUmt0TmJHdDVUVlZhVVZWVU1Eaz0rTw==', 'Jose', 'Cordero', 'Cordero', 1, 1),
(3, 'javier_agustinrm@hotmail.com', 'MTIzNDU2NzgrTQ==', 'Javier', 'Ramirez', 'Martinez', 1, 1),
(4, 'Alexander@gmail.com', 'VVZkNGJHRnRSblZhU0VwMitS', 'Alexander', 'Ramirez', 'Ortega', 1, 1),
(5, 'alejandra@yahoo.com', 'UVd4bGFtRnVaSEpoK0E=', 'Alejandra', 'Ibarra', 'Martinez', 1, 1),
(6, 'pepe@yahoo.com', 'VlVkV2QxcFVSWGxOZWxFOStS', 'Pepe', 'Contreras', 'Ramirez', 1, 3),
(7, 'laura@gmail.com', 'TGF1cmExMjM0K00=', 'Laura', 'Benitez', 'Rios', 1, 3),
(8, 'dedo@gmail.com', 'UTI5dGNIVjBZV1J2Y21FPStB', 'Jose', 'Cordero', 'Cordero', 1, 3),
(9, 'daniel123@yahoo.com', 'UkdGdWFXVnNNVEl6K0E=', 'Daniel', 'Ibarra', 'Ramirez', 3, 3),
(10, 'mario123@yahoo.com', 'Vmtaa1IyVlhSbGhQU0doT1lXc3dPUT09K0M=', 'Mario', 'Jimenez', 'Flores', 2, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
