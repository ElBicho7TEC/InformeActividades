<?php
include 'getInfo.php';
?>
<?php
$Foto=$_FILES["foto"];//se obtiene el archivo de la fotografia 
$NFoto=$Foto['name']; //se obtiene el nombre
$type =$Foto['type']; //se obtiene el tipo 
$url_temp=$Foto['tmp_name']; //se obtiene la direccion que le otoga temporalmente
  if($NFoto !='')
  {
    $destino='C:/xampp/htdocs/informeActividades/html/imagenes/'; //ruta que debe cambiar a la del servidor
    $imgnombre='img_'.md5(date('d-m-Y H:m:s')); //se encripta el nombre con md5 y la fecha de captura 
    $imgProducto=$imgnombre.'.jpg'; //se guarda omo jpg
    $src =$destino.$imgProducto; //se obtiene la ruta de la imagen que se guardara en la base de datos 
  }
/* se obtienen los datos del formulario */
$nombre=$_POST["nombre"]; //nombre
$descripcion=$_POST["descripcion"];// descripcion
$bimestre=$_POST["bimestre"];//bimestre
  if ($bimestre=="Selecciona el bimestre") //si no selecciono un bimestre se selecciona el uno automaticamente
   {
     $bimestre=1;
   }
$fecha=$_POST["fecha"];//fecha
list($anio, $mes, $dia) = explode("-",$fecha); //la fecha se separa en variables por año, mes y dia
$fechaCaptura=getdate(); // se obtiene la fecha del dia actual 
$diaCaptura=$fechaCaptura['mday']-1; //dia del dia
$mesCaptura=$fechaCaptura['mon']; //mes del dia
$anioCaptura=$fechaCaptura['year']; //año del dia
$idDependencia;
$idUsuarios;
include 'conexion.php';
$stmt = $conn->prepare("CALL sp_insertar_actividades(null,'$src','$nombre','$descripcion',$dia,$mes,$anio,$bimestre,$idDependencia,1,$idUsuarios,null,$diaCaptura,$mesCaptura,$anioCaptura)");
$stmt->execute();
if ($Foto!='') {
      move_uploaded_file($url_temp,$src); //se mueve la imagen a la carpeta predeterminada
    } 
 header("Location: insertarActividad.php");
?>