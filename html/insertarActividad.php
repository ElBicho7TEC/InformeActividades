<?php $tituloPagina="Insertar Actividad" ?>
<?php
include 'getInfo.php';
?>
<?php
include 'header.php';
?>
<body>
  <div class="container">
  	<form class="Myformulario" method="POST" action="insertarActividadDB.php" enctype='multipart/form-data'>
      <div class="row justify-content-center text-center text-md-left">
  	      <div class="col-md-12">
  	  	     <div class="form-group">
  	  	  	 Nombre Actividad: <input type="text"  id="nombre" name="nombre" class="form-control" name="Nombre" style="width: 80%" required=""  maxlength="45" pattern="[A-Za-z]+">
  	  	     </div>
  	  	     <div class="form-group">
             <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripcion de la Actividad" required=""  maxlength="45" pattern="[A-Za-z]+"></textarea>
             </div>
             <div class="form-group text-center">
                    <span>Plan de trabajo:</span>
                <select  id="planTrabajo" name="planTrabajo" required="">
                 <p></p>
                 <?php
                 include 'conexion.php';
                 $datos = $conn->query('SELECT * FROM plandesarrollo');
                 while ($valores=$datos->fetch()) {
                   echo "'<option value= $valores[idplandesarrollo]> $valores[nombreplandesarrollo] </option>'";
                 }
                             ?>
                </select>
                        </div>
             <div class="form-group">
                   Fecha de realización: <input class="form-control" type="date" id="fecha" name="fecha" style="width: 80%" required="">
             </div>
             <div class="form-group">
  	  	   	   <select class="custom-select custom-select mb-2" required="" id="bimestre" name="bimestre">
                 <option>Selecciona el bimestre</option>
                 <option value="1">Primero</option>
                 <option value="2">Segundo</option>
                 <option value="3">Tercero</option>
                 <option value="4">Cuarto</option>
                 <option value="3">Quinto</option>
                 <option value="3">Sexto</option>
               </select>
  	  	     </div>
  	         <div class="form-group">
               <?php if (isset($_GET['errorValidacion'])) { ?>
                Por favor elige un formato valido
              <?php }else { ?>
                  Seleciona la imagen de la actividad
                <?php } ?>
                <input type="file" class="form-control-file" id="foto" name="foto" accept="image/png, .jpeg, .jpg," required="">
             </div>
             <div class="form-group">
             	<button type="submit" name="Registro" class="btn btn-primary">Agregar</button>
             </div>
  	      </div>
  	    </div>
  	</form>
  </div>
</body>
<?php
include 'footer.php';
?>
</html>
