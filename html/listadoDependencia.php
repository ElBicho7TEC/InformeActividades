<?php $tituloPagina="Listado de Dependencias" ?>
<?php include 'getInfo.php'; ?>

			<?php include 'header.php'; ?>


	<body>
	<div class="header-bottom">

	<div class="container">
	<div class="row justify-content-center text-center text-md-left">
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
