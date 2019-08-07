#Procedimiento para insertar Rol

DELIMITER //
create procedure sp_insertarroles(nombreRol varchar(45))
begin
set @id= (select   idRol from rol ORDER BY idRol DESC limit 1) ;
set @id=@id+1;
insert into rol values(@id,nombreRol);
end
//
DELIMITER ;
