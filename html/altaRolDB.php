<?php

$nombreRol=$_POST["nombreRol"];

 include 'conexion.php';


$stmt = $conn->prepare("CALL sp_insertarRoles(?)");

$stmt->bindParam(1, $nombreRol, PDO::PARAM_STR);

$stmt->execute();


header("Location: altaRol.php");

 ?>
