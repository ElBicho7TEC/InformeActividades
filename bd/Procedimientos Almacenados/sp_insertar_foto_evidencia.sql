#Procedimiento para insertar foto de evidencia

DROP procedure IF EXISTS sp_insertar_foto_evidencia;
DELIMITER //
create procedure sp_insertar_foto_evidencia(
ruta VARCHAR(200))
begin
set @id= (select   idfotosevidencia from fotosevidencia ORDER BY idfotosevidencia DESC limit 1) ;
set @id = (select IFNULL(@id, 0)); 
set @id=@id+1;
insert into fotosevidencia values (@id, ruta);
end
//
DELIMITER ;


