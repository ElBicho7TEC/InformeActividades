<?php if (isset($_COOKIE['token'])) {
unset($_COOKIE['token']);
setcookie('token', '', time() - 3600, '/'); // empty value and old timestamp
}//borra la cookie de sesion
header("Location: login.php	");
?>