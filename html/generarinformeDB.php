<?php
include 'getInfo.php';
if (isset($_POST['enviar']))  // si se envio algo entra a la condicion  
{
	$fechainicio=$_POST['fecha1']; // se obtiene la fecha de inicio 
	$fechafin=$_POST['fecha2']; // se obtiene la fecha de fin 
	if (isset($_POST['id'])) // si selecciono una casilla de actividades entra a la condicion 
	{
$fechahoy=getdate(); // se obtiene la fecha del dia actual 
$diahoy=$fechahoy['mday']-1; //dia del dia
$meshoy=$fechahoy['mon']; //mes del dia
$aniohoy=$fechahoy['year']; //año del dia
$fecha=$aniohoy.'/'.$meshoy.'/'.$diahoy; //fecha al dia que se realiza el informe
 include 'conexion.php'; // se incluye la conexion de la base de datos 
$stmt = $conn->prepare("insert into informe values(null,'$fecha',1,$idUsuarios)"); // el plan de desarrollo cambiarlo cuando se tenga
$stmt->execute();// se ejecuta la consulta 
$consultaidinforme=$conn->prepare("select idinforme from informe order by idinforme desc limit 1"); 
$consultaidinforme->execute(); // se ejecuta la consulta
$Resultadoidinforme= $consultaidinforme->fetchAll(); //se obtienen los datos de la consulta
foreach ($Resultadoidinforme as $Datos) 
{
$identificador=$Datos['idinforme']; // se guarda el id en una variable 
} 
foreach ($_POST['id'] as $checkbox) // los datos del post de id se recorren 
	  { 
     $inserthistorial = $conn->prepare("insert into historial_informe values($identificador,$checkbox)"); // se inserta a un historial de informes para futuras consultas
     $inserthistorial->execute();// se ejecuta la consulta 
     // en esta parte falta una consulta de las actvidades para poder mandarlas  
    }
/* en esta parte se tendra que poner lo necesario para mandar y crear el informe  */
	}
	elseif($fechainicio!="") // esto es por si selecciona fechas pero no actividades entraria en este ciclo 
	{
       if ($fechafin>=$fechainicio) 
       {
        echo "esto se puede";
       }
       elseif ($fechainicio=="")
       {
       echo "esto no se puede";
       }
       else
       {
       echo "esto no se puede";
       }
	}
	else
	{
    header("location:generarinforme.php");	
    }
}

?>