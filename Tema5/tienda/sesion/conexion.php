<?php

$_servidor = "localhost";
$_usuario = "MEDAC";
$_contraseña = "MEDAC";
$_bd = "tienda_bd";

$_conexion = new mysqli($_servidor, $_usuario, $_contraseña, $_bd);

if($_conexion->connect_error){
    die("Error en la conexión: ".$_conexion->connect_error);
}


?>
