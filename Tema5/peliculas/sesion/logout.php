<?php
session_start(); // Recogemos sesion
$_SESSION = []; // Limpiamos el array de sesion
session_destroy(); //eliminamos todos los datos de la sesion del servidor PERO la cookie PHPSESSID sigue existiendo en el navedor pero no pasa nada porque no tiene datos asociados
header("location: login.php"); // redirigir cliente
exit();

?>