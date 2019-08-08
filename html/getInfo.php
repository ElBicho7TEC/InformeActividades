<?php
include("conexion.php");
if (isset($_COOKIE['token'])) {
$token=$_COOKIE["token"];
	$getID = $conn->prepare('SELECT idusuario FROM tokensesion where token='.'\''.$token.'\' and expira>'.'\''.date('Y-m-d').'\'');  //se obtienen el id del usuario loggeado
	$getID->execute(); //se ejecuta la consulta
	$resultado = $getID->fetchAll(); //se obtienen los datos de la consulta
	if($getID->rowCount()>0){
		foreach ($resultado as $User) { //se extraen los datos
			$idUsuarios=$User['idusuario'];
		}
		$getData = $conn->prepare('SELECT correoelectronico,nombre,apellidopaterno,apellidomaterno,iddependencia,idrol FROM usuarios where idusuario='.'\''.$idUsuarios.'\'');  //se obtienen los datos del usuario
		$getData->execute(); //se ejecuta la consulta
		$resultado = $getData->fetchAll(); //se obtienen los datos de la consulta
		if($getData->rowCount()>0){
			foreach ($resultado as $User) { //se extraen los datos
				$correoElectronico=$User['correoelectronico'];
				$Nombre=$User['nombre'];
				$apellidoPaterno=$User['apellidopaterno'];
				$apellidoMaterno=$User['apellidomaterno'];
				$idDependencia=$User['iddependencia'];
				$idRol=$User['idrol'];
			}
		}
	}else{
		if (isset($_COOKIE['token'])) {
			unset($_COOKIE['token']);
			setcookie('token', '', time() - 3600, '/'); // empty value and old timestamp
		}//borra la cookie al ya no ser valida
		header("Location: login.php?error=3	");//Entra a esta condici車n unicamente si la sesi車n no existe en la BD o la fecha de expiraci車n ha vencido, redirige al login
		}
}
else{
	if(isset($hastaAqui)) {
$idRol="";
	} else {
    header("Location: login.php?error=3	");// Si no existe el token te redirige al login
}
}
?>
