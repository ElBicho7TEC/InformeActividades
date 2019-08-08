<?php include 'header.php' ?>
		<div class="container">
			<div class="row justify-content-center text-center text-md-left">
				<div class="col-12 " >
					<form  class="Myformulario" method='POST' >
					    <div class="form-group text-center">
						    <h2>Registro del Usuario</h2>
					    </div>
					    <div class="form-group text-center">
						    <h3>Datos Personales</h3>
					    </div>
					    <div class="form-group text-center">
						    <span>Nombre:</span>
						    <input type="text" id="Nombre" name="Nombre" required=""  maxlength="45" pattern="[A-Za-z]+">
					   </div>
					   <div class="form-group text-center">
						  <span>Apellido Paterno:</span>
						  <input type="text" id="ApellidoP" name="ApellidoP" required="" pattern="[A-Za-z]+" maxlength="45">
					   </div>
					   <div class="form-group text-center">
						   <span>Apellido Materno:</span>
						   <input type="text" id="ApellidoM" name="ApellidoM" required="" pattern="[A-Za-z]+" maxlength="45">
					   </div>
					   <div class="form-group text-center">
						  <h3>Datos de usuario</h3>
					  </div>
					  <div class="form-group text-center">
						  <span>Correo eletr&oacute;nico:</span>
						  <input type="email" name="Correo" id="Correo" required="required">
					  </div>
					  <div class="form-group text-center">
						  <span>Contrase&ntilde;a:</span>
						  <input type="password" name="Contrasena" id="Contrasena" required=""  minlength="8" maxlength="20">
					  </div>
					  <div class="form-group text-center">
					       <span>Rol:</span>
						   <select  id="Rol" name="Rol" required="">
						   	<p></p>
						   	<?php
						   	include 'conexion.php';
						   	$datos = $conn->query('SELECT * FROM rol');
						   	while ($valores=$datos->fetch()) {
						   		echo "'<option value= $valores[idrol]> $valores[tiporol] </option>'";
						   	}
                           ?>
						   </select>
					  </div>
					  <div class="form-group text-center">
				           <span>Dependencia:</span>
						   <select  id="Dependencia" name="Dependencia" required="">
						   	<p></p>
						   	<?php
						   	include 'conexion.php';
						   	$datos = $conn->query('SELECT * FROM dependencia');
						   	while ($valores=$datos->fetch()) {
						   		echo "'<option value= $valores[iddependencia]> $valores[nombredependencia] </option>'";
						   	}
                           ?>
						   </select>
                      </div>
				      <div class="form-group text-center">
						   <input type="submit" class="btn btn-info" value="Registrarse" id="Registro"  name="Registro" style="margin: 25px;" required="">
					  </div>
				   </form>
    			 </div>
    	    </div>
		</div>
<?php
include 'footer.php';
if (isset($_POST["Nombre"])) {
$id=1;
$Nombre=$_POST["Nombre"];
$ApellidoP=$_POST["ApellidoP"];
$ApellidoM=$_POST["ApellidoM"];
$Correo=$_POST["Correo"];
$Contra=$_POST["Contrasena"];
include("codificacion.php"); // se incluye el archivo codificacion
$ContraEncriptada=codificar($Contra);// mandar a llamar la funcion para encriptar la contraseña
$Dependencia=$_POST["Dependencia"];;
$Rol=$_POST["Rol"];
include 'conexion.php';
$stmt=$conn->prepare("call sp_insertar_usuarios(?,?,?,?,?,?,?)");
$stmt->bindParam(1,$Correo, PDO::PARAM_STR);
$stmt->bindParam(2,$ContraEncriptada, PDO::PARAM_STR); //se manda como parametro la contraseña encriptada
$stmt->bindParam(3,$Nombre, PDO::PARAM_STR);
$stmt->bindParam(4,$ApellidoP, PDO::PARAM_STR);
$stmt->bindParam(5,$ApellidoM, PDO::PARAM_STR);
$stmt->bindParam(6,$Dependencia, PDO::PARAM_STR);
$stmt->bindParam(7,$Rol, PDO::PARAM_STR);
$stmt->execute(); }
?>
