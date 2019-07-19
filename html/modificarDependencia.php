<html>
	<head>
		<title>Modificar Dependencia</title>
		
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Anton|Dosis:400,800" rel="stylesheet">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="shortcut icon" href="logos/AhucatlanTransparente.png" type="image/png" />
	<?php include 'header.php' ?>
	</head>
	
	<body>
	<div class="header-bottom">
	
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
				
			</div>
	</div>
	</div>
	
	<div class="container">
		<h1 class="text-center">Modificar Dependencias</h1>
		<div class="col-md-6" >
			<form class="Myformulario" style="margin-top: 150p%; margin-left: 15%;" action="dataDependencia.php" method="post">
				<div class="form-group">
					<label>Nombre:</label>
					<input placeholder="Ejemplo: Transito" type="text" name="nombre" maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+">
					<label>Calle:</label>
					<input placeholder="Ejemplo: Mercado" type="text" name="calle"  maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+">
					<label>Colonia:</label>
					<input placeholder="Ejemplo: Centro" type="text" name="colonia" maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+">
					<label>N&uacute;mero:</label>
					<input placeholder="Ejemplo: 11" type="text" name="numero"  maxlength="45" size="50" pattern="[0-9]{1,3}$" required=" " pattern="[a-zA-Z\s]+">
					<label>C&oacute;digo Postal:</label>
					<input placeholder="Ejemplo: 63999" type="text" name="cp"  maxlength="45" size="50" required=" " pattern="[0-9]{5}">
					<label>Entre Calles:</label>
					<input placeholder="Ejemplo: Mercado e Hidalgo" type="text" name="referencias"   maxlength="45" size="50" required=" " pattern="[]+">
				</div>
				<div class="form-group text-center">
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