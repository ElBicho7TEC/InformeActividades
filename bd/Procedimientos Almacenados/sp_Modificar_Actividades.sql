#Procedimiento Almacenado para modificar actividades

DELIMITER //
CREATE  PROCEDURE `sp_modificar_actividades`(
	in idActividad INT,
	in nombre_Actividad VARCHAR(500),
	in descripcion VARCHAR(500),
	in fechaDia INT,
	in fechaMes INT,
	in fechaAno INT,
	in Bimestre INT,
	in idDependencia INT,
	in idfotosEvidencia INT,
	in idplanDesarrollo INT
)
BEGIN
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
END
//
DELIMITER ;
