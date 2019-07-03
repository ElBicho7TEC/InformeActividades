<?php
include("conexion.php");
$correo=$_POST['correo'];
$pass=$_POST['pass'];
 $login = $conn->prepare("SELECT * FROM usuarios where correoElectronico=?");  //se realiza la consulta de los datos del usuario
$login->execute(array($correo)); //se ejecuta la consulta
$resultado = $login->fetchAll(); //se obtienen los datos de la consulta
$totalUsuarios=$login->rowCount(); //se cuenta el numero de registros
if($totalUsuarios>0){
	foreach ($resultado as $User) { //se extraen los datos
		$idUsuarios=$User['idUsuario'];
		$contraseña=$User['contrasena'];
		$idDependencia=$User['idDependencia'];
		$idRol=$User['idRol'];
	}
	include("Decodificacion.php"); // se incluye el archivo de desencriptacion 
    $Contradesencriptada=decodificar($contraseña); //se ejecuta la funcion de desencriptar
	  if($pass==$Contradesencriptada){//compara la contraseña ingresada con aquella que obtuvimos de la BD, si entra, asigna las cookies del usuario
	  	$deleteOldToken = $conn->prepare('DELETE FROM `gestion_plan_desarrollo`.`tokensesion` WHERE idUsuario = :idUsuario;');  //se prepara delete del token previo del usuario
		$deleteOldToken->bindParam(':idUsuario',$idUsuarios);//asignacion de variables
		$deleteOldToken->execute();
		$token = bin2hex(random_bytes(20)); //Genera un token aleatorio con longitud de 20 caracteres
		$date = strtotime("+30 day"); //calcula la fecha actual y le agrega 30 días para obtener la vigencia de la sesión, modificar el 30 por el número deseado si se requiere
		$insertToken = $conn->prepare('INSERT INTO `gestion_plan_desarrollo`.`tokensesion` VALUES (:token,:idUsuario,:date) ;');  //se prepara inserción de el token de sesion a la BD
		$insertToken->bindParam(':token',$token); //liga de parametros
		$insertToken->bindParam(':idUsuario',$idUsuarios);
		$insertToken->bindParam(':date',date('Y-m-d', $date));//fin liga de parametros
		$insertToken->execute(); //se ejecuta la inserción
		$cookie_name = "token";
		$cookie_value = $token;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		header("Location: index.php?status=1");//Manda al usuario a la página principal del sitio, con estado 1 (sesión iniciada)
	}else{
		echo "Contraseña incorrecta";
		header("Location: login.php?error=2");//Regresa al usuario al login con el índice de error que indica contraseña incorrecta
	}
}else{
	header("Location: login.php?error=1");//Regresa al usuario al login con el índice de error que indica que el usuario no existe
}
?>
