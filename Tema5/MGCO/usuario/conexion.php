<?php
$_servidor = "localhost";
$_usuario = "MEDAC";
$_contraseña = "MEDAC";
$_bd = "tienda_bd";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$_conexion = new mysqli($_servidor, $_usuario, $_contraseña, $_bd);

if($_conexion->connect_error){
    die("Error en la conexión: ".$_conexion->connect_error); //cargas conexion a db y sacas el fallo, se para todo y o sigue el codigo, por eso no necesitamos else
}

?>