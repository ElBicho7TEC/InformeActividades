<?php include 'getInfo.php'; ?>
<?php
$nombre_PlanDesarrollo=$_POST["nombre_PlanDesarrollo"];
$descripcion_PlanDesarrollo=$_POST["descripcion_PlanDesarrollo"];
$estatus_PlanDesarrollo=$_POST["estatus_PlanDesarrollo"];
$fecha_PlanDesarrollo=$_POST["fecha_PlanDesarrollo"];
$idDependencia;


 include 'conexion.php';


$stmt = $conn->prepare("CALL sp_insertar_plan_desarrollo(?,?,?,?,?)");

$stmt->bindParam(1, $nombre_PlanDesarrollo, PDO::PARAM_STR);
$stmt->bindParam(2, $descripcion_PlanDesarrollo, PDO::PARAM_STR);
$stmt->bindParam(3, $estatus_PlanDesarrollo, PDO::PARAM_STR);
$stmt->bindParam(4, $fecha_PlanDesarrollo, PDO::PARAM_STR);
$stmt->bindParam(5, $idDependencia, PDO::PARAM_INT);

$stmt->execute();


header("Location: insertarPlanDesarrollo.php");
 ?>
