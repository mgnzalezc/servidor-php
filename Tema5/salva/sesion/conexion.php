<?php
$_servidor = "localhost";
$_usuario = "root";
$_contrasena = "";
$_bd = "videojuegos_bd";

$_conexion = new mysqli($_servidor, $_usuario, $_contrasena, $_bd);

if($_conexion->connect_error){
    die("Error de conexión: ".$_conexion->connect_error);
}

?>