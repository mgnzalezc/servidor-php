<?php
    session_start();
    //ahora si podemos usar el array $_SESSION
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX REAL</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php"); //manda de vuuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }

    //aqui no hace falta require conexion porque no estoy accediendo a la bd

    ?>

</head>
<body>
    <?php
    if($_SESSION["admin"]==1){
        echo "<h1>Bienvenido a la zona admin, ".$_SESSION['usuario'] ."</h1>";
    } else{
        echo "<h1>Has iniciado sesion, ".$_SESSION['usuario'] ."</h1>";
    }
    ?>

    <a href="sesion/logout.php">Log out no esta hecho aun</a>
    <a href="juego.php"> Lista de juegos</a>
    
</body>
</html>