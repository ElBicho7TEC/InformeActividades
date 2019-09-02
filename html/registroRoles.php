<?php include 'getInfo.php'; ?>
<html>
	<head>
		<title>Roles Existentes</title>
			<?php include 'header.php'; ?>
	</head>

	<body>
	<div class="header-bottom">

	<div class="container">
	<div class="row justify-content-center text-center text-md-left">
			</div>
	</div>
	</div>

	<div class="container mb-2">
		<h1 class="text-center">Roles Existentes</h1>
	<div class="row">
	<?php
include("conexion.php");

  $cadena='SELECT *FROM rol';
    $gsent = $conn->prepare($cadena);
    $gsent->execute();
    while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC)) {

    $tiporol=$resultado['tiporol'];

?>

<div class="col-md-4 col-lg-3 ">
<div class="border border-dark">
<div class=" text-light text-center mb-2   bg-dark" >
 <h4> <?php echo $tiporol ?> </h4>
</div>

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
