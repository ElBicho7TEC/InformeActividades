#Procedimiento Almacenado para insertar Usuario


DELIMITER //
  CREATE PROCEDURE sp_insertar_usuarios(
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
//
DELIMITER ;
