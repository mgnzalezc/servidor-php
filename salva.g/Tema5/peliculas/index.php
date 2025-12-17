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

    ?>

</head>
<body>
    <h1>Has iniciado sesion, <?= $_SESSION["usuario"] //eso significa php echo, el ?= ?> </h1>

    <a href="sesion/logout.php">Log out</a>
    <a href="vistaPelis.php">Ver lista peliculas</a>
    <a href="vistaPelis2.php">Lista multisort</a>
    <a href="listaEstudios.php">Lista de Estudios</a>
    
</body>
</html>