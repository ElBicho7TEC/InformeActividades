<?php
include 'getInfo.php';
if (isset($_POST['enviar']))  // si se envio algo entra a la condicion
{
 // $fechainicio=$_POST['fecha1']; // se obtiene la fecha de inicio
  //$fechafin=$_POST['fecha2']; // se obtiene la fecha de fin
  if (isset($_POST['id'])) // si selecciono una casilla de actividades entra a la condicion
  {



   include("conexion.php");
         




require('fpdf/fpdf.php'); // esta direccion se debe cambiar a la de donde se aloja la carpeta
$pdf=new FPDF();// se crea un nuevo archivo FPDF


foreach ($_POST['id'] as $checkbox) // los datos del post de id se recorren
    {
		   //consulta para conseguir los datos del informe
            $consultainforme=$conn->prepare("select DISTINCT  informe.idinforme, informe.fecha,
			concat(usuarios.nombre , ' ' ,  usuarios.apellidopaterno , ' '  , usuarios.apellidomaterno) as nombrecompleto,
			dependencia.nombredependencia
			from informe inner join usuarios inner join dependencia inner join historial_informe inner join actividad WHERE actividad.idactividad=historial_informe.idactividad  and  usuarios.iddependencia=actividad.iddependencia
			and dependencia.iddependencia=actividad.iddependencia and historial_informe.idinforme=informe.idinforme and informe.idusuario=usuarios.idusuario 
			and informe.idinforme=$checkbox 
			ORDER BY  informe.idinforme DESC;") ;
			 $consultainforme->execute(); // se ejecuta la consulta
             $resultadoinformes = $consultainforme->fetchAll(); //se obtienen los datos de la consulta
			
	foreach ($resultadoinformes as $resultado){
                $folio=$resultado['idinforme'];
                 $fechaInforme=$resultado['fecha'];
              
                $elaboro=$resultado['nombrecompleto'];
                $dependencia=$resultado['nombredependencia'];
				}
		
		
$pdf->addPage();// se añade una pagina
$pdf->SetFont('Helvetica','I',13);
$pdf->Cell(0,100,'Estamos viendo',1,1,'C');
$pdf->Cell(0,10,'Informe de actividades ('.$fechaInforme.')',0,1,'C');
$pdf->Cell(0,10,'Direccion de:'.$dependencia,0,1,'C');
$pdf->Cell(0,10,utf8_decode('Perteneciente al XLI Ayuntamiento de Ahucatlán,Nayarit.'),0,1,'C');
$pdf->Cell(0,50,'',0,1,'C');
$pdf->Cell(0,20,'______________________________________________',0,1,'C');
$pdf->Cell(0,10,'C.'.$elaboro,0,1,'C');
$pdf->SetFont('Arial','I',7);
$pdf->Cell(0,5,utf8_decode('Municipio de Ahucatlán'),0,1,'C');
$pdf->Cell(0,5,'Calle Miguel Hidalgo esq.20 de noviembre s/n,col.Centro',0,1,'C');
$pdf->Cell(0,5,utf8_decode('C.P.63900 Ahucatlán,Nayarit, México Tels.,01(324)2411254,2410239'),0,1,'C');


	//consulta para conseguir las actividades del informe
    $consultaactividades=$conn->prepare("select * from actividad inner join fotosevidencia inner join historial_informe
	where actividad.idfotosevidencia=fotosevidencia.idfotosevidencia and historial_informe.idactividad=actividad.idactividad and
	historial_informe.idinforme=$checkbox");
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
     $pdf->Cell(0,10,utf8_decode('Dirección de: '.$dependencia),1,1,'C');
     $pdf->Cell(0,10,utf8_decode('Actividad:  '.$nombreactividad),1,1,'C');
     $pdf->Ln(120);
     $pdf->Image($direccionimg,50,50,100,100);
     $pdf->Cell(0,10,utf8_decode('Descripcion:  '.$descripcionActividad),1,1,'C');
     $pdf->Ln(10);
     $pdf->SetY(266);
      $pdf->Cell(0,10,'Elaboro: '.$elaboro.'          '.'Fecha: '.$fechaactividad,0,1,'C');
	
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
    header("location:indexAdministrador.php");
    }
}

?>
