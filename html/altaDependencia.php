				<?php $tituloPagina="Alta de dependencia" ?>
        <?php include 'getInfo.php'; ?>
        <?php include 'header.php'; ?>

	<body>
	<div class="container">
		<div class="row justify-content-center text-center text-md-left" >
		<h1 class="text-center">Registro de Dependencias</h1>
		<div class="col-md-12" >
			<form class="Myformulario" style="margin-top: 150p%; margin-left: 15%;" action="altaDependenciaDB.php" method="post">
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
					<input placeholder="Ejemplo: Mercado e Hidalgo" type="text" name="referencias"   maxlength="45" size="50" required=" " pattern="[a-zA-Z\s]+">
				</div>
				<div class="form-group text-center">
					<input class="btn btn-info" type="submit" id="Guardar" name="Guardar" value="Dar de Alta">
				</div>
			</form>

		</div>
	</div>
</div>
	<div class="container">
	<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatlán, Nayarit.</p>
			</div>
	</div>
	</body>
</html>
