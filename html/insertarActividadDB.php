<?php
include 'getInfo.php';
?>
<?php
$Foto=$_FILES["foto"];//se obtiene el archivo de la fotografia
$NFoto=$Foto['name']; //se obtiene el nombre
$type =$Foto['type']; //se obtiene el tipo
$ext = pathinfo($NFoto, PATHINFO_EXTENSION);//se obtiene la extension
$allowed =  array('jpeg','png' ,'jpg');//Extensiones permitidas

if(!in_array($ext,$allowed) ) {//Checamos de una vez las extensiones permitidas
 header("Location: insertarActividad.php?errorValidacion=1");//Si no son de las extensiones permitidas, que regrese al usuario.
}
else{
$url_temp=$Foto['tmp_name']; //se obtiene la direccion que le otoga temporalmente
  if($NFoto !='')
  {
    $destino='imagenes/'; //ruta que debe cambiar a la del servidor
    $imgnombre='img_'.md5(date('d-m-Y H:m:s')); //se encripta el nombre con md5 y la fecha de captura
    $imgProducto=$imgnombre.".".$ext; //se guarda con la extension que tuvo
    $src =$destino.$imgProducto; //se obtiene la ruta de la imagen que se guardara en la base de datos
  }
/* se obtienen los datos del formulario */
$nombre=$_POST["nombre"]; //nombre
$descripcion=$_POST["descripcion"];// descripcion
$fecha=$_POST["fecha"];//fecha
list($anio, $mes, $dia) = explode("-",$fecha); //la fecha se separa en variables por año, mes y dia
$bimestre=$_POST["bimestre"];//bimestre
  if ($bimestre=="Selecciona el bimestre") //si no selecciono un bimestre se selecciona el uno automaticamente
   {
     $bimestre=1;
   }
$idDependencia;
$planTrabajo=$_POST["planTrabajo"];

$idUsuarios;
$fechaCaptura=getdate(); // se obtiene la fecha del dia actual
$diaCaptura=$fechaCaptura['mday']; //dia del dia
$mesCaptura=$fechaCaptura['mon']; //mes del dia
$anioCaptura=$fechaCaptura['year']; //año del dia




if ($Foto!='') {
    move_uploaded_file($url_temp,$src);
    }

    include 'conexion.php';
    //Primero se inserta la informacion de la foto
    $stmt = $conn->prepare("CALL sp_insertar_foto_evidencia(?)");
    $stmt->bindParam(1, $src, PDO::PARAM_STR);
    $stmt->execute();

    //Despues se inserta la Actividad
    $stmt = $conn->prepare("CALL sp_insertar_actividades(?,?,?,?,?,?,?,?)");
    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
    $stmt->bindParam(2, $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(3, $dia, PDO::PARAM_INT);
    $stmt->bindParam(4, $mes, PDO::PARAM_INT);
    $stmt->bindParam(5, $anio, PDO::PARAM_INT);
    $stmt->bindParam(6, $bimestre, PDO::PARAM_INT);
    $stmt->bindParam(7, $idDependencia, PDO::PARAM_INT);
    $stmt->bindParam(8, $planTrabajo, PDO::PARAM_INT);
    $stmt->execute();

   //Finalmente se inserta en el historial de Actividad
   $stmt = $conn->prepare("CALL sp_insertar_historial_actividad(?,?,?,?)");
   $stmt->bindParam(1, $idUsuarios, PDO::PARAM_INT);
   $stmt->bindParam(2, $diaCaptura, PDO::PARAM_INT);
   $stmt->bindParam(3, $mesCaptura, PDO::PARAM_INT);
   $stmt->bindParam(4, $anioCaptura, PDO::PARAM_INT);
   $stmt->execute();

 header("Location: insertarActividad.php");
 }
?>
