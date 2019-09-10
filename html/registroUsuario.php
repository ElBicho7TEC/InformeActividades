<?php $tituloPagina="Registro de Usuarios" ?>
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
			<h1 class="text-center">
				Usuarios Existentes
			</h1>
			<div class="row">

				<table>
					<tr>
					  <td>
					  	<strong>Nombre(s)</strong>
					  </td>

					  <td>
					  	<strong>Apellido Paterno</strong>
					  </td>

					  <td>
					  	<strong>Apellido Materno</strong>
					  </td>

					  <td>
					  	<strong>Correo electr&oacute;nico</strong>
					  </td>
					</tr>


					<?php
					include("conexion.php");

	  				$cadena='SELECT *FROM usuarios';
	    			$gsent = $conn->prepare($cadena);
	    			$gsent->execute();
	    			while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC))
	    			{
					    $Correo=$resultado['correoelectronico'];
					    $Nombre=$resultado['nombre'];
					    $Apellidopat=$resultado['apellidopaterno'];
					    $Apellidomat=$resultado['apellidomaterno'];
					?>

						<tr>
							<td>
						  		<?php  echo   $Nombre ?>
						  	</td>
						  	<td>
						  		<?php  echo   $Apellidopat ?>
						  	</td>
						  	<td>
						  		<?php  echo   $Apellidomat ?>
						  	</td>
						  	<td>
						  		<?php echo $Correo ?>
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
				<p style="text-align: center;">
					© 2019 Copyright: Ahuacatlán, Nayarit.
				</p>
			</div>
		</div>
	</body>
</html>
