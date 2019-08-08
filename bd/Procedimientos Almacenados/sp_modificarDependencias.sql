#Procedimiento almacenado para modificar Dependencias

DELIMITER //
create procedure sp_modificardependencias(
	 var_idDependencia INT,
	 var_nombreDependencia VARCHAR(45),
	 var_calle VARCHAR(45),
	 var_colonia VARCHAR(45),
	 var_numero VARCHAR(45),
	 var_codigoPostal VARCHAR(45),
	 var_entreCalles VARCHAR(45)
)
BEGIN
    UPDATE dependencia SET 
    nombredependencia=var_nombreDependencia,
    calle=var_calle,
    colonia=var_colonia,
    numero=var_numero,
    codigopostal=var_codigoPostal,
    entrecalles=var_entreCalles
    WHERE iddependencia=var_idDependencia;
END
//
DELIMITER ;

