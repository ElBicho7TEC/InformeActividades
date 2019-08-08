#Procedimiento almacenado para insertar actividad

DROP procedure IF EXISTS sp_insertar_actividades;
DELIMITER //
CREATE  PROCEDURE sp_insertar_actividades(
	in nombre_actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechadia INT,
	in fechames INT,
	in fechaano INT,
	in bimestre INT,
	in iddependencia INT,
    in idplandesarrollo int
)
BEGIN
set @id= (select   idactividad from actividad ORDER BY idactividad DESC limit 1);
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
set @idFoto= (select max(idfotosevidencia) as idfotosevidencia from fotosevidencia);
insert into actividad values (@id, nombre_actividad, descripcion, fechadia, fechames, fechaano, bimestre,
    iddependencia, @idFoto, idplandesarrollo);
END
//
DELIMITER ;
