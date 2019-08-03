<?php
include 'codificacion.php';
$id=$_POST["id"];
$nombre=$_POST["nombre"];
$apellidopat=$_POST["apellidopaterno"];
$apellidomat=$_POST["apellidomaterno"];
$Contra=$_POST["ContraDecencriptada"];
$ContraEncriptada=codificar($Contra);

 include 'conexion.php';


  $stmt = $conn->prepare("CALL sp_modificarusuario(?,?,?,?,?)");
  $stmt->bindParam(1, $id, PDO::PARAM_STR);
  $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
  $stmt->bindParam(3, $apellidopat, PDO::PARAM_STR);
  $stmt->bindParam(4, $apellidomat, PDO::PARAM_STR);
  $stmt->bindParam(5, $ContraEncriptada, PDO::PARAM_STR);

$stmt->execute();


  header("Location: modificarUsuario.php");

 ?>
