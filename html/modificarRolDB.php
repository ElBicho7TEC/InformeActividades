<?php
$id=$_POST["id"];
$nombreRol=$_POST["nombreRol"];

 include 'conexion.php';


  $stmt = $conn->prepare("CALL sp_modificarrol(?,?)");
  $stmt->bindParam(1, $id, PDO::PARAM_INT);
  $stmt->bindParam(2, $nombreRol, PDO::PARAM_STR);

  $stmt->execute();





header("Location: modificarRol.php");

?>
