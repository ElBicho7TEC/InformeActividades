CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Insertar_Actividades`(
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
	insert into actividad values (default, nombre_Actividad, descripcion, fechaDia, fechaMes, fechaAno,
    Bimestre, idDependencia, idfotosEvidencia, idplanDesarrollo);
END