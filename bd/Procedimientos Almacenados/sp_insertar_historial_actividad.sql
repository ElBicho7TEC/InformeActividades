#Procedimiento almacenado para insertar en historial de actividades

DROP procedure IF EXISTS sp_insertar_historial_actividad;
DELIMITER //
CREATE  PROCEDURE sp_insertar_historial_actividad(
  in idusuario int,
    in diacaptura int,
    in mescaptura int, 
    in aniocaptura int
)
begin
set @idact=(select max(idactividad) as idactividad from actividad);
insert into historial_actividad values (idusuario, @idact, diacaptura,mescaptura,aniocaptura);
END
//
DELIMITER ;
