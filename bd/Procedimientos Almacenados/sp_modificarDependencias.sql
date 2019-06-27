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

