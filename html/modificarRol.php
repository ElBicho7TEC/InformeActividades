<html>
	<head>
		<title>Modificar Rol</title>
			<?php 
		include 'header.php'; 
	?>
		
	</head>
	
	<body>
	<?php if(isset($_GET["idRol"])) {//Si se envia ID, cambiar por POST
		$id=$_GET["idRol"];
		include "conexion.php";
		$cadena='SELECT * FROM rol where idRol= :id';
		$gsent = $conn->prepare($cadena);
		$gsent->bindParam(':id', $id, PDO::PARAM_INT);
		$gsent->execute();
		$resultado = $gsent->fetch(PDO::FETCH_ASSOC);
		$rol=$resultado['tipoRol'];
		$funcion="Modificar";
	} else {//Si no tiene ID
		$id="";
		$rol="";
		$funcion="Insertar";
	} ?>
	
	
	<div class="header-bottom">
	<h1 class="text-center">Modificar Usuario</h1>
		<div class="container">
			<div class="row justify-content-center text-center text-md-left">
				<div class="col-12">
					<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
						<a class="navbar-brand" href="#">Perfil</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item active">
									<a class="nav-link" href="indexAdministrador.php">Inicio <span class="sr-only">(current)</span></a>
								</li>
     
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Usuarios
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="registro.php">Agregar Nuevo</a>
										<a class="dropdown-item" href="#">Modificar Usuarios</a>
									</div>
								</li>
	  
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Dependencias
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="dataDependencia.php">Agregar Dependencia</a>
										<a class="dropdown-item" href="#">Modificar Dependencia</a>
									</div>
								</li>
							</ul>
							<form class="form-inline my-2 my-lg-0">
								<input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="Buscar" style="border-color: #5DADE2 !important; color: white !important;" >Buscar</button>
							</form>
						</div>
					</nav>
				</div>
				<div class="col-12 col-md-4 mt-5 mt-md-10">
					<form class="Myformulario" action="dataRolDB.php" method="post">
						<div class="form-group">
							<label style="font-size: 35px; text-align: center;">Tipo de Rol</label>
							<input style="width: 280px" placeholder="Ejemplo: Trabajador"    type="text"  name="nombreRol" value="<?php echo $rol ?>" maxlength="45" required=" " pattern="[a-zA-Z]+">
						</div>
						<div class="form-group text-center">
							<input type="hidden" style="float: left;" name="id" value="<?php echo $id ?>">
							<input class="btn btn-info sss" style="float: right;" type="submit" id="Guardar" name="Guardar" value="<?php echo $funcion ?>">
						</div>
					</form>
				</div>
			</div>
			<div style="height:250px"></div>
			
			 <!--Footer-->
			<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatl&aacute;n, Nayarit.</p>
			</div>
			<!--/.Footer-->

		</div>
	</div>
	
	</body>
</html>