
<?php
$tituloPagina="Generar Informe";
include 'getInfo.php';
include 'header.php';

?>
<body>
  <div class="container">
  	<form class="Myformulario"enctype='multipart/form-data' method="POST" action="generarinformeDB.php">
      <div class="row justify-content-center text-center text-md-left">
          <div class="col-md-12 text-center" style="background: yellow">
          Puedes generar tu informe por actividades o por fecha,sino seleccionas ninguno te redireccionara de nuevo a esta pagina, de igual forma  si seleccionas ambas te hara el informe por actividades y no por fechas
          !!Gracias!!
          </div>
      </div>

      <div class="row justify-content-center text-center text-md-left">

          <div class="col-md-6">


            <div class="row">
            <div class="col-3">
          <b>  <?php echo "ID"; ?></b>
            </div>
            <div class="col-3">
            <b> <?php echo "Actividad"; ?></b>
            </div>
            <div class="col-3">
            <b> <?php echo "Fecha"; ?></b>
            </div>
            <div class="col-3">
            <b> <?php echo "Seleccionar "; ?></b>
            </div>
            </div>

          <?php
            include 'conexion.php'; //se incluye la conexión
            $idUsuarios;
            $ConsultaActividades = $conn->prepare("select actividad.idactividad,actividad.nombreactividad,actividad.fechaano,actividad.fechadia,actividad.fechames from actividad inner join historial_actividad WHERE actividad.idactividad=historial_actividad.idactividad and historial_actividad.idusuario=$idUsuarios ORDER BY actividad.idactividad DESC");  //se realiza la consulta de las actividades
             $ConsultaActividades->execute(); // se ejecuta la consulta
             $ResultadoActividades = $ConsultaActividades->fetchAll(); //se obtienen los datos de la consulta
                foreach ($ResultadoActividades as $Datos)
                  { //se recorren los datos
                  $identificador=$Datos['idactividad'];
                  $nombre=$Datos['nombreactividad'];
                  $anio=$Datos['fechaano'];
                  $dia=$Datos['fechadia'];
                  $mes=$Datos['fechames'];
          ?>
                <div class="row">
               <div class="col-3">
                #<?php echo $identificador; ?>
               </div>
               <div class="col-3">
                <?php echo $nombre; ?>
               </div>
               <div class="col-3">
                <?php echo $dia; ?>/<?php echo $mes; ?>/<?php echo $anio; ?>
               </div>
               <div class="col-3">
                <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="<?php echo $identificador ?>" id="id" name="id[]">
                </div>
                </div>
               </div>
            </div>
           <?php } ?>
  	      </div>
          <div class="col-md-6">
            <div class="form-group">
            Fecha de Inicio: <input class="form-control" type="date" id="fecha1" name="fecha1" style="width: 80%">
            <div class="form-group">
            Fecha de Término: <input class="form-control" type="date" id="fecha2" name="fecha2" style="width: 77%" >
             </div>
            </div>
          </div>
  	    </div>
         <button type="submit" name="enviar" id="enviar" class="btn btn-primary">Generar Informe</button>
  	</form>
  </div>
</body>
<?php
include 'footer.php';
?>
</html>
