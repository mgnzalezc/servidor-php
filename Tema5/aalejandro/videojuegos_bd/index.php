<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php");
        exit();
    }
    ?>
</head>
<body>
    <?php
    if($_SESSION["admin"]){
    
    
    ?>
    <div class="container text-center mt-5">
        <h1>Zona admins, bienvenid@ <?= $_SESSION["usuario"] ?></h1>
        <p class="mt-5">Elija una de las opciones:</p>
        <div class="d-grid gap-3 col-6 mx-auto mt-4">
            <a href="nuevoJuego.php" class="btn btn-secondary btn-admin">Crear un nuevo juego</a>
            <a href="nuevaDesarrolladora.php" class="btn btn-secondary">Crear una nueva desarrolladora</a>
            <a href="juego.php" class="btn btn-primary">Ir a los juegos</a>
            <a href="desarrolladoras.php" class="btn btn-primary">Ir a desarrolladoras</a>
            <a href="sesion/logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
    
    <?php
    }else{
    ?>

    <div class="container text-center mt-5">
        <h1>Bienvenid@ <?= $_SESSION["usuario"] ?></h1>
        <p class="mt-5">Elija una de las opciones:</p>
        <div class="d-grid gap-3 col-6 mx-auto mt-4">
            <a href="listaPelis.php" class="btn btn-primary">Ir a las pelis</a>
            <a href="listaEstudios.php" class="btn btn-primary">Ir a estudios</a>
            <a href="sesion/logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>

    </div>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>