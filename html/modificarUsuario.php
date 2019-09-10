<?php $tituloPagina="Modificar Usuario" ?>
<?php include 'getInfo.php'; ?>
<?php include 'decodificacion.php';?>
<?php if(isset($_GET["idUsuario"]))
 {//Cambiar por POST a futuro
    $id=$_GET["idUsuario"];
    include "conexion.php";
    $cadena='SELECT *FROM usuarios where idUsuario= :id';
    $gsent = $conn->prepare($cadena);
    $gsent->bindParam(':id', $id, PDO::PARAM_INT);
    $gsent->execute();
    $resultado = $gsent->fetch(PDO::FETCH_ASSOC);
    $Nombre=$resultado['nombre'];
    $Apellidopat=$resultado['apellidopaterno'];
    $Apellidomat=$resultado['apellidomaterno'];
    $Contrasena=$resultado['contrasena'];
    $ContraDecencriptada=decodificar($Contrasena);
 }
else
 {//Si no se manda ID, entonces mandar al listado  de usuarios
	header("Location: listadoUsuarios.php");
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
		<h1 class="text-center">Modificar Usuario</h1>
		<div class="col-12" >
			<form class="Myformulario" style="margin-top: 150p%; margin-left: 15%;" action="modificarUsuarioDB.php" method="post">
				<div class="form-group">
					<label>Nombre del usuario:</label>
					<input placeholder="Ejemplo: Juan" type="text" name="nombre" maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $Nombre ?>">
					<label>Apellido Paterno:</label>
					<input placeholder="Ejemplo: Lopez" type="text" name="apellidopaterno"  maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $Apellidopat ?>">
					<label>Apellido Materno:</label>
					<input placeholder="Ejemplo: Esparza" type="text" name="apellidomaterno"  maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+" value="<?php echo $Apellidomat ?>">
					<label>Contraseña</label>
					<input placeholder="Ejemplo:12345 " type="text" name="ContraDecencriptada"  maxlength="45" size="50" required=" "  value="<?php echo $ContraDecencriptada ?>">
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
