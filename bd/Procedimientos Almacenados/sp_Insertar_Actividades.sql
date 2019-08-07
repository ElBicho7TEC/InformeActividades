#Procedimiento almacenado para insertar actividad

DELIMITER //
CREATE  PROCEDURE sp_insertar_actividades(
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
	insert into fotosevidencia values(null, ruta);
    set idfotos=(select max(idfotosevidencia) as idfotosevidencia from fotosevidencia);
    insert into actividad values (null, nombre_actividad, descripcion, fechadia, fechames, fechaano, bimestre,
    iddependencia, idfotos, idplandesarrollo);
	set idact=(select max(idactividad) as idactividad from actividad);
    insert into historial_actividad values (idusuario, idact, diacaptura,mescaptura,aniocaptura);
END
//
DELIMITER ;
