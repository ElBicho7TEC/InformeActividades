<?php
$nombre=$_POST["nombre"];
$calle=$_POST["calle"];
$colonia=$_POST["colonia"];
$numero=$_POST["numero"];
$cp=$_POST["cp"];
$referencias=$_POST["referencias"];


 include 'conexion.php';


$stmt = $conn->prepare("CALL sp_insertarDependencias(?,?,?,?,?,?)");
$stmt->bindParam(1, $nombre, PDO::PARAM_STR);
$stmt->bindParam(2, $calle, PDO::PARAM_STR);
$stmt->bindParam(3, $colonia, PDO::PARAM_STR);
$stmt->bindParam(4, $numero, PDO::PARAM_STR);
$stmt->bindParam(5, $cp, PDO::PARAM_STR);
$stmt->bindParam(6, $referencias, PDO::PARAM_STR);

$stmt->execute();

  header("Location: altaDependencia.php");

 ?>
