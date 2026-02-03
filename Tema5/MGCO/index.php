<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["nombre"])){
        header("location: usuario/login.php"); //manda de vuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }

    ?>

</head>
<body>
    
    <?php

    echo "<h1>Bienvenido de nuevo, ".$_SESSION['nombre'] ."</h1>";

    if($_SESSION["rol"]=="admin"){
        echo "<h1> Está en modo administrador</h1>";

    } else if ($_SESSION["rol"]=="cliente"){
        echo "<h1> Está en modo editor</h1>";
    } else{
        echo "<h1> Está en modo cliente</h1>";
    }
    ?>

    
    <a href="productos.php"> Productos </a>
    <?php
    if($_SESSION["rol"]=="admin"){
        echo "<a href='nuevo.php'> Crear producto </a>";
    }
    ?>

    <a href="usuario/logout.php">Log out</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    
</body>
</html>