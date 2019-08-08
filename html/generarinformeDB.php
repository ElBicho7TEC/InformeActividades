<?php
include 'getInfo.php';
if (isset($_POST['enviar']))  // si se envio algo entra a la condicion
{
  $fechainicio=$_POST['fecha1']; // se obtiene la fecha de inicio
  $fechafin=$_POST['fecha2']; // se obtiene la fecha de fin
  if (isset($_POST['id'])) // si selecciono una casilla de actividades entra a la condicion
  {
$fechahoy=getdate(); // se obtiene la fecha del dia actual
$diahoy=$fechahoy['mday']; //dia del dia
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
$consultadependencia=$conn->prepare("select nombredependencia from dependencia where iddependencia=$idDependencia");
$consultadependencia->execute(); // se ejecuta la consulta
$Resultadodependencia= $consultadependencia->fetchAll(); //se obtienen los datos de la consulta
foreach ($Resultadodependencia as $Datosdependencia)
{
$nombredependencia=$Datosdependencia['nombredependencia']; // se guarda el nombre en una variable
}
require('fpdf/fpdf.php'); // esta direccion se debe cambiar a la de donde se aloja la carpeta
$pdf=new FPDF();// se crea un nuevo archivo FPDF
$pdf->addPage();// se añade una pagina
$pdf->SetFont('Helvetica','I',13);
$pdf->Cell(0,100,'Estamos viendo',1,1,'C');
$pdf->Cell(0,10,'Informe de actividades ('.$fecha.')',0,1,'C');
$pdf->Cell(0,10,'Direccion de:'.$nombredependencia,0,1,'C');
$pdf->Cell(0,10,utf8_decode('Perteneciente al XLI Ayuntamiento de Ahucatlán,Nayarit.'),0,1,'C');
$pdf->Cell(0,50,'',0,1,'C');
$pdf->Cell(0,20,'______________________________________________',0,1,'C');
$pdf->Cell(0,10,'C.'.$apellidoPaterno.' '.$apellidoMaterno.' '.$Nombre,0,1,'C');
$pdf->SetFont('Arial','I',7);
$pdf->Cell(0,5,utf8_decode('Municipio de Ahucatlán'),0,1,'C');
$pdf->Cell(0,5,'Calle Miguel Hidalgo esq.20 de noviembre s/n,col.Centro',0,1,'C');
$pdf->Cell(0,5,utf8_decode('C.P.63900 Ahucatlán,Nayarit, México Tels.,01(324)2411254,2410239'),0,1,'C');
foreach ($_POST['id'] as $checkbox) // los datos del post de id se recorren
    {
    $consultaactividades=$conn->prepare("select * from actividad inner join fotosevidencia where actividad.idfotosevidencia=fotosevidencia.idfotosevidencia and idactividad=$checkbox");
    $consultaactividades->execute(); // se ejecuta la consulta
    $Resultadoactividades= $consultaactividades->fetchAll(); //se obtienen los datos de la consulta
    foreach ($Resultadoactividades as $Datosactividades)
     {
     $nombreactividad=$Datosactividades['nombreactividad'];
     $fechaactividad=$Datosactividades['fechaano'].'/'.$Datosactividades['fechames'].'/'.$Datosactividades['fechadia']; //fecha al dia que se realiza el informe
     $direccionimg=$Datosactividades['ruta'];
     $descripcionActividad=$Datosactividades['descripcion'];
     $pdf->addPage();// se añade una pagina
     $pdf->SetFont('Helvetica','B',15);
     $pdf->Cell(0,10,utf8_decode('H.XLI AYUNTAMIENTO CONSTITUCIONAL DE AHUCATLÁN, NAYARIT'),0,1,'C');
     $pdf->Cell(0,10,utf8_decode('Dirección de: '.$nombredependencia),1,1,'C');
     $pdf->Cell(0,10,utf8_decode('Actividad:  '.$nombreactividad),1,1,'C');
     $pdf->Ln(120);
     $pdf->Image($direccionimg,50,50,100,100);
     $pdf->Cell(0,10,utf8_decode('Descripcion:  '.$descripcionActividad),1,1,'C');
     $pdf->Ln(10);
     $pdf->SetY(266);
      $pdf->Cell(0,10,'Elaboro: '.$apellidoPaterno.' '.$apellidoMaterno.' '.$Nombre.'                       Fecha: '.$fechaactividad,0,1,'C');
     }
    }
  $pdf->Output('prueba.pdf','I');
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
