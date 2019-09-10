<?php $tituloPagina="Modificar Dependencia" ?>
<?php include 'getInfo.php'; ?>
<?php if(isset($_GET["idDependencia"]))
 {//Cambiar por POST a futuro
    $id=$_GET["idDependencia"];
    include "conexion.php";
    $cadena='SELECT *FROM dependencia where idDependencia= :id';
    $gsent = $conn->prepare($cadena);
    $gsent->bindParam(':id', $id, PDO::PARAM_INT);
    $gsent->execute();
    $resultado = $gsent->fetch(PDO::FETCH_ASSOC);
    $nombreDeependencia=$resultado['nombredependencia'];
    $calle=$resultado['calle'];
    $colonia=$resultado['colonia'];
    $numero=$resultado['numero'];
    $codigoPostal=$resultado['codigopostal'];
    $entreCalles=$resultado['entrecalles'];

 }
else
 {//Si no se manda ID, entonces mandar al listado  de dependencias
	header("Location: listadoDependencia.php");
 }
 ?>


			<?php include 'header.php'; ?>


	<body>
	<div class="header-bottom">

	<div class="container">
	<div class="row justify-content-center text-center text-md-left">
				</div>

			</div>
	</div>
	</div>

	<div class="container">
		<h1 class="text-center">Modificar Dependencias</h1>
		<div class="col-12" >
			<form class="Myformulario" style="margin-top: 150p%; margin-left: 15%;" action="modificarDependenciaDB.php" method="post">
				<div class="form-group">
					<label>Nombre:</label>
					<input placeholder="Ejemplo: Transito" type="text" name="nombre" maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $nombreDeependencia ?>">
					<label>Calle:</label>
					<input placeholder="Ejemplo: Mercado" type="text" name="calle"  maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $calle ?>">
					<label>Colonia:</label>
					<input placeholder="Ejemplo: Centro" type="text" name="colonia" maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $colonia ?>">
					<label>N&uacute;mero:</label>
					<input placeholder="Ejemplo: 11" type="text" name="numero"  maxlength="45" size="50" pattern="[0-9]{1,3}$" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $numero ?>">
					<label>C&oacute;digo Postal:</label>
					<input placeholder="Ejemplo: 63999" type="text" name="cp"  maxlength="45" size="50" required=" " pattern="[0-9]{5}" value="<?php echo $codigoPostal ?>">
					<label>Entre Calles:</label>
					<input placeholder="Ejemplo: Mercado e Hidalgo" type="text" name="referencias"   maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $entreCalles ?>">
				</div>
				<div class="form-group text-center">
				<input type="hidden"  name="id" value="<?php echo $id ?>"> <!--Como esta en hidden no se va a mostrar en la interfaz -->
					<input class="btn btn-info" type="submit" id="Guardar" name="Guardar" value="Modificar">
				</div>
			</form>

		</div>
	</div>
	<div class="container">
	<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatlán, Nayarit.</p>
			</div>
	</div>
	</body>
</html>
