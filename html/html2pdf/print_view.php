<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Genrar PDFs con PHP</title>
<style type="text/css">
	
</style>
</head>
<body>
	<?php if(isset($_POST['titulo'])):  ?>
	<p><h1><?=$_POST['titulo']?></h1></p>
	<?php endif; ?>
	<p>Más información</p>
</body>
</html>