<?php $tituloPagina="Registro de dependencias" ?>
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
			<h1 class="text-center">Dependencias Existentes</h1>
			<div class="row">

				<table>
					<tr>
					  <td>
					  	<strong>Dependencia</strong>
					  </td>

					  <td>
					  	<strong>Calle</strong>
					  </td>

					  <td>
					  	<strong>Colonia</strong>
					  </td>

					  <td>
					  	<strong>N&uacute;mero</strong>
					  </td>

					  <td>
					  	<strong>C&oacute;digo postal</strong>
					  </td>

					  <td>
					  	<strong>Entre calles</strong>
					  </td>
					</tr>

					<?php
					include("conexion.php");

				  	$cadena='SELECT *FROM dependencia';
				    $gsent = $conn->prepare($cadena);
				    $gsent->execute();
				    while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC))
				    {
					    $nombreDeependencia=$resultado['nombredependencia'];
					    $calle=$resultado['calle'];
					    $colonia=$resultado['colonia'];
					    $numero=$resultado['numero'];
					    $codigoPostal=$resultado['codigopostal'];
					    $entreCalles=$resultado['entrecalles'];
					?>

					<tr>
						<td>
					  		<?php echo $nombreDeependencia ?>
						</td>
					  	<td>
							<?php  echo   $calle ?>
					  	</td>
						<td>
					  		#<?php echo  $numero  ?>
						</td>
					  	<td>
							<?php  echo   $colonia ?>
						</td>
						<td>
							<?php  echo   $codigoPostal ?>
						</td>
						<td>
							Entre <?php  echo   $entreCalles ?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>

		<div class="container">
			<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatlán, Nayarit.</p>
			</div>
		</div>
	</body>
</html>
