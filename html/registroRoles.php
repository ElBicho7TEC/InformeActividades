<?php $tituloPagina="Registro de Roles" ?>
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
				Roles Existentes
			</h1>
			<div class="row">
				<table>
					<tr>
					  <td>
					  	<strong>Rol</strong>
					  </td>
					</tr>

					<?php
					include("conexion.php");

		  			$cadena='SELECT *FROM rol';
				    $gsent = $conn->prepare($cadena);
				    $gsent->execute();
				    while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC))
				    {
				    	$tiporol=$resultado['tiporol'];

					?>

					<tr>
						<td>
					 		<?php echo $tiporol ?>
					  	</td>
					</tr>

				</div>
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
