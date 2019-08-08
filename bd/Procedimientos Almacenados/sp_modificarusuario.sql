#Procedimiento almacenado para modificar Usuario

DELIMITER //
CREATE  PROCEDURE `sp_modificarusuario`(var_idusuario int, var_nombre varchar(45), var_apellidopat varchar(45),var_apellidomat varchar (45),var_contrasena varchar(45))
BEGIN 
update usuarios set contrasena=var_contrasena, nombre=var_nombre, apellidopaterno=var_apellidopat, apellidomaterno=var_apellidomat WHERE idusuario=var_idusuario;
END
//
DELIMITER ;
