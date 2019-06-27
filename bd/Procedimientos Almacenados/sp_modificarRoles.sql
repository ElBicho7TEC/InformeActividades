#Procedimiento almacenado para modificar Roles
DELIMITER //
create procedure sp_modificarRoles(var_idRol INT,var_tipoRol VARCHAR(45))
begin
UPDATE rol SET tipoRol=var_tipoRol WHERE idRol = var_idRol;
end
;
//
DELIMITER ;






