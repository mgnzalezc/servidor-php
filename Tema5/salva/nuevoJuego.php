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
    <style>
        p{
            text-align: center;
        }
    </style>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){ //Comprobamos si el cliente ha iniciado sesión
        header("location: sesion/login.php");
        exit;
    }
    if(!$_SESSION["admin"]){ // Comprobamos si el cliente es admin
        header("location: index.php");
        exit;
    }
    require "sesion/conexion.php";



    // Para la lista desplegable
    $desarrolladoras = [];
    $consulta_lista = "SELECT nombre_desarrolladora FROM desarrolladoras";
    $res = $_conexion->query($consulta_lista);
    while($fila = $res->fetch_assoc()){
        array_push($desarrolladoras, $fila["nombre_desarrolladora"]);
    }
    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $titulo = trim($_POST["titulo"]);
        $nombre_desarrolladora = $_POST["nombre_desarrolladora"];
        $anno_lanzamiento = $_POST["anno_lanzamiento"];
        $porcentaje_resennas = $_POST["porcentaje_resennas"];
        $horas_duracion = $_POST["horas_duracion"];

        $errores = false;

        if($titulo == ""){
            $errores = true;
            $err_titulo = "<p class='bg-danger mt-1'>Introduce un titulo</p>";
        }

        if($nombre_desarrolladora == "pollitadura"){
            $errores = true;
            $err_estudio = "<p class='bg-danger mt-1'>Introduce una desarrolladora</p>";
        }

        if(!$errores){
            $consulta = "INSERT INTO videojuegos 
                            (titulo,
                            nombre_desarrolladora ,
                            anno_lanzamiento,
                            porcentaje_reseñas,
                            horas_duracion)
                            VALUES
                            (? , ? , ? , ? , ?)"; 
            $stmt = $_conexion->prepare($consulta);

            $stmt->bind_param("ssidi",$titulo, $nombre_desarrolladora, $anno_lanzamiento, $porcentaje_resennas, $horas_duracion);

            if($stmt->execute()){
                echo "<div class='alert alert-success'>La juego ha sido añadida</div>";
            }else{
                echo "<div class='alert alert-danger'>La juego NO ha sido añadida</div>";
            }
        }
    }
    ?>
    <div class="container mt-4">
        <h1 class="fs-1">Crear el juego </h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control">
                <?php //if(isset($err_titulo)) echo $err_titulo; ?>
                <?= $err_titulo ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Desarrolladora</label>
                <select name="nombre_desarrolladora" class="form-select">
                    <option value="pollitadura" selected>-------Elige una desarrolladora--------</option>
                    <?php
                    foreach($desarrolladoras as $desarrolladora){    
                    ?>
                    <option value="<?= $desarrolladora?>">
                        <?= $desarrolladora ?>
                    </option>
                    <?php    
                    }
                    ?>
                </select>
                <?= $err_estudio ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Año de lanzamiento</label>
                <input type="text" name="anno_lanzamiento" class="form-control">
                <?= $err_anno ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Porcentaje de reseñas</label>
                <input type="text" name="porcentaje_resennas" class="form-control">
                <?= $err_temporadas ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Horas de duración</label>
                <input type="text" name="horas_duracion" class="form-control">
                <?= $err_duracion ?? "" ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="Crear Jueguito" class="btn btn-success">
            </div>
        </form>
        <a href="index.php" class="btn btn-secondary">Volver al menú principal</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>