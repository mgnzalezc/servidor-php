<?php
/**
 * Vamos a crear conexion entre PHP y la db mysql, usando la clase mysqli
 * 
 * new mysqli(...) --> es el constructor de la clase mysqli, que se utiliza para inicializar un objeto que representa la conexion a db
 * 
 * si se produce conexion, la variable contendra un objeto de la clase mysqli que podremos usar con la db (consulta, manejo errores...)
 * si se produce fallo al conectarse, el método "connect_error" de este objeto contendra info sobre el porque no hemos podido conectarnos
 * 
 * 
 */
$_servidor = "localhost";
$_usuario = "MEDAC";
$_contraseña = "MEDAC";
$_bd = "peliculas_bd";

$_conexion = new mysqli($_servidor, $_usuario, $_contraseña, $_bd);

if($_conexion->connect_error){
    die("Error en la conexión: ".$_conexion->connect_error); //cargas conexion a db y sacas el fallo, se para todo y o sigue el codigo, por eso no necesitamos else
}

/* esto no deberia estar, lo comento para verlo, pero en conexion deberia estar solo la conexion o el error de conexion
    var_dump($_conexion->connect_error); //nulo porque ha ido bien
    echo "Conectados <br>";

    echo $_conexion->server_info;
    echo $_conexion->server_version; //en el -> estan todos los metodos del objeto q podemos usar

    para cerrar conexion: $_conexion->close();
*/

?>