<html>
	<?php 
	include 'header.php'; 
	?>
	
	<body>
		<?php 
		if(isset($_GET["idRol"])) 
		{//Si se envia ID, cambiar por POST
			$id=$_GET["idRol"];
			include "conexion.php";
			$cadena='SELECT * FROM rol where idRol= :id';
			$gsent = $conn->prepare($cadena);
			$gsent->bindParam(':id', $id, PDO::PARAM_INT);
			$gsent->execute();
			$resultado = $gsent->fetch(PDO::FETCH_ASSOC);
			$rol=$resultado['tipoRol'];
			$funcion="Modificar";
		} 
		else 
		{//Si no tiene ID
			$id="";
			$rol="";
			$funcion="Insertar";
		}
		?>
		
		<div class="header-bottom">
			<h1 class="text-center">
				Modificar Usuario
			</h1>
			
			<div class="container">
				<div class="row justify-content-center text-center text-md-left">
					<div class="col-12 col-md-4 mt-5 mt-md-10">
						<form class="Myformulario" action="dataRolDB.php" method="post">
							<div class="form-group">
								<label style="font-size: 35px; text-align: center;">
									Tipo de Rol
								</label>
								
								<input style="width: 280px" placeholder="Ejemplo: Trabajador"    type="text"  name="nombreRol" value="<?php echo $rol ?>" maxlength="45" required=" " pattern="[a-zA-Z]+">
							</div>
						
							<div class="form-group text-center">
								<input type="hidden" style="float: left;" name="id" value="<?php echo $id ?>">
								<input class="btn btn-info sss" style="float: right;" type="submit" id="Guardar" name="Guardar" value="<?php echo $funcion ?>">
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