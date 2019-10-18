<?php $tituloPagina="Administrador" ?>
<?php include 'getInfo.php'; ?>

    <?php include 'header.php'; ?>


<body>

<div class="header-bottom">
    <div class="container">
        <div class="row justify-content-center text-center text-md-left">
        </div>
    </div>
</div>


<div class="col-12 text-center  ">
    <b>Busqueda por dependencia:</b>
  <form action="indexAdministrador.php"  method="post"  enctype="multipart/form-data">
    <!-- Tipo -->
    <div class="form-group">
 
        <select name="dependencia" id="dependencia">
    <?php


    
                include 'conexion.php';
                $datos = $conn->query('SELECT * FROM dependencia');
                while ($valores=$datos->fetch()) {
                    echo "'<option value= $valores[iddependencia]> $valores[nombredependencia] </option>'";
                }
                ?>



  
    </select>
    <input type="submit" id="BuscarDependencia" name="BuscarDependencia" value="Buscar por Dependencia">
    </div>
    <!-- Fin del tipo -->

  </form>
</div>

<div class="col-12 text-center  ">
    <b>Busqueda por fecha:</b>
  <form action="indexAdministrador.php"  method="post"  enctype="multipart/form-data">
    <!-- Fechas -->
	 <div class="form-group text-center">
						  <span>Fecha Inicial:</span>
						  <input type="date" id="FechaInicio" name="FechaInicio" required=""  maxlength="45">
					   </div>
					    <div class="form-group text-center">
						  <span>Fecha Final:</span>
						  <input type="date" id="FechaFinal" name="FechaFinal" required=""  maxlength="45">
					   </div>
    <div class="form-group">
 <!--Fin Fechas -->
 
    <input type="submit" id="BuscarFecha" name="BuscarFecha" value="Buscar por Fecha">
    </div>


  </form>
</div>


<form class="Myformulario"enctype='multipart/form-data' method="POST" action="generarinformeAdminDB.php">
<div class="container mb-2">
    <h1 class="text-center">
        Informes
    </h1>


        <table>
            <tr>
                <td>
                    <strong>Folio</strong>
                </td>

                <td>
                    <strong>Fecha</strong>
                </td>

             

                <td>
                    <strong>Elaboró</strong>
                </td>
                <td>
                    <strong>Dependencia</strong>
                </td>
				<td>
                    <strong>Seleccionar</strong>
                </td>
			
            </tr>




            <?php
            include("conexion.php");
            //consulta
            $cadena='select DISTINCT  informe.idinforme, informe.fecha,
			concat(usuarios.nombre , " " ,  usuarios.apellidopaterno , " "  , usuarios.apellidomaterno) as nombrecompleto,
			dependencia.nombredependencia
			from informe inner join usuarios inner join dependencia inner join historial_informe inner join actividad' ;
            
			
			//where general
			$cadena = $cadena. " WHERE actividad.idactividad=historial_informe.idactividad  and  usuarios.iddependencia=actividad.iddependencia
			and dependencia.iddependencia=actividad.iddependencia and historial_informe.idinforme=informe.idinforme and informe.idusuario=usuarios.idusuario ";
			
			//Busqueda por dependencia
			if(isset($_POST["dependencia"])){
			$idDependenciaSeleccionada=$_POST['dependencia'];
			
			$cadena=$cadena." and actividad.iddependencia=$idDependenciaSeleccionada " ;	

			}
			//Fin Busqueda por dependencia
			
			//Busqueda por fecha
			if(isset($_POST["FechaInicio"]) and isset($_POST["FechaFinal"])){
			$FechaInicio=$_POST['FechaInicio'];
			$FechaFinal=$_POST['FechaFinal'];
			
			$cadena=$cadena." and  informe.fecha  between  '$FechaInicio' and '$FechaFinal' " ;	

			}
			//Fin Busqueda por fecha
			
			//order by
			$cadena = $cadena." ORDER BY  informe.idinforme DESC;" ;
			
			//echo $cadena;
			$gsent = $conn->prepare($cadena);
            $gsent->execute();
			
            while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC))
            {
				$identificador=$resultado['idinforme'];
                $folio=$resultado['idinforme'];
                 $fechaInforme=$resultado['fecha'];
              
                $elaboro=$resultado['nombrecompleto'];
                $dependencia=$resultado['nombredependencia'];
                ?>

                <tr>
                    <td>
                        #<?php  echo   $folio ?>
                    </td>
                    <td>
                      <?php echo $fechaInforme ?>
                    </td>
                    <td>
                   <?php echo $elaboro ?>
                    </td>
                    <td >
                    <?php echo $dependencia ?>
                    </td>
                    <td>
                         <input class="form-check-input" type="checkbox" value="<?php echo $identificador ?>" id="id" name="id[]">
                    </td>
				

			
                </tr>
                <?php
            }
            ?>
        </table>
			<button type="submit" name="enviar" id="enviar" class="btn btn-primary">Generar Informe</button>
    </div>
	</form>
</div>
<?php include 'footer.php' ?>
