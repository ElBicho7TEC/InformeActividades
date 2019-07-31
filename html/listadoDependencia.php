
<?php include 'getInfo.php'; ?>
<html>
	<head>
		<title>Listado de Dependencias</title>
			<?php include 'header.php'; ?>
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
	
	<div class="container mb-2">
		<h1 class="text-center">Listado de Dependencias</h1>
	<div class="row">
	<?php
include("conexion.php");

  $cadena='SELECT *FROM dependencia';
    $gsent = $conn->prepare($cadena);
    $gsent->execute();
    while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC)) {
		
		$idDependencia=$resultado['iddependencia'];
    $nombreDeependencia=$resultado['nombredependencia'];
    $calle=$resultado['calle'];
    $colonia=$resultado['colonia'];
    $numero=$resultado['numero'];
    $codigoPostal=$resultado['codigopostal'];
    $entreCalles=$resultado['entrecalles'];

?>

<div class="col-md-4 col-lg-3 ">
<div class="border border-dark">
<div class=" text-light text-center mb-2   bg-dark" >
 <h4> <?php echo $nombreDeependencia ?> </h4>
<div class=" text-center p-4 bg-light text-dark">
<p>  <?php  echo   $calle ?>  #<?php echo  $numero  ?></p>
<p> <?php  echo   $colonia ?> </p>
<p> <?php  echo   $codigoPostal ?> </p>
<p>Entre <?php  echo   $entreCalles ?> </p>
</div>

<a href="modificarDependencia.php?idDependencia=<?php echo $idDependencia ;?>" class="btn btn-light">Editar</a>

</div>
</div>
</div>
<?php } ?>
			
		</div>
	</div>
	<div class="container">
	<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatlán, Nayarit.</p>
			</div>
	</div>
	</body>
</html>