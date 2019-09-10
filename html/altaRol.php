  <?php $tituloPagina="Alta de Rol" ?>
        <?php include 'getInfo.php'; ?>
        <?php include 'header.php'; ?>
	<div class="header-bottom">
		<div class="container">
			<div class="row justify-content-center text-center text-md-left">
				<div class="col-12">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row justify-content-center text-center text-md-left">
				<div class="col-12 col-md-4 mt-5 mt-md-10">
					<form class="Myformulario" action="altaRolDB.php" method="post">
						<div class="form-group">
							<label style="font-size: 35px; text-align: center;">Tipo de Rol </label>
							<input style="width: 280px" placeholder="Ejemplo: Trabajador"    type="text"  name="nombreRol" value="" maxlength="45" required=" " pattern="[a-zA-Z]+">
						</div>
						<div class="form-group">
						<input type="submit" class="btn btn-info"   id="Guardar" name="Guardar" value="Dar de alta">
						</div>
					</form>
				</div>
			</div>
		</div>
			<div style="height:250px"></div>
<?php
include 'footer.php';
?>			 <!--Footer-->
			<div class="footer" style="color:#fff; background:#34495E;">
				<p style="text-align: center;"> © 2019 Copyright: Ahuacatl&aacute;n, Nayarit.</p>
			</div>
			<!--/.Footer-->

		</div>
	</div>
	</body>
</html>
