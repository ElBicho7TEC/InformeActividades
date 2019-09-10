<?php $tituloPagina="Modificar Rol" ?>
<?php include 'getInfo.php'; ?>
<?php
		if(isset($_GET["idRol"]))
		{//Cambiar por POST a futuro
			$id=$_GET["idRol"];
			include "conexion.php";
			$cadena='SELECT * FROM rol where idRol= :id';
			$gsent = $conn->prepare($cadena);
			$gsent->bindParam(':id', $id, PDO::PARAM_INT);
			$gsent->execute();
			$resultado = $gsent->fetch(PDO::FETCH_ASSOC);
			$rol=$resultado['tiporol'];
		}
		else
		{//Si no se envia ID del rol que se quiere modificar, entonces manda al de dar de alta
			header("Location: altaRol.php");

		}
		?>

		<?php include 'header.php'; ?>


	<body>
		<div class="header-bottom">
				<h1 class="text-center">Modificar rol</h1>

			<div class="container">
				<div class="row justify-content-center text-center text-md-left">
					<div class="col-12 col-md-4 mt-5 mt-md-10">
						<form class="Myformulario" action="modificarRolDB.php" method="post">
							<div class="form-group">
								<label style="font-size: 35px; text-align: center;">
									Tipo de Rol
								</label>

								<input style="width: 280px" placeholder="Ejemplo: Trabajador"    type="text"  name="nombreRol" value="<?php echo $rol ?>" maxlength="45" required=" " pattern="[a-zA-Z]+">
							</div>

							<div class="form-group">
								<input type="hidden"  name="id" value="<?php echo $id ?>"> <!--Como esta en hidden no se va a mostrar en la interfaz -->
								<input class="btn btn-info" type="submit" id="Guardar" name="Guardar" value="Modificar">
							</div>
						</form>
					</div>
				</div>

				<div style="height:250px">

				</div>
			</div>
		</div>

	</body>

	<?php
	include 'footer.php'
	?>

</html>
