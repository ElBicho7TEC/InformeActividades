#Procedimiento para insertar plan de desarrollo

DROP procedure IF EXISTS sp_insertar_plan_desarrollo;
DELIMITER //
create procedure sp_insertar_plan_desarrollo(
nombreplandesarrollo VARCHAR(45),descripcion VARCHAR(45), estatus VARCHAR(45), fechaprogramada VARCHAR(45), iddependencia int)
begin
set @id= (select idplandesarrollo from plandesarrollo ORDER BY idplandesarrollo DESC limit 1);
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into plandesarrollo values (@id, nombreplandesarrollo, descripcion, estatus, fechaprogramada, iddependencia);
end
//
DELIMITER ;


