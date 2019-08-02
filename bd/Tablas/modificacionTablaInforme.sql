USE gestion_plan_desarrollo;
-- -----------------------------------------------------
-- Table `Gestion_Plan_Desarrollo`.`informe`
-- -----------------------------------------------------

ALTER TABLE informe ADD idusuario  INT NOT NULL;
ALTER TABLE informe DROP notaevidencia;
select * from informe;