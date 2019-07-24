CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insertar_Usuarios`(
  in correoElectronico VARCHAR(45),
  in contraseña VARCHAR(45),
  in Nombre VARCHAR(45),
  in apellidoPaterno VARCHAR(45),
  in apellidoMaterno VARCHAR(45),
  in idDependencia INT,
  in idRol INT
)
BEGIN
	insert into usuarios values (null, correoElectronico, contraseña, Nombre,
    apellidoPaterno, apellidoMaterno, idDependencia, idRol);
END
