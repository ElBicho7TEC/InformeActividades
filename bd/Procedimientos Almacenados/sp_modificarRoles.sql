#Procedimiento almacenado para modificar Roles

DELIMITER //
CREATE  PROCEDURE `sp_modificarrol`(var_idrol int,var_tiporol)
BEGIN 
UPDATE rol SET tiporol=var_tiporol WHERE idrol = var_idrol;
END
//
DELIMITER ;
